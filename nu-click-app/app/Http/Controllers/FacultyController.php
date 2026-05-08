<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\CourseMaterial;
use App\Models\QuizAttempt;
use App\Models\Announcement;
use App\Models\Notification;
use App\Models\ActivityLog;


class FacultyController extends Controller
{

    

    // ==================== DASHBOARD ====================
    
    public function dashboard()
    {
        $user = Auth::user();
        $courses = Course::where('faculty_id', $user->id)->get();
        
        $totalStudents = Enrollment::whereIn('course_id', $courses->pluck('id'))->count();
        $totalCourses = $courses->count();
        $totalQuizzes = Quiz::whereIn('course_id', $courses->pluck('id'))->count();
        
        // Recent activities
        $recentEnrollments = Enrollment::with(['student', 'course'])
            ->whereIn('course_id', $courses->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        $recentQuizzes = Quiz::whereIn('course_id', $courses->pluck('id'))
            ->with('course')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('faculty.dashboard', compact(
            'totalStudents', 'totalCourses', 'totalQuizzes', 
            'recentEnrollments', 'recentQuizzes', 'courses'
        ));
    }

    // ==================== STUDENT MANAGEMENT ====================
    
    public function students()
    {
        $user = Auth::user();
        $courses = Course::where('faculty_id', $user->id)->get();
        $students = User::whereHas('enrollments', function($query) use ($courses) {
            $query->whereIn('course_id', $courses->pluck('id'));
        })->with(['enrollments' => function($query) use ($courses) {
            $query->whereIn('course_id', $courses->pluck('id'));
        }])->get();
        
        return view('faculty.students', compact('students', 'courses'));
    }
    
    public function studentDetails($id)
    {
        $student = User::with(['enrollments.course', 'quizAttempts.quiz'])->findOrFail($id);
        return view('faculty.student-details', compact('student'));
    }
    
    public function enrollStudent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id'
        ]);
        
        $course = Course::find($request->course_id);
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $exists = Enrollment::where('student_id', $request->student_id)
            ->where('course_id', $request->course_id)
            ->exists();
            
        if ($exists) {
            return redirect()->back()->with('error', 'Student already enrolled in this course');
        }
        
        $enrollment = Enrollment::create([
            'student_id' => $request->student_id,
            'course_id' => $request->course_id,
            'status' => 'active'
        ]);

        $student = User::find($request->student_id);
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Enrolled student: {$student->name} in course: {$course->code}",
            'metadata' => json_encode(['ip' => request()->ip(), 'enrollment_id' => $enrollment->id]),
        ]);
        
        return redirect()->back()->with('success', 'Student enrolled successfully');
    }
    
    public function removeStudent($enrollmentId)
    {
        $enrollment = Enrollment::findOrFail($enrollmentId);
        $course = Course::find($enrollment->course_id);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $enrollment->delete();
        return redirect()->back()->with('success', 'Student removed successfully');
    }
    
    public function searchStudents(Request $request)
    {
        $search = $request->get('q');
        
        $students = User::where('role', 'student')
            ->where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%")
                      ->orWhere('student_id', 'LIKE', "%{$search}%");
            })
            ->limit(10)
            ->get(['id', 'name', 'email', 'student_id']);
        
        return response()->json($students);
    }

    // ==================== COURSE MANAGEMENT ====================
    
    public function courses()
    {
        $user = Auth::user();
        $courses = Course::where('faculty_id', $user->id)
            ->withCount(['students', 'quizzes'])  // Add quizzes count
            ->get();
        return view('faculty.courses', compact('courses'));
    }
    
    public function createCourse()
    {
        return view('faculty.create-course');
    }
    
    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:courses',
            'name' => 'required',
            'description' => 'nullable',
            'credits' => 'required|integer|min:1|max:6',
        ]);
        
        // Auto-generate a join code for the course
        $joinCode = strtoupper(substr(md5(uniqid()), 0, 6));
        
        $course = Course::create([
            'code' => $validated['code'],
            'name' => $validated['name'],
            'description' => $validated['description'],
            'credits' => $validated['credits'],
            'faculty_id' => Auth::id(),
            'join_code' => $joinCode,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Created course: {$course->code} - {$course->name}",
            'metadata' => json_encode(['ip' => request()->ip(), 'course_id' => $course->id]),
        ]);
        
        return redirect()->route('faculty.courses')->with('success', 'Course created successfully! Join code: ' . $joinCode);
    }
    
    public function editCourse($id)
    {
        $course = Course::findOrFail($id);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->route('faculty.courses')->with('error', 'Unauthorized');
        }
        
        return view('faculty.edit-course', compact('course'));
    }
    
    public function updateCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->route('faculty.courses')->with('error', 'Unauthorized');
        }
        
        $validated = $request->validate([
            'code' => 'required|unique:courses,code,' . $id,
            'name' => 'required',
            'description' => 'nullable',
            'credits' => 'required|integer|min:1|max:6',
        ]);
        
        $course->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => "Updated course: {$course->code} - {$course->name}",
            'metadata' => json_encode(['ip' => request()->ip(), 'course_id' => $course->id]),
        ]);
        
        return redirect()->route('faculty.courses')->with('success', 'Course updated successfully!');
    }
    
    public function deleteCourse($id)
    {
        $course = Course::findOrFail($id);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $course->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => "Deleted course: {$course->name}",
            'metadata' => json_encode(['ip' => request()->ip()]),
        ]);
        return redirect()->route('faculty.courses')->with('success', 'Course deleted successfully!');
    }
    
    public function courseDetails($id)
    {
        $course = Course::with(['students', 'materials', 'quizzes.questions', 'students.enrollments'])
            ->withCount(['students', 'quizzes'])  // Add quizzes count
            ->findOrFail($id);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->route('faculty.courses')->with('error', 'Unauthorized');
        }
        
        return view('faculty.course-details', compact('course'));
    }
    
    // ==================== MATERIALS MANAGEMENT ====================
    
    public function materials($courseId)
    {
        $course = Course::findOrFail($courseId);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->route('faculty.courses')->with('error', 'Unauthorized');
        }
        
        $materials = CourseMaterial::where('course_id', $courseId)->get();
        return view('faculty.materials', compact('course', 'materials'));
    }
    
    public function uploadMaterial(Request $request, $courseId)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'file' => 'required|file|max:10240'
        ]);
        
        $course = Course::findOrFail($courseId);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $path = $request->file('file')->store('materials', 'public');
        
        $material = CourseMaterial::create([
            'course_id' => $courseId,
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
            'file_type' => $request->file('file')->getClientMimeType(),
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Uploaded material: {$request->title} for course: {$course->code}",
            'metadata' => json_encode(['ip' => request()->ip(), 'material_id' => $material->id]),
        ]);
        
        return redirect()->back()->with('success', 'Material uploaded successfully!');
    }
    
    public function deleteMaterial($id)
    {
        $material = CourseMaterial::findOrFail($id);
        $course = Course::find($material->course_id);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        if ($material->file_path) {
            Storage::disk('public')->delete($material->file_path);
        }
        
        $material->delete();
        return redirect()->back()->with('success', 'Material deleted successfully!');
    }

    // ==================== QUIZ MANAGEMENT ====================
    
    public function createQuizPage()
    {
        $user = Auth::user();
        $courses = Course::where('faculty_id', $user->id)->get();
        return view('faculty.create-quiz', compact('courses'));
    }
    
    public function createQuizForCourse($courseId)
    {
        $user = Auth::user();
        $courses = Course::where('faculty_id', $user->id)->get();
        $selectedCourse = $courseId;
        return view('faculty.create-quiz', compact('courses', 'selectedCourse'));
    }
    
    public function quizzesList()
    {
        $user = Auth::user();
        $quizzes = Quiz::whereHas('course', function($query) use ($user) {
            $query->where('faculty_id', $user->id);
        })->with(['course', 'questions', 'attempts'])->orderBy('created_at', 'desc')->get();
        
        return view('faculty.quizzes-list', compact('quizzes'));
    }
    
    public function quizzes($courseId)
    {
        $course = Course::findOrFail($courseId);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->route('faculty.courses')->with('error', 'Unauthorized');
        }
        
        $quizzes = Quiz::where('course_id', $courseId)->withCount('questions')->get();
        return view('faculty.quizzes', compact('course', 'quizzes'));
    }
    
    public function createQuiz($courseId)
    {
        $course = Course::findOrFail($courseId);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->route('faculty.courses')->with('error', 'Unauthorized');
        }
        
        return view('faculty.create-quiz', compact('course'));
    }
    
    public function storeQuiz(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required',
            'description' => 'nullable',
            'duration_minutes' => 'nullable|integer|min:1',
            'max_attempts' => 'nullable|integer|min:1|max:10',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);
        
        $course = Course::find($validated['course_id']);
        if ($course->faculty_id !== Auth::id()) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $quiz = Quiz::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Created quiz: {$quiz->title} for course: {$course->code}",
            'metadata' => json_encode(['ip' => request()->ip(), 'quiz_id' => $quiz->id]),
        ]);
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'quiz_id' => $quiz->id,
                'message' => 'Quiz created successfully'
            ]);
        }
        
        return redirect()->route('faculty.edit.quiz', $quiz->id)
            ->with('success', 'Quiz created! Now add questions.');
    }
    
    public function editQuiz($id)
    {
        $quiz = Quiz::with('questions', 'course')->findOrFail($id);
        $course = Course::find($quiz->course_id);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->route('faculty.courses')->with('error', 'Unauthorized');
        }
        
        return view('faculty.edit-quiz', compact('quiz', 'course'));
    }
    
    public function updateQuiz(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $course = Course::find($quiz->course_id);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'duration_minutes' => 'nullable|integer|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);
        
        $quiz->update($validated);
        
        return redirect()->route('faculty.course.details', $quiz->course_id)
            ->with('success', 'Quiz updated successfully!');
    }
    
    public function deleteQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $course = Course::find($quiz->course_id);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $quiz->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => "Deleted quiz: {$quiz->title}",
            'metadata' => json_encode(['ip' => request()->ip()]),
        ]);
        return redirect()->back()->with('success', 'Quiz deleted successfully!');
    }

    // ==================== QUESTION MANAGEMENT ====================
    
    public function questionBank()
    {
        $user = Auth::user();
        $questions = Question::whereHas('quiz.course', function($query) use ($user) {
            $query->where('faculty_id', $user->id);
        })->with(['quiz.course'])->orderBy('created_at', 'desc')->get();
        
        return view('faculty.question-bank', compact('questions'));
    }
    
    /**
     * Get questions from question bank that are not already in the quiz
     */
    public function getQuestionBank($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $course = Course::find($quiz->course_id);
        
        if ($course->faculty_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        // Get all question IDs that are already in this quiz
        $existingQuestionIds = $quiz->questions()->pluck('id')->toArray();
        
        // Get all questions that are not already in this quiz and belong to the faculty's courses
        $questions = Question::whereHas('quiz.course', function($query) use ($course) {
            $query->where('faculty_id', $course->faculty_id);
        })
        ->whereNotIn('id', $existingQuestionIds)
        ->with('quiz.course')
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function($question) {
            return [
                'id' => $question->id,
                'question_text' => $question->question_text,
                'question_type' => $question->question_type,
                'options' => $question->options,
                'correct_answer' => $question->correct_answer,
                'points' => $question->points,
                'quiz_title' => $question->quiz->title ?? 'N/A',
                'course_code' => $question->quiz->course->code ?? 'N/A',
            ];
        });
        
        return response()->json([
            'success' => true,
            'questions' => $questions
        ]);
    }
    
    /**
     * Add selected questions from question bank to the quiz
     */
    public function addQuestionsToQuiz(Request $request, $quizId)
    {
        $request->validate([
            'question_ids' => 'required|array',
            'question_ids.*' => 'exists:questions,id'
        ]);
        
        $quiz = Quiz::findOrFail($quizId);
        $course = Course::find($quiz->course_id);
        
        if ($course->faculty_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        $addedCount = 0;
        
        // Get the questions to add
        $questions = Question::whereIn('id', $request->question_ids)->get();
        
        // Update quiz_id for each question
        foreach ($questions as $question) {
            // Check if question already belongs to this quiz
            if ($question->quiz_id != $quizId) {
                $question->quiz_id = $quizId;
                $question->save();
                $addedCount++;
            }
        }
        
        // Update quiz total points
        $quiz->total_points = $quiz->questions()->sum('points');
        $quiz->save();
        
        return response()->json([
            'success' => true,
            'message' => "Successfully added {$addedCount} question(s) to the quiz",
            'count' => $addedCount
        ]);
    }
    
    public function addQuestion($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $course = Course::find($quiz->course_id);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->route('faculty.courses')->with('error', 'Unauthorized');
        }
        
        return view('faculty.add-question', compact('quiz'));
    }
    
    public function storeQuestion(Request $request, $quizId)
    {
        try {
            $quiz = Quiz::findOrFail($quizId);
            $course = Course::find($quiz->course_id);
            
            if ($course->faculty_id !== Auth::id()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }
            
            // Validate the request
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'question_text' => 'required|string',
                'question_type' => 'required|in:mcq,true_false,essay',
                'correct_answer' => 'required|string',
                'points' => 'required|integer|min:1'
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            
            $validated = $validator->validated();
            
            // Handle options for MCQ
            $options = null;
            if ($validated['question_type'] === 'mcq') {
                $optionsArray = $request->input('options', []);
                $optionsArray = array_filter($optionsArray, function($option) {
                    return !empty(trim($option));
                });
                if (empty($optionsArray)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Please provide at least one answer option for MCQ questions'
                    ], 422);
                }
                $options = json_encode(array_values($optionsArray));
            }
            
            // Create the question
            $question = Question::create([
                'quiz_id' => $quizId,
                'question_text' => $validated['question_text'],
                'question_type' => $validated['question_type'],
                'options' => $options,
                'correct_answer' => $validated['correct_answer'],
                'points' => $validated['points'],
            ]);
            
            // Update quiz total points
            $quiz->total_points = $quiz->questions()->sum('points');
            $quiz->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Question added successfully!',
                'question' => $question
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    public function editQuestion($id)
    {
        $question = Question::with('quiz')->findOrFail($id);
        $course = Course::find($question->quiz->course_id);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->route('faculty.courses')->with('error', 'Unauthorized');
        }
        
        // Redirect to question bank instead of showing separate edit page
        return redirect()->route('faculty.question.bank')->with('edit_question_id', $question->id);
    }
    
    public function updateQuestion(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $course = Course::find($question->quiz->course_id);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $validated = $request->validate([
            'question_text' => 'required',
            'question_type' => 'required|in:mcq,true_false,essay',
            'options' => 'nullable|array',
            'correct_answer' => 'required',
            'points' => 'required|integer|min:1'
        ]);
        
        if ($validated['question_type'] === 'mcq' && isset($validated['options'])) {
            $filteredOptions = array_filter($validated['options'], function($option) {
                return !empty(trim($option));
            });
            $validated['options'] = json_encode(array_values($filteredOptions));
        }
        
        $question->update($validated);
        
        $question->quiz->total_points = $question->quiz->questions()->sum('points');
        $question->quiz->save();
        
        return redirect()->route('faculty.edit.quiz', $question->quiz_id)
            ->with('success', 'Question updated successfully!');
    }
    
    public function deleteQuestion($id)
    {
        $question = Question::findOrFail($id);
        $course = Course::find($question->quiz->course_id);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $quizId = $question->quiz_id;
        $question->delete();
        
        $quiz = Quiz::find($quizId);
        $quiz->total_points = $quiz->questions()->sum('points');
        $quiz->save();
        
        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Question deleted successfully']);
        }
        
        return redirect()->back()->with('success', 'Question deleted successfully!');
    }

    // ==================== GRADING & SUBMISSIONS ====================
    
    public function gradingDashboard()
    {
        $user = Auth::user();
        
        // Get pending grading submissions
        $pendingGrading = QuizAttempt::whereHas('quiz.course', function($query) use ($user) {
            $query->where('faculty_id', $user->id);
        })
        ->whereNull('feedback') // This will work after you add the feedback column
        ->whereNotNull('completed_at')
        ->with(['quiz', 'student', 'quiz.course'])
        ->orderBy('completed_at', 'desc')
        ->limit(20)
        ->get();
        
        // Get total submissions
        $totalSubmissions = QuizAttempt::whereHas('quiz.course', function($query) use ($user) {
            $query->where('faculty_id', $user->id);
        })
        ->whereNotNull('completed_at')
        ->count();
        
        // Get average score
        $averageScore = QuizAttempt::whereHas('quiz.course', function($query) use ($user) {
            $query->where('faculty_id', $user->id);
        })
        ->whereNotNull('score')
        ->avg('score');
        
        return view('faculty.grading', compact('pendingGrading', 'totalSubmissions', 'averageScore'));
    }
    
    public function submissions($quizId)
    {
        $quiz = Quiz::with(['attempts.student', 'course'])->findOrFail($quizId);
        $course = Course::find($quiz->course_id);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->route('faculty.courses')->with('error', 'Unauthorized');
        }
        
        $attempts = QuizAttempt::where('quiz_id', $quizId)
            ->with('student')
            ->orderBy('completed_at', 'desc')
            ->get();
            
        return view('faculty.submissions', compact('quiz', 'attempts'));
    }
    
    public function gradeSubmission($attemptId)
    {
        $attempt = QuizAttempt::with(['quiz.questions', 'student'])->findOrFail($attemptId);
        $course = Course::find($attempt->quiz->course_id);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->route('faculty.courses')->with('error', 'Unauthorized');
        }
        
        return view('faculty.grade-submission', compact('attempt'));
    }
    
    public function updateGrade(Request $request, $attemptId)
    {
        $attempt = QuizAttempt::findOrFail($attemptId);
        $course = Course::find($attempt->quiz->course_id);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $request->validate([
            'score' => 'required|numeric|min:0|max:' . $attempt->quiz->total_points,
            'feedback' => 'nullable|string'
        ]);
        
        $attempt->score = $request->score;
        $attempt->feedback = $request->feedback;
        $attempt->save();
        
        return redirect()->route('faculty.submissions', $attempt->quiz_id)
            ->with('success', 'Grade updated successfully!');
    }

    // ==================== RESULTS & ANALYTICS ====================
    
    public function resultsIndex()
    {
        $user = Auth::user();
        $courses = Course::where('faculty_id', $user->id)->withCount(['students', 'quizzes'])->get();
        
        return view('faculty.results-index', compact('courses'));
    }
    
    public function results($courseId)
    {
        if ($courseId == 0) {
            return redirect()->route('faculty.results.index');
        }
        
        $course = Course::with(['students', 'quizzes'])->findOrFail($courseId);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->route('faculty.courses')->with('error', 'Unauthorized');
        }
        
        $analytics = [];
        $overallStats = [
            'total_students' => $course->students->count(),
            'total_quizzes' => $course->quizzes->count(),
            'average_score' => 0,
            'completion_rate' => 0
        ];
        
        $totalScores = 0;
        $totalAttempts = 0;
        
        foreach ($course->quizzes as $quiz) {
            $attempts = QuizAttempt::where('quiz_id', $quiz->id)
                ->whereNotNull('completed_at')
                ->get();
            
            $avgScore = $attempts->avg('score') ?? 0;
            $avgPercentage = $quiz->total_points > 0 ? ($avgScore / $quiz->total_points) * 100 : 0;
            
            $analytics[$quiz->id] = [
                'quiz' => $quiz,
                'average' => $avgScore,
                'average_percentage' => round($avgPercentage, 2),
                'highest' => $attempts->max('score') ?? 0,
                'lowest' => $attempts->min('score') ?? 0,
                'total_attempts' => $attempts->count(),
                'passing_rate' => $attempts->filter(function($attempt) use ($quiz) {
                    return ($attempt->score / max($quiz->total_points, 1)) >= 0.6;
                })->count() / max($attempts->count(), 1) * 100
            ];
            
            $totalScores += $avgPercentage;
            $totalAttempts += $attempts->count();
        }
        
        $overallStats['average_score'] = $course->quizzes->count() > 0 ? round($totalScores / $course->quizzes->count(), 2) : 0;
        $overallStats['completion_rate'] = ($course->students->count() > 0 && $course->quizzes->count() > 0) 
            ? round(($totalAttempts / ($course->students->count() * $course->quizzes->count())) * 100, 2) 
            : 0;
        
        return view('faculty.results', compact('course', 'analytics', 'overallStats'));
    }
    
    public function downloadResults($courseId)
    {
        $course = Course::with(['students', 'quizzes.attempts'])->findOrFail($courseId);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $csvData = [];
        $csvData[] = ['Student Name', 'Student ID', 'Email', 'Course', 'Quiz', 'Score', 'Percentage', 'Date Completed', 'Feedback'];
        
        foreach ($course->students as $student) {
            foreach ($course->quizzes as $quiz) {
                $attempt = QuizAttempt::where('quiz_id', $quiz->id)
                    ->where('student_id', $student->id)
                    ->first();
                
                if ($attempt) {
                    $percentage = $quiz->total_points > 0 ? round(($attempt->score / $quiz->total_points) * 100, 2) : 0;
                    $csvData[] = [
                        $student->name,
                        $student->student_id ?? 'N/A',
                        $student->email,
                        $course->name,
                        $quiz->title,
                        $attempt->score . '/' . $quiz->total_points,
                        $percentage . '%',
                        $attempt->completed_at ? $attempt->completed_at->format('Y-m-d H:i') : 'N/A',
                        $attempt->feedback ?? 'N/A'
                    ];
                }
            }
        }
        
        $filename = "course_{$course->code}_results_" . date('Y-m-d') . ".csv";
        $handle = fopen('php://temp', 'w+');
        
        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }
        
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);
        
        return response($content)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function getAttemptDetails($attemptId)
    {
        $attempt = QuizAttempt::with(['quiz.questions', 'student'])->findOrFail($attemptId);
        $course = Course::find($attempt->quiz->course_id);
        
        if ($course->faculty_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        // Get answers as array (already cast by the model)
        $answers = $attempt->answers ?? [];
        
        $answersList = [];
        foreach ($attempt->quiz->questions as $question) {
            $studentAnswer = isset($answers[$question->id]) ? $answers[$question->id] : 'No answer provided';
            
            // Determine if answer is correct (for MCQ and True/False)
            $isCorrect = false;
            if ($question->question_type != 'essay') {
                $isCorrect = strtolower(trim($studentAnswer)) == strtolower(trim($question->correct_answer));
            }
            
            $answersList[] = [
                'question_text' => $question->question_text,
                'student_answer' => is_array($studentAnswer) ? implode(', ', $studentAnswer) : $studentAnswer,
                'correct_answer' => $question->correct_answer,
                'points' => $question->points,
                'is_correct' => $isCorrect,
            ];
        }
        
        return response()->json([
            'success' => true,
            'student_name' => $attempt->student->name,
            'score' => $attempt->score,
            'total_points' => $attempt->quiz->total_points,
            'percentage' => $attempt->score && $attempt->quiz->total_points > 0 
                ? round(($attempt->score / $attempt->quiz->total_points) * 100, 1) 
                : 0,
            'submitted_at' => $attempt->completed_at ? $attempt->completed_at->format('M d, Y h:i A') : 'N/A',
            'status' => $attempt->feedback || $attempt->score ? 'Graded' : 'Pending',
            'answers' => $answersList
        ]);
    }

    public function getQuestionData($id)
    {
        $question = Question::findOrFail($id);
        $course = Course::find($question->quiz->course_id);
        
        if ($course->faculty_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        return response()->json([
            'success' => true,
            'question' => [
                'id' => $question->id,
                'question_text' => $question->question_text,
                'question_type' => $question->question_type,
                'options' => $question->options,
                'correct_answer' => $question->correct_answer,
                'points' => $question->points,
            ]
        ]);
    }

    public function storeQuestionBank(Request $request)
    {
        try {
            $validated = $request->validate([
                'quiz_id' => 'required|exists:quizzes,id',
                'question_text' => 'required|string',
                'question_type' => 'required|in:mcq,true_false,essay',
                'correct_answer' => 'required|string',
                'points' => 'required|integer|min:1',
                'options' => 'nullable|array',
            ]);
            
            $quiz = Quiz::findOrFail($validated['quiz_id']);
            $course = Course::find($quiz->course_id);
            
            if ($course->faculty_id !== Auth::id()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }
            
            $options = null;
            if ($validated['question_type'] === 'mcq' && isset($validated['options'])) {
                $options = json_encode(array_values(array_filter($validated['options'])));
            }
            
            $question = Question::create([
                'quiz_id' => $validated['quiz_id'],
                'question_text' => $validated['question_text'],
                'question_type' => $validated['question_type'],
                'options' => $options,
                'correct_answer' => $validated['correct_answer'],
                'points' => $validated['points'],
            ]);
            
            // Update quiz total points
            $quiz->total_points = $quiz->questions()->sum('points');
            $quiz->save();
            
            return response()->json(['success' => true, 'message' => 'Question added successfully!']);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateQuestionBank(Request $request, $id)
    {
        try {
            $question = Question::findOrFail($id);
            $course = Course::find($question->quiz->course_id);
            
            if ($course->faculty_id !== Auth::id()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }
            
            $validated = $request->validate([
                'quiz_id' => 'required|exists:quizzes,id',
                'question_text' => 'required|string',
                'question_type' => 'required|in:mcq,true_false,essay',
                'correct_answer' => 'required|string',
                'points' => 'required|integer|min:1',
                'options' => 'nullable|array',
            ]);
            
            $options = null;
            if ($validated['question_type'] === 'mcq' && isset($validated['options'])) {
                $options = json_encode(array_values(array_filter($validated['options'])));
            }
            
            $question->update([
                'quiz_id' => $validated['quiz_id'],
                'question_text' => $validated['question_text'],
                'question_type' => $validated['question_type'],
                'options' => $options,
                'correct_answer' => $validated['correct_answer'],
                'points' => $validated['points'],
            ]);
            
            // Update quiz total points
            $quiz = Quiz::find($validated['quiz_id']);
            $quiz->total_points = $quiz->questions()->sum('points');
            $quiz->save();
            
            return response()->json(['success' => true, 'message' => 'Question updated successfully!']);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function downloadMaterial($id)
    {
        $material = CourseMaterial::findOrFail($id);
        $course = Course::find($material->course_id);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $filePath = storage_path('app/public/' . $material->file_path);
        
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File not found.');
        }
        
        return response()->download($filePath, $material->title . '.' . pathinfo($material->file_path, PATHINFO_EXTENSION));
    }

    public function getStudentDetails($id)
    {
        $student = User::with(['enrollments.course', 'quizAttempts.quiz.course'])
            ->findOrFail($id);
        
        $courses = [];
        foreach ($student->enrollments as $enrollment) {
            $courses[] = [
                'id' => $enrollment->course->id,
                'code' => $enrollment->course->code,
                'name' => $enrollment->course->name,
                'enrolled_date' => $enrollment->created_at->format('M d, Y')
            ];
        }
        
        $quizzes = [];
        $totalScore = 0;
        foreach ($student->quizAttempts->whereNotNull('completed_at') as $attempt) {
            $percentage = $attempt->quiz->total_points > 0 
                ? ($attempt->score / $attempt->quiz->total_points) * 100 
                : 0;
            $totalScore += $percentage;
            
            $quizzes[] = [
                'title' => $attempt->quiz->title,
                'course_code' => $attempt->quiz->course->code,
                'score' => $attempt->score,
                'total_points' => $attempt->quiz->total_points,
                'completed_date' => $attempt->completed_at->format('M d, Y'),
            ];
        }
        
        $averageScore = count($quizzes) > 0 ? $totalScore / count($quizzes) : 0;
        
        return response()->json([
            'success' => true,
            'student' => [
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'student_id' => $student->student_id,
            ],
            'courses' => $courses,
            'quizzes' => $quizzes,
            'average_score' => $averageScore
        ]);
    }

    public function regenerateCourseCode($id)
    {
        $course = Course::findOrFail($id);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        // Generate a unique join code (6 characters)
        $course->join_code = strtoupper(substr(md5(uniqid() . $course->id . time()), 0, 6));
        $course->save();
        
        return redirect()->back()->with('success', 'New join code generated: ' . $course->join_code);
    }

    // ==================== ANNOUNCEMENT MANAGEMENT ====================

    public function announcements($courseId)
    {
        $course = Course::findOrFail($courseId);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->route('faculty.courses')->with('error', 'Unauthorized');
        }
        
        $announcements = Announcement::where('course_id', $courseId)
            ->with('faculty')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('faculty.announcements', compact('course', 'announcements'));
    }

    public function storeAnnouncement(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);
        
        if ($course->faculty_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        
        $announcement = Announcement::create([
            'course_id' => $courseId,
            'faculty_id' => Auth::id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        // Add this log
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Posted announcement: {$validated['title']} for course: {$course->code}",
            'metadata' => json_encode(['ip' => request()->ip(), 'announcement_id' => $announcement->id]),
        ]);
        
        // Create notification for all enrolled students
        $students = Enrollment::where('course_id', $courseId)->get();
        foreach ($students as $enrollment) {
            Notification::create([
                'user_id' => $enrollment->student_id,
                'type' => 'announcement',
                'title' => 'New Announcement: ' . $validated['title'],
                'message' => $validated['content'],
                'link' => route('student.course.details', $courseId),
                'is_read' => false,
            ]);
        }
        
        return redirect()->route('faculty.announcements', $courseId)
            ->with('success', 'Announcement posted successfully!');
    }

    public function editAnnouncement($id)
    {
        $announcement = Announcement::with('course')->findOrFail($id);
        
        if ($announcement->course->faculty_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        return view('faculty.edit-announcement', compact('announcement'));
    }

    public function updateAnnouncement(Request $request, $id)
    {
        $announcement = Announcement::with('course')->findOrFail($id);
        
        if ($announcement->course->faculty_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        
        $announcement->update($validated);
        
        return redirect()->route('faculty.announcements', $announcement->course_id)
            ->with('success', 'Announcement updated successfully!');
    }

    public function deleteAnnouncement($id)
    {
        $announcement = Announcement::with('course')->findOrFail($id);
        
        if ($announcement->course->faculty_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $announcement->delete();
        
        return redirect()->back()->with('success', 'Announcement deleted successfully!');
    }

    // ==================== QUIZ DATA FOR COURSE ====================

    public function getCourseQuizzes($courseId)
    {
        $course = Course::findOrFail($courseId);
        
        if ($course->faculty_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        $quizzes = Quiz::where('course_id', $courseId)
            ->withCount('questions')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return response()->json([
            'success' => true,
            'quizzes' => $quizzes
        ]);
    }
}