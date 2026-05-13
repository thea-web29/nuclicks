<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\AdminController;

// Public routes
Route::get('/', function () {
    return view('landing');
});

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Student routes
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/courses', [StudentController::class, 'courses'])->name('courses');
    Route::get('/course/{id}', [StudentController::class, 'courseDetails'])->name('course.details');
    Route::post('/course/join', [StudentController::class, 'joinCourse'])->name('course.join');
    Route::delete('/course/{id}/leave', [StudentController::class, 'leaveCourse'])->name('course.leave');
    Route::get('/quiz/{id}/take', [StudentController::class, 'takeQuiz'])->name('quiz.take');
    Route::post('/quiz/{id}/submit', [StudentController::class, 'submitQuiz'])->name('quiz.submit');
    Route::get('/quiz/results/{attemptId}', [StudentController::class, 'quizResults'])->name('quiz.results');

        // Phase 8: Progress Tracking
    Route::get('/progress', [StudentController::class, 'progress'])->name('progress');
    Route::post('/materials/{materialId}/complete', [StudentController::class, 'markMaterialCompleted'])->name('material.complete');
    
    // Phase 9: Notifications & Announcements
    Route::get('/announcements', [StudentController::class, 'announcements'])->name('announcements');
    Route::get('/notifications', [StudentController::class, 'notifications'])->name('notifications');
    Route::post('/notifications/{id}/read', [StudentController::class, 'markNotificationRead'])->name('notification.read');
    Route::post('/notifications/mark-all-read', [StudentController::class, 'markAllNotificationsRead'])->name('notifications.mark-all-read');

    // Faculty Evaluation
    Route::get('/faculty-evaluation', [StudentController::class, 'facultyEvaluation'])->name('faculty.evaluation');

    // Profile Routes
    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    Route::put('/profile', [StudentController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/avatar', [StudentController::class, 'updateAvatar'])->name('avatar.update');
    Route::put('/profile/password', [StudentController::class, 'changePassword'])->name('password.change');

    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    Route::put('/profile', [StudentController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/avatar', [StudentController::class, 'updateAvatar'])->name('avatar.update');
    Route::put('/profile/password', [StudentController::class, 'changePassword'])->name('password.change');

    });

// Faculty routes - COMPLETE AND ORGANIZED
Route::middleware(['auth'])->prefix('faculty')->name('faculty.')->group(function () {
    
    // ==================== DASHBOARD ====================
    Route::get('/dashboard', [FacultyController::class, 'dashboard'])->name('dashboard');
    
    // ==================== STUDENT MANAGEMENT ====================
    Route::get('/students', [FacultyController::class, 'students'])->name('students');
    Route::get('/students/{id}', [FacultyController::class, 'studentDetails'])->name('student.details');
    Route::post('/students/enroll', [FacultyController::class, 'enrollStudent'])->name('student.enroll');
    Route::delete('/students/{enrollmentId}/remove', [FacultyController::class, 'removeStudent'])->name('student.remove');
    Route::get('/search-students', [FacultyController::class, 'searchStudents'])->name('students.search');
    
    // ==================== COURSE MANAGEMENT ====================
    Route::get('/courses', [FacultyController::class, 'courses'])->name('courses');
    Route::get('/courses/create', [FacultyController::class, 'createCourse'])->name('create.course');
    Route::post('/courses', [FacultyController::class, 'storeCourse'])->name('store.course');
    Route::get('/courses/{id}/edit', [FacultyController::class, 'editCourse'])->name('edit.course');
    Route::put('/courses/{id}', [FacultyController::class, 'updateCourse'])->name('update.course');
    Route::delete('/courses/{id}', [FacultyController::class, 'deleteCourse'])->name('delete.course');
    Route::get('/courses/{id}', [FacultyController::class, 'courseDetails'])->name('course.details');
    
    // ==================== MATERIALS MANAGEMENT ====================
    Route::get('/courses/{courseId}/materials', [FacultyController::class, 'materials'])->name('materials');
    Route::post('/courses/{courseId}/materials', [FacultyController::class, 'uploadMaterial'])->name('upload.material');
    Route::delete('/materials/{id}', [FacultyController::class, 'deleteMaterial'])->name('material.delete');
    Route::get('/materials/{id}/download', [FacultyController::class, 'downloadMaterial'])->name('material.download');
    
    // ==================== QUIZ MANAGEMENT ====================
    // Create quiz pages
    Route::get('/quiz/create', [FacultyController::class, 'createQuizPage'])->name('quiz.create');
    Route::get('/quiz/create/for-course/{courseId}', [FacultyController::class, 'createQuizForCourse'])->name('quiz.create.for.course');
    
    // List all quizzes
    Route::get('/quizzes', [FacultyController::class, 'quizzesList'])->name('quizzes.list');
    
    // Course-specific quizzes
    Route::get('/courses/{courseId}/quizzes', [FacultyController::class, 'quizzes'])->name('quizzes');
    Route::get('/courses/{courseId}/quizzes/create', [FacultyController::class, 'createQuiz'])->name('create.quiz');
    
    // Quiz CRUD
    Route::post('/quizzes', [FacultyController::class, 'storeQuiz'])->name('store.quiz');
    Route::get('/quizzes/{id}/edit', [FacultyController::class, 'editQuiz'])->name('edit.quiz');
    Route::put('/quizzes/{id}', [FacultyController::class, 'updateQuiz'])->name('update.quiz');
    Route::delete('/quizzes/{id}', [FacultyController::class, 'deleteQuiz'])->name('delete.quiz');
    
    // ==================== QUESTION MANAGEMENT ====================
    // Question Bank Routes
    Route::get('/question-bank', [FacultyController::class, 'questionBank'])->name('question.bank');
    
    // Question Bank AJAX Routes (for modal editing)
    Route::post('/questions', [FacultyController::class, 'storeQuestionBank'])->name('store.question.bank');
    Route::get('/questions/{id}/edit-data', [FacultyController::class, 'getQuestionData'])->name('question.edit-data');
    Route::put('/questions/{id}', [FacultyController::class, 'updateQuestionBank'])->name('update.question.bank');
    Route::delete('/questions/{id}', [FacultyController::class, 'deleteQuestion'])->name('delete.question');
    
    // Quiz-specific question routes
    Route::get('/quizzes/{quiz}/question-bank', [FacultyController::class, 'getQuestionBank'])->name('quiz.question-bank');
    Route::post('/quizzes/{quiz}/add-questions', [FacultyController::class, 'addQuestionsToQuiz'])->name('quiz.add-questions');
    Route::get('/quizzes/{quizId}/questions/create', [FacultyController::class, 'addQuestion'])->name('add.question');
    Route::post('/quizzes/{quizId}/questions', [FacultyController::class, 'storeQuestion'])->name('store.question');
    
    // ==================== GRADING & SUBMISSIONS ====================
    Route::get('/grading', [FacultyController::class, 'gradingDashboard'])->name('grading');
    Route::get('/quizzes/{quizId}/submissions', [FacultyController::class, 'submissions'])->name('submissions');
    Route::get('/attempts/{attemptId}/grade', [FacultyController::class, 'gradeSubmission'])->name('grade.submission');
    Route::put('/attempts/{attemptId}', [FacultyController::class, 'updateGrade'])->name('update.grade');
    
    // ==================== RESULTS & ANALYTICS ====================
    Route::get('/results', [FacultyController::class, 'resultsIndex'])->name('results.index');
    Route::get('/courses/{courseId}/results', [FacultyController::class, 'results'])->name('results');
    Route::get('/courses/{courseId}/download-results', [FacultyController::class, 'downloadResults'])->name('download.results');

    // ==================== SUBMISSION DETAILS ====================
    Route::get('/attempts/{attemptId}/details', [FacultyController::class, 'getAttemptDetails'])->name('attempt.details');

    // ==================== STUDENT DETAILS ====================
    Route::get('/students/{id}/details', [FacultyController::class, 'getStudentDetails'])->name('student.details');

    // ==================== COURSE CODE ====================
    Route::put('/courses/{id}/regenerate-code', [FacultyController::class, 'regenerateCourseCode'])->name('course.regenerate-code');

    // ==================== ANNOUNCEMENT MANAGEMENT ====================
    Route::get('/courses/{courseId}/announcements', [FacultyController::class, 'announcements'])->name('announcements');
    Route::post('/courses/{courseId}/announcements', [FacultyController::class, 'storeAnnouncement'])->name('announcement.store');
    Route::get('/announcements/{id}/edit', [FacultyController::class, 'editAnnouncement'])->name('announcement.edit');
    Route::put('/announcements/{id}', [FacultyController::class, 'updateAnnouncement'])->name('announcement.update');
    Route::delete('/announcements/{id}', [FacultyController::class, 'deleteAnnouncement'])->name('announcement.delete');
    Route::get('/courses/{courseId}/quizzes-data', [FacultyController::class, 'getCourseQuizzes'])->name('course.quizzes-data');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{id}', [AdminController::class, 'showUser'])->name('users.show');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::post('/users/{id}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('users.toggle-status');
    Route::get('/students/{id}', [AdminController::class, 'studentDetails'])->name('students.details');
    Route::get('/faculty/{id}', [AdminController::class, 'facultyDetails'])->name('faculty.details');
    Route::post('/faculty/{id}/assign-courses', [AdminController::class, 'assignCourses'])->name('faculty.assign-courses');
    Route::get('/courses', [AdminController::class, 'courses'])->name('courses');
    Route::get('/quizzes', [AdminController::class, 'quizzes'])->name('quizzes');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
    Route::get('/logs', [AdminController::class, 'logs'])->name('logs');
    Route::get('/courses/{id}', [AdminController::class, 'showCourse'])->name('courses.show');
    Route::get('/courses/{id}/edit-data', [AdminController::class, 'getCourseData'])->name('courses.edit-data');

    // Add these to your admin routes group
    Route::get('/quizzes', [AdminController::class, 'quizzes'])->name('quizzes');
    Route::get('/quizzes/{id}', [AdminController::class, 'showQuiz'])->name('quizzes.show');
    Route::get('/quizzes/{id}/edit', [AdminController::class, 'editQuiz'])->name('quizzes.edit');
    Route::put('/quizzes/{id}', [AdminController::class, 'updateQuiz'])->name('quizzes.update');
    Route::delete('/quizzes/{id}', [AdminController::class, 'deleteQuiz'])->name('quizzes.delete');
    Route::get('/quizzes/{id}/edit-data', [AdminController::class, 'getQuizData'])->name('quizzes.edit-data');

    // Add these to your admin routes group
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
    Route::get('/export-results', [AdminController::class, 'exportResults'])->name('export.results');

    // Add these to your admin routes group
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');

    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');

    // Add these to your admin routes group
    Route::get('/security', [AdminController::class, 'security'])->name('security');
    Route::get('/security/clear-logs', [AdminController::class, 'clearLogs'])->name('security.clear-logs');

    
    
});