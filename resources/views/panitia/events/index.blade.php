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

        @forelse($events as $event)
        @php
            $today = \Carbon\Carbon::today();
            $eventDate = \Carbon\Carbon::parse($event->event_date);
            $diffInDays = $today->diffInDays($eventDate, false);
            
            if ($event->is_closed) {
                $statusLabel = 'Selesai';
                $statusClass = 'bg-red-500/20 text-red-400';
            } elseif ($diffInDays <= 14) {
                $statusLabel = 'Aktif';
                $statusClass = 'bg-green-500/20 text-green-400';
            } else {
                $statusLabel = 'Mendatang';
                $statusClass = 'bg-yellow-500/20 text-yellow-400';
            }
        @endphp
        <!-- CARD -->
        <div class="glow-card glow-hover p-6" x-show="search === '' || '{{ strtolower($event->title) }}'.includes(search.toLowerCase())">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">{{ $event->title }}</h2>
                <span class="px-3 py-1 text-xs rounded-full {{ $statusClass }}">
                    ● {{ $statusLabel }}
                </span>
            </div>

            <p class="text-gray-400 text-sm mb-5 line-clamp-2">
                {{ $event->description }}
            </p>

            <!-- STATS -->
            <div class="space-y-4 mb-6">
                <p class="text-gray-400 text-[10px] uppercase tracking-wider font-bold">Rincian Tiket & Kuota</p>
                <div class="grid grid-cols-1 gap-3">
                    @foreach($event->tickets as $ticket)
                        <div class="space-y-2 bg-white/5 p-3 rounded-xl border border-white/5">
                            <!-- Nama & Kategori -->
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-semibold text-gray-200 truncate pr-2">{{ $ticket->name }}</span>
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold uppercase {{ $ticket->type === 'Gratis' ? 'bg-green-500/20 text-green-400' : 'bg-purple-500/20 text-purple-400' }}">
                                    {{ $ticket->type }}
                                </span>
                            </div>
                            
                            <!-- Slot & Bar -->
                            <div class="space-y-1.5">
                                <div class="flex justify-between text-[10px]">
                                    <span class="text-gray-400">Ketersediaan Slot</span>
                                    <span class="text-white font-bold">{{ $ticket->quota }} Tersedia</span>
                                </div>
                                <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full {{ $ticket->type === 'Gratis' ? 'bg-green-500' : 'bg-purple-500' }}" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- ACTION -->
            <div class="space-y-2">
                <a href="{{ route('panitia.event.edit', $event->id) }}" class="block w-full py-2 text-center rounded-lg text-sm btn-glow">
                    Kelola
                </a>
                @if(!$event->is_closed)
                    <form action="{{ route('panitia.event.close', $event->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menutup event ini?');">
                        @csrf
                        <button type="submit" class="w-full py-2 rounded-lg text-sm bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500/20 transition">
                            Tutup Event
                        </button>
                    </form>
                @endif
            </div>

        </div>
        @empty
        <div class="col-span-full py-20 text-center">
            <p class="text-gray-500">Belum ada event yang dipublikasikan.</p>
            <a href="{{ route('panitia.event.create') }}" class="text-purple-400 hover:underline mt-2 inline-block">Mulai buat event pertama Anda</a>
        </div>
        @endforelse

    </div>

</div>

@endsection
