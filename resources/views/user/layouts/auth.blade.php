<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — Ethereal Stage</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/user/auth.css') }}">
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
