<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>My Profile - NU Horizon LMS</title>
    
    <!-- Google Fonts + Remix Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:opsz,wght@9..144,600;9..144,700;9..144,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    
    <!-- Tailwind CSS -->
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
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #F8F6F1;
            overflow-x: hidden;
        }

        :root {
            --navy: #0A1F44;
            --navy-mid: #1F3A6D;
            --navy-lite: #3D5FA0;
            --navy-pale: #EEF3FB;
            --gold: #FFD70F;
            --gold-d: #C49A00;
            --gold-mid: #F5C800;
            --gold-pale: #FFFBEA;
            --bg: #F8F6F1;
            --bg-2: #F2EEE5;
            --white: #FFFFFF;
            --txt-1: #0A1F44;
            --txt-2: #2C3E5C;
            --txt-3: #637089;
            --bdr: rgba(10,31,68,0.09);
            --bdr-gold: rgba(196,154,0,0.28);
            --card-shadow: 0 8px 20px rgba(10,31,68,0.05);
            --transition: all 0.25s ease;
            --danger-red: #dc2626;
            --danger-dark: #b91c1c;
            --blue-deep: #0A1F44;
        }

        /* Sidebar & Nav Sections */
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
            color: var(--navy);
        }
        .nav-item.active i {
            color: var(--navy);
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
            border: 2px solid var(--gold);
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

        /* Top Bar */
        .top-bar {
            background: white;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            border-bottom: 1px solid var(--bdr);
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
            color: var(--navy);
        }
        .page-title {
            font-family: 'Fraunces', serif;
            font-weight: 700;
            color: var(--navy);
        }

        @media (max-width: 1024px) {
            .menu-toggle {
                display: block;
            }
        }

        .dashboard-card {
            background: white;
            border-radius: 1.2rem;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--bdr);
            overflow: hidden;
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
            background: var(--navy);
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
            border-top: 1px solid var(--bdr);
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

        /* UNIFIED PREMIUM LOGO STYLING - PREVENTS SIZING JUMPS */
        .sidebar-logo {
            padding: 1.5rem !important;
            border-bottom: 1px solid rgba(255, 215, 15, 0.2) !important;
            display: flex !important;
            align-items: center !important;
            gap: 0.82rem !important;
            min-height: 96px !important;
            height: 96px !important;
            overflow: visible !important;
            box-sizing: border-box !important;
        }

        .sidebar-logo-img {
            height: 45px !important;
            width: auto !important;
            flex-shrink: 0 !important;
        }

        .logo-text {
            position: relative !important;
            min-width: 0 !important;
            overflow: visible !important;
        }

        .logo-text h1 {
            font-family: 'Fraunces', serif !important;
            font-size: 1.3rem !important;
            font-weight: 800 !important;
            color: white !important;
            letter-spacing: -0.3px !important;
            line-height: 1.05 !important;
            margin: 0 !important;
            white-space: nowrap !important;
            overflow: visible !important;
        }

        .logo-text p {
            font-size: 0.55rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.1em !important;
            text-transform: uppercase !important;
            color: rgba(255,255,255,0.5) !important;
            margin-top: 0.25rem !important;
            margin-bottom: 0 !important;
        }

        .horizon-logo-wrap {
            position: relative !important;
            display: inline-block !important;
            margin-left: 0.05rem !important;
            color: var(--gold) !important;
            overflow: visible !important;
        }

        .horizon-word {
            position: relative !important;
            display: inline-block !important;
            color: var(--gold) !important;
            z-index: 2 !important;
        }

        .sun-rays {
            position: absolute !important;
            left: 50% !important;
            top: -1.48rem !important;
            width: 108px !important;
            height: 36px !important;
            transform: translateX(-50%) !important;
            pointer-events: none !important;
            z-index: 1 !important;
            overflow: visible !important;
        }

        .sun-rays::after {
            content: "" !important;
            position: absolute !important;
            left: 50% !important;
            bottom: -2px !important;
            width: 62px !important;
            height: 18px !important;
            transform: translateX(-50%) !important;
            background: radial-gradient(ellipse at center, rgba(255, 215, 15, 0.30), transparent 72%) !important;
            border-radius: 999px !important;
        }

        .sun-rays .ray {
            position: absolute !important;
            left: 50% !important;
            bottom: 0 !important;
            width: 2px !important;
            border-radius: 999px !important;
            background: linear-gradient(
                to top,
                rgba(255, 215, 15, 0.95) 0%,
                rgba(255, 215, 15, 0.55) 42%,
                rgba(255, 215, 15, 0.00) 100%
            ) !important;
            transform-origin: bottom center !important;
            filter: drop-shadow(0 -1px 3px rgba(255, 215, 15, 0.18)) !important;
        }

        .sun-rays .ray-1 { height: 20px !important; opacity: 0.45 !important; transform: translateX(-50%) rotate(-64deg) !important; }
        .sun-rays .ray-2 { height: 24px; opacity: 0.58 !important; transform: translateX(-50%) rotate(-48deg) !important; }
        .sun-rays .ray-3 { height: 28px; opacity: 0.70 !important; transform: translateX(-50%) rotate(-32deg) !important; }
        .sun-rays .ray-4 { height: 31px; opacity: 0.82 !important; transform: translateX(-50%) rotate(-16deg) !important; }
        .sun-rays .ray-5 { height: 34px; opacity: 1 !important; width: 2.5px !important; transform: translateX(-50%) rotate(0deg) !important; }
        .sun-rays .ray-6 { height: 31px; opacity: 0.82 !important; transform: translateX(-50%) rotate(16deg) !important; }
        .sun-rays .ray-7 { height: 28px; opacity: 0.70 !important; transform: translateX(-50%) rotate(32deg) !important; }
        .sun-rays .ray-8 { height: 24px; opacity: 0.58 !important; transform: translateX(-50%) rotate(48deg) !important; }
        .sun-rays .ray-9 { height: 20px; opacity: 0.45 !important; transform: translateX(-50%) rotate(64deg) !important; }

        /* LOCKED SIDEBAR AND MAIN CONTENT LAYOUT */
        .sidebar {
            background-color: var(--navy) !important;
            width: 280px !important;
            min-width: 280px !important;
            max-width: 280px !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            height: 100% !important;
            z-index: 40 !important;
            transition: transform 0.3s ease !important;
            display: flex !important;
            flex-direction: column !important;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08) !important;
            box-sizing: border-box !important;
        }

        .main-content {
            margin-left: 280px !important;
            transition: margin-left 0.3s ease !important;
            min-height: 100vh !important;
            box-sizing: border-box !important;
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%) !important;
            }
            .sidebar.mobile-open {
                transform: translateX(0) !important;
            }
            .main-content {
                margin-left: 0 !important;
            }
        }

    </style>
