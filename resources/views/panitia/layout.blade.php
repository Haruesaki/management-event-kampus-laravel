<!DOCTYPE html>
<html lang="en">
<head>
    <title>Event Central</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: #0B0B0F;
            color: white;
        }

        /* SIDEBAR */
        .sidebar {
            background: linear-gradient(180deg, #0f0f14, #0a0a10);
            border-right: 1px solid rgba(255,255,255,0.05);
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            color: #9ca3af;
            transition: all 0.25s ease;
        }

        .menu-item:hover {
            background: rgba(168,85,247,0.1);
            color: white;
        }

        .active-menu {
            background: linear-gradient(90deg, rgba(168,85,247,0.25), transparent);
            color: #c084fc;
        }

        .icon {
            width: 18px;
            height: 18px;
            stroke-width: 1.5;
        }

        .create-btn {
            display: block;
            text-align: center;
            padding: 12px;
            border-radius: 14px;
            background: linear-gradient(90deg, #9333ea, #ec4899);
            font-weight: 500;
            color: white;
            box-shadow: 0 0 25px rgba(168,85,247,0.5);
            transition: 0.3s;
        }

        .create-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 35px rgba(168,85,247,0.8);
        }

        /* NAVBAR */
        .navbar {
            position: fixed;
            top: 0;
            left: 256px;
            right: 0;
            height: 70px;
            background: rgba(11,11,15,0.7);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .nav-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #15151D;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
        }

        .nav-icon:hover {
            background: rgba(168,85,247,0.2);
        }

        .nav-icon svg {
            width: 18px;
            height: 18px;
        }

        /* CARD */
        .glow-card {
            background: #15151D;
            border-radius: 16px;
            box-shadow: 0 0 0 1px rgba(255,255,255,0.03),
                        0 10px 30px rgba(124,58,237,0.15);
            transition: 0.3s;
        }

        .glow-card:hover {
            box-shadow: 0 0 0 1px rgba(255,255,255,0.05),
                        0 15px 40px rgba(168,85,247,0.25);
            transform: translateY(-3px);
        }

        .input-dark {
            background: #15151D;
            border: 1px solid #1c1c24;
            border-radius: 10px;
            padding: 10px 14px;
            outline: none;
            transition: 0.3s;
        }

        .input-dark:focus {
            border-color: #9333ea;
            box-shadow: 0 0 0 2px rgba(147,51,234,0.3);
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<aside class="w-64 h-screen fixed top-0 left-0 flex flex-col justify-between px-6 py-8 sidebar">

    <div>
        <h1 class="text-lg font-semibold mb-1">Event Central</h1>
        <p class="text-xs text-gray-500 mb-10 tracking-widest">MANAGEMENT SUITE</p>

        <nav class="space-y-3">

            <a href="{{ route('panitia.dashboard') }}"
               class="menu-item {{ request()->routeIs('panitia.dashboard') ? 'active-menu' : '' }}">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('panitia.events') }}"
               class="menu-item {{ request()->routeIs('panitia.events') ? 'active-menu' : '' }}">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <rect x="3" y="5" width="18" height="16" rx="2"/>
                    <line x1="8" y1="3" x2="8" y2="7"/>
                    <line x1="16" y1="3" x2="16" y2="7"/>
                    <line x1="3" y1="11" x2="21" y2="11"/>
                </svg>
                <span>Ongoing Events</span>
            </a>

            <a href="{{ route('panitia.attendees') }}"
               class="menu-item {{ request()->routeIs('panitia.attendees') ? 'active-menu' : '' }}">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M17 11c2.2 0 4 1.8 4 4v2"/>
                    <path d="M3 21v-2c0-2.2 1.8-4 4-4h4c2.2 0 4 1.8 4 4v2"/>
                </svg>
                <span>Attendees</span>
            </a>

        </nav>
    </div>

    <div class="space-y-4">
        <a href="{{ route('panitia.event.create') }}" class="create-btn">
            + Create Event
        </a>

        <div class="text-sm text-gray-400 hover:text-purple-400 cursor-pointer">
            Help Center
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-gray-500 hover:text-red-400 cursor-pointer w-full text-left">
                Logout
            </button>
        </form>
    </div>

</aside>

<!-- NAVBAR -->
<div class="navbar">

    <div class="text-sm text-gray-300">
        Nocturnal Curator
    </div>

    <div class="flex items-center gap-4">

        <!-- NOTIF -->
<div class="nav-icon">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path d="M18 8a6 6 0 10-12 0c0 7-3 7-3 7h18s-3 0-3-7"/>
        <path d="M13.73 21a2 2 0 01-3.46 0"/>
    </svg>
</div>

<!-- SETTINGS -->
<div class="nav-icon">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <circle cx="12" cy="12" r="3"/>
        <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06
                 a2 2 0 01-2.83 2.83l-.06-.06
                 a1.65 1.65 0 00-1.82-.33
                 a1.65 1.65 0 00-1 1.51V21
                 a2 2 0 01-2 2h-1
                 a2 2 0 01-2-2v-.09
                 a1.65 1.65 0 00-1-1.51
                 a1.65 1.65 0 00-1.82.33l-.06.06
                 a2 2 0 01-2.83-2.83l.06-.06
                 a1.65 1.65 0 00.33-1.82
                 a1.65 1.65 0 00-1.51-1H3
                 a2 2 0 01-2-2v-1
                 a2 2 0 012-2h.09
                 a1.65 1.65 0 001.51-1
                 a1.65 1.65 0 00-.33-1.82l-.06-.06
                 a2 2 0 012.83-2.83l.06.06
                 a1.65 1.65 0 001.82.33h0
                 a1.65 1.65 0 001-1.51V3
                 a2 2 0 012-2h1
                 a2 2 0 012 2v.09
                 a1.65 1.65 0 001 1.51
                 a1.65 1.65 0 001.82-.33l.06-.06
                 a2 2 0 012.83 2.83l-.06.06
                 a1.65 1.65 0 00-.33 1.82v0
                 a1.65 1.65 0 001.51 1H21
                 a2 2 0 012 2v1
                 a2 2 0 01-2 2h-.09
                 a1.65 1.65 0 00-1.51 1z"/>
    </svg>
</div>

<!-- USER AVATAR -->
<div class="relative group cursor-pointer">

    <div class="w-9 h-9 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-sm font-semibold shadow-lg shadow-purple-500/30 group-hover:scale-105 transition">
        NC
    </div>

    <!-- DROPDOWN -->
    <div class="absolute right-0 mt-3 w-44 bg-[#15151D] border border-[#1c1c24] rounded-xl opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-200 shadow-xl">

        <a href="#" class="block px-4 py-2 text-sm hover:bg-[#1c1c24] rounded-t-xl">
            Profile
        </a>

        <a href="#" class="block px-4 py-2 text-sm hover:bg-[#1c1c24]">
            Settings
        </a>

        <div class="border-t border-[#1c1c24] my-1"></div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-[#1c1c24] rounded-b-xl">
                Logout
            </button>
        </form>

    </div>

</div>

    </div>

</div>

<!-- CONTENT -->
<div class="ml-64 pt-[90px] p-6">
    @yield('content')
</div>

</body>
</html>