<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Edit Quiz: {{ $quiz->title }} - NU Horizon LMS</title>
    <!-- Google Fonts + Remix Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:opsz,wght@9..144,600;9..144,700;9..144,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: { preflight: false },
        }
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #F8F6F1;
            overflow-x: hidden;
        }

        :root {
            --blue-deep: #0A1F44;
            --gold: #FFD70F;
            --gold-dark: #e5c20c;
            --gray-light: #F8FAFF;
            --gray-border: rgba(10,31,68,0.09);
            --card-shadow: 0 8px 24px rgba(10,31,68,0.05);
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            --danger-red: #dc2626;
            --danger-dark: #b91c1c;
        }

        /* Sidebar styles */
        

        @media (max-width: 1024px) {
            
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            
        }

        
        
        
        .logo-text h1 span
        

        .nav-section {
            padding: 0 1rem;
            margin-top: 1.5rem;
        }
        .nav-section-title {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255, 215, 15, 0.5);
            margin-bottom: 0.75rem;
            font-weight: 700;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 1rem;
            border-radius: 12px;
            color: rgba(255, 255, 255, 0.75);
            transition: var(--transition);
            margin-bottom: 0.25rem;
            font-weight: 500;
            text-decoration: none;
        }
        .nav-item i {
            font-size: 1.2rem;
            width: 1.5rem;
        }
        .nav-item:hover {
            background: rgba(255, 215, 15, 0.12);
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
            border-top: 1px solid rgba(255, 215, 15, 0.2);
        }
        .profile-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            text-decoration: none;
        }
        .avatar {
            width: 42px;
            height: 42px;
            background: rgba(255, 215, 15, 0.2);
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
            margin: 0;
        }
        .profile-details span {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.7rem;
        }
        
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
        }

        /* Main content */
        
        .top-bar {
            background: white;
            padding: 1.2rem 2rem;
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
        @media (max-width: 1024px) {
            .menu-toggle {
                display: block;
            }
            
        }

        /* Standard Themed Cards */
        .premium-card {
            background: white;
            border-radius: 1.5rem;
            transition: var(--transition);
            border: 1px solid rgba(10,31,68,0.06);
            box-shadow: var(--card-shadow);
            padding: 1.75rem;
            position: relative;
            overflow: hidden;
        }
        .premium-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--blue-deep) 0%, var(--gold) 100%);
            opacity: 0.8;
        }

        /* Stats Cards */
        .stat-box {
            background: white;
            border: 1px solid rgba(10,31,68,0.06);
            border-radius: 1.25rem;
            padding: 1.25rem 1.5rem;
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        /* Modals and Forms */
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
            max-width: 640px;
            width: 92%;
            border-radius: 1.75rem;
            box-shadow: 0 30px 50px -15px rgba(0, 0, 0, 0.25);
            transform: scale(0.96) translateY(12px);
            transition: transform 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.2);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            max-height: 90vh;
        }
        .modal-overlay.active .modal-container {
            transform: scale(1) translateY(0);
        }
        .modal-header {
            background: var(--blue-deep);
            padding: 1.25rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 3px solid var(--gold);
        }
        .modal-header h3 {
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .modal-close {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.2s;
        }
        .modal-close:hover {
            color: var(--gold);
        }
        .modal-body {
            padding: 1.75rem;
            overflow-y: auto;
            flex: 1;
        }
        .modal-footer {
            padding: 1.25rem 1.75rem;
            background: #F9FAFB;
            border-top: 1px solid var(--gray-border);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        /* Styled inputs */
        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--blue-deep);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            border: 1.5px solid rgba(10,31,68,0.12);
            font-family: inherit;
            font-size: 0.9rem;
            color: #1e293b;
            transition: var(--transition);
            background: white;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--blue-deep);
            box-shadow: 0 0 0 3px rgba(10, 31, 68, 0.08);
        }

        /* Buttons */
        .btn-cancel {
            background: #e2e8f0;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 2rem;
            font-weight: 700;
            font-size: 0.85rem;
            color: #475569;
            transition: all 0.2s;
            cursor: pointer;
        }
        .btn-cancel:hover {
            background: #cbd5e1;
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

        /* Logout Confirmation modal */
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
    
        

        

        

        

        

        

        

        

        

        

        .sun-rays .ray-1 { height: 20px; opacity: 0.45; transform: translateX(-50%) rotate(-64deg); }
        .sun-rays .ray-2 { height: 24px; opacity: 0.58; transform: translateX(-50%) rotate(-48deg); }
        .sun-rays .ray-3 { height: 28px; opacity: 0.70; transform: translateX(-50%) rotate(-32deg); }
        .sun-rays .ray-4 { height: 31px; opacity: 0.82; transform: translateX(-50%) rotate(-16deg); }
        .sun-rays .ray-5 { height: 34px; opacity: 1; width: 2.5px; transform: translateX(-50%) rotate(0deg); }
        .sun-rays .ray-6 { height: 31px; opacity: 0.82; transform: translateX(-50%) rotate(16deg); }
        .sun-rays .ray-7 { height: 28px; opacity: 0.70; transform: translateX(-50%) rotate(32deg); }
        .sun-rays .ray-8 { height: 24px; opacity: 0.58; transform: translateX(-50%) rotate(48deg); }
        .sun-rays .ray-9 { height: 20px; opacity: 0.45; transform: translateX(-50%) rotate(64deg); }

    
        /* UNIFIED PREMIUM LOGO STYLING - PREVENTS SIZING JUMPS */
        .sidebar-logo {
            padding: 1.5rem !important;
            border-bottom: 1px solid rgba(255, 215, 15, 0.2) !important;
            display: flex !important;
            align-items: center !important;
            gap: 0.82rem !important;
            min-height: 96px !important;
            height: 96px !important;
            overflow: visible !important;
            box-sizing: border-box !important;
        }

        .sidebar-logo-img {
            height: 45px !important;
            width: auto !important;
            flex-shrink: 0 !important;
        }

        .logo-text {
            position: relative !important;
            min-width: 0 !important;
            overflow: visible !important;
        }

        .logo-text h1 {
            font-family: 'Fraunces', serif !important;
            font-size: 1.3rem !important;
            font-weight: 800 !important;
            color: white !important;
            letter-spacing: -0.3px !important;
            line-height: 1.05 !important;
            margin: 0 !important;
            white-space: nowrap !important;
            overflow: visible !important;
        }

        .logo-text p {
            font-size: 0.55rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.1em !important;
            text-transform: uppercase !important;
            color: rgba(255,255,255,0.5) !important;
            margin-top: 0.25rem !important;
            margin-bottom: 0 !important;
        }

        .horizon-logo-wrap {
            position: relative !important;
            display: inline-block !important;
            margin-left: 0.05rem !important;
            color: var(--gold) !important;
            overflow: visible !important;
        }

        .horizon-word {
            position: relative !important;
            display: inline-block !important;
            color: var(--gold) !important;
            z-index: 2 !important;
        }

        .sun-rays {
            position: absolute !important;
            left: 50% !important;
            top: -1.48rem !important;
            width: 108px !important;
            height: 36px !important;
            transform: translateX(-50%) !important;
            pointer-events: none !important;
            z-index: 1 !important;
            overflow: visible !important;
        }

        .sun-rays::after {
            content: "" !important;
            position: absolute !important;
            left: 50% !important;
            bottom: -2px !important;
            width: 62px !important;
            height: 18px !important;
            transform: translateX(-50%) !important;
            background: radial-gradient(ellipse at center, rgba(255, 215, 15, 0.30), transparent 72%) !important;
            border-radius: 999px !important;
        }

        .sun-rays .ray {
            position: absolute !important;
            left: 50% !important;
            bottom: 0 !important;
            width: 2px !important;
            border-radius: 999px !important;
            background: linear-gradient(
                to top,
                rgba(255, 215, 15, 0.95) 0%,
                rgba(255, 215, 15, 0.55) 42%,
                rgba(255, 215, 15, 0.00) 100%
            ) !important;
            transform-origin: bottom center !important;
            filter: drop-shadow(0 -1px 3px rgba(255, 215, 15, 0.18)) !important;
        }

        .sun-rays .ray-1 { height: 20px !important; opacity: 0.45 !important; transform: translateX(-50%) rotate(-64deg) !important; }
        .sun-rays .ray-2 { height: 24px; opacity: 0.58 !important; transform: translateX(-50%) rotate(-48deg) !important; }
        .sun-rays .ray-3 { height: 28px; opacity: 0.70 !important; transform: translateX(-50%) rotate(-32deg) !important; }
        .sun-rays .ray-4 { height: 31px; opacity: 0.82 !important; transform: translateX(-50%) rotate(-16deg) !important; }
        .sun-rays .ray-5 { height: 34px; opacity: 1 !important; width: 2.5px !important; transform: translateX(-50%) rotate(0deg) !important; }
        .sun-rays .ray-6 { height: 31px; opacity: 0.82 !important; transform: translateX(-50%) rotate(16deg) !important; }
        .sun-rays .ray-7 { height: 28px; opacity: 0.70 !important; transform: translateX(-50%) rotate(32deg) !important; }
        .sun-rays .ray-8 { height: 24px; opacity: 0.58 !important; transform: translateX(-50%) rotate(48deg) !important; }
        .sun-rays .ray-9 { height: 20px; opacity: 0.45 !important; transform: translateX(-50%) rotate(64deg) !important; }

        /* LOCKED SIDEBAR AND MAIN CONTENT LAYOUT */
        .sidebar {
            background-color: var(--blue-deep) !important;
            width: 280px !important;
            min-width: 280px !important;
            max-width: 280px !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            height: 100% !important;
            z-index: 40 !important;
            transition: transform 0.3s ease !important;
            display: flex !important;
            flex-direction: column !important;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08) !important;
            box-sizing: border-box !important;
        }

        .main-content {
            margin-left: 280px !important;
            transition: margin-left 0.3s ease !important;
            min-height: 100vh !important;
            box-sizing: border-box !important;
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%) !important;
            }
            .sidebar.mobile-open {
                transform: translateX(0) !important;
            }
            .main-content {
                margin-left: 0 !important;
            }
        }

    </style>
