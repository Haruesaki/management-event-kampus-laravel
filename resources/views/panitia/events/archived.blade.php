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

        <div class="col-span-full py-20 text-center" style="background: var(--bg-card); border-radius: 24px; border: 1px dashed var(--border);">
            <svg style="width:48px; height:48px; color: var(--text-3); margin: 0 auto 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
            </svg>
            <h3 style="color: #fff; font-size: 18px; font-weight: 700;">Belum Ada Arsip Event</h3>
            <p style="color: var(--text-3); font-size: 14px; margin-top: 8px;">Event yang telah selesai atau Anda tutup akan muncul di sini.</p>
        </div>

    </div>

</div>

@endsection
