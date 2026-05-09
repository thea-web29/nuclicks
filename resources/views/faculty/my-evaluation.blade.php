<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>My Evaluation - Faculty Portal | NU Horizon</title>

    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,700;9..144,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: { preflight: false },
        }
    </script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #F5F7FB;
            color: #1f2937;
            overflow-x: hidden;
        }

        :root {
            --navy: #0A1F44;
            --gold: #FFD70F;
            --gold-dark: #e5c20c;
            --bdr: #E9EDF2;
            --muted: #6B7280;
            --shadow: 0 8px 20px rgba(0,0,0,0.05);
            --transition: all 0.25s ease;
            --danger-red: #dc2626;
            --danger-dark: #b91c1c;
        }

        .sidebar {
            background-color: var(--navy);
            width: 280px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            z-index: 40;
            transition: transform 0.3s ease;
            transform: translateX(0);
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 20px rgba(0,0,0,0.08);
        }

        .sidebar-logo {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,215,15,0.2);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-logo-img { height: 45px; width: auto; }
        .logo-text h1 {
            font-family: 'Fraunces', serif;
            font-size: 1.35rem;
            font-weight: 800;
            color: white;
            letter-spacing: -0.3px;
            margin: 0;
        }
        .logo-text span { color: var(--gold); }
        .logo-text p { font-size: 0.7rem; color: rgba(255,255,255,0.7); margin: 0; }

        .nav-section { padding: 0 1rem; margin-top: 1.5rem; }
        .nav-section-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,215,15,0.6);
            margin-bottom: 0.75rem;
            font-weight: 700;
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
            font-weight: 600;
            text-decoration: none;
        }
        .nav-item i { font-size: 1.2rem; width: 1.5rem; }
        .nav-item:hover { background: rgba(255,215,15,0.15); color: white; }
        .nav-item.active { background: var(--gold); color: var(--navy); }
        .nav-item.active i { color: var(--navy); }

        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

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
            font-weight: 800;
            color: var(--navy);
            margin: 0;
        }

        .header-profile { display: flex; align-items: center; gap: 1rem; }
        .header-avatar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.45rem 0.75rem;
            border-radius: 999px;
            background: #F8FAFF;
            border: 1px solid var(--bdr);
        }
        .header-avatar-img {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,215,15,0.25);
            color: var(--navy);
            overflow: hidden;
        }
        .header-avatar-img img { width: 34px; height: 34px; object-fit: cover; border-radius: 50%; }
        .header-avatar-name { font-size: 0.85rem; font-weight: 800; color: #111827; }
        .header-avatar-role { font-size: 0.7rem; color: var(--muted); }

        .header-logout-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background: rgba(220,38,38,0.12);
            color: #dc2626;
            cursor: pointer;
            transition: var(--transition);
        }
        .header-logout-btn:hover { background: #dc2626; color: white; }

        .stat-card {
            background: white;
            border-radius: 1.25rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(0,0,0,0.03);
            padding: 1.5rem;
        }
        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,215,15,0.18);
            color: var(--navy);
            font-size: 1.65rem;
        }
        .section-card {
            background: white;
            border-radius: 1.25rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(0,0,0,0.03);
            overflow: hidden;
        }
        .section-header {
            padding: 1.15rem 1.5rem;
            border-bottom: 1px solid var(--bdr);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        .section-header h3 {
            color: var(--navy);
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0;
        }
        .rating-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.65rem;
            border-radius: 999px;
            background: rgba(255,215,15,0.18);
            color: var(--navy);
            font-weight: 800;
            font-size: 0.78rem;
        }
        .progress-bar {
            height: 8px;
            border-radius: 999px;
            background: #E5E7EB;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            border-radius: 999px;
            background: var(--navy);
        }
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #9CA3AF;
        }

        .logout-modal-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(10,31,68,0.75);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            visibility: hidden;
            opacity: 0;
            transition: all 0.2s ease;
        }
        .logout-modal-overlay.active { visibility: visible; opacity: 1; }
        .confirmation-modal {
            background: white;
            max-width: 450px;
            width: 90%;
            border-radius: 1.5rem;
            box-shadow: 0 25px 40px rgba(0,0,0,0.2);
            overflow: hidden;
            transform: scale(0.95);
            transition: transform 0.2s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }
        .logout-modal-overlay.active .confirmation-modal { transform: scale(1); }
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
            font-weight: 800;
            color: white;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'Fraunces', serif;
        }
        .modal-header h3 i { color: var(--gold); }
        .modal-close { background: none; border: none; color: rgba(255,255,255,0.7); font-size: 1.6rem; cursor: pointer; }
        .modal-close:hover { color: var(--gold); }
        .modal-body { padding: 1.8rem 1.5rem; text-align: center; }
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
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .modal-btn-cancel { background: #eef2ff; color: #1e293b; }
        .modal-btn-confirm { background: var(--danger-red); color: white; }
        .modal-btn-confirm:hover { background: var(--danger-dark); }

        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.mobile-open { transform: translateX(0); }
            .main-content { margin-left: 0 !important; }
            .menu-toggle { display: block; }
        }

        @media (max-width: 640px) {
            .top-bar { padding: 1rem; }
            .header-avatar-info { display: none; }
        }
    </style>
