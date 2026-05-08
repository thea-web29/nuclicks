<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>National University | NU Horizon LMS — Intelligent Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600&display=swap" rel="stylesheet">
    <style>
        /* ══════════════════════════════════
           TOKENS
        ══════════════════════════════════ */
        :root {
            --navy:       #0A1F44;
            --navy-mid:   #1F3A6D;
            --navy-lite:  #3D5FA0;
            --navy-pale:  #EEF3FB;
            --gold:       #FFD70F;
            --gold-d:     #C49A00;
            --gold-mid:   #F5C800;
            --gold-pale:  #FFFBEA;

            --bg:         #F8F6F1;
            --bg-2:       #F2EEE5;
            --white:      #FFFFFF;

            --txt-1:      #0A1F44;
            --txt-2:      #2C3E5C;
            --txt-3:      #637089;
            --txt-4:      #9BAEC8;

            --bdr:        rgba(10,31,68,0.09);
            --bdr-gold:   rgba(196,154,0,0.28);
            --sh-s:       0 2px 12px rgba(10,31,68,0.07);
            --sh-m:       0 8px 32px rgba(10,31,68,0.11);
            --sh-l:       0 20px 56px rgba(10,31,68,0.14);

            --ease:       cubic-bezier(0.22,1,0.36,1);
            --spring:     cubic-bezier(0.34,1.56,0.64,1);
            --t:          0.26s var(--ease);
        }

        /* ══ CUSTOM SCROLLBAR ══ */
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 72px;
            scrollbar-width: thin;
            scrollbar-color: var(--navy) var(--navy-pale);
        }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--navy-pale); }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--navy-mid), var(--navy));
            border-radius: 4px;
            border: 2px solid var(--navy-pale);
        }
        ::-webkit-scrollbar-thumb:hover { background: var(--gold-d); }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--txt-1);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        /* ══ ANIMATIONS ══ */
        @keyframes fadeUp   { from{opacity:0;transform:translateY(28px);}  to{opacity:1;transform:translateY(0);} }
        @keyframes fadeIn   { from{opacity:0;} to{opacity:1;} }
        @keyframes shimmer  { 0%{background-position:-300% center;} 100%{background-position:300% center;} }
        @keyframes pulse    { 0%,100%{opacity:1;} 50%{opacity:.4;} }
        @keyframes marquee  { from{transform:translateX(0);} to{transform:translateX(-50%);} }
        @keyframes drawLine { from{width:0;} to{width:100%;} }
        @keyframes scaleIn  { from{transform:scaleX(0);} to{transform:scaleX(1);} }

        .a1{animation:fadeUp .75s var(--ease) both;}
        .a2{animation:fadeUp .75s var(--ease) .10s both;}
        .a3{animation:fadeUp .75s var(--ease) .22s both;}
        .a4{animation:fadeUp .75s var(--ease) .34s both;}
        .a5{animation:fadeUp .75s var(--ease) .48s both;}

        .reveal{opacity:0;transform:translateY(24px);transition:opacity .65s var(--ease),transform .65s var(--ease);}
        .reveal.on{opacity:1;transform:translateY(0);}
        .r1{transition-delay:.08s;} .r2{transition-delay:.18s;} .r3{transition-delay:.30s;}

        /* ══════════════════════════════════
           HEADER — deep navy
        ══════════════════════════════════ */
        .site-hdr {
            background: var(--navy);
            border-bottom: 2px solid rgba(255,215,15,0.18);
            transition: box-shadow .3s, border-color .3s;
            position: sticky; top: 0; z-index: 40;
        }
        .site-hdr.stuck {
            box-shadow: 0 4px 32px rgba(0,0,0,0.45);
            border-bottom-color: rgba(255,215,15,0.32);
        }

        .nav-link {
            font-size: .84rem; font-weight: 500;
            color: rgba(255,255,255,.60);
            display: flex; align-items: center; gap: .35rem;
            position: relative; padding: .2rem 0;
            transition: color var(--t);
        }
        .nav-link::after {
            content:""; position:absolute; bottom:-2px; left:0;
            width:0; height:2px; background:var(--gold);
            border-radius:2px; transition:width var(--t);
        }
        .nav-link:hover { color:#fff; }
        .nav-link:hover::after { width:100%; }

        .logo-wrap { display:flex; align-items:center; gap:.7rem; }
        .logo-img  { height:2.5rem; width:auto; margin-left:1.5rem; }
        .logo-name {
            font-family:'Fraunces',serif; font-size:1.3rem;
            font-weight:700; color:#fff; letter-spacing:-.01em;
        }
        .logo-name em { color:var(--gold); font-style:normal; }
        .logo-sub  { font-size:.52rem; font-weight:600; letter-spacing:.18em;
                     text-transform:uppercase; color:rgba(255,255,255,.35); }

        .hdr-login {
            font-size:.82rem; font-weight:600;
            color:rgba(255,255,255,.78);
            border:1.5px solid rgba(255,255,255,.22);
            padding:.48rem 1.1rem; border-radius:6px;
            transition:all var(--t);
            display:inline-flex; align-items:center; gap:.4rem;
        }
        .hdr-login:hover { border-color:rgba(255,255,255,.55); color:#fff; background:rgba(255,255,255,.08); }

        .hdr-cta {
            font-size:.82rem; font-weight:700;
            color:var(--navy); background:var(--gold);
            padding:.5rem 1.25rem; border-radius:6px;
            margin-right:1.5rem;
            box-shadow:0 2px 14px rgba(255,215,15,.38);
            transition:all var(--t);
            display:inline-flex; align-items:center; gap:.4rem;
        }
        .hdr-cta:hover { background:#ffe84d; box-shadow:0 4px 22px rgba(255,215,15,.58); transform:translateY(-1px); }

        .mob-login { flex:1; border:1.5px solid rgba(255,255,255,.28); color:rgba(255,255,255,.85); padding:.58rem; border-radius:6px; font-size:.82rem; font-weight:600; display:flex; align-items:center; justify-content:center; gap:.4rem; }
        .mob-reg   { flex:1; background:var(--gold); color:var(--navy); padding:.58rem; border-radius:6px; font-size:.82rem; font-weight:700; display:flex; align-items:center; justify-content:center; gap:.4rem; }
        .mob-menu  { background: var(--navy); border-top: 1px solid rgba(255,255,255,.08); }

        /* ══════════════════════════════════
           HERO — full-bleed background, centered content
        ══════════════════════════════════ */
        .hero {
            position: relative;
            min-height: 88vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* Background image */
        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('/logo/natt.png');
            background-size: cover;
            background-position: center 15%;
            background-repeat: no-repeat;
        }

        /* Dark overlay so text stays readable */
        .hero-bg::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(10,31,68,0.72) 0%,
                rgba(10,31,68,0.55) 40%,
                rgba(10,31,68,0.68) 100%
            );
        }

        /* Center content */
        .hero-center {
            position: relative;
            z-index: 2;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 1.5rem 4rem;
            max-width: 800px;
            width: 100%;
            margin-top: 1vh;
        }

        /* School seal / logo */
        .hero-seal {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid rgba(255,215,15,0.55);
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 28px rgba(255,215,15,0.20), 0 0 0 6px rgba(255,215,15,0.08);
            transition: box-shadow 0.35s var(--ease), border-color 0.35s var(--ease), transform 0.35s var(--spring);
            cursor: pointer;
        }
        .hero-seal:hover {
            border-color: rgba(255,215,15,0.95);
            box-shadow:
                0 0 0 6px rgba(255,215,15,0.15),
                0 0 30px 8px rgba(255,215,15,0.45),
                0 0 60px 16px rgba(255,215,15,0.20);
            transform: scale(1.07);
        }
        .hero-seal img {
            width: 78px;
            height: 78px;
            object-fit: contain;
            border-radius: 50%;
        }

        /* School name badge */
        .hero-school-tag {
            display: inline-flex;
            align-items: center;
            gap: .55rem;
            background: rgba(255,255,255,0.10);
            backdrop-filter: blur(10px);
            border: 1.5px solid rgba(255,215,15,0.35);
            color: rgba(255,255,255,0.92);
            font-size: .8rem;
            font-weight: 600;
            letter-spacing: .04em;
            padding: .45rem 1.2rem;
            border-radius: 100px;
            margin-bottom: 2rem;
        }
        .hero-school-tag i { color: var(--gold); }

        /* Eyebrow */
        .hero-eyebrow {
            display:inline-flex; align-items:center; gap:.55rem;
            background: rgba(255,255,255,0.10);
            backdrop-filter: blur(8px);
            border:1.5px solid rgba(255,255,255,0.20);
            padding:.38rem 1rem; border-radius:100px;
            font-size:.72rem; font-weight:600; color:rgba(255,255,255,0.80);
            letter-spacing:.04em; margin-bottom:1.5rem;
        }
        .live-dot { width:7px; height:7px; border-radius:50%; background:#22c55e; animation:pulse 2s ease-in-out infinite; }

        /* Title */
        .hero-h1 {
            font-family:'Fraunces',serif;
            font-size:clamp(2.4rem,5vw,4rem);
            font-weight:700; line-height:1.10;
            letter-spacing:-.03em; color:#fff;
            margin-bottom:1.25rem;
        }
        .hero-h1 em { font-style:italic; color:var(--gold); }
        .hero-h1 .hi {
            position:relative; display:inline-block;
        }
        .hero-h1 .hi::after {
            content:""; position:absolute; bottom:-4px; left:0;
            height:4px; border-radius:3px; width:0;
            background:linear-gradient(90deg,var(--gold),var(--gold-mid));
            animation:drawLine .9s var(--ease) .6s both;
        }

        .hero-p {
            font-size:1rem; color:rgba(255,255,255,0.72);
            line-height:1.78; max-width:32rem;
            margin: 0 auto 1.75rem;
        }

        /* Buttons */
        .btn-navy {
            display:inline-flex; align-items:center; gap:.5rem;
            background:var(--navy); color:#fff;
            font-size:.9rem; font-weight:700; letter-spacing:.01em;
            padding:.85rem 2rem; border-radius:8px;
            box-shadow:0 6px 22px rgba(10,31,68,.5);
            transition:all var(--t);
            border: 1.5px solid rgba(255,255,255,0.15);
        }
        .btn-navy:hover { background:var(--navy-mid); transform:translateY(-2px); box-shadow:0 12px 30px rgba(10,31,68,.6); }

        .btn-gold {
            display:inline-flex; align-items:center; gap:.5rem;
            background:var(--gold); color:var(--navy);
            font-size:.9rem; font-weight:700; letter-spacing:.01em;
            padding:.85rem 2rem; border-radius:8px;
            box-shadow:0 4px 22px rgba(255,215,15,.45);
            transition:all var(--t);
        }
        .btn-gold:hover { background:#ffe84d; transform:translateY(-2px); box-shadow:0 8px 30px rgba(255,215,15,.60); }

        /* Proof chips */
        .proof-row { display:flex; flex-wrap:wrap; gap:.6rem; margin-top:2rem; justify-content:center; }
        .proof-chip {
            display:flex; align-items:center; gap:.42rem;
            background:rgba(255,255,255,0.12);
            backdrop-filter: blur(8px);
            border:1.5px solid rgba(255,255,255,0.20);
            border-radius:6px; padding:.38rem .85rem;
            font-size:.74rem; font-weight:600; color:rgba(255,255,255,0.85);
            transition:transform var(--t), box-shadow var(--t), background var(--t);
        }
        .proof-chip:hover { transform:translateY(-2px); background:rgba(255,255,255,0.20); }
        .proof-chip i { color:var(--gold); font-size:.68rem; }

        /* ══════════════════════════════════
           MARQUEE STRIP
        ══════════════════════════════════ */
        .marquee-strip {
            background:var(--navy);
            overflow:hidden; padding:.8rem 0;
            border-top:1px solid rgba(255,215,15,.12);
            border-bottom:1px solid rgba(255,215,15,.08);
        }
        .marquee-track {
            display:flex; gap:3rem; width:max-content;
            animation:marquee 30s linear infinite;
        }
        .marquee-item {
            display:flex; align-items:center; gap:.55rem; flex-shrink:0;
            font-size:.73rem; font-weight:600;
            color:rgba(255,255,255,.42);
            letter-spacing:.09em; text-transform:uppercase;
        }
        .marquee-item i { color:var(--gold); font-size:.68rem; }
        .marquee-item .sep { color:rgba(255,215,15,.35); font-size:.42rem; margin:0 .25rem; }

        /* ══════════════════════════════════
           STATS STRIP
        ══════════════════════════════════ */
        .stats-strip { background:var(--white); border-bottom:1px solid var(--bdr); }

        .stat-col {
            padding:2.25rem 2rem;
            border-right:1px solid var(--bdr);
            position:relative; overflow:hidden;
            transition:background var(--t);
        }
        .stat-col:last-child { border-right:none; }
        .stat-col::after {
            content:""; position:absolute; bottom:0; left:0; right:0;
            height:3px; background:var(--gold);
            transform:scaleX(0); transform-origin:left;
            transition:transform .45s var(--ease);
        }
        .stat-col:hover { background:var(--gold-pale); }
        .stat-col:hover::after { transform:scaleX(1); }

        .stat-n {
            font-family:'Fraunces',serif; font-size:3.25rem;
            font-weight:700; color:var(--navy); line-height:1;
            letter-spacing:-.04em;
        }
        .stat-n em { color:var(--gold-d); font-style:normal; }
        .stat-l { font-size:.72rem; font-weight:600; color:var(--txt-3); margin-top:.45rem; text-transform:uppercase; letter-spacing:.08em; }

        /* ══════════════════════════════════
           SHARED SECTION ATOMS
        ══════════════════════════════════ */
        .eyebrow-tag {
            display:inline-flex; align-items:center; gap:.4rem;
            background:var(--gold-pale); border:1.5px solid var(--bdr-gold);
            color:var(--gold-d); font-size:.7rem; font-weight:700;
            letter-spacing:.09em; text-transform:uppercase;
            padding:.3rem .9rem; border-radius:100px; margin-bottom:1rem;
        }

        .sec-h2 {
            font-family:'Fraunces',serif;
            font-size:clamp(1.9rem,3.5vw,3rem);
            font-weight:700; color:var(--navy); line-height:1.12; letter-spacing:-.025em;
        }
        .sec-h2 em { font-style:italic; color:var(--gold-d); }

        .sec-p { font-size:.9rem; color:var(--txt-3); line-height:1.75; max-width:36rem; margin-top:1rem; }

        .sec-sep { height:1px; background:linear-gradient(90deg,transparent,var(--bdr) 50%,transparent); border:none; }

        /* ══════════════════════════════════
           SOLUTIONS
        ══════════════════════════════════ */
        .sol-section { background:var(--bg); }

        .sol-card {
            background:var(--white); border:1.5px solid var(--bdr);
            border-radius:14px; overflow:hidden;
            box-shadow:var(--sh-s);
            transition:transform .32s var(--spring), box-shadow .32s var(--ease);
            display:flex; flex-direction:column;
        }
        .sol-card:hover { transform:translateY(-7px); box-shadow:var(--sh-l); }

        .sol-stripe { height:5px; }
        .sol-stripe.s1 { background:linear-gradient(90deg,var(--navy),var(--navy-mid)); }
        .sol-stripe.s2 { background:linear-gradient(90deg,var(--gold),var(--gold-mid)); }
        .sol-stripe.s3 { background:linear-gradient(90deg,var(--navy-mid),var(--gold)); }

        .sol-body { padding:2rem; flex:1; display:flex; flex-direction:column; }

        .sol-icon {
            width:3rem; height:3rem; border-radius:10px;
            display:flex; align-items:center; justify-content:center;
            font-size:1.05rem; margin-bottom:1.25rem;
            background:var(--navy-pale); color:var(--navy-mid);
            border:1.5px solid var(--bdr);
            transition:background .28s, color .28s, transform .3s var(--spring);
        }
        .sol-card:hover .sol-icon { background:var(--navy); color:var(--gold); transform:scale(1.08) rotate(-4deg); }

        .sol-h { font-size:1.05rem; font-weight:700; color:var(--navy); margin-bottom:.45rem; }
        .sol-p { font-size:.85rem; color:var(--txt-3); line-height:1.7; flex:1; }

        .sol-list { list-style:none; margin-top:1.25rem; border-top:1px solid var(--bdr); padding-top:1rem; }
        .sol-list li { display:flex; align-items:center; gap:.58rem; padding:.3rem 0; font-size:.81rem; color:var(--txt-2); border-bottom:1px solid rgba(10,31,68,.03); }
        .sol-list li:last-child { border-bottom:none; }
        .sol-list li i { color:var(--gold-d); font-size:.62rem; flex-shrink:0; }

        .text-link {
            display:inline-flex; align-items:center; gap:.4rem; margin-top:1.25rem;
            font-size:.8rem; font-weight:700; color:var(--navy-mid);
            border-bottom:2px solid var(--gold); padding-bottom:1px;
            transition:gap var(--t), color var(--t);
        }
        .text-link:hover { gap:.65rem; color:var(--navy); }

        /* ══════════════════════════════════
           HOW IT WORKS — navy bg
        ══════════════════════════════════ */
        .steps-section { background:var(--navy); position:relative; overflow:hidden; }
        .steps-section::before {
            content:""; position:absolute; inset:0; pointer-events:none;
            background:radial-gradient(ellipse 70% 55% at 50% -5%, rgba(255,215,15,.10) 0%, transparent 60%);
        }

        .step-card {
            background:rgba(255,255,255,.05); border:1.5px solid rgba(255,255,255,.09);
            border-radius:14px; padding:2.25rem 2rem;
            position:relative;
            transition:background .3s, border-color .3s, transform .32s var(--spring);
        }
        .step-card:hover { background:rgba(255,255,255,.09); border-color:rgba(255,215,15,.32); transform:translateY(-5px); }

        .step-num {
            font-family:'Fraunces',serif; font-size:4.5rem; font-weight:700;
            color:rgba(255,215,15,.10); line-height:1; margin-bottom:1.1rem;
            transition:color .3s;
        }
        .step-card:hover .step-num { color:rgba(255,215,15,.26); }

        .step-icon {
            width:2.75rem; height:2.75rem; border-radius:8px;
            display:flex; align-items:center; justify-content:center;
            background:rgba(255,215,15,.10); color:var(--gold);
            font-size:.92rem; margin-bottom:1.1rem;
            border:1px solid rgba(255,215,15,.18);
            transition:background .3s, color .3s;
        }
        .step-card:hover .step-icon { background:var(--gold); color:var(--navy); }

        .step-h { font-family:'Fraunces',serif; font-size:1.2rem; font-weight:600; color:#fff; margin-bottom:.5rem; }
        .step-p { font-size:.84rem; color:rgba(255,255,255,.46); line-height:1.72; }
        .step-arr { position:absolute; top:50%; right:-1.5rem; transform:translateY(-50%); color:rgba(255,215,15,.22); font-size:.95rem; z-index:2; }

        /* ══════════════════════════════════
           ANALYTICS
        ══════════════════════════════════ */
        .analytics-section { background:var(--bg-2); }

        .af-item {
            display:flex; gap:1rem; align-items:flex-start;
            padding:1.1rem 1.2rem;
            background:var(--white); border:1.5px solid var(--bdr);
            border-left:3px solid transparent; border-radius:10px;
            box-shadow:var(--sh-s);
            transition:border-left-color .28s, box-shadow .28s, transform .28s var(--ease);
        }
        .af-item:hover { border-left-color:var(--gold-d); box-shadow:var(--sh-m); transform:translateX(4px); }

        .af-icon {
            width:2.5rem; height:2.5rem; border-radius:8px; flex-shrink:0;
            display:flex; align-items:center; justify-content:center;
            font-size:.88rem; color:var(--navy-mid);
            background:var(--navy-pale); border:1.5px solid var(--bdr);
            transition:background .28s, color .28s;
        }
        .af-item:hover .af-icon { background:var(--navy); color:var(--gold); }
        .af-h { font-size:.88rem; font-weight:700; color:var(--navy); }
        .af-p { font-size:.76rem; color:var(--txt-3); margin-top:.18rem; line-height:1.5; }

        .kpi-card {
            background:var(--white); border:1.5px solid var(--bdr);
            border-top:3px solid var(--gold-d); border-radius:10px;
            padding:1.25rem 1rem; text-align:center;
            box-shadow:var(--sh-s);
            transition:transform .3s var(--spring), box-shadow .3s;
        }
        .kpi-card:hover { transform:translateY(-4px); box-shadow:var(--sh-m); }
        .kpi-n { font-family:'Fraunces',serif; font-size:2rem; font-weight:700; color:var(--navy); letter-spacing:-.03em; }
        .kpi-l { font-size:.68rem; font-weight:600; color:var(--txt-3); margin-top:.2rem; text-transform:uppercase; letter-spacing:.07em; }

        /* Testimonial card */
        .quote-card {
            background:var(--navy); border-radius:16px; overflow:hidden;
            position:relative; max-width:28rem; width:100%;
            border:1.5px solid rgba(255,215,15,.15);
            box-shadow:var(--sh-l);
        }
        .quote-card::before {
            content:""; position:absolute; top:0; left:0; right:0; height:4px;
            background:linear-gradient(90deg,var(--gold),#fff5a0,var(--gold));
            background-size:200% 100%; animation:shimmer 4s linear infinite;
        }
        .quote-inner { padding:2.5rem 2.25rem; }
        .quote-q {
            font-family:'Fraunces',serif; font-size:5.5rem;
            line-height:.7; color:rgba(255,215,15,.14); margin-bottom:.5rem;
        }
        .quote-text { font-size:.93rem; line-height:1.78; color:rgba(255,255,255,.83); }
        .quote-stars { color:var(--gold); letter-spacing:.12em; font-size:.86rem; margin-top:1.25rem; }
        .quote-src { font-size:.7rem; color:rgba(255,255,255,.30); margin-top:.5rem; }
        .quote-row { display:flex; border-top:1px solid rgba(255,255,255,.08); margin-top:1.75rem; }
        .qs { flex:1; text-align:center; padding:1.1rem .5rem; border-right:1px solid rgba(255,255,255,.07); }
        .qs:last-child { border-right:none; }
        .qs-n { font-family:'Fraunces',serif; font-size:1.55rem; font-weight:700; color:#fff; }
        .qs-l { font-size:.62rem; font-weight:600; color:rgba(255,255,255,.30); text-transform:uppercase; letter-spacing:.07em; margin-top:.14rem; }

        /* ══════════════════════════════════
           CTA — professional navy
        ══════════════════════════════════ */
        .cta-section { background:#122f62; position:relative; overflow:hidden; }
        .cta-section::before {
            content:""; position:absolute; top:-260px; left:50%; transform:translateX(-50%);
            width:800px; height:800px; border-radius:50%;
            background:radial-gradient(circle, rgba(255,215,15,.09) 0%, rgba(255,215,15,.03) 35%, transparent 65%);
            pointer-events:none;
        }

        .cta-inner { position:relative; z-index:1; max-width:52rem; margin:0 auto; text-align:center; }

        .cta-rule { width:3rem; height:3px; border-radius:3px; background:var(--gold); margin:0 auto 2.5rem; }

        .cta-tag {
            display:inline-flex; align-items:center; gap:.45rem;
            border:1px solid rgba(255,215,15,.28); padding:.30rem .9rem; border-radius:100px;
            font-size:.68rem; font-weight:600; color:rgba(255,215,15,.78);
            letter-spacing:.09em; text-transform:uppercase;
            background:rgba(255,215,15,.06); margin-bottom:1.5rem;
        }

        .cta-h {
            font-family:'Fraunces',serif;
            font-size:clamp(2rem,4.2vw,3.5rem);
            font-weight:700; color:#fff; line-height:1.10; letter-spacing:-.025em;
        }
        .cta-h em { font-style:italic; color:var(--gold); }

        .cta-p { font-size:.92rem; color:rgba(255,255,255,.50); max-width:31rem; margin:.9rem auto 0; line-height:1.80; }

        .btn-cta-gold {
            display:inline-flex; align-items:center; gap:.52rem;
            background:var(--gold); color:var(--navy);
            font-size:.9rem; font-weight:700; letter-spacing:.01em;
            padding:.88rem 2.2rem; border-radius:8px;
            box-shadow:0 6px 22px rgba(255,215,15,.28);
            transition:all var(--t);
        }
        .btn-cta-gold:hover { background:#ffe84d; box-shadow:0 10px 30px rgba(255,215,15,.44); transform:translateY(-2px); }

        .btn-cta-ghost {
            display:inline-flex; align-items:center; gap:.52rem;
            border:1.5px solid rgba(255,255,255,.22); color:rgba(255,255,255,.80);
            font-size:.9rem; font-weight:600; letter-spacing:.01em;
            padding:.88rem 2.2rem; border-radius:8px;
            transition:all var(--t);
        }
        .btn-cta-ghost:hover { border-color:rgba(255,255,255,.55); color:#fff; background:rgba(255,255,255,.08); }

        .cta-chips {
            display:flex; flex-wrap:wrap; justify-content:center; gap:1.5rem;
            margin-top:2.25rem; padding-top:2rem;
            border-top:1px solid rgba(255,255,255,.08);
        }
        .cta-chip { display:flex; align-items:center; gap:.42rem; font-size:.77rem; font-weight:500; color:rgba(255,255,255,.36); }
        .cta-chip i { color:rgba(255,215,15,.68); font-size:.66rem; }

        /* ══════════════════════════════════
           FOOTER
        ══════════════════════════════════ */
        .site-footer { background:var(--navy); border-top:1px solid rgba(255,215,15,.10); }

        .f-logo-name { font-family:'Fraunces',serif; font-size:1.5rem; font-weight:700; color:#fff; }
        .f-logo-name em { color:var(--gold); font-style:normal; }
        .f-tag { font-size:.82rem; color:rgba(255,255,255,.34); line-height:1.65; margin-top:.7rem; max-width:220px; }

        .f-social { width:2.2rem; height:2.2rem; border:1px solid rgba(255,215,15,.20); border-radius:7px; display:flex; align-items:center; justify-content:center; color:rgba(255,215,15,.55); font-size:.8rem; transition:all var(--t); }
        .f-social:hover { background:var(--gold); color:var(--navy); border-color:var(--gold); transform:translateY(-2px); }

        .f-head { font-size:.62rem; font-weight:700; text-transform:uppercase; letter-spacing:.15em; color:rgba(255,255,255,.26); margin-bottom:1.1rem; }
        .f-lnk  { font-size:.87rem; color:rgba(255,255,255,.42); display:flex; align-items:center; gap:.4rem; transition:color var(--t), padding-left var(--t); }
        .f-lnk:hover { color:var(--gold); padding-left:4px; }
        .f-lnk i { font-size:.6rem; opacity:.35; }
        .f-cnt  { display:flex; align-items:flex-start; gap:.62rem; font-size:.85rem; color:rgba(255,255,255,.36); line-height:1.65; }
        .f-cnt i { color:var(--gold); font-size:.66rem; margin-top:.26rem; flex-shrink:0; }
        .f-div  { border-color:rgba(255,255,255,.07); }
        .f-copy { font-size:.73rem; color:rgba(255,255,255,.22); }
        .f-copy-lnk { font-size:.73rem; color:rgba(255,255,255,.22); transition:color var(--t); }
        .f-copy-lnk:hover { color:var(--gold); }

        *:focus-visible { outline:2.5px solid var(--gold-d); outline-offset:3px; border-radius:3px; }
    </style>
</head>
<body>

<!-- ══════════ HEADER ══════════ -->
<header class="site-hdr" id="site-hdr">
    <div class="px-0">
        <div class="flex justify-between items-center py-3 md:py-0 md:h-[72px]">

            <div class="logo-wrap">
                <img src="logo/NatU.png" alt="National University" class="logo-img"
                     onerror="this.src='https://placehold.co/56x56/0A1F44/FFD70F?text=NU'">
                <div>
                    <div class="logo-sub">National University</div>
                    <div class="logo-name">NU Horizon <em>LMS</em></div>
                </div>
            </div>

            <nav class="hidden md:flex items-center gap-7" aria-label="Primary navigation">
                <a href="#platform" class="nav-link"><i class="fas fa-th-large text-xs opacity-50 mr-1"></i>Platform</a>
                <a href="#solutions" class="nav-link"><i class="fas fa-lightbulb text-xs opacity-50 mr-1"></i>Solutions</a>
                <a href="#research" class="nav-link"><i class="fas fa-flask text-xs opacity-50 mr-1"></i>Research</a>
                <a href="#support" class="nav-link"><i class="fas fa-life-ring text-xs opacity-50 mr-1"></i>Support</a>
                <div class="flex items-center gap-2.5 pl-5 border-l border-white/10">
                    <a href="/login" class="hdr-login"><i class="fas fa-sign-in-alt text-xs"></i> Log in</a>
                    <a href="/register" class="hdr-cta"><i class="fas fa-user-plus text-xs"></i> Get started</a>
                </div>
            </nav>

            <div class="md:hidden pr-4">
                <button class="p-1.5 text-white" id="mob-btn" aria-label="Toggle menu" aria-expanded="false">
                    <i class="fas fa-bars text-xl" id="mob-icon"></i>
                </button>
            </div>
        </div>
    </div>

    <div id="mob-menu" class="md:hidden hidden mob-menu px-5 pb-5" role="navigation">
        <div class="flex flex-col space-y-1 pt-3">
            <a href="#platform" class="text-white/60 hover:text-white py-2 text-sm font-medium flex items-center gap-2.5"><i class="fas fa-th-large text-xs w-4 text-center opacity-50"></i>Platform</a>
            <a href="#solutions" class="text-white/60 hover:text-white py-2 text-sm font-medium flex items-center gap-2.5"><i class="fas fa-lightbulb text-xs w-4 text-center opacity-50"></i>Solutions</a>
            <a href="#research" class="text-white/60 hover:text-white py-2 text-sm font-medium flex items-center gap-2.5"><i class="fas fa-flask text-xs w-4 text-center opacity-50"></i>Research</a>
            <a href="#support" class="text-white/60 hover:text-white py-2 text-sm font-medium flex items-center gap-2.5"><i class="fas fa-life-ring text-xs w-4 text-center opacity-50"></i>Support</a>
            <div class="flex gap-3 pt-3">
                <a href="/login" class="mob-login"><i class="fas fa-sign-in-alt text-xs"></i> Login</a>
                <a href="/register" class="mob-reg"><i class="fas fa-user-plus text-xs"></i> Register</a>
            </div>
        </div>
    </div>
</header>

<main>

<!-- ══════════ HERO — full-bleed background, centered layout ══════════ -->
<section id="platform" class="hero">

    <!-- Background image layer -->
    <div class="hero-bg"
         style="background-image: url('/logo/natt.png');"
         aria-hidden="true">
    </div>

    <!-- Centered content -->
    <div class="hero-center">

        <!-- School seal -->
        <div class="hero-seal a1">
            <img src="logo/NatU.png" alt="National University seal"
                 onerror="this.style.display='none'; this.parentElement.innerHTML='<i class=\'fas fa-graduation-cap\' style=\'font-size:2.5rem;color:var(--gold)\'></i>'">
        </div>

        <!-- School name tag -->
        <div class="hero-school-tag a1">
            <i class="fas fa-university text-xs"></i>
            National University — Lipa City, Batangas
        </div>

        <!-- Eyebrow -->
        <div class="hero-eyebrow a2">
            <span class="live-dot"></span>
            Accredited · National University System
        </div>

        <!-- Main headline -->
        <h1 class="hero-h1 a2">
            Elevate <em>digital</em> excellence<br>
            with <span class="hi">NU Horizon LMS</span>
        </h1>

        <!-- Sub-copy -->
        <p class="hero-p a3">
            A unified, data‑driven learning ecosystem for students, faculty, and
            administrators. Drive academic success through real‑time intelligence
            and seamless collaboration.
        </p>

        <!-- CTA buttons -->
        <div class="flex flex-col sm:flex-row gap-3 a4">
            <a href="/register" class="btn-gold">
                <i class="fas fa-rocket text-sm"></i> Launch Portal
            </a>
            <a href="#solutions" class="btn-navy">
                <i class="fas fa-play-circle text-sm"></i> Explore Features
            </a>
        </div>

        <!-- Proof chips -->
        <div class="proof-row a5">
            <div class="proof-chip"><i class="fas fa-book-open"></i> 1,200+ Active Courses</div>
            <div class="proof-chip"><i class="fas fa-users"></i> 15K+ Learners</div>
            <div class="proof-chip"><i class="fas fa-star"></i> 94% Satisfaction</div>
            <div class="proof-chip"><i class="fas fa-shield-alt"></i> ISO 27001</div>
        </div>

    </div>
</section>

<!-- ══════════ MARQUEE ══════════ -->
<div class="marquee-strip">
    <div class="marquee-track">
        <div class="marquee-item"><i class="fas fa-graduation-cap"></i>Student Experience<span class="sep">◆</span></div>
        <div class="marquee-item"><i class="fas fa-chart-bar"></i>Real-time Analytics<span class="sep">◆</span></div>
        <div class="marquee-item"><i class="fas fa-robot"></i>AI-Powered Learning<span class="sep">◆</span></div>
        <div class="marquee-item"><i class="fas fa-shield-alt"></i>ISO 27001 Security<span class="sep">◆</span></div>
        <div class="marquee-item"><i class="fas fa-chalkboard-teacher"></i>Faculty Empowerment<span class="sep">◆</span></div>
        <div class="marquee-item"><i class="fas fa-mobile-alt"></i>Mobile First<span class="sep">◆</span></div>
        <div class="marquee-item"><i class="fas fa-bell"></i>Early Alert System<span class="sep">◆</span></div>
        <div class="marquee-item"><i class="fas fa-file-export"></i>Compliance Reports<span class="sep">◆</span></div>
        <!-- duplicate for seamless loop -->
        <div class="marquee-item"><i class="fas fa-graduation-cap"></i>Student Experience<span class="sep">◆</span></div>
        <div class="marquee-item"><i class="fas fa-chart-bar"></i>Real-time Analytics<span class="sep">◆</span></div>
        <div class="marquee-item"><i class="fas fa-robot"></i>AI-Powered Learning<span class="sep">◆</span></div>
        <div class="marquee-item"><i class="fas fa-shield-alt"></i>ISO 27001 Security<span class="sep">◆</span></div>
        <div class="marquee-item"><i class="fas fa-chalkboard-teacher"></i>Faculty Empowerment<span class="sep">◆</span></div>
        <div class="marquee-item"><i class="fas fa-mobile-alt"></i>Mobile First<span class="sep">◆</span></div>
        <div class="marquee-item"><i class="fas fa-bell"></i>Early Alert System<span class="sep">◆</span></div>
        <div class="marquee-item"><i class="fas fa-file-export"></i>Compliance Reports<span class="sep">◆</span></div>
    </div>
</div>

<!-- ══════════ STATS ══════════ -->
<div class="stats-strip reveal">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
        <div class="grid grid-cols-2 md:grid-cols-4">
            <div class="stat-col reveal r1">
                <div class="stat-n">98<em>%</em></div>
                <div class="stat-l">Faculty adoption rate</div>
            </div>
            <div class="stat-col reveal r2">
                <div class="stat-n">24<em>/7</em></div>
                <div class="stat-l">Global access &amp; support</div>
            </div>
            <div class="stat-col reveal r3">
                <div class="stat-n">#<em>1</em></div>
                <div class="stat-l">Academic innovation ranking</div>
            </div>
            <div class="stat-col reveal" style="transition-delay:.42s">
                <div class="stat-n" style="font-size:2.1rem;line-height:1.2">ISO<br><em>27001</em></div>
                <div class="stat-l">Certified security</div>
            </div>
        </div>
    </div>
</div>

<hr class="sec-sep">

<!-- ══════════ SOLUTIONS ══════════ -->
<section id="solutions" class="sol-section py-28">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">

        <div class="text-center mb-16 reveal">
            <span class="eyebrow-tag"><i class="fas fa-layer-group text-xs"></i> Integrated Ecosystem</span>
            <h2 class="sec-h2">Built for the <em>modern</em><br>university</h2>
            <p class="sec-p mx-auto">
                Role‑specific tools that empower every stakeholder — from orientation to graduation.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="sol-card reveal r1">
                <div class="sol-stripe s1"></div>
                <div class="sol-body">
                    <div class="sol-icon"><i class="fas fa-user-graduate"></i></div>
                    <h3 class="sol-h">Student Experience</h3>
                    <p class="sol-p">Personalized dashboards, adaptive assignments, peer collaboration, and mobile‑first access to lectures &amp; grades.</p>
                    <ul class="sol-list">
                        <li><i class="fas fa-check-circle"></i>AI study recommendations</li>
                        <li><i class="fas fa-check-circle"></i>Real‑time grade analytics</li>
                        <li><i class="fas fa-check-circle"></i>Integrated library &amp; resources</li>
                        <li><i class="fas fa-check-circle"></i>Mobile app for iOS &amp; Android</li>
                    </ul>
                    <a href="#" class="text-link">Student portal <i class="fas fa-arrow-right text-xs"></i></a>
                </div>
            </div>

            <div class="sol-card reveal r2">
                <div class="sol-stripe s2"></div>
                <div class="sol-body">
                    <div class="sol-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    <h3 class="sol-h">Faculty Empowerment</h3>
                    <p class="sol-p">Streamlined course authoring, automated assessment, engagement analytics, and early‑alert systems for at-risk students.</p>
                    <ul class="sol-list">
                        <li><i class="fas fa-check-circle"></i>Rubric‑based grading</li>
                        <li><i class="fas fa-check-circle"></i>Attendance &amp; participation tracking</li>
                        <li><i class="fas fa-check-circle"></i>Rich multimedia content studio</li>
                        <li><i class="fas fa-check-circle"></i>Automated plagiarism detection</li>
                    </ul>
                    <a href="#" class="text-link">Faculty workspace <i class="fas fa-arrow-right text-xs"></i></a>
                </div>
            </div>

            <div class="sol-card reveal r3">
                <div class="sol-stripe s3"></div>
                <div class="sol-body">
                    <div class="sol-icon"><i class="fas fa-building"></i></div>
                    <h3 class="sol-h">Administrative Suite</h3>
                    <p class="sol-p">Centralized governance, compliance reporting, enrollment analytics, and institutional KPIs — all in one place.</p>
                    <ul class="sol-list">
                        <li><i class="fas fa-check-circle"></i>Program &amp; curriculum management</li>
                        <li><i class="fas fa-check-circle"></i>Accreditation readiness tools</li>
                        <li><i class="fas fa-check-circle"></i>Advanced data privacy controls</li>
                        <li><i class="fas fa-check-circle"></i>Custom role &amp; permission controls</li>
                    </ul>
                    <a href="#" class="text-link">Admin analytics <i class="fas fa-arrow-right text-xs"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<hr class="sec-sep">

<!-- ══════════ HOW IT WORKS ══════════ -->
<section class="steps-section py-24">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">

        <div class="text-center mb-16 reveal">
            <span class="eyebrow-tag" style="background:rgba(255,215,15,.10);border-color:rgba(255,215,15,.24);color:var(--gold);">
                <i class="fas fa-map-signs text-xs"></i> Getting Started
            </span>
            <h2 class="sec-h2" style="color:#fff;">Up &amp; running in <em style="color:var(--gold);">three steps</em></h2>
        </div>

        <div class="grid md:grid-cols-3 gap-6 relative">
            <div class="step-card reveal r1">
                <span class="step-arr hidden md:block"><i class="fas fa-chevron-right"></i></span>
                <div class="step-num">01</div>
                <div class="step-icon"><i class="fas fa-id-card-alt"></i></div>
                <h3 class="step-h">Create Your Account</h3>
                <p class="step-p">Register using your institutional email. SSO with existing university systems is fully supported.</p>
            </div>
            <div class="step-card reveal r2">
                <span class="step-arr hidden md:block"><i class="fas fa-chevron-right"></i></span>
                <div class="step-num">02</div>
                <div class="step-icon"><i class="fas fa-th-large"></i></div>
                <h3 class="step-h">Access Your Courses</h3>
                <p class="step-p">Your enrolled courses, schedules, and materials are automatically synced from the registrar system.</p>
            </div>
            <div class="step-card reveal r3">
                <div class="step-num">03</div>
                <div class="step-icon"><i class="fas fa-chart-bar"></i></div>
                <h3 class="step-h">Track Your Progress</h3>
                <p class="step-p">Monitor grades, submissions, and learning outcomes in real-time from any device, anywhere.</p>
            </div>
        </div>
    </div>
</section>

<hr class="sec-sep">

<!-- ══════════ ANALYTICS ══════════ -->
<section id="research" class="analytics-section py-24">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
        <div class="flex flex-col lg:flex-row gap-16 items-center">

            <div class="flex-1 order-2 lg:order-1 reveal">
                <span class="eyebrow-tag"><i class="fas fa-flask text-xs"></i> Research-Driven Platform</span>
                <h2 class="sec-h2">Intelligent analytics &amp;<br><em>predictive insights</em></h2>
                <p class="sec-p">
                    NU Horizon LMS harnesses learning analytics to identify at-risk students, personalize intervention strategies, and continuously improve curriculum effectiveness — all while maintaining FERPA &amp; GDPR compliance.
                </p>

                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="af-item">
                        <div class="af-icon"><i class="fas fa-chart-bar"></i></div>
                        <div><div class="af-h">Real-time Dashboards</div><div class="af-p">Track engagement, completion, and performance metrics</div></div>
                    </div>
                    <div class="af-item">
                        <div class="af-icon"><i class="fas fa-robot"></i></div>
                        <div><div class="af-h">AI Recommendations</div><div class="af-p">Adaptive learning paths tailored for each student</div></div>
                    </div>
                    <div class="af-item">
                        <div class="af-icon"><i class="fas fa-bell"></i></div>
                        <div><div class="af-h">Early Alert System</div><div class="af-p">Proactive intervention for at-risk students</div></div>
                    </div>
                    <div class="af-item">
                        <div class="af-icon"><i class="fas fa-file-export"></i></div>
                        <div><div class="af-h">Compliance Reporting</div><div class="af-p">Automated accreditation &amp; CHED reports</div></div>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-3 gap-3">
                    <div class="kpi-card"><div class="kpi-n">18%</div><div class="kpi-l">Retention ↑</div></div>
                    <div class="kpi-card"><div class="kpi-n">3.2×</div><div class="kpi-l">Faster Grading</div></div>
                    <div class="kpi-card"><div class="kpi-n">94%</div><div class="kpi-l">Satisfaction</div></div>
                </div>

                <a href="#" class="text-link mt-8 inline-flex">Explore Research &amp; Case Studies <i class="fas fa-arrow-right text-xs"></i></a>
            </div>

            <div class="flex-1 order-1 lg:order-2 flex justify-center reveal r3">
                <div class="quote-card">
                    <div class="quote-inner">
                        <div class="quote-q">"</div>
                        <p class="quote-text">
                            NU Horizon LMS increased first‑year student retention by
                            <strong style="color:var(--gold)">18%</strong> through data-driven
                            early alert systems and personalized interventions.
                        </p>
                        <div class="quote-stars">★★★★★</div>
                        <div class="quote-src">— National University Academic Report 2025</div>
                        <div class="quote-row">
                            <div class="qs"><div class="qs-n">15K+</div><div class="qs-l">Learners</div></div>
                            <div class="qs"><div class="qs-n">1,200+</div><div class="qs-l">Courses</div></div>
                            <div class="qs"><div class="qs-n">98%</div><div class="qs-l">Faculty</div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<hr class="sec-sep">

<!-- ══════════ CTA ══════════ -->
<section class="cta-section py-28">
    <div class="max-w-5xl mx-auto px-5 sm:px-8">
        <div class="cta-inner reveal">
            <div class="cta-rule"></div>
            <div class="cta-tag">
                <i class="fas fa-graduation-cap text-xs"></i>
                National University · NU Horizon LMS
            </div>
            <h3 class="cta-h">
                Join the digital transformation<br>
                at <em>National University</em>
            </h3>
            <p class="cta-p">
                Accelerate your institution's learning outcomes with next‑gen LMS technology.
                Schedule a live demo or request early access today.
            </p>
            <div class="flex flex-wrap justify-center gap-3 mt-10">
                <a href="/register" class="btn-cta-gold">
                    <i class="fas fa-calendar-check text-sm"></i> Request a Demo
                </a>
                <a href="#" class="btn-cta-ghost">
                    <i class="fas fa-phone-alt text-sm"></i> Contact Admissions
                </a>
            </div>
            <div class="cta-chips">
                <div class="cta-chip"><i class="fas fa-headset"></i>24/7 live support</div>
                <div class="cta-chip"><i class="fas fa-calendar-alt"></i>Demo in 30 minutes</div>
                <div class="cta-chip"><i class="fas fa-lock"></i>No commitment required</div>
                <div class="cta-chip"><i class="fas fa-envelope"></i>www.national-u.edu.ph</div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════ FOOTER ══════════ -->
<footer id="support" class="site-footer pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-10 border-b f-div">
            <div>
                <div class="flex items-center gap-2.5 mb-3">
                    <i class="fas fa-graduation-cap text-xl" style="color:var(--gold)"></i>
                    <div class="f-logo-name">NU Horizon <em>LMS</em></div>
                </div>
                <p class="f-tag">Empowering National University's academic mission with advanced, data-driven learning technology.</p>
                <div class="flex space-x-2 mt-5">
                    <a href="#" class="f-social" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="f-social" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="f-social" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="f-social" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div>
                <h4 class="f-head">Platform</h4>
                <ul class="space-y-2.5">
                    <li><a href="#" class="f-lnk"><i class="fas fa-user-graduate"></i> Student portal</a></li>
                    <li><a href="#" class="f-lnk"><i class="fas fa-chalkboard-teacher"></i> Faculty workspace</a></li>
                    <li><a href="#" class="f-lnk"><i class="fas fa-chart-pie"></i> Admin analytics</a></li>
                    <li><a href="#" class="f-lnk"><i class="fas fa-mobile-alt"></i> Mobile app</a></li>
                </ul>
            </div>
            <div>
                <h4 class="f-head">Resources</h4>
                <ul class="space-y-2.5">
                    <li><a href="#" class="f-lnk"><i class="fas fa-question-circle"></i> Help center</a></li>
                    <li><a href="#" class="f-lnk"><i class="fas fa-calendar-alt"></i> Academic calendar</a></li>
                    <li><a href="#" class="f-lnk"><i class="fas fa-shield-alt"></i> Security &amp; compliance</a></li>
                    <li><a href="#" class="f-lnk"><i class="fas fa-code"></i> Developer API</a></li>
                </ul>
            </div>
            <div>
                <h4 class="f-head">Contact</h4>
                <ul class="space-y-3">
                    <li class="f-cnt"><i class="fas fa-map-marker-alt"></i><span>SM City Lipa, Ayala Highway, Lipa City, Batangas</span></li>
                    <li class="f-cnt"><i class="fas fa-envelope"></i><a href="#" class="hover:text-yellow-400 transition-colors">www.national-u.edu.ph</a></li>
                    <li class="f-cnt"><i class="fas fa-phone-alt"></i><span>09399188505</span></li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col md:flex-row justify-between items-center pt-6 gap-3">
            <p class="f-copy">© 2025 National University — NU Horizon Learning Management System. All rights reserved.</p>
            <div class="flex gap-5">
                <a href="#" class="f-copy-lnk">Privacy policy</a>
                <a href="#" class="f-copy-lnk">Terms of use</a>
                <a href="#" class="f-copy-lnk">Accessibility</a>
            </div>
        </div>
    </div>
</footer>

</main>

<script>
    /* ── Mobile menu toggle ── */
    const mobBtn  = document.getElementById('mob-btn');
    const mobMenu = document.getElementById('mob-menu');
    const mobIcon = document.getElementById('mob-icon');
    if (mobBtn && mobMenu) {
        mobBtn.addEventListener('click', () => {
            const hidden = mobMenu.classList.toggle('hidden');
            mobIcon.className = hidden ? 'fas fa-bars text-xl' : 'fas fa-times text-xl';
            mobBtn.setAttribute('aria-expanded', String(!hidden));
        });
    }

    /* ── Header shadow on scroll ── */
    const hdr = document.getElementById('site-hdr');
    window.addEventListener('scroll', () => {
        hdr.classList.toggle('stuck', window.scrollY > 10);
    }, { passive: true });

    /* ── Scroll-reveal via IntersectionObserver ── */
    const reveals = document.querySelectorAll('.reveal');
    const io = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('on'); io.unobserve(e.target); }
        });
    }, { threshold: 0.10, rootMargin: '0px 0px -40px 0px' });
    reveals.forEach(el => io.observe(el));

    /* ── Smooth scroll for anchor links ── */
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const id = a.getAttribute('href');
            if (id === '#') return;
            const target = document.querySelector(id);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                if (mobMenu && !mobMenu.classList.contains('hidden')) {
                    mobMenu.classList.add('hidden');
                    if (mobIcon) mobIcon.className = 'fas fa-bars text-xl';
                    if (mobBtn) mobBtn.setAttribute('aria-expanded', 'false');
                }
            }
        });
    });
</script>
</body>
</html>