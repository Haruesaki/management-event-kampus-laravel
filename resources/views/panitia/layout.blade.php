<!DOCTYPE html>
<html lang="en">
<head>
    <title>Panitia Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: #0f0b1a;
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
    </style>
</head>
<body class="flex">

<!-- Sidebar -->
<div class="w-64 h-screen p-5 bg-black">
    <h1 class="text-xl font-bold mb-6">Event Central</h1>

    <ul class="space-y-4">
        <li><a href="{{ route('panitia.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('panitia.event.create') }}">Create Event</a></li>
        <li><a href="{{ route('panitia.event.index') }}">Events</a></li>
        <li><a href="{{ route('panitia.attendee') }}">Attendees</a></li>
        <li><a href="{{ route('panitia.payment') }}">Payments</a></li>
    </ul>
</div>

<!-- Content -->
<div class="flex-1 p-6">
    @yield('content')
</div>

</body>
</html>
