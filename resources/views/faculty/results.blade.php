<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results - {{ $course->name }} | NU Clicks LMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-indigo-800 text-white fixed h-full">
            <div class="p-6">
                <h1 class="text-2xl font-bold">NU Clicks LMS</h1>
                <p class="text-sm text-indigo-200 mt-2">Results Analytics</p>
            </div>
            <nav class="mt-6">
                <div class="px-4 mb-4">
                    <p class="text-xs text-indigo-300 uppercase tracking-wider">Main</p>
                </div>
                <a href="{{ route('faculty.dashboard') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('faculty.dashboard') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-dashboard-line mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('faculty.students') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('faculty.students*') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-user-line mr-3"></i>
                    <span>Students</span>
                </a>
                <a href="{{ route('faculty.courses') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('faculty.courses*') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-book-line mr-3"></i>
                    <span>Courses</span>
                </a>
                
                <!-- Quiz Management Section -->
                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs text-indigo-300 uppercase tracking-wider">Quiz Management</p>
                </div>
                <a href="{{ route('faculty.quiz.create') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('faculty.quiz.create*') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-quiz-line mr-3"></i>
                    <span>Create Quiz</span>
                </a>
                <a href="{{ route('faculty.quizzes.list') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('faculty.quizzes.list*') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-list-check mr-3"></i>
                    <span>All Quizzes</span>
                </a>
                <a href="{{ route('faculty.question.bank') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('faculty.question.bank*') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-database-2-line mr-3"></i>
                    <span>Question Bank</span>
                </a>
                
                <!-- In the Quick Actions section -->
                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs text-indigo-300 uppercase tracking-wider">Analytics</p>
                </div>

                <!-- In the sidebar navigation -->
                <a href="{{ route('faculty.results.index') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('faculty.results*') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-bar-chart-line mr-3"></i>
                    <span>Results & Analytics</span>
                </a>
                <a href="{{ route('faculty.grading') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('faculty.grading*') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-graduation-cap-line mr-3"></i>
                    <span>Grading</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <div class="bg-white shadow-sm px-6 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">{{ $course->code }} - {{ $course->name }}</h2>
                        <p class="text-sm text-gray-600">Course Analytics & Performance</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('faculty.results.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                            ← Back to Courses
                        </a>
                        <a href="{{ route('faculty.download.results', $course->id) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                            <i class="ri-download-line mr-1"></i> Download CSV
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <!-- Overview Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Students</p>
                                <p class="text-2xl font-bold">{{ $overallStats['total_students'] }}</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="ri-user-line text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Quizzes</p>
                                <p class="text-2xl font-bold">{{ $overallStats['total_quizzes'] }}</p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <i class="ri-quiz-line text-purple-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Avg. Score</p>
                                <p class="text-2xl font-bold">{{ round($overallStats['average_score']) }}%</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="ri-percent-line text-green-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Completion Rate</p>
                                <p class="text-2xl font-bold">{{ round($overallStats['completion_rate']) }}%</p>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <i class="ri-check-line text-yellow-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quiz Performance Table -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-6 border-b">
                        <h3 class="text-lg font-semibold">Quiz Performance</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quiz Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Attempts</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Average Score</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Highest</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lowest</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Passing Rate</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($analytics as $data)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $data['quiz']->title }}</div>
                                                <div class="text-sm text-gray-500">{{ $data['quiz']->total_points }} points</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $data['total_attempts'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="font-semibold">{{ round($data['average'], 1) }}</span>
                                                <span class="text-sm text-gray-500 ml-1">/ {{ $data['quiz']->total_points }}</span>
                                                <span class="ml-2 text-sm text-green-600">({{ $data['average_percentage'] }}%)</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-green-600 font-semibold">{{ $data['highest'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-red-600">{{ $data['lowest'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                                    <div class="bg-green-600 rounded-full h-2" style="width: {{ $data['passing_rate'] }}%"></div>
                                                </div>
                                                <span>{{ round($data['passing_rate']) }}%</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('faculty.submissions', $data['quiz']->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                                View Details
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if(count($analytics) == 0)
                        <div class="text-center py-8 text-gray-500">
                            No quizzes have been taken yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>