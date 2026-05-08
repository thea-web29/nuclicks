<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Course Management - NU Clicks LMS</title>
    <!-- Google Fonts + Font Awesome + Remix Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: { preflight: false },
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

        /* Course card styling */
        .course-card {
            background: white;
            border-radius: 1.2rem;
            transition: var(--transition);
            border: 1px solid rgba(0,0,0,0.03);
            box-shadow: var(--card-shadow);
        }
        .course-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 28px rgba(0, 0, 0, 0.08);
        }
        .badge-gold {
            background: rgba(255,215,15,0.2);
            color: #856404;
            padding: 0.25rem 0.7rem;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        .fixed-dropdown {
            position: fixed;
            min-width: 180px;
            z-index: 50;
        }
        .btn-outline {
            border: 1px solid var(--gray-border);
            transition: var(--transition);
        }
        .btn-outline:hover {
            border-color: var(--gold);
            background-color: #FEFCE8;
        }
        
        /* Enhanced professional modal styles for create course */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(10, 31, 68, 0.6);
            backdrop-filter: blur(5px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1), visibility 0.3s;
        }
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .modal-container {
            background: white;
            max-width: 560px;
            width: 92%;
            border-radius: 1.75rem;
            box-shadow: 0 30px 50px -15px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(255, 215, 15, 0.1);
            transform: scale(0.96) translateY(12px);
            transition: transform 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.2);
            overflow: hidden;
        }
        .modal-overlay.active .modal-container {
            transform: scale(1) translateY(0);
        }
        .modal-header {
            background: linear-gradient(135deg, #0A1F44 0%, #132e5e 100%);
            padding: 1.25rem 1.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--gold);
        }
        .modal-header h3 {
            font-weight: 700;
            font-size: 1.35rem;
            letter-spacing: -0.2px;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            color: white;
        }
        .modal-header h3 i {
            color: var(--gold);
            font-size: 1.6rem;
        }
        .modal-close {
            background: rgba(255,255,255,0.15);
            width: 32px;
            height: 32px;
            border-radius: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            cursor: pointer;
            color: white;
            transition: all 0.2s;
        }
        .modal-close:hover {
            background: var(--gold);
            color: var(--blue-deep);
            transform: rotate(90deg);
        }
        .modal-body {
            padding: 1.75rem 2rem 1.5rem;
            background: #FFFFFF;
        }
        .form-group {
            margin-bottom: 1.35rem;
        }
        .form-label {
            display: block;
            font-weight: 600;
            font-size: 0.85rem;
            color: #1E293B;
            margin-bottom: 0.5rem;
            letter-spacing: -0.2px;
        }
        .form-label span {
            color: #ef4444;
        }
        .form-control {
            width: 100%;
            border: 1.5px solid #E2E8F0;
            border-radius: 0.9rem;
            padding: 0.7rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s;
            background: #FCFDFF;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(255, 215, 15, 0.25);
            background: white;
        }
        textarea.form-control {
            resize: vertical;
            min-height: 90px;
        }
        .modal-footer {
            background: #F8FAFE;
            padding: 1rem 2rem 1.5rem;
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            border-top: 1px solid #EDF2F7;
        }
        .btn-cancel {
            background: transparent;
            border: 1.5px solid #CBD5E1;
            padding: 0.6rem 1.4rem;
            border-radius: 2rem;
            font-weight: 600;
            font-size: 0.85rem;
            color: #475569;
            transition: all 0.2s;
            cursor: pointer;
        }
        .btn-cancel:hover {
            background: #F1F5F9;
            border-color: #94A3B8;
        }
        .btn-submit {
            background: var(--blue-deep);
            border: none;
            padding: 0.6rem 1.8rem;
            border-radius: 2rem;
            font-weight: 700;
            font-size: 0.85rem;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(10,31,68,0.2);
        }
        .btn-submit:hover {
            background: #0F2A5C;
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(10,31,68,0.15);
        }
        .btn-submit i {
            font-size: 1rem;
        }
        .error-feedback {
            font-size: 0.7rem;
            color: #E53E3E;
            margin-top: 0.4rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        /* ===== LOGOUT CONFIRMATION MODAL STYLES (THEMED: gold/blue, red confirm) ===== */
        .logout-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(10, 31, 68, 0.75);
            backdrop-filter: blur(4px);
            z-index: 1100;
            display: flex;
            align-items: center;
            justify-content: center;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0.2s, opacity 0.2s ease;
        }
        .logout-modal-overlay.active {
            visibility: visible;
            opacity: 1;
        }
        .logout-confirmation-modal {
            background: white;
            max-width: 450px;
            width: 90%;
            border-radius: 1.5rem;
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transform: scale(0.95);
            transition: transform 0.2s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }
        .logout-modal-overlay.active .logout-confirmation-modal {
            transform: scale(1);
        }
        .logout-modal-header {
            background: var(--blue-deep);
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid var(--gold);
        }
        .logout-modal-header h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .logout-modal-header h3 i {
            color: var(--gold);
            font-size: 1.4rem;
        }
        .logout-modal-close {
            background: none;
            border: none;
            color: rgba(255,255,255,0.7);
            font-size: 1.6rem;
            cursor: pointer;
            transition: color 0.2s;
            line-height: 1;
            padding: 0;
        }
        .logout-modal-close:hover {
            color: var(--gold);
        }
        .logout-modal-body {
            padding: 1.8rem 1.5rem;
            background: white;
            text-align: center;
        }
        .logout-modal-body p {
            font-size: 1rem;
            color: #1f2937;
            font-weight: 500;
            margin-bottom: 0;
        }
        .logout-modal-footer {
            padding: 1rem 1.5rem 1.5rem 1.5rem;
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            background: #f9fafb;
            border-top: 1px solid var(--gray-border);
        }
        .logout-modal-btn {
            padding: 0.6rem 1.25rem;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            font-family: 'Inter', sans-serif;
        }
        .logout-modal-btn-cancel {
            background: #eef2ff;
            color: #1e293b;
        }
        .logout-modal-btn-cancel:hover {
            background: #e2e8f0;
            transform: translateY(-1px);
        }
        .logout-modal-btn-confirm {
            background: var(--danger-red);
            color: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .logout-modal-btn-confirm:hover {
            background: var(--danger-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(220, 38, 38, 0.2);
        }
        @media (max-width: 500px) {
            .logout-modal-footer {
                flex-direction: column-reverse;
            }
            .logout-modal-btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

<!-- ========== SIDEBAR (UPDATED: RED LOGOUT BUTTON) ========== -->
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
        <!-- Logout form with full account logout + modal trigger -->
        <form method="POST" action="{{ route('logout') }}" id="logoutForm">
            @csrf
            <button type="button" id="logoutButton" class="logout-btn">
                <i class="ri-logout-box-r-line"></i> Sign Out of Account
            </button>
        </form>
    </div>
</aside>

<!-- ========== MAIN CONTENT ========== -->
<div class="main-content" id="mainContent">
    <div class="top-bar">
        <button class="menu-toggle" id="menuToggle">
            <i class="ri-menu-line"></i>
        </button>
        <h2 class="page-title text-lg md:text-xl">Course Management</h2>
        <div class="flex items-center gap-3">
            <button id="openCreateCourseModalBtn" class="flex items-center gap-1.5 px-5 py-2 rounded-xl text-sm font-semibold transition shadow-sm" style="background: var(--blue-deep); color: white;">
                <i class="ri-add-line text-base"></i> Create Course
            </button>
        </div>
    </div>

    <div class="p-4 md:p-6">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-xl mb-6 shadow-sm flex items-center gap-2">
                <i class="ri-checkbox-circle-line text-green-600"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(isset($courses) && $courses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                    <div class="course-card p-5 flex flex-col transition-all duration-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="px-2.5 py-0.5 rounded-md text-[11px] font-bold bg-indigo-100 text-indigo-800">{{ $course->code }}</span>
                                </div>
                                <h4 class="font-bold text-indigo-900 text-lg tracking-tight">{{ $course->name }}</h4>
                            </div>
                            <span class="badge-gold flex items-center gap-1.5">
                                <i class="ri-group-line text-xs"></i> {{ $course->students_count ?? 0 }} students
                            </span>
                        </div>
                        
                        <div class="mt-4 flex justify-between text-sm text-gray-500 border-t border-gray-100 pt-3">
                            <span class="flex items-center gap-1.5"><i class="ri-quiz-line text-indigo-400"></i> Quizzes: {{ $course->quizzes_count ?? 0 }}</span>
                            <span class="flex items-center gap-1.5"><i class="ri-file-copy-line"></i> Credits: {{ $course->credits ?? 0 }}</span>
                        </div>
                        
                        <div class="mt-6 flex gap-2">
                            <a href="{{ route('faculty.course.details', $course->id) }}" 
                               class="flex-1 text-center text-xs font-semibold py-2.5 rounded-xl transition-all duration-200 shadow-sm hover:shadow" 
                               style="background:#0A1F44; color:white;">
                                Manage Course
                            </a>
                            <a href="{{ route('faculty.quiz.create.for.course', $course->id) }}" 
                               class="flex-1 text-center text-xs font-semibold py-2.5 rounded-xl border border-gray-300 transition-all hover:border-gold hover:bg-gray-50">
                                <i class="ri-add-circle-line mr-1"></i> Add Quiz
                            </a>
                            
                            <div class="relative">
                                <button onclick="toggleDropdown({{ $course->id }}, event)" 
                                        class="px-3 py-2 rounded-xl border border-gray-300 transition-all hover:border-gold hover:bg-gray-50">
                                    <i class="ri-more-2-line"></i>
                                </button>
                                <div id="dropdown-{{ $course->id }}" class="fixed-dropdown hidden z-50">
                                    <div class="bg-white rounded-xl shadow-xl border border-gray-200 py-1.5 min-w-[190px]">
                                        <a href="{{ route('faculty.edit.course', $course->id) }}" 
                                           class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition gap-3">
                                            <i class="ri-edit-line text-yellow-600 text-base"></i>
                                            <span>Edit Course</span>
                                        </a>
                                        <a href="{{ route('faculty.results', $course->id) }}" 
                                           class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition gap-3">
                                            <i class="ri-bar-chart-line text-blue-600 text-base"></i>
                                            <span>View Analytics</span>
                                        </a>
                                        <div class="border-t border-gray-100 my-1"></div>
                                        <form action="{{ route('faculty.delete.course', $course->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="flex items-center w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-gray-50 transition gap-3"
                                                    onclick="return confirm('⚠️ Delete this course? All associated quizzes, submissions, and enrollments will be permanently lost. This action cannot be undone.')">
                                                <i class="ri-delete-bin-line text-base"></i>
                                                <span>Delete Course</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden text-center py-16 px-4 transition-all">
                <i class="ri-book-open-line text-6xl text-gray-300 mb-5 block"></i>
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">No Courses Created Yet</h3>
                <p class="text-gray-500 max-w-sm mx-auto mb-7">Ready to build your curriculum? Start by adding your first course and engage students with quizzes and content.</p>
            </div>
        @endif
    </div>
</div>

<!-- ======================= MODAL: CREATE COURSE (PROFESSIONAL THEME) ======================= -->
<div id="createCourseModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h3>
                <i class="ri-add-circle-line"></i> 
                Create New Course
            </h3>
            <div class="modal-close" id="closeModalBtn">
                <i class="ri-close-line"></i>
            </div>
        </div>
        
        <form id="createCourseForm" action="{{ route('faculty.store.course') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Course Code <span>*</span></label>
                    <input type="text" name="code" required 
                           value="{{ old('code') }}"
                           class="form-control"
                           placeholder="e.g., CS101, MATH201">
                    @error('code')
                        <div class="error-feedback"><i class="ri-error-warning-line"></i> {{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">Course Name <span>*</span></label>
                    <input type="text" name="name" required 
                           value="{{ old('name') }}"
                           class="form-control"
                           placeholder="e.g., Introduction to Computer Science">
                    @error('name')
                        <div class="error-feedback"><i class="ri-error-warning-line"></i> {{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="3" 
                              class="form-control"
                              placeholder="Course description, objectives, prerequisites...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="error-feedback"><i class="ri-error-warning-line"></i> {{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">Credits <span>*</span></label>
                    <input type="number" name="credits" required min="1" max="6" value="{{ old('credits', 3) }}"
                           class="form-control">
                    @error('credits')
                        <div class="error-feedback"><i class="ri-error-warning-line"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" id="cancelModalBtn" class="btn-cancel">Cancel</button>
                <button type="submit" class="btn-submit">
                    <i class="ri-save-line"></i> Create Course
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ======================= LOGOUT CONFIRMATION MODAL (THEMED: red confirm button) ======================= -->
<div id="logoutModal" class="logout-modal-overlay">
    <div class="logout-confirmation-modal">
        <div class="logout-modal-header">
            <h3>
                <i class="ri-logout-box-r-line"></i> 
                Confirm Sign Out
            </h3>
            <button class="logout-modal-close" id="closeLogoutModalBtn">&times;</button>
        </div>
        <div class="logout-modal-body">
            <p>Are you sure you want to sign out of your account?</p>
            <p class="text-xs text-gray-500 mt-2">You will be redirected to the main page and will need to log in again.</p>
        </div>
        <div class="logout-modal-footer">
            <button class="logout-modal-btn logout-modal-btn-cancel" id="cancelLogoutBtn">Cancel</button>
            <button class="logout-modal-btn logout-modal-btn-confirm" id="confirmLogoutBtn">Yes, Sign Out</button>
        </div>
    </div>
</div>

<script>
    // ======================= DROPDOWN MANAGEMENT =======================
    let activeDropdown = null;
    
    function toggleDropdown(courseId, event) {
        event.stopPropagation();
        const dropdown = document.getElementById(`dropdown-${courseId}`);
        const button = event.currentTarget;
        
        if (activeDropdown && activeDropdown !== dropdown) {
            activeDropdown.classList.add('hidden');
        }
        
        if (dropdown.classList.contains('hidden')) {
            const rect = button.getBoundingClientRect();
            dropdown.style.top = `${rect.bottom + window.scrollY + 6}px`;
            dropdown.style.left = `${rect.right - 190}px`;
            dropdown.classList.remove('hidden');
            activeDropdown = dropdown;
        } else {
            dropdown.classList.add('hidden');
            activeDropdown = null;
        }
    }
    
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.relative')) {
            if (activeDropdown) {
                activeDropdown.classList.add('hidden');
                activeDropdown = null;
            }
        }
    });
    
    window.addEventListener('resize', () => { 
        if (activeDropdown) { 
            activeDropdown.classList.add('hidden'); 
            activeDropdown = null; 
        } 
    });
    window.addEventListener('scroll', () => { 
        if (activeDropdown) { 
            activeDropdown.classList.add('hidden'); 
            activeDropdown = null; 
        } 
    });
    
    // ======================= MOBILE SIDEBAR TOGGLE =======================
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
    
    // ======================= CREATE COURSE MODAL LOGIC =======================
    const modal = document.getElementById('createCourseModal');
    const openModalBtns = document.querySelectorAll('#openCreateCourseModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const cancelModalBtn = document.getElementById('cancelModalBtn');
    
    function openCreateModal() {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeCreateModal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    if (openModalBtns.length) {
        openModalBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                openCreateModal();
            });
        });
    }
    
    if (closeModalBtn) closeModalBtn.addEventListener('click', closeCreateModal);
    if (cancelModalBtn) cancelModalBtn.addEventListener('click', closeCreateModal);
    
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeCreateModal();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeCreateModal();
        }
    });
    
    // Auto-open modal if validation errors exist after POST
    @if ($errors->any() && (old('_token') || request()->isMethod('post')))
        window.addEventListener('DOMContentLoaded', function() {
            openCreateModal();
            let firstError = document.querySelector('.error-feedback');
            if (firstError) {
                let inputField = firstError.previousElementSibling?.querySelector?.('.form-control') || firstError.previousElementSibling;
                if (inputField && inputField.focus) inputField.focus();
            }
        });
    @endif
    
    // ======================= ACTIVE NAVIGATION HIGHLIGHT =======================
    const currentUrl = window.location.pathname;
    document.querySelectorAll('.nav-item').forEach(item => {
        const href = item.getAttribute('href');
        if (href && currentUrl.includes(href) && href !== '/faculty/dashboard') {
            item.classList.add('active');
        } else if (currentUrl === '/faculty/dashboard' && href === '/faculty/dashboard') {
            item.classList.add('active');
        }
    });
    
    if (currentUrl.includes('/faculty/courses') || 
        currentUrl.includes('/faculty/create-course') || 
        currentUrl.includes('/faculty/edit-course') ||
        currentUrl.includes('/faculty/course-details')) {
        document.querySelectorAll('.nav-item').forEach(item => {
            if (item.getAttribute('href') === '{{ route("faculty.courses") }}') {
                item.classList.add('active');
            }
        });
    }

    // ======================= LOGOUT CONFIRMATION MODAL LOGIC (FULL ACCOUNT LOGOUT) =======================
    const logoutButton = document.getElementById('logoutButton');
    const logoutModal = document.getElementById('logoutModal');
    const confirmLogoutBtn = document.getElementById('confirmLogoutBtn');
    const cancelLogoutBtn = document.getElementById('cancelLogoutBtn');
    const closeLogoutModalBtn = document.getElementById('closeLogoutModalBtn');
    const logoutForm = document.getElementById('logoutForm');

    function openLogoutModal() {
        logoutModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeLogoutModal() {
        logoutModal.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (logoutButton) {
        logoutButton.addEventListener('click', (e) => {
            e.preventDefault();
            openLogoutModal();
        });
    }
    if (confirmLogoutBtn) {
        confirmLogoutBtn.addEventListener('click', () => {
            if (logoutForm) {
                logoutForm.submit();
            } else {
                window.location.href = "{{ route('logout') }}";
            }
        });
    }
    if (cancelLogoutBtn) cancelLogoutBtn.addEventListener('click', closeLogoutModal);
    if (closeLogoutModalBtn) closeLogoutModalBtn.addEventListener('click', closeLogoutModal);
    logoutModal.addEventListener('click', (e) => {
        if (e.target === logoutModal) closeLogoutModal();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && logoutModal.classList.contains('active')) closeLogoutModal();
    });
</script>
</body>
</html>