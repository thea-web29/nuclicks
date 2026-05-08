<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginHistory;
use App\Models\AccessLog;
use App\Models\ActivityLog;

class TrackLoginHistory
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Track after login
        if (Auth::check() && !session('login_tracked')) {
            $this->trackLogin($request);
            session(['login_tracked' => true]);
        }
        
        return $response;
    }
    
    private function trackLogin($request)
    {
        $userAgent = $request->userAgent();
        $deviceInfo = $this->parseUserAgent($userAgent);
        
        // Log to login_history
        LoginHistory::create([
            'user_id' => Auth::id(),
            'ip_address' => $request->ip(),
            'user_agent' => $userAgent,
            'device_type' => $deviceInfo['device_type'],
            'browser' => $deviceInfo['browser'],
            'os' => $deviceInfo['os'],
            'location' => null,
            'status' => 'success',
            'login_at' => now(),
        ]);
        
        // Log to access_logs
        AccessLog::create([
            'user_id' => Auth::id(),
            'action' => 'login',
            'resource_type' => 'user',
            'resource_id' => Auth::id(),
            'ip_address' => $request->ip(),
            'details' => 'User logged in successfully',
            'status' => 'success',
        ]);
        
        // Log to activity_logs
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'login',
            'description' => Auth::user()->name . ' logged into the system',
        ]);
    }
    
    private function parseUserAgent($userAgent)
    {
        $device_type = 'unknown';
        $browser = 'unknown';
        $os = 'unknown';
        
        // Detect device type
        if (preg_match('/mobile/i', $userAgent)) {
            $device_type = 'mobile';
        } elseif (preg_match('/tablet|ipad/i', $userAgent)) {
            $device_type = 'tablet';
        } elseif (preg_match('/windows|mac|linux/i', $userAgent)) {
            $device_type = 'desktop';
        }
        
        // Detect browser
        if (preg_match('/Edg/i', $userAgent)) {
            $browser = 'Edge';
        } elseif (preg_match('/Chrome/i', $userAgent)) {
            $browser = 'Chrome';
        } elseif (preg_match('/Safari/i', $userAgent)) {
            $browser = 'Safari';
        } elseif (preg_match('/Firefox/i', $userAgent)) {
            $browser = 'Firefox';
        } elseif (preg_match('/MSIE|Trident/i', $userAgent)) {
            $browser = 'Internet Explorer';
        }
        
        // Detect OS
        if (preg_match('/Windows/i', $userAgent)) {
            $os = 'Windows';
        } elseif (preg_match('/Mac/i', $userAgent)) {
            $os = 'macOS';
        } elseif (preg_match('/Linux/i', $userAgent)) {
            $os = 'Linux';
        } elseif (preg_match('/Android/i', $userAgent)) {
            $os = 'Android';
        } elseif (preg_match('/iOS|iPhone|iPad/i', $userAgent)) {
            $os = 'iOS';
        }
        
        return [
            'device_type' => $device_type,
            'browser' => $browser,
            'os' => $os,
        ];
    }
}