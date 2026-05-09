<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Student Management - NU Clicks LMS</title>
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
            --success-green: #10b981;
            --info-blue: #3b82f6;
        }

        /* Remove focus outline from all elements */
        *:focus {
            outline: none !important;
        }

        *:focus-visible {
            outline: none !important;
        }

        button:focus,
        button:focus-visible,
        a:focus,
        a:focus-visible,
        input:focus,
        input:focus-visible,
        select:focus,
        select:focus-visible,
        textarea:focus,
        textarea:focus-visible {
            outline: none !important;
            box-shadow: none !important;
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
        .menu-toggle:focus {
            outline: none;
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

        /* Action buttons styling - ONE LINE ONLY */
        .action-group {
            display: flex;
            gap: 6px;
            flex-wrap: nowrap;
            white-space: nowrap;
        }
        
        .action-btn {
            padding: 6px;
            border-radius: 8px;
            transition: all 0.2s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            font-size: 0;
            width: 32px;
            height: 32px;
            border: none;
            background: transparent;
        }
        
        .action-btn i {
            font-size: 1.1rem;
            margin: 0;
        }
        
        .action-btn:focus {
            outline: none;
            box-shadow: none;
        }
        
        .btn-view {
            color: var(--info-blue);
            background: rgba(59, 130, 246, 0.1);
        }
        .btn-view:hover {
            background: var(--info-blue);
            color: white;
        }
        
        .btn-message {
            color: var(--success-green);
            background: rgba(16, 185, 129, 0.1);
        }
        .btn-message:hover {
            background: var(--success-green);
            color: white;
        }
        
        .btn-edit {
            color: var(--gold-dark);
            background: rgba(255, 215, 15, 0.1);
        }
        .btn-edit:hover {
            background: var(--gold);
            color: var(--blue-deep);
        }
        
        .btn-delete {
            color: var(--danger-red);
            background: rgba(220, 38, 38, 0.1);
        }
        .btn-delete:hover {
            background: var(--danger-red);
            color: white;
        }

        /* Remove outline from all buttons and inputs */
        button, input, select, textarea, a {
            outline: none !important;
        }
        
        button:focus, input:focus, select:focus, textarea:focus, a:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        /* Modal styles */
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
        .modal-close:focus {
            outline: none;
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
        .modal-btn:focus {
            outline: none;
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

        /* Remove blue highlight on click for mobile */
        -webkit-tap-highlight-color: transparent;
    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <!-- ORIGINAL NU LOGO - HINDI BINAGO -->
        <img src="/logo/NatU.png" alt="NU Logo" class="sidebar-logo-img">
        <div class="logo-text">
            <h1>NU <span>CLICKS</span> LMS</h1>
            <p>Faculty Portal</p>
        </div>
    </div>

    <div style="flex:1; overflow-y: auto;">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>
            <a href="{{ route('faculty.dashboard') }}" class="nav-item">
                <i class="ri-dashboard-line"></i> Dashboard
            </a>
            <a href="{{ route('faculty.students') }}" class="nav-item active">
                <i class="ri-user-line"></i> Students
            </a>
            <a href="{{ route('faculty.courses') }}" class="nav-item">
                <i class="ri-book-line"></i> Courses
            </a>
            <a href="{{ route('faculty.folder-files') }}" class="nav-item {{ request()->routeIs('faculty.folder-files*') ? 'active' : '' }}">
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
            <a href="{{ route('faculty.results.index') }}" class="nav-item">
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
                <p>Dr. John Smith</p>
                <span>john.smith@nu.edu.ph</span>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" id="logoutForm">
            @csrf
            <button type="button" id="logoutButton" class="logout-btn">
                <i class="ri-logout-box-r-line"></i> Sign Out
            </button>
        </form>
    </div>
</aside>

<!-- Main Content -->
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
                        <option value="CS101">CS101 - Programming</option>
                        <option value="CS201">CS201 - Data Structures</option>
                        <option value="CS301">CS301 - Algorithms</option>
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
                        <!-- Sample Student 1 -->
                        <tr class="student-row hover:bg-gray-50 transition" data-student-id="1">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">NU-2024-001</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="ri-user-line text-indigo-600 text-sm"></i>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">Maria Santos</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">maria.santos@nu.edu.ph</td>
                            <td class="px-6 py-4 text-sm text-gray-500">CS101, CS201</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="action-group">
                                    <button onclick="viewStudent(1)" class="action-btn btn-view" title="View Student">
                                        <i class="ri-eye-line"></i>
                                    </button>
                                    <button onclick="messageStudent(1)" class="action-btn btn-message" title="Send Message">
                                        <i class="ri-mail-send-line"></i>
                                    </button>
                                    <button onclick="editStudent(1)" class="action-btn btn-edit" title="Edit Student">
                                        <i class="ri-edit-line"></i>
                                    </button>
                                    <button onclick="deleteStudent(1)" class="action-btn btn-delete" title="Delete Student">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Sample Student 2 -->
                        <tr class="student-row hover:bg-gray-50 transition" data-student-id="2">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">NU-2024-002</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="ri-user-line text-indigo-600 text-sm"></i>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">Juan Dela Cruz</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">juan.delacruz@nu.edu.ph</td>
                            <td class="px-6 py-4 text-sm text-gray-500">CS101, CS301</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="action-group">
                                    <button onclick="viewStudent(2)" class="action-btn btn-view" title="View Student">
                                        <i class="ri-eye-line"></i>
                                    </button>
                                    <button onclick="messageStudent(2)" class="action-btn btn-message" title="Send Message">
                                        <i class="ri-mail-send-line"></i>
                                    </button>
                                    <button onclick="editStudent(2)" class="action-btn btn-edit" title="Edit Student">
                                        <i class="ri-edit-line"></i>
                                    </button>
                                    <button onclick="deleteStudent(2)" class="action-btn btn-delete" title="Delete Student">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Sample Student 3 -->
                        <tr class="student-row hover:bg-gray-50 transition" data-student-id="3">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">NU-2024-003</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="ri-user-line text-indigo-600 text-sm"></i>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">Anna Reyes</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">anna.reyes@nu.edu.ph</td>
                            <td class="px-6 py-4 text-sm text-gray-500">CS201, CS301</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="action-group">
                                    <button onclick="viewStudent(3)" class="action-btn btn-view" title="View Student">
                                        <i class="ri-eye-line"></i>
                                    </button>
                                    <button onclick="messageStudent(3)" class="action-btn btn-message" title="Send Message">
                                        <i class="ri-mail-send-line"></i>
                                    </button>
                                    <button onclick="editStudent(3)" class="action-btn btn-edit" title="Edit Student">
                                        <i class="ri-edit-line"></i>
                                    </button>
                                    <button onclick="deleteStudent(3)" class="action-btn btn-delete" title="Delete Student">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modals (same as before) -->
<div id="studentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b flex justify-between items-center" style="border-bottom-color: rgba(255,215,15,0.3);">
            <div>
                <h3 class="text-xl font-semibold flex items-center gap-2">
                    <i class="ri-user-star-line" style="color: var(--gold);"></i> Student Details
                </h3>
                <p class="text-gray-600 text-sm">Complete student information and performance</p>
            </div>
            <button onclick="closeStudentModal()" class="text-gray-400 hover:text-gray-600">
                <i class="ri-close-line text-2xl"></i>
            </button>
        </div>
        <div class="p-6" id="modalContent">
            <div class="text-center py-8">
                <div class="text-gray-400">Select a student to view details...</div>
            </div>
        </div>
    </div>
</div>

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

<div id="editStudentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-lg">
        <div class="p-6 border-b" style="border-bottom-color: rgba(255,215,15,0.3);">
            <h3 class="text-xl font-semibold flex items-center gap-2">
                <i class="ri-edit-line" style="color: var(--gold);"></i> Edit Student
            </h3>
            <p class="text-gray-600 text-sm">Update student information</p>
        </div>
        <div class="p-6">
            <form id="editStudentForm">
                <input type="hidden" id="editStudentId">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Student ID</label>
                    <input type="text" id="editStudentIdInput" required 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-gold">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" id="editStudentName" required 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-gold">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="editStudentEmail" required 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-gold">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-6 py-2 rounded-lg transition-all flex items-center gap-2" style="background: var(--blue-deep); color: white;">
                        <i class="ri-save-line"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="deleteModal" class="modal-overlay">
    <div class="confirmation-modal">
        <div class="modal-header">
            <h3>
                <i class="ri-delete-bin-line"></i> 
                Confirm Delete
            </h3>
            <button class="modal-close" id="closeDeleteModalBtn">&times;</button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete this student?</p>
            <p class="text-xs text-gray-500 mt-2">This action cannot be undone.</p>
        </div>
        <div class="modal-footer">
            <button class="modal-btn modal-btn-cancel" id="cancelDeleteBtn">Cancel</button>
            <button class="modal-btn modal-btn-confirm" id="confirmDeleteBtn">Yes, Delete</button>
        </div>
    </div>
</div>

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
        </div>
        <div class="modal-footer">
            <button class="modal-btn modal-btn-cancel" id="cancelLogoutBtn">Cancel</button>
            <button class="modal-btn modal-btn-confirm" id="confirmLogoutBtn">Yes, Sign Out</button>
        </div>
    </div>
</div>

<script>
    // Sample student data
    const studentsData = {
        1: { id: 1, student_id: 'NU-2024-001', name: 'Maria Santos', email: 'maria.santos@nu.edu.ph', courses: ['CS101 - Programming', 'CS201 - Data Structures'], grades: { 'CS101': 92, 'CS201': 88 } },
        2: { id: 2, student_id: 'NU-2024-002', name: 'Juan Dela Cruz', email: 'juan.delacruz@nu.edu.ph', courses: ['CS101 - Programming', 'CS301 - Algorithms'], grades: { 'CS101': 78, 'CS301': 85 } },
        3: { id: 3, student_id: 'NU-2024-003', name: 'Anna Reyes', email: 'anna.reyes@nu.edu.ph', courses: ['CS201 - Data Structures', 'CS301 - Algorithms'], grades: { 'CS201': 95, 'CS301': 91 } }
    };

    let currentDeleteId = null;

    // View Student
    function viewStudent(id) {
        const student = studentsData[id];
        if (student) {
            const modal = document.getElementById('studentModal');
            const content = document.getElementById('modalContent');
            
            content.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        <div class="bg-gray-50 rounded-lg p-6 text-center" style="border: 1px solid rgba(255,215,15,0.2);">
                            <div class="h-24 w-24 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="ri-user-line text-4xl text-indigo-600"></i>
                            </div>
                            <h3 class="text-xl font-bold">${escapeHtml(student.name)}</h3>
                            <p class="text-gray-600">${escapeHtml(student.email)}</p>
                            <p class="text-sm text-gray-500 mt-2">Student ID: ${escapeHtml(student.student_id)}</p>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="mb-6">
                            <h4 class="font-semibold text-lg mb-3 flex items-center">
                                <i class="ri-book-line mr-2" style="color: var(--gold);"></i> Enrolled Courses
                            </h4>
                            ${student.courses.map(course => `
                                <div class="border rounded-lg p-3 mb-2">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h4 class="font-semibold">${escapeHtml(course)}</h4>
                                            <p class="text-sm text-gray-600">Grade: ${student.grades[course.split(' - ')[0]] || 'N/A'}</p>
                                        </div>
                                        <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Active</span>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                </div>
            `;
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    function closeStudentModal() {
        const modal = document.getElementById('studentModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Message Student
    function messageStudent(id) {
        document.getElementById('messageStudentId').value = id;
        document.getElementById('messageModal').classList.remove('hidden');
        document.getElementById('messageModal').classList.add('flex');
    }

    function closeMessageModal() {
        document.getElementById('messageModal').classList.add('hidden');
        document.getElementById('messageModal').classList.remove('flex');
        document.getElementById('messageForm').reset();
    }

    // Edit Student
    function editStudent(id) {
        const student = studentsData[id];
        if (student) {
            document.getElementById('editStudentId').value = id;
            document.getElementById('editStudentIdInput').value = student.student_id;
            document.getElementById('editStudentName').value = student.name;
            document.getElementById('editStudentEmail').value = student.email;
            document.getElementById('editStudentModal').classList.remove('hidden');
            document.getElementById('editStudentModal').classList.add('flex');
        }
    }

    function closeEditModal() {
        document.getElementById('editStudentModal').classList.add('hidden');
        document.getElementById('editStudentModal').classList.remove('flex');
    }

    // Delete Student
    function deleteStudent(id) {
        currentDeleteId = id;
        document.getElementById('deleteModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('active');
        document.body.style.overflow = '';
        currentDeleteId = null;
    }

    function confirmDelete() {
        if (currentDeleteId) {
            const row = document.querySelector(`.student-row[data-student-id="${currentDeleteId}"]`);
            if (row) {
                row.remove();
                delete studentsData[currentDeleteId];
                showNotification('Student deleted successfully!', 'success');
            }
            closeDeleteModal();
        }
    }

    // Filter Students
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
            const matchesCourse = !courseFilter || courses.includes(courseFilter.toLowerCase());
            
            row.style.display = (matchesSearch && matchesCourse) ? '' : 'none';
        });
    }

    // Helper Functions
    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-20 right-4 z-50 px-4 py-2 rounded-lg shadow-lg text-white ${type === 'success' ? 'bg-green-500' : 'bg-blue-500'}`;
        notification.textContent = message;
        document.body.appendChild(notification);
        setTimeout(() => notification.remove(), 3000);
    }

    // Event Listeners
    document.getElementById('messageForm').addEventListener('submit', function(e) {
        e.preventDefault();
        showNotification('Message sent successfully!', 'success');
        closeMessageModal();
    });

    document.getElementById('editStudentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('editStudentId').value;
        const newName = document.getElementById('editStudentName').value;
        const newEmail = document.getElementById('editStudentEmail').value;
        const newStudentId = document.getElementById('editStudentIdInput').value;
        
        if (studentsData[id]) {
            studentsData[id].name = newName;
            studentsData[id].email = newEmail;
            studentsData[id].student_id = newStudentId;
            
            const row = document.querySelector(`.student-row[data-student-id="${id}"]`);
            if (row) {
                row.querySelector('td:nth-child(2) .text-gray-900').textContent = newName;
                row.querySelector('td:nth-child(3)').textContent = newEmail;
                row.querySelector('td:nth-child(1)').textContent = newStudentId;
            }
            
            showNotification('Student updated successfully!', 'success');
            closeEditModal();
        }
    });

    document.getElementById('confirmDeleteBtn').addEventListener('click', confirmDelete);
    document.getElementById('cancelDeleteBtn').addEventListener('click', closeDeleteModal);
    document.getElementById('closeDeleteModalBtn').addEventListener('click', closeDeleteModal);
    
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') filterStudents();
    });

    // Mobile sidebar toggle
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('mobile-open');
        });
    }

    // Logout Modal
    const logoutButton = document.getElementById('logoutButton');
    const logoutModal = document.getElementById('logoutModal');
    const confirmLogoutBtn = document.getElementById('confirmLogoutBtn');
    const cancelLogoutBtn = document.getElementById('cancelLogoutBtn');
    const closeLogoutModalBtn = document.getElementById('closeModalBtn');
    const logoutForm = document.getElementById('logoutForm');

    function openLogoutModal() {
        logoutModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeLogoutModalFunc() {
        logoutModal.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (logoutButton) logoutButton.addEventListener('click', openLogoutModal);
    if (confirmLogoutBtn) confirmLogoutBtn.addEventListener('click', () => logoutForm.submit());
    if (cancelLogoutBtn) cancelLogoutBtn.addEventListener('click', closeLogoutModalFunc);
    if (closeLogoutModalBtn) closeLogoutModalBtn.addEventListener('click', closeLogoutModalFunc);
</script>
</body>
</html>