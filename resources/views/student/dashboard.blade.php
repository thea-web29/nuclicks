<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard – NU Horizon LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        /* ══ DESIGN TOKENS — identical to faculty/admin ══ */
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
            --blue:      #3b82f6;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            color: var(--txt-1);
        }

        *:focus { outline: none !important; }

        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(10,31,68,0.15); border-radius: 99px; }

        /* ══ SIDEBAR ══ */
        .sidebar {
            position: fixed; top: 0; left: 0;
            width: var(--sidebar-w); height: 100vh;
            background: var(--navy);
            display: flex; flex-direction: column;
            z-index: 100; transition: transform .3s var(--ease);
            box-shadow: 4px 0 32px rgba(0,0,0,0.18);
        }
        .sidebar::before {
            content: ""; position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), var(--gold-mid), transparent);
            background-size: 200% 100%; animation: shimmer 4s linear infinite;
        }
        @keyframes shimmer { 0% { background-position: -200% center; } 100% { background-position: 200% center; } }
        .sidebar::after {
            content: ""; position: absolute; inset: 0;
            background-image: linear-gradient(rgba(255,255,255,0.012) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.012) 1px, transparent 1px);
            background-size: 32px 32px; pointer-events: none;
        }
        .sidebar-arc {
            position: absolute; width: 340px; height: 340px; border-radius: 50%;
            border: 1px solid rgba(255,215,15,0.06); bottom: -60px; left: -100px;
            pointer-events: none; z-index: 0;
        }
        .sidebar-inner { position: relative; z-index: 1; display: flex; flex-direction: column; height: 100%; }

        .sidebar-logo {
            padding: 1.5rem 1.4rem 1.3rem; display: flex; align-items: center; gap: .85rem;
            border-bottom: 1px solid rgba(255,215,15,0.14);
        }
        .logo-seal-wrap { position: relative; flex-shrink: 0; }
        .logo-seal { width: 40px; height: 40px; border-radius: 50%; object-fit: contain; background: rgba(255,255,255,0.07); border: 1.5px solid rgba(255,215,15,0.30); display: block; }
        .logo-seal-ring { position: absolute; inset: -3px; border-radius: 50%; border: 1.5px solid rgba(255,215,15,0.28); animation: rotateSlow 14s linear infinite; }
        @keyframes rotateSlow { from { transform:rotate(0deg); } to { transform:rotate(360deg); } }
        .logo-seal-ring::before {
            content: ""; position: absolute; top: -2px; left: 50%; transform: translateX(-50%);
            width: 4px; height: 4px; border-radius: 50%; background: var(--gold); box-shadow: 0 0 5px var(--gold);
        }
        .logo-text h1 { font-family: 'Fraunces', serif; font-size: 1.15rem; font-weight: 700; color: #fff; letter-spacing: -.02em; line-height: 1.1; }
        .logo-text h1 em { color: var(--gold); font-style: normal; }
        .logo-text p { font-size: .65rem; font-weight: 600; letter-spacing: .10em; text-transform: uppercase; color: rgba(255,255,255,0.40); margin-top: .15rem; }

        .nav-body { flex: 1; overflow-y: auto; padding: 1.2rem .85rem; display: flex; flex-direction: column; gap: 1.6rem; }
        .nav-section-label { font-size: .62rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; color: rgba(255,215,15,0.50); margin-bottom: .4rem; padding-left: .4rem; }
        .nav-item {
            display: flex; align-items: center; gap: .7rem; padding: .62rem .85rem; border-radius: 10px;
            color: rgba(255,255,255,0.70); text-decoration: none; font-size: .82rem; font-weight: 500;
            transition: all var(--t); margin-bottom: .15rem;
        }
        .nav-item i { font-size: 1.05rem; width: 1.25rem; flex-shrink: 0; }
        .nav-item:hover { background: rgba(255,215,15,0.10); color: rgba(255,255,255,0.92); }
        .nav-item.active { background: var(--gold); color: var(--navy); font-weight: 700; box-shadow: 0 4px 14px rgba(255,215,15,0.30); }
        .nav-item.active i { color: var(--navy); }
        .nav-badge { margin-left: auto; background: var(--danger); color: #fff; font-size: .6rem; font-weight: 700; padding: .1rem .45rem; border-radius: 99px; flex-shrink: 0; }

        .sidebar-footer { padding: 1rem 1.2rem; border-top: 1px solid rgba(255,215,15,0.14); }
        .profile-row { display: flex; align-items: center; gap: .75rem; margin-bottom: .85rem; }
        .avatar { width: 38px; height: 38px; border-radius: 50%; background: rgba(255,215,15,0.15); border: 1.5px solid rgba(255,215,15,0.30); display: flex; align-items: center; justify-content: center; color: var(--gold); font-size: 1rem; flex-shrink: 0; }
        .profile-name { font-size: .82rem; font-weight: 700; color: #fff; }
        .profile-email { font-size: .68rem; color: rgba(255,255,255,0.42); margin-top: .1rem; }
        .logout-btn { width: 100%; padding: .58rem .9rem; border-radius: 8px; background: rgba(220,38,38,0.12); border: 1px solid rgba(220,38,38,0.22); color: #fca5a5; font-size: .78rem; font-weight: 600; font-family: 'Plus Jakarta Sans', sans-serif; display: flex; align-items: center; justify-content: center; gap: .5rem; cursor: pointer; transition: all var(--t); }
        .logout-btn:hover { background: var(--danger); border-color: var(--danger); color: #fff; box-shadow: 0 4px 12px rgba(220,38,38,0.35); }

        /* ══ MAIN ══ */
        .main-content { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }

        .topbar {
            position: sticky; top: 0; z-index: 50;
            background: rgba(248,246,241,0.88); backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--bdr);
            padding: .9rem 2rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem;
        }
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

        .page-body { padding: 1.8rem 2rem; flex: 1; }

        .section-header { margin-bottom: 1.4rem; }
        .section-header h2 { font-size: .65rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; color: var(--txt-3); display: flex; align-items: center; gap: .5rem; }
        .section-header h2::after { content: ""; flex: 1; height: 1px; background: var(--bdr); }

        @keyframes fadeUp { from { opacity:0; transform:translateY(16px); } to { opacity:1; transform:translateY(0); } }

        /* ══ WELCOME BANNER — same as faculty dashboard ══ */
        .welcome-banner {
            background: var(--navy); border-radius: 16px; padding: 1.6rem 2rem;
            margin-bottom: 1.8rem; display: flex; align-items: center; justify-content: space-between; gap: 1.5rem;
            position: relative; overflow: hidden;
            box-shadow: 0 6px 28px rgba(10,31,68,0.18); border: 1px solid rgba(255,215,15,0.12);
            animation: fadeUp .45s var(--ease) both;
        }
        .welcome-banner::before { content: ""; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, transparent, var(--gold), var(--gold-mid), transparent); background-size: 200% 100%; animation: shimmer 4s linear infinite; }
        .welcome-banner::after { content: ""; position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,0.012) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.012) 1px, transparent 1px); background-size: 32px 32px; pointer-events: none; }
        .welcome-arc { position: absolute; width: 280px; height: 280px; border-radius: 50%; border: 1px solid rgba(255,215,15,0.07); right: -60px; top: -100px; pointer-events: none; z-index: 0; }
        .welcome-left { position: relative; z-index: 1; }
        .welcome-greeting { font-size: .68rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: rgba(255,255,255,0.45); margin-bottom: .35rem; display: flex; align-items: center; gap: .4rem; }
        .welcome-dot { width: 5px; height: 5px; border-radius: 50%; background: var(--gold); box-shadow: 0 0 5px var(--gold); }
        .welcome-name { font-family: 'Fraunces', serif; font-size: 1.6rem; font-weight: 700; color: #fff; letter-spacing: -.03em; line-height: 1.15; margin-bottom: .5rem; }
        .welcome-name em { color: var(--gold); font-style: normal; }
        .welcome-pills { display: flex; align-items: center; gap: .5rem; flex-wrap: wrap; }
        .welcome-pill { display: inline-flex; align-items: center; gap: .3rem; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,215,15,0.14); border-radius: 20px; padding: .22rem .65rem; font-size: .68rem; font-weight: 600; color: rgba(255,255,255,0.65); }
        .welcome-pill i { font-size: .75rem; color: var(--gold-mid); }
        .welcome-right { position: relative; z-index: 1; flex-shrink: 0; }
        .welcome-date-box { background: rgba(255,215,15,0.10); border: 1px solid rgba(255,215,15,0.20); border-radius: 12px; padding: .9rem 1.2rem; text-align: center; min-width: 100px; }
        .welcome-date-day { font-family: 'Fraunces', serif; font-size: 2.2rem; font-weight: 700; color: var(--gold); line-height: 1; letter-spacing: -.04em; }
        .welcome-date-month { font-size: .65rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: rgba(255,255,255,0.45); margin-top: .2rem; }

        /* ══ STAT CARDS ══ */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.8rem; }
        .stat-card { background: var(--white); border-radius: 14px; padding: 1.2rem 1.1rem; border: 1px solid var(--bdr); box-shadow: 0 2px 12px rgba(10,31,68,0.04); transition: all var(--t); position: relative; overflow: hidden; animation: fadeUp .5s var(--ease) both; }
        .stat-card:nth-child(1) { animation-delay: .06s; }
        .stat-card:nth-child(2) { animation-delay: .12s; }
        .stat-card:nth-child(3) { animation-delay: .18s; }
        .stat-card:nth-child(4) { animation-delay: .24s; }
        .stat-card::before { content: ""; position: absolute; top: 0; left: 0; right: 0; height: 3px; border-radius: 14px 14px 0 0; }
        .stat-card.navy::before   { background: linear-gradient(90deg, var(--navy-lite), var(--navy)); }
        .stat-card.green::before  { background: linear-gradient(90deg, #4ade80, #16a34a); }
        .stat-card.purple::before { background: linear-gradient(90deg, #a78bfa, #7c3aed); }
        .stat-card.gold::before   { background: linear-gradient(90deg, var(--gold-mid), var(--gold-d)); }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(10,31,68,0.10); border-color: rgba(10,31,68,0.15); }
        .stat-label { font-size: .7rem; font-weight: 600; color: var(--txt-3); text-transform: uppercase; letter-spacing: .04em; margin-bottom: .5rem; }
        .stat-value { font-family: 'Fraunces', serif; font-size: 2rem; font-weight: 700; line-height: 1; letter-spacing: -.04em; margin-bottom: .35rem; }
        .stat-card.navy   .stat-value { color: var(--navy); }
        .stat-card.green  .stat-value { color: var(--green); }
        .stat-card.purple .stat-value { color: var(--purple); }
        .stat-card.gold   .stat-value { color: var(--gold-d); }
        .stat-icon { position: absolute; right: .85rem; top: .85rem; font-size: 1.55rem; opacity: .12; }
        .stat-change { font-size: .68rem; font-weight: 600; display: flex; align-items: center; gap: .2rem; color: var(--txt-3); }
        .stat-change.up { color: var(--green); }

        /* ══ LAYOUT ══ */
        .main-grid { display: grid; grid-template-columns: 1fr 340px; gap: 1.2rem; }
        .left-col  { display: flex; flex-direction: column; gap: 1.2rem; }

        /* ══ DASH CARD ══ */
        .dash-card { background: var(--white); border-radius: 14px; border: 1px solid var(--bdr); box-shadow: 0 2px 12px rgba(10,31,68,0.04); overflow: hidden; animation: fadeUp .55s var(--ease) .18s both; }
        .dash-card-head { padding: 1.1rem 1.3rem .9rem; border-bottom: 1px solid var(--bdr); display: flex; align-items: center; justify-content: space-between; }
        .dash-card-title { font-size: .82rem; font-weight: 700; color: var(--txt-1); display: flex; align-items: center; gap: .5rem; }
        .dash-card-title i { color: var(--gold-d); font-size: .9rem; }
        .dash-card-badge { font-size: .65rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase; color: var(--txt-3); background: var(--bg); border: 1px solid var(--bdr); border-radius: 6px; padding: .2rem .55rem; }
        .dash-card-body { padding: 1.2rem 1.3rem; }

        /* ══ COURSE ITEMS ══ */
        .course-item { border: 1px solid var(--bdr); border-radius: 12px; padding: 1rem 1.1rem; margin-bottom: .7rem; transition: all var(--t); }
        .course-item:last-child { margin-bottom: 0; }
        .course-item:hover { border-color: rgba(10,31,68,0.18); box-shadow: 0 4px 16px rgba(10,31,68,0.07); }
        .course-item-top { display: flex; align-items: flex-start; justify-content: space-between; gap: .75rem; margin-bottom: .6rem; }
        .course-code-badge { font-size: .62rem; font-weight: 700; padding: .18rem .5rem; border-radius: 5px; background: var(--navy-pale); color: var(--navy-mid); display: inline-block; margin-bottom: .3rem; }
        .course-credits { font-size: .65rem; color: var(--txt-3); margin-left: .4rem; }
        .course-name-text { font-family: 'Fraunces', serif; font-size: .95rem; font-weight: 700; color: var(--navy); line-height: 1.25; }
        .course-desc { font-size: .72rem; color: var(--txt-3); margin-top: .25rem; line-height: 1.45; }
        .course-meta-row { display: flex; flex-wrap: wrap; gap: .75rem; font-size: .7rem; color: var(--txt-3); margin-top: .5rem; }
        .course-meta-row span { display: flex; align-items: center; gap: .25rem; }
        .course-meta-row i { font-size: .78rem; }
        .btn-view-course { display: inline-flex; align-items: center; gap: .35rem; padding: .42rem .9rem; border-radius: 8px; border: none; background: var(--navy); color: #fff; font-size: .72rem; font-weight: 700; font-family: 'Plus Jakarta Sans', sans-serif; text-decoration: none; cursor: pointer; transition: all var(--t); white-space: nowrap; flex-shrink: 0; }
        .btn-view-course:hover { background: var(--navy-mid); transform: translateY(-1px); }
        .progress-row { margin-top: .65rem; }
        .progress-label-row { display: flex; justify-content: space-between; font-size: .68rem; color: var(--txt-3); margin-bottom: .28rem; }
        .progress-track { height: 5px; background: var(--bg); border-radius: 99px; overflow: hidden; border: 1px solid var(--bdr); }
        .progress-fill { height: 100%; border-radius: 99px; background: linear-gradient(90deg, var(--gold-mid), var(--gold-d)); }

        /* ══ ANNOUNCEMENTS ══ */
        .announcement-item { padding: .8rem 0; border-bottom: 1px solid var(--bdr); }
        .announcement-item:last-child { border-bottom: none; padding-bottom: 0; }
        .announcement-item:first-child { padding-top: 0; }
        .announcement-bar { display: flex; gap: .75rem; }
        .announcement-accent { width: 3px; border-radius: 99px; background: var(--gold-d); flex-shrink: 0; align-self: stretch; }
        .announcement-title { font-size: .8rem; font-weight: 700; color: var(--txt-1); margin-bottom: .2rem; }
        .announcement-content { font-size: .72rem; color: var(--txt-2); line-height: 1.45; margin-bottom: .3rem; }
        .announcement-footer { display: flex; justify-content: space-between; align-items: center; }
        .announcement-course { font-size: .65rem; color: var(--navy-lite); font-weight: 600; }
        .announcement-time  { font-size: .63rem; color: var(--txt-3); }

        /* ══ QUIZ ITEMS ══ */
        .quiz-item { border: 1px solid var(--bdr); border-radius: 10px; padding: .9rem; margin-bottom: .65rem; transition: all var(--t); }
        .quiz-item:last-child { margin-bottom: 0; }
        .quiz-item:hover { border-color: rgba(10,31,68,0.18); box-shadow: 0 3px 12px rgba(10,31,68,0.06); }
        .quiz-item-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: .45rem; }
        .status-badge { font-size: .62rem; font-weight: 700; padding: .18rem .55rem; border-radius: 99px; }
        .badge-upcoming { background: var(--gold-pale); color: var(--gold-d); border: 1px solid rgba(196,154,0,0.18); }
        .quiz-q-count { font-size: .65rem; color: var(--txt-3); }
        .quiz-title-text { font-size: .82rem; font-weight: 700; color: var(--txt-1); margin-bottom: .2rem; }
        .quiz-course-name { font-size: .68rem; color: var(--txt-3); margin-bottom: .5rem; }
        .quiz-meta-list { display: flex; flex-direction: column; gap: .22rem; }
        .quiz-meta-item { font-size: .7rem; color: var(--txt-3); display: flex; align-items: center; gap: .35rem; }
        .quiz-meta-item i { font-size: .75rem; }
        .btn-take-quiz { display: block; text-align: center; margin-top: .7rem; padding: .52rem; border-radius: 8px; border: none; background: var(--green); color: #fff; font-size: .75rem; font-weight: 700; font-family: 'Plus Jakarta Sans', sans-serif; text-decoration: none; transition: all var(--t); box-shadow: 0 2px 8px rgba(22,163,74,0.22); }
        .btn-take-quiz:hover { background: #15803d; transform: translateY(-1px); }

        /* ══ EMPTY STATES ══ */
        .empty-state { text-align: center; padding: 2.5rem 1rem; color: var(--txt-3); font-size: .8rem; }
        .empty-state i { font-size: 2.2rem; display: block; margin-bottom: .55rem; opacity: .3; }

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

        @media (max-width: 1200px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay { display: block; }
            .main-content { margin-left: 0; }
            .menu-toggle { display: flex; }
            .main-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .page-body { padding: 1.2rem 1rem; }
            .topbar { padding: .8rem 1rem; }
            .welcome-banner { flex-direction: column; align-items: flex-start; }
        }
        @media (max-width: 420px) { .stats-grid { grid-template-columns: 1fr; } }
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
                <p>Student Portal · National University</p>
            </div>
        </div>

        <div class="nav-body">
            <div>
                <div class="nav-section-label">Main</div>
                <a href="{{ route('student.dashboard') }}" class="nav-item {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>
                <a href="{{ route('student.courses') }}" class="nav-item {{ request()->routeIs('student.courses*') ? 'active' : '' }}">
                    <i class="ri-book-line"></i> My Courses
                </a>
                <a href="{{ route('student.progress') }}" class="nav-item {{ request()->routeIs('student.progress*') ? 'active' : '' }}">
                    <i class="ri-bar-chart-line"></i> Progress
                </a>
                <a href="{{ route('student.announcements') }}" class="nav-item {{ request()->routeIs('student.announcements*') ? 'active' : '' }}">
                    <i class="ri-megaphone-line"></i> Announcements
                </a>
                <a href="{{ route('student.notifications') }}" class="nav-item {{ request()->routeIs('student.notifications*') ? 'active' : '' }}">
                    <i class="ri-notification-line"></i> Notifications
                    @if(isset($unreadNotifications) && $unreadNotifications > 0)
                        <span class="nav-badge">{{ $unreadNotifications }}</span>
                    @endif
                </a>
                <a href="{{ route('student.faculty.evaluation') }}" class="nav-item {{ request()->routeIs('student.faculty.evaluation') ? 'active' : '' }}">
                    <i class="ri-star-line"></i> Faculty Evaluation
                </a>
            </div>
            <div>
                <div class="nav-section-label">Account</div>
                <a href="{{ route('student.profile') }}" class="nav-item {{ request()->routeIs('student.profile*') ? 'active' : '' }}">
                    <i class="ri-user-line"></i> Profile
                </a>
            </div>
        </div>

        <div class="sidebar-footer">
            <div class="profile-row">
                <div class="avatar"><i class="ri-graduation-cap-line"></i></div>
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

    <header class="topbar">
        <div class="topbar-left">
            <button class="menu-toggle" id="menuToggle" onclick="toggleSidebar()">
                <i class="ri-menu-2-line"></i>
            </button>
            <div>
                <div class="topbar-title">NU Horizon <em>LMS</em></div>
                <div class="topbar-breadcrumb">Student → Dashboard</div>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-badge"><span class="topbar-dot"></span> System Online</div>
            <div class="topbar-badge"><i class="ri-calendar-line"></i><span id="topbar-date"></span></div>
        </div>
    </header>

    <div class="page-body">

        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="welcome-arc"></div>
            <div class="welcome-left">
                <div class="welcome-greeting">
                    <span class="welcome-dot"></span>
                    <span id="welcome-time-label">Good morning</span>
                </div>
                <div class="welcome-name">Welcome back, <em>{{ Auth::user()->name }}</em></div>
                <div class="welcome-pills">
                    <span class="welcome-pill"><i class="ri-graduation-cap-line"></i> Student</span>
                    <span class="welcome-pill"><i class="ri-map-pin-line"></i> National University</span>
                    <span class="welcome-pill" id="welcome-day-pill"><i class="ri-time-line"></i></span>
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

        <div class="stats-grid">
            <div class="stat-card navy">
                <i class="ri-book-line stat-icon"></i>
                <div class="stat-label">Enrolled Courses</div>
                <div class="stat-value">{{ $enrolledCourses->count() }}</div>
                <div class="stat-change up"><i class="ri-arrow-up-s-line"></i> Active courses</div>
            </div>
            <div class="stat-card green">
                <i class="ri-checkbox-circle-line stat-icon"></i>
                <div class="stat-label">Completed Quizzes</div>
                <div class="stat-value">{{ $completedQuizzes }}</div>
                <div class="stat-change up"><i class="ri-arrow-up-s-line"></i> Finished</div>
            </div>
            <div class="stat-card purple">
                <i class="ri-bar-chart-line stat-icon"></i>
                <div class="stat-label">Average Score</div>
                <div class="stat-value">{{ $averageScore }}%</div>
                <div class="stat-change up"><i class="ri-arrow-up-s-line"></i> Overall average</div>
            </div>
            <div class="stat-card gold">
                <i class="ri-time-line stat-icon"></i>
                <div class="stat-label">Pending Quizzes</div>
                <div class="stat-value">{{ $pendingQuizzes }}</div>
                <div class="stat-change neutral"><i class="ri-subtract-line"></i> To complete</div>
            </div>
        </div>

        <!-- Section: Activity -->
        <div class="section-header">
            <h2><i class="ri-time-line" style="color:var(--gold-d);font-size:.85rem;"></i> My Activity</h2>
        </div>

        <div class="main-grid">
            <!-- Left col -->
            <div class="left-col">

                <!-- Enrolled Courses -->
                <div class="dash-card">
                    <div class="dash-card-head">
                        <div class="dash-card-title"><i class="ri-book-open-line"></i> My Enrolled Courses</div>
                        <span class="dash-card-badge">{{ $enrolledCourses->count() }} courses</span>
                    </div>
                    <div class="dash-card-body">
                        @if($enrolledCourses->count() > 0)
                            @foreach($enrolledCourses as $enrollment)
                                <div class="course-item">
                                    <div class="course-item-top">
                                        <div style="flex:1;min-width:0;">
                                            <div>
                                                <span class="course-code-badge">{{ $enrollment->course->code }}</span>
                                                <span class="course-credits">{{ $enrollment->course->credits }} credits</span>
                                            </div>
                                            <div class="course-name-text">{{ $enrollment->course->name }}</div>
                                            <div class="course-desc">{{ Str::limit($enrollment->course->description ?? 'No description available.', 100) }}</div>
                                            <div class="course-meta-row">
                                                <span><i class="ri-user-line"></i> {{ $enrollment->course->faculty->name ?? 'N/A' }}</span>
                                                <span><i class="ri-quiz-line"></i> {{ $enrollment->course->quizzes->count() }} Quizzes</span>
                                            </div>
                                        </div>
                                        <a href="{{ route('student.course.details', $enrollment->course->id) }}" class="btn-view-course">
                                            View <i class="ri-arrow-right-line"></i>
                                        </a>
                                    </div>
                                    <div class="progress-row">
                                        <div class="progress-label-row">
                                            <span>Progress</span>
                                            <span>{{ $enrollment->progress ?? 0 }}%</span>
                                        </div>
                                        <div class="progress-track">
                                            <div class="progress-fill" style="width:{{ $enrollment->progress ?? 0 }}%;"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <i class="ri-book-line"></i>
                                You are not enrolled in any courses yet.
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Announcements -->
                <div class="dash-card">
                    <div class="dash-card-head">
                        <div class="dash-card-title"><i class="ri-megaphone-line"></i> Recent Announcements</div>
                        <span class="dash-card-badge">Latest</span>
                    </div>
                    <div class="dash-card-body">
                        @if($announcements->count() > 0)
                            @foreach($announcements as $announcement)
                                <div class="announcement-item">
                                    <div class="announcement-bar">
                                        <div class="announcement-accent"></div>
                                        <div style="flex:1;min-width:0;">
                                            <div class="announcement-title">{{ $announcement->title }}</div>
                                            <div class="announcement-content">{{ $announcement->content }}</div>
                                            <div class="announcement-footer">
                                                <span class="announcement-course">{{ $announcement->course->name }}</span>
                                                <span class="announcement-time">{{ $announcement->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state"><i class="ri-megaphone-line"></i> No announcements yet.</div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Right col: Upcoming Quizzes -->
            <div>
                <div class="dash-card">
                    <div class="dash-card-head">
                        <div class="dash-card-title"><i class="ri-quiz-line"></i> Upcoming Quizzes</div>
                        <span class="dash-card-badge">{{ $upcomingQuizzes->count() }}</span>
                    </div>
                    <div class="dash-card-body">
                        @if($upcomingQuizzes->count() > 0)
                            @foreach($upcomingQuizzes as $quiz)
                                <div class="quiz-item">
                                    <div class="quiz-item-head">
                                        <span class="status-badge badge-upcoming">Upcoming</span>
                                        <span class="quiz-q-count">{{ $quiz->questions->count() }} questions</span>
                                    </div>
                                    <div class="quiz-title-text">{{ $quiz->title }}</div>
                                    <div class="quiz-course-name">{{ $quiz->course->name }}</div>
                                    <div class="quiz-meta-list">
                                        @if($quiz->start_date)
                                            <div class="quiz-meta-item">
                                                <i class="ri-calendar-line"></i>
                                                Starts: {{ \Carbon\Carbon::parse($quiz->start_date)->format('M d, Y h:i A') }}
                                            </div>
                                        @endif
                                        @if($quiz->duration_minutes)
                                            <div class="quiz-meta-item">
                                                <i class="ri-time-line"></i>
                                                Duration: {{ $quiz->duration_minutes }} minutes
                                            </div>
                                        @endif
                                        <div class="quiz-meta-item">
                                            <i class="ri-star-line"></i>
                                            Points: {{ $quiz->total_points }}
                                        </div>
                                    </div>
                                    <a href="{{ route('student.quiz.take', $quiz->id) }}" class="btn-take-quiz">
                                        <i class="ri-play-circle-line"></i> Take Quiz
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <i class="ri-quiz-line"></i>
                                No upcoming quizzes.<br>
                                <span style="font-size:.72rem;">Check back later for new quizzes.</span>
                            </div>
                        @endif
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
    const now = new Date();
    document.getElementById('topbar-date').textContent = now.toLocaleDateString('en-PH', { month: 'short', day: 'numeric', year: 'numeric' });
    document.getElementById('welcome-day').textContent = now.getDate();
    document.getElementById('welcome-month').textContent = now.toLocaleDateString('en-PH', { month: 'short', year: 'numeric' });
    const hour = now.getHours();
    document.getElementById('welcome-time-label').textContent = hour < 12 ? 'Good morning' : hour < 17 ? 'Good afternoon' : 'Good evening';
    const days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    document.getElementById('welcome-day-pill').innerHTML = '<i class="ri-time-line"></i> ' + days[now.getDay()];

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
    function openLogoutModal() { document.getElementById('logoutModal').classList.add('active'); document.body.style.overflow = 'hidden'; }
    function closeLogoutModal() { document.getElementById('logoutModal').classList.remove('active'); document.body.style.overflow = ''; }
    document.getElementById('logoutButton').addEventListener('click', function(e) { e.preventDefault(); openLogoutModal(); });
    document.getElementById('confirmLogoutBtn').addEventListener('click', () => { document.getElementById('logoutForm').submit(); });
    document.getElementById('logoutModal').addEventListener('click', function(e) { if (e.target === this) closeLogoutModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLogoutModal(); });
</script>
</body>
</html>