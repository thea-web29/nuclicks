<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>User Management – NU Horizon LMS</title>

    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        /* ══ DESIGN TOKENS (mirror dashboard) ══ */
        :root {
            --navy:      #0A1F44;
            --navy-mid:  #1F3A6D;
            --navy-lite: #3D5FA0;
            --navy-pale: #EEF3FB;
            --gold:      #FFD70F;
            --gold-d:    #C49A00;
            --gold-mid:  #F5C800;
            --gold-pale: #FFFBEA;
            --bg:        #F8F6F1;
            --white:     #FFFFFF;
            --txt-1:     #0A1F44;
            --txt-2:     #2C3E5C;
            --txt-3:     #637089;
            --bdr:       rgba(10,31,68,0.10);
            --ease:      cubic-bezier(0.22,1,0.36,1);
            --spring:    cubic-bezier(0.34,1.56,0.64,1);
            --t:         0.26s var(--ease);
            --sidebar-w: 272px;
            --danger:    #dc2626;
            --danger-d:  #b91c1c;
            --green:     #16a34a;
            --purple:    #7c3aed;
            --orange:    #ea580c;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            color: var(--txt-1);
        }

        /* scrollbar */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(10,31,68,0.15); border-radius: 99px; }

        /* ══ SIDEBAR (identical from dashboard) ══ */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--navy);
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform .3s var(--ease);
            box-shadow: 4px 0 32px rgba(0,0,0,0.18);
        }
        .sidebar::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), var(--gold-mid), transparent);
            background-size: 200% 100%;
            animation: shimmer 4s linear infinite;
        }
        @keyframes shimmer {
            0%   { background-position: -200% center; }
            100% { background-position:  200% center; }
        }
        .sidebar::after {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.012) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.012) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
        }
        .sidebar-arc {
            position: absolute;
            width: 340px; height: 340px;
            border-radius: 50%;
            border: 1px solid rgba(255,215,15,0.06);
            bottom: -60px; left: -100px;
            pointer-events: none;
            z-index: 0;
        }
        .sidebar-inner {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .sidebar-logo {
            padding: 1.5rem 1.4rem 1.3rem;
            display: flex;
            align-items: center;
            gap: .85rem;
            border-bottom: 1px solid rgba(255,215,15,0.14);
        }
        .logo-seal-wrap {
            position: relative;
            flex-shrink: 0;
        }
        .logo-seal {
            width: 40px; height: 40px;
            border-radius: 50%;
            object-fit: contain;
            background: rgba(255,255,255,0.07);
            border: 1.5px solid rgba(255,215,15,0.30);
            display: block;
        }
        .logo-seal-ring {
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            border: 1.5px solid rgba(255,215,15,0.28);
            animation: rotateSlow 14s linear infinite;
        }
        @keyframes rotateSlow { from { transform:rotate(0deg); } to { transform:rotate(360deg); } }
        .logo-seal-ring::before {
            content: "";
            position: absolute;
            top: -2px; left: 50%; transform: translateX(-50%);
            width: 4px; height: 4px;
            border-radius: 50%;
            background: var(--gold);
            box-shadow: 0 0 5px var(--gold);
        }
        .logo-text h1 {
            font-family: 'Fraunces', serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: -.02em;
            line-height: 1.1;
        }
        .logo-text h1 em { color: var(--gold); font-style: normal; }
        .logo-text p {
            font-size: .65rem;
            font-weight: 600;
            letter-spacing: .10em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.40);
            margin-top: .15rem;
        }
        .nav-body {
            flex: 1;
            overflow-y: auto;
            padding: 1.2rem .85rem;
            display: flex;
            flex-direction: column;
            gap: 1.6rem;
        }
        .nav-section-label {
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: rgba(255,215,15,0.50);
            margin-bottom: .4rem;
            padding-left: .4rem;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: .7rem;
            padding: .62rem .85rem;
            border-radius: 10px;
            color: rgba(255,255,255,0.70);
            text-decoration: none;
            font-size: .82rem;
            font-weight: 500;
            transition: all var(--t);
            margin-bottom: .15rem;
        }
        .nav-item i { font-size: 1.05rem; width: 1.25rem; flex-shrink: 0; }
        .nav-item:hover {
            background: rgba(255,215,15,0.10);
            color: rgba(255,255,255,0.92);
        }
        .nav-item.active {
            background: var(--gold);
            color: var(--navy);
            font-weight: 700;
            box-shadow: 0 4px 14px rgba(255,215,15,0.30);
        }
        .nav-item.active i { color: var(--navy); }
        .sidebar-footer {
            padding: 1rem 1.2rem;
            border-top: 1px solid rgba(255,215,15,0.14);
        }
        .profile-row {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: .85rem;
        }
        .avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: rgba(255,215,15,0.15);
            border: 1.5px solid rgba(255,215,15,0.30);
            display: flex; align-items: center; justify-content: center;
            color: var(--gold);
            font-size: 1rem;
            flex-shrink: 0;
        }
        .profile-name { font-size: .82rem; font-weight: 700; color: #fff; }
        .profile-email { font-size: .68rem; color: rgba(255,255,255,0.42); margin-top: .1rem; }
        .logout-btn {
            width: 100%;
            padding: .58rem .9rem;
            border-radius: 8px;
            background: rgba(220,38,38,0.12);
            border: 1px solid rgba(220,38,38,0.22);
            color: #fca5a5;
            font-size: .78rem;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            cursor: pointer;
            transition: all var(--t);
        }
        .logout-btn:hover {
            background: var(--danger);
            border-color: var(--danger);
            color: #fff;
            box-shadow: 0 4px 12px rgba(220,38,38,0.35);
        }

        /* ══ MAIN CONTENT ══ */
        .main-content {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Topbar */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(248,246,241,0.88);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--bdr);
            padding: .9rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        .topbar-left { display: flex; align-items: center; gap: 1rem; }
        .menu-toggle {
            display: none;
            background: none;
            border: 1px solid var(--bdr);
            border-radius: 8px;
            padding: .4rem .55rem;
            color: var(--txt-2);
            font-size: 1.1rem;
            cursor: pointer;
            transition: all var(--t);
        }
        .menu-toggle:hover { border-color: var(--gold-d); color: var(--navy); }
        .topbar-title {
            font-family: 'Fraunces', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--navy);
            letter-spacing: -.02em;
        }
        .topbar-title em { color: var(--gold-d); font-style: normal; }
        .topbar-breadcrumb {
            font-size: .72rem;
            color: var(--txt-3);
            font-weight: 500;
        }
        .topbar-right { display: flex; align-items: center; gap: .75rem; }
        .topbar-badge {
            display: flex; align-items: center; gap: .4rem;
            font-size: .72rem;
            font-weight: 600;
            color: var(--txt-3);
            background: var(--white);
            border: 1px solid var(--bdr);
            border-radius: 8px;
            padding: .4rem .75rem;
            box-shadow: 0 1px 4px rgba(10,31,68,0.04);
        }
        .topbar-badge i { font-size: .85rem; color: var(--gold-d); }
        .topbar-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 0 2px rgba(34,197,94,0.25);
        }

        /* PAGE BODY */
        .page-body { padding: 1.8rem 2rem; flex: 1; }

        /* custom UI components (cards, tables, badges) */
        .dash-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            overflow: hidden;
            transition: all var(--t);
        }
        .dash-card-head {
            padding: 1rem 1.3rem;
            border-bottom: 1px solid var(--bdr);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
        }
        .dash-card-title {
            font-size: .82rem;
            font-weight: 700;
            color: var(--txt-1);
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .dash-card-title i { color: var(--gold-d); font-size: .9rem; }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.8rem;
        }
        .user-table th {
            text-align: left;
            padding: 0.9rem 1rem;
            background: #FCFAF7;
            border-bottom: 1px solid var(--bdr);
            font-weight: 700;
            color: var(--txt-2);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .user-table td {
            padding: 0.9rem 1rem;
            border-bottom: 1px solid var(--bdr);
            color: var(--txt-2);
            vertical-align: middle;
        }
        .user-table tr:last-child td { border-bottom: none; }
        .user-table tr:hover td { background: rgba(10,31,68,0.02); }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.2rem 0.7rem;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 700;
            background: var(--bg);
            border: 1px solid transparent;
        }
        .status-active {
            background: rgba(22,163,74,0.12);
            color: var(--green);
            border-color: rgba(34,197,94,0.2);
        }
        .status-inactive {
            background: rgba(220,38,38,0.08);
            color: var(--danger);
            border-color: rgba(220,38,38,0.2);
        }
        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 8px;
            color: var(--txt-3);
            transition: var(--t);
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }
        .action-btn:hover { background: var(--bg); color: var(--navy); }
        .action-btn.danger:hover { background: rgba(220,38,38,0.1); color: var(--danger); }

        /* tabs */
        .tabs-container {
            display: flex;
            gap: 0.5rem;
            background: var(--white);
            border: 1px solid var(--bdr);
            border-radius: 60px;
            width: fit-content;
            padding: 0.25rem;
            margin-bottom: 1.8rem;
        }
        .tab-btn {
            padding: 0.55rem 1.6rem;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.75rem;
            border: none;
            background: transparent;
            cursor: pointer;
            transition: all var(--t);
            color: var(--txt-3);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .tab-btn i { margin-right: 6px; font-size: 0.85rem; vertical-align: middle; }
        .tab-btn.active-tab {
            background: var(--navy);
            color: white;
            box-shadow: 0 2px 8px rgba(10,31,68,0.12);
        }
        .tab-content.hidden { display: none; }

        /* pagination */
        .pagination-wrap {
            padding: 1rem 1.3rem;
            border-top: 1px solid var(--bdr);
            background: var(--bg);
        }
        .pagination {
            display: flex;
            gap: 6px;
            justify-content: flex-end;
            flex-wrap: wrap;
        }
        .pagination a, .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            height: 32px;
            padding: 0 8px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--txt-2);
            transition: var(--t);
            text-decoration: none;
        }
        .pagination a:hover { background: var(--bg); color: var(--navy); }
        .pagination .active span {
            background: var(--navy);
            color: white;
        }
        .pagination .disabled span { opacity: 0.4; }

        /* flash messages */
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.8rem;
            font-weight: 500;
        }
        .alert-success {
            background: rgba(22,163,74,0.08);
            border-left: 3px solid var(--green);
            color: #14532d;
        }
        .alert-error {
            background: rgba(220,38,38,0.06);
            border-left: 3px solid var(--danger);
            color: #7f1a1a;
        }

        /* modals consistent with dashboard */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(10,31,68,0.72);
            backdrop-filter: blur(6px);
            z-index: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            visibility: hidden;
            opacity: 0;
            transition: all .22s var(--ease);
        }
        .modal-overlay.active { visibility: visible; opacity: 1; }
        .modal {
            background: var(--white);
            border-radius: 18px;
            width: min(440px, 94vw);
            overflow: hidden;
            transform: scale(0.94) translateY(12px);
            transition: transform .28s var(--spring);
            box-shadow: 0 40px 80px rgba(0,0,0,0.25);
        }
        .modal-overlay.active .modal { transform: scale(1) translateY(0); }
        .modal-head {
            background: var(--navy);
            padding: 1.2rem 1.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid var(--gold);
        }
        .modal-head h3 {
            font-family: 'Fraunces', serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .modal-head h3 i { color: var(--gold); }
        .modal-close {
            background: none;
            border: none;
            color: rgba(255,255,255,0.55);
            font-size: 1.3rem;
            cursor: pointer;
            transition: color var(--t);
        }
        .modal-close:hover { color: var(--gold); }
        .modal-body {
            padding: 1.8rem 1.5rem;
            text-align: center;
        }
        .modal-body p { font-size: .88rem; color: var(--txt-2); line-height: 1.5; }
        .user-name-chip {
            background: var(--navy-pale);
            padding: 0.3rem 1rem;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.8rem;
            display: inline-block;
            margin-top: 0.5rem;
        }
        .modal-foot {
            padding: .9rem 1.4rem 1.3rem;
            display: flex;
            gap: .6rem;
            justify-content: flex-end;
            background: var(--bg);
            border-top: 1px solid var(--bdr);
        }
        .btn-cancel {
            padding: .58rem 1.1rem;
            border-radius: 8px;
            border: 1px solid var(--bdr);
            background: var(--white);
            font-size: .8rem;
            font-weight: 600;
            color: var(--txt-2);
            cursor: pointer;
            transition: all var(--t);
        }
        .btn-confirm {
            padding: .58rem 1.2rem;
            border-radius: 8px;
            border: none;
            background: var(--danger);
            font-size: .8rem;
            font-weight: 700;
            color: #fff;
            cursor: pointer;
            transition: all var(--t);
        }
        .btn-confirm:hover { background: var(--danger-d); }
        .btn-primary-sm {
            background: var(--navy);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: var(--t);
        }
        .btn-primary-sm:hover { background: var(--navy-mid); transform: translateY(-1px); }

        /* responsive */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(10,31,68,0.65);
            z-index: 90;
        }
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay { display: block; }
            .main-content { margin-left: 0; }
            .menu-toggle { display: flex; }
        }
        @media (max-width: 640px) {
            .page-body { padding: 1.2rem 1rem; }
            .topbar { padding: .8rem 1rem; }
            .user-table th, .user-table td { padding: 0.7rem 0.8rem; }
        }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- ══ SIDEBAR (identical to dashboard) ══ -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-arc"></div>
    <div class="sidebar-inner">
        <div class="sidebar-logo">
            <div class="logo-seal-wrap">
                <div class="logo-seal-ring"></div>
                <img src="/logo/NatU.png" alt="NU seal" class="logo-seal" onerror="this.style.display='none'">
            </div>
            <div class="logo-text">
                <h1>NU Horizon <em>LMS</em></h1>
                <p>Admin Portal · National University</p>
            </div>
        </div>
        <div class="nav-body">
            <div>
                <div class="nav-section-label">Main</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>
                <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <i class="ri-team-line"></i> Users
                </a>
                <a href="{{ route('admin.users.create') }}" class="nav-item {{ request()->routeIs('admin.users.create') ? 'active' : '' }}">
                    <i class="ri-user-add-line"></i> Account Creation
                </a>
                <a href="{{ route('admin.faculty') }}" class="nav-item {{ request()->routeIs('admin.faculty*') ? 'active' : '' }}">
                    <i class="ri-user-star-line"></i> Faculty
                </a>
            </div>
            <div>
                <div class="nav-section-label">Academic</div>
                <a href="{{ route('admin.programs') }}" class="nav-item {{ request()->routeIs('admin.programs*') ? 'active' : '' }}">
                    <i class="ri-graduation-cap-line"></i> Programs
                </a>
                <a href="{{ route('admin.departments') }}" class="nav-item {{ request()->routeIs('admin.departments*') ? 'active' : '' }}">
                    <i class="ri-building-2-line"></i> Departments
                </a>
                <a href="{{ route('admin.subjects') }}" class="nav-item {{ request()->routeIs('admin.subjects*') || request()->routeIs('admin.courses*') ? 'active' : '' }}">
                    <i class="ri-book-open-line"></i> Subjects
                </a>
            </div>
            <div>
                <div class="nav-section-label">Assessment</div>
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
            <div class="profile-row">
                <div class="avatar"><i class="ri-user-line"></i></div>
                <div>
                    <div class="profile-name">{{ Auth::user()->name }}</div>
                    <div class="profile-email">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <button onclick="openLogoutModal()" class="logout-btn">
                <i class="ri-logout-box-line"></i> Sign Out
            </button>
        </div>
    </div>
