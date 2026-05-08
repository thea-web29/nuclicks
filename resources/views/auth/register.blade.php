<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Register - NU Clicks LMS</title>
    <!-- Google Fonts + Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* ---------- RESET & FULL RESPONSIVE (NO BREAKS) ---------- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            overflow: auto;  /* scrolling allowed but scrollbar hidden */
        }

        /* hide scrollbar everywhere but keep functionality */
        body::-webkit-scrollbar {
            width: 0;
            background: transparent;
        }
        body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0A1F44 0%, #1A3A6E 50%, #0E2A55 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            min-height: 100vh;
            padding: 1rem;
        }

        /* decorative circles - responsive scaling */
        body::before {
            content: '';
            position: absolute;
            top: -20%;
            right: -10%;
            width: min(380px, 50vw);
            height: min(380px, 50vw);
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
            width: min(400px, 55vw);
            height: min(400px, 55vw);
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        /* BACK BUTTON - fixed, always accessible */
        .back-button {
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 100;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-weight: 600;
            font-size: 0.8rem;
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
            gap: 0.4rem;
            white-space: nowrap;
        }

        .back-button i {
            font-size: 0.75rem;
            color: #FFD70F;
        }

        .back-button:hover {
            background: #FFD70F;
            color: #0A1F44;
            transform: translateX(-3px);
        }

        .back-button:hover i {
            color: #0A1F44;
        }

        /* registration container - fully responsive, centered, scrollable inner */
        .register-container {
            width: 100%;
            max-width: 550px;
            margin: 0 auto;
            padding: 0.5rem;
            animation: fadeSlideUp 0.4s ease;
            z-index: 2;
            position: relative;
            max-height: 90vh;
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .register-container::-webkit-scrollbar {
            width: 0;
            background: transparent;
        }

        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* main card - flexible */
        .register-card {
            background: #FFFFFF;
            border-radius: 1.5rem;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            border: 1px solid rgba(255, 215, 15, 0.3);
        }

        .card-accent {
            height: 4px;
            background: linear-gradient(90deg, #FFD70F, #FFE484, #FFD70F);
        }

        .card-inner {
            padding: 1.2rem 1.5rem 1.8rem;
        }

        /* brand */
        .brand {
            text-align: center;
            margin-bottom: 0.8rem;
        }

        .logo {
            font-size: clamp(1.4rem, 6vw, 1.8rem);
            font-weight: 800;
            letter-spacing: -0.3px;
            background: linear-gradient(135deg, #0A1F44 20%, #1E3A6B 80%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .logo span {
            color: #FFD70F;
            background: none;
        }

        /* heading */
        .auth-heading {
            text-align: center;
            margin-bottom: 1rem;
        }

        .auth-heading h2 {
            font-size: clamp(1.3rem, 5vw, 1.6rem);
            font-weight: 700;
            color: #0A1F44;
        }

        .auth-heading p {
            font-size: 0.75rem;
            color: #5B6E8C;
            margin-top: 0.2rem;
        }

        .auth-heading a {
            color: #FFD70F;
            font-weight: 600;
            text-decoration: none;
        }

        /* error alert */
        .error-alert {
            background-color: #FFF5F5;
            border-left: 4px solid #E53E3E;
            border-radius: 0.8rem;
            padding: 0.5rem 0.8rem;
            margin-bottom: 1rem;
            font-size: 0.7rem;
            color: #b91c1c;
        }
        .error-alert ul {
            margin-left: 1rem;
        }

        /* form groups - responsive spacing */
        .form-group {
            margin-bottom: 0.9rem;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.7rem;
            margin-bottom: 0.25rem;
            color: #0A1F44;
            display: block;
        }

        .input-icon-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon-wrapper i {
            position: absolute;
            left: 0.8rem;
            color: #5B6E8C;
            font-size: 0.8rem;
            pointer-events: none;
        }

        .input-icon-wrapper input, 
        .input-icon-wrapper select {
            width: 100%;
            padding: 0.6rem 0.8rem 0.6rem 2rem;
            font-size: 0.8rem;
            font-family: 'Inter', sans-serif;
            border: 1.5px solid #E9EEF5;
            border-radius: 1rem;
            background: #FFFFFF;
            transition: all 0.2s;
            color: #1E2A44;
            font-weight: 500;
            outline: none;
        }

        .input-icon-wrapper select {
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="%235B6E8C" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>');
            background-repeat: no-repeat;
            background-position: right 0.8rem center;
            padding-right: 2rem;
        }

        .input-icon-wrapper input:focus,
        .input-icon-wrapper select:focus {
            border-color: #FFD70F;
            box-shadow: 0 0 0 3px rgba(255, 215, 15, 0.2);
        }

        /* password wrapper */
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-wrapper i.field-icon {
            position: absolute;
            left: 0.8rem;
            color: #5B6E8C;
            font-size: 0.8rem;
            pointer-events: none;
        }

        .password-wrapper input {
            width: 100%;
            padding: 0.6rem 2rem 0.6rem 2rem;
            font-size: 0.8rem;
            border: 1.5px solid #E9EEF5;
            border-radius: 1rem;
            background: #FFFFFF;
            outline: none;
        }

        .password-wrapper input:focus {
            border-color: #FFD70F;
            box-shadow: 0 0 0 3px rgba(255, 215, 15, 0.2);
        }

        .toggle-password {
            position: absolute;
            right: 0.8rem;
            cursor: pointer;
            color: #5B6E8C;
            font-size: 0.8rem;
            background: none;
            border: none;
            padding: 0;
        }

        .toggle-password:hover {
            color: #FFD70F;
        }

        /* register button */
        .btn-register {
            background: #0A1F44;
            color: white;
            font-weight: 700;
            font-size: 0.85rem;
            padding: 0.7rem 1rem;
            border: none;
            width: 100%;
            border-radius: 1.8rem;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .btn-register i {
            color: #FFD70F;
        }

        .btn-register:hover {
            background: #122d5c;
            transform: translateY(-2px);
        }

        /* extra small devices (<= 480px) */
        @media (max-width: 480px) {
            body {
                padding: 0.5rem;
            }
            .card-inner {
                padding: 1rem;
            }
            .back-button {
                top: 0.7rem;
                left: 0.7rem;
                padding: 0.4rem 0.8rem;
                font-size: 0.7rem;
            }
            .form-group {
                margin-bottom: 0.8rem;
            }
            .btn-register {
                padding: 0.6rem;
                font-size: 0.8rem;
            }
        }

        /* landscape mode on small heights */
        @media (max-height: 650px) {
            .register-container {
                max-height: 95vh;
            }
            .card-inner {
                padding: 0.8rem 1rem 1rem;
            }
            .form-group {
                margin-bottom: 0.6rem;
            }
            .brand {
                margin-bottom: 0.3rem;
            }
        }
    </style>
</head>
<body>
    <!-- BACK button outside container, fixed -->
    <a href="/login" class="back-button">
        <i class="fas fa-arrow-left"></i> BACK
    </a>

    <div class="register-container">
        <div class="register-card">
            <div class="card-accent"></div>
            <div class="card-inner">
                <div class="brand">
                    <div class="logo">NU <span>CLICKS</span> LMS</div>
                </div>

                <div class="auth-heading">
                    <h2>Create an account</h2>
                    <p>Already have an account? 
                        <a href="/login">sign in <i class="fas fa-arrow-right" style="font-size: 0.6rem;"></i></a>
                    </p>
                </div>

                @if($errors->any())
                <div class="error-alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="/register">
                    @csrf
                    
                    <!-- Full Name -->
                    <div class="form-group">
                        <label class="form-label" for="name">Full Name</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="text" id="name" name="name" required value="{{ old('name') }}" placeholder="Juan Dela Cruz">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label class="form-label" for="email">Email address</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" required value="{{ old('email') }}" placeholder="you@example.com">
                        </div>
                    </div>

                    <!-- Role -->
                    <div class="form-group">
                        <label class="form-label" for="role">Role</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-briefcase"></i>
                            <select name="role" id="role" required>
                                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                                <option value="faculty" {{ old('role') == 'faculty' ? 'selected' : '' }}>Faculty</option>
                            </select>
                        </div>
                    </div>

                    <!-- Dynamic: Student Fields -->
                    <div id="studentFields">
                        <div class="form-group">
                            <label class="form-label" for="student_id">Student ID</label>
                            <div class="input-icon-wrapper">
                                <i class="fas fa-id-card"></i>
                                <input type="text" id="student_id" name="student_id" value="{{ old('student_id') }}" placeholder="2024-12345">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="year_level">Year Level</label>
                            <div class="input-icon-wrapper">
                                <i class="fas fa-calendar-alt"></i>
                                <select name="year_level" id="year_level">
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
                                    <option value="5">5th Year</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic: Faculty Fields -->
                    <div id="facultyFields" style="display: none;">
                        <div class="form-group">
                            <label class="form-label" for="faculty_id">Faculty ID</label>
                            <div class="input-icon-wrapper">
                                <i class="fas fa-id-badge"></i>
                                <input type="text" id="faculty_id" name="faculty_id" value="{{ old('faculty_id') }}" placeholder="FAC-2024-001">
                            </div>
                        </div>
                    </div>

                    <!-- Department -->
                    <div class="form-group">
                        <label class="form-label" for="department">Department</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-building"></i>
                            <input type="text" id="department" name="department" value="{{ old('department') }}" placeholder="Computer Science">
                        </div>
                    </div>

                    <!-- Password with toggle -->
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="password-wrapper">
                            <i class="fas fa-lock field-icon"></i>
                            <input type="password" id="password" name="password" required placeholder="Create password">
                            <button type="button" class="toggle-password" data-target="password" aria-label="Show/Hide">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password with toggle -->
                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                        <div class="password-wrapper">
                            <i class="fas fa-lock field-icon"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirm password">
                            <button type="button" class="toggle-password" data-target="password_confirmation" aria-label="Show/Hide">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-register">
                        <i class="fas fa-user-plus"></i> Register
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle Student / Faculty fields
        const roleSelect = document.getElementById('role');
        const studentDiv = document.getElementById('studentFields');
        const facultyDiv = document.getElementById('facultyFields');
        const studentIdInput = document.getElementById('student_id');
        const facultyIdInput = document.getElementById('faculty_id');

        function toggleFields() {
            const isStudent = roleSelect.value === 'student';
            if (isStudent) {
                studentDiv.style.display = 'block';
                facultyDiv.style.display = 'none';
                if (studentIdInput) studentIdInput.required = true;
                if (facultyIdInput) facultyIdInput.required = false;
                if (facultyIdInput) facultyIdInput.value = '';
            } else {
                studentDiv.style.display = 'none';
                facultyDiv.style.display = 'block';
                if (studentIdInput) studentIdInput.required = false;
                if (facultyIdInput) facultyIdInput.required = true;
                if (studentIdInput) studentIdInput.value = '';
            }
        }

        if (roleSelect) {
            roleSelect.addEventListener('change', toggleFields);
            toggleFields();
        }

        // Password visibility toggle
        const toggleButtons = document.querySelectorAll('.toggle-password');
        toggleButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                const targetId = this.getAttribute('data-target');
                const inputField = document.getElementById(targetId);
                if (inputField) {
                    const type = inputField.type === 'password' ? 'text' : 'password';
                    inputField.type = type;
                    const icon = this.querySelector('i');
                    if (type === 'text') {
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    } else {
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    }
                }
            });
        });

        // Preserve old role after validation error
        const oldRole = "{{ old('role') }}";
        if (oldRole && roleSelect && (oldRole === 'student' || oldRole === 'faculty')) {
            roleSelect.value = oldRole;
            toggleFields();
        }
    </script>
</body>
</html>