<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Question Bank - NU Clicks LMS</title>
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

        /* Stats cards styling */
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
        .question-item {
            transition: var(--transition);
        }
        .question-item:hover {
            background: #F8FAFF;
        }
        .btn-gold {
            background-color: var(--gold);
            color: var(--blue-deep);
        }
        .btn-gold:hover {
            background-color: var(--gold-dark);
        }
        .badge-mcq {
            background: #dcfce7;
            color: #166534;
        }
        .badge-tf {
            background: #dbeafe;
            color: #1e40af;
        }
        .badge-essay {
            background: #f3e8ff;
            color: #6b21a5;
        }
        
        /* ========== ENHANCED PROFESSIONAL MODAL STYLES (matches course modal) ========== */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(10, 31, 68, 0.6);
            backdrop-filter: blur(5px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1), visibility 0.3s;
        }
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .modal-container {
            background: white;
            max-width: 640px;
            width: 92%;
            border-radius: 1.75rem;
            box-shadow: 0 30px 50px -15px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(255, 215, 15, 0.1);
            transform: scale(0.96) translateY(12px);
            transition: transform 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.2);
            overflow: hidden;
        }
        .modal-overlay.active .modal-container {
            transform: scale(1) translateY(0);
        }
        .modal-header {
            background: linear-gradient(135deg, #0A1F44 0%, #132e5e 100%);
            padding: 1.25rem 1.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--gold);
        }
        .modal-header h3 {
            font-weight: 700;
            font-size: 1.35rem;
            letter-spacing: -0.2px;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            color: white;
        }
        .modal-header h3 i {
            color: var(--gold);
            font-size: 1.6rem;
        }
        .modal-close {
            background: rgba(255,255,255,0.15);
            width: 32px;
            height: 32px;
            border-radius: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            cursor: pointer;
            color: white;
            transition: all 0.2s;
        }
        .modal-close:hover {
            background: var(--gold);
            color: var(--blue-deep);
            transform: rotate(90deg);
        }
        .modal-body {
            padding: 1.75rem 2rem 1.5rem;
            background: #FFFFFF;
            max-height: 65vh;
            overflow-y: auto;
        }
        .form-group {
            margin-bottom: 1.35rem;
        }
        .form-label {
            display: block;
            font-weight: 600;
            font-size: 0.85rem;
            color: #1E293B;
            margin-bottom: 0.5rem;
            letter-spacing: -0.2px;
        }
        .form-label span {
            color: #ef4444;
        }
        .form-control, select.form-control, textarea.form-control {
            width: 100%;
            border: 1.5px solid #E2E8F0;
            border-radius: 0.9rem;
            padding: 0.7rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s;
            background: #FCFDFF;
        }
        .form-control:focus, select.form-control:focus, textarea.form-control:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(255, 215, 15, 0.25);
            background: white;
        }
        .option-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }
        .option-row input[type="text"] {
            flex: 1;
        }
        .correct-radio {
            width: 1.1rem;
            height: 1.1rem;
            accent-color: var(--gold);
            cursor: pointer;
        }
        .remove-option {
            color: #94A3B8;
            transition: color 0.2s;
            cursor: pointer;
            font-size: 1.1rem;
        }
        .remove-option:hover {
            color: #ef4444;
        }
        .add-option-btn {
            color: var(--blue-deep);
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.8rem;
            margin-top: 0.5rem;
            cursor: pointer;
            transition: opacity 0.2s;
        }
        .add-option-btn:hover {
            opacity: 0.8;
        }
        .radio-group {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            margin-top: 0.3rem;
        }
        .radio-group label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            cursor: pointer;
        }
        .modal-footer {
            background: #F8FAFE;
            padding: 1rem 2rem 1.5rem;
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            border-top: 1px solid #EDF2F7;
        }
        .btn-cancel {
            background: transparent;
            border: 1.5px solid #CBD5E1;
            padding: 0.6rem 1.4rem;
            border-radius: 2rem;
            font-weight: 600;
            font-size: 0.85rem;
            color: #475569;
            transition: all 0.2s;
            cursor: pointer;
        }
        .btn-cancel:hover {
            background: #F1F5F9;
            border-color: #94A3B8;
        }
        .btn-submit {
            background: var(--blue-deep);
            border: none;
            padding: 0.6rem 1.8rem;
            border-radius: 2rem;
            font-weight: 700;
            font-size: 0.85rem;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(10,31,68,0.2);
        }
        .btn-submit:hover {
            background: #0F2A5C;
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(10,31,68,0.15);
        }
        .error-feedback {
            font-size: 0.7rem;
            color: #E53E3E;
            margin-top: 0.3rem;
        }
        /* Custom scroll inside modal */
        .modal-body::-webkit-scrollbar {
            width: 5px;
        }
        .modal-body::-webkit-scrollbar-track {
            background: #E2E8F0;
            border-radius: 10px;
        }
        .modal-body::-webkit-scrollbar-thumb {
            background: var(--gold);
            border-radius: 10px;
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
        <h2 class="page-title text-lg md:text-xl">Question Bank</h2>
        <div class="w-8"></div>
    </div>

    <div class="p-4 md:p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total Questions</p>
                        <p class="text-3xl font-bold" style="color: var(--blue-deep);">{{ $questions->count() }}</p>
                    </div>
                    <i class="ri-questionnaire-line text-4xl text-indigo-300"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">MCQ Questions</p>
                        <p class="text-3xl font-bold text-green-600">{{ $questions->where('question_type', 'mcq')->count() }}</p>
                    </div>
                    <i class="ri-list-check-2 text-4xl text-green-300"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">True/False Questions</p>
                        <p class="text-3xl font-bold text-blue-600">{{ $questions->where('question_type', 'true_false')->count() }}</p>
                    </div>
                    <i class="ri-checkbox-circle-line text-4xl text-blue-300"></i>
                </div>
            </div>
        </div>

        <!-- Questions List Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center flex-wrap gap-3">
                <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <i class="ri-database-2-line" style="color: var(--gold);"></i> All Questions
                </h3>
                <button onclick="openCreateModal()" class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold transition shadow-sm" style="background: var(--blue-deep); color: white;">
                    <i class="ri-add-line"></i> Add Question
                </button>
            </div>
            
            @if($questions->count() > 0)
                <div class="divide-y divide-gray-100">
                    @foreach($questions as $question)
                    <div class="p-5 question-item transition" id="question-{{ $question->id }}">
                        <div class="flex flex-col md:flex-row md:items-start justify-between gap-3">
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center gap-2 mb-2">
                                    @if($question->question_type == 'mcq')
                                        <span class="badge-mcq text-xs px-2.5 py-0.5 rounded-full font-medium">Multiple Choice</span>
                                    @elseif($question->question_type == 'true_false')
                                        <span class="badge-tf text-xs px-2.5 py-0.5 rounded-full font-medium">True/False</span>
                                    @else
                                        <span class="badge-essay text-xs px-2.5 py-0.5 rounded-full font-medium">Essay</span>
                                    @endif
                                    <a href="{{ route('faculty.edit.quiz', $question->quiz_id) }}" class="text-xs text-indigo-600 hover:underline">
                                        {{ $question->quiz->course->code ?? 'N/A' }} - {{ $question->quiz->title ?? 'N/A' }}
                                    </a>
                                    <span class="text-xs text-gray-500">{{ $question->points }} points</span>
                                </div>
                                <p class="text-gray-800 font-medium">{{ $question->question_text }}</p>
                                
                                @if($question->question_type == 'mcq')
                                    <div class="mt-3 space-y-1">
                                        @php
                                            $options = $question->options;
                                            if (is_string($options)) $options = json_decode($options, true);
                                            if (!is_array($options)) $options = [];
                                        @endphp
                                        @forelse($options as $option)
                                            <div class="text-sm {{ $option == $question->correct_answer ? 'text-green-700 font-semibold' : 'text-gray-600' }}">
                                                • {{ $option }}
                                                @if($option == $question->correct_answer)
                                                    <span class="text-green-600 ml-2">(Correct)</span>
                                                @endif
                                            </div>
                                        @empty
                                            <div class="text-sm text-gray-500">No options available</div>
                                        @endforelse
                                    </div>
                                @elseif($question->question_type == 'true_false')
                                    <div class="mt-2">
                                        <span class="text-sm text-green-700 font-semibold">✓ Correct Answer: {{ $question->correct_answer }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <button onclick="editQuestion({{ $question->id }})" class="p-2 rounded-lg hover:bg-gray-100 transition text-blue-600">
                                    <i class="ri-edit-line text-lg"></i>
                                </button>
                                <button onclick="deleteQuestion({{ $question->id }})" class="p-2 rounded-lg hover:bg-gray-100 transition text-red-600">
                                    <i class="ri-delete-bin-line text-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <i class="ri-question-line text-6xl text-gray-300 mb-4 block"></i>
                    <p class="text-gray-500 mb-4">No questions in the question bank yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- ========== ENHANCED PROFESSIONAL MODAL: Create/Edit Question ========== -->
<div id="questionModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h3 id="modalTitle">
                <i class="ri-add-circle-line"></i> Create New Question
            </h3>
            <div class="modal-close" onclick="closeModal()">
                <i class="ri-close-line"></i>
            </div>
        </div>
        
        <div class="modal-body">
            <form id="questionForm">
                @csrf
                <input type="hidden" id="editQuestionId" name="question_id" value="">

                <div class="form-group">
                    <label class="form-label">Quiz <span>*</span></label>
                    <select id="quizIdSelect" name="quiz_id" class="form-control" required>
                        <option value="">Select a Quiz</option>
                        @foreach($quizzes as $quiz)
                            <option value="{{ $quiz->id }}">{{ $quiz->course->code ?? 'N/A' }} — {{ $quiz->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Question Type</label>
                    <select id="questionType" name="question_type" class="form-control">
                        <option value="mcq">Multiple Choice (MCQ)</option>
                        <option value="true_false">True / False</option>
                        <option value="essay">Essay</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Question Text <span>*</span></label>
                    <textarea id="questionText" name="question_text" rows="3" required class="form-control" placeholder="e.g., What is the capital of France?"></textarea>
                </div>
                
                <!-- MCQ Options -->
                <div id="mcqDiv" class="form-group">
                    <label class="form-label">Answer Options</label>
                    <div id="optionsList" class="space-y-2">
                        <div class="option-row">
                            <input type="text" name="options[]" class="form-control" placeholder="Option 1">
                            <input type="radio" name="correct_answer" value="" class="correct-radio" onchange="setCorrectAnswerValue(this)">
                            <i class="ri-delete-bin-line remove-option" onclick="this.parentElement.remove()"></i>
                        </div>
                        <div class="option-row">
                            <input type="text" name="options[]" class="form-control" placeholder="Option 2">
                            <input type="radio" name="correct_answer" value="" class="correct-radio" onchange="setCorrectAnswerValue(this)">
                            <i class="ri-delete-bin-line remove-option" onclick="this.parentElement.remove()"></i>
                        </div>
                    </div>
                    <div class="add-option-btn" onclick="addOption()">
                        <i class="ri-add-line"></i> Add another option
                    </div>
                </div>
                
                <!-- True/False -->
                <div id="tfDiv" class="form-group" style="display: none;">
                    <label class="form-label">Correct Answer</label>
                    <div class="radio-group">
                        <label><input type="radio" name="correct_answer" value="True"> True</label>
                        <label><input type="radio" name="correct_answer" value="False"> False</label>
                    </div>
                </div>
                
                <!-- Essay -->
                <div id="essayDiv" class="form-group" style="display: none;">
                    <label class="form-label">Sample Answer / Rubric (Optional)</label>
                    <textarea id="essayAnswer" name="correct_answer" rows="3" class="form-control" placeholder="Provide a sample answer or grading guidelines..."></textarea>
                    <p class="text-xs text-gray-500 mt-1">Essay questions will be manually graded.</p>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Points <span>*</span></label>
                    <input type="number" id="points" name="points" required min="1" value="1" class="form-control">
                </div>
            </form>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
            <button type="submit" form="questionForm" class="btn-submit">
                <i class="ri-save-line"></i> Save Question
            </button>
        </div>
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
    // ========== Mobile sidebar toggle ==========
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    if (menuToggle) {
        menuToggle.addEventListener('click', () => sidebar.classList.toggle('mobile-open'));
    }
    document.addEventListener('click', function(event) {
        const isMobile = window.innerWidth <= 1024;
        if (isMobile && sidebar.classList.contains('mobile-open')) {
            if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                sidebar.classList.remove('mobile-open');
            }
        }
    });
    
    // ========== Active nav highlight ==========
    const currentUrl = window.location.pathname;
    document.querySelectorAll('.nav-item').forEach(item => {
        const href = item.getAttribute('href');
        if (href && currentUrl.includes(href) && href !== '/faculty/dashboard') {
            item.classList.add('active');
        } else if (currentUrl === '/faculty/dashboard' && href === '/faculty/dashboard') {
            item.classList.add('active');
        }
    });
    if (currentUrl.includes('/faculty/question-bank')) {
        document.querySelectorAll('.nav-item').forEach(item => {
            if (item.getAttribute('href') === '{{ route("faculty.question.bank") }}') {
                item.classList.add('active');
            }
        });
    }
    
    // ========== Modal logic with enhanced theme ==========
    let optionCounter = 2;
    const modal = document.getElementById('questionModal');
    
    function openModal() {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
        resetForm();
    }
    
    function openCreateModal() {
        document.getElementById('modalTitle').innerHTML = '<i class="ri-add-circle-line"></i> Create New Question';
        document.getElementById('editQuestionId').value = '';
        resetForm();
        openModal();
    }
    
    function editQuestion(questionId) {
        fetch(`/faculty/questions/${questionId}/edit-data`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const q = data.question;
                document.getElementById('modalTitle').innerHTML = '<i class="ri-edit-line"></i> Edit Question';
                document.getElementById('editQuestionId').value = q.id;
                document.getElementById('quizIdSelect').value = q.quiz_id || '';
                document.getElementById('questionType').value = q.question_type;
                document.getElementById('questionText').value = q.question_text;
                document.getElementById('points').value = q.points;
                toggleSections();
                
                if (q.question_type === 'mcq') {
                    let options = typeof q.options === 'string' ? JSON.parse(q.options) : q.options;
                    const container = document.getElementById('optionsList');
                    container.innerHTML = '';
                    if (options && Array.isArray(options)) {
                        options.forEach((opt, idx) => {
                            const div = document.createElement('div');
                            div.className = 'option-row';
                            div.innerHTML = `
                                <input type="text" name="options[]" class="form-control" value="${escapeHtml(opt)}">
                                <input type="radio" name="correct_answer" value="${escapeHtml(opt)}" class="correct-radio" onchange="setCorrectAnswerValue(this)" ${opt === q.correct_answer ? 'checked' : ''}>
                                <i class="ri-delete-bin-line remove-option" onclick="this.parentElement.remove()"></i>
                            `;
                            container.appendChild(div);
                        });
                        optionCounter = options.length;
                    }
                } else if (q.question_type === 'true_false') {
                    const radios = document.querySelectorAll('#tfDiv input[name="correct_answer"]');
                    radios.forEach(radio => { if (radio.value === q.correct_answer) radio.checked = true; });
                } else if (q.question_type === 'essay') {
                    document.getElementById('essayAnswer').value = q.correct_answer || '';
                }
                openModal();
            } else alert('Could not load question');
        })
        .catch(err => alert('Error: ' + err.message));
    }
    
    function deleteQuestion(questionId) {
        if (confirm('Delete this question? This action cannot be undone.')) {
            fetch(`/faculty/questions/${questionId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) { alert('Question deleted'); location.reload(); }
                else alert(data.message || 'Error');
            })
            .catch(err => alert('Error: ' + err.message));
        }
    }
    
    function resetForm() {
        document.getElementById('questionForm').reset();
        document.getElementById('editQuestionId').value = '';
        document.getElementById('optionsList').innerHTML = `
            <div class="option-row">
                <input type="text" name="options[]" class="form-control" placeholder="Option 1">
                <input type="radio" name="correct_answer" value="" class="correct-radio" onchange="setCorrectAnswerValue(this)">
                <i class="ri-delete-bin-line remove-option" onclick="this.parentElement.remove()"></i>
            </div>
            <div class="option-row">
                <input type="text" name="options[]" class="form-control" placeholder="Option 2">
                <input type="radio" name="correct_answer" value="" class="correct-radio" onchange="setCorrectAnswerValue(this)">
                <i class="ri-delete-bin-line remove-option" onclick="this.parentElement.remove()"></i>
            </div>
        `;
        optionCounter = 2;
        document.getElementById('questionType').value = 'mcq';
        document.getElementById('essayAnswer').value = '';
        toggleSections();
        updateRadioValues();
    }
    
    function addOption() {
        optionCounter++;
        const container = document.getElementById('optionsList');
        const div = document.createElement('div');
        div.className = 'option-row';
        div.innerHTML = `
            <input type="text" name="options[]" class="form-control" placeholder="Option ${optionCounter}">
            <input type="radio" name="correct_answer" value="" class="correct-radio" onchange="setCorrectAnswerValue(this)">
            <i class="ri-delete-bin-line remove-option" onclick="this.parentElement.remove()"></i>
        `;
        container.appendChild(div);
        updateRadioValues();
    }
    
    function setCorrectAnswerValue(radio) {
        const optInput = radio.parentElement.querySelector('input[type="text"]');
        if (optInput && optInput.value) radio.value = optInput.value;
    }
    
    function toggleSections() {
        const type = document.getElementById('questionType').value;
        document.getElementById('mcqDiv').style.display = type === 'mcq' ? 'block' : 'none';
        document.getElementById('tfDiv').style.display = type === 'true_false' ? 'block' : 'none';
        document.getElementById('essayDiv').style.display = type === 'essay' ? 'block' : 'none';
    }
    
    function updateRadioValues() {
        const options = document.querySelectorAll('[name="options[]"]');
        const radios = document.querySelectorAll('.correct-radio');
        radios.forEach((radio, idx) => { if (options[idx] && options[idx].value) radio.value = options[idx].value; });
    }
    
    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    document.getElementById('questionType').addEventListener('change', toggleSections);
    document.addEventListener('input', e => { if (e.target.name === 'options[]') updateRadioValues(); });
    modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape' && modal.classList.contains('active')) closeModal(); });
    
    // Form submission
    document.getElementById('questionForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const type = document.getElementById('questionType').value;
        const questionText = document.getElementById('questionText').value.trim();
        const points = document.getElementById('points').value;
        let correctAnswer = '';
        
        if (!questionText) { alert('Please enter question text'); return; }
        
        if (type === 'mcq') {
            let selected = null;
            document.querySelectorAll('#mcqDiv .correct-radio').forEach(r => { if (r.checked && r.value) selected = r.value; });
            if (!selected) { alert('Please select the correct answer'); return; }
            correctAnswer = selected;
        } else if (type === 'true_false') {
            const selected = document.querySelector('#tfDiv input[name="correct_answer"]:checked');
            if (!selected) { alert('Please select True or False'); return; }
            correctAnswer = selected.value;
        } else {
            correctAnswer = document.getElementById('essayAnswer').value || 'To be graded manually';
        }
        
        updateRadioValues();
        const quizId = document.getElementById('quizIdSelect').value;
        if (!quizId) { alert('Please select a quiz'); return; }

        const formData = new FormData();
        formData.append('_token', document.querySelector('input[name="_token"]').value);
        formData.append('quiz_id', quizId);
        formData.append('question_type', type);
        formData.append('question_text', questionText);
        formData.append('correct_answer', correctAnswer);
        formData.append('points', points);

        if (type === 'mcq') {
            document.querySelectorAll('[name="options[]"]').forEach(opt => { if (opt.value.trim()) formData.append('options[]', opt.value.trim()); });
        }

        const questionId = document.getElementById('editQuestionId').value;
        let url = '/faculty/questions';
        if (questionId) { url = `/faculty/questions/${questionId}`; formData.append('_method', 'PUT'); }

        fetch(url, { method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.json())
            .then(data => {
                if (data.success) { alert(questionId ? 'Question updated!' : 'Question added!'); location.reload(); }
                else alert(data.message || 'Validation failed');
            })
            .catch(err => alert('Error: ' + err.message));
    });
    
    toggleSections();

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