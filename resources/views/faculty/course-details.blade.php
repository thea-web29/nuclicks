<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->name }} – Course Management | NU Horizon LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        /* ══ DESIGN TOKENS (identical to dashboard) ══ */
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
            -webkit-tap-highlight-color: transparent;
        }

        *:focus { outline: none !important; }

        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(10,31,68,0.15); border-radius: 99px; }

        /* ══ SIDEBAR (identical to faculty dashboard) ══ */
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

        /* Logo */
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

        /* Nav */
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

        /* Sidebar footer */
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

        /* Section header */
        .section-header { margin-bottom: 1.4rem; }
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
            content: ""; flex: 1; height: 1px;
            background: var(--bdr);
        }

        /* Stats cards – smaller, simpler fonts */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .stat-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            padding: 1rem 1.2rem;
            transition: all var(--t);
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--navy-lite), var(--navy));
        }
        .stat-card .stat-label {
            font-size: 0.65rem;      /* smaller */
            color: var(--txt-3);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.25rem;
        }
        .stat-card .stat-value {
            font-family: 'Plus Jakarta Sans', sans-serif;  /* simpler, not Fraunces */
            font-weight: 600;
            font-size: 1rem;          /* much smaller than before (was 1.6rem) */
            color: var(--navy);
            margin-bottom: 0.2rem;
        }
        .stat-card .stat-sub {
            font-size: 0.65rem;
            color: var(--txt-3);
        }

        /* Join code card – simpler, smaller */
        .join-code-card {
            background: linear-gradient(135deg, var(--gold-pale) 0%, var(--white) 100%);
            border: 1px solid var(--bdr);
            border-radius: 14px;
            padding: 1rem 1.2rem;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .join-code {
            font-family: 'Plus Jakarta Sans', sans-serif;  /* simpler */
            font-weight: 700;
            font-size: 1.1rem;        /* smaller (was 1.8rem) */
            color: var(--navy);
            letter-spacing: 0.05em;
        }
        .code-label {
            font-size: 0.65rem;
            color: var(--txt-3);
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 0.2rem;
        }
        .class-access-text {
            font-size: 0.75rem;       /* smaller, simpler */
            color: var(--txt-2);
        }

        /* Action buttons (unchanged) */
        .btn-primary {
            background: var(--navy);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            cursor: pointer;
            transition: all var(--t);
            text-decoration: none;
        }
        .btn-primary:hover { background: var(--navy-mid); transform: translateY(-1px); }
        .btn-secondary {
            background: transparent;
            border: 1px solid var(--bdr);
            color: var(--txt-2);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            cursor: pointer;
            transition: all var(--t);
            text-decoration: none;
        }
        .btn-secondary:hover { background: var(--bg); border-color: var(--gold-d); }
        .btn-success {
            background: var(--green);
            color: white;
            border: none;
        }
        .btn-success:hover { background: #15803d; }

        /* Tabs, tables, modals remain same as before */
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

        .table-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            overflow: hidden;
        }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: var(--bg); border-bottom: 1px solid var(--bdr); }
        th {
            padding: 0.75rem 1rem;
            text-align: left;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--txt-3);
        }
        td {
            padding: 0.8rem 1rem;
            font-size: 0.8rem;
            color: var(--txt-2);
            border-bottom: 1px solid var(--bdr);
            vertical-align: middle;
        }
        tbody tr:hover td { background: var(--gold-pale); }
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.2rem 0.6rem;
            border-radius: 99px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        .status-added { background: rgba(22,163,74,0.12); color: var(--green); }
        .status-pending { background: rgba(245,158,11,0.12); color: var(--orange); }

        .list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border: 1px solid var(--bdr);
            border-radius: 12px;
            margin-bottom: 0.6rem;
            transition: all var(--t);
        }
        .list-item:hover { background: var(--bg); border-color: rgba(10,31,68,0.15); }
        .list-item-title { font-weight: 700; font-size: 0.85rem; color: var(--txt-1); }
        .list-item-sub { font-size: 0.7rem; color: var(--txt-3); margin-top: 0.2rem; }
        .list-item-actions { display: flex; gap: 0.5rem; }

        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(10,31,68,0.72);
            backdrop-filter: blur(6px);
            z-index: 500;
            display: flex; align-items: center; justify-content: center;
            visibility: hidden; opacity: 0;
            transition: all .22s var(--ease);
        }
        .modal-overlay.active { visibility: visible; opacity: 1; }
        .modal {
            background: var(--white);
            border-radius: 18px;
            width: min(500px, 94vw);
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
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .modal-close {
            background: none; border: none;
            color: rgba(255,255,255,0.55);
            font-size: 1.3rem;
            cursor: pointer;
        }
        .modal-body { padding: 1.5rem; }
        .modal-foot {
            padding: .9rem 1.4rem 1.3rem;
            display: flex; gap: .6rem;
            justify-content: flex-end;
            background: var(--bg);
            border-top: 1px solid var(--bdr);
        }
        .form-group { margin-bottom: 1rem; }
        .form-label {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--txt-3);
            margin-bottom: 0.4rem;
        }
        .form-input {
            width: 100%;
            padding: 0.6rem 0.9rem;
            border: 1px solid var(--bdr);
            border-radius: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.8rem;
            background: var(--white);
        }
        .form-input:focus { border-color: var(--gold-d); outline: none; }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--txt-3);
        }
        .empty-state i { font-size: 2rem; opacity: 0.3; margin-bottom: 0.5rem; display: block; }

        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(10,31,68,0.65);
            z-index: 90;
        }
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay { display: block; }
            .main-content { margin-left: 0; }
            .menu-toggle { display: flex; }
            .stats-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            .page-body { padding: 1rem; }
            .topbar { padding: .8rem 1rem; }
            .join-code-card { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- ══ SIDEBAR (identical to faculty dashboard) ══ -->
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
                <p>Faculty Portal · National University</p>
            </div>
        </div>
        <div class="nav-body">
            <div>
                <div class="nav-section-label">Main</div>
                <a href="{{ route('faculty.dashboard') }}" class="nav-item"><i class="ri-dashboard-line"></i> Dashboard</a>
                <a href="{{ route('faculty.students') }}" class="nav-item"><i class="ri-user-line"></i> Students</a>
                <a href="{{ route('faculty.courses') }}" class="nav-item active"><i class="ri-book-line"></i> Courses</a>
                <a href="{{ route('faculty.folder-files') }}" class="nav-item"><i class="ri-folder-3-line"></i> Files & Folders</a>
            </div>
            <div>
                <div class="nav-section-label">Quiz Management</div>
                <a href="{{ route('faculty.quiz.create') }}" class="nav-item"><i class="ri-add-circle-line"></i> Create Quiz</a>
                <a href="{{ route('faculty.quizzes.list') }}" class="nav-item"><i class="ri-list-check"></i> All Quizzes</a>
                <a href="{{ route('faculty.question.bank') }}" class="nav-item"><i class="ri-database-2-line"></i> Question Bank</a>
                <a href="{{ route('faculty.grading') }}" class="nav-item"><i class="ri-graduation-cap-line"></i> Grading</a>
            </div>
            <div>
                <div class="nav-section-label">Analytics</div>
                <a href="{{ route('faculty.results.index') }}" class="nav-item"><i class="ri-bar-chart-line"></i> Results & Analytics</a>
                <a href="{{ route('faculty.my-evaluation') }}" class="nav-item"><i class="ri-star-smile-line"></i> My Evaluation</a>
            </div>
        </div>
        <div class="sidebar-footer">
            <div class="profile-row" onclick="window.location='{{ route('faculty.profile') }}'">
                <div class="avatar"><i class="ri-user-line"></i></div>
                <div>
                    <div class="profile-name">{{ Auth::user()->name }}</div>
                    <div class="profile-email">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                @csrf
                <button type="button" id="logoutButton" class="logout-btn"><i class="ri-logout-box-line"></i> Sign Out</button>
            </form>
        </div>
    </div>
</aside>

<!-- ══ MAIN CONTENT ══ -->
<div class="main-content">
    <header class="topbar">
        <div class="topbar-left">
            <button class="menu-toggle" id="menuToggle" onclick="toggleSidebar()"><i class="ri-menu-2-line"></i></button>
            <div>
                <div class="topbar-title">NU Horizon <em>LMS</em></div>
                <div class="topbar-breadcrumb">Faculty → Courses → {{ $course->code }}</div>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-badge"><span class="topbar-dot"></span> System Online</div>
            <div class="topbar-badge"><i class="ri-calendar-line"></i><span id="topbar-date"></span></div>
            <a href="{{ route('faculty.announcements', $course->id) }}" class="btn-primary" style="background: var(--purple);"><i class="ri-megaphone-line"></i> Announcements</a>
        </div>
    </header>

    <div class="page-body">
        @if(session('success'))
            <div class="alert alert-success" style="background: rgba(22,163,74,0.08); border-left: 3px solid var(--green); padding: 0.8rem 1rem; border-radius: 10px; margin-bottom: 1.5rem;">
                <i class="ri-checkbox-circle-line"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error" style="background: rgba(220,38,38,0.08); border-left: 3px solid var(--danger); padding: 0.8rem 1rem; border-radius: 10px; margin-bottom: 1.5rem;">
                <i class="ri-error-warning-line"></i> {{ session('error') }}
            </div>
        @endif

        <!-- Stats cards – smaller, simpler -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Course</div>
                <div class="stat-value">{{ $course->code }} – {{ $course->name }}</div>
                <div class="stat-sub">Section: {{ $course->section ?? 'N/A' }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Current Join Code</div>
                <div class="stat-value">{{ $course->join_code ?? 'NONE' }}</div>
                <div class="stat-sub">Students use this code to join</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Class Summary</div>
                <div class="stat-value">{{ $course->students->count() }} enrolled</div>
                <div class="stat-sub">{{ ($eligibleStudents ?? collect())->count() }} eligible</div>
            </div>
        </div>

        <!-- Action cards: Add students & Generate code – simpler text -->
        <div class="join-code-card">
            <div>
                <div class="code-label"><i class="ri-user-add-line"></i> Class Access</div>
                <div class="join-code">Manage student enrollment</div>
                <div class="class-access-text">Add eligible students or generate a new join code.</div>
            </div>
            <div style="display: flex; gap: 0.6rem;">
                <form action="{{ route('faculty.course.add-eligible-students', $course->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-primary btn-success" onclick="return confirm('Add all eligible students from this course and section?')">
                        <i class="ri-user-add-line"></i> Add Students
                    </button>
                </form>
                <form action="{{ route('faculty.course.generate-code', $course->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn-primary" onclick="return confirm('Generate join code and email students?')">
                        <i class="ri-mail-send-line"></i> Generate & Email
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs-container">
            <button class="tab-btn active-tab" onclick="switchTab('eligible')"><i class="ri-user-search-line"></i> Eligible Students</button>
            <button class="tab-btn" onclick="switchTab('students')"><i class="ri-group-line"></i> Enrolled Students</button>
            <button class="tab-btn" onclick="switchTab('materials')"><i class="ri-file-copy-line"></i> Materials</button>
            <button class="tab-btn" onclick="switchTab('quizzes')"><i class="ri-quiz-line"></i> Quizzes</button>
        </div>

        <!-- Eligible Students Tab -->
        <div id="eligible" class="tab-content">
            <div class="table-card">
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr><th>Student</th><th>Student ID</th><th>Email</th><th>Section</th><th>Status</th></tr>
                        </thead>
                        <tbody>
                            @forelse($eligibleStudents ?? [] as $student)
                                @php $isEnrolled = $course->students->contains('id', $student->id); @endphp
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->student_id ?? 'N/A' }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->section ?? 'N/A' }}</td>
                                    <td>
                                        @if($isEnrolled)
                                            <span class="status-badge status-added"><i class="ri-check-line"></i> Already Added</span>
                                        @else
                                            <span class="status-badge status-pending"><i class="ri-time-line"></i> Not Yet Added</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="empty-state"><i class="ri-user-search-line"></i> No eligible students found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Enrolled Students Tab -->
        <div id="students" class="tab-content hidden">
            <div class="table-card">
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr><th>Student</th><th>Student ID</th><th>Email</th><th>Enrolled Date</th><th>Action</th></tr>
                        </thead>
                        <tbody>
                            @forelse($course->students as $student)
                                @php $enrollment = $student->enrollments->firstWhere('course_id', $course->id); @endphp
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->student_id ?? 'N/A' }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $enrollment ? $enrollment->created_at->format('M d, Y') : 'N/A' }}</td>
                                    <td>
                                        @if($enrollment)
                                            <form action="{{ route('faculty.student.remove', $enrollment->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-secondary" style="padding: 0.2rem 0.6rem; color: var(--danger);" onclick="return confirm('Remove student from this class?')">
                                                    <i class="ri-user-unfollow-line"></i> Remove
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400">No record</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="empty-state"><i class="ri-user-line"></i> No students enrolled yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Materials Tab -->
        <div id="materials" class="tab-content hidden">
            <div style="margin-bottom: 1rem; text-align: right;">
                <button onclick="openUploadModal()" class="btn-primary"><i class="ri-upload-line"></i> Upload Material</button>
            </div>
            <div>
                @if($course->materials->count() > 0)
                    @foreach($course->materials as $material)
                        <div class="list-item">
                            <div>
                                <div class="list-item-title">{{ $material->title }}</div>
                                <div class="list-item-sub">{{ $material->description ?? 'No description' }} • Uploaded {{ $material->created_at->format('M d, Y') }}</div>
                            </div>
                            <div class="list-item-actions">
                                <a href="{{ route('faculty.material.download', $material->id) }}" class="btn-secondary" style="padding: 0.3rem 0.7rem;"><i class="ri-download-line"></i></a>
                                <form action="{{ route('faculty.material.delete', $material->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-secondary" style="color: var(--danger); padding: 0.3rem 0.7rem;" onclick="return confirm('Delete this material?')"><i class="ri-delete-bin-line"></i></button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state"><i class="ri-file-line"></i> No materials uploaded yet.</div>
                @endif
            </div>
        </div>

        <!-- Quizzes Tab -->
        <div id="quizzes" class="tab-content hidden">
            <div style="margin-bottom: 1rem; text-align: right;">
                <a href="{{ route('faculty.create.quiz', $course->id) }}" class="btn-primary"><i class="ri-add-line"></i> Create Quiz</a>
            </div>
            <div>
                @if($course->quizzes->count() > 0)
                    @foreach($course->quizzes as $quiz)
                        <div class="list-item">
                            <div>
                                <div class="list-item-title">{{ $quiz->title }}</div>
                                <div class="list-item-sub">{{ $quiz->description ?? 'No description' }} • {{ $quiz->questions->count() }} questions • {{ $quiz->total_points }} points</div>
                            </div>
                            <div class="list-item-actions">
                                <a href="{{ route('faculty.edit.quiz', $quiz->id) }}" class="btn-secondary" style="padding: 0.3rem 0.7rem;"><i class="ri-edit-line"></i></a>
                                <a href="{{ route('faculty.submissions', $quiz->id) }}" class="btn-secondary" style="padding: 0.3rem 0.7rem;"><i class="ri-bar-chart-line"></i></a>
                                <form action="{{ route('faculty.delete.quiz', $quiz->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-secondary" style="color: var(--danger); padding: 0.3rem 0.7rem;" onclick="return confirm('Delete this quiz?')"><i class="ri-delete-bin-line"></i></button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state"><i class="ri-quiz-line"></i> No quizzes created yet.</div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Upload Material Modal -->
