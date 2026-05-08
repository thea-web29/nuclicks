<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login – NU Horizon LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600&display=swap" rel="stylesheet">
    <style>
        /* ══ TOKENS (mirrored from landing) ══ */
        :root {
            --navy:      #0A1F44;
            --navy-mid:  #1F3A6D;
            --navy-lite: #3D5FA0;
            --navy-pale: #EEF3FB;
            --gold:      #FFD70F;
            --gold-d:    #C49A00;
            --gold-mid:  #F5C800;
            --gold-pale: #FFFBEA;
            --bg:        #F8F6F1;
            --white:     #FFFFFF;
            --txt-1:     #0A1F44;
            --txt-2:     #2C3E5C;
            --txt-3:     #637089;
            --bdr:       rgba(10,31,68,0.10);
            --ease:      cubic-bezier(0.22,1,0.36,1);
            --spring:    cubic-bezier(0.34,1.56,0.64,1);
            --t:         0.26s var(--ease);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--navy);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* ══ BACKGROUND ══ */
        .bg-layer {
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 15% 50%, rgba(63,95,160,0.45) 0%, transparent 65%),
                radial-gradient(ellipse 50% 70% at 85% 20%, rgba(255,215,15,0.07) 0%, transparent 55%),
                var(--navy);
            z-index: 0;
        }

        /* Subtle grid texture */
        .bg-layer::after {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.015) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.015) 1px, transparent 1px);
            background-size: 48px 48px;
        }

        /* ══ CARD ══ */
        .login-card {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: min(900px, 96vw);
            min-height: 560px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow:
                0 32px 80px rgba(0,0,0,0.55),
                0 0 0 1px rgba(255,215,15,0.12);
            animation: cardIn .7s var(--ease) both;
        }

        @keyframes cardIn {
            from { opacity:0; transform:translateY(28px) scale(0.97); }
            to   { opacity:1; transform:translateY(0) scale(1); }
        }

        /* ══ LEFT PANEL ══ */
        .panel-left {
            background: linear-gradient(150deg, var(--navy-mid) 0%, var(--navy) 60%, #060f22 100%);
            padding: 3.5rem 3rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        /* Decorative arcs */
        .panel-left::before {
            content: "";
            position: absolute;
            width: 420px; height: 420px;
            border-radius: 50%;
            border: 1.5px solid rgba(255,215,15,0.08);
            top: 50%; left: 50%;
            transform: translate(-50%,-50%);
            pointer-events: none;
        }
        .panel-left::after {
            content: "";
            position: absolute;
            width: 280px; height: 280px;
            border-radius: 50%;
            border: 1px solid rgba(255,215,15,0.12);
            top: 50%; left: 50%;
            transform: translate(-50%,-50%);
            pointer-events: none;
        }

        /* Gold top bar */
        .panel-left .gold-bar {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), var(--gold-mid), transparent);
            background-size: 200% 100%;
            animation: shimmer 4s linear infinite;
        }

        @keyframes shimmer {
            0%   { background-position: -200% center; }
            100% { background-position:  200% center; }
        }

        /* Seal */
        .seal-wrap {
            position: relative;
            width: 110px; height: 110px;
            margin-bottom: 2rem;
            z-index: 1;
        }
        .seal-ring {
            position: absolute;
            inset: -8px;
            border-radius: 50%;
            border: 2.5px solid rgba(255,215,15,0.50);
            box-shadow: 0 0 24px rgba(255,215,15,0.18), inset 0 0 12px rgba(255,215,15,0.06);
            animation: rotateSlow 18s linear infinite;
        }
        @keyframes rotateSlow {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }
        .seal-ring::before {
            content: "";
            position: absolute;
            top: -3px; left: 50%;
            transform: translateX(-50%);
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--gold);
            box-shadow: 0 0 8px var(--gold);
        }
        .seal-img {
            width: 110px; height: 110px;
            border-radius: 50%;
            object-fit: contain;
            background: rgba(255,255,255,0.07);
            border: 2px solid rgba(255,255,255,0.12);
            display: block;
        }
        .seal-fallback {
            width: 110px; height: 110px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
            border: 2px solid rgba(255,215,15,0.30);
            display: flex; align-items: center; justify-content: center;
            font-size: 2.8rem; color: var(--gold);
        }

        .panel-left .univ-name {
            font-family: 'Fraunces', serif;
            font-size: 1.55rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
            letter-spacing: -.02em;
            z-index: 1;
            margin-bottom: .5rem;
        }
        .panel-left .univ-name em {
            font-style: italic;
            color: var(--gold);
        }

        .panel-left .univ-sub {
            font-size: .72rem;
            font-weight: 500;
            color: rgba(255,255,255,0.38);
            letter-spacing: .14em;
            text-transform: uppercase;
            z-index: 1;
            margin-bottom: 2.25rem;
        }

        /* Divider */
        .panel-left .left-divider {
            width: 2.5rem; height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            border-radius: 2px;
            margin: 0 auto 1.75rem;
            z-index: 1;
        }

        /* Chips */
        .left-chips {
            display: flex;
            flex-direction: column;
            gap: .6rem;
            z-index: 1;
            width: 100%;
        }
        .left-chip {
            display: flex;
            align-items: center;
            gap: .6rem;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 8px;
            padding: .55rem .9rem;
            font-size: .75rem;
            color: rgba(255,255,255,0.50);
            transition: background var(--t), border-color var(--t), color var(--t);
        }
        .left-chip:hover {
            background: rgba(255,215,15,0.08);
            border-color: rgba(255,215,15,0.22);
            color: rgba(255,255,255,0.80);
        }
        .left-chip-dot {
            width: 5px; height: 5px;
            border-radius: 50%;
            background: var(--gold);
            opacity: .7;
            flex-shrink: 0;
        }

        /* ══ RIGHT PANEL ══ */
        .panel-right {
            background: var(--bg);
            padding: 3.5rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        /* Subtle warm texture */
        .panel-right::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 50% at 100% 0%, rgba(255,215,15,0.06) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 0% 100%, rgba(10,31,68,0.04) 0%, transparent 50%);
            pointer-events: none;
        }

        .form-header {
            margin-bottom: 2rem;
            position: relative;
        }
        .form-logo {
            font-family: 'Fraunces', serif;
            font-size: 1.65rem;
            font-weight: 700;
            color: var(--navy);
            letter-spacing: -.02em;
            line-height: 1;
            margin-bottom: .35rem;
        }
        .form-logo em { color: var(--gold-d); font-style: normal; }

        .form-tagline {
            font-size: .75rem;
            font-weight: 600;
            color: var(--txt-3);
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .form-subtitle {
            font-size: .82rem;
            color: var(--txt-3);
            margin-top: .6rem;
            line-height: 1.5;
        }

        /* Header rule */
        .form-rule {
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, var(--bdr) 0%, transparent 100%);
            margin: 1.5rem 0;
        }

        /* ══ ALERTS ══ */
        .alert {
            padding: .75rem 1rem;
            border-radius: 8px;
            font-size: .8rem;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: flex-start;
            gap: .55rem;
            line-height: 1.5;
        }
        .alert-error {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid rgba(185,28,28,0.18);
            border-left: 3px solid #dc2626;
        }
        .alert-info {
            background: var(--navy-pale);
            color: var(--navy-mid);
            border: 1px solid rgba(63,95,160,0.18);
            border-left: 3px solid var(--navy-lite);
        }
        .alert-icon { font-size: .9rem; margin-top: .05rem; flex-shrink: 0; }

        /* ══ FORM ELEMENTS ══ */
        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
        }

        .form-label {
            display: block;
            font-size: .75rem;
            font-weight: 700;
            color: var(--txt-2);
            margin-bottom: .5rem;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .input-wrap {
            position: relative;
        }
        .input-icon {
            position: absolute;
            left: .9rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--txt-3);
            font-size: .8rem;
            pointer-events: none;
            transition: color var(--t);
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: .78rem 1rem .78rem 2.5rem;
            border: 1.5px solid var(--bdr);
            border-radius: 9px;
            font-size: .9rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            outline: none;
            background: var(--white);
            color: var(--txt-1);
            transition: border-color var(--t), box-shadow var(--t);
            box-shadow: 0 1px 4px rgba(10,31,68,0.04);
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: var(--gold-d);
            box-shadow: 0 0 0 3px rgba(196,154,0,0.14), 0 1px 4px rgba(10,31,68,0.06);
        }

        .input-wrap:focus-within .input-icon {
            color: var(--gold-d);
        }

        /* Password toggle */
        .pw-toggle {
            position: absolute;
            right: .9rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--txt-3);
            font-size: .82rem;
            cursor: pointer;
            padding: .2rem;
            transition: color var(--t);
            outline: none;
        }
        .pw-toggle:hover { color: var(--navy); }

        /* Remember row */
        .remember-row {
            display: flex;
            align-items: center;
            gap: .65rem;
            margin-bottom: 1.5rem;
        }
        .remember-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--navy);
            cursor: pointer;
            border-radius: 4px;
            flex-shrink: 0;
        }
        .remember-row label {
            font-size: .8rem;
            color: var(--txt-3);
            cursor: pointer;
            font-weight: 500;
            line-height: 1;
        }

        /* Submit button */
        .btn-login {
            width: 100%;
            padding: .88rem;
            background: var(--navy);
            color: #fff;
            border: none;
            border-radius: 9px;
            font-size: .9rem;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            letter-spacing: .02em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .55rem;
            position: relative;
            overflow: hidden;
            transition: background var(--t), transform var(--t), box-shadow var(--t);
            box-shadow: 0 4px 18px rgba(10,31,68,0.30);
        }

        /* Gold shimmer sweep on hover */
        .btn-login::before {
            content: "";
            position: absolute;
            top: 0; left: -100%;
            width: 60%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,215,15,0.18), transparent);
            transition: left .55s var(--ease);
        }
        .btn-login:hover::before { left: 160%; }
        .btn-login:hover {
            background: var(--navy-mid);
            transform: translateY(-1px);
            box-shadow: 0 8px 28px rgba(10,31,68,0.40);
        }
        .btn-login:active { transform: translateY(0); }

        .btn-icon { font-size: .85rem; }

        /* Footer */
        .form-footer {
            margin-top: 1.5rem;
            padding-top: 1.2rem;
            border-top: 1px solid var(--bdr);
            text-align: center;
        }
        .form-footer p {
            font-size: .72rem;
            color: var(--txt-3);
            line-height: 1.5;
        }
        .form-footer a {
            color: var(--navy-mid);
            font-weight: 600;
            text-decoration: none;
            border-bottom: 1px solid var(--gold);
            padding-bottom: 1px;
            transition: color var(--t);
        }
        .form-footer a:hover { color: var(--gold-d); }

        /* ══ BACK LINK ══ */
        .back-link {
            position: fixed;
            top: 1.25rem;
            left: 1.25rem;
            z-index: 50;
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            font-size: .78rem;
            font-weight: 600;
            color: rgba(255,255,255,0.55);
            font-family: 'Plus Jakarta Sans', sans-serif;
            text-decoration: none;
            padding: .45rem .9rem;
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 8px;
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(8px);
            transition: all var(--t);
        }
        .back-link:hover {
            color: #fff;
            border-color: rgba(255,215,15,0.35);
            background: rgba(255,215,15,0.08);
        }

        /* ══ RESPONSIVE ══ */
        @media (max-width: 640px) {
            .login-card {
                grid-template-columns: 1fr;
                border-radius: 16px;
                min-height: auto;
            }
            .panel-left {
                padding: 2.5rem 1.75rem;
            }
            .panel-right {
                padding: 2.5rem 1.75rem;
            }
            .left-chips { display: none; }
            .panel-left .left-divider { display: none; }
            .seal-wrap { width: 80px; height: 80px; }
            .seal-img { width: 80px; height: 80px; }
            .seal-fallback { width: 80px; height: 80px; font-size: 2rem; }
        }

        /* Stagger-in for form elements */
        .fade-in { animation: fadeUp .5s var(--ease) both; }
        .fd1 { animation-delay: .12s; }
        .fd2 { animation-delay: .22s; }
        .fd3 { animation-delay: .32s; }
        .fd4 { animation-delay: .40s; }
        .fd5 { animation-delay: .48s; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<!-- Background -->
<div class="bg-layer"></div>

<!-- Back to main -->
<a href="/" class="back-link">
    <i>←</i> Back to Main Page
</a>

<!-- Card -->
<div class="login-card">

    <!-- LEFT: Branding panel -->
    <div class="panel-left">
        <div class="gold-bar"></div>

        <!-- Seal -->
        <div class="seal-wrap">
            <div class="seal-ring"></div>
            <img src="/logo/NatU.png" alt="NU seal" class="seal-img"
                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
            <div class="seal-fallback" style="display:none;">🎓</div>
        </div>

        <h2 class="univ-name">NU Horizon <em>LMS</em></h2>
        <p class="univ-sub">National University · Lipa</p>

        <div class="left-divider"></div>

        <div class="left-chips">
            <div class="left-chip">
                <span class="left-chip-dot"></span>
                Accredited — National University System
            </div>
            <div class="left-chip">
                <span class="left-chip-dot"></span>
                ISO 27001 Certified Security
            </div>
            <div class="left-chip">
                <span class="left-chip-dot"></span>
                15,000+ Active Learners
            </div>
        </div>
    </div>

    <!-- RIGHT: Form panel -->
    <div class="panel-right">

        <div class="form-header fade-in fd1">
            <div class="form-logo">NU Horizon <em>LMS</em></div>
            <div class="form-tagline">Intelligent Learning Platform</div>
            <p class="form-subtitle">Sign in to access your academic portal</p>
            <div class="form-rule"></div>
        </div>

        {{-- Session messages --}}
        @if(session('info'))
            <div class="alert alert-info fade-in fd1">
                <span class="alert-icon">ℹ</span>
                <span>{{ session('info') }}</span>
            </div>
        @endif

        {{-- Validation errors --}}
        @if($errors->any())
            <div class="alert alert-error fade-in fd1">
                <span class="alert-icon">⚠</span>
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="form-group fade-in fd2">
                <label class="form-label" for="email">Email Address</label>
                <div class="input-wrap">
                    <span class="input-icon">✉</span>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="yourname@national-u.edu.ph"
                        required
                        autofocus
                    >
                </div>
            </div>

            <div class="form-group fade-in fd3">
                <label class="form-label" for="password">Password</label>
                <div class="input-wrap">
                    <span class="input-icon">🔒</span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >
                    <button type="button" class="pw-toggle" onclick="togglePw()" id="pw-btn" title="Show/hide password">
                        👁
                    </button>
                </div>
            </div>

            <div class="remember-row fade-in fd4">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Keep me signed in</label>
            </div>

            <button type="submit" class="btn-login fade-in fd5">
                <span class="btn-icon">→</span>
                Sign In to Portal
            </button>
        </form>

        <div class="form-footer fade-in fd5">
            <p>Having trouble? Contact <a href="mailto:support@national-u.edu.ph">IT Support</a></p>
            <p style="margin-top:.5rem;">NU Horizon LMS &copy; {{ date('Y') }} · National University</p>
        </div>

    </div>
</div>

<script>
function togglePw() {
    const input = document.getElementById('password');
    const btn   = document.getElementById('pw-btn');
    if (input.type === 'password') {
        input.type = 'text';
        btn.textContent = '🙈';
    } else {
        input.type = 'password';
        btn.textContent = '👁';
    }
}
</script>
</body>
</html>