<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Question - {{ $question->question_text }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-indigo-800 text-white fixed h-full overflow-y-auto">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Nu Clicks LMS</h1>
                <p class="text-sm text-indigo-200 mt-2">Edit Question</p>
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
                <a href="{{ route('faculty.folder-files') }}" class="nav-item {{ request()->routeIs('faculty.folder-files*') ? 'active' : '' }}">
                <i class="ri-folder-3-line"></i> Files & Folders
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
                <a href="{{ route('faculty.question.bank') }}" class="flex items-center px-6 py-3 bg-indigo-900">
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
                        <h2 class="text-xl font-semibold text-gray-800">Edit Question</h2>
                        <p class="text-sm text-gray-600">{{ $question->quiz->course->code }} - {{ $question->quiz->title }}</p>
                    </div>
                    <a href="{{ route('faculty.question.bank') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                        Back to Question Bank
                    </a>
                </div>
            </div>

            <div class="p-6">
                <div class="bg-white rounded-lg shadow max-w-3xl mx-auto">
                    <div class="p-6">
                        <form id="editQuestionForm" action="{{ route('faculty.update.question', $question->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Question Type</label>
                                <select id="questionType" name="question_type" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                    <option value="mcq" {{ $question->question_type == 'mcq' ? 'selected' : '' }}>Multiple Choice (MCQ)</option>
                                    <option value="true_false" {{ $question->question_type == 'true_false' ? 'selected' : '' }}>True / False</option>
                                    <option value="essay" {{ $question->question_type == 'essay' ? 'selected' : '' }}>Essay</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Question Text</label>
                                <textarea name="question_text" rows="3" required class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ $question->question_text }}</textarea>
                            </div>
                            
                            <!-- MCQ Options -->
                            <div id="mcqDiv" style="{{ $question->question_type == 'mcq' ? 'display: block;' : 'display: none;' }}">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Answer Options</label>
                                <div id="optionsList">
                                    @php
                                        $options = is_string($question->options) ? json_decode($question->options, true) : $question->options;
                                        $options = $options ?: [];
                                    @endphp
                                    @foreach($options as $index => $option)
                                    <div class="flex mb-2 items-center">
                                        <input type="text" name="options[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 mr-2" placeholder="Option {{ $index + 1 }}" value="{{ $option }}">
                                        <input type="radio" name="correct_answer" value="{{ $option }}" class="w-4 h-4" {{ $option == $question->correct_answer ? 'checked' : '' }}>
                                        <button type="button" onclick="this.parentElement.remove()" class="text-red-500 ml-2">✕</button>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" onclick="addOption()" class="text-indigo-600 text-sm mt-1">+ Add Option</button>
                            </div>
                            
                            <!-- True/False Options -->
                            <div id="tfDiv" style="{{ $question->question_type == 'true_false' ? 'display: block;' : 'display: none;' }}">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Correct Answer</label>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="correct_answer" value="True" class="mr-2" {{ $question->correct_answer == 'True' ? 'checked' : '' }}> True
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="correct_answer" value="False" class="mr-2" {{ $question->correct_answer == 'False' ? 'checked' : '' }}> False
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Essay Options -->
                            <div id="essayDiv" style="{{ $question->question_type == 'essay' ? 'display: block;' : 'display: none;' }}">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Sample Answer (Optional)</label>
                                <textarea name="correct_answer" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ $question->correct_answer != 'To be graded manually' ? $question->correct_answer : '' }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Essay questions will be manually graded</p>
                            </div>
                            
                            <div class="mb-4 mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Points</label>
                                <input type="number" name="points" required min="1" value="{{ $question->points }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            </div>
                            
                            <div class="flex justify-end space-x-2 pt-4 border-t">
                                <a href="{{ route('faculty.question.bank') }}" class="px-4 py-2 border border-gray-300 rounded-lg">Cancel</a>
                                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Update Question</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let optionCounter = {{ count($options ?? []) }};
        
        function addOption() {
            optionCounter++;
            const container = document.getElementById('optionsList');
            const div = document.createElement('div');
            div.className = 'flex mb-2 items-center';
            div.innerHTML = `
                <input type="text" name="options[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 mr-2" placeholder="Option ${optionCounter}">
                <input type="radio" name="correct_answer" value="" class="w-4 h-4">
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 ml-2">✕</button>
            `;
            container.appendChild(div);
        }
        
        function toggleSections() {
            const type = document.getElementById('questionType').value;
            document.getElementById('mcqDiv').style.display = type === 'mcq' ? 'block' : 'none';
            document.getElementById('tfDiv').style.display = type === 'true_false' ? 'block' : 'none';
            document.getElementById('essayDiv').style.display = type === 'essay' ? 'block' : 'none';
        }
        
        document.getElementById('questionType').addEventListener('change', toggleSections);
    </script>
</body>
</html>