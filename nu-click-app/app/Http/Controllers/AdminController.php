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
            ->withCount(['enrollments', 'quizAttempts'])
            ->orderBy('name')
            ->paginate(10);
            
        $faculty = User::where('role', 'faculty')
            ->withCount('courses')
            ->orderBy('name')
            ->paginate(10);
            
        return view('admin.users', compact('students', 'faculty'));
    }
    
    public function createUser()
    {
        return view('admin.create-user');
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
            'year_level' => 'nullable|integer|min:1|max:6',
            'department' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'qualification' => 'nullable|string',
            'bio' => 'nullable|string',
        ]);
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'status' => $validated['status'] ?? 'active',
            'student_id' => $validated['student_id'] ?? null,
            'year_level' => $validated['year_level'] ?? null,
            'department' => $validated['department'] ?? null,
            'specialization' => $validated['specialization'] ?? null,
            'qualification' => $validated['qualification'] ?? null,
            'bio' => $validated['bio'] ?? null,
        ]);
        
        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Created user: {$user->name} ({$user->role})",
        ]);
        
        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }
    
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $courses = Course::all();
        $assignedCourses = $user->courses()->pluck('courses.id')->toArray();
        
        return view('admin.edit-user', compact('user', 'courses', 'assignedCourses'));
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
            'year_level' => 'nullable|integer|min:1|max:6',
            'department' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'qualification' => 'nullable|string',
            'bio' => 'nullable|string',
            'course_ids' => 'nullable|array',
        ]);
        
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'status' => $validated['status'] ?? 'active',
            'student_id' => $validated['student_id'] ?? null,
            'year_level' => $validated['year_level'] ?? null,
            'department' => $validated['department'] ?? null,
            'specialization' => $validated['specialization'] ?? null,
            'qualification' => $validated['qualification'] ?? null,
            'bio' => $validated['bio'] ?? null,
        ]);
        
        if (!empty($validated['password'])) {
            $user->update(['password' => bcrypt($validated['password'])]);
        }
        
        // Sync courses for faculty
        if ($user->role === 'faculty' && isset($validated['course_ids'])) {
            $user->courses()->sync($validated['course_ids']);
        } elseif ($user->role === 'faculty') {
            $user->courses()->sync([]);
        }
        
        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => "Updated user: {$user->name}",
        ]);
        
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
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
        $courses = Course::with('faculty')
            ->withCount(['students', 'quizzes'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        $faculties = User::where('role', 'faculty')->where('status', 'active')->get();
        
        return view('admin.courses', compact('courses', 'faculties'));
    }
    
    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:courses',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'credits' => 'required|integer|min:1|max:6',
            'faculty_id' => 'nullable|exists:users,id',
            'join_code' => 'nullable|string|unique:courses',
        ]);
        
        if (empty($validated['join_code'])) {
            $validated['join_code'] = strtoupper(substr(md5(uniqid()), 0, 6));
        }
        
        $course = Course::create($validated);
        
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Created course: {$course->code} - {$course->name}",
        ]);
        
        return response()->json(['success' => true]);
    }
    
    public function updateCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        
        $validated = $request->validate([
            'code' => 'required|string|unique:courses,code,' . $id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'credits' => 'required|integer|min:1|max:6',
            'faculty_id' => 'nullable|exists:users,id',
            'join_code' => 'nullable|string|unique:courses,join_code,' . $id,
        ]);
        
        $course->update($validated);
        
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => "Updated course: {$course->code} - {$course->name}",
        ]);
        
        return response()->json(['success' => true]);
    }
    
    public function deleteCourse($id)
    {
        $course = Course::findOrFail($id);
        $courseName = $course->name;
        $course->delete();
        
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => "Deleted course: {$courseName}",
        ]);
        
        return response()->json(['success' => true]);
    }
    
    public function getCourseData($id)
    {
        $course = Course::findOrFail($id);
        
        return response()->json([
            'success' => true,
            'course' => [
                'id' => $course->id,
                'code' => $course->code,
                'name' => $course->name,
                'description' => $course->description,
                'credits' => $course->credits,
                'faculty_id' => $course->faculty_id,
                'join_code' => $course->join_code,
            ]
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


}