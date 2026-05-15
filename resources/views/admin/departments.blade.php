<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Department Management – NU Horizon LMS</title>

    <!-- Fonts + Icons (dashboard style) -->
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

        /* Dashboard card & table */
        .dash-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            overflow: hidden;
        }
        .dash-card-head {
            padding: 1rem 1.3rem;
            border-bottom: 1px solid var(--bdr);
            display: flex;
            align-items: center;
            justify-content: space-between;
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

        .department-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.8rem;
        }
        .department-table th {
            text-align: left;
            padding: 0.9rem 1rem;
            background: #FCFAF7;
            border-bottom: 1px solid var(--bdr);
            font-weight: 700;
            color: var(--txt-2);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .department-table td {
            padding: 0.9rem 1rem;
            border-bottom: 1px solid var(--bdr);
            color: var(--txt-2);
            vertical-align: middle;
        }
        .department-table tr:last-child td { border-bottom: none; }
        .department-table tr:hover td { background: rgba(10,31,68,0.02); }

        .badge-code {
            display: inline-flex;
            align-items: center;
            padding: 0.2rem 0.7rem;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 700;
            background: rgba(10,31,68,0.08);
            color: var(--navy);
        }
        .badge-count {
            display: inline-flex;
            align-items: center;
            padding: 0.2rem 0.6rem;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
            background: var(--bg);
        }
        .btn-primary-sm {
            background: var(--navy);
            color: white;
            padding: 0.45rem 1rem;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: var(--t);
            border: none;
            cursor: pointer;
        }
        .btn-primary-sm:hover {
            background: var(--navy-mid);
            transform: translateY(-1px);
        }
        .btn-icon {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--txt-3);
            padding: 0.25rem;
            border-radius: 6px;
            transition: var(--t);
            font-size: 1.1rem;
        }
        .btn-icon:hover { background: rgba(10,31,68,0.05); }
        .btn-icon.edit:hover { color: #d97706; }
        .btn-icon.delete:hover { color: var(--danger); background: rgba(220,38,38,0.08); }

        /* Modal (dashboard style) */
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
            width: min(600px, 94vw);
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
            padding: 1.5rem;
        }
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
            background: var(--navy);
            font-size: .8rem;
            font-weight: 700;
            color: #fff;
            cursor: pointer;
            transition: all var(--t);
        }
        .btn-confirm:hover { background: var(--navy-mid); }
        .btn-danger {
            background: var(--danger);
        }
        .btn-danger:hover { background: var(--danger-d); }

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
        .form-label .required { color: var(--danger); margin-left: 0.2rem; }
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
        .form-hint {
            font-size: 0.68rem;
            color: var(--txt-3);
            margin-top: 0.3rem;
        }

        /* Alerts */
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
        .alert-error {
            background: rgba(220,38,38,0.06);
            border-left: 3px solid var(--danger);
            color: #7f1a1a;
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
                <a href="{{ route('admin.departments') }}" class="nav-item active">
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
                <a href="{{ route('admin.settings') }}" class="nav-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
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
                <div class="topbar-breadcrumb">Admin → Academic → Departments</div>
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
        <!-- Flash messages -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="ri-checkbox-circle-line"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                <i class="ri-error-warning-line"></i> {{ session('error') }}
            </div>
        @endif

        <div class="dash-card">
            <div class="dash-card-head">
                <span class="dash-card-title"><i class="ri-building-2-line"></i> Academic Departments</span>
                <button onclick="openCreateModal()" class="btn-primary-sm">
                    <i class="ri-add-line"></i> Add Department
                </button>
            </div>
            <div style="overflow-x: auto;">
                <table class="department-table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Department Name</th>
                            <th>Description</th>
                            <th>Faculty</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departments as $department)
                        <tr>
                            <td><span class="badge-code">{{ $department->code }}</span></td>
                            <td><div style="font-weight: 500;">{{ $department->name }}</div></td>
                            <td><div style="color: var(--txt-3);">{{ Str::limit($department->description, 60) ?: '—' }}</div></td>
                            <td><span class="badge-count">{{ $department->faculty_count ?? 0 }} faculty</span></td>
                            <td>
                                <button onclick="editDepartment({{ $department->id }})" class="btn-icon edit" title="Edit">
                                    <i class="ri-edit-line"></i>
                                </button>
                                <button onclick="openDeleteModal({{ $department->id }}, '{{ addslashes($department->name) }}')" class="btn-icon delete" title="Delete">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 2rem;">
                                    <i class="ri-building-2-line" style="font-size: 2rem; color: var(--txt-3); opacity: 0.4;"></i>
                                    <p style="margin-top: 0.5rem; color: var(--txt-3);">No departments yet.</p>
                                    <button onclick="openCreateModal()" class="btn-primary-sm" style="margin-top: 0.5rem;">Add Department</button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ══ DEPARTMENT MODAL (create / edit) ══ -->
