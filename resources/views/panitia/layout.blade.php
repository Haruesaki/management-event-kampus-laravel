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

        .sidebar {
            background: linear-gradient(180deg, #14121c, #0d0b14);
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            color: #9ca3af;
            transition: all 0.25s ease;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.04);
            color: white;
        }

        .menu-active {
            background: linear-gradient(90deg, rgba(168,85,247,0.25), rgba(236,72,153,0.15));
            color: #c084fc;
            box-shadow: inset 0 0 20px rgba(168,85,247,0.15);
        }

        .menu-active svg {
            color: #c084fc;
        }

        .create-btn {
            background: linear-gradient(90deg, #a855f7, #ec4899);
            box-shadow: 0 10px 25px rgba(168,85,247,0.4);
            transition: 0.25s;
        }

        .create-btn:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 15px 35px rgba(168,85,247,0.6);
        }
    </style>
</head>

<body class="flex">

<!-- SIDEBAR -->
<div class="w-64 h-screen p-6 sidebar flex flex-col justify-between border-r border-[#1c1c24]">

    <!-- TOP -->
    <div>
        <div class="mb-10">
            <h1 class="text-lg font-semibold">Event Central</h1>
            <p class="text-xs text-gray-500 tracking-widest">MANAGEMENT SUITE</p>
        </div>

        <ul class="space-y-3 text-sm">

            <!-- Dashboard -->
            <li>
                <a href="{{ route('panitia.dashboard') }}"
                   class="menu-item {{ request()->routeIs('panitia.dashboard') ? 'menu-active' : '' }}">
                    
                    <!-- ICON -->
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="3" width="5" height="5"/>
                        <rect x="10" y="3" width="5" height="5"/>
                        <rect x="3" y="10" width="5" height="5"/>
                        <rect x="10" y="10" width="5" height="5"/>
                    </svg>

                    Dashboard
                </a>
            </li>

            <!-- Ongoing Events -->
            <li>
                <a href="#"
                   class="menu-item">
                    
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="4" width="12" height="10" rx="2"/>
                        <line x1="3" y1="8" x2="15" y2="8"/>
                    </svg>

                    Ongoing Events
                </a>
            </li>

            <!-- Attendees -->
            <li>
                <a href="{{ route('panitia.attendees') }}"
                   class="menu-item {{ request()->routeIs('panitia.attendees') ? 'menu-active' : '' }}">
                    
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="9" cy="6" r="3"/>
                        <path d="M3 15c1.5-3 9.5-3 12 0"/>
                    </svg>

                    Attendees
                </a>
            </li>

        </ul>
    </div>

    <!-- BOTTOM -->
    <div class="space-y-5">

        <!-- BUTTON -->
        <a href="{{ route('panitia.event.create') }}"
           class="block text-center py-3 rounded-xl font-medium create-btn">
            + Create Event
        </a>

        <!-- HELP -->
        <div class="text-sm text-gray-500 flex items-center gap-2 cursor-pointer hover:text-white transition">
            <span>❓</span> Help Center
        </div>

        <!-- LOGOUT -->
        <div class="text-sm text-gray-500 flex items-center gap-2 cursor-pointer hover:text-white transition">
            <span>⏻</span> Logout
        </div>

    </div>

</div>

<!-- CONTENT -->
<div class="flex-1 p-6">
    @yield('content')
</div>

</body>
</html>