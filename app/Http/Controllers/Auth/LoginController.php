<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginHistory;
use App\Models\AccessLog;
use App\Models\ActivityLog;
use App\Models\Otp;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // ── Force password change on first login ──────────────────────────
            if ($user->must_change_password) {
                // Invalidate any previous OTPs for this user
                Otp::where('user_id', $user->id)->update(['used' => true]);

                // Generate a 6-digit OTP valid for 10 minutes
                $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

                Otp::create([
                    'user_id'    => $user->id,
                    'otp'        => $otp,
                    'expires_at' => now()->addMinutes(10),
                    'used'       => false,
                ]);

                // Send OTP to student's email
                Mail::to($user->email)->send(new OtpMail($otp, $user->name));

                // Store user id in session for the change-password page
                session(['otp_user_id' => $user->id]);

                // Log out immediately — user must verify OTP first
                Auth::logout();

                return redirect()->route('password.change.form')
                    ->with('info', 'A one-time password has been sent to ' . $user->email . '. Please enter it to set your new password.');
            }
            // ─────────────────────────────────────────────────────────────────

            // Normal redirect based on role
            return match ($user->role) {
                'admin'   => redirect()->intended('/admin/dashboard'),
                'faculty' => redirect()->intended('/faculty/dashboard'),
                default   => redirect()->intended('/student/dashboard'),
            };
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $user     = Auth::user();
        $userId   = $user?->id;
        $userName = $user?->name ?? 'Unknown';
        $userRole = $user?->role ?? 'unknown';

        // Update login history
        if ($userId) {
            $loginHistory = LoginHistory::where('user_id', $userId)
                ->whereNull('logout_at')
                ->orderBy('login_at', 'desc')
                ->first();

            $loginHistory?->update(['logout_at' => now()]);

            AccessLog::create([
                'user_id'       => $userId,
                'action'        => 'logout',
                'resource_type' => 'user',
                'resource_id'   => $userId,
                'ip_address'    => $request->ip(),
                'details'       => 'User logged out',
                'status'        => 'success',
            ]);

            ActivityLog::create([
                'user_id'     => $userId,
                'action'      => 'logout',
                'description' => "{$userName} ({$userRole}) logged out of the system",
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}