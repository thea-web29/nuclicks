<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>System Settings – NU Horizon LMS</title>

    <!-- Fonts & Icons (dashboard style) -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

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

        /* Dashboard cards */
        .dash-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            overflow: hidden;
            transition: all var(--t);
            margin-bottom: 1.5rem;
        }
        .dash-card-head {
            padding: 1rem 1.3rem;
            border-bottom: 1px solid var(--bdr);
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .dash-card-head i { color: var(--gold-d); font-size: 0.9rem; }
        .dash-card-head h3 {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--txt-1);
            margin: 0;
        }
        .dash-card-body {
            padding: 1.3rem;
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
        .form-input, .form-select {
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
        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: var(--gold-d);
            box-shadow: 0 0 0 3px rgba(196,154,0,0.1);
        }
        .form-hint {
            font-size: 0.68rem;
            color: var(--txt-3);
            margin-top: 0.3rem;
        }
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        @media (max-width: 640px) {
            .grid-2 { grid-template-columns: 1fr; }
        }

        /* Grade scale inline row */
        .grade-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        .grade-input {
            padding: 0.4rem 0.6rem;
            border-radius: 8px;
            border: 1px solid var(--bdr);
            font-size: 0.75rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-icon {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--txt-3);
            font-size: 1rem;
            transition: var(--t);
        }
        .btn-icon:hover { color: var(--danger); }
        .btn-add {
            background: none;
            border: 1px dashed var(--bdr);
            padding: 0.4rem 1rem;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--navy);
            cursor: pointer;
            transition: var(--t);
        }
        .btn-add:hover { background: var(--bg); border-color: var(--gold-d); }

        /* File type pills */
        .file-types-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 0.8rem;
        }
        .file-type-pill {
            background: var(--white);
            border: 1px solid var(--bdr);
            border-radius: 40px;
            padding: 0.25rem 0.7rem;
            font-size: 0.7rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }
        .file-type-pill button {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--txt-3);
            font-size: 0.8rem;
        }
        .file-type-pill button:hover { color: var(--danger); }

        /* Save button */
        .btn-primary {
            background: var(--navy);
            border: none;
            padding: 0.7rem 1.5rem;
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

        /* Modal (logout) */
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
            width: min(400px, 94vw);
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
            font-size: 1.05rem;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .modal-head h3 i { color: var(--gold); }
        .modal-close {
            background: none;
            border: none;
            color: rgba(255,255,255,0.55);
            font-size: 1.3rem;
            cursor: pointer;
            transition: color var(--t);
        }
        .modal-close:hover { color: var(--gold); }
        .modal-body {
            padding: 1.8rem 1.5rem;
            text-align: center;
        }
        .modal-body p { font-size: .88rem; color: var(--txt-2); line-height: 1.5; }
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
            color: var(--txt-2);
            cursor: pointer;
            transition: all var(--t);
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
            transition: all var(--t);
        }
        .btn-confirm:hover { background: var(--danger-d); }

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
            .page-body { padding: 1.2rem 1rem; }
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
                <a href="{{ route('admin.subjects') }}" class="nav-item {{ request()->routeIs('admin.subjects*') || request()->routeIs('admin.courses*') ? 'active' : '' }}">
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
                <a href="{{ route('admin.settings') }}" class="nav-item active">
                    <i class="ri-settings-line"></i> Settings
                </a>
            </div>
        </div>
        <div class="sidebar-footer">
            <div class="profile-row">
                <div class="avatar"><i class="ri-user-line"></i></div>
                <div>
                    <div class="profile-name">{{ Auth::user()->name ?? 'Admin User' }}</div>
                    <div class="profile-email">{{ Auth::user()->email ?? 'admin@nu.edu.ph' }}</div>
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
                <div class="topbar-breadcrumb">Admin → System Settings</div>
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

    <div class="page-body">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="ri-checkbox-circle-line"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            <!-- Grading Settings -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <i class="ri-graduation-cap-line"></i>
                    <h3>Grading System</h3>
                </div>
                <div class="dash-card-body">
                    <div class="grid-2">
                        @foreach($gradingSettings as $setting)
                            <div class="form-group">
                                <label class="form-label">{{ ucwords(str_replace('_', ' ', $setting->key)) }}</label>
                                @if($setting->type === 'boolean')
                                    <select name="{{ $setting->key }}" class="form-select">
                                        <option value="1" {{ $setting->value == 'true' ? 'selected' : '' }}>Enabled</option>
                                        <option value="0" {{ $setting->value == 'false' ? 'selected' : '' }}>Disabled</option>
                                    </select>
                                @elseif($setting->type === 'json' && $setting->key === 'grade_scale')
                                    <div id="gradeScaleContainer">
                                        @php $grades = json_decode($setting->value, true); @endphp
                                        @foreach($grades as $index => $grade)
                                            <div class="grade-row">
                                                <input type="number" name="grade_scale[{{ $index }}][min]" value="{{ $grade['min'] ?? '' }}" placeholder="Min" class="grade-input" style="width: 70px;">
