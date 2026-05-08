<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Progress - Nu Clicks LMS</title>
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
            <div class="bg-white shadow-sm px-6 py-4">
                <h2 class="text-xl font-semibold text-gray-800">Learning Progress</h2>
                <p class="text-sm text-gray-500">Track your course completion and performance</p>
            </div>

            <div class="p-6">
                <!-- Overall Progress Card -->
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-lg mb-8">
                    <div class="p-6 text-white">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-indigo-100 text-sm">Overall Progress</p>
                                <p class="text-4xl font-bold">{{ $averageProgress }}%</p>
                                <p class="text-indigo-100 text-sm mt-1">Across {{ $enrolledCourses->count() }} courses</p>
                            </div>
                            <div class="relative w-32 h-32">
                                <svg class="w-32 h-32 transform -rotate-90">
                                    <circle cx="64" cy="64" r="56" stroke="rgba(255,255,255,0.2)" stroke-width="12" fill="none"/>
                                    <circle cx="64" cy="64" r="56" stroke="white" stroke-width="12" fill="none"
                                            stroke-dasharray="351.86" stroke-dashoffset="{{ 351.86 - (351.86 * $averageProgress / 100) }}"
                                            class="transition-all duration-500"/>
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-2xl font-bold">{{ $averageProgress }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Progress List -->
                <div class="space-y-6">
                    @foreach($enrolledCourses as $enrollment)
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800">{{ $enrollment->course->name }}</h3>
                                        <p class="text-sm text-gray-500">{{ $enrollment->course->code }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-2xl font-bold text-indigo-600">{{ $enrollment->course_progress }}%</p>
                                        <p class="text-xs text-gray-500">Complete</p>
                                    </div>
                                </div>
                                
                                <!-- Progress Bar -->
                                <div class="mb-4">
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-green-500 rounded-full h-3 transition-all duration-500" style="width: {{ $enrollment->course_progress }}%"></div>
                                    </div>
                                </div>
                                
                                <!-- Stats Grid -->
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                    <div class="bg-blue-50 rounded-lg p-3 text-center">
                                        <p class="text-xs text-gray-500">Quizzes Completed</p>
                                        <p class="text-xl font-bold text-blue-600">{{ $enrollment->completed_quizzes }}/{{ $enrollment->total_quizzes }}</p>
                                    </div>
                                    <div class="bg-green-50 rounded-lg p-3 text-center">
                                        <p class="text-xs text-gray-500">Materials</p>
                                        <p class="text-xl font-bold text-green-600">{{ $enrollment->completed_materials }}/{{ $enrollment->total_materials }}</p>
                                    </div>
                                    <div class="bg-purple-50 rounded-lg p-3 text-center">
                                        <p class="text-xs text-gray-500">Avg. Quiz Score</p>
                                        @php
                                            $avgScore = $enrollment->quiz_scores->avg('percentage') ?? 0;
                                        @endphp
                                        <p class="text-xl font-bold text-purple-600">{{ round($avgScore) }}%</p>
                                    </div>
                                    <div class="bg-yellow-50 rounded-lg p-3 text-center">
                                        <p class="text-xs text-gray-500">Instructor</p>
                                        <p class="text-sm font-semibold text-yellow-700">{{ $enrollment->course->faculty->name ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                
                                <!-- Quiz Scores Breakdown -->
                                @if($enrollment->quiz_scores->count() > 0)
                                    <div class="border-t pt-4">
                                        <h4 class="font-semibold text-gray-700 mb-3">Quiz Performance</h4>
                                        <div class="space-y-2">
                                            @foreach($enrollment->quiz_scores as $quizScore)
                                                <div class="flex items-center justify-between">
                                                    <div class="flex-1">
                                                        <div class="flex justify-between text-sm mb-1">
                                                            <span class="text-gray-600">{{ $quizScore['title'] }}</span>
                                                            <span class="text-gray-600">{{ $quizScore['score'] }}/{{ $quizScore['total'] }}</span>
                                                        </div>
                                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                                            <div class="bg-indigo-600 rounded-full h-2" style="width: {{ $quizScore['percentage'] }}%"></div>
                                                        </div>
                                                    </div>
                                                    <span class="ml-4 text-sm font-semibold {{ $quizScore['percentage'] >= 70 ? 'text-green-600' : ($quizScore['percentage'] >= 50 ? 'text-yellow-600' : 'text-red-600') }}">
                                                        {{ $quizScore['percentage'] }}%
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>