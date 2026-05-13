<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Evaluation - Nu Clicks LMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-indigo-800 text-white fixed h-full overflow-y-auto">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Nu Clicks LMS</h1>
                <p class="text-sm text-indigo-200 mt-2">Student Portal</p>
            </div>
            <nav class="mt-6">
                <div class="px-4 mb-4">
                    <p class="text-xs text-indigo-300 uppercase tracking-wider">Main</p>
                </div>
                <a href="{{ route('student.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-dashboard-line mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('student.courses') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-book-line mr-3"></i>
                    <span>My Courses</span>
                </a>
                <a href="{{ route('student.progress') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-bar-chart-line mr-3"></i>
                    <span>Progress</span>
                </a>
                <a href="{{ route('student.announcements') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-megaphone-line mr-3"></i>
                    <span>Announcements</span>
                </a>
                <a href="{{ route('student.notifications') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-notification-line mr-3"></i>
                    <span>Notifications</span>
                </a>
                <a href="{{ route('student.faculty.evaluation') }}" class="flex items-center px-6 py-3 bg-indigo-900">
                    <i class="ri-star-line mr-3"></i>
                    <span>Faculty Evaluation</span>
                </a>

                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs text-indigo-300 uppercase tracking-wider">Account</p>
                </div>
                <a href="{{ route('student.profile') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-user-line mr-3"></i>
                    <span>Profile</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-6 py-3 hover:bg-indigo-700 text-left">
                        <i class="ri-logout-box-line mr-3"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <!-- Top Bar -->
            <div class="bg-white shadow-sm px-6 py-4 flex justify-between items-center sticky top-0 z-10">
                <h2 class="text-xl font-semibold text-gray-800">Faculty Evaluation</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{ Auth::user()->name }}</span>
                </div>
            </div>

            <div class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        <i class="ri-checkbox-circle-line mr-2"></i>{{ session('success') }}
                    </div>
                @endif

                <!-- Page Header -->
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl p-6 mb-8 text-white shadow-lg">
                    <div class="flex items-center space-x-4">
                        <div class="bg-white bg-opacity-20 p-3 rounded-full">
                            <i class="ri-star-fill text-3xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold">Faculty Evaluation</h3>
                            <p class="text-indigo-100 mt-1">Rate your instructors and help improve the quality of education.</p>
                        </div>
                    </div>
                </div>

                @if($enrolledCourses->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($enrolledCourses as $course)
                            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                <!-- Card Header -->
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2"></div>
                                <div class="p-6">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded font-medium">{{ $course->code }}</span>
                                            <h4 class="font-bold text-lg text-gray-800 mt-2">{{ $course->name }}</h4>
                                        </div>
                                        <div class="bg-indigo-50 p-3 rounded-full">
                                            <i class="ri-user-star-line text-indigo-600 text-xl"></i>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-3 mb-5 p-3 bg-gray-50 rounded-lg">
                                        <div class="bg-indigo-100 p-2 rounded-full">
                                            <i class="ri-user-line text-indigo-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Instructor</p>
                                            <p class="font-semibold text-gray-800">{{ $course->faculty->name }}</p>
                                        </div>
                                    </div>

                                    <!-- Evaluation Form -->
                                    <form class="evaluation-form space-y-4" data-course="{{ $course->id }}">
                                        @csrf
                                        <!-- Teaching Effectiveness -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Teaching Effectiveness</label>
                                            <div class="star-rating flex space-x-1" data-field="teaching">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <button type="button" data-value="{{ $i }}"
                                                        class="star-btn text-2xl text-gray-300 hover:text-yellow-400 transition-colors focus:outline-none"
                                                        title="{{ $i }} star{{ $i > 1 ? 's' : '' }}">
                                                        <i class="ri-star-fill"></i>
                                                    </button>
                                                @endfor
                                            </div>
                                        </div>

                                        <!-- Subject Knowledge -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Subject Knowledge</label>
                                            <div class="star-rating flex space-x-1" data-field="knowledge">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <button type="button" data-value="{{ $i }}"
                                                        class="star-btn text-2xl text-gray-300 hover:text-yellow-400 transition-colors focus:outline-none"
                                                        title="{{ $i }} star{{ $i > 1 ? 's' : '' }}">
                                                        <i class="ri-star-fill"></i>
                                                    </button>
                                                @endfor
                                            </div>
                                        </div>

                                        <!-- Communication Skills -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Communication Skills</label>
                                            <div class="star-rating flex space-x-1" data-field="communication">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <button type="button" data-value="{{ $i }}"
                                                        class="star-btn text-2xl text-gray-300 hover:text-yellow-400 transition-colors focus:outline-none"
                                                        title="{{ $i }} star{{ $i > 1 ? 's' : '' }}">
                                                        <i class="ri-star-fill"></i>
                                                    </button>
                                                @endfor
                                            </div>
                                        </div>

                                        <!-- Comments -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Additional Comments <span class="text-gray-400">(optional)</span></label>
                                            <textarea rows="3"
                                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 resize-none"
                                                placeholder="Share your thoughts about this instructor..."></textarea>
                                        </div>

                                        <button type="submit"
                                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors flex items-center justify-center space-x-2">
                                            <i class="ri-send-plane-line"></i>
                                            <span>Submit Evaluation</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow p-12 text-center">
                        <i class="ri-star-line text-6xl text-gray-300 mb-4 block"></i>
                        <h3 class="text-lg font-semibold text-gray-600 mb-2">No Courses to Evaluate</h3>
                        <p class="text-gray-500">You need to be enrolled in a course with an assigned instructor to submit an evaluation.</p>
                        <a href="{{ route('student.courses') }}"
                           class="inline-block mt-6 bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                            Browse Courses
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Star rating interaction
        document.querySelectorAll('.star-rating').forEach(function(ratingGroup) {
            const stars = ratingGroup.querySelectorAll('.star-btn');

            stars.forEach(function(star, index) {
                // Hover effect
                star.addEventListener('mouseenter', function() {
                    stars.forEach(function(s, i) {
                        s.classList.toggle('text-yellow-400', i <= index);
                        s.classList.toggle('text-gray-300', i > index);
                    });
                });

                // Reset on leave (unless selected)
                star.addEventListener('mouseleave', function() {
                    const selected = ratingGroup.dataset.selected;
                    stars.forEach(function(s, i) {
                        if (selected) {
                            s.classList.toggle('text-yellow-400', i < parseInt(selected));
                            s.classList.toggle('text-gray-300', i >= parseInt(selected));
                        } else {
                            s.classList.remove('text-yellow-400');
                            s.classList.add('text-gray-300');
                        }
                    });
                });

                // Click to select
                star.addEventListener('click', function() {
                    const value = parseInt(this.dataset.value);
                    ratingGroup.dataset.selected = value;
                    stars.forEach(function(s, i) {
                        s.classList.toggle('text-yellow-400', i < value);
                        s.classList.toggle('text-gray-300', i >= value);
                    });
                });
            });
        });

        // Form submission (UI-only demo)
        document.querySelectorAll('.evaluation-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const btn = form.querySelector('button[type="submit"]');
                btn.disabled = true;
                btn.innerHTML = '<i class="ri-checkbox-circle-line"></i> <span>Evaluation Submitted!</span>';
                btn.classList.replace('bg-indigo-600', 'bg-green-500');
                btn.classList.replace('hover:bg-indigo-700', 'hover:bg-green-500');
            });
        });
    </script>
</body>
</html>
