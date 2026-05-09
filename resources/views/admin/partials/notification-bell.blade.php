@php
    use App\Models\Notification;

    $adminUnreadNotifications = Notification::where('user_id', Auth::id())
        ->where('is_read', false)
        ->count();

    $adminRecentNotifications = Notification::where('user_id', Auth::id())
        ->latest()
        ->limit(5)
        ->get();
@endphp

<style>
    .admin-notification-wrapper {
        position: relative;
    }

    .admin-notification-btn {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        border: 1px solid #E5E7EB;
        background: white;
        color: #0A1F44;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        position: relative;
        transition: all 0.2s ease;
    }

    .admin-notification-btn:hover {
        background: #F8FAFF;
        border-color: #FFD70F;
        box-shadow: 0 4px 10px rgba(0,0,0,0.06);
    }

    .admin-notification-btn i {
        font-size: 1.25rem;
    }

    .admin-notification-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        min-width: 18px;
        height: 18px;
        padding: 0 5px;
        border-radius: 999px;
        background: #dc2626;
        color: white;
        font-size: 0.65rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid white;
    }

    .admin-notification-dropdown {
        display: none;
        position: absolute;
        top: 50px;
        right: 0;
        width: 360px;
        max-width: calc(100vw - 2rem);
        background: white;
        border: 1px solid #E5E7EB;
        border-radius: 18px;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.16);
        overflow: hidden;
        z-index: 999;
    }

    .admin-notification-dropdown.active {
        display: block;
    }

    .admin-notification-header {
        padding: 1rem;
        background: #0A1F44;
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 2px solid #FFD70F;
    }

    .admin-notification-header h4 {
        margin: 0;
        font-size: 0.95rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .admin-notification-list {
        max-height: 360px;
        overflow-y: auto;
    }

    .admin-notification-item {
        padding: 0.85rem 1rem;
        border-bottom: 1px solid #F1F5F9;
        display: block;
        text-decoration: none;
        color: #1F2937;
        background: white;
    }

    .admin-notification-item:hover {
        background: #F8FAFF;
    }

    .admin-notification-item.unread {
        background: #EFF6FF;
    }

    .admin-notification-title {
        font-weight: 700;
        font-size: 0.85rem;
        color: #0A1F44;
        margin-bottom: 0.25rem;
    }

    .admin-notification-message {
        font-size: 0.78rem;
        color: #4B5563;
        line-height: 1.35;
    }

    .admin-notification-time {
        font-size: 0.7rem;
        color: #9CA3AF;
        margin-top: 0.35rem;
    }

    .admin-notification-empty {
        padding: 2rem 1rem;
        text-align: center;
        color: #6B7280;
        font-size: 0.85rem;
    }

    .admin-notification-footer {
        padding: 0.75rem 1rem;
        background: #F9FAFB;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
    }

    .admin-notification-footer a,
    .admin-notification-footer button {
        font-size: 0.78rem;
        font-weight: 700;
        color: #0A1F44;
        background: none;
        border: none;
        cursor: pointer;
        text-decoration: none;
    }

    .admin-notification-footer a:hover,
    .admin-notification-footer button:hover {
        color: #1D4ED8;
    }
</style>

<div class="admin-notification-wrapper">
    <button type="button" class="admin-notification-btn" onclick="toggleAdminNotifications(event)">
        <i class="ri-notification-3-line"></i>

        @if($adminUnreadNotifications > 0)
            <span class="admin-notification-badge">
                {{ $adminUnreadNotifications > 9 ? '9+' : $adminUnreadNotifications }}
            </span>
        @endif
    </button>

    <div id="adminNotificationDropdown" class="admin-notification-dropdown">
        <div class="admin-notification-header">
            <h4>
                <i class="ri-notification-3-line"></i>
                Notifications
            </h4>
            <span style="font-size: 0.75rem; color: #FFD70F;">
                {{ $adminUnreadNotifications }} unread
            </span>
        </div>

        <div class="admin-notification-list">
            @forelse($adminRecentNotifications as $notification)
                <form method="POST" action="{{ route('admin.notifications.read', $notification->id) }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="admin-notification-item {{ !$notification->is_read ? 'unread' : '' }}" style="width: 100%; text-align: left; border: none; cursor: pointer;">
                        <div class="admin-notification-title">
                            {{ $notification->title }}
                        </div>

                        <div class="admin-notification-message">
                            {{ $notification->message }}
                        </div>

                        <div class="admin-notification-time">
                            {{ $notification->created_at ? $notification->created_at->diffForHumans() : '' }}
                        </div>
                    </button>
                </form>
            @empty
                <div class="admin-notification-empty">
                    <i class="ri-notification-off-line" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                    No notifications yet.
                </div>
            @endforelse
        </div>

        <div class="admin-notification-footer">
            <a href="{{ route('admin.notifications') }}">View all</a>

            @if($adminUnreadNotifications > 0)
                <form method="POST" action="{{ route('admin.notifications.mark-all-read') }}" style="margin: 0;">
                    @csrf
                    <button type="submit">Mark all as read</button>
                </form>
            @endif
        </div>
    </div>
</div>

<script>
    function toggleAdminNotifications(event) {
        event.stopPropagation();

        const dropdown = document.getElementById('adminNotificationDropdown');

        if (dropdown) {
            dropdown.classList.toggle('active');
        }
    }

    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('adminNotificationDropdown');
        const wrapper = document.querySelector('.admin-notification-wrapper');

        if (dropdown && wrapper && !wrapper.contains(event.target)) {
            dropdown.classList.remove('active');
        }
    });
</script>