<div id="uploadModal" class="modal-overlay">
    <div class="modal">
        <div class="modal-head">
            <h3><i class="ri-upload-line"></i> Upload Course Material</h3>
            <button class="modal-close" onclick="closeUploadModal()">&times;</button>
        </div>
        <form action="{{ route('faculty.upload.material', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Title <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="3" class="form-input"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">File <span style="color:var(--danger)">*</span></label>
                    <input type="file" name="file" class="form-input" required>
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn-cancel" onclick="closeUploadModal()">Cancel</button>
                <button type="submit" class="btn-primary"><i class="ri-upload-line"></i> Upload</button>
            </div>
        </form>
    </div>
</div>

<!-- Logout Modal -->
<div class="modal-overlay" id="logoutModal">
    <div class="modal" style="max-width: 400px;">
        <div class="modal-head"><h3><i class="ri-logout-box-r-line"></i> Confirm Sign Out</h3><button class="modal-close" onclick="closeLogoutModal()">×</button></div>
        <div class="modal-body"><p>Are you sure you want to sign out of your account?</p><p class="modal-warn">You will be redirected to the login page.</p></div>
        <div class="modal-foot"><button class="btn-cancel" onclick="closeLogoutModal()">Cancel</button><button class="btn-confirm" id="confirmLogoutBtn">Yes, Sign Out</button></div>
    </div>
