<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Evaluation - NU Clicks LMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex">
    <aside class="w-64 bg-indigo-900 text-white fixed h-full overflow-y-auto">
        <div class="p-6 border-b border-indigo-700">
            <h1 class="text-2xl font-bold">Nu Clicks LMS</h1>
            <p class="text-sm text-indigo-200">Admin Portal</p>
        </div>
        <nav class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700"><i class="ri-dashboard-line mr-3"></i>Dashboard</a>
            <a href="{{ route('admin.users') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700"><i class="ri-team-line mr-3"></i>Users</a>
            <a href="{{ route('admin.faculty') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700"><i class="ri-user-star-line mr-3"></i>Faculty</a>
            <a href="{{ route('admin.subjects') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700"><i class="ri-book-open-line mr-3"></i>Subjects</a>
            <a href="{{ route('admin.faculty-evaluations') }}" class="flex items-center px-6 py-3 bg-indigo-700"><i class="ri-star-smile-line mr-3"></i>Faculty Evaluation</a>
            <a href="{{ route('admin.folder-files') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700"><i class="ri-folder-3-line mr-3"></i>Folder & Files</a>
            <a href="{{ route('admin.analytics') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700"><i class="ri-bar-chart-line mr-3"></i>Analytics</a>
            <a href="{{ route('admin.logs') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700"><i class="ri-history-line mr-3"></i>Activity Logs</a>
            <a href="{{ route('admin.settings') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700"><i class="ri-settings-line mr-3"></i>Settings</a>
            <a href="{{ route('admin.profile') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700"><i class="ri-user-line mr-3"></i>My Profile</a>
        </nav>
    </aside>

    <main class="flex-1 ml-64">
        <div class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Faculty Evaluation</h2>
                <p class="text-sm text-gray-500">Oversee faculty performance based on student feedback.</p>
            </div>
            <div>
                <button onclick="openSettingsModal()" class="bg-indigo-700 hover:bg-indigo-800 text-white px-4 py-2 rounded-lg text-sm font-semibold flex items-center shadow transition-colors">
                    <i class="ri-settings-3-line mr-2"></i> Evaluation Settings
                </button>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
                <div class="bg-white rounded-xl shadow p-5">
                    <p class="text-gray-500 text-sm">Total Evaluations</p>
                    <p class="text-3xl font-bold text-indigo-700">{{ number_format($totalEvaluations) }}</p>
                </div>
                <div class="bg-white rounded-xl shadow p-5">
                    <p class="text-gray-500 text-sm">Average Rating</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ number_format($averageRating, 2) }}/5</p>
                </div>
                <div class="bg-white rounded-xl shadow p-5">
                    <p class="text-gray-500 text-sm">Faculty With Feedback</p>
                    <p class="text-3xl font-bold text-green-600">{{ $faculty->where('faculty_evaluations_received_count', '>', 0)->count() }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow mb-6 overflow-hidden">
                <div class="px-6 py-4 border-b">
                    <h3 class="font-bold text-gray-800">Top 5 Performing Faculty</h3>
                </div>
                <div class="p-6">
                    @if($topFaculty->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                            @foreach($topFaculty as $index => $member)
                                <div class="border rounded-xl p-4 bg-gray-50">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-bold text-indigo-700">#{{ $index + 1 }}</span>
                                        <span class="font-bold text-yellow-600">{{ number_format($member->faculty_evaluations_received_avg_rating ?? 0, 2) }}/5</span>
                                    </div>
                                    <p class="font-semibold text-gray-800 truncate">{{ $member->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $member->faculty_evaluations_received_count }} evaluation(s)</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center">No faculty evaluations yet.</p>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-xl shadow overflow-hidden mb-6">
                <div class="px-6 py-4 border-b">
                    <h3 class="font-bold text-gray-800">Faculty Performance Summary</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Faculty</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Average Rating</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Evaluations</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Performance</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($faculty as $member)
                                @php $rating = $member->faculty_evaluations_received_avg_rating ?? 0; @endphp
                                <tr>
                                    <td class="px-6 py-4">
                                        <p class="font-semibold text-gray-800">{{ $member->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $member->email }}</p>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-yellow-600">{{ number_format($rating, 2) }}/5</td>
                                    <td class="px-6 py-4">{{ $member->faculty_evaluations_received_count }}</td>
                                    <td class="px-6 py-4">
                                        @if($rating >= 4.5)
                                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">Excellent</span>
                                        @elseif($rating >= 3.5)
                                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">Good</span>
                                        @elseif($rating > 0)
                                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">Needs Support</span>
                                        @else
                                            <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-sm font-semibold">No Data</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="px-6 py-4 border-b">
                    <h3 class="font-bold text-gray-800">Recent Student Feedback</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Faculty</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Course</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Rating</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Comment</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($evaluations as $evaluation)
                                <tr>
                                    <td class="px-6 py-4 font-semibold">{{ $evaluation->faculty->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">{{ $evaluation->course->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 font-bold text-yellow-600">{{ number_format($evaluation->rating, 2) }}/5</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $evaluation->comment ?: 'No comment' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $evaluation->created_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">No feedback submitted yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            <div class="p-4">{{ $evaluations->links() }}</div>
        </div>
    </div>
</main>

<!-- Evaluation Settings Modal -->
<div id="settingsModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-indigo-50">
            <h3 class="text-lg font-bold text-indigo-900 flex items-center">
                <i class="ri-calendar-check-line mr-2"></i> Evaluation Period
            </h3>
            <button onclick="closeSettingsModal()" class="text-gray-500 hover:text-gray-700">
                <i class="ri-close-line text-xl"></i>
            </button>
        </div>
        <form action="{{ route('admin.faculty-evaluations.settings') }}" method="POST" class="p-6">
            @csrf
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <div class="flex items-center space-x-6">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="status" value="open" class="form-radio text-indigo-600 w-4 h-4" {{ $evalStatus !== 'closed' ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Open</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="status" value="closed" class="form-radio text-indigo-600 w-4 h-4" {{ $evalStatus === 'closed' ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Closed</span>
                    </label>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Start Date</label>
                <input type="datetime-local" name="start_date" value="{{ $evalStart }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">End Date</label>
                <input type="datetime-local" name="end_date" value="{{ $evalEnd }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeSettingsModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium text-sm transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-indigo-700 hover:bg-indigo-800 text-white rounded-lg font-medium text-sm transition shadow">Save Settings</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openSettingsModal() {
        document.getElementById('settingsModal').classList.remove('hidden');
        document.getElementById('settingsModal').classList.add('flex');
    }
    
    function closeSettingsModal() {
        document.getElementById('settingsModal').classList.add('hidden');
        document.getElementById('settingsModal').classList.remove('flex');
    }
</script>

</div>
</body>
</html>
