<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>National University | Nu Clicks LMS — Intelligent Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* ========== GLOBAL & RESET ========== */
        * {
            font-family: 'Inter', sans-serif;
        }
        
        /* ========== BACKGROUND IMAGE (replaces solid white/light backgrounds) ========== */
        body {
            background: #0A1F44; /* fallback deep navy */
            position: relative;
        }
        
        /* main full-page background image with cinematic overlay for readability */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('/logo/natt.png');
            background-size: cover;
            background-position: center 30%;
            background-attachment: fixed;
            filter: brightness(0.92) contrast(1.05);
            z-index: -2;
        }
        
        /* soft overlay to ensure text contrast and modern aesthetic */
        body::after {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 248, 235, 0.72); /* warm light overlay - keeps navy text crisp */
            backdrop-filter: blur(1px);
            z-index: -1;
            pointer-events: none;
        }
        
        /* ----- REPLACE ALL WHITE/SOLID LIGHT BACKGROUNDS WITH SEMI-TRANSPARENT ELEMENTS (image visible underneath) ----- */
        .feature-card,
        .stat-card,
        .cta-card,
        .stats-section-card {
            background: rgba(255, 252, 245, 0.92) !important;
            backdrop-filter: blur(2px);
            transition: all 0.25s ease;
        }
        
        /* override Tailwind bg-white / bg-white/60 classes that were originally solid white */
        .bg-white,
        [class*="bg-white/"],
        .bg-white\/60,
        .bg-white\/70,
        .bg-white\/80,
        .bg-opacity-white {
            background: rgba(255, 252, 242, 0.88) !important;
            backdrop-filter: blur(1.5px);
        }
        
        /* specifically target analytics section, stats bar, and any white container */
        .analytics-card-bg {
            background: rgba(255, 253, 245, 0.92) !important;
            backdrop-filter: blur(2px);
        }
        
        /* feature card enhancements */
        .feature-card {
            transition: transform 0.25s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(255, 215, 15, 0.25);
        }
        
        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 35px -12px rgba(10, 31, 68, 0.2);
            background: rgba(255, 252, 245, 0.96) !important;
        }
        
        /* stat card hover */
        .stat-card:hover {
            background: rgba(255, 232, 138, 0.85) !important;
            border-color: #FFD70F;
        }
        
        /* hero gradient stays semi-transparent to let image flow, but text remains readable */
        .hero-gradient {
            background: radial-gradient(circle at 100% 0%, rgba(255,199,44,0.12) 0%, rgba(10,31,68,0.04) 80%);
            backdrop-filter: blur(0px);
        }
        
        /* accreditation badge remains vibrant, not white */
        .accred-badge {
            background: #FFE08A;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        /* stats card highlight (navy gradient) remains solid for contrast, but slightly transparent? we keep original impact */
        .stats-card-highlight {
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);
            overflow: hidden;
            width: 100%;
            max-width: 28rem;
            background: linear-gradient(145deg, #0A1F44, #1F3A6D);
            border: 1px solid rgba(255,215,15,0.3);
        }
        
        /* CTA section background (light gold) now semi-transparent to match background image */
        .cta-bg {
            background: rgba(255, 243, 218, 0.85) !important;
            backdrop-filter: blur(4px);
        }
        
        /* ensure section badge styles are untouched */
        .section-badge, .section-badge-inline {
            background: #FFE08A;
            color: #0A1F44;
        }
        
        /* stats section container (original had bg-white/60 backdrop-blur-sm) */
        .stats-outer-container {
            background: rgba(255, 252, 240, 0.85) !important;
            backdrop-filter: blur(2px);
            border-top: 1px solid rgba(0,0,0,0.05);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        /* login/register buttons not affected, they keep original styling */
        .login-btn, .get-started-btn, .mobile-login-btn, .mobile-register-btn {
            backdrop-filter: none;
        }
        
        /* ensure footer is solid navy (no transparency issues) */
        .footer-bg {
            background-color: #0A1F44;
        }
        
        /* card hover and readability */
        .gold-focus:focus-visible {
            outline: 2px solid #FFD70F;
            outline-offset: 2px;
        }
        .card-hover {
            transition: transform 0.25s ease, box-shadow 0.3s ease;
        }
        
        .gold-text {
            color: #FFD70F;
        }
        .text-navy {
            color: #0A1F44;
        }
        .bg-navy {
            background-color: #0A1F44;
        }
        .bg-gold {
            background-color: #FFD70F;
        }
        .hover-bg-gold-dark:hover {
            background-color: #E0A800;
        }
        .gold-gradient {
            background: linear-gradient(90deg, #FFC72C, #4A6FA5);
        }
        
        /* header background remains solid navy for brand authority */
        .header-bg {
            background-color: #092554;
        }
        .mobile-menu-bg {
            background-color: #0A1F44;
        }
        .nav-link:hover {
            color: #FFD70F;
        }
        .login-btn {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.2s;
            border: 1px solid #FFD70F;
            color: #FFD70F;
            background: transparent;
        }
        .login-btn:hover {
            background-color: #FFD70F;
            color: #0A1F44;
        }
        .get-started-btn {
            padding: 0.5rem 1.25rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 600;
            box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);
            transition: all 0.2s;
            background-color: #FFD70F;
            color: #0A1F44;
            margin-right: 25px;
        }
        .get-started-btn:hover {
            background-color: #E0A800;
        }
        .mobile-login-btn {
            flex: 1;
            text-align: center;
            border: 1px solid #FFD70F;
            color: #FFD70F;
            padding: 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 600;
        }
        .mobile-register-btn {
            flex: 1;
            text-align: center;
            background-color: #FFD70F;
            color: #0A1F44;
            padding: 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        /* logo area */
        .logo-wrapper {
            display: flex;
            align-items: center;
            gap: .25rem;
        }
        .logo-img {
            height: 3rem;
            width: auto;
            margin-left: 25px;
        }
        .logo-text-primary {
            color: white;
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: -0.025em;
        }
        .logo-text-secondary {
            color: #FFD70F;
            font-size: 1.25rem;
            font-weight: 700;
        }
        .brand-subtitle {
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.05em;
        }
        
        /* hero */
        .hero-title {
            color: #0A1F44;
        }
        .launch-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem 2rem;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            transition: all 0.2s;
            transform: scale(1);
            background-color: #FFD70F;
            color: #0A1F44;
        }
        .launch-btn:hover {
            background-color: #E0A800;
            transform: scale(1.02);
        }
        .explore-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem 2rem;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.2s;
            border: 2px solid #1F3A6D;
            color: #1F3A6D;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(2px);
        }
        .explore-btn:hover {
            background-color: #F5F9FF;
            border-color: #4A6FA5;
        }
        .icon-muted {
            color: #4A6FA5;
        }
        .stat-text {
            color: #1F3A6D;
        }
        .stat-number {
            color: #FFD70F;
        }
        
        /* feature icon */
        .feature-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            background: rgba(74,111,165,0.15);
            color: #4A6FA5;
        }
        .check-icon {
            font-size: 0.75rem;
            color: #FFD70F;
        }
        .analytics-icon {
            color: #4A6FA5;
        }
        .learn-more-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            transition: color 0.2s;
            color: #FFD70F;
        }
        .learn-more-link:hover {
            color: #E0A800;
        }
        .stars {
            color: #FFE08A;
            font-size: 0.875rem;
        }
        .demo-btn {
            padding: 0.75rem 1.75rem;
            border-radius: 0.5rem;
            font-weight: 700;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            transition: all 0.2s;
            background: #FFD70F;
            color: #0A1F44;
        }
        .demo-btn:hover {
            background-color: #E0A800;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        }
        .contact-btn {
            padding: 0.75rem 1.75rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s;
            border: 2px solid #0A1F44;
            color: #0A1F44;
            background: rgba(255,255,245,0.9);
        }
        .contact-btn:hover {
            background-color: #0A1F44;
            color: #FFD70F;
        }
        .social-link {
            color: #FFE08A;
            transition: color 0.2s;
            font-size: 1.25rem;
        }
        .social-link:hover {
            color: #FFD70F;
        }
        .footer-link {
            color: #d1d5db;
            transition: color 0.2s;
            font-size: 0.875rem;
        }
        .footer-link:hover {
            color: #FFD70F;
        }
        .footer-bottom-link {
            color: #9ca3af;
            transition: color 0.2s;
            font-size: 0.75rem;
        }
        .footer-bottom-link:hover {
            color: #FFD70F;
        }
    </style>
</head>
<body class="antialiased">

    <!-- ==================== HEADER / NAVIGATION ==================== -->
    <header class="sticky top-0 z-40 shadow-lg header-bg">
        <div class="px-0">
            <div class="flex flex-wrap justify-between items-center py-3 md:py-0 md:h-20">
                
                <!-- ===== SEPARATED LOGO AREA ===== -->
                <div class="logo-wrapper">
                    <img src="logo/NatU.png" alt="National University logo" class="logo-img" onerror="this.src='https://placehold.co/60x60?text=NU'">
                    <div class="leading-tight">
                        <span class="brand-subtitle">NATIONAL UNIVERSITY</span>
                        <div class="flex items-baseline gap-1">
                            <span class="logo-text-primary">NU Clicks</span>
                            <span class="logo-text-secondary">LMS</span>
                        </div>
                    </div>
                </div>

                <!-- Desktop Navigation + Buttons (Right) -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="nav-link text-white/80 hover:text-gold text-sm font-medium transition">Platform</a>
                    <a href="#" class="nav-link text-white/80 hover:text-gold text-sm font-medium transition">Solutions</a>
                    <a href="#" class="nav-link text-white/80 hover:text-gold text-sm font-medium transition">Research</a>
                    <a href="#" class="nav-link text-white/80 hover:text-gold text-sm font-medium transition">Support</a>
                    <div class="flex items-center gap-3 pl-2 border-l border-white/20">
                        <a href="/login" class="login-btn">Log in</a>
                        <a href="/register" class="get-started-btn">Get started</a>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button class="text-white focus:outline-none" id="mobile-menu-btn"><i class="fas fa-bars text-xl"></i></button>
                </div>
            </div>
        </div>
        <!-- Mobile menu dropdown -->
        <div id="mobile-menu" class="md:hidden hidden mobile-menu-bg px-5 pb-5 border-t border-white/10">
            <div class="flex flex-col space-y-3 pt-3">
                <a href="#" class="text-white/80 hover:text-gold py-1">Platform</a>
                <a href="#" class="text-white/80 hover:text-gold py-1">Solutions</a>
                <a href="#" class="text-white/80 hover:text-gold py-1">Research</a>
                <a href="#" class="text-white/80 hover:text-gold py-1">Support</a>
                <div class="flex gap-3 pt-2">
                    <a href="/login" class="mobile-login-btn">Login</a>
                    <a href="/register" class="mobile-register-btn">Register</a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <!-- HERO SECTION with background image shining through -->
        <section class="relative overflow-hidden hero-gradient">
            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-16 md:py-24">
                <div class="text-center max-w-4xl mx-auto">
                    <div class="accred-badge">
                        <i class="fas fa-university text-xs"></i>
                        <span class="text-xs font-bold tracking-wide uppercase">Accredited • National University System</span>
                    </div>
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold tracking-tight leading-tight hero-title">
                        Elevate <span class="gold-text">digital excellence</span><br>with Nu Clicks LMS
                    </h1>
                    <p class="text-lg md:text-xl text-gray-700 max-w-2xl mx-auto mt-6 leading-relaxed font-medium">
                        A unified, data‑driven learning ecosystem for students, faculty, and administrators.  
                        Drive academic success through real‑time intelligence and seamless collaboration.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4 mt-10">
                        <a href="/register" class="launch-btn"> <i class="fas fa-rocket"></i> Launch Portal</a>
                        <a href="#features" class="explore-btn"> <i class="fas fa-play-circle"></i> Explore features</a>
                    </div>
                    <!-- Key metrics -->
                    <div class="mt-14 flex flex-wrap justify-center gap-x-8 gap-y-4 text-sm font-medium">
                        <div class="flex items-center gap-2"><i class="fas fa-chalkboard-user icon-muted"></i><span class="stat-text">1,200+ active courses</span></div>
                        <div class="flex items-center gap-2"><i class="fas fa-users icon-muted"></i><span class="stat-text">15K+ learners</span></div>
                        <div class="flex items-center gap-2"><i class="fas fa-chart-line icon-muted"></i><span class="stat-text">94% student satisfaction</span></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- STATS SECTION (replaced solid white background with image-transparent overlay) -->
        <div class="stats-outer-container border-y border-gray-200/50 py-0">
            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-12">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                    <div class="stat-card p-4 rounded-xl transition shadow-sm"><div class="text-3xl font-black stat-number">98%</div><p class="text-sm font-semibold text-gray-800 mt-1">Faculty adoption rate</p></div>
                    <div class="stat-card p-4 rounded-xl transition shadow-sm"><div class="text-3xl font-black stat-number">24/7</div><p class="text-sm font-semibold text-gray-800 mt-1">Global access & support</p></div>
                    <div class="stat-card p-4 rounded-xl transition shadow-sm"><div class="text-3xl font-black stat-number">#1</div><p class="text-sm font-semibold text-gray-800 mt-1">Academic innovation ranking</p></div>
                    <div class="stat-card p-4 rounded-xl transition shadow-sm"><div class="text-3xl font-black stat-number">ISO</div><p class="text-sm font-semibold text-gray-800 mt-1">27001 certified security</p></div>
                </div>
            </div>
        </div>

        <!-- FEATURE GRID (Role-based cards) -->
        <section id="features" class="py-20">
            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
                <div class="text-center mb-14">
                    <span class="section-badge">Integrated ecosystem</span>
                    <h2 class="text-3xl md:text-4xl font-bold mt-4 section-title">Built for the <span class="gold-text">modern university</span></h2>
                    <div class="w-20 h-1 mx-auto mt-4 rounded-full gold-gradient"></div>
                    <p class="text-gray-700 max-w-2xl mx-auto mt-4">Role‑specific tools that empower every stakeholder across the academic journey.</p>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Student Card -->
                    <div class="feature-card rounded-xl shadow-md">
                        <div class="p-6 md:p-8">
                            <div class="feature-icon"><i class="fas fa-user-graduate text-xl"></i></div>
                            <h3 class="text-xl font-bold text-navy">Student Experience</h3>
                            <p class="text-gray-600 text-sm mt-2 leading-relaxed">Personalized dashboards, adaptive assignments, peer collaboration, and mobile‑first access to lectures & grades.</p>
                            <ul class="mt-5 space-y-2 text-sm">
                                <li class="flex items-center gap-2"><i class="fas fa-check-circle check-icon"></i><span class="text-gray-800">AI study recommendations</span></li>
                                <li class="flex items-center gap-2"><i class="fas fa-check-circle check-icon"></i><span class="text-gray-800">Real‑time grade analytics</span></li>
                                <li class="flex items-center gap-2"><i class="fas fa-check-circle check-icon"></i><span class="text-gray-800">Integrated library & resources</span></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Faculty Card -->
                    <div class="feature-card rounded-xl shadow-md">
                        <div class="p-6 md:p-8">
                            <div class="feature-icon"><i class="fas fa-chalkboard-user text-xl"></i></div>
                            <h3 class="text-xl font-bold text-navy">Faculty Empowerment</h3>
                            <p class="text-gray-600 text-sm mt-2 leading-relaxed">Streamlined course authoring, automated assessment, engagement analytics, and early‑alert systems.</p>
                            <ul class="mt-5 space-y-2 text-sm">
                                <li class="flex items-center gap-2"><i class="fas fa-check-circle check-icon"></i><span class="text-gray-800">Rubric‑based grading</span></li>
                                <li class="flex items-center gap-2"><i class="fas fa-check-circle check-icon"></i><span class="text-gray-800">Attendance & participation tracking</span></li>
                                <li class="flex items-center gap-2"><i class="fas fa-check-circle check-icon"></i><span class="text-gray-800">Rich multimedia content studio</span></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Admin Card -->
                    <div class="feature-card rounded-xl shadow-md">
                        <div class="p-6 md:p-8">
                            <div class="feature-icon"><i class="fas fa-building-user text-xl"></i></div>
                            <h3 class="text-xl font-bold text-navy">Administrative Suite</h3>
                            <p class="text-gray-600 text-sm mt-2 leading-relaxed">Centralized governance, compliance reporting, enrollment analytics, and institutional performance KPIs.</p>
                            <ul class="mt-5 space-y-2 text-sm">
                                <li class="flex items-center gap-2"><i class="fas fa-check-circle check-icon"></i><span class="text-gray-800">Program & curriculum management</span></li>
                                <li class="flex items-center gap-2"><i class="fas fa-check-circle check-icon"></i><span class="text-gray-800">Accreditation readiness tools</span></li>
                                <li class="flex items-center gap-2"><i class="fas fa-check-circle check-icon"></i><span class="text-gray-800">Advanced data privacy controls</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ANALYTICS HIGHLIGHT (transparent white bg replaced with semi-transparent overlay) -->
        <section class="py-16 analytics-card-bg">
            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
                <div class="flex flex-col lg:flex-row gap-12 items-center">
                    <div class="flex-1 order-2 lg:order-1">
                        <div class="section-badge-inline">Research-driven platform</div>
                        <h2 class="text-3xl font-bold leading-tight text-navy">Intelligent analytics & <span class="gold-text">predictive insights</span></h2>
                        <p class="text-gray-700 mt-4 leading-relaxed">Nu Clicks LMS harnesses learning analytics to identify at‑risk students, personalize intervention strategies, and continuously improve curriculum effectiveness — all while maintaining FERPA/GDPR compliance.</p>
                        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex gap-3"><i class="fas fa-chart-simple text-xl analytics-icon"></i><div><h4 class="font-semibold text-navy">Real‑time dashboards</h4><p class="text-xs text-gray-600">Track engagement, completion, and performance metrics</p></div></div>
                            <div class="flex gap-3"><i class="fas fa-robot text-xl analytics-icon"></i><div><h4 class="font-semibold text-navy">AI recommendations</h4><p class="text-xs text-gray-600">Adaptive learning paths for each student</p></div></div>
                        </div>
                        <div class="mt-6">
                            <a href="#" class="learn-more-link">Explore research & case studies <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="flex-1 order-1 lg:order-2 flex justify-center">
                        <div class="stats-card-highlight">
                            <div class="p-6 text-white text-center">
                                <i class="fas fa-chart-line text-5xl mb-3 gold-text"></i>
                                <p class="text-base font-medium">“Nu Clicks LMS increased first‑year retention by 18% through early alert systems.”</p>
                                <div class="mt-4 flex justify-center gap-1 stars">★★★★★</div>
                                <span class="text-xs opacity-80 block mt-2">— National University Academic Report 2025</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FINAL CTA (light gold semi-transparent) -->
        <section class="py-16 cta-bg">
            <div class="max-w-6xl mx-auto px-5 sm:px-8 text-center">
                <div class="cta-card rounded-2xl shadow-xl">
                    <h3 class="text-2xl md:text-3xl font-bold text-navy">Join the digital transformation at <span class="gold-text">National University</span></h3>
                    <p class="text-gray-800 max-w-xl mx-auto mt-3">Accelerate your institution’s learning outcomes with next‑gen LMS. Schedule a demo or request early access.</p>
                    <div class="flex flex-wrap justify-center gap-4 mt-8">
                        <a href="/register" class="demo-btn">Request demo <i class="fas fa-calendar-check ml-1"></i></a>
                        <a href="#" class="contact-btn">Contact admissions <i class="fas fa-phone-alt ml-1"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER (Navy + Gold) -->
        <footer class="footer-bg pt-16 pb-8">
            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-10 border-b border-white/10">
                    <div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-graduation-cap gold-text text-xl"></i>
                            <span class="text-white text-lg font-bold">Nu Clicks <span class="gold-text">LMS</span></span>
                        </div>
                        <p class="text-gray-400 text-sm mt-3 leading-relaxed">Empowering National University's academic mission with advanced learning technology.</p>
                        <div class="flex space-x-4 mt-5">
                            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold text-base mb-4">Platform</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="footer-link">Student portal</a></li>
                            <li><a href="#" class="footer-link">Faculty workspace</a></li>
                            <li><a href="#" class="footer-link">Admin analytics</a></li>
                            <li><a href="#" class="footer-link">Mobile app</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold text-base mb-4">Resources</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="footer-link">Help center</a></li>
                            <li><a href="#" class="footer-link">Academic calendar</a></li>
                            <li><a href="#" class="footer-link">Security & compliance</a></li>
                            <li><a href="#" class="footer-link">Developer API</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold text-base mb-4">Contact</h4>
                        <ul class="space-y-2 text-sm text-gray-300">
                            <li class="flex items-center gap-2"><i class="fas fa-map-marker-alt gold-text text-xs"></i> Main Campus, University City</li>
                            <li class="flex items-center gap-2"><i class="fas fa-envelope gold-text text-xs"></i> lms-support@nu.edu</li>
                            <li class="flex items-center gap-2"><i class="fas fa-phone-alt gold-text text-xs"></i> +1 (800) 452‑6789</li>
                        </ul>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row justify-between items-center pt-6 text-gray-400 text-xs">
                    <p>© 2025 National University — Nu Clicks Learning Management System. All rights reserved.</p>
                    <div class="flex gap-6 mt-3 md:mt-0">
                        <a href="#" class="footer-bottom-link">Privacy policy</a>
                        <a href="#" class="footer-bottom-link">Terms of use</a>
                        <a href="#" class="footer-bottom-link">Accessibility</a>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <script>
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>