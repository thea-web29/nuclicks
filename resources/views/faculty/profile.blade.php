<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - NU Horizon LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:opsz,wght@9..144,600;9..144,700;9..144,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        *{margin:0;padding:0;box-sizing:border-box}body{font-family:'Plus Jakarta Sans',sans-serif;background:#F8F6F1;overflow-x:hidden}:root{--navy:#0A1F44;--gold:#FFD70F;--gray-border:rgba(10,31,68,0.09);--transition:all .25s ease;--danger-red:#dc2626}@media(max-width:1024px){.sidebar.mobile-open{transform:translateX(0)}}.logo-text h1 span.nav-section{padding:0 1rem;margin-top:1.5rem}.nav-section-title{font-size:.65rem;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,215,15,.5);margin-bottom:.75rem;font-weight:700}.nav-item{display:flex;align-items:center;gap:.75rem;padding:.7rem 1rem;border-radius:12px;color:rgba(255,255,255,.75);transition:var(--transition);margin-bottom:.25rem;font-weight:500;text-decoration:none}.nav-item i{font-size:1.2rem;width:1.5rem}.nav-item:hover{background:rgba(255,215,15,.12);color:white}.nav-item.active{background:var(--gold);color:var(--navy)}.nav-item.active i{color:var(--navy)}.sidebar-footer{margin-top:auto;padding:1.2rem;border-top:1px solid rgba(255,215,15,.2)}.profile-info{display:flex;align-items:center;gap:.75rem;margin-bottom:1rem;text-decoration:none}.avatar{width:42px;height:42px;background:rgba(255,215,15,.2);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--gold)}.profile-details p{color:white;font-weight:600;font-size:.85rem;margin-bottom:0}.profile-details span{color:rgba(255,255,255,.6);font-size:.7rem}.logout-btn{width:100%;background:rgba(220,38,38,.15);border:none;padding:.6rem;border-radius:40px;color:#fca5a5;font-weight:600;display:flex;align-items:center;justify-content:center;gap:.5rem;cursor:pointer;transition:var(--transition)}.logout-btn:hover{background:var(--danger-red);color:white}.top-bar{background:white;padding:1.2rem 2rem;display:flex;align-items:center;justify-content:space-between;box-shadow:0 2px 8px rgba(0,0,0,.03);border-bottom:1px solid var(--gray-border);position:sticky;top:0;z-index:20}.menu-toggle{display:none;background:none;border:none;font-size:1.5rem;cursor:pointer;color:var(--navy)}@media(max-width:1024px){.menu-toggle{display:block}}.badge{display:inline-flex;align-items:center;padding:.32rem .8rem;border-radius:999px;font-size:.75rem;font-weight:800;white-space:nowrap}.badge-navy{background:rgba(10,31,68,.1);color:var(--navy)}.badge-blue{background:#dbeafe;color:#1d4ed8}.badge-green{background:#dcfce7;color:#15803d}.badge-gold{background:rgba(255,215,15,.18);color:#a16207}.modal-overlay{position:fixed;inset:0;background:rgba(10,31,68,.75);backdrop-filter:blur(4px);z-index:1000;display:flex;align-items:center;justify-content:center;visibility:hidden;opacity:0;transition:all .2s ease}.modal-overlay.active{visibility:visible;opacity:1}.modal-box{background:white;width:90%;max-width:450px;border-radius:1.5rem;box-shadow:0 25px 40px rgba(0,0,0,.2);overflow:hidden;transform:scale(.95);transition:transform .2s cubic-bezier(.2,.9,.4,1.1)}.modal-overlay.active .modal-box{transform:scale(1)}.modal-header{background:var(--navy);padding:1.25rem 1.5rem;display:flex;align-items:center;justify-content:space-between;border-bottom:2px solid var(--gold)}.modal-header h3{font-size:1.1rem;font-weight:700;color:white;display:flex;align-items:center;gap:.5rem}.modal-header h3 i{color:var(--gold)}.modal-close{background:none;border:none;color:rgba(255,255,255,.7);font-size:1.6rem;cursor:pointer}input:focus,textarea:focus,select:focus{outline:none;border-color:var(--gold);box-shadow:0 0 0 2px rgba(255,215,15,.2)}
    
        

        

        

        

        

        

        

        

        

        

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
</head>
<body>

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

            <p>Faculty Portal</p>
        </div>
    </div>

    <div style="flex:1; overflow-y: auto;">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>
            <a href="{{ route('faculty.dashboard') }}" class="nav-item"><i class="ri-dashboard-line"></i> Dashboard</a>
            <a href="{{ route('faculty.students') }}" class="nav-item"><i class="ri-user-line"></i> Students</a>
            <a href="{{ route('faculty.courses') }}" class="nav-item"><i class="ri-book-line"></i> Courses</a>
            <a href="{{ route('faculty.folder-files') }}" class="nav-item"><i class="ri-folder-3-line"></i> Files & Folders</a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Quiz Management</div>
            <a href="{{ route('faculty.quiz.create') }}" class="nav-item"><i class="ri-add-circle-line"></i> Create Quiz</a>
            <a href="{{ route('faculty.quizzes.list') }}" class="nav-item"><i class="ri-list-check"></i> All Quizzes</a>
            <a href="{{ route('faculty.question.bank') }}" class="nav-item"><i class="ri-database-2-line"></i> Question Bank</a>
            <a href="{{ route('faculty.grading') }}" class="nav-item"><i class="ri-graduation-cap-line"></i> Grading</a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Analytics</div>
            <a href="{{ route('faculty.results.index') }}" class="nav-item"><i class="ri-bar-chart-line"></i> Results & Analytics</a>
            <a href="{{ route('faculty.my-evaluation') }}" class="nav-item"><i class="ri-star-smile-line"></i> My Evaluation</a>
        </div>
    </div>

    <div class="sidebar-footer">
        <a href="{{ route('faculty.profile') }}" class="profile-info" style="text-decoration: none;">
            <div class="avatar">
                <i class="ri-user-line"></i>
            </div>
            <div class="profile-details">
                <p>{{ Auth::user()->name }}</p>
                <span>{{ Auth::user()->email }}</span>
            </div>
        </a>
        <button type="button" onclick="openLogoutModal()" class="logout-btn">
            <i class="ri-logout-box-r-line"></i> Sign Out
        </button>
    </div>
</aside>

<div class="main-content" id="mainContent">
    <div class="top-bar">
        <div class="flex items-center gap-3">
            <button class="menu-toggle" id="menuToggle"><i class="ri-menu-line"></i></button>
            <div>
                <h2 style="font-weight:800;color:var(--navy);font-size:1.15rem;margin:0;">My Profile</h2>
                <p class="text-xs text-gray-500 hidden md:block">Manage your professional profile and qualification details</p>
            </div>
        </div>
    </div>

    <div class="p-4 md:p-6">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-xl mb-6 shadow-sm font-semibold text-sm">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-xl mb-6 shadow-sm text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Profile Details Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <div class="text-center">
                        <div class="relative inline-block">
                            <div class="h-32 w-32 rounded-full border-4 border-slate-100 bg-slate-50 flex items-center justify-center mx-auto overflow-hidden shadow-sm">
                                @if($user->avatar)
                                    <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                                @else
                                    <i class="ri-user-star-line text-5xl text-slate-400"></i>
                                @endif
                            </div>
                            <button onclick="document.getElementById('avatar-input').click()" 
                                    class="absolute bottom-0 right-0 bg-yellow-400 text-[#0A1F44] p-2 rounded-full shadow hover:bg-yellow-500 transition border-2 border-white flex items-center justify-center w-9 h-9">
                                <i class="ri-camera-fill text-sm"></i>
                            </button>
                            
                            <form method="POST" action="{{ route('faculty.avatar.update') }}" enctype="multipart/form-data" id="avatar-form" class="hidden">
                                @csrf
                                <input type="file" id="avatar-input" name="avatar" accept="image/*" onchange="document.getElementById('avatar-form').submit()">
                            </form>
                        </div>
                        <h3 class="text-xl font-extrabold mt-4" style="color:var(--navy);">{{ $user->name }}</h3>
                        <p class="text-sm font-semibold text-gray-500 mt-1">{{ $user->email }}</p>
                        
                        <div class="mt-3 flex justify-center gap-1.5">
                            <span class="badge badge-navy uppercase tracking-wider text-[10px] font-black">Faculty Member</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 mt-6 pt-6 space-y-3.5">
                        <div class="flex justify-between items-center bg-slate-50 px-4 py-2.5 rounded-xl border border-gray-100">
                            <span class="text-sm font-semibold text-gray-600">Courses Taught</span>
                            <span class="badge badge-blue font-extrabold">{{ Auth::user()->courses()->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center bg-slate-50 px-4 py-2.5 rounded-xl border border-gray-100">
                            <span class="text-sm font-semibold text-gray-600">Average Evaluation</span>
                            <span class="badge badge-gold font-extrabold"><i class="ri-star-fill text-[10px] mr-1"></i> {{ number_format(Auth::user()->facultyEvaluationsReceived()->avg('rating') ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center bg-slate-50 px-4 py-2.5 rounded-xl border border-gray-100">
                            <span class="text-sm font-semibold text-gray-600">Central Files</span>
                            <span class="badge badge-green font-extrabold">{{ Auth::user()->uploadedAdminFiles()->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Form Details -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                        <h3 class="font-extrabold text-slate-800 flex items-center gap-2" style="color:var(--navy);"><i class="ri-user-settings-line text-blue-500"></i> Edit Profile Information</h3>
                    </div>
                    <div class="p-6">
                        <form method="POST" action="{{ route('faculty.profile.update') }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name *</label>
                                    <input type="text" name="name" required value="{{ old('name', $user->name) }}"
                                           class="w-full border border-gray-300 rounded-xl px-4 py-2.5 outline-none transition text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address *</label>
                                    <input type="email" name="email" required value="{{ old('email', $user->email) }}"
                                           class="w-full border border-gray-300 rounded-xl px-4 py-2.5 outline-none transition text-sm">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Specialization</label>
                                    <input type="text" name="specialization" value="{{ old('specialization', $user->specialization ?? '') }}" placeholder="e.g. Computer Science, Mathematics"
                                           class="w-full border border-gray-300 rounded-xl px-4 py-2.5 outline-none transition text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Qualification</label>
                                    <input type="text" name="qualification" value="{{ old('qualification', $user->qualification ?? '') }}" placeholder="e.g. PhD, MS"
                                           class="w-full border border-gray-300 rounded-xl px-4 py-2.5 outline-none transition text-sm">
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Bio</label>
                                <textarea name="bio" rows="4" 
                                          class="w-full border border-gray-300 rounded-xl px-4 py-2.5 outline-none transition text-sm"
                                          placeholder="Tell students about yourself...">{{ old('bio', $user->bio ?? '') }}</textarea>
                            </div>
                            
                            <div class="flex justify-end pt-4 border-t border-gray-100">
                                <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-sm text-[#0A1F44] transition shadow-sm bg-yellow-400 hover:bg-yellow-500">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="logoutModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h3><i class="ri-logout-box-r-line"></i> Confirm Sign Out</h3>
            <button class="modal-close" onclick="closeLogoutModal()">&times;</button>
        </div>
        <div style="padding:1.8rem 1.5rem;text-align:center;">
            <p style="font-weight:600;color:var(--navy);">Are you sure you want to sign out?</p>
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
    const menuToggle=document.getElementById('menuToggle'),sidebar=document.getElementById('sidebar');
    if(menuToggle){
        menuToggle.addEventListener('click',()=>sidebar.classList.toggle('mobile-open'))
    }
    document.addEventListener('click',e=>{
        const m=window.innerWidth<=1024;
        if(m&&sidebar&&sidebar.classList.contains('mobile-open')&&!sidebar.contains(e.target)&&!menuToggle.contains(e.target)){
            sidebar.classList.remove('mobile-open')
        }
    });

    function openLogoutModal(){
        document.getElementById('logoutModal').classList.add('active');
        document.body.style.overflow='hidden'
    }
    function closeLogoutModal(){
        document.getElementById('logoutModal').classList.remove('active');
        document.body.style.overflow=''
    }
    document.addEventListener('keydown',e=>{
        if(e.key==='Escape'){
            document.querySelectorAll('.modal-overlay.active').forEach(m=>m.classList.remove('active'));
            document.body.style.overflow=''
        }
    });
</script>
</body>
</html>