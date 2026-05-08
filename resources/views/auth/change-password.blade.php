<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password – NuClicks</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f4f4f4; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card { background: #fff; border-radius: 10px; padding: 40px; width: 100%; max-width: 420px; box-shadow: 0 4px 16px rgba(0,0,0,0.10); }
        h1 { color: #e63946; font-size: 22px; margin-bottom: 6px; }
        p.sub { color: #666; font-size: 14px; margin-bottom: 24px; }
        .alert { padding: 10px 14px; border-radius: 6px; font-size: 14px; margin-bottom: 16px; }
        .alert-info  { background: #e8f4fd; color: #1a6fa8; }
        .alert-error { background: #fdecea; color: #c0392b; }
        label { display: block; font-size: 13px; font-weight: bold; color: #333; margin-bottom: 4px; }
        input[type=text], input[type=password] {
            width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px;
            font-size: 15px; margin-bottom: 16px; outline: none; transition: border-color .2s;
        }
        input:focus { border-color: #e63946; }
        .otp-input { letter-spacing: 6px; font-size: 22px; text-align: center; font-weight: bold; }
        button[type=submit] {
            width: 100%; padding: 12px; background: #e63946; color: #fff; border: none;
            border-radius: 6px; font-size: 15px; font-weight: bold; cursor: pointer;
        }
        button[type=submit]:hover { background: #c0392b; }
        .resend { text-align: center; margin-top: 14px; font-size: 13px; color: #888; }
        .resend a { color: #e63946; text-decoration: none; }
    </style>
</head>
<body>
<div class="card">
    <h1>Set New Password</h1>
    <p class="sub">Enter the OTP sent to your email and choose a new password.</p>

    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.change.update') }}">
        @csrf

        <label for="otp">One-Time Password (OTP)</label>
        <input
            type="text"
            id="otp"
            name="otp"
            class="otp-input"
            maxlength="6"
            placeholder="______"
            autocomplete="off"
            required
        >

        <label for="password">New Password</label>
        <input type="password" id="password" name="password" placeholder="Min. 8 characters" required>

        <label for="password_confirmation">Confirm New Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat new password" required>

        <button type="submit">Set Password &amp; Log In</button>
    </form>

    <div class="resend">
        Didn't receive the OTP?
        <a href="{{ route('password.change.resend') }}">Resend OTP</a>
    </div>
</div>
</body>
</html>