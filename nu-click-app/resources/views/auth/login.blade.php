<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Nu Clicks LMS | Secure Login</title>
    <!-- Google Fonts + Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* ---------- RESET & FULLSCREEN NO SCROLL ---------- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            overflow: hidden;  /* prevents scrolling */
        }

        body {
            font-family: 'Inter', sans-serif;
            /* gradient blue background */
            background: linear-gradient(135deg, #0A1F44 0%, #1A3A6E 50%, #0E2A55 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            min-height: 100vh;
        }

        /* subtle decorative elements (optional, keep minimal) */
        body::before {
            content: '';
            position: absolute;
            top: -20%;
            right: -10%;
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, rgba(255,215,15,0.08) 0%, rgba(255,215,15,0) 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: absolute;
            bottom: -15%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        /* BACK BUTTON - outside container, upper left, button style with text */
        .back-button {
            position: fixed;
            top: 1.8rem;
            left: 2rem;
            z-index: 100;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            padding: 0.6rem 1.3rem;
            border-radius: 2.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 0.3px;
            transition: all 0.25s ease;
            cursor: pointer;
            text-decoration: none;
            color: #FFD70F;
            border: 1px solid rgba(255, 215, 15, 0.5);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            font-family: 'Inter', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-button i {
            font-size: 0.85rem;
            color: #FFD70F;
        }

        .back-button:hover {
            background: #FFD70F;
            color: #0A1F44;
            transform: translateX(-4px);
            border-color: #FFD70F;
            box-shadow: 0 8px 18px rgba(0,0,0,0.15);
        }

        .back-button:hover i {
            color: #0A1F44;
        }

        /* login container — centered, no overflow */
        .login-container {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            padding: 1rem;
            animation: fadeSlideUp 0.5s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            z-index: 2;
            position: relative;
        }

        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* main card */
        .login-card {
            background: #FFFFFF;
            border-radius: 2rem;
            box-shadow: 0 25px 45px -12px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            transition: all 0.2s ease;
            border: 1px solid rgba(255, 215, 15, 0.3);
        }

        .card-accent {
            height: 5px;
            background: linear-gradient(90deg, #FFD70F, #FFE484, #FFD70F);
            width: 100%;
        }

        .card-inner {
            padding: 2rem 2rem 2.2rem;
        }

        /* brand */
        .brand {
            text-align: center;
            margin-bottom: 1.8rem;
            margin-top: 0.2rem;
        }

        .logo {
            font-size: 1.9rem;
            font-weight: 800;
            letter-spacing: -0.3px;
            background: linear-gradient(135deg, #0A1F44 20%, #1E3A6B 80%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: inline-block;
        }

        .logo span {
            color: #FFD70F;
            background: none;
            -webkit-background-clip: unset;
            background-clip: unset;
        }

        /* heading */
        .auth-heading {
            text-align: center;
            margin-bottom: 1.8rem;
        }

        .auth-heading h2 {
            font-size: 1.85rem;
            font-weight: 700;
            color: #0A1F44;
            letter-spacing: -0.3px;
        }

        .auth-heading p {
            font-size: 0.9rem;
            color: #5B6E8C;
            margin-top: 0.5rem;
        }

        .auth-heading a {
            color: #FFD70F;
            font-weight: 600;
            text-decoration: none;
            border-bottom: 1.5px dotted transparent;
            transition: all 0.2s ease;
        }

        .auth-heading a:hover {
            color: #e5c20c;
            border-bottom-color: #e5c20c;
        }

        /* error alert */
        .error-alert {
            background-color: #FFF5F5;
            border-left: 4px solid #E53E3E;
            border-radius: 1rem;
            padding: 0.9rem 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.85rem;
            color: #b91c1c;
        }

        .error-alert i {
            font-size: 1.1rem;
            color: #E53E3E;
        }

        /* form */
        .form-group {
            margin-bottom: 1.4rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
            color: #0A1F44;
            letter-spacing: -0.2px;
        }

        .input-icon-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon-wrapper i {
            position: absolute;
            left: 1rem;
            color: #5B6E8C;
            font-size: 1.1rem;
            pointer-events: none;
        }

        .input-icon-wrapper input {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.7rem;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            border: 1.5px solid #E9EEF5;
            border-radius: 1.2rem;
            background: #FFFFFF;
            transition: all 0.2s ease;
            color: #1E2A44;
            font-weight: 500;
            outline: none;
        }

        /* special styling for password field to accommodate eye button */
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-wrapper input {
            width: 100%;
            padding: 0.85rem 3rem 0.85rem 2.7rem;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            border: 1.5px solid #E9EEF5;
            border-radius: 1.2rem;
            background: #FFFFFF;
            transition: all 0.2s ease;
            color: #1E2A44;
            font-weight: 500;
            outline: none;
        }

        .password-wrapper input:focus {
            border-color: #FFD70F;
            box-shadow: 0 0 0 4px rgba(255, 215, 15, 0.25);
        }

        .toggle-password {
            position: absolute;
            right: 1rem;
            cursor: pointer;
            color: #5B6E8C;
            font-size: 1.1rem;
            transition: color 0.2s;
            background: transparent;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .toggle-password:hover {
            color: #FFD70F;
        }

        .input-icon-wrapper input:focus {
            border-color: #FFD70F;
            box-shadow: 0 0 0 4px rgba(255, 215, 15, 0.25);
        }

        .input-icon-wrapper input::placeholder {
            color: #BEC9DA;
            font-weight: 400;
        }

        /* remember & forgot */
        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 1rem 0 1.6rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .checkbox-wrapper input {
            width: 1rem;
            height: 1rem;
            accent-color: #FFD70F;
            cursor: pointer;
        }

        .checkbox-wrapper span {
            font-size: 0.85rem;
            font-weight: 500;
            color: #5B6E8C;
        }

        .forgot-link {
            font-size: 0.85rem;
            font-weight: 600;
            color: #0A1F44;
            text-decoration: none;
            transition: all 0.2s ease;
            border-bottom: 1px solid transparent;
        }

        .forgot-link:hover {
            color: #FFD70F;
            border-bottom-color: #FFD70F;
        }

        /* blue sign in button */
        .btn-login {
            background: #0A1F44;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            padding: 0.9rem 1.2rem;
            border: none;
            width: 100%;
            border-radius: 2rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            letter-spacing: 0.3px;
        }

        .btn-login i {
            font-size: 1rem;
            transition: transform 0.2s;
            color: #FFD70F;
        }

        .btn-login:hover {
            background: #122d5c;
            transform: translateY(-2px);
            box-shadow: 0 12px 20px -12px rgba(10, 31, 68, 0.4);
        }

        .btn-login:hover i {
            transform: translateX(3px);
        }

        .btn-login:active {
            transform: translateY(1px);
        }

        /* responsive adjustments – no scroll */
        @media (max-width: 520px) {
            .card-inner {
                padding: 1.5rem;
            }
            .auth-heading h2 {
                font-size: 1.6rem;
            }
            .logo {
                font-size: 1.6rem;
            }
            .back-button {
                top: 1rem;
                left: 1rem;
                padding: 0.45rem 1rem;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- BACK BUTTON - text style, outside container, upper left -->
    <a href="/" class="back-button">
        <i class="fas fa-arrow-left"></i> BACK
    </a>

    <div class="login-container">
        <div class="login-card">
            <div class="card-accent"></div>
            <div class="card-inner">
                <div class="brand">
                    <div class="logo">NU <span>CLICKS</span> LMS</div>
                </div>

                <div class="auth-heading">
                    <h2>Welcome back</h2>
                    <p>Sign in to continue &nbsp;•&nbsp; 
                        <a href="/register">create an account <i class="fas fa-arrow-right" style="font-size: 0.7rem;"></i></a>
                    </p>
                </div>

                @if($errors->any())
                <div class="error-alert" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif

                <form method="POST" action="/login">
                    @csrf
                    
                    <!-- Email field -->
                    <div class="form-group">
                        <label class="form-label" for="email">Email address</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" autocomplete="email" required 
                                   placeholder="your@email.com" value="{{ old('email') }}">
                        </div>
                    </div>

                    <!-- Password field with show/hide eye toggle -->
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="password-wrapper">
                            <i class="fas fa-lock" style="position: absolute; left: 1rem; color: #5B6E8C; z-index: 1; pointer-events: none;"></i>
                            <input type="password" id="password" name="password" autocomplete="current-password" required 
                                   placeholder="••••••••">
                            <button type="button" class="toggle-password" id="togglePasswordBtn" aria-label="Show/Hide Password">
                                <i class="fas fa-eye-slash" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-actions">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" name="remember" id="remember">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="forgot-link">Forgot password? <i class="fas fa-question-circle" style="font-size: 0.7rem;"></i></a>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="fas fa-arrow-right-to-bracket"></i> Sign in
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Simple JavaScript for password toggle -->
    <script>
        (function() {
            const toggleBtn = document.getElementById('togglePasswordBtn');
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (toggleBtn && passwordField && eyeIcon) {
                toggleBtn.addEventListener('click', function() {
                    // toggle password type
                    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordField.setAttribute('type', type);
                    // toggle eye icon
                    if (type === 'text') {
                        eyeIcon.classList.remove('fa-eye-slash');
                        eyeIcon.classList.add('fa-eye');
                    } else {
                        eyeIcon.classList.remove('fa-eye');
                        eyeIcon.classList.add('fa-eye-slash');
                    }
                });
            }
        })();
    </script>
</body>
</html>