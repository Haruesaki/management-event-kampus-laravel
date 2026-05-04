@extends('panitia.layout')

@section('content')

<div class="p-8 bg-gradient-to-br from-[#0B0B0F] via-[#12121A] to-[#0B0B0F] min-h-screen text-white">

    
    <div class="mb-8">
        <p class="text-xs text-purple-400 tracking-widest mb-1">PRODUCTION STUDIO</p>
        <h1 class="text-3xl font-semibold">Create New Production</h1>
        <p class="text-gray-400 text-sm mt-1">Craft your next standout experience with precision and style.</p>
    </div>

    
    <div class="grid grid-cols-3 gap-8">

       
        <div class="space-y-12 text-sm text-gray-400">

            <div>
                <p class="text-white font-medium mb-1">Event Identity</p>
                <p>Establish visual and key attributes. Ensure coherence across all touchpoints.</p>
            </div>

            <div>
                <p class="text-white font-medium mb-1">Time & Place</p>
                <p>Define the schedule and location for your event.</p>
            </div>

            <div>
                <p class="text-white font-medium mb-1">Access & Pricing</p>
                <p>Set ticket tiers and availability.</p>
            </div>

            <div>
                <p class="text-white font-medium mb-1">Narrative</p>
                <p>Tell the story behind your event.</p>
            </div>

        </div>

        
        <div class="col-span-2 space-y-10">

            
            <div class="grid grid-cols-2 gap-6">

               
                <div class="border border-dashed border-[#2a2a35] rounded-2xl h-56 flex items-center justify-center bg-[#15151D] hover:bg-[#1a1a25] transition">
                    <p class="text-gray-500 text-sm">Upload Event Poster</p>
                </div>

                
                <div class="space-y-4">
                    <input type="text" placeholder="Event Name"
                        class="w-full bg-[#15151D] p-3 rounded-lg outline-none border border-[#1c1c24] focus:ring-2 focus:ring-purple-500" />

                    <input type="text" placeholder="Category"
                        class="w-full bg-[#15151D] p-3 rounded-lg outline-none border border-[#1c1c24]" />
                </div>

            </div>

            
            <div class="grid grid-cols-3 gap-4">

                <input type="datetime-local"
                    class="bg-[#15151D] p-3 rounded-lg border border-[#1c1c24]" />

                <input type="text" placeholder="Doors Open"
                    class="bg-[#15151D] p-3 rounded-lg border border-[#1c1c24]" />

                <input type="text" placeholder="Duration"
                    class="bg-[#15151D] p-3 rounded-lg border border-[#1c1c24]" />

                <input type="text" placeholder="Search Venue Address..."
                    class="col-span-3 bg-[#15151D] p-3 rounded-lg border border-[#1c1c24]" />

                
                <div class="col-span-3 h-48 rounded-xl bg-gradient-to-r from-purple-500/20 to-pink-500/20 flex items-center justify-center">
                    <p class="text-gray-400 text-sm">Map Preview</p>
                </div>

            </div>

            
            <div class="space-y-4">

                <div class="bg-[#15151D] p-4 rounded-xl border border-[#1c1c24] flex justify-between">
                    <div>
                        <p class="font-medium">Standard Tier</p>
                        <p class="text-xs text-gray-400">Qty: 200</p>
                    </div>
                    <p>$50</p>
                </div>

                <div class="bg-[#15151D] p-4 rounded-xl border border-[#1c1c24] flex justify-between">
                    <div>
                        <p class="font-medium">Premium Tier</p>
                        <p class="text-xs text-gray-400">Qty: 50</p>
                    </div>
                    <p>$150</p>
                </div>

                <button class="w-full border border-dashed border-purple-500 text-purple-400 py-2 rounded-xl hover:bg-purple-500/10 transition">
                    + Add Ticket Tier
                </button>

            </div>

           
            <textarea rows="4" placeholder="Describe your event..."
                class="w-full bg-[#15151D] p-4 rounded-xl border border-[#1c1c24] outline-none"></textarea>

           
            <div class="flex justify-end gap-4">

                <button class="px-6 py-2 rounded-lg bg-[#1c1c24] hover:bg-[#2a2a35] transition">
                    Save as Draft
                </button>

                <button class="px-6 py-2 rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 hover:scale-105 transition">
                    Launch Production
                </button>

            </div>

        </div>

    </div>

</div>

@endsection