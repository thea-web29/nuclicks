<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements – {{ $course->name }} | NU Horizon LMS</title>
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

        /* Cards */
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
            gap: 0.6rem;
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

        /* Announcement item */
        .announcement-item {
            padding: 1.2rem 1.3rem;
            border-bottom: 1px solid var(--bdr);
            transition: background var(--t);
        }
        .announcement-item:last-child { border-bottom: none; }
        .announcement-item:hover { background: var(--bg); }
        .announcement-meta {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            margin-bottom: 0.6rem;
            flex-wrap: wrap;
        }
        .date-badge {
            background: var(--navy-pale);
            color: var(--navy-mid);
            padding: 0.2rem 0.6rem;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        .poster-info {
            font-size: 0.7rem;
            color: var(--txt-3);
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        .announcement-title {
            font-family: 'Fraunces', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 0.5rem;
        }
        .announcement-content {
            font-size: 0.8rem;
            color: var(--txt-2);
            line-height: 1.5;
            margin-bottom: 0.8rem;
        }
        .announcement-actions {
            display: flex;
            gap: 0.6rem;
        }
        .action-link {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.3rem 0.7rem;
            border-radius: 6px;
            text-decoration: none;
            transition: all var(--t);
        }
        .action-link.edit {
            background: rgba(196,154,0,0.10);
            color: var(--gold-d);
        }
        .action-link.edit:hover {
            background: var(--gold);
            color: var(--navy);
        }
        .action-link.delete {
            background: rgba(220,38,38,0.08);
            color: var(--danger);
        }
        .action-link.delete:hover {
            background: var(--danger);
            color: #fff;
        }

        /* Form elements */
        .form-group { margin-bottom: 1.2rem; }
        .form-label {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--txt-3);
            display: block;
            margin-bottom: 0.4rem;
        }
        .form-input, .form-textarea {
            width: 100%;
            padding: 0.65rem 1rem;
            border-radius: 10px;
            border: 1px solid var(--bdr);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.8rem;
            color: var(--txt-1);
            background: var(--white);
            transition: var(--t);
        }
        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--gold-d);
            box-shadow: 0 0 0 3px rgba(196,154,0,0.1);
        }
        .btn-primary {
            background: var(--navy);
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.75rem;
            color: white;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: var(--t);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-primary:hover { background: var(--navy-mid); transform: translateY(-1px); }
        .btn-secondary {
            background: transparent;
            border: 1px solid var(--bdr);
            padding: 0.6rem 1.2rem;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.75rem;
            color: var(--txt-2);
            cursor: pointer;
            transition: var(--t);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }
        .btn-secondary:hover { background: var(--white); border-color: var(--gold-d); }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--txt-3);
        }
        .empty-state i { font-size: 3rem; opacity: 0.3; display: block; margin-bottom: 1rem; }
        .empty-state p { font-size: 0.85rem; }

        /* Alert */
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

        /* Logout modal (same as dashboard) */
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
            display: flex; align-items: center; justify-content: space-between;
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
        .modal-body { padding: 1.5rem; text-align: center; }
        .modal-warn { font-size: .72rem; color: var(--txt-3); margin-top: .5rem; }
        .modal-foot {
            padding: .9rem 1.4rem 1.3rem;
            display: flex; gap: .6rem;
            justify-content: flex-end;
            background: var(--bg);
            border-top: 1px solid var(--bdr);
        }
        .btn-cancel {
            padding: .58rem 1.1rem; border-radius: 8px;
            border: 1px solid var(--bdr); background: var(--white);
            font-size: .8rem; font-weight: 600; color: var(--txt-2);
            cursor: pointer;
        }
        .btn-confirm {
            padding: .58rem 1.2rem; border-radius: 8px; border: none;
            background: var(--danger); font-size: .8rem; font-weight: 700; color: #fff;
            cursor: pointer;
        }
        .btn-confirm:hover { background: var(--danger-d); transform: translateY(-1px); }

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
        }
        @media (max-width: 640px) {
            .page-body { padding: 1rem; }
            .topbar { padding: .8rem 1rem; }
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
                <div class="topbar-breadcrumb">Faculty → Courses → {{ $course->code }} → Announcements</div>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-badge"><span class="topbar-dot"></span> System Online</div>
            <div class="topbar-badge"><i class="ri-calendar-line"></i><span id="topbar-date"></span></div>
            <a href="{{ route('faculty.course.details', $course->id) }}" class="btn-secondary"><i class="ri-arrow-left-line"></i> Back to Course</a>
        </div>
    </header>

    <div class="page-body">
        <div class="section-header">
            <h2><i class="ri-megaphone-line" style="color:var(--gold-d);font-size:.85rem;"></i> Course Announcements</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="ri-checkbox-circle-line"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Create Announcement Form -->
        <div class="dash-card">
            <div class="dash-card-head">
                <div class="dash-card-title"><i class="ri-megaphone-line"></i> Post New Announcement</div>
            </div>
            <div class="dash-card-body">
                <form action="{{ route('faculty.announcement.store', $course->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Title <span style="color:var(--danger)">*</span></label>
                        <input type="text" name="title" required class="form-input" placeholder="e.g., Important Update on Midterm Exam">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Content <span style="color:var(--danger)">*</span></label>
                        <textarea name="content" rows="4" required class="form-textarea" placeholder="Write your announcement here..."></textarea>
                    </div>
                    <div style="display: flex; justify-content: flex-end;">
                        <button type="submit" class="btn-primary"><i class="ri-send-plane-line"></i> Post Announcement</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Announcements List -->
        <div class="dash-card">
            <div class="dash-card-head">
                <div class="dash-card-title"><i class="ri-history-line"></i> All Announcements</div>
            </div>
            <div>
                @if($announcements->count() > 0)
                    @foreach($announcements as $announcement)
                        <div class="announcement-item">
                            <div class="announcement-meta">
                                <span class="date-badge"><i class="ri-calendar-line"></i> {{ $announcement->created_at->format('M d, Y h:i A') }}</span>
                                <span class="poster-info"><i class="ri-user-line"></i> Posted by: {{ $announcement->faculty->name }}</span>
                            </div>
                            <div class="announcement-title">{{ $announcement->title }}</div>
                            <div class="announcement-content">{{ $announcement->content }}</div>
                            <div class="announcement-actions">
                                <a href="{{ route('faculty.announcement.edit', $announcement->id) }}" class="action-link edit"><i class="ri-edit-line"></i> Edit</a>
                                <form action="{{ route('faculty.announcement.delete', $announcement->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-link delete" onclick="return confirm('Delete this announcement?')"><i class="ri-delete-bin-line"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="ri-megaphone-line"></i>
                        <p>No announcements yet.</p>
                        <p style="font-size: 0.7rem; margin-top: 0.3rem;">Post your first announcement above.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Logout Modal -->
<div class="modal-overlay" id="logoutModal">
    <div class="modal">
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
        if (e.key === 'Escape') closeLogoutModal();
    });
</script>
</body>
</html>