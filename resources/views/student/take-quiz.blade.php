<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Take Quiz - {{ $quiz->title }} - NU Horizon LMS</title>
    
    <!-- Google Fonts + Remix Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:opsz,wght@9..144,600;9..144,700;9..144,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            corePlugins: { preflight: false },
        }
    </script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #F8F6F1;
            color: #0A1F44;
            overflow-x: hidden;
        }

        :root {
            --navy: #0A1F44;
            --navy-mid: #1F3A6D;
            --navy-lite: #3D5FA0;
            --navy-pale: #EEF3FB;
            --gold: #FFD70F;
            --gold-d: #C49A00;
            --gold-mid: #F5C800;
            --gold-pale: #FFFBEA;
            --bg: #F8F6F1;
            --bg-2: #F2EEE5;
            --white: #FFFFFF;
            --txt-1: #0A1F44;
            --txt-2: #2C3E5C;
            --txt-3: #637089;
            --bdr: rgba(10,31,68,0.09);
            --bdr-gold: rgba(196,154,0,0.28);
            --card-shadow: 0 8px 20px rgba(10,31,68,0.05);
            --transition: all 0.25s ease;
            --danger-red: #dc2626;
            --danger-dark: #b91c1c;
            --blue-deep: #0A1F44;
        }

        .dashboard-card {
            background: white;
            border-radius: 1.2rem;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--bdr);
            overflow: hidden;
        }

        .option-label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            border-radius: 12px;
            border: 1px solid var(--bdr);
            background: white;
            cursor: pointer;
            transition: var(--transition);
        }

        .option-label:hover {
            border-color: var(--navy-lite);
            background: var(--navy-pale);
        }

        /* Checkbox/Radio Styling */
        input[type="radio"], input[type="checkbox"] {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid var(--navy-lite);
            border-radius: 50%;
            outline: none;
            cursor: pointer;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            transition: var(--transition);
        }

        input[type="radio"]:checked {
            border-color: var(--navy);
            background: var(--navy);
        }

        input[type="radio"]:checked::after {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--gold);
            display: block;
        }

        .timer-badge {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--navy);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 30px;
            box-shadow: 0 10px 25px rgba(10, 31, 68, 0.2);
            border: 2px solid var(--gold);
            z-index: 100;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 700;
            font-family: monospace;
            font-size: 1.2rem;
        }

        .timer-badge.warning {
            background: #d97706;
            border-color: #f59e0b;
        }

        .timer-badge.danger {
            background: var(--danger-red);
            border-color: #fca5a5;
            animation: pulse-red 1s infinite alternate;
        }

        @keyframes pulse-red {
            0% { transform: scale(1); }
            100% { transform: scale(1.05); }
        }

    </style>
