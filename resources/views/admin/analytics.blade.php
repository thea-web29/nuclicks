<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Analytics & Reports – NU Horizon LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* ══ DESIGN TOKENS (fully mirrored from dashboard) ══ */
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

        /* ══ SIDEBAR (exactly as dashboard) ══ */
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
        .export-btn {
            background: var(--gold);
            border: none;
            color: var(--navy);
            padding: .45rem 1rem;
            font-weight: 700;
            font-size: .75rem;
            border-radius: 40px;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all var(--t);
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .export-btn:hover {
            background: var(--gold-mid);
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(196,154,0,0.2);
        }

        /* ══ DASHBOARD CARD (shared) ══ */
        .page-body { padding: 1.8rem 2rem; flex: 1; }
        .section-header {
            margin-bottom: 1.4rem;
        }
        .section-header h2 {
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: var(--txt-3);
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .section-header h2::after {
            content: "";
            flex: 1;
            height: 1px;
            background: var(--bdr);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 1.8rem;
        }
        .stat-card {
            background: var(--white);
            border-radius: 14px;
            padding: 1.2rem 1.1rem;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            transition: all var(--t);
            position: relative;
            overflow: hidden;
            animation: fadeUp .5s var(--ease) both;
        }
        .stat-card::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            border-radius: 14px 14px 0 0;
        }
        .stat-card.navy::before  { background: linear-gradient(90deg, var(--navy-lite), var(--navy)); }
        .stat-card.green::before { background: linear-gradient(90deg, #4ade80, #16a34a); }
        .stat-card.purple::before{ background: linear-gradient(90deg, #a78bfa, #7c3aed); }
        .stat-card.gold::before  { background: linear-gradient(90deg, var(--gold-mid), var(--gold-d)); }
        .stat-value { font-family: 'Fraunces', serif; font-size: 2rem; font-weight: 700; line-height: 1; margin-bottom: .35rem; }
        .stat-card.navy  .stat-value { color: var(--navy); }
        .stat-card.green .stat-value { color: var(--green); }
        .stat-card.purple .stat-value { color: var(--purple); }
        .stat-card.gold  .stat-value { color: var(--gold-d); }

        .dash-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }
        .dash-card-head {
            padding: 1rem 1.3rem .8rem;
            border-bottom: 1px solid var(--bdr);
            display: flex;
            align-items: center;
            justify-content: space-between;
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

        .overview-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.2rem;
            margin-bottom: 1.8rem;
        }
        .perf-stat {
            text-align: center;
        }
        .perf-big-number {
            font-family: 'Fraunces', serif;
            font-size: 2.3rem;
            font-weight: 700;
            color: var(--navy);
        }
        .progress-bar-bg {
            background: var(--bg);
            border-radius: 99px;
            height: 6px;
            overflow: hidden;
            border: 1px solid var(--bdr);
            margin-top: 6px;
        }
        .progress-fill {
            background: linear-gradient(90deg, var(--gold-mid), var(--gold-d));
            height: 100%;
            border-radius: 99px;
        }
        .progress-fill-red { background: var(--danger); }
        .progress-fill-green { background: var(--green); }

        /* Tables styling */
        .analytics-table-wrapper {
            overflow-x: auto;
        }
        .analytics-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.78rem;
        }
        .analytics-table th {
            text-align: left;
            padding: 0.85rem 1rem;
            background: var(--bg);
            font-weight: 700;
            color: var(--txt-2);
            border-bottom: 1px solid var(--bdr);
        }
        .analytics-table td {
            padding: 0.9rem 1rem;
            border-bottom: 1px solid var(--bdr);
            color: var(--txt-2);
        }
        .analytics-table tr:last-child td { border-bottom: none; }
        .status-badge {
            display: inline-flex;
            padding: 0.2rem 0.6rem;
            border-radius: 99px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        .status-excellent { background: rgba(22,163,74,0.12); color: var(--green); }
        .status-average { background: rgba(245,200,0,0.12); color: #b45309; }
        .status-needs { background: rgba(220,38,38,0.12); color: var(--danger); }

        @keyframes fadeUp {
            from { opacity:0; transform:translateY(16px); }
            to   { opacity:1; transform:translateY(0); }
        }

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
        .modal-body { padding: 1.5rem; }
        .modal-foot {
            padding: .9rem 1.4rem 1.3rem;
            display: flex;
            gap: .6rem;
            justify-content: flex-end;
            background: var(--bg);
            border-top: 1px solid var(--bdr);
        }
        .btn-cancel, .btn-confirm, .btn-primary {
            padding: .6rem 1.2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: .8rem;
            cursor: pointer;
        }
        .btn-cancel {
            background: var(--white);
            border: 1px solid var(--bdr);
        }
        .btn-confirm {
            background: var(--danger);
            border: none;
            color: white;
        }
        .btn-primary {
            background: var(--navy);
            color: white;
            border: none;
        }
        select, input {
            border: 1px solid var(--bdr);
            border-radius: 10px;
            padding: 0.6rem;
            width: 100%;
            font-family: inherit;
        }
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay { display: block; }
            .main-content { margin-left: 0; }
            .menu-toggle { display: flex; }
            .overview-grid { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: repeat(2,1fr); }
        }
        @media (max-width: 640px) {
            .stats-grid { grid-template-columns: 1fr; }
            .page-body { padding: 1rem; }
        }
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(10,31,68,0.65);
            z-index: 90;
        }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- SIDEBAR (exact from dashboard) -->
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
            <div><div class="nav-section-label">Main</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item"> <i class="ri-dashboard-line"></i> Dashboard</a>
                <a href="{{ route('admin.users') }}" class="nav-item"> <i class="ri-team-line"></i> Users</a>
                <a href="{{ route('admin.users.create') }}" class="nav-item"> <i class="ri-user-add-line"></i> Account Creation</a>
                <a href="{{ route('admin.faculty') }}" class="nav-item"> <i class="ri-user-star-line"></i> Faculty</a>
            </div>
            <div><div class="nav-section-label">Academic</div>
                <a href="{{ route('admin.programs') }}" class="nav-item"> <i class="ri-graduation-cap-line"></i> Programs</a>
                <a href="{{ route('admin.departments') }}" class="nav-item"> <i class="ri-building-2-line"></i> Departments</a>
                <a href="{{ route('admin.subjects') }}" class="nav-item"> <i class="ri-book-open-line"></i> Subjects</a>
            </div>
            <div><div class="nav-section-label">Assessment</div>
                <a href="{{ route('admin.analytics') }}" class="nav-item active"> <i class="ri-bar-chart-line"></i> Analytics</a>
                <a href="{{ route('admin.logs') }}" class="nav-item"> <i class="ri-history-line"></i> Activity Logs</a>
                <a href="{{ route('admin.settings') }}" class="nav-item"> <i class="ri-settings-line"></i> Settings</a>
            </div>
        </div>
        <div class="sidebar-footer">
            <div class="profile-row">
                <div class="avatar"><i class="ri-user-line"></i></div>
                <div><div class="profile-name">{{ Auth::user()->name }}</div><div class="profile-email">{{ Auth::user()->email }}</div></div>
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
            <div><div class="topbar-title">NU Horizon <em>LMS</em></div><div class="topbar-breadcrumb">Admin → Analytics & Reports</div></div>
        </div>
        <div class="topbar-right">
            <div class="topbar-badge"><span class="topbar-dot"></span> System Online</div>
            <div class="topbar-badge"><i class="ri-calendar-line"></i><span id="topbar-date"></span></div>
            <button onclick="showExportModal()" class="export-btn"><i class="ri-download-line"></i> Export Report</button>
        </div>
    </header>

    <div class="page-body">
        <!-- Stats cards (4) -->
        <div class="stats-grid">
            <div class="stat-card navy"><div class="stat-label">Total Students</div><div class="stat-value">{{ number_format($totalStudents) }}</div></div>
            <div class="stat-card green"><div class="stat-label">Total Faculty</div><div class="stat-value">{{ number_format($totalFaculty) }}</div></div>
            <div class="stat-card purple"><div class="stat-label">Total Courses</div><div class="stat-value">{{ number_format($totalCourses) }}</div></div>
            <div class="stat-card gold"><div class="stat-label">Total Quizzes</div><div class="stat-value">{{ number_format($totalQuizzes) }}</div></div>
        </div>

        <!-- Analytics Overview (3 cards) -->
        <div class="overview-grid">
            <div class="dash-card"><div class="dash-card-head"><div class="dash-card-title"><i class="ri-bar-chart-line"></i> Overall Performance</div></div>
                <div class="dash-card-body"><div class="perf-stat"><div class="perf-big-number">{{ $overallAverage }}%</div><div class="text-sm text-gray-500 mt-1">Average Score</div><div class="mt-3 text-sm">Total Attempts: <strong>{{ number_format($totalAttempts) }}</strong></div></div></div>
            </div>
            <div class="dash-card"><div class="dash-card-head"><div class="dash-card-title"><i class="ri-pie-chart-line"></i> Pass / Fail Rate</div></div>
                <div class="dash-card-body"><div class="flex justify-between items-center mb-1"><span>Pass Rate</span><span class="font-bold text-green-600">{{ $passRate }}%</span></div><div class="progress-bar-bg"><div class="progress-fill-green" style="width: {{ $passRate }}%; height:100%"></div></div>
                <div class="flex justify-between items-center mt-3 mb-1"><span>Fail Rate</span><span class="font-bold text-red-600">{{ $failRate }}%</span></div><div class="progress-bar-bg"><div class="progress-fill-red" style="width: {{ $failRate }}%; height:100%"></div></div></div>
            </div>
            <div class="dash-card"><div class="dash-card-head"><div class="dash-card-title"><i class="ri-line-chart-line"></i> Monthly Trend</div></div>
                <div class="dash-card-body"><canvas id="trendChart" height="180"></canvas></div>
            </div>
        </div>

        <!-- Course Performance Table -->
        <div class="dash-card"><div class="dash-card-head"><div class="dash-card-title"><i class="ri-book-open-line"></i> Course Performance</div></div>
            <div class="analytics-table-wrapper"><table class="analytics-table"><thead><tr><th>Course</th><th>Students</th><th>Quizzes</th><th>Attempts</th><th>Avg Score</th><th>Status</th></tr></thead>
            <tbody>@foreach($coursePerformance as $course)<tr><td><div><div class="font-medium">{{ $course['code'] }}</div><div class="text-xs text-gray-500">{{ $course['name'] }}</div></div></td>
            <td>{{ $course['students'] }}</td><td>{{ $course['quizzes'] }}</td><td>{{ number_format($course['attempts']) }}</td><td><div class="flex items-center gap-2"><span class="font-semibold">{{ $course['average_score'] }}%</span><div class="w-16 bg-gray-200 rounded-full h-1.5"><div class="bg-gold-600 rounded-full h-1.5" style="width: {{ $course['average_score'] }}%; background:var(--gold-d);"></div></div></div></td>
            <td>@if($course['average_score'] >= 70)<span class="status-badge status-excellent">Excellent</span>@elseif($course['average_score'] >= 50)<span class="status-badge status-average">Average</span>@else<span class="status-badge status-needs">Needs Improvement</span>@endif</td></tr>@endforeach</tbody></table></div>
        </div>

        <!-- Faculty Performance Table -->
        <div class="dash-card"><div class="dash-card-head"><div class="dash-card-title"><i class="ri-user-star-line"></i> Faculty Performance</div></div>
            <div class="analytics-table-wrapper"><table class="analytics-table"><thead><tr><th>Faculty</th><th>Courses</th><th>Total Attempts</th><th>Avg Score</th></tr></thead>
            <tbody>@foreach($facultyPerformance as $faculty)<tr><td><div><div class="font-medium">{{ $faculty['name'] }}</div><div class="text-xs text-gray-500">{{ $faculty['email'] }}</div></div></td>
            <td>{{ $faculty['courses'] }}</td><td>{{ number_format($faculty['attempts']) }}</td><td><div class="flex items-center gap-2"><span class="font-semibold">{{ $faculty['average_score'] }}%</span><div class="w-16 bg-gray-200 rounded-full h-1.5"><div class="rounded-full h-1.5" style="width: {{ $faculty['average_score'] }}%; background:var(--gold-d);"></div></div></div></td></tr>@endforeach</tbody></table></div>
        </div>

        <!-- Top Students Table -->
        <div class="dash-card"><div class="dash-card-head"><div class="dash-card-title"><i class="ri-medal-line"></i> Top Performing Students</div></div>
            <div class="analytics-table-wrapper"><table class="analytics-table"><thead><tr><th>Student</th><th>Email</th><th>Attempts</th><th>Avg Score</th></tr></thead>
            <tbody>@foreach($topStudents as $student)<tr><td><div class="flex items-center gap-2"><div class="w-6 h-6 bg-navy-pale rounded-full flex items-center justify-center"><i class="ri-user-line text-xs"></i></div>{{ $student['name'] }}</div></td>
            <td>{{ $student['email'] }}</td><td>{{ $student['attempts'] }}</td><td><div class="flex items-center gap-2"><span class="font-semibold text-green-600">{{ $student['average_score'] }}%</span><div class="w-16 bg-gray-200 rounded-full h-1.5"><div class="bg-green-600 rounded-full h-1.5" style="width: {{ $student['average_score'] }}%"></div></div></div></td></tr>@endforeach</tbody></table></div>
        </div>
    </div>
</div>

<!-- LOGOUT MODAL (same as dashboard) -->
<div class="modal-overlay" id="logoutModal"><div class="modal"><div class="modal-head"><h3><i class="ri-logout-box-r-line"></i> Confirm Sign Out</h3><button class="modal-close" onclick="closeLogoutModal()">×</button></div><div class="modal-body"><p>Are you sure you want to sign out of your account?</p><p class="modal-warn text-xs text-gray-500">You will be redirected to the login page.</p></div><div class="modal-foot"><button class="btn-cancel" onclick="closeLogoutModal()">Cancel</button><form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="btn-confirm">Yes, Sign Out</button></form></div></div></div>

<!-- EXPORT MODAL (styled unified) -->
<div class="modal-overlay" id="exportModal"><div class="modal"><div class="modal-head"><h3><i class="ri-database-2-line"></i> Export Report</h3><button class="modal-close" onclick="closeExportModal()">×</button></div><div class="modal-body"><form action="{{ route('admin.export.results') }}" method="GET"><div class="mb-4"><label class="block text-sm font-semibold mb-1">Report Type</label><select name="type" class="w-full"><option value="courses">Course Performance</option><option value="faculty">Faculty Performance</option><option value="students">Student Performance</option></select></div><div class="mb-4"><label class="block text-sm font-semibold mb-1">Format</label><select name="format" class="w-full"><option value="csv">CSV</option></select></div><div class="modal-foot" style="padding:0; margin-top:1rem;"><button type="button" class="btn-cancel" onclick="closeExportModal()">Cancel</button><button type="submit" class="btn-primary">Export</button></div></form></div></div></div>

<script>
    const d = new Date(); document.getElementById('topbar-date').textContent = d.toLocaleDateString('en-PH', { month: 'short', day: 'numeric', year: 'numeric' });
    function toggleSidebar() { const s = document.getElementById('sidebar'); const o = document.getElementById('sidebarOverlay'); const open = s.classList.toggle('open'); o.style.display = open ? 'block' : 'none'; }
    function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); document.getElementById('sidebarOverlay').style.display = 'none'; }
    function openLogoutModal() { document.getElementById('logoutModal').classList.add('active'); document.body.style.overflow = 'hidden'; }
    function closeLogoutModal() { document.getElementById('logoutModal').classList.remove('active'); document.body.style.overflow = ''; }
    function showExportModal() { document.getElementById('exportModal').classList.add('active'); document.body.style.overflow = 'hidden'; }
    function closeExportModal() { document.getElementById('exportModal').classList.remove('active'); document.body.style.overflow = ''; }
    document.getElementById('exportModal')?.addEventListener('click', e => { if (e.target === e.currentTarget) closeExportModal(); });
    document.getElementById('logoutModal')?.addEventListener('click', e => { if (e.target === e.currentTarget) closeLogoutModal(); });

    // Trend chart (exactly as analytics page)
    const trendCtx = document.getElementById('trendChart').getContext('2d');
    const monthlyData = @json($monthlyTrend);
    new Chart(trendCtx, {
        type: 'line', data: { labels: monthlyData.map(i => i.month), datasets: [
            { label: 'Average Score (%)', data: monthlyData.map(i => i.average_score), borderColor: '#3D5FA0', backgroundColor: 'rgba(61,95,160,0.1)', tension: 0.4, fill: true, yAxisID: 'y' },
            { label: 'Attempts', data: monthlyData.map(i => i.attempts), borderColor: '#C49A00', backgroundColor: 'rgba(196,154,0,0.1)', tension: 0.4, fill: true, yAxisID: 'y1' }
        ] },
        options: { responsive: true, maintainAspectRatio: true, plugins: { legend: { position: 'top' } }, scales: { y: { beginAtZero: true, title: { display: true, text: 'Avg Score (%)' } }, y1: { position: 'right', beginAtZero: true, title: { display: true, text: 'Attempts' }, grid: { drawOnChartArea: false } } } }
    });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') { closeLogoutModal(); closeExportModal(); } });
</script>
</body>
</html>