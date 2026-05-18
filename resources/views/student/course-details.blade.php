<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>{{ $course->name }} - NU Horizon LMS</title>
    
    <!-- Google Fonts + Remix Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:opsz,wght@9..144,600;9..144,700;9..144,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    
    <!-- Tailwind CSS -->
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
            --navy: #0A1F44;
            --navy-mid: #1F3A6D;
            --navy-lite: #3D5FA0;
            --navy-pale: #EEF3FB;
            --gold: #FFD70F;
            --gold-d: #C49A00;
            --gold-mid: #F5C800;
            --gold-pale: #FFFBEA;
            --bg: #F8F6F1;
            --bg-2: #F2EEE5;
            --white: #FFFFFF;
            --txt-1: #0A1F44;
            --txt-2: #2C3E5C;
            --txt-3: #637089;
            --bdr: rgba(10,31,68,0.09);
            --bdr-gold: rgba(196,154,0,0.28);
            --card-shadow: 0 8px 20px rgba(10,31,68,0.05);
            --transition: all 0.25s ease;
            --danger-red: #dc2626;
            --danger-dark: #b91c1c;
            --blue-deep: #0A1F44;
        }

        /* Sidebar & Nav Sections */
        .nav-section {
            padding: 0 1rem;
            margin-top: 1.5rem;
        }
        .nav-section-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,215,15,0.6);
            margin-bottom: 0.75rem;
            font-weight: 600;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 1rem;
            border-radius: 12px;
            color: rgba(255,255,255,0.85);
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
            background: rgba(255,215,15,0.15);
            color: white;
        }
        .nav-item.active {
            background: var(--gold);
            color: var(--navy);
        }
        .nav-item.active i {
            color: var(--navy);
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 1.2rem;
            border-top: 1px solid rgba(255,215,15,0.2);
        }
        .profile-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }
        .avatar {
            width: 42px;
            height: 42px;
            background: rgba(255,215,15,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 1.1rem;
            border: 2px solid var(--gold);
        }
        .profile-details p {
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
            margin: 0;
        }
        .profile-details span {
            color: rgba(255,255,255,0.6);
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
            box-shadow: 0 4px 10px rgba(220, 38, 38, 0.3);
        }

        /* Top Bar */
        .top-bar {
            background: white;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            border-bottom: 1px solid var(--bdr);
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
            color: var(--navy);
        }
        .page-title {
            font-family: 'Fraunces', serif;
            font-weight: 700;
            color: var(--navy);
        }

        @media (max-width: 1024px) {
            .menu-toggle {
                display: block;
            }
        }

        .dashboard-card {
            background: white;
            border-radius: 1.2rem;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--bdr);
            overflow: hidden;
        }

        /* Logout Confirmation Modal */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(10, 31, 68, 0.75);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            visibility: hidden;
            opacity: 0;
            transition: all 0.2s ease;
        }
        .modal-overlay.active {
            visibility: visible;
            opacity: 1;
        }
        .confirmation-modal {
            background: white;
            max-width: 450px;
            width: 90%;
            border-radius: 1.5rem;
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transform: scale(0.95);
            transition: transform 0.2s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }
        .modal-overlay.active .confirmation-modal {
            transform: scale(1);
        }
        .modal-header {
            background: var(--navy);
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid var(--gold);
        }
        .modal-header h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .modal-header h3 i {
            color: var(--gold);
        }
        .modal-close {
            background: none;
            border: none;
            color: rgba(255,255,255,0.7);
            font-size: 1.6rem;
            cursor: pointer;
        }
        .modal-close:hover {
            color: var(--gold);
        }
        .modal-body {
            padding: 1.8rem 1.5rem;
            text-align: center;
        }
        .modal-footer {
            padding: 1rem 1.5rem 1.5rem;
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            background: #f9fafb;
            border-top: 1px solid var(--bdr);
        }
        .modal-btn {
            padding: 0.6rem 1.25rem;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }
        .modal-btn-cancel {
            background: #eef2ff;
            color: #1e293b;
        }
        .modal-btn-cancel:hover {
            background: #e2e8f0;
        }
        .modal-btn-confirm {
            background: var(--danger-red);
            color: white;
        }
        .modal-btn-confirm:hover {
            background: var(--danger-dark);
        }

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
            background-color: var(--navy) !important;
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

