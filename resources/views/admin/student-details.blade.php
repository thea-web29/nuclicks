<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Student Details – {{ $student->name }} | NU Horizon LMS</title>
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

        /* page body */
        .page-body { padding: 1.8rem 2rem; flex: 1; }
        .two-col-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 1.5rem;
        }
        @media (max-width: 1024px) { .two-col-grid { grid-template-columns: 1fr; } }

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

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 0.6rem 0;
            border-bottom: 1px solid var(--bdr);
        }
        .info-row:last-child { border-bottom: none; }
        .info-label {
            font-size: 0.75rem;
            color: var(--txt-3);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .info-value {
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--txt-1);
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.2rem 0.7rem;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 700;
        }
        .status-active {
            background: rgba(22,163,74,0.12);
            color: var(--green);
            border: 1px solid rgba(34,197,94,0.2);
        }
        .status-inactive {
            background: rgba(220,38,38,0.08);
            color: var(--danger);
            border: 1px solid rgba(220,38,38,0.2);
        }
        .list-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.8rem 0;
            border-bottom: 1px solid var(--bdr);
        }
        .list-item:last-child { border-bottom: none; }
        .list-item-title {
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--txt-1);
        }
        .list-item-sub {
            font-size: 0.7rem;
            color: var(--txt-3);
            margin-top: 2px;
        }
        .score-pill {
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.2rem 0.65rem;
            border-radius: 6px;
        }
        .score-pass { background: rgba(22,163,74,0.1); color: var(--green); }
        .score-fail { background: rgba(220,38,38,0.1); color: var(--danger); }

        /* modals */
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
        .modal-body { padding: 1.5rem; text-align: center; }
        .modal-foot {
            padding: .9rem 1.4rem 1.3rem;
            display: flex;
            gap: .6rem;
            justify-content: flex-end;
            background: var(--bg);
            border-top: 1px solid var(--bdr);
        }
        .btn-cancel, .btn-confirm {
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
                <div class="topbar-breadcrumb">Admin → Users → Student Details</div>
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
            <a href="{{ route('admin.users') }}" class="back-btn">
                <i class="ri-arrow-left-line"></i> Back to Users
            </a>
        </div>
    </header>

    <div class="page-body">
        <div class="two-col-grid">
            <!-- Left Column: Profile Card -->
            <div>
                <div class="dash-card">
                    <div class="dash-card-head">
                        <div class="dash-card-title"><i class="ri-user-line"></i> Student Profile</div>
                    </div>
                    <div class="dash-card-body" style="text-align: center;">
                        <div class="avatar" style="width: 80px; height: 80px; margin: 0 auto 1rem; font-size: 2rem;">
                            <i class="ri-user-line"></i>
                        </div>
                        <h2 style="font-family: 'Fraunces', serif; font-size: 1.3rem; margin-bottom: 0.25rem;">{{ $student->name }}</h2>
                        <p style="color: var(--txt-3); font-size: 0.8rem;">{{ $student->email }}</p>
                        <p style="font-size: 0.7rem; font-family: monospace; background: var(--navy-pale); display: inline-block; padding: 0.2rem 0.8rem; border-radius: 40px; margin-top: 0.5rem;">
                            Student ID: {{ $student->student_id ?? 'N/A' }}
                        </p>
                        <div style="margin-top: 1rem;">
                            @if($student->status === 'active')
                                <span class="status-badge status-active">Active</span>
                            @else
                                <span class="status-badge status-inactive">Inactive</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="dash-card">
                    <div class="dash-card-head">
                        <div class="dash-card-title"><i class="ri-information-line"></i> Academic Info</div>
                    </div>
                    <div class="dash-card-body">
                        <div class="info-row">
                            <span class="info-label"><i class="ri-building-2-line"></i> Department</span>
                            <span class="info-value">{{ $student->department_id ? ($student->departmentRel->name ?? '—') : ($student->department ?? 'N/A') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="ri-calendar-line"></i> Year Level</span>
                            <span class="info-value">{{ $student->year_level ? $student->year_level . ' Year' : 'N/A' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="ri-bar-chart-line"></i> Average Quiz Score</span>
                            <span class="info-value" style="color: {{ $averageScore >= 70 ? 'var(--green)' : 'var(--danger)' }};">{{ $averageScore }}%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Enrolled Courses & Quiz Attempts -->
            <div>
                <!-- Enrolled Courses -->
                <div class="dash-card">
                    <div class="dash-card-head">
                        <div class="dash-card-title"><i class="ri-book-open-line"></i> Enrolled Courses</div>
                        <span class="status-badge" style="background: var(--navy-pale);">Total: {{ $enrolledCourses->count() }}</span>
                    </div>
                    <div class="dash-card-body">
                        @if($enrolledCourses->count() > 0)
                            @foreach($enrolledCourses as $enrollment)
                                <div class="list-item">
                                    <div>
                                        <div class="list-item-title">{{ $enrollment->course->code }} – {{ $enrollment->course->name }}</div>
                                        <div class="list-item-sub">Enrolled: {{ $enrollment->created_at->format('M d, Y') }}</div>
                                    </div>
                                    <span class="status-badge" style="background: rgba(22,163,74,0.1); color: var(--green);">Enrolled</span>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center" style="color: var(--txt-3); padding: 1rem;">No courses enrolled.</p>
                        @endif
                    </div>
                </div>

                <!-- Quiz Attempts -->
                <div class="dash-card">
                    <div class="dash-card-head">
                        <div class="dash-card-title"><i class="ri-list-check"></i> Quiz Attempts</div>
                        <span class="status-badge" style="background: var(--navy-pale);">Total: {{ $quizAttempts->count() }}</span>
                    </div>
                    <div class="dash-card-body">
                        @if($quizAttempts->count() > 0)
                            @foreach($quizAttempts as $attempt)
                                @php
                                    $pct = $attempt->quiz->total_points > 0 ? ($attempt->score / $attempt->quiz->total_points) : 0;
                                    $pass = $pct >= 0.6;
                                @endphp
                                <div class="list-item">
                                    <div>
                                        <div class="list-item-title">{{ $attempt->quiz->title }}</div>
                                        <div class="list-item-sub">{{ $attempt->quiz->course->name }} · {{ $attempt->completed_at->format('M d, Y') }}</div>
                                    </div>
                                    <div class="score-pill {{ $pass ? 'score-pass' : 'score-fail' }}">
                                        {{ $attempt->score }}/{{ $attempt->quiz->total_points }}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center" style="color: var(--txt-3); padding: 1rem;">No quiz attempts yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- LOGOUT MODAL -->
<div class="modal-overlay" id="logoutModal">
    <div class="modal">
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
                <button type="submit" class="btn-confirm">Yes, Sign Out</button>
            </form>
        </div>
    </div>
</div>

<script>
    // date
    document.getElementById('topbar-date').textContent = new Date().toLocaleDateString('en-PH', { month: 'short', day: 'numeric', year: 'numeric' });

    // sidebar toggle
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const open = sidebar.classList.toggle('open');
        overlay.style.display = open ? 'block' : 'none';
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').style.display = 'none';
    }

    // logout modal
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    document.getElementById('logoutModal').addEventListener('click', e => {
        if (e.target === e.currentTarget) closeLogoutModal();
    });
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeLogoutModal();
    });
</script>
</body>
</html>
