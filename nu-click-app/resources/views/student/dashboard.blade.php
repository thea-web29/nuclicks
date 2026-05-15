<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Nu Clicks LMS</title>
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
                <a href="{{ route('student.dashboard') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('student.dashboard') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-dashboard-line mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('student.courses') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('student.courses*') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-book-line mr-3"></i>
                    <span>My Courses</span>
                </a>
                <a href="{{ route('student.progress') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('student.progress*') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-bar-chart-line mr-3"></i>
                    <span>Progress</span>
                </a>
                <a href="{{ route('student.announcements') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('student.announcements*') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-megaphone-line mr-3"></i>
                    <span>Announcements</span>
                </a>
                <a href="{{ route('student.notifications') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('student.notifications*') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-notification-line mr-3"></i>
                    <span>Notifications</span>
                    @if(isset($unreadNotifications) && $unreadNotifications > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $unreadNotifications }}</span>
                    @endif
                </a>
                <a href="{{ route('student.faculty.evaluation') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('student.faculty.evaluation') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
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
                <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{ Auth::user()->name }}</span>
                </div>
            </div>

            <div class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Enrolled Courses</p>
                                <p class="text-3xl font-bold text-indigo-600">{{ $enrolledCourses->count() }}</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="ri-book-line text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Completed Quizzes</p>
                                <p class="text-3xl font-bold text-green-600">{{ $completedQuizzes }}</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="ri-checkbox-circle-line text-green-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Average Score</p>
                                <p class="text-3xl font-bold text-blue-600">{{ $averageScore }}%</p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <i class="ri-bar-chart-line text-purple-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Pending Quizzes</p>
                                <p class="text-3xl font-bold text-yellow-600">{{ $pendingQuizzes }}</p>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <i class="ri-time-line text-yellow-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- My Courses Section -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg shadow">
                            <div class="p-6 border-b">
                                <h3 class="text-lg font-semibold">My Enrolled Courses</h3>
                            </div>
                            <div class="p-6">
                                @if($enrolledCourses->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($enrolledCourses as $enrollment)
                                            <div class="border rounded-lg p-4 hover:shadow-md transition">
                                                <div class="flex justify-between items-start">
                                                    <div class="flex-1">
                                                        <div class="flex items-center space-x-2 mb-2">
                                                            <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded">{{ $enrollment->course->code }}</span>
                                                            <span class="text-xs text-gray-500">{{ $enrollment->course->credits }} credits</span>
                                                        </div>
                                                        <h4 class="font-semibold text-lg">{{ $enrollment->course->name }}</h4>
                                                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($enrollment->course->description ?? 'No description available', 100) }}</p>
                                                        <div class="flex items-center space-x-4 mt-3 text-sm text-gray-500">
                                                            <span><i class="ri-user-line mr-1"></i> Instructor: {{ $enrollment->course->faculty->name ?? 'N/A' }}</span>
                                                            <span><i class="ri-quiz-line mr-1"></i> {{ $enrollment->course->quizzes->count() }} Quizzes</span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-4">
                                                        <a href="{{ route('student.course.details', $enrollment->course->id) }}" 
                                                           class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 text-sm">
                                                            View Course
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- Progress Bar -->
                                                <div class="mt-4">
                                                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                                                        <span>Progress</span>
                                                        <span>{{ $enrollment->progress ?? 0 }}%</span>
                                                    </div>
                                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                                        <div class="bg-green-500 rounded-full h-2" style="width: {{ $enrollment->progress ?? 0 }}%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-12">
                                        <i class="ri-book-line text-6xl text-gray-300 mb-4 block"></i>
                                        <p class="text-gray-500">You are not enrolled in any courses yet.</p>
                                        <p class="text-sm text-gray-400 mt-2">Use the join code below to enroll in a course.</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Recent Announcements -->
                        <div class="bg-white rounded-lg shadow mt-8">
                            <div class="p-6 border-b">
                                <h3 class="text-lg font-semibold">Recent Announcements</h3>
                            </div>
                            <div class="p-6">
                                @if($announcements->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($announcements as $announcement)
                                            <div class="border-l-4 border-indigo-500 pl-4 py-2">
                                                <div class="flex justify-between items-start">
                                                    <div>
                                                        <h4 class="font-semibold">{{ $announcement->title }}</h4>
                                                        <p class="text-sm text-gray-600 mt-1">{{ $announcement->content }}</p>
                                                    </div>
                                                    <span class="text-xs text-gray-400">{{ $announcement->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="text-xs text-gray-500 mt-2">Course: {{ $announcement->course->name }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 text-center py-8">No announcements yet.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Quizzes Section -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow">
                            <div class="p-6 border-b">
                                <h3 class="text-lg font-semibold">Upcoming Quizzes</h3>
                            </div>
                            <div class="p-6">
                                @if($upcomingQuizzes->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($upcomingQuizzes as $quiz)
                                            <div class="border rounded-lg p-4">
                                                <div class="flex items-center justify-between mb-2">
                                                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Upcoming</span>
                                                    <span class="text-xs text-gray-500">{{ $quiz->questions->count() }} questions</span>
                                                </div>
                                                <h4 class="font-semibold">{{ $quiz->title }}</h4>
                                                <p class="text-sm text-gray-600 mt-1">{{ $quiz->course->name }}</p>
                                                <div class="mt-3 space-y-1 text-sm">
                                                    @if($quiz->start_date)
                                                        <div class="flex items-center text-gray-500">
                                                            <i class="ri-calendar-line mr-2"></i>
                                                            Starts: {{ \Carbon\Carbon::parse($quiz->start_date)->format('M d, Y h:i A') }}
                                                        </div>
                                                    @endif
                                                    @if($quiz->duration_minutes)
                                                        <div class="flex items-center text-gray-500">
                                                            <i class="ri-time-line mr-2"></i>
                                                            Duration: {{ $quiz->duration_minutes }} minutes
                                                        </div>
                                                    @endif
                                                    <div class="flex items-center text-gray-500">
                                                        <i class="ri-star-line mr-2"></i>
                                                        Points: {{ $quiz->total_points }}
                                                    </div>
                                                </div>
                                                <a href="{{ route('student.quiz.take', $quiz->id) }}" 
                                                   class="block text-center bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 mt-3">
                                                    Take Quiz
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-8">
                                        <i class="ri-quiz-line text-6xl text-gray-300 mb-4 block"></i>
                                        <p class="text-gray-500">No upcoming quizzes.</p>
                                        <p class="text-sm text-gray-400 mt-2">Check back later for new quizzes.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>