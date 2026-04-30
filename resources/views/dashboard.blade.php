@extends('panitia.layout')

@section('content')

<div class="p-8 bg-gradient-to-br from-[#0B0B0F] via-[#12121A] to-[#0B0B0F] min-h-screen text-white">

    <!-- TOP BAR -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-xl font-semibold">Ethereal Auditorium</h1>

        <div class="flex items-center gap-4">
            <input type="text" placeholder="Search events..."
                class="bg-[#15151D] px-4 py-2 rounded-lg text-sm outline-none border border-[#1c1c24] w-64">

            <div class="w-9 h-9 rounded-full bg-[#1c1c24] flex items-center justify-center">🔔</div>
            <div class="w-9 h-9 rounded-full bg-[#1c1c24] flex items-center justify-center">👤</div>
        </div>
    </div>

    <!-- HERO -->
    <div class="relative rounded-2xl overflow-hidden mb-10">

        <img src="https://images.unsplash.com/photo-1504805572947-34fad45aed93"
             class="absolute inset-0 w-full h-full object-cover opacity-40">

        <div class="relative p-10 bg-gradient-to-r from-black/80 to-transparent">

            <span class="text-xs bg-purple-500/20 text-purple-400 px-3 py-1 rounded-full">
                FEATURED PERFORMANCE
            </span>

            <h2 class="text-4xl font-bold mt-4 leading-tight">
                Dies Natalis <br>
                <span class="text-purple-400">Concert 2026</span>
            </h2>

            <p class="text-gray-300 mt-3 max-w-lg">
                Experience an ethereal night of orchestral fusion and digital arts in the heart of the main campus plaza.
            </p>

            <div class="mt-6 flex gap-4">
                <button class="px-5 py-2 rounded-full bg-gradient-to-r from-purple-500 to-pink-500">
                    Get Tickets Now →
                </button>
                <button class="px-5 py-2 rounded-full bg-white/10">
                    View Lineup
                </button>
            </div>

        </div>
    </div>

    <!-- CATEGORIES -->
    <div class="mb-10">
        <div class="flex justify-between mb-4">
            <h3 class="font-semibold">Explore Categories</h3>
            <span class="text-sm text-purple-400">View All</span>
        </div>

        <div class="grid grid-cols-4 gap-4">

            @foreach(['Music','Seminar','Workshop','Sports'] as $cat)
            <div class="bg-[#15151D] p-6 rounded-xl text-center hover:bg-[#1a1a22] transition">
                <div class="w-10 h-10 mx-auto mb-2 bg-purple-500/20 rounded-full flex items-center justify-center">
                    🎵
                </div>
                <p class="text-sm">{{ $cat }}</p>
            </div>
            @endforeach

        </div>
    </div>

    <!-- UPCOMING EVENTS -->
    <div>
        <div class="flex justify-between mb-4">
            <h3 class="font-semibold">Upcoming Events</h3>
        </div>

        <div class="grid grid-cols-3 gap-6">

            <!-- CARD 1 -->
            <div class="bg-[#15151D] rounded-2xl overflow-hidden hover:scale-105 transition">

                <img src="https://images.unsplash.com/photo-1529336953121-ad5a0d43d0d2"
                     class="h-40 w-full object-cover">

                <div class="p-4">
                    <p class="font-medium">Tech Summit</p>
                    <p class="text-xs text-gray-400">Future Tech Summit</p>
                    <p class="mt-2 text-purple-400">$25.00</p>
                </div>

            </div>

            <!-- CARD 2 -->
            <div class="bg-[#15151D] rounded-2xl overflow-hidden hover:scale-105 transition">

                <img src="https://images.unsplash.com/photo-1547891654-e66ed7ebb968"
                     class="h-40 w-full object-cover">

                <div class="p-4">
                    <p class="font-medium">Canvas of Dreams</p>
                    <p class="text-xs text-gray-400">Art Exhibition</p>
                    <p class="mt-2 text-green-400">FREE</p>
                </div>

            </div>

            <!-- CARD 3 -->
            <div class="bg-[#15151D] rounded-2xl overflow-hidden hover:scale-105 transition">

                <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee"
                     class="h-40 w-full object-cover">

                <div class="p-4">
                    <p class="font-medium">Central Amphitheater</p>
                    <p class="text-xs text-gray-400">Live Music</p>
                    <p class="mt-2 text-purple-400">Explore →</p>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection