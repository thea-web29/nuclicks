<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Account Creation – NU Horizon LMS</title>
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

        .sidebar-footer { padding: 1rem 1.2rem; border-top: 1px solid rgba(255,215,15,0.14); }
        .profile-row { display: flex; align-items: center; gap: .75rem; margin-bottom: .85rem; cursor: pointer; }
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
        .back-btn { display: inline-flex; align-items: center; gap: .4rem; padding: .42rem .9rem; border-radius: 8px; border: 1px solid var(--bdr); background: var(--white); color: var(--txt-2); font-size: .75rem; font-weight: 600; font-family: 'Plus Jakarta Sans', sans-serif; text-decoration: none; transition: all var(--t); }
        .back-btn:hover { border-color: var(--gold-d); color: var(--navy); }

        /* ══ PAGE BODY ══ */
        .page-body { padding: 1.8rem 2rem; flex: 1; }
        .form-container { max-width: 900px; margin: 0 auto; }

        /* ══ ALERTS ══ */
        .alert { padding: .75rem 1rem; border-radius: 10px; margin-bottom: 1.2rem; display: flex; align-items: flex-start; gap: .6rem; font-size: .78rem; font-weight: 500; }
        .alert-success { background: rgba(22,163,74,0.08); border-left: 3px solid var(--green); color: #14532d; }
        .alert-error   { background: rgba(220,38,38,0.06); border-left: 3px solid var(--danger); color: #7f1a1a; }
        .alert-warning { background: rgba(245,158,11,0.08); border-left: 3px solid #f59e0b; color: #92400e; }
        .alert ul { margin-top: .3rem; margin-left: 1rem; }

        /* ══ TABS ══ */
        .tabs-container { display: flex; gap: .4rem; background: var(--white); border: 1px solid var(--bdr); border-radius: 60px; width: fit-content; padding: .25rem; margin-bottom: 1.6rem; }
        .tab-btn { padding: .52rem 1.5rem; border-radius: 40px; font-weight: 600; font-size: .75rem; border: none; background: transparent; cursor: pointer; transition: all var(--t); color: var(--txt-3); font-family: 'Plus Jakarta Sans', sans-serif; }
        .tab-btn i { margin-right: 5px; font-size: .82rem; vertical-align: middle; }
        .tab-btn.active-tab { background: var(--navy); color: #fff; box-shadow: 0 2px 8px rgba(10,31,68,0.12); }

        /* ══ DASH CARD ══ */
        .dash-card { background: var(--white); border-radius: 14px; border: 1px solid var(--bdr); box-shadow: 0 2px 12px rgba(10,31,68,0.04); overflow: hidden; }
        .dash-card-head { padding: 1rem 1.3rem .9rem; border-bottom: 1px solid var(--bdr); display: flex; align-items: center; gap: .55rem; }
        .dash-card-head i { color: var(--gold-d); font-size: .9rem; }
        .dash-card-head h3 { font-size: .82rem; font-weight: 700; color: var(--txt-1); margin: 0; }
        .dash-card-body { padding: 1.3rem 1.4rem; }

        /* ══ FORM ══ */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-group { margin-bottom: 1rem; }
        .form-group:last-child { margin-bottom: 0; }
        .form-label { font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: var(--txt-3); display: block; margin-bottom: .38rem; }
        .form-label .required { color: var(--danger); margin-left: .18rem; }
        .form-input, .form-select {
            width: 100%; padding: .62rem 1rem; border-radius: 9px; border: 1px solid var(--bdr);
            font-family: 'Plus Jakarta Sans', sans-serif; font-size: .8rem;
            color: var(--txt-1); background: var(--bg); transition: all var(--t);
        }
        .form-input:focus, .form-select:focus { border-color: var(--gold-d); background: var(--white); box-shadow: 0 0 0 3px rgba(196,154,0,0.10); }
        .form-input::placeholder { color: var(--txt-3); }
        .form-hint { font-size: .68rem; color: var(--txt-3); margin-top: .28rem; }

        /* Info box */
        .info-box { background: var(--navy-pale); border-left: 3px solid var(--gold-d); border-radius: 10px; padding: .7rem 1rem; font-size: .75rem; color: var(--txt-2); display: flex; align-items: flex-start; gap: .55rem; margin-bottom: 1rem; }
        .info-box i { color: var(--gold-d); font-size: .95rem; margin-top: .08rem; flex-shrink: 0; }

        /* Error box */
        .error-box { background: rgba(220,38,38,0.06); border-left: 3px solid var(--danger); border-radius: 10px; padding: .8rem 1rem; margin-bottom: 1.2rem; }
        .error-list { list-style: none; font-size: .75rem; color: var(--danger); }
        .error-list li { margin-bottom: .22rem; display: flex; align-items: center; gap: .45rem; }

        /* Form actions footer */
        .form-actions { display: flex; justify-content: flex-end; gap: .75rem; padding: 1rem 1.4rem; background: var(--bg); border-top: 1px solid var(--bdr); }
        .btn-primary { background: var(--navy); border: none; padding: .58rem 1.2rem; border-radius: 8px; font-weight: 700; font-size: .78rem; color: #fff; display: inline-flex; align-items: center; gap: .45rem; cursor: pointer; transition: all var(--t); font-family: 'Plus Jakarta Sans', sans-serif; box-shadow: 0 2px 8px rgba(10,31,68,0.18); }
        .btn-primary:hover { background: var(--navy-mid); transform: translateY(-1px); }
        .btn-secondary { background: transparent; border: 1px solid var(--bdr); padding: .58rem 1.2rem; border-radius: 8px; font-weight: 600; font-size: .78rem; color: var(--txt-2); cursor: pointer; transition: all var(--t); text-decoration: none; display: inline-flex; align-items: center; gap: .4rem; font-family: 'Plus Jakarta Sans', sans-serif; }
        .btn-secondary:hover { background: var(--white); border-color: var(--gold-d); color: var(--navy); }

        /* Bulk layout */
        .bulk-grid { display: grid; grid-template-columns: 1fr .9fr; gap: 1.3rem; }
        .radio-group { display: flex; gap: .85rem; margin-top: .5rem; }
        .radio-card { flex: 1; border: 1px solid var(--bdr); border-radius: 10px; padding: .75rem; cursor: pointer; transition: all var(--t); font-size: .78rem; }
        .radio-card.active-radio { border-color: var(--gold-d); background: var(--gold-pale); }
        .radio-card input { margin-right: .45rem; }

        /* CSV format cards */
        .csv-card { border: 1px solid var(--bdr); border-radius: 12px; padding: 1rem; }
        .csv-card h4 { font-size: .8rem; font-weight: 700; color: var(--navy); margin-bottom: .5rem; }
        code { display: block; background: var(--bg); padding: .45rem .7rem; border-radius: 7px; font-size: .68rem; font-family: 'Courier New', monospace; color: var(--txt-2); margin-bottom: .35rem; }

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
        .hidden { display: none !important; }

        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay { display: block; }
            .main-content { margin-left: 0; }
            .menu-toggle { display: flex; }
            .bulk-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            .form-grid { grid-template-columns: 1fr; }
            .page-body { padding: 1.2rem 1rem; }
            .topbar { padding: .8rem 1rem; }
            .tabs-container { flex-direction: column; border-radius: 12px; }
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
                <p>Admin Portal · National University</p>
            </div>
        </div>

        <div class="nav-body">
            <div>
                <div class="nav-section-label">Main</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>
                <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="ri-team-line"></i> Users
                </a>
                <a href="{{ route('admin.users.create') }}" class="nav-item {{ request()->routeIs('admin.users.create') ? 'active' : '' }}">
                    <i class="ri-user-add-line"></i> Account Creation
                </a>
                <a href="{{ route('admin.faculty') }}" class="nav-item {{ request()->routeIs('admin.faculty*') ? 'active' : '' }}">
                    <i class="ri-user-star-line"></i> Faculty
                </a>
            </div>
            <div>
                <div class="nav-section-label">Academic</div>
                <a href="{{ route('admin.programs') }}" class="nav-item {{ request()->routeIs('admin.programs*') ? 'active' : '' }}">
                    <i class="ri-graduation-cap-line"></i> Programs
                </a>
                <a href="{{ route('admin.departments') }}" class="nav-item {{ request()->routeIs('admin.departments*') ? 'active' : '' }}">
                    <i class="ri-building-2-line"></i> Departments
                </a>
                <a href="{{ route('admin.subjects') }}" class="nav-item {{ request()->routeIs('admin.subjects*') ? 'active' : '' }}">
                    <i class="ri-book-open-line"></i> Subjects
                </a>
            </div>
            <div>
                <div class="nav-section-label">Assessment</div>
                <a href="{{ route('admin.analytics') }}" class="nav-item {{ request()->routeIs('admin.analytics*') ? 'active' : '' }}">
                    <i class="ri-bar-chart-line"></i> Analytics
                </a>
                <a href="{{ route('admin.logs') }}" class="nav-item {{ request()->routeIs('admin.logs*') ? 'active' : '' }}">
                    <i class="ri-history-line"></i> Activity Logs
                </a>
                <a href="{{ route('admin.settings') }}" class="nav-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                    <i class="ri-settings-line"></i> Settings
                </a>
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
<div class="main-content">
    <header class="topbar">
        <div class="topbar-left">
            <button class="menu-toggle" id="menuToggle" onclick="toggleSidebar()">
                <i class="ri-menu-2-line"></i>
            </button>
            <div>
                <div class="topbar-title">NU Horizon <em>LMS</em></div>
                <div class="topbar-breadcrumb">Admin → Account Creation</div>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-badge"><span class="topbar-dot"></span> System Online</div>
            <div class="topbar-badge"><i class="ri-calendar-line"></i><span id="topbar-date"></span></div>
            <a href="{{ route('admin.users') }}" class="back-btn"><i class="ri-arrow-left-line"></i> Back to Users</a>
        </div>
    </header>

    <div class="page-body">
        <div class="form-container">

            <!-- Flash messages -->
            @if(session('success'))
                <div class="alert alert-success"><i class="ri-checkbox-circle-line"></i> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error"><i class="ri-error-warning-line"></i> {{ session('error') }}</div>
            @endif
            @if(session('import_errors') && count(session('import_errors')))
                <div class="alert alert-warning">
                    <i class="ri-alert-line"></i>
                    <div>
                        <strong>Some rows were skipped:</strong>
                        <ul style="margin-top:.3rem;margin-left:1rem;">
                            @foreach(session('import_errors') as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Tabs -->
            <div class="tabs-container">
                <button class="tab-btn active-tab" id="tab-single" onclick="switchTab('single')">
                    <i class="ri-user-add-line"></i> Create Individual Account
                </button>
                <button class="tab-btn" id="tab-bulk" onclick="switchTab('bulk')">
                    <i class="ri-upload-cloud-line"></i> Bulk Import
                </button>
            </div>

            <!-- ══ TAB: SINGLE ACCOUNT ══ -->
            <div id="panel-single" class="tab-content">
                @if($errors->any())
                    <div class="error-box">
                        <ul class="error-list">
                            @foreach($errors->all() as $error)
                                <li><i class="ri-error-warning-line"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="dash-card">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="dash-card-body">

                            <!-- Role + Status -->
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Role <span class="required">*</span></label>
                                    <select name="role" id="role" required class="form-select">
                                        <option value="student" {{ old('role','student') == 'student' ? 'selected' : '' }}>Student</option>
                                        <option value="faculty"  {{ old('role') == 'faculty'  ? 'selected' : '' }}>Faculty</option>
                                        <option value="admin"    {{ old('role') == 'admin'    ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="active" selected>Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Name + Email -->
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Full Name <span class="required">*</span></label>
                                    <input type="text" name="name" required value="{{ old('name') }}" class="form-input" placeholder="e.g. Juan Dela Cruz">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email Address <span class="required">*</span></label>
                                    <input type="email" name="email" required value="{{ old('email') }}" class="form-input" placeholder="juan@nu.edu.ph">
                                </div>
                            </div>

                            <!-- STUDENT FIELDS -->
                            <div id="studentFields">
                                <div class="info-box">
                                    <i class="ri-information-line"></i>
                                    <span><strong>No password needed.</strong> Initial password = <strong>Student ID</strong>. Student must change it on first login via OTP email.</span>
                                </div>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">Student ID <span class="required">*</span></label>
                                        <input type="text" name="student_id" value="{{ old('student_id') }}" class="form-input" placeholder="e.g. 2024-0001">
                                        <div class="form-hint">This will be the initial password.</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Year Level</label>
                                        <select name="year_level" class="form-select">
                                            <option value="">Select Year</option>
                                            @for($i = 1; $i <= 6; $i++)
                                                <option value="{{ $i }}" {{ old('year_level') == $i ? 'selected' : '' }}>
                                                    {{ $i }}{{ $i==1?'st':($i==2?'nd':($i==3?'rd':'th')) }} Year
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Program <span class="required">*</span></label>
                                    <select name="program_id" class="form-select">
                                        <option value="">-- Select Program --</option>
                                        @foreach($programs as $program)
                                            <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                                {{ $program->code }} – {{ $program->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if($programs->isEmpty())
                                        <div class="form-hint" style="color:var(--danger);">No programs yet. <a href="{{ route('admin.programs') }}" style="color:var(--navy);">Create one first.</a></div>
                                    @endif
                                    <div class="form-hint">Section is assigned when student enters a join code from their faculty.</div>
                                </div>
                            </div>

                            <!-- FACULTY FIELDS -->
                            <div id="facultyFields" class="hidden">
                                <div class="info-box">
                                    <i class="ri-information-line"></i>
                                    <span><strong>No password needed.</strong> Initial password = <strong>Faculty ID</strong>. Faculty must change it on first login via OTP email.</span>
                                </div>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">Faculty ID <span class="required">*</span></label>
                                        <input type="text" name="faculty_id" value="{{ old('faculty_id') }}" class="form-input" placeholder="e.g. FAC-001">
                                        <div class="form-hint">This will be the initial password.</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Department <span style="font-weight:400;text-transform:none;">(optional)</span></label>
                                        <select name="department_id" class="form-select">
                                            <option value="">-- Select Department (optional) --</option>
                                            @foreach($departments ?? [] as $dept)
                                                <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->code }} – {{ $dept->name }}</option>
                                            @endforeach
                                        </select>
                                        @if(isset($departments) && $departments->isEmpty())
                                            <div class="form-hint">No departments yet. <a href="{{ route('admin.departments') }}" style="color:var(--navy);">Create one.</a></div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">Specialization <span style="font-weight:400;text-transform:none;">(optional)</span></label>
                                        <input type="text" name="specialization" value="{{ old('specialization') }}" class="form-input" placeholder="e.g. Software Engineering">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Qualification <span style="font-weight:400;text-transform:none;">(optional)</span></label>
                                        <input type="text" name="qualification" value="{{ old('qualification') }}" class="form-input" placeholder="e.g. Master's in CS">
                                    </div>
                                </div>
                                <div class="form-hint"><i class="ri-information-line"></i> Assign subjects after creation via <a href="{{ route('admin.faculty') }}" style="color:var(--navy);">Faculty Management</a>.</div>
                            </div>

                            <!-- ADMIN FIELDS -->
                            <div id="adminFields" class="hidden">
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">Password <span class="required">*</span></label>
                                        <input type="password" name="password" class="form-input">
                                        <div class="form-hint">Minimum 8 characters</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Confirm Password <span class="required">*</span></label>
                                        <input type="password" name="password_confirmation" class="form-input">
                                    </div>
                                </div>
                            </div>

                        </div><!-- /dash-card-body -->
                        <div class="form-actions">
                            <a href="{{ route('admin.users') }}" class="btn-secondary">Cancel</a>
                            <button type="submit" class="btn-primary"><i class="ri-save-line"></i> Create Account</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ══ TAB: BULK IMPORT ══ -->
            <div id="panel-bulk" class="tab-content hidden">
                <div class="bulk-grid">

                    <!-- Upload form -->
                    <div class="dash-card">
                        <div class="dash-card-head"><i class="ri-upload-cloud-line"></i><h3>Upload CSV File</h3></div>
                        <div class="dash-card-body">
                            <form method="POST" action="{{ route('admin.bulk-import.process') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Account Type</label>
                                    <div class="radio-group">
                                        <label class="radio-card active-radio" id="radio-students-card">
                                            <input type="radio" name="type" value="students" checked> Students
                                            <div class="form-hint">Initial password = Student ID</div>
                                        </label>
                                        <label class="radio-card" id="radio-faculty-card">
                                            <input type="radio" name="type" value="faculty"> Faculty
                                            <div class="form-hint">Initial password = Faculty ID</div>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">CSV File</label>
                                    <input type="file" name="file" accept=".csv,.txt" required class="form-input">
                                    <div class="form-hint">Accepted: .csv or .txt</div>
                                </div>
                                <button type="submit" class="btn-primary" style="width:100%;justify-content:center;">
                                    <i class="ri-upload-cloud-line"></i> Import Accounts
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Templates + notes -->
                    <div style="display:flex;flex-direction:column;gap:1rem;">
                        <div class="dash-card">
                            <div class="dash-card-head"><i class="ri-download-line"></i><h3>Download Templates</h3></div>
                            <div class="dash-card-body" style="display:flex;flex-direction:column;gap:.5rem;">
                                <a href="{{ route('admin.bulk-import.template', ['type' => 'students']) }}" class="btn-primary" style="background:var(--navy-lite);justify-content:center;">
                                    <i class="ri-download-line"></i> Students Template
                                </a>
                                <a href="{{ route('admin.bulk-import.template', ['type' => 'faculty']) }}" class="btn-primary" style="background:var(--navy-mid);justify-content:center;">
                                    <i class="ri-download-line"></i> Faculty Template
                                </a>
                            </div>
                        </div>
                        <div class="dash-card">
                            <div class="dash-card-head"><i class="ri-information-line"></i><h3>Important Notes</h3></div>
                            <div class="dash-card-body">
                                <ul style="list-style:disc;margin-left:1.1rem;display:flex;flex-direction:column;gap:.35rem;font-size:.75rem;color:var(--txt-2);">
                                    <li>Do not add password columns</li>
                                    <li>Students use Student ID as initial password</li>
                                    <li>Faculty use Faculty ID as initial password</li>
                                    <li>Users must change password on first login</li>
                                    <li>Program code must exist in Programs table</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- CSV Format Guide -->
                <div class="dash-card" style="margin-top:1.3rem;">
                    <div class="dash-card-head"><i class="ri-file-copy-line"></i><h3>CSV Format Guide</h3></div>
                    <div class="dash-card-body">
                        <div class="form-grid">
                            <div class="csv-card">
                                <h4>Students CSV</h4>
                                <code>name,email,student_id,year_level,section,program_code</code>
                                <div class="form-hint">Example:</div>
                                <code>Juan Dela Cruz,juan@nu.edu,2024-0001,1,A,BSCS</code>
                            </div>
                            <div class="csv-card">
                                <h4>Faculty CSV</h4>
                                <code>name,email,faculty_id,department,specialization</code>
                                <div class="form-hint">Example:</div>
                                <code>Maria Santos,maria@nu.edu,FAC-001,CCS,Software Engineering</code>
                            </div>
                        </div>
                    </div>
                </div>
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

    /* Role field toggle */
    const roleSelect = document.getElementById('role');
    const studentDiv = document.getElementById('studentFields');
    const facultyDiv = document.getElementById('facultyFields');
    const adminDiv   = document.getElementById('adminFields');
    function toggleRoleFields() {
        const role = roleSelect.value;
        studentDiv.classList.toggle('hidden', role !== 'student');
        facultyDiv.classList.toggle('hidden', role !== 'faculty');
        adminDiv.classList.toggle('hidden',   role !== 'admin');
    }
    roleSelect.addEventListener('change', toggleRoleFields);
    toggleRoleFields();

    /* Tab switching */
    function switchTab(tab) {
        document.getElementById('panel-single').classList.toggle('hidden', tab !== 'single');
        document.getElementById('panel-bulk').classList.toggle('hidden',  tab !== 'bulk');
        document.getElementById('tab-single').classList.toggle('active-tab', tab === 'single');
        document.getElementById('tab-bulk').classList.toggle('active-tab',   tab === 'bulk');
    }
    @if(session('tab') === 'bulk') switchTab('bulk'); @endif

    /* Radio card styling */
    const radioStudents = document.querySelector('input[name="type"][value="students"]');
    const radioFaculty  = document.querySelector('input[name="type"][value="faculty"]');
    const cardStudents  = document.getElementById('radio-students-card');
    const cardFaculty   = document.getElementById('radio-faculty-card');
    function updateRadioCards() {
        if (!radioStudents || !cardStudents) return;
        cardStudents.classList.toggle('active-radio', radioStudents.checked);
        if (cardFaculty) cardFaculty.classList.toggle('active-radio', radioFaculty?.checked);
    }
    radioStudents?.addEventListener('change', updateRadioCards);
    radioFaculty?.addEventListener('change', updateRadioCards);
    updateRadioCards();

    /* Logout modal */
    function openLogoutModal() { document.getElementById('logoutModal').classList.add('active'); document.body.style.overflow = 'hidden'; }
    function closeLogoutModal() { document.getElementById('logoutModal').classList.remove('active'); document.body.style.overflow = ''; }
    document.getElementById('logoutButton').addEventListener('click', function(e) { e.preventDefault(); openLogoutModal(); });
    document.getElementById('confirmLogoutBtn').addEventListener('click', () => { document.getElementById('logoutForm').submit(); });
    document.getElementById('logoutModal').addEventListener('click', function(e) { if (e.target === this) closeLogoutModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLogoutModal(); });
</script>
</body>
</html>
