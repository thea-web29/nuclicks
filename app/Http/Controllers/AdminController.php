<?php

namespace App\Http\Controllers;

//use App\Mail\CourseCodeMail;
use App\Models\Notification;
use App\Models\AccessLog;
use App\Models\ActivityLog;
use App\Models\AdminFile;
use App\Models\FacultyEvaluation;
use App\Models\Course;
use App\Models\CourseMaterial;
use App\Models\Department;
use App\Models\Enrollment;
use App\Models\LoginHistory;
use App\Models\Program;
use App\Models\Section;
use App\Models\FacultySubjectAssignment;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\SystemSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Throwable;

class AdminController extends Controller
{
    // ==================== DASHBOARD ====================

    public function dashboard()
    {
        $totalStudents = User::where('role', 'student')->count();
        $totalFaculty = User::where('role', 'faculty')->count();
        $totalCourses = Course::count();
        $totalEvaluations = class_exists(FacultyEvaluation::class) ? FacultyEvaluation::count() : 0;
        $totalFiles = class_exists(AdminFile::class) ? AdminFile::where('type', 'file')->whereNull('archived_at')->count() : 0;
        $totalQuizzes = Quiz::count();
        $activeQuizzes = Quiz::where('is_active', true)->count();

        $totalAttempts = QuizAttempt::count();
        $averageScore = QuizAttempt::avg('score') ?? 0;

        if ($averageScore > 0) {
            $averageScore = ($averageScore / max(Quiz::sum('total_points'), 1)) * 100;
        }

        $coursesPerFaculty = User::where('role', 'faculty')
            ->withCount('courses')
            ->orderBy('courses_count', 'desc')
            ->limit(5)
            ->get();

        $recentEnrollments = Enrollment::with(['student', 'course'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentAttempts = QuizAttempt::with(['student', 'quiz.course'])
            ->orderBy('completed_at', 'desc')
            ->limit(5)
            ->get();

        $recentActivities = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $topFaculty = $this->getTopPerformingFaculty(5);

        $monthlyStats = $this->getMonthlyStats();

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalFaculty',
            'totalCourses',
            'totalEvaluations',
            'totalFiles',
            'totalQuizzes',
            'activeQuizzes',
            'totalAttempts',
            'averageScore',
            'coursesPerFaculty',
            'recentEnrollments',
            'recentAttempts',
            'recentActivities',
            'topFaculty',
            'monthlyStats'
        ));
    }

    private function getMonthlyStats()
    {
        return collect(range(1, 12))->map(function ($month) {
            return [
                'month' => date('M', mktime(0, 0, 0, $month, 1)),
                'students' => User::where('role', 'student')
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', date('Y'))
                    ->count(),
                'courses' => Course::whereMonth('created_at', $month)
                    ->whereYear('created_at', date('Y'))
                    ->count(),
                'quizzes' => Quiz::whereMonth('created_at', $month)
                    ->whereYear('created_at', date('Y'))
                    ->count(),
            ];
        });
    }


    private function getTopPerformingFaculty(int $limit = 5)
    {
        if (!class_exists(FacultyEvaluation::class)) {
            return collect();
        }

        return User::where('role', 'faculty')
            ->withCount('facultyEvaluationsReceived')
            ->withAvg('facultyEvaluationsReceived', 'rating')
            ->having('faculty_evaluations_received_count', '>', 0)
            ->orderByDesc('faculty_evaluations_received_avg_rating')
            ->orderByDesc('faculty_evaluations_received_count')
            ->limit($limit)
            ->get();
    }

    // ==================== USER MANAGEMENT ====================

    public function users()
    {
        $students = User::where('role', 'student')
            ->with('program')
            ->withCount(['enrollments', 'quizAttempts'])
            ->orderBy('name')
            ->paginate(10, ['*'], 'students_page');

        $faculty = User::where('role', 'faculty')
            ->withCount('courses')
            ->orderBy('name')
            ->paginate(10, ['*'], 'faculty_page');

        return view('admin.users', compact('students', 'faculty'));
    }

    public function createUser()
    {
        $programs = Program::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();
        return view('admin.create-user', compact('programs', 'departments'));
    }

    public function storeUser(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:student,faculty,admin',
            'status' => 'nullable|in:active,inactive',
        ];

        if ($request->role === 'student') {
            $rules['student_id'] = 'required|string|max:50|unique:users,student_id';
            $rules['year_level'] = 'nullable|integer|min:1|max:12';
            $rules['program_id'] = 'required|exists:programs,id';
        }

        if ($request->role === 'faculty') {
            $rules['faculty_id'] = 'required|string|max:50|unique:users,faculty_id';
            $rules['department_id'] = 'nullable|exists:departments,id';
            $rules['specialization'] = 'nullable|string|max:255';
            $rules['qualification'] = 'nullable|string';
        }

        if ($request->role === 'admin') {
            $rules['password'] = 'required|min:8|confirmed';
            $rules['password_confirmation'] = 'required';
        }

        $validated = $request->validate($rules);

        if ($request->role === 'student') {
            $password = $validated['student_id'];
        } elseif ($request->role === 'faculty') {
            $password = $validated['faculty_id'];
        } else {
            $password = $validated['password'];
        }

        $mustChangePassword = in_array($request->role, ['student', 'faculty']);

        $user = User::create([
            'name' => $validated['name'],
            'email' => strtolower(trim($validated['email'])),
            'password' => Hash::make($password),
            'role' => $validated['role'],
            'status' => $validated['status'] ?? 'active',
            'must_change_password' => $mustChangePassword,
            'department_id' => $validated['department_id'] ?? null,
            'student_id' => $validated['student_id'] ?? null,
            'faculty_id' => $validated['faculty_id'] ?? null,
            'year_level' => $validated['year_level'] ?? null,
            'program_id' => $validated['program_id'] ?? null,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Created user: {$user->name} ({$user->role})",
        ]);

        $message = 'User created successfully.';

        if ($request->role === 'student') {
            $message .= ' Initial password is their Student ID.';
        } elseif ($request->role === 'faculty') {
            $message .= ' Initial password is their Faculty ID.';
        }

        return redirect()->route('admin.users')->with('success', $message);
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $courses = Course::all();
        $programs = Program::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();
        $assignedCourses = Course::where('faculty_id', $id)->pluck('id')->toArray();

        return view('admin.edit-user', compact('user', 'courses', 'programs', 'departments', 'assignedCourses'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8|confirmed',
            'role' => 'required|in:student,faculty,admin',
            'status' => 'in:active,inactive',
            'student_id' => 'nullable|string|max:50|unique:users,student_id,' . $id,
            'faculty_id' => 'nullable|string|max:50|unique:users,faculty_id,' . $id,
            'year_level' => 'nullable|integer|min:1|max:12',
            'section' => 'nullable|string|max:50',
            'program_id' => 'nullable|exists:programs,id',
            'department' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'qualification' => 'nullable|string',
            'bio' => 'nullable|string',
            'course_ids' => 'nullable|array',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => strtolower(trim($validated['email'])),
            'role' => $validated['role'],
            'status' => $validated['status'] ?? 'active',
            'student_id' => $validated['student_id'] ?? null,
            'faculty_id' => $validated['faculty_id'] ?? null,
            'year_level' => $validated['year_level'] ?? null,
            'section' => isset($validated['section']) ? strtoupper(trim($validated['section'])) : null,
            'program_id' => $validated['program_id'] ?? null,
            'department' => $validated['department'] ?? null,
            'specialization' => $validated['specialization'] ?? null,
            'qualification' => $validated['qualification'] ?? null,
            'bio' => $validated['bio'] ?? null,
        ]);

