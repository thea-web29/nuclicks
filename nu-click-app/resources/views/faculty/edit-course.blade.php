<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course - {{ $course->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-indigo-800 text-white h-full fixed">
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
                <a href="{{ route('faculty.courses') }}" class="flex items-center px-6 py-3 bg-indigo-900">
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
                        <h2 class="text-xl font-semibold text-gray-800">Edit Course</h2>
                        <p class="text-sm text-gray-600">Update course information</p>
                    </div>
                    <a href="{{ route('faculty.course.details', $course->id) }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                        Back to Course Details
                    </a>
                </div>
            </div>

            <div class="p-6 max-w-3xl">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="bg-white rounded-lg shadow p-6">
                    <form action="{{ route('faculty.update.course', $course->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Course Code *</label>
                            <input type="text" name="code" required 
                                   value="{{ old('code', $course->code) }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500"
                                   placeholder="e.g., CS101, MATH201">
                            <p class="text-xs text-gray-500 mt-1">Unique course identifier</p>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Course Name *</label>
                            <input type="text" name="name" required 
                                   value="{{ old('name', $course->name) }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500"
                                   placeholder="e.g., Introduction to Computer Science">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Description</label>
                            <textarea name="description" rows="4" 
                                      class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500"
                                      placeholder="Course description, objectives, prerequisites...">{{ old('description', $course->description) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Optional. Describe what students will learn.</p>
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Credits *</label>
                            <input type="number" name="credits" required min="1" max="6" 
                                   value="{{ old('credits', $course->credits) }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                            <p class="text-xs text-gray-500 mt-1">Number of credit hours (1-6)</p>
                        </div>
                        
                        <div class="flex justify-end space-x-2 pt-4 border-t">
                            <a href="{{ route('faculty.course.details', $course->id) }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                                Cancel
                            </a>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                Update Course
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Danger Zone -->
                <div class="mt-8 bg-red-50 border border-red-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-red-700 mb-2">Danger Zone</h3>
                    <p class="text-sm text-red-600 mb-4">Deleting a course will remove all associated data including materials, quizzes, and enrollments.</p>
                    <form action="{{ route('faculty.delete.course', $course->id) }}" method="POST" onsubmit="return confirm('Are you absolutely sure? This action cannot be undone!')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                            <i class="ri-delete-bin-line mr-1"></i> Delete Course Permanently
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>