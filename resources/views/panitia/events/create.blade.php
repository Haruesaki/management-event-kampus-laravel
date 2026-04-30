@extends('panitia.layout')

@section('title', 'Create New Production')
@section('subtitle', 'PRODUCTION STUDIO')

@section('content')

<div class="grid grid-cols-3 gap-8">

    <!-- LEFT INFO -->
    <div class="space-y-10 text-sm text-gray-400">

        <div>
            <h3 class="text-white font-semibold mb-2">Event Identity</h3>
            <p>The visual anchor of your production. Ensure the poster captures the atmosphere essence of the night.</p>
        </div>

        <div>
            <h3 class="text-white font-semibold mb-2">Time & Place</h3>
            <p>Where and when the curtain rises. Coordinate the logistics of your nocturnal venue.</p>
        </div>

        <div>
            <h3 class="text-white font-semibold mb-2">Access & Pricing</h3>
            <p>Define the tiers of exclusivity. Manage availability and value for your attendees.</p>
        </div>

        <div>
            <h3 class="text-white font-semibold mb-2">Narrative</h3>
            <p>Tell the story. Use evocative language to describe the atmosphere, the talent, and the mystery.</p>
        </div>

    </div>

    <!-- RIGHT FORM -->
    <div class="col-span-2 space-y-6">

        <!-- POSTER -->
        <div class="glow-card p-6 border-dashed border border-[#2a2a35] text-center">
            <p class="text-gray-500 text-sm">Upload Event Poster</p>
        </div>

        <!-- INPUT ROW -->
        <div class="grid grid-cols-2 gap-4">
            <input type="text" placeholder="Event Name" class="input-dark">
            <input type="text" placeholder="Category" class="input-dark">
        </div>

        <!-- DATE -->
        <div class="grid grid-cols-3 gap-4">
            <input type="date" class="input-dark">
            <input type="time" class="input-dark">
            <input type="text" placeholder="Duration" class="input-dark">
        </div>

        <!-- LOCATION -->
        <input type="text" placeholder="Search Venue Address..." class="input-dark w-full">

        <div class="glow-card h-40 flex items-center justify-center text-gray-500">
            Map Preview
        </div>

        <!-- TICKET -->
        <div class="space-y-3">
            <div class="glow-card p-4 flex justify-between items-center">
                <div>
                    <p class="text-white">Standard Tier</p>
                    <p class="text-xs text-gray-400">Quota 200</p>
                </div>
                <p>$25</p>
            </div>

            <div class="glow-card p-4 flex justify-between items-center">
                <div>
                    <p class="text-white">Premium Tier</p>
                    <p class="text-xs text-gray-400">Quota 50</p>
                </div>
                <p>$50</p>
            </div>
        </div>

        <!-- NARRATIVE -->
        <textarea class="input-dark w-full h-32" placeholder="Write your story..."></textarea>

        <!-- ACTION -->
        <div class="flex justify-end gap-4">
            <button class="px-6 py-2 rounded-lg bg-[#1c1c24]">Save Draft</button>
            <button class="create-btn px-6 py-2">Launch Production</button>
        </div>

    </div>

</div>

@endsection