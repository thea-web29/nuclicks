<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Student Dashboard - NU Clicks LMS</title>
    
    <!-- Google Fonts + Remix Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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

        /* Sidebar - Same as before */
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
            font-size: 1.1rem;
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

        /* Red Logout Button (matching Faculty/Admin) */
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

        /* Main Content */
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

        .stat-card {
            background: white;
            border-radius: 1.2rem;
            padding: 1.2rem;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            border: 1px solid rgba(0,0,0,0.03);
        }
        .stat-card:hover {
            transform: translateY(-2px);
        }
        .dashboard-card {
            background: white;
            border-radius: 1.2rem;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(0,0,0,0.03);
            overflow: hidden;
        }
        .activity-item {
            transition: var(--transition);
        }
        .activity-item:hover {
            background: #F8FAFF;
        }

        /* Logout Confirmation Modal - Same as Faculty */
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
            background: var(--blue-deep);
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
            border-top: 1px solid var(--gray-border);
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
    </style>
</head>
<body>

<!-- ========== SIDEBAR (STUDENT VERSION) ========== -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <img src="/logo/NatU.png" alt="NU Logo" class="sidebar-logo-img">
        <div class="logo-text">
            <h1>NU <span>CLICKS</span> LMS</h1>
            <p>Student Portal</p>
        </div>
    </div>

    <div style="flex:1; overflow-y: auto;">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>
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
                    <span class="ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $unreadNotifications }}</span>
                @endif
            </a>
            <a href="{{ route('student.faculty.evaluation') }}" class="nav-item {{ request()->routeIs('student.faculty.evaluation') ? 'active' : '' }}">
                <i class="ri-star-line"></i> Faculty Evaluation
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Account</div>
            <a href="{{ route('student.profile') }}" class="nav-item">
                <i class="ri-user-line"></i> Profile
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
                <span>Student</span>
            </div>
        </div>
        
        <!-- Logout Button with Confirmation -->
        <button onclick="openLogoutModal()" class="logout-btn">
            <i class="ri-logout-box-r-line"></i> Sign Out
        </button>
    </div>
</aside>

