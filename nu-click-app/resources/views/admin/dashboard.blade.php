<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Admin Dashboard - NU Clicks LMS</title>
    <!-- Google Fonts + Remix Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
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
        .logout-btn {
            width: 100%;
            background: rgba(255,215,15,0.15);
            border: none;
            padding: 0.6rem;
            border-radius: 40px;
            color: var(--gold);
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: var(--transition);
        }
        .logout-btn:hover {
            background: var(--gold);
            color: var(--blue-deep);
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

        /* Stats cards and dashboard components */
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
    </style>
</head>
<body>

<!-- ========== SIDEBAR (ADMIN VERSION - SAME LAYOUT) ========== -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <img src="/logo/NatU.png" alt="NU Logo" class="sidebar-logo-img">
        <div class="logo-text">
            <h1>NU <span>CLICKS</span> LMS</h1>
            <p>Admin Portal</p>
        </div>
    </div>

    <div style="flex:1; overflow-y: auto;">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="ri-dashboard-line"></i> Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="ri-user-line"></i> Users
            </a>
            <a href="{{ route('admin.courses') }}" class="nav-item {{ request()->routeIs('admin.courses*') ? 'active' : '' }}">
                <i class="ri-book-line"></i> Courses
            </a>
            <a href="{{ route('admin.quizzes') }}" class="nav-item {{ request()->routeIs('admin.quizzes*') ? 'active' : '' }}">
                <i class="ri-list-check"></i> Quizzes
            </a>
            <a href="{{ route('admin.analytics') }}" class="nav-item {{ request()->routeIs('admin.analytics*') ? 'active' : '' }}">
                <i class="ri-bar-chart-line"></i> Analytics
            </a>
            <a href="{{ route('admin.logs') }}" class="nav-item {{ request()->routeIs('admin.logs*') ? 'active' : '' }}">
                <i class="ri-history-line"></i> Activity Logs
            </a>
            <a href="{{ route('admin.settings') }}" class="nav-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                <i class="ri-settings-line"></i> Settings
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
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="ri-logout-box-line"></i> Logout
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
        <h2 class="page-title text-lg md:text-xl">Dashboard</h2>
        {{-- <div class="flex items-center gap-3">
            <span class="text-sm text-gray-600 hidden md:inline">Welcome, {{ Auth::user()->name }}</span>
        </div> --}}
    </div>




    <div class="p-4 md:p-6">
        <!-- Stats Cards Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total Students</p>
                        <p class="text-3xl font-bold" style="color: var(--blue-deep);">{{ number_format($totalStudents) }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="ri-user-line text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total Faculty</p>
                        <p class="text-3xl font-bold text-green-600">{{ number_format($totalFaculty) }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="ri-user-star-line text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total Courses</p>
                        <p class="text-3xl font-bold text-purple-600">{{ number_format($totalCourses) }}</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="ri-book-line text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total Quizzes</p>
                        <p class="text-3xl font-bold text-yellow-600">{{ number_format($totalQuizzes) }}</p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="ri-quiz-line text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Active Quizzes</p>
                        <p class="text-3xl font-bold text-orange-600">{{ number_format($activeQuizzes) }}</p>
                    </div>
                    <div class="bg-orange-100 p-3 rounded-full">
                        <i class="ri-play-circle-line text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Monthly Statistics Chart -->
            <div class="dashboard-card p-5">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="ri-bar-chart-grouped-line" style="color: var(--gold);"></i> Monthly Statistics
                </h3>
                <canvas id="monthlyChart" height="250"></canvas>
            </div>
            
            <!-- Quiz Performance + Courses per Faculty -->
            <div class="dashboard-card p-5">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="ri-questionnaire-line" style="color: var(--gold);"></i> Quiz Performance
                </h3>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="text-center bg-gray-50 rounded-xl p-3">
                        <p class="text-gray-500 text-sm">Total Attempts</p>
                        <p class="text-3xl font-bold text-blue-600">{{ number_format($totalAttempts) }}</p>
                    </div>
                    <div class="text-center bg-gray-50 rounded-xl p-3">
                        <p class="text-gray-500 text-sm">Average Score</p>
                        <p class="text-3xl font-bold text-green-600">{{ number_format($averageScore, 1) }}%</p>
                    </div>
                </div>
                <div class="mt-2">
                    <h4 class="font-semibold text-gray-700 mb-3">Courses per Faculty (Top 5)</h4>
                    <div class="space-y-3">
                        @foreach($coursesPerFaculty as $faculty)
                            @php
                                $maxCourses = $coursesPerFaculty->first()->courses_count ?? 1;
                                $percentage = $maxCourses > 0 ? ($faculty->courses_count / $maxCourses) * 100 : 0;
                            @endphp
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-700">{{ $faculty->name }}</span>
                                    <span class="text-gray-500">{{ $faculty->courses_count }} courses</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="rounded-full h-2" style="width: {{ $percentage }}%; background-color: var(--gold);"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Recent Enrollments -->
            <div class="dashboard-card">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="ri-user-add-line" style="color: var(--gold);"></i> Recent Enrollments
                    </h3>
                </div>
                <div class="p-5">
                    @if($recentEnrollments->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentEnrollments as $enrollment)
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $enrollment->student->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $enrollment->course->name }}</p>
                                    </div>
                                    <span class="text-xs text-gray-400">{{ $enrollment->created_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No recent enrollments.</p>
                    @endif
                </div>
            </div>
            
            <!-- Recent Quiz Attempts -->
            <div class="dashboard-card">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="ri-quiz-line" style="color: var(--gold);"></i> Recent Quiz Attempts
                    </h3>
                </div>
                <div class="p-5">
                    @if($recentAttempts->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentAttempts as $attempt)
                                @php
                                    $percentage = $attempt->quiz->total_points > 0 
                                        ? ($attempt->score / $attempt->quiz->total_points) * 100 
                                        : 0;
                                @endphp
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $attempt->student->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $attempt->quiz->title }} - {{ $attempt->quiz->course->name }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold {{ $percentage >= 60 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $attempt->score }}/{{ $attempt->quiz->total_points }}
                                        </p>
                                        <span class="text-xs text-gray-400">{{ $attempt->completed_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No quiz attempts yet.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Activity Logs -->
        <div class="dashboard-card">
            <div class="px-5 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <i class="ri-history-line" style="color: var(--gold);"></i> Recent Activity Logs
                </h3>
            </div>
            <div class="p-5">
                @if($recentActivities->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentActivities as $activity)
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl activity-item">
                                <div class="flex-shrink-0 mt-0.5">
                                    @switch($activity->action)
                                        @case('create')
                                            <i class="ri-add-line text-green-600 text-lg"></i>
                                            @break
                                        @case('update')
                                            <i class="ri-edit-line text-yellow-600 text-lg"></i>
                                            @break
                                        @case('delete')
                                            <i class="ri-delete-bin-line text-red-600 text-lg"></i>
                                            @break
                                        @default
                                            <i class="ri-information-line text-blue-600 text-lg"></i>
                                    @endswitch
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-700">{{ $activity->description }}</p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        {{ $activity->user ? $activity->user->name : 'System' }} • {{ $activity->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">No activity logs available.</p>
                @endif
            </div>
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
        if (href && currentUrl.includes(href) && href !== '/admin/dashboard') {
            item.classList.add('active');
        } else if (currentUrl === '/admin/dashboard' && href === '/admin/dashboard') {
            item.classList.add('active');
        }
    });

    // Monthly Statistics Chart
    const ctx = document.getElementById('monthlyChart').getContext('2d');
    const monthlyData = @json($monthlyStats);
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: monthlyData.map(item => item.month),
            datasets: [
                {
                    label: 'Students',
                    data: monthlyData.map(item => item.students),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: 'rgb(59, 130, 246)'
                },
                {
                    label: 'Courses',
                    data: monthlyData.map(item => item.courses),
                    borderColor: 'rgb(139, 92, 246)',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: 'rgb(139, 92, 246)'
                },
                {
                    label: 'Quizzes',
                    data: monthlyData.map(item => item.quizzes),
                    borderColor: 'rgb(234, 179, 8)',
                    backgroundColor: 'rgba(234, 179, 8, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: 'rgb(234, 179, 8)'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#E9EDF2' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
</script>
</body>
</html>