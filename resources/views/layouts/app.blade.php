<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ethereal Auditorium') — Manajemen Event Kampus</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg-root:    #0c0a14;
            --bg-sidebar: #13101e;
            --bg-main:    #100e1a;
            --bg-card:    #1c1829;
            --bg-card-2:  #201c30;
            --border:     rgba(255,255,255,0.10);
            --accent:     #b366ff;
            --accent-2:   #e055f5;
            --accent-soft:rgba(179,102,255,0.18);
            --accent-glow:rgba(179,102,255,0.40);
            --text-1:     #ffffff;
            --text-2:     #d4cef0;
            --text-3:     #9b92bc;
            --sidebar-w:  200px;
            --topbar-h:   60px;
        }

        html, body { height: 100%; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg-root);
            color: var(--text-1);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            z-index: 100;
            padding: 24px 0;
        }
        .sidebar-brand {
            padding: 0 20px 28px;
            border-bottom: 1px solid var(--border);
        }
        .sidebar-brand .brand-name {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.03em;
        }
        .sidebar-brand .brand-sub {
            font-size: 10px;
            color: #b0a8cc;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-top: 2px;
        }
        .sidebar-nav {
            padding: 20px 12px;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 500;
            color: #ccc5e8;
            text-decoration: none;
            transition: all 0.2s;
            position: relative;
        }
        .nav-item svg { width: 17px; height: 17px; opacity: 0.85; flex-shrink: 0; }
        .nav-item:hover { background: var(--accent-soft); color: #ffffff; }
        .nav-item:hover svg { opacity: 1; }
        .nav-item.active {
            background: var(--accent-soft);
            color: #d89cff;
            border-left: 3px solid var(--accent);
            padding-left: 9px;
        }
        .nav-item.active svg { opacity: 1; color: #d89cff; }

        /* ── Wrapper ── */
        .layout-wrapper {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── Topbar ── */
        .topbar {
            height: var(--topbar-h);
            background: rgba(16,14,26,0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 90;
        }
        .topbar-brand {
            font-family: 'Poppins', sans-serif;
            font-size: 17px;
            font-weight: 800;
            background: linear-gradient(90deg, #c47fff, #e870f5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.01em;
        }
        .topbar-nav { display: flex; gap: 28px; align-items: center; }
        .topbar-nav a {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 500;
            color: #ccc5e8;
            text-decoration: none;
            padding-bottom: 2px;
            transition: color 0.2s;
        }
        .topbar-nav a:hover, .topbar-nav a.active {
            color: #ffffff;
        }
        .topbar-nav a.active { border-bottom: 2px solid var(--accent); }
        .topbar-right { display: flex; align-items: center; gap: 16px; }
        .topbar-icon {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--bg-card);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            color: var(--text-2);
            transition: all 0.2s;
        }
        .topbar-icon:hover { border-color: var(--accent); color: var(--accent); }
        .topbar-icon svg { width: 16px; height: 16px; }
        .topbar-search {
            display: flex; align-items: center; gap: 8px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 7px 14px;
        }
        .topbar-search svg { width: 14px; height: 14px; color: var(--text-3); flex-shrink: 0; }
        .topbar-search input {
            background: none; border: none; outline: none;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px; color: var(--text-1);
            width: 160px;
        }
        .topbar-search input::placeholder { color: var(--text-3); }
        .btn-login {
            padding: 7px 18px;
            border-radius: 20px;
            border: 1px solid var(--accent);
            background: transparent;
            color: var(--accent);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-login:hover { background: var(--accent-soft); }
        .avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700;
            cursor: pointer;
            overflow: hidden;
            border: 2px solid var(--accent-glow);
        }
        .avatar img { width: 100%; height: 100%; object-fit: cover; }

        /* ── Main content ── */
        .main-content {
            flex: 1;
            padding: 32px 28px;
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--text-3); border-radius: 3px; }
    </style>
    @stack('styles')
</head>
<body>
    {{-- Sidebar --}}
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-name">The Auditorium</div>
            <div class="brand-sub">Digital Curator</div>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('home') || request()->routeIs('dashboard') ? 'active' : '' }}">
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
    </aside>

    {{-- Main wrapper --}}
    <div class="layout-wrapper">
        {{-- Topbar --}}
        <header class="topbar">
            <div style="display:flex; align-items:center; gap:32px;">
                <span class="topbar-brand">Ethereal Auditorium</span>
                <nav class="topbar-nav">
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('home') || request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                    <a href="#">Schedule</a>
                    <a href="#">Venues</a>
                </nav>
            </div>
            <div style="display:flex; align-items:center; gap:12px;">
                <div class="topbar-search">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
                    </svg>
                    <input type="text" placeholder="Search events...">
                </div>
                <div class="topbar-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </div>
                <div class="topbar-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                @auth
                    <div class="avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-login">Login</a>
                @endauth
            </div>
        </header>

        {{-- Page content --}}
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
