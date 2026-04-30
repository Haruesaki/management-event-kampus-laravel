<!DOCTYPE html>
<html lang="en">
<head>
    <title>Event Central</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: radial-gradient(circle at top, #1a1333, #0b0719);
            color: white;
        }

        .card {
            background: linear-gradient(145deg, #1a132f, #120d25);
            border-radius: 16px;
            padding: 20px;
        }

        .btn-primary {
            background: linear-gradient(90deg, #7c3aed, #ec4899);
        }

        .sidebar a {
            display: block;
            padding: 10px;
            border-radius: 8px;
            color: #aaa;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #1f163a;
            color: white;
        }

        .sidebar a:active {
            transform: scale(0.97);
        }

        .active {
            color: #c084fc;
            font-weight: bold;
            background: #1f163a;
        }
    </style>
</head>

<body class="flex">

<!-- SIDEBAR -->
<div class="w-64 h-screen p-6 bg-black sidebar flex flex-col justify-between">

    <div>
        <h1 class="text-xl font-bold mb-8">Event Central</h1>

        <ul class="space-y-3">

            <li>
                <a href="{{ route('panitia.dashboard') }}"
                   class="{{ request()->routeIs('panitia.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('panitia.attendees') }}"
                   class="{{ request()->routeIs('panitia.attendees') ? 'active' : '' }}">
                    Attendees
                </a>
            </li>

            <li>
                <a href="{{ route('panitia.event.create') }}"
                   class="{{ request()->routeIs('panitia.event.create') ? 'active' : '' }}">
                    + Create Event
                </a>
            </li>

        </ul>
    </div>

    <div>
        <a href="#" class="text-gray-400 text-sm">Logout</a>
    </div>

</div>

<!-- CONTENT -->
<div class="flex-1 p-6">
    @yield('content')
</div>

</body>
</html>