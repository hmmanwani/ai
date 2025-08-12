<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>IMS | New Password</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo.png') }}" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-hover: #4f46e5;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --error-color: #ef4444;
            --background-color: #f8fafc;
            --card-background: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .password-container {
            width: 100%;
            max-width: 420px;
            background: var(--card-background);
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            animation: slideUp 0.6s ease-out;
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

        .password-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .logo-container {
            margin-bottom: 20px;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            backdrop-filter: blur(10px);
        }

        .logo img {
            width: 35px;
            height: 35px;
            filter: brightness(0) invert(1);
        }

        .welcome-text h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .welcome-text p {
            font-size: 14px;
            opacity: 0.9;
            font-weight: 400;
        }

        .password-form {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .input-group {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 15px;
            font-weight: 400;
            color: var(--text-primary);
            background: var(--card-background);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .form-control::placeholder {
            color: var(--text-secondary);
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .form-control:focus + .input-icon {
            color: var(--primary-color);
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .btn-change {
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-change:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-change:active {
            transform: translateY(0);
        }

        .btn-change:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-change .spinner {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .back-to-login {
            text-align: center;
            margin-top: 20px;
        }

        .back-to-login a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .back-to-login a:hover {
            color: var(--primary-hover);
        }

        .error-message {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: var(--error-color);
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .success-message {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: var(--success-color);
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-control.is-invalid {
            border-color: var(--error-color);
        }

        .form-control.is-valid {
            border-color: var(--success-color);
        }

        .invalid-feedback {
            display: block;
            color: var(--error-color);
            font-size: 12px;
            margin-top: 6px;
        }

        .password-strength {
            margin-top: 8px;
            font-size: 12px;
        }

        .strength-bar {
            height: 4px;
            background: var(--border-color);
            border-radius: 2px;
            overflow: hidden;
            margin-top: 4px;
        }

        .strength-fill {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { background: var(--error-color); width: 25%; }
        .strength-fair { background: #f59e0b; width: 50%; }
        .strength-good { background: #10b981; width: 75%; }
        .strength-strong { background: var(--success-color); width: 100%; }

        /* Floating particles background */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Responsive design */
        @media (max-width: 480px) {
            .password-container {
                margin: 10px;
                border-radius: 16px;
            }
            
            .password-header {
                padding: 30px 20px;
            }
            
            .password-form {
                padding: 30px 20px;
            }
            
            .welcome-text h1 {
                font-size: 20px;
            }
        }

        /* Loading state */
        .loading .btn-change .spinner {
            display: inline-block;
        }

        .loading .btn-change span {
            display: none;
        }
    </style>
</head>

<body>
    <!-- Floating particles -->
    <div class="particles">
        <div class="particle" style="left: 10%; top: 20%; width: 4px; height: 4px; animation-delay: 0s;"></div>
        <div class="particle" style="left: 20%; top: 60%; width: 6px; height: 6px; animation-delay: 1s;"></div>
        <div class="particle" style="left: 80%; top: 30%; width: 3px; height: 3px; animation-delay: 2s;"></div>
        <div class="particle" style="left: 90%; top: 70%; width: 5px; height: 5px; animation-delay: 3s;"></div>
        <div class="particle" style="left: 50%; top: 10%; width: 4px; height: 4px; animation-delay: 4s;"></div>
        <div class="particle" style="left: 30%; top: 80%; width: 6px; height: 6px; animation-delay: 5s;"></div>
    </div>

    <div class="password-container">
        <div class="password-header">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('assets/images/logo/logo.png') }}" alt="IMS Logo">
                </div>
            </div>
            <div class="welcome-text">
                <h1>Set New Password</h1>
                <p>Create a strong password for your account</p>
            </div>
        </div>

        <div class="password-form">
            @if(session('notification'))
                @if(session('notification')['type'] == 'danger')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('notification')['message'] }}
                    </div>
                @else
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i>
                        {{ session('notification')['message'] }}
                    </div>
                @endif
            @endif

            <form method="POST" action="{{ URL('/submit-new-password') }}" id="passwordForm">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <div class="input-group">
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               placeholder="Enter your new password"
                               required>
                        <i class="fas fa-lock input-icon"></i>
                        <button type="button" class="password-toggle" id="togglePassword1">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="password-strength">
                        <div class="strength-bar">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                        <span id="strengthText">Password strength</span>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" 
                               name="confirm_password" 
                               id="confirm_password" 
                               class="form-control @error('confirm_password') is-invalid @enderror" 
                               placeholder="Confirm your new password"
                               required>
                        <i class="fas fa-lock input-icon"></i>
                        <button type="button" class="password-toggle" id="togglePassword2">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('confirm_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-change" id="changeBtn">
                    <span class="spinner"></span>
                    <span>Change Password</span>
                </button>
            </form>

            <div class="back-to-login">
                <a href="{{ URL('/') }}">
                    <i class="fas fa-arrow-left me-2"></i>
                    Back to Login
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- jQuery Validation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            // Password toggle functionality
            $('#togglePassword1').click(function() {
                const passwordField = $('#password');
                const icon = $(this).find('i');
                
                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            $('#togglePassword2').click(function() {
                const passwordField = $('#confirm_password');
                const icon = $(this).find('i');
                
                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            // Password strength checker
            function checkPasswordStrength(password) {
                let strength = 0;
                let feedback = [];

                if (password.length >= 8) strength += 1;
                if (password.match(/[a-z]/)) strength += 1;
                if (password.match(/[A-Z]/)) strength += 1;
                if (password.match(/[0-9]/)) strength += 1;
                if (password.match(/[^a-zA-Z0-9]/)) strength += 1;

                const strengthFill = $('#strengthFill');
                const strengthText = $('#strengthText');

                strengthFill.removeClass('strength-weak strength-fair strength-good strength-strong');

                if (strength <= 1) {
                    strengthFill.addClass('strength-weak');
                    strengthText.text('Weak password');
                } else if (strength <= 2) {
                    strengthFill.addClass('strength-fair');
                    strengthText.text('Fair password');
                } else if (strength <= 3) {
                    strengthFill.addClass('strength-good');
                    strengthText.text('Good password');
                } else {
                    strengthFill.addClass('strength-strong');
                    strengthText.text('Strong password');
                }
            }

            $('#password').on('input', function() {
                const password = $(this).val();
                if (password.length > 0) {
                    checkPasswordStrength(password);
                } else {
                    $('#strengthFill').removeClass('strength-weak strength-fair strength-good strength-strong');
                    $('#strengthText').text('Password strength');
                }
            });

            // Form validation
            $('#passwordForm').validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    password: {
                        required: true,
                        minlength: 8
                    },
                    confirm_password: {
                        required: true,
                        equalTo: '#password'
                    }
                },
                messages: {
                    password: {
                        required: 'Please enter a new password',
                        minlength: 'Password must be at least 8 characters long'
                    },
                    confirm_password: {
                        required: 'Please confirm your password',
                        equalTo: 'Passwords do not match'
                    }
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    const btn = $('#changeBtn');
                    btn.prop('disabled', true).addClass('loading');
                    
                    // Simulate loading state
                    setTimeout(() => {
                        form.submit();
                    }, 500);
                }
            });

            // Auto-focus on password field
            $('#password').focus();

            // Enter key submission
            $(document).keypress(function(e) {
                if (e.which === 13) {
                    $('#passwordForm').submit();
                }
            });

            // Add floating animation to particles
            function createParticle() {
                const particle = $('<div class="particle"></div>');
                const size = Math.random() * 4 + 2;
                const left = Math.random() * 100;
                const animationDelay = Math.random() * 6;
                
                particle.css({
                    left: left + '%',
                    top: '100%',
                    width: size + 'px',
                    height: size + 'px',
                    animationDelay: animationDelay + 's'
                });
                
                $('.particles').append(particle);
                
                setTimeout(() => {
                    particle.remove();
                }, 6000);
            }

            // Create particles periodically
            setInterval(createParticle, 2000);
        });
    </script>
</body>
</html>
