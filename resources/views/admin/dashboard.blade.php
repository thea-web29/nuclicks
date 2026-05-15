<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard – NU Horizon LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* ══ DESIGN TOKENS (mirrored from login page) ══ */
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

        /* Gold shimmer top bar */
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

        /* Subtle grid texture on sidebar */
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

        /* Decorative arc */
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

        /* Top bar */
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

        /* ══ PAGE BODY ══ */
        .page-body { padding: 1.8rem 2rem; flex: 1; }

        /* Section header */
        .section-header {
            margin-bottom: 1.4rem;
        }
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
            grid-template-columns: repeat(5, 1fr);
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
        .stat-card:nth-child(5) { animation-delay: .30s; }

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
        .stat-card.purple::before{ background: linear-gradient(90deg, #a78bfa, #7c3aed); }
        .stat-card.gold::before  { background: linear-gradient(90deg, var(--gold-mid), var(--gold-d)); }
        .stat-card.orange::before{ background: linear-gradient(90deg, #fb923c, #ea580c); }

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
        .stat-card.purple .stat-value { color: var(--purple); }
        .stat-card.gold  .stat-value { color: var(--gold-d); }
        .stat-card.orange .stat-value { color: var(--orange); }
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
        .stat-change.up { color: var(--green); }
        .stat-change.neutral { color: var(--txt-3); }

        /* ══ TWO-COLUMN ══ */
        .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; margin-bottom: 1.2rem; }
        .three-col { display: grid; grid-template-columns: 1.4fr 1fr; gap: 1.2rem; margin-bottom: 1.2rem; }

        /* ══ DASHBOARD CARD ══ */
        .dash-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            overflow: hidden;
            animation: fadeUp .55s var(--ease) .18s both;
        }
        .dash-card-head {
            padding: 1.1rem 1.3rem .9rem;
            border-bottom: 1px solid var(--bdr);
            display: flex;
            align-items: center;
            justify-content: space-between;
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
        .dash-card-badge {
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
            color: var(--txt-3);
            background: var(--bg);
            border: 1px solid var(--bdr);
            border-radius: 6px;
            padding: .2rem .55rem;
        }
        .dash-card-body { padding: 1.2rem 1.3rem; }

        /* Chart areas */
        .chart-wrap { position: relative; }

        /* ══ PERFORMANCE NUMS ══ */
        .perf-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .8rem;
            margin-bottom: 1.2rem;
        }
        .perf-box {
            background: var(--bg);
            border: 1px solid var(--bdr);
            border-radius: 10px;
            padding: .85rem;
            text-align: center;
        }
        .perf-box-label { font-size: .68rem; font-weight: 600; color: var(--txt-3); text-transform: uppercase; letter-spacing: .05em; margin-bottom: .35rem; }
        .perf-box-val {
            font-family: 'Fraunces', serif;
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -.04em;
            line-height: 1;
        }
        .perf-box-val.blue { color: var(--navy-lite); }
        .perf-box-val.green { color: var(--green); }

        /* Faculty bar */
        .faculty-bar-row { margin-bottom: .7rem; }
        .faculty-bar-meta {
            display: flex;
            justify-content: space-between;
            font-size: .72rem;
            color: var(--txt-2);
            font-weight: 500;
            margin-bottom: .3rem;
        }
        .faculty-bar-meta span:last-child { color: var(--txt-3); font-weight: 400; }
        .bar-track {
            height: 5px;
            background: var(--bg);
            border-radius: 99px;
            overflow: hidden;
            border: 1px solid var(--bdr);
        }
        .bar-fill {
            height: 100%;
            border-radius: 99px;
            background: linear-gradient(90deg, var(--gold-mid), var(--gold-d));
        }

        /* ══ ENROLLMENT / QUIZ LIST ══ */
        .list-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .7rem 0;
            border-bottom: 1px solid var(--bdr);
            transition: background var(--t);
        }
        .list-item:last-child { border-bottom: none; padding-bottom: 0; }
        .list-item:first-child { padding-top: 0; }
        .list-avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: var(--navy-pale);
            display: flex; align-items: center; justify-content: center;
            font-size: .7rem;
            font-weight: 700;
            color: var(--navy-mid);
            flex-shrink: 0;
        }
        .list-info { flex: 1; padding: 0 .65rem; min-width: 0; }
        .list-name { font-size: .8rem; font-weight: 600; color: var(--txt-1); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .list-sub { font-size: .68rem; color: var(--txt-3); margin-top: .08rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .list-time { font-size: .65rem; color: var(--txt-3); white-space: nowrap; flex-shrink: 0; }
        .score-pill {
            font-size: .72rem;
            font-weight: 700;
            padding: .2rem .55rem;
            border-radius: 6px;
        }
        .score-pill.pass { background: rgba(22,163,74,0.10); color: var(--green); }
        .score-pill.fail { background: rgba(220,38,38,0.10); color: var(--danger); }

        /* ══ ACTIVITY LOG ══ */
        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: .75rem;
            padding: .7rem .9rem;
            border-radius: 9px;
            transition: background var(--t);
            margin-bottom: .2rem;
        }
        .activity-item:hover { background: var(--bg); }
        .activity-icon {
            width: 28px; height: 28px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: .85rem;
            flex-shrink: 0;
        }
        .activity-icon.create { background: rgba(22,163,74,0.12); color: var(--green); }
        .activity-icon.update { background: rgba(234,179,8,0.12); color: #ca8a04; }
        .activity-icon.delete { background: rgba(220,38,38,0.10); color: var(--danger); }
        .activity-icon.info   { background: var(--navy-pale); color: var(--navy-lite); }
        .activity-text { font-size: .78rem; color: var(--txt-2); line-height: 1.45; }
        .activity-meta { font-size: .65rem; color: var(--txt-3); margin-top: .18rem; }

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
        .modal-body .modal-warn {
            font-size: .72rem;
            color: var(--txt-3);
            margin-top: .55rem;
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

        /* ══ MOBILE OVERLAY ══ */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(10,31,68,0.65);
            z-index: 90;
        }

        /* ══ EMPTY STATE ══ */
        .empty-state {
            text-align: center;
            padding: 1.8rem 1rem;
            color: var(--txt-3);
            font-size: .8rem;
        }
        .empty-state i { font-size: 1.8rem; display: block; margin-bottom: .5rem; opacity: .4; }

        /* ══ RESPONSIVE ══ */
        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay { display: block; }
            .main-content { margin-left: 0; }
            .menu-toggle { display: flex; }
            .two-col, .three-col { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .page-body { padding: 1.2rem 1rem; }
            .topbar { padding: .8rem 1rem; }
        }
        @media (max-width: 420px) {
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

        <!-- Logo -->
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

        <!-- Nav -->
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

        <!-- Footer -->
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
                <div class="topbar-breadcrumb">Admin → Dashboard</div>
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

        <!-- Section: Overview -->
        <div class="section-header">
            <h2><i class="ri-pulse-line" style="color:var(--gold-d);font-size:.85rem;"></i> Overview</h2>
        </div>

        <!-- Stat cards -->
        <div class="stats-grid">
            <div class="stat-card navy">
                <i class="ri-user-line stat-icon"></i>
                <div class="stat-label">Total Students</div>
                <div class="stat-value">{{ number_format($totalStudents) }}</div>
                <div class="stat-change up"><i class="ri-arrow-up-s-line"></i> Active learners</div>
            </div>
            <div class="stat-card green">
                <i class="ri-user-star-line stat-icon"></i>
                <div class="stat-label">Total Faculty</div>
                <div class="stat-value">{{ number_format($totalFaculty) }}</div>
                <div class="stat-change up"><i class="ri-arrow-up-s-line"></i> Instructors</div>
            </div>
            <div class="stat-card purple">
                <i class="ri-book-line stat-icon"></i>
                <div class="stat-label">Total Courses</div>
                <div class="stat-value">{{ number_format($totalCourses) }}</div>
                <div class="stat-change neutral"><i class="ri-subtract-line"></i> All subjects</div>
            </div>
            <div class="stat-card gold">
                <i class="ri-quiz-line stat-icon"></i>
                <div class="stat-label">Total Quizzes</div>
                <div class="stat-value">{{ number_format($totalQuizzes) }}</div>
                <div class="stat-change neutral"><i class="ri-subtract-line"></i> All assessments</div>
            </div>
            <div class="stat-card orange">
                <i class="ri-play-circle-line stat-icon"></i>
                <div class="stat-label">Active Quizzes</div>
                <div class="stat-value">{{ number_format($activeQuizzes) }}</div>
                <div class="stat-change up"><i class="ri-arrow-up-s-line"></i> Live now</div>
            </div>
        </div>

        <!-- Section: Analytics -->
        <div class="section-header">
            <h2><i class="ri-bar-chart-2-line" style="color:var(--gold-d);font-size:.85rem;"></i> Analytics</h2>
        </div>

        <!-- Charts row -->
        <div class="three-col">
            <!-- Monthly chart -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div class="dash-card-title">
                        <i class="ri-bar-chart-grouped-line"></i> Monthly Statistics
                    </div>
                    <span class="dash-card-badge">Last 6 months</span>
                </div>
                <div class="dash-card-body">
                    <div class="chart-wrap">
                        <canvas id="monthlyChart" height="220"></canvas>
                    </div>
                </div>
            </div>

            <!-- Performance + Faculty bars -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div class="dash-card-title">
                        <i class="ri-questionnaire-line"></i> Quiz Performance
                    </div>
                </div>
                <div class="dash-card-body">
                    <div class="perf-row">
                        <div class="perf-box">
                            <div class="perf-box-label">Total Attempts</div>
                            <div class="perf-box-val blue">{{ number_format($totalAttempts) }}</div>
                        </div>
                        <div class="perf-box">
                            <div class="perf-box-label">Average Score</div>
                            <div class="perf-box-val green">{{ number_format($averageScore, 1) }}%</div>
                        </div>
                    </div>
                    <div style="font-size:.72rem;font-weight:700;color:var(--txt-2);text-transform:uppercase;letter-spacing:.05em;margin-bottom:.75rem;">
                        Courses per Faculty — Top 5
                    </div>
                    @foreach($coursesPerFaculty as $faculty)
                        @php
                            $maxCourses = $coursesPerFaculty->first()->courses_count ?? 1;
                            $pct = $maxCourses > 0 ? ($faculty->courses_count / $maxCourses) * 100 : 0;
                        @endphp
                        <div class="faculty-bar-row">
                            <div class="faculty-bar-meta">
                                <span>{{ $faculty->name }}</span>
                                <span>{{ $faculty->courses_count }} courses</span>
                            </div>
                            <div class="bar-track">
                                <div class="bar-fill" style="width:{{ $pct }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Section: Activity -->
        <div class="section-header">
            <h2><i class="ri-time-line" style="color:var(--gold-d);font-size:.85rem;"></i> Recent Activity</h2>
        </div>

        <!-- Enrollments + Quiz attempts -->
        <div class="two-col">
            <!-- Recent enrollments -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div class="dash-card-title">
                        <i class="ri-user-add-line"></i> Recent Enrollments
                    </div>
                    <span class="dash-card-badge">Latest</span>
                </div>
                <div class="dash-card-body">
                    @if($recentEnrollments->count() > 0)
                        @foreach($recentEnrollments as $enrollment)
                            <div class="list-item">
                                <div class="list-avatar">{{ strtoupper(substr($enrollment->student->name, 0, 2)) }}</div>
                                <div class="list-info">
                                    <div class="list-name">{{ $enrollment->student->name }}</div>
                                    <div class="list-sub">{{ $enrollment->course->name }}</div>
                                </div>
                                <div class="list-time">{{ $enrollment->created_at->diffForHumans() }}</div>
                            </div>
                        @endforeach
                    @else
                        <div class="empty-state"><i class="ri-user-line"></i> No recent enrollments.</div>
                    @endif
                </div>
            </div>

            <!-- Recent quiz attempts -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div class="dash-card-title">
                        <i class="ri-quiz-line"></i> Recent Quiz Attempts
                    </div>
                    <span class="dash-card-badge">Latest</span>
                </div>
                <div class="dash-card-body">
                    @if($recentAttempts->count() > 0)
                        @foreach($recentAttempts as $attempt)
                            @php
                                $pct = $attempt->quiz->total_points > 0
                                    ? ($attempt->score / $attempt->quiz->total_points) * 100 : 0;
                                $pass = $pct >= 60;
                            @endphp
                            <div class="list-item">
                                <div class="list-avatar">{{ strtoupper(substr($attempt->student->name, 0, 2)) }}</div>
                                <div class="list-info">
                                    <div class="list-name">{{ $attempt->student->name }}</div>
                                    <div class="list-sub">{{ $attempt->quiz->title }} · {{ $attempt->quiz->course->name }}</div>
                                </div>
                                <div style="text-align:right;flex-shrink:0;">
                                    <div class="score-pill {{ $pass ? 'pass' : 'fail' }}">
                                        {{ $attempt->score }}/{{ $attempt->quiz->total_points }}
                                    </div>
                                    <div class="list-time" style="margin-top:.25rem;">{{ $attempt->completed_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="empty-state"><i class="ri-quiz-line"></i> No quiz attempts yet.</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Activity logs -->
        <div class="section-header">
            <h2><i class="ri-history-line" style="color:var(--gold-d);font-size:.85rem;"></i> Activity Logs</h2>
        </div>

        <div class="dash-card" style="margin-bottom:1.8rem;">
            <div class="dash-card-head">
                <div class="dash-card-title">
                    <i class="ri-history-line"></i> Recent System Logs
                </div>
                <a href="{{ route('admin.logs') }}" style="font-size:.72rem;font-weight:600;color:var(--navy-lite);text-decoration:none;display:flex;align-items:center;gap:.25rem;">
                    View all <i class="ri-arrow-right-s-line"></i>
                </a>
            </div>
            <div style="padding:.4rem .45rem;">
                @if($recentActivities->count() > 0)
                    @foreach($recentActivities as $activity)
                        <div class="activity-item">
                            <div class="activity-icon
                                @switch($activity->action)
                                    @case('create') create @break
                                    @case('update') update @break
                                    @case('delete') delete @break
                                    @default info
                                @endswitch
                            ">
                                @switch($activity->action)
                                    @case('create') <i class="ri-add-line"></i> @break
                                    @case('update') <i class="ri-edit-line"></i> @break
                                    @case('delete') <i class="ri-delete-bin-line"></i> @break
                                    @default <i class="ri-information-line"></i>
                                @endswitch
                            </div>
                            <div>
                                <div class="activity-text">{{ $activity->description }}</div>
                                <div class="activity-meta">
                                    {{ $activity->user ? $activity->user->name : 'System' }}
                                    &nbsp;·&nbsp;
                                    {{ $activity->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state"><i class="ri-history-line"></i> No activity logs available.</div>
                @endif
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

    /* ── Monthly chart ── */
    const ctx = document.getElementById('monthlyChart').getContext('2d');
    const monthlyData = @json($monthlyStats);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: monthlyData.map(i => i.month),
            datasets: [
                {
                    label: 'Students',
                    data: monthlyData.map(i => i.students),
                    borderColor: '#3D5FA0',
                    backgroundColor: 'rgba(61,95,160,0.08)',
                    tension: 0.42, fill: true, pointRadius: 4,
                    pointBackgroundColor: '#3D5FA0',
                    borderWidth: 2.5
                },
                {
                    label: 'Courses',
                    data: monthlyData.map(i => i.courses),
                    borderColor: '#7c3aed',
                    backgroundColor: 'rgba(124,58,237,0.07)',
                    tension: 0.42, fill: true, pointRadius: 4,
                    pointBackgroundColor: '#7c3aed',
                    borderWidth: 2.5
                },
                {
                    label: 'Quizzes',
                    data: monthlyData.map(i => i.quizzes),
                    borderColor: '#C49A00',
                    backgroundColor: 'rgba(196,154,0,0.07)',
                    tension: 0.42, fill: true, pointRadius: 4,
                    pointBackgroundColor: '#C49A00',
                    borderWidth: 2.5
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: { family: 'Plus Jakarta Sans', size: 11, weight: '600' },
                        usePointStyle: true, pointStyleWidth: 8, boxHeight: 6
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: '#0A1F44',
                    titleFont: { family: 'Plus Jakarta Sans', size: 11, weight: '700' },
                    bodyFont: { family: 'Plus Jakarta Sans', size: 11 },
                    padding: 10,
                    cornerRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(10,31,68,0.05)' },
                    ticks: { font: { family: 'Plus Jakarta Sans', size: 10 }, color: '#637089' }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Plus Jakarta Sans', size: 10 }, color: '#637089' }
                }
            }
        }
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