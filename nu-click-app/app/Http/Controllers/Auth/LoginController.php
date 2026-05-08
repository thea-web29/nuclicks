<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginHistory;
use App\Models\AccessLog;
use App\Models\ActivityLog;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role === 'faculty') {
                return redirect()->intended('/faculty/dashboard');
            } else {
                return redirect()->intended('/student/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    public function logout(Request $request)
    {
        $user = Auth::user();
        $userName = $user ? $user->name : 'Unknown';
        $userRole = $user ? $user->role : 'unknown';
        $userId = $user ? $user->id : null;
        
        // Update login history with logout time
        $loginHistory = LoginHistory::where('user_id', $userId)
            ->whereNull('logout_at')
            ->orderBy('login_at', 'desc')
            ->first();
        
        if ($loginHistory) {
            $loginHistory->update(['logout_at' => now()]);
        }
        
        // Log to access_logs
        if ($userId) {
            AccessLog::create([
                'user_id' => $userId,
                'action' => 'logout',
                'resource_type' => 'user',
                'resource_id' => $userId,
                'ip_address' => $request->ip(),
                'details' => 'User logged out',
                'status' => 'success',
            ]);
            
            // Log to activity_logs
            ActivityLog::create([
                'user_id' => $userId,
                'action' => 'logout',
                'description' => $userName . ' (' . $userRole . ') logged out of the system',
            ]);
        }
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}