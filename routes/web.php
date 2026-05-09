<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\AdminController;

// ──────────────────────────────────────────────────────────────
// PUBLIC
// ──────────────────────────────────────────────────────────────

Route::get('/', fn() => view('landing'));

// Auth
Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register',  [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ──────────────────────────────────────────────────────────────
// OTP PASSWORD CHANGE (no auth required — user just logged out)
// ──────────────────────────────────────────────────────────────

Route::get('/change-password',        [PasswordChangeController::class, 'showForm'])
    ->name('password.change.form');
Route::post('/change-password',       [PasswordChangeController::class, 'update'])
    ->name('password.change.update');
Route::get('/change-password/resend', [PasswordChangeController::class, 'resend'])
    ->name('password.change.resend');

// ──────────────────────────────────────────────────────────────
// STUDENT ROUTES
// ──────────────────────────────────────────────────────────────

Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard',                            [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/courses',                              [StudentController::class, 'courses'])->name('courses');
    Route::get('/course/{id}',                          [StudentController::class, 'courseDetails'])->name('course.details');
    Route::post('/course/join',                         [StudentController::class, 'joinCourse'])->name('course.join');
    Route::delete('/course/{id}/leave',                 [StudentController::class, 'leaveCourse'])->name('course.leave');
    Route::get('/quiz/{id}/take',                       [StudentController::class, 'takeQuiz'])->name('quiz.take');
    Route::post('/quiz/{id}/submit',                    [StudentController::class, 'submitQuiz'])->name('quiz.submit');
    Route::get('/quiz/results/{attemptId}',             [StudentController::class, 'quizResults'])->name('quiz.results');
    Route::get('/progress',                             [StudentController::class, 'progress'])->name('progress');
    Route::post('/materials/{materialId}/complete',     [StudentController::class, 'markMaterialCompleted'])->name('material.complete');
    Route::get('/announcements',                        [StudentController::class, 'announcements'])->name('announcements');
    Route::get('/notifications',                        [StudentController::class, 'notifications'])->name('notifications');
    Route::post('/notifications/{id}/read',             [StudentController::class, 'markNotificationRead'])->name('notification.read');
    Route::post('/notifications/mark-all-read',         [StudentController::class, 'markAllNotificationsRead'])->name('notifications.mark-all-read');
    Route::get('/profile',                              [StudentController::class, 'profile'])->name('profile');
    Route::put('/profile',                              [StudentController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/avatar',                      [StudentController::class, 'updateAvatar'])->name('avatar.update');
    Route::put('/profile/password',                     [StudentController::class, 'changePassword'])->name('password.change');
});

// ──────────────────────────────────────────────────────────────
// FACULTY ROUTES  (course creation removed — admin only now)
// ──────────────────────────────────────────────────────────────

