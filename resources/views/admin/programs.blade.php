<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programs - Admin Panel | NU Clicks LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #F5F7FB; overflow-x: hidden; }
        :root {
            --blue-deep: #0A1F44;
            --gold: #FFD70F;
            --gold-dark: #e5c20c;
            --gray-border: #E9EDF2;
            --danger-red: #dc2626;
            --danger-dark: #b91c1c;
            --transition: all 0.25s ease;
        }
        .sidebar {
            background-color: var(--blue-deep);
            width: 280px; position: fixed; top: 0; left: 0; height: 100%;
            z-index: 40; display: flex; flex-direction: column;
            box-shadow: 4px 0 20px rgba(0,0,0,0.08);
        }
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.mobile-open { transform: translateX(0); }
            .main-content { margin-left: 0 !important; }
        }
        .sidebar-logo {
            padding: 1.5rem; border-bottom: 1px solid rgba(255,215,15,0.2);
            display: flex; align-items: center; gap: 0.75rem;
        }
        .sidebar-logo-img { height: 45px; width: auto; }
        .logo-text h1 { font-size: 1.3rem; font-weight: 800; color: white; letter-spacing: -0.3px; }
        .logo-text h1 span { color: var(--gold); }
        .logo-text p { font-size: 0.7rem; color: rgba(255,255,255,0.7); }
        .nav-section { padding: 0 1rem; margin-top: 1.5rem; }
        .nav-section-title { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,215,15,0.6); margin-bottom: 0.75rem; font-weight: 600; }
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
        .sidebar-footer { margin-top: auto; padding: 1.2rem; border-top: 1px solid rgba(255,215,15,0.2); }
        .logout-btn {
            width: 100%; background: rgba(220,38,38,0.15); border: none; padding: 0.6rem;
            border-radius: 40px; color: #fca5a5; font-weight: 600;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            cursor: pointer; transition: var(--transition);
        }
        .logout-btn:hover { background: var(--danger-red); color: white; }
        .main-content { margin-left: 280px; transition: margin-left 0.3s ease; min-height: 100vh; }
        .top-bar {
            background: white; padding: 1rem 2rem;
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03); border-bottom: 1px solid var(--gray-border);
            position: sticky; top: 0; z-index: 20;
        }
        .menu-toggle { display: none; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--blue-deep); }
        @media (max-width: 1024px) { .menu-toggle { display: block; } .main-content { margin-left: 0; } }
        .btn-icon { transition: var(--transition); }
        .btn-icon:hover { transform: translateY(-1px); }
        
        /* Modern Modal Styles (matching Faculty page design) */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(10,31,68,0.75); backdrop-filter: blur(4px);
            z-index: 1000; display: flex; align-items: center; justify-content: center;
            visibility: hidden; opacity: 0; transition: all 0.2s ease;
        }
        .modal-overlay.active { visibility: visible; opacity: 1; }
        .modal-box {
            background: white; width: 90%; max-width: 600px; border-radius: 1.5rem;
            box-shadow: 0 25px 40px rgba(0,0,0,0.2); overflow: hidden;
            transform: scale(0.95); transition: transform 0.2s cubic-bezier(0.2,0.9,0.4,1.1);
        }
        .modal-overlay.active .modal-box { transform: scale(1); }
        .modal-header {
            background: var(--blue-deep); padding: 1.25rem 1.5rem;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 2px solid var(--gold);
        }
        .modal-header h3 {
            font-size: 1.1rem; font-weight: 700; color: white;
            display: flex; align-items: center; gap: 0.5rem;
        }
        .modal-header h3 i { color: var(--gold); }
        .modal-close {
            background: none; border: none; color: rgba(255,255,255,0.7);
            font-size: 1.6rem; cursor: pointer; transition: var(--transition);
        }
        .modal-close:hover { color: var(--gold); }
        .badge {
            display: inline-flex; align-items: center; padding: 0.2rem 0.6rem;
            border-radius: 9999px; font-size: 0.7rem; font-weight: 600;
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 2px rgba(255,215,15,0.2);
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
        <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1rem;">
            <div style="width:42px;height:42px;background:rgba(255,215,15,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--gold);">
                <i class="ri-user-line"></i>
            </div>
            <div>
                <p style="color:white;font-weight:600;font-size:0.85rem;">{{ Auth::user()->name ?? 'Admin User' }}</p>
                <span style="color:rgba(255,255,255,0.6);font-size:0.7rem;">{{ Auth::user()->email ?? 'admin@nuclicks.edu' }}</span>
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
            <h2 style="font-weight:700;color:var(--blue-deep);font-size:1.1rem;">Program Management</h2>
            <p class="text-sm text-gray-500 hidden md:block">Manage degree programs (BSCS, BSIT, etc.)</p>
        </div>
        <button onclick="openCreateModal()" class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold transition shadow-sm" style="background: var(--blue-deep); color: white;">
            <i class="ri-add-line text-base"></i> Add Program
        </button>
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

        <!-- Programs Table (modern card style) -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Code</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Program Name</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Subjects</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Students</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($programs as $program)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold" style="background:rgba(10,31,68,0.1);color:var(--blue-deep);">
                                        {{ $program->code }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $program->name }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">{{ Str::limit($program->description, 60) ?: '—' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                        {{ $program->subjects_count ?? 0 }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        {{ $program->students_count ?? 0 }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="editProgram({{ $program->id }})" class="text-yellow-600 hover:text-yellow-800 btn-icon" title="Edit">
                                        <i class="ri-edit-line text-lg"></i>
                                    </button>
                                    <button onclick="deleteProgram({{ $program->id }}, '{{ addslashes($program->name) }}')" class="text-red-600 hover:text-red-800 btn-icon" title="Delete">
                                        <i class="ri-delete-bin-line text-lg"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <i class="ri-graduation-cap-line text-6xl text-gray-300 mb-4 block"></i>
                                    No programs yet.
                                    <button onclick="openCreateModal()" class="ml-2 text-indigo-600 hover:text-indigo-800 font-medium">Add your first program</button>
                                </tr>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ========== MODERN PROGRAM MODAL (MATCHING FACULTY UI DESIGN) ========== -->
<div id="programModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h3>
                <i class="ri-graduation-cap-line"></i> 
                <span id="modalTitle">Add Program</span>
            </h3>
            <button class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="p-6">
            <p class="text-sm text-gray-500 mb-4" id="modalSubtext">Fill in the program details below.</p>
            <form id="programForm">
                @csrf
                <input type="hidden" id="programId" name="program_id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Program Code <span class="text-red-500">*</span></label>
                        <input type="text" id="progCode" name="code" required maxlength="20"
                               class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-300 uppercase transition"
                               placeholder="e.g. BSCS">
                        <p class="text-xs text-gray-500 mt-1">Short unique code (auto-uppercased)</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Program Name <span class="text-red-500">*</span></label>
                        <input type="text" id="progName" name="name" required
                               class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-300 transition"
                               placeholder="e.g. BS Computer Science">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                    <textarea id="progDescription" name="description" rows="3"
                              class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-300 transition"
                              placeholder="Brief description of this degree program..."></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeModal()" class="px-5 py-2.5 border border-gray-300 rounded-xl hover:bg-gray-50 transition text-sm font-medium">Cancel</button>
                    <button type="submit" id="submitBtn" class="px-6 py-2.5 rounded-xl text-sm font-semibold transition shadow-sm" style="background: var(--blue-deep); color: white;">Save Program</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Logout Confirmation Modal (matching faculty modal style) -->
<div id="logoutModal" class="modal-overlay">
    <div class="modal-box" style="max-width:450px;">
        <div class="modal-header">
            <h3><i class="ri-logout-box-r-line"></i> Confirm Sign Out</h3>
            <button class="modal-close" onclick="closeLogoutModal()">&times;</button>
        </div>
        <div style="padding:1.8rem 1.5rem;text-align:center;">
            <p>Are you sure you want to sign out of your account?</p>
            <p class="text-xs text-gray-500 mt-2">You will be redirected to the login page.</p>
        </div>
        <div style="padding:1rem 1.5rem 1.5rem;display:flex;gap:.75rem;justify-content:flex-end;background:#f9fafb;border-top:1px solid var(--gray-border);">
            <button onclick="closeLogoutModal()" style="padding:.6rem 1.25rem;border-radius:40px;background:#eef2ff;color:#1e293b;border:none;font-weight:600;cursor:pointer;">Cancel</button>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" style="padding:.6rem 1.25rem;border-radius:40px;background:#dc2626;color:white;border:none;font-weight:600;cursor:pointer;">Yes, Sign Out</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Mobile sidebar toggle
    const menuToggle = document.getElementById('menuToggle');
    const sidebar    = document.getElementById('sidebar');
    if (menuToggle) {
        menuToggle.addEventListener('click', () => sidebar.classList.toggle('mobile-open'));
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

    // Modal controls (matching faculty style)
    function openCreateModal() {
        document.getElementById('modalTitle').innerText = 'Add Program';
        document.getElementById('modalSubtext').innerText = 'Fill in the program details below.';
        document.getElementById('programForm').reset();
        document.getElementById('programId').value = '';
        document.getElementById('submitBtn').innerText = 'Save Program';
        document.getElementById('programModal').classList.add('active');
        document.body.style.overflow = 'hidden';
        const codeInput = document.getElementById('progCode');
        if (codeInput) codeInput.value = '';
    }

    function closeModal() {
        document.getElementById('programModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    // Enhanced editProgram with modern modal & data fetching
    function editProgram(id) {
        fetch(`/admin/programs/${id}/data`, {
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                document.getElementById('modalTitle').innerText = 'Edit Program';
                document.getElementById('modalSubtext').innerText = 'Modify program information below.';
                document.getElementById('programId').value = data.program.id;
                document.getElementById('progCode').value = data.program.code;
                document.getElementById('progName').value = data.program.name;
                document.getElementById('progDescription').value = data.program.description || '';
                document.getElementById('submitBtn').innerText = 'Update Program';
                document.getElementById('programModal').classList.add('active');
                document.body.style.overflow = 'hidden';
            } else {
                alert(data.message || 'Failed to load program data');
            }
        })
        .catch(e => alert('Error loading program: ' + e.message));
    }

    // Delete program with confirmation
    function deleteProgram(id, name) {
        if (!confirm(`Delete program "${name}"?\n\nThis will NOT delete subjects or students assigned to this program, but they will lose their program assignment.`)) return;

        fetch(`/admin/programs/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) location.reload();
            else alert(data.message || 'Error deleting program');
        })
        .catch(e => alert('Error: ' + e.message));
    }

    // Form submission handler (Create + Update)
    document.getElementById('programForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const id  = document.getElementById('programId').value;
        const url = id ? `/admin/programs/${id}` : '/admin/programs';

        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        if (id) formData.append('_method', 'PUT');
        
        let codeVal = document.getElementById('progCode').value.trim();
        codeVal = codeVal.toUpperCase();
        formData.append('code', codeVal);
        formData.append('name', document.getElementById('progName').value.trim());
        formData.append('description', document.getElementById('progDescription').value.trim());

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                let errorMsg = data.message || 'Error saving program';
                if (data.errors) {
                    const errs = Object.values(data.errors).flat();
                    errorMsg = errs.join('\n');
                }
                alert(errorMsg);
            }
        })
        .catch(e => alert('Error: ' + e.message));
    });

    // Close modal when clicking outside (matching faculty pattern)
    const modalOverlay = document.getElementById('programModal');
    modalOverlay.addEventListener('click', function(e) {
        if (e.target === modalOverlay) closeModal();
    });

    // Auto uppercase on code field
    const codeInputField = document.getElementById('progCode');
    if (codeInputField) {
        codeInputField.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    }

    // Logout modal functions
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    document.getElementById('logoutModal').addEventListener('click', function(e) {
        if (e.target === document.getElementById('logoutModal')) closeLogoutModal();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (document.getElementById('programModal').classList.contains('active')) closeModal();
            if (document.getElementById('logoutModal').classList.contains('active')) closeLogoutModal();
        }
    });
</script>
</body>
</html>