<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Bank – NU Horizon LMS</title>
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
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            border-radius: 14px 14px 0 0;
        }
        .stat-card.navy::before   { background: linear-gradient(90deg, var(--navy-lite), var(--navy)); }
        .stat-card.green::before  { background: linear-gradient(90deg, #4ade80, #16a34a); }
        .stat-card.blue::before   { background: linear-gradient(90deg, #93c5fd, #3b82f6); }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(10,31,68,0.10); }
        .stat-label { font-size: .7rem; font-weight: 600; color: var(--txt-3); text-transform: uppercase; letter-spacing: .04em; margin-bottom: .4rem; }
        .stat-value {
            font-family: 'Fraunces', serif;
            font-size: 2rem; font-weight: 700;
            line-height: 1; letter-spacing: -.04em;
        }
        .stat-card.navy  .stat-value { color: var(--navy); }
        .stat-card.green .stat-value { color: var(--green); }
        .stat-card.blue  .stat-value { color: var(--blue); }
        .stat-icon {
            position: absolute;
            right: .85rem; top: .85rem;
            font-size: 1.55rem; opacity: .10;
        }

        @keyframes fadeUp {
            from { opacity:0; transform:translateY(16px); }
            to   { opacity:1; transform:translateY(0); }
        }

        /* ══ DASH CARD ══ */
        .dash-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--bdr);
            box-shadow: 0 2px 12px rgba(10,31,68,0.04);
            overflow: hidden;
            animation: fadeUp .5s var(--ease) .2s both;
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
        .btn-add {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .48rem 1rem;
            border-radius: 8px; border: none;
            background: var(--navy); color: #fff;
            font-size: .78rem; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all var(--t);
            box-shadow: 0 2px 8px rgba(10,31,68,0.18);
        }
        .btn-add:hover { background: var(--navy-mid); transform: translateY(-1px); }

        /* ══ QUESTION ITEMS ══ */
        .question-item {
            padding: 1rem 1.3rem;
            border-bottom: 1px solid var(--bdr);
            transition: background var(--t);
        }
        .question-item:last-child { border-bottom: none; }
        .question-item:hover { background: var(--gold-pale); }
        .question-item-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }
        .question-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: .45rem;
            margin-bottom: .45rem;
        }
        .badge {
            display: inline-flex; align-items: center; gap: .25rem;
            padding: .18rem .6rem;
            border-radius: 99px;
            font-size: .65rem; font-weight: 700;
        }
        .badge-mcq    { background: rgba(22,163,74,0.12); color: var(--green); }
        .badge-tf     { background: rgba(59,130,246,0.12); color: var(--blue); }
        .badge-essay  { background: rgba(124,58,237,0.12); color: var(--purple); }
        .quiz-link {
            font-size: .72rem; font-weight: 600;
            color: var(--navy-lite); text-decoration: none;
        }
        .quiz-link:hover { color: var(--navy); text-decoration: underline; }
        .points-label {
            font-size: .68rem; color: var(--txt-3); font-weight: 500;
        }
        .question-text {
            font-size: .82rem; font-weight: 600;
            color: var(--txt-1); line-height: 1.45;
        }
        .question-options { margin-top: .55rem; display: flex; flex-direction: column; gap: .22rem; }
        .option-line {
            font-size: .75rem; color: var(--txt-2);
            display: flex; align-items: center; gap: .35rem;
        }
        .option-line.correct { color: var(--green); font-weight: 700; }
        .option-line i { font-size: .7rem; }
        .correct-answer-label {
            font-size: .75rem; color: var(--green); font-weight: 700;
            margin-top: .4rem;
        }
        .question-actions { display: flex; gap: .35rem; flex-shrink: 0; }
        .q-btn {
            width: 30px; height: 30px;
            border-radius: 7px; border: none;
            background: transparent;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all var(--t);
            font-size: .95rem;
        }
        .q-btn.edit   { background: rgba(59,130,246,0.10); color: var(--blue); }
        .q-btn.edit:hover { background: var(--blue); color: #fff; }
        .q-btn.delete { background: rgba(220,38,38,0.10); color: var(--danger); }
        .q-btn.delete:hover { background: var(--danger); color: #fff; }

        /* ══ EMPTY STATE ══ */
        .empty-state {
            text-align: center; padding: 3.5rem 1rem;
            color: var(--txt-3); font-size: .82rem;
        }
        .empty-state i { font-size: 2.8rem; display: block; margin-bottom: .65rem; opacity: .3; }

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
            border-radius: 18px;
            width: min(640px, 94vw);
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
        .modal-body-scroll {
            padding: 1.5rem 1.6rem 1.2rem;
            max-height: 65vh;
            overflow-y: auto;
        }
        .modal-body-scroll::-webkit-scrollbar { width: 4px; }
        .modal-body-scroll::-webkit-scrollbar-thumb { background: var(--gold-mid); border-radius: 99px; }
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
        .form-group:last-child { margin-bottom: 0; }
        .form-label {
            display: block;
            font-size: .75rem; font-weight: 700;
            color: var(--txt-2); margin-bottom: .35rem;
        }
        .form-label span { color: var(--danger); }
        .form-hint { font-size: .65rem; color: var(--txt-3); margin-top: .25rem; }
        .form-control {
            width: 100%;
            padding: .58rem .9rem;
            border: 1px solid var(--bdr);
            border-radius: 9px;
            font-size: .82rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--txt-1);
            background: var(--bg);
            transition: border-color var(--t), background var(--t), box-shadow var(--t);
        }
        .form-control:focus {
            border-color: var(--gold-d);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(196,154,0,0.12);
        }
        textarea.form-control { resize: vertical; min-height: 75px; }

        /* Option rows */
        .option-row {
            display: flex; align-items: center; gap: .6rem;
            margin-bottom: .55rem;
        }
        .option-row input[type="text"] { flex: 1; }
        .correct-radio {
            width: 15px; height: 15px;
            accent-color: var(--gold-d);
            cursor: pointer; flex-shrink: 0;
        }
        .remove-option-btn {
            color: var(--txt-3); font-size: 1rem;
            cursor: pointer; transition: color var(--t);
            flex-shrink: 0;
        }
        .remove-option-btn:hover { color: var(--danger); }
        .add-option-btn {
            display: inline-flex; align-items: center; gap: .3rem;
            font-size: .75rem; font-weight: 600;
            color: var(--navy-lite);
            cursor: pointer; transition: color var(--t);
            margin-top: .3rem;
        }
        .add-option-btn:hover { color: var(--navy); }

        /* Radio group */
        .radio-group { display: flex; gap: 1.2rem; margin-top: .35rem; }
        .radio-group label {
            display: flex; align-items: center; gap: .4rem;
            font-size: .82rem; color: var(--txt-2); cursor: pointer;
        }
        .radio-group input[type="radio"] { accent-color: var(--gold-d); }

        /* Buttons */
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
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay { display: block; }
            .main-content { margin-left: 0; }
            .menu-toggle { display: flex; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 640px) {
            .stats-grid { grid-template-columns: 1fr; }
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
                <div class="topbar-breadcrumb">Faculty → Quiz Management → Question Bank</div>
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
            <h2><i class="ri-database-2-line" style="color:var(--gold-d);font-size:.85rem;"></i> Question Bank</h2>
        </div>

        <!-- Stat cards -->
        <div class="stats-grid">
            <div class="stat-card navy">
                <i class="ri-questionnaire-line stat-icon"></i>
                <div class="stat-label">Total Questions</div>
                <div class="stat-value">{{ $questions->count() }}</div>
            </div>
            <div class="stat-card green">
                <i class="ri-list-check-2 stat-icon"></i>
                <div class="stat-label">MCQ Questions</div>
                <div class="stat-value">{{ $questions->where('question_type', 'mcq')->count() }}</div>
            </div>
            <div class="stat-card blue">
                <i class="ri-checkbox-circle-line stat-icon"></i>
                <div class="stat-label">True / False</div>
                <div class="stat-value">{{ $questions->where('question_type', 'true_false')->count() }}</div>
            </div>
        </div>

        <!-- Questions list -->
        <div class="dash-card">
            <div class="dash-card-head">
                <div class="dash-card-title">
                    <i class="ri-database-2-line"></i> All Questions
                </div>
                <button class="btn-add" onclick="openCreateModal()">
                    <i class="ri-add-line"></i> Add Question
                </button>
            </div>

            @if($questions->count() > 0)
                @foreach($questions as $question)
                    <div class="question-item" id="question-{{ $question->id }}">
                        <div class="question-item-top">
                            <div style="flex:1;min-width:0;">
                                <div class="question-meta">
                                    @if($question->question_type == 'mcq')
                                        <span class="badge badge-mcq"><i class="ri-list-check-2"></i> Multiple Choice</span>
                                    @elseif($question->question_type == 'true_false')
                                        <span class="badge badge-tf"><i class="ri-checkbox-circle-line"></i> True / False</span>
                                    @else
                                        <span class="badge badge-essay"><i class="ri-file-text-line"></i> Essay</span>
                                    @endif
                                    <a href="{{ route('faculty.edit.quiz', $question->quiz_id) }}" class="quiz-link">
                                        {{ $question->quiz->course->code ?? 'N/A' }} — {{ $question->quiz->title ?? 'N/A' }}
                                    </a>
                                    <span class="points-label">{{ $question->points }} pt{{ $question->points != 1 ? 's' : '' }}</span>
                                </div>
                                <div class="question-text">{{ $question->question_text }}</div>

                                @if($question->question_type == 'mcq')
                                    @php
                                        $options = $question->options;
                                        if (is_string($options)) $options = json_decode($options, true);
                                        if (!is_array($options)) $options = [];
                                    @endphp
                                    <div class="question-options">
                                        @forelse($options as $option)
                                            <div class="option-line {{ $option == $question->correct_answer ? 'correct' : '' }}">
                                                @if($option == $question->correct_answer)
                                                    <i class="ri-checkbox-circle-fill"></i>
                                                @else
                                                    <i class="ri-circle-line"></i>
                                                @endif
                                                {{ $option }}
                                                @if($option == $question->correct_answer)
                                                    <span style="font-size:.65rem;margin-left:.25rem;">(Correct)</span>
                                                @endif
                                            </div>
                                        @empty
                                            <div style="font-size:.72rem;color:var(--txt-3);">No options available.</div>
                                        @endforelse
                                    </div>
                                @elseif($question->question_type == 'true_false')
                                    <div class="correct-answer-label">
                                        <i class="ri-checkbox-circle-fill"></i> Correct Answer: {{ $question->correct_answer }}
                                    </div>
                                @endif
                            </div>
                            <div class="question-actions">
                                <button class="q-btn edit" onclick="editQuestion({{ $question->id }})" title="Edit question">
                                    <i class="ri-edit-line"></i>
                                </button>
                                <button class="q-btn delete" onclick="confirmDeleteQuestion({{ $question->id }})" title="Delete question">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="ri-question-line"></i>
                    No questions in the question bank yet.
                </div>
            @endif
        </div>

    </div><!-- /page-body -->
</div><!-- /main-content -->

<!-- ══ CREATE / EDIT QUESTION MODAL ══ -->
<div id="questionModal" class="modal-overlay">
    <div class="modal">
        <div class="modal-head">
            <h3 id="modalTitle"><i class="ri-add-circle-line"></i> Create New Question</h3>
            <button class="modal-close" onclick="closeModal()"><i class="ri-close-line"></i></button>
        </div>
        <div class="modal-body-scroll">
            <form id="questionForm">
                @csrf
                <input type="hidden" id="editQuestionId" name="question_id" value="">

                <div class="form-group">
                    <label class="form-label">Question Type</label>
                    <select id="questionType" name="question_type" class="form-control">
                        <option value="mcq">Multiple Choice (MCQ)</option>
                        <option value="true_false">True / False</option>
                        <option value="essay">Essay</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Question Text <span>*</span></label>
                    <textarea id="questionText" name="question_text" rows="3" required
                              class="form-control"
                              placeholder="e.g., What is the capital of France?"></textarea>
                </div>

                <!-- MCQ Options -->
                <div id="mcqDiv" class="form-group">
                    <label class="form-label">Answer Options</label>
                    <div id="optionsList">
                        <div class="option-row">
                            <input type="text" name="options[]" class="form-control" placeholder="Option 1">
                            <input type="radio" name="correct_answer" value="" class="correct-radio" onchange="setCorrectAnswerValue(this)">
                            <i class="ri-delete-bin-line remove-option-btn" onclick="this.parentElement.remove()"></i>
                        </div>
                        <div class="option-row">
                            <input type="text" name="options[]" class="form-control" placeholder="Option 2">
                            <input type="radio" name="correct_answer" value="" class="correct-radio" onchange="setCorrectAnswerValue(this)">
                            <i class="ri-delete-bin-line remove-option-btn" onclick="this.parentElement.remove()"></i>
                        </div>
                    </div>
                    <div class="add-option-btn" onclick="addOption()">
                        <i class="ri-add-line"></i> Add another option
                    </div>
                </div>

                <!-- True/False -->
                <div id="tfDiv" class="form-group" style="display:none;">
                    <label class="form-label">Correct Answer</label>
                    <div class="radio-group">
                        <label><input type="radio" name="correct_answer" value="True"> True</label>
                        <label><input type="radio" name="correct_answer" value="False"> False</label>
                    </div>
                </div>

                <!-- Essay -->
                <div id="essayDiv" class="form-group" style="display:none;">
                    <label class="form-label">Sample Answer / Rubric <span style="color:var(--txt-3);font-weight:400;">(optional)</span></label>
                    <textarea id="essayAnswer" name="correct_answer" rows="3" class="form-control"
                              placeholder="Provide a sample answer or grading guidelines…"></textarea>
                    <div class="form-hint">Essay questions will be manually graded.</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Points <span>*</span></label>
                    <input type="number" id="points" name="points" required min="1" value="1" class="form-control">
                </div>
            </form>
        </div>
        <div class="modal-foot">
            <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
            <button type="submit" form="questionForm" class="btn-submit">
                <i class="ri-save-line"></i> Save Question
            </button>
        </div>
    </div>
</div>

<!-- ══ DELETE CONFIRM MODAL ══ -->
<div id="deleteModal" class="modal-overlay">
    <div class="modal modal-sm">
        <div class="modal-head">
            <h3><i class="ri-delete-bin-line"></i> Delete Question</h3>
            <button class="modal-close" onclick="closeDeleteModal()"><i class="ri-close-line"></i></button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete this question?</p>
            <p class="modal-warn">This action cannot be undone.</p>
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

    /* ── Modal helpers ── */
    let optionCounter = 2;
    const questionModal = document.getElementById('questionModal');

    function openModal() {
        questionModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        questionModal.classList.remove('active');
        document.body.style.overflow = '';
        resetForm();
    }
    function openCreateModal() {
        document.getElementById('modalTitle').innerHTML = '<i class="ri-add-circle-line"></i> Create New Question';
        document.getElementById('editQuestionId').value = '';
        resetForm();
        openModal();
    }
    questionModal.addEventListener('click', e => { if (e.target === questionModal) closeModal(); });

    /* ── Toggle question type sections ── */
    function toggleSections() {
        const type = document.getElementById('questionType').value;
        document.getElementById('mcqDiv').style.display   = type === 'mcq' ? 'block' : 'none';
        document.getElementById('tfDiv').style.display    = type === 'true_false' ? 'block' : 'none';
        document.getElementById('essayDiv').style.display = type === 'essay' ? 'block' : 'none';
    }
    document.getElementById('questionType').addEventListener('change', toggleSections);

    /* ── MCQ options ── */
    function addOption() {
        optionCounter++;
        const container = document.getElementById('optionsList');
        const div = document.createElement('div');
        div.className = 'option-row';
        div.innerHTML = `
            <input type="text" name="options[]" class="form-control" placeholder="Option ${optionCounter}">
            <input type="radio" name="correct_answer" value="" class="correct-radio" onchange="setCorrectAnswerValue(this)">
            <i class="ri-delete-bin-line remove-option-btn" onclick="this.parentElement.remove()"></i>
        `;
        container.appendChild(div);
        updateRadioValues();
    }
    function setCorrectAnswerValue(radio) {
        const optInput = radio.parentElement.querySelector('input[type="text"]');
        if (optInput && optInput.value) radio.value = optInput.value;
    }
    function updateRadioValues() {
        const options = document.querySelectorAll('[name="options[]"]');
        const radios  = document.querySelectorAll('.correct-radio');
        radios.forEach((radio, idx) => { if (options[idx] && options[idx].value) radio.value = options[idx].value; });
    }
    document.addEventListener('input', e => { if (e.target.name === 'options[]') updateRadioValues(); });

    /* ── Reset form ── */
    function resetForm() {
        document.getElementById('questionForm').reset();
        document.getElementById('editQuestionId').value = '';
        document.getElementById('optionsList').innerHTML = `
            <div class="option-row">
                <input type="text" name="options[]" class="form-control" placeholder="Option 1">
                <input type="radio" name="correct_answer" value="" class="correct-radio" onchange="setCorrectAnswerValue(this)">
                <i class="ri-delete-bin-line remove-option-btn" onclick="this.parentElement.remove()"></i>
            </div>
            <div class="option-row">
                <input type="text" name="options[]" class="form-control" placeholder="Option 2">
                <input type="radio" name="correct_answer" value="" class="correct-radio" onchange="setCorrectAnswerValue(this)">
                <i class="ri-delete-bin-line remove-option-btn" onclick="this.parentElement.remove()"></i>
            </div>
        `;
        optionCounter = 2;
        document.getElementById('questionType').value = 'mcq';
        document.getElementById('essayAnswer').value = '';
        toggleSections();
    }

    /* ── Edit question ── */
    function editQuestion(questionId) {
        fetch(`/faculty/questions/${questionId}/edit-data`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const q = data.question;
                document.getElementById('modalTitle').innerHTML = '<i class="ri-edit-line"></i> Edit Question';
                document.getElementById('editQuestionId').value = q.id;
                document.getElementById('questionType').value   = q.question_type;
                document.getElementById('questionText').value   = q.question_text;
                document.getElementById('points').value         = q.points;
                toggleSections();
                if (q.question_type === 'mcq') {
                    let opts = typeof q.options === 'string' ? JSON.parse(q.options) : q.options;
                    const container = document.getElementById('optionsList');
                    container.innerHTML = '';
                    if (opts && Array.isArray(opts)) {
                        opts.forEach(opt => {
                            const div = document.createElement('div');
                            div.className = 'option-row';
                            div.innerHTML = `
                                <input type="text" name="options[]" class="form-control" value="${escapeHtml(opt)}">
                                <input type="radio" name="correct_answer" value="${escapeHtml(opt)}" class="correct-radio" onchange="setCorrectAnswerValue(this)" ${opt === q.correct_answer ? 'checked' : ''}>
                                <i class="ri-delete-bin-line remove-option-btn" onclick="this.parentElement.remove()"></i>
                            `;
                            container.appendChild(div);
                        });
                        optionCounter = opts.length;
                    }
                } else if (q.question_type === 'true_false') {
                    document.querySelectorAll('#tfDiv input[name="correct_answer"]').forEach(r => {
                        if (r.value === q.correct_answer) r.checked = true;
                    });
                } else {
                    document.getElementById('essayAnswer').value = q.correct_answer || '';
                }
                openModal();
            } else alert('Could not load question.');
        })
        .catch(err => alert('Error: ' + err.message));
    }

    /* ── Delete question ── */
    let pendingDeleteId = null;

    function confirmDeleteQuestion(id) {
        pendingDeleteId = id;
        document.getElementById('deleteModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('active');
        document.body.style.overflow = '';
        pendingDeleteId = null;
    }
    document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
        if (!pendingDeleteId) return;
        fetch(`/faculty/questions/${pendingDeleteId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) { closeDeleteModal(); location.reload(); }
            else alert(data.message || 'Error deleting question.');
        })
        .catch(err => alert('Error: ' + err.message));
    });
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });

    /* ── Form submission ── */
    document.getElementById('questionForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const type         = document.getElementById('questionType').value;
        const questionText = document.getElementById('questionText').value.trim();
        const points       = document.getElementById('points').value;
        let correctAnswer  = '';

        if (!questionText) { alert('Please enter question text.'); return; }

        if (type === 'mcq') {
            let selected = null;
            document.querySelectorAll('#mcqDiv .correct-radio').forEach(r => { if (r.checked && r.value) selected = r.value; });
            if (!selected) { alert('Please select the correct answer.'); return; }
            correctAnswer = selected;
        } else if (type === 'true_false') {
            const sel = document.querySelector('#tfDiv input[name="correct_answer"]:checked');
            if (!sel) { alert('Please select True or False.'); return; }
            correctAnswer = sel.value;
        } else {
            correctAnswer = document.getElementById('essayAnswer').value || 'To be graded manually';
        }

        updateRadioValues();
        const formData = new FormData();
        formData.append('_token', document.querySelector('input[name="_token"]').value);
        formData.append('question_type', type);
        formData.append('question_text', questionText);
        formData.append('correct_answer', correctAnswer);
        formData.append('points', points);
        if (type === 'mcq') {
            document.querySelectorAll('[name="options[]"]').forEach(opt => {
                if (opt.value.trim()) formData.append('options[]', opt.value.trim());
            });
        }

        const questionId = document.getElementById('editQuestionId').value;
        let url = '/faculty/questions';
        if (questionId) { url = `/faculty/questions/${questionId}`; formData.append('_method', 'PUT'); }

        fetch(url, { method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.json())
            .then(data => {
                if (data.success) { closeModal(); location.reload(); }
                else alert(data.message || 'Validation failed.');
            })
            .catch(err => alert('Error: ' + err.message));
    });

    /* ── Util ── */
    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
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
        if (e.key === 'Escape') { closeModal(); closeDeleteModal(); closeLogoutModal(); }
    });

    toggleSections();
</script>
</body>
</html>