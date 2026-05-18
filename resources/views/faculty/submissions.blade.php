<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Quiz Submissions: {{ $quiz->title }} - NU Horizon LMS</title>
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
            max-width: 680px;
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

        /* Table custom styling */
        .submissions-table {
            width: 100%;
            border-collapse: collapse;
        }
        .submissions-table th {
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--blue-deep);
            padding: 1rem 1.5rem;
            background: #F8FAFF;
            border-bottom: 1.5px solid rgba(10,31,68,0.06);
            text-align: left;
        }
        .submissions-table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(10,31,68,0.04);
            font-size: 0.88rem;
            color: #475569;
        }
        .submissions-table tr:hover {
            background: #fbfbf9;
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
            <a href="{{ route('faculty.quizzes.list') }}" class="nav-item {{ request()->routeIs('faculty.quizzes.list*') || request()->routeIs('submissions*') ? 'active' : '' }}">
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

<!-- Main Content wrapper -->
<div class="main-content" id="mainContent">
    <div class="top-bar">
        <div class="flex items-center gap-3">
            <button class="menu-toggle" id="menuToggle">
                <i class="ri-menu-line"></i>
            </button>
            <div>
                <h2 style="font-weight:800;color:var(--blue-deep);font-size:1.15rem;margin:0;">Quiz Submissions</h2>
                <p class="text-xs text-gray-500 hidden md:block">{{ $quiz->title }} &mdash; {{ $quiz->course->code }} {{ $quiz->course->name }}</p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('faculty.edit.quiz', $quiz->id) }}" class="flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-bold transition border border-gray-300 bg-white hover:bg-gray-50 text-slate-700 cursor-pointer" style="text-decoration: none;">
                <i class="ri-arrow-left-line"></i> Back to Quiz Questions
            </a>
            @if($attempts->count() > 0)
                <button onclick="exportSubmissions()" class="flex items-center gap-1.5 px-5 py-2.5 rounded-full text-xs font-bold transition shadow-sm border-0 bg-yellow-400 hover:bg-yellow-500 text-[#0A1F44] cursor-pointer">
                    <i class="ri-download-line text-sm"></i> Export Results
                </button>
            @endif
        </div>
    </div>

    <div class="p-4 md:p-6">
        <!-- Stats Card Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="stat-box">
                <div class="stat-icon bg-indigo-50 text-indigo-600">
                    <i class="ri-file-list-3-line"></i>
                </div>
                <div>
                    <p class="text-[0.68rem] text-gray-500 uppercase font-bold tracking-wider">Submissions</p>
                    <p class="text-xl font-bold text-slate-800">{{ $attempts->count() }}</p>
                </div>
            </div>
            
            <div class="stat-box">
                <div class="stat-icon bg-green-50 text-green-600">
                    <i class="ri-award-line"></i>
                </div>
                <div>
                    <p class="text-[0.68rem] text-gray-500 uppercase font-bold tracking-wider">Average Score</p>
                    <p class="text-xl font-bold text-slate-800">
                        {{ $attempts->avg('score') ? round($attempts->avg('score'), 1) : 0 }}<span class="text-sm font-normal text-slate-500">/{{ $quiz->total_points }}</span>
                    </p>
                </div>
            </div>
            
            <div class="stat-box">
                <div class="stat-icon bg-blue-50 text-blue-600">
                    <i class="ri-percent-line"></i>
                </div>
                <div>
                    <p class="text-[0.68rem] text-gray-500 uppercase font-bold tracking-wider">Passing Rate</p>
                    <p class="text-xl font-bold text-slate-800">
                        @php
                            $passingCount = $attempts->filter(function($attempt) use ($quiz) {
                                return $quiz->total_points > 0 && ($attempt->score / $quiz->total_points) >= 0.6;
                            })->count();
                            $passingRate = $attempts->count() > 0 ? round(($passingCount / $attempts->count()) * 100) : 0;
                        @endphp
                        {{ $passingRate }}%
                    </p>
                </div>
            </div>

            <div class="stat-box">
                <div class="stat-icon bg-yellow-50 text-yellow-600">
                    <i class="ri-time-line"></i>
                </div>
                <div>
                    <p class="text-[0.68rem] text-gray-500 uppercase font-bold tracking-wider">Pending Grade</p>
                    <p class="text-xl font-bold text-slate-800">
                        {{ $attempts->whereNull('feedback')->whereNotNull('completed_at')->count() }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Submissions Table Layout Card -->
        <div class="premium-card">
            <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-6">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <i class="ri-user-star-line text-yellow-500 text-xl"></i>
                    Student Performance List
                </h3>
                <span class="px-3 py-1 bg-gray-100 rounded-full text-xs font-semibold text-gray-600">
                    Active Quiz Attempts
                </span>
            </div>

            <div class="overflow-x-auto rounded-xl border border-gray-100">
                <table class="submissions-table">
                    <thead>
                        <tr>
                            <th>Student Info</th>
                            <th>Submitted Date</th>
                            <th>Points Obtained</th>
                            <th>Score Percent</th>
                            <th>Grading Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attempts as $attempt)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 bg-indigo-50 rounded-full flex items-center justify-center">
                                            <i class="ri-user-line text-indigo-600 text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm m-0">{{ $attempt->student->name }}</p>
                                            <span class="text-[0.7rem] text-slate-400 block mt-0.5">{{ $attempt->student->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-xs font-medium text-slate-600">
                                        <i class="ri-calendar-event-line text-slate-400"></i>
                                        {{ $attempt->completed_at ? $attempt->completed_at->format('M d, Y h:i A') : 'Incomplete attempt' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="font-bold text-slate-800">
                                        {{ $attempt->score ?? 0 }} <span class="text-xs text-slate-400">/ {{ $quiz->total_points }} pts</span>
                                    </span>
                                </td>
                                <td>
                                    @if($attempt->score && $quiz->total_points > 0)
                                        @php $percentage = ($attempt->score / $quiz->total_points) * 100; @endphp
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs font-bold {{ $percentage >= 80 ? 'text-green-600' : ($percentage >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                                                {{ round($percentage, 1) }}%
                                            </span>
                                            <div class="w-16 bg-gray-100 rounded-full h-1.5 overflow-hidden">
                                                <div class="bg-indigo-600 h-full rounded-full" style="width: {{ $percentage }}%"></div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-slate-300 text-xs font-bold">&mdash;</span>
                                    @endif
                                </td>
                                <td>
                                    @if($attempt->completed_at)
                                        @if($attempt->feedback || $attempt->score)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[0.68rem] font-bold bg-green-50 text-green-700">
                                                <i class="ri-checkbox-circle-fill"></i> Graded
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[0.68rem] font-bold bg-yellow-50 text-yellow-700">
                                                <i class="ri-time-fill"></i> Pending Manual Grade
                                            </span>
                                        @endif
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[0.68rem] font-bold bg-slate-100 text-slate-500">
                                            <i class="ri-loader-3-line"></i> In Progress
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($attempt->completed_at)
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('faculty.grade.submission', $attempt->id) }}" 
                                               class="text-indigo-600 hover:text-indigo-800 font-bold text-xs flex items-center gap-0.5" style="text-decoration: none;">
                                                <i class="ri-edit-line"></i> Grade
                                            </a>
                                            <button onclick="viewSubmission({{ $attempt->id }})" 
                                                    class="text-blue-600 hover:text-blue-800 font-bold text-xs flex items-center gap-0.5 border-none bg-transparent cursor-pointer">
                                                <i class="ri-eye-line"></i> Details
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-slate-300 text-xs font-medium">Incomplete</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-16 text-slate-400">
                                    <i class="ri-file-list-line text-6xl text-slate-200 mb-4 block"></i>
                                    No active attempts or submissions registered for this quiz yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal: View Detailed Submission -->
<div id="submissionModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h3>
                <i class="ri-file-list-3-line text-yellow-400"></i>
                Detailed Submission Report
            </h3>
            <button class="modal-close" onclick="closeSubmissionModal()">
                <i class="ri-close-line"></i>
            </button>
        </div>
        
        <div class="modal-body" id="modalContent">
            <!-- Dynamic submission data injects here -->
            <div class="text-center py-8">
                <p class="text-slate-400">Loading student submission file...</p>
            </div>
        </div>
        
        <div class="modal-footer">
            <button onclick="closeSubmissionModal()" class="btn-cancel">Close Panel</button>
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

<script>
    // Sidebar Toggle
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('mobile-open');
        });
    }

    // Logout Modal Logic
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

    // Fetch and display submission details in Modal overlay
    function viewSubmission(attemptId) {
        const modal = document.getElementById('submissionModal');
        modal.classList.add('active');
        
        fetch(`/faculty/attempts/${attemptId}/details`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let answersHtml = '';
                data.answers.forEach((answer, index) => {
                    const isCorrect = answer.is_correct ? 'text-green-600' : 'text-red-600';
                    const correctIcon = answer.is_correct ? 'ri-checkbox-circle-fill text-green-500' : 'ri-close-circle-fill text-red-500';
                    
                    answersHtml += `
                        <div class="border border-gray-100 rounded-xl p-4 bg-gray-50 mb-3">
                            <div class="flex justify-between items-center mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="bg-indigo-900 text-white text-[0.65rem] font-bold px-2 py-0.5 rounded-full uppercase">Q${index + 1}</span>
                                    <span class="text-xs text-gray-500 font-semibold">${answer.points} pts</span>
                                </div>
                                <i class="${correctIcon} text-xl"></i>
                            </div>
                            <p class="font-bold text-slate-800 text-sm mb-3">${escapeHtml(answer.question_text)}</p>
                            <div class="bg-white rounded-xl p-3 border border-gray-100">
                                <p class="text-xs text-slate-600 mb-1"><strong>Student's Answer:</strong></p>
                                <p class="text-sm font-semibold text-slate-800">${escapeHtml(answer.student_answer || 'No answer provided')}</p>
                                ${!answer.is_correct && answer.correct_answer ? `
                                    <div class="mt-2 pt-2 border-t border-gray-100">
                                        <p class="text-[0.65rem] text-green-600 mb-0.5"><strong>Correct Key Reference:</strong></p>
                                        <p class="text-xs font-bold text-green-700">${escapeHtml(answer.correct_answer)}</p>
                                    </div>
                                ` : ''}
                            </div>
                        </div>
                    `;
                });
                
                document.getElementById('modalContent').innerHTML = `
                    <div class="mb-5 p-4 bg-[#F8FAFF] rounded-2xl border border-blue-50">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                <i class="ri-user-line text-indigo-600 text-base"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm m-0">${escapeHtml(data.student_name)}</h4>
                                <span class="text-xs text-slate-400">Submission Report Summary</span>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div>
                                <p class="text-[0.65rem] text-gray-400 font-bold uppercase tracking-wider">Score Obtained</p>
                                <p class="text-lg font-bold text-slate-800">${data.score}/${data.total_points}</p>
                            </div>
                            <div>
                                <p class="text-[0.65rem] text-gray-400 font-bold uppercase tracking-wider">Grade Ratio</p>
                                <p class="text-lg font-bold ${data.percentage >= 60 ? 'text-green-600' : 'text-red-600'}">${data.percentage}%</p>
                            </div>
                            <div>
                                <p class="text-[0.65rem] text-gray-400 font-bold uppercase tracking-wider">Time Completed</p>
                                <p class="text-xs font-semibold text-slate-600 mt-1">${data.submitted_at}</p>
                            </div>
                            <div>
                                <p class="text-[0.65rem] text-gray-400 font-bold uppercase tracking-wider">Attempt State</p>
                                <p class="text-xs font-semibold text-slate-600 mt-1 uppercase">${data.status}</p>
                            </div>
                        </div>
                    </div>
                    <h4 class="font-bold text-slate-800 text-sm mb-3">Individual Answers Report</h4>
                    <div class="space-y-3">
                        ${answersHtml}
                    </div>
                `;
            }
        })
        .catch(error => {
            document.getElementById('modalContent').innerHTML = `
                <div class="text-center py-8">
                    <p class="text-red-500 font-bold">Error loading submission details report.</p>
                </div>
            `;
        });
    }
    
    function closeSubmissionModal() {
        const modal = document.getElementById('submissionModal');
        modal.classList.remove('active');
        document.getElementById('modalContent').innerHTML = `
            <div class="text-center py-8">
                <p class="text-slate-400">Loading student submission file...</p>
            </div>
        `;
    }
    
    function exportSubmissions() {
        const rows = [
            ['Student Name', 'Student Email', 'Submitted At', 'Score', 'Total Points', 'Percentage', 'Status']
        ];
        
        @foreach($attempts as $attempt)
            @php
                $percentage = $attempt->score && $quiz->total_points > 0 ? round(($attempt->score / $quiz->total_points) * 100, 1) : 0;
                $status = $attempt->feedback || $attempt->score ? 'Graded' : ($attempt->completed_at ? 'Pending' : 'In Progress');
            @endphp
            rows.push([
                '{{ addslashes($attempt->student->name) }}',
                '{{ $attempt->student->email }}',
                '{{ $attempt->completed_at ? $attempt->completed_at->format("Y-m-d H:i:s") : "N/A" }}',
                '{{ $attempt->score ?? "Not graded" }}',
                '{{ $quiz->total_points }}',
                '{{ $percentage }}%',
                '{{ $status }}'
            ]);
        @endforeach
        
        let csvContent = rows.map(row => row.join(',')).join('\n');
        const blob = new Blob([csvContent], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = '{{ $quiz->title }}_submissions_report.csv';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
    }
    
    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    // Close modal on background click
    document.getElementById('submissionModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeSubmissionModal();
        }
    });
</script>
</body>
</html>