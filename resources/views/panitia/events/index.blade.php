@extends('panitia.layout')

@section('content')

<div class="p-8 text-white">

    <!-- HEADER -->
    <div class="mb-10">
        <h1 class="text-3xl font-semibold gradient-text">Ongoing Events</h1>
        <p class="text-sm text-gray-400 mt-1">Monitor and manage your live events</p>
    </div>

    <!-- GRID -->
    <div class="grid grid-cols-3 gap-6">

        <!-- CARD -->
        <div class="glow-card glow-hover p-6">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Neon Masquerade</h2>
                <span class="px-3 py-1 text-xs rounded-full bg-green-500/20 text-green-400">
                    ● Active
                </span>
            </div>

            <p class="text-gray-400 text-sm mb-5">
                Night festival with music, art & immersive visuals.
            </p>

            <!-- STATS -->
            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <p class="text-gray-400 text-xs">Attendees</p>
                    <p class="text-xl font-bold">342</p>
                </div>
                <div>
                    <p class="text-gray-400 text-xs">Revenue</p>
                    <p class="text-xl font-bold">$12,450</p>
                </div>
            </div>

            <!-- PROGRESS -->
            <div class="mb-5">
                <div class="flex justify-between text-xs text-gray-400 mb-1">
                    <span>Ticket Sold</span>
                    <span>84%</span>
                </div>

                <div class="w-full h-2 bg-[#1c1c24] rounded overflow-hidden">
                    <div class="h-2 bg-gradient-to-r from-purple-500 to-pink-500 animate-pulse"
                         style="width:84%">
                    </div>
                </div>
            </div>

            <!-- ACTION -->
            <div class="flex gap-3">
                <a href="{{ route('panitia.attendees') }}"
                   class="flex-1 text-center bg-[#1c1c24] py-2 rounded-lg text-sm hover:bg-purple-500/20">
                    Attendees
                </a>

                <button class="flex-1 py-2 rounded-lg text-sm btn-glow">
                    Manage
                </button>
            </div>

        </div>


        <!-- CARD 2 -->
        <div class="glow-card glow-hover p-6">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Tech Summit</h2>
                <span class="px-3 py-1 text-xs rounded-full bg-yellow-500/20 text-yellow-400">
                    ● Upcoming
                </span>
            </div>

            <p class="text-gray-400 text-sm mb-5">
                Innovation & startup ecosystem conference.
            </p>

            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <p class="text-gray-400 text-xs">Attendees</p>
                    <p class="text-xl font-bold">120</p>
                </div>
                <div>
                    <p class="text-gray-400 text-xs">Revenue</p>
                    <p class="text-xl font-bold">$5,200</p>
                </div>
            </div>

            <div class="mb-5">
                <div class="flex justify-between text-xs text-gray-400 mb-1">
                    <span>Ticket Sold</span>
                    <span>45%</span>
                </div>

                <div class="w-full h-2 bg-[#1c1c24] rounded overflow-hidden">
                    <div class="h-2 bg-gradient-to-r from-purple-500 to-pink-500"
                         style="width:45%">
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('panitia.attendees') }}"
                   class="flex-1 text-center bg-[#1c1c24] py-2 rounded-lg text-sm hover:bg-purple-500/20">
                    Attendees
                </a>

                <button class="flex-1 py-2 rounded-lg text-sm bg-blue-500/20 text-blue-400 hover:bg-blue-500/30">
                    Edit
                </button>
            </div>

        </div>


        <!-- CARD 3 -->
        <div class="glow-card glow-hover p-6">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Art Expo</h2>
                <span class="px-3 py-1 text-xs rounded-full bg-red-500/20 text-red-400">
                    ● Closed
                </span>
            </div>

            <p class="text-gray-400 text-sm mb-5">
                Exhibition of modern digital art.
            </p>

            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <p class="text-gray-400 text-xs">Attendees</p>
                    <p class="text-xl font-bold">500</p>
                </div>
                <div>
                    <p class="text-gray-400 text-xs">Revenue</p>
                    <p class="text-xl font-bold">$18,000</p>
                </div>
            </div>

            <div class="mb-5">
                <div class="flex justify-between text-xs text-gray-400 mb-1">
                    <span>Ticket Sold</span>
                    <span>100%</span>
                </div>

                <div class="w-full h-2 bg-[#1c1c24] rounded overflow-hidden">
                    <div class="h-2 bg-gradient-to-r from-purple-500 to-pink-500"
                         style="width:100%">
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <button class="flex-1 bg-gray-700 py-2 rounded-lg text-sm">
                    Report
                </button>

                <button class="flex-1 bg-red-500/20 text-red-400 py-2 rounded-lg text-sm">
                    Archive
                </button>
            </div>

        </div>

    </div>

</div>

@endsection