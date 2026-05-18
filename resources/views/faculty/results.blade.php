<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Course Analytics - {{ $course->name }} | NU Horizon LMS</title>
    <!-- Google Fonts + Remix Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:opsz,wght@9..144,600;9..144,700;9..144,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: { preflight: false },
        }
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #F8F6F1;
            overflow-x: hidden;
        }

        :root {
            --blue-deep: #0A1F44;
            --gold: #FFD70F;
            --gold-dark: #e5c20c;
            --gray-light: #F8FAFF;
            --gray-border: rgba(10,31,68,0.09);
            --card-shadow: 0 8px 24px rgba(10,31,68,0.05);
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            --danger-red: #dc2626;
            --danger-dark: #b91c1c;
        }

        /* Sidebar styles */
        

        @media (max-width: 1024px) {
            
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            
        }

        
        
        
        .logo-text h1 span
        

        .nav-section {
            padding: 0 1rem;
            margin-top: 1.5rem;
        }
        .nav-section-title {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255, 215, 15, 0.5);
            margin-bottom: 0.75rem;
            font-weight: 700;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 1rem;
            border-radius: 12px;
            color: rgba(255, 255, 255, 0.75);
            transition: var(--transition);
            margin-bottom: 0.25rem;
            font-weight: 500;
            text-decoration: none;
        }
        .nav-item i {
            font-size: 1.2rem;
            width: 1.5rem;
        }
        .nav-item:hover {
            background: rgba(255, 215, 15, 0.12);
            color: white;
        }
        .nav-item.active {
            background: var(--gold);
            color: var(--blue-deep);
        }
        .nav-item.active i {
            color: var(--blue-deep);
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 1.2rem;
            border-top: 1px solid rgba(255, 215, 15, 0.2);
        }
        .profile-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            text-decoration: none;
        }
        .avatar {
            width: 42px;
            height: 42px;
            background: rgba(255, 215, 15, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
        }
        .profile-details p {
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
            margin: 0;
        }
        .profile-details span {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.7rem;
        }
        
        .logout-btn {
            width: 100%;
            background: rgba(220, 38, 38, 0.15);
            border: none;
            padding: 0.6rem;
            border-radius: 40px;
            color: #fca5a5;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: var(--transition);
        }
        .logout-btn:hover {
            background: var(--danger-red);
            color: white;
        }

        /* Main content */
        
        .top-bar {
            background: white;
            padding: 1.2rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            border-bottom: 1px solid var(--gray-border);
            position: sticky;
            top: 0;
            z-index: 20;
        }
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--blue-deep);
        }
        @media (max-width: 1024px) {
            .menu-toggle {
                display: block;
            }
            
        }

        /* Analytics Bento Grid cards */
        .glass-card {
            background: white;
            border-radius: 1.5rem;
            border: 1px solid rgba(10,31,68,0.06);
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
        }

        .stat-card {
            background: white;
            border-radius: 1.25rem;
            border: 1px solid rgba(10,31,68,0.06);
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: var(--transition);
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(10,31,68,0.08);
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        /* Table design elements */
        .table-wrap {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            text-align: left;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #637089;
            background: #F8FAFC;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid rgba(10,31,68,0.09);
            font-weight: 700;
        }
        td {
            padding: 1.1rem 1.25rem;
            border-bottom: 1px solid rgba(10,31,68,0.05);
            color: #2C3E5C;
            font-size: 0.9rem;
            vertical-align: middle;
        }
        tr:hover td {
            background: #FFFDF4;
        }

        .btn-light {
            border: 1px solid var(--gray-border);
            background: #F8FAFC;
            color: var(--blue-deep);
            padding: 0.6rem 1rem;
            border-radius: 999px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            text-decoration: none;
            font-size: 0.8rem;
            transition: var(--transition);
        }
        .btn-light:hover {
            background: #e2e8f0;
        }

        .btn-gold {
            border: none;
            background: var(--gold);
            color: var(--blue-deep);
            padding: 0.6rem 1rem;
            border-radius: 999px;
            font-weight: 800;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            text-decoration: none;
            font-size: 0.8rem;
            transition: var(--transition);
        }
        .btn-gold:hover {
            background: var(--gold-dark);
        }

        /* ===== LOGOUT CONFIRMATION MODAL STYLES ===== */
        .logout-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(10, 31, 68, 0.75);
            backdrop-filter: blur(4px);
            z-index: 1100;
            display: flex;
            align-items: center;
            justify-content: center;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0.2s, opacity 0.2s ease;
        }
        .logout-modal-overlay.active {
            visibility: visible;
            opacity: 1;
        }
        .logout-confirmation-modal {
            background: white;
            max-width: 450px;
            width: 90%;
            border-radius: 1.5rem;
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transform: scale(0.95);
            transition: transform 0.2s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }
        .logout-modal-overlay.active .logout-confirmation-modal {
            transform: scale(1);
        }
        .logout-modal-header {
            background: var(--blue-deep);
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid var(--gold);
        }
        .logout-modal-header h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .logout-modal-header h3 i {
            color: var(--gold);
            font-size: 1.4rem;
        }
        .logout-modal-close {
            background: none;
            border: none;
            color: rgba(255,255,255,0.7);
            font-size: 1.6rem;
            cursor: pointer;
        }
        .logout-modal-close:hover {
            color: var(--gold);
        }
        .logout-modal-body {
            padding: 1.8rem 1.5rem;
            background: white;
            text-align: center;
        }
        .logout-modal-body p {
            font-size: 1rem;
            color: #1f2937;
            font-weight: 500;
            margin-bottom: 0;
        }
        .logout-modal-footer {
            padding: 1rem 1.5rem 1.5rem 1.5rem;
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            background: #f9fafb;
            border-top: 1px solid var(--gray-border);
        }
        .logout-modal-btn {
            padding: 0.6rem 1.25rem;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }
        .logout-modal-btn-cancel {
            background: #eef2ff;
            color: #1e293b;
        }
        .logout-modal-btn-confirm {
            background: var(--danger-red);
            color: white;
        }
    
        

        

        

        

        

        

        

        

        

        

        .sun-rays .ray-1 { height: 20px; opacity: 0.45; transform: translateX(-50%) rotate(-64deg); }
        .sun-rays .ray-2 { height: 24px; opacity: 0.58; transform: translateX(-50%) rotate(-48deg); }
        .sun-rays .ray-3 { height: 28px; opacity: 0.70; transform: translateX(-50%) rotate(-32deg); }
        .sun-rays .ray-4 { height: 31px; opacity: 0.82; transform: translateX(-50%) rotate(-16deg); }
        .sun-rays .ray-5 { height: 34px; opacity: 1; width: 2.5px; transform: translateX(-50%) rotate(0deg); }
        .sun-rays .ray-6 { height: 31px; opacity: 0.82; transform: translateX(-50%) rotate(16deg); }
        .sun-rays .ray-7 { height: 28px; opacity: 0.70; transform: translateX(-50%) rotate(32deg); }
        .sun-rays .ray-8 { height: 24px; opacity: 0.58; transform: translateX(-50%) rotate(48deg); }
        .sun-rays .ray-9 { height: 20px; opacity: 0.45; transform: translateX(-50%) rotate(64deg); }

    
        /* UNIFIED PREMIUM LOGO STYLING - PREVENTS SIZING JUMPS */
        .sidebar-logo {
            padding: 1.5rem !important;
            border-bottom: 1px solid rgba(255, 215, 15, 0.2) !important;
            display: flex !important;
            align-items: center !important;
            gap: 0.82rem !important;
            min-height: 96px !important;
            height: 96px !important;
            overflow: visible !important;
            box-sizing: border-box !important;
        }

        .sidebar-logo-img {
            height: 45px !important;
            width: auto !important;
            flex-shrink: 0 !important;
        }

        .logo-text {
            position: relative !important;
            min-width: 0 !important;
            overflow: visible !important;
        }

        .logo-text h1 {
            font-family: 'Fraunces', serif !important;
            font-size: 1.3rem !important;
            font-weight: 800 !important;
            color: white !important;
            letter-spacing: -0.3px !important;
            line-height: 1.05 !important;
            margin: 0 !important;
            white-space: nowrap !important;
            overflow: visible !important;
        }

        .logo-text p {
            font-size: 0.55rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.1em !important;
            text-transform: uppercase !important;
            color: rgba(255,255,255,0.5) !important;
            margin-top: 0.25rem !important;
            margin-bottom: 0 !important;
        }

        .horizon-logo-wrap {
            position: relative !important;
            display: inline-block !important;
            margin-left: 0.05rem !important;
            color: var(--gold) !important;
            overflow: visible !important;
        }

        .horizon-word {
            position: relative !important;
            display: inline-block !important;
            color: var(--gold) !important;
            z-index: 2 !important;
        }

        .sun-rays {
            position: absolute !important;
            left: 50% !important;
            top: -1.48rem !important;
            width: 108px !important;
            height: 36px !important;
            transform: translateX(-50%) !important;
            pointer-events: none !important;
            z-index: 1 !important;
            overflow: visible !important;
        }

        .sun-rays::after {
            content: "" !important;
            position: absolute !important;
            left: 50% !important;
            bottom: -2px !important;
            width: 62px !important;
            height: 18px !important;
            transform: translateX(-50%) !important;
            background: radial-gradient(ellipse at center, rgba(255, 215, 15, 0.30), transparent 72%) !important;
            border-radius: 999px !important;
        }

        .sun-rays .ray {
            position: absolute !important;
            left: 50% !important;
            bottom: 0 !important;
            width: 2px !important;
            border-radius: 999px !important;
            background: linear-gradient(
                to top,
                rgba(255, 215, 15, 0.95) 0%,
                rgba(255, 215, 15, 0.55) 42%,
                rgba(255, 215, 15, 0.00) 100%
            ) !important;
            transform-origin: bottom center !important;
            filter: drop-shadow(0 -1px 3px rgba(255, 215, 15, 0.18)) !important;
        }

        .sun-rays .ray-1 { height: 20px !important; opacity: 0.45 !important; transform: translateX(-50%) rotate(-64deg) !important; }
        .sun-rays .ray-2 { height: 24px; opacity: 0.58 !important; transform: translateX(-50%) rotate(-48deg) !important; }
        .sun-rays .ray-3 { height: 28px; opacity: 0.70 !important; transform: translateX(-50%) rotate(-32deg) !important; }
        .sun-rays .ray-4 { height: 31px; opacity: 0.82 !important; transform: translateX(-50%) rotate(-16deg) !important; }
        .sun-rays .ray-5 { height: 34px; opacity: 1 !important; width: 2.5px !important; transform: translateX(-50%) rotate(0deg) !important; }
        .sun-rays .ray-6 { height: 31px; opacity: 0.82 !important; transform: translateX(-50%) rotate(16deg) !important; }
        .sun-rays .ray-7 { height: 28px; opacity: 0.70 !important; transform: translateX(-50%) rotate(32deg) !important; }
        .sun-rays .ray-8 { height: 24px; opacity: 0.58 !important; transform: translateX(-50%) rotate(48deg) !important; }
        .sun-rays .ray-9 { height: 20px; opacity: 0.45 !important; transform: translateX(-50%) rotate(64deg) !important; }

        /* LOCKED SIDEBAR AND MAIN CONTENT LAYOUT */
        .sidebar {
            background-color: var(--blue-deep) !important;
            width: 280px !important;
            min-width: 280px !important;
            max-width: 280px !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            height: 100% !important;
            z-index: 40 !important;
            transition: transform 0.3s ease !important;
            display: flex !important;
            flex-direction: column !important;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08) !important;
            box-sizing: border-box !important;
        }

        .main-content {
            margin-left: 280px !important;
            transition: margin-left 0.3s ease !important;
            min-height: 100vh !important;
            box-sizing: border-box !important;
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%) !important;
            }
            .sidebar.mobile-open {
                transform: translateX(0) !important;
            }
            .main-content {
                margin-left: 0 !important;
            }
        }

    </style>
