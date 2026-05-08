<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - Nu Clicks LMS</title>
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
                <a href="{{ route('student.courses') }}" class="flex items-center px-6 py-3 bg-indigo-900">
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
                <h2 class="text-xl font-semibold text-gray-800">My Courses</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{ Auth::user()->name }}</span>
                </div>
            </div>

            <div class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Join Course Card -->
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-lg mb-8">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row justify-between items-center">
                            <div class="text-white mb-4 md:mb-0">
                                <h3 class="text-xl font-bold">Join a New Course</h3>
                                <p class="text-indigo-100">Enter the course join code provided by your instructor</p>
                            </div>
                            <div>
                                <form action="{{ route('student.course.join') }}" method="POST" class="flex space-x-2">
                                    @csrf
                                    <input type="text" name="join_code" placeholder="Enter join code (e.g., ABC123)" 
                                           class="px-4 py-2 rounded-lg border-0 focus:ring-2 focus:ring-white"
                                           style="min-width: 200px;" required>
                                    <button type="submit" class="bg-white text-indigo-600 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100">
                                        <i class="ri-add-line mr-1"></i> Join Course
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enrolled Courses -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">My Enrolled Courses</h2>
                    @if($enrolledCourses->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($enrolledCourses as $course)
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2"></div>
                                    <div class="p-6">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3 class="text-xl font-bold text-gray-800">{{ $course->code }}</h3>
                                                <p class="text-gray-600 mt-1">{{ $course->name }}</p>
                                            </div>
                                            <div class="bg-blue-100 px-3 py-1 rounded-full">
                                                <span class="text-xs text-blue-600">{{ $course->credits }} credits</span>
                                            </div>
                                        </div>
                                        <p class="text-gray-500 text-sm mt-3">{{ Str::limit($course->description ?? 'No description available', 100) }}</p>
                                        <div class="mt-4 flex items-center justify-between text-sm">
                                            <div class="flex items-center text-gray-600">
                                                <i class="ri-quiz-line mr-1"></i>
                                                <span>{{ $course->quizzes->count() }} Quizzes</span>
                                            </div>
                                            <div class="flex items-center text-gray-600">
                                                <i class="ri-file-line mr-1"></i>
                                                <span>{{ $course->materials->count() }} Materials</span>
                                            </div>
                                        </div>
                                        <div class="mt-4 pt-3 border-t flex space-x-2">
                                            <a href="{{ route('student.course.details', $course->id) }}" 
                                               class="flex-1 text-center bg-indigo-600 text-white px-3 py-2 rounded hover:bg-indigo-700 text-sm">
                                                View Course
                                            </a>
                                            <form action="{{ route('student.course.leave', $course->id) }}" method="POST" class="flex-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full text-center bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 text-sm"
                                                        onclick="return confirm('Are you sure you want to leave this course?')">
                                                    Leave Course
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white rounded-lg shadow p-12 text-center">
                            <i class="ri-book-line text-6xl text-gray-300 mb-4 block"></i>
                            <p class="text-gray-500">You haven't enrolled in any courses yet.</p>
                            <p class="text-sm text-gray-400 mt-2">Use the join code above to enroll in a course.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>