</head>
<body>

<!-- ========== SIDEBAR ========== -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <img src="/logo/NatU.png" alt="NU Logo" class="sidebar-logo-img" onerror="this.src='https://placehold.co/45x45/0A1F44/FFD70F?text=NU'">

        <div class="logo-text">
            <h1>
                NU
                <span class="horizon-logo-wrap">
                    <span class="sun-rays" aria-hidden="true">
                        <span class="ray ray-1"></span>
                        <span class="ray ray-2"></span>
                        <span class="ray ray-3"></span>
                        <span class="ray ray-4"></span>
                        <span class="ray ray-5"></span>
                        <span class="ray ray-6"></span>
                        <span class="ray ray-7"></span>
                        <span class="ray ray-8"></span>
                        <span class="ray ray-9"></span>
                    </span>

                    <span class="horizon-word">HORIZON</span>
                </span>
            </h1>

            <p>Student Portal</p>
        </div>
    </div>

    <div style="flex:1; overflow-y: auto;">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>
            <a href="{{ route('student.dashboard') }}" class="nav-item">
                <i class="ri-dashboard-line"></i> Dashboard
            </a>
            <a href="{{ route('student.courses') }}" class="nav-item">
                <i class="ri-book-line"></i> My Courses
            </a>
            <a href="{{ route('student.progress') }}" class="nav-item">
                <i class="ri-bar-chart-line"></i> Progress
            </a>
            <a href="{{ route('student.announcements') }}" class="nav-item">
                <i class="ri-megaphone-line"></i> Announcements
            </a>
            <a href="{{ route('student.notifications') }}" class="nav-item">
                <i class="ri-notification-line"></i> Notifications
            </a>
            <a href="{{ route('student.faculty.evaluation') }}" class="nav-item">
                <i class="ri-star-line"></i> Faculty Evaluation
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Account</div>
            <a href="{{ route('student.profile') }}" class="nav-item active">
                <i class="ri-user-settings-line"></i> Profile
            </a>
        </div>
    </div>

    <div class="sidebar-footer">
        <a href="{{ route('student.profile') }}" class="profile-info" style="text-decoration: none;">
            <div class="avatar">
                <i class="ri-user-line"></i>
            </div>
            <div class="profile-details">
                <p>{{ Auth::user()->name }}</p>
                <span>Student</span>
            </div>
        </a>
        
        <!-- Logout with Confirmation -->
        <button onclick="openLogoutModal()" class="logout-btn">
            <i class="ri-logout-box-r-line"></i> Sign Out
        </button>
    </div>
