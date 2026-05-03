@extends('panitia.layout')

@section('content')

<div class="p-8 bg-gradient-to-br from-[#0B0B0F] via-[#12121A] to-[#0B0B0F] min-h-screen text-white">

    <!-- HEADER -->
    <div class="mb-8">
        <p class="text-xs text-purple-400 tracking-widest mb-1">PRODUCTION STUDIO</p>
        <h1 class="text-3xl font-semibold">Create New Production</h1>
        <p class="text-gray-400 text-sm mt-1">Craft your next standout experience with precision and style.</p>
    </div>

    <!-- MAIN GRID -->
    <div class="grid grid-cols-3 gap-8">

        <!-- LEFT LABEL -->
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

        <!-- RIGHT CONTENT -->
        <div class="col-span-2 space-y-10">

            <!-- EVENT IDENTITY -->
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

            <!-- TIME & PLACE -->
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

            <!-- TICKETS -->
            <div class="space-y-4">

                <div id="ticket-list" class="space-y-3">
                    <div class="bg-[#15151D] p-4 rounded-xl border border-[#1c1c24] flex justify-between items-center">
                        <div>
                            <p class="font-medium">Standard Tier</p>
                            <p class="text-xs text-gray-400">Qty: 200</p>
                        </div>
                        <p>$50</p>
                    </div>
                    <div class="bg-[#15151D] p-4 rounded-xl border border-[#1c1c24] flex justify-between items-center">
                        <div>
                            <p class="font-medium">Premium Tier</p>
                            <p class="text-xs text-gray-400">Qty: 50</p>
                        </div>
                        <p>$150</p>
                    </div>
                </div>

                <button onclick="addTicketTier()" class="w-full border border-dashed border-purple-500 text-purple-400 py-2 rounded-xl hover:bg-purple-500/10 transition">
                    + Add Ticket Tier
                </button>

            </div>

            <!-- NARRATIVE -->
            <textarea rows="4" placeholder="Describe your event..."
                class="w-full bg-[#15151D] p-4 rounded-xl border border-[#1c1c24] outline-none"></textarea>

            <!-- ACTION -->
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

<!-- MODAL Add Ticket Tier -->
<div id="ticket-modal" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 hidden">
    <div class="bg-[#15151D] border border-[#2a2a35] rounded-2xl p-6 w-full max-w-md space-y-4">
        <h2 class="text-white text-lg font-semibold">Add Ticket Tier</h2>

        <input id="tier-name" type="text" placeholder="Tier Name (e.g. VIP)"
            class="w-full bg-[#0B0B0F] p-3 rounded-lg border border-[#1c1c24] text-white outline-none focus:ring-2 focus:ring-purple-500" />

        <input id="tier-qty" type="number" placeholder="Quantity"
            class="w-full bg-[#0B0B0F] p-3 rounded-lg border border-[#1c1c24] text-white outline-none focus:ring-2 focus:ring-purple-500" />

        <input id="tier-price" type="number" placeholder="Price (e.g. 100)"
            class="w-full bg-[#0B0B0F] p-3 rounded-lg border border-[#1c1c24] text-white outline-none focus:ring-2 focus:ring-purple-500" />

        <div class="flex justify-end gap-3 pt-2">
            <button onclick="closeModal()" class="px-4 py-2 rounded-lg bg-[#1c1c24] hover:bg-[#2a2a35] text-white transition">
                Cancel
            </button>
            <button onclick="saveTicketTier()" class="px-4 py-2 rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 text-white hover:scale-105 transition">
                Add Tier
            </button>
        </div>
    </div>
</div>

<script>
    function addTicketTier() {
        document.getElementById('ticket-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('ticket-modal').classList.add('hidden');
        document.getElementById('tier-name').value = '';
        document.getElementById('tier-qty').value = '';
        document.getElementById('tier-price').value = '';
    }

    function saveTicketTier() {
        const name  = document.getElementById('tier-name').value.trim();
        const qty   = document.getElementById('tier-qty').value.trim();
        const price = document.getElementById('tier-price').value.trim();

        if (!name || !qty || !price) {
            alert('Semua field harus diisi!');
            return;
        }

        const ticketList = document.getElementById('ticket-list');

        const newTier = document.createElement('div');
        newTier.className = 'bg-[#15151D] p-4 rounded-xl border border-[#1c1c24] flex justify-between items-center';
        newTier.innerHTML = `
            <div>
                <p class="font-medium">${name}</p>
                <p class="text-xs text-gray-400">Qty: ${qty}</p>
            </div>
            <p>$${price}</p>
        `;

        ticketList.appendChild(newTier);
        closeModal();
    }
</script>

@endsection