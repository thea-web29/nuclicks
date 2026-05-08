<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Student Management - Nu Clicks LMS</title>
    <!-- Google Fonts + Font Awesome + Remix Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: { preflight: false },
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        /* Sidebar styles */
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

        /* Main content */
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

        /* Additional student management styles */
        .stat-card {
            background: white;
            border-radius: 1.2rem;
            padding: 1.2rem;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            border: 1px solid rgba(0,0,0,0.03);
        }
        .badge-gold {
            background: rgba(255,215,15,0.2);
            color: #856404;
            padding: 0.25rem 0.7rem;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        .recent-item:hover {
            background: #F8FAFF;
        }
        .btn-gold {
            background-color: var(--gold);
            color: var(--blue-deep);
        }
        .btn-gold:hover {
            background-color: var(--gold-dark);
        }

        /* ===== MODAL STYLES (THEMED: gold/blue, only confirm button red) ===== */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(10, 31, 68, 0.75);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0.2s, opacity 0.2s ease;
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
            font-size: 1.4rem;
        }
        .modal-close {
            background: none;
            border: none;
            color: rgba(255,255,255,0.7);
            font-size: 1.6rem;
            cursor: pointer;
            transition: color 0.2s;
            line-height: 1;
            padding: 0;
        }
        .modal-close:hover {
            color: var(--gold);
        }
        .modal-body {
            padding: 1.8rem 1.5rem;
            background: white;
            text-align: center;
        }
        .modal-body p {
            font-size: 1rem;
            color: #1f2937;
            font-weight: 500;
            margin-bottom: 0;
        }
        .modal-footer {
            padding: 1rem 1.5rem 1.5rem 1.5rem;
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
            font-family: 'Inter', sans-serif;
        }
        .modal-btn-cancel {
            background: #eef2ff;
            color: #1e293b;
        }
        .modal-btn-cancel:hover {
            background: #e2e8f0;
            transform: translateY(-1px);
        }
        .modal-btn-confirm {
            background: var(--danger-red);
            color: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .modal-btn-confirm:hover {
            background: var(--danger-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(220, 38, 38, 0.2);
        }
        @media (max-width: 500px) {
            .modal-footer {
                flex-direction: column-reverse;
            }
            .modal-btn {
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
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Analytics</div>
            <a href="{{ route('faculty.results.index') }}" class="nav-item {{ request()->routeIs('faculty.results*') ? 'active' : '' }}">
                <i class="ri-bar-chart-line"></i> Results & Analytics
            </a>
            <a href="{{ route('faculty.grading') }}" class="nav-item {{ request()->routeIs('faculty.grading*') ? 'active' : '' }}">
                <i class="ri-graduation-cap-line"></i> Grading
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
                <i class="ri-logout-box-r-line"></i> Sign Out of Account
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
        <h2 class="page-title text-lg md:text-xl">Student Management</h2>
        <div class="w-8"></div>
    </div>

    <div class="p-4 md:p-6">
        <!-- Search and Filters -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6 border-l-4" style="border-left-color: var(--gold);">
            <div class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <div class="relative">
                        <i class="ri-search-line absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" 
                               id="searchInput"
                               placeholder="Search students by name, email, or ID..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-gold">
                    </div>
                </div>
                <div>
                    <select id="courseFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-gold bg-white">
                        <option value="">All Courses</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->code }} - {{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button onclick="filterStudents()" class="px-6 py-2 rounded-lg transition-all flex items-center gap-2" style="background: var(--blue-deep); color: white;">
                        <i class="ri-filter-line"></i> Search
                    </button>
                </div>
            </div>
        </div>

        <!-- Students List -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Courses Enrolled</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="studentsTableBody" class="bg-white divide-y divide-gray-200">
                        @forelse($students as $student)
                        <tr class="student-row hover:bg-gray-50 transition" data-student-id="{{ $student->id }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">
                                {{ $student->student_id ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="ri-user-line text-indigo-600 text-sm"></i>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">{{ $student->name }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $student->email }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                @php
                                    $studentCourses = $student->enrollments->pluck('course.code')->toArray();
                                @endphp
                                {{ implode(', ', $studentCourses) ?: 'No courses enrolled' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="viewStudent({{ $student->id }})" 
                                        class="text-indigo-600 hover:text-indigo-900 mr-3 transition flex items-center gap-1">
                                    <i class="ri-eye-line"></i> View
                                </button>
                                <button onclick="messageStudent({{ $student->id }})" 
                                        class="text-green-600 hover:text-green-900 transition flex items-center gap-1">
                                    <i class="ri-mail-send-line"></i> Message
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <i class="ri-user-line text-6xl text-gray-300 mb-4 block"></i>
                                No students found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Student Details Modal -->
<div id="studentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b flex justify-between items-center" style="border-bottom-color: rgba(255,215,15,0.3);">
            <div>
                <h3 class="text-xl font-semibold flex items-center gap-2">
                    <i class="ri-user-star-line" style="color: var(--gold);"></i> Student Details
                </h3>
                <p class="text-gray-600 text-sm" id="modalSubtitle">View student information</p>
            </div>
            <button onclick="closeStudentModal()" class="text-gray-400 hover:text-gray-600">
                <i class="ri-close-line text-2xl"></i>
            </button>
        </div>
        <div class="p-6" id="modalContent">
            <div class="text-center py-8">
                <div class="text-gray-400">Loading student details...</div>
            </div>
        </div>
    </div>
</div>

<!-- Message Modal -->
<div id="messageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="p-6 border-b" style="border-bottom-color: rgba(255,215,15,0.3);">
            <h3 class="text-xl font-semibold flex items-center gap-2">
                <i class="ri-mail-send-line" style="color: var(--gold);"></i> Send Message
            </h3>
            <p class="text-gray-600 text-sm">Send a message to the student</p>
        </div>
        <div class="p-6">
            <form id="messageForm">
                @csrf
                <input type="hidden" id="messageStudentId" name="student_id">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                    <input type="text" name="subject" required 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-gold">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                    <textarea name="message" rows="4" required 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-gold"></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeMessageModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-6 py-2 rounded-lg transition-all flex items-center gap-2" style="background: var(--blue-deep); color: white;">
                        <i class="ri-send-plane-line"></i> Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ======================= THEMED CONFIRMATION MODAL (Only confirm button is red) ======================= -->
<div id="logoutModal" class="modal-overlay">
    <div class="confirmation-modal">
        <div class="modal-header">
            <h3>
                <i class="ri-logout-box-r-line"></i> 
                Confirm Sign Out
            </h3>
            <button class="modal-close" id="closeModalBtn">&times;</button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to sign out of your account?</p>
            <p class="text-xs text-gray-500 mt-2">You will be redirected to the main page and will need to log in again.</p>
        </div>
        <div class="modal-footer">
            <button class="modal-btn modal-btn-cancel" id="cancelLogoutBtn">Cancel</button>
            <button class="modal-btn modal-btn-confirm" id="confirmLogoutBtn">Yes, Sign Out</button>
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
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const isMobile = window.innerWidth <= 1024;
        if (isMobile && sidebar.classList.contains('mobile-open')) {
            if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                sidebar.classList.remove('mobile-open');
            }
        }
    });

    // Active nav item highlight based on current URL
    const currentUrl = window.location.pathname;
    document.querySelectorAll('.nav-item').forEach(item => {
        const href = item.getAttribute('href');
        if (href && currentUrl.includes(href) && href !== '/faculty/dashboard') {
            item.classList.add('active');
        } else if (currentUrl === '/faculty/dashboard' && href === '/faculty/dashboard') {
            item.classList.add('active');
        }
    });

    // Student Management Functions
    function viewStudent(studentId) {
        const modal = document.getElementById('studentModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        fetch(`/faculty/students/${studentId}/details`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('modalSubtitle').innerHTML = `<i class="ri-user-line mr-1"></i> Student Information`;
                
                let coursesHtml = '';
                data.courses.forEach(course => {
                    coursesHtml += `
                        <div class="border rounded-lg p-3 mb-2 hover:shadow-sm transition">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h4 class="font-semibold">${escapeHtml(course.code)} - ${escapeHtml(course.name)}</h4>
                                    <p class="text-sm text-gray-600">Enrolled: ${course.enrolled_date}</p>
                                </div>
                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Active</span>
                            </div>
                        </div>
                    `;
                });
                
                let quizzesHtml = '';
                data.quizzes.forEach(quiz => {
                    const percentage = quiz.total_points > 0 ? (quiz.score / quiz.total_points) * 100 : 0;
                    quizzesHtml += `
                        <div class="border rounded-lg p-3 mb-2 hover:shadow-sm transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-semibold">${escapeHtml(quiz.title)}</h4>
                                    <p class="text-sm text-gray-600">Course: ${escapeHtml(quiz.course_code)}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold ${percentage >= 70 ? 'text-green-600' : (percentage >= 50 ? 'text-yellow-600' : 'text-red-600')}">
                                        ${quiz.score}/${quiz.total_points}
                                    </p>
                                    <p class="text-xs text-gray-500">${percentage.toFixed(1)}%</p>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="rounded-full h-2" style="width: ${percentage}%; background-color: var(--gold);"></div>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Completed: ${quiz.completed_date}</p>
                        </div>
                    `;
                });
                
                document.getElementById('modalContent').innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-1">
                            <div class="bg-gray-50 rounded-lg p-6 text-center" style="border: 1px solid rgba(255,215,15,0.2);">
                                <div class="h-24 w-24 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="ri-user-line text-4xl text-indigo-600"></i>
                                </div>
                                <h3 class="text-xl font-bold">${escapeHtml(data.student.name)}</h3>
                                <p class="text-gray-600">${escapeHtml(data.student.email)}</p>
                                <p class="text-sm text-gray-500 mt-2">Student ID: ${escapeHtml(data.student.student_id || 'N/A')}</p>
                                <div class="mt-4 pt-4 border-t" style="border-top-color: rgba(255,215,15,0.2);">
                                    <div class="flex justify-between text-sm mb-2">
                                        <span class="text-gray-600">Total Quizzes Taken:</span>
                                        <span class="font-semibold">${data.quizzes.length}</span>
                                    </div>
                                    <div class="flex justify-between text-sm mb-2">
                                        <span class="text-gray-600">Average Score:</span>
                                        <span class="font-semibold ${data.average_score >= 70 ? 'text-green-600' : 'text-red-600'}">${data.average_score.toFixed(1)}%</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Courses Enrolled:</span>
                                        <span class="font-semibold">${data.courses.length}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="mb-6">
                                <h4 class="font-semibold text-lg mb-3 flex items-center">
                                    <i class="ri-book-line mr-2" style="color: var(--gold);"></i> Enrolled Courses
                                </h4>
                                ${coursesHtml || '<p class="text-gray-500">No courses enrolled.</p>'}
                            </div>
                            <div>
                                <h4 class="font-semibold text-lg mb-3 flex items-center">
                                    <i class="ri-quiz-line mr-2" style="color: var(--gold);"></i> Quiz Attempts
                                </h4>
                                ${quizzesHtml || '<p class="text-gray-500">No quiz attempts yet.</p>'}
                            </div>
                        </div>
                    </div>
                `;
            } else {
                document.getElementById('modalContent').innerHTML = `<div class="text-center py-8 text-red-500">Error loading student details. Please try again.</div>`;
            }
        })
        .catch(error => {
            document.getElementById('modalContent').innerHTML = `<div class="text-center py-8 text-red-500">Error: ${error.message}</div>`;
        });
    }
    
    function closeStudentModal() {
        const modal = document.getElementById('studentModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.getElementById('modalContent').innerHTML = `<div class="text-center py-8 text-gray-400">Loading student details...</div>`;
    }
    
    function messageStudent(studentId) {
        document.getElementById('messageStudentId').value = studentId;
        document.getElementById('messageModal').classList.remove('hidden');
        document.getElementById('messageModal').classList.add('flex');
    }
    
    function closeMessageModal() {
        document.getElementById('messageModal').classList.add('hidden');
        document.getElementById('messageModal').classList.remove('flex');
        document.getElementById('messageForm').reset();
    }
    
    function filterStudents() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const courseFilter = document.getElementById('courseFilter').value;
        
        const rows = document.querySelectorAll('.student-row');
        rows.forEach(row => {
            const name = row.querySelector('td:nth-child(2) .text-gray-900')?.textContent.toLowerCase() || '';
            const email = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';
            const studentId = row.querySelector('td:nth-child(1)')?.textContent.toLowerCase() || '';
            const courses = row.querySelector('td:nth-child(4)')?.textContent.toLowerCase() || '';
            
            const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm) || studentId.includes(searchTerm);
            const matchesCourse = !courseFilter || courses.includes(courseFilter);
            
            row.style.display = (matchesSearch && matchesCourse) ? '' : 'none';
        });
    }
    
    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    // Close modals on outside click
    document.getElementById('studentModal').addEventListener('click', function(e) {
        if (e.target === this) closeStudentModal();
    });
    document.getElementById('messageModal').addEventListener('click', function(e) {
        if (e.target === this) closeMessageModal();
    });
    
    // Message form submission
    document.getElementById('messageForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('/faculty/students/message', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Message sent successfully!');
                closeMessageModal();
            } else {
                alert(data.message || 'Error sending message');
            }
        })
        .catch(error => alert('Error: ' + error.message));
    });
    
    // Search on enter key
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') filterStudents();
    });

    // -------------------- LOGOUT CONFIRMATION MODAL LOGIC (FULL ACCOUNT LOGOUT) --------------------
    const logoutButton = document.getElementById('logoutButton');
    const logoutModal = document.getElementById('logoutModal');
    const confirmBtn = document.getElementById('confirmLogoutBtn');
    const cancelBtn = document.getElementById('cancelLogoutBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
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
    if (confirmBtn) {
        confirmBtn.addEventListener('click', () => {
            if (logoutForm) {
                logoutForm.submit();
            } else {
                window.location.href = "{{ route('logout') }}";
            }
        });
    }
    if (cancelBtn) cancelBtn.addEventListener('click', closeLogoutModal);
    if (closeModalBtn) closeModalBtn.addEventListener('click', closeLogoutModal);
    logoutModal.addEventListener('click', (e) => {
        if (e.target === logoutModal) closeLogoutModal();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && logoutModal.classList.contains('active')) closeLogoutModal();
    });
</script>
</body>
</html>