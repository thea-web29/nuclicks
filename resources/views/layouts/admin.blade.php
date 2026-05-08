<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Faculty & Students | NU Clicks LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background: #F5F7FB; }
        :root {
            --blue-deep: #0A1F44;
            --gold: #FFD70F;
        }
        /* custom scrollbar */
        .custom-scroll::-webkit-scrollbar { width: 5px; height: 5px; }
        .custom-scroll::-webkit-scrollbar-track { background: #eef2f6; border-radius: 10px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

        .sidebar {
            background-color: var(--blue-deep);
            width: 280px;
            position: fixed;
            top: 0; left: 0;
            height: 100%;
            z-index: 40;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 20px rgba(0,0,0,0.08);
        }
        .sidebar-logo { padding: 1.5rem; border-bottom: 1px solid rgba(255,215,15,0.2); display: flex; align-items: center; gap: 0.75rem; }
        .logo-text h1 { font-size: 1.3rem; font-weight: 800; color: white; }
        .logo-text h1 span { color: var(--gold); }
        .logo-text p { font-size: 0.7rem; color: rgba(255,255,255,0.7); }
        .nav-section { padding: 0 1rem; margin-top: 1.5rem; }
        .nav-section-title { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,215,15,0.6); margin-bottom: 0.75rem; font-weight: 600; }
        .nav-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.7rem 1rem; border-radius: 12px; color: rgba(255,255,255,0.85); transition: all 0.25s ease; margin-bottom: 0.25rem; font-weight: 500; text-decoration: none; }
        .nav-item i { font-size: 1.2rem; width: 1.5rem; }
        .nav-item:hover { background: rgba(255,215,15,0.15); color: white; }
        .nav-item.active { background: var(--gold); color: var(--blue-deep); }
        .sidebar-footer { margin-top: auto; padding: 1.2rem; border-top: 1px solid rgba(255,215,15,0.2); }
        .logout-btn { width: 100%; background: rgba(220,38,38,0.15); border: none; padding: 0.6rem; border-radius: 40px; color: #fca5a5; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem; cursor: pointer; transition: 0.2s; }
        .logout-btn:hover { background: #dc2626; color: white; }
        .main-content { margin-left: 280px; min-height: 100vh; }

        /* custom filter chips & table */
        .filter-chip { transition: all 0.2s ease; cursor: pointer; background: white; border: 1px solid #e2e8f0; }
        .filter-chip.active { background: var(--blue-deep); color: white; border-color: var(--blue-deep); }
        .status-badge { display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
        .status-active { background: #e0f2fe; color: #0369a1; }
        .status-inactive { background: #f1f5f9; color: #475569; }
        .role-badge-faculty { background: #fef9c3; color: #854d0e; }
        .role-badge-student { background: #dbeafe; color: #1e40af; }
        .action-icon { opacity: 0.7; transition: 0.2s; cursor: pointer; }
        .action-icon:hover { opacity: 1; color: var(--blue-deep); transform: scale(1.05); }
        .detail-card { background: white; border-radius: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); border: 1px solid #edf2f7; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo">
        <!-- Using inline SVG placeholder as logo; ensures no broken image, keeping NU brand -->
        <div style="width:45px;height:45px;background:#FFD70F;border-radius:12px;display:flex;align-items:center;justify-content:center;font-weight:800;color:#0A1F44;">NU</div>
        <div class="logo-text">
            <h1>NU <span>CLICKS</span> LMS</h1>
            <p>Admin Portal</p>
        </div>
    </div>
    <div style="flex:1; overflow-y:auto;">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>
            <a href="#" class="nav-item"><i class="ri-dashboard-line"></i> Dashboard</a>
            <a href="#" class="nav-item active"><i class="ri-team-line"></i> Users</a>
            <a href="#" class="nav-item"><i class="ri-user-add-line"></i> Account Creation</a>
            <a href="#" class="nav-item"><i class="ri-user-star-line"></i> Faculty</a>
        </div>
        <div class="nav-section">
            <div class="nav-section-title">Academic</div>
            <a href="#" class="nav-item"><i class="ri-graduation-cap-line"></i> Programs</a>
            <a href="#" class="nav-item"><i class="ri-building-2-line"></i> Departments</a>
            <a href="#" class="nav-item"><i class="ri-book-open-line"></i> Subjects</a>
        </div>
        <div class="nav-section">
            <div class="nav-section-title">Assessment</div>
            <a href="#" class="nav-item"><i class="ri-list-check"></i> Quizzes</a>
            <a href="#" class="nav-item"><i class="ri-bar-chart-line"></i> Analytics</a>
            <a href="#" class="nav-item"><i class="ri-history-line"></i> Activity Logs</a>
            <a href="#" class="nav-item"><i class="ri-settings-line"></i> Settings</a>
        </div>
    </div>
    <div class="sidebar-footer">
        <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1rem;">
            <div style="width:42px;height:42px;background:rgba(255,215,15,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--gold);"><i class="ri-user-line"></i></div>
            <div>
                <p style="color:white;font-weight:600;font-size:0.85rem;">Dr. Maria Santos</p>
                <span style="color:rgba(255,255,255,0.6);font-size:0.7rem;">admin@nuclicks.edu</span>
            </div>
        </div>
        <button class="logout-btn"><i class="ri-logout-box-line"></i> Logout</button>
    </div>
</aside>

<div class="main-content">
    <div style="background:white;padding:1rem 2rem;display:flex;align-items:center;justify-content:space-between;box-shadow:0 2px 8px rgba(0,0,0,0.03);border-bottom:1px solid #E9EDF2;position:sticky;top:0;z-index:20;">
        <h2 style="font-weight:700;color:var(--blue-deep);font-size:1.1rem;">👥 User Management · Faculty & Students</h2>
        <div class="flex gap-3">
            <button id="addUserBtn" class="bg-[#0A1F44] text-white text-sm px-4 py-2 rounded-xl flex items-center gap-2 shadow-sm hover:bg-[#0f2b58] transition"><i class="ri-user-add-line"></i> Add User</button>
            <button id="exportBtn" class="border border-gray-300 text-gray-700 text-sm px-4 py-2 rounded-xl flex items-center gap-2 bg-white hover:bg-gray-50"><i class="ri-download-line"></i> Export</button>
        </div>
    </div>
    <div class="p-6">
        <!-- Filter row & search -->
        <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
            <div class="flex gap-2 flex-wrap">
                <div data-role="all" class="filter-chip active px-4 py-2 rounded-full text-sm font-medium shadow-sm">All Users</div>
                <div data-role="student" class="filter-chip px-4 py-2 rounded-full text-sm font-medium shadow-sm">🎓 Students</div>
                <div data-role="faculty" class="filter-chip px-4 py-2 rounded-full text-sm font-medium shadow-sm">👨‍🏫 Faculty</div>
            </div>
            <div class="relative">
                <i class="ri-search-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" id="searchInput" placeholder="Search name, email, ID..." class="pl-10 pr-4 py-2 border border-gray-200 rounded-xl w-72 bg-white focus:ring-2 focus:ring-[#FFD70F] focus:border-transparent outline-none text-sm">
            </div>
        </div>

        <!-- Stats Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-7">
            <div class="bg-white p-5 rounded-2xl border border-gray-100 flex items-center justify-between shadow-sm">
                <div><p class="text-gray-500 text-sm">Total Users</p><p class="text-3xl font-bold text-[#0A1F44]" id="totalCount">0</p></div>
                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-[#0A1F44]"><i class="ri-group-line text-xl"></i></div>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-gray-100 flex items-center justify-between shadow-sm">
                <div><p class="text-gray-500 text-sm">Students Enrolled</p><p class="text-3xl font-bold text-[#0A1F44]" id="studentCount">0</p></div>
                <div class="w-12 h-12 rounded-full bg-amber-50 flex items-center justify-center text-amber-600"><i class="ri-graduation-cap-line text-xl"></i></div>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-gray-100 flex items-center justify-between shadow-sm">
                <div><p class="text-gray-500 text-sm">Faculty Members</p><p class="text-3xl font-bold text-[#0A1F44]" id="facultyCount">0</p></div>
                <div class="w-12 h-12 rounded-full bg-purple-50 flex items-center justify-center text-purple-600"><i class="ri-user-star-line text-xl"></i></div>
            </div>
        </div>

        <!-- User Table -->
        <div class="detail-card overflow-hidden rounded-2xl">
            <div class="overflow-x-auto custom-scroll">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Department / Program</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody" class="bg-white divide-y divide-gray-100">
                        <!-- dynamic rows injected -->
                    </tbody>
                </table>
            </div>
            <div id="emptyState" class="text-center py-12 text-gray-400 hidden flex-col items-center gap-2">
                <i class="ri-user-search-line text-4xl opacity-60"></i>
                <p class="text-sm">No users match the selected filters</p>
            </div>
        </div>

        <!-- Quick detail modal (view faculty/student) -->
        <div id="detailModal" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 hidden transition-all">
            <div class="bg-white rounded-2xl max-w-lg w-full mx-4 shadow-2xl transform transition-all">
                <div class="flex justify-between items-center p-5 border-b">
                    <h3 class="text-xl font-bold text-[#0A1F44] flex items-center gap-2"><i class="ri-information-line"></i> User Details</h3>
                    <button id="closeModalBtn" class="text-gray-400 hover:text-gray-600"><i class="ri-close-line text-2xl"></i></button>
                </div>
                <div id="modalContent" class="p-6 space-y-3"></div>
                <div class="p-5 border-t bg-gray-50 flex justify-end">
                    <button id="modalCloseFooter" class="px-5 py-2 bg-gray-200 rounded-xl text-gray-700 hover:bg-gray-300">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // ----- MOCK DATA (Student & Faculty with rich fields) -----
    const usersData = [
        { id: 1, name: "Sophia Ramirez", email: "sophia.ramirez@nu.edu.ph", role: "student", status: "active", program: "BS Computer Science", year: "3rd Year", studentId: "NU-2022-01234", avatar: "SR" },
        { id: 2, name: "James Dela Cruz", email: "james.dc@nu.edu.ph", role: "student", status: "active", program: "BS Information Technology", year: "2nd Year", studentId: "NU-2023-04567", avatar: "JD" },
        { id: 3, name: "Dr. Maria Concepcion", email: "maria.concepcion@nu.edu.ph", role: "faculty", status: "active", department: "College of Computer Studies", designation: "Professor & Program Chair", employeeId: "FAC-1089", courses: ["Web Development", "Database Systems"] },
        { id: 4, name: "Ethan Vergara", email: "ethan.verg@nu.edu.ph", role: "student", status: "inactive", program: "BS Information Systems", year: "4th Year", studentId: "NU-2021-09876", avatar: "EV" },
        { id: 5, name: "Prof. Ricardo Gomez", email: "ricardo.gomez@nu.edu.ph", role: "faculty", status: "active", department: "College of Business", designation: "Associate Professor", employeeId: "FAC-2045", courses: ["Business Analytics", "Operations Management"] },
        { id: 6, name: "Liam Mendoza", email: "liam.m@nu.edu.ph", role: "student", status: "active", program: "BS Computer Engineering", year: "1st Year", studentId: "NU-2024-11223", avatar: "LM" },
        { id: 7, name: "Dr. Sofia Adriano", email: "sofia.adriano@nu.edu.ph", role: "faculty", status: "active", department: "College of Arts & Sciences", designation: "Dean", employeeId: "FAC-0091", courses: ["Ethics", "Philosophy of Science"] },
        { id: 8, name: "Isabella Cruz", email: "isabella.cruz@nu.edu.ph", role: "student", status: "active", program: "BS Multimedia Arts", year: "2nd Year", studentId: "NU-2023-33456", avatar: "IC" }
    ];

    // DOM elements
    const tbody = document.getElementById('userTableBody');
    const emptyStateDiv = document.getElementById('emptyState');
    const totalSpan = document.getElementById('totalCount');
    const studentCountSpan = document.getElementById('studentCount');
    const facultyCountSpan = document.getElementById('facultyCount');
    const searchInput = document.getElementById('searchInput');
    const filterChips = document.querySelectorAll('.filter-chip');
    const detailModal = document.getElementById('detailModal');
    const modalContentDiv = document.getElementById('modalContent');
    const closeModalBtns = document.getElementById('closeModalBtn');
    const modalCloseFooter = document.getElementById('modalCloseFooter');

    let activeRoleFilter = 'all';   // 'all', 'student', 'faculty'
    let searchQuery = '';

    // Helper: update counts
    function updateStats(users) {
        totalSpan.innerText = users.length;
        const students = users.filter(u => u.role === 'student').length;
        const faculties = users.filter(u => u.role === 'faculty').length;
        studentCountSpan.innerText = students;
        facultyCountSpan.innerText = faculties;
    }

    // get filtered users based on role + search
    function getFilteredUsers() {
        let filtered = [...usersData];
        if (activeRoleFilter !== 'all') {
            filtered = filtered.filter(u => u.role === activeRoleFilter);
        }
        if (searchQuery.trim() !== '') {
            const q = searchQuery.toLowerCase();
            filtered = filtered.filter(u => 
                u.name.toLowerCase().includes(q) || 
                u.email.toLowerCase().includes(q) ||
                (u.studentId && u.studentId.toLowerCase().includes(q)) ||
                (u.employeeId && u.employeeId.toLowerCase().includes(q)) ||
                (u.program && u.program.toLowerCase().includes(q))
            );
        }
        return filtered;
    }

    // Render table rows
    function renderTable() {
        const filtered = getFilteredUsers();
        updateStats(filtered);
        if (filtered.length === 0) {
            tbody.innerHTML = '';
            emptyStateDiv.classList.remove('hidden');
            return;
        }
        emptyStateDiv.classList.add('hidden');
        tbody.innerHTML = filtered.map(user => {
            const roleClass = user.role === 'faculty' ? 'role-badge-faculty' : 'role-badge-student';
            const roleIcon = user.role === 'faculty' ? 'ri-user-star-line' : 'ri-graduation-cap-line';
            const statusClass = user.status === 'active' ? 'status-active' : 'status-inactive';
            const statusText = user.status === 'active' ? 'Active' : 'Inactive';
            let roleLabel = user.role === 'faculty' ? 'Faculty' : 'Student';
            let departmentOrProgram = '';
            if (user.role === 'student') departmentOrProgram = user.program + (user.year ? ` (${user.year})` : '');
            else departmentOrProgram = user.department || '—';
            return `
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-[#0A1F44] to-[#2a3f6e] text-white flex items-center justify-center text-sm font-semibold shadow-sm">${user.avatar || user.name.charAt(0)+user.name.split(' ')[1]?.charAt(0) || user.name.charAt(1)}</div>
                            <div>
                                <p class="font-semibold text-gray-800">${user.name}</p>
                                <p class="text-xs text-gray-400">${user.email}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="status-badge ${roleClass} flex gap-1 w-fit"><i class="${roleIcon} text-xs"></i> ${roleLabel}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">${departmentOrProgram}</td>
                    <td class="px-6 py-4"><span class="status-badge ${statusClass}">${statusText}</span></td>
                    <td class="px-6 py-4">
                        <div class="flex gap-3">
                            <i class="ri-eye-line action-icon text-gray-500 text-lg" data-user-id="${user.id}" title="View Details"></i>
                            <i class="ri-edit-line action-icon text-gray-500 text-lg" data-edit-id="${user.id}" title="Edit"></i>
                            <i class="ri-delete-bin-6-line action-icon text-gray-400 hover:text-red-500 text-lg" data-delete-id="${user.id}" title="Delete"></i>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');

        // attach event listeners to action icons after render
        document.querySelectorAll('.ri-eye-line').forEach(icon => {
            icon.addEventListener('click', (e) => {
                const userId = parseInt(icon.getAttribute('data-user-id'));
                showUserDetails(userId);
            });
        });
        document.querySelectorAll('.ri-edit-line').forEach(icon => {
            icon.addEventListener('click', (e) => {
                const userId = parseInt(icon.getAttribute('data-edit-id'));
                alert(`[Demo] Edit user ID: ${userId}\nIn production, this would open a full edit form.`);
            });
        });
        document.querySelectorAll('.ri-delete-bin-6-line').forEach(icon => {
            icon.addEventListener('click', (e) => {
                const userId = parseInt(icon.getAttribute('data-delete-id'));
                if(confirm('Are you sure you want to delete this user? (Demo action)')) {
                    const index = usersData.findIndex(u => u.id === userId);
                    if(index !== -1) {
                        usersData.splice(index,1);
                        renderTable();
                    }
                }
            });
        });
    }

    // show details modal (student/faculty comprehensive view)
    function showUserDetails(userId) {
        const user = usersData.find(u => u.id === userId);
        if (!user) return;
        let detailsHtml = '';
        if (user.role === 'student') {
            detailsHtml = `
                <div class="flex items-center gap-4 border-b pb-3"><div class="w-14 h-14 rounded-full bg-[#0A1F44] text-white flex items-center justify-center text-xl font-bold">${user.avatar || user.name.charAt(0)}</div><div><h4 class="font-bold text-lg">${user.name}</h4><p class="text-gray-500 text-sm">${user.email}</p></div></div>
                <div class="grid grid-cols-2 gap-3 text-sm mt-3"><div><span class="text-gray-500">Student ID</span><p class="font-medium">${user.studentId || 'N/A'}</p></div><div><span class="text-gray-500">Program</span><p class="font-medium">${user.program}</p></div><div><span class="text-gray-500">Year Level</span><p class="font-medium">${user.year || '—'}</p></div><div><span class="text-gray-500">Status</span><p class="font-medium capitalize">${user.status}</p></div></div>
                <div class="mt-3 bg-gray-50 p-3 rounded-xl"><span class="text-xs font-semibold text-gray-500">ENROLLMENT RECORD</span><p class="text-xs mt-1">Active enrollment as of SY 2025-2026 • Maintains good standing</p></div>
            `;
        } else {
            // faculty details
            const coursesList = user.courses ? user.courses.map(c => `<span class="bg-gray-100 px-2 py-1 rounded-full text-xs">${c}</span>`).join(' ') : '—';
            detailsHtml = `
                <div class="flex items-center gap-4 border-b pb-3"><div class="w-14 h-14 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center text-xl font-bold">${user.name.charAt(0)}</div><div><h4 class="font-bold text-lg">${user.name}</h4><p class="text-gray-500 text-sm">${user.email}</p></div></div>
                <div class="grid grid-cols-2 gap-3 text-sm mt-3"><div><span class="text-gray-500">Employee ID</span><p class="font-medium">${user.employeeId || 'FAC-XXX'}</p></div><div><span class="text-gray-500">Department</span><p class="font-medium">${user.department}</p></div><div><span class="text-gray-500">Designation</span><p class="font-medium">${user.designation || 'Faculty'}</p></div><div><span class="text-gray-500">Status</span><p class="font-medium capitalize">${user.status}</p></div></div>
                <div class="mt-3"><span class="text-sm font-semibold">📖 Assigned Courses</span><div class="flex flex-wrap gap-1 mt-2">${coursesList}</div></div>
                <div class="mt-2 text-xs text-gray-400 bg-blue-50 p-2 rounded-lg">Member since: 2023 • Full-time faculty load: 24 units</div>
            `;
        }
        modalContentDiv.innerHTML = detailsHtml;
        detailModal.classList.remove('hidden');
    }

    function closeModal() {
        detailModal.classList.add('hidden');
    }

    // Event listeners
    filterChips.forEach(chip => {
        chip.addEventListener('click', () => {
            filterChips.forEach(c => c.classList.remove('active'));
            chip.classList.add('active');
            const role = chip.getAttribute('data-role');
            if (role === 'all') activeRoleFilter = 'all';
            else if (role === 'student') activeRoleFilter = 'student';
            else if (role === 'faculty') activeRoleFilter = 'faculty';
            renderTable();
        });
    });

    searchInput.addEventListener('input', (e) => {
        searchQuery = e.target.value;
        renderTable();
    });

    // modals close
    closeModalBtns.addEventListener('click', closeModal);
    modalCloseFooter.addEventListener('click', closeModal);
    detailModal.addEventListener('click', (e) => {
        if(e.target === detailModal) closeModal();
    });

    // add user demo
    document.getElementById('addUserBtn').addEventListener('click', () => {
        alert("➕ User creation dialog would appear (integrate with backend).\nDemo: You can create new faculty/student forms.");
    });
    document.getElementById('exportBtn').addEventListener('click', () => {
        const filtered = getFilteredUsers();
        let csv = "Name,Email,Role,Department/Program,Status\n";
        filtered.forEach(u => {
            const deptProg = u.role === 'student' ? u.program : (u.department || '—');
            csv += `"${u.name}","${u.email}","${u.role}", "${deptProg}","${u.status}"\n`;
        });
        const blob = new Blob([csv], {type: "text/csv"});
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = "NU_Clicks_Users_Export.csv";
        link.click();
        URL.revokeObjectURL(link.href);
    });

    // initial render
    renderTable();
</script>
</body>
</html>