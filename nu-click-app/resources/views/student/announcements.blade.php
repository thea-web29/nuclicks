<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements - Nu Clicks LMS</title>
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
            <div class="bg-white shadow-sm px-6 py-4">
                <h2 class="text-xl font-semibold text-gray-800">Announcements</h2>
                <p class="text-sm text-gray-500">Latest updates from your instructors</p>
            </div>

            <div class="p-6">
                @if($announcements->count() > 0)
                    <div class="space-y-4">
                        @foreach($announcements as $announcement)
                            <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                                <div class="border-l-4 border-indigo-500">
                                    <div class="p-6">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <span class="text-xs text-indigo-600 font-semibold">{{ $announcement->course->code }} - {{ $announcement->course->name }}</span>
                                                <h3 class="text-xl font-bold text-gray-800 mt-1">{{ $announcement->title }}</h3>
                                            </div>
                                            <span class="text-xs text-gray-400">{{ $announcement->created_at->format('M d, Y h:i A') }}</span>
                                        </div>
                                        <p class="text-gray-600 mt-2">{{ $announcement->content }}</p>
                                        <div class="mt-4 flex items-center text-sm text-gray-500">
                                            <i class="ri-user-line mr-1"></i>
                                            <span>Posted by: {{ $announcement->faculty->name ?? 'Instructor' }}</span>
                                            <i class="ri-time-line ml-4 mr-1"></i>
                                            <span>{{ $announcement->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6">
                        {{ $announcements->links() }}
                    </div>
                @else
                    <div class="bg-white rounded-lg shadow p-12 text-center">
                        <i class="ri-megaphone-line text-6xl text-gray-300 mb-4 block"></i>
                        <p class="text-gray-500">No announcements yet.</p>
                        <p class="text-sm text-gray-400 mt-2">Check back later for updates from your instructors.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>