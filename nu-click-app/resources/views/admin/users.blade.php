<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>User Management - Admin Panel | NU Clicks LMS</title>
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

        /* Table and tab styling */
        .data-table {
            border-radius: 1rem;
            overflow: hidden;
        }
        .tab-button {
            transition: var(--transition);
        }
        .tab-button:hover:not(.active-tab) {
            color: var(--blue-deep);
        }
        .active-tab {
            border-bottom-color: var(--gold);
            color: var(--blue-deep);
            font-weight: 600;
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .btn-icon {
            transition: var(--transition);
        }
        .btn-icon:hover {
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

<!-- ========== SIDEBAR (ADMIN VERSION - UNIFIED) ========== -->
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
        <div>
            <h2 class="page-title text-lg md:text-xl">User Management</h2>
            <p class="text-sm text-gray-500 hidden md:block">Manage students and faculty accounts</p>
        </div>
        <a href="{{ route('admin.users.create') }}?role=student" id="createStudentBtn" class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold transition shadow-sm" style="background: var(--blue-deep); color: white;">
            <i class="ri-add-line text-base"></i> Create New Student
        </a>
        <a href="{{ route('admin.users.create') }}?role=faculty" id="createFacultyBtn" class="hidden items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold transition shadow-sm" style="background: var(--blue-deep); color: white;">
            <i class="ri-add-line text-base"></i> Create New Faculty
        </a>
    </div>

    <div class="p-4 md:p-6">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-xl mb-6 shadow-sm flex items-center gap-2">
                <i class="ri-checkbox-circle-line text-green-600"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-xl mb-6 shadow-sm flex items-center gap-2">
                <i class="ri-error-warning-line text-red-600"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Tabs -->
        <div class="border-b border-gray-200 mb-6">
            <nav class="flex space-x-6">
                <button onclick="showTab('students')" id="studentsTab" class="tab-button py-2.5 px-1 border-b-2 border-gold text-blue-deep font-semibold transition" style="border-bottom-color: var(--gold);">
                    <i class="ri-user-line mr-1"></i> Students
                </button>
                <button onclick="showTab('faculty')" id="facultyTab" class="tab-button py-2.5 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition">
                    <i class="ri-user-star-line mr-1"></i> Faculty
                </button>
            </nav>
        </div>

        <!-- Students Table -->
        <div id="studentsContent" class="tab-content">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Student ID</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Department</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Year Level</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Courses</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Quizzes</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($students as $student)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-600">{{ $student->student_id ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                                <i class="ri-user-line text-indigo-600 text-sm"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">{{ $student->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->departmentRel->name ?? $student->department ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->year_level ? $student->year_level . ' Year' : 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->enrollments_count ?? 0 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->quiz_attempts_count ?? 0 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button onclick="toggleStatus({{ $student->id }})" class="status-toggle-{{ $student->id }}">
                                            @if($student->status === 'active')
                                                <span class="status-badge bg-green-100 text-green-700">Active</span>
                                            @else
                                                <span class="status-badge bg-red-100 text-red-700">Inactive</span>
                                            @endif
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <a href="{{ route('admin.users.show', $student->id) }}" class="text-blue-600 hover:text-blue-800 btn-icon inline-block" title="View">
                                            <i class="ri-eye-line text-lg"></i>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $student->id) }}" class="text-yellow-600 hover:text-yellow-800 btn-icon inline-block" title="Edit">
                                            <i class="ri-edit-line text-lg"></i>
                                        </a>
                                        @if($student->id !== Auth::id())
                                            <form action="{{ route('admin.users.delete', $student->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 btn-icon" onclick="return confirm('Delete this user? This action cannot be undone.')" title="Delete">
                                                    <i class="ri-delete-bin-line text-lg"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $students->links() }}
                </div>
            </div>
        </div>

        <!-- Faculty Table -->
        <div id="facultyContent" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Department</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Courses</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($faculty as $facultyMember)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $facultyMember->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="h-8 w-8 bg-purple-100 rounded-full flex items-center justify-center">
                                                <i class="ri-user-star-line text-purple-600 text-sm"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">{{ $facultyMember->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $facultyMember->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $facultyMember->departmentRel->name ?? $facultyMember->department ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $facultyMember->courses_count ?? 0 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button onclick="toggleStatus({{ $facultyMember->id }})" class="status-toggle-{{ $facultyMember->id }}">
                                            @if($facultyMember->status === 'active')
                                                <span class="status-badge bg-green-100 text-green-700">Active</span>
                                            @else
                                                <span class="status-badge bg-red-100 text-red-700">Inactive</span>
                                            @endif
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <a href="{{ route('admin.users.show', $facultyMember->id) }}" class="text-blue-600 hover:text-blue-800 btn-icon inline-block" title="View">
                                            <i class="ri-eye-line text-lg"></i>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $facultyMember->id) }}" class="text-yellow-600 hover:text-yellow-800 btn-icon inline-block" title="Edit">
                                            <i class="ri-edit-line text-lg"></i>
                                        </a>
                                        @if($facultyMember->id !== Auth::id())
                                            <form action="{{ route('admin.users.delete', $facultyMember->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 btn-icon" onclick="return confirm('Delete this user? This action cannot be undone.')" title="Delete">
                                                    <i class="ri-delete-bin-line text-lg"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $faculty->links() }}
                </div>
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

    // Tab switching functionality
    function showTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        // Show selected tab content
        document.getElementById(tabName + 'Content').classList.remove('hidden');
        
        // Update tab button styles
        const studentsTab = document.getElementById('studentsTab');
        const facultyTab = document.getElementById('facultyTab');
        
        if (tabName === 'students') {
            studentsTab.classList.add('border-gold', 'text-blue-deep', 'font-semibold');
            studentsTab.classList.remove('border-transparent', 'text-gray-500');
            facultyTab.classList.remove('border-gold', 'text-blue-deep', 'font-semibold');
            facultyTab.classList.add('border-transparent', 'text-gray-500');
            document.getElementById('createStudentBtn').classList.remove('hidden');
            document.getElementById('createStudentBtn').classList.add('flex');
            document.getElementById('createFacultyBtn').classList.add('hidden');
            document.getElementById('createFacultyBtn').classList.remove('flex');
        } else {
            facultyTab.classList.add('border-gold', 'text-blue-deep', 'font-semibold');
            facultyTab.classList.remove('border-transparent', 'text-gray-500');
            studentsTab.classList.remove('border-gold', 'text-blue-deep', 'font-semibold');
            studentsTab.classList.add('border-transparent', 'text-gray-500');
            document.getElementById('createFacultyBtn').classList.remove('hidden');
            document.getElementById('createFacultyBtn').classList.add('flex');
            document.getElementById('createStudentBtn').classList.add('hidden');
            document.getElementById('createStudentBtn').classList.remove('flex');
        }
    }


    // Toggle user status via AJAX (same as original)
    function toggleStatus(userId) {
        fetch(`/admin/users/${userId}/toggle-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const statusSpan = document.querySelector(`.status-toggle-${userId}`);
                if (data.status === 'active') {
                    statusSpan.innerHTML = '<span class="status-badge bg-green-100 text-green-700">Active</span>';
                } else {
                    statusSpan.innerHTML = '<span class="status-badge bg-red-100 text-red-700">Inactive</span>';
                }
            } else {
                alert(data.message || 'Error toggling status');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error toggling status');
        });
    }

    // Initialize tab based on URL hash or default to students
    const hash = window.location.hash.substring(1);
    if (hash === 'faculty') {
        showTab('faculty');
    } else {
        showTab('students');
    }
</script>
</body>
</html>