<!-- ========== SIDEBAR ========== -->
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

            <p>Student Portal</p>
        </div>
    </div>

    <div style="flex:1; overflow-y: auto;">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>
            <a href="{{ route('student.dashboard') }}" class="nav-item">
                <i class="ri-dashboard-line"></i> Dashboard
            </a>
            <a href="{{ route('student.courses') }}" class="nav-item active">
                <i class="ri-book-line"></i> My Courses
            </a>
            <a href="{{ route('student.progress') }}" class="nav-item">
                <i class="ri-bar-chart-line"></i> Progress
            </a>
            <a href="{{ route('student.announcements') }}" class="nav-item">
                <i class="ri-megaphone-line"></i> Announcements
            </a>
            <a href="{{ route('student.notifications') }}" class="nav-item">
                <i class="ri-notification-line"></i> Notifications
            </a>
            <a href="{{ route('student.faculty.evaluation') }}" class="nav-item">
                <i class="ri-star-line"></i> Faculty Evaluation
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Account</div>
            <a href="{{ route('student.profile') }}" class="nav-item">
                <i class="ri-user-settings-line"></i> Profile
            </a>
        </div>
    </div>

    <div class="sidebar-footer">
        <a href="{{ route('student.profile') }}" class="profile-info" style="text-decoration: none;">
            <div class="avatar">
                <i class="ri-user-line"></i>
            </div>
            <div class="profile-details">
                <p>{{ Auth::user()->name }}</p>
                <span>Student</span>
            </div>
        </a>
        
        <!-- Logout with Confirmation -->
        <button onclick="openLogoutModal()" class="logout-btn">
            <i class="ri-logout-box-r-line"></i> Sign Out
        </button>
    </div>
</aside>

