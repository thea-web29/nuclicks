<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login – NuClicks</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 40px 36px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.10);
        }

        .logo {
            text-align: center;
            margin-bottom: 28px;
        }

        .logo h1 {
            font-size: 28px;
            font-weight: 800;
            color: #e63946;
            letter-spacing: -0.5px;
        }

        .logo p {
            color: #888;
            font-size: 13px;
            margin-top: 4px;
        }

        .alert {
            padding: 10px 14px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .alert-error {
            background: #fdecea;
            color: #c0392b;
            border-left: 3px solid #e63946;
        }

        .alert-info {
            background: #e8f4fd;
            color: #1a6fa8;
            border-left: 3px solid #2980b9;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #444;
            margin-bottom: 6px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid #ddd;
            border-radius: 7px;
            font-size: 15px;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            color: #333;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #e63946;
            box-shadow: 0 0 0 3px rgba(230, 57, 70, 0.12);
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 22px;
        }

        .remember-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #e63946;
            cursor: pointer;
        }

        .remember-row label {
            margin: 0;
            font-size: 13px;
            color: #666;
            cursor: pointer;
            font-weight: normal;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #e63946;
            color: #fff;
            border: none;
            border-radius: 7px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s;
            letter-spacing: 0.3px;
        }

        .btn-login:hover {
            background: #c0392b;
        }

        .footer-note {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #999;
        }
    </style>
</head>
<body>
<div class="login-wrapper">
    <div class="card">
        <div class="logo">
            <h1>NuClicks</h1>
            <p>Sign in to your account</p>
        </div>

        {{-- Session messages (e.g. after OTP redirect) --}}
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        {{-- Validation errors --}}
        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="you@example.com"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >
            </div>

            <div class="remember-row">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>

            <button type="submit" class="btn-login">Log In</button>
        </form>

        <div class="footer-note">
            NuClicks &copy; {{ date('Y') }}
        </div>
    </div>
</div>
</body>
</html>