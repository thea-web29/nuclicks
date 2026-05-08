<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User - Admin Panel</title>
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
                        <h2 class="text-xl font-semibold text-gray-800">Create New User</h2>
                        <p class="text-sm text-gray-600">Add a new student, faculty, or admin user</p>
                    </div>
                    <a href="{{ route('admin.users') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                        Back to Users
                    </a>
                </div>
            </div>

            <div class="p-6 max-w-3xl">
                <div class="bg-white rounded-lg shadow p-6">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input type="text" name="name" required value="{{ old('name') }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                <input type="email" name="email" required value="{{ old('email') }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                                <input type="password" name="password" required
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                                <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password *</label>
                                <input type="password" name="password_confirmation" required
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Role *</label>
                                <select name="role" id="role" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                                    <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                                    <option value="faculty" {{ old('role') == 'faculty' ? 'selected' : '' }}>Faculty</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Student-specific fields -->
                        <div id="studentFields" class="{{ old('role') == 'student' ? '' : 'hidden' }}">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Student ID</label>
                                    <input type="text" name="student_id" value="{{ old('student_id') }}"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                                    <p class="text-xs text-gray-500 mt-1">For students only</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Year Level</label>
                                    <select name="year_level" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                                        <option value="">Select Year</option>
                                        <option value="1">1st Year</option>
                                        <option value="2">2nd Year</option>
                                        <option value="3">3rd Year</option>
                                        <option value="4">4th Year</option>
                                        <option value="5">5th Year</option>
                                        <option value="6">6th Year</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Faculty-specific fields -->
                        <div id="facultyFields" class="{{ old('role') == 'faculty' ? '' : 'hidden' }}">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                                    <input type="text" name="department" value="{{ old('department') }}"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                                    <p class="text-xs text-gray-500 mt-1">e.g., Computer Science, Engineering, Business</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Specialization</label>
                                    <input type="text" name="specialization" value="{{ old('specialization') }}"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                                    <p class="text-xs text-gray-500 mt-1">e.g., Web Development, Data Science, AI</p>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Qualification</label>
                                <textarea name="qualification" rows="2" 
                                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500"
                                          placeholder="e.g., PhD in Computer Science, Master's in Education">{{ old('qualification') }}</textarea>
                            </div>
                        </div>
                        
                        <!-- Common fields for all -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bio (Optional)</label>
                            <textarea name="bio" rows="3" 
                                      class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500"
                                      placeholder="Tell us about this user...">{{ old('bio') }}</textarea>
                        </div>
                        
                        <div class="flex justify-end space-x-2 pt-4 border-t">
                            <a href="{{ route('admin.users') }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</a>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Create User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show/hide fields based on role selection
        const roleSelect = document.getElementById('role');
        const studentFields = document.getElementById('studentFields');
        const facultyFields = document.getElementById('facultyFields');
        
        function toggleFields() {
            const role = roleSelect.value;
            
            if (role === 'student') {
                studentFields.classList.remove('hidden');
                facultyFields.classList.add('hidden');
            } else if (role === 'faculty') {
                studentFields.classList.add('hidden');
                facultyFields.classList.remove('hidden');
            } else {
                studentFields.classList.add('hidden');
                facultyFields.classList.add('hidden');
            }
        }
        
        roleSelect.addEventListener('change', toggleFields);
        
        // Initial toggle based on default selected role
        toggleFields();
    </script>
</body>
</html>