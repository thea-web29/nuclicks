<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Files & Folders – NU Horizon LMS</title>
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

        /* ══ ALERTS ══ */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: .6rem;
            border-radius: 10px;
            padding: .75rem 1rem;
            font-size: .8rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
            animation: fadeUp .4s var(--ease) both;
        }
        .alert i { font-size: 1rem; flex-shrink: 0; margin-top: .05rem; }
        .alert-success {
            background: rgba(22,163,74,0.08);
            border: 1px solid rgba(22,163,74,0.20);
            border-left: 4px solid var(--green);
            color: var(--green);
        }
        .alert-error {
            background: rgba(220,38,38,0.07);
            border: 1px solid rgba(220,38,38,0.18);
            border-left: 4px solid var(--danger);
            color: var(--danger);
        }
        .alert ul { margin-top: .3rem; padding-left: 1.1rem; font-weight: 400; }

        @keyframes fadeUp {
            from { opacity:0; transform:translateY(14px); }
            to   { opacity:1; transform:translateY(0); }
        }

        /* ══ LAYOUT GRIDS ══ */
        .two-col-lg { display: grid; grid-template-columns: 1fr 2fr; gap: 1.2rem; margin-bottom: 1.2rem; }
        .two-col     { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; margin-bottom: 1.2rem; }

        /* ══ DASH CARD ══ */
        .dash-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            overflow: hidden;
            animation: fadeUp .5s var(--ease) both;
        }
        .dash-card-head {
            padding: 1rem 1.3rem .85rem;
            border-bottom: 1px solid var(--bdr);
            display: flex; align-items: center; justify-content: space-between;
            gap: .75rem;
        }
        .dash-card-title {
            font-size: .82rem; font-weight: 700;
            color: var(--txt-1);
            display: flex; align-items: center; gap: .5rem;
        }
        .dash-card-title i { color: var(--gold-d); font-size: .9rem; }
        .dash-card-sub { font-size: .68rem; color: var(--txt-3); margin-top: .15rem; }
        .dash-card-badge {
            font-size: .65rem; font-weight: 700;
            letter-spacing: .05em; text-transform: uppercase;
            color: var(--txt-3);
            background: var(--bg); border: 1px solid var(--bdr);
            border-radius: 6px; padding: .2rem .55rem;
            white-space: nowrap; flex-shrink: 0;
        }
        .dash-card-link {
            font-size: .72rem; font-weight: 600;
            color: var(--navy-lite); text-decoration: none;
            display: flex; align-items: center; gap: .25rem;
            white-space: nowrap; flex-shrink: 0;
        }
        .dash-card-link:hover { color: var(--navy); }
        .dash-card-body { padding: 1.2rem 1.3rem; }

        /* ══ FORMS ══ */
        .form-group { margin-bottom: 1rem; }
        .form-group:last-child { margin-bottom: 0; }
        .form-label {
            display: block;
            font-size: .75rem; font-weight: 700;
            color: var(--txt-2);
            margin-bottom: .35rem;
        }
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
        .form-control:focus { border-color: var(--gold-d); background: var(--white); outline: none; box-shadow: 0 0 0 3px rgba(196,154,0,0.12); }
        textarea.form-control { resize: vertical; min-height: 75px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .85rem; }

        /* Buttons */
        .btn {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .55rem 1rem;
            border-radius: 8px; border: none;
            font-size: .78rem; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all var(--t);
            text-decoration: none;
        }
        .btn-navy { background: var(--navy); color: #fff; box-shadow: 0 2px 8px rgba(10,31,68,0.18); }
        .btn-navy:hover { background: var(--navy-mid); transform: translateY(-1px); }
        .btn-gold { background: var(--gold); color: var(--navy); }
        .btn-gold:hover { background: var(--gold-mid); }
        .btn-outline {
            background: var(--white); color: var(--txt-2);
            border: 1px solid var(--bdr);
        }
        .btn-outline:hover { background: var(--bg); border-color: rgba(10,31,68,0.18); }
        .btn-danger-soft { background: rgba(220,38,38,0.08); color: var(--danger); border: 1px solid rgba(220,38,38,0.18); }
        .btn-danger-soft:hover { background: var(--danger); color: #fff; }
        .btn-sm { padding: .35rem .75rem; font-size: .72rem; }
        .btn-full { width: 100%; justify-content: center; }

        /* ══ FOLDER CHIPS ══ */
        .folder-chips {
            display: flex;
            flex-wrap: wrap;
            gap: .6rem;
            padding: 1.1rem 1.3rem;
        }
        .folder-chip {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .42rem .9rem;
            border-radius: 99px;
            border: 1px solid var(--bdr);
            background: var(--white);
            color: var(--txt-2);
            font-size: .78rem; font-weight: 600;
            text-decoration: none;
            transition: all var(--t);
        }
        .folder-chip i { font-size: .85rem; }
        .folder-chip:hover { border-color: var(--gold-d); background: var(--gold-pale); color: var(--navy); }
        .folder-chip.active {
            background: var(--gold);
            border-color: var(--gold);
            color: var(--navy);
            box-shadow: 0 2px 8px rgba(255,215,15,0.30);
        }

        /* ══ TABLE ══ */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: var(--bg); border-bottom: 1px solid var(--bdr); }
        th {
            padding: .75rem 1.2rem;
            text-align: left;
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--txt-3);
            white-space: nowrap;
        }
        td {
            padding: .85rem 1.2rem;
            font-size: .8rem;
            color: var(--txt-2);
            border-bottom: 1px solid var(--bdr);
            vertical-align: middle;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr { transition: background var(--t); }
        tbody tr:hover { background: var(--gold-pale); }

        /* File icon cell */
        .file-icon-wrap {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: var(--navy-pale);
            color: var(--navy-lite);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        .file-name { font-size: .82rem; font-weight: 600; color: var(--txt-1); }
        .file-desc { font-size: .68rem; color: var(--txt-3); margin-top: .1rem; }

        /* Badges */
        .badge {
            display: inline-flex; align-items: center; gap: .3rem;
            padding: .2rem .6rem;
            border-radius: 99px;
            font-size: .68rem; font-weight: 700;
        }
        .badge-admin   { background: rgba(59,130,246,0.12); color: #1D4ED8; }
        .badge-faculty { background: rgba(22,163,74,0.10);  color: var(--green); }
        .badge-folder  { background: var(--gold-pale); color: var(--gold-d); border: 1px solid rgba(196,154,0,0.15); }
        .badge-file    { background: var(--navy-pale); color: var(--navy-lite); }
        .badge-archived { background: rgba(99,112,137,0.10); color: var(--txt-3); }

        /* Table action group */
        .tbl-actions { display: flex; gap: .4rem; flex-wrap: wrap; }

        /* ══ MINI FILE LIST ══ */
        .mini-file-item {
            display: flex; align-items: center; justify-content: space-between;
            gap: .75rem;
            padding: .7rem .9rem;
            border-radius: 10px;
            border: 1px solid var(--bdr);
            background: var(--bg);
            margin-bottom: .5rem;
            transition: all var(--t);
        }
        .mini-file-item:last-child { margin-bottom: 0; }
        .mini-file-item:hover { border-color: rgba(10,31,68,0.15); background: var(--white); }
        .mini-file-name { font-size: .78rem; font-weight: 600; color: var(--txt-1); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .mini-file-date { font-size: .65rem; color: var(--txt-3); margin-top: .08rem; }

        /* ══ EMPTY STATE ══ */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--txt-3);
            font-size: .8rem;
        }
        .empty-state i { font-size: 2.5rem; display: block; margin-bottom: .6rem; opacity: .35; }

        /* ══ PAGINATION ══ */
        .pagination-wrap {
            padding: .9rem 1.3rem;
            border-top: 1px solid var(--bdr);
        }

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
            .two-col-lg, .two-col { grid-template-columns: 1fr; }
            .form-grid { grid-template-columns: 1fr; }
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
                <div class="topbar-breadcrumb">Faculty → Files & Folders</div>
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
            <h2><i class="ri-folder-3-line" style="color:var(--gold-d);font-size:.85rem;"></i> Files & Folders</h2>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="ri-checkbox-circle-line"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                <i class="ri-error-warning-line"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                <i class="ri-error-warning-line"></i>
                <div>
                    <div style="font-weight:700;margin-bottom:.3rem;">Please fix the following:</div>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Create Folder + Upload File -->
        <div class="two-col-lg">

            <!-- Create Folder -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <div class="dash-card-title">
                            <i class="ri-folder-add-line"></i> Create Folder
                        </div>
                    </div>
                </div>
                <div class="dash-card-body">
                    <form action="{{ route('faculty.folder-files.folders.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Folder Name</label>
                            <input type="text" name="name" class="form-control"
                                   placeholder="e.g., Term 1 Materials" required>
                        </div>
                        <button type="submit" class="btn btn-gold btn-full" style="margin-top:.25rem;">
                            <i class="ri-add-line"></i> Create Folder
                        </button>
                    </form>
                </div>
            </div>

            <!-- Upload File -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <div class="dash-card-title">
                            <i class="ri-upload-cloud-2-line"></i> Upload File
                        </div>
                        <div class="dash-card-sub">Saved to the shared repository used by Admin</div>
                    </div>
                </div>
                <div class="dash-card-body">
                    <form action="{{ route('faculty.folder-files.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Select Folder</label>
                                <select name="folder_id" class="form-control">
                                    <option value="">No folder / Main repository</option>
                                    @foreach($folders as $item)
                                        <option value="{{ $item->id }}" {{ (string) $folder === (string) $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Choose File</label>
                                <input type="file" name="file" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description <span style="color:var(--txt-3);font-weight:400;">(optional)</span></label>
                            <textarea name="description" class="form-control"
                                      placeholder="Optional description for admin and faculty reference"></textarea>
                        </div>
                        <div style="display:flex;justify-content:flex-end;margin-top:.25rem;">
                            <button type="submit" class="btn btn-navy">
                                <i class="ri-upload-cloud-line"></i> Upload File
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Folders -->
        <div class="dash-card" style="margin-bottom:1.2rem;">
            <div class="dash-card-head">
                <div>
                    <div class="dash-card-title">
                        <i class="ri-folder-3-line"></i> Folders
                    </div>
                    <div class="dash-card-sub">Folders created by admins and faculty are shown here.</div>
                </div>
                <a href="{{ route('faculty.folder-files') }}" class="dash-card-link">
                    <i class="ri-home-4-line"></i> Main Repository
                </a>
            </div>
            <div class="folder-chips">
                <a href="{{ route('faculty.folder-files') }}" class="folder-chip {{ empty($folder) ? 'active' : '' }}">
                    <i class="ri-home-4-line"></i> All Files
                </a>
                @foreach($folders as $item)
                    <a href="{{ route('faculty.folder-files', ['folder' => $item->id]) }}"
                       class="folder-chip {{ (string) $folder === (string) $item->id ? 'active' : '' }}">
                        <i class="ri-folder-5-line"></i> {{ $item->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Files Table -->
        <div class="dash-card" style="margin-bottom:1.2rem;">
            <div class="dash-card-head">
                <div>
                    <div class="dash-card-title">
                        <i class="ri-file-list-3-line"></i>
                        {{ $selectedFolder ? $selectedFolder->name : 'Centralized Files' }}
                    </div>
                    <div class="dash-card-sub">Admin uploads and faculty uploads are listed together.</div>
                </div>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>File</th>
                            <th>Folder</th>
                            <th>Uploaded By</th>
                            <th>Size</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($files as $file)
                            @php
                                $uploaderRole = strtolower(optional($file->uploader)->role ?? 'user');
                                $size = $file->size ? number_format($file->size / 1024, 1) . ' KB' : 'N/A';
                            @endphp
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:flex-start;gap:.75rem;">
                                        <div class="file-icon-wrap">
                                            <i class="ri-file-3-line"></i>
                                        </div>
                                        <div>
                                            <div class="file-name">{{ $file->original_name ?? $file->name }}</div>
                                            @if($file->description)
                                                <div class="file-desc">{{ $file->description }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($file->folder)
                                        <span class="badge badge-folder">
                                            <i class="ri-folder-line"></i> {{ $file->folder->name }}
                                        </span>
                                    @else
                                        <span style="font-size:.72rem;color:var(--txt-3);">Main</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $uploaderRole === 'admin' ? 'badge-admin' : 'badge-faculty' }}">
                                        <i class="{{ $uploaderRole === 'admin' ? 'ri-admin-line' : 'ri-user-star-line' }}"></i>
                                        {{ optional($file->uploader)->name ?? 'Unknown' }}
                                    </span>
                                </td>
                                <td style="font-size:.75rem;color:var(--txt-3);">{{ $size }}</td>
                                <td style="font-size:.72rem;color:var(--txt-3);white-space:nowrap;">
                                    {{ optional($file->created_at)->format('M d, Y') }}<br>
                                    <span style="font-size:.65rem;">{{ optional($file->created_at)->format('h:i A') }}</span>
                                </td>
                                <td>
                                    <div class="tbl-actions">
                                        <a href="{{ route('faculty.folder-files.download', $file->id) }}" class="btn btn-sm btn-outline">
                                            <i class="ri-download-line"></i> Download
                                        </a>
                                        @if((int) $file->uploaded_by === (int) Auth::id())
                                            <form action="{{ route('faculty.folder-files.archive', $file->id) }}" method="POST" style="margin:0;" id="archive-form-{{ $file->id }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button"
                                                        class="btn btn-sm btn-danger-soft"
                                                        onclick="confirmArchive({{ $file->id }}, '{{ addslashes($file->original_name ?? $file->name) }}')">
                                                    <i class="ri-archive-line"></i> Archive
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="ri-folder-open-line"></i>
                                        No files found in this folder yet.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($files->hasPages())
                <div class="pagination-wrap">
                    {{ $files->appends(request()->query())->links() }}
                </div>
            @endif
        </div>

        <!-- My Files + Archived -->
        <div class="two-col">

            <!-- My Uploaded Files -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div class="dash-card-title">
                        <i class="ri-user-upload-line"></i> My Uploaded Files
                    </div>
                </div>
                <div class="dash-card-body">
                    @forelse($myFiles as $file)
                        <div class="mini-file-item">
                            <div style="min-width:0;">
                                <div class="mini-file-name">{{ $file->original_name ?? $file->name }}</div>
                                <div class="mini-file-date">{{ optional($file->created_at)->format('M d, Y · h:i A') }}</div>
                            </div>
                            <a href="{{ route('faculty.folder-files.download', $file->id) }}" class="btn btn-sm btn-outline" style="flex-shrink:0;">
                                <i class="ri-download-line"></i>
                            </a>
                        </div>
                    @empty
                        <div class="empty-state" style="padding:1.8rem 1rem;">
                            <i class="ri-upload-cloud-line"></i>
                            You have not uploaded any active files yet.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- My Archived Files -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div class="dash-card-title">
                        <i class="ri-archive-line"></i> My Archived Files
                    </div>
                </div>
                <div class="dash-card-body">
                    @forelse($archivedMyFiles as $file)
                        <div class="mini-file-item">
                            <div style="min-width:0;">
                                <div class="mini-file-name">{{ $file->original_name ?? $file->name }}</div>
                                <div class="mini-file-date">Archived {{ optional($file->archived_at)->format('M d, Y · h:i A') }}</div>
                            </div>
                            <span class="badge badge-archived" style="flex-shrink:0;">Archived</span>
                        </div>
                    @empty
                        <div class="empty-state" style="padding:1.8rem 1rem;">
                            <i class="ri-archive-line"></i>
                            No archived files yet.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

    </div><!-- /page-body -->
</div><!-- /main-content -->

<!-- ══ ARCHIVE CONFIRM MODAL ══ -->
<div id="archiveModal" class="modal-overlay">
    <div class="modal">
        <div class="modal-head">
            <h3><i class="ri-archive-line"></i> Archive File</h3>
            <button class="modal-close" onclick="closeArchiveModal()">×</button>
        </div>
        <div class="modal-body">
            <p>Archive <strong id="archiveFileName"></strong>?</p>
            <p class="modal-warn">Admin will no longer see it as an active file.</p>
        </div>
        <div class="modal-foot">
            <button class="btn-cancel" onclick="closeArchiveModal()">Cancel</button>
            <button class="btn-confirm" id="confirmArchiveBtn">Yes, Archive</button>
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

    /* ── Archive modal ── */
    let pendingArchiveForm = null;

    function confirmArchive(id, name) {
        pendingArchiveForm = document.getElementById(`archive-form-${id}`);
        document.getElementById('archiveFileName').textContent = name;
        document.getElementById('archiveModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeArchiveModal() {
        document.getElementById('archiveModal').classList.remove('active');
        document.body.style.overflow = '';
        pendingArchiveForm = null;
    }
    document.getElementById('confirmArchiveBtn').addEventListener('click', () => {
        if (pendingArchiveForm) pendingArchiveForm.submit();
    });
    document.getElementById('archiveModal').addEventListener('click', function(e) {
        if (e.target === this) closeArchiveModal();
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
        if (e.key === 'Escape') { closeArchiveModal(); closeLogoutModal(); }
    });
</script>
</body>
</html>