<input type="number" name="grade_scale[{{ $index }}][max]" value="{{ $grade['max'] ?? '' }}" placeholder="Max" class="grade-input" style="width: 70px;">
<input type="text" name="grade_scale[{{ $index }}][grade]" value="{{ $grade['grade'] ?? '' }}" placeholder="Grade" class="grade-input" style="width: 80px;">
<input type="text" name="grade_scale[{{ $index }}][description]" value="{{ $grade['description'] ?? '' }}" placeholder="Description" class="grade-input" style="flex: 1; min-width: 120px;">
                                                <button type="button" onclick="this.closest('.grade-row').remove()" class="btn-icon"><i class="ri-close-line"></i></button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" onclick="addGradeLevel()" class="btn-add"><i class="ri-add-line"></i> Add Grade Level</button>
                                @else
                                    <input type="{{ $setting->type === 'number' ? 'number' : 'text' }}" name="{{ $setting->key }}" value="{{ $setting->value }}" class="form-input">
                                @endif
                                <div class="form-hint">{{ $setting->description }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Quiz Settings -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <i class="ri-quiz-line"></i>
                    <h3>Quiz Rules</h3>
                </div>
                <div class="dash-card-body">
                    <div class="grid-2">
                        @foreach($quizSettings as $setting)
                            <div class="form-group">
                                <label class="form-label">{{ ucwords(str_replace('_', ' ', $setting->key)) }}</label>
                                @if($setting->type === 'boolean')
                                    <select name="{{ $setting->key }}" class="form-select">
                                        <option value="1" {{ $setting->value == 'true' ? 'selected' : '' }}>Enabled</option>
                                        <option value="0" {{ $setting->value == 'false' ? 'selected' : '' }}>Disabled</option>
                                    </select>
                                @elseif($setting->key === 'show_correct_answers_after')
                                    <select name="{{ $setting->key }}" class="form-select">
                                        <option value="immediate" {{ $setting->value == 'immediate' ? 'selected' : '' }}>Immediately after submission</option>
                                        <option value="after_end" {{ $setting->value == 'after_end' ? 'selected' : '' }}>After quiz end date</option>
                                        <option value="manual" {{ $setting->value == 'manual' ? 'selected' : '' }}>Manual (faculty grades)</option>
                                    </select>
                                @else
                                    <input type="{{ $setting->type === 'number' ? 'number' : 'text' }}" name="{{ $setting->key }}" value="{{ $setting->value }}" class="form-input">
                                @endif
                                <div class="form-hint">{{ $setting->description }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Academic Settings -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <i class="ri-calendar-line"></i>
                    <h3>Academic Settings</h3>
                </div>
                <div class="dash-card-body">
                    <div class="grid-2">
                        @foreach($academicSettings as $setting)
                            <div class="form-group">
                                <label class="form-label">{{ ucwords(str_replace('_', ' ', $setting->key)) }}</label>
                                @if($setting->type === 'boolean')
                                    <select name="{{ $setting->key }}" class="form-select">
                                        <option value="1" {{ $setting->value == 'true' ? 'selected' : '' }}>Enabled</option>
                                        <option value="0" {{ $setting->value == 'false' ? 'selected' : '' }}>Disabled</option>
                                    </select>
                                @elseif(in_array($setting->key, ['semester_start_date', 'semester_end_date']))
                                    <input type="date" name="{{ $setting->key }}" value="{{ $setting->value }}" class="form-input">
                                @else
                                    <input type="{{ $setting->type === 'number' ? 'number' : 'text' }}" name="{{ $setting->key }}" value="{{ $setting->value }}" class="form-input">
                                @endif
                                <div class="form-hint">{{ $setting->description }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- File Upload Settings -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <i class="ri-file-upload-line"></i>
                    <h3>File Upload Settings</h3>
                </div>
                <div class="dash-card-body">
                    <div class="grid-2">
                        @foreach($fileSettings as $setting)
                            <div class="form-group">
                                <label class="form-label">{{ ucwords(str_replace('_', ' ', $setting->key)) }}</label>
                                @if($setting->type === 'json' && $setting->key === 'allowed_file_types')
                                    <div style="border: 1px solid var(--bdr); border-radius: 12px; padding: 0.8rem;">
                                        <div id="fileTypesContainer" class="file-types-container">
                                            @php $types = json_decode($setting->value, true); @endphp
                                            @foreach($types as $type)
                                                <span class="file-type-pill">
                                                    {{ $type }}
                                                    <button type="button" onclick="removeFileType(this)">&times;</button>
                                                    <input type="hidden" name="allowed_file_types[]" value="{{ $type }}">
                                                </span>
                                            @endforeach
                                        </div>
                                        <div style="display: flex; gap: 0.5rem;">
                                            <input type="text" id="newFileType" placeholder="e.g., pdf, jpg, doc" class="form-input" style="flex: 1;">
                                            <button type="button" onclick="addFileType()" class="btn-primary" style="padding: 0.5rem 1rem;">Add</button>
                                        </div>
                                    </div>
                                @else
                                    <input type="{{ $setting->type === 'number' ? 'number' : 'text' }}" name="{{ $setting->key }}" value="{{ $setting->value }}" class="form-input">
                                @endif
                                <div class="form-hint">{{ $setting->description }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end;">
                <button type="submit" class="btn-primary"><i class="ri-save-line"></i> Save All Settings</button>
            </div>
        </form>
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
            <p style="font-size:0.7rem; margin-top:0.5rem;">You will be redirected to the login page.</p>
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
    // Date
    const d = new Date();
    document.getElementById('topbar-date').textContent = d.toLocaleDateString('en-PH', { month: 'short', day: 'numeric', year: 'numeric' });

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

    // Active nav highlight
    const currentUrl = window.location.pathname;
    document.querySelectorAll('.nav-item').forEach(item => {
        const href = item.getAttribute('href');
        if (href && currentUrl.includes(href) && href !== '/admin/dashboard') {
            item.classList.add('active');
        } else if (currentUrl === '/admin/dashboard' && href === '/admin/dashboard') {
            item.classList.add('active');
        }
    });

    // Grade scale dynamic add
    let gradeCount = {{ count(json_decode($gradingSettings->where('key', 'grade_scale')->first()->value ?? '[]', true)) }};
    function addGradeLevel() {
        const container = document.getElementById('gradeScaleContainer');
        const div = document.createElement('div');
        div.className = 'grade-row';
        div.innerHTML = `
            <input type="number" name="grade_scale[${gradeCount}][min]" placeholder="Min" class="grade-input" style="width: 70px;">
            <input type="number" name="grade_scale[${gradeCount}][max]" placeholder="Max" class="grade-input" style="width: 70px;">
            <input type="text" name="grade_scale[${gradeCount}][grade]" placeholder="Grade" class="grade-input" style="width: 80px;">
            <input type="text" name="grade_scale[${gradeCount}][description]" placeholder="Description" class="grade-input" style="flex: 1; min-width: 120px;">
            <button type="button" onclick="this.closest('.grade-row').remove()" class="btn-icon"><i class="ri-close-line"></i></button>
        `;
        container.appendChild(div);
        gradeCount++;
    }

    // File types dynamic add/remove
    function addFileType() {
        const input = document.getElementById('newFileType');
        const type = input.value.trim().toLowerCase();
        if (!type) return;

        const container = document.getElementById('fileTypesContainer');
        const span = document.createElement('span');
        span.className = 'file-type-pill';
        span.innerHTML = `
            ${type}
            <button type="button" onclick="removeFileType(this)">&times;</button>
            <input type="hidden" name="allowed_file_types[]" value="${type}">
        `;
        container.appendChild(span);
        input.value = '';
    }

    function removeFileType(btn) {
        btn.closest('.file-type-pill').remove();
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
    document.getElementById('logoutModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeLogoutModal();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLogoutModal();
    });
</script>
</body>
</html>