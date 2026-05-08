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
                <p class="text-sm text-indigo-200 mt-2">Edit Quiz</p>
            </div>
            <nav class="mt-6">
                 <div class="px-4 mb-4">
                    <p class="text-xs text-indigo-300 uppercase tracking-wider">Main</p>
                </div>
                <a href="{{ route('faculty.dashboard') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('faculty.dashboard') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-dashboard-line mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('faculty.students') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('faculty.students*') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-user-line mr-3"></i>
                    <span>Students</span>
                </a>
                <a href="{{ route('faculty.courses') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('faculty.courses*') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
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
        <div class="flex-1 ml-64">
            <div class="bg-white shadow-sm px-6 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Edit Quiz: {{ $quiz->title }}</h2>
                        <p class="text-sm text-gray-600">{{ $quiz->course->code }} - {{ $quiz->course->name }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('faculty.course.details', $quiz->course_id) }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                            Back to Course
                        </a>
                        
                        <!-- Add Question Dropdown -->
                        <div class="relative" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open" 
                                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center space-x-2">
                                <i class="ri-add-line"></i>
                                <span>Add Question</span>
                                <i class="ri-arrow-down-s-line"></i>
                            </button>
                            
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-95"
                                 class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg z-20 border border-gray-200"
                                 style="display: none;">
                                <div class="py-2">
                                    <button onclick="openModal()" 
                                            class="flex items-center w-full px-4 py-3 hover:bg-gray-50 transition group">
                                        <div class="bg-green-100 p-2 rounded-lg mr-3 group-hover:bg-green-200">
                                            <i class="ri-file-edit-line text-green-600"></i>
                                        </div>
                                        <div class="flex-1 text-left">
                                            <p class="text-sm font-medium text-gray-900">Create New Question</p>
                                            <p class="text-xs text-gray-500">Create a brand new question for this quiz</p>
                                        </div>
                                        <i class="ri-arrow-right-s-line text-gray-400"></i>
                                    </button>
                                    
                                    <div class="border-t border-gray-100 my-1"></div>
                                    
                                    <button onclick="openQuestionBankModal()" 
                                            class="flex items-center w-full px-4 py-3 hover:bg-gray-50 transition group">
                                        <div class="bg-blue-100 p-2 rounded-lg mr-3 group-hover:bg-blue-200">
                                            <i class="ri-database-2-line text-blue-600"></i>
                                        </div>
                                        <div class="flex-1 text-left">
                                            <p class="text-sm font-medium text-gray-900">Add from Question Bank</p>
                                            <p class="text-xs text-gray-500">Import existing questions from your bank</p>
                                        </div>
                                        <i class="ri-arrow-right-s-line text-gray-400"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <!-- Quiz Info Card -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Total Questions</p>
                            <p class="text-2xl font-bold">{{ $quiz->questions->count() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Points</p>
                            <p class="text-2xl font-bold">{{ $quiz->total_points }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Duration</p>
                            <p class="text-2xl font-bold">{{ $quiz->duration_minutes ?? 'Unlimited' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            <p class="text-2xl font-bold">
                                @if($quiz->hasStarted() && !$quiz->hasEnded())
                                    <span class="text-green-600 text-base">Active</span>
                                @elseif($quiz->hasEnded())
                                    <span class="text-red-600 text-base">Ended</span>
                                @else
                                    <span class="text-yellow-600 text-base">Upcoming</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Questions List -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b">
                        <h3 class="text-lg font-semibold">Questions</h3>
                    </div>
                    <div class="p-6">
                        @if($quiz->questions->count() > 0)
                            <div class="space-y-4">
                                @foreach($quiz->questions as $index => $question)
                                    <div class="border rounded-lg p-4" id="question-{{ $question->id }}">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-2 mb-2">
                                                    <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded">
                                                        Q{{ $index + 1 }}
                                                    </span>
                                                    <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">
                                                        {{ strtoupper(str_replace('_', ' ', $question->question_type)) }}
                                                    </span>
                                                    <span class="text-sm text-gray-500">{{ $question->points }} pts</span>
                                                </div>
                                                <p class="font-medium">{{ $question->question_text }}</p>
                                                
                                                @if($question->question_type == 'mcq' && $question->options)
                                                    <div class="mt-2 space-y-1">
                                                        @foreach(json_decode($question->options) as $option)
                                                            <div class="text-sm {{ $option == $question->correct_answer ? 'text-green-600 font-semibold' : 'text-gray-600' }}">
                                                                • {{ $option }} 
                                                                @if($option == $question->correct_answer)
                                                                    <span class="text-green-600 text-xs">(Correct)</span>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @elseif($question->question_type == 'true_false')
                                                    <div class="mt-2">
                                                        <span class="text-sm font-semibold text-green-600">
                                                            Answer: {{ $question->correct_answer }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex space-x-2 ml-4">
                                                <button onclick="editQuestionInline({{ $question->id }})" 
                                                        class="text-yellow-600 hover:text-yellow-800">
                                                    <i class="ri-edit-line text-xl"></i>
                                                </button>
                                                <form action="{{ route('faculty.delete.question', $question->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Delete this question?')">
                                                        <i class="ri-delete-bin-line text-xl"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="text-6xl mb-4">❓</div>
                                <h3 class="text-xl font-semibold mb-2">No Questions Yet</h3>
                                <p class="text-gray-600 mb-4">Start adding questions to your quiz</p>
                                <div class="flex justify-center space-x-4">
                                    <button onclick="openModal()" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                                        Create New Question
                                    </button>
                                    <button onclick="openQuestionBankModal()" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                                        Add from Question Bank
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Creating New Question -->
    <div id="questionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b">
                <h3 class="text-xl font-semibold" id="modalTitle">Create New Question</h3>
                <p class="text-gray-600 text-sm">Fill in the question details below</p>
            </div>
            <div class="p-6">
                <form id="questionForm">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="editQuestionId" name="question_id" value="">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Question Type</label>
                        <select id="questionType" name="question_type" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            <option value="mcq">Multiple Choice (MCQ)</option>
                            <option value="true_false">True / False</option>
                            <option value="essay">Essay</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Question Text</label>
                        <textarea id="questionText" name="question_text" rows="3" required 
                                  class="w-full border border-gray-300 rounded-lg px-4 py-2"></textarea>
                    </div>
                    
                    <!-- MCQ Options -->
                    <div id="mcqDiv">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Answer Options</label>
                        <div id="optionsList">
                            <div class="flex mb-2 items-center">
                                <input type="text" name="options[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 mr-2" placeholder="Option 1">
                                <input type="radio" name="correct_answer" value="" class="correct-radio w-4 h-4" onchange="setCorrectAnswerValue(this)">
                            </div>
                            <div class="flex mb-2 items-center">
                                <input type="text" name="options[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 mr-2" placeholder="Option 2">
                                <input type="radio" name="correct_answer" value="" class="correct-radio w-4 h-4" onchange="setCorrectAnswerValue(this)">
                            </div>
                        </div>
                        <button type="button" onclick="addOption()" class="text-indigo-600 text-sm mt-1">+ Add Option</button>
                    </div>
                    
                    <!-- True/False Options -->
                    <div id="tfDiv" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Correct Answer</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="correct_answer" value="True" class="mr-2"> True
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="correct_answer" value="False" class="mr-2"> False
                            </label>
                        </div>
                    </div>
                    
                    <!-- Essay Options -->
                    <div id="essayDiv" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sample Answer (Optional)</label>
                        <textarea name="correct_answer" id="essayAnswer" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2"></textarea>
                        <p class="text-xs text-gray-500 mt-1">Essay questions will be manually graded</p>
                    </div>
                    
                    <div class="mb-4 mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Points</label>
                        <input type="number" id="points" name="points" required min="1" value="1" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Max Attempts</label>
                        <input type="number" name="max_attempts" min="1" max="10" value="{{ old('max_attempts', $quiz->max_attempts ?? 1) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                        <p class="text-xs text-gray-500 mt-1">Maximum number of times a student can take this quiz (default: 1)</p>
                    </div>

                    <div class="flex justify-end space-x-2 pt-4 border-t">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-lg">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Save Question</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Question Bank -->
    <div id="questionBankModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-semibold">Add from Question Bank</h3>
                    <p class="text-gray-600 text-sm">Select questions to add to this quiz</p>
                </div>
                <button onclick="closeQuestionBankModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <input type="text" id="searchQuestions" placeholder="Search questions..." 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <select id="filterQuestionType" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                                <option value="">All Types</option>
                                <option value="mcq">Multiple Choice</option>
                                <option value="true_false">True/False</option>
                                <option value="essay">Essay</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div id="questionBankList" class="space-y-3 max-h-96 overflow-y-auto">
                    <div class="text-center py-8">
                        <div class="text-gray-400">Loading questions...</div>
                    </div>
                </div>
                
                <div class="mt-6 pt-4 border-t flex justify-end space-x-2">
                    <button onclick="closeQuestionBankModal()" class="px-4 py-2 border border-gray-300 rounded-lg">Cancel</button>
                    <button onclick="addSelectedQuestions()" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Add Selected Questions
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        let optionCounter = 2;
        let selectedCorrectAnswer = '';
        let bankQuestions = [];
        let isEditing = false;
        
        function editQuestionInline(questionId) {
            // Fetch question data and open modal for editing
            fetch(`/faculty/questions/${questionId}/edit-data`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const question = data.question;
                    isEditing = true;
                    document.getElementById('modalTitle').innerText = 'Edit Question';
                    document.getElementById('editQuestionId').value = question.id;
                    document.getElementById('questionType').value = question.question_type;
                    document.getElementById('questionText').value = question.question_text;
                    document.getElementById('points').value = question.points;
                    
                    toggleSections();
                    
                    if (question.question_type === 'mcq') {
                        const options = typeof question.options === 'string' ? JSON.parse(question.options) : question.options;
                        const container = document.getElementById('optionsList');
                        container.innerHTML = '';
                        
                        if (options && Array.isArray(options)) {
                            options.forEach((option, idx) => {
                                const div = document.createElement('div');
                                div.className = 'flex mb-2 items-center';
                                div.innerHTML = `
                                    <input type="text" name="options[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 mr-2" placeholder="Option ${idx + 1}" value="${escapeHtml(option)}">
                                    <input type="radio" name="correct_answer" value="${escapeHtml(option)}" class="correct-radio w-4 h-4" onchange="setCorrectAnswerValue(this)" ${option === question.correct_answer ? 'checked' : ''}>
                                    <button type="button" onclick="this.parentElement.remove()" class="text-red-500 ml-2">✕</button>
                                `;
                                container.appendChild(div);
                            });
                            optionCounter = options.length;
                        }
                        selectedCorrectAnswer = question.correct_answer;
                    } else if (question.question_type === 'true_false') {
                        const radios = document.querySelectorAll('#tfDiv input[name="correct_answer"]');
                        radios.forEach(radio => {
                            if (radio.value === question.correct_answer) {
                                radio.checked = true;
                            }
                        });
                        selectedCorrectAnswer = question.correct_answer;
                    } else if (question.question_type === 'essay') {
                        document.getElementById('essayAnswer').value = question.correct_answer || '';
                        selectedCorrectAnswer = question.correct_answer || '';
                    }
                    
                    document.getElementById('questionModal').classList.remove('hidden');
                    document.getElementById('questionModal').classList.add('flex');
                }
            })
            .catch(error => {
                alert('Error loading question: ' + error.message);
            });
        }
        
        function openModal() {
            document.getElementById('modalTitle').innerText = 'Create New Question';
            document.getElementById('editQuestionId').value = '';
            resetForm();
            document.getElementById('questionModal').classList.remove('hidden');
            document.getElementById('questionModal').classList.add('flex');
        }
        
        function closeModal() {
            document.getElementById('questionModal').classList.add('hidden');
            document.getElementById('questionModal').classList.remove('flex');
            resetForm();
        }
        
        function openQuestionBankModal() {
            document.getElementById('questionBankModal').classList.remove('hidden');
            document.getElementById('questionBankModal').classList.add('flex');
            loadQuestionBank();
        }
        
        function closeQuestionBankModal() {
            document.getElementById('questionBankModal').classList.add('hidden');
            document.getElementById('questionBankModal').classList.remove('flex');
        }
        
        function loadQuestionBank() {
            const quizId = {{ $quiz->id }};
            
            fetch(`/faculty/quizzes/${quizId}/question-bank`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    bankQuestions = data.questions;
                    renderQuestionBank(data.questions);
                } else {
                    throw new Error(data.message || 'Failed to load questions');
                }
            })
            .catch(error => {
                document.getElementById('questionBankList').innerHTML = `
                    <div class="text-center py-8">
                        <div class="text-red-400">Error loading questions. Please try again.</div>
                        <button onclick="loadQuestionBank()" class="mt-2 text-indigo-600 hover:underline">Retry</button>
                    </div>
                `;
            });
        }
        
        function renderQuestionBank(questions) {
            if (!questions || questions.length === 0) {
                document.getElementById('questionBankList').innerHTML = `
                    <div class="text-center py-8">
                        <div class="text-gray-400">No questions available in the question bank.</div>
                        <a href="{{ route('faculty.question.bank') }}" class="inline-block mt-2 text-indigo-600 hover:underline">Go to Question Bank</a>
                    </div>
                `;
                return;
            }
            
            let html = '';
            questions.forEach((question) => {
                let optionsHtml = '';
                if (question.question_type === 'mcq' && question.options) {
                    try {
                        const options = typeof question.options === 'string' ? JSON.parse(question.options) : question.options;
                        if (Array.isArray(options)) {
                            optionsHtml = `
                                <div class="mt-2 text-sm text-gray-600">
                                    ${options.map(opt => `• ${escapeHtml(opt)}`).join('<br>')}
                                </div>
                            `;
                        }
                    } catch(e) {}
                }
                
                html += `
                    <div class="border rounded-lg p-4 hover:bg-gray-50">
                        <div class="flex items-start">
                            <input type="checkbox" value="${question.id}" class="question-checkbox mt-1 mr-3 w-4 h-4 rounded border-gray-300">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2 flex-wrap gap-2">
                                    <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">
                                        ${question.question_type === 'mcq' ? 'Multiple Choice' : (question.question_type === 'true_false' ? 'True/False' : 'Essay')}
                                    </span>
                                    <span class="text-xs text-gray-500">${question.points} pts</span>
                                    <span class="text-xs text-gray-400">From: ${escapeHtml(question.course_code || 'N/A')}</span>
                                </div>
                                <p class="font-medium text-gray-900">${escapeHtml(question.question_text)}</p>
                                ${optionsHtml}
                            </div>
                        </div>
                    </div>
                `;
            });
            
            document.getElementById('questionBankList').innerHTML = html;
        }
        
        function addSelectedQuestions() {
            const selectedIds = [];
            document.querySelectorAll('.question-checkbox:checked').forEach(checkbox => {
                selectedIds.push(checkbox.value);
            });
            
            if (selectedIds.length === 0) {
                alert('Please select at least one question to add.');
                return;
            }
            
            const quizId = {{ $quiz->id }};
            const addButton = event.target;
            const originalText = addButton.innerHTML;
            addButton.innerHTML = 'Adding...';
            addButton.disabled = true;
            
            fetch(`/faculty/quizzes/${quizId}/add-questions`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ question_ids: selectedIds })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(`Successfully added ${selectedIds.length} question(s)!`);
                    location.reload();
                } else {
                    alert(data.message || 'Error adding questions');
                }
            })
            .catch(error => {
                alert('Error: ' + error.message);
            })
            .finally(() => {
                addButton.innerHTML = originalText;
                addButton.disabled = false;
            });
        }
        
        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        
        // Search and filter functionality
        document.addEventListener('input', function(e) {
            if (e.target.id === 'searchQuestions' || e.target.id === 'filterQuestionType') {
                const searchTerm = document.getElementById('searchQuestions').value.toLowerCase();
                const typeFilter = document.getElementById('filterQuestionType').value;
                
                const filtered = bankQuestions.filter(question => {
                    const matchesSearch = question.question_text.toLowerCase().includes(searchTerm);
                    const matchesType = !typeFilter || question.question_type === typeFilter;
                    return matchesSearch && matchesType;
                });
                
                renderQuestionBank(filtered);
            }
        });
        
        function resetForm() {
            document.getElementById('questionForm').reset();
            isEditing = false;
            selectedCorrectAnswer = '';
            document.getElementById('editQuestionId').value = '';
            document.getElementById('optionsList').innerHTML = `
                <div class="flex mb-2 items-center">
                    <input type="text" name="options[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 mr-2" placeholder="Option 1">
                    <input type="radio" name="correct_answer" value="" class="correct-radio w-4 h-4" onchange="setCorrectAnswerValue(this)">
                </div>
                <div class="flex mb-2 items-center">
                    <input type="text" name="options[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 mr-2" placeholder="Option 2">
                    <input type="radio" name="correct_answer" value="" class="correct-radio w-4 h-4" onchange="setCorrectAnswerValue(this)">
                </div>
            `;
            optionCounter = 2;
            document.getElementById('questionType').value = 'mcq';
            document.getElementById('essayAnswer').value = '';
            toggleSections();
            updateRadioValues();
        }
        
        function addOption() {
            optionCounter++;
            const container = document.getElementById('optionsList');
            const div = document.createElement('div');
            div.className = 'flex mb-2 items-center';
            div.innerHTML = `
                <input type="text" name="options[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 mr-2" placeholder="Option ${optionCounter}">
                <input type="radio" name="correct_answer" value="" class="correct-radio w-4 h-4" onchange="setCorrectAnswerValue(this)">
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 ml-2">✕</button>
            `;
            container.appendChild(div);
            updateRadioValues();
        }
        
        function setCorrectAnswerValue(radio) {
            const optionInput = radio.parentElement.querySelector('input[type="text"]');
            if (optionInput && optionInput.value) {
                radio.value = optionInput.value;
                selectedCorrectAnswer = radio.value;
            }
        }
        
        function toggleSections() {
            const type = document.getElementById('questionType').value;
            document.getElementById('mcqDiv').style.display = type === 'mcq' ? 'block' : 'none';
            document.getElementById('tfDiv').style.display = type === 'true_false' ? 'block' : 'none';
            document.getElementById('essayDiv').style.display = type === 'essay' ? 'block' : 'none';
        }
        
        function updateRadioValues() {
            const options = document.querySelectorAll('[name="options[]"]');
            const radios = document.querySelectorAll('.correct-radio');
            radios.forEach((radio, index) => {
                if (options[index] && options[index].value) {
                    radio.value = options[index].value;
                }
            });
        }
        
        // Handle form submission for new question
        document.getElementById('questionForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const type = document.getElementById('questionType').value;
            const questionText = document.getElementById('questionText').value.trim();
            const questionId = document.getElementById('editQuestionId').value;
            
            if (!questionText) {
                alert('Please enter the question text');
                return;
            }
            
            if (type === 'mcq') {
                let hasCorrect = false;
                const radios = document.querySelectorAll('#mcqDiv .correct-radio');
                radios.forEach(radio => {
                    if (radio.checked && radio.value) {
                        hasCorrect = true;
                        selectedCorrectAnswer = radio.value;
                    }
                });
                if (!hasCorrect) {
                    alert('Please select the correct answer');
                    return;
                }
            }
            
            if (type === 'true_false') {
                const selected = document.querySelector('#tfDiv input[name="correct_answer"]:checked');
                if (!selected) {
                    alert('Please select True or False');
                    return;
                }
                selectedCorrectAnswer = selected.value;
            }
            
            if (type === 'essay') {
                const essayValue = document.getElementById('essayAnswer').value;
                selectedCorrectAnswer = essayValue || 'To be graded manually';
            }
            
            updateRadioValues();
            
            const formData = new FormData();
            formData.append('_token', document.querySelector('input[name="_token"]').value);
            formData.append('question_type', type);
            formData.append('question_text', questionText);
            formData.append('correct_answer', selectedCorrectAnswer);
            formData.append('points', document.querySelector('input[name="points"]').value);
            
            if (type === 'mcq') {
                const options = document.querySelectorAll('[name="options[]"]');
                options.forEach(option => {
                    if (option.value.trim()) {
                        formData.append('options[]', option.value.trim());
                    }
                });
            }
            
            const quizId = {{ $quiz->id }};
            const url = questionId ? `/faculty/questions/${questionId}` : `/faculty/quizzes/${quizId}/questions`;
            const method = questionId ? 'PUT' : 'POST';

            if (method === 'PUT') {
                formData.append('_method', 'PUT');
                formData.append('quiz_id', quizId);
            }
            
            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(questionId ? 'Question updated successfully!' : 'Question added successfully!');
                    location.reload();
                } else {
                    let errorMsg = data.message || 'Validation failed';
                    if (data.errors) {
                        errorMsg += '\n' + Object.values(data.errors).flat().join('\n');
                    }
                    alert(errorMsg);
                }
            })
            .catch(error => {
                alert('Error: ' + error.message);
            });
        });
        
        document.getElementById('questionType').addEventListener('change', function() {
            toggleSections();
        });
        
        document.addEventListener('input', function(e) {
            if (e.target.name === 'options[]') {
                updateRadioValues();
            }
        });
        
        document.getElementById('questionModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
        
        document.getElementById('questionBankModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeQuestionBankModal();
            }
        });
        
        toggleSections();
    </script>
</body>
</html>