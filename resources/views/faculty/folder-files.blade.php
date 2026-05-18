<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Files & Folders - Faculty Portal | NU Horizon LMS</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:opsz,wght@9..144,600;9..144,700;9..144,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: { preflight: false }
        }
    </script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #F8F6F1;
            overflow-x: hidden;
        }

        :root {
            --navy: #0A1F44;
            --navy-mid: #1F3A6D;
            --gold: #FFD70F;
            --gold-d: #C49A00;
            --bg: #F8F6F1;
            --white: #FFFFFF;
            --txt-1: #0A1F44;
            --txt-2: #2C3E5C;
            --txt-3: #637089;
            --bdr: rgba(10,31,68,0.09);
            --card-shadow: 0 8px 20px rgba(10,31,68,0.05);
            --transition: all 0.25s ease;
            --danger-red: #dc2626;
            --danger-dark: #b91c1c;
        }

        

        @media (max-width: 1024px) {
            
            .sidebar.mobile-open { transform: translateX(0); }
            
        }

        

        

        

        

        

        .nav-section { padding: 0 1rem; margin-top: 1.5rem; }

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

        .nav-item i { font-size: 1.2rem; width: 1.5rem; }
        .nav-item:hover { background: rgba(255,215,15,0.12); color: white; }
        .nav-item.active { background: var(--gold); color: var(--navy); }
        .nav-item.active i { color: var(--navy); }

        

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

        @media (max-width: 1024px) {
            .menu-toggle { display: block; }
        }

        .card {
            background: white;
            border-radius: 1.25rem;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--bdr);
            overflow: hidden;
        }

        .card-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--bdr);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .form-input {
            width: 100%;
            border: 1px solid #D1D5DB;
            border-radius: 0.85rem;
            padding: 0.7rem 0.9rem;
            background: white;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(255, 215, 15, 0.18);
        }

        .btn-primary {
            border: none;
            background: var(--navy);
            color: white;
            padding: 0.7rem 1rem;
            border-radius: 999px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-primary:hover { background: var(--navy-mid); }

        .btn-gold {
            border: none;
            background: var(--gold);
            color: var(--navy);
            padding: 0.7rem 1rem;
            border-radius: 999px;
            font-weight: 800;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-gold:hover { background: #f3ca00; }

        .btn-light {
            border: 1px solid var(--bdr);
            background: #F8FAFC;
            color: var(--navy);
            padding: 0.52rem 0.8rem;
            border-radius: 999px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            text-decoration: none;
            font-size: 0.78rem;
        }

        .btn-danger {
            border: none;
            background: #FEE2E2;
            color: var(--danger-red);
            padding: 0.52rem 0.8rem;
            border-radius: 999px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.78rem;
        }

        .folder-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.7rem 0.9rem;
            border-radius: 999px;
            border: 1px solid var(--bdr);
            background: #fff;
            color: var(--navy);
            font-weight: 700;
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.85rem;
        }

        .folder-chip:hover,
        .folder-chip.active {
            background: var(--gold);
            border-color: var(--gold);
            color: var(--navy);
        }

        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--txt-3);
            background: #F8FAFC;
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--bdr);
        }

        td {
            padding: 0.9rem 1rem;
            border-bottom: 1px solid rgba(10,31,68,0.06);
            color: var(--txt-2);
            font-size: 0.9rem;
            vertical-align: middle;
        }

        tr:hover td { background: #FFFDF2; }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.3rem 0.65rem;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 800;
        }

        .badge-admin { background: #DBEAFE; color: #1D4ED8; }
        .badge-faculty { background: #DCFCE7; color: #15803D; }
        .badge-folder { background: #FEF3C7; color: #92400E; }
        .badge-file { background: #E0E7FF; color: #3730A3; }

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
            transition: transform 0.2s cubic-bezier(0.34,1.56,0.64,1);
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
            margin: 0;
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
        .modal-btn-confirm {
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
    </div>

    <div class="sidebar-footer">
        <a href="{{ route('faculty.profile') }}" class="profile-info">
            <div class="avatar">
                <i class="ri-user-line"></i>
            </div>
            <div class="profile-details">
                <p>{{ Auth::user()->name }}</p>
                <span>{{ Auth::user()->email }}</span>
            </div>
        </a>
        <button type="button" id="logoutButton" class="logout-btn">
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
            <div>
                <h2 class="page-title text-lg md:text-xl">Files & Folders</h2>
                <p class="text-sm text-gray-500 hidden md:block">Centralized repository shared with the Admin Files & Folders module</p>
            </div>
        </div>

        <a href="{{ route('faculty.dashboard') }}" class="btn-light">
            <i class="ri-arrow-left-line"></i> Dashboard
        </a>
    </div>

    <div class="p-4 md:p-6 space-y-6">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-xl shadow-sm flex items-center gap-2">
                <i class="ri-checkbox-circle-line text-green-600"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-xl shadow-sm flex items-center gap-2">
                <i class="ri-error-warning-line text-red-600"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-xl shadow-sm">
                <p class="font-bold mb-2">Please fix the following:</p>
                <ul class="list-disc ml-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="card lg:col-span-1">
                <div class="card-header">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="ri-folder-add-line" style="color: var(--gold);"></i> Create Folder
                    </h3>
                </div>
                <form action="{{ route('faculty.folder-files.folders.store') }}" method="POST" class="p-5 space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Folder Name</label>
                        <input type="text" name="name" class="form-input" placeholder="e.g., Term 1 Materials" required>
                    </div>
                    <button type="submit" class="btn-gold w-full justify-center">
                        <i class="ri-add-line"></i> Create Folder
                    </button>
                </form>
            </div>

            <div class="card lg:col-span-2">
                <div class="card-header">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="ri-upload-cloud-2-line" style="color: var(--gold);"></i> Upload File
                    </h3>
                    <span class="text-xs text-gray-500">Saved to the same repository used by Admin</span>
                </div>
                <form action="{{ route('faculty.folder-files.upload') }}" method="POST" enctype="multipart/form-data" class="p-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Select Folder</label>
                        <select name="folder_id" class="form-input">
                            <option value="">No folder / Main repository</option>
                            @foreach($folders as $item)
                                <option value="{{ $item->id }}" {{ (string) $folder === (string) $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Choose File</label>
                        <input type="file" name="file" class="form-input" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                        <textarea name="description" class="form-input" rows="3" placeholder="Optional description for admin and faculty reference"></textarea>
                    </div>

                    <div class="md:col-span-2 flex justify-end">
                        <button type="submit" class="btn-primary">
                            <i class="ri-upload-cloud-line"></i> Upload File
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="ri-folder-3-line" style="color: var(--gold);"></i> Folders
                    </h3>
                    <p class="text-xs text-gray-500 mt-1">Folders created by admins and faculty are shown here.</p>
                </div>
                <a href="{{ route('faculty.folder-files') }}" class="btn-light">
                    <i class="ri-home-4-line"></i> Main Repository
                </a>
            </div>

            <div class="p-5 flex flex-wrap gap-3">
                <a href="{{ route('faculty.folder-files') }}" class="folder-chip {{ empty($folder) ? 'active' : '' }}">
                    <i class="ri-home-4-line"></i> All Files
                </a>
                @foreach($folders as $item)
                    <a href="{{ route('faculty.folder-files', ['folder' => $item->id]) }}" class="folder-chip {{ (string) $folder === (string) $item->id ? 'active' : '' }}">
                        <i class="ri-folder-5-line"></i> {{ $item->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="ri-file-list-3-line" style="color: var(--gold);"></i>
                        {{ $selectedFolder ? $selectedFolder->name : 'Centralized Files' }}
                    </h3>
                    <p class="text-xs text-gray-500 mt-1">Admin uploads and faculty uploads are listed together.</p>
                </div>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>File</th>
                            <th>Folder</th>
                            <th>Uploaded By</th>
                            <th>Size</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($files as $file)
                            @php
                                $uploaderRole = strtolower(optional($file->uploader)->role ?? 'user');
                                $size = $file->size ? number_format($file->size / 1024, 1) . ' KB' : 'N/A';
                            @endphp
                            <tr>
                                <td>
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center shrink-0">
                                            <i class="ri-file-3-line text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-800">{{ $file->original_name ?? $file->name }}</p>
                                            @if($file->description)
                                                <p class="text-xs text-gray-500 mt-1">{{ $file->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($file->folder)
                                        <span class="badge badge-folder"><i class="ri-folder-line"></i>{{ $file->folder->name }}</span>
                                    @else
                                        <span class="text-xs text-gray-400">Main</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $uploaderRole === 'admin' ? 'badge-admin' : 'badge-faculty' }}">
                                        <i class="{{ $uploaderRole === 'admin' ? 'ri-admin-line' : 'ri-user-star-line' }}"></i>
                                        {{ optional($file->uploader)->name ?? 'Unknown' }}
                                    </span>
                                </td>
                                <td>{{ $size }}</td>
                                <td>{{ optional($file->created_at)->format('M d, Y h:i A') }}</td>
                                <td>
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('faculty.folder-files.download', $file->id) }}" class="btn-light">
                                            <i class="ri-download-line"></i> Download
                                        </a>

                                        @if((int) $file->uploaded_by === (int) Auth::id())
                                            <form action="{{ route('faculty.folder-files.archive', $file->id) }}" method="POST" onsubmit="return confirm('Archive this file? Admin will no longer see it as active.');" style="margin:0;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn-danger">
                                                    <i class="ri-archive-line"></i> Archive
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-10 text-gray-500">
                                    <i class="ri-folder-open-line text-5xl text-gray-300 block mb-3"></i>
                                    No files found in this folder yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($files->hasPages())
                <div class="p-4 border-t border-gray-100">
                    {{ $files->appends(request()->query())->links() }}
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="ri-user-upload-line" style="color: var(--gold);"></i> My Uploaded Files
                    </h3>
                </div>
                <div class="p-5 space-y-3">
                    @forelse($myFiles as $file)
                        <div class="flex items-center justify-between gap-3 p-3 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="min-w-0">
                                <p class="font-bold text-sm text-gray-800 truncate">{{ $file->original_name ?? $file->name }}</p>
                                <p class="text-xs text-gray-500">{{ optional($file->created_at)->format('M d, Y h:i A') }}</p>
                            </div>
                            <a href="{{ route('faculty.folder-files.download', $file->id) }}" class="btn-light shrink-0">
                                <i class="ri-download-line"></i>
                            </a>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-6">You have not uploaded any active files yet.</p>
                    @endforelse
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="ri-archive-line" style="color: var(--gold);"></i> My Archived Files
                    </h3>
                </div>
                <div class="p-5 space-y-3">
                    @forelse($archivedMyFiles as $file)
                        <div class="flex items-center justify-between gap-3 p-3 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="min-w-0">
                                <p class="font-bold text-sm text-gray-800 truncate">{{ $file->original_name ?? $file->name }}</p>
                                <p class="text-xs text-gray-500">Archived {{ optional($file->archived_at)->format('M d, Y h:i A') }}</p>
                            </div>
                            <span class="badge badge-file">Archived</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-6">No archived files yet.</p>
                    @endforelse
                </div>
            </div>
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

<form method="POST" action="{{ route('logout') }}" id="logoutForm" style="display: none;">
    @csrf
</form>

<script>
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

    const logoutButtonSidebar = document.getElementById('logoutButton');
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

    if (logoutButtonSidebar) {
        logoutButtonSidebar.addEventListener('click', (e) => {
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
</body>
</html>
