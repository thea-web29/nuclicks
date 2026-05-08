<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course - Nu Clicks LMS</title>
    <!-- External Libraries -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        /* ========== CUSTOM STYLES ========== */
        /* Add any custom CSS overrides here */
        /* Example: custom focus ring, transitions, etc. */
        .focus-ring:focus {
            outline: none;
            ring: 2px solid #4f46e5;
        }
        /* Sidebar scroll behavior */
        .sidebar-nav {
            scrollbar-width: thin;
            scrollbar-color: #818cf8 #312e81;
        }
        .sidebar-nav::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar-nav::-webkit-scrollbar-track {
            background: #312e81;
        }
        .sidebar-nav::-webkit-scrollbar-thumb {
            background: #818cf8;
            border-radius: 3px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-indigo-800 text-white">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Nu Clicks LMS</h1>
                <p class="text-sm text-indigo-200 mt-2">Faculty Portal</p>
            </div>
            <nav class="mt-6 sidebar-nav">
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
                <!-- Analytics Section -->
                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs text-indigo-300 uppercase tracking-wider">Analytics</p>
                </div>
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
        <div class="flex-1">
            <div class="bg-white shadow-sm px-6 py-4">
                <h2 class="text-xl font-semibold text-gray-800">Create New Course</h2>
            </div>

            <div class="p-6 max-w-3xl">
                <div class="bg-white rounded-lg shadow p-6">
                    <form action="{{ route('faculty.store.course') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Course Code *</label>
                            <input type="text" name="code" required 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500"
                                   placeholder="e.g., CS101, MATH201">
                            @error('code')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Course Name *</label>
                            <input type="text" name="name" required 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500"
                                   placeholder="e.g., Introduction to Computer Science">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Description</label>
                            <textarea name="description" rows="4" 
                                      class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500"
                                      placeholder="Course description, objectives, prerequisites..."></textarea>
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Credits *</label>
                            <input type="number" name="credits" required min="1" max="6" value="3"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                            @error('credits')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('faculty.courses') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                                Cancel
                            </a>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                Create Course
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom JavaScript (if needed) -->
    <script>
        // Example: confirm before leaving unsaved changes? 
        // Placeholder for future JS functionality.
        console.log("Create Course page loaded");
    </script>
</body>
</html>