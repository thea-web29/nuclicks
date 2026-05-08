<?php

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

if (!function_exists('logActivity')) {
    function logActivity($action, $description, $metadata = null)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'description' => $description,
            'metadata' => $metadata,
        ]);
    }
}