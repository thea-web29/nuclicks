<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>{{ $course->code }} - Course Details - NU Horizon LMS</title>
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

        /* Tabs and Cards */
        .glass-card {
            background: white;
            border-radius: 1.5rem;
            border: 1px solid rgba(10,31,68,0.06);
            box-shadow: var(--card-shadow);
        }
        .tab-link {
            text-decoration: none;
            transition: var(--transition);
        }
        .tab-link.active-tab {
            border-bottom-color: var(--blue-deep);
            color: var(--blue-deep) !important;
            font-weight: 800;
        }

        /* Standardized Modals */
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
            max-width: 500px;
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
            font-size: 1.3rem;
            letter-spacing: -0.2px;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            color: white;
            margin: 0;
        }
        .modal-header h3 i {
            color: var(--gold);
            font-size: 1.5rem;
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
        }
        .btn-submit:hover {
            background: #0F2A5C;
        }

        /* Data table styles */
        .premium-table {
            width: 100%;
            border-collapse: collapse;
        }
        .premium-table th {
            background: #F8FAFC;
            color: #475569;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #E2E8F0;
        }
        .premium-table td {
            padding: 1rem 1.5rem;
            font-size: 0.85rem;
            color: #1E293B;
            border-bottom: 1px solid #F1F5F9;
        }
        .premium-table tr:hover {
            background-color: #F8FAFC/50;
        }

        /* ===== LOGOUT CONFIRMATION MODAL STYLES ===== */
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
        .logout-modal-btn-confirm {
            background: var(--danger-red);
            color: white;
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
            <a href="{{ route('faculty.dashboard') }}" class="nav-item">
                <i class="ri-dashboard-line"></i> Dashboard
            </a>
            <a href="{{ route('faculty.students') }}" class="nav-item">
                <i class="ri-user-line"></i> Students
            </a>
            <a href="{{ route('faculty.courses') }}" class="nav-item active">
                <i class="ri-book-line"></i> Courses
            </a>
            <a href="{{ route('faculty.folder-files') }}" class="nav-item">
                <i class="ri-folder-3-line"></i> Files & Folders
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Quiz Management</div>
            <a href="{{ route('faculty.quiz.create') }}" class="nav-item">
                <i class="ri-add-circle-line"></i> Create Quiz
            </a>
            <a href="{{ route('faculty.quizzes.list') }}" class="nav-item">
                <i class="ri-list-check"></i> All Quizzes
            </a>
            <a href="{{ route('faculty.question.bank') }}" class="nav-item">
                <i class="ri-database-2-line"></i> Question Bank
            </a>
            <a href="{{ route('faculty.grading') }}" class="nav-item">
                <i class="ri-graduation-cap-line"></i> Grading
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Analytics</div>
            <a href="{{ route('faculty.results.index') }}" class="nav-item">
                <i class="ri-bar-chart-line"></i> Results & Analytics
            </a>
            <a href="{{ route('faculty.my-evaluation') }}" class="nav-item">
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
                <h2 style="font-weight:800;color:var(--blue-deep);font-size:1.15rem;margin:0;">
                    {{ $course->code }} — {{ $course->name }}
                </h2>
                <p class="text-xs text-gray-500 hidden md:block">
                    Manage students, materials, announcements, and quiz lists
                </p>
            </div>
        </div>
        <div>
            <a href="{{ route('faculty.announcements', $course->id) }}"
               class="flex items-center gap-1.5 px-5 py-2.5 rounded-full text-xs font-bold transition shadow-sm border-0 bg-yellow-400 hover:bg-yellow-500 text-[#0A1F44]" style="text-decoration:none;">
                <i class="ri-megaphone-line"></i> Announcements
            </a>
        </div>
    </div>

    <div class="p-4 md:p-6">

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-xl mb-6 shadow-sm flex items-center gap-2">
                <i class="ri-checkbox-circle-line text-green-600 text-lg"></i>
                <span class="font-semibold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-xl mb-6 shadow-sm flex items-center gap-2">
                <i class="ri-error-warning-line text-red-600 text-lg"></i>
                <span class="font-semibold text-sm">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Summary Bento Row -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div class="glass-card p-6 flex gap-4 items-center">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center font-black text-lg text-[#0A1F44] bg-gradient-to-tr from-amber-300 via-yellow-400 to-yellow-300 shadow-sm border border-white/50 shrink-0">
                    {{ strtoupper(substr($course->name, 0, 2)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-[10px] uppercase font-black tracking-wider text-gray-400">Class Focus</p>
                    <h3 class="text-base font-extrabold text-slate-800 truncate m-0" style="color:var(--blue-deep);">{{ $course->name }}</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Section: <strong>{{ $course->section ?? 'N/A' }}</strong></p>
                </div>
            </div>

            <div class="glass-card p-6 flex justify-between items-center relative overflow-hidden">
                <div class="min-w-0 z-10">
                    <p class="text-[10px] uppercase font-black tracking-wider text-gray-400">Current Join Code</p>
                    <h3 class="text-2xl font-black font-mono text-indigo-700 m-0 tracking-widest mt-1">
                        {{ $course->join_code ?? 'NONE' }}
                    </h3>
                    <p class="text-[10px] text-gray-500 mt-1">Share this code with eligible students.</p>
                </div>
                <i class="ri-key-2-line text-6xl text-slate-100 absolute -right-3 -bottom-3 rotate-12 z-0"></i>
            </div>

            <div class="glass-card p-6 flex justify-between items-center relative overflow-hidden">
                <div class="min-w-0 z-10">
                    <p class="text-[10px] uppercase font-black tracking-wider text-gray-400">Enrolled Students</p>
                    <h3 class="text-2xl font-black text-slate-800 m-0 mt-1" style="color:var(--blue-deep);">
                        {{ $course->students->count() }} Enrolled
                    </h3>
                    <p class="text-[10px] text-gray-500 mt-1">
                        {{ ($eligibleStudents ?? collect())->count() }} eligible matching student records found.
                    </p>
                </div>
                <i class="ri-group-line text-6xl text-slate-100 absolute -right-3 -bottom-3 rotate-12 z-0"></i>
            </div>
        </div>

        <!-- Class Access Action Area -->
        <div class="bg-indigo-50/50 rounded-2xl p-5 mb-6 border border-indigo-100/60 shadow-sm">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                <div>
                    <h3 class="text-base font-extrabold text-indigo-950 m-0">Quick Class Enrollment</h3>
                    <p class="text-xs text-indigo-700 mt-1">
                        Synchronize enrolled students who match this course's section code, then automatically generate and email the class join credentials.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <form action="{{ route('faculty.course.add-eligible-students', $course->id) }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit"
                                class="bg-indigo-900 text-white px-5 py-2.5 rounded-xl hover:bg-opacity-95 text-xs font-bold transition border-none shadow-sm cursor-pointer"
                                onclick="return confirm('Add all eligible students from this course and section?')">
                            <i class="ri-user-add-line mr-1"></i> Add Students
                        </button>
                    </form>

                    <form action="{{ route('faculty.course.generate-code', $course->id) }}" method="POST" style="margin:0;">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                                class="bg-yellow-400 text-[#0A1F44] px-5 py-2.5 rounded-xl hover:bg-yellow-500 text-xs font-bold transition border-none shadow-sm cursor-pointer"
                                onclick="return confirm('Generate join code and email students in this course and section?')">
                            <i class="ri-mail-send-line mr-1"></i> Generate & Email Code
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="border-b border-gray-200 mb-6">
            <nav class="flex space-x-8">
                <a href="#" class="tab-link active-tab py-2 px-1 border-b-2 border-transparent text-gray-500 font-bold text-sm" data-tab="eligible">
                    Eligible Students
                </a>

                <a href="#" class="tab-link py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-bold text-sm" data-tab="students">
                    Enrolled Students
                </a>

                <a href="#" class="tab-link py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-bold text-sm" data-tab="materials">
                    Materials
                </a>

                <a href="#" class="tab-link py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-bold text-sm" data-tab="quizzes">
                    Quizzes
                </a>
            </nav>
        </div>

        <!-- Tab: Eligible -->
        <div id="eligible" class="tab-content">
            <div class="glass-card overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-base font-extrabold m-0" style="color:var(--blue-deep);">Eligible Registered Students</h3>
                    <p class="text-xs text-gray-500 mt-1">Students registered under this course and section who can join this class group.</p>
                </div>

                @if(($eligibleStudents ?? collect())->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="premium-table">
                            <thead>
                            <tr>
                                <th>Student</th>
                                <th>Student ID</th>
                                <th>Email</th>
                                <th>Section</th>
                                <th>Class Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($eligibleStudents as $student)
                                @php
                                    $isEnrolled = $course->students->contains('id', $student->id);
                                @endphp
                                <tr>
                                    <td class="font-bold text-slate-800">{{ $student->name }}</td>
                                    <td class="font-mono text-xs">{{ $student->student_id ?? 'N/A' }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td class="font-semibold">{{ $student->section ?? 'N/A' }}</td>
                                    <td>
                                        @if($isEnrolled)
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-green-100 text-green-800">
                                                Already Added
                                            </span>
                                        @else
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-100 text-amber-800">
                                                Not Yet Added
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-16">
                        <i class="ri-user-search-line text-5xl text-gray-300 mb-4 block"></i>
                        <p class="text-gray-500 font-semibold">No matching eligible student rosters found.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tab: Enrolled -->
        <div id="students" class="tab-content hidden">
            <div class="glass-card overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-base font-extrabold m-0" style="color:var(--blue-deep);">Enrolled Student Rosters</h3>
                    <p class="text-xs text-gray-500 mt-1">All active student accounts enrolled in this classroom database.</p>
                </div>

                @if($course->students->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="premium-table">
                            <thead>
                            <tr>
                                <th>Student</th>
                                <th>Student ID</th>
                                <th>Email</th>
                                <th>Enrolled Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($course->students as $student)
                                @php
                                    $enrollment = $student->enrollments->firstWhere('course_id', $course->id);
                                @endphp
                                <tr>
                                    <td class="font-bold text-slate-800">{{ $student->name }}</td>
                                    <td class="font-mono text-xs">{{ $student->student_id ?? 'N/A' }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td class="text-gray-500 text-xs">
                                        {{ $enrollment ? $enrollment->created_at->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td>
                                        @if($enrollment)
                                            <form action="{{ route('faculty.student.remove', $enrollment->id) }}" method="POST" style="margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 border-none bg-none font-bold text-xs cursor-pointer"
                                                        onclick="return confirm('Remove student from this class?')">
                                                    Remove Student
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400">No enrollment record</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-16">
                        <i class="ri-user-line text-5xl text-gray-300 mb-4 block"></i>
                        <p class="text-gray-500 font-semibold">No students have joined this course yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tab: Materials -->
        <div id="materials" class="tab-content hidden">
            <div class="glass-card overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <div>
                        <h3 class="text-base font-extrabold m-0" style="color:var(--blue-deep);">Syllabus & Course Materials</h3>
                        <p class="text-xs text-gray-500 mt-1">Upload files, assignments, and guidelines for enrolled students.</p>
                    </div>
                    <button onclick="showUploadModal()" class="flex items-center gap-1 px-5 py-2 rounded-full bg-indigo-900 text-white font-bold text-xs hover:bg-opacity-90 border-0 cursor-pointer shadow-sm">
                        <i class="ri-upload-line text-sm"></i> Upload File
                    </button>
                </div>

                <div class="p-6">
                    @if($course->materials->count() > 0)
                        <div class="space-y-3.5">
                            @foreach($course->materials as $material)
                                <div class="border border-slate-100 rounded-2xl p-4 flex justify-between items-center bg-slate-50/40 hover:bg-slate-50/80 transition-all duration-200">
                                    <div class="flex items-center gap-4 min-w-0">
                                        <div class="w-10 h-10 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 shrink-0">
                                            <i class="ri-file-text-line text-lg"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-extrabold text-slate-800 text-sm truncate m-0">{{ $material->title }}</h4>
                                            <p class="text-xs text-gray-500 truncate mt-0.5">{{ $material->description ?? 'No description' }}</p>
                                            <p class="text-[10px] text-gray-400 mt-1">
                                                Uploaded: {{ $material->created_at->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex space-x-2 shrink-0">
                                        <a href="{{ route('faculty.material.download', $material->id) }}"
                                           class="w-8 h-8 rounded-full bg-slate-100 hover:bg-yellow-400 hover:text-[#0A1F44] transition-all flex items-center justify-center text-slate-700">
                                            <i class="ri-download-line text-sm"></i>
                                        </a>

                                        <form action="{{ route('faculty.material.delete', $material->id) }}" method="POST" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="w-8 h-8 rounded-full bg-slate-100 hover:bg-red-600 hover:text-white transition-all flex items-center justify-center text-red-600 border-none cursor-pointer"
                                                    onclick="return confirm('Delete this material?')">
                                                <i class="ri-delete-bin-line text-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16">
                            <i class="ri-file-line text-5xl text-gray-300 mb-4 block"></i>
                            <p class="text-gray-500 font-semibold">No educational files uploaded yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tab: Quizzes -->
        <div id="quizzes" class="tab-content hidden">
            <div class="glass-card overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <div>
                        <h3 class="text-base font-extrabold m-0" style="color:var(--blue-deep);">Interactive Quizzes</h3>
                        <p class="text-xs text-gray-500 mt-1">Build, structure, and check quiz assessments created for this course.</p>
                    </div>
                    <a href="{{ route('faculty.create.quiz', $course->id) }}"
                       class="flex items-center gap-1 px-5 py-2 rounded-full bg-yellow-400 text-[#0A1F44] font-bold text-xs hover:bg-yellow-500 border-0 shadow-sm" style="text-decoration:none;">
                        <i class="ri-add-line text-sm"></i> Create Quiz
                    </a>
                </div>

                <div class="p-6">
                    @if($course->quizzes->count() > 0)
                        <div class="space-y-3.5">
                            @foreach($course->quizzes as $quiz)
                                <div class="border border-slate-100 rounded-2xl p-4 flex justify-between items-center bg-slate-50/40 hover:bg-slate-50/80 transition-all duration-200">
                                    <div class="flex items-center gap-4 min-w-0">
                                        <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 shrink-0">
                                            <i class="ri-quiz-line text-lg"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-extrabold text-slate-800 text-sm truncate m-0">{{ $quiz->title }}</h4>
                                            <p class="text-xs text-gray-500 truncate mt-0.5">{{ $quiz->description ?? 'No description' }}</p>
                                            <div class="flex items-center gap-3 mt-1.5 text-[10px] text-gray-400 font-bold uppercase tracking-wider">
                                                <span class="bg-indigo-50 text-indigo-700 px-2 py-0.5 rounded-md">{{ $quiz->questions->count() }} Questions</span>
                                                <span class="bg-amber-50 text-amber-700 px-2 py-0.5 rounded-md">{{ $quiz->total_points }} Points</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex space-x-2 shrink-0">
                                        <a href="{{ route('faculty.edit.quiz', $quiz->id) }}"
                                           class="w-8 h-8 rounded-full bg-slate-100 hover:bg-yellow-400 hover:text-[#0A1F44] transition-all flex items-center justify-center text-slate-700">
                                            <i class="ri-edit-line text-sm"></i>
                                        </a>

                                        <a href="{{ route('faculty.submissions', $quiz->id) }}"
                                           class="w-8 h-8 rounded-full bg-slate-100 hover:bg-blue-600 hover:text-white transition-all flex items-center justify-center text-slate-700">
                                            <i class="ri-bar-chart-line text-sm"></i>
                                        </a>

                                        <form action="{{ route('faculty.delete.quiz', $quiz->id) }}" method="POST" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="w-8 h-8 rounded-full bg-slate-100 hover:bg-red-600 hover:text-white transition-all flex items-center justify-center text-red-600 border-none cursor-pointer"
                                                    onclick="return confirm('Delete this quiz?')">
                                                <i class="ri-delete-bin-line text-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16">
                            <i class="ri-quiz-line text-5xl text-gray-300 mb-4 block"></i>
                            <p class="text-gray-500 font-semibold">No quizzes constructed yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Upload Modal -->
<div id="uploadModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h3>
                <i class="ri-upload-line"></i> 
                Upload Course Material
            </h3>
            <div class="modal-close" onclick="closeUploadModal()">&times;</div>
        </div>

        <form action="{{ route('faculty.upload.material', $course->id) }}" method="POST" enctype="multipart/form-data" style="margin:0;">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Material Title *</label>
                    <input type="text" name="title" class="form-control" required placeholder="e.g. Chapter 1 PDF, Slides">
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="3" class="form-control" placeholder="Short description..."></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Attach File *</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" onclick="closeUploadModal()" class="btn-cancel">Cancel</button>
                <button type="submit" class="btn-submit">Upload Material</button>
            </div>
        </form>
    </div>
</div>

<!-- Logout Modal -->
<div id="logoutModal" class="logout-modal-overlay">
    <div class="logout-confirmation-modal">
        <div class="logout-modal-header">
            <h3>
                <i class="ri-logout-box-r-line"></i> 
                Confirm Sign Out
            </h3>
            <button class="logout-modal-close" onclick="closeLogoutModal()">&times;</button>
        </div>
        <div class="logout-modal-body">
            <p>Are you sure you want to sign out of your account?</p>
            <p class="text-xs text-gray-500 mt-2">You will be redirected to the login page.</p>
        </div>
        <div class="logout-modal-footer">
            <button class="logout-modal-btn logout-modal-btn-cancel" onclick="closeLogoutModal()">Cancel</button>
            <button class="logout-modal-btn logout-modal-btn-confirm" id="confirmLogoutBtn">Yes, Sign Out</button>
        </div>
    </div>
</div>

<script>
    // Tab toggling logic
    document.querySelectorAll('.tab-link').forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();

            const tabId = link.dataset.tab;

            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            document.getElementById(tabId).classList.remove('hidden');

            document.querySelectorAll('.tab-link').forEach(l => {
                l.classList.remove('active-tab');
            });

            link.classList.add('active-tab');
        });
    });

    // Modal helpers
    function showUploadModal() {
        document.getElementById('uploadModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeUploadModal() {
        document.getElementById('uploadModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    // Sidebar drawer toggling
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

    // Logout Modal helpers
    const logoutButton = document.getElementById('logoutButton');
    const logoutModal = document.getElementById('logoutModal');
    const confirmLogoutBtn = document.getElementById('confirmLogoutBtn');
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
</script>
</body>
</html>