</div>

<script>
    // Topbar date
    document.getElementById('topbar-date').textContent = new Date().toLocaleDateString('en-PH', { month: 'short', day: 'numeric', year: 'numeric' });

    // Sidebar toggle
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

    // Tab switching
    function switchTab(tabId) {
        const contents = ['eligible', 'students', 'materials', 'quizzes'];
        contents.forEach(id => {
            const el = document.getElementById(id);
            if (el) el.classList.add('hidden');
        });
        document.getElementById(tabId).classList.remove('hidden');
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active-tab');
            if (btn.textContent.toLowerCase().includes(tabId) || 
                (tabId === 'eligible' && btn.textContent.includes('Eligible')) ||
                (tabId === 'students' && btn.textContent.includes('Enrolled')) ||
                (tabId === 'materials' && btn.textContent.includes('Materials')) ||
                (tabId === 'quizzes' && btn.textContent.includes('Quizzes'))) {
                btn.classList.add('active-tab');
            }
        });
    }

    // Upload modal
    function openUploadModal() {
        document.getElementById('uploadModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeUploadModal() {
        document.getElementById('uploadModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    // Logout modal
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    document.getElementById('logoutButton')?.addEventListener('click', (e) => {
        e.preventDefault();
        openLogoutModal();
    });
    document.getElementById('confirmLogoutBtn')?.addEventListener('click', () => {
        document.getElementById('logoutForm').submit();
    });
    document.getElementById('logoutModal')?.addEventListener('click', (e) => {
        if (e.target === e.currentTarget) closeLogoutModal();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') { closeUploadModal(); closeLogoutModal(); }
    });
</script>
</body>
</html>