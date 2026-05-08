<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Announcement - {{ $announcement->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-indigo-800 text-white fixed h-full overflow-y-auto">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Nu Clicks LMS</h1>
                <p class="text-sm text-indigo-200 mt-2">Faculty Portal</p>
            </div>
            <nav class="mt-6">
                <div class="px-4 mb-4">
                    <p class="text-xs text-indigo-300 uppercase tracking-wider">Main</p>
                </div>
                <a href="{{ route('faculty.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-dashboard-line mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('faculty.students') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-user-line mr-3"></i>
                    <span>Students</span>
                </a>
                <a href="{{ route('faculty.courses') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-book-line mr-3"></i>
                    <span>Courses</span>
                </a>
                
                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs text-indigo-300 uppercase tracking-wider">Quiz Management</p>
                </div>
                <a href="{{ route('faculty.quiz.create') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-quiz-line mr-3"></i>
                    <span>Create Quiz</span>
                </a>
                <a href="{{ route('faculty.quizzes.list') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-list-check mr-3"></i>
                    <span>All Quizzes</span>
                </a>
                <a href="{{ route('faculty.question.bank') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-database-2-line mr-3"></i>
                    <span>Question Bank</span>
                </a>
                
                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs text-indigo-300 uppercase tracking-wider">Analytics</p>
                </div>
                <a href="{{ route('faculty.results.index') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-bar-chart-line mr-3"></i>
                    <span>Results & Analytics</span>
                </a>
                <a href="{{ route('faculty.grading') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
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
                        <h2 class="text-xl font-semibold text-gray-800">Edit Announcement</h2>
                        <p class="text-sm text-gray-600">{{ $announcement->course->code }} - {{ $announcement->course->name }}</p>
                    </div>
                    <a href="{{ route('faculty.announcements', $announcement->course_id) }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                        Back to Announcements
                    </a>
                </div>
            </div>

            <div class="p-6 max-w-3xl mx-auto">
                <div class="bg-white rounded-lg shadow p-6">
                    <form action="{{ route('faculty.announcement.update', $announcement->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                            <input type="text" name="title" required value="{{ old('title', $announcement->title) }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                            <textarea name="content" rows="6" required 
                                      class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">{{ old('content', $announcement->content) }}</textarea>
                        </div>
                        
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('faculty.announcements', $announcement->course_id) }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                Cancel
                            </a>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                Update Announcement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>