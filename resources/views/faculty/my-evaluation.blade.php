<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Evaluation – NU Horizon LMS</title>
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
            --blue:      #3b82f6;
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

        @keyframes fadeUp {
            from { opacity:0; transform:translateY(16px); }
            to   { opacity:1; transform:translateY(0); }
        }

        /* ══ HERO BANNER ══ */
        .hero-banner {
            background: var(--navy);
            border-radius: 16px;
            padding: 1.6rem 2rem;
            margin-bottom: 1.6rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 6px 28px rgba(10,31,68,0.18);
            border: 1px solid rgba(255,215,15,0.12);
            animation: fadeUp .45s var(--ease) both;
        }
        .hero-banner::before {
            content: "";
            position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), var(--gold-mid), transparent);
            background-size: 200% 100%;
            animation: shimmer 4s linear infinite;
        }
        .hero-banner::after {
            content: "";
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.012) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.012) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
        }
        .hero-banner-arc {
            position: absolute;
            width: 280px; height: 280px;
            border-radius: 50%;
            border: 1px solid rgba(255,215,15,0.07);
            right: -60px; top: -100px;
            pointer-events: none;
            z-index: 0;
        }
        .hero-left { position: relative; z-index: 1; }
        .hero-pills {
            display: flex; align-items: center; gap: .5rem;
            flex-wrap: wrap;
            margin-bottom: .55rem;
        }
        .hero-pill {
            display: inline-flex; align-items: center; gap: .3rem;
            padding: .2rem .65rem;
            border-radius: 99px;
            font-size: .68rem; font-weight: 700;
        }
        .hero-pill.gold {
            background: rgba(255,215,15,0.15);
            border: 1px solid rgba(255,215,15,0.25);
            color: var(--gold-mid);
        }
        .hero-pill.navy-pale {
            background: rgba(255,255,255,0.10);
            border: 1px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.75);
        }
        .hero-title {
            font-family: 'Fraunces', serif;
            font-size: 1.5rem; font-weight: 700;
            color: #fff; line-height: 1.2;
            margin-bottom: .5rem;
        }
        .hero-sub { font-size: .78rem; color: rgba(255,255,255,0.55); max-width: 500px; line-height: 1.5; }
        .hero-right { position: relative; z-index: 1; flex-shrink: 0; }
        .rating-circle-wrap {
            background: rgba(255,255,255,0.10);
            border: 1px solid rgba(255,215,15,0.20);
            border-radius: 14px;
            padding: 1.2rem 1.5rem;
            text-align: center;
            min-width: 120px;
        }
        .rating-big {
            font-family: 'Fraunces', serif;
            font-size: 2.6rem; font-weight: 700;
            color: var(--gold);
            line-height: 1;
            letter-spacing: -.04em;
        }
        .rating-out-of { font-size: .68rem; color: rgba(255,255,255,0.50); margin-top: .2rem; font-weight: 600; letter-spacing: .05em; text-transform: uppercase; }

        /* ══ STAT CARDS ══ */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.6rem;
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
        .stat-card::before {
            content: "";
            position: absolute; top: 0; left: 0; right: 0; height: 3px;
            border-radius: 14px 14px 0 0;
        }
        .stat-card.blue::before  { background: linear-gradient(90deg, #93c5fd, var(--blue)); }
        .stat-card.gold::before  { background: linear-gradient(90deg, var(--gold-mid), var(--gold-d)); }
        .stat-card.green::before { background: linear-gradient(90deg, #4ade80, #16a34a); }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(10,31,68,0.10); }
        .stat-label { font-size: .7rem; font-weight: 600; color: var(--txt-3); text-transform: uppercase; letter-spacing: .04em; margin-bottom: .4rem; }
        .stat-value {
            font-family: 'Fraunces', serif;
            font-size: 1.9rem; font-weight: 700;
            line-height: 1; letter-spacing: -.04em;
        }
        .stat-card.blue  .stat-value { color: var(--blue); }
        .stat-card.gold  .stat-value { color: var(--gold-d); }
        .stat-card.green .stat-value { color: var(--green); }
        .stat-icon {
            position: absolute;
            right: .85rem; top: .85rem;
            font-size: 1.55rem; opacity: .10;
        }

        /* ══ TWO-COL ══ */
        .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; margin-bottom: 1.2rem; }

        /* ══ DASH CARD ══ */
        .dash-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            overflow: hidden;
            animation: fadeUp .5s var(--ease) .2s both;
            margin-bottom: 1.2rem;
        }
        .dash-card-head {
            padding: 1rem 1.3rem .9rem;
            border-bottom: 1px solid var(--bdr);
            display: flex; align-items: center; justify-content: space-between;
        }
        .dash-card-title {
            font-size: .82rem; font-weight: 700;
            color: var(--txt-1);
            display: flex; align-items: center; gap: .5rem;
        }
        .dash-card-title i { color: var(--gold-d); font-size: .9rem; }
        .dash-card-badge {
            font-size: .65rem; font-weight: 700;
            letter-spacing: .05em; text-transform: uppercase;
            color: var(--txt-3);
            background: var(--bg); border: 1px solid var(--bdr);
            border-radius: 6px; padding: .2rem .55rem;
        }
        .dash-card-body { padding: 1.2rem 1.3rem; }

        /* ══ RATING DISTRIBUTION ══ */
        .rating-row { margin-bottom: .8rem; }
        .rating-row:last-child { margin-bottom: 0; }
        .rating-row-meta {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: .3rem;
        }
        .star-label {
            display: flex; align-items: center; gap: .3rem;
            font-size: .78rem; font-weight: 700; color: var(--txt-2);
        }
        .star-label i { color: var(--gold-d); font-size: .78rem; }
        .rating-count { font-size: .68rem; color: var(--txt-3); }
        .progress-track {
            height: 6px;
            background: var(--bg);
            border-radius: 99px;
            overflow: hidden;
            border: 1px solid var(--bdr);
        }
        .progress-fill {
            height: 100%;
            border-radius: 99px;
            background: linear-gradient(90deg, var(--gold-mid), var(--gold-d));
        }

        /* ══ CATEGORY AVERAGES ══ */
        .category-row { margin-bottom: .8rem; }
        .category-row:last-child { margin-bottom: 0; }
        .category-row-meta {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: .3rem;
        }
        .category-label { font-size: .78rem; font-weight: 700; color: var(--txt-2); }
        .category-score { font-size: .68rem; font-weight: 700; color: var(--gold-d); }

        /* ══ COURSE TABLE ══ */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: var(--bg); border-bottom: 1px solid var(--bdr); }
        th {
            padding: .7rem 1.2rem;
            text-align: left;
            font-size: .65rem; font-weight: 700;
            letter-spacing: .08em; text-transform: uppercase;
            color: var(--txt-3); white-space: nowrap;
        }
        td {
            padding: .85rem 1.2rem;
            font-size: .8rem; color: var(--txt-2);
            border-bottom: 1px solid var(--bdr);
            vertical-align: middle;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr { transition: background var(--t); }
        tbody tr:hover { background: var(--gold-pale); }
        .course-name-cell { font-size: .82rem; font-weight: 700; color: var(--txt-1); }

        /* Rating pill */
        .rating-pill {
            display: inline-flex; align-items: center; gap: .3rem;
            padding: .2rem .6rem; border-radius: 99px;
            font-size: .68rem; font-weight: 700;
            background: var(--gold-pale); color: var(--gold-d);
            border: 1px solid rgba(196,154,0,0.15);
        }
        .rating-pill i { font-size: .7rem; }

        /* ══ FEEDBACK CARDS ══ */
        .feedback-card {
            padding: .9rem 1rem;
            border-radius: 10px;
            border: 1px solid var(--bdr);
            background: var(--bg);
            margin-bottom: .65rem;
            transition: all var(--t);
        }
        .feedback-card:last-child { margin-bottom: 0; }
        .feedback-card:hover { background: var(--white); border-color: rgba(10,31,68,0.15); }
        .feedback-card-top {
            display: flex; align-items: flex-start; justify-content: space-between;
            gap: .75rem; margin-bottom: .45rem;
        }
        .feedback-course { font-size: .8rem; font-weight: 700; color: var(--txt-1); }
        .feedback-date   { font-size: .65rem; color: var(--txt-3); margin-top: .1rem; }
        .feedback-comment { font-size: .78rem; color: var(--txt-2); line-height: 1.55; }

        /* ══ EMPTY STATE ══ */
        .empty-state {
            text-align: center; padding: 2.5rem 1rem;
            color: var(--txt-3); font-size: .8rem;
            background: var(--bg); border-radius: 10px;
        }
        .empty-state i { font-size: 2rem; display: block; margin-bottom: .5rem; opacity: .35; }

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
            .two-col { grid-template-columns: 1fr; }
            .hero-banner { flex-direction: column; align-items: flex-start; }
        }
        @media (max-width: 640px) {
            .stats-grid { grid-template-columns: 1fr; }
            .page-body { padding: 1.2rem 1rem; }
            .topbar { padding: .8rem 1rem; }
        }
    </style>
</head>
<body>

@php
    $authUser = Auth::user();

    $isRecord = function ($item) {
        return is_object($item) || is_array($item);
    };

    $getValue = function ($item, $key, $default = null) {
        if (is_array($item))  return $item[$key] ?? $default;
        if (is_object($item)) return data_get($item, $key, $default);
        return $default;
    };

    $formatDate = function ($date) {
        if (empty($date)) return 'Recently submitted';
        try {
            if ($date instanceof \Carbon\Carbon) return $date->format('M d, Y h:i A');
            return \Carbon\Carbon::parse($date)->format('M d, Y h:i A');
        } catch (\Throwable $e) { return 'Recently submitted'; }
    };

    $evaluationsCollection      = collect($evaluations ?? [])->filter(fn($i) => $isRecord($i))->values();
    $recentEvaluationsCollection = collect($recentEvaluations ?? $evaluationsCollection->take(8))->filter(fn($i) => $isRecord($i))->values();
    $courseRatingsCollection     = collect($courseRatings ?? $courseBreakdown ?? [])->filter(fn($i) => $isRecord($i))->values();
    $categoryAveragesCollection  = collect($categoryAverages ?? []);

    $totalEvaluations = $evaluationCount ?? $totalEvaluationCount ?? $evaluationsTotal ?? $evaluationsCollection->count();
    $averageRating    = (float) ($averageRating ?? $averageEvaluationRating ?? $avgRating ?? $evaluationsCollection->avg('rating') ?? 0);

    $ratingDistributionRaw = $ratingDistribution ?? $ratingCounts ?? [
        5 => $fiveStarCount ?? 0,
        4 => $fourStarCount ?? 0,
        3 => $threeStarCount ?? 0,
        2 => $twoStarCount ?? 0,
        1 => $oneStarCount ?? 0,
    ];

    $ratingDistributionCollection = collect($ratingDistributionRaw);
    $ratingTotal = $ratingDistributionCollection->sum(fn($c) => is_numeric($c) ? (int)$c : 0);
    if ($ratingTotal <= 0 && $totalEvaluations > 0) $ratingTotal = (int) $totalEvaluations;

    $ratingPercent = function ($count) use ($ratingTotal) {
        if ($ratingTotal <= 0) return 0;
        return round(((int)$count / $ratingTotal) * 100);
    };

    $performanceLabel = 'No Data Yet';
    $performancePill  = 'navy-pale';
    if ($averageRating >= 4.5)     { $performanceLabel = 'Excellent';          $performancePill = 'gold'; }
    elseif ($averageRating >= 4.0) { $performanceLabel = 'Very Good';          $performancePill = 'gold'; }
    elseif ($averageRating >= 3.0) { $performanceLabel = 'Satisfactory';       $performancePill = 'navy-pale'; }
    elseif ($averageRating > 0)    { $performanceLabel = 'Needs Improvement';  $performancePill = 'navy-pale'; }

    $categoryFallbacks = ['teaching_quality'=>'Teaching Quality','communication'=>'Communication','preparedness'=>'Preparedness','fairness'=>'Fairness'];
    $resolvedCategoryAverages = collect();
    if ($categoryAveragesCollection->count() > 0) {
        foreach ($categoryAveragesCollection as $category => $score) {
            $resolvedCategoryAverages->put($category, is_numeric($score) ? (float)$score : 0);
        }
    } else {
        foreach ($categoryFallbacks as $key => $label) {
            $resolvedCategoryAverages->put($label, (float)($evaluationsCollection->avg($key) ?? 0));
        }
    }
@endphp

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
                    <div class="profile-name">{{ $authUser->name ?? 'Faculty User' }}</div>
                    <div class="profile-email">{{ $authUser->email ?? '' }}</div>
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
                <div class="topbar-breadcrumb">Faculty → My Evaluation</div>
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
            <h2><i class="ri-star-smile-line" style="color:var(--gold-d);font-size:.85rem;"></i> My Evaluation</h2>
        </div>

        <!-- Hero banner -->
        <div class="hero-banner">
            <div class="hero-banner-arc"></div>
            <div class="hero-left">
                <div class="hero-pills">
                    <span class="hero-pill gold">
                        <i class="ri-star-smile-line"></i> Faculty Evaluation
                    </span>
                    <span class="hero-pill {{ $performancePill === 'gold' ? 'gold' : 'navy-pale' }}">
                        {{ $performanceLabel }}
                    </span>
                </div>
                <div class="hero-title">Student Feedback Summary</div>
                <div class="hero-sub">This page shows your evaluation results based on student feedback. Student identities are kept protected when evaluations are submitted anonymously.</div>
            </div>
            <div class="hero-right">
                <div class="rating-circle-wrap">
                    <div class="rating-big">{{ number_format($averageRating, 2) }}</div>
                    <div class="rating-out-of">out of 5</div>
                </div>
            </div>
        </div>

        <!-- Stat cards -->
        <div class="stats-grid">
            <div class="stat-card blue">
                <i class="ri-chat-smile-3-line stat-icon"></i>
                <div class="stat-label">Total Evaluations</div>
                <div class="stat-value">{{ $totalEvaluations }}</div>
            </div>
            <div class="stat-card gold">
                <i class="ri-star-line stat-icon"></i>
                <div class="stat-label">Average Rating</div>
                <div class="stat-value">{{ number_format($averageRating, 2) }}<span style="font-size:1rem;font-family:'Plus Jakarta Sans',sans-serif;font-weight:600;color:var(--txt-3)">/5</span></div>
            </div>
            <div class="stat-card green">
                <i class="ri-award-line stat-icon"></i>
                <div class="stat-label">Performance Level</div>
                <div class="stat-value" style="font-size:1.25rem;letter-spacing:-.01em;">{{ $performanceLabel }}</div>
            </div>
        </div>

        <!-- Rating Distribution + Category Averages -->
        <div class="two-col">

            <!-- Rating Distribution -->
            <div class="dash-card" style="margin-bottom:0;">
                <div class="dash-card-head">
                    <div class="dash-card-title">
                        <i class="ri-bar-chart-horizontal-line"></i> Rating Distribution
                    </div>
                </div>
                <div class="dash-card-body">
                    @for($star = 5; $star >= 1; $star--)
                        @php
                            $count   = (int)($ratingDistributionCollection->get($star) ?? $ratingDistributionCollection->get((string)$star) ?? 0);
                            $percent = $ratingPercent($count);
                        @endphp
                        <div class="rating-row">
                            <div class="rating-row-meta">
                                <span class="star-label">{{ $star }} <i class="ri-star-fill"></i></span>
                                <span class="rating-count">{{ $count }} · {{ $percent }}%</span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-fill" style="width:{{ $percent }}%;"></div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Category Averages -->
            <div class="dash-card" style="margin-bottom:0;">
                <div class="dash-card-head">
                    <div class="dash-card-title">
                        <i class="ri-focus-3-line"></i> Category Averages
                    </div>
                </div>
                <div class="dash-card-body">
                    @forelse($resolvedCategoryAverages as $category => $score)
                        @php
                            $label        = is_string($category) ? ucwords(str_replace('_', ' ', $category)) : 'Category ' . $loop->iteration;
                            $score        = is_numeric($score) ? (float)$score : 0;
                            $scorePercent = min(100, max(0, ($score / 5) * 100));
                        @endphp
                        <div class="category-row">
                            <div class="category-row-meta">
                                <span class="category-label">{{ $label }}</span>
                                <span class="category-score">{{ number_format($score, 2) }}/5</span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-fill" style="width:{{ $scorePercent }}%;"></div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state"><i class="ri-bar-chart-box-line"></i> No category ratings available yet.</div>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- Course Evaluation Summary -->
        <div class="dash-card">
            <div class="dash-card-head">
                <div class="dash-card-title">
                    <i class="ri-book-open-line"></i> Course Evaluation Summary
                </div>
            </div>
            @if($courseRatingsCollection->count() > 0)
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Average Rating</th>
                                <th>Evaluations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courseRatingsCollection as $courseRating)
                                @php
                                    $courseName    = $getValue($courseRating, 'course.name') ?? $getValue($courseRating, 'course_name') ?? 'Course #' . ($getValue($courseRating, 'course_id', 'N/A'));
                                    $courseAverage = (float)($getValue($courseRating, 'average_rating') ?? $getValue($courseRating, 'rating') ?? 0);
                                    $courseCount   = $getValue($courseRating, 'evaluation_count') ?? $getValue($courseRating, 'count') ?? 0;
                                @endphp
                                <tr>
                                    <td><span class="course-name-cell">{{ $courseName }}</span></td>
                                    <td>
                                        <span class="rating-pill">
                                            <i class="ri-star-fill"></i> {{ number_format($courseAverage, 2) }}/5
                                        </span>
                                    </td>
                                    <td style="font-size:.78rem;color:var(--txt-3);">{{ $courseCount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="dash-card-body">
                    <div class="empty-state"><i class="ri-book-open-line"></i> No course-specific evaluation data yet.</div>
                </div>
            @endif
        </div>

        <!-- Recent Student Feedback -->
        <div class="dash-card">
            <div class="dash-card-head">
                <div class="dash-card-title">
                    <i class="ri-message-3-line"></i> Recent Student Feedback
                </div>
                <span class="dash-card-badge">Latest comments</span>
            </div>
            <div class="dash-card-body">
                @if($recentEvaluationsCollection->count() > 0)
                    @foreach($recentEvaluationsCollection as $evaluation)
                        @php
                            $courseName = $getValue($evaluation, 'course.name') ?? $getValue($evaluation, 'course_name') ?? 'General Evaluation';
                            $createdAt  = $formatDate($getValue($evaluation, 'created_at'));
                            $rating     = (float)($getValue($evaluation, 'rating', 0));
                            $comment    = $getValue($evaluation, 'comment', 'No written comment provided.');
                        @endphp
                        <div class="feedback-card">
                            <div class="feedback-card-top">
                                <div>
                                    <div class="feedback-course">{{ $courseName }}</div>
                                    <div class="feedback-date">{{ $createdAt }}</div>
                                </div>
                                <span class="rating-pill">
                                    <i class="ri-star-fill"></i> {{ number_format($rating, 1) }}/5
                                </span>
                            </div>
                            <div class="feedback-comment">{{ $comment ?: 'No written comment provided.' }}</div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state"><i class="ri-chat-smile-3-line"></i> No student feedback yet.</div>
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
        if (e.key === 'Escape') closeLogoutModal();
    });
</script>
</body>
</html>