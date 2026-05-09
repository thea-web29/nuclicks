<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>System Settings - Admin Panel | NU Clicks LMS</title>

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
            overflow: hidden;
        }

        .avatar img {
            width: 42px;
            height: 42px;
            object-fit: cover;
            border-radius: 50%;
        }

        .profile-details p {
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
            margin: 0;
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
            margin: 0;
        }

        @media (max-width: 1024px) {
            .menu-toggle {
                display: block;
            }

            .main-content {
                margin-left: 0;
            }
        }

        .settings-card {
            background: white;
            border-radius: 1.2rem;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(0,0,0,0.03);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .settings-card-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--gray-border);
            background: #fff;
        }

        .settings-card-body {
            padding: 1.5rem;
        }

        .form-input {
            width: 100%;
            border: 1px solid #D1D5DB;
            border-radius: 0.75rem;
            padding: 0.625rem 1rem;
            transition: var(--transition);
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 2px rgba(255, 215, 15, 0.2);
        }

        .small-input {
            border: 1px solid #D1D5DB;
            border-radius: 0.65rem;
            padding: 0.5rem 0.65rem;
            font-size: 0.875rem;
            background: white;
        }

        .small-input:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 2px rgba(255, 215, 15, 0.15);
        }

        .btn-save {
            background-color: var(--blue-deep);
            color: white;
            padding: 0.625rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: var(--transition);
            border: none;
            cursor: pointer;
        }

        .btn-save:hover {
            background-color: #0e2a5c;
        }

        .logout-modal-overlay {
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
            transition: all 0.2s ease;
        }

        .logout-modal-overlay.active {
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

        .logout-modal-overlay.active .confirmation-modal {
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

@php
    $authUser = Auth::user();

    $profilePicture = null;

    if ($authUser && !empty($authUser->profile_picture)) {
        $profilePicture = asset('storage/' . $authUser->profile_picture);
    } elseif ($authUser && !empty($authUser->avatar)) {
        $profilePicture = asset('storage/' . $authUser->avatar);
    }

    /*
    |--------------------------------------------------------------------------
    | Safe Settings Value Reader
    |--------------------------------------------------------------------------
    | This prevents errors when system_settings.value is already an array.
    | It safely handles:
    | - JSON strings
    | - plain strings
    | - arrays already casted by Laravel
    | - null values
    */
    if (!function_exists('nuclicks_setting_value')) {
        function nuclicks_setting_value($value, $default = null) {
            if (is_array($value)) {
                return $value;
            }

            if (is_null($value)) {
                return $default;
            }

            if (!is_string($value)) {
                return $value;
            }

            $decoded = json_decode($value, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }

            return $value;
        }
    }

    if (!function_exists('nuclicks_setting_text')) {
        function nuclicks_setting_text($value, $default = '') {
            $cleanValue = nuclicks_setting_value($value, $default);

            if (is_array($cleanValue)) {
                return implode(',', $cleanValue);
            }

            if (is_bool($cleanValue)) {
                return $cleanValue ? '1' : '0';
            }

            if (is_null($cleanValue)) {
                return $default;
            }

            return $cleanValue;
        }
    }

    if (!function_exists('nuclicks_setting_boolean')) {
        function nuclicks_setting_boolean($value) {
            $cleanValue = nuclicks_setting_value($value, false);

            return in_array($cleanValue, [true, 1, '1', 'true', 'yes', 'enabled'], true);
        }
    }

    $gradeScaleSetting = $gradingSettings->where('key', 'grade_scale')->first();
    $decodedGradeScale = nuclicks_setting_value($gradeScaleSetting->value ?? [], []);

    if (!is_array($decodedGradeScale)) {
        $decodedGradeScale = [];
    }
@endphp

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
            <div class="nav-section-title">Management</div>

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
                @if($profilePicture)
                    <img src="{{ $profilePicture }}" alt="Profile Picture">
                @else
                    <i class="ri-user-line"></i>
                @endif
            </div>

            <div class="profile-details">
                <p>{{ $authUser->name ?? 'Admin User' }}</p>
                <span>{{ $authUser->email ?? 'admin@nuclicks.test' }}</span>
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
        <button class="menu-toggle" id="menuToggle">
            <i class="ri-menu-line"></i>
        </button>

        <div>
            <h2 class="page-title text-lg md:text-xl">System Settings</h2>
            <p class="text-sm text-gray-500 hidden md:block">Configure platform behavior and rules</p>
        </div>

        <div class="w-8"></div>
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

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-xl mb-6 shadow-sm">
                <div class="font-semibold mb-2">Please fix the following:</div>
                <ul class="list-disc ml-6">
                    @foreach($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            <!-- Grading Settings -->
            <div class="settings-card">
                <div class="settings-card-header">
                    <h3 class="text-lg font-bold flex items-center gap-2">
                        <i class="ri-graduation-cap-line" style="color: var(--gold);"></i>
                        Grading System
                    </h3>
                </div>

                <div class="settings-card-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($gradingSettings as $setting)
                            <div class="{{ $setting->key === 'grade_scale' ? 'md:col-span-2' : '' }}">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                                </label>

                                @if($setting->type === 'boolean')
                                    @php
                                        $isEnabled = nuclicks_setting_boolean($setting->value);
                                    @endphp

                                    <select name="{{ $setting->key }}" class="form-input bg-white">
                                        <option value="1" {{ $isEnabled ? 'selected' : '' }}>Enabled</option>
                                        <option value="0" {{ !$isEnabled ? 'selected' : '' }}>Disabled</option>
                                    </select>

                                @elseif($setting->type === 'json' && $setting->key === 'grade_scale')
                                    @php
                                        $grades = nuclicks_setting_value($setting->value, []);

                                        if (!is_array($grades)) {
                                            $grades = [];
                                        }
                                    @endphp

                                    <div id="gradeScaleContainer">
                                        @forelse($grades as $index => $grade)
                                            @php
                                                $min = $grade['min'] ?? '';
                                                $max = $grade['max'] ?? '';
                                                $label = $grade['label'] ?? $grade['grade'] ?? '';
                                                $description = $grade['description'] ?? '';
                                            @endphp

                                            <div class="flex flex-wrap gap-2 mb-2 items-center">
                                                <input
                                                    type="number"
                                                    name="grade_scale[{{ $index }}][min]"
                                                    value="{{ $min }}"
                                                    placeholder="Min"
                                                    class="small-input w-20"
                                                >

                                                <input
                                                    type="number"
                                                    name="grade_scale[{{ $index }}][max]"
                                                    value="{{ $max }}"
                                                    placeholder="Max"
                                                    class="small-input w-20"
                                                >

                                                <input
                                                    type="text"
                                                    name="grade_scale[{{ $index }}][label]"
                                                    value="{{ $label }}"
                                                    placeholder="Label"
                                                    class="small-input w-36"
                                                >

                                                <input
                                                    type="text"
                                                    name="grade_scale[{{ $index }}][description]"
                                                    value="{{ $description }}"
                                                    placeholder="Description"
                                                    class="small-input flex-1 min-w-[180px]"
                                                >

                                                <button
                                                    type="button"
                                                    onclick="this.parentElement.remove()"
                                                    class="text-red-500 hover:text-red-700 text-lg"
                                                    title="Remove"
                                                >
                                                    ✕
                                                </button>
                                            </div>
                                        @empty
                                            <div class="flex flex-wrap gap-2 mb-2 items-center">
                                                <input type="number" name="grade_scale[0][min]" value="90" placeholder="Min" class="small-input w-20">
                                                <input type="number" name="grade_scale[0][max]" value="100" placeholder="Max" class="small-input w-20">
                                                <input type="text" name="grade_scale[0][label]" value="Excellent" placeholder="Label" class="small-input w-36">
                                                <input type="text" name="grade_scale[0][description]" value="" placeholder="Description" class="small-input flex-1 min-w-[180px]">
                                                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 text-lg">✕</button>
                                            </div>

                                            <div class="flex flex-wrap gap-2 mb-2 items-center">
                                                <input type="number" name="grade_scale[1][min]" value="75" placeholder="Min" class="small-input w-20">
                                                <input type="number" name="grade_scale[1][max]" value="89" placeholder="Max" class="small-input w-20">
                                                <input type="text" name="grade_scale[1][label]" value="Passed" placeholder="Label" class="small-input w-36">
                                                <input type="text" name="grade_scale[1][description]" value="" placeholder="Description" class="small-input flex-1 min-w-[180px]">
                                                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 text-lg">✕</button>
                                            </div>

                                            <div class="flex flex-wrap gap-2 mb-2 items-center">
                                                <input type="number" name="grade_scale[2][min]" value="0" placeholder="Min" class="small-input w-20">
                                                <input type="number" name="grade_scale[2][max]" value="74" placeholder="Max" class="small-input w-20">
                                                <input type="text" name="grade_scale[2][label]" value="Failed" placeholder="Label" class="small-input w-36">
                                                <input type="text" name="grade_scale[2][description]" value="" placeholder="Description" class="small-input flex-1 min-w-[180px]">
                                                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 text-lg">✕</button>
                                            </div>
                                        @endforelse
                                    </div>

                                    <button
                                        type="button"
                                        onclick="addGradeLevel()"
                                        class="text-indigo-600 text-sm mt-2 hover:underline flex items-center gap-1"
                                    >
                                        <i class="ri-add-line"></i> Add Grade Level
                                    </button>

                                @else
                                    @php
                                        $displayValue = nuclicks_setting_text($setting->value, '');
                                    @endphp

                                    <input
                                        type="{{ $setting->type === 'number' ? 'number' : 'text' }}"
                                        name="{{ $setting->key }}"
                                        value="{{ $displayValue }}"
                                        class="form-input"
                                    >
                                @endif

                                <p class="text-xs text-gray-500 mt-1">{{ $setting->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Quiz Settings -->
            <div class="settings-card">
                <div class="settings-card-header">
                    <h3 class="text-lg font-bold flex items-center gap-2">
                        <i class="ri-quiz-line" style="color: var(--gold);"></i>
                        Quiz Rules
                    </h3>
                </div>

                <div class="settings-card-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($quizSettings as $setting)
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                                </label>

                                @if($setting->type === 'boolean')
                                    @php
                                        $isEnabled = nuclicks_setting_boolean($setting->value);
                                    @endphp

                                    <select name="{{ $setting->key }}" class="form-input bg-white">
                                        <option value="1" {{ $isEnabled ? 'selected' : '' }}>Enabled</option>
                                        <option value="0" {{ !$isEnabled ? 'selected' : '' }}>Disabled</option>
                                    </select>

                                @elseif($setting->key === 'show_correct_answers_after')
                                    @php
                                        $displayValue = nuclicks_setting_text($setting->value, '');
                                    @endphp

                                    <select name="{{ $setting->key }}" class="form-input bg-white">
                                        <option value="immediate" {{ $displayValue == 'immediate' ? 'selected' : '' }}>Immediately after submission</option>
                                        <option value="after_end" {{ $displayValue == 'after_end' ? 'selected' : '' }}>After quiz end date</option>
                                        <option value="manual" {{ $displayValue == 'manual' ? 'selected' : '' }}>Manual faculty grading</option>
                                    </select>

                                @else
                                    @php
                                        $displayValue = nuclicks_setting_text($setting->value, '');
                                    @endphp

                                    <input
                                        type="{{ $setting->type === 'number' ? 'number' : 'text' }}"
                                        name="{{ $setting->key }}"
                                        value="{{ $displayValue }}"
                                        class="form-input"
                                    >
                                @endif

                                <p class="text-xs text-gray-500 mt-1">{{ $setting->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Academic Settings -->
            <div class="settings-card">
                <div class="settings-card-header">
                    <h3 class="text-lg font-bold flex items-center gap-2">
                        <i class="ri-calendar-line" style="color: var(--gold);"></i>
                        Academic Settings
                    </h3>
                </div>

                <div class="settings-card-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($academicSettings as $setting)
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                                </label>

                                @if($setting->type === 'boolean')
                                    @php
                                        $isEnabled = nuclicks_setting_boolean($setting->value);
                                    @endphp

                                    <select name="{{ $setting->key }}" class="form-input bg-white">
                                        <option value="1" {{ $isEnabled ? 'selected' : '' }}>Enabled</option>
                                        <option value="0" {{ !$isEnabled ? 'selected' : '' }}>Disabled</option>
                                    </select>

                                @elseif($setting->key === 'semester_start_date' || $setting->key === 'semester_end_date')
                                    @php
                                        $displayValue = nuclicks_setting_text($setting->value, '');
                                    @endphp

                                    <input
                                        type="date"
                                        name="{{ $setting->key }}"
                                        value="{{ $displayValue }}"
                                        class="form-input"
                                    >

                                @else
                                    @php
                                        $displayValue = nuclicks_setting_text($setting->value, '');
                                    @endphp

                                    <input
                                        type="{{ $setting->type === 'number' ? 'number' : 'text' }}"
                                        name="{{ $setting->key }}"
                                        value="{{ $displayValue }}"
                                        class="form-input"
                                    >
                                @endif

                                <p class="text-xs text-gray-500 mt-1">{{ $setting->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- File Upload Settings -->
            <div class="settings-card">
                <div class="settings-card-header">
                    <h3 class="text-lg font-bold flex items-center gap-2">
                        <i class="ri-file-upload-line" style="color: var(--gold);"></i>
                        File Upload Settings
                    </h3>
                </div>

                <div class="settings-card-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($fileSettings as $setting)
                            <div class="{{ $setting->key === 'allowed_file_types' ? 'md:col-span-2' : '' }}">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                                </label>

                                @if($setting->key === 'allowed_file_types')
                                    @php
                                        $types = nuclicks_setting_value($setting->value, []);

                                        if (!is_array($types)) {
                                            $types = explode(',', (string) $types);
                                        }

                                        $types = array_values(array_filter(array_map(function ($type) {
                                            return trim(str_replace('"', '', (string) $type));
                                        }, $types)));
                                    @endphp

                                    <div class="border rounded-xl p-3 bg-gray-50">
                                        <div class="flex flex-wrap gap-2 mb-2" id="fileTypesContainer">
                                            @foreach($types as $type)
                                                <span class="bg-white border border-gray-300 px-3 py-1 rounded-full text-sm flex items-center shadow-sm">
                                                    {{ $type }}
                                                    <button type="button" onclick="removeFileType(this)" class="ml-2 text-red-500 hover:text-red-700">&times;</button>
                                                    <input type="hidden" name="allowed_file_types[]" value="{{ $type }}">
                                                </span>
                                            @endforeach
                                        </div>

                                        <div class="flex mt-2">
                                            <input
                                                type="text"
                                                id="newFileType"
                                                placeholder="e.g., pdf, jpg, doc"
                                                class="flex-1 border border-gray-300 rounded-l-xl px-3 py-2 text-sm focus:outline-none"
                                            >

                                            <button
                                                type="button"
                                                onclick="addFileType()"
                                                class="bg-gray-700 text-white px-4 py-2 rounded-r-xl text-sm hover:bg-gray-800 transition"
                                            >
                                                Add
                                            </button>
                                        </div>
                                    </div>

                                @else
                                    @php
                                        $displayValue = nuclicks_setting_text($setting->value, '');
                                    @endphp

                                    <input
                                        type="{{ $setting->type === 'number' ? 'number' : 'text' }}"
                                        name="{{ $setting->key }}"
                                        value="{{ $displayValue }}"
                                        class="form-input"
                                    >
                                @endif

                                <p class="text-xs text-gray-500 mt-1">{{ $setting->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-save flex items-center gap-2">
                    <i class="ri-save-line"></i> Save All Settings
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ======================= LOGOUT CONFIRMATION MODAL ======================= -->
<div id="logoutModal" class="logout-modal-overlay">
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

    const currentUrl = window.location.pathname;

    document.querySelectorAll('.nav-item').forEach(item => {
        const href = item.getAttribute('href');

        if (href && currentUrl.includes(href) && href !== '/admin/dashboard') {
            item.classList.add('active');
        } else if (currentUrl === '/admin/dashboard' && href === '/admin/dashboard') {
            item.classList.add('active');
        }
    });

    let gradeCount = {{ count($decodedGradeScale) > 0 ? count($decodedGradeScale) : 3 }};

    function addGradeLevel() {
        const container = document.getElementById('gradeScaleContainer');

        if (!container) {
            return;
        }

        const div = document.createElement('div');
        div.className = 'flex flex-wrap gap-2 mb-2 items-center';

        div.innerHTML = `
            <input type="number" name="grade_scale[${gradeCount}][min]" placeholder="Min" class="small-input w-20">
            <input type="number" name="grade_scale[${gradeCount}][max]" placeholder="Max" class="small-input w-20">
            <input type="text" name="grade_scale[${gradeCount}][label]" placeholder="Label" class="small-input w-36">
            <input type="text" name="grade_scale[${gradeCount}][description]" placeholder="Description" class="small-input flex-1 min-w-[180px]">
            <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 text-lg">✕</button>
        `;

        container.appendChild(div);
        gradeCount++;
    }

    function addFileType() {
        const input = document.getElementById('newFileType');
        const container = document.getElementById('fileTypesContainer');

        if (!input || !container) {
            return;
        }

        const type = input.value.trim().toLowerCase().replace(/^\./, '');

        if (!type) {
            return;
        }

        const existingTypes = Array.from(container.querySelectorAll('input[name="allowed_file_types[]"]'))
            .map(input => input.value.toLowerCase());

        if (existingTypes.includes(type)) {
            input.value = '';
            return;
        }

        const span = document.createElement('span');
        span.className = 'bg-white border border-gray-300 px-3 py-1 rounded-full text-sm flex items-center shadow-sm';

        span.innerHTML = `
            ${type}
            <button type="button" onclick="removeFileType(this)" class="ml-2 text-red-500 hover:text-red-700">&times;</button>
            <input type="hidden" name="allowed_file_types[]" value="${type}">
        `;

        container.appendChild(span);
        input.value = '';
    }

    function removeFileType(button) {
        button.parentElement.remove();
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
            if (e.target === this) {
                closeLogoutModal();
            }
        });
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLogoutModal();
        }
    });
</script>

</body>
</html>