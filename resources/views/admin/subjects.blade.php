<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Department Management - NU Clicks LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        *{margin:0;padding:0;box-sizing:border-box}body{font-family:'Inter',sans-serif;background:#F5F7FB;overflow-x:hidden}:root{--blue-deep:#0A1F44;--gold:#FFD70F;--gray-border:#E9EDF2;--danger-red:#dc2626;--transition:all .25s ease}@media(max-width:1024px){.sidebar.mobile-open{transform:translateX(0)}}.logo-text h1 span{color:var(--gold)}.nav-section{padding:0 1rem;margin-top:1.5rem}.nav-section-title{font-size:.7rem;text-transform:uppercase;letter-spacing:1px;color:rgba(255,215,15,.6);margin-bottom:.75rem;font-weight:600}.nav-item{display:flex;align-items:center;gap:.75rem;padding:.7rem 1rem;border-radius:12px;color:rgba(255,255,255,.85);transition:var(--transition);margin-bottom:.25rem;font-weight:500;text-decoration:none}.nav-item i{font-size:1.2rem;width:1.5rem}.nav-item:hover{background:rgba(255,215,15,.15);color:white}.nav-item.active{background:var(--gold);color:var(--blue-deep)}.sidebar-footer{margin-top:auto;padding:1.2rem;border-top:1px solid rgba(255,215,15,.2)}.logout-btn{width:100%;background:rgba(220,38,38,.15);border:none;padding:.6rem;border-radius:40px;color:#fca5a5;font-weight:600;display:flex;align-items:center;justify-content:center;gap:.5rem;cursor:pointer}.logout-btn:hover{background:var(--danger-red);color:white}.top-bar{background:white;padding:1rem 2rem;display:flex;align-items:center;justify-content:space-between;box-shadow:0 2px 8px rgba(0,0,0,.03);border-bottom:1px solid var(--gray-border);position:sticky;top:0;z-index:20}.menu-toggle{display:none;background:none;border:none;font-size:1.5rem;cursor:pointer;color:var(--blue-deep)}@media(max-width:1024px){.menu-toggle{display:block}}.btn-icon{transition:var(--transition)}.btn-icon:hover{transform:translateY(-1px)}.table-card{background:white;border-radius:1rem;box-shadow:0 8px 20px rgba(10,31,68,.05);border:1px solid #e5e7eb;overflow:hidden}.data-table{width:100%;border-collapse:collapse}.data-table thead{background:#f9fafb}.data-table th{padding:1rem 1.5rem;text-align:left;font-size:.75rem;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid #e5e7eb;white-space:nowrap}.data-table td{padding:1rem 1.5rem;border-bottom:1px solid #f1f5f9;vertical-align:middle}.data-table tbody tr:hover{background:#f8fafc}.badge{display:inline-flex;align-items:center;padding:.32rem .8rem;border-radius:999px;font-size:.75rem;font-weight:800;white-space:nowrap}.badge-navy{background:rgba(10,31,68,.1);color:var(--blue-deep)}.badge-blue{background:#dbeafe;color:#1d4ed8}.badge-green{background:#dcfce7;color:#15803d}.badge-gold{background:rgba(255,215,15,.18);color:#a16207}.modal-overlay{position:fixed;inset:0;background:rgba(10,31,68,.75);backdrop-filter:blur(4px);z-index:1000;display:flex;align-items:center;justify-content:center;visibility:hidden;opacity:0;transition:all .2s ease}.modal-overlay.active{visibility:visible;opacity:1}.modal-box{background:white;width:90%;max-width:650px;border-radius:1.5rem;box-shadow:0 25px 40px rgba(0,0,0,.2);overflow:hidden;transform:scale(.95);transition:transform .2s cubic-bezier(.2,.9,.4,1.1)}.modal-overlay.active .modal-box{transform:scale(1)}.modal-header{background:var(--blue-deep);padding:1.25rem 1.5rem;display:flex;align-items:center;justify-content:space-between;border-bottom:2px solid var(--gold)}.modal-header h3{font-size:1.1rem;font-weight:700;color:white;display:flex;align-items:center;gap:.5rem}.modal-header h3 i{color:var(--gold)}.modal-close{background:none;border:none;color:rgba(255,255,255,.7);font-size:1.6rem;cursor:pointer}input:focus,textarea:focus,select:focus{outline:none;border-color:var(--gold);box-shadow:0 0 0 2px rgba(255,215,15,.2)}
    
        

        

        

        

        

        

        

        

        

        

        .sun-rays .ray-1 { height: 20px; opacity: 0.45; transform: translateX(-50%) rotate(-64deg); }
        .sun-rays .ray-2 { height: 24px; opacity: 0.58; transform: translateX(-50%) rotate(-48deg); }
        .sun-rays .ray-3 { height: 28px; opacity: 0.70; transform: translateX(-50%) rotate(-32deg); }
        .sun-rays .ray-4 { height: 31px; opacity: 0.82; transform: translateX(-50%) rotate(-16deg); }
        .sun-rays .ray-5 { height: 34px; opacity: 1; width: 2.5px; transform: translateX(-50%) rotate(0deg); }
        .sun-rays .ray-6 { height: 31px; opacity: 0.82; transform: translateX(-50%) rotate(16deg); }
        .sun-rays .ray-7 { height: 28px; opacity: 0.70; transform: translateX(-50%) rotate(32deg); }
        .sun-rays .ray-8 { height: 24px; opacity: 0.58; transform: translateX(-50%) rotate(48deg); }
        .sun-rays .ray-9 { height: 20px; opacity: 0.45; transform: translateX(-50%) rotate(64deg); }

    
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
            background-color: var(--blue-deep) !important;
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
</head><body>
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
            <a href="{{ route('admin.departments') }}" class="nav-item {{ request()->routeIs('admin.departments*') ? 'active' : '' }}">
                <i class="ri-building-2-line"></i> Departments
            </a>
            <a href="{{ route('admin.programs') }}" class="nav-item {{ request()->routeIs('admin.programs*') ? 'active' : '' }}">
                <i class="ri-graduation-cap-line"></i> Programs/Courses
            </a>
            <a href="{{ route('admin.sections') }}" class="nav-item {{ request()->routeIs('admin.sections*') ? 'active' : '' }}">
                <i class="ri-layout-grid-line"></i> Sections
            </a>
            <a href="{{ route('admin.subjects') }}" class="nav-item {{ request()->routeIs('admin.subjects*') || request()->routeIs('admin.courses*') ? 'active' : '' }}">
                <i class="ri-book-open-line"></i> Subjects
            </a>
            <a href="{{ route('admin.faculty-assignments') }}" class="nav-item {{ request()->routeIs('admin.faculty-assignments*') ? 'active' : '' }}">
                <i class="ri-user-settings-line"></i> Faculty Assignments
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
    <div class="sidebar-footer"><a href="{{ route('admin.profile') }}" style="display:flex;align-items:center;gap:.75rem;margin-bottom:1rem;text-decoration:none;"><div style="width:42px;height:42px;background:rgba(255,215,15,.2);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--gold);"><i class="ri-user-line"></i></div><div><p style="color:white;font-weight:600;font-size:.85rem;margin:0;">{{ Auth::user()->name ?? 'Admin User' }}</p><span style="color:rgba(255,255,255,.6);font-size:.7rem;display:block;">{{ Auth::user()->email ?? 'admin@nuclicks.edu' }}</span></div></a><button onclick="openLogoutModal()" class="logout-btn"><i class="ri-logout-box-line"></i> Logout</button></div>
</aside>


<div class="main-content" id="mainContent"><div class="top-bar"><button class="menu-toggle" id="menuToggle"><i class="ri-menu-line"></i></button><div><h2 style="font-weight:700;color:var(--blue-deep);font-size:1.1rem;">Subject Management</h2><p class="text-sm text-gray-500 hidden md:block">Subjects are assigned to Program/Course and Section</p></div><div class="flex items-center gap-3">@if(View::exists('admin.partials.notification-bell')) @include('admin.partials.notification-bell') @endif<button onclick="openCreateModal()" class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold" style="background:var(--blue-deep);color:white;"><i class="ri-add-line"></i>Add Subject</button></div></div><div class="p-4 md:p-6"><div class="table-card"><div class="overflow-x-auto"><table class="data-table"><thead><tr><th>Code</th><th>Subject Name</th><th>Department</th><th>Program/Course</th><th>Section</th><th>Faculty</th><th>Quizzes</th><th>Actions</th></tr></thead><tbody>@forelse($courses as $course)<tr><td><span class="badge badge-navy">{{ $course->code }}</span></td><td><div class="font-semibold">{{ $course->name }}</div><div class="text-xs text-gray-500">{{ Str::limit($course->description, 45) }}</div></td><td>@if($course->program && $course->program->department)<span class="badge badge-gold">{{ $course->program->department->code }}</span>@else<span class="text-red-500 text-sm">No department</span>@endif</td><td><div class="font-semibold">{{ $course->program->code ?? '—' }}</div><div class="text-xs text-gray-500">{{ $course->program->name ?? '' }}</div></td><td><span class="badge badge-blue">{{ $course->sectionRecord->name ?? $course->section ?? '—' }}</span></td><td><div class="font-semibold text-sm">{{ $course->faculty->name ?? 'Not assigned' }}</div></td><td><span class="badge badge-green">{{ $course->quizzes_count ?? 0 }}</span></td><td><div class="flex gap-3"><button onclick="editSubject({{ $course->id }})" class="text-yellow-600"><i class="ri-edit-line text-lg"></i></button><button onclick="deleteSubject({{ $course->id }}, '{{ addslashes($course->name) }}')" class="text-red-600"><i class="ri-delete-bin-line text-lg"></i></button></div></td></tr>@empty<tr><td colspan="8" class="text-center py-12 text-gray-500">No subjects yet.</td></tr>@endforelse</tbody></table></div></div><div class="mt-4">{{ $courses->links() }}</div></div></div>
<div id="subjectModal" class="modal-overlay"><div class="modal-box"><div class="modal-header"><h3><i class="ri-book-open-line"></i><span id="modalTitle">Add Subject</span></h3><button class="modal-close" onclick="closeModal()">&times;</button></div><div class="p-6"><form id="subjectForm">@csrf<input type="hidden" id="subjectId"><div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4"><div><label class="block text-sm font-semibold mb-2">Program/Course *</label><select id="programId" required class="w-full border rounded-xl px-4 py-2.5"><option value="">Select Program/Course</option>@foreach($programs as $program)<option value="{{ $program->id }}">{{ $program->code }} - {{ $program->name }} @if($program->department) ({{ $program->department->code }}) @endif</option>@endforeach</select></div><div><label class="block text-sm font-semibold mb-2">Section *</label><select id="sectionId" required class="w-full border rounded-xl px-4 py-2.5"><option value="">Select Section</option>@foreach($sections as $section)<option value="{{ $section->id }}" data-program="{{ $section->program_id }}">{{ $section->name }} - {{ $section->program->code ?? '' }}</option>@endforeach</select></div><div><label class="block text-sm font-semibold mb-2">Subject Code *</label><input id="subjectCode" required maxlength="50" class="w-full border rounded-xl px-4 py-2.5 uppercase" placeholder="IT101"></div><div><label class="block text-sm font-semibold mb-2">Subject Name *</label><input id="subjectName" required class="w-full border rounded-xl px-4 py-2.5" placeholder="Introduction to Computing"></div><div><label class="block text-sm font-semibold mb-2">Faculty</label><select id="facultyId" class="w-full border rounded-xl px-4 py-2.5"><option value="">Not assigned</option>@foreach($faculties as $faculty)<option value="{{ $faculty->id }}">{{ $faculty->name }} @if($faculty->department_id || $faculty->department) ({{ $faculty->department_id ? ($faculty->departmentRel->code ?? 'N/A') : $faculty->department }}) @endif</option>@endforeach</select></div><div><label class="block text-sm font-semibold mb-2">Credits/Units *</label><input type="number" id="credits" value="3" min="1" max="6" required class="w-full border rounded-xl px-4 py-2.5"></div></div><div class="mb-6"><label class="block text-sm font-semibold mb-2">Description</label><textarea id="subjectDesc" rows="3" class="w-full border rounded-xl px-4 py-2.5"></textarea></div><div class="flex justify-end gap-3 pt-4 border-t"><button type="button" onclick="closeModal()" class="px-5 py-2.5 border rounded-xl">Cancel</button><button type="submit" id="submitBtn" class="px-6 py-2.5 rounded-xl font-semibold" style="background:var(--blue-deep);color:white;">Save Subject</button></div></form></div></div></div>
<script>
function filterSections(){const p=programId.value;[...sectionId.options].forEach(o=>{if(!o.value)return;o.hidden=p&&o.dataset.program!==p})}function openCreateModal(){subjectForm.reset();subjectId.value='';credits.value=3;modalTitle.innerText='Add Subject';submitBtn.innerText='Save Subject';subjectModal.classList.add('active');document.body.style.overflow='hidden';filterSections()}function closeModal(){subjectModal.classList.remove('active');document.body.style.overflow=''}programId.addEventListener('change',()=>{sectionId.value='';filterSections()});function editSubject(id){fetch(`/admin/courses/${id}/edit-data`,{headers:{Accept:'application/json','X-Requested-With':'XMLHttpRequest'}}).then(r=>r.json()).then(d=>{if(d.success){modalTitle.innerText='Edit Subject';subjectId.value=d.course.id;programId.value=d.course.program_id||'';filterSections();sectionId.value=d.course.section_id||'';subjectCode.value=d.course.code||'';subjectName.value=d.course.name||'';subjectDesc.value=d.course.description||'';facultyId.value=d.course.faculty_id||'';credits.value=d.course.credits||3;submitBtn.innerText='Update Subject';subjectModal.classList.add('active');document.body.style.overflow='hidden'}else alert(d.message||'Failed to load subject')})}function deleteSubject(id,name){if(!confirm(`Delete subject "${name}"?`))return;fetch(`/admin/courses/${id}`,{method:'DELETE',headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}',Accept:'application/json','X-Requested-With':'XMLHttpRequest'}}).then(r=>r.json()).then(d=>{if(d.success)location.reload();else alert(d.message||'Error deleting subject')})}subjectForm.addEventListener('submit',e=>{e.preventDefault();const id=subjectId.value,url=id?`/admin/courses/${id}`:'/admin/courses',fd=new FormData();fd.append('_token','{{ csrf_token() }}');if(id)fd.append('_method','PUT');fd.append('program_id',programId.value);fd.append('section_id',sectionId.value);fd.append('code',subjectCode.value.trim().toUpperCase());fd.append('name',subjectName.value.trim());fd.append('description',subjectDesc.value.trim());fd.append('faculty_id',facultyId.value);fd.append('credits',credits.value);fetch(url,{method:'POST',body:fd,headers:{'X-Requested-With':'XMLHttpRequest'}}).then(r=>r.json()).then(d=>{if(d.success)location.reload();else alert(d.message||(d.errors?Object.values(d.errors).flat().join('\n'):'Error saving subject'))})});subjectCode.addEventListener('input',function(){this.value=this.value.toUpperCase()});subjectModal.addEventListener('click',e=>{if(e.target.id==='subjectModal')closeModal()});
</script>
<div id="logoutModal" class="modal-overlay"><div class="modal-box" style="max-width:450px;"><div class="modal-header"><h3><i class="ri-logout-box-r-line"></i> Confirm Sign Out</h3><button class="modal-close" onclick="closeLogoutModal()">&times;</button></div><div style="padding:1.8rem 1.5rem;text-align:center;"><p>Are you sure you want to sign out?</p><p class="text-xs text-gray-500 mt-2">You will be redirected to the login page.</p></div><div style="padding:1rem 1.5rem 1.5rem;display:flex;gap:.75rem;justify-content:flex-end;background:#f9fafb;border-top:1px solid var(--gray-border);"><button onclick="closeLogoutModal()" style="padding:.6rem 1.25rem;border-radius:40px;background:#eef2ff;color:#1e293b;border:none;font-weight:600;cursor:pointer;">Cancel</button><form method="POST" action="{{ route('logout') }}" style="margin:0;">@csrf<button type="submit" style="padding:.6rem 1.25rem;border-radius:40px;background:#dc2626;color:white;border:none;font-weight:600;cursor:pointer;">Yes, Sign Out</button></form></div></div></div>
<script>
const menuToggle=document.getElementById('menuToggle'),sidebar=document.getElementById('sidebar');if(menuToggle){menuToggle.addEventListener('click',()=>sidebar.classList.toggle('mobile-open'))}document.addEventListener('click',e=>{const m=window.innerWidth<=1024;if(m&&sidebar&&sidebar.classList.contains('mobile-open')&&!sidebar.contains(e.target)&&!menuToggle.contains(e.target)){sidebar.classList.remove('mobile-open')}});function openLogoutModal(){document.getElementById('logoutModal').classList.add('active');document.body.style.overflow='hidden'}function closeLogoutModal(){document.getElementById('logoutModal').classList.remove('active');document.body.style.overflow=''}document.addEventListener('keydown',e=>{if(e.key==='Escape'){document.querySelectorAll('.modal-overlay.active').forEach(m=>m.classList.remove('active'));document.body.style.overflow=''}});
</script>
</body></html>