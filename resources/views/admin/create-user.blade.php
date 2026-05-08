<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Account Creation - Admin Panel | NU Clicks LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { corePlugins: { preflight: false } }</script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #F5F7FB; overflow-x: hidden; }
        :root {
            --blue-deep: #0A1F44;
            --gold: #FFD70F;
            --gold-dark: #e5c20c;
            --gray-light: #F8FAFF;
            --gray-border: #E9EDF2;
            --card-shadow: 0 8px 20px rgba(0,0,0,0.05);
            --transition: all 0.25s ease;
            --danger-red: #dc2626;
            --danger-dark: #b91c1c;
        }
        .sidebar {
            background-color: var(--blue-deep);
            width: 280px; position: fixed; top: 0; left: 0;
            height: 100%; z-index: 40;
            transition: transform 0.3s ease; transform: translateX(0);
            display: flex; flex-direction: column;
            box-shadow: 4px 0 20px rgba(0,0,0,0.08);
        }
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.mobile-open { transform: translateX(0); }
            .main-content { margin-left: 0 !important; }
        }
        .sidebar-logo {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,215,15,0.2);
            display: flex; align-items: center; gap: 0.75rem;
        }
        .sidebar-logo img { height: 45px; width: auto; }
        .logo-text h1 { font-size: 1.3rem; font-weight: 800; color: white; }
        .logo-text h1 span { color: var(--gold); }
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
            width: 42px; height: 42px;
            background: rgba(255,215,15,0.2); border-radius: 50%;
            display: flex; align-items: center; justify-content: center; color: var(--gold);
        }
        .profile-details p { color: white; font-weight: 600; font-size: 0.85rem; }
        .profile-details span { color: rgba(255,255,255,0.6); font-size: 0.7rem; }
        .logout-btn {
            width: 100%; background: rgba(220,38,38,0.15); border: none;
            padding: 0.6rem; border-radius: 40px; color: #fca5a5; font-weight: 600;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            cursor: pointer; transition: var(--transition);
        }
        .logout-btn:hover { background: var(--danger-red); color: white; }
        .main-content { margin-left: 280px; min-height: 100vh; }
        .top-bar {
            background: white; padding: 1rem 2rem;
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03); border-bottom: 1px solid var(--gray-border);
            position: sticky; top: 0; z-index: 20;
        }
        .menu-toggle { display: none; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--blue-deep); }
        @media (max-width: 1024px) { .menu-toggle { display: block; } .main-content { margin-left: 0; } }
        .page-title { font-weight: 700; color: var(--blue-deep); }
        /* Tab styles */
        .tab-btn {
            padding: 0.6rem 1.5rem; border-radius: 10px; font-weight: 600;
            font-size: 0.9rem; transition: var(--transition); cursor: pointer;
            border: 2px solid transparent; background: transparent;
        }
        .tab-btn.active {
            background: var(--blue-deep); color: white; border-color: var(--blue-deep);
        }
        .tab-btn:not(.active) {
            color: #6b7280; border-color: #e5e7eb;
        }
        .tab-btn:not(.active):hover { border-color: var(--blue-deep); color: var(--blue-deep); }
        /* Form field styles */
        .form-input {
            width: 100%; border: 1px solid #d1d5db; border-radius: 0.75rem;
            padding: 0.6rem 1rem; font-size: 0.9rem; outline: none; transition: var(--transition);
        }
        .form-input:focus { border-color: var(--blue-deep); }
        .form-label { display: block; font-size: 0.8rem; font-weight: 600; color: #374151; margin-bottom: 0.4rem; }
        /* Logout modal */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(10,31,68,0.75); backdrop-filter: blur(4px);
            z-index: 1000; display: flex; align-items: center; justify-content: center;
            visibility: hidden; opacity: 0; transition: all 0.2s ease;
        }
        .modal-overlay.active { visibility: visible; opacity: 1; }
        .confirmation-modal {
            background: white; max-width: 450px; width: 90%; border-radius: 1.5rem;
            box-shadow: 0 25px 40px rgba(0,0,0,0.2); overflow: hidden;
            transform: scale(0.95); transition: transform 0.2s cubic-bezier(0.2,0.9,0.4,1.1);
        }
        .modal-overlay.active .confirmation-modal { transform: scale(1); }
        .modal-header { background: var(--blue-deep); color: white; padding: 1.5rem; display: flex; align-items: center; justify-content: space-between; }
        .modal-header h3 { font-size: 1.1rem; font-weight: 700; display: flex; align-items: center; gap: 0.5rem; }
        .modal-close { background: none; border: none; color: rgba(255,255,255,0.7); font-size: 1.5rem; cursor: pointer; }
        .modal-body { padding: 1.5rem; color: #374151; }
        .modal-footer { padding: 1rem 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 0.75rem; }
        .modal-btn { padding: 0.5rem 1.5rem; border-radius: 0.75rem; font-weight: 600; font-size: 0.9rem; cursor: pointer; border: none; }
        .modal-btn-cancel { background: #f3f4f6; color: #374151; }
        .modal-btn-confirm { background: var(--danger-red); color: white; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <img src="/logo/NatU.png" alt="NU Logo">
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
            <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <i class="ri-team-line"></i> Users
            </a>
            <a href="{{ route('admin.users.create') }}" class="nav-item active">
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

<!-- MAIN CONTENT -->
<div class="main-content" id="mainContent">
    <div class="top-bar">
        <button class="menu-toggle" id="menuToggle"><i class="ri-menu-line"></i></button>
        <div>
            <h2 class="page-title text-lg md:text-xl">Account Creation</h2>
            <p class="text-sm text-gray-500 hidden md:block">Create individual accounts or bulk import from CSV</p>
        </div>
        <a href="{{ route('admin.users') }}" class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold" style="border: 1px solid #e5e7eb; color: #374151;">
            <i class="ri-arrow-left-line"></i> Back to Users
        </a>
    </div>

    <div class="p-4 md:p-6 max-w-4xl">

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-xl mb-4 flex items-center gap-2">
                <i class="ri-checkbox-circle-line text-green-600"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-xl mb-4 flex items-center gap-2">
                <i class="ri-error-warning-line text-red-600"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif
        @if(session('import_errors') && count(session('import_errors')))
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl px-4 py-3 mb-4 text-yellow-800">
                <p class="font-semibold mb-1">Some rows were skipped:</p>
                <ul class="list-disc ml-5 space-y-1 text-sm">
                    @foreach(session('import_errors') as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Tab Buttons -->
        <div class="flex gap-3 mb-6 bg-white p-2 rounded-xl shadow-sm border border-gray-100 w-fit">
            <button class="tab-btn active" id="tab-single" onclick="switchTab('single')">
                <i class="ri-user-add-line mr-1.5"></i> Create Individual Account
            </button>
            <button class="tab-btn" id="tab-bulk" onclick="switchTab('bulk')">
                <i class="ri-upload-cloud-line mr-1.5"></i> Bulk Import
            </button>
        </div>

        <!-- ========== TAB: SINGLE ACCOUNT ========== -->
        <div id="panel-single">
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow p-6">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    {{-- Role + Status --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="form-label">Role *</label>
                            <select name="role" id="role" required class="form-input bg-white">
                                <option value="student" {{ old('role','student') == 'student' ? 'selected' : '' }}>Student</option>
                                <option value="faculty"  {{ old('role') == 'faculty'  ? 'selected' : '' }}>Faculty</option>
                                <option value="admin"    {{ old('role') == 'admin'    ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label">Status</label>
                            <select name="status" class="form-input bg-white">
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    {{-- Basic info --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="name" required value="{{ old('name') }}" class="form-input">
                        </div>
                        <div>
                            <label class="form-label">Email Address *</label>
                            <input type="email" name="email" required value="{{ old('email') }}" class="form-input">
                        </div>
                    </div>

                    {{-- ===== STUDENT FIELDS ===== --}}
                    <div id="studentFields">
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-5">
                            <p class="text-sm text-blue-700"><i class="ri-information-line mr-1"></i>
                            <strong>No password needed.</strong> Initial password = <strong>Student ID</strong>. Student must change it on first login via OTP email.</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                            <div>
                                <label class="form-label">Student ID *</label>
                                <input type="text" name="student_id" value="{{ old('student_id') }}" class="form-input" placeholder="e.g. 2024-0001">
                                <p class="text-xs text-gray-500 mt-1">This will be the initial password.</p>
                            </div>
                            <div>
                                <label class="form-label">Year Level</label>
                                <select name="year_level" class="form-input bg-white">
                                    <option value="">Select Year</option>
                                    @for($i = 1; $i <= 6; $i++)
                                        <option value="{{ $i }}" {{ old('year_level') == $i ? 'selected' : '' }}>{{ $i }}{{ $i==1?'st':($i==2?'nd':($i==3?'rd':'th')) }} Year</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="form-label">Program *</label>
                            <select name="program_id" class="form-input bg-white">
                                <option value="">-- Select Program --</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>{{ $program->code }} – {{ $program->name }}</option>
                                @endforeach
                            </select>
                            @if($programs->isEmpty())
                                <p class="text-xs text-red-500 mt-1">No programs yet. <a href="{{ route('admin.programs') }}" class="underline">Create one first.</a></p>
                            @endif
                            <p class="text-xs text-gray-500 mt-1">Section is assigned when student enters a join code from their faculty.</p>
                        </div>
                    </div>

                    {{-- ===== FACULTY FIELDS ===== --}}
                    <div id="facultyFields" class="hidden">
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-5">
                            <p class="text-sm text-green-700"><i class="ri-information-line mr-1"></i>
                            <strong>No password needed.</strong> Initial password = <strong>Faculty ID</strong>. Faculty must change it on first login via OTP email.</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                            <div>
                                <label class="form-label">Faculty ID *</label>
                                <input type="text" name="faculty_id" value="{{ old('faculty_id') }}" class="form-input" placeholder="e.g. FAC-001">
                                <p class="text-xs text-gray-500 mt-1">This will be the initial password.</p>
                            </div>
                            <div>
                                <label class="form-label">Department <span class="text-gray-400 font-normal">(optional)</span></label>
                                <select name="department_id" class="form-input bg-white">
                                    <option value="">-- Select Department --</option>
                                    @foreach($departments ?? [] as $dept)
                                        <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->code }} – {{ $dept->name }}</option>
                                    @endforeach
                                </select>
                                @if(isset($departments) && $departments->isEmpty())
                                    <p class="text-xs text-gray-400 mt-1">No departments yet. <a href="{{ route('admin.departments') }}" class="underline text-blue-500">Create one.</a></p>
                                @endif
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                            <div>
                                <label class="form-label">Specialization <span class="text-gray-400 font-normal">(optional)</span></label>
                                <input type="text" name="specialization" value="{{ old('specialization') }}" class="form-input" placeholder="e.g. Software Engineering">
                            </div>
                            <div>
                                <label class="form-label">Qualification <span class="text-gray-400 font-normal">(optional)</span></label>
                                <input type="text" name="qualification" value="{{ old('qualification') }}" class="form-input" placeholder="e.g. Master's in CS">
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mb-5"><i class="ri-information-line"></i> Assign subjects to this faculty after creation via <a href="{{ route('admin.faculty') }}" class="text-blue-600 underline">Faculty Management</a>.</p>
                    </div>

                    {{-- ===== ADMIN FIELDS ===== --}}
                    <div id="adminFields" class="hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                            <div>
                                <label class="form-label">Password *</label>
                                <input type="password" name="password" class="form-input">
                                <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
                            </div>
                            <div>
                                <label class="form-label">Confirm Password *</label>
                                <input type="password" name="password_confirmation" class="form-input">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.users') }}" class="px-5 py-2.5 border border-gray-300 rounded-xl hover:bg-gray-50 text-sm font-medium">Cancel</a>
                        <button type="submit" class="px-6 py-2.5 rounded-xl text-sm font-semibold text-white" style="background: var(--blue-deep);">Create Account</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ========== TAB: BULK IMPORT ========== -->
        <div id="panel-bulk" class="hidden">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-1">Upload CSV File</h2>
                    <p class="text-sm text-gray-500 mb-5">Select account type, download the template, fill it in, then import.</p>

                    <form method="POST" action="{{ route('admin.bulk-import.process') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5">
                            <label class="form-label">Account Type</label>
                            <div class="grid grid-cols-2 gap-4 mt-1">
                                <label class="cursor-pointer border-2 border-transparent rounded-xl p-4 hover:border-blue-300 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50">
                                    <input type="radio" name="type" value="students" checked class="mr-2">
                                    <span class="font-semibold text-sm">Students</span>
                                    <p class="text-xs text-gray-500 mt-1">Initial password = Student ID</p>
                                </label>
                                <label class="cursor-pointer border-2 border-transparent rounded-xl p-4 hover:border-yellow-300 has-[:checked]:border-yellow-500 has-[:checked]:bg-yellow-50">
                                    <input type="radio" name="type" value="faculty" class="mr-2">
                                    <span class="font-semibold text-sm">Faculty</span>
                                    <p class="text-xs text-gray-500 mt-1">Initial password = Faculty ID</p>
                                </label>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label">CSV File</label>
                            <input type="file" name="file" accept=".csv,.txt" required
                                   class="w-full border rounded-xl px-4 py-2.5 bg-gray-50 text-sm mt-1">
                            <p class="text-xs text-gray-500 mt-1">Accepted: .csv or .txt</p>
                        </div>

                        <button type="submit" class="px-6 py-2.5 rounded-xl text-sm font-semibold text-white" style="background: var(--blue-deep);">
                            <i class="ri-upload-cloud-line mr-1"></i> Import Accounts
                        </button>
                    </form>
                </div>

                <div class="space-y-4">
                    <div class="bg-white rounded-2xl shadow p-5">
                        <h3 class="font-bold text-gray-900 mb-3 text-sm">Download Templates</h3>
                        <div class="space-y-2">
                            <a href="{{ route('admin.bulk-import.template', ['type' => 'students']) }}"
                               class="block text-center px-4 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700">
                               <i class="ri-download-line mr-1"></i> Students Template
                            </a>
                            <a href="{{ route('admin.bulk-import.template', ['type' => 'faculty']) }}"
                               class="block text-center px-4 py-2.5 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700">
                               <i class="ri-download-line mr-1"></i> Faculty Template
                            </a>
                        </div>
                    </div>

                    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5">
                        <h3 class="font-bold text-amber-800 text-sm mb-2">Important Notes</h3>
                        <ul class="text-xs text-amber-700 space-y-1 list-disc ml-4">
                            <li>Do not add password columns</li>
                            <li>Students use Student ID as initial password</li>
                            <li>Faculty use Faculty ID as initial password</li>
                            <li>Users must change password on first login</li>
                            <li>Program code must exist in Programs table</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- CSV Format Guide -->
            <div class="bg-white rounded-2xl shadow p-6 mt-5">
                <h3 class="font-bold text-gray-900 mb-4">CSV Format Guide</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="border rounded-xl p-4">
                        <h4 class="font-bold text-blue-700 text-sm mb-2">Students CSV</h4>
                        <code class="block bg-gray-100 p-3 rounded-lg text-xs mb-2">name,email,student_id,year_level,section,program_code</code>
                        <p class="text-xs text-gray-500 mb-1">Example:</p>
                        <code class="block bg-gray-100 p-3 rounded-lg text-xs">Juan Dela Cruz,juan@nu.edu,2024-0001,1,A,BSCS</code>
                    </div>
                    <div class="border rounded-xl p-4">
                        <h4 class="font-bold text-emerald-700 text-sm mb-2">Faculty CSV</h4>
                        <code class="block bg-gray-100 p-3 rounded-lg text-xs mb-2">name,email,faculty_id,department,specialization</code>
                        <p class="text-xs text-gray-500 mb-1">Example:</p>
                        <code class="block bg-gray-100 p-3 rounded-lg text-xs">Maria Santos,maria@nu.edu,FAC-001,CCS,Software Engineering</code>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- LOGOUT MODAL -->
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
        menuToggle.addEventListener('click', () => sidebar.classList.toggle('mobile-open'));
    }
    document.addEventListener('click', e => {
        if (window.innerWidth <= 1024 && sidebar.classList.contains('mobile-open')) {
            if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                sidebar.classList.remove('mobile-open');
            }
        }
    });

    // Role field toggles
    const roleSelect    = document.getElementById('role');
    const studentFields = document.getElementById('studentFields');
    const facultyFields = document.getElementById('facultyFields');
    const adminFields   = document.getElementById('adminFields');

    function toggleFields() {
        const role = roleSelect.value;
        studentFields.classList.toggle('hidden', role !== 'student');
        facultyFields.classList.toggle('hidden', role !== 'faculty');
        adminFields.classList.toggle('hidden',   role !== 'admin');
    }
    roleSelect.addEventListener('change', toggleFields);
    toggleFields();

    // Tab switching
    function switchTab(tab) {
        const tabs = ['single', 'bulk'];
        tabs.forEach(t => {
            document.getElementById(`panel-${t}`).classList.toggle('hidden', t !== tab);
            const btn = document.getElementById(`tab-${t}`);
            btn.classList.toggle('active', t === tab);
        });
    }

    // Check if we should open bulk tab (e.g. redirected from old bulk-import route)
    const urlParams = new URLSearchParams(window.location.search);
    @if(session('tab') === 'bulk')
    switchTab('bulk');
    @endif

    // Logout modal
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    document.getElementById('logoutModal').addEventListener('click', e => {
        if (e.target === document.getElementById('logoutModal')) closeLogoutModal();
    });
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeLogoutModal();
    });
</script>
</body>
</html>