<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security & Logs - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <div class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Security & Logs</h2>
                    <p class="text-sm text-gray-500">Monitor system security and user activity</p>
                </div>
                <div class="flex space-x-2">
                    <button onclick="clearLogs('login')" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                        <i class="ri-delete-bin-line mr-1"></i> Clear Login History
                    </button>
                    <button onclick="clearLogs('access')" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700">
                        <i class="ri-delete-bin-line mr-1"></i> Clear Access Logs
                    </button>
                </div>
            </div>

            <div class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Logins</p>
                                <p class="text-3xl font-bold text-indigo-600">{{ number_format($totalLogins) }}</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="ri-login-box-line text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Unique Users</p>
                                <p class="text-3xl font-bold text-green-600">{{ number_format($uniqueUsers) }}</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="ri-user-line text-green-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Failed Logins</p>
                                <p class="text-3xl font-bold text-red-600">{{ number_format($failedLogins) }}</p>
                            </div>
                            <div class="bg-red-100 p-3 rounded-full">
                                <i class="ri-error-warning-line text-red-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Actions</p>
                                <p class="text-3xl font-bold text-purple-600">{{ number_format($totalActions) }}</p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <i class="ri-bar-chart-line text-purple-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Login Trends Chart -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Login Trends (Last 30 Days)</h3>
                        <canvas id="loginTrendsChart" height="200"></canvas>
                    </div>
                    
                    <!-- Devices & Browsers -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Device & Browser Statistics</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h4 class="font-medium mb-2">Devices</h4>
                                <div class="space-y-2">
                                    @foreach($devices as $device => $count)
                                        <div>
                                            <div class="flex justify-between text-sm mb-1">
                                                <span class="capitalize">{{ $device }}</span>
                                                <span>{{ $count }}</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="bg-indigo-600 rounded-full h-2" style="width: {{ $totalLogins > 0 ? ($count / $totalLogins) * 100 : 0 }}%"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div>
                                <h4 class="font-medium mb-2">Browsers</h4>
                                <div class="space-y-2">
                                    @foreach($browsers as $browser)
                                        <div>
                                            <div class="flex justify-between text-sm mb-1">
                                                <span>{{ $browser->browser ?: 'Unknown' }}</span>
                                                <span>{{ $browser->count }}</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="bg-green-600 rounded-full h-2" style="width: {{ $totalLogins > 0 ? ($browser->count / $totalLogins) * 100 : 0 }}%"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs for Logs -->
                <div class="border-b border-gray-200 mb-6">
                    <nav class="flex space-x-8">
                        <button onclick="showTab('login')" id="loginTab" class="tab-button py-2 px-1 border-b-2 border-indigo-500 text-indigo-600 font-medium">
                            Login History
                        </button>
                        <button onclick="showTab('access')" id="accessTab" class="tab-button py-2 px-1 text-gray-500 hover:text-gray-700">
                            Access Logs
                        </button>
                        <button onclick="showTab('active')" id="activeTab" class="tab-button py-2 px-1 text-gray-500 hover:text-gray-700">
                            Most Active Users
                        </button>
                    </nav>
                </div>

                <!-- Login History Table -->
                <div id="loginContent" class="tab-content">
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">IP Address</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Device</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Browser/OS</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Login Time</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Logout Time</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($loginHistory as $history)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                                        <i class="ri-user-line text-indigo-600 text-sm"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">{{ $history->user->name ?? 'N/A' }}</div>
                                                        <div class="text-xs text-gray-500">{{ $history->user->email ?? 'N/A' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono">{{ $history->ip_address ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @if($history->device_type === 'desktop')
                                                    <i class="ri-computer-line text-blue-600"></i>
                                                @elseif($history->device_type === 'mobile')
                                                    <i class="ri-smartphone-line text-green-600"></i>
                                                @else
                                                    <i class="ri-tablet-line text-purple-600"></i>
                                                @endif
                                                <span class="ml-1 capitalize">{{ $history->device_type ?? 'Unknown' }}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $history->browser ?? 'Unknown' }} / {{ $history->os ?? 'Unknown' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $history->login_at->format('M d, Y h:i A') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $history->logout_at ? $history->logout_at->format('M d, Y h:i A') : 'Still logged in' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Success</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="px-6 py-4 border-t">
                            {{ $loginHistory->links() }}
                        </div>
                    </div>
                </div>

                <!-- Access Logs Table -->
                <div id="accessContent" class="tab-content hidden">
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Resource</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">IP Address</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Timestamp</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($accessLogs as $log)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                                        <i class="ri-user-line text-indigo-600 text-sm"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">{{ $log->user->name ?? 'N/A' }}</div>
                                                        <div class="text-xs text-gray-500">{{ $log->user->email ?? 'N/A' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @switch($log->action)
                                                    @case('create')
                                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Create</span>
                                                        @break
                                                    @case('update')
                                                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Update</span>
                                                        @break
                                                    @case('delete')
                                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Delete</span>
                                                        @break
                                                    @case('login')
                                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Login</span>
                                                        @break
                                                    @case('logout')
                                                        <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Logout</span>
                                                        @break
                                                    @default
                                                        <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">{{ ucfirst($log->action) }}</span>
                                                @endswitch
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ ucfirst($log->resource_type) }} #{{ $log->resource_id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono">{{ $log->ip_address ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $log->created_at->format('M d, Y h:i A') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Success</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="px-6 py-4 border-t">
                            {{ $accessLogs->links() }}
                        </div>
                    </div>
                </div>

                <!-- Most Active Users -->
                <div id="activeContent" class="tab-content hidden">
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rank</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions Performed</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Last Activity</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($activeUsers as $index => $user)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">#{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                                        <i class="ri-user-line text-indigo-600 text-sm"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">{{ $user->user->name ?? 'N/A' }}</div>
                                                        <div class="text-xs text-gray-500">{{ $user->user->email ?? 'N/A' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($user->user->role === 'admin')
                                                    <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">Admin</span>
                                                @elseif($user->user->role === 'faculty')
                                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Faculty</span>
                                                @else
                                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Student</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-indigo-600">{{ $user->action_count }} actions</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $user->user->updated_at->diffForHumans() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Show selected tab
            document.getElementById(tabName + 'Content').classList.remove('hidden');
            
            // Update tab styles
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('border-indigo-500', 'text-indigo-600');
                btn.classList.add('text-gray-500');
            });
            
            const activeTab = document.getElementById(tabName + 'Tab');
            activeTab.classList.add('border-indigo-500', 'text-indigo-600');
            activeTab.classList.remove('text-gray-500');
        }
        
        function clearLogs(type) {
            if (confirm(`Are you sure you want to clear all ${type} logs? This action cannot be undone.`)) {
                window.location.href = `/admin/security/clear-logs?type=${type}`;
            }
        }
        
        // Login Trends Chart
        const ctx = document.getElementById('loginTrendsChart').getContext('2d');
        const loginTrends = @json($loginTrends);
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: loginTrends.map(item => item.date),
                datasets: [{
                    label: 'Logins',
                    data: loginTrends.map(item => item.logins),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    </script>
</body>
</html>