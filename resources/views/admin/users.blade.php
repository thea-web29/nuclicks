<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>User Management - Admin Panel | NU Clicks LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { corePlugins: { preflight: false } }</script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

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

        /* ===== SIDEBAR ===== */
        .sidebar {
            background-color: var(--blue-deep);
            width: 280px;
            position: fixed;
            top: 0; left: 0;
            height: 100%;
            z-index: 40;
            transition: transform 0.3s ease;
            transform: translateX(0);
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08);
        }
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.mobile-open { transform: translateX(0); }
            .main-content { margin-left: 0 !important; }
        }
        .sidebar-logo {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 215, 15, 0.2);
            display: flex; align-items: center; gap: 0.75rem;
        }
        .sidebar-logo-img { height: 45px; width: auto; }
        .logo-text h1 { font-size: 1.3rem; font-weight: 800; color: white; letter-spacing: -0.3px; }
        .logo-text span { color: var(--gold); }
        .logo-text p { font-size: 0.7rem; color: rgba(255,255,255,0.7); }
        .nav-section { padding: 0 1rem; margin-top: 1.5rem; }
        .nav-section-title {
            font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px;
            color: rgba(255,215,15,0.6); margin-bottom: 0.75rem; font-weight: 600;
        }
        .nav-item {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.7rem 1rem; border-radius: 12px;
            color: rgba(255,255,255,0.85); transition: var(--transition);
            margin-bottom: 0.25rem; font-weight: 500; text-decoration: none;
        }
        .nav-item i { font-size: 1.2rem; width: 1.5rem; }
        .nav-item:hover { background: rgba(255,215,15,0.15); color: white; }
        .nav-item.active { background: var(--gold); color: var(--blue-deep); }
        .nav-item.active i { color: var(--blue-deep); }
        .sidebar-footer {
            margin-top: auto; padding: 1.2rem;
            border-top: 1px solid rgba(255,215,15,0.2);
        }
        .profile-info { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; }
        .avatar {
            width: 42px; height: 42px; background: rgba(255,215,15,0.2);
            border-radius: 50%; display: flex; align-items: center;
            justify-content: center; color: var(--gold); flex-shrink: 0;
        }
        .profile-details p { color: white; font-weight: 600; font-size: 0.85rem; }
        .profile-details span { color: rgba(255,255,255,0.6); font-size: 0.7rem; }
        .logout-btn {
            width: 100%; background: rgba(220, 38, 38, 0.15); border: none;
            padding: 0.6rem; border-radius: 40px; color: #fca5a5; font-weight: 600;
            display: flex; align-items: center; justify-content: center;
            gap: 0.5rem; cursor: pointer; transition: var(--transition);
        }
        .logout-btn:hover { background: var(--danger-red); color: white; box-shadow: 0 4px 10px rgba(220,38,38,0.3); }

        /* ===== MAIN ===== */
        .main-content { margin-left: 280px; transition: margin-left 0.3s ease; min-height: 100vh; }
        .top-bar {
            background: white; padding: 1rem 2rem;
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03); border-bottom: 1px solid var(--gray-border);
            position: sticky; top: 0; z-index: 20;
        }
        .menu-toggle { display: none; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--blue-deep); }
        .page-title { font-weight: 700; color: var(--blue-deep); }
        @media (max-width: 1024px) {
            .menu-toggle { display: block; }
            .main-content { margin-left: 0; }
        }

        /* ===== TABS ===== */
        .tab-button { transition: var(--transition); color: #6b7280; }
        .tab-button:hover:not(.active-tab) { color: var(--blue-deep); }
        .active-tab { background: var(--blue-deep) !important; color: white !important; }
        .active-tab i { color: white !important; }

        /* ===== TABLE ===== */
        .status-badge {
            display: inline-flex; align-items: center;
            padding: 0.25rem 0.75rem; border-radius: 9999px;
            font-size: 0.75rem; font-weight: 500;
        }
        .btn-icon { transition: var(--transition); }
        .btn-icon:hover { transform: translateY(-1px); }

        /* ===== ACTION BUTTONS FIX ===== */
        a.btn-icon {
            text-decoration: none;
        }
        button.btn-icon {
            outline: none;
            border: none;
            background: transparent;
            box-shadow: none;
            cursor: pointer;
        }
        button.btn-icon:focus {
            outline: none;
            box-shadow: none;
        }

        /* ===== SHARED MODAL BASE ===== */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(10, 31, 68, 0.75);
            backdrop-filter: blur(4px); z-index: 1000;
            display: flex; align-items: center; justify-content: center;
            visibility: hidden; opacity: 0; transition: all 0.2s ease;
        }
        .modal-overlay.active { visibility: visible; opacity: 1; }

        .confirmation-modal {
            background: white; max-width: 450px; width: 90%;
            border-radius: 1.5rem; box-shadow: 0 25px 40px rgba(0,0,0,0.2);
            overflow: hidden; transform: scale(0.95);
            transition: transform 0.2s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }
        .modal-overlay.active .confirmation-modal { transform: scale(1); }

        .modal-header {
            background: var(--blue-deep); padding: 1.25rem 1.5rem;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 2px solid var(--gold);
        }
        .modal-header h3 {
            font-size: 1.1rem; font-weight: 700; color: white;
            margin: 0; display: flex; align-items: center; gap: 0.5rem;
        }
        .modal-header h3 i { color: var(--gold); }
        .modal-close { background: none; border: none; color: rgba(255,255,255,0.7); font-size: 1.6rem; cursor: pointer; line-height: 1; }
        .modal-close:hover { color: var(--gold); }

        .modal-body { padding: 1.8rem 1.5rem; text-align: center; color: #374151; }
        .modal-body .delete-icon-wrap {
            width: 64px; height: 64px; border-radius: 50%;
            background: #fee2e2; display: flex; align-items: center;
            justify-content: center; margin: 0 auto 1rem;
        }
        .modal-body .delete-icon-wrap i { font-size: 1.8rem; color: var(--danger-red); }
        .modal-body h4 { font-size: 1rem; font-weight: 700; color: #1e293b; margin-bottom: 0.4rem; }
        .modal-body p { font-size: 0.875rem; color: #6b7280; }
        .modal-body .user-name-chip {
            display: inline-block; margin-top: 0.6rem;
            background: #f3f4f6; border: 1px solid #e5e7eb;
            border-radius: 0.5rem; padding: 0.3rem 0.75rem;
            font-size: 0.85rem; font-weight: 600; color: #1e293b;
        }

        .modal-footer {
            padding: 1rem 1.5rem 1.5rem; display: flex; gap: 0.75rem;
            justify-content: flex-end; background: #f9fafb;
            border-top: 1px solid var(--gray-border);
        }
        .modal-btn {
            padding: 0.6rem 1.25rem; border-radius: 40px;
            font-weight: 600; font-size: 0.85rem; cursor: pointer;
            transition: all 0.2s ease; border: none;
        }
        .modal-btn-cancel { background: #eef2ff; color: #1e293b; }
        .modal-btn-cancel:hover { background: #e2e8f0; }
        .modal-btn-danger { background: var(--danger-red); color: white; display: flex; align-items: center; gap: 0.4rem; }
        .modal-btn-danger:hover { background: var(--danger-dark); }
        .modal-btn-logout { background: var(--danger-red); color: white; }
        .modal-btn-logout:hover { background: var(--danger-dark); }
    </style>
</head>
<body>

<!-- ========== SIDEBAR ========== -->
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
            <a href="{{ route('admin.users.create') }}" class="nav-item {{ request()->routeIs('admin.users.create') ? 'active' : '' }}">
                <i class="ri-user-add-line"></i> Account Creation
            </a>
            <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
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
            <div class="avatar"><i class="ri-user-line"></i></div>
            <div class="profile-details">
                <p>{{ Auth::user()->name }}</p>
                <span>{{ Auth::user()->email }}</span>
            </div>
        </div>
        <button onclick="openLogoutModal()" class="logout-btn">
            <i class="ri-logout-box-line"></i> Logout
        </button>
    </div>
</aside>

<!-- ========== MAIN CONTENT ========== -->
<div class="main-content" id="mainContent">
    <div class="top-bar">
        <button class="menu-toggle" id="menuToggle"><i class="ri-menu-line"></i></button>
        <div>
            <h2 class="page-title text-lg md:text-xl">User Management</h2>
            <p class="text-sm text-gray-500 hidden md:block">Manage students and faculty accounts</p>
        </div>
        <a href="{{ route('admin.users.create') }}"
           class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold transition shadow-sm"
           style="background: var(--blue-deep); color: white; text-decoration: none;">
            <i class="ri-add-line text-base"></i> Create New User
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
        <div class="mb-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-2 inline-flex gap-2">
                <button onclick="showTab('students')" id="studentsTab"
                        class="tab-button flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200">
                    <i class="ri-user-line text-base"></i> Students
                </button>
                <button onclick="showTab('faculty')" id="facultyTab"
                        class="tab-button flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200">
                    <i class="ri-user-star-line text-base"></i> Faculty
                </button>
            </div>
        </div>

        <!-- ── STUDENTS TABLE ── -->
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->department ?? 'N/A' }}</td>
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center gap-1">
                                            <a href="{{ route('admin.users.show', $student->id) }}"
                                               class="p-1.5 rounded-lg text-blue-500 hover:text-blue-700 hover:bg-blue-50 btn-icon transition"
                                               title="View">
                                                <i class="ri-eye-line text-base"></i>
                                            </a>
                                            <a href="{{ route('admin.users.edit', $student->id) }}"
                                               class="p-1.5 rounded-lg text-amber-500 hover:text-amber-700 hover:bg-amber-50 btn-icon transition"
                                               title="Edit">
                                                <i class="ri-edit-line text-base"></i>
                                            </a>
                                            @if($student->id !== Auth::id())
                                                <button type="button"
                                                        onclick="openDeleteModal({{ $student->id }}, '{{ addslashes($student->name) }}', '{{ route('admin.users.delete', $student->id) }}')"
                                                        class="p-1.5 rounded-lg text-red-400 hover:text-red-600 hover:bg-red-50 btn-icon transition"
                                                        title="Delete">
                                                    <i class="ri-delete-bin-line text-base"></i>
                                                </button>
                                            @endif
                                        </div>
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

        <!-- ── FACULTY TABLE ── -->
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $facultyMember->department ?? 'N/A' }}</td>
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center gap-1">
                                            <a href="{{ route('admin.users.show', $facultyMember->id) }}"
                                               class="p-1.5 rounded-lg text-blue-500 hover:text-blue-700 hover:bg-blue-50 btn-icon transition"
                                               title="View">
                                                <i class="ri-eye-line text-base"></i>
                                            </a>
                                            <a href="{{ route('admin.users.edit', $facultyMember->id) }}"
                                               class="p-1.5 rounded-lg text-amber-500 hover:text-amber-700 hover:bg-amber-50 btn-icon transition"
                                               title="Edit">
                                                <i class="ri-edit-line text-base"></i>
                                            </a>
                                            @if($facultyMember->id !== Auth::id())
                                                <button type="button"
                                                        onclick="openDeleteModal({{ $facultyMember->id }}, '{{ addslashes($facultyMember->name) }}', '{{ route('admin.users.delete', $facultyMember->id) }}')"
                                                        class="p-1.5 rounded-lg text-red-400 hover:text-red-600 hover:bg-red-50 btn-icon transition"
                                                        title="Delete">
                                                    <i class="ri-delete-bin-line text-base"></i>
                                                </button>
                                            @endif
                                        </div>
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

<!-- ===== DELETE CONFIRMATION MODAL ===== -->
<div id="deleteModal" class="modal-overlay">
    <div class="confirmation-modal">
        <div class="modal-header">
            <h3><i class="ri-delete-bin-line"></i> Delete User</h3>
            <button class="modal-close" onclick="closeDeleteModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="delete-icon-wrap">
                <i class="ri-user-unfollow-line"></i>
            </div>
            <h4>Are you sure?</h4>
            <p>You are about to permanently delete</p>
            <span class="user-name-chip" id="deleteUserName">—</span>
            <p class="mt-3" style="font-size:0.8rem; color:#ef4444;">
                <i class="ri-error-warning-line"></i>
                This action <strong>cannot be undone</strong>. All associated data will be removed.
            </p>
        </div>
        <div class="modal-footer">
            <button class="modal-btn modal-btn-cancel" onclick="closeDeleteModal()">
                Cancel
            </button>
            <form id="deleteForm" method="POST" style="margin:0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="modal-btn modal-btn-danger">
                    <i class="ri-delete-bin-line"></i> Yes, Delete
                </button>
            </form>
        </div>
    </div>
</div>

<!-- ===== LOGOUT MODAL ===== -->
<div id="logoutModal" class="modal-overlay">
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
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="modal-btn modal-btn-logout">Yes, Sign Out</button>
            </form>
        </div>
    </div>
</div>

<script>
    // ── Mobile sidebar ──
    const menuToggle = document.getElementById('menuToggle');
    const sidebar    = document.getElementById('sidebar');
    if (menuToggle) {
        menuToggle.addEventListener('click', () => sidebar.classList.toggle('mobile-open'));
    }
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 1024 && sidebar.classList.contains('mobile-open')) {
            if (!sidebar.contains(e.target) && menuToggle && !menuToggle.contains(e.target)) {
                sidebar.classList.remove('mobile-open');
            }
        }
    });

    // ── Tabs ──
    function showTab(tabName) {
        document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
        document.getElementById(tabName + 'Content').classList.remove('hidden');

        ['students', 'faculty'].forEach(name => {
            const btn = document.getElementById(name + 'Tab');
            if (name === tabName) {
                btn.classList.add('active-tab');
            } else {
                btn.classList.remove('active-tab');
                btn.style.color = '';
            }
        });

        history.replaceState(null, '', '#' + tabName);
    }

    const hash = window.location.hash.substring(1);
    showTab(hash === 'faculty' ? 'faculty' : 'students');

    // ── Toggle status AJAX ──
    function toggleStatus(userId) {
        fetch(`/admin/users/${userId}/toggle-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                const btn = document.querySelector(`.status-toggle-${userId}`);
                btn.innerHTML = data.status === 'active'
                    ? '<span class="status-badge bg-green-100 text-green-700">Active</span>'
                    : '<span class="status-badge bg-red-100 text-red-700">Inactive</span>';
            } else {
                alert(data.message || 'Error toggling status');
            }
        })
        .catch(() => alert('Error toggling status'));
    }

    // ── Delete modal ──
    function openDeleteModal(userId, userName, actionUrl) {
        document.getElementById('deleteUserName').textContent = userName;
        document.getElementById('deleteForm').action = actionUrl;
        document.getElementById('deleteModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    document.getElementById('deleteModal').addEventListener('click', (e) => {
        if (e.target === document.getElementById('deleteModal')) closeDeleteModal();
    });

    // ── Logout modal ──
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    document.getElementById('logoutModal').addEventListener('click', (e) => {
        if (e.target === document.getElementById('logoutModal')) closeLogoutModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') { closeDeleteModal(); closeLogoutModal(); }
    });
</script>
</body>
</html>