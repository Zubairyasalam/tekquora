<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - TekQuora</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-dark: #0f0f11;
            --bg-form: rgba(255, 255, 255, 0.03);
            --form-border: rgba(255, 255, 255, 0.08);
            --text-main: #f3f4f6;
            --text-muted: #9ca3af;
            --accent-purple: #8b5cf6;
            --accent-purple-hover: #7c3aed;
            --lamp-color: #1a1a1a;
            --light-color: rgba(253, 224, 71, 0.15); /* Yellow light */
            --light-glow: rgba(253, 224, 71, 0.25);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: background-color 0.5s ease;
        }

        body.is-on {
            background-color: #171612; /* slightly warmer dark background when on */
        }

        .login-wrapper {
            display: flex;
            width: 100%;
            max-width: 1100px;
            height: 100vh;
            position: relative;
        }

        /* --- Lamp Section --- */
        .lamp-section {
            flex: 1;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }

        .lamp-container {
            position: relative;
            height: 400px;
            width: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transform: translateY(-10vh);
        }

        /* Lamp head/shade */
        .lamp-head {
            width: 180px;
            height: 14px;
            background-color: var(--lamp-color);
            border-radius: 12px;
            position: absolute;
            top: 20px;
            z-index: 5;
            box-shadow: 0 4px 10px rgba(0,0,0,0.8);
        }

        /* Lamp stand */
        .lamp-stand {
            width: 8px;
            height: 360px;
            background-color: var(--lamp-color);
            position: absolute;
            top: 34px;
            z-index: 4;
        }

        /* Lamp base */
        .lamp-base {
            width: 140px;
            height: 14px;
            background-color: var(--lamp-color);
            border-radius: 8px;
            position: absolute;
            bottom: 0;
            z-index: 5;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.5);
        }

        /* Pull Cord */
        .lamp-cord {
            position: absolute;
            top: 34px;
            right: 45px; 
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            z-index: 6;
            padding-bottom: 30px; /* larger clickable area */
        }

        .cord-line {
            width: 2px;
            height: 120px;
            background-color: #222;
            transition: height 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .cord-handle {
            width: 14px;
            height: 28px;
            background-color: #fbbf24;
            border-radius: 14px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.6);
            transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Cord pulling animation */
        .lamp-cord:active .cord-line {
            height: 140px;
        }
        .lamp-cord:active .cord-handle {
            transform: translateY(20px);
        }

        /* The Light Beam */
        .light-beam {
            position: absolute;
            top: 34px;
            left: -200px; /* Center it based on width */
            width: 700px;
            height: 120vh;
            background: linear-gradient(180deg, var(--light-glow) 0%, rgba(253, 224, 71, 0) 80%);
            clip-path: polygon(35% 0, 65% 0, 100% 100%, 0 100%);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.5s ease;
            z-index: 3;
            filter: blur(8px);
        }

        /* Light source glow (bulb) */
        .light-bulb {
            position: absolute;
            top: 34px;
            width: 80px;
            height: 12px;
            background-color: #fff;
            border-radius: 0 0 40px 40px;
            opacity: 0;
            transition: opacity 0.3s ease;
            box-shadow: 0 5px 30px 15px rgba(253, 224, 71, 0.8);
            z-index: 4;
        }

        /* --- Form Section --- */
        .form-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 20;
        }

        .login-card {
            background: var(--bg-form);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--form-border);
            border-radius: 24px;
            padding: 1.25rem 2rem 2.5rem;
            width: 100%;
            max-width: 380px;
            opacity: 0;
            transform: translateY(40px);
            pointer-events: none;
            transition: opacity 0.6s ease 0.2s, transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) 0.2s;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .login-header {
            text-align: center;
            margin-bottom: 1rem;
        }

        .login-header h2 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            letter-spacing: -0.025em;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 0.4rem;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            background: rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 1rem 1.2rem;
            color: var(--text-main);
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--accent-purple);
            background: rgba(0, 0, 0, 0.4);
            box-shadow: 0 0 0 2px rgba(139, 92, 246, 0.2);
        }

        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-wrapper .form-input {
            padding-right: 2.8rem;
        }

        .toggle-password {
            position: absolute;
            right: 0.8rem;
            background: none;
            border: none;
            color: #475569;
            cursor: pointer;
            padding: 0.4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s ease;
            z-index: 5;
        }

        .toggle-password:hover {
            color: #0f172a;
        }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1.1rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1.5rem;
            box-shadow: 0 4px 14px rgba(139, 92, 246, 0.3);
            letter-spacing: 0.025em;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
        }

        .forgot-pass {
            display: block;
            text-align: right;
            color: #a78bfa;
            font-size: 0.85rem;
            text-decoration: none;
            margin-top: 0.6rem;
            transition: color 0.3s ease;
        }

        .forgot-pass:hover {
            color: #c4b5fd;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .divider::before { margin-right: 1em; }
        .divider::after { margin-left: 1em; }

        .btn-google {
            width: 100%;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-main);
            padding: 1rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-google:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
        }

        /* --- ACTIVE STATE --- */
        body.is-on .light-beam {
            opacity: 1;
        }
        body.is-on .light-bulb {
            opacity: 1;
        }
        body.is-on .lamp-side-logo {
            opacity: 1;
        }
        body.is-on .login-card {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        /* Error alert */
        .login-error-alert {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }
        
        .back-link {
            position: absolute;
            top: 2rem;
            left: 2rem;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
            z-index: 50;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .back-link:hover {
            color: white;
        }

        .lamp-side-logo {
            position: absolute;
            bottom: 12vh; /* Position it in the circled area below the lamp */
            left: 50%;
            transform: translateX(-50%);
            max-width: 280px;
            max-height: 80px;
            object-fit: contain;
            z-index: 20;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .lamp-side-logo {
                display: none; /* Hide on mobile to save space, or adjust positioning */
            }
            .login-wrapper {
                flex-direction: column;
            }
            .lamp-section {
                height: 35vh;
                flex: none;
                transform: scale(0.8);
            }
            .form-section {
                height: 65vh;
                align-items: flex-start;
                padding-top: 1rem;
            }
            .login-card {
                transform: translateY(30px);
                margin: 0 1.5rem;
                padding: 2rem 1.5rem;
            }
            body.is-on .login-card {
                transform: translateY(0);
            }
            .light-beam {
                top: 34px;
                height: 600px;
                clip-path: polygon(25% 0, 75% 0, 100% 100%, 0 100%);
            }
        }
    </style>
</head>
<body>

    <div class="login-wrapper">
        <!-- Lamp Side -->
        <div class="lamp-section">
            <div class="lamp-container">
                <div class="light-beam"></div>
                <div class="light-bulb"></div>
                
                <div class="lamp-head"></div>
                <div class="lamp-stand"></div>
                <div class="lamp-base"></div>
                
                <!-- Pull Cord -->
                <div class="lamp-cord" id="lampToggle" title="Click to toggle light">
                    <div class="cord-line"></div>
                    <div class="cord-handle"></div>
                </div>
            </div>
            
            <!-- Logo below lamp -->
            <img src="{{ asset('assets/Tekquora_website_logo-resized.png') }}" alt="TekQuora" class="lamp-side-logo">
        </div>

        <!-- Form Side -->
        <div class="form-section">
            <div class="login-card">
                <div class="login-header">
                    <img src="{{ asset('assets/Tekquora_logo-removebg-preview.png') }}" alt="TekQuora" style="height: 110px; margin-bottom: 0.2rem; border-radius: 8px; object-fit: contain; transform: scale(1.15);">
                    <h2>Welcome Back</h2>
                </div>

                @if($errors->any())
                    <div class="login-error-alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="{{ \App\Models\Setting::get('admin_login_email', 'admin@tekquora.com') }}" required value="{{ old('email') }}">
                    </div>

                    <div class="form-group" style="margin-bottom: 0.5rem;">
                        <label for="password">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required>
                            <button type="button" class="toggle-password" id="togglePassword" aria-label="Toggle password visibility">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-login">SIGN IN</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const lampToggle = document.getElementById('lampToggle');
            const body = document.body;
            const emailInput = document.getElementById('email');
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (togglePassword && passwordInput && eyeIcon) {
                togglePassword.addEventListener('click', () => {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    
                    if (isPassword) {
                        // Eye Off SVG Icon
                        eyeIcon.innerHTML = `
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                            <line x1="1" y1="1" x2="23" y2="23"></line>
                        `;
                    } else {
                        // Eye SVG Icon
                        eyeIcon.innerHTML = `
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        `;
                    }
                });
            }

            lampToggle.addEventListener('click', () => {
                const isOn = body.classList.toggle('is-on');
                
                // Focus the email input field after animation when turned on
                if (isOn) {
                    setTimeout(() => {
                        emailInput.focus();
                    }, 600); // Wait for the transition to finish (0.6s)
                }
            });
        });
    </script>
</body>
</html>
