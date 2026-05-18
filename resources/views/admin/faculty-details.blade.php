<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Faculty Details - {{ $faculty->name }} | NU Clicks LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { corePlugins: { preflight: false } }</script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

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

        /* ===== SIDEBAR ===== */
        
        @media (max-width: 1024px) {
            
            .sidebar.mobile-open { transform: translateX(0); }
            
        }

        
        
        
        
        

        .nav-section { padding: 0 1rem; margin-top: 1.5rem; }
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
            text-decoration: none;
        }
        .nav-item i { font-size: 1.2rem; width: 1.5rem; }
        .nav-item:hover { background: rgba(255,215,15,0.15); color: white; }
        .nav-item.active { background: var(--gold); color: var(--blue-deep); }
        .nav-item.active i { color: var(--blue-deep); }

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
            width: 42px; height: 42px;
            background: rgba(255,215,15,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            flex-shrink: 0;
        }
        .profile-details p { color: white; font-weight: 600; font-size: 0.85rem; }
        .profile-details span { color: rgba(255,255,255,0.6); font-size: 0.7rem; }

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

        /* ===== MAIN ===== */
        
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
        .page-title { font-weight: 700; color: var(--blue-deep); }
        @media (max-width: 1024px) {
            .menu-toggle { display: block; }
            
        }

        /* ===== CARDS ===== */
        .dashboard-card {
            background: white;
            border-radius: 1.2rem;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(0,0,0,0.03);
            overflow: hidden;
        }
        .card-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--gray-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .card-header-left {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .card-header-left i { color: var(--gold); font-size: 1.15rem; }
        .card-header-left h3 { font-weight: 700; color: #1e293b; font-size: 0.95rem; }

        /* stat pill */
        .stat-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.3rem 0.8rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* course row */
        .course-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--gray-border);
            transition: background 0.15s;
        }
        .course-row:last-child { border-bottom: none; }
        .course-row:hover { background: #f8faff; }

        /* assign-course modal */
        .assign-modal-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(10, 31, 68, 0.75);
            backdrop-filter: blur(4px);
            z-index: 900;
            display: flex;
            align-items: center;
            justify-content: center;
            visibility: hidden;
            opacity: 0;
            transition: all 0.2s ease;
        }
        .assign-modal-overlay.active { visibility: visible; opacity: 1; }
        .assign-modal {
            background: white;
            max-width: 560px;
            width: 95%;
            border-radius: 1.5rem;
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transform: scale(0.95);
            transition: transform 0.2s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            max-height: 85vh;
            display: flex;
            flex-direction: column;
        }
        .assign-modal-overlay.active .assign-modal { transform: scale(1); }

        /* logout / confirm modal */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(10, 31, 68, 0.75);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            visibility: hidden;
            opacity: 0;
            transition: all 0.2s ease;
        }
        .modal-overlay.active { visibility: visible; opacity: 1; }
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
        .modal-overlay.active .confirmation-modal { transform: scale(1); }

        .modal-header {
            background: var(--blue-deep);
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid var(--gold);
            flex-shrink: 0;
        }
        .modal-header h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .modal-header h3 i { color: var(--gold); }
        .modal-close {
            background: none;
            border: none;
            color: rgba(255,255,255,0.7);
            font-size: 1.6rem;
            cursor: pointer;
            line-height: 1;
        }
        .modal-close:hover { color: var(--gold); }

        .modal-body {
            padding: 1.5rem;
            color: #374151;
            overflow-y: auto;
            flex: 1;
        }
        .modal-footer {
            padding: 1rem 1.5rem;
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            background: #f9fafb;
            border-top: 1px solid var(--gray-border);
            flex-shrink: 0;
        }
        .modal-btn {
            padding: 0.6rem 1.25rem;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }
        .modal-btn-cancel { background: #eef2ff; color: #1e293b; }
        .modal-btn-cancel:hover { background: #e2e8f0; }
        .modal-btn-confirm { background: var(--blue-deep); color: white; }
        .modal-btn-confirm:hover { background: #0f2d5e; }
        .modal-btn-danger { background: var(--danger-red); color: white; }
        .modal-btn-danger:hover { background: var(--danger-dark); }

        /* course checkbox list */
        .course-check-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border: 1px solid var(--gray-border);
            border-radius: 0.75rem;
            cursor: pointer;
            transition: var(--transition);
            margin-bottom: 0.5rem;
        }
        .course-check-item:hover { border-color: var(--blue-deep); background: #f8faff; }
        .course-check-item input[type="checkbox"] { accent-color: var(--blue-deep); width: 16px; height: 16px; cursor: pointer; }
        .course-check-item.checked { border-color: var(--blue-deep); background: rgba(10,31,68,0.04); }

        /* search inside modal */
        .modal-search {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 0.75rem;
            padding: 0.6rem 1rem 0.6rem 2.4rem;
            font-size: 0.875rem;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: var(--transition);
            margin-bottom: 1rem;
        }
        .modal-search:focus { border-color: var(--blue-deep); box-shadow: 0 0 0 3px rgba(10,31,68,0.07); }
    
        

        

        

        

        

        

        

        

        

        

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

<!-- ========== SIDEBAR ========== -->
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

            <p>Admin Portal</p>
        </div>
    </div>

        <div style="flex:1; overflow-y: auto;">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="ri-dashboard-line"></i> Dashboard
            </a>
            <a href="{{ route('admin.users.create') }}" class="nav-item {{ request()->routeIs('admin.users.create') ? 'active' : '' }}">
                <i class="ri-user-add-line"></i> Account Creation
            </a>
            <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <i class="ri-team-line"></i> Users
            </a>
            <a href="{{ route('admin.faculty') }}" class="nav-item {{ request()->routeIs('admin.faculty*') ? 'active' : '' }}">
                <i class="ri-user-star-line"></i> Faculty
            </a>
        </div>
        <div class="nav-section">
            <div class="nav-section-title">Academic</div>
            <a href="{{ route('admin.departments') }}" class="nav-item {{ request()->routeIs('admin.departments*') ? 'active' : '' }}">
                <i class="ri-building-2-line"></i> Departments
            </a>
            <a href="{{ route('admin.programs') }}" class="nav-item {{ request()->routeIs('admin.programs*') ? 'active' : '' }}">
                <i class="ri-graduation-cap-line"></i> Programs/Courses
            </a>
            <a href="{{ route('admin.sections') }}" class="nav-item {{ request()->routeIs('admin.sections*') ? 'active' : '' }}">
                <i class="ri-layout-grid-line"></i> Sections
            </a>
            <a href="{{ route('admin.subjects') }}" class="nav-item {{ request()->routeIs('admin.subjects*') || request()->routeIs('admin.courses*') ? 'active' : '' }}">
                <i class="ri-book-open-line"></i> Subjects
            </a>
            <a href="{{ route('admin.faculty-assignments') }}" class="nav-item {{ request()->routeIs('admin.faculty-assignments*') ? 'active' : '' }}">
                <i class="ri-user-settings-line"></i> Faculty Assignments
            </a>
        </div>
        <div class="nav-section">
            <div class="nav-section-title">Management</div>
            <a href="{{ route('admin.faculty-evaluations') }}" class="nav-item {{ request()->routeIs('admin.faculty-evaluations*') ? 'active' : '' }}">
                <i class="ri-star-smile-line"></i> Faculty Evaluation
            </a>
            <a href="{{ route('admin.folder-files') }}" class="nav-item {{ request()->routeIs('admin.folder-files*') ? 'active' : '' }}">
                <i class="ri-folder-3-line"></i> Folder & Files
            </a>
            <a href="{{ route('admin.analytics') }}" class="nav-item {{ request()->routeIs('admin.analytics*') ? 'active' : '' }}">
                <i class="ri-bar-chart-line"></i> Analytics
            </a>
            <a href="{{ route('admin.logs') }}" class="nav-item {{ request()->routeIs('admin.logs*') ? 'active' : '' }}">
                <i class="ri-history-line"></i> Activity Logs
            </a>
            <a href="{{ route('admin.settings') }}" class="nav-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                <i class="ri-settings-line"></i> Settings
            </a>
        </div>
    </div>

    <div class="sidebar-footer">
        <a href="{{ route('admin.profile') }}" class="profile-info" style="text-decoration: none;">
            <div class="avatar"><i class="ri-user-line"></i></div>
            <div class="profile-details">
                <p>{{ Auth::user()->name }}</p>
                <span>{{ Auth::user()->email }}</span>
            </div>
        </a>
        <button onclick="openLogoutModal()" class="logout-btn">
            <i class="ri-logout-box-line"></i> Logout
        </button>
    </div>
</aside>

<!-- ========== MAIN CONTENT ========== -->
<div class="main-content" id="mainContent">

    <!-- TOP BAR -->
    <div class="top-bar">
        <button class="menu-toggle" id="menuToggle"><i class="ri-menu-line"></i></button>
        <div>
            <h2 class="page-title text-lg md:text-xl">Faculty Details</h2>
            <p class="text-sm text-gray-500 hidden md:block">{{ $faculty->name }}</p>
        </div>
        <a href="{{ route('admin.users') }}" class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold transition shadow-sm border border-gray-200 text-gray-700 hover:bg-gray-50">
            <i class="ri-arrow-left-line text-base"></i> Back to Users
        </a>
    </div>

    <!-- BODY -->
    <div class="p-4 md:p-6">

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-xl mb-5 flex items-center gap-2">
                <i class="ri-checkbox-circle-line text-green-600"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-xl mb-5 flex items-center gap-2">
                <i class="ri-error-warning-line text-red-600"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- ── LEFT: Profile Card ── -->
            <div class="lg:col-span-1 space-y-5">

                <!-- Profile -->
                <div class="dashboard-card p-6">
                    <div class="text-center">
                        <div class="h-20 w-20 mx-auto mb-4 rounded-full flex items-center justify-center" style="background: rgba(10,31,68,0.08);">
                            <i class="ri-user-star-line text-4xl" style="color: var(--blue-deep);"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $faculty->name }}</h3>
                        <p class="text-gray-500 text-sm mt-1">{{ $faculty->email }}</p>
                        @if($faculty->faculty_id)
                            <p class="text-xs text-gray-400 mt-1">Faculty ID: {{ $faculty->faculty_id }}</p>
                        @endif
                        <div class="mt-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                {{ $faculty->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($faculty->status ?? 'active') }}
                            </span>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 mt-6 pt-5 space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500 flex items-center gap-1.5">
                                <i class="ri-building-2-line"></i> Department
                            </span>
                            <span class="text-sm font-medium text-gray-800">
                                {{ $faculty->department_id ? ($faculty->departmentRel->name ?? 'N/A') : ($faculty->department ?? 'N/A') }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500 flex items-center gap-1.5">
                                <i class="ri-microscope-line"></i> Specialization
                            </span>
                            <span class="text-sm font-medium text-gray-800 text-right max-w-[55%]">{{ $faculty->specialization ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500 flex items-center gap-1.5">
                                <i class="ri-award-line"></i> Qualification
                            </span>
                            <span class="text-sm font-medium text-gray-800 text-right max-w-[55%]">{{ $faculty->qualification ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500 flex items-center gap-1.5">
                                <i class="ri-book-open-line"></i> Courses
                            </span>
                            <span class="text-sm font-semibold" style="color: var(--blue-deep);">
                                {{ count($assignedIds) }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-5 flex gap-2">
                        <a href="{{ route('admin.users.edit', $faculty->id) }}"
                           class="flex-1 flex items-center justify-center gap-1.5 py-2 rounded-xl text-sm font-semibold border border-gray-200 text-gray-700 hover:bg-gray-50 transition">
                            <i class="ri-edit-line"></i> Edit
                        </a>
                        <button onclick="openAssignModal()"
                                class="flex-1 flex items-center justify-center gap-1.5 py-2 rounded-xl text-sm font-semibold text-white transition"
                                style="background: var(--blue-deep);">
                            <i class="ri-add-line"></i> Assign Course
                        </button>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="dashboard-card p-5">
                    <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">Quick Stats</h4>
                    <div class="space-y-3">
                        @php
                            $totalStudents = 0;
                            $totalQuizzes  = 0;
                            foreach ($faculty->courses as $c) {
                                $totalStudents += $c->students->count();
                                $totalQuizzes  += $c->quizzes->count();
                            }
                        @endphp
                        <div class="flex items-center justify-between p-3 rounded-xl bg-blue-50">
                            <span class="text-sm text-blue-700 font-medium flex items-center gap-2">
                                <i class="ri-book-open-line"></i> Assigned Courses
                            </span>
                            <span class="text-sm font-bold text-blue-800">{{ count($assignedIds) }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-purple-50">
                            <span class="text-sm text-purple-700 font-medium flex items-center gap-2">
                                <i class="ri-group-line"></i> Total Students
                            </span>
                            <span class="text-sm font-bold text-purple-800">{{ $totalStudents }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-amber-50">
                            <span class="text-sm text-amber-700 font-medium flex items-center gap-2">
                                <i class="ri-list-check"></i> Quizzes Created
                            </span>
                            <span class="text-sm font-bold text-amber-800">{{ $totalQuizzes }}</span>
                        </div>
                    </div>
                </div>

            </div><!-- /left col -->

            <!-- ── RIGHT: Assigned Courses ── -->
            <div class="lg:col-span-2 space-y-5">

                <!-- Assigned Courses -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <div class="card-header-left">
                            <i class="ri-book-open-line"></i>
                            <h3>Assigned Courses</h3>
                        </div>
                        <span class="stat-pill bg-blue-100 text-blue-700">
                            {{ count($assignedIds) }} {{ Str::plural('Course', count($assignedIds)) }}
                        </span>
                    </div>

                    @php $assignedCourses = $faculty->courses->whereIn('id', $assignedIds); @endphp

                    @if($assignedCourses->count() > 0)
                        @foreach($assignedCourses as $course)
                            @php
                                $studentCount = $course->students->count();
                                $quizCount    = $course->quizzes->count();
                            @endphp
                            <div class="course-row">
                                <div class="flex items-start gap-3 min-w-0">
                                    <div class="h-10 w-10 rounded-xl flex items-center justify-center flex-shrink-0"
                                         style="background: rgba(10,31,68,0.07);">
                                        <i class="ri-book-2-line text-base" style="color: var(--blue-deep);"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 truncate">
                                            {{ $course->code }} – {{ $course->name }}
                                        </p>
                                        <p class="text-xs text-gray-400 mt-0.5">
                                            {{ $course->program->name ?? 'No Program' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 flex-shrink-0 ml-3">
                                    <span class="stat-pill bg-indigo-50 text-indigo-600">
                                        <i class="ri-group-line text-xs"></i> {{ $studentCount }}
                                    </span>
                                    <span class="stat-pill bg-amber-50 text-amber-600">
                                        <i class="ri-list-check text-xs"></i> {{ $quizCount }}
                                    </span>
                                    <form action="{{ route('admin.faculty.unassign-course', ['faculty' => $faculty->id, 'course' => $course->id]) }}"
                                          method="POST" class="inline"
                                          onsubmit="return confirm('Remove this course from {{ addslashes($faculty->name) }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="p-1.5 rounded-lg text-red-400 hover:text-red-600 hover:bg-red-50 transition"
                                                title="Unassign course">
                                            <i class="ri-close-line text-base"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="p-8 text-center">
                            <i class="ri-book-open-line text-3xl text-gray-300 mb-2 block"></i>
                            <p class="text-gray-400 text-sm">No courses assigned yet.</p>
                            <button onclick="openAssignModal()"
                                    class="mt-3 inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold text-white transition"
                                    style="background: var(--blue-deep);">
                                <i class="ri-add-line"></i> Assign a Course
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Courses & Quizzes breakdown -->
                @if($assignedCourses->count() > 0)
                <div class="dashboard-card">
                    <div class="card-header">
                        <div class="card-header-left">
                            <i class="ri-list-check"></i>
                            <h3>Quizzes by Course</h3>
                        </div>
                    </div>
                    @foreach($assignedCourses as $course)
                        @if($course->quizzes->count() > 0)
                            <div style="border-bottom: 1px solid var(--gray-border);">
                                <div class="px-5 py-3 bg-gray-50">
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                        {{ $course->code }} — {{ $course->name }}
                                    </p>
                                </div>
                                @foreach($course->quizzes as $quiz)
                                    <div class="flex justify-between items-center px-5 py-3 hover:bg-gray-50 transition" style="border-top: 1px solid var(--gray-border);">
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">{{ $quiz->title }}</p>
                                            <p class="text-xs text-gray-400 mt-0.5">
                                                {{ $quiz->questions_count ?? $quiz->questions->count() ?? 0 }} questions
                                                · {{ $quiz->total_points ?? 0 }} pts
                                            </p>
                                        </div>
                                        <span class="stat-pill {{ $quiz->is_published ?? false ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                            {{ ($quiz->is_published ?? false) ? 'Published' : 'Draft' }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach

                    @php $totalQuizzesCheck = $assignedCourses->sum(fn($c) => $c->quizzes->count()); @endphp
                    @if($totalQuizzesCheck === 0)
                        <div class="p-6 text-center">
                            <p class="text-gray-400 text-sm">No quizzes created for any assigned course.</p>
                        </div>
                    @endif
                </div>
                @endif

            </div><!-- /right col -->
        </div><!-- /grid -->
    </div><!-- /body -->
</div><!-- /main-content -->

<!-- ===== ASSIGN COURSE MODAL ===== -->
<div id="assignModal" class="assign-modal-overlay">
    <div class="assign-modal">
        <div class="modal-header">
            <h3><i class="ri-book-open-line"></i> Assign Courses</h3>
            <button class="modal-close" onclick="closeAssignModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p class="text-sm text-gray-500 mb-4">
                Select the courses to assign to <strong>{{ $faculty->name }}</strong>.
                Already-assigned courses are pre-checked.
            </p>

            <!-- Search -->
            <div class="relative mb-1">
                <i class="ri-search-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" id="courseSearch" class="modal-search" placeholder="Search courses…"
                       oninput="filterCourses(this.value)">
            </div>

            <form id="assignForm" method="POST"
                  action="{{ route('admin.faculty.assign-courses', $faculty->id) }}">
                @csrf
                <div id="courseList">
                    @foreach($allCourses as $course)
                        @php $checked = in_array($course->id, $assignedIds); @endphp
                        <label class="course-check-item {{ $checked ? 'checked' : '' }}"
                               data-name="{{ strtolower($course->name . ' ' . $course->code) }}">
                            <input type="checkbox" name="course_ids[]"
                                   value="{{ $course->id }}"
                                   {{ $checked ? 'checked' : '' }}
                                   onchange="this.closest('label').classList.toggle('checked', this.checked)">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-800">{{ $course->code }} — {{ $course->name }}</p>
                                <p class="text-xs text-gray-400">{{ $course->program->name ?? 'No Program' }}</p>
                            </div>
                            @if($checked)
                                <span class="stat-pill bg-blue-100 text-blue-600 flex-shrink-0">Assigned</span>
                            @endif
                        </label>
                    @endforeach
                    @if($allCourses->isEmpty())
                        <p class="text-center text-gray-400 text-sm py-4">No courses available.</p>
                    @endif
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="modal-btn modal-btn-cancel" onclick="closeAssignModal()">Cancel</button>
            <button class="modal-btn modal-btn-confirm"
                    onclick="document.getElementById('assignForm').submit()">
                <i class="ri-save-line mr-1"></i> Save Assignments
            </button>
        </div>
    </div>
</div>

<!-- ===== LOGOUT MODAL ===== -->
<div id="logoutModal" class="modal-overlay">
    <div class="confirmation-modal">
        <div class="modal-header">
            <h3><i class="ri-logout-box-r-line"></i> Confirm Sign Out</h3>
            <button class="modal-close" onclick="closeLogoutModal()">&times;</button>
        </div>
        <div class="modal-body" style="text-align:center;">
            <p>Are you sure you want to sign out of your account?</p>
            <p class="text-xs text-gray-500 mt-2">You will be redirected to the login page.</p>
        </div>
        <div class="modal-footer">
            <button class="modal-btn modal-btn-cancel" onclick="closeLogoutModal()">Cancel</button>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="modal-btn modal-btn-danger">Yes, Sign Out</button>
            </form>
        </div>
    </div>
</div>

<script>
    // ── Mobile sidebar ──
    const menuToggle = document.getElementById('menuToggle');
    const sidebar    = document.getElementById('sidebar');
    if (menuToggle) {
        menuToggle.addEventListener('click', () => sidebar.classList.toggle('mobile-open'));
    }
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 1024 && sidebar.classList.contains('mobile-open')) {
            if (!sidebar.contains(e.target) && menuToggle && !menuToggle.contains(e.target)) {
                sidebar.classList.remove('mobile-open');
            }
        }
    });

    // ── Assign modal ──
    function openAssignModal() {
        document.getElementById('assignModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeAssignModal() {
        document.getElementById('assignModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    document.getElementById('assignModal').addEventListener('click', (e) => {
        if (e.target === document.getElementById('assignModal')) closeAssignModal();
    });

    // ── Course search filter ──
    function filterCourses(query) {
        const q = query.toLowerCase();
        document.querySelectorAll('#courseList label[data-name]').forEach(label => {
            label.style.display = label.dataset.name.includes(q) ? '' : 'none';
        });
    }

    // ── Logout modal ──
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    document.getElementById('logoutModal').addEventListener('click', (e) => {
        if (e.target === document.getElementById('logoutModal')) closeLogoutModal();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') { closeLogoutModal(); closeAssignModal(); }
    });
</script>
</body>
</html>