        if (!empty($validated['password'])) {
            $user->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        /*
         * Do not clear existing subject assignments by setting courses.faculty_id to NULL.
         * In this LMS structure, faculty-subject assignments are managed in the
         * Faculty Assignments module. Clearing here caused SQL errors when
         * courses.faculty_id was not nullable and could also remove assignments
         * unintentionally when editing a faculty profile.
         */
        if ($user->role === 'faculty' && !empty($validated['course_ids'])) {
            Course::whereIn('id', $validated['course_ids'])->update(['faculty_id' => $user->id]);
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => "Updated user: {$user->name}",
        ]);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function showUser($id)
    {
        $userToView = User::findOrFail($id);

        if ($userToView->role === 'faculty') {
            return redirect()->route('admin.faculty.details', $id);
        }

        $student = User::with(['enrollments.course', 'quizAttempts.quiz.course', 'program'])
            ->findOrFail($id);

        $enrolledCourses = $student->enrollments()->with('course')->get();
        $quizAttempts = $student->quizAttempts()->with('quiz.course')->get();

        $totalScore = 0;
        $totalPossible = 0;

        foreach ($quizAttempts as $attempt) {
            $totalScore += $attempt->score;
            $totalPossible += $attempt->quiz->total_points ?? 0;
        }

        $averageScore = $totalPossible > 0 ? round(($totalScore / $totalPossible) * 100) : 0;

        return view('admin.student-details', compact(
            'student',
            'enrolledCourses',
            'quizAttempts',
            'averageScore'
        ));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users')->with('error', 'You cannot delete your own account.');
        }

