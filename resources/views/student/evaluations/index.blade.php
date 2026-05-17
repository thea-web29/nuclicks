<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Faculty Evaluation – NU Horizon LMS</title>
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

        /* ══ SIDEBAR (identical to dashboard, student version) ══ */
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

        /* Hero card (page header) */
        .hero-card {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
            border-radius: 16px;
            padding: 1.5rem 2rem;
            margin-bottom: 1.8rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 4px 20px rgba(10,31,68,0.2);
        }
        .hero-icon {
            background: rgba(255,215,15,0.15);
            border-radius: 60px;
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--gold);
        }
        .hero-text h3 {
            font-family: 'Fraunces', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.2rem;
        }
        .hero-text p {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.65);
        }

        /* Cards grid */
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.2rem;
        }
        @media (max-width: 900px) {
            .courses-grid { grid-template-columns: 1fr; }
        }

        .dash-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            overflow: hidden;
            transition: all var(--t);
        }
        .dash-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(10,31,68,0.10);
        }
        .card-gold-top {
            height: 4px;
            background: linear-gradient(90deg, var(--gold-d), var(--gold));
        }
        .card-body { padding: 1.2rem 1.3rem; }

        /* Instructor chip */
        .instructor-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--navy-pale);
            border-radius: 40px;
            padding: 0.3rem 0.8rem;
            margin-top: 0.75rem;
            margin-bottom: 0.75rem;
        }
        .instructor-chip i { color: var(--navy-lite); font-size: 0.85rem; }
        .instructor-chip span { font-size: 0.7rem; font-weight: 600; color: var(--navy-mid); }

        /* Star rating */
        .star-rating {
            display: flex;
            gap: 0.4rem;
            margin-top: 0.3rem;
            margin-bottom: 0.5rem;
        }
        .star-btn {
            background: none;
            border: none;
            font-size: 1.3rem;
            color: #d1d5db;
            cursor: pointer;
            transition: all 0.2s ease;
            padding: 0;
            line-height: 1;
        }
        .star-btn.text-yellow-400 { color: var(--gold-d); }

        .form-label-sm {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--txt-3);
            display: block;
            margin-bottom: 0.2rem;
        }
        .form-textarea {
            width: 100%;
            padding: 0.6rem 0.9rem;
            border: 1px solid var(--bdr);
            border-radius: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.75rem;
            resize: vertical;
            background: var(--white);
        }
        .form-textarea:focus {
            outline: none;
            border-color: var(--gold-d);
            box-shadow: 0 0 0 2px rgba(196,154,0,0.1);
        }

        .btn-submit {
            background: var(--navy);
            color: white;
            border: none;
            padding: 0.6rem 1rem;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: all var(--t);
            width: 100%;
            justify-content: center;
            margin-top: 0.5rem;
        }
        .btn-submit:hover {
            background: var(--navy-mid);
            transform: translateY(-1px);
        }

        .already-evaluated {
            background: rgba(22,163,74,0.08);
            border: 1px solid rgba(22,163,74,0.2);
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
        }
        .already-evaluated i { font-size: 2rem; color: var(--green); margin-bottom: 0.3rem; display: block; }

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

        /* Empty state */
        .empty-card {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--bdr);
            text-align: center;
            padding: 3rem 2rem;
        }
        .empty-card i { font-size: 3rem; color: var(--txt-3); opacity: 0.3; margin-bottom: 1rem; display: block; }

        /* Modal (same as dashboard) */
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
            background: none; border: none;
            color: rgba(255,255,255,0.55);
            font-size: 1.3rem;
            cursor: pointer;
        }
        .modal-body { padding: 1.5rem; text-align: center; }
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

        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(10,31,68,0.65); z-index: 90;
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
            .hero-card { flex-direction: column; text-align: center; padding: 1.2rem; }
        }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- ══ SIDEBAR (Student Portal) ══ -->
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
                <a href="{{ route('student.dashboard') }}" class="nav-item"><i class="ri-dashboard-line"></i> Dashboard</a>
                <a href="{{ route('student.courses') }}" class="nav-item"><i class="ri-book-line"></i> My Courses</a>
                <a href="{{ route('student.progress') }}" class="nav-item"><i class="ri-bar-chart-line"></i> Progress</a>
                <a href="{{ route('student.announcements') }}" class="nav-item"><i class="ri-megaphone-line"></i> Announcements</a>
                <a href="{{ route('student.notifications') }}" class="nav-item"><i class="ri-notification-line"></i> Notifications</a>
                <a href="{{ route('student.faculty.evaluation') }}" class="nav-item active"><i class="ri-star-line"></i> Faculty Evaluation</a>
            </div>
            <div>
                <div class="nav-section-label">Account</div>
                <a href="{{ route('student.profile') }}" class="nav-item"><i class="ri-user-line"></i> Profile</a>
            </div>
        </div>
        <div class="sidebar-footer">
            <div class="profile-row" onclick="window.location='{{ route('student.profile') }}'">
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
                <div class="topbar-breadcrumb">Student → Faculty Evaluation</div>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-badge"><span class="topbar-dot"></span> System Online</div>
            <div class="topbar-badge"><i class="ri-calendar-line"></i><span id="topbar-date"></span></div>
        </div>
    </header>

    <div class="page-body">
        <!-- Hero header -->
        <div class="hero-card">
            <div class="hero-icon"><i class="ri-star-fill"></i></div>
            <div class="hero-text">
                <h3>Faculty Evaluation</h3>
                <p>Rate your instructors and help improve the quality of education.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success"><i class="ri-checkbox-circle-line"></i> {{ session('success') }}</div>
        @endif

        @if(isset($isClosed) && $isClosed)
            <div class="empty-card">
                <i class="ri-lock-fill"></i>
                <h3 style="font-family:'Fraunces'; font-size:1.1rem;">Evaluation Period Closed</h3>
                <p>The faculty evaluation period is currently closed or has ended.</p>
                <a href="{{ route('student.dashboard') }}" class="btn-submit" style="width: auto; margin-top: 1rem; display: inline-flex;">Back to Dashboard</a>
            </div>
        @elseif($enrolledCourses->count() > 0)
            <div class="courses-grid">
                @foreach($enrolledCourses as $course)
                    <div class="dash-card">
                        <div class="card-gold-top"></div>
                        <div class="card-body">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div>
                                    <span class="stat-pill" style="background: var(--navy-pale); color: var(--navy-mid); font-size: 0.65rem; padding: 0.2rem 0.6rem; border-radius: 6px;">{{ $course->code }}</span>
                                    <h4 style="font-family: 'Fraunces'; font-size: 1rem; font-weight: 700; margin-top: 0.5rem; margin-bottom: 0.5rem;">{{ $course->name }}</h4>
                                </div>
                                <div style="background: var(--navy-pale); border-radius: 10px; padding: 0.4rem 0.6rem;"><i class="ri-user-star-line" style="color: var(--navy-lite);"></i></div>
                            </div>

                            <div class="instructor-chip">
                                <i class="ri-user-line"></i>
                                <span>Instructor: {{ $course->faculty->name ?? 'Not Assigned' }}</span>
                            </div>

                            @if(in_array($course->id, $evaluatedCourseIds))
                                <div class="already-evaluated">
                                    <i class="ri-checkbox-circle-fill"></i>
                                    <strong>Already Evaluated</strong>
                                    <p style="font-size: 0.7rem; margin-top: 0.2rem;">Thank you for your feedback.</p>
                                </div>
                            @elseif($course->faculty)
                                <form class="evaluation-form" data-course="{{ $course->id }}" data-faculty="{{ $course->faculty->id }}">
                                    @csrf
                                    <!-- Teaching Effectiveness -->
                                    <div style="margin-top: 0.5rem;">
                                        <div class="form-label-sm">Teaching Effectiveness</div>
                                        <div class="star-rating" data-field="teaching">
                                            @for($i=1;$i<=5;$i++)
                                                <button type="button" data-value="{{ $i }}" class="star-btn"><i class="ri-star-fill"></i></button>
                                            @endfor
                                        </div>
                                    </div>
                                    <!-- Subject Knowledge -->
                                    <div>
                                        <div class="form-label-sm">Subject Knowledge</div>
                                        <div class="star-rating" data-field="knowledge">
                                            @for($i=1;$i<=5;$i++)
                                                <button type="button" data-value="{{ $i }}" class="star-btn"><i class="ri-star-fill"></i></button>
                                            @endfor
                                        </div>
                                    </div>
                                    <!-- Communication Skills -->
                                    <div>
                                        <div class="form-label-sm">Communication Skills</div>
                                        <div class="star-rating" data-field="communication">
                                            @for($i=1;$i<=5;$i++)
                                                <button type="button" data-value="{{ $i }}" class="star-btn"><i class="ri-star-fill"></i></button>
                                            @endfor
                                        </div>
                                    </div>
                                    <!-- Comments -->
                                    <div>
                                        <div class="form-label-sm">Additional Comments <span style="font-weight:normal;">(optional)</span></div>
                                        <textarea rows="2" class="form-textarea" placeholder="Share your thoughts..."></textarea>
                                    </div>
                                    <button type="submit" class="btn-submit"><i class="ri-send-plane-line"></i> Submit Evaluation</button>
                                </form>
                            @else
                                <div style="background: rgba(245,158,11,0.08); border-left: 3px solid var(--orange); border-radius: 10px; padding: 0.6rem; font-size: 0.7rem;">
                                    <i class="ri-error-warning-line"></i> No faculty assigned to evaluate for this course.
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-card">
                <i class="ri-star-line"></i>
                <h3 style="font-family:'Fraunces'; font-size:1.1rem;">No Courses to Evaluate</h3>
                <p>You need to be enrolled in a course with an assigned instructor.</p>
                <a href="{{ route('student.courses') }}" class="btn-submit" style="width: auto; margin-top: 1rem; display: inline-flex;">Browse Courses</a>
            </div>
        @endif
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

    // Star rating logic
    document.querySelectorAll('.star-rating').forEach(container => {
        const stars = container.querySelectorAll('.star-btn');
        let selected = null;

        function updateStars(value) {
            stars.forEach((star, idx) => {
                if (idx < value) star.classList.add('text-yellow-400');
                else star.classList.remove('text-yellow-400');
            });
        }

        stars.forEach(star => {
            const val = parseInt(star.dataset.value);
            star.addEventListener('mouseenter', () => updateStars(val));
            star.addEventListener('mouseleave', () => updateStars(selected || 0));
            star.addEventListener('click', () => {
                selected = val;
                container.dataset.selected = val;
                updateStars(val);
            });
        });
    });

    // Evaluation form submission
    document.querySelectorAll('.evaluation-form').forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = this.querySelector('button[type="submit"]');
            const teaching = this.querySelector('.star-rating[data-field="teaching"]').dataset.selected;
            const knowledge = this.querySelector('.star-rating[data-field="knowledge"]').dataset.selected;
            const communication = this.querySelector('.star-rating[data-field="communication"]').dataset.selected;
            const comment = this.querySelector('textarea').value;

            if (!teaching || !knowledge || !communication) {
                alert('Please provide a rating for all criteria.');
                return;
            }

            const payload = {
                _token: '{{ csrf_token() }}',
                course_id: form.dataset.course,
                faculty_id: form.dataset.faculty,
                teaching: teaching,
                knowledge: knowledge,
                communication: communication,
                comment: comment
            };

            btn.disabled = true;
            btn.innerHTML = '<i class="ri-loader-4-line animate-spin"></i> Submitting...';

            try {
                const response = await fetch("{{ route('student.faculty.evaluation.store') }}", {
                    method: "POST",
                    headers: { "Content-Type": "application/json", "Accept": "application/json" },
                    body: JSON.stringify(payload)
                });
                const data = await response.json();
                if (response.ok) {
                    btn.innerHTML = '<i class="ri-checkbox-circle-line"></i> Submitted!';
                    btn.classList.add('bg-green-600');
                    btn.disabled = true;
                    form.querySelectorAll('button.star-btn, textarea').forEach(el => el.disabled = true);
                    setTimeout(() => location.reload(), 1500);
                } else {
                    alert(data.message || 'Error submitting evaluation');
                    btn.disabled = false;
                    btn.innerHTML = '<i class="ri-send-plane-line"></i> Submit Evaluation';
                }
            } catch (err) {
                alert('Network error. Please try again.');
                btn.disabled = false;
                btn.innerHTML = '<i class="ri-send-plane-line"></i> Submit Evaluation';
            }
        });
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
    document.getElementById('logoutButton')?.addEventListener('click', e => { e.preventDefault(); openLogoutModal(); });
    document.getElementById('confirmLogoutBtn')?.addEventListener('click', () => document.getElementById('logoutForm').submit());
    document.getElementById('logoutModal')?.addEventListener('click', e => { if (e.target === e.currentTarget) closeLogoutModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLogoutModal(); });
</script>
</body>
</html>