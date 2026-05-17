<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Faculty Details – {{ $faculty->name }} | NU Horizon LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        /* ══ DESIGN TOKENS (mirrored from dashboard) ══ */
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

        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(10,31,68,0.15); border-radius: 99px; }

        /* ══ SIDEBAR (identical to dashboard) ══ */
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
        .logo-seal-wrap { position: relative; flex-shrink: 0; }
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
        .nav-item:hover { background: rgba(255,215,15,0.10); color: rgba(255,255,255,0.92); }
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
            cursor: pointer;
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
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: transparent;
            border: 1px solid var(--bdr);
            border-radius: 40px;
            padding: .45rem 1rem;
            font-size: .75rem;
            font-weight: 600;
            color: var(--txt-2);
            transition: all var(--t);
            text-decoration: none;
        }
        .back-btn:hover {
            background: var(--bg);
            border-color: var(--gold-d);
            color: var(--navy);
        }

        /* PAGE BODY */
        .page-body { padding: 1.8rem 2rem; flex: 1; }

        /* cards */
        .dash-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            overflow: hidden;
            margin-bottom: 1.5rem;
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
        .dash-card-body { padding: 1.2rem 1.3rem; }

        /* layout */
        .two-col-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 1.5rem;
        }
        @media (max-width: 1024px) {
            .two-col-grid { grid-template-columns: 1fr; }
        }

        /* profile card */
        .profile-avatar {
            width: 80px; height: 80px;
            margin: 0 auto 1rem;
            border-radius: 50%;
            background: var(--navy-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            color: var(--navy-lite);
        }
        .stat-row {
            display: flex;
            justify-content: space-between;
            padding: 0.7rem 0;
            border-bottom: 1px solid var(--bdr);
        }
        .stat-row:last-child { border-bottom: none; }
        .stat-label {
            font-size: 0.75rem;
            color: var(--txt-3);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .stat-value {
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--txt-1);
        }

        /* course list */
        .course-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.9rem 1.3rem;
            border-bottom: 1px solid var(--bdr);
            transition: background 0.2s;
        }
        .course-item:last-child { border-bottom: none; }
        .course-item:hover { background: var(--bg); }
        .course-info h4 {
            font-size: 0.8rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
        }
        .course-info p {
            font-size: 0.7rem;
            color: var(--txt-3);
        }
        .course-stats {
            display: flex;
            gap: 0.8rem;
            align-items: center;
        }
        .stat-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.2rem 0.6rem;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
            background: var(--navy-pale);
            color: var(--navy-mid);
        }
        .action-icon {
            padding: 0.3rem;
            border-radius: 6px;
            color: var(--txt-3);
            transition: all var(--t);
            cursor: pointer;
            background: transparent;
            border: none;
        }
        .action-icon:hover { background: rgba(220,38,38,0.1); color: var(--danger); }

        /* modal (common) */
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
            width: min(560px, 94vw);
            max-height: 85vh;
            overflow: hidden;
            transform: scale(0.94) translateY(12px);
            transition: transform .28s var(--spring);
            display: flex;
            flex-direction: column;
        }
        .modal-overlay.active .modal { transform: scale(1) translateY(0); }
        .modal-head {
            background: var(--navy);
            padding: 1rem 1.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid var(--gold);
            flex-shrink: 0;
        }
        .modal-head h3 {
            font-family: 'Fraunces', serif;
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .modal-close {
            background: none;
            border: none;
            color: rgba(255,255,255,0.55);
            font-size: 1.3rem;
            cursor: pointer;
        }
        .modal-body {
            padding: 1.2rem 1.4rem;
            overflow-y: auto;
            flex: 1;
        }
        .modal-foot {
            padding: 0.8rem 1.4rem 1.2rem;
            display: flex;
            gap: 0.6rem;
            justify-content: flex-end;
            background: var(--bg);
            border-top: 1px solid var(--bdr);
            flex-shrink: 0;
        }
        .btn-cancel, .btn-primary {
            padding: 0.5rem 1.1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all var(--t);
        }
        .btn-cancel {
            background: transparent;
            border: 1px solid var(--bdr);
            color: var(--txt-2);
        }
        .btn-primary {
            background: var(--navy);
            border: none;
            color: white;
        }
        .btn-primary:hover { background: var(--navy-mid); transform: translateY(-1px); }

        /* search input inside modal */
        .search-wrapper {
            position: relative;
            margin-bottom: 1rem;
        }
        .search-wrapper i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--txt-3);
            font-size: 0.85rem;
        }
        .search-input {
            width: 100%;
            padding: 0.6rem 0.8rem 0.6rem 2rem;
            border-radius: 10px;
            border: 1px solid var(--bdr);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.75rem;
        }
        .course-check-item {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.6rem 0.8rem;
            border: 1px solid var(--bdr);
            border-radius: 10px;
            margin-bottom: 0.5rem;
            cursor: pointer;
            transition: all var(--t);
        }
        .course-check-item:hover { border-color: var(--gold-d); background: var(--gold-pale); }
        .course-check-item input[type="checkbox"] { accent-color: var(--navy); width: 16px; height: 16px; }
        .course-check-item.checked { border-color: var(--gold-d); background: rgba(196,154,0,0.05); }
        .badge-assigned {
            font-size: 0.65rem;
            background: rgba(61,95,160,0.12);
            color: var(--navy-lite);
            padding: 0.15rem 0.5rem;
            border-radius: 40px;
            margin-left: auto;
        }

        .alert {
            padding: 0.75rem 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.75rem;
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
            .page-body { padding: 1rem; }
            .topbar { padding: 0.8rem 1rem; }
        }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- SIDEBAR -->
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
                <a href="{{ route('admin.dashboard') }}" class="nav-item"><i class="ri-dashboard-line"></i> Dashboard</a>
                <a href="{{ route('admin.users') }}" class="nav-item active"><i class="ri-team-line"></i> Users</a>
                <a href="{{ route('admin.users.create') }}" class="nav-item"><i class="ri-user-add-line"></i> Account Creation</a>
                <a href="{{ route('admin.faculty') }}" class="nav-item"><i class="ri-user-star-line"></i> Faculty</a>
            </div>
            <div>
                <div class="nav-section-label">Academic</div>
                <a href="{{ route('admin.programs') }}" class="nav-item"><i class="ri-graduation-cap-line"></i> Programs</a>
                <a href="{{ route('admin.departments') }}" class="nav-item"><i class="ri-building-2-line"></i> Departments</a>
                <a href="{{ route('admin.subjects') }}" class="nav-item"><i class="ri-book-open-line"></i> Subjects</a>
            </div>
            <div>
                <div class="nav-section-label">Assessment</div>
                <a href="{{ route('admin.faculty-evaluations') }}" class="nav-item"><i class="ri-star-smile-line"></i> Faculty Evaluation</a>
                <a href="{{ route('admin.folder-files') }}" class="nav-item"><i class="ri-folder-3-line"></i> Folder & Files</a>
                <a href="{{ route('admin.analytics') }}" class="nav-item"><i class="ri-bar-chart-line"></i> Analytics</a>
                <a href="{{ route('admin.logs') }}" class="nav-item"><i class="ri-history-line"></i> Activity Logs</a>
                <a href="{{ route('admin.settings') }}" class="nav-item"><i class="ri-settings-line"></i> Settings</a>
            </div>
        </div>
        <div class="sidebar-footer">
            <div class="profile-row" onclick="window.location='{{ route('admin.profile') }}'">
                <div class="avatar"><i class="ri-user-line"></i></div>
                <div>
                    <div class="profile-name">{{ Auth::user()->name }}</div>
                    <div class="profile-email">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <button onclick="openLogoutModal()" class="logout-btn"><i class="ri-logout-box-line"></i> Sign Out</button>
        </div>
    </div>