</aside>

<!-- ══ MAIN CONTENT ══ -->
<div class="main-content">
    <header class="topbar">
        <div class="topbar-left">
            <button class="menu-toggle" id="menuToggle" onclick="toggleSidebar()">
                <i class="ri-menu-2-line"></i>
            </button>
            <div>
                <div class="topbar-title">NU Horizon <em>LMS</em></div>
                <div class="topbar-breadcrumb">Admin → User Management</div>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-badge">
                <span class="topbar-dot"></span>
                System Online
            </div>
            <div class="topbar-badge">
                <i class="ri-calendar-line"></i>
                <span id="topbar-date"></span>
            </div>
        </div>
    </header>

    <div class="page-body">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="ri-checkbox-circle-line"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                <i class="ri-error-warning-line"></i> {{ session('error') }}
            </div>
        @endif

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 12px;">
            <div class="dash-card-title" style="font-size: 0.9rem;">
                <i class="ri-team-line"></i> System Users
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn-primary-sm">
                <i class="ri-add-line"></i> Create New User
            </a>
        </div>

        <!-- Tabs -->
        <div class="tabs-container">
            <button class="tab-btn" id="studentsTabBtn" onclick="showUserTab('students')"><i class="ri-user-line"></i> Students</button>
            <button class="tab-btn" id="facultyTabBtn" onclick="showUserTab('faculty')"><i class="ri-user-star-line"></i> Faculty</button>
        </div>

        <!-- Students Table -->
        <div id="studentsContent" class="tab-content">
            <div class="dash-card">
                <div class="dash-card-head">
                    <span class="dash-card-title"><i class="ri-graduation-cap-line"></i> Enrolled Students</span>
                    <span class="status-badge" style="background:var(--navy-pale);">Total: {{ $students->total() }}</span>
                </div>
                <div style="overflow-x: auto;">
                    <table class="user-table">
                        <thead>
                            <tr><th>ID</th><th>Student ID</th><th>Name</th><th>Email</th><th>Department</th><th>Year</th><th>Courses</th><th>Quizzes</th><th>Status</th><th>Actions</th></tr>
                        </thead>
