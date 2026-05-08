<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Announcement;
use App\Models\Notification;
use App\Models\User;

class StudentController extends Controller
{

    public function dashboard()
    {
        $user = Auth::user();
        
        // Get enrolled courses with progress
        $enrolledCourses = Enrollment::where('student_id', $user->id)
            ->with(['course.faculty', 'course.quizzes', 'course.materials'])
            ->get();
        
        // Calculate stats
        $completedQuizzes = QuizAttempt::where('student_id', $user->id)
            ->whereNotNull('completed_at')
            ->count();
        
        // Get average score
        $attempts = QuizAttempt::where('student_id', $user->id)
            ->whereNotNull('score')
            ->with('quiz')
            ->get();
        
        $totalEarnedPoints = 0;
        $totalPossiblePoints = 0;
        
        foreach ($attempts as $attempt) {
            $totalEarnedPoints += $attempt->score;
            $totalPossiblePoints += $attempt->quiz->total_points;
        }
        
        $averageScore = $totalPossiblePoints > 0 
            ? round(($totalEarnedPoints / $totalPossiblePoints) * 100, 1) 
            : 0;
        
        // Get upcoming quizzes
        $takenQuizIds = QuizAttempt::where('student_id', $user->id)
            ->whereNotNull('completed_at')
            ->pluck('quiz_id')
            ->toArray();
        
        $upcomingQuizzes = Quiz::whereHas('course.enrollments', function($q) use ($user) {
                $q->where('student_id', $user->id);
            })
            ->whereNotIn('id', $takenQuizIds)
            ->where(function($q) {
                $q->whereNull('start_date')
                  ->orWhere('start_date', '<=', now());
            })
            ->where(function($q) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', now());
            })
            ->with(['course', 'questions'])
            ->get();
        
        $pendingQuizzes = $upcomingQuizzes->count();
        
        // Get unread notifications count
        try {
            $unreadNotifications = Notification::where('user_id', $user->id)
                ->where('is_read', false)
                ->count();
        } catch (\Exception $e) {
            $unreadNotifications = 0;
        }
        
        // Get recent announcements
        try {
            $announcements = Announcement::whereHas('course.enrollments', function($q) use ($user) {
                    $q->where('student_id', $user->id);
                })
                ->with('course')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        } catch (\Exception $e) {
            $announcements = collect();
        }
        
        // Calculate progress for each course
        foreach ($enrolledCourses as $enrollment) {
            $totalMaterials = $enrollment->course->materials->count();
            $totalQuizzes = $enrollment->course->quizzes->count();
            
            $completedMaterials = 0;
            $completedQuizzesCount = 0;
            
            if ($totalQuizzes > 0) {
                $completedQuizzesCount = QuizAttempt::where('student_id', $user->id)
                    ->whereIn('quiz_id', $enrollment->course->quizzes->pluck('id'))
                    ->whereNotNull('completed_at')
                    ->count();
            }
            
            $quizProgress = $totalQuizzes > 0 ? ($completedQuizzesCount / $totalQuizzes) * 60 : 0;
            $materialProgress = $totalMaterials > 0 ? ($completedMaterials / $totalMaterials) * 40 : 0;
            
            $enrollment->progress = round($quizProgress + $materialProgress);
            $enrollment->completed_quizzes = $completedQuizzesCount;
            $enrollment->total_quizzes = $totalQuizzes;
            $enrollment->completed_materials = $completedMaterials;
            $enrollment->total_materials = $totalMaterials;
        }
        
        return view('student.dashboard', compact(
            'enrolledCourses', 'completedQuizzes', 'averageScore', 
            'upcomingQuizzes', 'pendingQuizzes', 'announcements',
            'unreadNotifications'
        ));
    }
    
    // ==================== PROFILE MANAGEMENT ====================

