<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Dashboard – NU Horizon LMS</title>
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

        /* ══ WELCOME BANNER ══ */
        .welcome-banner {
            background: var(--navy);
            border-radius: 16px;
            padding: 1.6rem 2rem;
            margin-bottom: 1.8rem;
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
        /* Gold shimmer line on top */
        .welcome-banner::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), var(--gold-mid), transparent);
            background-size: 200% 100%;
            animation: shimmer 4s linear infinite;
        }
        /* Subtle grid texture */
        .welcome-banner::after {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.012) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.012) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
        }
        /* Decorative arc inside banner */
        .welcome-arc {
            position: absolute;
            width: 300px; height: 300px;
            border-radius: 50%;
            border: 1px solid rgba(255,215,15,0.07);
            right: -80px; top: -120px;
            pointer-events: none;
            z-index: 0;
        }
        .welcome-arc2 {
            position: absolute;
            width: 160px; height: 160px;
            border-radius: 50%;
            border: 1px solid rgba(255,215,15,0.05);
            right: 80px; bottom: -80px;
            pointer-events: none;
            z-index: 0;
        }
        .welcome-left {
            position: relative;
            z-index: 1;
        }
        .welcome-greeting {
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.45);
            margin-bottom: .35rem;
            display: flex;
            align-items: center;
            gap: .4rem;
        }
        .welcome-greeting-dot {
            width: 5px; height: 5px;
            border-radius: 50%;
            background: var(--gold);
            box-shadow: 0 0 5px var(--gold);
        }
        .welcome-name {
            font-family: 'Fraunces', serif;
            font-size: 1.65rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: -.03em;
            line-height: 1.15;
            margin-bottom: .55rem;
        }
        .welcome-name em {
            color: var(--gold);
            font-style: normal;
        }
        .welcome-pills {
            display: flex;
            align-items: center;
            gap: .5rem;
            flex-wrap: wrap;
        }
        .welcome-pill {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,215,15,0.14);
            border-radius: 20px;
            padding: .22rem .65rem;
            font-size: .68rem;
            font-weight: 600;
            color: rgba(255,255,255,0.65);
        }
        .welcome-pill i { font-size: .75rem; color: var(--gold-mid); }
        .welcome-right {
            position: relative;
            z-index: 1;
            flex-shrink: 0;
        }
        .welcome-date-box {
            background: rgba(255,215,15,0.10);
            border: 1px solid rgba(255,215,15,0.20);
            border-radius: 12px;
            padding: .9rem 1.3rem;
            text-align: center;
            min-width: 100px;
        }
        .welcome-date-day {
            font-family: 'Fraunces', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--gold);
            line-height: 1;
            letter-spacing: -.04em;
        }
        .welcome-date-month {
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.50);
            margin-top: .2rem;
        }

        /* ══ SECTION HEADER ══ */
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
        .stat-card.navy::before   { background: linear-gradient(90deg, var(--navy-lite), var(--navy)); }
        .stat-card.green::before  { background: linear-gradient(90deg, #4ade80, #16a34a); }
        .stat-card.purple::before { background: linear-gradient(90deg, #a78bfa, #7c3aed); }
        .stat-card.gold::before   { background: linear-gradient(90deg, var(--gold-mid), var(--gold-d)); }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(10,31,68,0.10);
            border-color: rgba(10,31,68,0.15);
        }
        .stat-label {
            font-size: .7rem; font-weight: 600;
            color: var(--txt-3);
            text-transform: uppercase; letter-spacing: .04em;
            margin-bottom: .5rem;
        }
        .stat-value {
            font-family: 'Fraunces', serif;
            font-size: 2rem; font-weight: 700;
            line-height: 1; letter-spacing: -.04em;
            margin-bottom: .35rem;
        }
        .stat-card.navy   .stat-value { color: var(--navy); }
        .stat-card.green  .stat-value { color: var(--green); }
        .stat-card.purple .stat-value { color: var(--purple); }
        .stat-card.gold   .stat-value { color: var(--gold-d); }
        .stat-icon {
            position: absolute;
            right: .85rem; top: .85rem;
            font-size: 1.55rem; opacity: .12;
        }
        .stat-change {
            font-size: .68rem; font-weight: 600;
            display: flex; align-items: center; gap: .2rem;
            color: var(--txt-3);
        }
        .stat-change.up { color: var(--green); }
        .stat-change.neutral { color: var(--txt-3); }

        /* ══ LAYOUT ══ */
        .two-col   { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; margin-bottom: 1.2rem; }
        .three-col { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.2rem; margin-bottom: 1.2rem; }

        /* ══ DASH CARD ══ */
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
        .dash-card-link {
            font-size: .72rem; font-weight: 600;
            color: var(--navy-lite); text-decoration: none;
            display: flex; align-items: center; gap: .25rem;
        }
        .dash-card-link:hover { color: var(--navy); }
        .dash-card-body { padding: 1.2rem 1.3rem; }

        /* ══ LIST ITEMS ══ */
        .list-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: .7rem 0;
            border-bottom: 1px solid var(--bdr);
        }
        .list-item:last-child { border-bottom: none; padding-bottom: 0; }
        .list-item:first-child { padding-top: 0; }
        .list-avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: var(--navy-pale);
            display: flex; align-items: center; justify-content: center;
            font-size: .7rem; font-weight: 700;
            color: var(--navy-mid); flex-shrink: 0;
        }
        .list-info { flex: 1; padding: 0 .65rem; min-width: 0; }
        .list-name { font-size: .8rem; font-weight: 600; color: var(--txt-1); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .list-sub { font-size: .68rem; color: var(--txt-3); margin-top: .08rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .list-time {
            font-size: .65rem; font-weight: 600;
            white-space: nowrap; flex-shrink: 0;
            background: rgba(22,163,74,0.08);
            color: var(--green);
            padding: .2rem .5rem; border-radius: 6px;
        }

        /* ══ QUIZ ITEMS ══ */
        .quiz-item {
            padding: .85rem;
            border: 1px solid var(--bdr);
            border-radius: 10px;
            margin-bottom: .6rem;
            transition: all var(--t);
        }
        .quiz-item:last-child { margin-bottom: 0; }
        .quiz-item:hover {
            border-color: rgba(10,31,68,0.18);
            box-shadow: 0 3px 12px rgba(10,31,68,0.06);
        }
        .quiz-item-top { display: flex; align-items: flex-start; justify-content: space-between; gap: .75rem; margin-bottom: .5rem; }
        .quiz-title { font-size: .82rem; font-weight: 700; color: var(--txt-1); }
        .quiz-badge {
            font-size: .62rem; font-weight: 700;
            padding: .18rem .5rem; border-radius: 5px;
            background: var(--gold-pale); color: var(--gold-d);
            border: 1px solid rgba(196,154,0,0.18);
            white-space: nowrap; flex-shrink: 0;
        }
        .quiz-meta { display: flex; gap: 1rem; font-size: .68rem; color: var(--txt-3); }
        .quiz-meta span { display: flex; align-items: center; gap: .25rem; }
        .quiz-actions { display: flex; gap: .5rem; margin-top: .6rem; }
        .quiz-btn {
            font-size: .72rem; font-weight: 600;
            padding: .32rem .7rem; border-radius: 7px;
            text-decoration: none;
            display: flex; align-items: center; gap: .3rem;
            transition: all var(--t);
        }
        .quiz-btn.edit {
            background: rgba(196,154,0,0.10); color: var(--gold-d);
            border: 1px solid rgba(196,154,0,0.20);
        }
        .quiz-btn.edit:hover { background: rgba(196,154,0,0.18); }
        .quiz-btn.results {
            background: var(--navy-pale); color: var(--navy-lite);
            border: 1px solid rgba(61,95,160,0.18);
        }
        .quiz-btn.results:hover { background: rgba(61,95,160,0.14); }

        /* ══ COURSE CARDS ══ */
        .course-card {
            background: var(--white);
            border: 1px solid var(--bdr);
            border-radius: 12px; padding: 1.1rem;
            transition: all var(--t);
        }
        .course-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 24px rgba(10,31,68,0.08);
            border-color: rgba(10,31,68,0.15);
        }
        .course-code-badge {
            font-size: .62rem; font-weight: 700;
            padding: .18rem .5rem; border-radius: 5px;
            background: var(--navy-pale); color: var(--navy-mid);
            display: inline-block; margin-bottom: .4rem;
        }
        .course-name {
            font-size: .9rem; font-weight: 700;
            color: var(--navy); margin-bottom: .6rem;
        }
        .course-students-badge {
            font-size: .65rem; font-weight: 700;
            padding: .2rem .55rem; border-radius: 6px;
            background: var(--gold-pale); color: var(--gold-d);
            border: 1px solid rgba(196,154,0,0.15);
            display: flex; align-items: center; gap: .25rem;
        }
        .course-meta {
            display: flex; justify-content: space-between;
            font-size: .68rem; color: var(--txt-3);
            border-top: 1px solid var(--bdr);
            padding-top: .6rem; margin-top: .6rem;
        }
        .course-meta span { display: flex; align-items: center; gap: .3rem; }
        .course-actions { display: flex; gap: .5rem; margin-top: .75rem; }
        .course-btn {
            flex: 1; text-align: center;
            font-size: .72rem; font-weight: 700;
            padding: .5rem; border-radius: 8px;
            text-decoration: none; transition: all var(--t);
        }
        .course-btn.primary { background: var(--navy); color: #fff; }
        .course-btn.primary:hover { background: var(--navy-mid); }
        .course-btn.secondary {
            background: var(--white); color: var(--txt-2);
            border: 1px solid var(--bdr);
        }
        .course-btn.secondary:hover { background: var(--bg); border-color: rgba(10,31,68,0.18); }

        /* ══ EMPTY STATE ══ */
        .empty-state {
            text-align: center; padding: 2rem 1rem;
            color: var(--txt-3); font-size: .8rem;
        }
        .empty-state i { font-size: 1.8rem; display: block; margin-bottom: .5rem; opacity: .4; }

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
        .modal-warn { font-size: .72rem; color: var(--txt-3); margin-top: .55rem; }
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
        .btn-cancel:hover { background: var(--bg); border-color: rgba(10,31,68,0.18); }
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

        /* ══ FOOTER NOTE ══ */
        .page-footer-note {
            text-align: center; font-size: .68rem;
            color: var(--txt-3);
            padding: 1.2rem 0 2rem;
            border-top: 1px solid var(--bdr); margin-top: .5rem;
        }

        /* ══ RESPONSIVE ══ */
        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .three-col  { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay { display: block; }
            .main-content { margin-left: 0; }
            .menu-toggle { display: flex; }
            .two-col, .three-col { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .welcome-banner { flex-direction: column; align-items: flex-start; }
            .welcome-right { align-self: flex-start; }
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
                <div class="topbar-breadcrumb">Faculty → Dashboard</div>
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

        <!-- ══ WELCOME BANNER ══ -->
        <div class="welcome-banner">
            <div class="welcome-arc"></div>
            <div class="welcome-arc2"></div>
            <div class="welcome-left">
                <div class="welcome-greeting">
                    <span class="welcome-greeting-dot"></span>
                    <span id="welcome-time-label">Good morning</span>
                </div>
                <div class="welcome-name">
                    Welcome back, <em>{{ Auth::user()->name }}</em>
                </div>
                <div class="welcome-pills">
                    <span class="welcome-pill">
                        <i class="ri-user-star-line"></i> Faculty
                    </span>
                    <span class="welcome-pill">
                        <i class="ri-map-pin-line"></i> National University
                    </span>
                    <span class="welcome-pill" id="welcome-day-pill">
                        <i class="ri-time-line"></i>
                    </span>
                </div>
            </div>
            <div class="welcome-right">
                <div class="welcome-date-box">
                    <div class="welcome-date-day" id="welcome-day"></div>
                    <div class="welcome-date-month" id="welcome-month"></div>
                </div>
            </div>
        </div>

        <!-- Section: Overview -->
        <div class="section-header">
            <h2><i class="ri-pulse-line" style="color:var(--gold-d);font-size:.85rem;"></i> Overview</h2>
        </div>

        <!-- Stat cards -->
        <div class="stats-grid">
            <div class="stat-card navy">
                <i class="ri-user-line stat-icon"></i>
                <div class="stat-label">Total Students</div>
                <div class="stat-value">{{ $totalStudents ?? 0 }}</div>
                <div class="stat-change up"><i class="ri-arrow-up-s-line"></i> Enrolled learners</div>
            </div>
            <div class="stat-card green">
                <i class="ri-book-line stat-icon"></i>
                <div class="stat-label">Total Courses</div>
                <div class="stat-value">{{ $totalCourses ?? 0 }}</div>
                <div class="stat-change neutral"><i class="ri-subtract-line"></i> Assigned subjects</div>
            </div>
            <div class="stat-card purple">
                <i class="ri-file-list-3-line stat-icon"></i>
                <div class="stat-label">Total Quizzes</div>
                <div class="stat-value">{{ $totalQuizzes ?? 0 }}</div>
                <div class="stat-change neutral"><i class="ri-subtract-line"></i> All assessments</div>
            </div>
            <div class="stat-card gold">
                <i class="ri-percent-line stat-icon"></i>
                <div class="stat-label">Avg. Score</div>
                <div class="stat-value">{{ $avgScore ?? 0 }}%</div>
                <div class="stat-change up"><i class="ri-arrow-up-s-line"></i> Class average</div>
            </div>
        </div>

        <!-- Section: Recent Activity -->
        <div class="section-header">
            <h2><i class="ri-time-line" style="color:var(--gold-d);font-size:.85rem;"></i> Recent Activity</h2>
        </div>

        <div class="two-col">
            <!-- Recent Enrollments -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div class="dash-card-title">
                        <i class="ri-user-add-line"></i> Recent Enrollments
                    </div>
                    <span class="dash-card-badge">Latest activity</span>
                </div>
                <div class="dash-card-body">
                    @if(isset($recentEnrollments) && $recentEnrollments->count() > 0)
                        @foreach($recentEnrollments as $enrollment)
                            <div class="list-item">
                                <div class="list-avatar">
                                    <i class="ri-user-smile-line" style="font-size:.8rem;"></i>
                                </div>
                                <div class="list-info">
                                    <div class="list-name">{{ $enrollment->student->name }}</div>
                                    <div class="list-sub">{{ $enrollment->course->name }}</div>
                                </div>
                                <div class="list-time">{{ $enrollment->created_at->diffForHumans() }}</div>
                            </div>
                        @endforeach
                    @else
                        <div class="empty-state">
                            <i class="ri-user-add-line"></i> No recent enrollments yet.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Quizzes -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div class="dash-card-title">
                        <i class="ri-quiz-line"></i> Recent Quizzes
                    </div>
                    <a href="{{ route('faculty.quizzes.list') }}" class="dash-card-link">
                        View All <i class="ri-arrow-right-s-line"></i>
                    </a>
                </div>
                <div class="dash-card-body">
                    @if(isset($recentQuizzes) && $recentQuizzes->count() > 0)
                        @foreach($recentQuizzes as $quiz)
                            <div class="quiz-item">
                                <div class="quiz-item-top">
                                    <div>
                                        <div class="quiz-title">{{ $quiz->title }}</div>
                                        <span class="quiz-badge">{{ $quiz->course->name ?? 'General' }}</span>
                                    </div>
                                </div>
                                <div class="quiz-meta">
                                    <span><i class="ri-question-line"></i> {{ $quiz->questions->count() }} questions</span>
                                    @if($quiz->duration_minutes)
                                        <span><i class="ri-timer-line"></i> {{ $quiz->duration_minutes }} mins</span>
                                    @endif
                                    <span><i class="ri-calendar-line"></i> {{ $quiz->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="quiz-actions">
                                    <a href="{{ route('faculty.edit.quiz', $quiz->id) }}" class="quiz-btn edit">
                                        <i class="ri-edit-line"></i> Edit
                                    </a>
                                    <a href="{{ route('faculty.submissions', $quiz->id) }}" class="quiz-btn results">
                                        <i class="ri-bar-chart-line"></i> Results
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="empty-state">
                            <i class="ri-quiz-line"></i> No quizzes created yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Section: My Courses -->
        <div class="section-header">
            <h2><i class="ri-book-open-line" style="color:var(--gold-d);font-size:.85rem;"></i> My Courses</h2>
        </div>

        <div class="dash-card" style="margin-bottom:1.8rem;">
            <div class="dash-card-head">
                <div class="dash-card-title">
                    <i class="ri-book-open-line"></i> Assigned Courses
                </div>
                @if(isset($courses) && $courses->count() > 0)
                    <a href="{{ route('faculty.courses') }}" class="dash-card-link">
                        Manage all <i class="ri-arrow-right-s-line"></i>
                    </a>
                @endif
            </div>
            <div class="dash-card-body">
                @if(isset($courses) && $courses->count() > 0)
                    <div class="three-col" style="margin-bottom:0;">
                        @foreach($courses as $course)
                            <div class="course-card">
                                <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:.2rem;">
                                    <div>
                                        <span class="course-code-badge">{{ $course->code }}</span>
                                        <div class="course-name">{{ $course->name }}</div>
                                    </div>
                                    <span class="course-students-badge">
                                        <i class="ri-group-line"></i> {{ $course->students_count ?? 0 }}
                                    </span>
                                </div>
                                <div class="course-meta">
                                    <span><i class="ri-quiz-line"></i> Quizzes: {{ $course->quizzes->count() ?? 0 }}</span>
                                    <span><i class="ri-file-line"></i> Materials: {{ $course->materials->count() ?? 0 }}</span>
                                </div>
                                <div class="course-actions">
                                    <a href="{{ route('faculty.quiz.create.for.course', $course->id) }}" class="course-btn primary">
                                        <i class="ri-quiz-line"></i> Create Quiz
                                    </a>
                                    <a href="{{ route('faculty.course.details', $course->id) }}" class="course-btn secondary">
                                        Manage
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="ri-book-line"></i> No courses assigned yet.
                    </div>
                @endif
            </div>
        </div>

        <div class="page-footer-note">
            <i class="ri-information-line"></i> Faculty dashboard — manage courses, quizzes, and track student performance.
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
    /* ── Date / time ── */
    const now = new Date();

    document.getElementById('topbar-date').textContent =
        now.toLocaleDateString('en-PH', { month: 'short', day: 'numeric', year: 'numeric' });

    document.getElementById('welcome-day').textContent   = now.getDate();
    document.getElementById('welcome-month').textContent =
        now.toLocaleDateString('en-PH', { month: 'short', year: 'numeric' });

    const hour = now.getHours();
    document.getElementById('welcome-time-label').textContent =
        hour < 12 ? 'Good morning' : hour < 17 ? 'Good afternoon' : 'Good evening';

    const days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    document.getElementById('welcome-day-pill').innerHTML =
        `<i class="ri-time-line"></i> ${days[now.getDay()]}`;

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
        e.preventDefault();
        openLogoutModal();
    });
    document.getElementById('confirmLogoutBtn').addEventListener('click', function() {
        document.getElementById('logoutForm').submit();
    });
    document.getElementById('logoutModal').addEventListener('click', function(e) {
        if (e.target === this) closeLogoutModal();
    });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLogoutModal(); });
</script>
</body>
</html>