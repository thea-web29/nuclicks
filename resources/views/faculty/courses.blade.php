<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Course Management - NU Horizon LMS</title>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        /* Course card styling */
        .course-card {
            background: white;
            border-radius: 1.5rem;
            transition: var(--transition);
            border: 1px solid rgba(10,31,68,0.06);
            box-shadow: var(--card-shadow);
            position: relative;
        }
        .course-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--blue-deep) 0%, var(--gold) 100%);
            border-top-left-radius: 1.5rem;
            border-top-right-radius: 1.5rem;
            opacity: 0;
            transition: var(--transition);
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 36px rgba(10,31,68,0.09);
            border-color: rgba(255, 215, 15, 0.4);
        }
        .course-card:hover::before {
            opacity: 1;
        }
        .badge-gold {
            background: rgba(255,215,15,0.18);
            color: #a16207;
            padding: 0.32rem 0.8rem;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 800;
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
            box-shadow: 0 30px 50px -15px rgba(0, 0, 0, 0.25);
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
            box-sizing: border-box;
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
            <a href="{{ route('faculty.quizzes.list') }}" class="nav-item {{ request()->routeIs('faculty.quizzes.list*') ? 'active' : '' }}">
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

<div class="main-content" id="mainContent">
    <div class="top-bar">
        <div class="flex items-center gap-3">
            <button class="menu-toggle" id="menuToggle">
                <i class="ri-menu-line"></i>
            </button>
            <div>
                <h2 style="font-weight:800;color:var(--blue-deep);font-size:1.15rem;margin:0;">Course Management</h2>
                <p class="text-xs text-gray-500 hidden md:block">Manage your academic syllabus, quizzes, and student lists</p>
            </div>
        </div>
        <div>
            <button id="openCreateCourseModalBtn" class="flex items-center gap-1.5 px-6 py-2.5 rounded-full text-xs font-bold transition shadow-sm border-0 bg-yellow-400 hover:bg-yellow-500 text-[#0A1F44] cursor-pointer">
                <i class="ri-add-line text-sm"></i> Create Course
            </button>
        </div>
    </div>

    <div class="p-4 md:p-6">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-xl mb-6 shadow-sm flex items-center gap-2">
                <i class="ri-checkbox-circle-line text-green-600 text-lg"></i>
                <span class="font-semibold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @if(isset($courses) && $courses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                    <div class="course-card p-6 flex flex-col transition-all duration-200">
                        <div class="flex justify-between items-center mb-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-slate-100 text-[#0A1F44] border border-slate-200/50">
                                {{ $course->code }}
                            </span>
                            <span class="badge-gold flex items-center gap-1.5 text-[10px] font-extrabold uppercase">
                                <i class="ri-group-line text-xs"></i> {{ $course->students_count ?? 0 }} enrolled
                            </span>
                        </div>

                        <div class="flex gap-3.5 items-center mb-4">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center font-black text-sm text-[#0A1F44] bg-gradient-to-tr from-amber-300 via-yellow-400 to-yellow-300 shadow-sm border border-white/50 shrink-0">
                                {{ strtoupper(substr($course->name, 0, 2)) }}
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-extrabold text-slate-800 text-base truncate tracking-tight leading-tight m-0" style="color:var(--blue-deep);">
                                    {{ $course->name }}
                                </h4>
                                <p class="text-[11px] text-gray-400 truncate mt-1">Active Course Syllabus</p>
                            </div>
                        </div>
                        
                        <div class="mt-4 flex justify-between text-xs text-gray-500 border-t border-gray-100/80 pt-3">
                            <span class="flex items-center gap-1.5 font-semibold"><i class="ri-quiz-line text-indigo-500 text-sm"></i> Quizzes: <strong class="text-slate-800">{{ $course->quizzes_count ?? 0 }}</strong></span>
                            <span class="flex items-center gap-1.5 font-semibold"><i class="ri-bookmark-3-line text-amber-500 text-sm"></i> Credits: <strong class="text-slate-800">{{ $course->credits ?? 0 }}</strong></span>
                        </div>
                        
                        <div class="mt-6 flex gap-2">
                            <a href="{{ route('faculty.course.details', $course->id) }}" 
                               class="flex-grow text-center text-xs font-extrabold py-2.5 rounded-xl transition-all duration-200 shadow-sm hover:shadow text-white hover:opacity-95" 
                               style="background:#0A1F44; text-decoration: none;">
                                Manage Course
                            </a>
                            <a href="{{ route('faculty.quiz.create.for.course', $course->id) }}" 
                               class="flex-grow text-center text-xs font-extrabold py-2.5 rounded-xl border border-gray-300 transition-all hover:border-gold hover:bg-yellow-50/50 text-slate-700"
                               style="text-decoration: none;">
                                <i class="ri-add-circle-line mr-1 text-yellow-500"></i> Add Quiz
                            </a>
                            
                            <div class="relative">
                                <button onclick="toggleDropdown({{ $course->id }}, event)" 
                                        class="px-3 py-2 rounded-xl border border-gray-300 transition-all hover:border-gold hover:bg-gray-50 flex items-center justify-center h-full cursor-pointer">
                                    <i class="ri-more-2-line text-slate-600"></i>
                                </button>
                                <div id="dropdown-{{ $course->id }}" class="absolute right-0 mt-2 hidden z-50 bg-white rounded-xl shadow-xl border border-gray-200 py-1.5 min-w-[190px]">
                                    <button type="button"
                                            data-id="{{ $course->id }}"
                                            data-code="{{ $course->code }}"
                                            data-name="{{ $course->name }}"
                                            data-section="{{ $course->section }}"
                                            data-description="{{ $course->description }}"
                                            onclick="initEditCourse(this, event)"
                                            class="flex items-center w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition gap-3 border-none bg-transparent cursor-pointer">
                                        <i class="ri-edit-line text-yellow-600 text-base"></i>
                                        <span>Edit Course</span>
                                    </button>
                                    <a href="{{ route('faculty.results', $course->id) }}" 
                                       class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition gap-3"
                                       style="text-decoration: none;">
                                        <i class="ri-bar-chart-line text-blue-600 text-base"></i>
                                        <span>View Analytics</span>
                                    </a>
                                    <div class="border-t border-gray-100 my-1"></div>
                                    <form action="{{ route('faculty.delete.course', $course->id) }}" method="POST" style="margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="flex items-center w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-gray-50 transition gap-3 border-none bg-none cursor-pointer"
                                                onclick="return confirm('⚠️ Delete this course? All associated quizzes, submissions, and enrollments will be permanently lost. This action cannot be undone.')">
                                            <i class="ri-delete-bin-line text-base"></i>
                                            <span>Delete Course</span>
                                        </button>
                                    </form>
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

<!-- ======================= MODAL: EDIT COURSE (PROFESSIONAL THEME) ======================= -->
<div id="editCourseModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h3>
                <i class="ri-edit-line"></i> 
                Edit Course
            </h3>
            <div class="modal-close" id="closeEditModalBtn">
                <i class="ri-close-line"></i>
            </div>
        </div>
        
        <form id="editCourseForm" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="modal-body">
                {{-- Read-only info (sent as readonly inputs to satisfy Laravel request validation) --}}
                <div class="form-group">
                    <label class="form-label">Subject Code</label>
                    <input type="text" id="edit_code" name="code" readonly required
                           class="form-control bg-gray-50 text-gray-400 font-semibold cursor-not-allowed" style="border-color: rgba(10,31,68,0.05);">
                </div>

                <div class="form-group">
                    <label class="form-label">Subject Name</label>
                    <input type="text" id="edit_name" name="name" readonly required
                           class="form-control bg-gray-50 text-gray-400 font-semibold cursor-not-allowed" style="border-color: rgba(10,31,68,0.05);">
                </div>

                <div class="form-group">
                    <label class="form-label">Section</label>
                    <input type="text" id="edit_section" name="section" readonly
                           class="form-control bg-gray-50 text-gray-400 font-semibold cursor-not-allowed" style="border-color: rgba(10,31,68,0.05);">
                </div>

                {{-- Editable fields --}}
                <div class="form-group">
                    <label class="form-label" for="edit_description">Description</label>
                    <textarea id="edit_description" name="description" rows="3" class="form-control" placeholder="Short description of this course..."></textarea>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" id="cancelEditModalBtn" class="btn-cancel">Cancel</button>
                <button type="submit" class="btn-submit">
                    <i class="ri-save-line"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ======================= LOGOUT CONFIRMATION MODAL ======================= -->
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
        
        if (activeDropdown && activeDropdown !== dropdown) {
            activeDropdown.classList.add('hidden');
        }
        
        if (dropdown.classList.contains('hidden')) {
            dropdown.classList.remove('hidden');
            activeDropdown = dropdown;
        } else {
            dropdown.classList.add('hidden');
            activeDropdown = null;
        }
    }
    
    document.addEventListener('click', function(event) {
        if (activeDropdown && !event.target.closest('.relative')) {
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

    // ======================= EDIT COURSE MODAL LOGIC =======================
    const editModal = document.getElementById('editCourseModal');
    const closeEditModalBtn = document.getElementById('closeEditModalBtn');
    const cancelEditModalBtn = document.getElementById('cancelEditModalBtn');
    const editCourseForm = document.getElementById('editCourseForm');
    
    function initEditCourse(btn, event) {
        if (event) event.stopPropagation();
        
        const id = btn.getAttribute('data-id');
        const code = btn.getAttribute('data-code');
        const name = btn.getAttribute('data-name');
        const section = btn.getAttribute('data-section');
        const description = btn.getAttribute('data-description');
        
        // Populate fields
        document.getElementById('edit_code').value = code || '';
        document.getElementById('edit_name').value = name || '';
        document.getElementById('edit_section').value = section || '';
        document.getElementById('edit_description').value = description || '';
        
        // Dynamically set action URL
        editCourseForm.action = `/faculty/courses/${id}`;
        
        // Show modal
        editModal.classList.add('active');
        document.body.style.overflow = 'hidden';
        
        // Close dropdown
        if (activeDropdown) {
            activeDropdown.classList.add('hidden');
            activeDropdown = null;
        }
    }
    
    function closeEditModal() {
        editModal.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    if (closeEditModalBtn) closeEditModalBtn.addEventListener('click', closeEditModal);
    if (cancelEditModalBtn) cancelEditModalBtn.addEventListener('click', closeEditModal);
    
    editModal.addEventListener('click', function(e) {
        if (e.target === editModal) {
            closeEditModal();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && editModal.classList.contains('active')) {
            closeEditModal();
        }
    });
    
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

    // ======================= LOGOUT CONFIRMATION MODAL LOGIC =======================
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