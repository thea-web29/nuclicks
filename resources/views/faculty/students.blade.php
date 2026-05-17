<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Student Management – NU Horizon LMS</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
            --blue:      #3b82f6;
            --info:      #3b82f6;
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
            content: "";
            flex: 1;
            height: 1px;
            background: var(--bdr);
        }

        /* Filter card */
        .filter-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--bdr);
            border-left: 4px solid var(--gold-d);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            padding: 1.1rem 1.3rem;
            margin-bottom: 1.4rem;
            display: flex;
            flex-wrap: wrap;
            gap: .75rem;
            align-items: center;
        }
        .filter-search-wrap {
            flex: 1;
            min-width: 220px;
            position: relative;
        }
        .filter-search-wrap i {
            position: absolute;
            left: .8rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--txt-3);
            font-size: .9rem;
        }
        .filter-input {
            width: 100%;
            padding: .55rem .9rem .55rem 2.2rem;
            border: 1px solid var(--bdr);
            border-radius: 9px;
            font-size: .8rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--txt-1);
            background: var(--bg);
            transition: border-color var(--t);
        }
        .filter-input:focus { border-color: var(--gold-d); background: var(--white); }
        .filter-select {
            padding: .55rem .9rem;
            border: 1px solid var(--bdr);
            border-radius: 9px;
            font-size: .8rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--txt-2);
            background: var(--bg);
            cursor: pointer;
        }
        .filter-btn {
            padding: .55rem 1.1rem;
            border-radius: 9px;
            border: none;
            background: var(--navy);
            color: #fff;
            font-size: .8rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: .4rem;
            transition: all var(--t);
        }
        .filter-btn:hover { background: var(--navy-mid); }

        /* Table card */
        .table-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            overflow: hidden;
        }
        .table-wrap { overflow-x: auto; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead tr {
            background: var(--bg);
            border-bottom: 1px solid var(--bdr);
        }
        th {
            padding: .75rem 1.2rem;
            text-align: left;
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--txt-3);
            white-space: nowrap;
        }
        td {
            padding: .8rem 1.2rem;
            font-size: .8rem;
            color: var(--txt-2);
            border-bottom: 1px solid var(--bdr);
            vertical-align: middle;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: var(--bg); }

        .student-id-cell {
            font-family: 'Fraunces', serif;
            font-size: .78rem;
            color: var(--navy-lite);
            font-weight: 600;
        }
        .student-name-cell {
            display: flex;
            align-items: center;
            gap: .65rem;
        }
        .student-avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: var(--navy-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .7rem;
            font-weight: 700;
            color: var(--navy-mid);
            flex-shrink: 0;
        }
        .student-name { font-size: .82rem; font-weight: 600; color: var(--txt-1); }
        .student-email { font-size: .7rem; color: var(--txt-3); }

        /* Action buttons */
        .action-group { display: flex; gap: 5px; flex-wrap: nowrap; }
        .action-btn {
            width: 30px; height: 30px;
            border-radius: 7px;
            border: none;
            background: transparent;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all var(--t);
        }
        .action-btn i { font-size: 1rem; }
        .btn-view   { background: rgba(59,130,246,0.10); color: var(--blue); }
        .btn-view:hover { background: var(--blue); color: #fff; }
        .btn-message { background: rgba(22,163,74,0.10); color: var(--green); }
        .btn-message:hover { background: var(--green); color: #fff; }
        .btn-edit   { background: rgba(196,154,0,0.10); color: var(--gold-d); }
        .btn-edit:hover { background: var(--gold); color: var(--navy); }
        .btn-delete { background: rgba(220,38,38,0.10); color: var(--danger); }
        .btn-delete:hover { background: var(--danger); color: #fff; }

        /* Modals (dashboard style) */
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
            overflow: hidden;
            transform: scale(0.94) translateY(12px);
            transition: transform .28s var(--spring);
            box-shadow: 0 40px 80px rgba(0,0,0,0.25);
        }
        .modal-overlay.active .modal { transform: scale(1) translateY(0); }
        .modal-lg { width: min(860px, 96vw); max-height: 90vh; overflow-y: auto; }
        .modal-md { width: min(500px, 94vw); }
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
        .modal-body-left { padding: 1.5rem; text-align: left; }
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
            cursor: pointer;
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
        }
        .modal-form-group { margin-bottom: 1rem; }
        .modal-form-label {
            display: block;
            font-size: .75rem;
            font-weight: 600;
            color: var(--txt-2);
            margin-bottom: .35rem;
        }
        .modal-form-input {
            width: 100%;
            padding: .58rem .9rem;
            border: 1px solid var(--bdr);
            border-radius: 9px;
            font-size: .82rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
        }
        .modal-form-input:focus { border-color: var(--gold-d); background: var(--white); }
        textarea.modal-form-input { resize: vertical; min-height: 90px; }
        .modal-form-row { display: grid; grid-template-columns: 1fr 1fr; gap: .85rem; }
        .view-profile-card {
            background: var(--bg);
            border: 1px solid var(--bdr);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 1.2rem;
        }
        .view-avatar-lg {
            width: 64px; height: 64px;
            border-radius: 50%;
            background: var(--navy-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: var(--navy-mid);
            margin: 0 auto .75rem;
        }
        .view-name { font-family: 'Fraunces', serif; font-size: 1.15rem; font-weight: 700; color: var(--navy); }
        .view-email { font-size: .75rem; color: var(--txt-3); margin-top: .2rem; }
        .view-id { font-size: .7rem; color: var(--txt-3); margin-top: .3rem; }
        .view-course-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .65rem .85rem;
            border: 1px solid var(--bdr);
            border-radius: 9px;
            margin-bottom: .5rem;
        }
        .status-pill {
            font-size: .65rem;
            font-weight: 700;
            padding: .18rem .5rem;
            border-radius: 5px;
            background: rgba(22,163,74,0.10);
            color: var(--green);
        }
        .modal-section-title {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--txt-3);
            margin-bottom: .75rem;
            display: flex;
            align-items: center;
            gap: .4rem;
        }
        .empty-state { text-align: center; padding: 2rem; color: var(--txt-3); }
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
            .topbar { padding: .8rem 1rem; }
            .modal-form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- ══ SIDEBAR (Faculty Portal) ══ -->
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
                <a href="{{ route('faculty.students') }}" class="nav-item active"><i class="ri-user-line"></i> Students</a>
                <a href="{{ route('faculty.courses') }}" class="nav-item"><i class="ri-book-line"></i> Courses</a>
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
            <button onclick="openLogoutModal()" class="logout-btn"><i class="ri-logout-box-line"></i> Sign Out</button>
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
                <div class="topbar-breadcrumb">Faculty → Student Management</div>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-badge"><span class="topbar-dot"></span> System Online</div>
            <div class="topbar-badge"><i class="ri-calendar-line"></i><span id="topbar-date"></span></div>
        </div>
    </header>

    <div class="page-body">
        <div class="section-header">
            <h2><i class="ri-group-line" style="color:var(--gold-d);font-size:.85rem;"></i> My Students</h2>
        </div>

        <!-- Filter Card -->
        <div class="filter-card">
            <div class="filter-search-wrap">
                <i class="ri-search-line"></i>
                <input type="text" id="searchInput" placeholder="Search by name, email, or student ID…" class="filter-input">
            </div>
            <select id="courseFilter" class="filter-select">
                <option value="">All Courses</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->code }} – {{ $course->name }}</option>
                @endforeach
            </select>
            <button onclick="filterStudents()" class="filter-btn"><i class="ri-filter-line"></i> Search</button>
        </div>

        <!-- Students Table -->
        <div class="table-card">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr><th>Student ID</th><th>Name</th><th>Email</th><th>Courses Enrolled</th><th>Actions</th></tr>
                    </thead>
                    <tbody id="studentsTableBody">
                        @forelse($students as $student)
                        <tr class="student-row" data-student-id="{{ $student->id }}" data-student-name="{{ $student->name }}" data-student-email="{{ $student->email }}" data-student-id-number="{{ $student->student_id }}">
                            <td class="student-id-cell">{{ $student->student_id ?? 'N/A' }}</td>
                            <td>
                                <div class="student-name-cell">
                                    <div class="student-avatar">{{ strtoupper(substr($student->name, 0, 2)) }}</div>
                                    <div>
                                        <div class="student-name">{{ $student->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="student-email">{{ $student->email }}</td>
                            <td>
                                @php
                                    $courseList = $student->enrollments->map(function($e) {
                                        return $e->course->code ?? $e->course->name;
                                    })->implode(', ');
                                @endphp
                                {{ $courseList ?: '—' }}
                            </td>
                            <td>
                                <div class="action-group">
                                    <button onclick="viewStudent({{ $student->id }})" class="action-btn btn-view" title="View Student"><i class="ri-eye-line"></i></button>
                                    <button onclick="messageStudent({{ $student->id }})" class="action-btn btn-message" title="Send Message"><i class="ri-mail-send-line"></i></button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="empty-state"><i class="ri-user-line"></i> No students enrolled in your courses yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ══ MODALS ══ -->

<!-- View Student Modal -->
<div id="studentModal" class="modal-overlay">
    <div class="modal modal-lg">
        <div class="modal-head"><h3><i class="ri-user-star-line"></i> Student Details</h3><button class="modal-close" onclick="closeStudentModal()">×</button></div>
        <div class="modal-body-left" id="modalContent">Loading...</div>
    </div>
</div>

<!-- Message Modal -->
<div id="messageModal" class="modal-overlay">
    <div class="modal modal-md">
        <div class="modal-head"><h3><i class="ri-mail-send-line"></i> Send Message</h3><button class="modal-close" onclick="closeMessageModal()">×</button></div>
        <div class="modal-body-left">
            <form id="messageForm">
                <input type="hidden" id="messageStudentId" name="student_id">
                <div class="modal-form-group"><label class="modal-form-label">Subject</label><input type="text" name="subject" required class="modal-form-input" placeholder="Enter subject…"></div>
                <div class="modal-form-group"><label class="modal-form-label">Message</label><textarea name="message" rows="4" required class="modal-form-input" placeholder="Write your message…"></textarea></div>
                <div class="modal-foot" style="padding:1rem 0 0;background:transparent;border:none;"><button type="button" onclick="closeMessageModal()" class="btn-cancel">Cancel</button><button type="submit" class="btn-confirm" style="background:var(--navy);"><i class="ri-send-plane-line"></i> Send Message</button></div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal-overlay">
    <div class="modal modal-md">
        <div class="modal-head"><h3><i class="ri-delete-bin-line"></i> Confirm Delete</h3><button class="modal-close" onclick="closeDeleteModal()">×</button></div>
        <div class="modal-body-left"><p>Are you sure you want to delete this student? This action cannot be undone.</p></div>
        <div class="modal-foot"><button class="btn-cancel" onclick="closeDeleteModal()">Cancel</button><button class="btn-confirm" id="confirmDeleteBtn" style="background:var(--danger);">Yes, Delete</button></div>
    </div>
</div>

<!-- Logout Modal -->
<div class="modal-overlay" id="logoutModal">
    <div class="modal modal-md">
        <div class="modal-head"><h3><i class="ri-logout-box-r-line"></i> Confirm Sign Out</h3><button class="modal-close" onclick="closeLogoutModal()">×</button></div>
        <div class="modal-body-left"><p>Are you sure you want to sign out of your account?</p><p class="modal-warn">You will be redirected to the login page.</p></div>
        <div class="modal-foot"><button class="btn-cancel" onclick="closeLogoutModal()">Cancel</button><button class="btn-confirm" id="confirmLogoutBtn">Yes, Sign Out</button></div>
    </div>
</div>

<script>
    // Date
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

    // Filter students (client-side)
    function filterStudents() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const courseFilter = document.getElementById('courseFilter').value;
        const rows = document.querySelectorAll('#studentsTableBody .student-row');
        rows.forEach(row => {
            const name = row.getAttribute('data-student-name')?.toLowerCase() || '';
            const email = row.getAttribute('data-student-email')?.toLowerCase() || '';
            const id = row.getAttribute('data-student-id-number')?.toLowerCase() || '';
            const coursesCell = row.querySelector('td:nth-child(4)')?.textContent.toLowerCase() || '';
            const matchesSearch = name.includes(search) || email.includes(search) || id.includes(search);
            const matchesCourse = !courseFilter || coursesCell.includes(courseFilter);
            row.style.display = (matchesSearch && matchesCourse) ? '' : 'none';
        });
    }
    document.getElementById('searchInput').addEventListener('keypress', e => { if (e.key === 'Enter') filterStudents(); });

    // View student details (AJAX)
    function viewStudent(id) {
        fetch(`/faculty/students/${id}/details`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                const s = data.student;
                const coursesHtml = s.courses.map(c => `
                    <div class="view-course-item">
                        <div><div class="view-course-name">${escapeHtml(c.code)} – ${escapeHtml(c.name)}</div><div class="view-grade">Grade: ${c.grade ?? 'N/A'}</div></div>
                        <span class="status-pill">Enrolled</span>
                    </div>
                `).join('');
                document.getElementById('modalContent').innerHTML = `
                    <div class="view-profile-card">
                        <div class="view-avatar-lg"><i class="ri-user-line"></i></div>
                        <div class="view-name">${escapeHtml(s.name)}</div>
                        <div class="view-email">${escapeHtml(s.email)}</div>
                        <div class="view-id">Student ID: ${escapeHtml(s.student_id ?? 'N/A')}</div>
                    </div>
                    <div class="modal-section-title"><i class="ri-book-line"></i> Enrolled Courses</div>
                    ${coursesHtml || '<p class="empty-state">No courses enrolled.</p>'}
                `;
            } else {
                document.getElementById('modalContent').innerHTML = '<div class="empty-state">Failed to load student details.</div>';
            }
            document.getElementById('studentModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        })
        .catch(() => {
            document.getElementById('modalContent').innerHTML = '<div class="empty-state">Error loading student data.</div>';
            document.getElementById('studentModal').classList.add('active');
        });
    }
    function closeStudentModal() {
        document.getElementById('studentModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    // Message student
    function messageStudent(id) {
        document.getElementById('messageStudentId').value = id;
        document.getElementById('messageModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeMessageModal() {
        document.getElementById('messageModal').classList.remove('active');
        document.body.style.overflow = '';
        document.getElementById('messageForm').reset();
    }

    // Submit message via AJAX
    document.getElementById('messageForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append('_token', '{{ csrf_token() }}');
        const btn = this.querySelector('button[type="submit"]');
        const original = btn.innerHTML;
        btn.innerHTML = '<i class="ri-loader-4-line animate-spin"></i> Sending...';
        btn.disabled = true;
        fetch('{{ route('faculty.students.message') }}', {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                alert(data.message || 'Message sent successfully!');
                closeMessageModal();
            } else {
                alert(data.message || 'Error sending message');
            }
        })
        .catch(err => alert('Network error: ' + err.message))
        .finally(() => { btn.innerHTML = original; btn.disabled = false; });
    });

    // Delete student (with confirmation)
    let deleteId = null;
    function deleteStudent(id) {
        deleteId = id;
        document.getElementById('deleteModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('active');
        document.body.style.overflow = '';
        deleteId = null;
    }
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (!deleteId) return;
        fetch(`/faculty/students/${deleteId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                const row = document.querySelector(`.student-row[data-student-id="${deleteId}"]`);
                if (row) row.remove();
                alert('Student deleted successfully!');
            } else {
                alert(data.message || 'Error deleting student');
            }
            closeDeleteModal();
        })
        .catch(err => { alert('Error: ' + err.message); closeDeleteModal(); });
    });

    // Logout modal
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    document.getElementById('confirmLogoutBtn').addEventListener('click', () => {
        document.getElementById('logoutForm')?.submit() || (window.location = '{{ route('logout') }}');
    });
    // Add logout form if not present (fallback)
    if (!document.getElementById('logoutForm')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('logout') }}';
        form.innerHTML = '@csrf';
        form.id = 'logoutForm';
        form.style.display = 'none';
        document.body.appendChild(form);
    }
    document.getElementById('logoutModal').addEventListener('click', e => { if (e.target === e.currentTarget) closeLogoutModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLogoutModal(); });

    // Close modals when clicking overlay
    ['studentModal', 'messageModal', 'deleteModal'].forEach(id => {
        document.getElementById(id)?.addEventListener('click', e => { if (e.target === e.currentTarget) { e.currentTarget.classList.remove('active'); document.body.style.overflow = ''; } });
    });

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }
</script>
</body>
</html>