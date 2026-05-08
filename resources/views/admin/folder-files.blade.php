<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Folder & Files - NU Clicks LMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex">
    <aside class="w-64 bg-indigo-900 text-white fixed h-full overflow-y-auto">
        <div class="p-6 border-b border-indigo-700"><h1 class="text-2xl font-bold">Nu Clicks LMS</h1><p class="text-sm text-indigo-200">Admin Portal</p></div>
        <nav class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700"><i class="ri-dashboard-line mr-3"></i>Dashboard</a>
            <a href="{{ route('admin.users') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700"><i class="ri-team-line mr-3"></i>Users</a>
            <a href="{{ route('admin.faculty') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700"><i class="ri-user-star-line mr-3"></i>Faculty</a>
            <a href="{{ route('admin.subjects') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700"><i class="ri-book-open-line mr-3"></i>Subjects</a>
            <a href="{{ route('admin.faculty-evaluations') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700"><i class="ri-star-smile-line mr-3"></i>Faculty Evaluation</a>
            <a href="{{ route('admin.folder-files') }}" class="flex items-center px-6 py-3 bg-indigo-700"><i class="ri-folder-3-line mr-3"></i>Folder & Files</a>
            <a href="{{ route('admin.settings') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700"><i class="ri-settings-line mr-3"></i>Settings</a>
            <a href="{{ route('admin.profile') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700"><i class="ri-user-line mr-3"></i>My Profile</a>
        </nav>
    </aside>

    <main class="flex-1 ml-64">
        <div class="bg-white shadow px-6 py-4"><h2 class="text-xl font-bold text-gray-800">Folder & Files</h2><p class="text-sm text-gray-500">Create folders, upload files, download files, archive files, and view faculty uploaded materials.</p></div>
        <div class="p-6">
            @if(session('success'))<div class="mb-4 bg-green-100 text-green-700 border border-green-300 rounded p-3">{{ session('success') }}</div>@endif
            @if(session('error'))<div class="mb-4 bg-red-100 text-red-700 border border-red-300 rounded p-3">{{ session('error') }}</div>@endif
            @if($errors->any())<div class="mb-4 bg-red-100 text-red-700 border border-red-300 rounded p-3"><ul class="list-disc list-inside">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="font-bold text-gray-800 mb-4">Create Folder</h3>
                    <form action="{{ route('admin.folder-files.folders.store') }}" method="POST" class="flex gap-3">
                        @csrf
                        <input type="text" name="name" required placeholder="Folder name" class="flex-1 border rounded-lg px-4 py-2">
                        <button class="bg-indigo-700 text-white px-5 py-2 rounded-lg hover:bg-indigo-800">Create</button>
                    </form>
                </div>
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="font-bold text-gray-800 mb-4">Upload File</h3>
                    <form action="{{ route('admin.folder-files.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                        @csrf
                        <select name="folder_id" class="w-full border rounded-lg px-4 py-2">
                            <option value="">No folder / root</option>
                            @foreach($folders as $folderItem)<option value="{{ $folderItem->id }}">{{ $folderItem->name }}</option>@endforeach
                        </select>
                        <input type="file" name="file" required class="w-full border rounded-lg px-4 py-2 bg-white">
                        <textarea name="description" rows="2" placeholder="Description (optional)" class="w-full border rounded-lg px-4 py-2"></textarea>
                        <button class="bg-indigo-700 text-white px-5 py-2 rounded-lg hover:bg-indigo-800">Upload</button>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow overflow-hidden mb-6">
                <div class="px-6 py-4 border-b flex items-center justify-between"><h3 class="font-bold text-gray-800">Admin Files</h3><a href="{{ route('admin.folder-files') }}" class="text-sm text-indigo-700">Show all</a></div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">File</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Folder</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Uploaded By</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Size</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Actions</th></tr></thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($files as $file)
                                <tr>
                                    <td class="px-6 py-4"><p class="font-semibold text-gray-800">{{ $file->original_name ?? $file->name }}</p><p class="text-sm text-gray-500">{{ $file->description }}</p></td>
                                    <td class="px-6 py-4">{{ $file->folder->name ?? 'Root' }}</td>
                                    <td class="px-6 py-4">{{ $file->uploader->name ?? 'Admin' }}</td>
                                    <td class="px-6 py-4">{{ $file->size_for_humans }}</td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <a href="{{ route('admin.folder-files.download', $file) }}" class="bg-green-600 text-white px-3 py-1 rounded text-sm">Download</a>
                                        <form action="{{ route('admin.folder-files.archive', $file) }}" method="POST" onsubmit="return confirm('Archive this file?')">@csrf @method('PATCH')<button class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">Archive</button></form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">No admin files uploaded yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4">{{ $files->links() }}</div>
            </div>

            <div class="bg-white rounded-xl shadow overflow-hidden mb-6">
                <div class="px-6 py-4 border-b"><h3 class="font-bold text-gray-800">Faculty Uploaded Files / Materials</h3></div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Material</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Subject</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Faculty</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Uploaded</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Action</th></tr></thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($facultyMaterials as $material)
                                <tr>
                                    <td class="px-6 py-4"><p class="font-semibold">{{ $material->title }}</p><p class="text-sm text-gray-500">{{ $material->file_type }}</p></td>
                                    <td class="px-6 py-4">{{ $material->course->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">{{ $material->course->faculty->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $material->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">
                                        @if($material->file_path)
                                            <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="bg-blue-600 text-white px-3 py-1 rounded text-sm">Open</a>
                                        @else
                                            <span class="text-gray-400">No file</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">No faculty materials uploaded yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4">{{ $facultyMaterials->links() }}</div>
            </div>

            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="px-6 py-4 border-b"><h3 class="font-bold text-gray-800">Archived Files</h3></div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                    @forelse($archivedFiles as $file)
                        <div class="border rounded-lg p-4 bg-gray-50"><p class="font-semibold">{{ $file->original_name ?? $file->name }}</p><p class="text-xs text-gray-500">Archived {{ $file->archived_at?->format('M d, Y') }}</p></div>
                    @empty
                        <p class="text-gray-500">No archived files.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