</head>
<body>

<!-- Sidebar Section -->
<aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
        <img src="/logo/NatU.png" alt="NU Logo" class="sidebar-logo-img" onerror="this.src='https://placehold.co/45x45/0A1F44/FFD70F?text=NU'">

        <div class="logo-text">
            <h1>
                NU
                <span class="horizon-logo-wrap">
                    <span class="sun-rays" aria-hidden="true">
                        <span class="ray ray-1"></span>
                        <span class="ray ray-2"></span>
                        <span class="ray ray-3"></span>
                        <span class="ray ray-4"></span>
                        <span class="ray ray-5"></span>
                        <span class="ray ray-6"></span>
                        <span class="ray ray-7"></span>
                        <span class="ray ray-8"></span>
                        <span class="ray ray-9"></span>
                    </span>

                    <span class="horizon-word">HORIZON</span>
                </span>
            </h1>

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
            <a href="{{ route('faculty.folder-files') }}" class="nav-item {{ request()->routeIs('faculty.folder-files*') ? 'active' : '' }}">
                <i class="ri-folder-3-line"></i> Files & Folders
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Quiz Management</div>
            <a href="{{ route('faculty.quiz.create') }}" class="nav-item {{ request()->routeIs('faculty.quiz.create*') ? 'active' : '' }}">
                <i class="ri-add-circle-line"></i> Create Quiz
            </a>
            <a href="{{ route('faculty.quizzes.list') }}" class="nav-item {{ request()->routeIs('faculty.quizzes.list*') || request()->routeIs('edit.quiz*') ? 'active' : '' }}">
                <i class="ri-list-check"></i> All Quizzes
            </a>
            <a href="{{ route('faculty.question.bank') }}" class="nav-item {{ request()->routeIs('faculty.question.bank*') ? 'active' : '' }}">
                <i class="ri-database-2-line"></i> Question Bank
            </a>
            <a href="{{ route('faculty.grading') }}" class="nav-item {{ request()->routeIs('faculty.grading*') ? 'active' : '' }}">
                <i class="ri-graduation-cap-line"></i> Grading
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Analytics</div>
            <a href="{{ route('faculty.results.index') }}" class="nav-item {{ request()->routeIs('faculty.results*') ? 'active' : '' }}">
                <i class="ri-bar-chart-line"></i> Results & Analytics
            </a>
            <a href="{{ route('faculty.my-evaluation') }}" class="nav-item {{ request()->routeIs('faculty.my-evaluation*') ? 'active' : '' }}">
                <i class="ri-star-smile-line"></i> My Evaluation
            </a>
        </div>
    </div>

    <div class="sidebar-footer">
        <a href="{{ route('faculty.profile') }}" class="profile-info" style="text-decoration: none;">
            <div class="avatar">
                <i class="ri-user-line"></i>
            </div>
            <div class="profile-details">
                <p>{{ Auth::user()->name }}</p>
                <span>{{ Auth::user()->email }}</span>
            </div>
        </a>
        <form method="POST" action="{{ route('logout') }}" id="logoutForm">
            @csrf
            <button type="button" id="logoutButton" class="logout-btn">
                <i class="ri-logout-box-r-line"></i> Sign Out
            </button>
        </form>
    </div>
