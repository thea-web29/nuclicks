<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->name }} - Nu Clicks LMS</title>
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
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">{{ $course->code }} - {{ $course->name }}</h2>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{ Auth::user()->name }}</span>
                </div>
            </div>

            <div class="p-6">
                <!-- Course Header -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold mb-2">{{ $course->name }}</h1>
                            <p class="text-gray-600">{{ $course->code }}</p>
                            <p class="text-gray-700 mt-2">{{ $course->description ?? 'No description available.' }}</p>
                            <div class="mt-4">
                                <span class="text-sm text-gray-500"><i class="ri-user-line mr-1"></i> Instructor: {{ $course->faculty->name ?? 'Not assigned' }}</span>
                                <span class="text-sm text-gray-500 ml-4"><i class="ri-star-line mr-1"></i> Credits: {{ $course->credits }}</span>
                            </div>
                        </div>
                        <div class="text-right">
                            @if($enrollment->grade)
                                <div class="bg-green-100 px-4 py-2 rounded">
                                    <p class="text-sm text-gray-600">Current Grade</p>
                                    <p class="text-2xl font-bold text-green-600">{{ $enrollment->grade }}%</p>
                                    <p class="text-sm text-gray-500">{{ $enrollment->letter_grade }}</p>
                                </div>
                            @else
                                <div class="bg-yellow-100 px-4 py-2 rounded">
                                    <p class="text-sm text-gray-600">Status</p>
                                    <p class="font-semibold text-yellow-600">{{ ucfirst($enrollment->status) }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Announcements Section -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-lg font-semibold mb-4 flex items-center">
                        <i class="ri-megaphone-line mr-2 text-indigo-600"></i> Announcements
                    </h2>
                    @if($announcements && $announcements->count() > 0)
                        <div class="space-y-4">
                            @foreach($announcements as $announcement)
                                <div class="border-l-4 border-indigo-500 pl-4 py-2">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-semibold text-gray-800">{{ $announcement->title }}</h3>
                                            <p class="text-gray-600 text-sm mt-1">{{ $announcement->content }}</p>
                                        </div>
                                        <span class="text-xs text-gray-400">{{ $announcement->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">Posted by: {{ $announcement->faculty->name }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No announcements yet.</p>
                    @endif
                </div>

                <!-- Quizzes Section -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold flex items-center">
                            <i class="ri-quiz-line mr-2 text-indigo-600"></i> Quizzes
                        </h2>
                    </div>
                    @if($quizzes->count() > 0)
                        <div class="space-y-4">
                            @foreach($quizzes as $quiz)
                                <div class="border rounded-lg p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-semibold text-lg">{{ $quiz->title }}</h3>
                                            <p class="text-gray-600 text-sm">{{ $quiz->description ?? 'No description' }}</p>
                                            <div class="mt-2 text-sm text-gray-500">
                                                @if($quiz->duration_minutes)
                                                    <span><i class="ri-time-line mr-1"></i> Duration: {{ $quiz->duration_minutes }} minutes</span>
                                                @endif
                                                @if($quiz->start_date)
                                                    <span class="ml-4"><i class="ri-calendar-line mr-1"></i> Starts: {{ \Carbon\Carbon::parse($quiz->start_date)->format('M d, Y H:i') }}</span>
                                                @endif
                                                @if($quiz->end_date)
                                                    <span class="ml-4"><i class="ri-calendar-close-line mr-1"></i> Ends: {{ \Carbon\Carbon::parse($quiz->end_date)->format('M d, Y H:i') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            @php
                                                $now = now();
                                                $startDate = $quiz->start_date ? \Carbon\Carbon::parse($quiz->start_date) : null;
                                                $endDate = $quiz->end_date ? \Carbon\Carbon::parse($quiz->end_date) : null;
                                                $hasStarted = !$startDate || $now >= $startDate;
                                                $hasEnded = $endDate && $now > $endDate;
                                            @endphp
                                            
                                            @if($quiz->attempted > 0)
                                                <span class="bg-gray-500 text-white px-3 py-1 rounded text-sm flex items-center">
                                                    <i class="ri-check-line mr-1"></i> Completed
                                                </span>
                                            @elseif($hasEnded)
                                                <span class="bg-red-500 text-white px-3 py-1 rounded text-sm flex items-center">
                                                    <i class="ri-close-line mr-1"></i> Expired
                                                </span>
                                            @elseif(!$hasStarted)
                                                <span class="bg-yellow-500 text-white px-3 py-1 rounded text-sm flex items-center">
                                                    <i class="ri-time-line mr-1"></i> Upcoming
                                                </span>
                                            @else
                                                <a href="{{ route('student.quiz.take', $quiz->id) }}" 
                                                   class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center">
                                                    <i class="ri-play-line mr-1"></i> Take Quiz
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="ri-quiz-line text-6xl text-gray-300 mb-4 block"></i>
                            <p class="text-gray-500">No quizzes available for this course yet.</p>
                        </div>
                    @endif
                </div>

                <!-- Course Materials -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold mb-4 flex items-center">
                        <i class="ri-file-line mr-2 text-indigo-600"></i> Course Materials
                    </h2>
                    @if($course->materials->count() > 0)
                        <div class="space-y-3">
                            @foreach($course->materials as $material)
                                <div class="border rounded-lg p-4 flex justify-between items-center hover:bg-gray-50">
                                    <div>
                                        <h3 class="font-semibold">{{ $material->title }}</h3>
                                        @if($material->description)
                                            <p class="text-sm text-gray-600">{{ $material->description }}</p>
                                        @endif
                                        <p class="text-xs text-gray-400 mt-1">Uploaded: {{ $material->created_at->format('M d, Y') }}</p>
                                    </div>
                                    @if($material->file_path)
                                        <a href="{{ asset('storage/' . $material->file_path) }}" 
                                           class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 text-sm flex items-center" target="_blank">
                                            <i class="ri-download-line mr-1"></i> Download
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="ri-file-line text-6xl text-gray-300 mb-4 block"></i>
                            <p class="text-gray-500">No materials uploaded for this course yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>