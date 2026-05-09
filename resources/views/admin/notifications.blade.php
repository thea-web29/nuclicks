<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Admin Panel | NU Clicks LMS</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #F5F7FB;
        }

        .page-card {
            background: white;
            border-radius: 1.25rem;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
            border: 1px solid #E9EDF2;
            overflow: hidden;
        }

        .notification-row {
            padding: 1.25rem;
            border-bottom: 1px solid #E9EDF2;
            display: flex;
            gap: 1rem;
            align-items: flex-start;
        }

        .notification-row.unread {
            background: #EFF6FF;
        }

        .notification-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #0A1F44;
            color: #FFD70F;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .btn-primary {
            background: #0A1F44;
            color: white;
            padding: 0.6rem 1rem;
            border-radius: 999px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .btn-primary:hover {
            background: #0e2a5c;
        }

        .btn-light {
            background: #EEF2FF;
            color: #0A1F44;
            padding: 0.55rem 1rem;
            border-radius: 999px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }
    </style>
</head>
<body>

<div class="min-h-screen">
    <div class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between sticky top-0 z-20">
        <div>
            <h1 class="text-xl font-bold text-[#0A1F44] m-0">Admin Notifications</h1>
            <p class="text-sm text-gray-500 m-0">View faculty evaluation alerts and other system notifications</p>
        </div>

        <div class="flex items-center gap-3">
            @include('admin.partials.notification-bell')

            <a href="{{ route('admin.dashboard') }}" class="btn-light">
                <i class="ri-arrow-left-line"></i>
                Back to Dashboard
            </a>
        </div>
    </div>

    <div class="p-6">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="page-card">
            <div class="px-5 py-4 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-lg font-bold text-[#0A1F44] m-0">
                    <i class="ri-notification-3-line"></i>
                    All Notifications
                </h2>

                <form method="POST" action="{{ route('admin.notifications.mark-all-read') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-primary">
                        <i class="ri-check-double-line"></i>
                        Mark all as read
                    </button>
                </form>
            </div>

            @forelse($notifications as $notification)
                <div class="notification-row {{ !$notification->is_read ? 'unread' : '' }}">
                    <div class="notification-icon">
                        @if($notification->type === 'faculty_evaluation')
                            <i class="ri-star-smile-line"></i>
                        @else
                            <i class="ri-notification-3-line"></i>
                        @endif
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center justify-between gap-3">
                            <h3 class="font-bold text-gray-800 m-0">
                                {{ $notification->title }}
                            </h3>

                            @if(!$notification->is_read)
                                <span class="text-xs bg-blue-600 text-white px-2 py-1 rounded-full">Unread</span>
                            @endif
                        </div>

                        <p class="text-gray-600 mt-2 mb-2">
                            {{ $notification->message }}
                        </p>

                        <p class="text-xs text-gray-400 mb-3">
                            {{ $notification->created_at ? $notification->created_at->format('M d, Y h:i A') : '' }}
                        </p>

                        <div class="flex items-center gap-2">
                            @if($notification->link)
                                <form method="POST" action="{{ route('admin.notifications.read', $notification->id) }}" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="btn-light">
                                        Open
                                    </button>
                                </form>
                            @elseif(!$notification->is_read)
                                <form method="POST" action="{{ route('admin.notifications.read', $notification->id) }}" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="btn-light">
                                        Mark as read
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 text-gray-500">
                    <i class="ri-notification-off-line text-6xl text-gray-300 block mb-4"></i>
                    <p class="font-semibold">No notifications yet.</p>
                    <p class="text-sm">Faculty evaluation alerts will appear here once students submit them.</p>
                </div>
            @endforelse

            @if($notifications->hasPages())
                <div class="p-4">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>