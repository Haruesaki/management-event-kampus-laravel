<x-app-layout>
    <div class="p-8 text-white min-h-screen relative" style="background-color: #121214;">
        <!-- Header -->
        <div class="flex justify-between items-start mb-10">
            <div>
                <h1 class="text-5xl font-extrabold tracking-tight mb-4">Identity <span class="text-purple-400 italic font-serif">Matrix</span></h1>
                <p class="text-gray-400 text-sm w-2/3 leading-relaxed">Orchestrate campus roles and permissions from a single atmospheric nexus. Managing 2,491 active digital entities across the network.</p>
            </div>
            <div class="flex space-x-4">
                <div class="bg-[#1c1c21] p-4 rounded-xl border border-gray-800 text-center w-32">
                    <div class="text-[10px] text-purple-400 uppercase tracking-widest font-bold mb-1">Network Health</div>
                    <div class="text-2xl font-bold">99.2<span class="text-sm">%</span></div>
                </div>
                <div class="bg-gradient-to-b from-purple-500/20 to-transparent p-4 rounded-xl border border-purple-500/30 text-center w-32">
                    <div class="text-[10px] text-pink-400 uppercase tracking-widest font-bold mb-1">Growth Metric</div>
                    <div class="text-2xl font-bold text-white">+124</div>
                    <div class="text-[10px] text-gray-500">Active this wk</div>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex space-x-2 bg-[#1c1c21] p-1 rounded-full border border-gray-800">
                <button class="px-6 py-2 bg-gray-800 text-white text-sm rounded-full font-medium">All Roles</button>
                <button class="px-6 py-2 text-gray-400 hover:text-white text-sm rounded-full font-medium transition">Admin</button>
                <button class="px-6 py-2 text-gray-400 hover:text-white text-sm rounded-full font-medium transition">Panitia</button>
                <button class="px-6 py-2 text-gray-400 hover:text-white text-sm rounded-full font-medium transition">Peserta</button>
            </div>
            <button class="px-6 py-2.5 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full text-sm font-bold shadow-[0_0_15px_rgba(168,85,247,0.3)]">
                <span class="mr-2">+</span> Onboard New User
            </button>
        </div>

        <!-- Table/List Area -->
        <div class="bg-[#1c1c21] rounded-2xl border border-gray-800 overflow-hidden">
            <div class="grid grid-cols-4 px-6 py-4 border-b border-gray-800 text-[10px] font-bold text-gray-500 uppercase tracking-wider">
                <div class="col-span-1">Entity Name</div>
                <div>Current Role</div>
                <div>Access Status</div>
                <div class="text-right">Operational Actions</div>
            </div>
            
            <div class="divide-y divide-gray-800/50">
                <!-- User 1 -->
                <div class="grid grid-cols-4 items-center px-6 py-4 hover:bg-gray-800/30 transition">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded bg-purple-900/50 flex items-center justify-center text-purple-300 font-bold text-sm">BS</div>
                        <div>
                            <div class="font-bold text-sm">Bastian Setya</div>
                            <div class="text-[10px] text-gray-500">bastian.s@campus.edu</div>
                        </div>
                    </div>
                    <div><span class="bg-gray-800 text-gray-300 text-[10px] px-2 py-1 rounded font-bold tracking-wider">ADMIN</span></div>
                    <div class="flex items-center text-sm text-gray-300"><span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span> Active</div>
                    <div class="flex justify-end space-x-3 text-gray-500">
                        <button class="hover:text-white">✏️</button>
                        <button class="hover:text-white">🚫</button>
                        <button class="hover:text-red-500">🗑</button>
                    </div>
                </div>

                <!-- User 2 (Selected Example) -->
                <div class="grid grid-cols-4 items-center px-6 py-4 bg-gray-800/50 relative border-l-2 border-purple-500">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded bg-gray-700 bg-cover bg-center"></div>
                        <div>
                            <div class="font-bold text-sm">Lestari Ananta</div>
                            <div class="text-[10px] text-gray-500">lestari.a@event.com</div>
                        </div>
                    </div>
                    <div><span class="bg-pink-900/30 text-pink-400 border border-pink-900/50 text-[10px] px-2 py-1 rounded font-bold tracking-wider">PANITIA</span></div>
                    <div class="flex items-center text-sm text-gray-300"><span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span> Active</div>
                    <div class="flex justify-end space-x-3 text-gray-500">
                        <button class="text-white">✏️</button>
                        <button class="hover:text-white">🚫</button>
                        <button class="hover:text-red-500">🗑</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 text-[10px] text-gray-500">Showing 1 to 4 of 2,491 identities</div>

        <!-- Selected Insight Popover / Overlay (Absolute positioned over the bottom right) -->
        <div class="absolute bottom-12 right-12 w-72 bg-[#1c1c21] rounded-xl border border-purple-500/50 p-5 shadow-2xl shadow-purple-900/20">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-[10px] font-bold text-purple-400 uppercase tracking-widest">Selected Insight</h3>
                <button class="text-gray-500 hover:text-white">×</button>
            </div>
            <div class="flex items-center space-x-4 mb-6">
                <div class="w-12 h-12 rounded-full bg-gray-700 bg-cover"></div>
                <div>
                    <div class="font-bold">Lestari Ananta</div>
                    <div class="text-xs text-pink-400">Active Panitia</div>
                </div>
            </div>
            <div class="space-y-3 text-sm mb-6">
                <div class="flex justify-between border-b border-gray-800 pb-2">
                    <span class="text-gray-500">Last Login</span>
                    <span>2 Mins ago</span>
                </div>
                <div class="flex justify-between border-b border-gray-800 pb-2">
                    <span class="text-gray-500">Auth Level</span>
                    <span>Tier 2 Manager</span>
                </div>
            </div>
            <div>
                <div class="w-full bg-gray-800 h-1.5 rounded-full mb-1">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-1.5 rounded-full w-[85%]"></div>
                </div>
                <div class="text-right text-[10px] text-gray-500">Quota Usage: 85%</div>
            </div>
        </div>
    </div>
</x-app-layout>