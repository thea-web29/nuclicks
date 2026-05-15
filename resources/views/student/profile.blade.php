<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>My Profile - NU Clicks LMS</title>
    
    <!-- Google Fonts + Remix Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
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

        /* Sidebar - Fully Consistent */
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

        .dashboard-card {
            background: white;
            border-radius: 1.2rem;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(0,0,0,0.03);
            overflow: hidden;
        }
    </style>
</head>
<body>

<!-- ========== SIDEBAR ========== -->
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
            </a>
            <a href="{{ route('student.faculty.evaluation') }}" class="nav-item {{ request()->routeIs('student.faculty.evaluation') ? 'active' : '' }}">
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
        <div class="profile-info">
            <div class="avatar">
                <i class="ri-user-line"></i>
            </div>
            <div class="profile-details">
                <p>{{ Auth::user()->name }}</p>
                <span>Student</span>
            </div>
        </div>
        
        <!-- Logout with Confirmation -->
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
        <div>
            <h2 class="page-title text-lg md:text-xl">My Profile</h2>
            <p class="text-sm text-gray-500">Manage your account information</p>
        </div>
    </div>

    <div class="p-4 md:p-6">
        <!-- Session Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-5 py-4 rounded-2xl mb-6 flex items-center gap-3">
                <i class="ri-check-line text-xl"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-5 py-4 rounded-2xl mb-6">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Profile Sidebar Card -->
            <div class="lg:col-span-4">
                <div class="dashboard-card p-8 text-center">
                    <div class="relative inline-block mx-auto">
                        <div class="h-40 w-40 rounded-3xl bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center overflow-hidden border-4 border-white shadow-inner">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" 
                                     alt="{{ $user->name }}" 
                                     class="h-full w-full object-cover rounded-3xl">
                            @else
                                <i class="ri-user-line text-8xl text-blue-500"></i>
                            @endif
                        </div>
                        <button onclick="document.getElementById('avatarInput').click()" 
                                class="absolute -bottom-2 -right-2 bg-white shadow-md hover:bg-gray-50 text-blue-600 p-3 rounded-2xl border border-gray-200 transition">
                            <i class="ri-camera-line text-xl"></i>
                        </button>
                        <input type="file" id="avatarInput" accept="image/*" class="hidden" onchange="uploadAvatar(this)">
                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mt-6">{{ $user->name }}</h3>
                    <p class="text-gray-600">{{ $user->email }}</p>
                    <p class="text-sm text-gray-500 mt-1">Student • {{ ucfirst($user->role ?? 'Student') }}</p>
                    <p class="text-xs text-gray-400 mt-4">Member since {{ $memberSince ?? '—' }}</p>

                    <!-- Quick Stats -->
                    <div class="mt-8 pt-8 border-t grid grid-cols-2 gap-6 text-left">
                        <div>
                            <p class="text-xs text-gray-500">Courses Enrolled</p>
                            <p class="text-3xl font-bold text-blue-600">{{ $enrolledCourses ?? 0 }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Quizzes Taken</p>
                            <p class="text-3xl font-bold text-green-600">{{ $quizzesTaken ?? 0 }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Avg. Score</p>
                            <p class="text-3xl font-bold text-purple-600">{{ $averageScore ?? 0 }}%</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Materials Done</p>
                            <p class="text-3xl font-bold text-orange-600">{{ $completedMaterials ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Profile & Password -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Edit Profile -->
                <div class="dashboard-card">
                    <div class="px-8 py-6 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <i class="ri-user-line" style="color: var(--gold);"></i> 
                            Edit Profile Information
                        </h3>
                    </div>
                    <div class="p-8">
                        <form action="{{ route('student.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" required value="{{ old('name', $user->name) }}"
                                           class="w-full border border-gray-300 rounded-2xl px-5 py-3 focus:outline-none focus:border-blue-500 transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" required value="{{ old('email', $user->email) }}"
                                           class="w-full border border-gray-300 rounded-2xl px-5 py-3 focus:outline-none focus:border-blue-500 transition">
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" name="phone" value="{{ old('phone', $user->phone ?? '') }}"
                                       class="w-full border border-gray-300 rounded-2xl px-5 py-3 focus:outline-none focus:border-blue-500 transition"
                                       placeholder="+63 912 345 6789">
                            </div>
                            
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bio / About Me</label>
                                <textarea name="bio" rows="4" 
                                          class="w-full border border-gray-300 rounded-3xl px-5 py-3 focus:outline-none focus:border-blue-500 transition"
                                          placeholder="Tell us a little about yourself...">{{ old('bio', $user->bio ?? '') }}</textarea>
                            </div>
                            
                            <div class="flex justify-end mt-8">
                                <button type="submit" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-2xl font-medium transition flex items-center gap-2">
                                    <i class="ri-save-line"></i>
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Change Password -->
                <div class="dashboard-card">
                    <div class="px-8 py-6 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <i class="ri-lock-line" style="color: var(--gold);"></i> 
                            Change Password
                        </h3>
                    </div>
                    <div class="p-8">
                        <form action="{{ route('student.password.change') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                <input type="password" name="current_password" required
                                       class="w-full border border-gray-300 rounded-2xl px-5 py-3 focus:outline-none focus:border-blue-500 transition">
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                    <input type="password" name="new_password" required
                                           class="w-full border border-gray-300 rounded-2xl px-5 py-3 focus:outline-none focus:border-blue-500 transition">
                                    <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                                    <input type="password" name="new_password_confirmation" required
                                           class="w-full border border-gray-300 rounded-2xl px-5 py-3 focus:outline-none focus:border-blue-500 transition">
                                </div>
                            </div>
                            
                            <div class="flex justify-end mt-8">
                                <button type="submit" 
                                        class="bg-amber-600 hover:bg-amber-700 text-white px-8 py-3 rounded-2xl font-medium transition flex items-center gap-2">
                                    <i class="ri-lock-password-line"></i>
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        @if(isset($recentActivities) && $recentActivities->count() > 0)
        <div class="mt-8 dashboard-card">
            <div class="px-8 py-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <i class="ri-history-line" style="color: var(--gold);"></i> 
                    Recent Activity
                </h3>
            </div>
            <div class="p-8">
                <div class="space-y-4">
                    @foreach($recentActivities as $activity)
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-2xl">
                            <div class="flex-shrink-0 mt-0.5">
                                @switch($activity->type ?? $activity->action)
                                    @case('course_joined')
                                        <i class="ri-book-open-line text-green-600 text-xl"></i>
                                        @break
                                    @case('quiz_submitted')
                                        <i class="ri-quiz-line text-blue-600 text-xl"></i>
                                        @break
                                    @case('material_completed')
                                        <i class="ri-check-double-line text-emerald-600 text-xl"></i>
                                        @break
                                    @default
                                        <i class="ri-information-line text-gray-600 text-xl"></i>
                                @endswitch
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-700">{{ $activity->description ?? $activity->activity }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-6">
                    <a href="{{ route('student.notifications') }}" 
                       class="text-blue-600 hover:text-blue-700 font-medium text-sm inline-flex items-center gap-1">
                        View All Activity in Notifications →
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