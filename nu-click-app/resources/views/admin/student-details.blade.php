<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details - {{ $student->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-indigo-800 text-white fixed h-full overflow-y-auto">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Nu Clicks LMS</h1>
                <p class="text-sm text-indigo-200 mt-2">Admin Portal</p>
            </div>
            <nav class="mt-6">
                <div class="px-4 mb-4">
                    <p class="text-xs text-indigo-300 uppercase tracking-wider">Main</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-dashboard-line mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.users') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-user-line mr-3"></i>
                    <span>Users</span>
                </a>
                <a href="{{ route('admin.courses') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-book-line mr-3"></i>
                    <span>Courses</span>
                </a>
                <a href="{{ route('admin.quizzes') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-quiz-line mr-3"></i>
                    <span>Quizzes</span>
                </a>
                <a href="{{ route('admin.analytics') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-bar-chart-line mr-3"></i>
                    <span>Analytics</span>
                </a>
                <a href="{{ route('admin.logs') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-history-line mr-3"></i>
                    <span>Activity Logs</span>
                </a>
                <a href="{{ route('admin.settings') }}"class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-settings-line mr-3"></i>
                    <span>Settings</span>
                </a>
                
                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs text-indigo-300 uppercase tracking-wider">Account</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-6 py-3 hover:bg-indigo-700 text-left">
                        <i class="ri-logout-box-line mr-3"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </div>

        <div class="flex-1 ml-64">
            <div class="bg-white shadow-sm px-6 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Student Details</h2>
                        <p class="text-sm text-gray-600">{{ $student->name }}</p>
                    </div>
                    <a href="{{ route('admin.users') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Back to Users</a>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Student Info Card -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="text-center">
                                <div class="h-24 w-24 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="ri-user-line text-4xl text-indigo-600"></i>
                                </div>
                                <h3 class="text-xl font-bold">{{ $student->name }}</h3>
                                <p class="text-gray-600">{{ $student->email }}</p>
                                <p class="text-sm text-gray-500 mt-2">Student ID: {{ $student->student_id ?? 'N/A' }}</p>
                                <div class="mt-4">
                                    <span class="px-2 py-1 text-xs rounded-full {{ $student->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($student->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="border-t mt-6 pt-6">
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Department:</span>
                                    <span class="font-medium">{{ $student->department ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Year Level:</span>
                                    <span class="font-medium">{{ $student->year_level ? $student->year_level . ' Year' : 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Average Score:</span>
                                    <span class="font-medium {{ $averageScore >= 70 ? 'text-green-600' : 'text-red-600' }}">{{ $averageScore }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enrolled Courses -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg shadow mb-6">
                            <div class="p-6 border-b">
                                <h3 class="text-lg font-semibold">Enrolled Courses</h3>
                            </div>
                            <div class="p-6">
                                @if($enrolledCourses->count() > 0)
                                    <div class="space-y-3">
                                        @foreach($enrolledCourses as $enrollment)
                                            <div class="border rounded-lg p-4">
                                                <div class="flex justify-between items-center">
                                                    <div>
                                                        <h4 class="font-semibold">{{ $enrollment->course->code }} - {{ $enrollment->course->name }}</h4>
                                                        <p class="text-sm text-gray-500">Enrolled: {{ $enrollment->created_at->format('M d, Y') }}</p>
                                                    </div>
                                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">{{ ucfirst($enrollment->status) }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 text-center py-4">No courses enrolled.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Quiz Attempts -->
                        <div class="bg-white rounded-lg shadow">
                            <div class="p-6 border-b">
                                <h3 class="text-lg font-semibold">Quiz Attempts</h3>
                            </div>
                            <div class="p-6">
                                @if($quizAttempts->count() > 0)
                                    <div class="space-y-3">
                                        @foreach($quizAttempts as $attempt)
                                            <div class="border rounded-lg p-4">
                                                <div class="flex justify-between items-center">
                                                    <div>
                                                        <h4 class="font-semibold">{{ $attempt->quiz->title }}</h4>
                                                        <p class="text-sm text-gray-500">{{ $attempt->quiz->course->name }}</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <p class="font-semibold {{ $attempt->score / $attempt->quiz->total_points >= 0.6 ? 'text-green-600' : 'text-red-600' }}">
                                                            {{ $attempt->score }}/{{ $attempt->quiz->total_points }}
                                                        </p>
                                                        <p class="text-xs text-gray-400">{{ $attempt->completed_at->format('M d, Y') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 text-center py-4">No quiz attempts yet.</p>
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