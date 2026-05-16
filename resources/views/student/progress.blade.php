<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Progress – NU Horizon LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <style>
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
            --blue:      #3b82f6;
            --orange:    #d97706;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); min-height: 100vh; color: var(--txt-1); }
        *:focus { outline: none !important; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(10,31,68,0.15); border-radius: 99px; }

        /* ══ SIDEBAR ══ */
        .sidebar {
            position: fixed; top: 0; left: 0; width: var(--sidebar-w); height: 100vh;
            background: var(--navy); display: flex; flex-direction: column;
            z-index: 100; transition: transform .3s var(--ease); box-shadow: 4px 0 32px rgba(0,0,0,0.18);
        }
        .sidebar::before {
            content: ""; position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), var(--gold-mid), transparent);
            background-size: 200% 100%; animation: shimmer 4s linear infinite;
        }
        @keyframes shimmer { 0% { background-position: -200% center; } 100% { background-position: 200% center; } }
        .sidebar::after {
            content: ""; position: absolute; inset: 0;
            background-image: linear-gradient(rgba(255,255,255,0.012) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255,255,255,0.012) 1px, transparent 1px);
            background-size: 32px 32px; pointer-events: none;
        }
        .sidebar-arc { position: absolute; width: 340px; height: 340px; border-radius: 50%; border: 1px solid rgba(255,215,15,0.06); bottom: -60px; left: -100px; pointer-events: none; z-index: 0; }
        .sidebar-inner { position: relative; z-index: 1; display: flex; flex-direction: column; height: 100%; }

        .sidebar-logo { padding: 1.5rem 1.4rem 1.3rem; display: flex; align-items: center; gap: .85rem; border-bottom: 1px solid rgba(255,215,15,0.14); }
        .logo-seal-wrap { position: relative; flex-shrink: 0; }
        .logo-seal { width: 40px; height: 40px; border-radius: 50%; object-fit: contain; background: rgba(255,255,255,0.07); border: 1.5px solid rgba(255,215,15,0.30); display: block; }
        .logo-seal-ring { position: absolute; inset: -3px; border-radius: 50%; border: 1.5px solid rgba(255,215,15,0.28); animation: rotateSlow 14s linear infinite; }
        @keyframes rotateSlow { from { transform:rotate(0deg); } to { transform:rotate(360deg); } }
        .logo-seal-ring::before { content: ""; position: absolute; top: -2px; left: 50%; transform: translateX(-50%); width: 4px; height: 4px; border-radius: 50%; background: var(--gold); box-shadow: 0 0 5px var(--gold); }
        .logo-text h1 { font-family: 'Fraunces', serif; font-size: 1.15rem; font-weight: 700; color: #fff; letter-spacing: -.02em; line-height: 1.1; }
        .logo-text h1 em { color: var(--gold); font-style: normal; }
        .logo-text p { font-size: .65rem; font-weight: 600; letter-spacing: .10em; text-transform: uppercase; color: rgba(255,255,255,0.40); margin-top: .15rem; }

        .nav-body { flex: 1; overflow-y: auto; padding: 1.2rem .85rem; display: flex; flex-direction: column; gap: 1.6rem; }
        .nav-section-label { font-size: .62rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; color: rgba(255,215,15,0.50); margin-bottom: .4rem; padding-left: .4rem; }
        .nav-item { display: flex; align-items: center; gap: .7rem; padding: .62rem .85rem; border-radius: 10px; color: rgba(255,255,255,0.70); text-decoration: none; font-size: .82rem; font-weight: 500; transition: all var(--t); margin-bottom: .15rem; }
        .nav-item i { font-size: 1.05rem; width: 1.25rem; flex-shrink: 0; }
        .nav-item:hover { background: rgba(255,215,15,0.10); color: rgba(255,255,255,0.92); }
        .nav-item.active { background: var(--gold); color: var(--navy); font-weight: 700; box-shadow: 0 4px 14px rgba(255,215,15,0.30); }
        .nav-item.active i { color: var(--navy); }
        .nav-badge { margin-left: auto; background: var(--danger); color: #fff; font-size: .6rem; font-weight: 700; padding: .1rem .45rem; border-radius: 99px; flex-shrink: 0; }

        .sidebar-footer { padding: 1rem 1.2rem; border-top: 1px solid rgba(255,215,15,0.14); }
        .profile-row { display: flex; align-items: center; gap: .75rem; margin-bottom: .85rem; }
        .avatar { width: 38px; height: 38px; border-radius: 50%; background: rgba(255,215,15,0.15); border: 1.5px solid rgba(255,215,15,0.30); display: flex; align-items: center; justify-content: center; color: var(--gold); font-size: 1rem; flex-shrink: 0; }
        .profile-name { font-size: .82rem; font-weight: 700; color: #fff; }
        .profile-email { font-size: .68rem; color: rgba(255,255,255,0.42); margin-top: .1rem; }
        .logout-btn { width: 100%; padding: .58rem .9rem; border-radius: 8px; background: rgba(220,38,38,0.12); border: 1px solid rgba(220,38,38,0.22); color: #fca5a5; font-size: .78rem; font-weight: 600; font-family: 'Plus Jakarta Sans', sans-serif; display: flex; align-items: center; justify-content: center; gap: .5rem; cursor: pointer; transition: all var(--t); }
        .logout-btn:hover { background: var(--danger); border-color: var(--danger); color: #fff; box-shadow: 0 4px 12px rgba(220,38,38,0.35); }

        /* ══ MAIN ══ */
        .main-content { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }
        .topbar { position: sticky; top: 0; z-index: 50; background: rgba(248,246,241,0.88); backdrop-filter: blur(14px); border-bottom: 1px solid var(--bdr); padding: .9rem 2rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; }
        .topbar-left { display: flex; align-items: center; gap: 1rem; }
        .menu-toggle { display: none; background: none; border: 1px solid var(--bdr); border-radius: 8px; padding: .4rem .55rem; color: var(--txt-2); font-size: 1.1rem; cursor: pointer; transition: all var(--t); }
        .menu-toggle:hover { border-color: var(--gold-d); color: var(--navy); }
        .topbar-title { font-family: 'Fraunces', serif; font-size: 1.2rem; font-weight: 700; color: var(--navy); letter-spacing: -.02em; }
        .topbar-title em { color: var(--gold-d); font-style: normal; }
        .topbar-breadcrumb { font-size: .72rem; color: var(--txt-3); font-weight: 500; }
        .topbar-right { display: flex; align-items: center; gap: .75rem; }
        .topbar-badge { display: flex; align-items: center; gap: .4rem; font-size: .72rem; font-weight: 600; color: var(--txt-3); background: var(--white); border: 1px solid var(--bdr); border-radius: 8px; padding: .4rem .75rem; box-shadow: 0 1px 4px rgba(10,31,68,0.04); }
        .topbar-badge i { font-size: .85rem; color: var(--gold-d); }
        .topbar-dot { width: 7px; height: 7px; border-radius: 50%; background: #22c55e; box-shadow: 0 0 0 2px rgba(34,197,94,0.25); }

        .page-body { padding: 1.8rem 2rem; flex: 1; }

        .section-header { margin-bottom: 1.4rem; }
        .section-header h2 { font-size: .65rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; color: var(--txt-3); display: flex; align-items: center; gap: .5rem; }
        .section-header h2::after { content: ""; flex: 1; height: 1px; background: var(--bdr); }

        @keyframes fadeUp { from { opacity:0; transform:translateY(14px); } to { opacity:1; transform:translateY(0); } }

        /* ══ OVERVIEW BANNER ══ */
        .overview-banner {
            background: var(--navy); border-radius: 14px; padding: 1.6rem 2rem;
            margin-bottom: 1.4rem; position: relative; overflow: hidden;
            box-shadow: 0 4px 20px rgba(10,31,68,0.15); border: 1px solid rgba(255,215,15,0.12);
            animation: fadeUp .4s var(--ease) both;
        }
        .overview-banner::before { content: ""; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, transparent, var(--gold), var(--gold-mid), transparent); background-size: 200% 100%; animation: shimmer 4s linear infinite; }
        .overview-banner::after { content: ""; position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,0.012) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.012) 1px, transparent 1px); background-size: 32px 32px; pointer-events: none; }
        .overview-arc { position: absolute; width: 240px; height: 240px; border-radius: 50%; border: 1px solid rgba(255,215,15,0.06); right: -50px; top: -80px; pointer-events: none; z-index: 0; }
        .overview-inner { position: relative; z-index: 1; display: flex; align-items: center; justify-content: space-between; gap: 2rem; flex-wrap: wrap; }
        .overview-left .overline { font-size: .68rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; color: rgba(255,255,255,0.45); margin-bottom: .4rem; display: flex; align-items: center; gap: .4rem; }
        .overview-left .overline i { font-size: .9rem; color: var(--gold-mid); }
        .overview-left .big-pct { font-family: 'Fraunces', serif; font-size: 3.5rem; font-weight: 700; color: #fff; letter-spacing: -.05em; line-height: 1; }
        .overview-left .sub { font-size: .78rem; color: rgba(255,255,255,0.48); margin-top: .35rem; }
        .overview-right { flex-shrink: 0; }
        .circle-wrap { position: relative; width: 120px; height: 120px; }
        .circle-wrap svg { transform: rotate(-90deg); }
        .circle-inner { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; flex-direction: column; }
        .circle-inner .val { font-family: 'Fraunces', serif; font-size: 1.9rem; font-weight: 700; color: #fff; line-height: 1; }
        .circle-inner .unit { font-size: .75rem; color: rgba(255,255,255,0.55); font-weight: 600; }

        /* ══ DASH CARD ══ */
        .dash-card { background: var(--white); border-radius: 14px; border: 1px solid var(--bdr); box-shadow: 0 2px 12px rgba(10,31,68,0.04); overflow: hidden; animation: fadeUp .5s var(--ease) .1s both; }
        .dash-card-head { padding: 1rem 1.3rem .9rem; border-bottom: 1px solid var(--bdr); display: flex; align-items: center; justify-content: space-between; }
        .dash-card-title { font-size: .82rem; font-weight: 700; color: var(--txt-1); display: flex; align-items: center; gap: .5rem; }
        .dash-card-title i { color: var(--gold-d); font-size: .9rem; }
        .dash-card-body { padding: 1.3rem; }

        /* ══ COURSE PROGRESS ITEMS ══ */
        .course-progress-item {
            border: 1px solid var(--bdr); border-radius: 12px; padding: 1.2rem 1.3rem;
            margin-bottom: 1rem; transition: all var(--t); animation: fadeUp .5s var(--ease) both;
        }
        .course-progress-item:last-child { margin-bottom: 0; }
        .course-progress-item:hover { border-color: rgba(10,31,68,0.18); box-shadow: 0 4px 16px rgba(10,31,68,0.07); }

        .course-progress-head { display: flex; align-items: flex-start; justify-content: space-between; gap: 1rem; margin-bottom: 1rem; }
        .course-progress-name { font-family: 'Fraunces', serif; font-size: 1rem; font-weight: 700; color: var(--navy); line-height: 1.25; margin-bottom: .2rem; }
        .course-progress-code { font-size: .68rem; font-weight: 700; color: var(--txt-3); }
        .course-pct-big { font-family: 'Fraunces', serif; font-size: 2rem; font-weight: 700; color: var(--navy-lite); letter-spacing: -.04em; line-height: 1; }
        .course-pct-label { font-size: .62rem; color: var(--txt-3); text-align: right; margin-top: .08rem; }

        /* Main course progress bar */
        .main-prog-track { height: 7px; background: var(--bg); border-radius: 99px; overflow: hidden; border: 1px solid var(--bdr); margin-bottom: 1.1rem; }
        .main-prog-fill { height: 100%; border-radius: 99px; background: linear-gradient(90deg, var(--gold-mid), var(--gold-d)); transition: width .8s var(--ease); }

        /* Mini stat cells */
        .mini-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: .65rem; margin-bottom: 1rem; }
        .mini-stat { border-radius: 10px; padding: .7rem .65rem; text-align: center; border: 1px solid var(--bdr); }
        .mini-stat.blue   { background: rgba(59,130,246,0.06); }
        .mini-stat.green  { background: rgba(22,163,74,0.06); }
        .mini-stat.purple { background: rgba(124,58,237,0.06); }
        .mini-stat.gold   { background: var(--gold-pale); }
        .mini-stat-label { font-size: .62rem; color: var(--txt-3); font-weight: 600; margin-bottom: .25rem; text-transform: uppercase; letter-spacing: .04em; }
        .mini-stat-val { font-family: 'Fraunces', serif; font-size: 1.3rem; font-weight: 700; line-height: 1; }
        .mini-stat.blue   .mini-stat-val { color: var(--blue); }
        .mini-stat.green  .mini-stat-val { color: var(--green); }
        .mini-stat.purple .mini-stat-val { color: var(--purple); }
        .mini-stat.gold   .mini-stat-val { color: var(--gold-d); font-size: .85rem; font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Quiz performance breakdown */
        .quiz-perf-head { display: flex; align-items: center; gap: .45rem; font-size: .78rem; font-weight: 700; color: var(--txt-1); margin-bottom: .8rem; padding-top: .9rem; border-top: 1px solid var(--bdr); }
        .quiz-perf-head i { color: var(--gold-d); }
        .quiz-row { display: flex; align-items: center; gap: .75rem; margin-bottom: .55rem; }
        .quiz-row:last-child { margin-bottom: 0; }
        .quiz-row-title { font-size: .75rem; color: var(--txt-2); flex: 1; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .quiz-row-score { font-size: .72rem; color: var(--txt-3); white-space: nowrap; flex-shrink: 0; }
        .quiz-bar-track { flex: 1; height: 5px; background: var(--bg); border-radius: 99px; overflow: hidden; border: 1px solid var(--bdr); }
        .quiz-bar-fill { height: 100%; border-radius: 99px; background: linear-gradient(90deg, var(--navy-lite), var(--navy)); transition: width .7s var(--ease); }
        .quiz-pct-badge {
            font-size: .68rem; font-weight: 700; min-width: 38px; text-align: right; flex-shrink: 0;
        }
        .pct-green  { color: var(--green); }
        .pct-amber  { color: var(--orange); }
        .pct-red    { color: var(--danger); }

        /* ══ EMPTY STATE ══ */
        .empty-state { text-align: center; padding: 3.5rem 1rem; color: var(--txt-3); font-size: .82rem; }
        .empty-state i { font-size: 2.8rem; display: block; margin-bottom: .65rem; opacity: .3; }

        /* ══ MODAL ══ */
        .modal-overlay { position: fixed; inset: 0; background: rgba(10,31,68,0.72); backdrop-filter: blur(6px); z-index: 500; display: flex; align-items: center; justify-content: center; visibility: hidden; opacity: 0; transition: all .22s var(--ease); }
        .modal-overlay.active { visibility: visible; opacity: 1; }
        .modal { background: var(--white); border-radius: 18px; width: min(440px, 94vw); overflow: hidden; transform: scale(0.94) translateY(12px); transition: transform .28s var(--spring); box-shadow: 0 40px 80px rgba(0,0,0,0.25), 0 0 0 1px rgba(255,215,15,0.10); }
        .modal-overlay.active .modal { transform: scale(1) translateY(0); }
        .modal-head { background: var(--navy); padding: 1.2rem 1.4rem; display: flex; align-items: center; justify-content: space-between; border-bottom: 2px solid var(--gold); position: relative; }
        .modal-head::before { content: ""; position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, var(--gold), transparent); }
        .modal-head h3 { font-family: 'Fraunces', serif; font-size: 1.05rem; font-weight: 700; color: #fff; display: flex; align-items: center; gap: .5rem; }
        .modal-head h3 i { color: var(--gold); }
        .modal-close { background: none; border: none; color: rgba(255,255,255,0.55); font-size: 1.3rem; cursor: pointer; transition: color var(--t); line-height: 1; }
        .modal-close:hover { color: var(--gold); }
        .modal-body { padding: 1.8rem 1.5rem; text-align: center; }
        .modal-body p { font-size: .88rem; color: var(--txt-2); line-height: 1.55; }
        .modal-warn { font-size: .72rem; color: var(--txt-3); margin-top: .5rem; }
        .modal-foot { padding: .9rem 1.4rem 1.3rem; display: flex; gap: .6rem; justify-content: flex-end; background: var(--bg); border-top: 1px solid var(--bdr); }
        .btn-cancel { padding: .58rem 1.1rem; border-radius: 8px; border: 1px solid var(--bdr); background: var(--white); font-size: .8rem; font-weight: 600; color: var(--txt-2); font-family: 'Plus Jakarta Sans', sans-serif; cursor: pointer; transition: all var(--t); }
        .btn-cancel:hover { background: var(--bg); }
        .btn-confirm { padding: .58rem 1.2rem; border-radius: 8px; border: none; background: var(--danger); font-size: .8rem; font-weight: 700; color: #fff; font-family: 'Plus Jakarta Sans', sans-serif; cursor: pointer; transition: all var(--t); box-shadow: 0 3px 10px rgba(220,38,38,0.30); }
        .btn-confirm:hover { background: var(--danger-d); transform: translateY(-1px); }

        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(10,31,68,0.65); z-index: 90; }

        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay { display: block; }
            .main-content { margin-left: 0; }
            .menu-toggle { display: flex; }
            .mini-stats { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 640px) {
            .page-body { padding: 1.2rem 1rem; }
            .topbar { padding: .8rem 1rem; }
            .overview-inner { flex-direction: column; align-items: flex-start; }
            .mini-stats { grid-template-columns: 1fr 1fr; }
            .course-progress-head { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- ══ SIDEBAR ══ -->
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
                <p>Student Portal · National University</p>
            </div>
        </div>

        <div class="nav-body">
            <div>
                <div class="nav-section-label">Main</div>
                <a href="{{ route('student.dashboard') }}" class="nav-item {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>
                <a href="{{ route('student.courses') }}" class="nav-item {{ request()->routeIs('student.courses*') ? 'active' : '' }}">
                    <i class="ri-book-line"></i> My Courses
                </a>
                <a href="{{ route('student.progress') }}" class="nav-item {{ request()->routeIs('student.progress*') ? 'active' : '' }}">
                    <i class="ri-bar-chart-line"></i> Progress
                </a>
                <a href="{{ route('student.announcements') }}" class="nav-item {{ request()->routeIs('student.announcements*') ? 'active' : '' }}">
                    <i class="ri-megaphone-line"></i> Announcements
                </a>
                <a href="{{ route('student.notifications') }}" class="nav-item {{ request()->routeIs('student.notifications*') ? 'active' : '' }}">
                    <i class="ri-notification-line"></i> Notifications
                    @if(isset($unreadNotifications) && $unreadNotifications > 0)
                        <span class="nav-badge">{{ $unreadNotifications }}</span>
                    @endif
                </a>
                <a href="{{ route('student.faculty.evaluation') }}" class="nav-item {{ request()->routeIs('student.faculty.evaluation') ? 'active' : '' }}">
                    <i class="ri-star-line"></i> Faculty Evaluation
                </a>
            </div>
            <div>
                <div class="nav-section-label">Account</div>
                <a href="{{ route('student.profile') }}" class="nav-item {{ request()->routeIs('student.profile*') ? 'active' : '' }}">
                    <i class="ri-user-line"></i> Profile
                </a>
            </div>
        </div>

        <div class="sidebar-footer">
            <div class="profile-row">
                <div class="avatar"><i class="ri-graduation-cap-line"></i></div>
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
    <header class="topbar">
        <div class="topbar-left">
            <button class="menu-toggle" id="menuToggle" onclick="toggleSidebar()">
                <i class="ri-menu-2-line"></i>
            </button>
            <div>
                <div class="topbar-title">NU Horizon <em>LMS</em></div>
                <div class="topbar-breadcrumb">Student → My Progress</div>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-badge"><span class="topbar-dot"></span> System Online</div>
            <div class="topbar-badge"><i class="ri-calendar-line"></i><span id="topbar-date"></span></div>
        </div>
    </header>

    <div class="page-body">

        <div class="section-header">
            <h2><i class="ri-bar-chart-line" style="color:var(--gold-d);font-size:.85rem;"></i> My Progress</h2>
        </div>

        <!-- Overall Progress Banner -->
        <div class="overview-banner">
            <div class="overview-arc"></div>
            <div class="overview-inner">
                <div class="overview-left">
                    <div class="overline"><i class="ri-trophy-line"></i> Overall Progress</div>
                    <div class="big-pct">{{ $averageProgress }}%</div>
                    <div class="sub">Across {{ $enrolledCourses->count() }} enrolled {{ Str::plural('course', $enrolledCourses->count()) }}</div>
                </div>
                <div class="overview-right">
                    <div class="circle-wrap">
                        <svg width="120" height="120" viewBox="0 0 120 120">
                            <circle cx="60" cy="60" r="50" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="12"/>
                            <circle cx="60" cy="60" r="50" fill="none" stroke="var(--gold)" stroke-width="12"
                                    stroke-dasharray="314.16"
                                    stroke-dashoffset="{{ 314.16 - (314.16 * $averageProgress / 100) }}"
                                    stroke-linecap="round"
                                    style="transition: stroke-dashoffset .8s ease;"/>
                        </svg>
                        <div class="circle-inner">
                            <div class="val">{{ $averageProgress }}</div>
                            <div class="unit">%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Course Progress Details -->
        <div class="dash-card">
            <div class="dash-card-head">
                <div class="dash-card-title">
                    <i class="ri-bar-chart-grouped-line"></i> Course Progress Details
                </div>
            </div>
            <div class="dash-card-body">
                @forelse($enrolledCourses as $i => $enrollment)
                    <div class="course-progress-item" style="animation-delay:{{ $i * 0.06 }}s;">

                        <!-- Head -->
                        <div class="course-progress-head">
                            <div>
                                <div class="course-progress-name">{{ $enrollment->course->name }}</div>
                                <div class="course-progress-code">{{ $enrollment->course->code }}</div>
                            </div>
                            <div style="text-align:right;flex-shrink:0;">
                                <div class="course-pct-big">{{ $enrollment->course_progress ?? 0 }}%</div>
                                <div class="course-pct-label">Completed</div>
                            </div>
                        </div>

                        <!-- Main progress bar -->
                        <div class="main-prog-track">
                            <div class="main-prog-fill" style="width:{{ $enrollment->course_progress ?? 0 }}%;"></div>
                        </div>

                        <!-- Mini stats -->
                        <div class="mini-stats">
                            <div class="mini-stat blue">
                                <div class="mini-stat-label">Quizzes</div>
                                <div class="mini-stat-val">{{ $enrollment->completed_quizzes ?? 0 }}<span style="font-size:.7rem;font-family:'Plus Jakarta Sans',sans-serif;color:var(--txt-3);"> / {{ $enrollment->total_quizzes ?? 0 }}</span></div>
                            </div>
                            <div class="mini-stat green">
                                <div class="mini-stat-label">Materials</div>
                                <div class="mini-stat-val">{{ $enrollment->completed_materials ?? 0 }}<span style="font-size:.7rem;font-family:'Plus Jakarta Sans',sans-serif;color:var(--txt-3);"> / {{ $enrollment->total_materials ?? 0 }}</span></div>
                            </div>
                            <div class="mini-stat purple">
                                <div class="mini-stat-label">Avg. Score</div>
                                @php $avgScore = $enrollment->quiz_scores->avg('percentage') ?? 0; @endphp
                                <div class="mini-stat-val">{{ round($avgScore) }}%</div>
                            </div>
                            <div class="mini-stat gold">
                                <div class="mini-stat-label">Instructor</div>
                                <div class="mini-stat-val" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $enrollment->course->faculty->name ?? 'N/A' }}</div>
                            </div>
                        </div>

                        <!-- Quiz performance -->
                        @if($enrollment->quiz_scores && $enrollment->quiz_scores->count() > 0)
                            <div class="quiz-perf-head">
                                <i class="ri-quiz-line"></i> Quiz Performance
                            </div>
                            @foreach($enrollment->quiz_scores as $quizScore)
                                <div class="quiz-row">
                                    <div class="quiz-row-title">{{ $quizScore['title'] }}</div>
                                    <div class="quiz-row-score">{{ $quizScore['score'] }} / {{ $quizScore['total'] }}</div>
                                    <div class="quiz-bar-track" style="max-width:120px;">
                                        <div class="quiz-bar-fill" style="width:{{ $quizScore['percentage'] }}%;"></div>
                                    </div>
                                    <div class="quiz-pct-badge {{ $quizScore['percentage'] >= 70 ? 'pct-green' : ($quizScore['percentage'] >= 50 ? 'pct-amber' : 'pct-red') }}">
                                        {{ $quizScore['percentage'] }}%
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                @empty
                    <div class="empty-state">
                        <i class="ri-bar-chart-line"></i>
                        No progress data available yet.
                        <p style="font-size:.72rem;margin-top:.3rem;">Enroll in courses to start tracking your progress.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

<!-- Logout Modal -->
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
    document.getElementById('topbar-date').textContent =
        new Date().toLocaleDateString('en-PH', { month: 'short', day: 'numeric', year: 'numeric' });

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
    function openLogoutModal() { document.getElementById('logoutModal').classList.add('active'); document.body.style.overflow = 'hidden'; }
    function closeLogoutModal() { document.getElementById('logoutModal').classList.remove('active'); document.body.style.overflow = ''; }
    document.getElementById('logoutButton').addEventListener('click', function(e) { e.preventDefault(); openLogoutModal(); });
    document.getElementById('confirmLogoutBtn').addEventListener('click', () => { document.getElementById('logoutForm').submit(); });
    document.getElementById('logoutModal').addEventListener('click', function(e) { if (e.target === this) closeLogoutModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLogoutModal(); });
</script>
</body>
</html>