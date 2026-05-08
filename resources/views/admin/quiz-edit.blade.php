<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quiz - {{ $quiz->title }}</title>
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
                        <h2 class="text-xl font-semibold text-gray-800">Edit Quiz</h2>
                        <p class="text-sm text-gray-600">{{ $quiz->title }} - {{ $quiz->course->code }} {{ $quiz->course->name }}</p>
                    </div>
                    <a href="{{ route('admin.quizzes') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                        Back to Quizzes
                    </a>
                </div>
            </div>

            <div class="p-6 max-w-3xl mx-auto">
                <div class="bg-white rounded-lg shadow p-6">
                    <form action="{{ route('admin.quizzes.update', $quiz->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Course *</label>
                            <select name="course_id" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ $quiz->course_id == $course->id ? 'selected' : '' }}>
                                        {{ $course->code }} - {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Quiz Title *</label>
                            <input type="text" name="title" required value="{{ old('title', $quiz->title) }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="description" rows="3" 
                                      class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">{{ old('description', $quiz->description) }}</textarea>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Duration (minutes)</label>
                                <input type="number" name="duration_minutes" min="1" value="{{ old('duration_minutes', $quiz->duration_minutes) }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                <p class="text-xs text-gray-500 mt-1">Leave empty for unlimited</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Max Attempts</label>
                                <input type="number" name="max_attempts" min="1" max="10" value="{{ old('max_attempts', $quiz->max_attempts) }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                <p class="text-xs text-gray-500 mt-1">Maximum attempts per student</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                                <input type="datetime-local" name="start_date" value="{{ old('start_date', $quiz->start_date ? $quiz->start_date->format('Y-m-d\TH:i') : '') }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                                <input type="datetime-local" name="end_date" value="{{ old('end_date', $quiz->end_date ? $quiz->end_date->format('Y-m-d\TH:i') : '') }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Total Points</label>
                            <input type="number" name="total_points" readonly value="{{ $quiz->total_points }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100">
                            <p class="text-xs text-gray-500 mt-1">Calculated from questions</p>
                        </div>
                        
                        <div class="flex justify-end space-x-2 pt-4 border-t">
                            <a href="{{ route('admin.quizzes') }}" class="px-4 py-2 border border-gray-300 rounded-lg">Cancel</a>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Update Quiz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>