<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses – NU Horizon LMS</title>
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

        /* ══ ALERTS ══ */
        .alert { display: flex; align-items: flex-start; gap: .6rem; border-radius: 10px; padding: .75rem 1rem; font-size: .8rem; font-weight: 600; margin-bottom: 1.2rem; animation: fadeUp .4s var(--ease) both; }
        .alert-success { background: rgba(22,163,74,0.08); border: 1px solid rgba(22,163,74,0.20); border-left: 4px solid var(--green); color: var(--green); }
        .alert-error   { background: rgba(220,38,38,0.07); border: 1px solid rgba(220,38,38,0.18); border-left: 4px solid var(--danger); color: var(--danger); }
        .alert ul { padding-left: 1.1rem; font-weight: 400; margin-top: .3rem; }

        /* ══ JOIN BANNER ══ */
        .join-card {
            background: var(--white); border-radius: 14px; border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04); overflow: hidden;
            margin-bottom: 1.3rem; animation: fadeUp .4s var(--ease) both;
        }
        .join-banner {
            background: var(--navy); padding: 1.6rem 2rem;
            position: relative; overflow: hidden;
        }
        .join-banner::before { content: ""; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, transparent, var(--gold), var(--gold-mid), transparent); background-size: 200% 100%; animation: shimmer 4s linear infinite; }
        .join-banner::after { content: ""; position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,0.012) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.012) 1px, transparent 1px); background-size: 32px 32px; pointer-events: none; }
        .join-banner-arc { position: absolute; width: 220px; height: 220px; border-radius: 50%; border: 1px solid rgba(255,215,15,0.06); right: -50px; top: -80px; pointer-events: none; z-index: 0; }
        .join-banner-inner { position: relative; z-index: 1; display: flex; align-items: center; justify-content: space-between; gap: 1.5rem; flex-wrap: wrap; }
        .join-banner-left h3 { font-family: 'Fraunces', serif; font-size: 1.2rem; font-weight: 700; color: #fff; display: flex; align-items: center; gap: .6rem; margin-bottom: .3rem; }
        .join-banner-left h3 i { color: var(--gold); }
        .join-banner-left p { font-size: .75rem; color: rgba(255,255,255,0.48); }
        .join-form { display: flex; gap: .6rem; flex-wrap: wrap; }
        .join-input { padding: .6rem 1rem; border-radius: 9px; border: 1px solid rgba(255,215,15,0.25); background: rgba(255,255,255,0.10); color: #fff; font-size: .82rem; font-family: 'Plus Jakarta Sans', sans-serif; width: 260px; transition: all var(--t); }
        .join-input::placeholder { color: rgba(255,255,255,0.38); }
        .join-input:focus { border-color: var(--gold); background: rgba(255,255,255,0.14); box-shadow: 0 0 0 3px rgba(255,215,15,0.12); }
        .btn-join { padding: .6rem 1.3rem; border-radius: 9px; border: none; background: var(--gold); color: var(--navy); font-size: .8rem; font-weight: 800; font-family: 'Plus Jakarta Sans', sans-serif; cursor: pointer; display: flex; align-items: center; gap: .4rem; transition: all var(--t); box-shadow: 0 2px 8px rgba(255,215,15,0.30); white-space: nowrap; }
        .btn-join:hover { background: var(--gold-mid); transform: translateY(-1px); }

        /* ══ DASH CARD ══ */
        .dash-card { background: var(--white); border-radius: 14px; border: 1px solid var(--bdr); box-shadow: 0 2px 12px rgba(10,31,68,0.04); overflow: hidden; animation: fadeUp .5s var(--ease) .1s both; }
        .dash-card-head { padding: 1rem 1.3rem .9rem; border-bottom: 1px solid var(--bdr); display: flex; align-items: center; justify-content: space-between; }
        .dash-card-title { font-size: .82rem; font-weight: 700; color: var(--txt-1); display: flex; align-items: center; gap: .5rem; }
        .dash-card-title i { color: var(--gold-d); font-size: .9rem; }
        .dash-card-badge { font-size: .65rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase; color: var(--txt-3); background: var(--bg); border: 1px solid var(--bdr); border-radius: 6px; padding: .2rem .55rem; }
        .dash-card-body { padding: 1.3rem; }

        /* ══ COURSE CARDS GRID ══ */
        .courses-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.1rem; }
        .course-card {
            background: var(--white); border-radius: 14px; border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04); overflow: hidden;
            transition: all var(--t); animation: fadeUp .5s var(--ease) both;
        }
        .course-card::before { content: ""; display: block; height: 3px; background: linear-gradient(90deg, var(--navy-lite), var(--navy)); }
        .course-card:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(10,31,68,0.10); border-color: rgba(10,31,68,0.15); }
        .course-card-body { padding: 1.1rem 1.2rem; }
        .course-card-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: .65rem; }
        .course-code-pill { font-size: .62rem; font-weight: 700; padding: .18rem .55rem; border-radius: 5px; background: var(--navy-pale); color: var(--navy-mid); }
        .course-credits-pill { font-size: .62rem; font-weight: 700; padding: .18rem .55rem; border-radius: 5px; background: var(--gold-pale); color: var(--gold-d); border: 1px solid rgba(196,154,0,0.15); }
        .course-name { font-family: 'Fraunces', serif; font-size: .95rem; font-weight: 700; color: var(--navy); line-height: 1.3; margin-bottom: .4rem; }
        .course-desc { font-size: .72rem; color: var(--txt-3); line-height: 1.45; margin-bottom: .75rem; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; }
        .course-meta { display: flex; justify-content: space-between; font-size: .68rem; color: var(--txt-3); border-top: 1px solid var(--bdr); padding-top: .6rem; margin-bottom: .75rem; }
        .course-meta span { display: flex; align-items: center; gap: .28rem; }
        .course-meta i { font-size: .75rem; }
        .course-actions { display: flex; gap: .5rem; }
        .btn-view { flex: 1; text-align: center; padding: .52rem; border-radius: 8px; border: none; background: var(--navy); color: #fff; font-size: .72rem; font-weight: 700; font-family: 'Plus Jakarta Sans', sans-serif; text-decoration: none; transition: all var(--t); }
        .btn-view:hover { background: var(--navy-mid); }
        .btn-leave { flex: 1; text-align: center; padding: .52rem; border-radius: 8px; border: 1px solid rgba(220,38,38,0.20); background: rgba(220,38,38,0.07); color: var(--danger); font-size: .72rem; font-weight: 700; font-family: 'Plus Jakarta Sans', sans-serif; cursor: pointer; transition: all var(--t); width: 100%; }
        .btn-leave:hover { background: var(--danger); color: #fff; border-color: var(--danger); }

        /* ══ EMPTY STATE ══ */
        .empty-state { text-align: center; padding: 3.5rem 1rem; color: var(--txt-3); font-size: .82rem; }
        .empty-state i { font-size: 2.8rem; display: block; margin-bottom: .65rem; opacity: .3; }
        .empty-state .hint { font-size: .72rem; margin-top: .3rem; }

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

        @media (max-width: 1200px) { .courses-grid { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay { display: block; }
            .main-content { margin-left: 0; }
            .menu-toggle { display: flex; }
        }
        @media (max-width: 640px) {
            .courses-grid { grid-template-columns: 1fr; }
            .page-body { padding: 1.2rem 1rem; }
            .topbar { padding: .8rem 1rem; }
            .join-banner-inner { flex-direction: column; align-items: flex-start; }
            .join-input { width: 100%; }
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
                <div class="topbar-breadcrumb">Student → My Courses</div>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-badge"><span class="topbar-dot"></span> System Online</div>
            <div class="topbar-badge"><i class="ri-calendar-line"></i><span id="topbar-date"></span></div>
        </div>
    </header>

    <div class="page-body">

        <div class="section-header">
            <h2><i class="ri-book-open-line" style="color:var(--gold-d);font-size:.85rem;"></i> My Courses</h2>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success"><i class="ri-checkbox-circle-line"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error"><i class="ri-error-warning-line"></i> {{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                <i class="ri-error-warning-line" style="flex-shrink:0;"></i>
                <ul style="list-style:none;padding:0;">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <!-- Join Course Card -->
        <div class="join-card">
            <div class="join-banner">
                <div class="join-banner-arc"></div>
                <div class="join-banner-inner">
                    <div class="join-banner-left">
                        <h3><i class="ri-add-circle-line"></i> Join a New Course</h3>
                        <p>Enter the join code provided by your instructor</p>
                    </div>
                    <form action="{{ route('student.course.join') }}" method="POST" class="join-form">
                        @csrf
                        <input type="text" name="join_code" placeholder="Enter join code (e.g., ABC123)" class="join-input" required>
                        <button type="submit" class="btn-join">
                            <i class="ri-add-line"></i> Join Course
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Enrolled Courses -->
        <div class="dash-card">
            <div class="dash-card-head">
                <div class="dash-card-title"><i class="ri-book-line"></i> My Enrolled Courses</div>
                <span class="dash-card-badge">{{ $enrolledCourses->count() }} courses</span>
            </div>
            <div class="dash-card-body">
                @if($enrolledCourses->count() > 0)
                    <div class="courses-grid">
                        @foreach($enrolledCourses as $i => $course)
                            <div class="course-card" style="animation-delay:{{ $i * 0.05 }}s;">
                                <div class="course-card-body">
                                    <div class="course-card-top">
                                        <span class="course-code-pill">{{ $course->code }}</span>
                                        <span class="course-credits-pill">{{ $course->credits ?? 'N/A' }} credits</span>
                                    </div>
                                    <div class="course-name">{{ $course->name }}</div>
                                    <div class="course-desc">{{ Str::limit($course->description ?? 'No description available.', 110) }}</div>
                                    <div class="course-meta">
                                        <span><i class="ri-quiz-line"></i> {{ $course->quizzes->count() }} Quizzes</span>
                                        <span><i class="ri-file-text-line"></i> {{ $course->materials->count() ?? 0 }} Materials</span>
                                    </div>
                                    <div class="course-actions">
                                        <a href="{{ route('student.course.details', $course->id) }}" class="btn-view">View Course</a>
                                        <form action="{{ route('student.course.leave', $course->id) }}" method="POST" style="flex:1;" id="leave-form-{{ $course->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-leave"
                                                    onclick="confirmLeave({{ $course->id }}, '{{ addslashes($course->name) }}')">
                                                Leave Course
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="ri-book-line"></i>
                        You haven't enrolled in any courses yet.
                        <p class="hint">Use the join code section above to get started.</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

<!-- Leave Confirm Modal -->
<div id="leaveModal" class="modal-overlay">
    <div class="modal">
        <div class="modal-head">
            <h3><i class="ri-logout-box-line"></i> Leave Course</h3>
            <button class="modal-close" onclick="closeLeaveModal()">×</button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to leave <strong id="leaveCourseName"></strong>?</p>
            <p class="modal-warn">You will lose access to all course materials and quiz history.</p>
        </div>
        <div class="modal-foot">
            <button class="btn-cancel" onclick="closeLeaveModal()">Cancel</button>
            <button class="btn-confirm" id="confirmLeaveBtn">Yes, Leave</button>
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

    /* Leave modal */
    let pendingLeaveForm = null;
    function confirmLeave(id, name) {
        pendingLeaveForm = document.getElementById('leave-form-' + id);
        document.getElementById('leaveCourseName').textContent = name;
        document.getElementById('leaveModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeLeaveModal() {
        document.getElementById('leaveModal').classList.remove('active');
        document.body.style.overflow = '';
        pendingLeaveForm = null;
    }
    document.getElementById('confirmLeaveBtn').addEventListener('click', () => {
        if (pendingLeaveForm) pendingLeaveForm.submit();
    });
    document.getElementById('leaveModal').addEventListener('click', function(e) { if (e.target === this) closeLeaveModal(); });

    /* Logout modal */
    function openLogoutModal() { document.getElementById('logoutModal').classList.add('active'); document.body.style.overflow = 'hidden'; }
    function closeLogoutModal() { document.getElementById('logoutModal').classList.remove('active'); document.body.style.overflow = ''; }
    document.getElementById('logoutButton').addEventListener('click', function(e) { e.preventDefault(); openLogoutModal(); });
    document.getElementById('confirmLogoutBtn').addEventListener('click', () => { document.getElementById('logoutForm').submit(); });
    document.getElementById('logoutModal').addEventListener('click', function(e) { if (e.target === this) closeLogoutModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') { closeLeaveModal(); closeLogoutModal(); } });
</script>
</body>
</html>