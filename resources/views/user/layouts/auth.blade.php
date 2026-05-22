<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — Event Kampus</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/shared/layout.css') }}">
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
        <a href="/" class="brand-logo">Event<span>Kampus</span></a>
        <nav class="auth-topbar-nav">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-outline">Dashboard</a>
            @else
                @if(request()->routeIs('login'))
                    <a href="{{ route('register') }}" class="btn-outline">Register</a>
                @else
                    <a href="{{ route('login') }}" class="btn-outline">Sign In</a>
                @endif
            @endauth
        </nav>
    </header>

    <div class="auth-body">
        @yield('auth-content')
    </div>

    @stack('scripts')
</body>
</html>
