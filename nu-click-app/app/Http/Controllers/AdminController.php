<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\Enrollment;
use App\Models\QuizAttempt;
use App\Models\ActivityLog;
use Barryvdh\DomPDF\Facade\Pdf; // Uncomment if using PDF package
use App\Models\SystemSetting;
use App\Models\LoginHistory;
use App\Models\AccessLog;
use App\Models\Department;
use App\Models\Program;
use App\Models\Section;
use App\Models\FacultySubjectAssignment;
use Illuminate\Validation\Rule;


class AdminController extends Controller
{
    public function dashboard()
    {
        // Get statistics
        $totalStudents = User::where('role', 'student')->count();
        $totalFaculty = User::where('role', 'faculty')->count();
        $totalCourses = Course::count();
        $totalQuizzes = Quiz::count();
        $activeQuizzes = Quiz::where('is_active', true)->count();
        
        // Quiz performance stats
        $totalAttempts = QuizAttempt::count();
        $averageScore = QuizAttempt::avg('score') ?? 0;
        if ($averageScore > 0) {
            $averageScore = ($averageScore / Quiz::sum('total_points')) * 100;
        } else {
            $averageScore = 0;
        }
        
        // Courses per faculty (top 5)
        $coursesPerFaculty = User::where('role', 'faculty')
            ->withCount('courses')
            ->orderBy('courses_count', 'desc')
            ->limit(5)
            ->get();
        
        // Recent enrollments
        $recentEnrollments = Enrollment::with(['student', 'course'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Recent quiz attempts
        $recentAttempts = QuizAttempt::with(['student', 'quiz.course'])
            ->orderBy('completed_at', 'desc')
            ->limit(5)
            ->get();
        
        // Recent activities
        $recentActivities = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        // Monthly statistics for chart
        $monthlyStats = $this->getMonthlyStats();
        
        return view('admin.dashboard', compact(
            'totalStudents',
            'totalFaculty',
            'totalCourses',
            'totalQuizzes',
            'activeQuizzes',
            'totalAttempts',
            'averageScore',
            'coursesPerFaculty',
            'recentEnrollments',
            'recentAttempts',
            'recentActivities',
            'monthlyStats'
        ));
    }
    
    private function getMonthlyStats()
    {
        $months = collect(range(1, 12))->map(function($month) {
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
        
        return $months;
    }
    
    public function users()
    {
        $students = User::where('role', 'student')
            ->with(['program', 'departmentRel'])
            ->withCount(['enrollments', 'quizAttempts'])
            ->orderBy('name')
            ->paginate(10);
            
        $faculty = User::where('role', 'faculty')
            ->with(['departmentRel'])
            ->withCount('courses')
            ->orderBy('name')
            ->paginate(10);
            
        return view('admin.users', compact('students', 'faculty'));
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
        $program = Program::withCount(['subjects', 'students', 'sections'])->findOrFail($id);

        if ($program->subjects_count > 0 || $program->students_count > 0 || $program->sections_count > 0) {
            return response()->json([
                'success' => false,
                'message' => 'This program/course cannot be deleted because it still has subjects, students, or sections assigned to it.',
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
        $program = Program::with(['department', 'sections' => function ($query) {
            $query->where('is_active', true)->orderBy('name');
        }])->findOrFail($id);

        return response()->json([
            'success' => true,
            'program' => $program,
        ]);
    }

    // ==================== DEPARTMENT MANAGEMENT ====================

    public function departments()
    {
        $departments = Department::withCount('programs')
            ->orderBy('name')
            ->get();

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

    
    public function createUser()
    {
        $departments = Department::orderBy('name')->get();
        $programs = Program::orderBy('name')->get();
        return view('admin.create-user', compact('departments', 'programs'));
    }

    
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:student,faculty,admin',
            'status' => 'in:active,inactive',
            'student_id' => 'nullable|string|unique:users',
            'faculty_id' => 'nullable|string|unique:users',
            'year_level' => 'nullable|integer|min:1|max:4',
            'section' => 'nullable|string|max:10',
            'department_id' => 'nullable|exists:departments,id',
            'program_id' => 'nullable|exists:programs,id',
            'specialization' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);
        
        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'status' => $validated['status'] ?? 'active',
            'student_id' => $validated['student_id'] ?? null,
            'faculty_id' => $validated['faculty_id'] ?? null,
            'year_level' => $validated['year_level'] ?? null,
            'section' => $validated['section'] ?? null,
            'department_id' => $validated['department_id'] ?? null,
            'program_id' => $validated['program_id'] ?? null,
            'specialization' => $validated['specialization'] ?? null,
            'bio' => $validated['bio'] ?? null,
        ];

        // Sync legacy department string and handle student department mapping
        if (!empty($userData['department_id'])) {
            $dept = Department::find($userData['department_id']);
            if ($dept) $userData['department'] = $dept->name;
        } elseif (!empty($userData['program_id'])) {
            $program = Program::with('department')->find($userData['program_id']);
            if ($program && $program->department) {
                $userData['department_id'] = $program->department_id;
                $userData['department'] = $program->department->name;
            }
        }

        $user = User::create($userData);
        
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Created user: {$user->name} ({$user->role})",
        ]);
        
        $redirectRoute = route('admin.users');
        if ($user->role === 'faculty') {
            $redirectRoute .= '#faculty';
        }
        
        return redirect($redirectRoute)->with('success', 'User created successfully.');

    }


    
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $courses = Course::all();
        $assignedCourses = $user->courses()->pluck('courses.id')->toArray();
        $departments = Department::orderBy('name')->get();
        $programs = Program::orderBy('name')->get();
        
        return view('admin.edit-user', compact('user', 'courses', 'assignedCourses', 'departments', 'programs'));
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
            'student_id' => 'nullable|string|unique:users,student_id,' . $id,
            'faculty_id' => 'nullable|string|unique:users,faculty_id,' . $id,
            'year_level' => 'nullable|integer|min:1|max:4',
            'section' => 'nullable|string|max:10',
            'department_id' => 'nullable|exists:departments,id',
            'program_id' => 'nullable|exists:programs,id',
            'specialization' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'course_ids' => 'nullable|array',
        ]);
        
        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ];

