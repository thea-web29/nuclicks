<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>National University | NU Clicks LMS — Intelligent Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap" rel="stylesheet">
    <style>
        /* ========== CSS VARIABLES ========== */
        :root {
            --navy:        #0A1F44;
            --navy-mid:    #1F3A6D;
            --navy-light:  #4A6FA5;
            --navy-faint:  #EEF3FB;
            --gold:        #FFD70F;
            --gold-dark:   #D4A800;
            --gold-pale:   #FFF8DC;
            --gold-glow:   rgba(255, 215, 15, 0.25);
            --surface:     rgba(255, 252, 245, 0.95);
            --text-body:   #374151;
            --text-muted:  #6B7280;
            --shadow-sm:   0 2px 8px rgba(10,31,68,0.08);
            --shadow-md:   0 8px 24px rgba(10,31,68,0.12);
            --shadow-lg:   0 20px 48px rgba(10,31,68,0.18);
            --radius-sm:   0.5rem;
            --radius-md:   0.75rem;
            --radius-lg:   1rem;
            --radius-xl:   1.25rem;
            --ease-out:    cubic-bezier(0.22, 1, 0.36, 1);
            --transition:  0.25s var(--ease-out);
        }

        /* ========== GLOBAL ========== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; scroll-padding-top: 72px; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--navy);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            color: var(--text-body);
        }

        /* ========== BACKGROUND ========== */
        /* [KEPT] Background image + overlay — unchanged from original */
        body::before {
            content: "";
            position: fixed; inset: 0;
            background-image: url('/logo/natt.png');
            background-size: cover;
            background-position: center 30%;
            background-attachment: fixed;
            filter: brightness(0.88) contrast(1.06) saturate(0.9);
            z-index: -2;
        }
        body::after {
            content: "";
            position: fixed; inset: 0;
            background: linear-gradient(160deg, rgba(236,244,255,0.78) 0%, rgba(255,248,225,0.72) 100%);
            backdrop-filter: blur(1.5px);
            z-index: -1;
            pointer-events: none;
        }

        /* ========== TYPOGRAPHY ========== */
        h1, h2, h3, h4, .display-font { font-family: 'Outfit', sans-serif; }

        /* ========== ANIMATIONS ========== */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes shimmer {
            0%   { background-position: -200% center; }
            100% { background-position:  200% center; }
        }
        @keyframes pulse-ring {
            0%, 100% { box-shadow: 0 0 0 0 var(--gold-glow); }
            50%        { box-shadow: 0 0 0 10px rgba(255,215,15,0); }
        }

        .anim-fade-up  { animation: fadeUp 0.65s var(--ease-out) both; }
        .anim-delay-1  { animation-delay: 0.08s; }
        .anim-delay-2  { animation-delay: 0.18s; }
        .anim-delay-3  { animation-delay: 0.28s; }
        .anim-delay-4  { animation-delay: 0.40s; }
        .anim-delay-5  { animation-delay: 0.54s; }

        /* Scroll-reveal */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.6s var(--ease-out), transform 0.6s var(--ease-out);
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: 0.10s; }
        .reveal-delay-2 { transition-delay: 0.22s; }
        .reveal-delay-3 { transition-delay: 0.34s; }

        /* ========== HEADER ========== */
        .header-bg {
            background: rgba(8, 28, 70, 0.97);
            backdrop-filter: blur(14px) saturate(1.6);
            /* [IMPROVED] Thicker gold bottom accent on header for brand consistency */
            border-bottom: 2px solid rgba(255, 215, 15, 0.18);
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
        }
        .header-bg.scrolled {
            box-shadow: 0 4px 28px rgba(10, 31, 68, 0.45);
            border-bottom-color: rgba(255, 215, 15, 0.30);
        }

        /* [IMPROVED] Nav links — cleaner underline indicator, better color */
        .nav-link {
            position: relative;
            color: rgba(255,255,255,0.72);
            font-size: 0.875rem;
            font-weight: 500;
            letter-spacing: 0.01em;
            transition: color var(--transition);
            padding: 0.25rem 0;
        }
        .nav-link::after {
            content: "";
            position: absolute; bottom: -2px; left: 0;
            width: 0; height: 2px;
            background: var(--gold);
            border-radius: 2px;
            transition: width 0.25s var(--ease-out);
        }
        .nav-link:hover { color: #fff; }
        .nav-link:hover::after { width: 100%; }

        /* Logo */
        .logo-wrapper { display: flex; align-items: center; gap: 0.6rem; }
        .logo-img { height: 2.75rem; width: auto; margin-left: 1.5rem; }
        .logo-text-primary { color: white; font-size: 1.2rem; font-weight: 800; font-family: 'Outfit', sans-serif; letter-spacing: -0.03em; }
        .logo-text-secondary { color: var(--gold); font-size: 1.2rem; font-weight: 800; font-family: 'Outfit', sans-serif; }
        .brand-subtitle { color: rgba(255,255,255,0.5); font-size: 0.6rem; font-weight: 600; letter-spacing: 0.14em; text-transform: uppercase; }

        /* [IMPROVED] Header buttons — tighter, more refined */
        .login-btn {
            padding: 0.45rem 1.1rem;
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            font-weight: 600;
            border: 1.5px solid rgba(255,215,15,0.6);
            color: var(--gold);
            background: transparent;
            letter-spacing: 0.01em;
            transition: all var(--transition);
            display: inline-flex; align-items: center; gap: 0.4rem;
        }
        .login-btn:hover {
            background: var(--gold);
            border-color: var(--gold);
            color: var(--navy);
            box-shadow: 0 0 14px var(--gold-glow);
        }
        .get-started-btn {
            padding: 0.45rem 1.2rem;
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            font-weight: 700;
            background: var(--gold);
            color: var(--navy);
            margin-right: 1.5rem;
            letter-spacing: 0.01em;
            box-shadow: 0 2px 10px rgba(255,215,15,0.32);
            transition: all var(--transition);
            display: inline-flex; align-items: center; gap: 0.4rem;
        }
        .get-started-btn:hover {
            background: var(--gold-dark);
            box-shadow: 0 4px 16px rgba(255,215,15,0.42);
            transform: translateY(-1px);
        }

        /* Mobile buttons */
        .mobile-login-btn {
            flex: 1; text-align: center;
            border: 1.5px solid var(--gold); color: var(--gold);
            padding: 0.55rem; border-radius: var(--radius-sm);
            font-size: 0.875rem; font-weight: 600;
            display: flex; align-items: center; justify-content: center; gap: 0.4rem;
        }
        .mobile-register-btn {
            flex: 1; text-align: center;
            background: var(--gold); color: var(--navy);
            padding: 0.55rem; border-radius: var(--radius-sm);
            font-size: 0.875rem; font-weight: 700;
            display: flex; align-items: center; justify-content: center; gap: 0.4rem;
        }

        /* ========== HERO ========== */
        /* [IMPROVED] Subtle radial gradient background for depth */
        .hero-section {
            background: radial-gradient(ellipse 90% 70% at 50% -5%,
                rgba(255,200,44,0.09) 0%,
                rgba(10,31,68,0.02) 70%);
            position: relative;
            overflow: hidden;
        }

        /* [ADDED] Decorative geometric accent shapes for visual interest */
        .hero-section::before {
            content: "";
            position: absolute; top: -60px; right: -60px;
            width: 340px; height: 340px;
            border-radius: 50%;
            border: 1.5px solid rgba(255,215,15,0.10);
            pointer-events: none;
        }
        .hero-section::after {
            content: "";
            position: absolute; bottom: 20px; left: -80px;
            width: 260px; height: 260px;
            border-radius: 50%;
            border: 1.5px solid rgba(31,58,109,0.10);
            pointer-events: none;
        }

        /* [IMPROVED] Accreditation badge — slightly taller, better padding */
        .accred-badge {
            display: inline-flex; align-items: center; gap: 0.5rem;
            background: var(--gold);
            color: var(--navy);
            padding: 0.4rem 1.1rem;
            border-radius: 9999px;
            font-size: 0.7rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
            margin-bottom: 1.75rem;
            border: 1.5px solid rgba(10,31,68,0.10);
            box-shadow: 0 3px 12px rgba(255,215,15,0.38);
        }

        .hero-title {
            color: var(--navy);
            line-height: 1.07;
            letter-spacing: -0.03em;
        }

        /* [IMPROVED] Hero CTA buttons — slightly larger, more consistent */
        .launch-btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 0.9rem 2.2rem;
            border-radius: var(--radius-md);
            font-size: 0.95rem; font-weight: 700;
            background: var(--gold); color: var(--navy);
            box-shadow: 0 8px 22px rgba(255,215,15,0.38);
            transition: all var(--transition);
            letter-spacing: 0.01em;
            font-family: 'Outfit', sans-serif;
        }
        .launch-btn:hover {
            background: var(--gold-dark);
            box-shadow: 0 12px 30px rgba(255,215,15,0.48);
            transform: translateY(-2px) scale(1.01);
        }
        .launch-btn:active { transform: translateY(0) scale(0.99); }

        .explore-btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 0.9rem 2.2rem;
            border-radius: var(--radius-md);
            font-size: 0.95rem; font-weight: 600;
            border: 2px solid rgba(31,58,109,0.45);
            color: var(--navy-mid);
            background: rgba(255,255,255,0.72);
            backdrop-filter: blur(6px);
            transition: all var(--transition);
            font-family: 'Outfit', sans-serif;
        }
        .explore-btn:hover {
            background: rgba(255,255,255,0.92);
            border-color: var(--navy-mid);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* [IMPROVED] Hero metric pills — better visual weight */
        .hero-metric {
            display: flex; align-items: center; gap: 0.5rem;
            background: rgba(255,255,255,0.62);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(31,58,109,0.14);
            border-radius: 9999px;
            padding: 0.4rem 1rem;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--navy-mid);
            transition: background var(--transition), transform var(--transition);
        }
        .hero-metric:hover {
            background: rgba(255,255,255,0.85);
            transform: translateY(-1px);
        }
        .hero-metric-icon {
            color: var(--navy-light);
            font-size: 0.75rem;
        }

        /* ========== TRUST STRIP ========== */
        /* [ADDED] New trust / partner logos strip below hero for institutional credibility */
        .trust-strip {
            background: rgba(255,255,255,0.55);
            backdrop-filter: blur(6px);
            border-top: 1px solid rgba(10,31,68,0.07);
            border-bottom: 1px solid rgba(10,31,68,0.07);
        }
        .trust-item {
            display: flex; align-items: center; gap: 0.5rem;
            font-size: 0.78rem; font-weight: 600;
            color: var(--navy-light);
            letter-spacing: 0.04em;
            text-transform: uppercase;
            opacity: 0.75;
            transition: opacity var(--transition);
        }
        .trust-item:hover { opacity: 1; }

        /* ========== STATS STRIP ========== */
        .stats-outer-container {
            background: rgba(255,252,240,0.88);
            backdrop-filter: blur(4px);
            border-top: 1px solid rgba(0,0,0,0.05);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        /* [IMPROVED] Stat cards — cleaner top border, more structured layout */
        .stat-card {
            background: rgba(255,252,248,0.95);
            border: 1px solid rgba(255,215,15,0.18);
            border-top: 3px solid var(--gold);
            border-radius: var(--radius-lg);
            padding: 1.4rem 1.25rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: transform 0.28s var(--ease-out), box-shadow 0.28s ease, background 0.2s;
        }
        .stat-card::before {
            content: "";
            position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(255,215,15,0.04) 0%, transparent 60%);
            pointer-events: none;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            background: rgba(255,248,225,0.97);
        }
        .stat-number {
            font-family: 'Outfit', sans-serif;
            font-size: 2.1rem;
            font-weight: 900;
            color: var(--navy);
            letter-spacing: -0.04em;
            line-height: 1.1;
        }
        .stat-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-top: 0.35rem;
            line-height: 1.35;
        }
        /* [ADDED] Stat icon for visual hierarchy */
        .stat-icon {
            width: 2.2rem; height: 2.2rem;
            border-radius: var(--radius-sm);
            background: var(--gold-pale);
            border: 1px solid rgba(255,215,15,0.3);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 0.85rem;
            color: var(--navy-mid);
            font-size: 0.85rem;
        }

        /* ========== SECTION HEADER ========== */
        .section-badge {
            display: inline-flex; align-items: center; gap: 0.4rem;
            background: var(--gold);
            color: var(--navy);
            padding: 0.32rem 0.9rem;
            border-radius: 9999px;
            font-size: 0.7rem; font-weight: 700;
            letter-spacing: 0.09em; text-transform: uppercase;
            margin-bottom: 0.85rem;
        }
        .section-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--navy);
            letter-spacing: -0.025em;
            line-height: 1.2;
        }
        .section-subtitle {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.65;
            max-width: 34rem;
            margin: 0 auto;
        }
        /* [IMPROVED] Divider — gradient left-to-right, short and impactful */
        .section-divider {
            display: block;
            width: 3rem; height: 3px;
            border-radius: 9999px;
            background: linear-gradient(90deg, var(--gold), rgba(74,111,165,0.4));
            margin: 0.85rem auto 0;
        }

        /* ========== FEATURE CARDS ========== */
        /* [IMPROVED] Cards — tighter internal spacing, cleaner hierarchy */
        .feature-card {
            background: var(--surface);
            border: 1px solid rgba(255,215,15,0.18);
            border-left: 4px solid var(--gold);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s var(--ease-out), box-shadow 0.3s ease, background 0.2s;
            overflow: hidden;
            display: flex; flex-direction: column;
        }
        .feature-card:hover {
            transform: translateY(-7px);
            box-shadow: var(--shadow-lg);
            background: rgba(255,252,248,0.99);
        }
        .feature-card-body { padding: 1.75rem; flex: 1; display: flex; flex-direction: column; }

        /* [IMPROVED] Feature icon — more structured, consistent size */
        .feature-icon {
            width: 2.85rem; height: 2.85rem;
            border-radius: var(--radius-md);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.2rem;
            background: rgba(74,111,165,0.10);
            color: var(--navy-mid);
            font-size: 1rem;
            border: 1px solid rgba(74,111,165,0.15);
            flex-shrink: 0;
            transition: background var(--transition), color var(--transition), transform var(--transition);
        }
        .feature-card:hover .feature-icon {
            background: var(--navy);
            color: var(--gold);
            transform: scale(1.05);
        }
        .feature-card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 0.5rem;
            letter-spacing: -0.015em;
        }
        .feature-card-desc {
            color: var(--text-muted);
            font-size: 0.855rem;
            line-height: 1.65;
            flex: 1;
        }

        /* [IMPROVED] Feature list — consistent sizing, aligned checkmarks */
        .feature-list {
            margin-top: 1.25rem;
            border-top: 1px solid rgba(10,31,68,0.06);
            padding-top: 1rem;
            list-style: none;
        }
        .feature-list li {
            display: flex; align-items: center; gap: 0.6rem;
            padding: 0.3rem 0;
            font-size: 0.835rem;
            color: var(--text-body);
            border-bottom: 1px solid rgba(0,0,0,0.04);
        }
        .feature-list li:last-child { border-bottom: none; }
        .feature-list .check-icon {
            font-size: 0.72rem;
            color: var(--gold-dark);
            flex-shrink: 0;
            width: 1rem; text-align: center;
        }

        /* [ADDED] Feature card footer link — consistent across all cards */
        .card-link {
            display: inline-flex; align-items: center; gap: 0.35rem;
            font-size: 0.82rem; font-weight: 700;
            color: var(--navy-mid);
            margin-top: 1.25rem;
            border-bottom: 1.5px solid var(--gold);
            padding-bottom: 1px;
            transition: color var(--transition), gap var(--transition), border-color var(--transition);
        }
        .card-link:hover {
            color: var(--navy);
            gap: 0.55rem;
            border-color: var(--gold-dark);
        }

        /* ========== HOW IT WORKS SECTION ========== */
        /* [ADDED] New "How It Works" section — 3-step process for clarity */
        .step-card {
            background: rgba(255,252,248,0.92);
            border: 1px solid rgba(255,215,15,0.18);
            border-radius: var(--radius-lg);
            padding: 2rem 1.5rem;
            text-align: center;
            position: relative;
            transition: transform 0.28s var(--ease-out), box-shadow 0.28s ease;
        }
        .step-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }
        .step-number {
            width: 3rem; height: 3rem;
            border-radius: 50%;
            background: var(--navy);
            color: var(--gold);
            font-family: 'Outfit', sans-serif;
            font-size: 1.1rem; font-weight: 800;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.1rem;
            box-shadow: 0 4px 12px rgba(10,31,68,0.2);
        }
        .step-connector {
            position: absolute; top: 3.35rem; right: -1.75rem;
            color: rgba(74,111,165,0.35);
            font-size: 1.2rem;
            z-index: 1;
        }

        /* ========== ANALYTICS SECTION ========== */
        .analytics-section-bg {
            background: rgba(255,253,246,0.92);
            backdrop-filter: blur(3px);
        }

        /* [IMPROVED] Analytics feature items — more compact, better aligned */
        .analytics-feature {
            display: flex; gap: 1rem; align-items: flex-start;
            padding: 1rem 1.1rem;
            border-radius: var(--radius-md);
            background: rgba(255,255,255,0.58);
            border: 1px solid rgba(10,31,68,0.07);
            transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
        }
        .analytics-feature:hover {
            background: rgba(255,255,255,0.88);
            transform: translateX(4px);
            box-shadow: var(--shadow-sm);
        }
        .analytics-feature-icon {
            width: 2.4rem; height: 2.4rem;
            border-radius: var(--radius-sm);
            background: var(--navy-faint);
            border: 1px solid rgba(74,111,165,0.18);
            display: flex; align-items: center; justify-content: center;
            color: var(--navy-mid);
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        /* [IMPROVED] Testimonial card — cleaner, more authoritative */
        .testimonial-card {
            border-radius: var(--radius-xl);
            overflow: hidden;
            width: 100%; max-width: 27rem;
            background: linear-gradient(150deg, #0B2450 0%, #162F5E 100%);
            border: 1px solid rgba(255,215,15,0.22);
            box-shadow: var(--shadow-lg);
            position: relative;
        }
        .testimonial-card::before {
            content: "";
            position: absolute; top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--gold), #FFF6B0, var(--gold));
            background-size: 200% 100%;
            animation: shimmer 4s linear infinite;
        }
        .testimonial-body {
            padding: 2.25rem 2rem;
            color: white;
            text-align: center;
        }
        .testimonial-icon-wrap {
            width: 3.5rem; height: 3.5rem;
            margin: 0 auto 1.25rem;
            border-radius: 50%;
            background: rgba(255,215,15,0.12);
            border: 1.5px solid rgba(255,215,15,0.32);
            display: flex; align-items: center; justify-content: center;
        }
        .stars { color: var(--gold); font-size: 0.85rem; letter-spacing: 0.12em; }

        /* [ADDED] Key metric mini-cards inside analytics section */
        .metric-chip {
            display: flex; flex-direction: column; align-items: center;
            padding: 1rem 1.25rem;
            background: rgba(255,255,255,0.75);
            border: 1px solid rgba(255,215,15,0.20);
            border-radius: var(--radius-md);
            text-align: center;
            transition: background var(--transition), transform var(--transition);
        }
        .metric-chip:hover {
            background: rgba(255,255,255,0.95);
            transform: translateY(-2px);
        }
        .metric-chip-number {
            font-family: 'Outfit', sans-serif;
            font-size: 1.5rem; font-weight: 900;
            color: var(--navy);
            letter-spacing: -0.03em;
        }
        .metric-chip-label {
            font-size: 0.72rem; font-weight: 600;
            color: var(--text-muted);
            margin-top: 0.2rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        /* ========== CTA SECTION ========== */
        .cta-section-bg {
            background: rgba(255,243,218,0.85);
            backdrop-filter: blur(4px);
        }
        /* [IMPROVED] CTA card — stronger visual anchor with shimmer top border */
        .cta-card {
            background: rgba(255,252,248,0.97);
            border: 1px solid rgba(255,215,15,0.28);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-lg);
            padding: 3.5rem 2.5rem;
            position: relative;
            overflow: hidden;
            text-align: center;
        }
        .cta-card::before {
            content: "";
            position: absolute; top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--gold), #FFF6B0, var(--gold));
            background-size: 200% 100%;
            animation: shimmer 3.5s linear infinite;
        }
        /* [ADDED] Subtle decorative background element in CTA */
        .cta-card::after {
            content: "";
            position: absolute; bottom: -60px; right: -60px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,215,15,0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .cta-title {
            font-size: 1.9rem; font-weight: 800;
            color: var(--navy);
            letter-spacing: -0.025em;
            line-height: 1.2;
        }
        .cta-subtitle {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.65;
            max-width: 30rem;
            margin: 0.85rem auto 0;
        }

        .demo-btn {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.85rem 2rem;
            border-radius: var(--radius-md);
            font-weight: 700; font-size: 0.9rem;
            font-family: 'Outfit', sans-serif;
            background: var(--gold);
            color: var(--navy);
            box-shadow: 0 4px 16px rgba(255,215,15,0.38);
            transition: all var(--transition);
        }
        .demo-btn:hover {
            background: var(--gold-dark);
            box-shadow: 0 8px 22px rgba(255,215,15,0.48);
            transform: translateY(-2px);
        }
        .contact-btn {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.85rem 2rem;
            border-radius: var(--radius-md);
            font-weight: 600; font-size: 0.9rem;
            font-family: 'Outfit', sans-serif;
            border: 2px solid rgba(31,58,109,0.40);
            color: var(--navy-mid);
            background: rgba(255,255,255,0.85);
            transition: all var(--transition);
        }
        .contact-btn:hover {
            background: var(--navy);
            border-color: var(--navy);
            color: var(--gold);
            transform: translateY(-2px);
        }

        /* [ADDED] CTA info strip — phone / email / support info */
        .cta-info-strip {
            display: flex; flex-wrap: wrap; justify-content: center; gap: 1.25rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(10,31,68,0.08);
        }
        .cta-info-item {
            display: flex; align-items: center; gap: 0.4rem;
            font-size: 0.78rem; font-weight: 500;
            color: var(--text-muted);
        }
        .cta-info-item i { color: var(--navy-light); font-size: 0.72rem; }

        /* ========== FOOTER ========== */
        .footer-bg { background: var(--navy); }

        /* [IMPROVED] Social links — cleaner sizing */
        .social-link {
            display: flex; align-items: center; justify-content: center;
            width: 2.25rem; height: 2.25rem;
            border-radius: 50%;
            border: 1px solid rgba(255,215,15,0.28);
            color: rgba(255,224,138,0.80);
            font-size: 0.82rem;
            transition: all var(--transition);
        }
        .social-link:hover {
            background: var(--gold);
            border-color: var(--gold);
            color: var(--navy);
            transform: translateY(-2px);
        }
        .footer-link {
            color: #9CA3AF;
            font-size: 0.865rem;
            transition: color var(--transition), transform var(--transition), padding-left var(--transition);
            display: inline-flex; align-items: center; gap: 0.35rem;
        }
        .footer-link:hover { color: var(--gold); padding-left: 3px; }
        .footer-section-title {
            color: white;
            font-family: 'Outfit', sans-serif;
            font-size: 0.8rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.1em;
            margin-bottom: 1rem;
        }

        /* [ADDED] Footer newsletter / contact highlight */
        .footer-contact-item {
            display: flex; align-items: flex-start; gap: 0.6rem;
            font-size: 0.855rem; color: #9CA3AF;
            line-height: 1.5;
        }
        .footer-contact-item i {
            color: var(--gold);
            font-size: 0.72rem;
            margin-top: 0.2rem;
            flex-shrink: 0;
        }
        .footer-bottom-link { color: #6B7280; font-size: 0.75rem; transition: color var(--transition); }
        .footer-bottom-link:hover { color: var(--gold); }

        /* [ADDED] Divider utility */
        .footer-divider { border-color: rgba(255,255,255,0.08); }

        /* ========== UTILITY ========== */
        .gold-text { color: var(--gold-dark); }
        .text-navy  { color: var(--navy); }

        /* ========== FOCUS / ACCESSIBILITY ========== */
        *:focus-visible {
            outline: 2.5px solid var(--gold);
            outline-offset: 3px;
            border-radius: 3px;
        }

        /* ========== SECTION SEPARATOR ========== */
        /* [ADDED] Light wave / line separator between sections for visual rhythm */
        .section-sep {
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, rgba(10,31,68,0.10) 30%, rgba(255,215,15,0.25) 50%, rgba(10,31,68,0.10) 70%, transparent 100%);
            border: none;
        }

        /* ========== LEARN MORE LINK ========== */
        .learn-more-link {
            display: inline-flex; align-items: center; gap: 0.45rem;
            font-weight: 700; font-size: 0.875rem;
            color: var(--navy-mid);
            border-bottom: 2px solid var(--gold);
            padding-bottom: 1px;
            transition: color var(--transition), gap var(--transition), border-color var(--transition);
        }
        .learn-more-link:hover {
            color: var(--navy);
            gap: 0.65rem;
            border-color: var(--gold-dark);
        }

        /* Mobile menu background */
        .mobile-menu-bg { background: var(--navy); }
    </style>
</head>
<body class="antialiased">

    <header class="sticky top-0 z-40 shadow-lg header-bg" id="site-header">
        <div class="px-0">
            <div class="flex flex-wrap justify-between items-center py-3 md:py-0 md:h-[72px]">

                <div class="logo-wrapper">
                    <img src="logo/NatU.png" alt="National University logo" class="logo-img"
                         onerror="this.src='https://placehold.co/56x56/0A1F44/FFD70F?text=NU'">
                    <div class="leading-tight">
                        <span class="brand-subtitle">National University</span>
                        <div class="flex items-baseline gap-1">
                            <span class="logo-text-primary">NU Clicks</span>
                            <span class="logo-text-secondary">LMS</span>
                        </div>
                    </div>
                </div>

                <nav class="hidden md:flex items-center space-x-7" aria-label="Primary navigation">
                    <a href="#platform" class="nav-link">
                        <i class="fas fa-th-large mr-1.5 text-xs opacity-70"></i>Platform
                    </a>
                    <a href="#solutions" class="nav-link">
                        <i class="fas fa-lightbulb mr-1.5 text-xs opacity-70"></i>Solutions
                    </a>
                    <a href="#research" class="nav-link">
                        <i class="fas fa-flask mr-1.5 text-xs opacity-70"></i>Research
                    </a>
                    <a href="#support" class="nav-link">
                        <i class="fas fa-life-ring mr-1.5 text-xs opacity-70"></i>Support
                    </a>
                    <div class="flex items-center gap-3 pl-5 border-l border-white/12">
                        <a href="/login" class="login-btn" aria-label="Log in to NU Clicks LMS">
                            <i class="fas fa-sign-in-alt text-xs"></i> Log in
                        </a>
                        <a href="/register" class="get-started-btn" aria-label="Register for NU Clicks LMS">
                            <i class="fas fa-user-plus text-xs"></i> Get started
                        </a>
                    </div>
                </nav>

                <div class="md:hidden pr-4">
                    <button class="text-white focus:outline-none p-1.5" id="mobile-menu-btn" aria-label="Toggle navigation" aria-expanded="false">
                        <i class="fas fa-bars text-xl" id="menu-icon"></i>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="md:hidden hidden mobile-menu-bg px-5 pb-5 border-t border-white/10" role="navigation" aria-label="Mobile navigation">
            <div class="flex flex-col space-y-1 pt-3">
                <a href="#platform" class="text-white/72 hover:text-white py-2 text-sm font-medium flex items-center gap-2.5">
                    <i class="fas fa-th-large text-xs w-4 text-center opacity-60"></i>Platform
                </a>
                <a href="#solutions" class="text-white/72 hover:text-white py-2 text-sm font-medium flex items-center gap-2.5">
                    <i class="fas fa-lightbulb text-xs w-4 text-center opacity-60"></i>Solutions
                </a>
                <a href="#research" class="text-white/72 hover:text-white py-2 text-sm font-medium flex items-center gap-2.5">
                    <i class="fas fa-flask text-xs w-4 text-center opacity-60"></i>Research
                </a>
                <a href="#support" class="text-white/72 hover:text-white py-2 text-sm font-medium flex items-center gap-2.5">
                    <i class="fas fa-life-ring text-xs w-4 text-center opacity-60"></i>Support
                </a>
                <div class="flex gap-3 pt-3">
                    <a href="/login" class="mobile-login-btn">
                        <i class="fas fa-sign-in-alt text-xs"></i> Login
                    </a>
                    <a href="/register" class="mobile-register-btn">
                        <i class="fas fa-user-plus text-xs"></i> Register
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section id="platform" class="relative overflow-hidden hero-section">
            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-20 md:py-28">
                <div class="text-center max-w-4xl mx-auto">

                    <div class="anim-fade-up anim-delay-1">
                        <span class="accred-badge">
                            <i class="fas fa-university text-xs"></i>
                            Accredited &nbsp;·&nbsp; National University System
                        </span>
                    </div>

                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold hero-title anim-fade-up anim-delay-2">
                        Elevate <span class="gold-text">digital excellence</span><br>
                        with NU Clicks LMS
                    </h1>

                    <p class="text-base md:text-lg text-gray-700 max-w-2xl mx-auto mt-6 leading-relaxed font-normal anim-fade-up anim-delay-3">
                        A unified, data‑driven learning ecosystem for students, faculty, and administrators.
                        Drive academic success through real‑time intelligence and seamless collaboration.
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center gap-4 mt-10 anim-fade-up anim-delay-4">
                        <a href="/register" class="launch-btn">
                            <i class="fas fa-rocket text-sm"></i> Launch Portal
                        </a>
                        <a href="#solutions" class="explore-btn">
                            <i class="fas fa-play-circle text-sm"></i> Explore features
                        </a>
                    </div>

                    <div class="mt-14 flex flex-wrap justify-center gap-3 anim-fade-up anim-delay-5">
                        <div class="hero-metric">
                            <i class="fas fa-book-open hero-metric-icon"></i>
                            <span>1,200+ active courses</span>
                        </div>
                        <div class="hero-metric">
                            <i class="fas fa-users hero-metric-icon"></i>
                            <span>15K+ learners</span>
                        </div>
                        <div class="hero-metric">
                            <i class="fas fa-star hero-metric-icon"></i>
                            <span>94% student satisfaction</span>
                        </div>
                        <div class="hero-metric">
                            <i class="fas fa-shield-alt hero-metric-icon"></i>
                            <span>ISO 27001 certified</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="stats-outer-container py-14 reveal">
            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

                    <div class="stat-card reveal reveal-delay-1">
                        <div class="stat-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="stat-number">98<span class="text-xl font-bold">%</span></div>
                        <p class="stat-label">Faculty adoption rate</p>
                    </div>

                    <div class="stat-card reveal reveal-delay-2">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-number">24<span class="text-lg font-bold">/7</span></div>
                        <p class="stat-label">Global access &amp; support</p>
                    </div>

                    <div class="stat-card reveal reveal-delay-3">
                        <div class="stat-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="stat-number">#1</div>
                        <p class="stat-label">Academic innovation ranking</p>
                    </div>

                    <div class="stat-card reveal" style="transition-delay: 0.46s">
                        <div class="stat-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="stat-number text-2xl">ISO</div>
                        <p class="stat-label">27001 certified security</p>
                    </div>
                </div>
            </div>
        </div>

        <hr class="section-sep">

        <section id="solutions" class="py-24">
            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">

                <div class="text-center mb-16 reveal">
                    <span class="section-badge">
                        <i class="fas fa-layer-group text-xs"></i> Integrated ecosystem
                    </span>
                    <h2 class="section-title mt-2">
                        Built for the <span class="gold-text">modern university</span>
                    </h2>
                    <span class="section-divider"></span>
                    <p class="section-subtitle mt-5">
                        Role‑specific tools that empower every stakeholder across the academic journey — from orientation to graduation.
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-7">

                    <div class="feature-card reveal reveal-delay-1">
                        <div class="feature-card-body">
                            <div class="feature-icon">
                                <i class="fas fa-user-graduate text-lg"></i>
                            </div>
                            <h3 class="feature-card-title">Student Experience</h3>
                            <p class="feature-card-desc">
                                Personalized dashboards, adaptive assignments, peer collaboration, and mobile‑first access to lectures &amp; grades.
                            </p>
                            <ul class="feature-list">
                                <li><i class="fas fa-check-circle check-icon"></i><span>AI study recommendations</span></li>
                                <li><i class="fas fa-check-circle check-icon"></i><span>Real‑time grade analytics</span></li>
                                <li><i class="fas fa-check-circle check-icon"></i><span>Integrated library &amp; resources</span></li>
                                <li><i class="fas fa-check-circle check-icon"></i><span>Mobile app for iOS &amp; Android</span></li>
                            </ul>
                            <a href="#" class="card-link">
                                Student portal <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>

                    <div class="feature-card reveal reveal-delay-2">
                        <div class="feature-card-body">
                            <div class="feature-icon">
                                <i class="fas fa-chalkboard-teacher text-lg"></i>
                            </div>
                            <h3 class="feature-card-title">Faculty Empowerment</h3>
                            <p class="feature-card-desc">
                                Streamlined course authoring, automated assessment, engagement analytics, and early‑alert systems for at-risk students.
                            </p>
                            <ul class="feature-list">
                                <li><i class="fas fa-check-circle check-icon"></i><span>Rubric‑based grading</span></li>
                                <li><i class="fas fa-check-circle check-icon"></i><span>Attendance &amp; participation tracking</span></li>
                                <li><i class="fas fa-check-circle check-icon"></i><span>Rich multimedia content studio</span></li>
                                <li><i class="fas fa-check-circle check-icon"></i><span>Automated plagiarism detection</span></li>
                            </ul>
                            <a href="#" class="card-link">
                                Faculty workspace <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>

                    <div class="feature-card reveal reveal-delay-3">
                        <div class="feature-card-body">
                            <div class="feature-icon">
                                <i class="fas fa-building text-lg"></i>
                            </div>
                            <h3 class="feature-card-title">Administrative Suite</h3>
                            <p class="feature-card-desc">
                                Centralized governance, compliance reporting, enrollment analytics, and institutional performance KPIs — all in one place.
                            </p>
                            <ul class="feature-list">
                                <li><i class="fas fa-check-circle check-icon"></i><span>Program &amp; curriculum management</span></li>
                                <li><i class="fas fa-check-circle check-icon"></i><span>Accreditation readiness tools</span></li>
                                <li><i class="fas fa-check-circle check-icon"></i><span>Advanced data privacy controls</span></li>
                                <li><i class="fas fa-check-circle check-icon"></i><span>Custom role &amp; permission controls</span></li>
                            </ul>
                            <a href="#" class="card-link">
                                Admin analytics <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr class="section-sep">

        <section class="py-20" style="background: rgba(255,252,245,0.88); backdrop-filter: blur(2px);">
            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">

                <div class="text-center mb-14 reveal">
                    <span class="section-badge">
                        <i class="fas fa-map-signs text-xs"></i> Getting started
                    </span>
                    <h2 class="section-title mt-2">
                        Up and running in <span class="gold-text">three steps</span>
                    </h2>
                    <span class="section-divider"></span>
                    <p class="section-subtitle mt-5">
                        NU Clicks LMS is designed for quick onboarding — no training required to get started.
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 relative">
                    <div class="step-card reveal reveal-delay-1">
                        <span class="step-connector hidden md:block">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                        <div class="step-number">1</div>
                        <div class="w-10 h-10 mx-auto mb-4 flex items-center justify-center text-navy-light text-xl opacity-70">
                            <i class="fas fa-id-card-alt text-2xl" style="color:var(--navy-light)"></i>
                        </div>
                        <h3 class="text-base font-700 text-navy font-bold mb-2" style="font-family:'Outfit',sans-serif;">Create your account</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Register using your institutional email. SSO with existing university systems is fully supported.</p>
                    </div>

                    <div class="step-card reveal reveal-delay-2">
                        <span class="step-connector hidden md:block">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                        <div class="step-number">2</div>
                        <div class="w-10 h-10 mx-auto mb-4 flex items-center justify-center text-xl opacity-70">
                            <i class="fas fa-th-large text-2xl" style="color:var(--navy-light)"></i>
                        </div>
                        <h3 class="text-base font-bold text-navy mb-2" style="font-family:'Outfit',sans-serif;">Access your courses</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Your enrolled courses, schedules, and materials are automatically synced from the registrar system.</p>
                    </div>

                    <div class="step-card reveal reveal-delay-3">
                        <div class="step-number">3</div>
                        <div class="w-10 h-10 mx-auto mb-4 flex items-center justify-center text-xl opacity-70">
                            <i class="fas fa-chart-bar text-2xl" style="color:var(--navy-light)"></i>
                        </div>
                        <h3 class="text-base font-bold text-navy mb-2" style="font-family:'Outfit',sans-serif;">Track your progress</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Monitor grades, submissions, and learning outcomes in real-time from any device, anywhere.</p>
                    </div>
                </div>
            </div>
        </section>

        <hr class="section-sep">

        <section id="research" class="py-20 analytics-section-bg">
            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
                <div class="flex flex-col lg:flex-row gap-16 items-center">

                    <div class="flex-1 order-2 lg:order-1 reveal">
                        <span class="section-badge">
                            <i class="fas fa-flask text-xs"></i> Research-driven platform
                        </span>
                        <h2 class="text-3xl font-bold leading-tight text-navy mt-2" style="letter-spacing:-0.025em;">
                            Intelligent analytics &amp; <span class="gold-text">predictive insights</span>
                        </h2>
                        <p class="text-gray-600 mt-4 leading-relaxed text-sm max-w-lg">
                            NU Clicks LMS harnesses learning analytics to identify at-risk students, personalize intervention strategies, and continuously improve curriculum effectiveness — all while maintaining FERPA &amp; GDPR compliance.
                        </p>

                        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="analytics-feature">
                                <div class="analytics-feature-icon">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy text-sm">Real-time dashboards</h4>
                                    <p class="text-xs text-gray-500 mt-0.5">Track engagement, completion, and performance metrics</p>
                                </div>
                            </div>
                            <div class="analytics-feature">
                                <div class="analytics-feature-icon">
                                    <i class="fas fa-robot"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy text-sm">AI recommendations</h4>
                                    <p class="text-xs text-gray-500 mt-0.5">Adaptive learning paths tailored for each student</p>
                                </div>
                            </div>
                            <div class="analytics-feature">
                                <div class="analytics-feature-icon">
                                    <i class="fas fa-bell"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy text-sm">Early alert system</h4>
                                    <p class="text-xs text-gray-500 mt-0.5">Proactive intervention for at-risk students</p>
                                </div>
                            </div>
                            <div class="analytics-feature">
                                <div class="analytics-feature-icon">
                                    <i class="fas fa-file-export"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy text-sm">Compliance reporting</h4>
                                    <p class="text-xs text-gray-500 mt-0.5">Automated accreditation &amp; CHED reports</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-3 gap-3">
                            <div class="metric-chip">
                                <span class="metric-chip-number">18%</span>
                                <span class="metric-chip-label">Retention ↑</span>
                            </div>
                            <div class="metric-chip">
                                <span class="metric-chip-number">3.2×</span>
                                <span class="metric-chip-label">Faster grading</span>
                            </div>
                            <div class="metric-chip">
                                <span class="metric-chip-number">94%</span>
                                <span class="metric-chip-label">Satisfaction</span>
                            </div>
                        </div>

                        <div class="mt-7">
                            <a href="#" class="learn-more-link">
                                Explore research &amp; case studies <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>

                    <div class="flex-1 order-1 lg:order-2 flex justify-center reveal reveal-delay-2">
                        <div class="testimonial-card">
                            <div class="testimonial-body">
                                <div class="testimonial-icon-wrap">
                                    <i class="fas fa-chart-line text-2xl" style="color:var(--gold);"></i>
                                </div>
                                <p class="text-base font-medium leading-relaxed text-white/90">
                                    "NU Clicks LMS increased first‑year student retention by <strong style="color:var(--gold)">18%</strong> through data-driven early alert systems and personalized interventions."
                                </p>
                                <div class="mt-5 flex justify-center gap-0.5 stars">★★★★★</div>
                                <span class="text-xs text-white/50 block mt-2">— National University Academic Report 2025</span>

                                <div class="mt-5 pt-4" style="border-top:1px solid rgba(255,255,255,0.08);">
                                    <div class="flex justify-around">
                                        <div class="text-center">
                                            <div class="text-xl font-900 text-white" style="font-family:'Outfit',sans-serif;font-weight:800;">15K+</div>
                                            <div class="text-xs text-white/45 mt-0.5">Active learners</div>
                                        </div>
                                        <div class="w-px bg-white/10 mx-3"></div>
                                        <div class="text-center">
                                            <div class="text-xl font-800 text-white" style="font-family:'Outfit',sans-serif;font-weight:800;">1,200+</div>
                                            <div class="text-xs text-white/45 mt-0.5">Courses offered</div>
                                        </div>
                                        <div class="w-px bg-white/10 mx-3"></div>
                                        <div class="text-center">
                                            <div class="text-xl font-800 text-white" style="font-family:'Outfit',sans-serif;font-weight:800;">98%</div>
                                            <div class="text-xs text-white/45 mt-0.5">Faculty adoption</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr class="section-sep">

        <section class="py-20 cta-section-bg">
            <div class="max-w-4xl mx-auto px-5 sm:px-8">
                <div class="cta-card reveal">
                    <h3 class="cta-title">
                        Join the digital transformation at<br>
                        <span class="gold-text">National University</span>
                    </h3>
                    <p class="cta-subtitle">
                        Accelerate your institution's learning outcomes with next‑gen LMS technology. Schedule a live demo or request early access today.
                    </p>

                    <div class="flex flex-wrap justify-center gap-4 mt-9">
                        <a href="/register" class="demo-btn">
                            <i class="fas fa-calendar-check text-sm"></i> Request a demo
                        </a>
                        <a href="#" class="contact-btn">
                            <i class="fas fa-phone-alt text-sm"></i> Contact admissions
                        </a>
                    </div>

                    <div class="cta-info-strip">
                        <div class="cta-info-item">
                            <i class="fas fa-headset"></i>
                            <span>24/7 live support</span>
                        </div>
                        <div class="cta-info-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Demo in under 30 minutes</span>
                        </div>
                        <div class="cta-info-item">
                            <i class="fas fa-lock"></i>
                            <span>No commitment required</span>
                        </div>
                        <div class="cta-info-item">
                            <i class="fas fa-envelope"></i>
                            <span>www.national-u.edu.ph</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer id="support" class="footer-bg pt-16 pb-8">
            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-10 border-b footer-divider">

                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <i class="fas fa-graduation-cap text-xl" style="color:var(--gold)"></i>
                            <span class="text-white text-lg font-bold" style="font-family:'Outfit',sans-serif;">
                                NU Clicks <span style="color:var(--gold)">LMS</span>
                            </span>
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            Empowering National University's academic mission with advanced, data-driven learning technology.
                        </p>
                        <div class="flex space-x-2.5 mt-5">
                            <a href="#" class="social-link" aria-label="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Twitter / X">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>

                    <div>
                        <h4 class="footer-section-title">Platform</h4>
                        <ul class="space-y-2.5">
                            <li>
                                <a href="#" class="footer-link">
                                    <i class="fas fa-user-graduate text-xs opacity-50"></i> Student portal
                                </a>
                            </li>
                            <li>
                                <a href="#" class="footer-link">
                                    <i class="fas fa-chalkboard-teacher text-xs opacity-50"></i> Faculty workspace
                                </a>
                            </li>
                            <li>
                                <a href="#" class="footer-link">
                                    <i class="fas fa-chart-pie text-xs opacity-50"></i> Admin analytics
                                </a>
                            </li>
                            <li>
                                <a href="#" class="footer-link">
                                    <i class="fas fa-mobile-alt text-xs opacity-50"></i> Mobile app
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="footer-section-title">Resources</h4>
                        <ul class="space-y-2.5">
                            <li>
                                <a href="#" class="footer-link">
                                    <i class="fas fa-question-circle text-xs opacity-50"></i> Help center
                                </a>
                            </li>
                            <li>
                                <a href="#" class="footer-link">
                                    <i class="fas fa-calendar-alt text-xs opacity-50"></i> Academic calendar
                                </a>
                            </li>
                            <li>
                                <a href="#" class="footer-link">
                                    <i class="fas fa-shield-alt text-xs opacity-50"></i> Security &amp; compliance
                                </a>
                            </li>
                            <li>
                                <a href="#" class="footer-link">
                                    <i class="fas fa-code text-xs opacity-50"></i> Developer API
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="footer-section-title">Contact</h4>
                        <ul class="space-y-3">
                            <li class="footer-contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>SM City Lipa, Ayala Highway, Lipa City, Batangas</span>
                            </li>
                            <li class="footer-contact-item">
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:lms-support@nu.edu" class="hover:text-yellow-400 transition-colors">www.national-u.edu.ph</a>
                            </li>
                            <li class="footer-contact-item">
                                <i class="fas fa-phone-alt"></i>
                                <span>09399188505</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-between items-center pt-6 gap-3">
                    <p class="text-gray-500 text-xs">
                        © 2025 National University — NU Clicks Learning Management System. All rights reserved.
                    </p>
                    <div class="flex gap-5">
                        <a href="#" class="footer-bottom-link">Privacy policy</a>
                        <a href="#" class="footer-bottom-link">Terms of use</a>
                        <a href="#" class="footer-bottom-link">Accessibility</a>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <script>
        /* ── Mobile menu toggle ── */
        const menuBtn    = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon   = document.getElementById('menu-icon');
        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => {
                const isHidden = mobileMenu.classList.toggle('hidden');
                menuIcon.className = isHidden ? 'fas fa-bars text-xl' : 'fas fa-times text-xl';
                menuBtn.setAttribute('aria-expanded', String(!isHidden));
            });
        }

        /* ── Header shadow on scroll ── */
        const header = document.getElementById('site-header');
        window.addEventListener('scroll', () => {
            header.classList.toggle('scrolled', window.scrollY > 10);
        }, { passive: true });

        /* ── Scroll-reveal via IntersectionObserver ── */
        const reveals = document.querySelectorAll('.reveal');
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    io.unobserve(e.target);
                }
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
                    
                    // Add logic to close the mobile menu if it is currently open
                    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                        if (menuIcon) menuIcon.className = 'fas fa-bars text-xl';
                        if (menuBtn) menuBtn.setAttribute('aria-expanded', 'false');
                    }
                }
            });
        });
    </script>
</body>
</html>