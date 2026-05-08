{{-- resources/views/admin/bulk-import.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulk Import Accounts - NuClicks</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
<div class="max-w-6xl mx-auto p-6">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Bulk Import Accounts</h1>
            <p class="text-gray-600 mt-1">
                Upload CSV files to create multiple student or faculty accounts.
            </p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('admin.users.create') }}"
               class="px-4 py-2 rounded-lg bg-white border hover:bg-gray-50">
                Create Single Account
            </a>

            <a href="{{ route('admin.users') }}"
               class="px-4 py-2 rounded-lg bg-gray-800 text-white hover:bg-gray-900">
                Back to Users
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 rounded-lg bg-red-50 border border-red-200 p-4 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    @if(session('import_errors') && count(session('import_errors')))
        <div class="mb-4 rounded-lg bg-yellow-50 border border-yellow-200 p-4 text-yellow-800">
            <p class="font-semibold mb-2">Some rows were skipped:</p>
            <ul class="list-disc ml-5 space-y-1">
                @foreach(session('import_errors') as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 rounded-lg bg-red-50 border border-red-200 p-4 text-red-700">
            <ul class="list-disc ml-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-2">Upload CSV File</h2>
            <p class="text-sm text-gray-600 mb-6">
                Select account type, upload the correct template, then click import.
            </p>

            <form method="POST" action="{{ route('admin.bulk-import.process') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Account Type</label>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="cursor-pointer border rounded-xl p-4 hover:bg-blue-50">
                            <input type="radio" name="type" value="students" checked class="mr-2">
                            <span class="font-semibold">Students</span>
                            <p class="text-sm text-gray-500 mt-1">
                                Initial password = Student ID
                            </p>
                        </label>

                        <label class="cursor-pointer border rounded-xl p-4 hover:bg-yellow-50">
                            <input type="radio" name="type" value="faculty" class="mr-2">
                            <span class="font-semibold">Faculty</span>
                            <p class="text-sm text-gray-500 mt-1">
                                Initial password = Faculty ID
                            </p>
                        </label>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">CSV File</label>
                    <input type="file"
                           name="file"
                           accept=".csv,.txt"
                           required
                           class="w-full border rounded-xl px-4 py-3 bg-gray-50">
                    <p class="text-xs text-gray-500 mt-2">
                        Accepted file types: .csv or .txt only.
                    </p>
                </div>

                <button type="submit"
                        class="w-full md:w-auto px-6 py-3 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700">
                    Import Accounts
                </button>
            </form>
        </div>

        <div class="space-y-6">

            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-3">Download Templates</h3>

                <div class="space-y-3">
                    <a href="{{ route('admin.bulk-import.template', ['type' => 'students']) }}"
                       class="block text-center px-4 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700">
                        Students Template
                    </a>

                    <a href="{{ route('admin.bulk-import.template', ['type' => 'faculty']) }}"
                       class="block text-center px-4 py-3 rounded-xl bg-green-600 text-white font-semibold hover:bg-green-700">
                        Faculty Template
                    </a>
                </div>
            </div>

            <div class="bg-red-50 border border-red-200 rounded-2xl p-6">
                <h3 class="text-lg font-bold text-red-700 mb-2">Important</h3>
                <ul class="text-sm text-red-700 space-y-2 list-disc ml-5">
                    <li>Do not add password columns.</li>
                    <li>Students use Student ID as initial password.</li>
                    <li>Faculty use Faculty ID as initial password.</li>
                    <li>Users must change password on first login.</li>
                </ul>
            </div>

        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6 mt-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">CSV Format Guide</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="border rounded-xl p-4">
                <h3 class="font-bold text-blue-700 mb-2">Students CSV</h3>
                <code class="block bg-gray-100 p-3 rounded-lg text-sm mb-3">
                    name,email,student_id,year_level,section,program_code
                </code>

                <p class="text-sm text-gray-600 mb-2">Example:</p>
                <code class="block bg-gray-100 p-3 rounded-lg text-sm">
                    Juan Dela Cruz,juan@example.com,IMNHS26001,11,A,TECHPRO
                </code>
            </div>

            <div class="border rounded-xl p-4">
                <h3 class="font-bold text-green-700 mb-2">Faculty CSV</h3>
                <code class="block bg-gray-100 p-3 rounded-lg text-sm mb-3">
                    name,email,faculty_id,department,specialization
                </code>

                <p class="text-sm text-gray-600 mb-2">Example:</p>
                <code class="block bg-gray-100 p-3 rounded-lg text-sm">
                    Maria Santos,maria@example.com,FAC-001,Computer Science,Software Engineering
                </code>
            </div>
        </div>

        <p class="text-sm text-gray-500 mt-4">
            Note: Student <strong>program_code</strong> must already exist in the Programs table.
        </p>
    </div>

</div>
</body>
</html>