Route::middleware(['auth'])->prefix('faculty')->name('faculty.')->group(function () {

    Route::get('/dashboard', [FacultyController::class, 'dashboard'])->name('dashboard');

    // Students
    Route::get('/students',                         [FacultyController::class, 'students'])->name('students');
    Route::get('/students/{id}',                    [FacultyController::class, 'studentDetails'])->name('student.details');
    Route::post('/students/enroll',                 [FacultyController::class, 'enrollStudent'])->name('student.enroll');
    Route::delete('/students/{enrollmentId}/remove',[FacultyController::class, 'removeStudent'])->name('student.remove');
    Route::get('/search-students',                  [FacultyController::class, 'searchStudents'])->name('students.search');
    Route::post('/students/message',                [FacultyController::class, 'sendMessage'])->name('students.message');

    // Courses
    Route::get('/courses',                          [FacultyController::class, 'courses'])->name('courses');
    Route::get('/courses/create',                   [FacultyController::class, 'createCourse'])->name('create.course');
    Route::post('/courses',                         [FacultyController::class, 'storeCourse'])->name('store.course');
    Route::get('/courses/{id}',                     [FacultyController::class, 'courseDetails'])->name('course.details');
    Route::get('/courses/{id}/edit',                [FacultyController::class, 'editCourse'])->name('edit.course');
    Route::put('/courses/{id}',                     [FacultyController::class, 'updateCourse'])->name('update.course');
    Route::delete('/courses/{id}',                  [FacultyController::class, 'deleteCourse'])->name('delete.course');
    Route::post('/courses/{id}/add-students',       [FacultyController::class, 'addEligibleStudentsToClass'])->name('course.add-students');
    Route::post('/courses/{id}/add-eligible-students', [FacultyController::class, 'addEligibleStudentsToClass'])->name('course.add-eligible-students');

    // Generate / resend join code (emails all eligible students)
    Route::put('/courses/{id}/generate-code',       [FacultyController::class, 'generateCourseCode'])->name('course.generate-code');

    // Materials
    Route::get('/courses/{courseId}/materials',     [FacultyController::class, 'materials'])->name('materials');
    Route::post('/courses/{courseId}/materials',    [FacultyController::class, 'uploadMaterial'])->name('upload.material');
    Route::delete('/materials/{id}',                [FacultyController::class, 'deleteMaterial'])->name('material.delete');
    Route::get('/materials/{id}/download',          [FacultyController::class, 'downloadMaterial'])->name('material.download');

    // Quizzes
    Route::get('/quiz/create',                           [FacultyController::class, 'createQuizPage'])->name('quiz.create');
    Route::get('/quiz/create/for-course/{courseId}',     [FacultyController::class, 'createQuizForCourse'])->name('quiz.create.for.course');
    Route::get('/quizzes',                               [FacultyController::class, 'quizzesList'])->name('quizzes.list');
    Route::get('/courses/{courseId}/quizzes',            [FacultyController::class, 'quizzes'])->name('quizzes');
    Route::get('/courses/{courseId}/quizzes/create',     [FacultyController::class, 'createQuiz'])->name('create.quiz');
    Route::post('/quizzes',                              [FacultyController::class, 'storeQuiz'])->name('store.quiz');
    Route::get('/quizzes/{id}/edit',                     [FacultyController::class, 'editQuiz'])->name('edit.quiz');
    Route::put('/quizzes/{id}',                          [FacultyController::class, 'updateQuiz'])->name('update.quiz');
    Route::delete('/quizzes/{id}',                       [FacultyController::class, 'deleteQuiz'])->name('delete.quiz');

    // Questions
    Route::get('/question-bank',                         [FacultyController::class, 'questionBank'])->name('question.bank');
    Route::post('/questions',                            [FacultyController::class, 'storeQuestionBank'])->name('store.question.bank');
    Route::get('/questions/{id}/edit-data',              [FacultyController::class, 'getQuestionData'])->name('question.edit-data');
    Route::get('/questions/{id}/edit',                   [FacultyController::class, 'editQuestion'])->name('edit.question');
    Route::put('/questions/{id}',                        [FacultyController::class, 'updateQuestionBank'])->name('update.question.bank');
    Route::put('/questions/{id}/update',                 [FacultyController::class, 'updateQuestion'])->name('update.question');
    Route::delete('/questions/{id}',                     [FacultyController::class, 'deleteQuestion'])->name('delete.question');
    Route::get('/quizzes/{quiz}/question-bank',          [FacultyController::class, 'getQuestionBank'])->name('quiz.question-bank');
    Route::post('/quizzes/{quiz}/add-questions',         [FacultyController::class, 'addQuestionsToQuiz'])->name('quiz.add-questions');
    Route::get('/quizzes/{quizId}/questions/create',     [FacultyController::class, 'addQuestion'])->name('add.question');
    Route::post('/quizzes/{quizId}/questions',           [FacultyController::class, 'storeQuestion'])->name('store.question');

    // Grading
    Route::get('/grading',                               [FacultyController::class, 'gradingDashboard'])->name('grading');
    Route::get('/quizzes/{quizId}/submissions',          [FacultyController::class, 'submissions'])->name('submissions');
    Route::get('/attempts/{attemptId}/grade',            [FacultyController::class, 'gradeSubmission'])->name('grade.submission');
    Route::put('/attempts/{attemptId}',                  [FacultyController::class, 'updateGrade'])->name('update.grade');

    // Results
    Route::get('/results',                               [FacultyController::class, 'resultsIndex'])->name('results.index');
    Route::get('/courses/{courseId}/results',            [FacultyController::class, 'results'])->name('results');
    Route::get('/courses/{courseId}/download-results',   [FacultyController::class, 'downloadResults'])->name('download.results');

    // Misc
    Route::get('/attempts/{attemptId}/details',          [FacultyController::class, 'getAttemptDetails'])->name('attempt.details');
    Route::get('/students/{id}/details',                 [FacultyController::class, 'getStudentDetails'])->name('student.details');
    Route::get('/courses/{courseId}/quizzes-data',       [FacultyController::class, 'getCourseQuizzes'])->name('course.quizzes-data');

    // Announcements
    Route::get('/courses/{courseId}/announcements',      [FacultyController::class, 'announcements'])->name('announcements');
    Route::post('/courses/{courseId}/announcements',     [FacultyController::class, 'storeAnnouncement'])->name('announcement.store');
    Route::get('/announcements/{id}/edit',               [FacultyController::class, 'editAnnouncement'])->name('announcement.edit');
    Route::put('/announcements/{id}',                    [FacultyController::class, 'updateAnnouncement'])->name('announcement.update');
    Route::delete('/announcements/{id}',                 [FacultyController::class, 'deleteAnnouncement'])->name('announcement.delete');

    // Profile
    Route::get('/profile',                               [FacultyController::class, 'profile'])->name('profile');
    Route::put('/profile',                               [FacultyController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/avatar',                       [FacultyController::class, 'updateAvatar'])->name('avatar.update');

    // Notifications
    Route::get('/notifications',                         [FacultyController::class, 'notifications'])->name('notifications');
    Route::post('/notifications/{id}/read',              [FacultyController::class, 'markNotificationRead'])->name('notification.read');
    Route::post('/notifications/mark-all-read',          [FacultyController::class, 'markAllNotificationsRead'])->name('notifications.mark-all-read');
});

// ──────────────────────────────────────────────────────────────
// ADMIN ROUTES
// ──────────────────────────────────────────────────────────────

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Admin profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/avatar', [AdminController::class, 'updateAvatar'])->name('avatar.update');
    Route::put('/profile/password', [AdminController::class, 'changePassword'])->name('password.change');
    Route::delete('/profile/delete', [AdminController::class, 'deleteAccount'])->name('profile.delete');

    // Users
    Route::get('/users',                        [AdminController::class, 'users'])->name('users');
    Route::get('/users/create',                 [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users',                       [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{id}',                   [AdminController::class, 'showUser'])->name('users.show');
    Route::get('/users/{id}/edit',              [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{id}',                   [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{id}',                [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::post('/users/{id}/toggle-status',    [AdminController::class, 'toggleUserStatus'])->name('users.toggle-status');
    Route::get('/students/{id}',                [AdminController::class, 'studentDetails'])->name('students.details');
    Route::get('/faculty',                      [AdminController::class, 'faculty'])->name('faculty');
    Route::get('/faculty/{id}',                 [AdminController::class, 'facultyDetails'])->name('faculty.details');
    Route::get('/faculty/{id}/data',            [AdminController::class, 'getFacultyData'])->name('faculty.data');
    Route::post('/faculty/{id}/assign-courses', [AdminController::class, 'assignCourses'])->name('faculty.assign-courses');

    // Bulk import
    Route::get('/bulk-import',                  [AdminController::class, 'bulkImport'])->name('bulk-import');
    Route::get('/bulk-import/template',         [AdminController::class, 'downloadTemplate'])->name('bulk-import.template');
    Route::post('/bulk-import',                 [AdminController::class, 'processBulkImport'])->name('bulk-import.process');

    // Programs
    Route::get('/programs',                     [AdminController::class, 'programs'])->name('programs');
    Route::post('/programs',                    [AdminController::class, 'storeProgram'])->name('programs.store');
    Route::put('/programs/{id}',                [AdminController::class, 'updateProgram'])->name('programs.update');
    Route::delete('/programs/{id}',             [AdminController::class, 'deleteProgram'])->name('programs.delete');
    Route::get('/programs/{id}/data',           [AdminController::class, 'getProgramData'])->name('programs.data');

    // Departments
    Route::get('/departments',                  [AdminController::class, 'departments'])->name('departments');
    Route::post('/departments',                 [AdminController::class, 'storeDepartment'])->name('departments.store');
    Route::put('/departments/{id}',             [AdminController::class, 'updateDepartment'])->name('departments.update');
    Route::delete('/departments/{id}',          [AdminController::class, 'deleteDepartment'])->name('departments.delete');
    Route::get('/departments/{id}/data',        [AdminController::class, 'getDepartmentData'])->name('departments.data');

    // Subjects page (same backend as courses — separate view)
    Route::get('/subjects',                     [AdminController::class, 'subjects'])->name('subjects');

    // Courses (Subjects backend) — admin-only CRUD
    Route::post('/courses',                     [AdminController::class, 'storeCourse'])->name('courses.store');
    Route::put('/courses/{id}',                 [AdminController::class, 'updateCourse'])->name('courses.update');
    Route::delete('/courses/{id}',              [AdminController::class, 'deleteCourse'])->name('courses.delete');
    Route::get('/courses/{id}/edit-data',       [AdminController::class, 'getCourseData'])->name('courses.edit-data');
    Route::get('/courses/{id}',                 [AdminController::class, 'showCourse'])->name('courses.show');
    Route::get('/courses',                      [AdminController::class, 'courses'])->name('courses');

    // Quizzes are intentionally not routed in the admin portal. They remain under Faculty and Student portals.

    // Analytics & export
    Route::get('/analytics',                    [AdminController::class, 'analytics'])->name('analytics');
    Route::get('/export-results',               [AdminController::class, 'exportResults'])->name('export.results');

    // Faculty evaluation
    Route::get('/faculty-evaluations', [AdminController::class, 'facultyEvaluations'])->name('faculty-evaluations');

    // Folder & files
    Route::get('/folder-files', [AdminController::class, 'folderFiles'])->name('folder-files');
    Route::post('/folder-files/folders', [AdminController::class, 'storeFolder'])->name('folder-files.folders.store');
    Route::post('/folder-files/folder', [AdminController::class, 'storeFolder'])->name('folder-files.folder.store');
    Route::post('/folder-files/upload', [AdminController::class, 'uploadAdminFile'])->name('folder-files.upload');
    Route::get('/folder-files/{id}/download', [AdminController::class, 'download'])->name('folder-files.download');
    Route::patch('/folder-files/{file}/archive', [AdminController::class, 'archiveAdminFile'])->name('folder-files.archive');
    Route::put('/folder-files/{id}', [AdminController::class, 'update'])->name('folder-files.update');
    Route::delete('/folder-files/{id}', [AdminController::class, 'delete'])->name('folder-files.delete');

    // Settings & security
    Route::get('/settings',                     [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings',                    [AdminController::class, 'updateSettings'])->name('settings.update');
    Route::get('/security',                     [AdminController::class, 'security'])->name('security');
    Route::get('/security/clear-logs',          [AdminController::class, 'clearLogs'])->name('security.clear-logs');
    Route::get('/logs',                         [AdminController::class, 'logs'])->name('logs');

    // Admin Notifications
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
    Route::post('/notifications/{id}/read', [AdminController::class, 'markNotificationRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [AdminController::class, 'markAllNotificationsRead'])->name('notifications.mark-all-read');
});