<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Edit User - Admin Panel | NU Clicks LMS</title>
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
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .sidebar-logo-img { height: 45px; width: auto; }
        .logo-text h1 { font-size: 1.3rem; font-weight: 800; color: white; letter-spacing: -0.3px; }
        .logo-text span { color: var(--gold); }
        .logo-text p { font-size: 0.7rem; color: rgba(255,255,255,0.7); }

        .nav-section { padding: 0 1rem; margin-top: 1.5rem; }
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
        .nav-item i { font-size: 1.2rem; width: 1.5rem; }
        .nav-item:hover { background: rgba(255,215,15,0.15); color: white; }
        .nav-item.active { background: var(--gold); color: var(--blue-deep); }
        .nav-item.active i { color: var(--blue-deep); }

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
            width: 42px; height: 42px;
            background: rgba(255,215,15,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            flex-shrink: 0;
        }
        .profile-details p { color: white; font-weight: 600; font-size: 0.85rem; }
        .profile-details span { color: rgba(255,255,255,0.6); font-size: 0.7rem; }

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

        /* ===== MAIN CONTENT ===== */
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
        .page-title { font-weight: 700; color: var(--blue-deep); }

        @media (max-width: 1024px) {
            .menu-toggle { display: block; }
            .main-content { margin-left: 0; }
        }

        /* ===== FORM CARD ===== */
        .dashboard-card {
            background: white;
            border-radius: 1.2rem;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(0,0,0,0.03);
            overflow: hidden;
        }

        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--gray-border);
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .card-header i { color: var(--gold); font-size: 1.15rem; }
        .card-header h3 { font-weight: 700; color: #1e293b; font-size: 0.95rem; }

        .form-input {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 0.75rem;
            padding: 0.65rem 1rem;
            font-size: 0.875rem;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: var(--transition);
            background: white;
            color: #1e293b;
        }
        .form-input:focus {
            border-color: var(--blue-deep);
            box-shadow: 0 0 0 3px rgba(10,31,68,0.07);
        }
        .form-label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.4rem;
        }
        .form-hint {
            font-size: 0.72rem;
            color: #9ca3af;
            margin-top: 0.3rem;
        }

        /* Info box (student note) */
        .info-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-size: 0.82rem;
            color: #1d4ed8;
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
        }
        .info-box i { font-size: 1rem; flex-shrink: 0; margin-top: 0.05rem; }

        /* ===== LOGOUT MODAL ===== */
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
        .modal-overlay.active { visibility: visible; opacity: 1; }

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
        .modal-overlay.active .confirmation-modal { transform: scale(1); }

        .modal-header {
            background: var(--blue-deep);
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid var(--gold);
        }
        .modal-header h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .modal-header h3 i { color: var(--gold); }
        .modal-close {
            background: none;
            border: none;
            color: rgba(255,255,255,0.7);
            font-size: 1.6rem;
            cursor: pointer;
            line-height: 1;
        }
        .modal-close:hover { color: var(--gold); }

        .modal-body {
            padding: 1.8rem 1.5rem;
            text-align: center;
            color: #374151;
        }
        .modal-body p:last-child { font-size: 0.78rem; color: #9ca3af; margin-top: 0.5rem; }

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
        .modal-btn-cancel { background: #eef2ff; color: #1e293b; }
        .modal-btn-cancel:hover { background: #e2e8f0; }
        .modal-btn-confirm { background: var(--danger-red); color: white; }
        .modal-btn-confirm:hover { background: var(--danger-dark); }
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
            <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="ri-team-line"></i> Users
            </a>
            <a href="{{ route('admin.users.create') }}" class="nav-item {{ request()->routeIs('admin.users.create') ? 'active' : '' }}">
                <i class="ri-user-add-line"></i> Account Creation
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

    <!-- TOP BAR -->
    <div class="top-bar">
        <button class="menu-toggle" id="menuToggle">
            <i class="ri-menu-line"></i>
        </button>
        <div>
            <h2 class="page-title text-lg md:text-xl">Edit User</h2>
            <p class="text-sm text-gray-500 hidden md:block">{{ $user->name }}</p>
        </div>
        <a href="{{ route('admin.users') }}" class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold transition shadow-sm border border-gray-200 text-gray-700 hover:bg-gray-50">
            <i class="ri-arrow-left-line text-base"></i> Back to Users
        </a>
    </div>

    <!-- PAGE BODY -->
    <div class="p-4 md:p-6 max-w-3xl">

        <!-- Validation Errors -->
        @if($errors->any())
            <div class="mb-5 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                <ul class="list-disc list-inside text-sm space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM CARD: Account Info -->
        <div class="dashboard-card mb-5">
            <div class="card-header">
                <i class="ri-user-settings-line"></i>
                <h3>Account Information</h3>
            </div>
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" id="editUserForm">
                @csrf
                @method('PUT')

                <div class="p-5 space-y-5">

                    <!-- Name + Email -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="form-label">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" required
                                   value="{{ old('name', $user->name) }}"
                                   class="form-input" placeholder="e.g. Juan Dela Cruz">
                        </div>
                        <div>
                            <label class="form-label">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" name="email" required
                                   value="{{ old('email', $user->email) }}"
                                   class="form-input" placeholder="e.g. juan@nu.edu.ph">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="form-label">New Password <span class="text-gray-400 font-normal">(optional)</span></label>
                            <input type="password" name="password" class="form-input" placeholder="Leave blank to keep current">
                            <p class="form-hint">Leave blank to keep the current password.</p>
                        </div>
                        <div>
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-input" placeholder="Re-enter new password">
                        </div>
                    </div>

                    <!-- Role + Status -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="form-label">Role <span class="text-red-500">*</span></label>
                            <select name="role" id="role" required class="form-input">
                                <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>Student</option>
                                <option value="faculty" {{ old('role', $user->role) == 'faculty' ? 'selected' : '' }}>Faculty</option>
                                <option value="admin"   {{ old('role', $user->role) == 'admin'   ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label">Status</label>
                            <select name="status" class="form-input">
                                <option value="active"   {{ old('status', $user->status) == 'active'   ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                </div><!-- /p-5 -->

                <!-- ===== STUDENT FIELDS ===== -->
                <div id="studentFields" class="{{ $user->role == 'student' ? '' : 'hidden' }}">
                    <div class="card-header" style="border-top: 1px solid var(--gray-border);">
                        <i class="ri-graduation-cap-line"></i>
                        <h3>Student Details</h3>
                    </div>
                    <div class="p-5 space-y-5">
                        <div class="info-box">
                            <i class="ri-information-line"></i>
                            <span>A student's section is assigned via join code — no need to set it here.</span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="form-label">Student ID</label>
                                <input type="text" name="student_id"
                                       value="{{ old('student_id', $user->student_id) }}"
                                       class="form-input" placeholder="e.g. 2021-00001">
                            </div>
                            <div>
                                <label class="form-label">Year Level</label>
                                <select name="year_level" class="form-input">
                                    <option value="">Select Year</option>
                                    @for($i = 1; $i <= 6; $i++)
                                        <option value="{{ $i }}" {{ old('year_level', $user->year_level) == $i ? 'selected' : '' }}>
                                            {{ $i }}{{ $i==1?'st':($i==2?'nd':($i==3?'rd':'th')) }} Year
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="form-label">Program</label>
                            <select name="program_id" class="form-input">
                                <option value="">-- Select Program --</option>
                                @foreach($programs ?? [] as $program)
                                    <option value="{{ $program->id }}" {{ old('program_id', $user->program_id) == $program->id ? 'selected' : '' }}>
                                        {{ $program->code }} – {{ $program->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- ===== FACULTY FIELDS ===== -->
                <div id="facultyFields" class="{{ $user->role == 'faculty' ? '' : 'hidden' }}">
                    <div class="card-header" style="border-top: 1px solid var(--gray-border);">
                        <i class="ri-user-star-line"></i>
                        <h3>Faculty Details</h3>
                    </div>
                    <div class="p-5 space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="form-label">Faculty ID</label>
                                <input type="text" name="faculty_id"
                                       value="{{ old('faculty_id', $user->faculty_id) }}"
                                       class="form-input" placeholder="e.g. FAC-2021-001">
                            </div>
                            <div>
                                <label class="form-label">Department</label>
                                <select name="department_id" class="form-input">
                                    <option value="">-- Select Department --</option>
                                    @foreach($departments ?? [] as $dept)
                                        <option value="{{ $dept->id }}" {{ old('department_id', $user->department_id) == $dept->id ? 'selected' : '' }}>
                                            {{ $dept->code }} – {{ $dept->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="form-label">Specialization</label>
                                <input type="text" name="specialization"
                                       value="{{ old('specialization', $user->specialization) }}"
                                       class="form-input" placeholder="e.g. Web Development">
                            </div>
                            <div>
                                <label class="form-label">Qualification</label>
                                <input type="text" name="qualification"
                                       value="{{ old('qualification', $user->qualification) }}"
                                       class="form-input" placeholder="e.g. PhD in Computer Science">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FORM FOOTER -->
                <div class="flex justify-end gap-3 px-5 py-4 border-t border-gray-100 bg-gray-50">
                    <a href="{{ route('admin.users') }}"
                       class="px-5 py-2.5 border border-gray-300 rounded-xl hover:bg-gray-100 text-sm font-medium text-gray-700 transition">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-6 py-2.5 rounded-xl text-sm font-semibold text-white flex items-center gap-2 transition"
                            style="background: var(--blue-deep);">
                        <i class="ri-save-line"></i> Update User
                    </button>
                </div>

            </form>
        </div><!-- /dashboard-card -->

    </div><!-- /p-4 -->
</div><!-- /main-content -->

<!-- ========== LOGOUT MODAL ========== -->
<div id="logoutModal" class="modal-overlay">
    <div class="confirmation-modal">
        <div class="modal-header">
            <h3><i class="ri-logout-box-r-line"></i> Confirm Sign Out</h3>
            <button class="modal-close" onclick="closeLogoutModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to sign out of your account?</p>
            <p>You will be redirected to the login page.</p>
        </div>
        <div class="modal-footer">
            <button class="modal-btn modal-btn-cancel" onclick="closeLogoutModal()">Cancel</button>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="modal-btn modal-btn-confirm">Yes, Sign Out</button>
            </form>
        </div>
    </div>
</div>

<script>
    // ── Mobile sidebar toggle ──
    const menuToggle = document.getElementById('menuToggle');
    const sidebar    = document.getElementById('sidebar');

    if (menuToggle) {
        menuToggle.addEventListener('click', function () {
            sidebar.classList.toggle('mobile-open');
        });
    }
    document.addEventListener('click', function (event) {
        const isMobile = window.innerWidth <= 1024;
        if (isMobile && sidebar.classList.contains('mobile-open')) {
            if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                sidebar.classList.remove('mobile-open');
            }
        }
    });

    // ── Role → toggle student / faculty fields ──
    const roleSelect    = document.getElementById('role');
    const studentFields = document.getElementById('studentFields');
    const facultyFields = document.getElementById('facultyFields');

    function toggleFields() {
        const role = roleSelect.value;
        studentFields.classList.toggle('hidden', role !== 'student');
        facultyFields.classList.toggle('hidden', role !== 'faculty');
    }
    roleSelect.addEventListener('change', toggleFields);

    // ── Logout modal ──
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    document.getElementById('logoutModal').addEventListener('click', function (e) {
        if (e.target === this) closeLogoutModal();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeLogoutModal();
    });
</script>
</body>
</html>