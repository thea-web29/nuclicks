<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile – NU Horizon LMS</title>
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
            --orange:    #ea580c;
            --blue:      #3b82f6;
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

        /* ══ LAYOUT ══ */
        .profile-grid { display: grid; grid-template-columns: 320px 1fr; gap: 1.3rem; align-items: start; }

        /* ══ DASH CARD ══ */
        .dash-card { background: var(--white); border-radius: 14px; border: 1px solid var(--bdr); box-shadow: 0 2px 12px rgba(10,31,68,0.04); overflow: hidden; animation: fadeUp .5s var(--ease) both; }
        .dash-card-head { padding: 1rem 1.3rem .9rem; border-bottom: 1px solid var(--bdr); }
        .dash-card-title { font-size: .82rem; font-weight: 700; color: var(--txt-1); display: flex; align-items: center; gap: .5rem; }
        .dash-card-title i { color: var(--gold-d); font-size: .9rem; }
        .dash-card-body { padding: 1.3rem 1.4rem; }

        /* ══ PROFILE SIDEBAR CARD ══ */
        .profile-side-card { text-align: center; padding: 1.8rem 1.4rem; }

        /* Avatar */
        .avatar-wrap { position: relative; display: inline-block; margin-bottom: 1rem; }
        .avatar-img {
            width: 120px; height: 120px; border-radius: 16px;
            background: var(--navy-pale);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
            border: 3px solid var(--white);
            box-shadow: 0 4px 16px rgba(10,31,68,0.12);
        }
        .avatar-img img { width: 100%; height: 100%; object-fit: cover; }
        .avatar-img i { font-size: 3.5rem; color: var(--navy-lite); }
        .avatar-edit-btn {
            position: absolute; bottom: -6px; right: -6px;
            background: var(--white); border: 1px solid var(--bdr);
            border-radius: 8px; padding: .3rem .4rem;
            color: var(--navy-lite); font-size: .9rem;
            cursor: pointer; transition: all var(--t);
            box-shadow: 0 2px 8px rgba(10,31,68,0.10);
        }
        .avatar-edit-btn:hover { border-color: var(--gold-d); color: var(--gold-d); }

        .profile-fullname { font-family: 'Fraunces', serif; font-size: 1.15rem; font-weight: 700; color: var(--navy); line-height: 1.2; margin-bottom: .2rem; }
        .profile-email-text { font-size: .75rem; color: var(--txt-3); margin-bottom: .3rem; }
        .profile-role-pill { display: inline-flex; align-items: center; gap: .3rem; font-size: .62rem; font-weight: 700; padding: .18rem .6rem; border-radius: 99px; background: var(--navy-pale); color: var(--navy-mid); text-transform: uppercase; letter-spacing: .06em; margin-bottom: .6rem; }
        .profile-since { font-size: .68rem; color: var(--txt-3); }

        /* Quick stats */
        .quick-stats { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; margin-top: 1.2rem; padding-top: 1.2rem; border-top: 1px solid var(--bdr); }
        .quick-stat { border-radius: 10px; padding: .7rem .65rem; border: 1px solid var(--bdr); text-align: left; }
        .quick-stat-label { font-size: .62rem; color: var(--txt-3); font-weight: 600; text-transform: uppercase; letter-spacing: .04em; margin-bottom: .25rem; }
        .quick-stat-val { font-family: 'Fraunces', serif; font-size: 1.5rem; font-weight: 700; line-height: 1; }
        .quick-stat.navy   .quick-stat-val { color: var(--navy); }
        .quick-stat.green  .quick-stat-val { color: var(--green); }
        .quick-stat.purple .quick-stat-val { color: var(--purple); }
        .quick-stat.orange .quick-stat-val { color: var(--orange); }

        /* ══ FORM STYLES ══ */
        .form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-group { margin-bottom: 1rem; }
        .form-group:last-of-type { margin-bottom: 0; }
        .form-label { display: block; font-size: .75rem; font-weight: 700; color: var(--txt-2); margin-bottom: .4rem; }
        .form-label .req { color: var(--danger); }
        .form-input {
            width: 100%; padding: .62rem .9rem;
            border: 1px solid var(--bdr); border-radius: 9px;
            background: var(--bg); color: var(--txt-1);
            font-size: .82rem; font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all var(--t);
        }
        .form-input:focus { border-color: var(--gold-d); background: var(--white); box-shadow: 0 0 0 3px rgba(196,154,0,0.10); }
        .form-input::placeholder { color: var(--txt-3); }
        textarea.form-input { resize: vertical; min-height: 90px; }
        .form-hint { font-size: .65rem; color: var(--txt-3); margin-top: .3rem; }
        .form-footer { display: flex; justify-content: flex-end; margin-top: 1.2rem; }

        /* Buttons */
        .btn-save {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .58rem 1.3rem; border-radius: 9px; border: none;
            background: var(--navy); color: #fff;
            font-size: .8rem; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all var(--t);
            box-shadow: 0 2px 8px rgba(10,31,68,0.20);
        }
        .btn-save:hover { background: var(--navy-mid); transform: translateY(-1px); }
        .btn-password {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .58rem 1.3rem; border-radius: 9px; border: none;
            background: var(--gold-d); color: #fff;
            font-size: .8rem; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all var(--t);
            box-shadow: 0 2px 8px rgba(196,154,0,0.25);
        }
        .btn-password:hover { background: #A07D00; transform: translateY(-1px); }

        /* Right column stack */
        .right-col { display: flex; flex-direction: column; gap: 1.2rem; }

        /* ══ ACTIVITY ══ */
        .activity-item {
            display: flex; align-items: flex-start; gap: .75rem;
            padding: .8rem .9rem; border-radius: 10px;
            background: var(--bg); border: 1px solid var(--bdr);
            margin-bottom: .6rem; transition: all var(--t);
        }
        .activity-item:last-child { margin-bottom: 0; }
        .activity-item:hover { background: var(--white); border-color: rgba(10,31,68,0.14); }
        .activity-icon { font-size: 1rem; flex-shrink: 0; margin-top: .1rem; }
        .activity-icon.green  { color: var(--green); }
        .activity-icon.blue   { color: var(--blue); }
        .activity-icon.teal   { color: #0d9488; }
        .activity-icon.gray   { color: var(--txt-3); }
        .activity-desc { font-size: .78rem; color: var(--txt-2); line-height: 1.45; }
        .activity-time { font-size: .65rem; color: var(--txt-3); margin-top: .18rem; }
        .view-all-link {
            display: inline-flex; align-items: center; gap: .3rem;
            font-size: .75rem; font-weight: 700; color: var(--navy-lite);
            text-decoration: none; margin-top: .9rem;
            transition: color var(--t);
        }
        .view-all-link:hover { color: var(--navy); }

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

        @media (max-width: 1200px) { .profile-grid { grid-template-columns: 280px 1fr; } }
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay { display: block; }
            .main-content { margin-left: 0; }
            .menu-toggle { display: flex; }
            .profile-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            .page-body { padding: 1.2rem 1rem; }
            .topbar { padding: .8rem 1rem; }
            .form-grid-2 { grid-template-columns: 1fr; }
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
                    <i class="ri-user-settings-line"></i> Profile
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
                <div class="topbar-breadcrumb">Student → My Profile</div>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-badge"><span class="topbar-dot"></span> System Online</div>
            <div class="topbar-badge"><i class="ri-calendar-line"></i><span id="topbar-date"></span></div>
        </div>
    </header>

    <div class="page-body">

        <div class="section-header">
            <h2><i class="ri-user-settings-line" style="color:var(--gold-d);font-size:.85rem;"></i> My Profile</h2>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success"><i class="ri-checkbox-circle-line"></i> {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                <i class="ri-error-warning-line" style="flex-shrink:0;"></i>
                <ul style="list-style:none;padding:0;">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <div class="profile-grid">

            <!-- Profile sidebar card -->
            <div>
                <div class="dash-card">
                    <div class="profile-side-card">
                        <!-- Avatar -->
                        <div class="avatar-wrap">
                            <div class="avatar-img">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}">
                                @else
                                    <i class="ri-user-line"></i>
                                @endif
                            </div>
                            <button class="avatar-edit-btn" onclick="document.getElementById('avatarInput').click()">
                                <i class="ri-camera-line"></i>
                            </button>
                            <input type="file" id="avatarInput" accept="image/*" class="hidden" onchange="uploadAvatar(this)" style="display:none;">
                        </div>

                        <div class="profile-fullname">{{ $user->name }}</div>
                        <div class="profile-email-text">{{ $user->email }}</div>
                        <div class="profile-role-pill"><i class="ri-graduation-cap-line"></i> Student</div>
                        <div class="profile-since">Member since {{ $memberSince ?? '—' }}</div>

                        <!-- Quick stats -->
                        <div class="quick-stats">
                            <div class="quick-stat navy">
                                <div class="quick-stat-label">Courses</div>
                                <div class="quick-stat-val">{{ $enrolledCourses ?? 0 }}</div>
                            </div>
                            <div class="quick-stat green">
                                <div class="quick-stat-label">Quizzes</div>
                                <div class="quick-stat-val">{{ $quizzesTaken ?? 0 }}</div>
                            </div>
                            <div class="quick-stat purple">
                                <div class="quick-stat-label">Avg. Score</div>
                                <div class="quick-stat-val">{{ $averageScore ?? 0 }}%</div>
                            </div>
                            <div class="quick-stat orange">
                                <div class="quick-stat-label">Materials</div>
                                <div class="quick-stat-val">{{ $completedMaterials ?? 0 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right column -->
            <div class="right-col">

                <!-- Edit Profile -->
                <div class="dash-card">
                    <div class="dash-card-head">
                        <div class="dash-card-title"><i class="ri-user-line"></i> Edit Profile Information</div>
                    </div>
                    <div class="dash-card-body">
                        <form action="{{ route('student.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-grid-2" style="margin-bottom:1rem;">
                                <div class="form-group" style="margin-bottom:0;">
                                    <label class="form-label">Full Name <span class="req">*</span></label>
                                    <input type="text" name="name" required value="{{ old('name', $user->name) }}" class="form-input">
                                </div>
                                <div class="form-group" style="margin-bottom:0;">
                                    <label class="form-label">Email Address <span class="req">*</span></label>
                                    <input type="email" name="email" required value="{{ old('email', $user->email) }}" class="form-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="form-input" placeholder="+63 912 345 6789">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Bio / About Me</label>
                                <textarea name="bio" rows="3" class="form-input" placeholder="Tell us a little about yourself...">{{ old('bio', $user->bio ?? '') }}</textarea>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn-save">
                                    <i class="ri-save-line"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Change Password -->
                <div class="dash-card">
                    <div class="dash-card-head">
                        <div class="dash-card-title"><i class="ri-lock-line"></i> Change Password</div>
                    </div>
                    <div class="dash-card-body">
                        <form action="{{ route('student.password.change') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Current Password</label>
                                <input type="password" name="current_password" required class="form-input">
                            </div>
                            <div class="form-grid-2" style="margin-bottom:1rem;">
                                <div class="form-group" style="margin-bottom:0;">
                                    <label class="form-label">New Password</label>
                                    <input type="password" name="new_password" required class="form-input">
                                    <div class="form-hint">Minimum 8 characters</div>
                                </div>
                                <div class="form-group" style="margin-bottom:0;">
                                    <label class="form-label">Confirm New Password</label>
                                    <input type="password" name="new_password_confirmation" required class="form-input">
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn-password">
                                    <i class="ri-lock-password-line"></i> Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Recent Activity -->
                @if(isset($recentActivities) && $recentActivities->count() > 0)
                    <div class="dash-card">
                        <div class="dash-card-head">
                            <div class="dash-card-title"><i class="ri-history-line"></i> Recent Activity</div>
                        </div>
                        <div class="dash-card-body">
                            @foreach($recentActivities as $activity)
                                <div class="activity-item">
                                    @php
                                        $type = $activity->type ?? $activity->action ?? '';
                                        $iconClass = match($type) {
                                            'course_joined'      => 'ri-book-open-line green',
                                            'quiz_submitted'     => 'ri-quiz-line blue',
                                            'material_completed' => 'ri-check-double-line teal',
                                            default              => 'ri-information-line gray',
                                        };
                                        [$icon, $cls] = explode(' ', $iconClass . ' ');
                                    @endphp
                                    <i class="activity-icon {{ $cls }} {{ $icon }}"></i>
                                    <div>
                                        <div class="activity-desc">{{ $activity->description ?? $activity->activity }}</div>
                                        <div class="activity-time">{{ $activity->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            @endforeach
                            <a href="{{ route('student.notifications') }}" class="view-all-link">
                                View all activity in Notifications <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </div>
                    </div>
                @endif

            </div><!-- /right-col -->
        </div><!-- /profile-grid -->

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

    /* Avatar upload — logic unchanged */
    function uploadAvatar(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            if (!file.type.match('image.*')) { alert('Please select an image file only.'); return; }
            if (file.size > 2 * 1024 * 1024) { alert('File size must be less than 2MB'); return; }
            const formData = new FormData();
            formData.append('avatar', file);
            formData.append('_token', '{{ csrf_token() }}');
            const btn = document.querySelector('.avatar-edit-btn');
            const original = btn.innerHTML;
            btn.innerHTML = '<i class="ri-loader-4-line"></i>';
            btn.disabled = true;
            fetch('{{ route('student.avatar.update') }}', {
                method: 'POST', body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) { location.reload(); }
                else { alert(data.message || 'Failed to upload avatar'); btn.innerHTML = original; btn.disabled = false; }
            })
            .catch(() => { alert('Error uploading avatar'); btn.innerHTML = original; btn.disabled = false; });
        }
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