</head>
<body class="py-8 md:py-12">

    <div class="max-w-4xl mx-auto px-4">
        <!-- Quiz Header -->
        <div class="dashboard-card bg-gradient-to-r from-slate-900 to-indigo-950 text-white p-6 md:p-8 mb-8 relative overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,215,15,0.12),transparent_45%)]"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div>
                    <span class="bg-indigo-600/30 text-indigo-300 border border-indigo-500/20 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                        Active Assessment
                    </span>
                    <h1 class="text-2xl md:text-4xl font-extrabold tracking-tight mt-3 text-white" style="font-family: 'Fraunces', serif;">
                        {{ $quiz->title }}
                    </h1>
                    <p class="text-slate-300 mt-2 text-sm leading-relaxed max-w-xl">
                        {{ $quiz->description ?? 'Please answer all questions carefully before submitting.' }}
                    </p>
                </div>

                <div class="flex-shrink-0 bg-white/10 backdrop-blur-md border border-white/15 p-4 rounded-2xl w-full md:w-auto text-center md:text-right">
                    <p class="text-xs text-indigo-200">Assessment Points</p>
                    <p class="text-3xl font-extrabold text-yellow-400 mt-1">{{ $quiz->total_points }} <span class="text-xs text-white font-normal">Points</span></p>
                    
                    @if($quiz->duration_minutes)
                        <span class="inline-block bg-amber-500/20 text-amber-300 border border-amber-500/30 px-3 py-1 rounded-full text-xs font-semibold mt-3">
                            <i class="ri-time-line"></i> Limit: {{ $quiz->duration_minutes }} Min
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quiz Form -->
        <form method="POST" action="{{ route('student.quiz.submit', $quiz->id) }}" class="space-y-6">
            @csrf
            
            @foreach($quiz->questions as $index => $question)
                <div class="dashboard-card p-6 md:p-8">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                        <span class="text-xs uppercase font-bold text-slate-400 tracking-wider">
                            Question {{ $index + 1 }} of {{ $quiz->questions->count() }}
                        </span>
                        <span class="text-xs bg-slate-100 text-slate-700 font-bold px-3 py-1 rounded-full">
                            {{ $question->points }} Points
                        </span>
                    </div>
                    
                    <h3 class="text-lg font-bold text-slate-800 leading-relaxed mb-6">
                        {{ $question->question_text }}
                    </h3>
                    
                    @if($question->question_type == 'mcq')
                        <div class="space-y-3">
                            @php
                                $options = is_string($question->options) ? json_decode($question->options, true) : $question->options;
                            @endphp
                            @foreach($options as $option)
                                <label class="option-label">
                                    <input type="radio" 
                                           name="question_{{ $question->id }}" 
                                           value="{{ $option }}"
                                           required>
                                    <span class="text-sm font-semibold text-slate-700">{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    @elseif($question->question_type == 'true_false')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="option-label">
                                <input type="radio" 
                                       name="question_{{ $question->id }}" 
                                       value="True"
                                       required>
                                <span class="text-sm font-bold text-slate-700">True</span>
                            </label>
                            <label class="option-label">
                                <input type="radio" 
                                       name="question_{{ $question->id }}" 
                                       value="False"
                                       required>
                                <span class="text-sm font-bold text-slate-700">False</span>
                            </label>
                        </div>
                    @else
                        <textarea name="question_{{ $question->id }}" 
                                  rows="5"
                                  class="w-full border border-slate-200 rounded-xl p-4 focus:outline-none focus:border-indigo-500 bg-slate-50 hover:bg-slate-100/50 transition focus:bg-white text-sm text-slate-700 font-medium"
                                  placeholder="Type your complete solution or essay response here..."
                                  required></textarea>
                    @endif
                </div>
            @endforeach

            <!-- Action Footer -->
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-8 pt-4">
                <a href="{{ route('student.course.details', $quiz->course_id) }}" 
                   class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-sm px-6 py-3 rounded-xl transition w-full sm:w-auto text-center"
                   onclick="return confirm('Are you sure you want to cancel? Any answers you filled will not be saved.');">
                    Cancel Assessment
                </a>
                <button type="submit" 
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm px-8 py-3 rounded-xl transition shadow-lg shadow-indigo-100 w-full sm:w-auto text-center">
                    Submit Attempt
                </button>
            </div>
        </form>
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
            timerElement.className = 'timer-badge';
            timerElement.id = 'quizTimer';
            timerElement.innerHTML = '<i class="ri-time-line"></i> <span>' + formatTime(timeLeft) + '</span>';
            document.body.appendChild(timerElement);
            
            timerInterval = setInterval(() => {
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    timerElement.innerHTML = '<i class="ri-alarm-warning-line"></i> <span>Time\'s Up!</span>';
                    timerElement.className = 'timer-badge danger';
                    alert('Time is up! Your answers will be automatically submitted.');
                    window.onbeforeunload = null; // Bypass safety warn
                    document.querySelector('form').submit();
                } else {
                    timeLeft--;
                    timerElement.querySelector('span').innerText = formatTime(timeLeft);
                    
                    // Warning when 5 minutes left
                    if (timeLeft <= 300 && timeLeft > 60) {
                        timerElement.className = 'timer-badge warning';
                    }
                    // Critical warning when 1 minute left
                    if (timeLeft <= 60) {
                        timerElement.className = 'timer-badge danger';
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
            if (timerStarted && timeLeft > 0) {
                e.preventDefault();
                e.returnValue = 'Your quiz is currently in progress. If you leave, your progress might not be saved.';
                return 'Your quiz is currently in progress. If you leave, your progress might not be saved.';
            }
        });

        // Clear warning on submit
        document.querySelector('form').addEventListener('submit', function() {
            window.onbeforeunload = null;
        });
        @endif
    </script>

</body>
</html>