public function profile()
{
    $user = Auth::user();
    
    $enrolledCourses = Enrollment::where('student_id', $user->id)->count();
    $completedQuizzes = QuizAttempt::where('student_id', $user->id)
        ->whereNotNull('completed_at')
        ->count();
    
    $attempts = QuizAttempt::where('student_id', $user->id)
        ->whereNotNull('score')
        ->with('quiz')
        ->get();
    
    $totalEarnedPoints = 0;
    $totalPossiblePoints = 0;
    
    foreach ($attempts as $attempt) {
        $totalEarnedPoints += $attempt->score;
        $totalPossiblePoints += $attempt->quiz->total_points;
    }
    
    $averageScore = $totalPossiblePoints > 0 
        ? round(($totalEarnedPoints / $totalPossiblePoints) * 100, 1) 
        : 0;
    
    $recentQuizzes = QuizAttempt::where('student_id', $user->id)
        ->whereNotNull('completed_at')
        ->with('quiz.course')
        ->orderBy('completed_at', 'desc')
        ->limit(5)
        ->get();
    
    $memberSince = $user->created_at->format('F Y');
    
    return view('student.profile', compact(
        'user', 'enrolledCourses', 'completedQuizzes', 
        'averageScore', 'recentQuizzes', 'memberSince'
    ));
}

    // ==================== PHASE 8: PROGRESS TRACKING ====================
    
    public function progress()
    {
        $user = Auth::user();
        
        // Get enrolled courses with detailed progress
        $enrolledCourses = Enrollment::where('student_id', $user->id)
            ->with(['course.faculty', 'course.quizzes', 'course.materials'])
            ->get();
        
        $overallProgress = 0;
        $totalCourses = $enrolledCourses->count();
        
        foreach ($enrolledCourses as $enrollment) {
            $totalMaterials = $enrollment->course->materials->count();
            $totalQuizzes = $enrollment->course->quizzes->count();
            
            $completedQuizzesCount = QuizAttempt::where('student_id', $user->id)
                ->whereIn('quiz_id', $enrollment->course->quizzes->pluck('id'))
                ->whereNotNull('completed_at')
                ->count();
            
            $completedMaterials = 0;
            
            $quizProgress = $totalQuizzes > 0 ? ($completedQuizzesCount / $totalQuizzes) * 60 : 0;
            $materialProgress = $totalMaterials > 0 ? ($completedMaterials / $totalMaterials) * 40 : 0;
            
            $enrollment->course_progress = round($quizProgress + $materialProgress);
            $enrollment->completed_quizzes = $completedQuizzesCount;
            $enrollment->total_quizzes = $totalQuizzes;
            $enrollment->completed_materials = $completedMaterials;
            $enrollment->total_materials = $totalMaterials;
            
            $quizAttempts = QuizAttempt::where('student_id', $user->id)
                ->whereIn('quiz_id', $enrollment->course->quizzes->pluck('id'))
                ->whereNotNull('completed_at')
                ->with('quiz')
                ->get();
            
            $enrollment->quiz_scores = $quizAttempts->map(function($attempt) {
                $percentage = $attempt->quiz->total_points > 0 
                    ? round(($attempt->score / $attempt->quiz->total_points) * 100, 1)
                    : 0;
                return [
                    'title' => $attempt->quiz->title,
                    'score' => $attempt->score,
                    'total' => $attempt->quiz->total_points,
                    'percentage' => $percentage,
                    'completed_at' => $attempt->completed_at->format('M d, Y'),
                ];
            });
            
            $overallProgress += $enrollment->course_progress;
        }
        
        $averageProgress = $totalCourses > 0 ? round($overallProgress / $totalCourses) : 0;
        
        return view('student.progress', compact('enrolledCourses', 'averageProgress'));
    }
    
    public function markMaterialCompleted(Request $request, $materialId)
    {
        return response()->json(['success' => true]);
    }
    
    // ==================== PHASE 9: NOTIFICATIONS & ANNOUNCEMENTS ====================
    
    public function announcements()
    {
        $user = Auth::user();
        
        $announcements = Announcement::whereHas('course.enrollments', function($q) use ($user) {
                $q->where('student_id', $user->id);
            })
            ->with('course')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('student.announcements', compact('announcements'));
    }
    
    public function notifications()
    {
        $user = Auth::user();
        
        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('student.notifications', compact('notifications'));
    }
    
    public function markNotificationRead($id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();
        
        if ($notification) {
            $notification->update(['is_read' => true]);
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 404);
    }
    
    public function markAllNotificationsRead()
    {
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);
        
        return redirect()->back()->with('success', 'All notifications marked as read.');
    }
    
