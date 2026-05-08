<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Quiz - {{ $quiz->title }} - Nu Clicks LMS</title>
    <scrip src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Quiz Header -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold mb-2">{{ $quiz->title }}</h1>
                        <p class="text-gray-600">{{ $quiz->description ?? 'No description' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Total Points: {{ $quiz->total_points }}</p>
                        @if($quiz->duration_minutes)
                            <p class="text-sm text-orange-600 font-semibold">Time Limit: {{ $quiz->duration_minutes }} minutes</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quiz Form -->
            <form method="POST" action="{{ route('student.quiz.submit', $quiz->id) }}" class="space-y-6">
                @csrf
                
                @foreach($quiz->questions as $index => $question)
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <div class="mb-4">
                            <span class="text-sm text-gray-500">Question {{ $index + 1 }} of {{ $quiz->questions->count() }}</span>
                            <span class="text-sm text-gray-500 ml-4">Points: {{ $question->points }}</span>
                        </div>
                        
                        <h3 class="text-lg font-semibold mb-4">{{ $question->question_text }}</h3>
                        
                        @if($question->question_type == 'mcq')
                            <div class="space-y-3">
                                @php
                                    $options = is_string($question->options) ? json_decode($question->options, true) : $question->options;
                                @endphp
                                @foreach($options as $option)
                                    <label class="flex items-center space-x-3 p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <input type="radio" 
                                               name="question_{{ $question->id }}" 
                                               value="{{ $option }}"
                                               class="form-radio text-indigo-600"
                                               required>
                                        <span>{{ $option }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @elseif($question->question_type == 'true_false')
                            <div class="space-y-3">
                                <label class="flex items-center space-x-3 p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <input type="radio" 
                                           name="question_{{ $question->id }}" 
                                           value="True"
                                           class="form-radio text-indigo-600"
                                           required>
                                    <span>True</span>
                                </label>
                                <label class="flex items-center space-x-3 p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <input type="radio" 
                                           name="question_{{ $question->id }}" 
                                           value="False"
                                           class="form-radio text-indigo-600"
                                           required>
                                    <span>False</span>
                                </label>
                            </div>
                        @else
                            <textarea name="question_{{ $question->id }}" 
                                      rows="4"
                                      class="w-full border rounded-lg p-3 focus:outline-none focus:border-indigo-500"
                                      placeholder="Enter your answer here..."
                                      required></textarea>
                        @endif
                    </div>
                @endforeach

                <div class="flex justify-between items-center">
                    <a href="{{ route('student.course.details', $quiz->course_id) }}" 
                       class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="bg-green-500 text-white px-8 py-3 rounded-lg hover:bg-green-600 transition font-semibold">
                        Submit Quiz
                    </button>
                </div>
            </form>
        </div>
    </div>

   <script>
    // Timer functionality with auto-submit
    @if($quiz->duration_minutes)
    let timeLeft = {{ $quiz->duration_minutes }} * 60;
    let timerStarted = false;
    let timerInterval = null;
    
    function startTimer() {
        if (timerStarted) return;
        timerStarted = true;
        
        const timerElement = document.createElement('div');
        timerElement.className = 'fixed top-4 right-4 bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-lg z-50 font-mono text-xl';
        timerElement.id = 'quizTimer';
        timerElement.innerHTML = '⏱️ ' + formatTime(timeLeft);
        document.body.appendChild(timerElement);
        
        timerInterval = setInterval(() => {
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                timerElement.innerHTML = '⏱️ Time\'s Up!';
                timerElement.classList.add('bg-red-600');
                alert('Time is up! Submitting your quiz...');
                document.querySelector('form').submit();
            } else {
                timeLeft--;
                timerElement.innerHTML = '⏱️ ' + formatTime(timeLeft);
                
                // Warning when 1 minute left
                if (timeLeft === 60) {
                    timerElement.classList.add('bg-yellow-600');
                    alert('1 minute remaining!');
                }
                // Warning when 5 minutes left
                if (timeLeft === 300) {
                    timerElement.classList.add('bg-yellow-500');
                }
            }
        }, 1000);
    }
    
    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = seconds % 60;
        return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
    }
    
    // Start timer when page loads
    document.addEventListener('DOMContentLoaded', startTimer);
    
    // Warn before leaving page
    window.addEventListener('beforeunload', function(e) {
        if (timerStarted && timerInterval) {
            e.preventDefault();
            e.returnValue = 'Your quiz is in progress. Are you sure you want to leave?';
            return 'Your quiz is in progress. Are you sure you want to leave?';
        }
    });
    @endif
</script>

</body>
</html>