<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results - {{ $attempt->quiz->title }}</title>
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
            <div class="bg-white shadow-sm px-6 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Quiz Results</h2>
                        <p class="text-sm text-gray-600">{{ $attempt->quiz->title }} - {{ $course->code }} {{ $course->name }}</p>
                    </div>
                    <a href="{{ route('student.course.details', $course->id) }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                        Back to Course
                    </a>
                </div>
            </div>

            <div class="p-6">
                <!-- Results Summary Card -->
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-lg mb-8">
                    <div class="p-6 text-white">
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                            <div class="text-center">
                                <p class="text-indigo-100 text-sm">Your Score</p>
                                <p class="text-2xl font-bold">{{ $attempt->score }}/{{ $attempt->quiz->total_points }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-indigo-100 text-sm">Percentage</p>
                                <p class="text-2xl font-bold">{{ $percentage }}%</p>
                            </div>
                            <div class="text-center">
                                <p class="text-indigo-100 text-sm">Grade</p>
                                <p class="text-2xl font-bold">{{ $letterGrade }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-indigo-100 text-sm">Correct Answers</p>
                                <p class="text-2xl font-bold">{{ $correctCount }}/{{ $totalQuestions }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-indigo-100 text-sm">Status</p>
                                <p class="text-2xl font-bold">
                                    @if($percentage >= 60)
                                        <span class="text-green-300">Passed</span>
                                    @else
                                        <span class="text-red-300">Failed</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feedback Card -->
                @if($attempt->feedback)
                <div class="bg-yellow-50 border-l-4 border-yellow-400 rounded-lg shadow p-4 mb-6">
                    <div class="flex items-center">
                        <i class="ri-chat-quote-line text-yellow-600 text-xl mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-yellow-800">Instructor Feedback</h4>
                            <p class="text-yellow-700">{{ $attempt->feedback }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Questions and Answers -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-6 border-b">
                        <h3 class="text-lg font-semibold">Question Breakdown</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        @foreach($questionsWithAnswers as $index => $item)
                            @php
                                $question = $item['question'];
                                $isCorrect = $item['is_correct'];
                                $studentAnswer = $item['student_answer'];
                            @endphp
                            <div class="border rounded-lg p-4 {{ $isCorrect ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50' }}">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex items-center space-x-2">
                                        <span class="bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded">Q{{ $index + 1 }}</span>
                                        <span class="text-sm text-gray-500">{{ $question->points }} points</span>
                                        @if($isCorrect)
                                            <span class="bg-green-500 text-white text-xs px-2 py-1 rounded flex items-center">
                                                <i class="ri-check-line mr-1"></i> Correct
                                            </span>
                                        @else
                                            <span class="bg-red-500 text-white text-xs px-2 py-1 rounded flex items-center">
                                                <i class="ri-close-line mr-1"></i> Incorrect
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <h4 class="font-semibold text-gray-800 mb-3">{{ $question->question_text }}</h4>
                                
                                <!-- Student Answer -->
                                <div class="mb-3">
                                    <p class="text-sm text-gray-500 mb-1">Your Answer:</p>
                                    <div class="bg-white rounded-lg p-3 border {{ $isCorrect ? 'border-green-300' : 'border-red-300' }}">
                                        <p class="text-gray-800">{{ $studentAnswer }}</p>
                                    </div>
                                </div>
                                
                                <!-- Correct Answer (if incorrect and not essay) -->
                                @if(!$isCorrect && $question->question_type != 'essay')
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Correct Answer:</p>
                                        <div class="bg-green-50 rounded-lg p-3 border border-green-300">
                                            <p class="text-green-700">{{ $question->correct_answer }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex justify-between">
                    <a href="{{ route('student.course.details', $course->id) }}" 
                       class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                        <i class="ri-arrow-left-line mr-1"></i> Back to Course
                    </a>
                    <button onclick="window.print()" 
                            class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                        <i class="ri-printer-line mr-1"></i> Print Results
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>