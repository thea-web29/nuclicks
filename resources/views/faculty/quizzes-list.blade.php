<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Quizzes – NU Horizon LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        /* ══ DESIGN TOKENS ══ */
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

        /* ══ SCROLLBAR ══ */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(10,31,68,0.15); border-radius: 99px; }

        /* ══ SIDEBAR ══ */
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
            display: flex; align-items: center; justify-content: center;
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

        /* ══ MAIN ══ */
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
        .topbar-breadcrumb { font-size: .72rem; color: var(--txt-3); font-weight: 500; }
        .topbar-right { display: flex; align-items: center; gap: .75rem; }
        .topbar-badge {
            display: flex; align-items: center; gap: .4rem;
            font-size: .72rem; font-weight: 600;
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


        /* ══ PAGE BODY ══ */
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

        /* ══ ALERT ══ */
        .alert-success {
            display: flex; align-items: center; gap: .6rem;
            background: rgba(22,163,74,0.08);
            border: 1px solid rgba(22,163,74,0.20);
            border-left: 4px solid var(--green);
            border-radius: 10px;
            padding: .75rem 1rem;
            font-size: .8rem; font-weight: 600;
            color: var(--green);
            margin-bottom: 1.4rem;
            animation: fadeUp .4s var(--ease) both;
        }

        @keyframes fadeUp {
            from { opacity:0; transform:translateY(14px); }
            to   { opacity:1; transform:translateY(0); }
        }

        /* ══ QUIZ CARDS ══ */
        .quiz-list { display: flex; flex-direction: column; gap: .9rem; }
        .quiz-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            padding: 1.2rem 1.3rem;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1.2rem;
            transition: all var(--t);
            animation: fadeUp .5s var(--ease) both;
            position: relative;
            overflow: hidden;
        }
        .quiz-card::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 4px; height: 100%;
            border-radius: 4px 0 0 4px;
        }
        .quiz-card.active-quiz::before  { background: var(--green); }
        .quiz-card.ended-quiz::before   { background: var(--danger); }
        .quiz-card.upcoming-quiz::before { background: var(--orange); }

        .quiz-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(10,31,68,0.09);
            border-color: rgba(10,31,68,0.15);
        }
        .quiz-card-left { flex: 1; min-width: 0; }
        .quiz-card-head {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: .55rem;
            margin-bottom: .45rem;
        }
        .quiz-title {
            font-family: 'Fraunces', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--navy);
            line-height: 1.25;
        }

        /* Status badges */
        .status-badge {
            font-size: .65rem; font-weight: 700;
            padding: .2rem .6rem;
            border-radius: 99px;
            display: inline-flex; align-items: center; gap: .25rem;
        }
        .status-active   { background: rgba(22,163,74,0.12); color: var(--green); }
        .status-ended    { background: rgba(220,38,38,0.10); color: var(--danger); }
        .status-upcoming { background: rgba(234,88,12,0.10); color: var(--orange); }

        .quiz-desc {
            font-size: .78rem; color: var(--txt-3);
            margin-bottom: .65rem;
            line-height: 1.45;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        .quiz-meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: .9rem;
        }
        .quiz-meta-item {
            display: flex; align-items: center; gap: .3rem;
            font-size: .72rem; color: var(--txt-3);
        }
        .quiz-meta-item i { font-size: .8rem; }
        .quiz-meta-item.course { color: var(--navy-lite); font-weight: 600; }

        /* Action buttons */
        .quiz-actions {
            display: flex;
            align-items: center;
            gap: .45rem;
            flex-shrink: 0;
        }
        .qa-btn {
            display: inline-flex; align-items: center; gap: .35rem;
            padding: .42rem .85rem;
            border-radius: 8px;
            font-size: .75rem; font-weight: 700;
            text-decoration: none;
            transition: all var(--t);
            border: 1px solid var(--bdr);
            background: var(--white);
            color: var(--txt-2);
            cursor: pointer;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .qa-btn:hover { background: var(--bg); border-color: rgba(10,31,68,0.18); }
        .qa-btn.edit i    { color: var(--gold-d); }
        .qa-btn.results i { color: var(--blue); }
        .qa-btn.delete    { color: var(--danger); border-color: rgba(220,38,38,0.15); }
        .qa-btn.delete:hover { background: rgba(220,38,38,0.06); border-color: rgba(220,38,38,0.25); }

        /* ══ EMPTY STATE ══ */
        .empty-card {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            text-align: center;
            padding: 4rem 2rem;
            animation: fadeUp .5s var(--ease) both;
        }
        .empty-card i { font-size: 3rem; color: var(--txt-3); opacity: .3; display: block; margin-bottom: 1rem; }
        .empty-card h3 { font-family: 'Fraunces', serif; font-size: 1.3rem; font-weight: 700; color: var(--navy); margin-bottom: .5rem; }
        .empty-card p { font-size: .82rem; color: var(--txt-3); max-width: 320px; margin: 0 auto 1.5rem; }
        .btn-gold {
            display: inline-flex; align-items: center; gap: .35rem;
            padding: .42rem .95rem;
            border-radius: 8px; border: none;
            background: var(--gold); color: var(--navy);
            font-size: .75rem; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            text-decoration: none; cursor: pointer;
            transition: all var(--t);
            box-shadow: 0 2px 8px rgba(255,215,15,0.28);
        }
        .btn-gold:hover { background: var(--gold-mid); transform: translateY(-1px); }

        /* ══ MODAL ══ */
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
            border-radius: 18px; width: min(440px, 94vw);
            overflow: hidden;
            transform: scale(0.94) translateY(12px);
            transition: transform .28s var(--spring);
            box-shadow: 0 40px 80px rgba(0,0,0,0.25), 0 0 0 1px rgba(255,215,15,0.10);
        }
        .modal-overlay.active .modal { transform: scale(1) translateY(0); }
        .modal-head {
            background: var(--navy);
            padding: 1.2rem 1.4rem;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 2px solid var(--gold);
            position: relative;
        }
        .modal-head::before {
            content: "";
            position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }
        .modal-head h3 {
            font-family: 'Fraunces', serif;
            font-size: 1.05rem; font-weight: 700; color: #fff;
            display: flex; align-items: center; gap: .5rem;
        }
        .modal-head h3 i { color: var(--gold); }
        .modal-close {
            background: none; border: none;
            color: rgba(255,255,255,0.55); font-size: 1.3rem;
            cursor: pointer; transition: color var(--t); line-height: 1;
        }
        .modal-close:hover { color: var(--gold); }
        .modal-body { padding: 1.8rem 1.5rem; text-align: center; }
        .modal-body p { font-size: .88rem; color: var(--txt-2); line-height: 1.55; }
        .modal-warn { font-size: .72rem; color: var(--txt-3); margin-top: .5rem; }
        .modal-foot {
            padding: .9rem 1.4rem 1.3rem;
            display: flex; gap: .6rem; justify-content: flex-end;
            background: var(--bg); border-top: 1px solid var(--bdr);
        }
        .btn-cancel {
            padding: .58rem 1.1rem; border-radius: 8px;
            border: 1px solid var(--bdr); background: var(--white);
            font-size: .8rem; font-weight: 600; color: var(--txt-2);
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all var(--t);
        }
        .btn-cancel:hover { background: var(--bg); }
        .btn-confirm {
            padding: .58rem 1.2rem; border-radius: 8px; border: none;
            background: var(--danger); font-size: .8rem; font-weight: 700; color: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all var(--t);
            box-shadow: 0 3px 10px rgba(220,38,38,0.30);
        }
        .btn-confirm:hover { background: var(--danger-d); transform: translateY(-1px); }

        /* ══ MOBILE OVERLAY ══ */
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(10,31,68,0.65); z-index: 90;
        }

        /* ══ RESPONSIVE ══ */
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay { display: block; }
            .main-content { margin-left: 0; }
            .menu-toggle { display: flex; }
            .quiz-card { flex-direction: column; }
            .quiz-actions { flex-wrap: wrap; }
        }
        @media (max-width: 640px) {
            .page-body { padding: 1.2rem 1rem; }
            .topbar { padding: .8rem 1rem; }
        }
    </style>
