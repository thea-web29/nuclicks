<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $quiz->title }} - Quiz Details</title>
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
                <a href="{{ route('admin.quizzes') }}" class="flex items-center px-6 py-3 bg-indigo-900">
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
                <a href="{{ route('admin.settings') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
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

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <div class="bg-white shadow-sm px-6 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Quiz Details</h2>
                        <p class="text-sm text-gray-600">{{ $quiz->title }} - {{ $quiz->course->code }} {{ $quiz->course->name }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.quizzes') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                            Back to Quizzes
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Quiz Info Card -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="text-center">
                                <div class="h-20 w-20 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="ri-quiz-line text-3xl text-indigo-600"></i>
                                </div>
                                <h3 class="text-xl font-bold">{{ $quiz->title }}</h3>
                                <p class="text-gray-600 text-sm mt-1">{{ $quiz->course->code }} - {{ $quiz->course->name }}</p>
                            </div>
                            <div class="border-t mt-6 pt-6">
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Total Questions:</span>
                                    <span class="font-semibold">{{ $quiz->questions_count ?? 0 }}</span>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Total Points:</span>
                                    <span class="font-semibold">{{ $quiz->total_points }}</span>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Duration:</span>
                                    <span class="font-semibold">{{ $quiz->duration_minutes ?? 'Unlimited' }} minutes</span>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Max Attempts:</span>
                                    <span class="font-semibold">{{ $quiz->max_attempts ?? 'Unlimited' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Attempts:</span>
                                    <span class="font-semibold">{{ $attempts->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Performance Stats -->
                    <div class="lg:col-span-2">
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-white rounded-lg shadow p-6 text-center">
                                <i class="ri-bar-chart-line text-3xl text-blue-600 mb-2 block"></i>
                                <p class="text-2xl font-bold">{{ $averageScore }}/{{ $quiz->total_points }}</p>
                                <p class="text-sm text-gray-500">Average Score</p>
                            </div>
                            <div class="bg-white rounded-lg shadow p-6 text-center">
                                <i class="ri-percent-line text-3xl text-green-600 mb-2 block"></i>
                                <p class="text-2xl font-bold">{{ $averagePercentage }}%</p>
                                <p class="text-sm text-gray-500">Average Percentage</p>
                            </div>
                        </div>

                        <!-- Attempts List -->
                        <div class="bg-white rounded-lg shadow">
                            <div class="p-6 border-b">
                                <h3 class="text-lg font-semibold">Student Attempts</h3>
                            </div>
                            <div class="p-6">
                                @if($attempts->count() > 0)
                                    <div class="space-y-3">
                                        @foreach($attempts as $attempt)
                                            @php
                                                $percentage = $quiz->total_points > 0 ? round(($attempt->score / $quiz->total_points) * 100, 1) : 0;
                                            @endphp
                                            <div class="border rounded-lg p-4">
                                                <div class="flex justify-between items-center">
                                                    <div>
                                                        <div class="flex items-center space-x-2">
                                                            <div class="h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                                                <i class="ri-user-line text-indigo-600 text-sm"></i>
                                                            </div>
                                                            <div>
                                                                <p class="font-medium">{{ $attempt->student->name }}</p>
                                                                <p class="text-xs text-gray-500">{{ $attempt->student->email }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <p class="font-semibold {{ $percentage >= 60 ? 'text-green-600' : 'text-red-600' }}">
                                                            {{ $attempt->score }}/{{ $quiz->total_points }} ({{ $percentage }}%)
                                                        </p>
                                                        <p class="text-xs text-gray-400">{{ $attempt->completed_at ? $attempt->completed_at->format('M d, Y h:i A') : 'In Progress' }}</p>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                                        <div class="bg-indigo-600 rounded-full h-2" style="width: {{ $percentage }}%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 text-center py-8">No attempts yet for this quiz.</p>
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