<div id="deptModal" class="modal-overlay">
    <div class="modal">
        <div class="modal-head">
            <h3><i class="ri-building-2-line"></i> <span id="modalTitle">Add Department</span></h3>
            <button class="modal-close" onclick="closeModal()">×</button>
        </div>
        <div class="modal-body">
            <p style="font-size: 0.75rem; color: var(--txt-3); margin-bottom: 1rem;">Fill in the department details below.</p>
            <form id="deptForm">
                @csrf
                <input type="hidden" id="deptId" name="dept_id">

                <div class="form-group">
                    <label class="form-label">Department Code <span class="required">*</span></label>
                    <input type="text" id="deptCode" name="code" required maxlength="20" class="form-input" placeholder="e.g. CCS">
                    <div class="form-hint">Short unique code (auto-uppercased)</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Department Name <span class="required">*</span></label>
                    <input type="text" id="deptName" name="name" required class="form-input" placeholder="e.g. College of Computer Studies">
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea id="deptDesc" name="description" rows="3" class="form-textarea" placeholder="Brief description of this department..."></textarea>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 0.8rem; margin-top: 1rem;">
                    <button type="button" onclick="closeModal()" class="btn-cancel">Cancel</button>
                    <button type="submit" id="submitBtn" class="btn-confirm">Save Department</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ══ DELETE CONFIRMATION MODAL ══ -->
<div id="deleteModal" class="modal-overlay">
    <div class="modal" style="max-width: 420px;">
        <div class="modal-head">
            <h3><i class="ri-delete-bin-line"></i> Delete Department</h3>
            <button class="modal-close" onclick="closeDeleteModal()">×</button>
        </div>
        <div class="modal-body" style="text-align: center;">
            <i class="ri-alert-line" style="font-size: 2rem; color: var(--danger); display: block; margin-bottom: 0.5rem;"></i>
            <p>Are you sure you want to delete <strong id="deleteDeptName"></strong>?</p>
            <p style="font-size: 0.7rem; color: var(--txt-3); margin-top: 0.5rem;">Faculty assigned to this department will lose their department assignment.</p>
        </div>
        <div class="modal-foot">
            <button class="btn-cancel" onclick="closeDeleteModal()">Cancel</button>
            <button id="confirmDeleteBtn" class="btn-confirm btn-danger">Yes, Delete</button>
        </div>
    </div>
</div>

<!-- ══ LOGOUT MODAL ══ -->
<div class="modal-overlay" id="logoutModal">
    <div class="modal" style="max-width: 400px;">
        <div class="modal-head">
            <h3><i class="ri-logout-box-r-line"></i> Confirm Sign Out</h3>
            <button class="modal-close" onclick="closeLogoutModal()">×</button>
        </div>
        <div class="modal-body" style="text-align: center;">
            <p>Are you sure you want to sign out of your account?</p>
            <p style="font-size:0.7rem; margin-top:0.5rem;">You will be redirected to the login page.</p>
        </div>
        <div class="modal-foot">
            <button class="btn-cancel" onclick="closeLogoutModal()">Cancel</button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-confirm btn-danger">Yes, Sign Out</button>
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

    // Modal handlers for department form
    function openCreateModal() {
        document.getElementById('modalTitle').innerText = 'Add Department';
        document.getElementById('deptForm').reset();
        document.getElementById('deptId').value = '';
        document.getElementById('submitBtn').innerText = 'Save Department';
        document.getElementById('deptModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('deptModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    // Edit department - fetch data
    function editDepartment(id) {
        fetch(`/admin/departments/${id}/data`, {
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                document.getElementById('modalTitle').innerText = 'Edit Department';
                document.getElementById('deptId').value = data.department.id;
                document.getElementById('deptCode').value = data.department.code;
                document.getElementById('deptName').value = data.department.name;
                document.getElementById('deptDesc').value = data.department.description || '';
                document.getElementById('submitBtn').innerText = 'Update Department';
                document.getElementById('deptModal').classList.add('active');
                document.body.style.overflow = 'hidden';
            } else {
                alert(data.message || 'Failed to load department data');
            }
        })
        .catch(e => alert('Error loading department: ' + e.message));
    }

    // Delete modal state
    let deleteDeptId = null;

    function openDeleteModal(id, name) {
        deleteDeptId = id;
        document.getElementById('deleteDeptName').innerText = name;
        document.getElementById('deleteModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('active');
        document.body.style.overflow = '';
        deleteDeptId = null;
    }

    // Confirm delete via AJAX
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (!deleteDeptId) return;

        fetch(`/admin/departments/${deleteDeptId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Error deleting department');
                closeDeleteModal();
            }
        })
        .catch(e => {
            alert('Error: ' + e.message);
            closeDeleteModal();
        });
    });

    // Form submission (create / update)
    document.getElementById('deptForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const id = document.getElementById('deptId').value;
        const url = id ? `/admin/departments/${id}` : '/admin/departments';

        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        if (id) formData.append('_method', 'PUT');

        let codeVal = document.getElementById('deptCode').value.trim();
        codeVal = codeVal.toUpperCase();
        formData.append('code', codeVal);
        formData.append('name', document.getElementById('deptName').value.trim());
        formData.append('description', document.getElementById('deptDesc').value.trim());

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                let errorMsg = data.message || 'Error saving department';
                if (data.errors) {
                    const errs = Object.values(data.errors).flat();
                    errorMsg = errs.join('\n');
                }
                alert(errorMsg);
            }
        })
        .catch(e => alert('Error: ' + e.message));
    });

    // Auto uppercase for code field
    const codeInput = document.getElementById('deptCode');
    if (codeInput) {
        codeInput.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    }

    // Close modals when clicking overlay
    document.getElementById('deptModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
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
    document.getElementById('logoutModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeLogoutModal();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (document.getElementById('deptModal').classList.contains('active')) closeModal();
            if (document.getElementById('deleteModal').classList.contains('active')) closeDeleteModal();
            if (document.getElementById('logoutModal').classList.contains('active')) closeLogoutModal();
        }
    });
</script>
</body>
</html>