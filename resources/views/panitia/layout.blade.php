<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panitia') — Event Central</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/shared/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/panitia/style.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
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

    {{-- ── SIDEBAR ── --}}
    <aside class="sidebar">

        {{-- Brand --}}
        <div class="sidebar-brand">
            <div class="brand-name">Event Central</div>
            <div class="brand-sub">Management Suite</div>
        </div>

        {{-- Navigation --}}
        <nav class="sidebar-nav">

            <a href="{{ route('panitia.dashboard') }}"
               class="nav-item {{ request()->routeIs('panitia.dashboard') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('panitia.events') }}"
               class="nav-item {{ request()->routeIs('panitia.events') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="5" width="18" height="16" rx="2"/>
                    <line x1="8" y1="3" x2="8" y2="7"/>
                    <line x1="16" y1="3" x2="16" y2="7"/>
                    <line x1="3" y1="11" x2="21" y2="11"/>
                </svg>
                Ongoing Events
            </a>

            <a href="{{ route('panitia.attendees') }}"
               class="nav-item {{ request()->routeIs('panitia.attendees') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M17 11c2.2 0 4 1.8 4 4v2"/>
                    <path d="M3 21v-2c0-2.2 1.8-4 4-4h4c2.2 0 4 1.8 4 4v2"/>
                </svg>
                Attendees
            </a>

            {{-- Tombol Create Event — Khusus Panitia --}}
            <div class="nav-section-label">Quick Actions</div>
            <a href="{{ route('panitia.event.create') }}" class="nav-item" style="
                background: linear-gradient(90deg, rgba(147,51,234,0.25), rgba(236,72,153,0.15));
                border: 1px solid rgba(147,51,234,0.35);
                color: #d8b4fe;
                margin-top: 4px;
            ">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="16"/>
                    <line x1="8" y1="12" x2="16" y2="12"/>
                </svg>
                Create Event
            </a>

        </nav>

        {{-- User Card --}}
        @auth
        <div class="sidebar-footer">
            <div class="role-card">
                <div class="role-card-avatar avatar-panitia">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="role-card-info">
                    <div class="role-card-name">{{ auth()->user()->name }}</div>
                    <div class="role-card-label">Panitia</div>
                </div>
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit" class="role-card-logout" title="Logout">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        @endauth

    </aside>

    {{-- ── LAYOUT WRAPPER ── --}}
    <div class="layout-wrapper">

        {{-- Topbar --}}
        <header class="topbar">
            <span class="topbar-brand">Event Central</span>

            <div class="topbar-search">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
                </svg>
                <input type="text" placeholder="Search events...">
            </div>

            <div class="topbar-actions">
                {{-- Notif icon --}}
                <div class="topbar-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </div>

                {{-- Settings icon --}}
                <div class="topbar-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="3"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/>
                    </svg>
                </div>

                @auth
                    <div class="topbar-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endauth
            </div>
        </header>

        {{-- Page Content --}}
        <main class="main-content">
            @yield('content')
        </main>

    </div>

    @stack('scripts')
</body>
</html>