<<<<<<< HEAD
                        <tbody>
                            @forelse($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td class="font-mono text-xs">{{ $student->student_id ?? '—' }}</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width:28px;height:28px;background:var(--navy-pale);border-radius:50%;display:flex;align-items:center;justify-content:center;"><i class="ri-user-line" style="font-size:12px;"></i></div>
                                        <span>{{ $student->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->department ?? 'N/A' }}</td>
                                <td>{{ $student->year_level ? $student->year_level.' Year' : '—' }}</td>
                                <td>{{ $student->enrollments_count ?? 0 }}</td>
                                <td>{{ $student->quiz_attempts_count ?? 0 }}</td>
                                <td>
                                    <button onclick="toggleStatus({{ $student->id }})" class="status-toggle-{{ $student->id }}">
                                        @if($student->status === 'active')
                                            <span class="status-badge status-active">Active</span>
                                        @else
                                            <span class="status-badge status-inactive">Inactive</span>
                                        @endif
                                    </button>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 4px;">
                                        <a href="{{ route('admin.users.show', $student->id) }}" class="action-btn" title="View"><i class="ri-eye-line"></i></a>
                                        <a href="{{ route('admin.users.edit', $student->id) }}" class="action-btn" title="Edit"><i class="ri-edit-line"></i></a>
                                        @if($student->id !== Auth::id())
                                            <button onclick="openDeleteModal({{ $student->id }}, '{{ addslashes($student->name) }}', '{{ route('admin.users.delete', $student->id) }}')" class="action-btn danger" title="Delete"><i class="ri-delete-bin-line"></i></button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="10" style="text-align:center; padding:2rem;">No students found.</td></tr>
                            @endforelse
=======
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($students as $student)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-600">{{ $student->student_id ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                                <i class="ri-user-line text-indigo-600 text-sm"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">{{ $student->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $student->department_id ? ($student->departmentRel->name ?? 'N/A') : ($student->department ?? 'N/A') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->year_level ? $student->year_level . ' Year' : 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->student_courses_count ?? 0 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->quiz_attempts_count ?? 0 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button onclick="toggleStatus({{ $student->id }})" class="status-toggle-{{ $student->id }}">
                                            @if($student->status === 'active')
                                                <span class="status-badge bg-green-100 text-green-700">Active</span>
                                            @else
                                                <span class="status-badge bg-red-100 text-red-700">Inactive</span>
                                            @endif
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center gap-1">
                                            <a href="{{ route('admin.users.show', $student->id) }}"
                                               class="p-1.5 rounded-lg text-blue-500 hover:text-blue-700 hover:bg-blue-50 btn-icon transition"
                                               title="View">
                                                <i class="ri-eye-line text-base"></i>
                                            </a>
                                            <a href="{{ route('admin.users.edit', $student->id) }}"
                                               class="p-1.5 rounded-lg text-amber-500 hover:text-amber-700 hover:bg-amber-50 btn-icon transition"
                                               title="Edit">
                                                <i class="ri-edit-line text-base"></i>
                                            </a>
                                            @if($student->id !== Auth::id())
                                                <button type="button"
                                                        onclick="openDeleteModal({{ $student->id }}, '{{ addslashes($student->name) }}', '{{ route('admin.users.delete', $student->id) }}')"
                                                        class="p-1.5 rounded-lg text-red-400 hover:text-red-600 hover:bg-red-50 btn-icon transition"
                                                        title="Delete">
                                                    <i class="ri-delete-bin-line text-base"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
>>>>>>> 95cf8eb6cac99de3a335b21478d22a95268738d0
                        </tbody>
                    </table>
                </div>
                <div class="pagination-wrap">
                    {{ $students->links() }}
                </div>
            </div>
        </div>

        <!-- Faculty Table -->
        <div id="facultyContent" class="tab-content hidden">
            <div class="dash-card">
                <div class="dash-card-head">
                    <span class="dash-card-title"><i class="ri-user-star-line"></i> Faculty Members</span>
                    <span class="status-badge" style="background:var(--navy-pale);">Total: {{ $faculty->total() }}</span>
                </div>
                <div style="overflow-x: auto;">
                    <table class="user-table">
                        <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Department</th><th>Courses</th><th>Status</th><th>Actions</th></tr></thead>
                        <tbody>
                            @forelse($faculty as $facultyMember)
                            <tr>
                                <td>{{ $facultyMember->id }}</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width:28px;height:28px;background:rgba(124,58,237,0.1);border-radius:50%;display:flex;align-items:center;justify-content:center;"><i class="ri-user-star-line" style="font-size:12px;color:#7c3aed;"></i></div>
                                        {{ $facultyMember->name }}
                                    </div>
                                </td>
                                <td>{{ $facultyMember->email }}</td>
                                <td>{{ $facultyMember->department ?? 'N/A' }}</td>
                                <td>{{ $facultyMember->courses_count ?? 0 }}</td>
                                <td>
                                    <button onclick="toggleStatus({{ $facultyMember->id }})" class="status-toggle-{{ $facultyMember->id }}">
                                        @if($facultyMember->status === 'active')
                                            <span class="status-badge status-active">Active</span>
                                        @else
                                            <span class="status-badge status-inactive">Inactive</span>
                                        @endif
                                    </button>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 4px;">
                                        <a href="{{ route('admin.users.show', $facultyMember->id) }}" class="action-btn"><i class="ri-eye-line"></i></a>
                                        <a href="{{ route('admin.users.edit', $facultyMember->id) }}" class="action-btn"><i class="ri-edit-line"></i></a>
                                        @if($facultyMember->id !== Auth::id())
                                            <button onclick="openDeleteModal({{ $facultyMember->id }}, '{{ addslashes($facultyMember->name) }}', '{{ route('admin.users.delete', $facultyMember->id) }}')" class="action-btn danger"><i class="ri-delete-bin-line"></i></button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
<<<<<<< HEAD
                            @empty
                            <tr><td colspan="7" style="text-align:center; padding:2rem;">No faculty records.</td></tr>
                            @endforelse
=======
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($faculty as $facultyMember)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $facultyMember->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="h-8 w-8 bg-purple-100 rounded-full flex items-center justify-center">
                                                <i class="ri-user-star-line text-purple-600 text-sm"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">{{ $facultyMember->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $facultyMember->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $facultyMember->department_id ? ($facultyMember->departmentRel->name ?? 'N/A') : ($facultyMember->department ?? 'N/A') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $facultyMember->faculty_courses_count ?? 0 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button onclick="toggleStatus({{ $facultyMember->id }})" class="status-toggle-{{ $facultyMember->id }}">
                                            @if($facultyMember->status === 'active')
                                                <span class="status-badge bg-green-100 text-green-700">Active</span>
                                            @else
                                                <span class="status-badge bg-red-100 text-red-700">Inactive</span>
                                            @endif
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center gap-1">
                                            <a href="{{ route('admin.users.show', $facultyMember->id) }}"
                                               class="p-1.5 rounded-lg text-blue-500 hover:text-blue-700 hover:bg-blue-50 btn-icon transition"
                                               title="View">
                                                <i class="ri-eye-line text-base"></i>
                                            </a>
                                            <a href="{{ route('admin.users.edit', $facultyMember->id) }}"
                                               class="p-1.5 rounded-lg text-amber-500 hover:text-amber-700 hover:bg-amber-50 btn-icon transition"
                                               title="Edit">
                                                <i class="ri-edit-line text-base"></i>
                                            </a>
                                            @if($facultyMember->id !== Auth::id())
                                                <button type="button"
                                                        onclick="openDeleteModal({{ $facultyMember->id }}, '{{ addslashes($facultyMember->name) }}', '{{ route('admin.users.delete', $facultyMember->id) }}')"
                                                        class="p-1.5 rounded-lg text-red-400 hover:text-red-600 hover:bg-red-50 btn-icon transition"
                                                        title="Delete">
                                                    <i class="ri-delete-bin-line text-base"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
>>>>>>> 95cf8eb6cac99de3a335b21478d22a95268738d0
                        </tbody>
                    </table>
                </div>
                <div class="pagination-wrap">
                    {{ $faculty->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DELETE MODAL (dashboard style) -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal">
        <div class="modal-head">
            <h3><i class="ri-delete-bin-line"></i> Delete User</h3>
            <button class="modal-close" onclick="closeDeleteModal()">×</button>
        </div>
        <div class="modal-body">
            <i class="ri-alert-line" style="font-size:2rem;color:var(--danger);display:block;margin-bottom:0.5rem;"></i>
            <p>You are about to permanently delete <strong id="deleteUserName"></strong>.</p>
            <div class="user-name-chip" style="margin-top:0.8rem;">This action cannot be undone</div>
        </div>
        <div class="modal-foot">
            <button class="btn-cancel" onclick="closeDeleteModal()">Cancel</button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-confirm">Yes, Delete</button>
            </form>
        </div>
    </div>
</div>

<!-- LOGOUT MODAL (dashboard style) -->
<div class="modal-overlay" id="logoutModal">
    <div class="modal">
        <div class="modal-head">
            <h3><i class="ri-logout-box-r-line"></i> Confirm Sign Out</h3>
            <button class="modal-close" onclick="closeLogoutModal()">×</button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to sign out of your account?</p>
            <p style="font-size:0.7rem; margin-top:0.5rem;">You will be redirected to the login page.</p>
        </div>
        <div class="modal-foot">
            <button class="btn-cancel" onclick="closeLogoutModal()">Cancel</button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-confirm">Yes, Sign Out</button>
            </form>
        </div>
    </div>
</div>

<script>
    // date & sidebar toggles
    const d = new Date();
    document.getElementById('topbar-date').textContent = d.toLocaleDateString('en-PH', { month: 'short', day: 'numeric', year: 'numeric' });
    function toggleSidebar() { const s = document.getElementById('sidebar'); s.classList.toggle('open'); document.getElementById('sidebarOverlay').style.display = s.classList.contains('open') ? 'block' : 'none'; }
    function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); document.getElementById('sidebarOverlay').style.display = 'none'; }

    // Tab switching
    function showUserTab(tab) {
        const studentsDiv = document.getElementById('studentsContent');
        const facultyDiv = document.getElementById('facultyContent');
        const studentsBtn = document.getElementById('studentsTabBtn');
        const facultyBtn = document.getElementById('facultyTabBtn');
        if (tab === 'students') {
            studentsDiv.classList.remove('hidden');
            facultyDiv.classList.add('hidden');
            studentsBtn.classList.add('active-tab');
            facultyBtn.classList.remove('active-tab');
        } else {
            facultyDiv.classList.remove('hidden');
            studentsDiv.classList.add('hidden');
            facultyBtn.classList.add('active-tab');
            studentsBtn.classList.remove('active-tab');
        }
        history.replaceState(null, '', '#' + tab);
    }
    const hash = window.location.hash.substring(1);
    if (hash === 'faculty') showUserTab('faculty');
    else showUserTab('students');

    // Toggle status AJAX (same endpoint)
    function toggleStatus(userId) {
        fetch(`/admin/users/${userId}/toggle-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                const btn = document.querySelector(`.status-toggle-${userId}`);
                if (data.status === 'active') {
                    btn.innerHTML = '<span class="status-badge status-active">Active</span>';
                } else {
                    btn.innerHTML = '<span class="status-badge status-inactive">Inactive</span>';
                }
            } else {
                alert(data.message || 'Error toggling status');
            }
        })
        .catch(() => alert('Network error while updating status'));
    }

    // Delete modal handling
    function openDeleteModal(userId, userName, actionUrl) {
        document.getElementById('deleteUserName').innerText = userName;
        document.getElementById('deleteForm').action = actionUrl;
        document.getElementById('deleteModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    document.getElementById('deleteModal')?.addEventListener('click', (e) => { if (e.target === document.getElementById('deleteModal')) closeDeleteModal(); });
    document.getElementById('logoutModal')?.addEventListener('click', (e) => { if (e.target === document.getElementById('logoutModal')) closeLogoutModal(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') { closeDeleteModal(); closeLogoutModal(); } });
</script>
</body>
</html>