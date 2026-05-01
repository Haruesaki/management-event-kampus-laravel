<x-app-layout>
    <div class="p-8 text-white min-h-screen" style="background-color: #121214;">
        <h1 class="text-4xl font-bold mb-2">Bulk Account Removal</h1>
        <p class="text-gray-400 mb-10 w-2/3">Streamline your administrative workflow. Import Excel or CSV files to decommission multiple student and staff accounts simultaneously.</p>

        <div class="grid grid-cols-2 gap-8">
            <!-- Left Panel -->
            <div class="space-y-6">
                <!-- Upload Area -->
                <div class="border-2 border-dashed border-gray-700 bg-[#1c1c21] rounded-xl p-10 flex flex-col items-center justify-center text-center hover:border-purple-500 transition">
                    <div class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center mb-4 text-purple-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Import Removal List</h3>
                    <p class="text-sm text-gray-400 mb-6">Drag and drop your <span class="text-white">.xlsx</span> or <span class="text-white">.csv</span> file here to begin the parsing process.</p>
                    <button class="px-6 py-2 border border-gray-600 rounded-full text-sm hover:bg-gray-800 transition">Select File</button>
                </div>

                <!-- Destructive Action Warning -->
                <div class="bg-red-950/20 border border-red-900/50 rounded-xl p-6 flex space-x-4">
                    <div class="text-red-500">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-red-400 font-bold mb-2">Destructive Action</h3>
                        <p class="text-xs text-red-400/80 leading-relaxed">Deleting accounts is irreversible. This will purge all associated academic records, event logs, and metadata for both Panitia and Peserta roles. Ensure you have a local backup.</p>
                    </div>
                </div>

                <!-- Checklist -->
                <div class="bg-[#1c1c21] rounded-xl border border-gray-800 p-6">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Requirement Checklist</h3>
                    <ul class="space-y-3 text-sm text-gray-300">
                        <li class="flex items-center space-x-2"><span class="text-purple-400">✓</span> <span>Column A: Unique User ID (NIM/NIP)</span></li>
                        <li class="flex items-center space-x-2"><span class="text-purple-400">✓</span> <span>Valid Role: Panitia or Peserta only</span></li>
                        <li class="flex items-center space-x-2"><span class="text-purple-400">✓</span> <span>Maximum 500 records per batch</span></li>
                    </ul>
                </div>
            </div>

            <!-- Right Panel (Queue) -->
            <div class="bg-[#1c1c21] rounded-xl border border-gray-800 p-6 flex flex-col h-full">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-xl font-bold">Removal Queue</h2>
                        <p class="text-xs text-gray-400">5 accounts detected in last_import.csv</p>
                    </div>
                    <span class="text-[10px] tracking-wider text-gray-500 uppercase">Pending Verification</span>
                </div>

                <div class="flex-1 space-y-4 overflow-y-auto">
                    <!-- Queue Item -->
                    <div class="flex justify-between items-center p-3 bg-gray-900/50 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <div class="w-10 h-10 bg-gray-700 rounded-full"></div>
                                <div class="absolute -bottom-1 -right-1 bg-red-500 rounded-full w-4 h-4 flex items-center justify-center text-[10px]">×</div>
                            </div>
                            <div>
                                <div class="font-semibold text-sm">Aditya Pratama</div>
                                <div class="text-[10px] text-gray-500">NIM: 2021081024 • Batch 2021</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-[10px] font-bold tracking-wider text-pink-500">PESERTA</span>
                            <button class="text-gray-500 hover:text-red-500">🗑</button>
                        </div>
                    </div>
                    <!-- Ulangi item di atas sesuai data -->
                </div>

                <div class="mt-6 pt-6 border-t border-gray-800 flex items-center justify-between">
                    <label class="flex items-center space-x-2 text-sm text-gray-400">
                        <input type="checkbox" class="rounded bg-gray-800 border-gray-700 text-pink-500 focus:ring-pink-500">
                        <span>I confirm these 5 accounts are correct for deletion.</span>
                    </label>
                    <button class="px-6 py-3 bg-gradient-to-r from-red-600 to-pink-600 rounded-lg font-bold shadow-[0_0_15px_rgba(225,29,72,0.4)]">Execute Batch Delete</button>
                </div>
            </div>
        </div>

        <!-- Footer Stats -->
        <div class="grid grid-cols-3 gap-6 mt-8 pt-8 border-t border-gray-800/50">
            <div class="border-l-2 border-purple-500 pl-4">
                <div class="text-[10px] text-gray-500 uppercase tracking-widest mb-1">Total Deletion Capacity</div>
                <div class="text-2xl font-bold">2,500 <span class="text-sm text-gray-500 font-normal">per day</span></div>
            </div>
            <div class="border-l-2 border-pink-500 pl-4">
                <div class="text-[10px] text-gray-500 uppercase tracking-widest mb-1">Deleted This Month</div>
                <div class="text-2xl font-bold">412 <span class="text-sm text-gray-500 font-normal">users purged</span></div>
            </div>
            <div class="border-l-2 border-red-500 pl-4">
                <div class="text-[10px] text-gray-500 uppercase tracking-widest mb-1">Recovery Window</div>
                <div class="text-2xl font-bold">0Hr <span class="text-sm text-gray-500 font-normal">Permanent</span></div>
            </div>
        </div>
    </div>
</x-app-layout>