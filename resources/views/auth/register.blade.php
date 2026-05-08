<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register – NU Horizon LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600&display=swap" rel="stylesheet">
    <style>
        /* ══ TOKENS (mirrored from login) ══ */
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
            padding: 2rem 1rem;
            overflow-x: hidden;
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
        .register-card {
            position: relative;
            z-index: 1;
            width: min(560px, 96vw);
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

        /* ══ GOLD TOP BAR ══ */
        .gold-bar {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), var(--gold-mid), transparent);
            background-size: 200% 100%;
            animation: shimmer 4s linear infinite;
            z-index: 2;
        }

        @keyframes shimmer {
            0%   { background-position: -200% center; }
            100% { background-position:  200% center; }
        }

        /* ══ FORM PANEL ══ */
        .panel-right {
            background: var(--bg);
            padding: 3rem 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            position: relative;
        }

        .panel-right::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 50% at 100% 0%, rgba(255,215,15,0.06) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 0% 100%, rgba(10,31,68,0.04) 0%, transparent 50%);
            pointer-events: none;
        }

        /* ══ FORM HEADER ══ */
        .form-header {
            margin-bottom: 1.5rem;
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
        .form-subtitle a {
            color: var(--navy-mid);
            font-weight: 600;
            text-decoration: none;
            border-bottom: 1px solid var(--gold);
            padding-bottom: 1px;
            transition: color var(--t);
        }
        .form-subtitle a:hover { color: var(--gold-d); }

        .form-rule {
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, var(--bdr) 0%, transparent 100%);
            margin: 1.25rem 0;
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
        .alert-icon { font-size: .9rem; margin-top: .05rem; flex-shrink: 0; }

        /* ══ FORM ELEMENTS ══ */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .9rem;
        }

        .form-group {
            margin-bottom: 1rem;
            position: relative;
        }

        .form-label {
            display: block;
            font-size: .72rem;
            font-weight: 700;
            color: var(--txt-2);
            margin-bottom: .45rem;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .input-wrap { position: relative; }

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

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
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
            -webkit-appearance: none;
            appearance: none;
        }

        select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23637089' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right .9rem center;
            background-color: var(--white);
            padding-right: 2.5rem;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        select:focus {
            border-color: var(--gold-d);
            box-shadow: 0 0 0 3px rgba(196,154,0,0.14), 0 1px 4px rgba(10,31,68,0.06);
        }

        .input-wrap:focus-within .input-icon { color: var(--gold-d); }

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

        /* Section separator */
        .section-sep {
            display: flex;
            align-items: center;
            gap: .6rem;
            margin: .25rem 0 1rem;
        }
        .section-sep-line {
            flex: 1;
            height: 1px;
            background: var(--bdr);
        }
        .section-sep-label {
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--txt-3);
            white-space: nowrap;
        }

        /* Submit button */
        .btn-register {
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
            margin-top: .25rem;
        }

        .btn-register::before {
            content: "";
            position: absolute;
            top: 0; left: -100%;
            width: 60%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,215,15,0.18), transparent);
            transition: left .55s var(--ease);
        }
        .btn-register:hover::before { left: 160%; }
        .btn-register:hover {
            background: var(--navy-mid);
            transform: translateY(-1px);
            box-shadow: 0 8px 28px rgba(10,31,68,0.40);
        }
        .btn-register:active { transform: translateY(0); }

        /* Footer */
        .form-footer {
            margin-top: 1.25rem;
            padding-top: 1rem;
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
        @media (max-width: 480px) {
            .panel-right { padding: 2.5rem 1.75rem; }
            .form-row { grid-template-columns: 1fr; }
        }

        /* Stagger-in animations */
        .fade-in { animation: fadeUp .5s var(--ease) both; }
        .fd1 { animation-delay: .12s; }
        .fd2 { animation-delay: .20s; }
        .fd3 { animation-delay: .28s; }
        .fd4 { animation-delay: .34s; }
        .fd5 { animation-delay: .40s; }
        .fd6 { animation-delay: .46s; }
        .fd7 { animation-delay: .52s; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="bg-layer"></div>

<a href="/login" class="back-link">
    <i>←</i> Back to Login
</a>

<div class="register-card">
    <div class="gold-bar"></div>

    <div class="panel-right">

        <div class="form-header fade-in fd1">
            <div class="form-logo">NU Horizon <em>LMS</em></div>
            <div class="form-tagline">Intelligent Learning Platform</div>
            <p class="form-subtitle">
                Create your account &nbsp;·&nbsp;
                Already have one? <a href="/login">Sign in</a>
            </p>
            <div class="form-rule"></div>
        </div>

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

        <form method="POST" action="/register">
            @csrf

            {{-- Personal Info --}}
            <div class="section-sep fade-in fd2">
                <div class="section-sep-line"></div>
                <span class="section-sep-label">Personal Info</span>
                <div class="section-sep-line"></div>
            </div>

            <div class="form-group fade-in fd2">
                <label class="form-label" for="name">Full Name</label>
                <div class="input-wrap">
                    <span class="input-icon">👤</span>
                    <input type="text" id="name" name="name"
                           value="{{ old('name') }}" placeholder="Juan Dela Cruz"
                           required autofocus>
                </div>
            </div>

            <div class="form-group fade-in fd2">
                <label class="form-label" for="email">Email Address</label>
                <div class="input-wrap">
                    <span class="input-icon">✉</span>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}" placeholder="yourname@national-u.edu.ph"
                           required>
                </div>
            </div>

            {{-- Account Details --}}
            <div class="section-sep fade-in fd3">
                <div class="section-sep-line"></div>
                <span class="section-sep-label">Account Details</span>
                <div class="section-sep-line"></div>
            </div>

            <div class="form-row fade-in fd3">
                <div class="form-group">
                    <label class="form-label" for="role">Role</label>
                    <div class="input-wrap">
                        <span class="input-icon">💼</span>
                        <select name="role" id="role" required>
                            <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                            <option value="faculty" {{ old('role') == 'faculty' ? 'selected' : '' }}>Faculty</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="department">Department</label>
                    <div class="input-wrap">
                        <span class="input-icon">🏫</span>
                        <input type="text" id="department" name="department"
                               value="{{ old('department') }}" placeholder="e.g. Computer Science">
                    </div>
                </div>
            </div>

            {{-- Student Fields --}}
            <div id="studentFields">
                <div class="form-row fade-in fd4">
                    <div class="form-group">
                        <label class="form-label" for="student_id">Student ID</label>
                        <div class="input-wrap">
                            <span class="input-icon">🪪</span>
                            <input type="text" id="student_id" name="student_id"
                                   value="{{ old('student_id') }}" placeholder="2024-12345">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="year_level">Year Level</label>
                        <div class="input-wrap">
                            <span class="input-icon">📅</span>
                            <select name="year_level" id="year_level">
                                <option value="1" {{ old('year_level') == '1' ? 'selected' : '' }}>1st Year</option>
                                <option value="2" {{ old('year_level') == '2' ? 'selected' : '' }}>2nd Year</option>
                                <option value="3" {{ old('year_level') == '3' ? 'selected' : '' }}>3rd Year</option>
                                <option value="4" {{ old('year_level') == '4' ? 'selected' : '' }}>4th Year</option>
                                <option value="5" {{ old('year_level') == '5' ? 'selected' : '' }}>5th Year</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Faculty Fields --}}
            <div id="facultyFields" style="display:none;">
                <div class="form-group fade-in fd4">
                    <label class="form-label" for="faculty_id">Faculty ID</label>
                    <div class="input-wrap">
                        <span class="input-icon">🪪</span>
                        <input type="text" id="faculty_id" name="faculty_id"
                               value="{{ old('faculty_id') }}" placeholder="FAC-2024-001">
                    </div>
                </div>
            </div>

            {{-- Security --}}
            <div class="section-sep fade-in fd5">
                <div class="section-sep-line"></div>
                <span class="section-sep-label">Security</span>
                <div class="section-sep-line"></div>
            </div>

            <div class="form-group fade-in fd5">
                <label class="form-label" for="password">Password</label>
                <div class="input-wrap">
                    <span class="input-icon">🔒</span>
                    <input type="password" id="password" name="password"
                           placeholder="Create a strong password" required>
                    <button type="button" class="pw-toggle"
                            onclick="togglePw('password','pw-btn-1')" id="pw-btn-1"
                            title="Show/hide password">👁</button>
                </div>
            </div>

            <div class="form-group fade-in fd6">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <div class="input-wrap">
                    <span class="input-icon">🔒</span>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           placeholder="Repeat your password" required>
                    <button type="button" class="pw-toggle"
                            onclick="togglePw('password_confirmation','pw-btn-2')" id="pw-btn-2"
                            title="Show/hide password">👁</button>
                </div>
            </div>

            <button type="submit" class="btn-register fade-in fd7">
                <span>→</span>
                Create Account
            </button>
        </form>

        <div class="form-footer fade-in fd7">
            <p>Having trouble? Contact <a href="mailto:support@national-u.edu.ph">IT Support</a></p>
            <p style="margin-top:.5rem;">NU Horizon LMS &copy; {{ date('Y') }} · National University</p>
        </div>

    </div>
