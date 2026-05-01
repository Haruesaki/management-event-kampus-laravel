<x-app-layout>
    <div class="p-8 text-white min-h-screen" style="background-color: #121214;">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-purple-400 text-xs font-bold tracking-widest uppercase mb-1">Management</h2>
                <h1 class="text-4xl font-bold">Curated Events</h1>
            </div>
            <button class="px-5 py-2.5 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg text-sm font-semibold shadow-[0_0_15px_rgba(168,85,247,0.4)]">+ Create New Event</button>
        </div>

        <div class="grid grid-cols-3 gap-8">
            <!-- Left List -->
            <div class="col-span-2">
                <!-- Tabs -->
                <div class="flex items-center justify-between border-b border-gray-800 mb-6">
                    <div class="flex space-x-6 text-sm">
                        <button class="py-3 border-b-2 border-purple-500 text-white font-semibold">All Events</button>
                        <button class="py-3 text-gray-400 hover:text-white">Upcoming</button>
                        <button class="py-3 text-gray-400 hover:text-white">Finished</button>
                    </div>
                    <div class="text-xs text-gray-500">Showing 24 Events</div>
                </div>

                <!-- Event Cards -->
                <div class="space-y-4">
                    <!-- Event 1 -->
                    <div class="bg-[#1c1c21] rounded-xl border border-gray-800 p-4 flex space-x-6 relative overflow-hidden">
                        <div class="absolute top-4 right-4 bg-gray-800 text-gray-300 text-[10px] px-2 py-1 rounded font-bold tracking-wider">UPCOMING</div>
                        <div class="w-48 h-32 bg-purple-900 rounded-lg bg-cover bg-center" style="background-image: url('/path/to/event1.jpg');"></div>
                        <div class="flex flex-col justify-between py-1 flex-1">
                            <div>
                                <h3 class="text-xl font-bold mb-2">Neo-Retro Synthwave Night</h3>
                                <div class="flex items-center text-xs text-gray-400 space-x-4">
                                    <span>📅 Oct 24, 2024</span>
                                    <span>📍 Main Auditorium</span>
                                    <span>👥 450/500 Quota</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-end">
                                <div class="flex items-center space-x-3">
                                    <span class="text-xl font-bold">$25.00</span>
                                    <span class="bg-pink-500/20 text-pink-400 text-[10px] px-2 py-1 rounded font-bold">PAID ENTRY</span>
                                </div>
                                <div class="flex space-x-3 text-gray-400">
                                    <button class="hover:text-white">✏️</button>
                                    <button class="hover:text-red-500">🗑</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Event 2 -->
                    <div class="bg-[#1c1c21] rounded-xl border border-gray-800 p-4 flex space-x-6 relative opacity-75">
                        <div class="absolute top-4 right-4 bg-gray-800 text-gray-500 text-[10px] px-2 py-1 rounded font-bold tracking-wider">FINISHED</div>
                        <div class="w-48 h-32 bg-gray-800 rounded-lg bg-cover bg-center" style="background-image: url('/path/to/event2.jpg');"></div>
                        <div class="flex flex-col justify-between py-1 flex-1">
                            <div>
                                <h3 class="text-xl font-bold text-gray-300 mb-2">Global Tech Symposium</h3>
                                <div class="flex items-center text-xs text-gray-500 space-x-4">
                                    <span>📅 Sep 12, 2024</span>
                                    <span>📍 Hall B</span>
                                    <span>👥 120/120 Quota</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-end">
                                <span class="text-xl font-bold text-gray-400">FREE</span>
                                <button class="text-gray-500 hover:text-white">👁</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar: Event Curator Form -->
            <div class="bg-[#1c1c21] rounded-2xl border border-gray-800 p-6 h-fit">
                <h3 class="text-xl font-bold flex items-center space-x-2 mb-6">
                    <span class="text-purple-400">✨</span> <span>Event Curator</span>
                </h3>
                
                <div class="border-2 border-dashed border-gray-700 rounded-xl p-8 flex flex-col items-center justify-center text-center mb-6">
                    <div class="text-gray-500 mb-2">🖼</div>
                    <p class="text-sm text-gray-400">Drop event poster or <span class="text-purple-400 cursor-pointer">browse</span></p>
                    <p class="text-[10px] text-gray-600 mt-1">RECOMMENDED: 1200X800PX</p>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Event Title</label>
                        <input type="text" placeholder="Enter a cinematic title..." class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-sm text-white focus:border-purple-500 outline-none">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Date</label>
                            <input type="date" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-sm text-white outline-none text-gray-400">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Location</label>
                            <input type="text" placeholder="Venue Hall" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-sm text-white outline-none">
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Quota</label>
                            <input type="number" placeholder="50" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-sm text-white outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Price ($)</label>
                            <input type="text" placeholder="0.00" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-sm text-white outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Payment</label>
                            <select class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-sm text-white outline-none appearance-none">
                                <option>Active</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-8">
                    <button class="bg-gradient-to-r from-purple-500 to-pink-500 py-3 rounded-lg font-bold text-sm">Publish Event</button>
                    <button class="bg-gray-800 hover:bg-gray-700 py-3 rounded-lg font-bold text-sm transition">Draft</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>