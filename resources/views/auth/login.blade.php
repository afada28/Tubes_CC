<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Admin Panel</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #d9fffb;
            --secondary-color: #ebf2d5;
            --accent-color: #95ddda;
            --accent-hover: #7ec5c2;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Animated background shapes */
        body::before,
        body::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            opacity: 0.15;
            animation: float 20s infinite ease-in-out;
        }

        body::before {
            width: 400px;
            height: 400px;
            background: var(--accent-color);
            top: -200px;
            right: -200px;
            animation-delay: 0s;
        }

        body::after {
            width: 300px;
            height: 300px;
            background: var(--secondary-color);
            bottom: -150px;
            left: -150px;
            animation-delay: 10s;
        }

        @keyframes float {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            50% {
                transform: translate(30px, -30px) scale(1.1);
            }
        }

        .login-container {
            max-width: 450px;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(149, 221, 218, 0.25);
            overflow: hidden;
            animation: slideUp 0.5s ease;
            border: 1px solid rgba(149, 221, 218, 0.2);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            padding: 50px 30px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .login-header::after {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            bottom: -75px;
            left: -75px;
        }

        .login-header .icon {
            width: 90px;
            height: 90px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            box-shadow: 0 10px 30px rgba(149, 221, 218, 0.3);
            position: relative;
            z-index: 1;
        }

        .login-header .icon i {
            font-size: 40px;
            background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-header h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #2d3748;
            position: relative;
            z-index: 1;
        }

        .login-header p {
            font-size: 14px;
            color: #4a5568;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .login-body {
            padding: 40px 30px;
            background: white;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 10px;
            display: block;
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--accent-color);
            font-size: 18px;
            z-index: 2;
        }

        .form-control {
            padding: 14px 16px 14px 48px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8fafc;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 4px rgba(149, 221, 218, 0.1);
            background: white;
            outline: none;
        }

        .form-control::placeholder {
            color: #a0aec0;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
            padding-right: 48px;
        }

        .invalid-feedback {
            font-size: 13px;
            margin-top: 6px;
            display: block;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #a0aec0;
            z-index: 10;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--accent-color);
        }

        .form-check {
            padding-left: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            cursor: pointer;
            border: 2px solid #cbd5e0;
            border-radius: 6px;
            margin: 0;
        }

        .form-check-input:checked {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 4px rgba(149, 221, 218, 0.1);
        }

        .form-check-label {
            font-size: 14px;
            color: #4a5568;
            cursor: pointer;
            user-select: none;
            margin: 0;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-hover) 100%);
            border: none;
            border-radius: 12px;
            color: #2d3748;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            font-family: 'Inter', sans-serif;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(149, 221, 218, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login.loading {
            color: transparent;
        }

        .btn-login.loading::after {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 3px solid rgba(45, 55, 72, 0.3);
            border-top-color: #2d3748;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .btn-google {
            width: 100%;
            padding: 14px 20px;
            background: white;
            color: #2d3748;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-google:hover {
            background: #f8fafc;
            border-color: #cbd5e0;
            color: #2d3748;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .btn-google i {
            color: #db4437;
        }

        .forgot-password {
            text-align: center;
            margin-top: 20px;
        }

        .forgot-password a {
            color: var(--accent-hover);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .forgot-password a:hover {
            color: var(--accent-color);
            transform: translateX(3px);
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-header h2 {
                font-size: 24px;
            }

            .login-body {
                padding: 30px 20px;
            }

            .login-header {
                padding: 40px 20px 30px;
            }

            .login-header .icon {
                width: 75px;
                height: 75px;
            }

            .login-header .icon i {
                font-size: 32px;
            }
        }

        /* Input animation */
        .input-group-custom {
            transition: transform 0.2s ease;
        }

        .form-control:focus ~ i {
            color: var(--accent-hover);
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h2>Graha Alfa Amertha Indonesia</h2>
                <p>Please login to continue</p>
            </div>

            <div class="login-body">
                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group-custom">
                            <i class="fas fa-envelope"></i>
                            <input id="email"
                                   type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autocomplete="email"
                                   autofocus
                                   placeholder="Enter your email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group-custom">
                            <i class="fas fa-lock"></i>
                            <input id="password"
                                   type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password"
                                   required
                                   autocomplete="current-password"
                                   placeholder="Enter your password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <!-- Submit Button -->
                    <button type="submit" class="btn-login" id="loginBtn">
                        <i class="fas fa-sign-in-alt me-2"></i> Login to Dashboard
                    </button>

                    <!-- Divider -->
                    <div class="text-center my-3">
                        <span style="color: #a0aec0; font-size: 14px;">atau</span>
                    </div>

                    <!-- Google Login Button -->
                    <a href="{{ route('auth.google') }}" class="btn-google">
                        <i class="fab fa-google me-2"></i> Login dengan Google
                    </a>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Add loading animation on form submit
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('loginBtn');
            btn.classList.add('loading');
            btn.disabled = true;
        });

        // Add focus animation to inputs
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.01)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>

</html>