</aside>

<!-- Main View Content -->
<div class="main-content" id="mainContent">
    <div class="top-bar">
        <div class="flex items-center gap-3">
            <button class="menu-toggle" id="menuToggle">
                <i class="ri-menu-line"></i>
            </button>
            <div>
                <h2 style="font-weight:800;color:var(--blue-deep);font-size:1.15rem;margin:0;">Edit Quiz</h2>
                <p class="text-xs text-gray-500 hidden md:block">{{ $quiz->course->code }} - {{ $quiz->course->name }}</p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('faculty.course.details', $quiz->course_id) }}" class="flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-bold transition border border-gray-300 bg-white hover:bg-gray-50 text-slate-700 cursor-pointer" style="text-decoration: none;">
                <i class="ri-arrow-left-line"></i> Back to Course
            </a>
            
            <!-- Add Question Dropdown with Alpine.js -->
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                <button @click="open = !open" 
                        class="flex items-center gap-1.5 px-6 py-2.5 rounded-full text-xs font-bold transition shadow-sm border-0 bg-yellow-400 hover:bg-yellow-500 text-[#0A1F44] cursor-pointer">
                    <i class="ri-add-line text-sm"></i>
                    <span>Add Question</span>
                    <i class="ri-arrow-down-s-line text-sm"></i>
                </button>
                
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl z-20 border border-gray-200 py-1"
                     style="display: none;">
                    <button onclick="openModal()" 
                            class="flex items-center w-full px-4 py-3 hover:bg-gray-50 transition border-none bg-none cursor-pointer">
                        <div class="bg-green-100 p-2 rounded-lg mr-3">
                            <i class="ri-file-edit-line text-green-600"></i>
                        </div>
                        <div class="flex-1 text-left">
                            <p class="text-xs font-bold text-gray-900">Create New Question</p>
                            <p class="text-[0.65rem] text-gray-500">Draft a unique question</p>
                        </div>
                        <i class="ri-arrow-right-s-line text-gray-400"></i>
                    </button>
                    
                    <div class="border-t border-gray-100 my-1"></div>
                    
                    <button onclick="openQuestionBankModal()" 
                            class="flex items-center w-full px-4 py-3 hover:bg-gray-50 transition border-none bg-none cursor-pointer">
                        <div class="bg-blue-100 p-2 rounded-lg mr-3">
                            <i class="ri-database-2-line text-blue-600"></i>
                        </div>
                        <div class="flex-1 text-left">
                            <p class="text-xs font-bold text-gray-900">From Question Bank</p>
                            <p class="text-[0.65rem] text-gray-500">Import existing questions</p>
                        </div>
                        <i class="ri-arrow-right-s-line text-gray-400"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="p-4 md:p-6">
        <!-- Quiz Info Banner Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="stat-box">
                <div class="stat-icon bg-blue-50 text-blue-600">
                    <i class="ri-file-list-3-line"></i>
                </div>
                <div>
                    <p class="text-[0.68rem] text-gray-500 uppercase font-bold tracking-wider">Total Questions</p>
                    <p class="text-xl font-bold text-slate-800">{{ $quiz->questions->count() }}</p>
                </div>
            </div>
            
            <div class="stat-box">
                <div class="stat-icon bg-yellow-50 text-yellow-600">
                    <i class="ri-award-line"></i>
                </div>
                <div>
                    <p class="text-[0.68rem] text-gray-500 uppercase font-bold tracking-wider">Total Points</p>
                    <p class="text-xl font-bold text-slate-800">{{ $quiz->total_points }} pts</p>
                </div>
            </div>
            
            <div class="stat-box">
                <div class="stat-icon bg-purple-50 text-purple-600">
                    <i class="ri-time-line"></i>
                </div>
                <div>
                    <p class="text-[0.68rem] text-gray-500 uppercase font-bold tracking-wider">Duration</p>
                    <p class="text-xl font-bold text-slate-800">{{ $quiz->duration_minutes ? $quiz->duration_minutes . ' min' : 'Unlimited' }}</p>
                </div>
            </div>

            <div class="stat-box">
                <div class="stat-icon bg-green-50 text-green-600">
                    <i class="ri-checkbox-circle-line"></i>
                </div>
                <div>
                    <p class="text-[0.68rem] text-gray-500 uppercase font-bold tracking-wider">Status</p>
                    <p class="text-xl font-bold">
                        @if($quiz->hasStarted() && !$quiz->hasEnded())
                            <span class="text-green-600">Active</span>
                        @elseif($quiz->hasEnded())
                            <span class="text-red-600">Ended</span>
                        @else
                            <span class="text-yellow-600">Upcoming</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Premium List Container -->
        <div class="premium-card">
            <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-6">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <i class="ri-questionnaire-line text-yellow-500 text-xl"></i>
                    Quiz Questions Layout
                </h3>
                <span class="px-3 py-1 bg-gray-100 rounded-full text-xs font-semibold text-gray-600">
                    {{ $quiz->title }}
                </span>
            </div>

            @if($quiz->questions->count() > 0)
                <div class="space-y-4">
                    @foreach($quiz->questions as $index => $question)
                        <div class="border border-gray-100 rounded-2xl p-5 bg-gray-50 hover:bg-white hover:shadow-md transition-all duration-200" id="question-{{ $question->id }}">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center gap-2 mb-3">
                                        <span class="bg-[#0A1F44] text-white text-[0.65rem] font-bold px-2.5 py-1 rounded-full uppercase">
                                            Q{{ $index + 1 }}
                                        </span>
                                        <span class="bg-gray-200 text-gray-800 text-[0.65rem] font-bold px-2.5 py-1 rounded-full uppercase">
                                            {{ strtoupper(str_replace('_', ' ', $question->question_type)) }}
                                        </span>
                                        <span class="text-xs font-semibold text-gray-500">
                                            <i class="ri-award-line"></i> {{ $question->points }} pts
                                        </span>
                                    </div>
                                    <h4 class="font-bold text-slate-800 text-base mb-3">{{ $question->question_text }}</h4>
                                    
                                    @if($question->question_type == 'mcq' && $question->options)
                                        <div class="mt-2 space-y-1.5 pl-2 border-l-2 border-gray-200">
                                            @foreach(json_decode($question->options) as $option)
                                                <div class="text-sm flex items-center gap-2 {{ $option == $question->correct_answer ? 'text-green-600 font-bold' : 'text-slate-600' }}">
                                                    <i class="{{ $option == $question->correct_answer ? 'ri-checkbox-circle-fill text-green-500' : 'ri-checkbox-blank-circle-line text-slate-400' }}"></i>
                                                    <span>{{ $option }}</span>
                                                    @if($option == $question->correct_answer)
                                                        <span class="bg-green-100 text-green-700 text-[0.55rem] font-extrabold px-1.5 py-0.5 rounded uppercase">Correct</span>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @elseif($question->question_type == 'true_false')
                                        <div class="mt-2 pl-2 border-l-2 border-gray-200">
                                            <span class="text-sm font-semibold text-slate-600">
                                                Correct Choice: 
                                                <span class="text-green-600 font-extrabold uppercase bg-green-50 px-2 py-0.5 rounded text-xs ml-1">{{ $question->correct_answer }}</span>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex space-x-1 ml-4">
                                    <button onclick="editQuestionInline({{ $question->id }})" 
                                            class="p-2 text-yellow-600 hover:text-yellow-700 hover:bg-yellow-50 rounded-xl transition border-none bg-transparent cursor-pointer">
                                        <i class="ri-edit-line text-lg"></i>
                                    </button>
                                    <form action="{{ route('faculty.delete.question', $question->id) }}" method="POST" class="inline" style="margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-xl transition border-none bg-transparent cursor-pointer" onclick="return confirm('Are you sure you want to delete this question?')">
                                            <i class="ri-delete-bin-line text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <div class="text-6xl mb-4">❓</div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">No Questions Drafted Yet</h3>
                    <p class="text-slate-500 text-sm mb-6 max-w-sm mx-auto">This quiz is empty. Let's create your first question or pull existing questions from your global bank!</p>
                    <div class="flex justify-center gap-3">
                        <button onclick="openModal()" class="px-5 py-2.5 bg-indigo-600 text-white rounded-full text-xs font-bold transition hover:bg-indigo-700 border-none cursor-pointer">
                            Create New Question
                        </button>
                        <button onclick="openQuestionBankModal()" class="px-5 py-2.5 bg-slate-800 text-white rounded-full text-xs font-bold transition hover:bg-slate-900 border-none cursor-pointer">
                            Pull from Bank
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Overlay: Create/Edit Question -->
<div id="questionModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h3 id="modalTitle">
                <i class="ri-questionnaire-line text-yellow-400"></i>
                Create New Question
            </h3>
            <button class="modal-close" onclick="closeModal()">
                <i class="ri-close-line"></i>
            </button>
        </div>
        
        <form id="questionForm">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="editQuestionId" name="question_id" value="">
            
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Question Type</label>
                    <select id="questionType" name="question_type" class="form-control">
                        <option value="mcq">Multiple Choice (MCQ)</option>
                        <option value="true_false">True / False</option>
                        <option value="essay">Essay</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Question text</label>
                    <textarea id="questionText" name="question_text" rows="3" required 
                              class="form-control" placeholder="Type your question prompt here..."></textarea>
                </div>
                
                <!-- MCQ Option Editor -->
                <div id="mcqDiv">
                    <label class="form-label">Answer Choices & Correct Key</label>
                    <div id="optionsList" class="space-y-2 mb-3">
                        <div class="flex items-center gap-2">
                            <input type="text" name="options[]" class="form-control" placeholder="Option 1">
                            <input type="radio" name="correct_answer" value="" class="correct-radio w-4 h-4 cursor-pointer" onchange="setCorrectAnswerValue(this)">
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="text" name="options[]" class="form-control" placeholder="Option 2">
                            <input type="radio" name="correct_answer" value="" class="correct-radio w-4 h-4 cursor-pointer" onchange="setCorrectAnswerValue(this)">
                        </div>
                    </div>
                    <button type="button" onclick="addOption()" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition border-none bg-transparent cursor-pointer">
                        <i class="ri-add-line"></i> Add Choice Option
                    </button>
                </div>
                
                <!-- True/False Option Editor -->
                <div id="tfDiv" style="display: none;">
                    <label class="form-label">Correct Answer</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-1.5 font-semibold text-slate-700 cursor-pointer">
                            <input type="radio" name="correct_answer" value="True" class="w-4 h-4"> True
                        </label>
                        <label class="flex items-center gap-1.5 font-semibold text-slate-700 cursor-pointer">
                            <input type="radio" name="correct_answer" value="False" class="w-4 h-4"> False
                        </label>
                    </div>
                </div>
                
                <!-- Essay Option Editor -->
                <div id="essayDiv" style="display: none;">
                    <label class="form-label">Sample Answer / Reference (Optional)</label>
                    <textarea name="correct_answer" id="essayAnswer" rows="3" class="form-control" placeholder="Enter key grading points or standard reference answers..."></textarea>
                    <p class="text-[0.7rem] text-slate-400 mt-1">Essay submissions require manual review and score allocation</p>
                </div>
                
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="form-label">Points</label>
                        <input type="number" id="points" name="points" required min="1" value="1" class="form-control">
                    </div>
                    
                    <div>
                        <label class="form-label">Max Attempts</label>
                        <input type="number" name="max_attempts" min="1" max="10" value="{{ old('max_attempts', $quiz->max_attempts ?? 1) }}" class="form-control">
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" onclick="closeModal()" class="btn-cancel">Cancel</button>
                <button type="submit" class="btn-submit">
                    <i class="ri-save-line"></i> Save Question
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Overlay: Question Bank -->
<div id="questionBankModal" class="modal-overlay">
    <div class="modal-container" style="max-width: 800px;">
        <div class="modal-header">
            <h3>
                <i class="ri-database-2-line text-yellow-400"></i>
                Import from Question Bank
            </h3>
            <button class="modal-close" onclick="closeQuestionBankModal()">
                <i class="ri-close-line"></i>
            </button>
        </div>
        
        <div class="modal-body">
            <div class="flex flex-col md:flex-row gap-3 mb-4">
                <div class="flex-1">
                    <input type="text" id="searchQuestions" placeholder="Search saved questions..." class="form-control">
                </div>
                <div class="md:w-48">
                    <select id="filterQuestionType" class="form-control">
                        <option value="">All Types</option>
                        <option value="mcq">Multiple Choice</option>
                        <option value="true_false">True/False</option>
                        <option value="essay">Essay</option>
                    </select>
                </div>
            </div>
            
            <div id="questionBankList" class="space-y-3 overflow-y-auto max-h-[400px] pr-2">
                <div class="text-center py-8">
                    <p class="text-slate-400">Fetching saved question archives...</p>
                </div>
            </div>
        </div>
        
        <div class="modal-footer">
            <button onclick="closeQuestionBankModal()" class="btn-cancel">Close</button>
            <button onclick="addSelectedQuestions()" class="btn-submit bg-indigo-600 hover:bg-indigo-700">
                <i class="ri-download-line"></i> Add Selected Questions
            </button>
        </div>
    </div>
