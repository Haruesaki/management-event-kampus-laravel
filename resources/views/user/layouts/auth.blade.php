<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — Ethereal Stage</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg:          #0a0812;
            --bg-card:     rgba(22,18,36,0.92);
            --bg-input:    rgba(15,12,26,0.7);
            --border:      rgba(255,255,255,0.10);
            --border-focus:rgba(179,102,255,0.65);
            --accent:      #b366ff;
            --accent-2:    #e055f5;
            --accent-btn:  linear-gradient(90deg, #b366ff, #e055f5);
            --text-1:      #ffffff;
            --text-2:      #d4cef0;
            --text-3:      #9b92bc;
        }
        html, body {
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text-1);
        }
        body {
            display: flex;
            flex-direction: column;
            position: relative;
            overflow-x: hidden;
        }

        /* ── Stage background ── */
        .stage-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            background: #0a0812;
            overflow: hidden;
        }

        /* Dark curtain-like gradient on sides */
        .stage-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 50% at 50% 120%, rgba(80,40,120,0.55) 0%, transparent 70%),
                radial-gradient(ellipse 40% 60% at 20% 100%, rgba(168,85,247,0.18) 0%, transparent 60%),
                radial-gradient(ellipse 40% 60% at 80% 100%, rgba(168,85,247,0.18) 0%, transparent 60%);
        }

        /* Stage floor glow */
        .stage-bg::after {
            content: '';
            position: absolute;
            bottom: 0; left: 50%;
            transform: translateX(-50%);
            width: 70%; height: 40%;
            background: radial-gradient(ellipse at center bottom, rgba(120,50,200,0.25) 0%, transparent 70%);
        }

        /* Spotlight beams */
        .spotlight {
            position: absolute;
            bottom: 0;
            width: 0;
            height: 0;
            border-style: solid;
            opacity: 0.12;
        }
        .spotlight-left {
            left: 15%;
            border-width: 0 120px 600px 120px;
            border-color: transparent transparent rgba(168,85,247,1) transparent;
            transform: rotate(-20deg);
            transform-origin: bottom center;
        }
        .spotlight-center {
            left: 50%;
            transform: translateX(-50%);
            border-width: 0 200px 700px 200px;
            border-color: transparent transparent rgba(200,120,255,1) transparent;
            opacity: 0.08;
        }
        .spotlight-right {
            right: 15%;
            border-width: 0 120px 600px 120px;
            border-color: transparent transparent rgba(168,85,247,1) transparent;
            transform: rotate(20deg);
            transform-origin: bottom center;
        }

        /* Silhouette figures at bottom (decorative) */
        .stage-figures {
            position: absolute;
            bottom: 0; left: 50%;
            transform: translateX(-50%);
            width: 100%; height: 200px;
            background:
                radial-gradient(ellipse 30% 80% at 35% 100%, rgba(20,15,35,0.9) 0%, transparent 100%),
                radial-gradient(ellipse 30% 80% at 65% 100%, rgba(20,15,35,0.9) 0%, transparent 100%);
            pointer-events: none;
        }

        /* Topbar */
        .auth-topbar {
            height: 56px;
            display: flex; align-items: center; justify-content: flex-end;
            padding: 0 40px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            position: relative; z-index: 10;
            background: rgba(10,8,20,0.6);
            backdrop-filter: blur(10px);
        }
        .auth-topbar-nav { display: flex; gap: 28px; align-items: center; }
        .auth-topbar-nav a {
            font-size: 13px; color: var(--text-2);
            text-decoration: none; transition: color 0.2s;
        }
        .auth-topbar-nav a:hover { color: var(--text-1); }
        .btn-outline {
            padding: 7px 20px;
            border-radius: 20px;
            border: 1px solid var(--accent);
            color: var(--accent);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            background: transparent;
        }
        .btn-outline:hover { background: rgba(168,85,247,0.12); }

        /* Auth body */
        .auth-body {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 20px;
            position: relative; z-index: 5;
        }

        /* Card */
        .auth-card {
            background: var(--bg-card);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 24px;
            padding: 44px 48px 40px;
            width: 100%;
            max-width: 380px;
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            box-shadow: 0 32px 80px rgba(0,0,0,0.5), 0 0 0 1px rgba(168,85,247,0.1);
        }

        .auth-title {
            font-family: 'Poppins', sans-serif;
            font-size: 28px;
            font-weight: 800;
            line-height: 1.1;
            color: #ffffff;
        }
        .auth-title span { color: var(--accent); }
        .auth-subtitle {
            font-size: 11px;
            color: #9b92bc;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            margin-top: 8px;
        }

        /* Form */
        .form-group { margin-top: 22px; }
        .form-label {
            display: block;
            font-family: 'Poppins', sans-serif;
            font-size: 11px; font-weight: 700;
            color: #c47fff;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 8px;
        }
        .input-wrap {
            display: flex; align-items: center; gap: 10px;
            background: rgba(15,12,26,0.7);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 50px;
            padding: 13px 18px;
            transition: border-color 0.2s;
        }
        .input-wrap:focus-within { border-color: var(--border-focus); }
        .input-wrap svg { width: 16px; height: 16px; color: var(--text-3); flex-shrink: 0; }
        .input-wrap input {
            background: none; border: none; outline: none; flex: 1;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; color: var(--text-1);
        }
        .input-wrap input::placeholder { color: var(--text-3); }
        .input-wrap button {
            background: none; border: none; cursor: pointer;
            color: var(--text-3); padding: 0;
            display: flex; align-items: center;
        }
        .input-wrap button svg { width: 16px; height: 16px; }

        /* Error */
        .field-error { font-size: 12px; color: #f87171; margin-top: 6px; }

        /* Forgot */
        .forgot-row {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 8px;
        }
        .forgot-link {
            font-size: 11px; font-weight: 600;
            color: var(--accent);
            text-transform: uppercase; letter-spacing: 0.08em;
            text-decoration: none;
        }

        /* Submit btn */
        .btn-primary {
            width: 100%;
            padding: 15px;
            border-radius: 50px;
            border: none;
            background: var(--accent-btn);
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 700;
            cursor: pointer;
            margin-top: 28px;
            letter-spacing: 0.05em;
            transition: opacity 0.2s, transform 0.15s;
        }
        .btn-primary:hover { opacity: 0.9; transform: translateY(-1px); }
        .btn-primary:active { transform: translateY(0); }

        /* Footer link */
        .auth-footer {
            margin-top: 24px;
            text-align: center;
            font-size: 12px;
            color: var(--text-3);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .auth-footer a { color: var(--accent); font-weight: 700; text-decoration: none; }

        /* Back link */
        .back-link {
            display: flex; align-items: center; gap: 6px;
            font-size: 12px; color: var(--text-3);
            text-decoration: none; text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-top: 20px;
            justify-content: center;
            transition: color 0.2s;
        }
        .back-link:hover { color: var(--text-1); }

        /* Footer bar */
        .auth-footer-bar {
            padding: 20px 40px;
            border-top: 1px solid rgba(255,255,255,0.06);
            display: flex; align-items: center; justify-content: space-between;
            position: relative; z-index: 5;
            background: rgba(10,8,20,0.5);
        }
        .footer-brand { font-size: 13px; font-weight: 600; color: var(--text-1); }
        .footer-links { display: flex; gap: 24px; }
        .footer-links a { font-size: 11px; color: var(--text-3); text-decoration: none; text-transform: uppercase; letter-spacing: 0.08em; transition: color 0.2s; }
        .footer-links a:hover { color: var(--text-2); }
        .footer-copy { font-size: 11px; color: var(--text-3); text-transform: uppercase; letter-spacing: 0.05em; }

        /* Alert */
        .alert-error {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.3);
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13px;
            color: #fca5a5;
            margin-bottom: 20px;
        }
    </style>
    @stack('styles')
</head>
<body>
    {{-- Stage background --}}
    <div class="stage-bg">
        <div class="spotlight spotlight-left"></div>
        <div class="spotlight spotlight-center"></div>
        <div class="spotlight spotlight-right"></div>
        <div class="stage-figures"></div>
    </div>

    <header class="auth-topbar">
        <nav class="auth-topbar-nav">
            <a href="#">Performances</a>
            <a href="#">Gallery</a>
            <a href="#">Schedule</a>
            <a href="#">About</a>
            @auth
                <a href="{{ route('dashboard') }}" class="btn-outline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-outline">Sign In</a>
            @endauth
        </nav>
    </header>

    <div class="auth-body">
        @yield('auth-content')
    </div>

    <footer class="auth-footer-bar">
        <span class="footer-brand">Ethereal Stage</span>
        <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Press Kit</a>
            <a href="#">Contact</a>
        </div>
        <span class="footer-copy">© 2024 The Ethereal Stage. A Digital Curator Experience</span>
    </footer>

    @stack('scripts')
</body>
</html>
