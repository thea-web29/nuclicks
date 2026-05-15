<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management – NU Horizon LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            --purple:    #7c3aed;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            color: var(--txt-1);
            -webkit-tap-highlight-color: transparent;
        }

        *:focus { outline: none !important; box-shadow: none !important; }

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
        .btn-create {
            display: flex;
            align-items: center;
            gap: .45rem;
            padding: .52rem 1.1rem;
            border-radius: 9px;
            border: none;
            background: var(--navy);
            color: #fff;
            font-size: .8rem;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all var(--t);
            box-shadow: 0 2px 8px rgba(10,31,68,0.18);
        }
        .btn-create:hover { background: var(--navy-mid); transform: translateY(-1px); box-shadow: 0 4px 14px rgba(10,31,68,0.22); }
        .btn-create i { font-size: .95rem; }

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
            display: flex;
            align-items: center;
            gap: .6rem;
            background: rgba(22,163,74,0.08);
            border: 1px solid rgba(22,163,74,0.20);
            border-left: 4px solid var(--green);
            border-radius: 10px;
            padding: .75rem 1rem;
            font-size: .8rem;
            font-weight: 600;
            color: var(--green);
            margin-bottom: 1.4rem;
            animation: fadeUp .4s var(--ease) both;
        }
        .alert-success i { font-size: 1rem; }

        @keyframes fadeUp {
            from { opacity:0; transform:translateY(14px); }
            to   { opacity:1; transform:translateY(0); }
        }

        /* ══ COURSE GRID ══ */
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.1rem;
        }

        /* ══ COURSE CARD ══ */
        .course-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            padding: 1.2rem;
            display: flex;
            flex-direction: column;
            transition: all var(--t);
            animation: fadeUp .5s var(--ease) both;
            position: relative;
            overflow: hidden;
        }
        .course-card::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--navy-lite), var(--navy));
            border-radius: 14px 14px 0 0;
        }
        .course-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(10,31,68,0.10);
            border-color: rgba(10,31,68,0.15);
        }
        .course-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: .75rem;
            margin-bottom: .75rem;
        }
        .course-code-badge {
            font-size: .62rem;
            font-weight: 700;
            padding: .18rem .55rem;
            border-radius: 5px;
            background: var(--navy-pale);
            color: var(--navy-mid);
            display: inline-block;
            margin-bottom: .35rem;
        }
        .course-name {
            font-family: 'Fraunces', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--navy);
            line-height: 1.25;
        }
        .course-students-badge {
            font-size: .65rem;
            font-weight: 700;
            padding: .22rem .6rem;
            border-radius: 6px;
            background: var(--gold-pale);
            color: var(--gold-d);
            border: 1px solid rgba(196,154,0,0.15);
            display: flex;
            align-items: center;
            gap: .25rem;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .course-meta {
            display: flex;
            justify-content: space-between;
            font-size: .68rem;
            color: var(--txt-3);
            border-top: 1px solid var(--bdr);
            padding-top: .65rem;
            margin-top: auto;
            margin-bottom: .75rem;
        }
        .course-meta span { display: flex; align-items: center; gap: .3rem; }
        .course-actions { display: flex; gap: .5rem; }
        .course-btn {
            flex: 1;
            text-align: center;
            font-size: .72rem;
            font-weight: 700;
            padding: .52rem;
            border-radius: 8px;
            text-decoration: none;
            transition: all var(--t);
            cursor: pointer;
            border: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .course-btn.primary { background: var(--navy); color: #fff; }
        .course-btn.primary:hover { background: var(--navy-mid); }
        .course-btn.secondary {
            background: var(--white);
            color: var(--txt-2);
            border: 1px solid var(--bdr);
        }
        .course-btn.secondary:hover { background: var(--bg); border-color: rgba(10,31,68,0.18); }

        /* More dropdown */
        .more-wrap { position: relative; }
        .more-btn {
            width: 34px; height: 34px;
            border-radius: 8px;
            border: 1px solid var(--bdr);
            background: var(--white);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            color: var(--txt-3);
            font-size: 1rem;
            transition: all var(--t);
        }
        .more-btn:hover { border-color: var(--gold-d); color: var(--navy); background: var(--bg); }
        .dropdown-menu {
            position: fixed;
            min-width: 180px;
            background: var(--white);
            border: 1px solid var(--bdr);
            border-radius: 12px;
            box-shadow: 0 12px 32px rgba(10,31,68,0.14);
            z-index: 200;
            overflow: hidden;
            display: none;
        }
        .dropdown-menu.open { display: block; }
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: .6rem;
            padding: .65rem 1rem;
            font-size: .78rem;
            font-weight: 500;
            color: var(--txt-2);
            text-decoration: none;
            transition: background var(--t);
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .dropdown-item i { font-size: .9rem; flex-shrink: 0; }
        .dropdown-item:hover { background: var(--bg); }
        .dropdown-item.danger { color: var(--danger); }
        .dropdown-item.danger:hover { background: rgba(220,38,38,0.05); }
        .dropdown-divider { height: 1px; background: var(--bdr); margin: .3rem 0; }

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
        .empty-card p { font-size: .82rem; color: var(--txt-3); max-width: 320px; margin: 0 auto; }

        /* ══ MODAL (shared base) ══ */
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
            width: min(560px, 94vw);
            overflow: hidden;
            transform: scale(0.94) translateY(12px);
            transition: transform .28s var(--spring);
            box-shadow: 0 40px 80px rgba(0,0,0,0.25), 0 0 0 1px rgba(255,215,15,0.10);
        }
        .modal-overlay.active .modal { transform: scale(1) translateY(0); }
        .modal-sm { width: min(440px, 94vw); }
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
            background: rgba(255,255,255,0.12);
            border: none;
            width: 30px; height: 30px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,0.70); font-size: 1.1rem;
            cursor: pointer; transition: all var(--t);
        }
        .modal-close:hover { background: var(--gold); color: var(--navy); transform: rotate(90deg); }
        .modal-body-form { padding: 1.6rem 1.6rem 1.2rem; }
        .modal-body { padding: 1.8rem 1.5rem; text-align: center; }
        .modal-body p { font-size: .88rem; color: var(--txt-2); line-height: 1.55; }
        .modal-warn { font-size: .72rem; color: var(--txt-3); margin-top: .5rem; }
        .modal-foot {
            padding: .9rem 1.4rem 1.3rem;
            display: flex; gap: .6rem; justify-content: flex-end;
            background: var(--bg); border-top: 1px solid var(--bdr);
        }

        /* Form inside modal */
        .form-group { margin-bottom: 1.1rem; }
        .form-label {
            display: block;
            font-size: .75rem; font-weight: 600;
            color: var(--txt-2);
            margin-bottom: .35rem;
        }
        .form-label span { color: var(--danger); }
        .form-control {
            width: 100%;
            padding: .58rem .9rem;
            border: 1px solid var(--bdr);
            border-radius: 9px;
            font-size: .82rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--txt-1);
            background: var(--bg);
            transition: border-color var(--t), background var(--t);
        }
        .form-control:focus { border-color: var(--gold-d); background: var(--white); }
        textarea.form-control { resize: vertical; min-height: 80px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: .85rem; }
        .error-feedback {
            font-size: .68rem; color: var(--danger);
            margin-top: .3rem;
            display: flex; align-items: center; gap: .25rem;
        }

        /* Modal buttons */
        .btn-cancel {
            padding: .58rem 1.1rem; border-radius: 8px;
            border: 1px solid var(--bdr); background: var(--white);
            font-size: .8rem; font-weight: 600; color: var(--txt-2);
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all var(--t);
        }
        .btn-cancel:hover { background: var(--bg); }
        .btn-submit {
            padding: .58rem 1.3rem; border-radius: 8px; border: none;
            background: var(--navy); font-size: .8rem; font-weight: 700; color: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all var(--t);
            display: flex; align-items: center; gap: .4rem;
            box-shadow: 0 3px 10px rgba(10,31,68,0.20);
        }
        .btn-submit:hover { background: var(--navy-mid); transform: translateY(-1px); }
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
        @media (max-width: 1200px) {
            .courses-grid { grid-template-columns: repeat(2, 1fr); }
        }
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
            .form-row { grid-template-columns: 1fr; }
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
                <div class="topbar-breadcrumb">Faculty → Course Management</div>
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
            <button id="openCreateCourseModalBtn" class="btn-create">
                <i class="ri-add-line"></i> Create Course
            </button>
        </div>
    </header>

    <!-- Page body -->
    <div class="page-body">

        <!-- Section header -->
        <div class="section-header">
            <h2><i class="ri-book-open-line" style="color:var(--gold-d);font-size:.85rem;"></i> Course Management</h2>
        </div>

        <!-- Success alert -->
        @if(session('success'))
            <div class="alert-success">
                <i class="ri-checkbox-circle-line"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Courses grid -->
        @if(isset($courses) && $courses->count() > 0)
            <div class="courses-grid">
                @foreach($courses as $i => $course)
                    <div class="course-card" style="animation-delay:{{ $i * 0.06 }}s;">
                        <div class="course-card-top">
                            <div>
                                <span class="course-code-badge">{{ $course->code }}</span>
                                <div class="course-name">{{ $course->name }}</div>
                            </div>
                            <span class="course-students-badge">
                                <i class="ri-group-line"></i> {{ $course->students_count ?? 0 }}
                            </span>
                        </div>
                        <div class="course-meta">
                            <span><i class="ri-quiz-line"></i> Quizzes: {{ $course->quizzes_count ?? 0 }}</span>
                            <span><i class="ri-file-copy-line"></i> Credits: {{ $course->credits ?? 0 }}</span>
                        </div>
                        <div class="course-actions">
                            <a href="{{ route('faculty.course.details', $course->id) }}" class="course-btn primary">
                                Manage Course
                            </a>
                            <a href="{{ route('faculty.quiz.create.for.course', $course->id) }}" class="course-btn secondary">
                                <i class="ri-add-circle-line"></i> Add Quiz
                            </a>
                            <div class="more-wrap">
                                <button class="more-btn" onclick="toggleDropdown({{ $course->id }}, event)" title="More options">
                                    <i class="ri-more-2-line"></i>
                                </button>
                                <div id="dropdown-{{ $course->id }}" class="dropdown-menu">
                                    <a href="{{ route('faculty.edit.course', $course->id) }}" class="dropdown-item">
                                        <i class="ri-edit-line" style="color:var(--gold-d);"></i> Edit Course
                                    </a>
                                    <a href="{{ route('faculty.results', $course->id) }}" class="dropdown-item">
                                        <i class="ri-bar-chart-line" style="color:var(--navy-lite);"></i> View Analytics
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('faculty.delete.course', $course->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                class="dropdown-item danger"
                                                onclick="confirmDeleteCourse({{ $course->id }}, '{{ addslashes($course->name) }}', this)">
                                            <i class="ri-delete-bin-line"></i> Delete Course
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-card">
                <i class="ri-book-open-line"></i>
                <h3>No Courses Created Yet</h3>
                <p>Ready to build your curriculum? Start by adding your first course and engage students with quizzes and content.</p>
            </div>
        @endif

    </div><!-- /page-body -->
</div><!-- /main-content -->

<!-- ══ CREATE COURSE MODAL ══ -->
<div id="createCourseModal" class="modal-overlay">
    <div class="modal">
        <div class="modal-head">
            <h3><i class="ri-add-circle-line"></i> Create New Course</h3>
            <button class="modal-close" id="closeCreateModalBtn"><i class="ri-close-line"></i></button>
        </div>
        <form id="createCourseForm" action="{{ route('faculty.store.course') }}" method="POST">
            @csrf
            <div class="modal-body-form">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Course Code <span>*</span></label>
                        <input type="text" name="code" required
                               value="{{ old('code') }}"
                               class="form-control"
                               placeholder="e.g., CS101">
                        @error('code')
                            <div class="error-feedback"><i class="ri-error-warning-line"></i> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Credits <span>*</span></label>
                        <input type="number" name="credits" required min="1" max="6"
                               value="{{ old('credits', 3) }}"
                               class="form-control">
                        @error('credits')
                            <div class="error-feedback"><i class="ri-error-warning-line"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Course Name <span>*</span></label>
                    <input type="text" name="name" required
                           value="{{ old('name') }}"
                           class="form-control"
                           placeholder="e.g., Introduction to Computer Science">
                    @error('name')
                        <div class="error-feedback"><i class="ri-error-warning-line"></i> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control"
                              placeholder="Course description, objectives, prerequisites…">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="error-feedback"><i class="ri-error-warning-line"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" id="cancelCreateModalBtn" class="btn-cancel">Cancel</button>
                <button type="submit" class="btn-submit">
                    <i class="ri-save-line"></i> Create Course
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ══ DELETE CONFIRM MODAL ══ -->
<div id="deleteCourseModal" class="modal-overlay">
    <div class="modal modal-sm">
        <div class="modal-head">
            <h3><i class="ri-delete-bin-line"></i> Delete Course</h3>
            <button class="modal-close" onclick="closeDeleteModal()"><i class="ri-close-line"></i></button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete <strong id="deleteCourseName"></strong>?</p>
            <p class="modal-warn">All associated quizzes, submissions, and enrollments will be permanently lost. This cannot be undone.</p>
        </div>
        <div class="modal-foot">
            <button class="btn-cancel" onclick="closeDeleteModal()">Cancel</button>
            <button class="btn-confirm" id="confirmDeleteBtn">Yes, Delete</button>
        </div>
    </div>
</div>

<!-- ══ LOGOUT MODAL ══ -->
<div class="modal-overlay" id="logoutModal">
    <div class="modal modal-sm">
        <div class="modal-head">
            <h3><i class="ri-logout-box-r-line"></i> Confirm Sign Out</h3>
            <button class="modal-close" onclick="closeLogoutModal()"><i class="ri-close-line"></i></button>
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

    /* ── Dropdown ── */
    let activeDropdown = null;

    function toggleDropdown(courseId, event) {
        event.stopPropagation();
        const dropdown = document.getElementById(`dropdown-${courseId}`);
        const button = event.currentTarget;

        if (activeDropdown && activeDropdown !== dropdown) {
            activeDropdown.classList.remove('open');
        }

        if (!dropdown.classList.contains('open')) {
            const rect = button.getBoundingClientRect();
            dropdown.style.top  = `${rect.bottom + window.scrollY + 6}px`;
            dropdown.style.left = `${rect.right - 185}px`;
            dropdown.classList.add('open');
            activeDropdown = dropdown;
        } else {
            dropdown.classList.remove('open');
            activeDropdown = null;
        }
    }

    document.addEventListener('click', () => {
        if (activeDropdown) { activeDropdown.classList.remove('open'); activeDropdown = null; }
    });
    window.addEventListener('scroll', () => {
        if (activeDropdown) { activeDropdown.classList.remove('open'); activeDropdown = null; }
    });

    /* ── Create Course Modal ── */
    function openCreateModal() {
        document.getElementById('createCourseModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeCreateModal() {
        document.getElementById('createCourseModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    document.getElementById('openCreateCourseModalBtn').addEventListener('click', openCreateModal);
    document.getElementById('closeCreateModalBtn').addEventListener('click', closeCreateModal);
    document.getElementById('cancelCreateModalBtn').addEventListener('click', closeCreateModal);
    document.getElementById('createCourseModal').addEventListener('click', function(e) {
        if (e.target === this) closeCreateModal();
    });

    @if ($errors->any())
        window.addEventListener('DOMContentLoaded', () => openCreateModal());
    @endif

    /* ── Delete Course Modal ── */
    let pendingDeleteForm = null;

    function confirmDeleteCourse(id, name, btn) {
        if (activeDropdown) { activeDropdown.classList.remove('open'); activeDropdown = null; }
        pendingDeleteForm = btn.closest('form');
        document.getElementById('deleteCourseName').textContent = name;
        document.getElementById('deleteCourseModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeDeleteModal() {
        document.getElementById('deleteCourseModal').classList.remove('active');
        document.body.style.overflow = '';
        pendingDeleteForm = null;
    }
    document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
        if (pendingDeleteForm) pendingDeleteForm.submit();
    });
    document.getElementById('deleteCourseModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });

    /* ── Logout Modal ── */
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
        if (e.key === 'Escape') {
            closeCreateModal(); closeDeleteModal(); closeLogoutModal();
        }
    });
</script>
</body>
</html>