</aside>

<!-- MAIN CONTENT -->
<div class="main-content">
    <header class="topbar">
        <div class="topbar-left">
            <button class="menu-toggle" id="menuToggle" onclick="toggleSidebar()"><i class="ri-menu-2-line"></i></button>
            <div>
                <div class="topbar-title">NU Horizon <em>LMS</em></div>
                <div class="topbar-breadcrumb">Admin → Users → Faculty Details</div>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-badge"><span class="topbar-dot"></span> System Online</div>
            <div class="topbar-badge"><i class="ri-calendar-line"></i><span id="topbar-date"></span></div>
            <a href="{{ route('admin.users') }}" class="back-btn"><i class="ri-arrow-left-line"></i> Back to Users</a>
        </div>
    </header>

    <div class="page-body">
        @if(session('success'))
            <div class="alert alert-success"><i class="ri-checkbox-circle-line"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error"><i class="ri-error-warning-line"></i> {{ session('error') }}</div>
        @endif

        <div class="two-col-grid">
            <!-- LEFT COLUMN: Profile Card -->
            <div>
                <div class="dash-card">
                    <div class="dash-card-body" style="text-align: center;">
                        <div class="profile-avatar"><i class="ri-user-star-line"></i></div>
                        <h2 style="font-family: 'Fraunces', serif; font-size: 1.3rem;">{{ $faculty->name }}</h2>
                        <p style="color: var(--txt-3); font-size: 0.8rem;">{{ $faculty->email }}</p>
                        @if($faculty->faculty_id)
                            <p style="font-size: 0.7rem; background: var(--navy-pale); display: inline-block; padding: 0.2rem 0.8rem; border-radius: 40px; margin-top: 0.5rem;">
                                ID: {{ $faculty->faculty_id }}
                            </p>
                        @endif
                        <div style="margin-top: 1rem;">
                            <span class="stat-pill {{ $faculty->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($faculty->status ?? 'active') }}
                            </span>
                        </div>
                    </div>
                    <div style="border-top: 1px solid var(--bdr); padding: 1rem 1.3rem;">
                        <div class="stat-row"><span class="stat-label"><i class="ri-building-2-line"></i> Department</span><span class="stat-value">{{ $faculty->department_id ? ($faculty->departmentRel->name ?? 'N/A') : ($faculty->department ?? 'N/A') }}</span></div>
                        <div class="stat-row"><span class="stat-label"><i class="ri-microscope-line"></i> Specialization</span><span class="stat-value">{{ $faculty->specialization ?? 'N/A' }}</span></div>
                        <div class="stat-row"><span class="stat-label"><i class="ri-award-line"></i> Qualification</span><span class="stat-value">{{ $faculty->qualification ?? 'N/A' }}</span></div>
                        <div class="stat-row"><span class="stat-label"><i class="ri-book-open-line"></i> Courses</span><span class="stat-value">{{ count($assignedIds) }}</span></div>
                    </div>
                    <div style="padding: 0 1.3rem 1.2rem; display: flex; gap: 0.6rem;">
                        <a href="{{ route('admin.users.edit', $faculty->id) }}" class="btn-cancel" style="flex:1; text-align: center; text-decoration: none;"><i class="ri-edit-line"></i> Edit</a>
                        <button onclick="openAssignModal()" class="btn-primary" style="flex:1;"><i class="ri-add-line"></i> Assign Course</button>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="dash-card">
                    <div class="dash-card-head"><div class="dash-card-title"><i class="ri-bar-chart-2-line"></i> Quick Stats</div></div>
                    <div class="dash-card-body">
                        @php
                            $totalStudents = 0; $totalQuizzes = 0;
                            foreach ($faculty->courses as $c) { $totalStudents += $c->students->count(); $totalQuizzes += $c->quizzes->count(); }
                        @endphp
                        <div class="stat-row"><span class="stat-label"><i class="ri-book-open-line"></i> Assigned Courses</span><span class="stat-value">{{ count($assignedIds) }}</span></div>
                        <div class="stat-row"><span class="stat-label"><i class="ri-group-line"></i> Total Students</span><span class="stat-value">{{ $totalStudents }}</span></div>
                        <div class="stat-row"><span class="stat-label"><i class="ri-list-check"></i> Quizzes Created</span><span class="stat-value">{{ $totalQuizzes }}</span></div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Assigned Courses & Quizzes -->
            <div>
                <!-- Assigned Courses List -->
                <div class="dash-card">
                    <div class="dash-card-head">
                        <div class="dash-card-title"><i class="ri-book-open-line"></i> Assigned Courses</div>
                        <span class="stat-pill" style="background: var(--navy-pale);">{{ count($assignedIds) }} courses</span>
                    </div>
                    @php $assignedCourses = $faculty->courses->whereIn('id', $assignedIds); @endphp
                    @if($assignedCourses->count() > 0)
                        @foreach($assignedCourses as $course)
                            @php $studentCount = $course->students->count(); $quizCount = $course->quizzes->count(); @endphp
                            <div class="course-item">
                                <div class="course-info">
                                    <h4>{{ $course->code }} – {{ $course->name }}</h4>
                                    <p>{{ $course->program->name ?? 'No Program' }}</p>
                                </div>
                                <div class="course-stats">
                                    <span class="stat-pill"><i class="ri-group-line"></i> {{ $studentCount }}</span>
                                    <span class="stat-pill"><i class="ri-list-check"></i> {{ $quizCount }}</span>
                                    <form action="{{ route('admin.faculty.unassign-course', ['faculty' => $faculty->id, 'course' => $course->id]) }}" method="POST" class="inline" onsubmit="return confirm('Remove this course from {{ addslashes($faculty->name) }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="action-icon" title="Unassign"><i class="ri-close-line"></i></button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="dash-card-body" style="text-align: center; padding: 2rem;">
                            <i class="ri-book-open-line" style="font-size: 2rem; opacity: 0.3;"></i>
                            <p style="margin-top: 0.5rem; color: var(--txt-3);">No courses assigned yet.</p>
                            <button onclick="openAssignModal()" class="btn-primary" style="margin-top: 1rem;"><i class="ri-add-line"></i> Assign a Course</button>
                        </div>
                    @endif
                </div>

                <!-- Quizzes by Course -->
                @if($assignedCourses->count() > 0)
                <div class="dash-card">
                    <div class="dash-card-head"><div class="dash-card-title"><i class="ri-list-check"></i> Quizzes by Course</div></div>
                    @php $hasAnyQuiz = false; @endphp
                    @foreach($assignedCourses as $course)
                        @if($course->quizzes->count() > 0)
                            @php $hasAnyQuiz = true; @endphp
                            <div style="border-bottom: 1px solid var(--bdr);">
                                <div style="padding: 0.6rem 1.3rem; background: var(--bg);"><span class="stat-pill" style="background: transparent;">{{ $course->code }} – {{ $course->name }}</span></div>
                                @foreach($course->quizzes as $quiz)
                                    <div class="course-item" style="padding-left: 2rem;">
                                        <div class="course-info">
                                            <h4>{{ $quiz->title }}</h4>
                                            <p>{{ $quiz->questions_count ?? $quiz->questions->count() ?? 0 }} questions · {{ $quiz->total_points ?? 0 }} pts</p>
                                        </div>
                                        <span class="stat-pill {{ ($quiz->is_published ?? false) ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                            {{ ($quiz->is_published ?? false) ? 'Published' : 'Draft' }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                    @if(!$hasAnyQuiz)
                        <div class="dash-card-body" style="text-align: center;"><p class="text-gray-400">No quizzes created for any assigned course.</p></div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- ASSIGN COURSE MODAL -->