</aside>

<!-- ========== MAIN CONTENT ========== -->
<div class="main-content" id="mainContent">
    <div class="top-bar">
        <div class="flex items-center gap-3">
            <button class="menu-toggle" id="menuToggle">
                <i class="ri-menu-line"></i>
            </button>
            <div>
                <h2 class="page-title text-lg md:text-xl">My Profile</h2>
                <p class="text-sm text-gray-500">Manage your account information</p>
            </div>
        </div>
    </div>

    <div class="p-4 md:p-6 max-w-7xl mx-auto">
        <!-- Session Messages -->
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl mb-6 flex items-center gap-3 shadow-sm">
                <i class="ri-checkbox-circle-line text-xl text-emerald-600"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-2xl mb-6 shadow-sm">
                <div class="flex items-center gap-2 mb-2">
                    <i class="ri-error-warning-line text-xl text-rose-600"></i>
                    <span class="text-sm font-bold">Please correct the following errors:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 text-xs font-semibold pl-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Profile Card -->
            <div class="lg:col-span-4">
                <div class="dashboard-card p-6 md:p-8 text-center bg-white">
                    <div class="relative inline-block mx-auto">
                        <div class="h-36 w-36 rounded-3xl bg-slate-100 flex items-center justify-center overflow-hidden border-4 border-white shadow-md relative group">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" 
                                     alt="{{ $user->name }}" 
                                     class="h-full w-full object-cover rounded-3xl">
                            @else
                                <div class="w-full h-full bg-gradient-to-tr from-slate-900 to-indigo-950 flex items-center justify-center text-white">
                                    <i class="ri-user-line text-6xl text-yellow-400"></i>
                                </div>
                            @endif
                        </div>
                        <button onclick="document.getElementById('avatarInput').click()" 
                                class="absolute -bottom-2 -right-2 bg-indigo-600 shadow-md hover:bg-indigo-700 text-white p-3 rounded-2xl transition border border-transparent">
                            <i class="ri-camera-line text-lg"></i>
                        </button>
                        <input type="file" id="avatarInput" accept="image/*" class="hidden" onchange="uploadAvatar(this)">
                    </div>

                    <h3 class="text-xl font-bold text-slate-800 mt-6" style="font-family: 'Fraunces', serif;">{{ $user->name }}</h3>
                    <p class="text-slate-500 text-sm font-medium mt-1">{{ $user->email }}</p>
                    
                    <span class="inline-block bg-indigo-50 border border-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-bold mt-4 uppercase tracking-wider">
                        {{ ucfirst($user->role ?? 'Student') }}
                    </span>
                    
                    <p class="text-xs text-slate-400 mt-4 font-semibold">Member since {{ $memberSince ?? '—' }}</p>

                    <!-- Quick Statistics -->
                    <div class="mt-8 pt-8 border-t border-slate-100 grid grid-cols-2 gap-4 text-left">
                        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100/80">
                            <p class="text-[10px] uppercase font-bold text-slate-400">Enrolled Courses</p>
                            <p class="text-2xl font-extrabold text-slate-800 mt-1">{{ $enrolledCourses ?? 0 }}</p>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100/80">
                            <p class="text-[10px] uppercase font-bold text-slate-400">Quizzes Taken</p>
                            <p class="text-2xl font-extrabold text-slate-800 mt-1">{{ $quizzesTaken ?? 0 }}</p>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100/80">
                            <p class="text-[10px] uppercase font-bold text-slate-400">Average Score</p>
                            <p class="text-2xl font-extrabold text-indigo-600 mt-1">{{ $averageScore ?? 0 }}%</p>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100/80">
                            <p class="text-[10px] uppercase font-bold text-slate-400">Materials Completed</p>
                            <p class="text-2xl font-extrabold text-slate-800 mt-1">{{ $completedMaterials ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Forms -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Personal Info -->
                <div class="dashboard-card">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                        <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                            <i class="ri-user-line text-indigo-600 text-lg"></i> 
                            Edit Profile Details
                        </h3>
                    </div>
                    <div class="p-6 md:p-8">
                        <form action="{{ route('student.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Full Name <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" required value="{{ old('name', $user->name) }}"
                                           class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500 bg-slate-50 focus:bg-white text-sm font-semibold text-slate-700 transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email Address <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" required value="{{ old('email', $user->email) }}"
                                           class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500 bg-slate-50 focus:bg-white text-sm font-semibold text-slate-700 transition">
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Phone Number</label>
                                <input type="tel" name="phone" value="{{ old('phone', $user->phone ?? '') }}"
                                       class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500 bg-slate-50 focus:bg-white text-sm font-semibold text-slate-700 transition"
                                       placeholder="+63 912 345 6789">
                            </div>
                            
                            <div class="mt-6">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Bio / About Me</label>
                                <textarea name="bio" rows="4" 
                                          class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:border-indigo-500 bg-slate-50 focus:bg-white text-sm font-semibold text-slate-700 transition"
                                          placeholder="Tell us a little about yourself...">{{ old('bio', $user->bio ?? '') }}</textarea>
                            </div>
                            
                            <div class="flex justify-end mt-8">
                                <button type="submit" 
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm px-6 py-3 rounded-xl transition flex items-center gap-1.5 shadow-md shadow-indigo-100">
                                    <i class="ri-save-line text-base"></i>
                                    Save Profile Info
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Password Info -->
                <div class="dashboard-card">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                        <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                            <i class="ri-lock-line text-indigo-600 text-lg"></i> 
                            Change Account Password
                        </h3>
                    </div>
                    <div class="p-6 md:p-8">
                        <form action="{{ route('student.password.change') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-6">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Current Password</label>
                                <input type="password" name="current_password" required
                                       class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500 bg-slate-50 focus:bg-white text-sm font-semibold text-slate-700 transition">
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">New Password</label>
                                    <input type="password" name="new_password" required
                                           class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500 bg-slate-50 focus:bg-white text-sm font-semibold text-slate-700 transition">
                                    <span class="text-[10px] text-slate-400 mt-1 font-bold block">Must be at least 8 characters long</span>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Confirm New Password</label>
                                    <input type="password" name="new_password_confirmation" required
                                           class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500 bg-slate-50 focus:bg-white text-sm font-semibold text-slate-700 transition">
                                </div>
                            </div>
                            
                            <div class="flex justify-end mt-8">
                                <button type="submit" 
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm px-6 py-3 rounded-xl transition flex items-center gap-1.5 shadow-md shadow-indigo-100">
                                    <i class="ri-lock-password-line text-base"></i>
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Logs -->
        @if(isset($recentActivities) && $recentActivities->count() > 0)
        <div class="mt-8 dashboard-card">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                    <i class="ri-history-line text-indigo-600 text-lg"></i> 
                    My Recent Activity Logs
                </h3>
            </div>
            <div class="p-6 md:p-8">
                <div class="space-y-4">
                    @foreach($recentActivities as $activity)
                        <div class="flex items-start gap-4 p-4 bg-slate-50 border border-slate-100 rounded-2xl">
                            <div class="flex-shrink-0 mt-0.5">
                                @switch($activity->type ?? $activity->action)
                                    @case('course_joined')
                                        <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center"><i class="ri-book-open-line text-base"></i></div>
                                        @break
                                    @case('quiz_submitted')
                                        <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center"><i class="ri-quiz-line text-base"></i></div>
                                        @break
                                    @case('material_completed')
                                        <div class="w-8 h-8 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center"><i class="ri-check-double-line text-base"></i></div>
                                        @break
                                    @default
                                        <div class="w-8 h-8 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center"><i class="ri-information-line text-base"></i></div>
                                @endswitch
                            </div>
                            <div class="flex-1">
                                <p class="text-slate-700 text-sm font-semibold">{{ $activity->description ?? $activity->activity }}</p>
                                <p class="text-[10px] text-slate-400 font-bold mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="text-center mt-6">
                    <a href="{{ route('student.notifications') }}" 
                       class="text-indigo-600 hover:text-indigo-700 font-bold text-xs uppercase tracking-wider inline-flex items-center gap-1">
                        View Complete Log Activities <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </div>
        </div>
        @endif
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

    // Avatar Upload
    function uploadAvatar(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            if (!file.type.match('image.*')) {
                alert('Please select an image file only.');
                return;
            }
            
            if (file.size > 2 * 1024 * 1024) {
                alert('File size must be less than 2MB');
                return;
            }
            
            const formData = new FormData();
            formData.append('avatar', file);
            formData.append('_token', '{{ csrf_token() }}');
            
            const btn = input.previousElementSibling;
            const original = btn.innerHTML;
            btn.innerHTML = `<i class="ri-loader-4-line animate-spin"></i>`;
            btn.disabled = true;
            
            fetch('{{ route('student.avatar.update') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Failed to upload avatar');
                    btn.innerHTML = original;
                    btn.disabled = false;
                }
            })
            .catch(() => {
                alert('Error uploading avatar');
                btn.innerHTML = original;
                btn.disabled = false;
            });
        }
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