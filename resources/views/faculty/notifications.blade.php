<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications – NuClicks</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f0f2f5; min-height: 100vh; padding: 40px 20px; }
        .container { max-width: 680px; margin: 0 auto; }
        .card { background: #fff; border-radius: 12px; padding: 32px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
        h1 { font-size: 22px; font-weight: 700; color: #1a1a2e; }
        .mark-all { font-size: 13px; color: #1a1a2e; text-decoration: none; padding: 6px 14px; border: 1px solid #1a1a2e; border-radius: 6px; font-weight: 600; }
        .mark-all:hover { background: #1a1a2e; color: #fff; }
        .back-link { display: inline-block; margin-bottom: 20px; font-size: 13px; color: #1a1a2e; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
        .notif-item { display: flex; gap: 14px; padding: 16px 0; border-bottom: 1px solid #f0f2f5; align-items: flex-start; }
        .notif-item:last-child { border-bottom: none; }
        .notif-dot { width: 10px; height: 10px; border-radius: 50%; background: #e63946; flex-shrink: 0; margin-top: 5px; }
        .notif-dot.read { background: #ddd; }
        .notif-body { flex: 1; }
        .notif-message { font-size: 14px; color: #333; font-weight: 500; }
        .notif-item.read-item .notif-message { color: #888; font-weight: normal; }
        .notif-time { font-size: 12px; color: #aaa; margin-top: 4px; }
        .empty { text-align: center; padding: 40px 0; color: #aaa; font-size: 15px; }
        .alert-success { padding: 10px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 18px; background: #e6f9f0; color: #1a7a4a; border-left: 3px solid #27ae60; }
    </style>
</head>
<body>
<div class="container">
    <a href="{{ route('faculty.dashboard') }}" class="back-link">← Back to Dashboard</a>
    <div class="card">
        <div class="header">
            <h1>Notifications</h1>
            <form method="POST" action="{{ route('faculty.notifications.mark-all-read') }}" style="display:inline;">
                @csrf
                <button type="submit" class="mark-all">Mark all as read</button>
            </form>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if($notifications->isEmpty())
            <div class="empty">You have no notifications.</div>
        @else
            @foreach($notifications as $notif)
                <div class="notif-item {{ $notif->is_read ? 'read-item' : '' }}">
                    <div class="notif-dot {{ $notif->is_read ? 'read' : '' }}"></div>
                    <div class="notif-body">
                        <div class="notif-message" style="font-weight: 700;">{{ $notif->title }}</div>
                        <div class="notif-message" style="margin-top: 4px;">{{ $notif->message }}</div>
                        <div class="notif-time">{{ $notif->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            @endforeach

            <div style="margin-top:20px;">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
</div>
</body>
</html>