<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - Nu Clicks LMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-indigo-800 text-white fixed h-full overflow-y-auto">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Nu Clicks LMS</h1>
                <p class="text-sm text-indigo-200 mt-2">Student Portal</p>
            </div>
            <nav class="mt-6">
                <div class="px-4 mb-4">
                    <p class="text-xs text-indigo-300 uppercase tracking-wider">Main</p>
                </div>
                <a href="{{ route('student.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-dashboard-line mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('student.courses') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-book-line mr-3"></i>
                    <span>My Courses</span>
                </a>
                <a href="{{ route('student.progress') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-bar-chart-line mr-3"></i>
                    <span>My Progress</span>
                </a>
                <a href="{{ route('student.announcements') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-megaphone-line mr-3"></i>
                    <span>Announcements</span>
                </a>
                <a href="{{ route('student.notifications') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-notification-line mr-3"></i>
                    <span>Notifications</span>
                </a>
                <a href="{{ route('student.faculty.evaluation') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-star-line mr-3"></i>
                    <span>Faculty Evaluation</span>
                </a>

                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs text-indigo-300 uppercase tracking-wider">Account</p>
                </div>
                <a href="{{ route('student.profile') }}" class="flex items-center px-6 py-3 bg-indigo-900">
                    <i class="ri-user-settings-line mr-3"></i>
                    <span>Profile</span>
                </a>
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
                <h2 class="text-xl font-semibold text-gray-800">My Profile</h2>
                <p class="text-sm text-gray-500">Manage your account information</p>
            </div>

            <div class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Profile Card -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="text-center">
                                <div class="relative inline-block">
                                    <div class="h-32 w-32 rounded-full bg-indigo-100 flex items-center justify-center mx-auto overflow-hidden">
                                        @if($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                                        @else
                                            <i class="ri-user-line text-5xl text-indigo-600"></i>
                                        @endif
                                    </div>
                                    <button onclick="document.getElementById('avatarInput').click()" 
                                            class="absolute bottom-0 right-0 bg-indigo-600 text-white p-1 rounded-full hover:bg-indigo-700 transition">
                                        <i class="ri-camera-line text-sm"></i>
                                    </button>
                                    <input type="file" id="avatarInput" accept="image/*" class="hidden" onchange="uploadAvatar(this)">
                                </div>
                                <h3 class="text-xl font-bold mt-4">{{ $user->name }}</h3>
                                <p class="text-gray-600">{{ $user->email }}</p>
                                <p class="text-sm text-gray-500 mt-1">Role: {{ ucfirst($user->role) }}</p>
                                <p class="text-xs text-gray-400 mt-2">Member since {{ $memberSince }}</p>
                            </div>
                            
                            <!-- Student Statistics Section -->
                            <div class="border-t mt-6 pt-6">
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-gray-600">Courses Enrolled</span>
                                    <span class="font-semibold text-indigo-600">{{ $enrolledCourses ?? 0 }}</span>
                                </div>
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-gray-600">Quizzes Taken</span>
                                    <span class="font-semibold text-green-600">{{ $quizzesTaken ?? 0 }}</span>
                                </div>
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-gray-600">Average Score</span>
                                    <span class="font-semibold text-purple-600">{{ $averageScore ?? 0 }}%</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Completed Materials</span>
                                    <span class="font-semibold text-orange-600">{{ $completedMaterials ?? 0 }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Profile Form -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg shadow">
                            <div class="border-b p-6">
                                <h3 class="text-lg font-semibold">Edit Profile</h3>
                            </div>
                            <div class="p-6">
                                <form action="{{ route('student.profile.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                            <input type="text" name="name" required value="{{ old('name', $user->name) }}"
                                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                            <input type="email" name="email" required value="{{ old('email', $user->email) }}"
                                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                        <input type="tel" name="phone" value="{{ old('phone', $user->phone ?? '') }}"
                                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500"
                                               placeholder="Enter your phone number">
                                    </div>
                                    
                                    <div class="mb-6">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                                        <textarea name="bio" rows="3" 
                                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500"
                                                  placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                                    </div>
                                    
                                    <div class="flex justify-end">
                                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                                            Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Change Password Form -->
                        <div class="bg-white rounded-lg shadow mt-6">
                            <div class="border-b p-6">
                                <h3 class="text-lg font-semibold">Change Password</h3>
                            </div>
                            <div class="p-6">
                                <form action="{{ route('student.password.change') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                        <input type="password" name="current_password" required
                                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                            <input type="password" name="new_password" required
                                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                                            <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                                            <input type="password" name="new_password_confirmation" required
                                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                                        </div>
                                    </div>
                                    
                                    <div class="flex justify-end">
                                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                                            Change Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        @if(isset($recentActivities) && $recentActivities->count() > 0)
                        <div class="bg-white rounded-lg shadow mt-6">
                            <div class="border-b p-6">
                                <h3 class="text-lg font-semibold">Recent Activity</h3>
                            </div>
                            <div class="p-6">
                                <div class="space-y-3">
                                    @foreach($recentActivities as $activity)
                                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                            <div class="flex-shrink-0">
                                                @switch($activity->type ?? $activity->action)
                                                    @case('course_joined')
                                                        <i class="ri-book-open-line text-green-600"></i>
                                                        @break
                                                    @case('quiz_submitted')
                                                        <i class="ri-quiz-line text-blue-600"></i>
                                                        @break
                                                    @case('material_completed')
                                                        <i class="ri-check-line text-yellow-600"></i>
                                                        @break
                                                    @default
                                                        <i class="ri-information-line text-indigo-600"></i>
                                                @endswitch
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm text-gray-700">{{ $activity->description ?? $activity->activity }}</p>
                                                <p class="text-xs text-gray-400 mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-4 text-center">
                                    <a href="{{ route('student.notifications') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">
                                        View All Activity →
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function uploadAvatar(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                if (!file.type.match('image.*')) {
                    alert('Please select an image file (JPEG, PNG, JPG, GIF)');
                    return;
                }
                
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB');
                    return;
                }
                
                const formData = new FormData();
                formData.append('avatar', file);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                
                const button = input.previousElementSibling;
                const originalHtml = button.innerHTML;
                button.innerHTML = '<i class="ri-loader-4-line animate-spin text-sm"></i>';
                button.disabled = true;
                
                fetch('{{ route('student.avatar.update') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message || 'Error uploading avatar');
                        button.innerHTML = originalHtml;
                        button.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error uploading avatar');
                    button.innerHTML = originalHtml;
                    button.disabled = false;
                });
            }
        }
    </script>
</body>
</html>