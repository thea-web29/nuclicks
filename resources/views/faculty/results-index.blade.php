<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Select Course - Results & Analytics | NU Clicks LMS</title>
    <!-- Google Fonts + Remix Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
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
            font-family: 'Inter', sans-serif;
            background: #F5F7FB;
            overflow-x: hidden;
        }

        :root {
            --blue-deep: #0A1F44;
            --gold: #FFD70F;
            --gold-dark: #e5c20c;
            --gray-light: #F8FAFF;
            --gray-border: #E9EDF2;
            --card-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            --transition: all 0.25s ease;
            --danger-red: #dc2626;
            --danger-dark: #b91c1c;
        }

        /* Sidebar (identical to all previous pages) */
        .sidebar {
            background-color: var(--blue-deep);
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
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08);
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0 !important;
            }
        }

        .sidebar-logo {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 215, 15, 0.2);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .sidebar-logo-img {
            height: 45px;
            width: auto;
        }
        .logo-text h1 {
            font-size: 1.3rem;
            font-weight: 800;
            color: white;
            letter-spacing: -0.3px;
        }
        .logo-text span {
            color: var(--gold);
        }
        .logo-text p {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.7);
        }

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
            text-decoration: none;   /* REMOVE UNDERLINE */
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
            color: var(--blue-deep);
        }
        .nav-item.active i {
            color: var(--blue-deep);
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
        }
        .profile-details p {
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
        }
        .profile-details span {
            color: rgba(255,255,255,0.6);
            font-size: 0.7rem;
        }
        
        /* ===== RED LOGOUT BUTTON (SIDEBAR) ===== */
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
        .logout-btn i {
            font-size: 1.1rem;
        }

        /* Main content area */
        .main-content {
            margin-left: 280px;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
        }
        .top-bar {
            background: white;
            padding: 1rem 2rem;
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
        .page-title {
            font-weight: 700;
            color: var(--blue-deep);
        }
        @media (max-width: 1024px) {
            .menu-toggle {
                display: block;
            }
            .main-content {
                margin-left: 0;
            }
        }

        /* Course analytics card styling */
        .analytics-card {
            background: white;
            border-radius: 1.2rem;
            transition: var(--transition);
            border: 1px solid rgba(0,0,0,0.03);
            box-shadow: var(--card-shadow);
            cursor: pointer;
        }
        .analytics-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 28px rgba(0, 0, 0, 0.08);
        }
        .stat-badge {
            background: #F8FAFF;
            border-radius: 1rem;
            padding: 0.5rem;
            text-align: center;
        }
        .btn-analytics {
            background: var(--blue-deep);
            color: white;
            transition: var(--transition);
        }
        .btn-analytics:hover {
            background: #0e2a5c;
        }
        .btn-download {
            background: #4B5563;
            transition: var(--transition);
        }
        .btn-download:hover {
            background: #374151;
        }

        /* ===== LOGOUT CONFIRMATION MODAL STYLES (THEMED: gold/blue, red confirm) ===== */
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
            transition: color 0.2s;
            line-height: 1;
            padding: 0;
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
            font-family: 'Inter', sans-serif;
        }
        .logout-modal-btn-cancel {
            background: #eef2ff;
            color: #1e293b;
        }
        .logout-modal-btn-cancel:hover {
            background: #e2e8f0;
            transform: translateY(-1px);
        }
        .logout-modal-btn-confirm {
            background: var(--danger-red);
            color: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .logout-modal-btn-confirm:hover {
            background: var(--danger-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(220, 38, 38, 0.2);
        }
        @media (max-width: 500px) {
            .logout-modal-footer {
                flex-direction: column-reverse;
            }
            .logout-modal-btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

<!-- ========== SIDEBAR (UPDATED: RED LOGOUT BUTTON) ========== -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <img src="/logo/NatU.png" alt="NU Logo" class="sidebar-logo-img">
        <div class="logo-text">
            <h1>NU <span>CLICKS</span> LMS</h1>
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

    <div class="sidebar-footer">
        <div class="profile-info">
            <div class="avatar">
                <i class="ri-user-line"></i>
            </div>
            <div class="profile-details">
                <p>{{ Auth::user()->name }}</p>
                <span>{{ Auth::user()->email }}</span>
            </div>
        </div>
        <!-- Logout form with full account logout + modal trigger -->
        <form method="POST" action="{{ route('logout') }}" id="logoutForm">
            @csrf
            <button type="button" id="logoutButton" class="logout-btn">
                <i class="ri-logout-box-r-line"></i> Sign Out
            </button>
        </form>
    </div>
</aside>

<!-- ========== MAIN CONTENT ========== -->
<div class="main-content" id="mainContent">
    <div class="top-bar">
        <button class="menu-toggle" id="menuToggle">
            <i class="ri-menu-line"></i>
        </button>
        <div>
            <h2 class="page-title text-lg md:text-xl">Results & Analytics</h2>
            <p class="text-sm text-gray-500 hidden md:block">Select a course to view detailed performance analytics</p>
        </div>
        <div class="w-8"></div>
    </div>

    <div class="p-4 md:p-6">
        @if(isset($courses) && $courses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                    <div class="analytics-card overflow-hidden">
                        <!-- Top accent bar with gradient -->
                        <div class="h-1.5" style="background: linear-gradient(90deg, var(--gold), var(--blue-deep));"></div>
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="px-2 py-0.5 rounded-md text-[11px] font-bold bg-indigo-100 text-indigo-800">{{ $course->code }}</span>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-800 line-clamp-1">{{ $course->name }}</h3>
                                </div>
                                <i class="ri-bar-chart-2-line text-3xl text-gray-300"></i>
                            </div>
                            
                            <!-- Stats row -->
                            <div class="grid grid-cols-2 gap-3 mb-5">
                                <div class="stat-badge">
                                    <p class="text-xs text-gray-500">Enrolled Students</p>
                                    <p class="text-2xl font-bold" style="color: var(--blue-deep);">{{ $course->students_count ?? 0 }}</p>
                                </div>
                                <div class="stat-badge">
                                    <p class="text-xs text-gray-500">Total Quizzes</p>
                                    <p class="text-2xl font-bold text-indigo-600">{{ $course->quizzes_count ?? 0 }}</p>
                                </div>
                            </div>
                            
                            <!-- Action buttons -->
                            <div class="flex gap-2">
                                <a href="{{ route('faculty.results', $course->id) }}" 
                                   class="flex-1 text-center text-sm font-semibold py-2.5 rounded-xl btn-analytics shadow-sm transition flex items-center justify-center gap-1">
                                    <i class="ri-bar-chart-line"></i> View Analytics
                                </a>
                                <a href="{{ route('faculty.download.results', $course->id) }}" 
                                   class="btn-download text-white px-3 py-2.5 rounded-xl transition flex items-center justify-center">
                                    <i class="ri-download-line text-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty state (matches other pages) -->
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden text-center py-16 px-4 transition-all">
                <i class="ri-bar-chart-2-line text-6xl text-gray-300 mb-5 block"></i>
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">No Courses Found</h3>
                <p class="text-gray-500 max-w-sm mx-auto mb-7">You don't have any courses yet. Create a course to start tracking student performance and analytics.</p>
            </div>
        @endif
    </div>
</div>

<!-- ======================= LOGOUT CONFIRMATION MODAL (THEMED: red confirm button) ======================= -->
<div id="logoutModal" class="logout-modal-overlay">
    <div class="logout-confirmation-modal">
        <div class="logout-modal-header">
            <h3>
                <i class="ri-logout-box-r-line"></i> 
                Confirm Sign Out
            </h3>
            <button class="logout-modal-close" id="closeLogoutModalBtn">&times;</button>
        </div>
        <div class="logout-modal-body">
            <p>Are you sure you want to sign out of your faculty account?</p>
            <p class="text-xs text-gray-500 mt-2">You will be redirected to the login page and will need to sign in again.</p>
        </div>
        <div class="logout-modal-footer">
            <button class="logout-modal-btn logout-modal-btn-cancel" id="cancelLogoutBtn">Cancel</button>
            <button class="logout-modal-btn logout-modal-btn-confirm" id="confirmLogoutBtn">Yes, Sign Out</button>
        </div>
    </div>
</div>

<script>
    // Mobile sidebar toggle (identical to all pages)
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('mobile-open');
        });
    }
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const isMobile = window.innerWidth <= 1024;
        if (isMobile && sidebar.classList.contains('mobile-open')) {
            if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                sidebar.classList.remove('mobile-open');
            }
        }
    });

    // Active nav highlight based on current route
    const currentUrl = window.location.pathname;
    document.querySelectorAll('.nav-item').forEach(item => {
        const href = item.getAttribute('href');
        if (href && currentUrl.includes(href) && href !== '/faculty/dashboard') {
            item.classList.add('active');
        } else if (currentUrl === '/faculty/dashboard' && href === '/faculty/dashboard') {
            item.classList.add('active');
        }
    });
    // Force "Results & Analytics" active highlight
    if (currentUrl.includes('/faculty/results') || currentUrl.includes('/faculty/results/index')) {
        document.querySelectorAll('.nav-item').forEach(item => {
            if (item.getAttribute('href') === '{{ route("faculty.results.index") }}') {
                item.classList.add('active');
            }
        });
    }

    // ======================= LOGOUT CONFIRMATION MODAL LOGIC (FULL ACCOUNT LOGOUT) =======================
    const logoutButton = document.getElementById('logoutButton');
    const logoutModal = document.getElementById('logoutModal');
    const confirmLogoutBtn = document.getElementById('confirmLogoutBtn');
    const cancelLogoutBtn = document.getElementById('cancelLogoutBtn');
    const closeLogoutModalBtn = document.getElementById('closeLogoutModalBtn');
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
    if (cancelLogoutBtn) cancelLogoutBtn.addEventListener('click', closeLogoutModal);
    if (closeLogoutModalBtn) closeLogoutModalBtn.addEventListener('click', closeLogoutModal);
    logoutModal.addEventListener('click', (e) => {
        if (e.target === logoutModal) closeLogoutModal();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && logoutModal.classList.contains('active')) closeLogoutModal();
    });
</script>
</body>
</html> 