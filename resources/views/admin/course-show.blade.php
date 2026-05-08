<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->name }} - Course Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-indigo-800 text-white fixed h-full overflow-y-auto">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Nu Clicks LMS</h1>
                <p class="text-sm text-indigo-200 mt-2">Admin Portal</p>
            </div>
            <nav class="mt-6">
                <div class="px-4 mb-4">
                    <p class="text-xs text-indigo-300 uppercase tracking-wider">Main</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-dashboard-line mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.users') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-user-line mr-3"></i>
                    <span>Users</span>
                </a>
                <a href="{{ route('admin.courses') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-book-line mr-3"></i>
                    <span>Courses</span>
                </a>
                <a href="{{ route('admin.quizzes') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-quiz-line mr-3"></i>
                    <span>Quizzes</span>
                </a>
                <a href="{{ route('admin.analytics') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-bar-chart-line mr-3"></i>
                    <span>Analytics</span>
                </a>
                <a href="{{ route('admin.logs') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-history-line mr-3"></i>
                    <span>Activity Logs</span>
                </a>
                <a href="{{ route('admin.settings') }}"class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-settings-line mr-3"></i>
                    <span>Settings</span>
                </a>
                
                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs text-indigo-300 uppercase tracking-wider">Account</p>
                </div>

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
                        <h2 class="text-xl font-semibold text-gray-800">Course Details</h2>
                        <p class="text-sm text-gray-600">{{ $course->code }} - {{ $course->name }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <button onclick="openEditModal()" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700">
                            <i class="ri-edit-line mr-1"></i> Edit Course
                        </button>
                        <a href="{{ route('admin.courses') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                            Back to Courses
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Course Info Card -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="text-center">
                                <div class="h-24 w-24 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="ri-book-line text-4xl text-indigo-600"></i>
                                </div>
                                <h3 class="text-xl font-bold">{{ $course->name }}</h3>
                                <p class="text-gray-600">{{ $course->code }}</p>
                                <div class="mt-4">
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                                </div>
                            </div>
                            <div class="border-t mt-6 pt-6">
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Join Code:</span>
                                    <span class="font-mono font-bold text-indigo-600">{{ $course->join_code ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Credits:</span>
                                    <span class="font-medium">{{ $course->credits }}</span>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Faculty:</span>
                                    <span class="font-medium">{{ $course->faculty->name ?? 'Not assigned' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Created:</span>
                                    <span class="font-medium">{{ $course->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course Stats -->
                    <div class="lg:col-span-2">
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-white rounded-lg shadow p-6 text-center">
                                <i class="ri-user-line text-3xl text-blue-600 mb-2 block"></i>
                                <p class="text-2xl font-bold">{{ $course->students_count ?? 0 }}</p>
                                <p class="text-sm text-gray-500">Enrolled Students</p>
                            </div>
                            <div class="bg-white rounded-lg shadow p-6 text-center">
                                <i class="ri-quiz-line text-3xl text-green-600 mb-2 block"></i>
                                <p class="text-2xl font-bold">{{ $course->quizzes_count ?? 0 }}</p>
                                <p class="text-sm text-gray-500">Total Quizzes</p>
                            </div>
                        </div>

                        <!-- Course Description -->
                        <div class="bg-white rounded-lg shadow mb-6">
                            <div class="p-6 border-b">
                                <h3 class="text-lg font-semibold">Description</h3>
                            </div>
                            <div class="p-6">
                                <p class="text-gray-600">{{ $course->description ?? 'No description provided.' }}</p>
                            </div>
                        </div>

                        <!-- Enrolled Students List -->
                        <div class="bg-white rounded-lg shadow">
                            <div class="p-6 border-b">
                                <h3 class="text-lg font-semibold">Enrolled Students</h3>
                            </div>
                            <div class="p-6">
                                @if($course->students->count() > 0)
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student ID</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Enrolled Date</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($course->students as $student)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->name }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->email }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->student_id ?? 'N/A' }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ $student->pivot->created_at->format('M d, Y') }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-gray-500 text-center py-4">No students enrolled in this course.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Course Modal -->
    <div id="editCourseModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b">
                <h3 class="text-xl font-semibold">Edit Course</h3>
                <p class="text-gray-600 text-sm">Update course information</p>
            </div>
            <div class="p-6">
                <form id="editCourseForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editCourseId" name="course_id" value="{{ $course->id }}">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Course Code *</label>
                            <input type="text" id="editCode" name="code" required 
                                   value="{{ $course->code }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Course Name *</label>
                            <input type="text" id="editName" name="name" required 
                                   value="{{ $course->name }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea id="editDescription" name="description" rows="3" 
                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">{{ $course->description }}</textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Credits</label>
                            <input type="number" id="editCredits" name="credits" min="1" max="6" 
                                   value="{{ $course->credits }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Assign Faculty</label>
                            <select id="editFacultyId" name="faculty_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                                <option value="">-- Select Faculty --</option>
                                @foreach($faculties ?? [] as $faculty)
                                    <option value="{{ $faculty->id }}" {{ $course->faculty_id == $faculty->id ? 'selected' : '' }}>
                                        {{ $faculty->name }} - {{ $faculty->department ?? 'No department' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Join Code</label>
                        <div class="flex space-x-2">
                            <input type="text" id="editJoinCode" name="join_code" readonly
                                   value="{{ $course->join_code ?? '' }}"
                                   class="flex-1 border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 font-mono">
                            <button type="button" onclick="generateEditJoinCode()" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                                Generate
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Students will use this code to join the course</p>
                    </div>
                    
                    <div class="flex justify-end space-x-2 pt-4 border-t">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2 border border-gray-300 rounded-lg">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Update Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Get faculties for the dropdown (you need to pass this from controller)
        // For now, we'll fetch them via AJAX or you can pass $faculties from controller
        
        function openEditModal() {
            document.getElementById('editCourseModal').classList.remove('hidden');
            document.getElementById('editCourseModal').classList.add('flex');
        }
        
        function closeEditModal() {
            document.getElementById('editCourseModal').classList.add('hidden');
            document.getElementById('editCourseModal').classList.remove('flex');
        }
        
        function generateEditJoinCode() {
            const code = Math.random().toString(36).substring(2, 8).toUpperCase();
            document.getElementById('editJoinCode').value = code;
        }
        
        document.getElementById('editCourseForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const courseId = document.getElementById('editCourseId').value;
            
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}');
            formData.append('_method', 'PUT');
            formData.append('code', document.getElementById('editCode').value);
            formData.append('name', document.getElementById('editName').value);
            formData.append('description', document.getElementById('editDescription').value);
            formData.append('credits', document.getElementById('editCredits').value);
            formData.append('faculty_id', document.getElementById('editFacultyId').value);
            formData.append('join_code', document.getElementById('editJoinCode').value);
            
            fetch(`/admin/courses/${courseId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Course updated successfully!');
                    location.reload();
                } else {
                    alert(data.message || 'Error updating course');
                }
            })
            .catch(error => {
                alert('Error: ' + error.message);
            });
        });
        
        document.getElementById('editCourseModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>
</body>
</html>