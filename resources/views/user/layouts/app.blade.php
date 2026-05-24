<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ethereal Auditorium') — Manajemen Event Kampus</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/shared/layout.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dark: '#0c0a14',
                    }
                }
            }
        }
    </script>
    @stack('styles')
</head>
<body>
    {{-- Sidebar --}}
    <aside class="sidebar">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}" class="brand-logo">Event<span>Kampus</span></a>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('user.dashboard') }}" class="nav-item {{ request()->routeIs('home') || request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 13a1 1 0 011-1h4a1 1 0 011 1v6a1 1 0 01-1 1h-4a1 1 0 01-1-1v-6z"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('events.index') }}" class="nav-item {{ request()->routeIs('events.*') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                </svg>
                Discovery
            </a>
            <a href="{{ route('schedule.index') }}" class="nav-item {{ request()->routeIs('schedule.*') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Schedule
            </a>
            <a href="{{ route('tickets.index') }}" class="nav-item {{ request()->routeIs('tickets.*') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
                My Tickets
            </a>
            <a href="{{ route('profile.show') }}" class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Profile
            </a>
        </nav>
        @auth
        <div style="margin-top: auto;">
            <div class="role-card">
                <a href="{{ route('profile.show') }}" style="display: flex; align-items: center; gap: 12px; text-decoration: none; flex: 1;">
                    <div class="role-card-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="role-card-info">
                        <div class="role-card-name">{{ auth()->user()->name }}</div>
                        <div class="role-card-label">User</div>
                    </div>
                </a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit" class="role-card-logout" title="Logout">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        @else
        <div style="margin-top: auto; padding: 16px; display: flex; flex-direction: column; gap: 10px;">
            <a href="{{ route('login') }}" class="btn-login" style="text-align: center; border-radius: 12px; padding: 10px;">Sign In</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn-sidebar-register" style="text-align: center; background: linear-gradient(135deg, var(--accent), var(--accent-2)); color: #fff; padding: 10px; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 13px; box-shadow: 0 4px 12px rgba(179,102,255,0.2);">Get Started</a>
            @endif
        </div>
        @endauth
    </aside>

    {{-- Main wrapper --}}
    <div class="layout-wrapper">
        {{-- Topbar --}}
        <header class="topbar">
            <div style="display:flex; align-items:center; gap:32px;">
                <a href="{{ route('dashboard') }}" class="brand-logo">Event<span>Kampus</span></a>
            </div>
        </header>

        {{-- Page content --}}
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    {{-- GLOBAL LOADER --}}
    <div id="global-loader" class="loader-overlay">
        <div class="premium-loader"></div>
        <div class="loader-text">Memproses Data...</div>
    </div>

    @stack('scripts')
</body>
</html>
