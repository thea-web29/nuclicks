<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->name }} - NuClicks Course Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
</head>

<body class="bg-gray-100">
<div class="min-h-screen flex">

    <div class="w-64 bg-indigo-800 text-white h-full fixed">
        <div class="p-6">
            <h1 class="text-2xl font-bold">NuClicks LMS</h1>
            <p class="text-sm text-indigo-200 mt-2">Faculty Portal</p>
        </div>

        <nav class="mt-6">
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

    <div class="flex-1 ml-64">

        <div class="bg-white shadow-sm px-6 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ $course->code }} - {{ $course->name }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        Section: <strong>{{ $course->section ?? 'N/A' }}</strong>
                    </p>
                </div>

                <a href="{{ route('faculty.announcements', $course->id) }}"
                   class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                    <i class="ri-megaphone-line mr-1"></i> Announcements
                </a>
            </div>
        </div>

        <div class="p-6">

            @if(session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-xl shadow p-5">
                    <p class="text-sm text-gray-500">Course</p>
                    <h3 class="text-lg font-bold text-gray-900">{{ $course->name }}</h3>
                    <p class="text-sm text-gray-600 mt-1">Code: {{ $course->code }}</p>
                    <p class="text-sm text-gray-600">Section: {{ $course->section ?? 'N/A' }}</p>
                </div>

                <div class="bg-white rounded-xl shadow p-5">
                    <p class="text-sm text-gray-500">Current Join Code</p>
                    <h3 class="text-3xl font-bold font-mono text-indigo-700">
                        {{ $course->join_code ?? 'NONE' }}
                    </h3>
                    <p class="text-xs text-gray-500 mt-1">
                        Students will use this code to join the class.
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow p-5">
                    <p class="text-sm text-gray-500">Class Summary</p>
                    <h3 class="text-lg font-bold text-gray-900">
                        {{ $course->students->count() }} enrolled
                    </h3>
                    <p class="text-sm text-gray-600">
                        {{ ($eligibleStudents ?? collect())->count() }} eligible in this course and section
                    </p>
                </div>
            </div>

            <div class="bg-indigo-50 rounded-xl p-5 mb-6 border border-indigo-200">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-indigo-900">Class Access</h3>
                        <p class="text-sm text-indigo-700">
                            Add students registered in this same course and section, then generate and email the join code.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <form action="{{ route('faculty.course.add-eligible-students', $course->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700"
                                    onclick="return confirm('Add all eligible students from this course and section?')">
                                <i class="ri-user-add-line mr-1"></i>
                                Add Students to Class
                            </button>
                        </form>

                        <form action="{{ route('faculty.course.generate-code', $course->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <button type="submit"
                                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700"
                                    onclick="return confirm('Generate join code and email students in this course and section?')">
                                <i class="ri-mail-send-line mr-1"></i>
                                Generate & Email Code
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="border-b border-gray-200 mb-6">
                <nav class="flex space-x-8">
                    <a href="#" class="tab-link py-2 px-1 border-b-2 border-indigo-500 text-indigo-600 font-medium" data-tab="eligible">
                        Eligible Students
                    </a>

                    <a href="#" class="tab-link py-2 px-1 text-gray-500 hover:text-gray-700" data-tab="students">
                        Enrolled Students
                    </a>

                    <a href="#" class="tab-link py-2 px-1 text-gray-500 hover:text-gray-700" data-tab="materials">
                        Materials
                    </a>

                    <a href="#" class="tab-link py-2 px-1 text-gray-500 hover:text-gray-700" data-tab="quizzes">
                        Quizzes
                    </a>
                </nav>
            </div>

            <div id="eligible" class="tab-content">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-2">Eligible Students</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        These are students whose registered course and section match this faculty class.
                    </p>

                    @if(($eligibleStudents ?? collect())->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Section</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Class Status</th>
                                </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($eligibleStudents as $student)
                                    @php
                                        $isEnrolled = $course->students->contains('id', $student->id);
                                    @endphp

                                    <tr>
                                        <td class="px-6 py-4">{{ $student->name }}</td>
                                        <td class="px-6 py-4">{{ $student->student_id ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">{{ $student->email }}</td>
                                        <td class="px-6 py-4">{{ $student->section ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            @if($isEnrolled)
                                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                                    Already Added
                                                </span>
                                            @else
                                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                                    Not Yet Added
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="ri-user-search-line text-6xl text-gray-300 mb-4 block"></i>
                            <p class="text-gray-500">No eligible students found for this course and section.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div id="students" class="tab-content hidden">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-4">Enrolled Students</h3>

                    @if($course->students->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Enrolled Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                                </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($course->students as $student)
                                    @php
                                        $enrollment = $student->enrollments->firstWhere('course_id', $course->id);
                                    @endphp

                                    <tr>
                                        <td class="px-6 py-4">{{ $student->name }}</td>
                                        <td class="px-6 py-4">{{ $student->student_id ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">{{ $student->email }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $enrollment ? $enrollment->created_at->format('M d, Y') : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($enrollment)
                                                <form action="{{ route('faculty.student.remove', $enrollment->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-red-600 hover:text-red-900"
                                                            onclick="return confirm('Remove student from this class?')">
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
                            <p class="text-gray-500">No students enrolled yet.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div id="materials" class="tab-content hidden">
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
                                        <p class="text-xs text-gray-400 mt-1">
                                            Uploaded: {{ $material->created_at->format('M d, Y') }}
                                        </p>
                                    </div>

                                    <div class="flex space-x-2">
                                        <a href="{{ route('faculty.material.download', $material->id) }}"
                                           class="text-indigo-600 hover:text-indigo-800">
                                            <i class="ri-download-line text-xl"></i>
                                        </a>

                                        <form action="{{ route('faculty.material.delete', $material->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-800"
                                                    onclick="return confirm('Delete this material?')">
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
                        </div>
                    @endif
                </div>
            </div>

            <div id="quizzes" class="tab-content hidden">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Quizzes</h3>
                        <a href="{{ route('faculty.create.quiz', $course->id) }}"
                           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            <i class="ri-add-line mr-1"></i> Create Quiz
                        </a>
                    </div>

                    @if($course->quizzes->count() > 0)
                        <div class="space-y-3">
                            @foreach($course->quizzes as $quiz)
                                <div class="border rounded-lg p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-semibold text-lg">{{ $quiz->title }}</h4>
                                            <p class="text-sm text-gray-600">{{ $quiz->description ?? 'No description' }}</p>
                                            <div class="flex space-x-4 mt-2 text-sm text-gray-500">
                                                <span>{{ $quiz->questions->count() }} Questions</span>
                                                <span>{{ $quiz->total_points }} Points</span>
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
                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-800"
                                                        onclick="return confirm('Delete this quiz?')">
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
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

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
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeUploadModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Cancel
                </button>

                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelectorAll('.tab-link').forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();

            const tabId = link.dataset.tab;

            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            document.getElementById(tabId).classList.remove('hidden');

            document.querySelectorAll('.tab-link').forEach(l => {
                l.classList.remove('border-indigo-500', 'text-indigo-600', 'font-medium');
                l.classList.add('text-gray-500');
            });

            link.classList.add('border-indigo-500', 'text-indigo-600', 'font-medium');
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
</script>
</body>
</html>