<!-- ========== MAIN CONTENT ========== -->
<div class="main-content" id="mainContent">
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="flex items-center gap-3">
            <button class="menu-toggle" id="menuToggle">
                <i class="ri-menu-line"></i>
            </button>
            <div>
                <h2 class="page-title text-lg md:text-xl">{{ $course->code }} - {{ $course->name }}</h2>
                <p class="text-sm text-gray-500">Course Information & Materials</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('student.profile') }}" class="flex items-center gap-2" style="text-decoration: none;">
                <div class="w-9 h-9 rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <span class="hidden md:inline text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</span>
            </a>
        </div>
    </div>

    <div class="p-4 md:p-6 max-w-7xl mx-auto">
        <!-- Course Header -->
        <div class="dashboard-card p-6 md:p-8 mb-6 bg-gradient-to-r from-slate-900 to-indigo-950 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,215,15,0.12),transparent_45%)]"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start gap-6">
                <div>
                    <span class="bg-indigo-600/30 text-indigo-300 border border-indigo-500/20 px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase">
                        {{ $course->code }}
                    </span>
                    <h1 class="text-2xl md:text-4xl font-extrabold tracking-tight mt-3 text-white" style="font-family: 'Fraunces', serif;">
                        {{ $course->name }}
                    </h1>
                    <p class="text-slate-300 mt-2 max-w-2xl text-sm md:text-base leading-relaxed">
                        {{ $course->description ?? 'No description available for this course.' }}
                    </p>
                    
                    <div class="mt-6 flex flex-wrap gap-4 text-xs md:text-sm text-slate-300">
                        <span class="flex items-center gap-1">
                            <i class="ri-user-follow-line text-yellow-400"></i> 
                            Instructor: <strong>{{ $course->faculty->name ?? 'Not assigned' }}</strong>
                        </span>
                        <span class="flex items-center gap-1">
                            <i class="ri-award-line text-yellow-400"></i> 
                            Credits: <strong>{{ $course->credits }} Units</strong>
                        </span>
                    </div>
                </div>

                <div class="flex-shrink-0 bg-white/10 backdrop-blur-md border border-white/15 p-4 rounded-2xl w-full md:w-auto text-center md:text-right">
                    @if($enrollment->grade)
                        <p class="text-xs text-indigo-200">Current Grade</p>
                        <p class="text-3xl font-extrabold text-yellow-400 mt-1">{{ $enrollment->grade }}%</p>
                        <span class="inline-block bg-yellow-400/20 text-yellow-300 border border-yellow-400/30 px-3 py-0.5 rounded-full text-xs font-bold mt-2">
                            Grade: {{ $enrollment->letter_grade }}
                        </span>
                    @else
                        <p class="text-xs text-indigo-200">Enrolled Status</p>
                        <p class="text-xl font-bold text-green-400 mt-1 flex items-center justify-center md:justify-end gap-1">
                            <span class="w-2.5 h-2.5 rounded-full bg-green-400 animate-pulse"></span>
                            Active
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Left Panel (Announcements & Materials) -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Announcements Section -->
                <div class="dashboard-card">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                        <h2 class="text-base font-bold text-gray-800 flex items-center gap-2">
                            <i class="ri-megaphone-line text-indigo-600 text-lg"></i>
                            Class Announcements
                        </h2>
                        <span class="text-xs bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-full font-semibold">
                            {{ $announcements ? $announcements->count() : 0 }} Posted
                        </span>
                    </div>
                    
                    <div class="p-6">
                        @if($announcements && $announcements->count() > 0)
                            <div class="space-y-4">
                                @foreach($announcements as $announcement)
                                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl transition hover:border-indigo-100">
                                        <div class="flex justify-between items-start gap-4">
                                            <div>
                                                <h3 class="font-bold text-slate-800 text-base">{{ $announcement->title }}</h3>
                                                <p class="text-slate-600 text-sm mt-1.5 leading-relaxed">{{ $announcement->content }}</p>
                                            </div>
                                            <span class="text-xs text-slate-400 bg-white border px-2.5 py-1 rounded-xl whitespace-nowrap">
                                                {{ $announcement->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <div class="mt-4 pt-3 border-t border-slate-100/85 flex items-center justify-between text-xs text-slate-500">
                                            <span class="flex items-center gap-1">
                                                <i class="ri-user-line text-indigo-600"></i> Posted by: <strong>{{ $announcement->faculty->name }}</strong>
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-10">
                                <i class="ri-megaphone-line text-5xl text-slate-300 block mb-3"></i>
                                <p class="text-slate-500 text-sm">No announcements have been posted for this course.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Course Materials -->
                <div class="dashboard-card">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                        <h2 class="text-base font-bold text-gray-800 flex items-center gap-2">
                            <i class="ri-folder-open-line text-indigo-600 text-lg"></i>
                            Course Handouts & Materials
                        </h2>
                    </div>

                    <div class="p-6">
                        @if($course->materials->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($course->materials as $material)
                                    <div class="p-4 border border-slate-200/90 rounded-2xl hover:border-indigo-200 transition bg-white shadow-sm flex flex-col justify-between">
                                        <div>
                                            <div class="w-10 h-10 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 mb-3">
                                                <i class="ri-file-text-line text-xl"></i>
                                            </div>
                                            <h3 class="font-bold text-slate-800 text-sm line-clamp-1">{{ $material->title }}</h3>
                                            @if($material->description)
                                                <p class="text-xs text-slate-500 mt-1 line-clamp-2">{{ $material->description }}</p>
                                            @endif
                                        </div>
                                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                                            <span class="text-[10px] text-slate-400">
                                                Uploaded: {{ $material->created_at->format('M d, Y') }}
                                            </span>
                                            @if($material->file_path)
                                                <a href="{{ asset('storage/' . $material->file_path) }}" 
                                                   class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs px-3.5 py-1.5 rounded-xl transition flex items-center gap-1 font-semibold" target="_blank">
                                                    <i class="ri-download-cloud-line"></i> Download
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-10">
                                <i class="ri-file-line text-5xl text-slate-300 block mb-3"></i>
                                <p class="text-slate-500 text-sm">No handouts or files have been uploaded yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Panel (Quizzes) -->
            <div class="lg:col-span-4">
                <div class="dashboard-card">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                        <h2 class="text-base font-bold text-gray-800 flex items-center gap-2">
                            <i class="ri-questionnaire-line text-indigo-600 text-lg"></i>
                            Quizzes & Assessments
                        </h2>
                    </div>

                    <div class="p-6">
                        @if($quizzes->count() > 0)
                            <div class="space-y-4">
                                @foreach($quizzes as $quiz)
                                    @php
                                        $now = now();
                                        $startDate = $quiz->start_date ? \Carbon\Carbon::parse($quiz->start_date) : null;
                                        $endDate = $quiz->end_date ? \Carbon\Carbon::parse($quiz->end_date) : null;
                                        $hasStarted = !$startDate || $now >= $startDate;
                                        $hasEnded = $endDate && $now > $endDate;
                                    @endphp
                                    
                                    <div class="p-4 border border-slate-200/90 rounded-2xl bg-slate-50/50 flex flex-col justify-between">
                                        <div>
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">
                                                    Duration: {{ $quiz->duration_minutes ?? 'No Limit' }} Min
                                                </span>
                                                
                                                @if($quiz->attempted > 0)
                                                    <span class="bg-emerald-100 text-emerald-800 border border-emerald-200 px-2 py-0.5 rounded-full text-[10px] font-bold">
                                                        Completed
                                                    </span>
                                                @elseif($hasEnded)
                                                    <span class="bg-rose-100 text-rose-800 border border-rose-200 px-2 py-0.5 rounded-full text-[10px] font-bold">
                                                        Expired
                                                    </span>
                                                @elseif(!$hasStarted)
                                                    <span class="bg-amber-100 text-amber-800 border border-amber-200 px-2 py-0.5 rounded-full text-[10px] font-bold">
                                                        Upcoming
                                                    </span>
                                                @else
                                                    <span class="bg-indigo-100 text-indigo-800 border border-indigo-200 px-2 py-0.5 rounded-full text-[10px] font-bold">
                                                        Available
                                                    </span>
                                                @endif
                                            </div>
                                            
                                            <h3 class="font-bold text-slate-800 text-sm">{{ $quiz->title }}</h3>
                                            <p class="text-xs text-slate-500 mt-1 line-clamp-2">
                                                {{ $quiz->description ?? 'Please read all instructions before starting.' }}
                                            </p>
                                        </div>

                                        <div class="mt-4 pt-3 border-t border-slate-100 flex flex-col gap-2">
                                            @if($quiz->end_date)
                                                <div class="flex items-center gap-1 text-[10px] text-rose-600 font-semibold mb-1">
                                                    <i class="ri-calendar-close-line"></i>
                                                    Deadline: {{ \Carbon\Carbon::parse($quiz->end_date)->format('M d, Y H:i') }}
                                                </div>
                                            @endif

                                            @if($quiz->attempted > 0)
                                                <div class="bg-emerald-50 text-emerald-700 text-xs text-center py-2 rounded-xl border border-emerald-100 font-semibold">
                                                    <i class="ri-checkbox-circle-line"></i> Attempt Submitted
                                                </div>
                                            @elseif($hasEnded)
                                                <div class="bg-slate-100 text-slate-500 text-xs text-center py-2 rounded-xl border border-slate-200 font-semibold cursor-not-allowed">
                                                    Quiz Closed
                                                </div>
                                            @elseif(!$hasStarted)
                                                <div class="bg-amber-50 text-amber-700 text-xs text-center py-2 rounded-xl border border-amber-100 font-semibold">
                                                    Starts: {{ \Carbon\Carbon::parse($quiz->start_date)->format('M d, Y H:i') }}
                                                </div>
                                            @else
                                                <a href="{{ route('student.quiz.take', $quiz->id) }}" 
                                                   class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold py-2 rounded-xl transition text-center shadow-md shadow-indigo-100 flex items-center justify-center gap-1">
                                                    <i class="ri-play-fill text-sm"></i> Start Attempt
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-10">
                                <i class="ri-questionnaire-line text-5xl text-slate-300 block mb-3"></i>
                                <p class="text-slate-500 text-sm">No quizzes assigned to this course.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ======================= LOGOUT CONFIRMATION MODAL ======================= -->
<div id="logoutModal" class="modal-overlay">
    <div class="confirmation-modal">
        <div class="modal-header">
            <h3>
                <i class="ri-logout-box-r-line"></i> 
                Confirm Sign Out
            </h3>
            <button class="modal-close" onclick="closeLogoutModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to sign out of your account?</p>
            <p class="text-xs text-gray-500 mt-2">You will be redirected to the login page.</p>
        </div>
        <div class="modal-footer">
            <button class="modal-btn modal-btn-cancel" onclick="closeLogoutModal()">Cancel</button>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="modal-btn modal-btn-confirm">Yes, Sign Out</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Mobile Sidebar Toggle
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    
    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('mobile-open');
        });
    }

    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 1024 && sidebar.classList.contains('mobile-open')) {
            if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                sidebar.classList.remove('mobile-open');
            }
        }
    });

    // Logout Modal Functions
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    // Close modal when clicking outside
    document.getElementById('logoutModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLogoutModal();
        }
    });

    // ESC key support
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLogoutModal();
        }
    });
</script>
</body>
</html>