        if ($request->has('status')) $updateData['status'] = $validated['status'];
        if ($request->has('student_id')) $updateData['student_id'] = $validated['student_id'];
        if ($request->has('faculty_id')) $updateData['faculty_id'] = $validated['faculty_id'];
        if ($request->has('year_level')) $updateData['year_level'] = $validated['year_level'];
        if ($request->has('section')) $updateData['section'] = $validated['section'];
        if ($request->has('department_id')) $updateData['department_id'] = $validated['department_id'];
        if ($request->has('program_id')) $updateData['program_id'] = $validated['program_id'];
        if ($request->has('specialization')) $updateData['specialization'] = $validated['specialization'];
        if ($request->has('bio')) $updateData['bio'] = $validated['bio'];

        // Sync legacy department string and handle student department mapping
        if (!empty($updateData['department_id'])) {
            $dept = Department::find($updateData['department_id']);
            if ($dept) $updateData['department'] = $dept->name;
        } elseif (!empty($updateData['program_id'])) {
            $program = Program::with('department')->find($updateData['program_id']);
            if ($program && $program->department) {
                $updateData['department_id'] = $program->department_id;
                $updateData['department'] = $program->department->name;
            }
        } elseif ($request->has('department_id')) {
            $updateData['department'] = null;
        }

        $user->update($updateData);
        
        if (!empty($validated['password'])) {
            $user->update(['password' => bcrypt($validated['password'])]);
        }
        
