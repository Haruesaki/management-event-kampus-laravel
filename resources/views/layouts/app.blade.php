<!DOCTYPE html>
<html lang="en">
<head>
    <title>Event Central</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: radial-gradient(circle at top, #0f0b1a, #05030d);
            color: white;
            font-family: 'Inter', sans-serif;
        }

        .sidebar {
            background: #0F0F14;
            border-right: 1px solid #1c1c24;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 12px;
            color: #9ca3af;
            transition: 0.2s;
        }

        .menu-item:hover {
            background: #1a1a22;
            color: white;
        }

        .active {
            background: #1a1a22;
            color: #c084fc;
            font-weight: 500;
        }

        .create-btn {
            background: linear-gradient(90deg, #7c3aed, #ec4899);
            border-radius: 12px;
            padding: 10px;
            text-align: center;
            font-weight: 500;
            transition: 0.2s;
        }

        .create-btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="flex">

<!-- SIDEBAR -->
<aside class="w-64 min-h-screen p-6 sidebar flex flex-col justify-between">

    <!-- TOP -->
    <div>
        <h1 class="text-lg font-semibold mb-10 tracking-wide">
            Event Central
        </h1>

        <ul class="space-y-2 text-sm">

            <!-- Dashboard -->
            <li>
                <a href="{{ route('panitia.dashboard') }}"
                   class="menu-item {{ request()->routeIs('panitia.dashboard') ? 'active' : '' }}">
                    📊 <span>Dashboard</span>
                </a>
            </li>

            <!-- Attendees -->
            <li>
                <a href="{{ route('panitia.attendees') }}"
                   class="menu-item {{ request()->routeIs('panitia.attendees') ? 'active' : '' }}">
                    👥 <span>Attendees</span>
                </a>
            </li>

            <!-- Create -->
            <li>
                <a href="{{ route('panitia.event.create') }}"
                   class="menu-item {{ request()->routeIs('panitia.event.create') ? 'active' : '' }}">
                    ➕ <span>Create Event</span>
                </a>
            </li>

        </ul>
    </div>

    <!-- BOTTOM -->
    <div class="space-y-4">

        <a href="{{ route('panitia.event.create') }}" class="create-btn">
            + Create Event
        </a>

        <p class="text-xs text-gray-500 hover:text-white cursor-pointer transition">
            Logout
        </p>

    </div>

</aside>

<!-- CONTENT -->
<main class="flex-1 p-6">
    @yield('content')
</main>

</body>
</html>