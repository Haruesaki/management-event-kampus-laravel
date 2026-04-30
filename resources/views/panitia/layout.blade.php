<!DOCTYPE html>
<html lang="en">
<head>
    <title>Event Central</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: radial-gradient(circle at top, #0b0b12, #050308);
            color: white;
            font-family: 'Inter', sans-serif;
        }

        /* GLASS SIDEBAR */
        .sidebar {
            background: linear-gradient(180deg, rgba(20,20,30,0.9), rgba(10,10,15,0.95));
            backdrop-filter: blur(12px);
            border-right: 1px solid rgba(255,255,255,0.05);
        }

        /* MENU ITEM */
        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 14px;
            color: #9ca3af;
            transition: all 0.25s ease;
            position: relative;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.05);
            color: white;
            transform: translateX(4px);
        }

        /* ACTIVE ITEM */
        .menu-active {
            background: linear-gradient(90deg, rgba(168,85,247,0.25), transparent);
            color: #d8b4fe;
        }

        .menu-active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 20%;
            height: 60%;
            width: 4px;
            border-radius: 10px;
            background: linear-gradient(to bottom, #a855f7, #ec4899);
            box-shadow: 0 0 12px rgba(168,85,247,0.8);
        }

        /* CREATE BUTTON */
        .create-btn {
            background: linear-gradient(90deg, #a855f7, #ec4899);
            border-radius: 14px;
            padding: 12px;
            text-align: center;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 0 20px rgba(168,85,247,0.4);
        }

        .create-btn:hover {
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 0 30px rgba(168,85,247,0.7);
        }

        /* ICON */
        .icon {
            width: 20px;
            height: 20px;
        }
    </style>
</head>

<body class="flex">

<!-- SIDEBAR -->
<aside class="w-64 min-h-screen p-6 flex flex-col justify-between sidebar">

    <!-- TOP -->
    <div>

        <!-- LOGO -->
        <div class="mb-10">
            <h1 class="text-lg font-semibold text-purple-400">Event Central</h1>
            <p class="text-xs text-gray-500 tracking-widest mt-1">MANAGEMENT SUITE</p>
        </div>

        <!-- MENU -->
        <ul class="space-y-3 text-sm">

            <!-- Dashboard -->
            <li>
                <a href="{{ route('panitia.dashboard') }}"
                   class="menu-item {{ request()->routeIs('panitia.dashboard') ? 'menu-active' : '' }}">
                    
                    <svg class="icon" fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24">
                        <path d="M3 12h7V3H3v9zM14 21h7v-9h-7v9zM14 3v7h7V3h-7zM3 21h7v-7H3v7z"/>
                    </svg>

                    Dashboard
                </a>
            </li>

            <!-- Ongoing -->
            <li>
                <a href="#"
                   class="menu-item text-gray-400 hover:text-white">
                    
                    <svg class="icon" fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24">
                        <path d="M8 7V3M16 7V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z"/>
                    </svg>

                    Ongoing Events
                </a>
            </li>

            <!-- Attendees -->
            <li>
                <a href="{{ route('panitia.attendees') }}"
                   class="menu-item {{ request()->routeIs('panitia.attendees') ? 'menu-active' : '' }}">
                    
                    <svg class="icon" fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24">
                        <path d="M17 20h5V4H2v16h5M17 20a4 4 0 00-8 0M17 20H9"/>
                    </svg>

                    Attendees
                </a>
            </li>

        </ul>

    </div>

    <!-- BOTTOM -->
    <div class="space-y-5">

        <!-- CREATE BUTTON -->
        <a href="{{ route('panitia.event.create') }}" class="create-btn">
            + Create Event
        </a>

        <!-- HELP -->
        <div class="flex items-center gap-3 text-gray-400 text-sm hover:text-white cursor-pointer transition">
            ❓ Help Center
        </div>

        <!-- LOGOUT -->
        <div class="flex items-center gap-3 text-gray-400 text-sm hover:text-white cursor-pointer transition">
            ↩ Logout
        </div>

    </div>

</aside>

<!-- CONTENT -->
<main class="flex-1 p-6">
    @yield('content')
</main>

</body>
</html>