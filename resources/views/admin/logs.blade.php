<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Logs – NU Horizon LMS</title>
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
            --orange:    #ea580c;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            color: var(--txt-1);
        }

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
        .nav-item:hover { background: rgba(255,215,15,0.10); color: rgba(255,255,255,0.92); }
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
            content: "";
            flex: 1;
            height: 1px;
            background: var(--bdr);
        }

        /* ══ STAT CARDS ══ */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 1.8rem;
        }
        .stat-card {
            background: var(--white);
            border-radius: 14px;
            padding: 1.2rem 1.1rem;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            transition: all var(--t);
            position: relative;
            overflow: hidden;
            animation: fadeUp .5s var(--ease) both;
        }
        .stat-card:nth-child(1) { animation-delay: .06s; }
        .stat-card:nth-child(2) { animation-delay: .12s; }
        .stat-card:nth-child(3) { animation-delay: .18s; }
        .stat-card:nth-child(4) { animation-delay: .24s; }

        @keyframes fadeUp {
            from { opacity:0; transform:translateY(16px); }
            to   { opacity:1; transform:translateY(0); }
        }
        .stat-card::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            border-radius: 14px 14px 0 0;
        }
        .stat-card.navy::before  { background: linear-gradient(90deg, var(--navy-lite), var(--navy)); }
        .stat-card.green::before { background: linear-gradient(90deg, #4ade80, #16a34a); }
        .stat-card.gold::before  { background: linear-gradient(90deg, var(--gold-mid), var(--gold-d)); }
        .stat-card.red::before   { background: linear-gradient(90deg, #f87171, #dc2626); }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(10,31,68,0.10);
            border-color: rgba(10,31,68,0.15);
        }
        .stat-label {
            font-size: .7rem;
            font-weight: 600;
            color: var(--txt-3);
            text-transform: uppercase;
            letter-spacing: .04em;
            margin-bottom: .5rem;
        }
        .stat-value {
            font-family: 'Fraunces', serif;
            font-size: 2rem;
            font-weight: 700;
            line-height: 1;
            letter-spacing: -.04em;
            margin-bottom: .35rem;
        }
        .stat-card.navy  .stat-value { color: var(--navy); }
        .stat-card.green .stat-value { color: var(--green); }
        .stat-card.gold  .stat-value { color: var(--gold-d); }
        .stat-card.red   .stat-value { color: var(--danger); }
        .stat-icon {
            position: absolute;
            right: .85rem; top: .85rem;
            font-size: 1.55rem;
            opacity: .12;
        }
        .stat-change {
            font-size: .68rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: .2rem;
            color: var(--txt-3);
        }

        /* ══ DASH CARD ══ */
        .dash-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            overflow: hidden;
            animation: fadeUp .55s var(--ease) .18s both;
            margin-bottom: 1.8rem;
        }
        .dash-card-head {
            padding: 1.1rem 1.3rem .9rem;
            border-bottom: 1px solid var(--bdr);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
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

        /* ══ FILTER BAR ══ */
        .filter-bar {
            padding: 1rem 1.3rem;
            border-bottom: 1px solid var(--bdr);
            background: var(--bg);
            display: flex;
            flex-wrap: wrap;
            gap: .75rem;
            align-items: flex-end;
        }
        .filter-group { display: flex; flex-direction: column; gap: .3rem; }
        .filter-label {
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .10em;
            text-transform: uppercase;
            color: var(--txt-3);
        }
        .filter-input,
        .filter-select {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: .8rem;
            font-weight: 500;
            color: var(--txt-1);
            background: var(--white);
            border: 1px solid var(--bdr);
            border-radius: 8px;
            padding: .5rem .85rem;
            outline: none;
            transition: border-color var(--t), box-shadow var(--t);
            min-width: 200px;
        }
        .filter-input:focus,
        .filter-select:focus {
            border-color: var(--navy-lite);
            box-shadow: 0 0 0 3px rgba(61,95,160,0.10);
        }
        .filter-btn {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: .78rem;
            font-weight: 700;
            padding: .52rem 1.1rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all var(--t);
            display: flex;
            align-items: center;
            gap: .4rem;
        }
        .filter-btn.primary {
            background: var(--navy);
            color: #fff;
        }
        .filter-btn.primary:hover {
            background: var(--navy-mid);
            box-shadow: 0 4px 12px rgba(10,31,68,0.25);
        }
        .filter-btn.secondary {
            background: var(--white);
            color: var(--txt-2);
            border: 1px solid var(--bdr);
        }
        .filter-btn.secondary:hover { background: var(--bg); }

        /* ══ TABLE ══ */
        .table-wrap { overflow-x: auto; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead tr {
            background: var(--bg);
            border-bottom: 1px solid var(--bdr);
        }
        thead th {
            padding: .75rem 1.3rem;
            text-align: left;
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .10em;
            text-transform: uppercase;
            color: var(--txt-3);
            white-space: nowrap;
        }
        tbody tr {
            border-bottom: 1px solid var(--bdr);
            transition: background var(--t);
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: var(--navy-pale); }
        td {
            padding: .85rem 1.3rem;
            font-size: .8rem;
            color: var(--txt-2);
            vertical-align: middle;
        }

        /* User cell */
        .user-cell { display: flex; align-items: center; gap: .65rem; }
        .user-initials {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: var(--navy-pale);
            display: flex; align-items: center; justify-content: center;
            font-size: .68rem;
            font-weight: 700;
            color: var(--navy-mid);
            flex-shrink: 0;
        }
        .user-name { font-size: .8rem; font-weight: 600; color: var(--txt-1); }
        .user-role { font-size: .68rem; color: var(--txt-3); margin-top: .05rem; }

        /* Action badge */
        .action-badge {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            font-size: .7rem;
            font-weight: 700;
            padding: .22rem .65rem;
            border-radius: 6px;
            white-space: nowrap;
        }
        .action-badge.create { background: rgba(22,163,74,0.10); color: var(--green); }
        .action-badge.update { background: rgba(202,138,4,0.10); color: #ca8a04; }
        .action-badge.delete { background: rgba(220,38,38,0.10); color: var(--danger); }
        .action-badge.login  { background: var(--navy-pale); color: var(--navy-lite); }
        .action-badge.logout { background: rgba(100,116,139,0.10); color: #475569; }
        .action-badge.default{ background: rgba(100,116,139,0.10); color: #475569; }

        /* Timestamp */
        .ts-date { font-size: .78rem; color: var(--txt-2); font-weight: 500; }
        .ts-time { font-size: .68rem; color: var(--txt-3); margin-top: .06rem; }

        /* ID */
        .log-id { font-family: 'Fraunces', serif; font-size: .78rem; color: var(--txt-3); }

        /* Pagination */
        .pagination-wrap {
            padding: .85rem 1.3rem;
            border-top: 1px solid var(--bdr);
            background: var(--bg);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: .6rem;
        }
        .pagination-info {
            font-size: .72rem;
            color: var(--txt-3);
            font-weight: 500;
        }
        .pagination-info strong { color: var(--txt-2); font-weight: 700; }

        /* Override Laravel's default pagination links */
        .pagination-wrap nav { display: flex; align-items: center; gap: .3rem; flex-wrap: wrap; }
        .pagination-wrap [aria-label="Pagination Navigation"] { display: flex; align-items: center; gap: .3rem; }

        /* All anchor/span inside pagination nav */
        .pagination-wrap nav span,
        .pagination-wrap nav a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            height: 32px;
            padding: 0 .55rem;
            border-radius: 8px;
            font-size: .75rem;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            text-decoration: none;
            transition: all var(--t);
            border: 1px solid var(--bdr);
            background: var(--white);
            color: var(--txt-2);
            cursor: pointer;
        }
        /* Hover state */
        .pagination-wrap nav a:hover {
            background: var(--navy-pale);
            border-color: var(--navy-lite);
            color: var(--navy);
        }
        /* Active / current page */
        .pagination-wrap nav span[aria-current="page"],
        .pagination-wrap nav .active > span,
        .pagination-wrap nav span.font-bold {
            background: var(--navy) !important;
            border-color: var(--navy) !important;
            color: #fff !important;
            box-shadow: 0 2px 8px rgba(10,31,68,0.25);
        }
        /* Disabled prev/next */
        .pagination-wrap nav span[aria-disabled="true"],
        .pagination-wrap nav span.cursor-default {
            opacity: .38;
            cursor: not-allowed;
            background: var(--bg);
            color: var(--txt-3);
        }
        /* Dots / ellipsis */
        .pagination-wrap nav span.dots,
        .pagination-wrap nav span[aria-hidden="true"] {
            background: transparent;
            border-color: transparent;
            color: var(--txt-3);
            cursor: default;
            letter-spacing: .05em;
        }
        /* Hide the verbose result text Laravel appends inside nav */
        .pagination-wrap nav > p { display: none; }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--txt-3);
        }
        .empty-state i { font-size: 2.2rem; display: block; margin-bottom: .6rem; opacity: .35; }
        .empty-state p { font-size: .85rem; }

        /* ══ MODAL ══ */
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
            width: min(440px, 94vw);
            overflow: hidden;
            transform: scale(0.94) translateY(12px);
            transition: transform .28s var(--spring);
            box-shadow: 0 40px 80px rgba(0,0,0,0.25), 0 0 0 1px rgba(255,215,15,0.10);
        }
        .modal-overlay.active .modal { transform: scale(1) translateY(0); }
        .modal-head {
            background: var(--navy);
            padding: 1.2rem 1.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid var(--gold);
            position: relative;
        }
        .modal-head::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
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
            line-height: 1;
        }
        .modal-close:hover { color: var(--gold); }
        .modal-body {
            padding: 1.8rem 1.5rem;
            text-align: center;
        }
        .modal-body p { font-size: .88rem; color: var(--txt-2); line-height: 1.55; }
        .modal-body .modal-warn { font-size: .72rem; color: var(--txt-3); margin-top: .55rem; }
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
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all var(--t);
        }
        .btn-cancel:hover { background: var(--bg); border-color: rgba(10,31,68,0.18); }
        .btn-confirm {
            padding: .58rem 1.2rem;
            border-radius: 8px;
            border: none;
            background: var(--danger);
            font-size: .8rem;
            font-weight: 700;
            color: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all var(--t);
            box-shadow: 0 3px 10px rgba(220,38,38,0.30);
        }
        .btn-confirm:hover { background: var(--danger-d); transform: translateY(-1px); }

        /* ══ MOBILE ══ */
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
        }
        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .page-body { padding: 1.2rem 1rem; }
            .topbar { padding: .8rem 1rem; }
            .filter-input { min-width: 140px; }
        }
        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: 1fr; }
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

        <div class="sidebar-logo">
            <div class="logo-seal-wrap">
                <div class="logo-seal-ring"></div>
                <img src="/logo/NatU.png" alt="NU seal" class="logo-seal"
                     onerror="this.style.display='none'">
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
                <a href="{{ route('admin.settings') }}" class="nav-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                    <i class="ri-settings-line"></i> Settings
                </a>
            </div>
        </div>

        <div class="sidebar-footer">
            <div class="profile-row">
                <div class="avatar"><i class="ri-user-line"></i></div>
                <div>
                    <div class="profile-name">{{ Auth::user()->name }}</div>
                    <div class="profile-email">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <button onclick="openLogoutModal()" class="logout-btn">
                <i class="ri-logout-box-line"></i> Sign Out
            </button>
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
                <div class="topbar-breadcrumb">Admin → Activity Logs</div>
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

        <!-- Section: Overview -->
        <div class="section-header">
            <h2><i class="ri-pulse-line" style="color:var(--gold-d);font-size:.85rem;"></i> Overview</h2>
        </div>

        <!-- Stat Cards -->
        <div class="stats-grid">
            <div class="stat-card navy">
                <i class="ri-history-line stat-icon"></i>
                <div class="stat-label">Total Logs</div>
                <div class="stat-value">{{ number_format($logs->total()) }}</div>
                <div class="stat-change"><i class="ri-subtract-line"></i> All records</div>
            </div>
            <div class="stat-card green">
                <i class="ri-add-line stat-icon"></i>
                <div class="stat-label">Create Actions</div>
                <div class="stat-value">{{ number_format($logs->where('action', 'create')->count()) }}</div>
                <div class="stat-change" style="color:var(--green)"><i class="ri-arrow-up-s-line"></i> Additions</div>
            </div>
            <div class="stat-card gold">
                <i class="ri-edit-line stat-icon"></i>
                <div class="stat-label">Update Actions</div>
                <div class="stat-value">{{ number_format($logs->where('action', 'update')->count()) }}</div>
                <div class="stat-change"><i class="ri-subtract-line"></i> Modifications</div>
            </div>
            <div class="stat-card red">
                <i class="ri-delete-bin-line stat-icon"></i>
                <div class="stat-label">Delete Actions</div>
                <div class="stat-value">{{ number_format($logs->where('action', 'delete')->count()) }}</div>
                <div class="stat-change" style="color:var(--danger)"><i class="ri-arrow-down-s-line"></i> Removals</div>
            </div>
        </div>

        <!-- Section: Logs -->
        <div class="section-header">
            <h2><i class="ri-history-line" style="color:var(--gold-d);font-size:.85rem;"></i> Activity Logs</h2>
        </div>

        <div class="dash-card">
            <div class="dash-card-head">
                <div class="dash-card-title">
                    <i class="ri-history-line"></i> System Activity Log
                </div>
            </div>

            <!-- Filter bar -->
            <div class="filter-bar">
                <div class="filter-group" style="flex:1;min-width:180px;">
                    <label class="filter-label">Search</label>
                    <input type="text" id="searchLogs" class="filter-input"
                           placeholder="Search by user, description…">
                </div>
                <div class="filter-group">
                    <label class="filter-label">Action</label>
                    <select id="filterAction" class="filter-select">
                        <option value="">All Actions</option>
                        <option value="create">Create</option>
                        <option value="update">Update</option>
                        <option value="delete">Delete</option>
                        <option value="login">Login</option>
                        <option value="logout">Logout</option>
                    </select>
                </div>
                <div style="display:flex;gap:.5rem;align-items:flex-end;">
                    <button class="filter-btn primary" onclick="filterLogs()">
                        <i class="ri-filter-line"></i> Filter
                    </button>
                    <button class="filter-btn secondary" onclick="resetFilters()">
                        <i class="ri-refresh-line"></i> Reset
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Description</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody id="logsTableBody">
                        @forelse($logs as $log)
                            <tr class="log-row">
                                <td><span class="log-id">{{ $log->id }}</span></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-initials">
                                            {{ strtoupper(substr($log->user_name ?? 'S', 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="user-name">{{ $log->user_name ?? 'System' }}</div>
                                            <div class="user-role">{{ ucfirst($log->user_role ?? 'system') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $actionClass = match($log->action) {
                                            'create' => 'create',
                                            'update' => 'update',
                                            'delete' => 'delete',
                                            'login'  => 'login',
                                            'logout' => 'logout',
                                            default  => 'default'
                                        };
                                        $actionIcon = match($log->action) {
                                            'create' => 'ri-add-line',
                                            'update' => 'ri-edit-line',
                                            'delete' => 'ri-delete-bin-line',
                                            'login'  => 'ri-login-box-line',
                                            'logout' => 'ri-logout-box-line',
                                            default  => 'ri-information-line'
                                        };
                                    @endphp
                                    <span class="action-badge {{ $actionClass }}">
                                        <i class="{{ $actionIcon }}"></i>
                                        {{ ucfirst($log->action) }}
                                    </span>
                                </td>
                                <td style="max-width:320px;">{{ $log->description }}</td>
                                <td>
                                    <div class="ts-date">{{ \Carbon\Carbon::parse($log->created_at)->format('M d, Y') }}</div>
                                    <div class="ts-time">{{ \Carbon\Carbon::parse($log->created_at)->format('h:i A') }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="ri-history-line"></i>
                                        <p>No activity logs found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-wrap">
                <div class="pagination-info">
                    Showing <strong>{{ $logs->firstItem() ?? 0 }}</strong>–<strong>{{ $logs->lastItem() ?? 0 }}</strong>
                    of <strong>{{ $logs->total() }}</strong> logs
                </div>
                {{ $logs->appends(request()->query())->links() }}
            </div>
        </div>

    </div><!-- /page-body -->
</div><!-- /main-content -->

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
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="btn-confirm">Yes, Sign Out</button>
            </form>
        </div>
    </div>
</div>

<script>
    /* ── Topbar date ── */
    const d = new Date();
    document.getElementById('topbar-date').textContent =
        d.toLocaleDateString('en-PH', { month: 'short', day: 'numeric', year: 'numeric' });

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

    /* ── Filter ── */
    function filterLogs() {
        const search = document.getElementById('searchLogs').value.toLowerCase();
        const action = document.getElementById('filterAction').value.toLowerCase();
        document.querySelectorAll('#logsTableBody .log-row').forEach(row => {
            const text = row.textContent.toLowerCase();
            const badge = row.querySelector('.action-badge');
            const rowAction = badge ? badge.textContent.trim().toLowerCase() : '';
            const matchSearch = !search || text.includes(search);
            const matchAction = !action || rowAction === action;
            row.style.display = (matchSearch && matchAction) ? '' : 'none';
        });
    }
    function resetFilters() {
        document.getElementById('searchLogs').value = '';
        document.getElementById('filterAction').value = '';
        document.querySelectorAll('#logsTableBody .log-row').forEach(r => r.style.display = '');
    }
    document.getElementById('searchLogs').addEventListener('keydown', e => {
        if (e.key === 'Enter') filterLogs();
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
    document.getElementById('logoutModal').addEventListener('click', function(e) {
        if (e.target === this) closeLogoutModal();
    });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLogoutModal(); });
</script>
</body>
</html>