<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements - {{ $course->name }}</title>
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
                        <h2 class="text-xl font-semibold text-gray-800">{{ $course->code }} - {{ $course->name }}</h2>
                        <p class="text-sm text-gray-600">Manage course announcements</p>
                    </div>
                    <a href="{{ route('faculty.course.details', $course->id) }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                        Back to Course
                    </a>
                </div>
            </div>

            <div class="p-6">
                <!-- Create Announcement Form -->
                <div class="bg-white rounded-lg shadow mb-8">
                    <div class="p-6 border-b">
                        <h3 class="text-lg font-semibold">Post New Announcement</h3>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('faculty.announcement.store', $course->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                <input type="text" name="title" required 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                                <textarea name="content" rows="4" required 
                                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500"
                                          placeholder="Write your announcement here..."></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                                    <i class="ri-send-plane-line mr-1"></i> Post Announcement
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Announcements List -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b">
                        <h3 class="text-lg font-semibold">All Announcements</h3>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @if($announcements->count() > 0)
                            @foreach($announcements as $announcement)
                                <div class="p-6 hover:bg-gray-50">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2 mb-2">
                                                <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded">
                                                    {{ $announcement->created_at->format('M d, Y h:i A') }}
                                                </span>
                                                <span class="text-xs text-gray-500">
                                                    Posted by: {{ $announcement->faculty->name }}
                                                </span>
                                            </div>
                                            <h4 class="text-lg font-semibold text-gray-800">{{ $announcement->title }}</h4>
                                            <p class="text-gray-600 mt-2">{{ $announcement->content }}</p>
                                        </div>
                                        <div class="flex space-x-2 ml-4">
                                            <a href="{{ route('faculty.announcement.edit', $announcement->id) }}" 
                                               class="text-yellow-600 hover:text-yellow-800">
                                                <i class="ri-edit-line text-xl"></i>
                                            </a>
                                            <form action="{{ route('faculty.announcement.delete', $announcement->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Delete this announcement?')">
                                                    <i class="ri-delete-bin-line text-xl"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-12">
                                <i class="ri-megaphone-line text-6xl text-gray-300 mb-4 block"></i>
                                <p class="text-gray-500">No announcements yet.</p>
                                <p class="text-sm text-gray-400 mt-2">Post your first announcement above.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>