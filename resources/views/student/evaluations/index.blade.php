<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Faculty Evaluation - NU Clicks LMS</title>
    
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

        /* Sidebar - Same as before */
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

        /* Logout Confirmation Modal - Same as Faculty */
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

<!-- ========== SIDEBAR (STUDENT VERSION) ========== -->
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
                @if(isset($unreadNotifications) && $unreadNotifications > 0)
                    <span class="ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $unreadNotifications }}</span>
                @endif
            </a>
            <a href="{{ route('student.faculty.evaluation') }}" class="nav-item {{ request()->routeIs('student.faculty.evaluation') ? 'active' : '' }}">
                <i class="ri-star-line"></i> Faculty Evaluation
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Account</div>
            <a href="{{ route('student.profile') }}" class="nav-item">
                <i class="ri-user-line"></i> Profile
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
        
        <!-- Logout Button with Confirmation -->
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
        <h2 class="page-title text-lg md:text-xl">Faculty Evaluation</h2>
    </div>

    <div class="p-4 md:p-6">
        <!-- Page Header -->
        <div class="bg-gradient-to-r from-blue-900 to-indigo-800 rounded-2xl p-6 mb-8 text-white shadow-lg">
            <div class="flex items-center space-x-4">
                <div class="bg-white bg-opacity-20 p-3 rounded-full">
                    <i class="ri-star-fill text-3xl text-yellow-400"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold">Faculty Evaluation</h3>
                    <p class="text-indigo-100 mt-1">Rate your instructors and help improve the quality of education.</p>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-5 py-4 rounded-2xl mb-6 flex items-center gap-3">
                <i class="ri-check-line text-xl"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(isset($isClosed) && $isClosed)
            <div class="dashboard-card p-12 text-center">
                <i class="ri-lock-fill text-7xl text-gray-300 mb-5 block"></i>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Evaluation Period Closed</h3>
                <p class="text-gray-500">The faculty evaluation period is currently closed or has ended.</p>
                <a href="{{ route('student.dashboard') }}"
                   class="inline-flex mt-6 bg-blue-800 text-white px-6 py-3 rounded-xl hover:bg-blue-900 transition-colors font-medium">
                    Back to Dashboard
                </a>
            </div>
        @elseif($enrolledCourses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($enrolledCourses as $course)
                    <div class="dashboard-card overflow-hidden transition hover:-translate-y-1 hover:shadow-xl">
                        <!-- Card Header -->
                        <div class="h-2" style="background: var(--gold);"></div>
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <span class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full font-medium">{{ $course->code }}</span>
                                    <h4 class="font-bold text-lg text-gray-800 mt-3">{{ $course->name }}</h4>
                                </div>
                                <div class="bg-indigo-50 p-3 rounded-xl border border-indigo-100">
                                    <i class="ri-user-star-line text-blue-800 text-xl"></i>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3 mb-5 p-4 bg-gray-50 rounded-xl border border-gray-100">
                                <div class="bg-blue-100 p-2 rounded-lg">
                                    <i class="ri-user-line text-blue-800"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Instructor</p>
                                    <p class="font-bold text-gray-800">{{ $course->faculty->name ?? 'Not Assigned' }}</p>
                                </div>
                            </div>

                            <!-- Evaluation Form -->
                            @if(in_array($course->id, $evaluatedCourseIds))
                            <div class="bg-green-50 text-green-800 p-6 rounded-xl border border-green-200 text-center mt-4">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="ri-checkbox-circle-fill text-3xl text-green-600"></i>
                                </div>
                                <h4 class="font-bold text-lg mb-1">Already Evaluated</h4>
                                <p class="text-sm opacity-80">Thank you for submitting your feedback for this course.</p>
                            </div>
                            @elseif($course->faculty)
                            <form class="evaluation-form space-y-5" data-course="{{ $course->id }}" data-faculty="{{ $course->faculty->id }}">
                                @csrf
                                <!-- Teaching Effectiveness -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Teaching Effectiveness</label>
                                    <div class="star-rating flex space-x-2" data-field="teaching">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" data-value="{{ $i }}"
                                                class="star-btn text-2xl text-gray-200 hover:text-yellow-400 transition-colors focus:outline-none transform hover:scale-110"
                                                title="{{ $i }} star{{ $i > 1 ? 's' : '' }}">
                                                <i class="ri-star-fill"></i>
                                            </button>
                                        @endfor
                                    </div>
                                </div>

                                <!-- Subject Knowledge -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Subject Knowledge</label>
                                    <div class="star-rating flex space-x-2" data-field="knowledge">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" data-value="{{ $i }}"
                                                class="star-btn text-2xl text-gray-200 hover:text-yellow-400 transition-colors focus:outline-none transform hover:scale-110"
                                                title="{{ $i }} star{{ $i > 1 ? 's' : '' }}">
                                                <i class="ri-star-fill"></i>
                                            </button>
                                        @endfor
                                    </div>
                                </div>

                                <!-- Communication Skills -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Communication Skills</label>
                                    <div class="star-rating flex space-x-2" data-field="communication">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" data-value="{{ $i }}"
                                                class="star-btn text-2xl text-gray-200 hover:text-yellow-400 transition-colors focus:outline-none transform hover:scale-110"
                                                title="{{ $i }} star{{ $i > 1 ? 's' : '' }}">
                                                <i class="ri-star-fill"></i>
                                            </button>
                                        @endfor
                                    </div>
                                </div>

                                <!-- Comments -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Additional Comments <span class="text-gray-400 font-normal">(optional)</span></label>
                                    <textarea rows="3"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm text-gray-700 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 resize-none transition"
                                        placeholder="Share your thoughts about this instructor..."></textarea>
                                </div>

                                <button type="submit"
                                    class="w-full bg-blue-800 hover:bg-blue-900 text-white font-semibold py-3 px-4 rounded-xl transition-all shadow-md hover:shadow-lg flex items-center justify-center space-x-2">
                                    <i class="ri-send-plane-line"></i>
                                    <span>Submit Evaluation</span>
                                </button>
                            </form>
                            @else
                            <div class="bg-yellow-50 text-yellow-800 p-4 rounded-xl border border-yellow-200 text-sm flex items-center gap-2">
                                <i class="ri-error-warning-line text-lg"></i>
                                No faculty assigned to evaluate for this course.
                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="dashboard-card p-12 text-center">
                <i class="ri-star-line text-7xl text-gray-200 mb-5 block"></i>
                <h3 class="text-xl font-bold text-gray-800 mb-2">No Courses to Evaluate</h3>
                <p class="text-gray-500">You need to be enrolled in a course with an assigned instructor to submit an evaluation.</p>
                <a href="{{ route('student.courses') }}"
                   class="inline-flex mt-6 bg-blue-800 text-white px-6 py-3 rounded-xl hover:bg-blue-900 transition-colors font-medium">
                    Browse Courses
                </a>
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

    // Star rating interaction
    document.querySelectorAll('.star-rating').forEach(function(ratingGroup) {
        const stars = ratingGroup.querySelectorAll('.star-btn');

        stars.forEach(function(star, index) {
            // Hover effect
            star.addEventListener('mouseenter', function() {
                stars.forEach(function(s, i) {
                    s.classList.toggle('text-yellow-400', i <= index);
                    s.classList.toggle('text-gray-200', i > index);
                });
            });

            // Reset on leave (unless selected)
            star.addEventListener('mouseleave', function() {
                const selected = ratingGroup.dataset.selected;
                stars.forEach(function(s, i) {
                    if (selected) {
                        s.classList.toggle('text-yellow-400', i < parseInt(selected));
                        s.classList.toggle('text-gray-200', i >= parseInt(selected));
                    } else {
                        s.classList.remove('text-yellow-400');
                        s.classList.add('text-gray-200');
                    }
                });
            });

            // Click to select
            star.addEventListener('click', function() {
                const value = parseInt(this.dataset.value);
                ratingGroup.dataset.selected = value;
                stars.forEach(function(s, i) {
                    s.classList.toggle('text-yellow-400', i < value);
                    s.classList.toggle('text-gray-200', i >= value);
                });
            });
        });
    });

    // Form submission
    document.querySelectorAll('.evaluation-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = form.querySelector('button[type="submit"]');
            const courseId = form.dataset.course;
            const facultyId = form.dataset.faculty;
            
            // Get ratings
            const teaching = form.querySelector('.star-rating[data-field="teaching"]').dataset.selected;
            const knowledge = form.querySelector('.star-rating[data-field="knowledge"]').dataset.selected;
            const communication = form.querySelector('.star-rating[data-field="communication"]').dataset.selected;
            const comment = form.querySelector('textarea').value;
            
            if (!teaching || !knowledge || !communication) {
                alert('Please provide a rating for all criteria.');
                return;
            }

            const payload = {
                _token: form.querySelector('input[name="_token"]').value,
                course_id: courseId,
                faculty_id: facultyId,
                teaching: teaching,
                knowledge: knowledge,
                communication: communication,
                comment: comment
            };

            btn.disabled = true;
            btn.innerHTML = '<i class="ri-loader-4-line animate-spin"></i> <span>Submitting...</span>';

            fetch("{{ route('student.faculty.evaluation.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json().then(data => ({status: res.status, body: data})))
            .then(result => {
                if(result.status === 200) {
                    btn.innerHTML = '<i class="ri-checkbox-circle-line"></i> <span>Evaluation Submitted!</span>';
                    btn.classList.replace('bg-blue-800', 'bg-green-600');
                    btn.classList.replace('hover:bg-blue-900', 'hover:bg-green-700');
                    
                    form.querySelectorAll('button.star-btn').forEach(b => b.disabled = true);
                    form.querySelectorAll('textarea').forEach(txt => txt.disabled = true);
                } else {
                    alert(result.body.message || 'Error submitting evaluation');
                    btn.disabled = false;
                    btn.innerHTML = '<i class="ri-send-plane-line"></i> <span>Submit Evaluation</span>';
                }
            })
            .catch(err => {
                alert('Something went wrong. Please try again.');
                btn.disabled = false;
                btn.innerHTML = '<i class="ri-send-plane-line"></i> <span>Submit Evaluation</span>';
            });
        });
    });
</script>
</body>
</html>
