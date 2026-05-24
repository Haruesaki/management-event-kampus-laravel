@extends('panitia.layout')

@section('content')

<div class="p-8 text-white" x-data="{ search: '' }">

    <!-- HEADER & SEARCH -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
        <div>
            <h1 class="text-3xl font-semibold gradient-text">Arsip Event</h1>
            <p class="text-sm text-gray-400 mt-1">Daftar event yang telah selesai dan diarsipkan</p>
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

        <!-- CARD 1 (Arsip) -->
        <div class="glow-card glow-hover p-6 opacity-75 hover:opacity-100 transition" x-show="search === '' || 'Art Expo 2025'.toLowerCase().includes(search.toLowerCase())">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Art Expo 2025</h2>
                <span class="px-3 py-1 text-xs rounded-full bg-blue-500/20 text-blue-400">
                    ● Selesai
                </span>
            </div>

            <p class="text-gray-400 text-sm mb-5">
                Pameran seni digital modern tahun lalu.
            </p>

            <!-- STATS -->
            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <p class="text-gray-400 text-xs">Peserta</p>
                    <p class="text-xl font-bold">500</p>
                </div>
                <div>
                    <p class="text-gray-400 text-xs">Pendapatan</p>
                    <p class="text-xl font-bold">$18,000</p>
                </div>
            </div>

            <!-- ACTION -->
            <div class="space-y-2">
                <a href="#" class="block w-full text-center py-2 rounded-lg text-sm btn-glow">
                    Detail Event
                </a>

                <button class="w-full py-2 rounded-lg text-sm bg-purple-500/10 text-purple-400 border border-purple-500/20 hover:bg-purple-500/20 transition">
                    Kembalikan dari Arsip
                </button>
            </div>

        </div>

        <!-- CARD 2 (Arsip) -->
        <div class="glow-card glow-hover p-6 opacity-75 hover:opacity-100 transition" x-show="search === '' || 'Workshop UI/UX'.toLowerCase().includes(search.toLowerCase())">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Workshop UI/UX</h2>
                <span class="px-3 py-1 text-xs rounded-full bg-blue-500/20 text-blue-400">
                    ● Selesai
                </span>
            </div>

            <p class="text-gray-400 text-sm mb-5">
                Pelatihan intensif desain antarmuka pengguna.
            </p>

            <!-- STATS -->
            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <p class="text-gray-400 text-xs">Peserta</p>
                    <p class="text-xl font-bold">45</p>
                </div>
                <div>
                    <p class="text-gray-400 text-xs">Pendapatan</p>
                    <p class="text-xl font-bold">$1,200</p>
                </div>
            </div>

            <!-- ACTION -->
            <div class="space-y-2">
                <a href="#" class="block w-full text-center py-2 rounded-lg text-sm btn-glow">
                    Detail Event
                </a>

                <button class="w-full py-2 rounded-lg text-sm bg-purple-500/10 text-purple-400 border border-purple-500/20 hover:bg-purple-500/20 transition">
                    Kembalikan dari Arsip
                </button>
            </div>

        </div>

    </div>

</div>

@endsection
