@extends('panitia.layout')

@section('title', 'Dashboard')
@section('subtitle', 'Manage your event')

@section('content')

<div class="space-y-8">

    <!-- HERO (ambil dari user dashboard) -->
    <div class="relative rounded-2xl overflow-hidden glow-card">

        <img src="https://images.unsplash.com/photo-1511379938547-c1f69419868d"
             class="w-full h-56 object-cover opacity-40">

        <div class="absolute inset-0 p-8 flex flex-col justify-center">

            <p class="text-xs text-purple-400 tracking-widest mb-2">
                FEATURED EVENT
            </p>

            <h1 class="text-3xl font-bold">
                Dies Natalis <span class="neon-text">Concert 2026</span>
            </h1>

            <p class="text-gray-400 text-sm mt-2 max-w-xl">
                Experience an orchestral fusion and digital arts in one unforgettable night.
            </p>

            <div class="mt-4 flex gap-3">
                <a href="{{ route('panitia.events') }}" class="create-btn px-4 py-2 text-sm">
                    Manage Event
                </a>

                <button class="px-4 py-2 bg-[#1c1c24] rounded-lg text-sm">
                    View Details
                </button>
            </div>

        </div>
    </div>

    <!-- STATS (punya panitia) -->
    <div class="grid grid-cols-4 gap-6">

        <div class="glow-card p-5">
            <p class="text-gray-400 text-sm">Total Attendees</p>
            <p class="text-2xl font-bold mt-1">342</p>
        </div>

        <div class="glow-card p-5">
            <p class="text-gray-400 text-sm">Paid</p>
            <p class="text-2xl font-bold text-green-400 mt-1">280</p>
        </div>

        <div class="glow-card p-5">
            <p class="text-gray-400 text-sm">Pending</p>
            <p class="text-2xl font-bold text-yellow-400 mt-1">62</p>
        </div>

        <div class="glow-card p-5">
            <p class="text-gray-400 text-sm">Revenue</p>
            <p class="text-2xl font-bold mt-1">$12,450</p>
        </div>

    </div>

    <!-- CATEGORY (ambil dari user dashboard) -->
    <div>
        <div class="flex justify-between mb-3">
            <h2 class="text-sm text-gray-400">Explore Categories</h2>
        </div>

        <div class="grid grid-cols-4 gap-4">

            <div class="glow-card p-4 text-center hover:scale-105 transition">
                <p>Music</p>
            </div>

            <div class="glow-card p-4 text-center hover:scale-105 transition">
                <p>Seminar</p>
            </div>

            <div class="glow-card p-4 text-center hover:scale-105 transition">
                <p>Workshop</p>
            </div>

            <div class="glow-card p-4 text-center hover:scale-105 transition">
                <p>Sports</p>
            </div>

        </div>
    </div>

    <!-- UPCOMING EVENTS (user style tapi buat panitia) -->
    <div>

        <div class="flex justify-between mb-3">
            <h2 class="text-sm text-gray-400">Your Events</h2>
        </div>

        <div class="grid grid-cols-3 gap-6">

            <!-- CARD 1 -->
            <div class="glow-card overflow-hidden">

                <img src="https://images.unsplash.com/photo-1515169067865-5387ec356754"
                     class="h-40 w-full object-cover">

                <div class="p-4">
                    <h3 class="font-semibold">Tech Summit</h3>
                    <p class="text-xs text-gray-400">May 2026</p>

                    <div class="flex justify-between mt-3 text-sm">
                        <span>$25</span>
                        <span class="text-purple-400">Active</span>
                    </div>
                </div>

            </div>

            <!-- CARD 2 -->
            <div class="glow-card overflow-hidden">

                <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee"
                     class="h-40 w-full object-cover">

                <div class="p-4">
                    <h3 class="font-semibold">Canvas of Dreams</h3>
                    <p class="text-xs text-gray-400">Free Event</p>

                    <div class="flex justify-between mt-3 text-sm">
                        <span>FREE</span>
                        <span class="text-green-400">Open</span>
                    </div>
                </div>

            </div>

            <!-- CARD 3 -->
            <div class="glow-card overflow-hidden">

                <img src="https://images.unsplash.com/photo-1500534623283-312aade485b7"
                     class="h-40 w-full object-cover">

                <div class="p-4">
                    <h3 class="font-semibold">Central Amphitheater</h3>
                    <p class="text-xs text-gray-400">Live music</p>

                    <div class="flex justify-between mt-3 text-sm">
                        <span>Location</span>
                        <span class="text-pink-400">Preview</span>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- RECENT ATTENDEES (panitia control tetap ada) -->
    <div class="glow-card p-4">

        <h2 class="text-sm text-gray-400 mb-3">Recent Attendees</h2>

        <table class="w-full text-sm">
            <tr class="border-b border-[#1c1c24]">
                <td class="py-2">Aria Vance</td>
                <td class="text-yellow-400">Pending</td>
                <td class="text-right">
                    <button class="bg-green-500 px-3 py-1 rounded text-xs">Confirm</button>
                </td>
            </tr>

            <tr>
                <td class="py-2">Kaelen Moore</td>
                <td class="text-green-400">Paid</td>
                <td class="text-right">-</td>
            </tr>
        </table>

    </div>

</div>

@endsection