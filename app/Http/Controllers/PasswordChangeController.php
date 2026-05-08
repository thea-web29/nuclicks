<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Otp;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;

class PasswordChangeController extends Controller
{
    /**
     * Show the OTP + new password form.
     */
    public function showForm()
    {
        // Must have an otp_user_id in session
        if (!session('otp_user_id')) {
            return redirect()->route('login');
        }

        return view('auth.change-password');
    }

    /**
     * Verify OTP and set the new password.
     */
    public function update(Request $request)
    {
        $request->validate([
            'otp'                   => 'required|string|size:6',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $userId = session('otp_user_id');

        if (!$userId) {
            return redirect()->route('login')->withErrors(['otp' => 'Session expired. Please log in again.']);
        }

        $user = User::findOrFail($userId);

        // Find the latest valid OTP for this user
        $otpRecord = Otp::where('user_id', $userId)
            ->where('otp', $request->otp)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'The OTP is invalid or has expired. Please try again.']);
        }

        // Mark OTP as used
        $otpRecord->update(['used' => true]);

        // Update password and clear must_change_password flag
        $user->update([
            'password'             => Hash::make($request->password),
            'must_change_password' => false,
        ]);

        // Clear the session key
        session()->forget('otp_user_id');

        // Log the user in automatically
        Auth::login($user);

        return match ($user->role) {
            'admin'   => redirect('/admin/dashboard')->with('success', 'Password changed successfully. Welcome!'),
            'faculty' => redirect('/faculty/dashboard')->with('success', 'Password changed successfully. Welcome!'),
            default   => redirect('/student/dashboard')->with('success', 'Password changed successfully. Welcome!'),
        };
    }

    /**
     * Resend a new OTP to the user.
     */
    public function resend(Request $request)
    {
        $userId = session('otp_user_id');

        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::findOrFail($userId);

        // Invalidate old OTPs
        Otp::where('user_id', $userId)->update(['used' => true]);

        // Generate new OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        Otp::create([
            'user_id'    => $userId,
            'otp'        => $otp,
            'expires_at' => now()->addMinutes(10),
            'used'       => false,
        ]);

        Mail::to($user->email)->send(new OtpMail($otp, $user->name));

        return back()->with('info', 'A new OTP has been sent to ' . $user->email);
    }
}