<div id="assignModal" class="modal-overlay">
    <div class="modal">
        <div class="modal-head">
            <h3><i class="ri-book-open-line"></i> Assign Courses</h3>
            <button class="modal-close" onclick="closeAssignModal()">×</button>
        </div>
        <div class="modal-body">
            <p style="font-size: 0.75rem; color: var(--txt-3); margin-bottom: 0.8rem;">Select courses to assign to <strong>{{ $faculty->name }}</strong>. Already assigned are pre-checked.</p>
            <div class="search-wrapper">
                <i class="ri-search-line"></i>
                <input type="text" id="courseSearch" class="search-input" placeholder="Search courses..." onkeyup="filterCourseList()">
            </div>
            <form id="assignForm" method="POST" action="{{ route('admin.faculty.assign-courses', $faculty->id) }}">
                @csrf
                <div id="courseListContainer">
                    @foreach($allCourses as $course)
                        @php $checked = in_array($course->id, $assignedIds); @endphp
                        <label class="course-check-item {{ $checked ? 'checked' : '' }}" data-name="{{ strtolower($course->name . ' ' . $course->code) }}">
                            <input type="checkbox" name="course_ids[]" value="{{ $course->id }}" {{ $checked ? 'checked' : '' }} onchange="this.closest('label').classList.toggle('checked', this.checked)">
                            <div style="flex:1;">
                                <div style="font-weight: 600; font-size: 0.75rem;">{{ $course->code }} – {{ $course->name }}</div>
                                <div style="font-size: 0.65rem; color: var(--txt-3);">{{ $course->program->name ?? 'No Program' }}</div>
                            </div>
                            @if($checked)
                                <span class="badge-assigned">Assigned</span>
                            @endif
                        </label>
                    @endforeach
                    @if($allCourses->isEmpty())
                        <p class="text-center text-gray-400 text-sm py-3">No courses available.</p>
                    @endif
                </div>
            </form>
        </div>
        <div class="modal-foot">
            <button class="btn-cancel" onclick="closeAssignModal()">Cancel</button>
            <button class="btn-primary" onclick="document.getElementById('assignForm').submit()">Save Assignments</button>
        </div>
    </div>
