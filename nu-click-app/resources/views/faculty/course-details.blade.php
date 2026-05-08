<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->name }} - Course Management</title>
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
                        <h2 class="text-xl font-semibold text-gray-800">{{ $course->code }} - {{ $course->name }}</h2>
                    </div>
                    <!-- Announcements Button -->
                    <a href="{{ route('faculty.announcements', $course->id) }}" 
                       class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                        <i class="ri-megaphone-line mr-1"></i> Announcements
                    </a>
                </div>
            </div>
            <!-- Add this after the course header or in the course info card -->
            <div class="bg-indigo-50 rounded-lg p-4 mb-6 border border-indigo-200">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-indigo-600 font-medium">Course Join Code</p>
                        <p class="text-2xl font-bold text-indigo-800 font-mono">{{ $course->join_code ?? 'Not generated' }}</p>
                        <p class="text-xs text-gray-500 mt-1">Share this code with students to join the course</p>
                    </div>
                    <form action="{{ route('faculty.course.regenerate-code', $course->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 text-sm">
                            <i class="ri-refresh-line mr-1"></i> Regenerate Code
                        </button>
                    </form>
                </div>
            </div>
            <div class="p-6">
                <!-- Tabs -->
                <div class="border-b border-gray-200 mb-6">
                    <nav class="flex space-x-8">
                        <a href="#" class="tab-link py-2 px-1 border-b-2 border-indigo-500 text-indigo-600 font-medium" data-tab="materials">
                            Materials
                        </a>
                        <a href="#" class="tab-link py-2 px-1 text-gray-500 hover:text-gray-700" data-tab="quizzes">
                            Quizzes
                        </a>
                        <a href="#" class="tab-link py-2 px-1 text-gray-500 hover:text-gray-700" data-tab="students">
                            Students
                        </a>
                    </nav>
                </div>

                <!-- Materials Tab -->
                <div id="materials" class="tab-content">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Course Materials</h3>
                            <button onclick="showUploadModal()" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                                <i class="ri-upload-line mr-1"></i> Upload Material
                            </button>
                        </div>
                        
                        @if($course->materials->count() > 0)
                            <div class="space-y-3">
                                @foreach($course->materials as $material)
                                    <div class="border rounded-lg p-4 flex justify-between items-center">
                                        <div>
                                            <h4 class="font-semibold">{{ $material->title }}</h4>
                                            <p class="text-sm text-gray-600">{{ $material->description ?? 'No description' }}</p>
                                            <div class="flex items-center space-x-3 mt-1">
                                                <span class="text-xs text-gray-400">Uploaded: {{ $material->created_at->format('M d, Y') }}</span>
                                                <span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ pathinfo($material->file_path, PATHINFO_EXTENSION) }}</span>
                                            </div>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('faculty.material.download', $material->id) }}" 
                                               class="text-indigo-600 hover:text-indigo-800">
                                                <i class="ri-download-line text-xl"></i>
                                            </a>
                                            <form action="{{ route('faculty.material.delete', $material->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Delete this material?')">
                                                    <i class="ri-delete-bin-line text-xl"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <i class="ri-file-line text-6xl text-gray-300 mb-4 block"></i>
                                <p class="text-gray-500">No materials uploaded yet.</p>
                                <button onclick="showUploadModal()" class="mt-4 text-indigo-600 hover:text-indigo-700">
                                    Upload your first material →
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quizzes Tab -->
                <div id="quizzes" class="tab-content hidden">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Quizzes</h3>
                            <a href="{{ route('faculty.create.quiz', $course->id) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                <i class="ri-add-line mr-1"></i> Create Quiz
                            </a>
                        </div>
                        
                        @if($course->quizzes->count() > 0)
                            <div class="space-y-3">
                                @foreach($course->quizzes as $quiz)
                                    <div class="border rounded-lg p-4">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <h4 class="font-semibold text-lg">{{ $quiz->title }}</h4>
                                                <p class="text-sm text-gray-600">{{ $quiz->description ?? 'No description' }}</p>
                                                <div class="flex space-x-4 mt-2 text-sm text-gray-500">
                                                    <span><i class="ri-question-line"></i> {{ $quiz->questions->count() }} Questions</span>
                                                    <span><i class="ri-star-line"></i> {{ $quiz->total_points }} Points</span>
                                                    @if($quiz->duration_minutes)
                                                        <span><i class="ri-time-line"></i> {{ $quiz->duration_minutes }} minutes</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="flex space-x-2">
                                                <a href="{{ route('faculty.edit.quiz', $quiz->id) }}" class="text-yellow-600 hover:text-yellow-800">
                                                    <i class="ri-edit-line text-xl"></i>
                                                </a>
                                                <a href="{{ route('faculty.submissions', $quiz->id) }}" class="text-blue-600 hover:text-blue-800">
                                                    <i class="ri-bar-chart-line text-xl"></i>
                                                </a>
                                                <form action="{{ route('faculty.delete.quiz', $quiz->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Delete this quiz?')">
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
                                <i class="ri-quiz-line text-6xl text-gray-300 mb-4 block"></i>
                                <p class="text-gray-500">No quizzes created yet.</p>
                                <a href="{{ route('faculty.create.quiz', $course->id) }}" class="mt-4 inline-block text-indigo-600 hover:text-indigo-700">
                                    Create your first quiz →
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Students Tab -->
                <div id="students" class="tab-content hidden">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Enrolled Students</h3>
                            <button onclick="showEnrollModal()" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                                <i class="ri-add-line mr-1"></i> Enroll Student
                            </button>
                        </div>
                        
                        @if($course->students->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Enrolled Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($course->students as $student)
                                            @php
                                                // Find the enrollment record for this student in this course
                                                $enrollment = $student->enrollments->firstWhere('course_id', $course->id);
                                            @endphp
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                                            <i class="ri-user-line text-indigo-600 text-sm"></i>
                                                        </div>
                                                        {{ $student->name }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $student->student_id ?? 'N/A' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $student->email }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $enrollment ? $enrollment->created_at->format('M d, Y') : 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($enrollment)
                                                        <form action="{{ route('faculty.student.remove', $enrollment->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Remove student from this course?')">
                                                                Remove
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span class="text-gray-400">No enrollment record</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-12">
                                <i class="ri-user-line text-6xl text-gray-300 mb-4 block"></i>
                                <p class="text-gray-500">No students enrolled in this course yet.</p>
                                <button onclick="showEnrollModal()" class="mt-4 text-indigo-600 hover:text-indigo-700">
                                    Enroll your first student →
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Material Modal -->
    <div id="uploadModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4">Upload Course Material</h3>
            <form action="{{ route('faculty.upload.material', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Title *</label>
                    <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Description</label>
                    <textarea name="description" rows="3" class="w-full border rounded px-3 py-2"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">File *</label>
                    <input type="file" name="file" class="w-full border rounded px-3 py-2" required>
                    <p class="text-xs text-gray-500 mt-1">Max size: 10MB. Supported: PDF, DOC, PPT, MP4, etc.</p>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeUploadModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Upload</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Enroll Student Modal -->
    <div id="enrollModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4">Enroll Student</h3>
            <form action="{{ route('faculty.student.enroll') }}" method="POST">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Student Email</label>
                    <input type="email" name="student_email" class="w-full border rounded px-3 py-2" required>
                    <p class="text-xs text-gray-500 mt-1">Enter the student's email address</p>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeEnrollModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Enroll</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Tab switching
        document.querySelectorAll('.tab-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const tabId = link.dataset.tab;
                
                // Hide all tab contents
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                });
                
                // Show selected tab
                document.getElementById(tabId).classList.remove('hidden');
                
                // Update tab styles
                document.querySelectorAll('.tab-link').forEach(l => {
                    l.classList.remove('border-indigo-500', 'text-indigo-600');
                    l.classList.add('text-gray-500');
                });
                link.classList.add('border-indigo-500', 'text-indigo-600');
                link.classList.remove('text-gray-500');
            });
        });
        
        function showUploadModal() {
            document.getElementById('uploadModal').classList.remove('hidden');
            document.getElementById('uploadModal').classList.add('flex');
        }
        
        function closeUploadModal() {
            document.getElementById('uploadModal').classList.add('hidden');
            document.getElementById('uploadModal').classList.remove('flex');
        }
        
        function showEnrollModal() {
            document.getElementById('enrollModal').classList.remove('hidden');
            document.getElementById('enrollModal').classList.add('flex');
        }
        
        function closeEnrollModal() {
            document.getElementById('enrollModal').classList.add('hidden');
            document.getElementById('enrollModal').classList.remove('flex');
        }
        
        // Close modals when clicking outside
        document.getElementById('uploadModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeUploadModal();
            }
        });
        
        document.getElementById('enrollModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEnrollModal();
            }
        });
    </script>
</body>
</html>