<!-- ========== MAIN CONTENT ========== -->
<div class="main-content" id="mainContent">
    <div class="top-bar">
        <button class="menu-toggle" id="menuToggle">
            <i class="ri-menu-line"></i>
        </button>
        <h2 class="page-title text-lg md:text-xl">Dashboard</h2>
    </div>

    <div class="p-4 md:p-6">
        <!-- Stats Cards Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Enrolled Courses</p>
                        <p class="text-3xl font-bold" style="color: var(--blue-deep);">{{ $enrolledCourses->count() }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="ri-book-line text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Completed Quizzes</p>
                        <p class="text-3xl font-bold text-green-600">{{ $completedQuizzes }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="ri-checkbox-circle-line text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Average Score</p>
                        <p class="text-3xl font-bold text-purple-600">{{ $averageScore }}%</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="ri-bar-chart-line text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Pending Quizzes</p>
                        <p class="text-3xl font-bold text-orange-600">{{ $pendingQuizzes }}</p>
                    </div>
                    <div class="bg-orange-100 p-3 rounded-full">
                        <i class="ri-time-line text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- My Enrolled Courses -->
            <div class="lg:col-span-2 dashboard-card">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="ri-book-line" style="color: var(--gold);"></i> My Enrolled Courses
                    </h3>
                </div>
                <div class="p-6">
                    @if($enrolledCourses->count() > 0)
                        <div class="space-y-6">
                            @foreach($enrolledCourses as $enrollment)
                                <div class="border border-gray-100 rounded-2xl p-5 hover:shadow-md transition">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-3">
                                                <span class="bg-indigo-100 text-indigo-700 text-xs font-medium px-3 py-1 rounded-xl">
                                                    {{ $enrollment->course->code }}
                                                </span>
                                                <span class="text-xs text-gray-500">{{ $enrollment->course->credits ?? 'N/A' }} credits</span>
                                            </div>
                                            <h4 class="font-semibold text-lg text-gray-800">{{ $enrollment->course->name }}</h4>
                                            <p class="text-sm text-gray-600 mt-1 line-clamp-2">
                                                {{ Str::limit($enrollment->course->description ?? 'No description available', 120) }}
                                            </p>
                                        </div>
                                        <a href="{{ route('student.course.details', $enrollment->course->id) }}" 
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-2xl text-sm font-medium transition">
                                            View Course
                                        </a>
                                    </div>

                                    <div class="mt-5">
                                        <div class="flex justify-between text-sm mb-1.5 text-gray-600">
                                            <span>Progress</span>
                                            <span class="font-medium">{{ $enrollment->progress ?? 0 }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-green-500 rounded-full h-2.5 transition-all" 
                                                 style="width: {{ $enrollment->progress ?? 0 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16">
                            <i class="ri-book-line text-7xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">You haven't enrolled in any courses yet.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Upcoming Quizzes -->
            <div class="dashboard-card">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="ri-quiz-line" style="color: var(--gold);"></i> Upcoming Quizzes
                    </h3>
                </div>
                <div class="p-6">
                    @if($upcomingQuizzes->count() > 0)
                        <div class="space-y-4">
                            @foreach($upcomingQuizzes as $quiz)
                                <div class="border border-gray-100 rounded-2xl p-5">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="bg-amber-100 text-amber-700 text-xs px-3 py-1 rounded-xl font-medium">Upcoming</span>
                                        <span class="text-xs text-gray-500">{{ $quiz->questions->count() }} questions</span>
                                    </div>
                                    <h4 class="font-semibold">{{ $quiz->title }}</h4>
                                    <p class="text-sm text-gray-600">{{ $quiz->course->name }}</p>
                                    
                                    <div class="mt-4 space-y-2 text-sm text-gray-600">
                                        @if($quiz->start_date)
                                        <div class="flex items-center gap-2">
                                            <i class="ri-calendar-line"></i>
                                            <span>{{ \Carbon\Carbon::parse($quiz->start_date)->format('M d, Y h:i A') }}</span>
                                        </div>
                                        @endif
                                        <div class="flex items-center gap-2">
                                            <i class="ri-time-line"></i>
                                            <span>{{ $quiz->duration_minutes ?? 'N/A' }} minutes</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <i class="ri-star-line"></i>
                                            <span>{{ $quiz->total_points }} points</span>
                                        </div>
                                    </div>

                                    <a href="{{ route('student.quiz.take', $quiz->id) }}" 
                                       class="block mt-5 text-center bg-green-600 hover:bg-green-700 text-white py-3 rounded-2xl font-medium transition">
                                        Take Quiz
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="ri-quiz-line text-6xl text-gray-300 mb-4 block"></i>
                            <p class="text-gray-500">No upcoming quizzes at the moment.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Notifications (Messages from Faculty) -->
        <div class="mt-8 dashboard-card">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <i class="ri-notification-3-line" style="color: var(--gold);"></i> Recent Notifications
                </h3>
            </div>
            <div class="p-6">
                @if($recentNotifications->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentNotifications as $notification)
                            <div class="flex items-start gap-4 p-3 rounded-xl hover:bg-gray-50 transition border border-transparent hover:border-gray-100">
                                <div class="bg-blue-100 p-2 rounded-lg">
                                    @if($notification->type === 'message')
                                        <i class="ri-mail-line text-blue-600"></i>
                                    @elseif($notification->type === 'quiz')
                                        <i class="ri-file-list-3-line text-blue-600"></i>
                                    @else
                                        <i class="ri-notification-line text-blue-600"></i>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <h4 class="text-sm font-semibold text-gray-800">{{ $notification->title }}</h4>
                                        <span class="text-[10px] text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $notification->message }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 text-center">
                        <a href="{{ route('student.notifications') }}" class="text-xs font-semibold text-blue-600 hover:underline">View All Notifications</a>
                    </div>
                @else
                    <div class="text-center py-6">
                        <p class="text-gray-500 text-sm">No recent notifications.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Announcements -->
        <div class="mt-8 dashboard-card">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <i class="ri-megaphone-line" style="color: var(--gold);"></i> Recent Announcements
                </h3>
            </div>
            <div class="p-6">
                @if($announcements->count() > 0)
                    <div class="space-y-5">
                        @foreach($announcements as $announcement)
                            <div class="border-l-4 border-gold pl-5 py-1">
                                <div class="flex justify-between">
                                    <h4 class="font-semibold text-gray-800">{{ $announcement->title }}</h4>
                                    <span class="text-xs text-gray-400">{{ $announcement->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">{{ $announcement->content }}</p>
                                <p class="text-xs text-gray-500 mt-2">Course: {{ $announcement->course->name }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">No recent announcements.</p>
                @endif
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