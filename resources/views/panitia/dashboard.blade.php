@extends('panitia.layout')

@section('title', 'Dashboard')
@section('subtitle', 'Kelola event Anda')

@section('content')

<div class="panitia-page">

    {{-- STATS --}}
    <div class="stats-row">
        <div class="stat-card">
            <p class="stat-label">Total Event</p>
            <p class="stat-value">{{ $totalEvents }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Total Kuota</p>
            <p class="stat-value green">{{ number_format($totalQuota) }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Peserta Terdaftar</p>
            <p class="stat-value yellow">0</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Pendapatan</p>
            <p class="stat-value">Rp 0</p>
        </div>
    </div>

    {{-- CATEGORIES --}}
    <!-- ... (tetap sama) ... -->
{{-- YOUR EVENTS --}}
<div>
    <div class="section-row">
        <p class="section-title">Event Terbaru Anda</p>
    </div>
    <div class="events-grid">
        @forelse($latestEvents as $event)
        @php
            $today = \Carbon\Carbon::today();
            $eventDate = \Carbon\Carbon::parse($event->event_date);
            $diffInDays = $today->diffInDays($eventDate, false);

            if ($event->is_closed) {
                $statusLabel = 'Selesai';
                $statusClass = 'badge-preview'; // Merah/Gelap
                $statusText = 'Red'; // Custom class handling
            } elseif ($diffInDays <= 14) {
                $statusLabel = 'Aktif';
                $statusClass = 'badge-active'; // Hijau
            } else {
                $statusLabel = 'Mendatang';
                $statusClass = 'badge-open'; // Kuning
            }
        @endphp
        <div class="event-card">
            @if($event->poster_url)
                <img src="{{ asset($event->poster_url) }}" class="event-thumb" alt="Event">
            @else
                <div class="event-thumb-placeholder"></div>
            @endif
            <div class="event-info">
                <p class="event-name line-clamp-1">{{ $event->title }}</p>
                <p class="event-meta">{{ $event->category }}</p>
                <div class="event-footer">
                    <span class="event-price">
                        @php $minPrice = $event->tickets->min('price'); @endphp
                        {{ $minPrice == 0 ? 'GRATIS' : 'Rp '.number_format($minPrice, 0, ',', '.') }}
                    </span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $statusClass === 'badge-active' ? 'bg-green-500/20 text-green-400' : ($statusClass === 'badge-open' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-red-500/20 text-red-400') }}">
                        {{ $statusLabel }}
                    </span>
                </div>
            </div>
        </div>        @empty
...
            <div class="col-span-full py-10 text-center text-gray-500">
                Belum ada event yang dibuat. <a href="{{ route('panitia.event.create') }}" class="text-purple-400">Buat sekarang?</a>
            </div>
            @endforelse
        </div>
    </div>

</div>

@endsection