</head>
<body>

<aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
        <img src="/logo/NatU.png" alt="NU Logo" class="sidebar-logo-img" onerror="this.src='https://placehold.co/45x45/0A1F44/FFD70F?text=NU'">

        <div class="logo-text">
            <h1>
                NU
                <span class="horizon-logo-wrap">
                    <span class="sun-rays" aria-hidden="true">
                        <span class="ray ray-1"></span>
                        <span class="ray ray-2"></span>
                        <span class="ray ray-3"></span>
                        <span class="ray ray-4"></span>
                        <span class="ray ray-5"></span>
                        <span class="ray ray-6"></span>
                        <span class="ray ray-7"></span>
                        <span class="ray ray-8"></span>
                        <span class="ray ray-9"></span>
                    </span>

                    <span class="horizon-word">HORIZON</span>
                </span>
            </h1>

            <p>Faculty Portal</p>
        </div>
    </div>

    <div style="flex:1; overflow-y: auto;">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>
            <a href="{{ route('faculty.dashboard') }}" class="nav-item">
                <i class="ri-dashboard-line"></i> Dashboard
            </a>
            <a href="{{ route('faculty.students') }}" class="nav-item">
                <i class="ri-user-line"></i> Students
            </a>
            <a href="{{ route('faculty.courses') }}" class="nav-item">
                <i class="ri-book-line"></i> Courses
            </a>
            <a href="{{ route('faculty.folder-files') }}" class="nav-item">
                <i class="ri-folder-3-line"></i> Files & Folders
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Quiz Management</div>
            <a href="{{ route('faculty.quiz.create') }}" class="nav-item">
                <i class="ri-add-circle-line"></i> Create Quiz
            </a>
            <a href="{{ route('faculty.quizzes.list') }}" class="nav-item">
                <i class="ri-list-check"></i> All Quizzes
            </a>
            <a href="{{ route('faculty.question.bank') }}" class="nav-item">
                <i class="ri-database-2-line"></i> Question Bank
            </a>
            <a href="{{ route('faculty.grading') }}" class="nav-item">
                <i class="ri-graduation-cap-line"></i> Grading
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Analytics</div>
            <a href="{{ route('faculty.results.index') }}" class="nav-item active">
                <i class="ri-bar-chart-line"></i> Results & Analytics
            </a>
            <a href="{{ route('faculty.my-evaluation') }}" class="nav-item">
                <i class="ri-star-smile-line"></i> My Evaluation
            </a>
        </div>
    </div>

    <div class="sidebar-footer">
        <a href="{{ route('faculty.profile') }}" class="profile-info" style="text-decoration: none;">
            <div class="avatar">
                <i class="ri-user-line"></i>
            </div>
            <div class="profile-details">
                <p>{{ Auth::user()->name }}</p>
                <span>{{ Auth::user()->email }}</span>
            </div>
        </a>
        <form method="POST" action="{{ route('logout') }}" id="logoutForm">
            @csrf
            <button type="button" id="logoutButton" class="logout-btn">
                <i class="ri-logout-box-r-line"></i> Sign Out
            </button>
        </form>
    </div>