</head>
<body>

<!-- Sidebar overlay (mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- ══ SIDEBAR ══ -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-arc"></div>
    <div class="sidebar-inner">

        <!-- Logo -->
        <div class="sidebar-logo">
            <div class="logo-seal-wrap">
                <div class="logo-seal-ring"></div>
                <img src="/logo/NatU.png" alt="NU seal" class="logo-seal"
                     onerror="this.style.display='none'">
            </div>
            <div class="logo-text">
                <h1>NU Horizon <em>LMS</em></h1>
                <p>Faculty Portal · National University</p>
            </div>
        </div>

        <!-- Nav -->
        <div class="nav-body">
            <div>
                <div class="nav-section-label">Main</div>
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
            <div>
                <div class="nav-section-label">Quiz Management</div>
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
            <div>
                <div class="nav-section-label">Analytics</div>
                <a href="{{ route('faculty.results.index') }}" class="nav-item {{ request()->routeIs('faculty.results*') ? 'active' : '' }}">
                    <i class="ri-bar-chart-line"></i> Results & Analytics
                </a>
                <a href="{{ route('faculty.my-evaluation') }}" class="nav-item {{ request()->routeIs('faculty.my-evaluation*') ? 'active' : '' }}">
                    <i class="ri-star-smile-line"></i> My Evaluation
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="sidebar-footer">
            <div class="profile-row">
                <div class="avatar"><i class="ri-user-line"></i></div>
                <div>
                    <div class="profile-name">{{ Auth::user()->name }}</div>
                    <div class="profile-email">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                @csrf
                <button type="button" id="logoutButton" class="logout-btn">
                    <i class="ri-logout-box-line"></i> Sign Out
                </button>
            </form>
        </div>

    </div>
</aside>

<!-- ══ MAIN ══ -->
<div class="main-content" id="mainContent">

    <!-- Topbar -->
    <header class="topbar">
        <div class="topbar-left">
            <button class="menu-toggle" id="menuToggle" onclick="toggleSidebar()">
                <i class="ri-menu-2-line"></i>
            </button>
            <div>
                <div class="topbar-title">NU Horizon <em>LMS</em></div>
                <div class="topbar-breadcrumb">Faculty → Quiz Management → All Quizzes</div>
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

    <!-- Page body -->
    <div class="page-body">

        <!-- Section header -->
        <div class="section-header">
            <h2><i class="ri-list-check" style="color:var(--gold-d);font-size:.85rem;"></i> All Quizzes</h2>
        </div>

        <!-- Success alert -->
        @if(session('success'))
            <div class="alert-success">
                <i class="ri-checkbox-circle-line"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(isset($quizzes) && $quizzes->count() > 0)
            <div class="quiz-list">
                @foreach($quizzes as $i => $quiz)
                    @php
                        $statusClass = 'upcoming-quiz';
                        $statusBadge = 'status-upcoming';
                        $statusText  = 'Upcoming';
                        $statusIcon  = 'ri-time-line';
                        if($quiz->hasStarted() && !$quiz->hasEnded()) {
                            $statusClass = 'active-quiz';
                            $statusBadge = 'status-active';
                            $statusText  = 'Active';
                            $statusIcon  = 'ri-checkbox-circle-line';
                        } elseif($quiz->hasEnded()) {
                            $statusClass = 'ended-quiz';
                            $statusBadge = 'status-ended';
                            $statusText  = 'Ended';
                            $statusIcon  = 'ri-close-circle-line';
                        }
                    @endphp
                    <div class="quiz-card {{ $statusClass }}" style="animation-delay:{{ $i * 0.05 }}s;">
                        <div class="quiz-card-left">
                            <div class="quiz-card-head">
                                <div class="quiz-title">{{ $quiz->title }}</div>
                                <span class="status-badge {{ $statusBadge }}">
                                    <i class="{{ $statusIcon }}"></i> {{ $statusText }}
                                </span>
                            </div>
                            <div class="quiz-desc">{{ $quiz->description ?? 'No description provided.' }}</div>
                            <div class="quiz-meta-row">
                                <span class="quiz-meta-item course">
                                    <i class="ri-book-line"></i> {{ $quiz->course->code ?? 'N/A' }}
                                </span>
                                <span class="quiz-meta-item">
                                    <i class="ri-question-line"></i> {{ $quiz->questions->count() }} Questions
                                </span>
                                <span class="quiz-meta-item">
                                    <i class="ri-star-line"></i> {{ $quiz->total_points }} Points
                                </span>
                                @if($quiz->duration_minutes)
                                    <span class="quiz-meta-item">
                                        <i class="ri-time-line"></i> {{ $quiz->duration_minutes }} min
                                    </span>
                                @endif
                                <span class="quiz-meta-item">
                                    <i class="ri-user-line"></i> {{ $quiz->attempts->count() }} Attempts
                                </span>
                            </div>
                        </div>
                        <div class="quiz-actions">
                            <a href="{{ route('faculty.edit.quiz', $quiz->id) }}" class="qa-btn edit">
                                <i class="ri-edit-line"></i> Edit
                            </a>
                            <a href="{{ route('faculty.submissions', $quiz->id) }}" class="qa-btn results">
                                <i class="ri-bar-chart-line"></i> Results
                            </a>
                            <form action="{{ route('faculty.delete.quiz', $quiz->id) }}" method="POST"
                                  style="margin:0;" id="delete-form-{{ $quiz->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        class="qa-btn delete"
                                        onclick="confirmDeleteQuiz({{ $quiz->id }}, '{{ addslashes($quiz->title) }}')">
                                    <i class="ri-delete-bin-line"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-card">
                <i class="ri-quiz-line"></i>
                <h3>No Quizzes Created Yet</h3>
                <p>Ready to assess your students? Create your first quiz and start building engaging assessments.</p>
                <a href="{{ route('faculty.quiz.create') }}" class="btn-gold">
                    <i class="ri-add-line"></i> Create Your First Quiz
                </a>
            </div>
        @endif

    </div><!-- /page-body -->
</div><!-- /main-content -->

<!-- ══ DELETE CONFIRM MODAL ══ -->
<div id="deleteModal" class="modal-overlay">
    <div class="modal">
        <div class="modal-head">
            <h3><i class="ri-delete-bin-line"></i> Delete Quiz</h3>
            <button class="modal-close" onclick="closeDeleteModal()">×</button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete <strong id="deleteQuizTitle"></strong>?</p>
            <p class="modal-warn">All questions, submissions, and results will be permanently lost. This cannot be undone.</p>
        </div>
        <div class="modal-foot">
            <button class="btn-cancel" onclick="closeDeleteModal()">Cancel</button>
            <button class="btn-confirm" id="confirmDeleteBtn">Yes, Delete</button>
        </div>
    </div>
</div>

<!-- ══ LOGOUT MODAL ══ -->
<div class="modal-overlay" id="logoutModal">
    <div class="modal">
        <div class="modal-head">
            <h3><i class="ri-logout-box-r-line"></i> Confirm Sign Out</h3>
            <button class="modal-close" onclick="closeLogoutModal()">×</button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to sign out of your account?</p>
            <p class="modal-warn">You will be redirected to the login page.</p>
        </div>
        <div class="modal-foot">
            <button class="btn-cancel" onclick="closeLogoutModal()">Cancel</button>
            <button class="btn-confirm" id="confirmLogoutBtn">Yes, Sign Out</button>
        </div>
    </div>
</div>

<script>
    /* ── Topbar date ── */
    document.getElementById('topbar-date').textContent =
        new Date().toLocaleDateString('en-PH', { month: 'short', day: 'numeric', year: 'numeric' });

    /* ── Sidebar toggle ── */
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

    /* ── Delete quiz modal ── */
    let pendingDeleteForm = null;

    function confirmDeleteQuiz(id, title) {
        pendingDeleteForm = document.getElementById(`delete-form-${id}`);
        document.getElementById('deleteQuizTitle').textContent = title;
        document.getElementById('deleteModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('active');
        document.body.style.overflow = '';
        pendingDeleteForm = null;
    }
    document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
        if (pendingDeleteForm) pendingDeleteForm.submit();
    });
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });

    /* ── Logout modal ── */
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    document.getElementById('logoutButton').addEventListener('click', function(e) {
        e.preventDefault(); openLogoutModal();
    });
    document.getElementById('confirmLogoutBtn').addEventListener('click', () => {
        document.getElementById('logoutForm').submit();
    });
    document.getElementById('logoutModal').addEventListener('click', function(e) {
        if (e.target === this) closeLogoutModal();
    });
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') { closeDeleteModal(); closeLogoutModal(); }
    });
</script>
</body>
</html>