<!DOCTYPE html>
<html>
<head>
    <title>Test Logs</title>
</head>
<body>
    <h1>Activity Logs Test</h1>
    <p>Total logs: {{ $logs->total() }}</p>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Action</th>
                <th>Description</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->user->name ?? 'System' }}</td>
                    <td>{{ $log->action }}</td>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $logs->links() }}
</body>
</html>