<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Management - Admin Panel | NU Clicks LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background:#F5F7FB; }
        :root { --blue-deep:#0A1F44; --gold:#FFD70F; --danger-red:#dc2626; --gray-border:#E9EDF2; --transition:all 0.25s ease; }
        .sidebar { background:var(--blue-deep); width:280px; position:fixed; top:0; left:0; height:100%; z-index:40; display:flex; flex-direction:column; box-shadow:4px 0 20px rgba(0,0,0,.08); }
        @media(max-width:1024px){ .sidebar{transform:translateX(-100%)} .sidebar.mobile-open{transform:translateX(0)} .main-content{margin-left:0!important} }
        .sidebar-logo { padding:1.5rem; border-bottom:1px solid rgba(255,215,15,.2); display:flex; align-items:center; gap:.75rem; }
        .sidebar-logo img { height:45px; }
        .logo-text h1 { font-size:1.3rem; font-weight:800; color:white; }
        .logo-text h1 span { color:var(--gold); }
        .logo-text p { font-size:.7rem; color:rgba(255,255,255,.7); }
        .nav-section { padding:0 1rem; margin-top:1.5rem; }
        .nav-section-title { font-size:.7rem; text-transform:uppercase; letter-spacing:1px; color:rgba(255,215,15,.6); margin-bottom:.75rem; font-weight:600; }
        .nav-item { display:flex; align-items:center; gap:.75rem; padding:.7rem 1rem; border-radius:12px; color:rgba(255,255,255,.85); transition:var(--transition); margin-bottom:.25rem; font-weight:500; text-decoration:none; }
        .nav-item i { font-size:1.2rem; width:1.5rem; }
        .nav-item:hover { background:rgba(255,215,15,.15); color:white; }
        .nav-item.active { background:var(--gold); color:var(--blue-deep); }
        .nav-item.active i { color:var(--blue-deep); }
        .sidebar-footer { margin-top:auto; padding:1.2rem; border-top:1px solid rgba(255,215,15,.2); }
        .logout-btn { width:100%; background:rgba(220,38,38,.15); border:none; padding:.6rem; border-radius:40px; color:#fca5a5; font-weight:600; display:flex; align-items:center; justify-content:center; gap:.5rem; cursor:pointer; transition:var(--transition); }
        .logout-btn:hover { background:var(--danger-red); color:white; }
        .main-content { margin-left:280px; min-height:100vh; }
        .top-bar { background:white; padding:1rem 2rem; display:flex; align-items:center; justify-content:space-between; box-shadow:0 2px 8px rgba(0,0,0,.03); border-bottom:1px solid var(--gray-border); position:sticky; top:0; z-index:20; }
        .menu-toggle { display:none; background:none; border:none; font-size:1.5rem; cursor:pointer; color:var(--blue-deep); }
        @media(max-width:1024px){ .menu-toggle{display:block} .main-content{margin-left:0} }
        .modal-overlay { position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(10,31,68,.75); backdrop-filter:blur(4px); z-index:1000; display:flex; align-items:center; justify-content:center; visibility:hidden; opacity:0; transition:all .2s; }
        .modal-overlay.active { visibility:visible; opacity:1; }
        .modal-box { background:white; width:90%; max-width:600px; border-radius:1.5rem; box-shadow:0 25px 40px rgba(0,0,0,.2); overflow:hidden; transform:scale(.95); transition:transform .2s cubic-bezier(.2,.9,.4,1.1); }
        .modal-overlay.active .modal-box { transform:scale(1); }
        .modal-header { background:var(--blue-deep); padding:1.25rem 1.5rem; display:flex; align-items:center; justify-content:space-between; border-bottom:2px solid var(--gold); }
        .modal-header h3 { font-size:1.1rem; font-weight:700; color:white; display:flex; align-items:center; gap:.5rem; }
        .modal-header h3 i { color:var(--gold); }
        .modal-close { background:none; border:none; color:rgba(255,255,255,.7); font-size:1.6rem; cursor:pointer; }
        .modal-close:hover { color:var(--gold); }
        .course-checkbox-list { max-height:320px; overflow-y:auto; border:1px solid var(--gray-border); border-radius:.75rem; }
        .course-item { display:flex; align-items:center; gap:.75rem; padding:.75rem 1rem; border-bottom:1px solid #f1f5f9; cursor:pointer; transition:background .15s; }
        .course-item:last-child { border-bottom:none; }
        .course-item:hover { background:#f8faff; }
        .course-item input[type=checkbox] { width:1.1rem; height:1.1rem; accent-color:var(--blue-deep); cursor:pointer; }
        .badge { display:inline-flex; align-items:center; padding:.2rem .6rem; border-radius:9999px; font-size:.7rem; font-weight:600; }
    </style>
</head>
<body>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <img src="/logo/NatU.png" alt="NU Logo">
        <div class="logo-text">
            <h1>NU <span>CLICKS</span> LMS</h1>
            <p>Admin Portal</p>
        </div>
    </div>
        <div style="flex:1;overflow-y:auto;">
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
            <div class="nav-section-title">Assessment</div>
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
        <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1rem;">
            <div style="width:42px;height:42px;background:rgba(255,215,15,.2);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--gold);"><i class="ri-user-line"></i></div>
            <div>
                <p style="color:white;font-weight:600;font-size:.85rem;">{{ Auth::user()->name }}</p>
                <span style="color:rgba(255,255,255,.6);font-size:.7rem;">{{ Auth::user()->email }}</span>
            </div>
        </div>
        <button onclick="openLogoutModal()" class="logout-btn"><i class="ri-logout-box-line"></i> Logout</button>
    </div>
</aside>

<div class="main-content" id="mainContent">
    <div class="top-bar">
        <button class="menu-toggle" id="menuToggle"><i class="ri-menu-line"></i></button>
        <div>
            <h2 style="font-weight:700;color:var(--blue-deep);font-size:1.1rem;">Faculty Management</h2>
            <p class="text-sm text-gray-500 hidden md:block">Assign faculty to subjects, programs and sections</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold shadow-sm" style="background:var(--blue-deep);color:white;">
            <i class="ri-add-line"></i> Add Faculty
        </a>
    </div>

    <div class="p-4 md:p-6">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-xl mb-6 flex items-center gap-2">
                <i class="ri-checkbox-circle-line text-green-600"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Faculty</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Faculty ID</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Department</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Assigned Subjects</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($faculty as $member)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-9 w-9 rounded-full bg-indigo-100 flex items-center justify-center">
                                        <i class="ri-user-star-line text-indigo-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-semibold text-gray-900">{{ $member->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $member->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $member->faculty_id ?? '—' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $member->department ?? '—' }}</td>
                            <td class="px-6 py-4">
                                @php $assigned = $courses->where('faculty_id', $member->id); @endphp
                                @if($assigned->count())
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($assigned as $c)
                                            <span class="badge" style="background:#e0e7ff;color:#3730a3;">
                                                {{ $c->code }}
                                                @if($c->program) <span class="ml-1 opacity-60">{{ $c->program->code }} §{{ $c->section }}</span> @endif
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-sm text-gray-400 italic">No subjects assigned</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button onclick="openAssignModal({{ $member->id }}, '{{ addslashes($member->name) }}')"
                                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium transition"
                                        style="background:var(--blue-deep);color:white;">
                                    <i class="ri-links-line"></i> Assign Subjects
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <i class="ri-user-star-line text-5xl text-gray-300 block mb-3"></i>
                                No faculty accounts yet.
                                <a href="{{ route('admin.users.create') }}" class="ml-1 text-indigo-600 font-medium underline">Add faculty</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Assign Subjects Modal -->
<div id="assignModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h3><i class="ri-links-line"></i> <span id="assignModalTitle">Assign Subjects</span></h3>
            <button class="modal-close" onclick="closeAssignModal()">&times;</button>
        </div>
        <div class="p-6">
            <p class="text-sm text-gray-500 mb-4">Select the subjects this faculty will teach. Unselecting removes them from a subject.</p>

            <input type="text" id="courseSearch" placeholder="Search subjects..."
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm mb-3 focus:outline-none focus:border-indigo-400"
                   oninput="filterCourses(this.value)">

            <div class="course-checkbox-list" id="courseList">
                @forelse($courses as $course)
                <label class="course-item" data-name="{{ strtolower($course->name . ' ' . $course->code) }}">
                    <input type="checkbox" class="course-checkbox" value="{{ $course->id }}">
                    <div class="flex-1">
                        <div class="text-sm font-semibold text-gray-800">{{ $course->code }} – {{ $course->name }}</div>
                        <div class="text-xs text-gray-500">
                            {{ $course->program->code ?? 'No program' }} &bull; Section {{ $course->section ?? '?' }}
                        </div>
                    </div>
                </label>
                @empty
                <div class="p-4 text-center text-gray-400 text-sm">No subjects created yet.</div>
                @endforelse
            </div>

            <div class="flex justify-end gap-3 mt-4 pt-4 border-t border-gray-100">
                <button type="button" onclick="closeAssignModal()" class="px-5 py-2 border border-gray-300 rounded-xl hover:bg-gray-50 text-sm font-medium">Cancel</button>
                <button type="button" onclick="saveAssignments()" class="px-6 py-2 rounded-xl text-sm font-semibold shadow-sm" style="background:var(--blue-deep);color:white;">Save Assignments</button>
            </div>
        </div>
    </div>
</div>

<!-- Logout Modal -->
<div id="logoutModal" class="modal-overlay">
    <div class="modal-box" style="max-width:450px;">
        <div class="modal-header">
            <h3><i class="ri-logout-box-r-line"></i> Confirm Sign Out</h3>
            <button class="modal-close" onclick="closeLogoutModal()">&times;</button>
        </div>
        <div style="padding:1.8rem 1.5rem;text-align:center;">
            <p>Are you sure you want to sign out?</p>
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
    let currentFacultyId = null;

    // Mobile sidebar
    const menuToggle = document.getElementById('menuToggle');
    const sidebar    = document.getElementById('sidebar');
    if (menuToggle) menuToggle.addEventListener('click', () => sidebar.classList.toggle('mobile-open'));

    // Search courses
    function filterCourses(q) {
        q = q.toLowerCase();
        document.querySelectorAll('#courseList .course-item').forEach(el => {
            el.style.display = el.dataset.name.includes(q) ? '' : 'none';
        });
    }

    // Open assign modal
    function openAssignModal(facultyId, name) {
        currentFacultyId = facultyId;
        document.getElementById('assignModalTitle').textContent = 'Assign Subjects — ' + name;

        // Fetch current assignments
        fetch(`/admin/faculty/${facultyId}/data`, {
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                const assigned = data.assigned_course_ids || [];
                document.querySelectorAll('.course-checkbox').forEach(cb => {
                    cb.checked = assigned.includes(parseInt(cb.value));
                });
            }
            document.getElementById('courseSearch').value = '';
            filterCourses('');
            document.getElementById('assignModal').classList.add('active');
        })
        .catch(e => alert('Error loading data: ' + e.message));
    }

    function closeAssignModal() {
        document.getElementById('assignModal').classList.remove('active');
        currentFacultyId = null;
    }

    // Save assignments
    function saveAssignments() {
        const checked = [...document.querySelectorAll('.course-checkbox:checked')].map(cb => cb.value);

        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        checked.forEach(id => formData.append('course_ids[]', id));

        fetch(`/admin/faculty/${currentFacultyId}/assign-courses`, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                closeAssignModal();
                location.reload();
            } else {
                alert(data.message || 'Error saving assignments');
            }
        })
        .catch(e => alert('Error: ' + e.message));
    }

    // Logout
    function openLogoutModal()  { document.getElementById('logoutModal').classList.add('active');    document.body.style.overflow = 'hidden'; }
    function closeLogoutModal() { document.getElementById('logoutModal').classList.remove('active'); document.body.style.overflow = ''; }
    document.getElementById('logoutModal').addEventListener('click', e => { if (e.target === document.getElementById('logoutModal')) closeLogoutModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') { closeAssignModal(); closeLogoutModal(); } });
</script>
</body>
</html>