</div>

<script>
    function togglePw(inputId, btnId) {
        const input = document.getElementById(inputId);
        const btn   = document.getElementById(btnId);
        if (input.type === 'password') {
            input.type = 'text';
            btn.textContent = '🙈';
        } else {
            input.type = 'password';
            btn.textContent = '👁';
        }
    }

    const roleSelect   = document.getElementById('role');
    const studentDiv   = document.getElementById('studentFields');
    const facultyDiv   = document.getElementById('facultyFields');
    const studentInput = document.getElementById('student_id');
    const facultyInput = document.getElementById('faculty_id');

    function toggleFields() {
        const isStudent = roleSelect.value === 'student';
        studentDiv.style.display = isStudent ? 'block' : 'none';
        facultyDiv.style.display = isStudent ? 'none'  : 'block';
        if (studentInput) { studentInput.required = isStudent;  if (!isStudent) studentInput.value = ''; }
        if (facultyInput) { facultyInput.required = !isStudent; if (isStudent)  facultyInput.value = ''; }
    }

    if (roleSelect) {
        roleSelect.addEventListener('change', toggleFields);
        const oldRole = "{{ old('role', 'student') }}";
        if (oldRole === 'student' || oldRole === 'faculty') roleSelect.value = oldRole;
        toggleFields();
    }
</script>
</body>
</html>