</div>

<!-- LOGOUT MODAL -->
<div id="logoutModal" class="modal-overlay">
    <div class="modal" style="max-width: 440px;">
        <div class="modal-head">
            <h3><i class="ri-logout-box-r-line"></i> Confirm Sign Out</h3>
            <button class="modal-close" onclick="closeLogoutModal()">×</button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to sign out of your account?</p>
            <p style="font-size: 0.7rem; margin-top: 0.5rem;">You will be redirected to the login page.</p>
        </div>
        <div class="modal-foot">
            <button class="btn-cancel" onclick="closeLogoutModal()">Cancel</button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-primary" style="background: var(--danger);">Yes, Sign Out</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('topbar-date').textContent = new Date().toLocaleDateString('en-PH', { month: 'short', day: 'numeric', year: 'numeric' });

    function toggleSidebar() {
        const s = document.getElementById('sidebar');
        const o = document.getElementById('sidebarOverlay');
        const open = s.classList.toggle('open');
        o.style.display = open ? 'block' : 'none';
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').style.display = 'none';
    }

    function openAssignModal() { document.getElementById('assignModal').classList.add('active'); document.body.style.overflow = 'hidden'; }
    function closeAssignModal() { document.getElementById('assignModal').classList.remove('active'); document.body.style.overflow = ''; }
    function openLogoutModal() { document.getElementById('logoutModal').classList.add('active'); document.body.style.overflow = 'hidden'; }
    function closeLogoutModal() { document.getElementById('logoutModal').classList.remove('active'); document.body.style.overflow = ''; }

    document.getElementById('assignModal')?.addEventListener('click', e => { if (e.target === e.currentTarget) closeAssignModal(); });
    document.getElementById('logoutModal')?.addEventListener('click', e => { if (e.target === e.currentTarget) closeLogoutModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') { closeAssignModal(); closeLogoutModal(); } });

    function filterCourseList() {
        const query = document.getElementById('courseSearch').value.toLowerCase();
        document.querySelectorAll('#courseListContainer .course-check-item').forEach(item => {
            const name = item.getAttribute('data-name') || '';
            item.style.display = name.includes(query) ? '' : 'none';
        });
    }
</script>
</body>
</html>
