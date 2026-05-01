<x-app-layout>
    <div class="p-8 text-white min-h-screen" style="background-color: #121214;">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold mb-2">System Overview</h1>
                <p class="text-gray-400">Welcome back, Curator. Here is your nocturnal report.</p>
            </div>
            <div class="flex space-x-4">
                <button class="px-4 py-2 bg-gray-800 rounded-lg text-sm hover:bg-gray-700 transition">Download Report</button>
                <button class="px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg text-sm font-semibold shadow-[0_0_15px_rgba(168,85,247,0.4)]">+ New Operation</button>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-4 gap-6 mb-8">
            <div class="bg-[#1c1c21] p-6 rounded-xl border border-gray-800">
                <h3 class="text-gray-400 text-xs font-bold tracking-wider mb-2 uppercase">Total Users</h3>
                <div class="text-3xl font-bold mb-2">14,282</div>
                <div class="text-purple-400 text-xs">↗ +12.5% vs last month</div>
            </div>
            <div class="bg-[#1c1c21] p-6 rounded-xl border border-gray-800">
                <h3 class="text-gray-400 text-xs font-bold tracking-wider mb-2 uppercase">Active Events</h3>
                <div class="text-3xl font-bold mb-2">84</div>
                <div class="text-purple-400 text-xs">📅 12 starting today</div>
            </div>
            <div class="bg-[#1c1c21] p-6 rounded-xl border border-gray-800">
                <h3 class="text-gray-400 text-xs font-bold tracking-wider mb-2 uppercase">Pending Payments</h3>
                <div class="text-3xl font-bold mb-2">$12,450</div>
                <div class="text-pink-400 text-xs">🕒 Avg. 4.2 days overdue</div>
            </div>
            <div class="bg-gradient-to-br from-[#2a2a35] to-[#1c1c21] p-6 rounded-xl border border-gray-800">
                <h3 class="text-gray-400 text-xs font-bold tracking-wider mb-2 uppercase">System Health</h3>
                <div class="text-3xl font-bold mb-2 text-white">Optimal</div>
                <div class="text-gray-400 text-xs">✓ All nodes functional</div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-3 gap-6">
            <!-- Left Column -->
            <div class="col-span-2 space-y-6">
                <!-- Recent Registrations -->
                <div class="bg-[#1c1c21] rounded-xl border border-gray-800 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold">Recent Registrations</h2>
                        <a href="#" class="text-purple-400 text-sm hover:underline">View All</a>
                    </div>
                    <div class="space-y-4">
                        <!-- Item 1 -->
                        <div class="flex justify-between items-center p-3 hover:bg-gray-800/50 rounded-lg transition">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">JV</div>
                                <div>
                                    <div class="font-semibold">Julianna Velez</div>
                                    <div class="text-xs text-gray-400">M.S. Cybernetics • 2 mins ago</div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="px-2 py-1 text-[10px] font-bold tracking-wider rounded bg-gray-800 text-gray-300 border border-gray-700">VERIFIED</span>
                                <button class="text-gray-400 hover:text-white">⋮</button>
                            </div>
                        </div>
                        <!-- Item 2 -->
                        <div class="flex justify-between items-center p-3 hover:bg-gray-800/50 rounded-lg transition">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">MS</div>
                                <div>
                                    <div class="font-semibold">Marcus Sterling</div>
                                    <div class="text-xs text-gray-400">B.A. Digital Arts • 14 mins ago</div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="px-2 py-1 text-[10px] font-bold tracking-wider rounded bg-pink-500/10 text-pink-500 border border-pink-500/20">PENDING</span>
                                <button class="text-gray-400 hover:text-white">⋮</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Banner -->
                <div class="rounded-xl p-8 bg-gradient-to-r from-[#20152a] to-[#3a1a3a] border border-pink-900/30 relative overflow-hidden">
                    <div class="relative z-10">
                        <h2 class="text-2xl font-bold text-purple-300 mb-2">Automated Archiving</h2>
                        <p class="text-gray-300 text-sm w-2/3 mb-6">The nocturnal curator is scheduled to archive logs in 4 hours. Ensure all manual overrides are resolved.</p>
                        <button class="px-4 py-2 border border-purple-500 text-purple-300 rounded-full text-sm hover:bg-purple-500/20 transition">Review Schedule</button>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- System Insights -->
                <div class="bg-[#1c1c21] rounded-xl border border-gray-800 p-6">
                    <h2 class="text-xl font-bold mb-4">System Insights</h2>
                    <div class="mb-4">
                        <div class="text-xs text-gray-400 uppercase tracking-widest flex justify-end mb-2">Real-Time</div>
                        <h3 class="font-bold text-lg mb-2">Peak Activity Predicted</h3>
                        <p class="text-xs text-gray-400 mb-4">Engagement is expected to spike between 20:00 and 22:00 for the 'Midnight Hackathon'.</p>
                        <div class="w-full bg-gray-800 h-1 mt-4 rounded-full">
                            <div class="bg-purple-500 h-1 rounded-full w-2/3"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Live System Feed -->
                <div class="bg-[#0a0a0c] rounded-xl p-6 border border-gray-800/50">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-6">Live System Feed</h3>
                    <div class="space-y-6 border-l border-gray-800 ml-2">
                        <div class="relative pl-6">
                            <div class="absolute w-2 h-2 bg-purple-500 rounded-full -left-1 top-1"></div>
                            <p class="text-xs text-gray-300">API Endpoint 'v2/events' successfully scaled</p>
                            <p class="text-[10px] text-gray-500 mt-1">4s ago</p>
                        </div>
                        <div class="relative pl-6">
                            <div class="absolute w-2 h-2 bg-pink-500 rounded-full -left-1 top-1"></div>
                            <p class="text-xs text-gray-300">Failed login attempt - IP: 192.168.1.45</p>
                            <p class="text-[10px] text-gray-500 mt-1">12m ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>