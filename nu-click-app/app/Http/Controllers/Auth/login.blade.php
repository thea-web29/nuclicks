Here's the enhanced login page using your `#0A1F44` navy and `#FFD70F` gold. Key design decisions:

- **Deep navy background** wraps the page, giving it a premium institutional feel
- **Gold sign-in button** is the primary CTA — high contrast against navy and white
- **Logo badge** uses navy + gold to establish brand identity at the top
- **Focus states** on inputs glow gold for a cohesive interaction feel
- **Role tags** use the brand duo — admin gets navy/gold, faculty gets gold/navy, student gets a light tint
- **Demo credentials** are tucked below a divider so they don't compete with the main form

Here's the updated Blade template code with these styles applied:

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Nu Clicks LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; }
        .page {
            min-height: 100vh;
            background: linear-gradient(135deg, #0A1F44 0%, #0f2d63 60%, #162e5c 100%);
            display: flex; align-items: center; justify-content: center;
            padding: 2rem 1rem;
        }
        .card {
            background: #fff; border-radius: 16px;
            width: 100%; max-width: 440px;
            padding: 2.5rem 2rem;
            box-shadow: 0 8px 40px rgba(10,31,68,0.25);
        }
        .logo-badge {
            width: 56px; height: 56px; border-radius: 12px;
            background: #0A1F44;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
        }
        .logo-badge svg { width: 32px; height: 32px; }
        h1 { text-align: center; font-size: 22px; font-weight: 600; color: #0A1F44; margin-bottom: 4px; }
        .subtitle { text-align: center; font-size: 13px; color: #5f6b7a; margin-bottom: 1.5rem; }
        .subtitle a { color: #0A1F44; font-weight: 500; text-decoration: none; }
        .error-box {
            background: #fff3f3; border: 1px solid #e24b4a;
            border-radius: 8px; padding: 10px 14px;
            font-size: 13px; color: #a32d2d; margin-bottom: 1rem;
        }
        .field-group { margin-bottom: 1rem; }
        label { display: block; font-size: 13px; font-weight: 500; color: #0A1F44; margin-bottom: 5px; }
        input[type="email"], input[type="password"] {
            width: 100%; padding: 10px 14px;
            border: 1px solid #c8d0dc; border-radius: 8px;
            font-size: 14px; color: #0A1F44; outline: none;
        }
        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #FFD70F; box-shadow: 0 0 0 3px rgba(255,215,15,0.2);
        }
        .row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; }
        .remember { display: flex; align-items: center; gap: 7px; font-size: 13px; color: #3a4557; }
        .forgot { font-size: 13px; color: #0A1F44; font-weight: 500; text-decoration: none; }
        .btn-signin {
            width: 100%; padding: 11px;
            background: #FFD70F; color: #0A1F44;
            font-size: 14px; font-weight: 600; border: none;
            border-radius: 8px; cursor: pointer;
        }
        .btn-signin:hover { background: #f0c900; }
        .divider { display: flex; align-items: center; gap: 12px; margin: 1.5rem 0 1.25rem; }
        .divider-line { flex: 1; height: 1px; background: #dde3ec; }
        .divider-label { font-size: 12px; color: #9aa5b4; }
        .demo-box {
            background: #f6f8fc; border-radius: 10px;
            border: 1px solid #dde3ec; padding: 1rem 1.25rem;
        }
        .demo-box h3 { font-size: 12px; font-weight: 600; color: #5f6b7a; text-transform: uppercase; letter-spacing: 0.07em; margin-bottom: 0.75rem; }
        .role-tag { display: inline-block; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 20px; margin-bottom: 4px; }
        .tag-admin { background: #0A1F44; color: #FFD70F; }
        .tag-faculty { background: #FFD70F; color: #0A1F44; }
        .tag-student { background: #e6ecf8; color: #0A1F44; }
        .demo-cred { font-size: 12px; color: #3a4557; line-height: 1.7; }
        .demo-sep { border: none; border-top: 1px solid #dde3ec; margin: 0.75rem 0; }
    </style>
</head>
<body>
<div class="page">
    <div class="card">
        <div class="logo-badge">
            <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="16" cy="16" r="13" stroke="#FFD70F" stroke-width="2.5"/>
                <path d="M10 21V11l6 8 6-8v10" stroke="#FFD70F" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h1>Nu Clicks LMS</h1>
        <p class="subtitle">Sign in to your account &nbsp;·&nbsp; <a href="/register">Create account</a></p>

        <form method="POST" action="/login">
            @csrf

            @if($errors->any())
                <div class="error-box">{{ $errors->first() }}</div>
            @endif

            <div class="field-group">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" placeholder="you@example.com"
                       autocomplete="email" required value="{{ old('email') }}">
            </div>
            <div class="field-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••"
                       autocomplete="current-password" required>
            </div>
            <div class="row">
                <label class="remember">
                    <input type="checkbox" id="remember" name="remember"> Remember me
                </label>
                <a href="#" class="forgot">Forgot password?</a>
            </div>
            <button class="btn-signin" type="submit">Sign in</button>
        </form>

        <div class="divider">
            <div class="divider-line"></div>
            <span class="divider-label">Demo credentials</span>
            <div class="divider-line"></div>
        </div>

        <div class="demo-box">
            <h3>Try the demo</h3>
            <div style="margin-bottom:0.75rem">
                <span class="role-tag tag-admin">Admin</span>
                <div class="demo-cred">admin@nuclicks.com &nbsp;·&nbsp; password</div>
            </div>
            <hr class="demo-sep">
            <div style="margin-bottom:0.75rem">
                <span class="role-tag tag-faculty">Faculty</span>
                <div class="demo-cred">faculty@nuclicks.com &nbsp;·&nbsp; password</div>
            </div>
            <hr class="demo-sep">
            <div>
                <span class="role-tag tag-student">Student</span>
                <div class="demo-cred">student@nuclicks.com &nbsp;·&nbsp; password</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>