</aside>

<div class="main-content" id="mainContent">
    <div class="top-bar">
        <div class="flex items-center gap-3">
            <button class="menu-toggle" id="menuToggle">
                <i class="ri-menu-line"></i>
            </button>
            <div>
                <h2 style="font-weight:800;color:var(--blue-deep);font-size:1.15rem;margin:0;">
                    {{ $course->code }} — {{ $course->name }}
                </h2>
                <p class="text-xs text-gray-500 hidden md:block">
                    Course Performance Metrics & Statistics
                </p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('faculty.results.index') }}" class="btn-light">
                <i class="ri-arrow-left-line"></i> Back to Courses
            </a>
            <a href="{{ route('faculty.download.results', $course->id) }}" class="btn-gold">
                <i class="ri-download-line"></i> Download CSV
            </a>
        </div>
    </div>

    <div class="p-4 md:p-6 space-y-6">
        <!-- Statistics Bento Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            <div class="stat-card">
                <div>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Total Enrolled</p>
                    <p class="text-2xl font-black mt-1" style="color: var(--blue-deep);">{{ $overallStats['total_students'] }}</p>
                </div>
                <div class="stat-icon bg-blue-50 text-blue-600">
                    <i class="ri-user-line"></i>
                </div>
            </div>

            <div class="stat-card">
                <div>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Total Quizzes</p>
                    <p class="text-2xl font-black mt-1" style="color: var(--blue-deep);">{{ $overallStats['total_quizzes'] }}</p>
                </div>
                <div class="stat-icon bg-indigo-50 text-indigo-600">
                    <i class="ri-quiz-line"></i>
                </div>
            </div>

            <div class="stat-card">
                <div>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Overall Avg. Score</p>
                    <p class="text-2xl font-black mt-1" style="color: var(--blue-deep);">{{ round($overallStats['average_score']) }}%</p>
                </div>
                <div class="stat-icon bg-emerald-50 text-emerald-600">
                    <i class="ri-percent-line"></i>
                </div>
            </div>

            <div class="stat-card">
                <div>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Completion Rate</p>
                    <p class="text-2xl font-black mt-1" style="color: var(--blue-deep);">{{ round($overallStats['completion_rate']) }}%</p>
                </div>
                <div class="stat-icon bg-amber-50 text-amber-600">
                    <i class="ri-checkbox-circle-line"></i>
                </div>
            </div>
        </div>

        <!-- Performance Board -->
        <div class="glass-card overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                <div>
                    <h3 class="text-sm font-black m-0" style="color:var(--blue-deep);">Quiz Performance Dashboard</h3>
                    <p class="text-xs text-gray-500 mt-1">Summary of all quiz evaluations published in this course.</p>
                </div>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Quiz Title</th>
                            <th>Total Attempts</th>
                            <th>Average Score</th>
                            <th>Highest</th>
                            <th>Lowest</th>
                            <th>Passing Rate</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($analytics as $data)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-[#0A1F44]/5 text-[#0A1F44] flex items-center justify-center font-extrabold text-sm shrink-0">
                                            Q
                                        </div>
                                        <div>
                                            <p class="font-extrabold text-[#0A1F44] m-0">{{ $data['quiz']->title }}</p>
                                            <p class="text-xs text-gray-400 mt-1">{{ $data['quiz']->total_points }} Points Total</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="font-bold text-gray-700">
                                    {{ $data['total_attempts'] }}
                                </td>
                                <td>
                                    <div class="flex items-center gap-1">
                                        <span class="font-black text-[#0A1F44]">{{ round($data['average'], 1) }}</span>
                                        <span class="text-xs text-gray-400">/ {{ $data['quiz']->total_points }}</span>
                                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full ml-1">
                                            {{ $data['average_percentage'] }}%
                                        </span>
                                    </div>
                                </td>
                                <td class="font-black text-emerald-600">{{ $data['highest'] }}</td>
                                <td class="font-bold text-red-500">{{ $data['lowest'] }}</td>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <div class="w-16 bg-gray-100 rounded-full h-1.5 overflow-hidden">
                                            <div class="bg-emerald-500 h-full rounded-full" style="width: {{ $data['passing_rate'] }}%"></div>
                                        </div>
                                        <span class="text-xs font-extrabold text-slate-700">{{ round($data['passing_rate']) }}%</span>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('faculty.submissions', $data['quiz']->id) }}" class="btn-light">
                                        <i class="ri-eye-line"></i> View Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-12 text-gray-500">
                                    <i class="ri-bar-chart-box-line text-5xl text-gray-300 block mb-3"></i>
                                    No quiz data is currently recorded for this course.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Logout Modal -->
