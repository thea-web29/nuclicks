<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Submission - {{ $attempt->quiz->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-indigo-800 text-white fixed h-full overflow-y-auto">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Nu Clicks LMS</h1>
                <p class="text-sm text-indigo-200 mt-2">Grade Submission</p>
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
                <a href="{{ route('faculty.grading') }}" class="flex items-center px-6 py-3 bg-indigo-900">
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
                        <h2 class="text-xl font-semibold text-gray-800">Grade Submission</h2>
                        <p class="text-sm text-gray-600">{{ $attempt->quiz->title }} - {{ $attempt->quiz->course->code }} {{ $attempt->quiz->course->name }}</p>
                    </div>
                    <a href="{{ route('faculty.submissions', $attempt->quiz_id) }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                        Back to Submissions
                    </a>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Student Info Card -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="text-center">
                                <div class="h-20 w-20 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="ri-user-line text-3xl text-indigo-600"></i>
                                </div>
                                <h3 class="text-xl font-bold">{{ $attempt->student->name }}</h3>
                                <p class="text-gray-600">{{ $attempt->student->email }}</p>
                                <p class="text-sm text-gray-500 mt-2">Student ID: {{ $attempt->student->student_id ?? 'N/A' }}</p>
                            </div>
                            <div class="border-t mt-4 pt-4">
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Submitted:</span>
                                    <span class="font-medium">{{ $attempt->completed_at ? $attempt->completed_at->format('M d, Y h:i A') : 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Time Taken:</span>
                                    <span class="font-medium">
                                        @if($attempt->started_at && $attempt->completed_at)
                                            {{ $attempt->started_at->diffInMinutes($attempt->completed_at) }} minutes
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Quiz Total:</span>
                                    <span class="font-medium">{{ $attempt->quiz->total_points }} points</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Grading Form -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-semibold mb-4">Student Answers</h3>
                            
                            @php
                                // Get answers as array (already cast from JSON)
                                $answers = $attempt->answers ?? [];
                            @endphp
                            
                            <div class="space-y-6">
                                @foreach($attempt->quiz->questions as $index => $question)
                                    <div class="border rounded-lg p-4">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="flex items-center space-x-2">
                                                <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded">Q{{ $index + 1 }}</span>
                                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">
                                                    {{ strtoupper(str_replace('_', ' ', $question->question_type)) }}
                                                </span>
                                                <span class="text-sm text-gray-500">{{ $question->points }} points</span>
                                            </div>
                                        </div>
                                        
                                        <p class="font-medium text-gray-800 mb-3">{{ $question->question_text }}</p>
                                        
                                        <!-- Student Answer -->
                                        <div class="bg-gray-50 rounded-lg p-3 mb-3">
                                            <p class="text-sm text-gray-500 mb-1">Student's Answer:</p>
                                            <p class="text-gray-800">
                                                @php
                                                    $studentAnswer = isset($answers[$question->id]) ? $answers[$question->id] : 'No answer provided';
                                                @endphp
                                                {{ is_array($studentAnswer) ? implode(', ', $studentAnswer) : $studentAnswer }}
                                            </p>
                                        </div>
                                        
                                        <!-- Correct Answer (for MCQ and True/False) -->
                                        @if($question->question_type != 'essay')
                                            <div class="bg-green-50 rounded-lg p-3">
                                                <p class="text-sm text-green-600 mb-1">Correct Answer:</p>
                                                <p class="text-green-700">{{ $question->correct_answer }}</p>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <!-- Grade Form -->
                            <form action="{{ route('faculty.update.grade', $attempt->id) }}" method="POST" class="mt-6 pt-6 border-t">
                                @csrf
                                @method('PUT')
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Score *</label>
                                        <input type="number" name="score" required 
                                               value="{{ old('score', $attempt->score) }}"
                                               min="0" max="{{ $attempt->quiz->total_points }}"
                                               step="0.01"
                                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500"
                                               id="scoreInput">
                                        <p class="text-xs text-gray-500 mt-1">Maximum: {{ $attempt->quiz->total_points }} points</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Percentage</label>
                                        <input type="text" readonly
                                               id="percentageField"
                                               value="{{ $attempt->score ? round(($attempt->score / $attempt->quiz->total_points) * 100, 1) : 0 }}%"
                                               class="w-full border border-gray-300 bg-gray-50 rounded-lg px-4 py-2">
                                    </div>
                                </div>
                                
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Feedback</label>
                                    <textarea name="feedback" rows="4" 
                                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500"
                                              placeholder="Provide feedback to the student...">{{ old('feedback', $attempt->feedback) }}</textarea>
                                </div>
                                
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('faculty.submissions', $attempt->quiz_id) }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                        Cancel
                                    </a>
                                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                        Save Grade
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-calculate percentage when score changes
        const scoreInput = document.getElementById('scoreInput');
        const maxPoints = {{ $attempt->quiz->total_points }};
        const percentageField = document.getElementById('percentageField');
        
        if (scoreInput && percentageField) {
            scoreInput.addEventListener('input', function() {
                const score = parseFloat(this.value) || 0;
                const percentage = maxPoints > 0 ? (score / maxPoints) * 100 : 0;
                percentageField.value = percentage.toFixed(1) + '%';
                
                // Add visual feedback
                if (score > maxPoints) {
                    this.classList.add('border-red-500');
                    this.setCustomValidity('Score cannot exceed maximum points');
                } else {
                    this.classList.remove('border-red-500');
                    this.setCustomValidity('');
                }
            });
        }
    </script>
</body>
</html>