public function courseDetails($id)
{
    $course = Course::with(['materials', 'quizzes.questions', 'faculty'])->findOrFail($id);
    
    $enrollment = Enrollment::where('student_id', Auth::id())
        ->where('course_id', $id)
        ->first();
    
    if (!$enrollment) {
        return redirect()->route('student.dashboard')->with('error', 'You are not enrolled in this course.');
    }
    
    // Get announcements for this course
    $announcements = Announcement::where('course_id', $id)
        ->with('faculty')
        ->orderBy('created_at', 'desc')
        ->get();
    
    $quizzes = $course->quizzes->map(function($quiz) {
        $attempt = QuizAttempt::where('quiz_id', $quiz->id)
            ->where('student_id', Auth::id())
            ->first();
        
        $quiz->attempted = $attempt && $attempt->completed_at ? 1 : 0;
        $quiz->score = $attempt ? $attempt->score : null;
        
        return $quiz;
    });
    
    return view('student.course-details', compact('course', 'enrollment', 'quizzes', 'announcements'));
}
    
    public function courses()
    {
        $user = Auth::user();
        
        $enrolledCourses = Enrollment::where('student_id', $user->id)
            ->with('course')
            ->get()
            ->pluck('course');
        
        $availableCourses = Course::whereNotIn('id', $enrolledCourses->pluck('id'))
            ->whereNotNull('join_code')
            ->get();
        
        return view('student.courses', compact('enrolledCourses', 'availableCourses'));
    }
    
    public function joinCourse(Request $request)
    {
        $request->validate([
            'join_code' => 'required|string'
        ]);
        
        $joinCode = $request->join_code ?? $request->course_code;
        $course = Course::where('join_code', strtoupper($joinCode))->first();
        
        if (!$course) {
            return redirect()->back()->with('error', 'Invalid join code. Please check and try again.');
        }
        
        $exists = Enrollment::where('student_id', Auth::id())
            ->where('course_id', $course->id)
            ->exists();
        
        if ($exists) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }
        
        Enrollment::create([
            'student_id' => Auth::id(),
            'course_id' => $course->id,
            'status' => 'active'
        ]);
        
        return redirect()->route('student.courses')->with('success', 'Successfully joined ' . $course->name . '!');
    }
    
    public function leaveCourse($id)
    {
        $enrollment = Enrollment::where('student_id', Auth::id())
            ->where('course_id', $id)
            ->first();
        
        if (!$enrollment) {
            return redirect()->back()->with('error', 'You are not enrolled in this course.');
        }
        
        $enrollment->delete();
        
        return redirect()->route('student.courses')->with('success', 'Successfully left the course.');
    }
    
    // ==================== PHASE 6: TEST / ASSESSMENT TAKING ====================
    
    public function takeQuiz($id)
    {
        $quiz = Quiz::with(['questions', 'course'])->findOrFail($id);
        
        $isEnrolled = Enrollment::where('student_id', Auth::id())
            ->where('course_id', $quiz->course_id)
            ->exists();
        
        if (!$isEnrolled) {
            return redirect()->route('student.dashboard')->with('error', 'You are not enrolled in this course.');
        }
        
        $now = now();
        
        if ($quiz->start_date && $now < $quiz->start_date) {
            return redirect()->route('student.course.details', $quiz->course_id)
                ->with('error', 'This quiz is not yet available. It starts on ' . $quiz->start_date->format('M d, Y h:i A'));
        }
        
        if ($quiz->end_date && $now > $quiz->end_date) {
            return redirect()->route('student.course.details', $quiz->course_id)
                ->with('error', 'This quiz has expired.');
        }
        
        if ($quiz->max_attempts) {
            $attemptCount = QuizAttempt::where('quiz_id', $id)
                ->where('student_id', Auth::id())
                ->count();
            
            if ($attemptCount >= $quiz->max_attempts) {
                return redirect()->route('student.course.details', $quiz->course_id)
                    ->with('error', 'You have reached the maximum number of attempts for this quiz.');
            }
        }
        
        $attempt = QuizAttempt::where('quiz_id', $id)
            ->where('student_id', Auth::id())
            ->whereNull('completed_at')
            ->first();
        
        if (!$attempt) {
            $attempt = QuizAttempt::create([
                'quiz_id' => $id,
                'student_id' => Auth::id(),
                'started_at' => now(),
            ]);
        }
        
        return view('student.take-quiz', compact('quiz', 'attempt'));
    }
    
    public function submitQuiz(Request $request, $id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        $attempt = QuizAttempt::where('quiz_id', $id)
            ->where('student_id', Auth::id())
            ->whereNull('completed_at')
            ->firstOrFail();

        $answers = [];
        $score = 0;

        foreach ($quiz->questions as $question) {
            $userAnswer = $request->input('question_' . $question->id);
            $answers[$question->id] = $userAnswer ?? 'No answer provided';
            
            if ($question->question_type != 'essay') {
                if (!empty($userAnswer) && strtolower(trim($userAnswer)) == strtolower(trim($question->correct_answer))) {
                    $score += $question->points;
                }
            }
        }

        $attempt->update([
            'completed_at' => now(),
            'answers' => $answers,
            'score' => $score,
        ]);

        return redirect()->route('student.quiz.results', $attempt->id)
            ->with('success', 'Quiz submitted successfully!');
    }
    
    // ==================== PHASE 7: RESULTS & FEEDBACK ====================
    
    public function quizResults($attemptId)
    {
        $attempt = QuizAttempt::with(['quiz.questions', 'student'])->findOrFail($attemptId);
        $course = Course::find($attempt->quiz->course_id);
        
        if ($attempt->student_id !== Auth::id()) {
            return redirect()->route('student.dashboard')->with('error', 'Unauthorized access.');
        }
        
        $answers = $attempt->answers ?? [];
        
        $questionsWithAnswers = [];
        $correctCount = 0;
        
        foreach ($attempt->quiz->questions as $question) {
            $studentAnswer = isset($answers[$question->id]) ? $answers[$question->id] : 'No answer provided';
            $isCorrect = false;
            
            if ($question->question_type != 'essay' && $studentAnswer != 'No answer provided') {
                $isCorrect = strtolower(trim($studentAnswer)) == strtolower(trim($question->correct_answer));
                if ($isCorrect) {
                    $correctCount++;
                }
            }
            
            $questionsWithAnswers[] = [
                'question' => $question,
                'student_answer' => $studentAnswer,
                'is_correct' => $isCorrect,
            ];
        }
        
        $totalQuestions = $attempt->quiz->questions->count();
        $percentage = $attempt->quiz->total_points > 0 
            ? round(($attempt->score / $attempt->quiz->total_points) * 100, 1) 
            : 0;
        
        $letterGrade = $this->getLetterGrade($percentage);
        
        return view('student.quiz-results', compact(
            'attempt', 'course', 'questionsWithAnswers', 
            'percentage', 'letterGrade', 'correctCount', 'totalQuestions'
        ));
    }
    
    private function getLetterGrade($percentage)
    {
        if ($percentage >= 90) return 'A';
        if ($percentage >= 80) return 'B';
        if ($percentage >= 70) return 'C';
        if ($percentage >= 60) return 'D';
        return 'F';
    }
}