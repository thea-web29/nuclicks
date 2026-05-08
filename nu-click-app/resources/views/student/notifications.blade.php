<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Nu Clicks LMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
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
                <a href="{{ route('student.dashboard') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('student.dashboard') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-dashboard-line mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('student.courses') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('student.courses*') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-book-line mr-3"></i>
                    <span>My Courses</span>
                </a>
                <a href="{{ route('student.progress') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('student.progress*') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-bar-chart-line mr-3"></i>
                    <span>Progress</span>
                </a>
                <a href="{{ route('student.announcements') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('student.announcements*') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-megaphone-line mr-3"></i>
                    <span>Announcements</span>
                </a>
                <a href="{{ route('student.notifications') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('student.notifications*') ? 'bg-indigo-900' : 'hover:bg-indigo-700' }}">
                    <i class="ri-notification-line mr-3"></i>
                    <span>Notifications</span>
                    @if(isset($unreadNotifications) && $unreadNotifications > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $unreadNotifications }}</span>
                    @endif
                </a>
                
                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs text-indigo-300 uppercase tracking-wider">Account</p>
                </div>
                <a href="{{ route('student.profile') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700">
                    <i class="ri-user-line mr-3"></i>
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
            <div class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Notifications</h2>
                    <p class="text-sm text-gray-500">Stay updated with course activities</p>
                </div>
                @if($notifications->where('is_read', false)->count() > 0)
                    <form action="{{ route('student.notifications.mark-all-read') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-indigo-600 hover:text-indigo-800 text-sm">
                            Mark all as read
                        </button>
                    </form>
                @endif
            </div>

            <div class="p-6">
                @if($notifications->count() > 0)
                    <div class="space-y-3">
                        @foreach($notifications as $notification)
                            <div class="bg-white rounded-lg shadow hover:shadow-md transition {{ $notification->is_read ? '' : 'border-l-4 border-indigo-500' }}">
                                <div class="p-5">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2 mb-2">
                                                @if(!$notification->is_read)
                                                    <span class="w-2 h-2 bg-indigo-600 rounded-full"></span>
                                                @endif
                                                <span class="text-xs font-semibold text-indigo-600">
                                                    @switch($notification->type)
                                                        @case('announcement')
                                                            <i class="ri-megaphone-line mr-1"></i> Announcement
                                                            @break
                                                        @case('new_material')
                                                            <i class="ri-file-line mr-1"></i> New Material
                                                            @break
                                                        @case('new_quiz')
                                                            <i class="ri-quiz-line mr-1"></i> New Quiz
                                                            @break
                                                        @case('deadline')
                                                            <i class="ri-calendar-warning-line mr-1"></i> Deadline
                                                            @break
                                                        @default
                                                            <i class="ri-information-line mr-1"></i> Update
                                                    @endswitch
                                                </span>
                                                <span class="text-xs text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                                            </div>
                                            <h3 class="font-semibold text-gray-800">{{ $notification->title }}</h3>
                                            <p class="text-gray-600 mt-1">{{ $notification->message }}</p>
                                            @if($notification->link)
                                                <a href="{{ $notification->link }}" class="inline-block mt-3 text-indigo-600 hover:text-indigo-800 text-sm">
                                                    View Details <i class="ri-arrow-right-line ml-1"></i>
                                                </a>
                                            @endif
                                        </div>
                                        @if(!$notification->is_read)
                                            <button onclick="markAsRead({{ $notification->id }})" 
                                                    class="text-gray-400 hover:text-gray-600 ml-4">
                                                <i class="ri-check-line text-xl"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6">
                        {{ $notifications->links() }}
                    </div>
                @else
                    <div class="bg-white rounded-lg shadow p-12 text-center">
                        <i class="ri-notification-off-line text-6xl text-gray-300 mb-4 block"></i>
                        <p class="text-gray-500">No notifications yet.</p>
                        <p class="text-sm text-gray-400 mt-2">You'll see updates about your courses here.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function markAsRead(notificationId) {
            fetch(`/student/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>