        $userName = $user->name;
        $user->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => "Deleted user: {$userName}",
        ]);

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function toggleUserStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();

        return response()->json([
            'success' => true,
            'status' => $user->status,
            'message' => 'User status updated successfully.',
        ]);
    }

    // ==================== BULK IMPORT ====================

    public function bulkImport()
    {
        // Redirects to Account Creation page (Bulk Import tab is now inside create-user)
        return redirect()->route('admin.users.create')->with('tab', 'bulk');
    }

    public function downloadTemplate(Request $request)
    {
        $type = $request->get('type', 'students');

        if ($type === 'students') {
            $headers = ['name', 'email', 'student_id', 'year_level', 'section', 'program_code'];
            $sample = [['Juan Dela Cruz', 'juan@example.com', 'IMNHS26001', '11', 'A', 'TECHPRO']];
            $filename = 'students_import_template.csv';
        } else {
            $headers = ['name', 'email', 'faculty_id', 'department', 'specialization'];
            $sample = [['Maria Santos', 'maria@example.com', 'FAC-001', 'Computer Science', 'Software Engineering']];
            $filename = 'faculty_import_template.csv';
        }

        $handle = fopen('php://temp', 'w+');

        fputcsv($handle, $headers);

        foreach ($sample as $row) {
            fputcsv($handle, $row);
        }

        rewind($handle);

        $content = stream_get_contents($handle);

        fclose($handle);

        return response($content)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function processBulkImport(Request $request)
    {
        $request->validate([
            'type' => 'required|in:students,faculty',
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $type = $request->type;
        $file = $request->file('file');
        $handle = fopen($file->getRealPath(), 'r');

        if (!$handle) {
            return redirect()->back()->with('error', 'Unable to open uploaded CSV file.');
        }

        fgetcsv($handle);

        $created = 0;
        $skipped = 0;
        $errors = [];
        $rowNumber = 1;

        DB::beginTransaction();

        try {
            while (($data = fgetcsv($handle)) !== false) {
                $rowNumber++;

                try {
                    if ($type === 'students') {
                        [$name, $email, $studentId, $yearLevel, $section, $programCode] = array_pad($data, 6, null);

                        $name = trim((string) $name);
                        $email = strtolower(trim((string) $email));
                        $studentId = trim((string) $studentId);
                        $yearLevel = trim((string) $yearLevel);
                        $section = strtoupper(trim((string) $section));
                        $programCode = strtoupper(trim((string) $programCode));

                        if ($name === '' || $email === '' || $studentId === '' || $section === '' || $programCode === '') {
                            $skipped++;
                            $errors[] = "Row {$rowNumber}: Missing required student data.";
                            continue;
                        }

                        if (User::where('email', $email)->exists()) {
                            $skipped++;
                            $errors[] = "Row {$rowNumber}: Email '{$email}' already exists.";
                            continue;
                        }

                        if (User::where('student_id', $studentId)->exists()) {
                            $skipped++;
                            $errors[] = "Row {$rowNumber}: Student ID '{$studentId}' already exists.";
                            continue;
                        }

                        $program = Program::whereRaw('UPPER(code) = ?', [$programCode])->first();

                        if (!$program) {
                            $skipped++;
                            $errors[] = "Row {$rowNumber}: Program code '{$programCode}' not found.";
                            continue;
                        }

                        User::create([
                            'name' => $name,
                            'email' => $email,
                            'password' => Hash::make($studentId),
                            'role' => 'student',
                            'status' => 'active',
                            'must_change_password' => true,
                            'student_id' => $studentId,
                            'year_level' => is_numeric($yearLevel) ? (int) $yearLevel : null,
                            'section' => $section,
                            'course_id' => $program->id,
                        ]);
                    } else {
                        [$name, $email, $facultyId, $department, $specialization] = array_pad($data, 5, null);

                        $name = trim((string) $name);
                        $email = strtolower(trim((string) $email));
                        $facultyId = trim((string) $facultyId);
                        $department = trim((string) $department);
                        $specialization = trim((string) $specialization);

                        if ($name === '' || $email === '' || $facultyId === '') {
                            $skipped++;
                            $errors[] = "Row {$rowNumber}: Missing required faculty data.";
                            continue;
                        }

                        if (User::where('email', $email)->exists()) {
                            $skipped++;
                            $errors[] = "Row {$rowNumber}: Email '{$email}' already exists.";
                            continue;
                        }

                        if (User::where('faculty_id', $facultyId)->exists()) {
                            $skipped++;
                            $errors[] = "Row {$rowNumber}: Faculty ID '{$facultyId}' already exists.";
                            continue;
                        }

                        User::create([
                            'name' => $name,
                            'email' => $email,
                            'password' => Hash::make($facultyId),
                            'role' => 'faculty',
                            'status' => 'active',
                            'must_change_password' => true,
                            'faculty_id' => $facultyId,
                            'department' => $department,
                            'specialization' => $specialization,
                        ]);
                    }

                    $created++;
                } catch (Throwable $e) {
                    $skipped++;
                    $errors[] = "Row {$rowNumber}: " . $e->getMessage();
                }
            }

            fclose($handle);

            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'create',
                'description' => "Bulk imported {$created} {$type} accounts.",
            ]);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            if (is_resource($handle)) {
                fclose($handle);
            }

            return redirect()->back()->with('error', 'Bulk import failed: ' . $e->getMessage());
        }

        return redirect()->route('admin.bulk-import')
            ->with('success', "Import complete: {$created} created, {$skipped} skipped.")
            ->with('import_errors', $errors);
    }

    // ==================== PROGRAM / COURSE MANAGEMENT ====================

    public function programs()
    {
        $programs = Program::with(['department'])
            ->withCount(['subjects', 'students', 'sections'])
            ->orderBy('name')
            ->get();

        $departments = Department::orderBy('name')->get();

        return view('admin.programs', compact('programs', 'departments'));
    }

    public function storeProgram(Request $request)
    {
        $validated = $request->validate([
            'department_id' => ['required', 'exists:departments,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:20', 'unique:programs,code'],
            'description' => ['nullable', 'string'],
        ]);

        $validated['code'] = strtoupper(trim($validated['code']));

        $program = Program::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Created program/course: {$program->code} - {$program->name}",
        ]);

        return response()->json([
            'success' => true,
            'program' => $program,
        ]);
    }

    public function updateProgram(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $validated = $request->validate([
            'department_id' => ['required', 'exists:departments,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:20', Rule::unique('programs', 'code')->ignore($program->id)],
            'description' => ['nullable', 'string'],
        ]);

        $validated['code'] = strtoupper(trim($validated['code']));

        Program::where('id', $program->id)->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => "Updated program/course: {$validated['code']} - {$validated['name']}",
        ]);

        return response()->json(['success' => true]);
    }

    public function deleteProgram($id)
    {
        $program = Program::withCount(['sections', 'subjects', 'students'])->findOrFail($id);

        if ($program->sections_count > 0 || $program->subjects_count > 0 || $program->students_count > 0) {
            return response()->json([
                'success' => false,
                'message' => 'This program/course cannot be deleted because it has sections, subjects, or students connected to it.',
            ], 422);
        }

        $name = $program->name;
        Program::where('id', $program->id)->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => "Deleted program/course: {$name}",
        ]);

        return response()->json(['success' => true]);
    }

    public function getProgramData($id)
    {
        $program = Program::with('department')->findOrFail($id);

        return response()->json([
            'success' => true,
            'program' => $program,
        ]);
    }

    // ==================== DEPARTMENT MANAGEMENT ====================

    public function departments()
    {
        $departments = Department::with(['programs' => function ($query) {
                $query->withCount(['sections', 'subjects', 'students'])->orderBy('name');
            }])
            ->orderBy('name')
            ->get()
            ->map(function ($department) {
                $assignmentFacultyCount = FacultySubjectAssignment::where('department_id', $department->id)
                    ->distinct('faculty_id')
                    ->count('faculty_id');

                $legacyProgramFacultyCount = Course::whereIn('program_id', $department->programs->pluck('id'))
                    ->whereNotNull('faculty_id')
                    ->distinct('faculty_id')
                    ->count('faculty_id');

                $department->computed_faculty_count = max($assignmentFacultyCount, $legacyProgramFacultyCount);
                $department->programs_count = $department->programs->count();

                return $department;
            });

        return view('admin.departments', compact('departments'));
    }

    public function storeDepartment(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:20', 'unique:departments,code'],
            'description' => ['nullable', 'string'],
        ]);

        $validated['code'] = strtoupper(trim($validated['code']));

        $department = Department::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Created department: {$department->code} - {$department->name}",
        ]);

        return response()->json([
            'success' => true,
            'department' => $department,
        ]);
    }

    public function updateDepartment(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:20', Rule::unique('departments', 'code')->ignore($department->id)],
            'description' => ['nullable', 'string'],
        ]);

        $validated['code'] = strtoupper(trim($validated['code']));

        Department::where('id', $department->id)->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => "Updated department: {$validated['code']} - {$validated['name']}",
        ]);

        return response()->json(['success' => true]);
    }

    public function deleteDepartment($id)
    {
        $department = Department::withCount('programs')->findOrFail($id);

        if ($department->programs_count > 0) {
            return response()->json([
                'success' => false,
                'message' => 'This department cannot be deleted because it still has programs/courses under it.',
            ], 422);
        }

        $name = $department->name;
        Department::where('id', $department->id)->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => "Deleted department: {$name}",
        ]);

        return response()->json(['success' => true]);
    }

    public function getDepartmentData($id)
    {
        $department = Department::with(['programs' => function ($query) {
            $query->orderBy('name');
        }])->findOrFail($id);

        return response()->json([
            'success' => true,
            'department' => $department,
        ]);
    }

    // ==================== SECTION MANAGEMENT ====================

    public function sections()
    {
        $sections = Section::with(['program.department'])
            ->withCount(['subjects', 'facultySubjectAssignments'])
            ->orderBy('name')
            ->get();

        $programs = Program::with('department')->orderBy('name')->get();

        return view('admin.sections', compact('sections', 'programs'));
    }

    public function storeSection(Request $request)
    {
        $validated = $request->validate([
            'program_id' => ['required', 'exists:programs,id'],
            'name' => ['required', 'string', 'max:100'],
            'year_level' => ['nullable', 'string', 'max:100'],
            'academic_year' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
        ]);

        $validated['name'] = strtoupper(trim($validated['name']));
        $validated['is_active'] = true;

        $exists = Section::where('program_id', $validated['program_id'])
            ->where('name', $validated['name'])
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Section already exists under this program/course. Section must be unique per program/course.',
            ], 422);
        }

        $section = Section::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Created section: {$section->name}",
        ]);

        return response()->json(['success' => true, 'section' => $section]);
    }

    public function updateSection(Request $request, $id)
    {
        $section = Section::findOrFail($id);

        $validated = $request->validate([
            'program_id' => ['required', 'exists:programs,id'],
            'name' => ['required', 'string', 'max:100'],
            'year_level' => ['nullable', 'string', 'max:100'],
            'academic_year' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
        ]);

        $validated['name'] = strtoupper(trim($validated['name']));

        $exists = Section::where('program_id', $validated['program_id'])
            ->where('name', $validated['name'])
            ->where('id', '!=', $section->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Section already exists under this program/course. Section must be unique per program/course.',
            ], 422);
        }

        Section::where('id', $section->id)->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => "Updated section: {$validated['name']}",
        ]);

        return response()->json(['success' => true]);
    }

    public function deleteSection($id)
    {
        $section = Section::withCount(['subjects', 'facultySubjectAssignments'])->findOrFail($id);

        if ($section->subjects_count > 0 || $section->faculty_subject_assignments_count > 0) {
            return response()->json([
                'success' => false,
                'message' => 'This section cannot be deleted because subjects or faculty assignments are connected to it.',
            ], 422);
        }

        $name = $section->name;
        Section::where('id', $section->id)->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => "Deleted section: {$name}",
        ]);

        return response()->json(['success' => true]);
    }

    public function getSectionData($id)
    {
        $section = Section::with('program.department')->findOrFail($id);

        return response()->json([
            'success' => true,
            'section' => $section,
        ]);
    }

    // ==================== SUBJECTS / FACULTY ASSIGNMENT MANAGEMENT ====================

    public function subjects()
    {
        $courses = Course::with(['faculty', 'program.department', 'sectionRecord'])
            ->withCount(['students', 'quizzes'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $faculties = User::where('role', 'faculty')
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $departments = Department::orderBy('name')->get();
        $programs = Program::with('department')->orderBy('name')->get();
        $sections = Section::with('program')->where('is_active', true)->orderBy('name')->get();

        return view('admin.subjects', compact('courses', 'faculties', 'programs', 'departments', 'sections'));
    }

    public function courses()
    {
        return $this->subjects();
    }

    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:courses,code'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'credits' => ['required', 'integer', 'min:1', 'max:6'],
            'faculty_id' => ['nullable', 'exists:users,id'],
            'program_id' => ['required', 'exists:programs,id'],
            'section_id' => ['required', 'exists:sections,id'],
        ]);

        $program = Program::with('department')->findOrFail($validated['program_id']);
        $section = Section::where('id', $validated['section_id'])
            ->where('program_id', $program->id)
            ->first();

        if (!$section) {
            return response()->json([
                'success' => false,
                'message' => 'Selected section does not belong to the selected program/course.',
            ], 422);
        }

        if (!$program->department_id) {
            return response()->json([
                'success' => false,
                'message' => 'Selected program/course must be assigned to a department before adding subjects.',
            ], 422);
        }

        $validated['code'] = strtoupper(trim($validated['code']));
        $validated['section'] = $section->name;
        $validated['join_code'] = strtoupper(substr(md5(uniqid('', true)), 0, 6));

        $course = Course::create($validated);

        if (!empty($validated['faculty_id'])) {
            FacultySubjectAssignment::updateOrCreate(
                [
                    'faculty_id' => $validated['faculty_id'],
                    'program_id' => $program->id,
                    'section_id' => $section->id,
                    'subject_id' => $course->id,
                ],
                [
                    'department_id' => $program->department_id,
                    'is_active' => true,
                ]
            );
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Created subject: {$course->code} - {$course->name}",
        ]);

        return response()->json([
            'success' => true,
            'course' => $course,
        ]);
    }

    public function updateCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('courses', 'code')->ignore($course->id)],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'credits' => ['required', 'integer', 'min:1', 'max:6'],
            'faculty_id' => ['nullable', 'exists:users,id'],
            'program_id' => ['required', 'exists:programs,id'],
            'section_id' => ['required', 'exists:sections,id'],
        ]);

        $program = Program::findOrFail($validated['program_id']);
        $section = Section::where('id', $validated['section_id'])
            ->where('program_id', $program->id)
            ->first();

        if (!$section) {
            return response()->json([
                'success' => false,
                'message' => 'Selected section does not belong to the selected program/course.',
            ], 422);
        }

        if (!$program->department_id) {
            return response()->json([
                'success' => false,
                'message' => 'Selected program/course must be assigned to a department before assigning subjects.',
            ], 422);
        }

        $validated['code'] = strtoupper(trim($validated['code']));
        $validated['section'] = $section->name;

        Course::where('id', $course->id)->update($validated);

        FacultySubjectAssignment::where('subject_id', $course->id)->delete();

        if (!empty($validated['faculty_id'])) {
            FacultySubjectAssignment::updateOrCreate(
                [
                    'faculty_id' => $validated['faculty_id'],
                    'program_id' => $program->id,
                    'section_id' => $section->id,
                    'subject_id' => $course->id,
                ],
                [
                    'department_id' => $program->department_id,
                    'is_active' => true,
                ]
            );
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => "Updated subject: {$validated['code']} - {$validated['name']}",
        ]);

        return response()->json(['success' => true]);
    }

    public function deleteCourse($id)
    {
        $course = Course::findOrFail($id);
        $name = $course->name;

        FacultySubjectAssignment::where('subject_id', $course->id)->delete();
        Course::where('id', $course->id)->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => "Deleted subject: {$name}",
        ]);

        return response()->json(['success' => true]);
    }

    public function showCourse($id)
    {
        $course = Course::with(['faculty', 'students', 'quizzes', 'materials', 'program.department', 'sectionRecord'])
            ->withCount(['students', 'quizzes'])
            ->findOrFail($id);

        $faculties = User::where('role', 'faculty')
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $programs = Program::with('department')->orderBy('name')->get();
        $sections = Section::where('program_id', $course->program_id)->orderBy('name')->get();

        return view('admin.course-show', compact('course', 'faculties', 'programs', 'sections'));
    }

    public function getCourseData($id)
    {
        $course = Course::with(['program.department', 'sectionRecord'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'course' => [
                'id' => $course->id,
                'code' => $course->code,
                'name' => $course->name,
                'description' => $course->description,
                'credits' => $course->credits,
                'faculty_id' => $course->faculty_id,
                'program_id' => $course->program_id,
                'department_id' => optional($course->program)->department_id,
                'section_id' => $course->section_id,
                'section' => $course->section,
                'join_code' => $course->join_code,
            ],
        ]);
    }

    public function facultyAssignments()
    {
        $assignments = FacultySubjectAssignment::with(['faculty', 'department', 'program', 'section', 'subject'])
            ->latest()
            ->paginate(20);

        $faculties = User::where('role', 'faculty')
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $departments = Department::orderBy('name')->get();
        $programs = Program::with('department')->orderBy('name')->get();
        $sections = Section::with('program')->orderBy('name')->get();
        $subjects = Course::with('program')->orderBy('name')->get();

        return view('admin.faculty-assignments', compact('assignments', 'faculties', 'departments', 'programs', 'sections', 'subjects'));
    }

    public function storeFacultyAssignment(Request $request)
    {
        $validated = $request->validate([
            'faculty_id' => ['required', 'exists:users,id'],
            'department_id' => ['required', 'exists:departments,id'],
            'program_id' => ['required', 'exists:programs,id'],
            'section_id' => ['required', 'exists:sections,id'],
            'subject_id' => ['required', 'exists:courses,id'],
        ]);

        $program = Program::findOrFail($validated['program_id']);
        $section = Section::findOrFail($validated['section_id']);
        $subject = Course::findOrFail($validated['subject_id']);

        if ((int) $program->department_id !== (int) $validated['department_id']) {
            return response()->json(['success' => false, 'message' => 'Selected program/course does not belong to the selected department.'], 422);
        }

        if ((int) $section->program_id !== (int) $program->id) {
            return response()->json(['success' => false, 'message' => 'Selected section does not belong to the selected program/course.'], 422);
        }

        if ((int) $subject->program_id !== (int) $program->id) {
            return response()->json(['success' => false, 'message' => 'Selected subject does not belong to the selected program/course.'], 422);
        }

        if (!empty($subject->section_id) && (int) $subject->section_id !== (int) $section->id) {
            return response()->json(['success' => false, 'message' => 'Selected subject does not belong to the selected section.'], 422);
        }

        $facultyDepartmentIds = FacultySubjectAssignment::where('faculty_id', $validated['faculty_id'])
            ->where('department_id', '!=', $validated['department_id'])
            ->distinct()
            ->pluck('department_id');

        if ($facultyDepartmentIds->isNotEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'This faculty already has assignments in another department. Faculty can be in different programs/courses only within the same department.',
            ], 422);
        }

        $assignment = FacultySubjectAssignment::updateOrCreate(
            [
                'faculty_id' => $validated['faculty_id'],
                'program_id' => $validated['program_id'],
                'section_id' => $validated['section_id'],
                'subject_id' => $validated['subject_id'],
            ],
            [
                'department_id' => $validated['department_id'],
                'is_active' => true,
            ]
        );

        Course::where('id', $subject->id)->update([
            'faculty_id' => $validated['faculty_id'],
            'section_id' => $section->id,
            'section' => $section->name,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => 'Created faculty subject assignment.',
        ]);

        return response()->json(['success' => true, 'assignment' => $assignment]);
    }

    public function deleteFacultyAssignment($id)
    {
        $assignment = FacultySubjectAssignment::findOrFail($id);
        FacultySubjectAssignment::where('id', $assignment->id)->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => 'Deleted faculty subject assignment.',
        ]);

        return response()->json(['success' => true]);
    }

    // ==================== QUIZ MANAGEMENT ====================

    public function quizzes()
    {
        $quizzes = Quiz::with(['course', 'questions', 'attempts'])
            ->withCount(['questions', 'attempts'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.quizzes', compact('quizzes'));
    }

    public function showQuiz($id)
    {
        $quiz = Quiz::with(['course', 'questions', 'attempts.student'])
            ->withCount(['questions', 'attempts'])
            ->findOrFail($id);

        $attempts = $quiz->attempts()
            ->with('student')
            ->orderBy('completed_at', 'desc')
            ->get();

        $averageScore = $quiz->attempts()->avg('score') ?? 0;

        $averagePercentage = $quiz->total_points > 0
            ? round(($averageScore / $quiz->total_points) * 100, 1)
            : 0;

        return view('admin.quiz-show', compact(
            'quiz',
            'attempts',
            'averageScore',
            'averagePercentage'
        ));
    }

    public function editQuiz($id)
    {
        $quiz = Quiz::with('course')->findOrFail($id);
        $courses = Course::all();

        return view('admin.quiz-edit', compact('quiz', 'courses'));
    }

    public function updateQuiz(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_minutes' => 'nullable|integer|min:1',
            'max_attempts' => 'nullable|integer|min:1|max:10',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'total_points' => 'nullable|integer|min:0',
        ]);

        $quiz->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => "Updated quiz: {$quiz->title}",
        ]);

        return redirect()->route('admin.quizzes')->with('success', 'Quiz updated successfully!');
    }

    public function deleteQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quizTitle = $quiz->title;

        $quiz->questions()->delete();
        $quiz->attempts()->delete();
        $quiz->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => "Deleted quiz: {$quizTitle}",
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Quiz deleted successfully!',
        ]);
    }

    public function getQuizData($id)
    {
        $quiz = Quiz::findOrFail($id);

        return response()->json([
            'success' => true,
            'quiz' => [
                'id' => $quiz->id,
                'course_id' => $quiz->course_id,
                'title' => $quiz->title,
                'description' => $quiz->description,
                'duration_minutes' => $quiz->duration_minutes,
                'max_attempts' => $quiz->max_attempts,
                'start_date' => $quiz->start_date,
                'end_date' => $quiz->end_date,
                'total_points' => $quiz->total_points,
            ],
        ]);
    }

    // ==================== ANALYTICS ====================

    public function analytics()
    {
        $totalStudents = User::where('role', 'student')->count();
        $totalFaculty = User::where('role', 'faculty')->count();
        $totalCourses = Course::count();
        $totalQuizzes = Quiz::count();
        $totalAttempts = QuizAttempt::whereNotNull('completed_at')->count();

        $totalPossiblePoints = Quiz::sum('total_points');
        $totalEarnedPoints = QuizAttempt::sum('score');

        $overallAverage = $totalPossiblePoints > 0
            ? round(($totalEarnedPoints / $totalPossiblePoints) * 100, 1)
            : 0;

        $passingAttempts = 0;
        $failingAttempts = 0;

        $attempts = QuizAttempt::with('quiz')->whereNotNull('completed_at')->get();

        foreach ($attempts as $attempt) {
            $pct = ($attempt->quiz && $attempt->quiz->total_points > 0)
                ? ($attempt->score / $attempt->quiz->total_points) * 100
                : 0;

            $pct >= 60 ? $passingAttempts++ : $failingAttempts++;
        }

        $passRate = $totalAttempts > 0 ? round(($passingAttempts / $totalAttempts) * 100, 1) : 0;
        $failRate = $totalAttempts > 0 ? round(($failingAttempts / $totalAttempts) * 100, 1) : 0;

        $courses = Course::with(['quizzes.attempts'])->withCount(['students', 'quizzes'])->get();
        $coursePerformance = [];

        foreach ($courses as $course) {
            $cAttempts = 0;
            $cScore = 0;
            $cPoints = 0;

            foreach ($course->quizzes as $quiz) {
                $quizAttempts = $quiz->attempts()->whereNotNull('completed_at')->get();
                $cAttempts += $quizAttempts->count();

                foreach ($quizAttempts as $attempt) {
                    $cScore += $attempt->score;
                    $cPoints += $quiz->total_points;
                }
            }

            $coursePerformance[] = [
                'id' => $course->id,
                'code' => $course->code,
                'name' => $course->name,
                'students' => $course->students_count,
                'quizzes' => $course->quizzes_count,
                'attempts' => $cAttempts,
                'average_score' => $cPoints > 0 ? round(($cScore / $cPoints) * 100, 1) : 0,
            ];
        }

        $faculty = User::where('role', 'faculty')->with('courses.quizzes.attempts')->get();
        $facultyPerformance = [];

        foreach ($faculty as $facultyMember) {
            $fAttempts = 0;
            $fScore = 0;
            $fPoints = 0;

            foreach ($facultyMember->courses as $course) {
                foreach ($course->quizzes as $quiz) {
                    $quizAttempts = $quiz->attempts()->whereNotNull('completed_at')->get();
                    $fAttempts += $quizAttempts->count();

                    foreach ($quizAttempts as $attempt) {
                        $fScore += $attempt->score;
                        $fPoints += $quiz->total_points;
                    }
                }
            }

            $facultyPerformance[] = [
                'id' => $facultyMember->id,
                'name' => $facultyMember->name,
                'email' => $facultyMember->email,
                'courses' => $facultyMember->courses->count(),
                'attempts' => $fAttempts,
                'average_score' => $fPoints > 0 ? round(($fScore / $fPoints) * 100, 1) : 0,
            ];
        }

        $topStudents = User::where('role', 'student')
            ->with('quizAttempts.quiz')
            ->get()
            ->map(function ($student) {
                $totalScore = $student->quizAttempts->sum('score');
                $totalPoints = $student->quizAttempts->sum(fn ($attempt) => $attempt->quiz->total_points ?? 0);

                return [
                    'id' => $student->id,
                    'name' => $student->name,
                    'email' => $student->email,
                    'attempts' => $student->quizAttempts->count(),
                    'average_score' => $totalPoints > 0 ? round(($totalScore / $totalPoints) * 100, 1) : 0,
                ];
            })
            ->sortByDesc('average_score')
            ->take(10);

        $monthlyTrend = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);

            $monthAttempts = QuizAttempt::whereMonth('completed_at', $month->month)
                ->whereYear('completed_at', $month->year)
                ->whereNotNull('completed_at')
                ->with('quiz')
                ->get();

            $monthScore = 0;
            $monthPoints = 0;

            foreach ($monthAttempts as $attempt) {
                $monthScore += $attempt->score;
                $monthPoints += $attempt->quiz->total_points ?? 0;
            }

            $monthlyTrend[] = [
                'month' => $month->format('M Y'),
                'attempts' => $monthAttempts->count(),
                'average_score' => $monthPoints > 0 ? round(($monthScore / $monthPoints) * 100, 1) : 0,
            ];
        }

        return view('admin.analytics', compact(
            'totalStudents',
            'totalFaculty',
            'totalCourses',
            'totalQuizzes',
            'totalAttempts',
            'overallAverage',
            'passRate',
            'failRate',
            'coursePerformance',
            'facultyPerformance',
            'topStudents',
            'monthlyTrend'
        ));
    }

    // ==================== EXPORT RESULTS ====================

    public function exportResults(Request $request)
    {
        $type = $request->get('type', 'courses');

        $data = [];

        switch ($type) {
            case 'courses':
                $courses = Course::with(['quizzes.attempts', 'program', 'students'])->get();

                $data[] = ['Course Code', 'Course Name', 'Program', 'Section', 'Students', 'Quizzes', 'Avg Score (%)'];

                foreach ($courses as $course) {
                    $totalAttempts = 0;
                    $totalScore = 0;
                    $totalPoints = 0;

                    foreach ($course->quizzes as $quiz) {
                        $quizAttempts = $quiz->attempts()->whereNotNull('completed_at')->get();
                        $totalAttempts += $quizAttempts->count();

                        foreach ($quizAttempts as $attempt) {
                            $totalScore += $attempt->score;
                            $totalPoints += $quiz->total_points;
                        }
                    }

                    $data[] = [
                        $course->code,
                        $course->name,
                        $course->program->code ?? 'N/A',
                        $course->section ?? 'N/A',
                        $course->students->count(),
                        $course->quizzes->count(),
                        $totalPoints > 0 ? round(($totalScore / $totalPoints) * 100, 1) . '%' : '0%',
                    ];
                }

                $filename = 'course_performance_' . date('Y-m-d');
                break;

            case 'students':
                $students = User::where('role', 'student')
                    ->with(['quizAttempts.quiz', 'program'])
                    ->get();

                $data[] = ['Name', 'Email', 'Student ID', 'Program', 'Section', 'Attempts', 'Avg Score (%)'];

                foreach ($students as $student) {
                    $totalScore = $student->quizAttempts->sum('score');
                    $totalPoints = $student->quizAttempts->sum(fn ($attempt) => $attempt->quiz->total_points ?? 0);

                    $data[] = [
                        $student->name,
                        $student->email,
                        $student->student_id ?? 'N/A',
                        $student->program->code ?? 'N/A',
                        $student->section ?? 'N/A',
                        $student->quizAttempts->count(),
                        $totalPoints > 0 ? round(($totalScore / $totalPoints) * 100, 1) . '%' : '0%',
                    ];
                }

                $filename = 'student_performance_' . date('Y-m-d');
                break;

            case 'faculty':
                $facultyUsers = User::where('role', 'faculty')
                    ->with(['courses.quizzes.attempts'])
                    ->get();

                $data[] = ['Faculty Name', 'Email', 'Faculty ID', 'Courses', 'Total Attempts', 'Avg Score (%)'];

                foreach ($facultyUsers as $fm) {
                    $fAttempts = 0;
                    $fScore = 0;
                    $fPoints = 0;

                    foreach ($fm->courses as $course) {
                        foreach ($course->quizzes as $quiz) {
                            $qa = $quiz->attempts()->whereNotNull('completed_at')->get();
                            $fAttempts += $qa->count();
                            foreach ($qa as $attempt) {
                                $fScore += $attempt->score;
                                $fPoints += $quiz->total_points;
                            }
                        }
                    }

                    $data[] = [
                        $fm->name,
                        $fm->email,
                        $fm->faculty_id ?? 'N/A',
                        $fm->courses->count(),
                        $fAttempts,
                        $fPoints > 0 ? round(($fScore / $fPoints) * 100, 1) . '%' : '0%',
                    ];
                }

                $filename = 'faculty_performance_' . date('Y-m-d');
                break;

            default:
                return redirect()->back()->with('error', 'Invalid export type.');
        }

        $handle = fopen('php://temp', 'w+');

        foreach ($data as $row) {
            fputcsv($handle, $row);
        }

        rewind($handle);

        $content = stream_get_contents($handle);

        fclose($handle);

        return response($content)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '.csv"');
    }

    // ==================== FACULTY DETAILS ====================

    public function faculty()
    {
        $faculty = User::where('role', 'faculty')
            ->withCount('courses')
            ->orderBy('name')
            ->get();

        $courses = Course::with('program')
            ->orderBy('name')
            ->get();

        return view('admin.faculty', compact('faculty', 'courses'));
    }

    public function facultyDetails($id)
    {
        $faculty = User::with(['courses.program', 'courses.students', 'courses.quizzes'])->findOrFail($id);
        $allCourses = Course::with('program')->orderBy('name')->get();
        $assignedIds = Course::where('faculty_id', $id)->pluck('id')->toArray();

        return view('admin.faculty-details', compact('faculty', 'allCourses', 'assignedIds'));
    }

    public function getFacultyData($id)
    {
        $faculty = User::findOrFail($id);
        $assignedCourseIds = Course::where('faculty_id', $id)->pluck('id')->toArray();

        return response()->json([
            'success' => true,
            'faculty' => $faculty,
            'assigned_course_ids' => $assignedCourseIds,
        ]);
    }

    public function assignCourses(Request $request, $id)
    {
        $faculty = User::findOrFail($id);

        $request->validate([
            'course_ids' => 'nullable|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        // Remove this faculty from all their current courses
        Course::where('faculty_id', $id)->update(['faculty_id' => null]);

        // Assign selected courses
        if (!empty($request->course_ids)) {
            Course::whereIn('id', $request->course_ids)->update(['faculty_id' => $id]);
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => "Assigned courses to faculty: {$faculty->name}",
        ]);

        return response()->json(['success' => true, 'message' => 'Courses assigned successfully.']);
    }

    public function studentDetails($id)
    {
        return $this->showUser($id);
    }

    // ==================== LOGS ====================

    public function logs()
    {
        $logs = DB::table('activity_logs')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        foreach ($logs as $log) {
            $user = User::find($log->user_id);
            $log->user_name = $user ? $user->name : 'System';
            $log->user_role = $user ? $user->role : 'system';
        }

        return view('admin.logs', compact('logs'));
    }


    // ==================== ADMIN PROFILE ====================

    public function profile()
    {
        $user = Auth::user();
        $memberSince = optional($user->created_at)->format('M d, Y') ?? 'N/A';
        $totalUsers = User::whereIn('role', ['student', 'faculty'])->count();
        $totalLogins = LoginHistory::where('user_id', $user->id)->count();
        $totalActions = ActivityLog::where('user_id', $user->id)->count();
        $recentActivities = ActivityLog::where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.profile', compact(
            'user',
            'memberSince',
            'totalUsers',
            'totalLogins',
            'totalActions',
            'recentActivities'
        ));
    }

    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'department' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:1000'],
        ]);

        User::where('id', $user->id)->update([
            'name' => $validated['name'],
            'email' => strtolower(trim($validated['email'])),
            'department' => $validated['department'] ?? null,
            'bio' => $validated['bio'] ?? null,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Updated admin profile',
        ]);

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
        ]);

        $user = User::findOrFail(Auth::id());

        if (!empty($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars/admins', 'public');

        User::where('id', $user->id)->update([
            'avatar' => $path,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Updated admin profile picture',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profile picture updated successfully.',
            'avatar_url' => asset('storage/' . $path),
        ]);
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::findOrFail(Auth::id());

        if (!Hash::check($validated['current_password'], $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        User::where('id', $user->id)->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Changed admin password',
        ]);

        return redirect()->route('admin.profile')->with('success', 'Password changed successfully.');
    }

    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => ['required'],
            'confirm_delete' => ['required', 'accepted'],
        ]);

        $user = User::findOrFail(Auth::id());

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Password is incorrect.']);
        }

        if (User::where('role', 'admin')->where('id', '!=', $user->id)->count() === 0) {
            return redirect()->back()->with('error', 'You cannot delete the only remaining admin account.');
        }

        $userId = $user->id;
        $name = $user->name;
        $avatar = $user->avatar ?? null;

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if (!empty($avatar)) {
            Storage::disk('public')->delete($avatar);
        }

        User::where('id', $userId)->delete();

        return redirect()->route('login')->with('success', "Admin account {$name} has been deleted.");
    }

    // ==================== FACULTY EVALUATION ====================

    public function facultyEvaluations()
    {
        $faculty = User::where('role', 'faculty')
            ->withCount('facultyEvaluationsReceived')
            ->withAvg('facultyEvaluationsReceived', 'rating')
            ->orderByDesc('faculty_evaluations_received_avg_rating')
            ->orderBy('name')
            ->get();

        $evaluations = FacultyEvaluation::with(['faculty', 'student', 'course'])
            ->latest()
            ->paginate(15);

        $totalEvaluations = FacultyEvaluation::count();
        $averageRating = FacultyEvaluation::avg('rating') ?? 0;
        $topFaculty = $this->getTopPerformingFaculty(5);

        return view('admin.faculty-evaluations', compact(
            'faculty',
            'evaluations',
            'totalEvaluations',
            'averageRating',
            'topFaculty'
        ));
    }

    // ==================== FOLDER & FILES ====================

    public function folderFiles(Request $request)
    {
        $folder = $request->get('folder');

        $folders = AdminFile::where('type', 'folder')
            ->whereNull('archived_at')
            ->orderBy('name')
            ->get();

        $files = AdminFile::with(['uploader', 'facultyUploader', 'folder'])
            ->where('type', 'file')
            ->when($folder, fn ($query) => $query->where('parent_id', $folder))
            ->whereNull('archived_at')
            ->latest()
            ->paginate(15);

        $facultyMaterials = CourseMaterial::with(['course.faculty'])
            ->latest()
            ->paginate(10, ['*'], 'materials_page');

        $archivedFiles = AdminFile::with(['uploader', 'folder'])
            ->whereNotNull('archived_at')
            ->latest('archived_at')
            ->limit(20)
            ->get();

        return view('admin.folder-files', compact(
            'folders',
            'files',
            'facultyMaterials',
            'archivedFiles',
            'folder'
        ));
    }

    public function storeFolder(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        AdminFile::create([
            'name' => $validated['name'],
            'type' => 'folder',
            'uploaded_by' => Auth::id(),
        ]);

        return redirect()->route('admin.folder-files')->with('success', 'Folder created successfully.');
    }

    public function uploadAdminFile(Request $request)
    {
        $maxMb = (int) SystemSetting::getValue('max_upload_size_mb', 20);
        $maxKb = max($maxMb, 1) * 1024;

        $validated = $request->validate([
            'folder_id' => ['nullable', 'exists:admin_files,id'],
            'file' => ['required', 'file', 'max:' . $maxKb],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $file = $request->file('file');
        $path = $file->store('admin-files', 'public');

        AdminFile::create([
            'name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            'original_name' => $file->getClientOriginalName(),
            'type' => 'file',
            'parent_id' => $validated['folder_id'] ?? null,
            'path' => $path,
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'description' => $validated['description'] ?? null,
            'uploaded_by' => Auth::id(),
        ]);

        return redirect()->route('admin.folder-files')->with('success', 'File uploaded successfully.');
    }

    public function downloadAdminFile(AdminFile $file)
    {
        abort_if($file->type !== 'file' || !$file->path, 404);

        if (!Storage::disk('public')->exists($file->path)) {
            return redirect()->back()->with('error', 'File not found in storage.');
        }

        $absolutePath = Storage::disk('public')->path($file->path);
        $downloadName = $file->original_name ?? $file->name;

        return response()->download($absolutePath, $downloadName);
    }

    public function archiveAdminFile(AdminFile $file)
    {
        AdminFile::where('id', $file->id)->update([
            'archived_at' => now(),
        ]);

        return redirect()->route('admin.folder-files')->with('success', 'File archived successfully.');
    }



    public function download($id)
    {
        $file = AdminFile::findOrFail($id);

        abort_if($file->type !== 'file' || !$file->path, 404);

        if (!Storage::disk('public')->exists($file->path)) {
            return redirect()->back()->with('error', 'File not found in storage.');
        }

        $absolutePath = Storage::disk('public')->path($file->path);
        $downloadName = $file->original_name ?? $file->name;

        return response()->download($absolutePath, $downloadName);
    }

    public function update(Request $request, $id)
    {
        $file = AdminFile::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'folder_id' => ['nullable', 'exists:admin_files,id'],
        ]);

        AdminFile::where('id', $file->id)->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'parent_id' => $validated['folder_id'] ?? null,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => "Updated admin file/folder: {$validated['name']}",
        ]);

        return redirect()->route('admin.folder-files')->with('success', 'File or folder updated successfully.');
    }

    public function delete($id)
    {
        $file = AdminFile::findOrFail($id);
        $fileName = $file->name;

        if ($file->type === 'folder') {
            $childFiles = AdminFile::where('parent_id', $file->id)->get();

            foreach ($childFiles as $child) {
                if ($child->type === 'file' && $child->path && Storage::disk('public')->exists($child->path)) {
                    Storage::disk('public')->delete($child->path);
                }

                AdminFile::where('id', $child->id)->delete();
            }
        }

        if ($file->type === 'file' && $file->path && Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path);
        }

        AdminFile::where('id', $file->id)->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => "Deleted admin file/folder: {$fileName}",
        ]);

        return redirect()->route('admin.folder-files')->with('success', 'File or folder deleted successfully.');
    }

    // ==================== SETTINGS ====================

    public function settings()
    {
        $this->ensureDefaultSettings();

        $gradingSettings = SystemSetting::where('group', 'grading')->orderBy('id')->get();
        $quizSettings = SystemSetting::where('group', 'quiz')->orderBy('id')->get();
        $academicSettings = SystemSetting::where('group', 'academic')->orderBy('id')->get();
        $fileSettings = SystemSetting::where('group', 'file')->orderBy('id')->get();

        return view('admin.settings', compact(
            'gradingSettings',
            'quizSettings',
            'academicSettings',
            'fileSettings'
        ));
    }

    public function updateSettings(Request $request)
    {
        $this->ensureDefaultSettings();

        $booleanKeys = SystemSetting::where('type', 'boolean')->pluck('key')->toArray();
        $submitted = $request->except('_token');

        foreach ($booleanKeys as $key) {
            $submitted[$key] = $request->has($key) ? '1' : '0';
        }

        foreach ($submitted as $key => $value) {
            $setting = SystemSetting::where('key', $key)->first();

            if (!$setting) {
                continue;
            }

            if ($setting->type === 'json') {
                $value = is_array($value) ? json_encode(array_values($value)) : $value;
            }

            $setting->update(['value' => $value]);
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Updated system settings',
        ]);

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully!');
    }

    private function ensureDefaultSettings(): void
    {
        $defaults = [
            ['group' => 'grading', 'key' => 'passing_grade', 'value' => '75', 'type' => 'number', 'description' => 'Minimum passing grade percentage'],
            ['group' => 'grading', 'key' => 'grade_scale', 'value' => '[{"label":"Excellent","min":"90","max":"100"},{"label":"Very Good","min":"85","max":"89"},{"label":"Good","min":"80","max":"84"},{"label":"Passed","min":"75","max":"79"},{"label":"Failed","min":"0","max":"74"}]', 'type' => 'json', 'description' => 'Grade scale labels and ranges'],
            ['group' => 'quiz', 'key' => 'default_quiz_duration', 'value' => '60', 'type' => 'number', 'description' => 'Default quiz duration in minutes'],
            ['group' => 'quiz', 'key' => 'allow_late_submissions', 'value' => '0', 'type' => 'boolean', 'description' => 'Allow late quiz submissions'],
            ['group' => 'academic', 'key' => 'school_name', 'value' => 'NU Clicks LMS', 'type' => 'text', 'description' => 'School or system display name'],
            ['group' => 'academic', 'key' => 'current_term', 'value' => 'Term 1', 'type' => 'text', 'description' => 'Current academic term'],
            ['group' => 'file', 'key' => 'max_upload_size_mb', 'value' => '20', 'type' => 'number', 'description' => 'Maximum upload size in MB'],
            ['group' => 'file', 'key' => 'allowed_file_types', 'value' => 'pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png,zip', 'type' => 'text', 'description' => 'Comma-separated allowed file extensions'],
        ];

        foreach ($defaults as $setting) {
            SystemSetting::firstOrCreate(['key' => $setting['key']], $setting);
        }
    }

    // ==================== SECURITY ====================

    public function security()
    {
        $loginHistory = LoginHistory::with('user')
            ->orderBy('login_at', 'desc')
            ->paginate(20);

        $accessLogs = AccessLog::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $totalLogins = LoginHistory::count();
        $uniqueUsers = LoginHistory::distinct('user_id')->count('user_id');
        $failedLogins = LoginHistory::where('status', 'failed')->count();
        $totalActions = AccessLog::count();

        $loginTrends = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);

            $loginTrends[] = [
                'date' => $date->format('M d'),
                'logins' => LoginHistory::whereDate('login_at', $date->toDateString())->count(),
            ];
        }

        $activeUsers = AccessLog::select('user_id')
            ->with('user')
            ->selectRaw('count(*) as action_count')
            ->groupBy('user_id')
            ->orderBy('action_count', 'desc')
            ->limit(10)
            ->get();

        $devices = [
            'desktop' => LoginHistory::where('device_type', 'desktop')->count(),
            'mobile' => LoginHistory::where('device_type', 'mobile')->count(),
            'tablet' => LoginHistory::where('device_type', 'tablet')->count(),
        ];

        $browsers = LoginHistory::select('browser')
            ->selectRaw('count(*) as count')
            ->whereNotNull('browser')
            ->groupBy('browser')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        return view('admin.security', compact(
            'loginHistory',
            'accessLogs',
            'totalLogins',
            'uniqueUsers',
            'failedLogins',
            'totalActions',
            'loginTrends',
            'activeUsers',
            'devices',
            'browsers'
        ));
    }

    public function clearLogs(Request $request)
    {
        $type = $request->get('type');

        if ($type === 'login') {
            LoginHistory::truncate();
            $message = 'Login history cleared successfully!';
        } elseif ($type === 'access') {
            AccessLog::truncate();
            $message = 'Access logs cleared successfully!';
        } else {
            return redirect()->back()->with('error', 'Invalid log type.');
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => "Cleared {$type} logs",
        ]);

        return redirect()->back()->with('success', $message);
    }
    // ==================== ADMIN NOTIFICATIONS ====================

public function notifications()
{
    $notifications = Notification::where('user_id', Auth::id())
        ->latest()
        ->paginate(15);

    return view('admin.notifications', compact('notifications'));
}

public function markNotificationRead($id)
{
    $notification = Notification::where('user_id', Auth::id())
        ->where('id', $id)
        ->firstOrFail();

    Notification::where('id', $notification->id)->update([
        'is_read' => true,
    ]);

    if ($notification->link) {
        return redirect($notification->link);
    }

    return redirect()->back()->with('success', 'Notification marked as read.');
}

public function markAllNotificationsRead()
{
    Notification::where('user_id', Auth::id())
        ->where('is_read', false)
        ->update([
            'is_read' => true,
        ]);

    return redirect()->back()->with('success', 'All notifications marked as read.');
}
}