<div id="logoutModal" class="logout-modal-overlay">
    <div class="logout-confirmation-modal">
        <div class="logout-modal-header">
            <h3>
                <i class="ri-logout-box-r-line"></i> 
                Confirm Sign Out
            </h3>
            <button class="logout-modal-close" onclick="closeLogoutModal()">&times;</button>
        </div>
        <div class="logout-modal-body">
            <p>Are you sure you want to sign out of your account?</p>
            <p class="text-xs text-gray-500 mt-2">You will be redirected to the login page.</p>
        </div>
        <div class="logout-modal-footer">
            <button class="logout-modal-btn logout-modal-btn-cancel" onclick="closeLogoutModal()">Cancel</button>
            <button class="logout-modal-btn logout-modal-btn-confirm" id="confirmLogoutBtn">Yes, Sign Out</button>
        </div>
    </div>
</div>

<script>
    // Sidebar Drawer controls
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('mobile-open');
        });
    }
    document.addEventListener('click', function(event) {
        const isMobile = window.innerWidth <= 1024;
        if (isMobile && sidebar.classList.contains('mobile-open')) {
            if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                sidebar.classList.remove('mobile-open');
            }
        }
    });

    // Logout Modal Helpers
    const logoutButton = document.getElementById('logoutButton');
    const logoutModal = document.getElementById('logoutModal');
    const confirmLogoutBtn = document.getElementById('confirmLogoutBtn');
    const logoutForm = document.getElementById('logoutForm');

    function openLogoutModal() {
        logoutModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeLogoutModal() {
        logoutModal.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (logoutButton) {
        logoutButton.addEventListener('click', (e) => {
            e.preventDefault();
            openLogoutModal();
        });
    }
    if (confirmLogoutBtn) {
        confirmLogoutBtn.addEventListener('click', () => {
            if (logoutForm) {
                logoutForm.submit();
            } else {
                window.location.href = "{{ route('logout') }}";
            }
        });
    }
</script>
</body>
</html>