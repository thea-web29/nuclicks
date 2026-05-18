<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Faculty Dashboard - NU Horizon LMS</title>

    <!-- Google Fonts + Font Awesome + Remix Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:opsz,wght@9..144,600;9..144,700;9..144,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: { preflight: false }
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
            --navy: #0A1F44;
            --navy-mid: #1F3A6D;
            --navy-lite: #3D5FA0;
            --navy-pale: #EEF3FB;
            --gold: #FFD70F;
            --gold-d: #C49A00;
            --gold-mid: #F5C800;
            --gold-pale: #FFFBEA;
            --bg: #F8F6F1;
            --bg-2: #F2EEE5;
            --white: #FFFFFF;
            --txt-1: #0A1F44;
            --txt-2: #2C3E5C;
            --txt-3: #637089;
            --bdr: rgba(10,31,68,0.09);
            --bdr-gold: rgba(196,154,0,0.28);
            --card-shadow: 0 8px 20px rgba(10,31,68,0.05);
            --transition: all 0.25s ease;
            --danger-red: #dc2626;
            --danger-dark: #b91c1c;
            --ease: cubic-bezier(0.22,1,0.36,1);
            --spring: cubic-bezier(0.34,1.56,0.64,1);
        }

        /* Sidebar */
        

        @media (max-width: 1024px) {
            

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            
        }

        

        

        

        

        

        

        

        .logo-text .horizon-word::before,
        .logo-text .horizon-word::after {
            content: none !important;
            display: none !important;
        }

        /* Natural sunrise rays placed above the letter I in HORIZON */
        

        

        

        .sun-rays .ray-1 {
            height: 20px;
            opacity: 0.45;
            transform: translateX(-50%) rotate(-64deg);
        }

        .sun-rays .ray-2 {
            height: 24px;
            opacity: 0.58;
            transform: translateX(-50%) rotate(-48deg);
        }

        .sun-rays .ray-3 {
            height: 28px;
            opacity: 0.70;
            transform: translateX(-50%) rotate(-32deg);
        }

        .sun-rays .ray-4 {
            height: 31px;
            opacity: 0.82;
            transform: translateX(-50%) rotate(-16deg);
        }

        .sun-rays .ray-5 {
            height: 34px;
            opacity: 1;
            width: 2.5px;
            transform: translateX(-50%) rotate(0deg);
        }

        .sun-rays .ray-6 {
            height: 31px;
            opacity: 0.82;
            transform: translateX(-50%) rotate(16deg);
        }

        .sun-rays .ray-7 {
            height: 28px;
            opacity: 0.70;
            transform: translateX(-50%) rotate(32deg);
        }

        .sun-rays .ray-8 {
            height: 24px;
            opacity: 0.58;
            transform: translateX(-50%) rotate(48deg);
        }

        .sun-rays .ray-9 {
            height: 20px;
            opacity: 0.45;
            transform: translateX(-50%) rotate(64deg);
        }

        .nav-section {
            padding: 0 1rem;
            margin-top: 1.5rem;
        }

        .nav-section-title {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255,215,15,0.5);
            margin-bottom: 0.75rem;
            font-weight: 700;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 1rem;
            border-radius: 12px;
            color: rgba(255,255,255,0.75);
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
            background: rgba(255,215,15,0.12);
            color: white;
        }

        .nav-item.active {
            background: var(--gold);
            color: var(--navy);
        }

        .nav-item.active i {
            color: var(--navy);
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
            margin-bottom: 0;
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
            box-shadow: 0 4px 10px rgba(220, 38, 38, 0.3);
        }

        .logout-btn i {
            font-size: 1.1rem;
        }

        

        .top-bar {
            background: white;
            padding: 0.75rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            border-bottom: 1px solid var(--bdr);
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
            color: var(--navy);
        }

        .page-title {
            font-weight: 700;
            color: var(--navy);
            font-family: 'Fraunces', serif;
        }

        .header-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-search {
            display: flex;
            align-items: center;
            background: #F5F7FB;
            border-radius: 40px;
            padding: 0.4rem 1rem;
            gap: 0.5rem;
            border: 1px solid var(--bdr);
        }

        .header-search i {
            color: var(--txt-3);
            font-size: 0.9rem;
        }

        .header-search input {
            border: none;
            background: transparent;
            outline: none;
            font-size: 0.8rem;
            width: 160px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .header-search input::placeholder {
            color: var(--txt-3);
        }

        .header-avatar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            padding: 0.3rem 0.8rem;
            border-radius: 40px;
            transition: background 0.2s;
        }

        .header-avatar:hover {
            background: #F5F7FB;
        }

        .header-avatar-img {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--navy), var(--navy-mid));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            border: 2px solid var(--gold);
        }

        .header-avatar-info {
            text-align: right;
        }

        .header-avatar-name {
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--navy);
        }

        .header-avatar-role {
            font-size: 0.65rem;
            color: var(--txt-3);
        }

        .header-logout-btn {
            background: none;
            border: none;
            color: var(--txt-3);
            font-size: 1.1rem;
            cursor: pointer;
            padding: 0.3rem;
            border-radius: 50%;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-logout-btn:hover {
            color: var(--danger-red);
            background: rgba(220,38,38,0.1);
        }

        @media (max-width: 1024px) {
            .menu-toggle {
                display: block;
            }

            

            .header-search input {
                width: 100px;
            }

            .header-avatar-info {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .header-search {
                display: none;
            }
        }

        .stat-card {
            background: white;
            border-radius: 1.2rem;
            padding: 1.2rem;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            border: 1px solid var(--bdr);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(10,31,68,0.08);
        }

        .gold-accent {
            border-left: 4px solid var(--gold);
        }

        .badge-gold {
            background: var(--gold-pale);
            color: var(--gold-d);
            padding: 0.25rem 0.7rem;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 700;
        }

        .course-card {
            border-radius: 1rem;
            transition: var(--transition);
            background: white;
            border: 1px solid var(--bdr);
        }

        .course-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.06);
        }

        .dashboard-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--navy);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'Fraunces', serif;
        }

        .section-title i {
            color: var(--gold);
            font-size: 1.4rem;
        }

        .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            background: var(--bg-2);
            border-radius: 1.2rem;
            color: var(--txt-3);
        }

        .recent-item {
            transition: background 0.2s ease;
            border-radius: 0.75rem;
        }

        .recent-item:hover {
            background: var(--navy-pale);
        }

        .welcome-header {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
            border-radius: 1.5rem;
            padding: 1.5rem 2rem;
            margin-bottom: 1.8rem;
            color: white;
        }

        .welcome-badge {
            background: rgba(255,215,15,0.18);
            border-radius: 40px;
            padding: 0.3rem 1rem;
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--gold);
        }

        .date-chip {
            background: rgba(255,255,255,0.12);
            border-radius: 40px;
            padding: 0.4rem 1rem;
            font-size: 0.8rem;
        }

        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 0.8rem;
        }

        .quick-action-item {
            background: white;
            border-radius: 1rem;
            padding: 0.9rem 0.5rem;
            text-align: center;
            transition: all 0.2s ease;
            border: 1px solid var(--bdr);
            cursor: pointer;
        }

        .quick-action-item:hover {
            transform: translateY(-3px);
            border-color: var(--gold);
            box-shadow: 0 8px 16px rgba(0,0,0,0.05);
        }

        .quick-action-icon {
            font-size: 1.5rem;
            color: var(--navy);
            margin-bottom: 0.4rem;
            display: block;
        }

        .quick-action-label {
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--txt-2);
        }

        .today-classes-card {
            background: white;
            border-radius: 1.2rem;
            border: 1px solid var(--bdr);
        }

        .recent-lesson-item {
            border-left: 3px solid var(--gold);
            transition: all 0.2s;
        }

        .recent-lesson-item:hover {
            background: var(--navy-pale);
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(10,31,68,0.85);
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
            box-shadow: 0 25px 40px rgba(0,0,0,0.2);
            overflow: hidden;
            transform: scale(0.95);
            transition: transform 0.2s var(--spring);
        }

        .modal-overlay.active .confirmation-modal {
            transform: scale(1);
        }

        .modal-header {
            background: var(--navy);
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
            font-family: 'Fraunces', serif;
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
            color: var(--txt-1);
            font-weight: 500;
        }

        .modal-footer {
            padding: 1rem 1.5rem 1.5rem;
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            background: #f9fafb;
            border-top: 1px solid var(--bdr);
        }

        .modal-btn {
            padding: 0.6rem 1.25rem;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .modal-btn-cancel {
            background: #eef2ff;
            color: #1e293b;
        }

        .modal-btn-cancel:hover {
            background: #e2e8f0;
            transform: translateY(-1px);
        }

        .modal-btn-confirm {
            background: var(--danger-red);
            color: white;
        }

        .modal-btn-confirm:hover {
            background: var(--danger-dark);
            transform: translateY(-1px);
        }

        @media (max-width: 500px) {
            .modal-footer {
                flex-direction: column-reverse;
            }

            .modal-btn {
                width: 100%;
            }
        }
    
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

<!-- Sidebar -->
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
            <button type="button" id="logoutButtonSidebar" class="logout-btn">
                <i class="ri-logout-box-r-line"></i> Sign Out
            </button>
        </div>
    </aside>

<!-- Main Content -->
<div class="main-content" id="mainContent">
    <div class="top-bar">
        <div class="flex items-center gap-3">
            <button class="menu-toggle" id="menuToggle">
                <i class="ri-menu-line"></i>
            </button>

            <h2 class="page-title text-lg md:text-xl">Dashboard</h2>
        </div>

        <div class="header-profile">
            <div class="header-search">
                <i class="ri-search-line"></i>
                <input type="text" placeholder="Search files...">
            </div>

            <div class="header-avatar" id="headerAvatar">
                <div class="header-avatar-img">
                    <i class="ri-user-line"></i>
                </div>

                <div class="header-avatar-info">
                    <div class="header-avatar-name">{{ Auth::user()->name ?? 'BABYLYN P BARTE' }}</div>
                    <div class="header-avatar-role">Faculty</div>
                </div>
            </div>

        </div>
    </div>

    <div class="p-4 md:p-6">
        <div class="welcome-header">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 flex-wrap mb-2">
                        <h1 class="text-2xl md:text-3xl font-bold" style="font-family:'Fraunces',serif">
                            Welcome, {{ Auth::user()->name ?? 'BABYLYN P BARTE' }}
                        </h1>

                        <span class="welcome-badge">
                            <i class="ri-star-fill mr-1"></i> Faculty · All Grade
                        </span>
                    </div>

                    <div class="flex items-center gap-2 text-white/80 text-sm">
                        <i class="ri-calendar-line"></i>
                        <span class="date-chip" id="currentDate">Friday, May 8, 2026</span>
                    </div>
                </div>

                <div class="flex gap-2">
                    <div class="bg-white/10 rounded-full px-3 py-1.5 text-xs font-medium flex items-center gap-1 backdrop-blur-sm">
                        <i class="ri-notification-3-line" style="color:var(--gold)"></i> Notifications
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="today-classes-card p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="ri-calendar-todo-line text-xl" style="color: var(--gold);"></i> Today's Classes
                    </h3>

                    <i class="ri-more-2-fill text-gray-400"></i>
                </div>

                <div class="empty-state py-6 bg-gray-50/50 rounded-xl">
                    <i class="ri-calendar-close-line text-3xl text-gray-300"></i>
                    <p class="text-gray-400 text-sm mt-2">No classes scheduled for Friday.</p>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <h3 class="font-bold text-gray-800 flex items-center gap-2 mb-4">
                    <i class="ri-flashlight-line text-xl" style="color: var(--gold);"></i> Quick Actions
                </h3>

                <div class="quick-actions-grid">
                    <div class="quick-action-item" onclick="window.location.href='{{ route('faculty.quiz.create') }}'">
                        <i class="ri-upload-cloud-line quick-action-icon"></i>
                        <span class="quick-action-label">Upload Lesson</span>
                    </div>

                    <div class="quick-action-item" onclick="window.location.href='{{ route('faculty.courses') }}'">
                        <i class="ri-book-open-line quick-action-icon"></i>
                        <span class="quick-action-label">Manage Class</span>
                    </div>

                    <div class="quick-action-item" onclick="window.location.href='{{ route('faculty.students') }}'">
                        <i class="ri-calendar-line quick-action-icon"></i>
                        <span class="quick-action-label">My Schedule</span>
                    </div>

                    <div class="quick-action-item" onclick="window.location.href='{{ route('faculty.quizzes.list') }}'">
                        <i class="ri-file-copy-line quick-action-icon"></i>
                        <span class="quick-action-label">Submissions</span>
                    </div>

                    <div class="quick-action-item">
                        <i class="ri-folder-chart-line quick-action-icon"></i>
                        <span class="quick-action-label">Content</span>
                    </div>

                    <div class="quick-action-item" onclick="window.location.href='{{ route('faculty.folder-files') }}'">
                        <i class="ri-folder-line quick-action-icon"></i>
                        <span class="quick-action-label">My Files</span>
                    </div>
                </div>
            </div>
        </div>

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
                        <i class="ri-file-list-3-line text-purple-600 text-2xl"></i>
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

        <div class="dashboard-section">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                            <i class="ri-user-add-line text-xl" style="color:var(--gold)"></i> Recent Enrollments
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

                                        <span class="text-xs text-green-700 bg-green-50 px-2 py-1 rounded-full">
                                            {{ $enrollment->created_at->diffForHumans() }}
                                        </span>
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
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                            <i class="ri-quiz-line text-xl" style="color:var(--gold)"></i> Recent Quizzes
                        </h3>

                        <a href="{{ route('faculty.quizzes.list') }}" class="text-sm font-medium flex items-center gap-1 hover:underline" style="color:var(--navy)">
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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                        <i class="ri-history-line" style="color: var(--gold);"></i> Recent Lessons
                    </h3>

                    <span class="text-xs text-gray-400">Latest updates</span>
                </div>

                <div class="p-4">
                    <div class="recent-lesson-item p-3 rounded-lg mb-2 bg-gray-50/30">
                        <p class="font-medium text-gray-800">Media and Information Litera...</p>
                        <p class="text-xs text-gray-500 mt-1">OOP-11 - Object Oriented Programming · 5 days ago</p>
                    </div>

                    <div class="text-center text-xs text-gray-400 mt-2">
                        <i class="ri-folder-line"></i> 2 more lessons available
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                        <i class="ri-star-smile-line" style="color: var(--gold);"></i> My Evaluation
                    </h3>

                    <a href="{{ route('faculty.my-evaluation') }}" class="text-sm font-medium flex items-center gap-1 hover:underline" style="color:var(--navy)">
                        View Details <i class="ri-arrow-right-line"></i>
                    </a>
                </div>

                <div class="p-5">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Average Rating</p>
                            <p class="text-3xl font-extrabold text-gray-800">{{ number_format($averageEvaluationRating ?? 0, 2) }}/5</p>
                            <p class="text-xs text-gray-400 mt-1">Based on {{ $evaluationCount ?? 0 }} student evaluation(s)</p>
                        </div>

                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center" style="background: rgba(255,215,15,0.18); color: var(--navy);">
                            <i class="ri-star-smile-line text-3xl"></i>
                        </div>
                    </div>

                    @if(isset($recentEvaluations) && $recentEvaluations->count() > 0)
                        <div class="mt-5 space-y-3">
                            @foreach($recentEvaluations->take(2) as $evaluation)
                                <div class="p-3 rounded-xl bg-gray-50 border border-gray-100">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="font-semibold text-sm text-gray-700">{{ $evaluation->course->name ?? 'General Evaluation' }}</span>
                                        <span class="text-xs font-bold" style="color: var(--navy);">{{ number_format($evaluation->rating ?? 0, 1) }}/5</span>
                                    </div>

                                    <p class="text-xs text-gray-500 line-clamp-2">{{ $evaluation->comment ?? 'No written comment provided.' }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state py-6 mt-3">
                            <i class="ri-chat-smile-3-line text-3xl text-gray-300"></i>
                            <p class="text-gray-400 mt-2">No student evaluations yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="dashboard-section">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center flex-wrap gap-3">
                    <div class="section-title">
                        <i class="ri-book-open-line text-2xl"></i>
                        <span>My Courses</span>
                    </div>

                    @if(isset($courses) && $courses->count() > 0)
                        <a href="{{ route('faculty.courses') }}" class="text-sm font-medium flex items-center gap-1 hover:underline" style="color:var(--navy)">
                            Manage all <i class="ri-arrow-right-line"></i>
                        </a>
                    @endif
                </div>

                <div class="p-5">
                    @if(isset($courses) && $courses->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                            @foreach($courses as $course)
                                <div class="course-card p-4 rounded-xl hover:shadow-md transition-all duration-200">
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
                                        <a href="{{ route('faculty.quiz.create.for.course', $course->id) }}" class="flex-1 text-center text-xs font-semibold py-2.5 rounded-lg transition-all duration-200 shadow-sm hover:shadow" style="background:var(--navy); color:white;">
                                            <i class="ri-quiz-line mr-1"></i> Create Quiz
                                        </a>

                                        <a href="{{ route('faculty.course.details', $course->id) }}" class="flex-1 text-center text-xs font-semibold py-2.5 rounded-lg border border-gray-300 hover:border-gold transition-all hover:bg-gray-50">
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

<div id="logoutModal" class="modal-overlay">
    <div class="confirmation-modal">
        <div class="modal-header">
            <h3><i class="ri-logout-box-r-line"></i> Confirm Sign Out</h3>
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
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateElem = document.getElementById('currentDate');

    if (dateElem) {
        dateElem.innerText = new Date().toLocaleDateString('en-US', options);
    }

    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');

    if (menuToggle) {
        menuToggle.addEventListener('click', () => sidebar.classList.toggle('mobile-open'));
    }

    document.addEventListener('click', (event) => {
        const isMobile = window.innerWidth <= 1024;

        if (isMobile && sidebar.classList.contains('mobile-open')) {
            if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                sidebar.classList.remove('mobile-open');
            }
        }
    });

    const currentUrl = window.location.pathname;

    document.querySelectorAll('.nav-item').forEach(item => {
        const href = item.getAttribute('href');

        if (href && currentUrl.includes(href) && href !== '/faculty/dashboard') {
            item.classList.add('active');
        } else if (currentUrl === '/faculty/dashboard' && href === '/faculty/dashboard') {
            item.classList.add('active');
        }
    });

    const logoutButtons = document.querySelectorAll('#logoutButtonHeader, #logoutButtonSidebar');
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

    logoutButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            openModal();
        });
    });

    if (confirmBtn) {
        confirmBtn.addEventListener('click', () => {
            if (logoutForm) {
                logoutForm.submit();
            } else {
                window.location.href = "{{ route('logout') }}";
            }
        });
    }

    if (cancelBtn) {
        cancelBtn.addEventListener('click', closeModal);
    }

    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', closeModal);
    }

    if (logoutModal) {
        logoutModal.addEventListener('click', (e) => {
            if (e.target === logoutModal) {
                closeModal();
            }
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && logoutModal.classList.contains('active')) {
            closeModal();
        }
    });
</script>

<form method="POST" action="{{ route('logout') }}" id="logoutForm" style="display: none;">
    @csrf
</form>

</body>
</html>