@extends('panitia.layout')

@section('content')

<div class="p-8 text-white" x-data="{ search: '' }">

    <!-- HEADER & SEARCH -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
        <div>
            <h1 class="text-3xl font-semibold gradient-text">Event Berlangsung</h1>
            <p class="text-sm text-gray-400 mt-1">Pantau dan kelola event aktif Anda</p>
        </div>

        <!-- SEARCH BAR -->
        <div class="relative w-full md:w-80">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input 
                type="text" 
                x-model="search"
                placeholder="Cari nama event..." 
                class="block w-full pl-10 pr-10 py-2.5 bg-[#15151D] border border-[#1c1c24] rounded-xl text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
            >
            <!-- Tombol Silang (Clear) -->
            <button 
                x-show="search.length > 0" 
                @click="search = ''"
                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-white transition-colors"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- CARD - Hanya menampilkan yang Aktif -->
        <div class="glow-card glow-hover p-6" x-show="search === '' || 'Neon Masquerade'.toLowerCase().includes(search.toLowerCase())">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Neon Masquerade</h2>
                <span class="px-3 py-1 text-xs rounded-full bg-green-500/20 text-green-400">
                    ● Aktif
                </span>
            </div>

            <p class="text-gray-400 text-sm mb-5">
                Festival malam dengan musik, seni & visual imersif.
            </p>

            <!-- STATS -->
            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <p class="text-gray-400 text-xs">Peserta</p>
                    <p class="text-xl font-bold">342</p>
                </div>
                <div>
                    <p class="text-gray-400 text-xs">Pendapatan</p>
                    <p class="text-xl font-bold">$12,450</p>
                </div>
            </div>

            <!-- PROGRESS -->
            <div class="mb-5">
                <div class="flex justify-between text-xs text-gray-400 mb-1">
                    <span>Tiket Terjual</span>
                    <span>84%</span>
                </div>

                <div class="w-full h-2 bg-[#1c1c24] rounded overflow-hidden">
                    <div class="h-2 bg-gradient-to-r from-purple-500 to-pink-500 animate-pulse"
                         style="width:84%">
                    </div>
                </div>
            </div>

            <!-- ACTION -->
            <div class="space-y-2">
                <button class="w-full py-2 rounded-lg text-sm btn-glow">
                    Kelola
                </button>
                <button class="w-full py-2 rounded-lg text-sm bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500/20 transition">
                    Tutup Event
                </button>
            </div>

        </div>

    </div>

</div>

@endsection