</head>
<body>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <img src="/logo/NatU.png" alt="NU Logo" class="sidebar-logo-img" onerror="this.src='https://placehold.co/45x45/0A1F44/FFD70F?text=NU'">
        <div class="logo-text">
            <h1>NU <span>HORIZON</span></h1>
            <p>Faculty Portal</p>
        </div>
    </div>

    <div style="flex:1; overflow-y: auto;">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>
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

        <div class="nav-section">
            <div class="nav-section-title">Quiz Management</div>
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

        <div class="nav-section">
            <div class="nav-section-title">Analytics</div>
            <a href="{{ route('faculty.results.index') }}" class="nav-item {{ request()->routeIs('faculty.results*') ? 'active' : '' }}">
                <i class="ri-bar-chart-line"></i> Results & Analytics
            </a>
            <a href="{{ route('faculty.my-evaluation') }}" class="nav-item {{ request()->routeIs('faculty.my-evaluation*') ? 'active' : '' }}">
                <i class="ri-star-smile-line"></i> My Evaluation
            </a>
            
        </div>
    </div>
</aside>

<div class="main-content" id="mainContent">
    <div class="top-bar">
        <div class="flex items-center gap-3">
            <button class="menu-toggle" id="menuToggle"><i class="ri-menu-line"></i></button>
            <div>
                <h2 class="page-title text-lg md:text-xl">My Evaluation</h2>
                <p class="text-sm text-gray-500 hidden md:block">Student feedback and faculty performance overview</p>
            </div>
        </div>

        <div class="header-profile">
            <div class="header-avatar" onclick="window.location.href='{{ route('faculty.profile') }}'" style="cursor:pointer;">
                <div class="header-avatar-img">
                    @if(Auth::user()->avatar ?? false)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile">
                    @else
                        <i class="ri-user-line"></i>
                    @endif
                </div>
                <div class="header-avatar-info">
                    <div class="header-avatar-name">{{ Auth::user()->name ?? 'Faculty' }}</div>
                    <div class="header-avatar-role">Faculty</div>
                </div>
            </div>
            <button class="header-logout-btn" id="logoutButtonHeader" title="Sign Out">
                <i class="ri-logout-box-r-line"></i>
            </button>
        </div>
    </div>

    <div class="p-4 md:p-6">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-xl mb-6 shadow-sm flex items-center gap-2">
                <i class="ri-checkbox-circle-line text-green-600"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-5 mb-6">
            <div class="stat-card xl:col-span-1">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-gray-500 font-semibold">Total Evaluations</p>
                        <p class="text-3xl font-extrabold text-gray-800">{{ $totalEvaluations ?? 0 }}</p>
                    </div>
                    <div class="stat-icon"><i class="ri-chat-check-line"></i></div>
                </div>
            </div>

            <div class="stat-card xl:col-span-1">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-gray-500 font-semibold">Average Rating</p>
                        <p class="text-3xl font-extrabold text-gray-800">{{ number_format($averageRating ?? 0, 2) }}/5</p>
                    </div>
                    <div class="stat-icon"><i class="ri-star-smile-line"></i></div>
                </div>
            </div>

            <div class="stat-card xl:col-span-1">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-gray-500 font-semibold">Teaching</p>
                        <p class="text-3xl font-extrabold text-gray-800">{{ number_format($averageTeachingQuality ?? 0, 2) }}</p>
                    </div>
                    <div class="stat-icon"><i class="ri-presentation-line"></i></div>
                </div>
            </div>

            <div class="stat-card xl:col-span-1">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-gray-500 font-semibold">Communication</p>
                        <p class="text-3xl font-extrabold text-gray-800">{{ number_format($averageCommunication ?? 0, 2) }}</p>
                    </div>
                    <div class="stat-icon"><i class="ri-discuss-line"></i></div>
                </div>
            </div>

            <div class="stat-card xl:col-span-1">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-gray-500 font-semibold">Fairness</p>
                        <p class="text-3xl font-extrabold text-gray-800">{{ number_format($averageFairness ?? 0, 2) }}</p>
                    </div>
                    <div class="stat-icon"><i class="ri-scales-3-line"></i></div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <div class="section-card xl:col-span-1">
                <div class="section-header">
                    <h3><i class="ri-bar-chart-box-line" style="color:var(--gold)"></i> Rating Breakdown</h3>
                </div>
                <div class="p-5 space-y-4">
                    @php
                        $totalBreakdown = max(array_sum($ratingBreakdown ?? []), 1);
                    @endphp

                    @foreach([5, 4, 3, 2, 1] as $stars)
                        @php
                            $count = $ratingBreakdown[$stars] ?? 0;
                            $percentage = ($count / $totalBreakdown) * 100;
                        @endphp
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-1 text-sm font-bold text-gray-700">
                                    <span>{{ $stars }}</span>
                                    <i class="ri-star-fill" style="color:var(--gold)"></i>
                                </div>
                                <span class="text-xs text-gray-500">{{ $count }} response(s)</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ $percentage }}%;"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="section-card xl:col-span-2">
                <div class="section-header">
                    <h3><i class="ri-feedback-line" style="color:var(--gold)"></i> Student Feedback</h3>
                    <span class="text-xs text-gray-400">Latest submissions</span>
                </div>

                <div class="p-5">
                    @if(isset($evaluations) && $evaluations->count() > 0)
                        <div class="space-y-4">
                            @foreach($evaluations as $evaluation)
                                <div class="border border-gray-100 rounded-2xl p-4 hover:shadow-sm transition bg-white">
                                    <div class="flex flex-wrap items-start justify-between gap-3 mb-3">
                                        <div>
                                            <div class="flex items-center gap-2 flex-wrap">
                                                <h4 class="font-extrabold text-gray-800 m-0">{{ $evaluation->course->name ?? 'General Evaluation' }}</h4>
                                                <span class="rating-pill"><i class="ri-star-fill"></i>{{ number_format($evaluation->rating ?? 0, 1) }}/5</span>
                                            </div>
                                            <p class="text-xs text-gray-400 mt-1">
                                                @if($evaluation->is_anonymous ?? false)
                                                    Submitted anonymously
                                                @else
                                                    From: {{ $evaluation->student->name ?? 'Student' }}
                                                @endif
                                                · {{ $evaluation->created_at ? $evaluation->created_at->format('M d, Y h:i A') : 'N/A' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                                        <div class="bg-gray-50 rounded-xl p-3">
                                            <p class="text-xs text-gray-500">Teaching</p>
                                            <p class="font-extrabold text-gray-800">{{ number_format($evaluation->teaching_quality ?? 0, 1) }}</p>
                                        </div>
                                        <div class="bg-gray-50 rounded-xl p-3">
                                            <p class="text-xs text-gray-500">Communication</p>
                                            <p class="font-extrabold text-gray-800">{{ number_format($evaluation->communication ?? 0, 1) }}</p>
                                        </div>
                                        <div class="bg-gray-50 rounded-xl p-3">
                                            <p class="text-xs text-gray-500">Preparedness</p>
                                            <p class="font-extrabold text-gray-800">{{ number_format($evaluation->preparedness ?? 0, 1) }}</p>
                                        </div>
                                        <div class="bg-gray-50 rounded-xl p-3">
                                            <p class="text-xs text-gray-500">Fairness</p>
                                            <p class="font-extrabold text-gray-800">{{ number_format($evaluation->fairness ?? 0, 1) }}</p>
                                        </div>
                                    </div>

                                    <div class="bg-blue-50/60 border border-blue-100 rounded-xl p-4">
                                        <p class="text-sm text-gray-700 leading-relaxed">
                                            {{ $evaluation->comment ?? 'No written comment provided.' }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-5">
                            {{ $evaluations->links() }}
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="ri-chat-smile-3-line text-5xl text-gray-300 block mb-3"></i>
                            <p class="font-bold text-gray-500">No evaluations yet.</p>
                            <p class="text-sm text-gray-400">Student faculty evaluation results will appear here once submitted.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div id="logoutModal" class="logout-modal-overlay">
    <div class="confirmation-modal">
        <div class="modal-header">
            <h3><i class="ri-logout-box-r-line"></i> Confirm Sign Out</h3>
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
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');

    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('mobile-open');
        });
    }

    document.addEventListener('click', function(event) {
        const isMobile = window.innerWidth <= 1024;
        if (isMobile && sidebar && sidebar.classList.contains('mobile-open')) {
            if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                sidebar.classList.remove('mobile-open');
            }
        }
    });

    const logoutButtonHeader = document.getElementById('logoutButtonHeader');
    if (logoutButtonHeader) {
        logoutButtonHeader.addEventListener('click', openLogoutModal);
    }

    function openLogoutModal() {
        document.getElementById('logoutModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    const logoutModal = document.getElementById('logoutModal');
    if (logoutModal) {
        logoutModal.addEventListener('click', function(e) {
            if (e.target === this) closeLogoutModal();
        });
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLogoutModal();
    });
</script>

</body>
</html>