        if ($user->role === 'faculty' && isset($validated['course_ids'])) {
            // Fix: Course has one faculty, update the faculty_id in courses table
            Course::where('faculty_id', $user->id)->update(['faculty_id' => null]);
            Course::whereIn('id', $validated['course_ids'])->update(['faculty_id' => $user->id]);
        }
        
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => "Updated user: {$user->name}",
        ]);
        
        $redirectRoute = route('admin.users');
        if ($user->role === 'faculty') {
            $redirectRoute .= '#faculty';
        }

        return redirect($redirectRoute)->with('success', 'User updated successfully.');

    }



    
    public function showUser($id)
    {
        $student = User::with(['enrollments.course', 'quizAttempts.quiz.course'])
            ->where('role', 'student')
            ->findOrFail($id);
            
        $enrolledCourses = $student->enrollments()->with('course')->get();
        $quizAttempts = $student->quizAttempts()->with('quiz.course')->get();
        
        // Calculate average score
        $totalScore = 0;
        $totalPossible = 0;
        foreach ($quizAttempts as $attempt) {
            $totalScore += $attempt->score;
            $totalPossible += $attempt->quiz->total_points;
        }
        $averageScore = $totalPossible > 0 ? round(($totalScore / $totalPossible) * 100) : 0;
        
        return view('admin.student-details', compact('student', 'enrolledCourses', 'quizAttempts', 'averageScore'));
    }
    
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users')->with('error', 'You cannot delete your own account.');
        }
        
        $userName = $user->name;
        $user->delete();
        
        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => "Deleted user: {$userName}",
        ]);
        
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
    
    public function toggleStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();
        
        return response()->json([
            'success' => true,
            'status' => $user->status,
            'message' => 'User status updated successfully.'
        ]);
    }
    
    public function courses()
    {
        $courses = Course::with(['faculty', 'program', 'sectionRecord'])
            ->withCount(['students', 'quizzes'])
            ->orderBy('name')
            ->paginate(15);
            
        $faculties = User::where('role', 'faculty')->where('status', 'active')->orderBy('name')->get();
        $programs = Program::orderBy('name')->get();
        $sections = Section::orderBy('name')->get();
        
        return view('admin.courses', compact('courses', 'faculties', 'programs', 'sections'));
    }

    public function sections()
    {
        $sections = Section::with(['program.department'])
            ->withCount(['students', 'assignments'])
            ->orderBy('name')
            ->get();

        $programs = Program::with('department')->orderBy('name')->get();

        return view('admin.sections', compact('sections', 'programs'));
    }

    public function storeSection(Request $request)
    {
        $validated = $request->validate([
            'program_id' => ['required', 'exists:programs,id'],
            'name' => ['required', 'string', 'max:50'],
            'year_level' => ['required', 'integer', 'min:1', 'max:10'],
        ]);

        $section = Section::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Created section: {$section->name}",
        ]);

        return response()->json([
            'success' => true,
            'section' => $section,
        ]);
    }

    public function updateSection(Request $request, $id)
    {
        $section = Section::findOrFail($id);

        $validated = $request->validate([
            'program_id' => ['required', 'exists:programs,id'],
            'name' => ['required', 'string', 'max:50'],
            'year_level' => ['required', 'integer', 'min:1', 'max:10'],
            'is_active' => ['boolean'],
        ]);

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
        $section = Section::withCount(['students', 'assignments'])->findOrFail($id);

        if ($section->students_count > 0 || $section->assignments_count > 0) {
            return response()->json([
                'success' => false,
                'message' => 'This section cannot be deleted because it still has students or faculty assignments.',
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
        $section = Section::with(['program.department'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'section' => $section,
        ]);
    }

    public function subjects()
    {
        $subjects = Course::with(['program.department', 'faculty', 'sectionRecord'])
            ->withCount(['students', 'quizzes'])
            ->orderBy('name')
            ->paginate(15);

        $programs = Program::with('department')->orderBy('name')->get();
        $faculties = User::where('role', 'faculty')->where('status', 'active')->orderBy('name')->get();
        $sections = Section::orderBy('name')->get();

        return view('admin.subjects', compact('subjects', 'programs', 'faculties', 'sections'));
    }

    
    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'program_id' => ['required', 'exists:programs,id'],
            'section_id' => ['nullable', 'exists:sections,id'],
            'faculty_id' => ['nullable', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:20', 'unique:courses,code'],
            'description' => ['nullable', 'string'],
            'credits' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['join_code'] = Str::random(8);
        $validated['code'] = strtoupper(trim($validated['code']));

        if (!empty($validated['section_id'])) {
            $section = Section::find($validated['section_id']);
            $validated['section'] = $section->name;
        }

        $course = Course::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Created course/subject: {$course->code} - {$course->name}",
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
            'program_id' => ['required', 'exists:programs,id'],
            'section_id' => ['nullable', 'exists:sections,id'],
            'faculty_id' => ['nullable', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:20', Rule::unique('courses', 'code')->ignore($course->id)],
            'description' => ['nullable', 'string'],
            'credits' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['code'] = strtoupper(trim($validated['code']));

        if (!empty($validated['section_id'])) {
            $section = Section::find($validated['section_id']);
            $validated['section'] = $section->name;
        }

        Course::where('id', $course->id)->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => "Updated course/subject: {$validated['code']} - {$validated['name']}",
        ]);

        return response()->json(['success' => true]);
    }

    public function deleteCourse($id)
    {
        $course = Course::withCount(['students', 'quizzes'])->findOrFail($id);

        if ($course->students_count > 0 || $course->quizzes_count > 0) {
            return response()->json([
                'success' => false,
                'message' => 'This course cannot be deleted because it still has students or quizzes.',
            ], 422);
        }

        $name = $course->name;
        Course::where('id', $course->id)->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => "Deleted course: {$name}",
        ]);

        return response()->json(['success' => true]);
    }

    public function getCourseData($id)
    {
        $course = Course::with(['program.department', 'sectionRecord'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'course' => $course,
        ]);
    }

    
    public function quizzes()
    {
        $quizzes = Quiz::with(['course', 'questions', 'attempts'])
            ->withCount(['questions', 'attempts'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('admin.quizzes', compact('quizzes'));
    }
    
public function logs()
{
    // Simple query without relationships first
    $logs = DB::table('activity_logs')
        ->orderBy('created_at', 'desc')
        ->paginate(20);
    
    // Get user names separately
    foreach ($logs as $log) {
        $user = User::find($log->user_id);
        $log->user_name = $user ? $user->name : 'System';
        $log->user_role = $user ? $user->role : 'system';
    }
    
    return view('admin.logs', compact('logs'));
}
    
    public function showCourse($id)
    {
        $course = Course::with(['faculty', 'students', 'quizzes', 'materials'])
            ->withCount(['students', 'quizzes'])
            ->findOrFail($id);
        
        $faculties = User::where('role', 'faculty')
            ->where('status', 'active')
            ->orderBy('name')
            ->get();
        
        return view('admin.course-show', compact('course', 'faculties'));
    }
    
    // QUIZ METHODS
    
    public function showQuiz($id)
    {
        $quiz = Quiz::with(['course', 'questions', 'attempts.student'])
            ->withCount(['questions', 'attempts'])
            ->findOrFail($id);
        
        $attempts = $quiz->attempts()->with('student')->orderBy('completed_at', 'desc')->get();
        
        $averageScore = $quiz->attempts()->avg('score') ?? 0;
        $averagePercentage = $quiz->total_points > 0 ? round(($averageScore / $quiz->total_points) * 100, 1) : 0;
        
        return view('admin.quiz-show', compact('quiz', 'attempts', 'averageScore', 'averagePercentage'));
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
        
        // Delete related questions first
        $quiz->questions()->delete();
        
        // Delete quiz attempts
        $quiz->attempts()->delete();
        
        // Delete the quiz
        $quiz->delete();
        
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => "Deleted quiz: {$quizTitle}",
        ]);
        
        return response()->json(['success' => true, 'message' => 'Quiz deleted successfully!']);
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
            ]
        ]);
    }
    
    // ENHANCED ANALYTICS METHOD
    
    public function analytics()
    {
        // Overall System Statistics
        $totalStudents = User::where('role', 'student')->count();
        $totalFaculty = User::where('role', 'faculty')->count();
        $totalCourses = Course::count();
        $totalQuizzes = Quiz::count();
        $totalAttempts = QuizAttempt::whereNotNull('completed_at')->count();
        
        // Overall Performance
        $averageScore = QuizAttempt::whereNotNull('score')->avg('score') ?? 0;
        $totalPossiblePoints = Quiz::sum('total_points');
        $totalEarnedPoints = QuizAttempt::sum('score');
        $overallAverage = $totalPossiblePoints > 0 ? round(($totalEarnedPoints / $totalPossiblePoints) * 100, 1) : 0;
        
        // Pass/Fail Statistics
        $passingAttempts = 0;
        $failingAttempts = 0;
        $attempts = QuizAttempt::with('quiz')->whereNotNull('completed_at')->get();
        
        foreach ($attempts as $attempt) {
            $percentage = $attempt->quiz->total_points > 0 ? ($attempt->score / $attempt->quiz->total_points) * 100 : 0;
            if ($percentage >= 60) {
                $passingAttempts++;
            } else {
                $failingAttempts++;
            }
        }
        
        $passRate = $totalAttempts > 0 ? round(($passingAttempts / $totalAttempts) * 100, 1) : 0;
        $failRate = $totalAttempts > 0 ? round(($failingAttempts / $totalAttempts) * 100, 1) : 0;
        
        // Performance by Course
        $courses = Course::with(['quizzes.attempts'])
            ->withCount(['students', 'quizzes'])
            ->get();
        
        $coursePerformance = [];
        foreach ($courses as $course) {
            $courseTotalAttempts = 0;
            $courseTotalScore = 0;
            $courseTotalPoints = 0;
            
            foreach ($course->quizzes as $quiz) {
                $quizAttempts = $quiz->attempts()->whereNotNull('completed_at')->get();
                $courseTotalAttempts += $quizAttempts->count();
                foreach ($quizAttempts as $attempt) {
                    $courseTotalScore += $attempt->score;
                    $courseTotalPoints += $quiz->total_points;
                }
            }
            
            $coursePerformance[] = [
                'id' => $course->id,
                'code' => $course->code,
                'name' => $course->name,
                'students' => $course->students_count,
                'quizzes' => $course->quizzes_count,
                'attempts' => $courseTotalAttempts,
                'average_score' => $courseTotalPoints > 0 ? round(($courseTotalScore / $courseTotalPoints) * 100, 1) : 0,
            ];
        }
        
        // Performance by Faculty
        $faculty = User::where('role', 'faculty')
            ->with('courses.quizzes.attempts')
            ->get();
        
        $facultyPerformance = [];
        foreach ($faculty as $facultyMember) {
            $facultyTotalAttempts = 0;
            $facultyTotalScore = 0;
            $facultyTotalPoints = 0;
            
            foreach ($facultyMember->courses as $course) {
                foreach ($course->quizzes as $quiz) {
                    $quizAttempts = $quiz->attempts()->whereNotNull('completed_at')->get();
                    $facultyTotalAttempts += $quizAttempts->count();
                    foreach ($quizAttempts as $attempt) {
                        $facultyTotalScore += $attempt->score;
                        $facultyTotalPoints += $quiz->total_points;
                    }
                }
            }
            
            $facultyPerformance[] = [
                'id' => $facultyMember->id,
                'name' => $facultyMember->name,
                'email' => $facultyMember->email,
                'courses' => $facultyMember->courses->count(),
                'attempts' => $facultyTotalAttempts,
                'average_score' => $facultyTotalPoints > 0 ? round(($facultyTotalScore / $facultyTotalPoints) * 100, 1) : 0,
            ];
        }
        
        // Top Performing Students
        $topStudents = User::where('role', 'student')
            ->with('quizAttempts')
            ->get()
            ->map(function($student) {
                $totalScore = $student->quizAttempts->sum('score');
                $totalPoints = $student->quizAttempts->sum(function($attempt) {
                    return $attempt->quiz->total_points;
                });
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
        
        // Monthly Performance Trend
        $monthlyTrend = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthAttempts = QuizAttempt::whereMonth('completed_at', $month->month)
                ->whereYear('completed_at', $month->year)
                ->whereNotNull('completed_at')
                ->get();
            
            $monthScore = 0;
            $monthPoints = 0;
            foreach ($monthAttempts as $attempt) {
                $monthScore += $attempt->score;
                $monthPoints += $attempt->quiz->total_points;
            }
            
            $monthlyTrend[] = [
                'month' => $month->format('M Y'),
                'attempts' => $monthAttempts->count(),
                'average_score' => $monthPoints > 0 ? round(($monthScore / $monthPoints) * 100, 1) : 0,
            ];
        }
        
        return view('admin.analytics', compact(
            'totalStudents', 'totalFaculty', 'totalCourses', 'totalQuizzes',
            'totalAttempts', 'overallAverage', 'passRate', 'failRate',
            'coursePerformance', 'facultyPerformance', 'topStudents', 'monthlyTrend'
        ));
    }
    
    // EXPORT RESULTS METHOD
    
    public function exportResults(Request $request)
    {
        $type = $request->get('type', 'courses');
        $format = $request->get('format', 'csv');
        
        $data = [];
        $filename = '';
        
        switch ($type) {
            case 'courses':
                $courses = Course::with(['quizzes.attempts'])->get();
                $data[] = ['Course Code', 'Course Name', 'Students', 'Quizzes', 'Total Attempts', 'Average Score (%)'];
                foreach ($courses as $course) {
                    $totalAttempts = 0;
                    $totalScore = 0;
                    $totalPoints = 0;
                    foreach ($course->quizzes as $quiz) {
                        $attempts = $quiz->attempts()->whereNotNull('completed_at')->get();
                        $totalAttempts += $attempts->count();
                        foreach ($attempts as $attempt) {
                            $totalScore += $attempt->score;
                            $totalPoints += $quiz->total_points;
                        }
                    }
                    $avgScore = $totalPoints > 0 ? round(($totalScore / $totalPoints) * 100, 1) : 0;
                    $data[] = [$course->code, $course->name, $course->students->count(), $course->quizzes->count(), $totalAttempts, $avgScore . '%'];
                }
                $filename = 'course_performance_report_' . date('Y-m-d');
                break;
                
            case 'faculty':
                $faculty = User::where('role', 'faculty')->with('courses.quizzes.attempts')->get();
                $data[] = ['Faculty Name', 'Email', 'Courses', 'Total Attempts', 'Average Score (%)'];
                foreach ($faculty as $f) {
                    $totalAttempts = 0;
                    $totalScore = 0;
                    $totalPoints = 0;
                    foreach ($f->courses as $course) {
                        foreach ($course->quizzes as $quiz) {
                            $attempts = $quiz->attempts()->whereNotNull('completed_at')->get();
                            $totalAttempts += $attempts->count();
                            foreach ($attempts as $attempt) {
                                $totalScore += $attempt->score;
                                $totalPoints += $quiz->total_points;
                            }
                        }
                    }
                    $avgScore = $totalPoints > 0 ? round(($totalScore / $totalPoints) * 100, 1) : 0;
                    $data[] = [$f->name, $f->email, $f->courses->count(), $totalAttempts, $avgScore . '%'];
                }
                $filename = 'faculty_performance_report_' . date('Y-m-d');
                break;
                
            case 'students':
                $students = User::where('role', 'student')->with('quizAttempts.quiz')->get();
                $data[] = ['Student Name', 'Email', 'Student ID', 'Total Attempts', 'Average Score (%)'];
                foreach ($students as $student) {
                    $totalScore = $student->quizAttempts->sum('score');
                    $totalPoints = $student->quizAttempts->sum(function($attempt) {
                        return $attempt->quiz->total_points;
                    });
                    $avgScore = $totalPoints > 0 ? round(($totalScore / $totalPoints) * 100, 1) : 0;
                    $data[] = [$student->name, $student->email, $student->student_id ?? 'N/A', $student->quizAttempts->count(), $avgScore . '%'];
                }
                $filename = 'student_performance_report_' . date('Y-m-d');
                break;
                
            default:
                return redirect()->back()->with('error', 'Invalid export type');
        }
        
        if ($format === 'csv') {
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
        
        return redirect()->back()->with('error', 'PDF export requires additional setup');
    }

    public function settings()
{
    // Get all settings grouped
    $gradingSettings = SystemSetting::where('group', 'grading')->get();
    $quizSettings = SystemSetting::where('group', 'quiz')->get();
    $academicSettings = SystemSetting::where('group', 'academic')->get();
    $fileSettings = SystemSetting::where('group', 'file')->get();
    
    return view('admin.settings', compact(
        'gradingSettings', 'quizSettings', 'academicSettings', 'fileSettings'
    ));
}

public function updateSettings(Request $request)
{
    $settings = $request->except('_token');
    
    foreach ($settings as $key => $value) {
        $setting = SystemSetting::where('key', $key)->first();
        if ($setting) {
            // Handle different types
            if ($setting->type === 'boolean') {
                $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
            } elseif ($setting->type === 'json' && is_array($value)) {
                $value = json_encode($value);
            }
            
            $setting->update(['value' => $value]);
        }
    }
    
    ActivityLog::create([
        'user_id' => Auth::id(),
        'action' => 'update',
        'description' => 'Updated system settings',
    ]);
    
    return redirect()->route('admin.settings')->with('success', 'Settings updated successfully!');
}

public function security()
{
    // Get login history with user details
    $loginHistory = LoginHistory::with('user')
        ->orderBy('login_at', 'desc')
        ->paginate(20);
    
    // Get access logs with user details
    $accessLogs = AccessLog::with('user')
        ->orderBy('created_at', 'desc')
        ->paginate(20);
    
    // Get statistics
    $totalLogins = LoginHistory::count();
    $uniqueUsers = LoginHistory::distinct('user_id')->count('user_id');
    $failedLogins = LoginHistory::where('status', 'failed')->count();
    $totalActions = AccessLog::count();
    
    // Get login trends (last 30 days)
    $loginTrends = [];
    for ($i = 29; $i >= 0; $i--) {
        $date = now()->subDays($i);
        $loginTrends[] = [
            'date' => $date->format('M d'),
            'logins' => LoginHistory::whereDate('login_at', $date->toDateString())->count(),
        ];
    }
    
    // Get most active users
    $activeUsers = AccessLog::select('user_id')
        ->with('user')
        ->selectRaw('count(*) as action_count')
        ->groupBy('user_id')
        ->orderBy('action_count', 'desc')
        ->limit(10)
        ->get();
    
    // Get devices breakdown
    $devices = [
        'desktop' => LoginHistory::where('device_type', 'desktop')->count(),
        'mobile' => LoginHistory::where('device_type', 'mobile')->count(),
        'tablet' => LoginHistory::where('device_type', 'tablet')->count(),
    ];
    
    // Get browsers breakdown
    $browsers = LoginHistory::select('browser')
        ->selectRaw('count(*) as count')
        ->whereNotNull('browser')
        ->groupBy('browser')
        ->orderBy('count', 'desc')
        ->limit(5)
        ->get();
    
    return view('admin.security', compact(
        'loginHistory', 'accessLogs', 'totalLogins', 'uniqueUsers',
        'failedLogins', 'totalActions', 'loginTrends', 'activeUsers',
        'devices', 'browsers'
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
        return redirect()->back()->with('error', 'Invalid log type');
    }
    
    ActivityLog::create([
        'user_id' => Auth::id(),
        'action' => 'delete',
        'description' => "Cleared {$type} logs",
    ]);
    
    return redirect()->back()->with('success', $message);
}

    public function bulkImport()
    {
        return view('admin.bulk-import');
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
                            'program_id' => $program->id,
                            'department_id' => $program->department_id,
                            'department' => $program->department ? $program->department->code : null,
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

                        $dept = Department::where('code', $department)->first();

                        User::create([
                            'name' => $name,
                            'email' => $email,
                            'password' => Hash::make($facultyId),
                            'role' => 'faculty',
                            'status' => 'active',
                            'must_change_password' => true,
                            'faculty_id' => $facultyId,
                            'department' => $department,
                            'department_id' => $dept ? $dept->id : null,
                            'specialization' => $specialization,
                        ]);
                    }

                    $created++;
                } catch (\Throwable $e) {
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
        } catch (\Throwable $e) {
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
}