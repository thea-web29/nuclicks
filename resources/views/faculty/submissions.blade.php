<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Submissions - {{ $quiz->title }}</title>
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
                        <h2 class="text-xl font-semibold text-gray-800">Quiz Submissions</h2>
                        <p class="text-sm text-gray-600">{{ $quiz->title }} - {{ $quiz->course->code }} {{ $quiz->course->name }}</p>
                    </div>
                    <a href="{{ route('faculty.edit.quiz', $quiz->id) }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                        Back to Quiz
                    </a>
                </div>
            </div>

            <div class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Submissions</p>
                                <p class="text-3xl font-bold text-indigo-600">{{ $attempts->count() }}</p>
                            </div>
                            <i class="ri-file-list-line text-4xl text-indigo-300"></i>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Average Score</p>
                                <p class="text-3xl font-bold text-green-600">
                                    {{ $attempts->avg('score') ? round($attempts->avg('score'), 1) : 0 }}/{{ $quiz->total_points }}
                                </p>
                            </div>
                            <i class="ri-bar-chart-line text-4xl text-green-300"></i>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Passing Rate</p>
                                <p class="text-3xl font-bold text-blue-600">
                                    @php
                                        $passingCount = $attempts->filter(function($attempt) use ($quiz) {
                                            return $quiz->total_points > 0 && ($attempt->score / $quiz->total_points) >= 0.6;
                                        })->count();
                                        $passingRate = $attempts->count() > 0 ? round(($passingCount / $attempts->count()) * 100) : 0;
                                    @endphp
                                    {{ $passingRate }}%
                                </p>
                            </div>
                            <i class="ri-star-line text-4xl text-blue-300"></i>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Pending Grading</p>
                                <p class="text-3xl font-bold text-yellow-600">
                                    {{ $attempts->whereNull('feedback')->whereNotNull('completed_at')->count() }}
                                </p>
                            </div>
                            <i class="ri-time-line text-4xl text-yellow-300"></i>
                        </div>
                    </div>
                </div>

                <!-- Submissions Table -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Student Submissions</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted At</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Percentage</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($attempts as $attempt)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                                    <i class="ri-user-line text-indigo-600"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $attempt->student->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $attempt->student->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $attempt->completed_at ? $attempt->completed_at->format('M d, Y h:i A') : 'Not completed' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm font-semibold {{ $attempt->score ? 'text-gray-900' : 'text-gray-400' }}">
                                                {{ $attempt->score ?? 'Not graded' }}/{{ $quiz->total_points }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($attempt->score && $quiz->total_points > 0)
                                                @php $percentage = ($attempt->score / $quiz->total_points) * 100; @endphp
                                                <div class="flex items-center">
                                                    <span class="text-sm font-medium 
                                                        {{ $percentage >= 80 ? 'text-green-600' : ($percentage >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                                                        {{ round($percentage, 1) }}%
                                                    </span>
                                                    <div class="ml-2 w-16 bg-gray-200 rounded-full h-2">
                                                        <div class="bg-indigo-600 rounded-full h-2" style="width: {{ $percentage }}%"></div>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-sm text-gray-400">--</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($attempt->completed_at)
                                                @if($attempt->feedback || $attempt->score)
                                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                                        <i class="ri-check-line mr-1"></i> Graded
                                                    </span>
                                                @else
                                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                                        <i class="ri-time-line mr-1"></i> Pending
                                                    </span>
                                                @endif
                                            @else
                                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-600">
                                                    <i class="ri-stop-circle-line mr-1"></i> In Progress
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if($attempt->completed_at)
                                                <a href="{{ route('faculty.grade.submission', $attempt->id) }}" 
                                                   class="text-indigo-600 hover:text-indigo-900 mr-3">
                                                    <i class="ri-edit-line mr-1"></i> Grade
                                                </a>
                                                <button onclick="viewSubmission({{ $attempt->id }})" 
                                                        class="text-blue-600 hover:text-blue-900">
                                                    <i class="ri-eye-line mr-1"></i> View
                                                </button>
                                            @else
                                                <span class="text-gray-400">Not submitted</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                            <i class="ri-file-list-line text-6xl text-gray-300 mb-4 block"></i>
                                            No submissions yet for this quiz.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Export Button -->
                @if($attempts->count() > 0)
                    <div class="mt-6 flex justify-end">
                        <button onclick="exportSubmissions()" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                            <i class="ri-download-line mr-1"></i> Export Results
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- View Submission Modal -->
    <div id="submissionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-semibold">Submission Details</h3>
                    <p class="text-gray-600 text-sm" id="modalStudentName"></p>
                </div>
                <button onclick="closeSubmissionModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>
            <div class="p-6" id="modalContent">
                <!-- Content loaded via AJAX -->
                <div class="text-center py-8">
                    <div class="text-gray-400">Loading submission details...</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function viewSubmission(attemptId) {
            const modal = document.getElementById('submissionModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Fetch submission details via AJAX
            fetch(`/faculty/attempts/${attemptId}/details`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('modalStudentName').innerHTML = `<i class="ri-user-line mr-1"></i> ${data.student_name}`;
                    
                    let answersHtml = '';
                    data.answers.forEach((answer, index) => {
                        const isCorrect = answer.is_correct ? 'text-green-600' : 'text-red-600';
                        const correctIcon = answer.is_correct ? 'ri-checkbox-circle-line' : 'ri-close-circle-line';
                        
                        answersHtml += `
                            <div class="border rounded-lg p-4 mb-3">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex items-center space-x-2">
                                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">Q${index + 1}</span>
                                        <span class="text-sm text-gray-500">${answer.points} pts</span>
                                    </div>
                                    <i class="${correctIcon} ${isCorrect} text-xl"></i>
                                </div>
                                <p class="font-medium text-gray-900 mb-2">${escapeHtml(answer.question_text)}</p>
                                <div class="bg-gray-50 rounded p-3">
                                    <p class="text-sm text-gray-600"><strong>Student's Answer:</strong> ${escapeHtml(answer.student_answer || 'No answer provided')}</p>
                                    ${!answer.is_correct && answer.correct_answer ? `<p class="text-sm text-green-600 mt-1"><strong>Correct Answer:</strong> ${escapeHtml(answer.correct_answer)}</p>` : ''}
                                </div>
                            </div>
                        `;
                    });
                    
                    document.getElementById('modalContent').innerHTML = `
                        <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Score</p>
                                    <p class="text-2xl font-bold">${data.score}/${data.total_points}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Percentage</p>
                                    <p class="text-2xl font-bold ${data.percentage >= 60 ? 'text-green-600' : 'text-red-600'}">${data.percentage}%</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Submitted At</p>
                                    <p class="text-sm">${data.submitted_at}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Status</p>
                                    <p class="text-sm">${data.status}</p>
                                </div>
                            </div>
                        </div>
                        <h4 class="font-semibold mb-3">Answers</h4>
                        ${answersHtml}
                    `;
                }
            })
            .catch(error => {
                document.getElementById('modalContent').innerHTML = `
                    <div class="text-center py-8">
                        <div class="text-red-400">Error loading submission details.</div>
                    </div>
                `;
            });
        }
        
        function closeSubmissionModal() {
            const modal = document.getElementById('submissionModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.getElementById('modalContent').innerHTML = `
                <div class="text-center py-8">
                    <div class="text-gray-400">Loading submission details...</div>
                </div>
            `;
        }
        
        function exportSubmissions() {
            // Create CSV export
            const rows = [
                ['Student Name', 'Student Email', 'Submitted At', 'Score', 'Total Points', 'Percentage', 'Status']
            ];
            
            @foreach($attempts as $attempt)
                @php
                    $percentage = $attempt->score && $quiz->total_points > 0 ? round(($attempt->score / $quiz->total_points) * 100, 1) : 0;
                    $status = $attempt->feedback || $attempt->score ? 'Graded' : ($attempt->completed_at ? 'Pending' : 'In Progress');
                @endphp
                rows.push([
                    '{{ addslashes($attempt->student->name) }}',
                    '{{ $attempt->student->email }}',
                    '{{ $attempt->completed_at ? $attempt->completed_at->format('Y-m-d H:i:s') : "N/A" }}',
                    '{{ $attempt->score ?? "Not graded" }}',
                    '{{ $quiz->total_points }}',
                    '{{ $percentage }}%',
                    '{{ $status }}'
                ]);
            @endforeach
            
            let csvContent = rows.map(row => row.join(',')).join('\n');
            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = '{{ $quiz->title }}_submissions.csv';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        }
        
        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        
        // Close modal when clicking outside
        document.getElementById('submissionModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeSubmissionModal();
            }
        });
    </script>
</body>
</html>