</div>

<!-- LOGOUT CONFIRMATION MODAL -->
<div id="logoutModal" class="logout-modal-overlay">
    <div class="logout-confirmation-modal">
        <div class="logout-modal-header">
            <h3>
                <i class="ri-logout-box-r-line"></i> 
                Sign Out
            </h3>
            <button class="logout-modal-close" id="closeLogoutModalBtn">×</button>
        </div>
        <div class="logout-modal-body">
            <p>Are you sure you want to log out of NU Horizon Portal?</p>
        </div>
        <div class="logout-modal-footer">
            <button type="button" id="cancelLogoutModalBtn" class="logout-modal-btn logout-modal-btn-cancel">Cancel</button>
            <button type="button" id="confirmLogoutBtn" class="logout-modal-btn logout-modal-btn-confirm">Sign Out</button>
        </div>
    </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    // Sidebar responsive toggle
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('mobile-open');
        });
    }

    // Logout Modal integration
    const logoutBtn = document.getElementById('logoutButton');
    const logoutModal = document.getElementById('logoutModal');
    const cancelLogoutBtn = document.getElementById('cancelLogoutModalBtn');
    const closeLogoutBtn = document.getElementById('closeLogoutModalBtn');
    const confirmLogoutBtn = document.getElementById('confirmLogoutBtn');
    const logoutForm = document.getElementById('logoutForm');

    if (logoutBtn && logoutModal) {
        logoutBtn.addEventListener('click', () => {
            logoutModal.classList.add('active');
        });
        if (cancelLogoutBtn) {
            cancelLogoutBtn.addEventListener('click', () => {
                logoutModal.classList.remove('active');
            });
        }
        if (closeLogoutBtn) {
            closeLogoutBtn.addEventListener('click', () => {
                logoutModal.classList.remove('active');
            });
        }
        if (confirmLogoutBtn && logoutForm) {
            confirmLogoutBtn.addEventListener('click', () => {
                logoutForm.submit();
            });
        }
    }

    // Question editor state & functions
    let optionCounter = 2;
    let selectedCorrectAnswer = '';
    let bankQuestions = [];
    let isEditing = false;
    
    function editQuestionInline(questionId) {
        fetch(`/faculty/questions/${questionId}/edit-data`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const question = data.question;
                isEditing = true;
                document.getElementById('modalTitle').innerHTML = '<i class="ri-edit-line text-yellow-400"></i> Edit Question';
                document.getElementById('editQuestionId').value = question.id;
                document.getElementById('questionType').value = question.question_type;
                document.getElementById('questionText').value = question.question_text;
                document.getElementById('points').value = question.points;
                
                toggleSections();
                
                if (question.question_type === 'mcq') {
                    const options = typeof question.options === 'string' ? JSON.parse(question.options) : question.options;
                    const container = document.getElementById('optionsList');
                    container.innerHTML = '';
                    
                    if (options && Array.isArray(options)) {
                        options.forEach((option, idx) => {
                            const div = document.createElement('div');
                            div.className = 'flex items-center gap-2';
                            div.innerHTML = `
                                <input type="text" name="options[]" class="form-control" placeholder="Option ${idx + 1}" value="${escapeHtml(option)}">
                                <input type="radio" name="correct_answer" value="${escapeHtml(option)}" class="correct-radio w-4 h-4 cursor-pointer" onchange="setCorrectAnswerValue(this)" ${option === question.correct_answer ? 'checked' : ''}>
                                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 font-bold border-none bg-transparent cursor-pointer p-1">✕</button>
                            `;
                            container.appendChild(div);
                        });
                        optionCounter = options.length;
                    }
                    selectedCorrectAnswer = question.correct_answer;
                } else if (question.question_type === 'true_false') {
                    const radios = document.querySelectorAll('#tfDiv input[name="correct_answer"]');
                    radios.forEach(radio => {
                        if (radio.value === question.correct_answer) {
                            radio.checked = true;
                        }
                    });
                    selectedCorrectAnswer = question.correct_answer;
                } else if (question.question_type === 'essay') {
                    document.getElementById('essayAnswer').value = question.correct_answer || '';
                    selectedCorrectAnswer = question.correct_answer || '';
                }
                
                document.getElementById('questionModal').classList.add('active');
            }
        })
        .catch(error => {
            alert('Error loading question: ' + error.message);
        });
    }
    
    function openModal() {
        document.getElementById('modalTitle').innerHTML = '<i class="ri-questionnaire-line text-yellow-400"></i> Create New Question';
        document.getElementById('editQuestionId').value = '';
        resetForm();
        document.getElementById('questionModal').classList.add('active');
    }
    
    function closeModal() {
        document.getElementById('questionModal').classList.remove('active');
        resetForm();
    }
    
    function openQuestionBankModal() {
        document.getElementById('questionBankModal').classList.add('active');
        loadQuestionBank();
    }
    
    function closeQuestionBankModal() {
        document.getElementById('questionBankModal').classList.remove('active');
    }
    
    function loadQuestionBank() {
        const quizId = {{ $quiz->id }};
        
        fetch(`/faculty/quizzes/${quizId}/question-bank`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                bankQuestions = data.questions;
                renderQuestionBank(data.questions);
            } else {
                throw new Error(data.message || 'Failed to load questions');
            }
        })
        .catch(error => {
            document.getElementById('questionBankList').innerHTML = `
                <div class="text-center py-8">
                    <div class="text-red-400">Error loading questions. Please try again.</div>
                    <button onclick="loadQuestionBank()" class="mt-2 text-indigo-600 hover:underline border-none bg-transparent cursor-pointer">Retry</button>
                </div>
            `;
        });
    }
    
    function renderQuestionBank(questions) {
        if (!questions || questions.length === 0) {
            document.getElementById('questionBankList').innerHTML = `
                <div class="text-center py-8">
                    <div class="text-gray-400">No questions available in the question bank.</div>
                    <a href="{{ route('faculty.question.bank') }}" class="inline-block mt-2 text-indigo-600 hover:underline" style="text-decoration:none;">Go to Question Bank</a>
                </div>
            `;
            return;
        }
        
        let html = '';
        questions.forEach((question) => {
            let optionsHtml = '';
            if (question.question_type === 'mcq' && question.options) {
                try {
                    const options = typeof question.options === 'string' ? JSON.parse(question.options) : question.options;
                    if (Array.isArray(options)) {
                        optionsHtml = `
                            <div class="mt-2 text-xs text-gray-500 pl-3 border-l border-gray-200">
                                ${options.map(opt => `• ${escapeHtml(opt)}`).join('<br>')}
                            </div>
                        `;
                    }
                } catch(e) {}
            }
            
            html += `
                <div class="border border-gray-100 rounded-xl p-4 bg-gray-50 hover:bg-white hover:shadow transition-all duration-200">
                    <div class="flex items-start">
                        <input type="checkbox" value="${question.id}" class="question-checkbox mt-1 mr-3 w-4 h-4 rounded border-gray-300 cursor-pointer">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2 flex-wrap gap-2">
                                <span class="bg-gray-200 text-gray-800 text-[0.65rem] font-bold px-2 py-0.5 rounded-full uppercase">
                                    ${question.question_type === 'mcq' ? 'Multiple Choice' : (question.question_type === 'true_false' ? 'True/False' : 'Essay')}
                                </span>
                                <span class="text-[0.7rem] font-bold text-gray-500">${question.points} pts</span>
                                <span class="text-[0.7rem] text-gray-400">Syllabus: ${escapeHtml(question.course_code || 'N/A')}</span>
                            </div>
                            <p class="font-bold text-slate-800 text-sm">${escapeHtml(question.question_text)}</p>
                            ${optionsHtml}
                        </div>
                    </div>
                </div>
            `;
        });
        
        document.getElementById('questionBankList').innerHTML = html;
    }
    
    function addSelectedQuestions() {
        const selectedIds = [];
        document.querySelectorAll('.question-checkbox:checked').forEach(checkbox => {
            selectedIds.push(checkbox.value);
        });
        
        if (selectedIds.length === 0) {
            alert('Please select at least one question to add.');
            return;
        }
        
        const quizId = {{ $quiz->id }};
        const addButton = event.target;
        const originalText = addButton.innerHTML;
        addButton.innerHTML = 'Adding...';
        addButton.disabled = true;
        
        fetch(`/faculty/quizzes/${quizId}/add-questions`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ question_ids: selectedIds })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`Successfully imported ${selectedIds.length} question(s)!`);
                location.reload();
            } else {
                alert(data.message || 'Error adding questions');
            }
        })
        .catch(error => {
            alert('Error: ' + error.message);
        })
        .finally(() => {
            addButton.innerHTML = originalText;
            addButton.disabled = false;
        });
    }
    
    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    // Search and filter functionality
    document.addEventListener('input', function(e) {
        if (e.target.id === 'searchQuestions' || e.target.id === 'filterQuestionType') {
            const searchTerm = document.getElementById('searchQuestions').value.toLowerCase();
            const typeFilter = document.getElementById('filterQuestionType').value;
            
            const filtered = bankQuestions.filter(question => {
                const matchesSearch = question.question_text.toLowerCase().includes(searchTerm);
                const matchesType = !typeFilter || question.question_type === typeFilter;
                return matchesSearch && matchesType;
            });
            
            renderQuestionBank(filtered);
        }
    });
    
    function resetForm() {
        document.getElementById('questionForm').reset();
        isEditing = false;
        selectedCorrectAnswer = '';
        document.getElementById('editQuestionId').value = '';
        document.getElementById('optionsList').innerHTML = `
            <div class="flex items-center gap-2">
                <input type="text" name="options[]" class="form-control" placeholder="Option 1">
                <input type="radio" name="correct_answer" value="" class="correct-radio w-4 h-4 cursor-pointer" onchange="setCorrectAnswerValue(this)">
            </div>
            <div class="flex items-center gap-2">
                <input type="text" name="options[]" class="form-control" placeholder="Option 2">
                <input type="radio" name="correct_answer" value="" class="correct-radio w-4 h-4 cursor-pointer" onchange="setCorrectAnswerValue(this)">
            </div>
        `;
        optionCounter = 2;
        document.getElementById('questionType').value = 'mcq';
        document.getElementById('essayAnswer').value = '';
        toggleSections();
        updateRadioValues();
    }
    
    function addOption() {
        optionCounter++;
        const container = document.getElementById('optionsList');
        const div = document.createElement('div');
        div.className = 'flex items-center gap-2';
        div.innerHTML = `
            <input type="text" name="options[]" class="form-control" placeholder="Option ${optionCounter}">
            <input type="radio" name="correct_answer" value="" class="correct-radio w-4 h-4 cursor-pointer" onchange="setCorrectAnswerValue(this)">
            <button type="button" onclick="this.parentElement.remove()" class="text-red-500 font-bold border-none bg-transparent cursor-pointer p-1">✕</button>
        `;
        container.appendChild(div);
        updateRadioValues();
    }
    
    function setCorrectAnswerValue(radio) {
        const optionInput = radio.parentElement.querySelector('input[type="text"]');
        if (optionInput && optionInput.value) {
            radio.value = optionInput.value;
            selectedCorrectAnswer = radio.value;
        }
    }
    
    function toggleSections() {
        const type = document.getElementById('questionType').value;
        document.getElementById('mcqDiv').style.display = type === 'mcq' ? 'block' : 'none';
        document.getElementById('tfDiv').style.display = type === 'true_false' ? 'block' : 'none';
        document.getElementById('essayDiv').style.display = type === 'essay' ? 'block' : 'none';
    }
    
    function updateRadioValues() {
        const options = document.querySelectorAll('[name="options[]"]');
        const radios = document.querySelectorAll('.correct-radio');
        radios.forEach((radio, index) => {
            if (options[index] && options[index].value) {
                radio.value = options[index].value;
            }
        });
    }
    
    // Handle form submission for new/edited question
    document.getElementById('questionForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const type = document.getElementById('questionType').value;
        const questionText = document.getElementById('questionText').value.trim();
        const questionId = document.getElementById('editQuestionId').value;
        
        if (!questionText) {
            alert('Please enter the question text');
            return;
        }
        
        if (type === 'mcq') {
            let hasCorrect = false;
            const radios = document.querySelectorAll('#mcqDiv .correct-radio');
            radios.forEach(radio => {
                if (radio.checked && radio.value) {
                    hasCorrect = true;
                    selectedCorrectAnswer = radio.value;
                }
            });
            if (!hasCorrect) {
                alert('Please select the correct answer');
                return;
            }
        }
        
        if (type === 'true_false') {
            const selected = document.querySelector('#tfDiv input[name="correct_answer"]:checked');
            if (!selected) {
                alert('Please select True or False');
                return;
            }
            selectedCorrectAnswer = selected.value;
        }
        
        if (type === 'essay') {
            const essayValue = document.getElementById('essayAnswer').value;
            selectedCorrectAnswer = essayValue || 'To be graded manually';
        }
        
        updateRadioValues();
        
        const formData = new FormData();
        formData.append('_token', document.querySelector('input[name="_token"]').value);
        formData.append('question_type', type);
        formData.append('question_text', questionText);
        formData.append('correct_answer', selectedCorrectAnswer);
        formData.append('points', document.getElementById('points').value);
        
        if (type === 'mcq') {
            const options = document.querySelectorAll('[name="options[]"]');
            options.forEach(option => {
                if (option.value.trim()) {
                    formData.append('options[]', option.value.trim());
                }
            });
        }
        
        const quizId = {{ $quiz->id }};
        const url = questionId ? `/faculty/questions/${questionId}` : `/faculty/quizzes/${quizId}/questions`;
        const method = questionId ? 'PUT' : 'POST';

        if (method === 'PUT') {
            formData.append('_method', 'PUT');
            formData.append('quiz_id', quizId);
        }
        
        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(questionId ? 'Question updated successfully!' : 'Question added successfully!');
                location.reload();
            } else {
                let errorMsg = data.message || 'Validation failed';
                if (data.errors) {
                    errorMsg += '\n' + Object.values(data.errors).flat().join('\n');
                }
                alert(errorMsg);
            }
        })
        .catch(error => {
            alert('Error: ' + error.message);
        });
    });
    
    document.getElementById('questionType').addEventListener('change', function() {
        toggleSections();
    });
    
    document.addEventListener('input', function(e) {
        if (e.target.name === 'options[]') {
            updateRadioValues();
        }
    });
    
    // Close modal on background click
    document.getElementById('questionModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    document.getElementById('questionBankModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeQuestionBankModal();
        }
    });
    
    toggleSections();
</script>
</body>
</html>