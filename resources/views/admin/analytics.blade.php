<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Analytics & Reports - Admin Panel | NU Horizon</title>
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
            --danger-red: #dc2626;
            --danger-dark: #b91c1c;
        }

        /* Sidebar (unified with all admin pages) */
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

        /* Red Logout Button */
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

        /* Stats card and table styling */
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
        .analytics-card {
            background: white;
            border-radius: 1.2rem;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(0,0,0,0.03);
            overflow: hidden;
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
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

<!-- ========== SIDEBAR (ADMIN UNIFIED) ========== -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <img src="/logo/NatU.png" alt="NU Logo" class="sidebar-logo-img">
        <div class="logo-text">
            <h1>NU <span>Horizon</span></h1>
            <p>Admin Portal</p>
        </div>
    </div>

        <div style="flex:1; overflow-y: auto;">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="ri-dashboard-line"></i> Dashboard
            </a>
            <a href="{{ route('admin.users.create') }}" class="nav-item {{ request()->routeIs('admin.users.create') ? 'active' : '' }}">
                <i class="ri-user-add-line"></i> Account Creation
            </a>
            <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <i class="ri-team-line"></i> Users
            </a>
            <a href="{{ route('admin.faculty') }}" class="nav-item {{ request()->routeIs('admin.faculty*') ? 'active' : '' }}">
                <i class="ri-user-star-line"></i> Faculty
            </a>
        </div>
        <div class="nav-section">
            <div class="nav-section-title">Academic</div>
            <a href="{{ route('admin.programs') }}" class="nav-item {{ request()->routeIs('admin.programs*') ? 'active' : '' }}">
                <i class="ri-graduation-cap-line"></i> Programs
            </a>
            <a href="{{ route('admin.departments') }}" class="nav-item {{ request()->routeIs('admin.departments*') ? 'active' : '' }}">
                <i class="ri-building-2-line"></i> Departments
            </a>
            <a href="{{ route('admin.subjects') }}" class="nav-item {{ request()->routeIs('admin.subjects*') || request()->routeIs('admin.courses*') ? 'active' : '' }}">
                <i class="ri-book-open-line"></i> Subjects
            </a>
        </div>
        <div class="nav-section">
            <div class="nav-section-title">Assessment</div>
            <a href="{{ route('admin.faculty-evaluations') }}" class="nav-item {{ request()->routeIs('admin.faculty-evaluations*') ? 'active' : '' }}">
                <i class="ri-star-smile-line"></i> Faculty Evaluation
            </a>
            <a href="{{ route('admin.folder-files') }}" class="nav-item {{ request()->routeIs('admin.folder-files*') ? 'active' : '' }}">
                <i class="ri-folder-3-line"></i> Folder & Files
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
        <div class="profile-info" onclick="window.location='{{ route('admin.profile') }}'" style="cursor:pointer;">
            <div class="avatar">
                <i class="ri-user-line"></i>
            </div>
            <div class="profile-details">
                <p>{{ Auth::user()->name }}</p>
                <span>{{ Auth::user()->email }}</span>
            </div>
        </div>
        
        <!-- Logout with Confirmation -->
        <button onclick="openLogoutModal()" class="logout-btn">
            <i class="ri-logout-box-line"></i> Logout
        </button>
    </div>
</aside>

<!-- ========== MAIN CONTENT ========== -->
<div class="main-content" id="mainContent">
    <div class="top-bar">
    <button class="menu-toggle" id="menuToggle">
        <i class="ri-menu-line"></i>
    </button>

    <div>
        <h2 class="page-title text-lg md:text-xl">Analytics & Reports</h2>
        <p class="text-sm text-gray-500 hidden md:block">System performance insights and reports</p>
    </div>

    <div class="flex items-center gap-3">
        @include('admin.partials.notification-bell')

        <button onclick="showExportModal()" class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold transition shadow-sm" style="background: #10B981; color: white;">
            <i class="ri-download-line text-base"></i> Export Report
        </button>
    </div>
</div>

    <div class="p-4 md:p-6">
        <!-- System Overview Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
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
        </div>

        <!-- Performance Overview -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="analytics-card p-5">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="ri-bar-chart-line" style="color: var(--gold);"></i> Overall Performance
                </h3>
                <div class="text-center">
                    <div class="text-5xl font-bold" style="color: var(--blue-deep);">{{ $overallAverage }}%</div>
                    <p class="text-gray-500 mt-2">Average Score</p>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Total Attempts:</span>
                        <span class="font-semibold">{{ number_format($totalAttempts) }}</span>
                    </div>
                </div>
            </div>
            <div class="analytics-card p-5">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="ri-pie-chart-line" style="color: var(--gold);"></i> Pass/Fail Rate
                </h3>
                <div class="flex items-center justify-center gap-8">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-600">{{ $passRate }}%</div>
                        <p class="text-sm text-gray-500">Pass Rate</p>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                            <div class="bg-green-600 rounded-full h-2" style="width: {{ $passRate }}%"></div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-red-600">{{ $failRate }}%</div>
                        <p class="text-sm text-gray-500">Fail Rate</p>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                            <div class="bg-red-600 rounded-full h-2" style="width: {{ $failRate }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="analytics-card p-5">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="ri-line-chart-line" style="color: var(--gold);"></i> Monthly Trend
                </h3>
                <canvas id="trendChart" height="150"></canvas>
            </div>
        </div>

        <!-- Course Performance Table -->
        <div class="analytics-card mb-8">
            <div class="px-5 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <i class="ri-book-line" style="color: var(--gold);"></i> Course Performance
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Course</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Students</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Quizzes</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Attempts</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Avg Score</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($coursePerformance as $course)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $course['code'] }}</div>
                                        <div class="text-sm text-gray-500">{{ $course['name'] }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $course['students'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $course['quizzes'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($course['attempts']) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <span class="font-semibold">{{ $course['average_score'] }}%</span>
                                        <div class="w-20 bg-gray-200 rounded-full h-2">
                                            <div class="rounded-full h-2" style="width: {{ $course['average_score'] }}%; background-color: var(--gold);"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($course['average_score'] >= 70)
                                        <span class="status-badge bg-green-100 text-green-700">Excellent</span>
                                    @elseif($course['average_score'] >= 50)
                                        <span class="status-badge bg-yellow-100 text-yellow-700">Average</span>
                                    @else
                                        <span class="status-badge bg-red-100 text-red-700">Needs Improvement</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Faculty Performance Table -->
        <div class="analytics-card mb-8">
            <div class="px-5 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <i class="ri-user-star-line" style="color: var(--gold);"></i> Faculty Performance
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Faculty</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Courses</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Attempts</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Avg Score</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($facultyPerformance as $faculty)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $faculty['name'] }}</div>
                                        <div class="text-sm text-gray-500">{{ $faculty['email'] }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $faculty['courses'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($faculty['attempts']) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <span class="font-semibold">{{ $faculty['average_score'] }}%</span>
                                        <div class="w-20 bg-gray-200 rounded-full h-2">
                                            <div class="rounded-full h-2" style="width: {{ $faculty['average_score'] }}%; background-color: var(--gold);"></div>
                                        </div>
                                    </div>
                                </td>
                             </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top Students Table -->
        <div class="analytics-card">
            <div class="px-5 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <i class="ri-medal-line" style="color: var(--gold);"></i> Top Performing Students
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Student</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Attempts</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Avg Score</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($topStudents as $student)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                            <i class="ri-user-line text-indigo-600 text-sm"></i>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">{{ $student['name'] }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student['email'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student['attempts'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <span class="font-semibold text-green-600">{{ $student['average_score'] }}%</span>
                                        <div class="w-20 bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-600 rounded-full h-2" style="width: {{ $student['average_score'] }}%"></div>
                                        </div>
                                    </div>
                                </td>
                             </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Export Modal -->
<div id="exportModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4">
        <div class="p-6 border-b border-gray-100">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Export Report</h3>
                    <p class="text-gray-500 text-sm mt-1">Choose export options</p>
                </div>
                <button onclick="closeExportModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.export.results') }}" method="GET">
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Report Type</label>
                    <select name="type" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:border-gold transition bg-white">
                        <option value="courses">Course Performance</option>
                        <option value="faculty">Faculty Performance</option>
                        <option value="students">Student Performance</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Format</label>
                    <select name="format" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:border-gold transition bg-white">
                        <option value="csv">CSV</option>
                    </select>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeExportModal()" class="px-5 py-2.5 border border-gray-300 rounded-xl hover:bg-gray-50 transition">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl transition shadow-sm" style="background: var(--blue-deep); color: white;">Export</button>
                </div>
            </form>
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
    // Mobile sidebar toggle
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

    // Active nav highlight
    const currentUrl = window.location.pathname;
    document.querySelectorAll('.nav-item').forEach(item => {
        const href = item.getAttribute('href');
        if (href && currentUrl.includes(href) && href !== '/admin/dashboard') {
            item.classList.add('active');
        } else if (currentUrl === '/admin/dashboard' && href === '/admin/dashboard') {
            item.classList.add('active');
        }
    });

    // Export modal functions
    function showExportModal() {
        document.getElementById('exportModal').classList.remove('hidden');
        document.getElementById('exportModal').classList.add('flex');
    }
    
    function closeExportModal() {
        document.getElementById('exportModal').classList.add('hidden');
        document.getElementById('exportModal').classList.remove('flex');
    }

    // Logout Modal Functions
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    // Close logout modal when clicking outside
    document.getElementById('logoutModal').addEventListener('click', function(e) {
        if (e.target === this) closeLogoutModal();
    });

    // Monthly Trend Chart
    const ctx = document.getElementById('trendChart').getContext('2d');
    const monthlyData = @json($monthlyTrend);
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: monthlyData.map(item => item.month),
            datasets: [
                {
                    label: 'Average Score (%)',
                    data: monthlyData.map(item => item.average_score),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true,
                    yAxisID: 'y',
                    pointBackgroundColor: 'rgb(59, 130, 246)'
                },
                {
                    label: 'Attempts',
                    data: monthlyData.map(item => item.attempts),
                    borderColor: 'rgb(139, 92, 246)',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    tension: 0.4,
                    fill: true,
                    yAxisID: 'y1',
                    pointBackgroundColor: 'rgb(139, 92, 246)'
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
                    title: {
                        display: true,
                        text: 'Average Score (%)'
                    },
                    grid: { color: '#E9EDF2' }
                },
                y1: {
                    position: 'right',
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Attempts'
                    },
                    grid: {
                        drawOnChartArea: false
                    }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
    
    // Close export modal on outside click
    document.getElementById('exportModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeExportModal();
        }
    });
</script>
</body>
</html>