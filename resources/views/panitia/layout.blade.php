<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panitia') — Event Central</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/shared/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/panitia/style.css') }}">
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

    {{-- ── SIDEBAR ── --}}
    <aside class="sidebar">

        {{-- Brand --}}
        <div class="sidebar-brand">
            <a href="{{ route('panitia.dashboard') }}" class="brand-logo">Event<span>Kampus</span></a>
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

            <a href="{{ route('panitia.manage_event') }}"
               class="nav-item {{ request()->routeIs('panitia.manage_event') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Kelola Event
            </a>

            <a href="{{ route('panitia.events') }}"
               class="nav-item {{ request()->routeIs('panitia.events') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="5" width="18" height="16" rx="2"/>
                    <line x1="8" y1="3" x2="8" y2="7"/>
                    <line x1="16" y1="3" x2="16" y2="7"/>
                    <line x1="3" y1="11" x2="21" y2="11"/>
                </svg>
                Event Berlangsung
            </a>

            <a href="{{ route('panitia.archived_events') }}"
               class="nav-item {{ request()->routeIs('panitia.archived_events') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Arsip Event
            </a>

            {{-- Tombol Create Event — Khusus Panitia --}}
            <div class="nav-section-label">Tindakan Cepat</div>
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
                Buat Event
            </a>

        </nav>

        {{-- User Card --}}
        @auth
        <div class="sidebar-footer">
            <div class="role-card">
                <a href="{{ route('profile.show') }}" style="display: flex; align-items: center; gap: 12px; text-decoration: none; flex: 1;">
                    <div class="role-card-avatar avatar-panitia">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="role-card-info">
                        <div class="role-card-name">{{ auth()->user()->name }}</div>
                        <div class="role-card-label">Panitia</div>
                    </div>
                </a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit" class="role-card-logout" title="Keluar">
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
            <div style="display:flex; align-items:center; gap:32px;">
                <a href="{{ route('panitia.dashboard') }}" class="brand-logo">Event<span>Kampus</span></a>
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