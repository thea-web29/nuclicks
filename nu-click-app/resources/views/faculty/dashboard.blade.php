<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Faculty Dashboard - Nu Clicks LMS</title>
    <!-- Google Fonts + Font Awesome + Remix Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Tailwind CSS CDN (for utility classes used in dashboard) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom override to ensure Tailwind doesn't conflict with sidebar styles -->
    <script>
        tailwind.config = {
            corePlugins: {
                preflight: false, // prevent global reset conflict with existing styles
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #F5F7FB;
            overflow-x: hidden;
        }

        /* ===== CUSTOM COLOR VARIABLES ===== */
        :root {
            --blue-deep: #0A1F44;
            --gold: #FFD70F;
            --gold-dark: #e5c20c;
            --gray-light: #F8FAFF;
            --gray-border: #E9EDF2;
            --card-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            --transition: all 0.25s ease;
            --danger-red: #dc2626;
            --danger-dark: #b91c1c;
        }

        /* Sidebar styles */
        .sidebar {
            background-color: var(--blue-deep);
            width: 280px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            z-index: 40;
            transition: transform 0.3s ease;
            transform: translateX(0);
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08);
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0 !important;
            }
        }

        .sidebar-logo {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 215, 15, 0.2);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .sidebar-logo-img {
            height: 45px;
            width: auto;
        }
        .logo-text h1 {
            font-size: 1.3rem;
            font-weight: 800;
            color: white;
            letter-spacing: -0.3px;
        }
        .logo-text span {
            color: var(--gold);
        }
        .logo-text p {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.7);
        }

        .nav-section {
            padding: 0 1rem;
            margin-top: 1.5rem;
        }
        .nav-section-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,215,15,0.6);
            margin-bottom: 0.75rem;
            font-weight: 600;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 1rem;
            border-radius: 12px;
            color: rgba(255,255,255,0.85);
            transition: var(--transition);
            margin-bottom: 0.25rem;
            font-weight: 500;
        }
        .nav-item i {
            font-size: 1.2rem;
            width: 1.5rem;
        }
        .nav-item:hover {
            background: rgba(255,215,15,0.15);
            color: white;
        }
        .nav-item.active {
            background: var(--gold);
            color: var(--blue-deep);
        }
        .nav-item.active i {
            color: var(--blue-deep);
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 1.2rem;
            border-top: 1px solid rgba(255,215,15,0.2);
        }
        .profile-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }
        .avatar {
            width: 42px;
            height: 42px;
            background: rgba(255,215,15,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
        }
        .profile-details p {
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
        }
        .profile-details span {
            color: rgba(255,255,255,0.6);
            font-size: 0.7rem;
        }
        
        /* ===== RED LOGOUT BUTTON (SIDEBAR) ===== */
        .logout-btn {
            width: 100%;
            background: rgba(220, 38, 38, 0.15);
            border: none;
            padding: 0.6rem;
            border-radius: 40px;
            color: #fca5a5;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: var(--transition);
        }
        .logout-btn:hover {
            background: var(--danger-red);
            color: white;
            box-shadow: 0 4px 10px rgba(220, 38, 38, 0.3);
        }
        .logout-btn i {
            font-size: 1.1rem;
        }

        /* Main content */
        .main-content {
            margin-left: 280px;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
        }
        .top-bar {
            background: white;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            border-bottom: 1px solid var(--gray-border);
            position: sticky;
            top: 0;
            z-index: 20;
        }
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--blue-deep);
        }
        .page-title {
            font-weight: 700;
            color: var(--blue-deep);
        }
        @media (max-width: 1024px) {
            .menu-toggle {
                display: block;
            }
            .main-content {
                margin-left: 0;
            }
        }

        /* Enhanced Dashboard Component Styles */
        .stat-card {
            background: white;
            border-radius: 1.2rem;
            padding: 1.2rem;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            border: 1px solid rgba(0,0,0,0.03);
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(10,31,68,0.1);
        }
        .gold-accent {
            border-left: 4px solid var(--gold);
        }
        .badge-gold {
            background: rgba(255,215,15,0.2);
            color: #856404;
            padding: 0.25rem 0.7rem;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        .course-card {
            border-radius: 1rem;
            transition: var(--transition);
            background: white;
        }
        .course-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.08);
        }
        
        .dashboard-section {
            margin-bottom: 2rem;
        }
        .section-title {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--blue-deep);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .section-title i {
            color: var(--gold);
            font-size: 1.4rem;
        }
        .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            background: #F9FAFE;
            border-radius: 1.2rem;
            color: #6c757d;
        }
        .recent-item {
            transition: background 0.2s ease;
            border-radius: 0.75rem;
        }
        .recent-item:hover {
            background: #F8FAFF;
        }

        /* ===== MODAL STYLES (THEMED: gold/blue, only confirm button red) ===== */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(10, 31, 68, 0.75);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0.2s, opacity 0.2s ease;
        }
        .modal-overlay.active {
            visibility: visible;
            opacity: 1;
        }
        .confirmation-modal {
            background: white;
            max-width: 450px;
            width: 90%;
            border-radius: 1.5rem;
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transform: scale(0.95);
            transition: transform 0.2s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }
        .modal-overlay.active .confirmation-modal {
            transform: scale(1);
        }
        /* Modal header uses theme: blue-deep background + gold border-bottom */
        .modal-header {
            background: var(--blue-deep);
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid var(--gold);
        }
        .modal-header h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .modal-header h3 i {
            color: var(--gold);
            font-size: 1.4rem;
        }
        .modal-close {
            background: none;
            border: none;
            color: rgba(255,255,255,0.7);
            font-size: 1.6rem;
            cursor: pointer;
            transition: color 0.2s;
            line-height: 1;
            padding: 0;
        }
        .modal-close:hover {
            color: var(--gold);
        }
        .modal-body {
            padding: 1.8rem 1.5rem;
            background: white;
            text-align: center;
        }
        .modal-body p {
            font-size: 1rem;
            color: #1f2937;
            font-weight: 500;
            margin-bottom: 0;
        }
        .modal-footer {
            padding: 1rem 1.5rem 1.5rem 1.5rem;
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            background: #f9fafb;
            border-top: 1px solid var(--gray-border);
        }
        .modal-btn {
            padding: 0.6rem 1.25rem;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            font-family: 'Inter', sans-serif;
        }
        .modal-btn-cancel {
            background: #eef2ff;
            color: #1e293b;
        }
        .modal-btn-cancel:hover {
            background: #e2e8f0;
            transform: translateY(-1px);
        }
        /* Only the confirm button is red */
        .modal-btn-confirm {
            background: var(--danger-red);
            color: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .modal-btn-confirm:hover {
            background: var(--danger-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(220, 38, 38, 0.2);
        }
        @media (max-width: 500px) {
            .modal-footer {
                flex-direction: column-reverse;
            }
            .modal-btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <img src="/logo/NatU.png" alt="NU Logo" class="sidebar-logo-img">
        <div class="logo-text">
            <h1>NU <span>CLICKS</span> LMS</h1>
            <p>Faculty Portal</p>
        </div>
    </div>

    <div style="flex:1; overflow-y: auto;">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>
            <a href="{{ route('faculty.dashboard') }}" class="nav-item {{ request()->routeIs('faculty.dashboard') ? 'active' : '' }}">
                <i class="ri-dashboard-line"></i> Dashboard
            </a>
            <a href="{{ route('faculty.students') }}" class="nav-item {{ request()->routeIs('faculty.students*') ? 'active' : '' }}">
                <i class="ri-user-line"></i> Students
            </a>
            <a href="{{ route('faculty.courses') }}" class="nav-item {{ request()->routeIs('faculty.courses*') ? 'active' : '' }}">
                <i class="ri-book-line"></i> Courses
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Quiz Management</div>
            <a href="{{ route('faculty.quiz.create') }}" class="nav-item {{ request()->routeIs('faculty.quiz.create*') ? 'active' : '' }}">
               <i class="ri-add-circle-line"></i> Create Quiz
            </a>
            <a href="{{ route('faculty.quizzes.list') }}" class="nav-item {{ request()->routeIs('faculty.quizzes.list*') ? 'active' : '' }}">
                <i class="ri-list-check"></i> All Quizzes
            </a>
            <a href="{{ route('faculty.question.bank') }}" class="nav-item {{ request()->routeIs('faculty.question.bank*') ? 'active' : '' }}">
                <i class="ri-database-2-line"></i> Question Bank
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Analytics</div>
            <a href="{{ route('faculty.results.index') }}" class="nav-item {{ request()->routeIs('faculty.results*') ? 'active' : '' }}">
                <i class="ri-bar-chart-line"></i> Results & Analytics
            </a>
            <a href="{{ route('faculty.grading') }}" class="nav-item {{ request()->routeIs('faculty.grading*') ? 'active' : '' }}">
                <i class="ri-graduation-cap-line"></i> Grading
            </a>
        </div>
    </div>

    <div class="sidebar-footer">
        <div class="profile-info">
            <div class="avatar">
                <i class="ri-user-line"></i>
            </div>
            <div class="profile-details">
                <p>{{ Auth::user()->name }}</p>
                <span>{{ Auth::user()->email }}</span>
            </div>
        </div>
        <!-- Logout form with full account logout -->
        <form method="POST" action="{{ route('logout') }}" id="logoutForm">
            @csrf
            <button type="button" id="logoutButton" class="logout-btn">
                <i class="ri-logout-box-r-line"></i> Sign Out of Account
            </button>
        </form>
    </div>
</aside>

<!-- Main Content -->
<div class="main-content" id="mainContent">
    <div class="top-bar">
        <button class="menu-toggle" id="menuToggle">
            <i class="ri-menu-line"></i>
        </button>
        <h2 class="page-title text-lg md:text-xl">Dashboard</h2>
        <div class="w-8"></div>
    </div>

    <div class="p-4 md:p-6">
        <!-- Key Metrics Cards -->
        <div class="dashboard-section">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="stat-card flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Students</p>
                        <p class="text-3xl font-extrabold text-gray-800">{{ $totalStudents ?? 0 }}</p>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-full">
                        <i class="ri-user-line text-blue-600 text-2xl"></i>
                    </div>
                </div>
                <div class="stat-card flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Courses</p>
                        <p class="text-3xl font-extrabold text-gray-800">{{ $totalCourses ?? 0 }}</p>
                    </div>
                    <div class="bg-green-50 p-3 rounded-full">
                        <i class="ri-book-line text-green-600 text-2xl"></i>
                    </div>
                </div>
                <div class="stat-card flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Quizzes</p>
                        <p class="text-3xl font-extrabold text-gray-800">{{ $totalQuizzes ?? 0 }}</p>
                    </div>
                    <div class="bg-purple-50 p-3 rounded-full">
                        <i class="ri-quiz-line text-purple-600 text-2xl"></i>
                    </div>
                </div>
                <div class="stat-card flex items-center justify-between gold-accent">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Avg. Score</p>
                        <p class="text-3xl font-extrabold text-gray-800">{{ $avgScore ?? 0 }}%</p>
                    </div>
                    <div class="bg-yellow-50 p-3 rounded-full">
                        <i class="ri-percent-line text-yellow-600 text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="dashboard-section">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gradient-to-r from-white to-gray-50/30">
                        <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                            <i class="ri-user-add-line text-xl" style="color:var(--gold)"></i> 
                            Recent Enrollments
                        </h3>
                        <span class="text-xs text-gray-400 bg-gray-100 px-2 py-1 rounded-full">Latest activity</span>
                    </div>
                    <div class="p-5">
                        @if(isset($recentEnrollments) && $recentEnrollments->count() > 0)
                            <div class="space-y-2">
                                @foreach($recentEnrollments as $enrollment)
                                    <div class="recent-item flex items-center justify-between py-3 px-2 border-b border-gray-50 last:border-0">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700">
                                                <i class="ri-user-smile-line text-sm"></i>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800">{{ $enrollment->student->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $enrollment->course->name }}</p>
                                            </div>
                                        </div>
                                        <span class="text-xs text-green-700 bg-green-50 px-2 py-1 rounded-full">{{ $enrollment->created_at->diffForHumans() }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state py-8">
                                <i class="ri-user-add-line text-3xl text-gray-300"></i>
                                <p class="mt-2 text-gray-400">No recent enrollments yet</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gradient-to-r from-white to-gray-50/30">
                        <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                            <i class="ri-quiz-line text-xl" style="color:var(--gold)"></i> 
                            Recent Quizzes
                        </h3>
                        <a href="{{ route('faculty.quizzes.list') }}" class="text-sm font-medium flex items-center gap-1 hover:underline" style="color:var(--blue-deep)">
                            View All <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                    <div class="p-5">
                        @if(isset($recentQuizzes) && $recentQuizzes->count() > 0)
                            <div class="space-y-3">
                                @foreach($recentQuizzes as $quiz)
                                    <div class="recent-item p-3 border border-gray-100 rounded-xl hover:border-gold/20">
                                        <div class="flex flex-wrap justify-between items-start gap-2">
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2 flex-wrap">
                                                    <p class="font-bold text-gray-800">{{ $quiz->title }}</p>
                                                    <span class="badge-gold text-[10px]">{{ $quiz->course->name ?? 'General' }}</span>
                                                </div>
                                                <div class="flex gap-4 mt-1 text-xs text-gray-400">
                                                    <span><i class="ri-question-line"></i> {{ $quiz->questions->count() }} questions</span>
                                                    @if($quiz->duration_minutes)
                                                        <span><i class="ri-timer-line"></i> {{ $quiz->duration_minutes }} mins</span>
                                                    @endif
                                                    <span><i class="ri-calendar-line"></i> {{ $quiz->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                            <div class="flex gap-2">
                                                <a href="{{ route('faculty.edit.quiz', $quiz->id) }}" class="text-yellow-600 hover:text-yellow-800 text-sm bg-yellow-50 px-3 py-1.5 rounded-lg transition flex items-center gap-1">
                                                    <i class="ri-edit-line"></i> <span class="hidden sm:inline">Edit</span>
                                                </a>
                                                <a href="{{ route('faculty.submissions', $quiz->id) }}" class="text-blue-600 hover:text-blue-800 text-sm bg-blue-50 px-3 py-1.5 rounded-lg transition flex items-center gap-1">
                                                    <i class="ri-bar-chart-line"></i> <span class="hidden sm:inline">Results</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="ri-quiz-line text-3xl text-gray-300"></i>
                                <p class="mt-2 text-gray-500">No quizzes created yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- My Courses -->
        <div class="dashboard-section">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center flex-wrap gap-3">
                    <div class="section-title">
                        <i class="ri-book-open-line text-2xl"></i>
                        <span>My Courses</span>
                    </div>
                    @if(isset($courses) && $courses->count() > 0)
                        <a href="{{ route('faculty.courses') }}" class="text-sm font-medium flex items-center gap-1 hover:underline" style="color:var(--blue-deep)">
                            Manage all <i class="ri-arrow-right-line"></i>
                        </a>
                    @endif
                </div>
                <div class="p-5">
                    @if(isset($courses) && $courses->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                            @foreach($courses as $course)
                                <div class="course-card border border-gray-100 p-4 rounded-xl hover:shadow-md transition-all duration-200 bg-white">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-indigo-100 text-indigo-800">{{ $course->code }}</span>
                                            </div>
                                            <h4 class="font-bold text-indigo-900 text-base">{{ $course->name }}</h4>
                                        </div>
                                        <span class="badge-gold flex items-center gap-1">
                                            <i class="ri-group-line text-xs"></i> {{ $course->students_count ?? 0 }} students
                                        </span>
                                    </div>
                                    <div class="mt-3 flex justify-between text-sm text-gray-500 border-t border-gray-50 pt-2">
                                        <span class="flex items-center gap-1"><i class="ri-quiz-line"></i> Quizzes: {{ $course->quizzes->count() ?? 0 }}</span>
                                        <span class="flex items-center gap-1"><i class="ri-file-line"></i> Materials: {{ $course->materials->count() ?? 0 }}</span>
                                    </div>
                                    <div class="mt-5 flex gap-2">
                                        <a href="{{ route('faculty.quiz.create.for.course', $course->id) }}" 
                                           class="flex-1 text-center text-xs font-semibold py-2.5 rounded-lg transition-all duration-200 shadow-sm hover:shadow" 
                                           style="background:#0A1F44; color:white;">
                                            <i class="ri-quiz-line mr-1"></i> Create Quiz
                                        </a>
                                        <a href="{{ route('faculty.course.details', $course->id) }}" 
                                           class="flex-1 text-center text-xs font-semibold py-2.5 rounded-lg border border-gray-300 hover:border-gold transition-all hover:bg-gray-50">
                                            Manage
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state py-10">
                            <i class="ri-book-line text-4xl text-gray-300"></i>
                            <p class="text-gray-500 mt-2 font-medium">No courses assigned yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="text-center text-xs text-gray-400 mt-6 border-t border-gray-100 pt-4">
            <i class="ri-information-line"></i> Faculty dashboard — manage courses, quizzes, and track student performance.
        </div>
    </div>
</div>

<!-- ======================= THEMED CONFIRMATION MODAL (Only confirm button is red) ======================= -->
<div id="logoutModal" class="modal-overlay">
    <div class="confirmation-modal">
        <div class="modal-header">
            <h3>
                <i class="ri-logout-box-r-line"></i> 
                Confirm Sign Out
            </h3>
            <button class="modal-close" id="closeModalBtn">&times;</button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to sign out of your account?</p>
            <p class="text-xs text-gray-500 mt-2">You will be redirected to the main page and will need to log in again.</p>
        </div>
        <div class="modal-footer">
            <button class="modal-btn modal-btn-cancel" id="cancelLogoutBtn">Cancel</button>
            <button class="modal-btn modal-btn-confirm" id="confirmLogoutBtn">Yes, Sign Out</button>
        </div>
    </div>
</div>

<script>
    // Mobile sidebar toggle
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('mobile-open');
        });
    }
    document.addEventListener('click', function(event) {
        const isMobile = window.innerWidth <= 1024;
        if (isMobile && sidebar.classList.contains('mobile-open')) {
            if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                sidebar.classList.remove('mobile-open');
            }
        }
    });

    // Active nav highlighting
    const currentUrl = window.location.pathname;
    document.querySelectorAll('.nav-item').forEach(item => {
        const href = item.getAttribute('href');
        if (href && currentUrl.includes(href) && href !== '/faculty/dashboard') {
            item.classList.add('active');
        } else if (currentUrl === '/faculty/dashboard' && href === '/faculty/dashboard') {
            item.classList.add('active');
        }
    });

    // Logout modal logic (full account logout)
    const logoutButton = document.getElementById('logoutButton');
    const logoutModal = document.getElementById('logoutModal');
    const confirmBtn = document.getElementById('confirmLogoutBtn');
    const cancelBtn = document.getElementById('cancelLogoutBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const logoutForm = document.getElementById('logoutForm');

    function openModal() {
        logoutModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        logoutModal.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (logoutButton) {
        logoutButton.addEventListener('click', (e) => {
            e.preventDefault();
            openModal();
        });
    }
    if (confirmBtn) {
        confirmBtn.addEventListener('click', () => {
            if (logoutForm) {
                logoutForm.submit();
            } else {
                window.location.href = "{{ route('logout') }}";
            }
        });
    }
    if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
    if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
    logoutModal.addEventListener('click', (e) => {
        if (e.target === logoutModal) closeModal();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && logoutModal.classList.contains('active')) closeModal();
    });
</script>
</body>
</html>