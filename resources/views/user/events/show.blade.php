@extends('user.layouts.app')
@section('title', $event->title)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/user/events.css') }}">
@endpush

@section('content')

{{-- Bleed-out wrapper --}}
<div class="event-detail-wrap">

    {{-- Back Button --}}
    <a href="{{ route('events.index') }}" class="ed-back-btn">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Back to Discovery
    </a>

    {{-- Hero Image --}}
    <div class="ed-hero">
        @if($event->poster_url)
            <img src="{{ asset($event->poster_url) }}" alt="{{ $event->title }}">
        @else
            <div class="ed-hero-placeholder">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="0.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                </svg>
            </div>
        @endif
        <div class="ed-hero-overlay"></div>
    </div>

    {{-- Body --}}
    <div class="ed-body">

        {{-- Category --}}
        <div class="ed-meta-bar">
            <span class="ed-cat-badge">{{ strtoupper($event->category) }}</span>
        </div>

        {{-- Title --}}
        @php
            $words = explode(' ', $event->title);
            $half  = ceil(count($words) / 2);
            $line1 = implode(' ', array_slice($words, 0, $half));
            $line2 = implode(' ', array_slice($words, $half));
        @endphp
        <h1 class="ed-title">
            {{ $line1 }}<br>
            <span>{{ $line2 }}</span>
        </h1>

        {{-- Info strip --}}
        <div class="ed-info-strip">
            <div class="ed-info-pill">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}
            </div>
            <div class="ed-info-pill">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                {{ $event->location }}
            </div>
            <div class="ed-info-pill">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Open: {{ $event->gates_open ?? '08:00 AM' }}
            </div>
        </div>

        {{-- Two-column --}}
        <div class="ed-cols">

            {{-- ── LEFT COLUMN ── --}}
            <div>

                {{-- About --}}
                <div class="ed-section-label">About Event</div>
                <div class="ed-about-text">
                    {!! nl2br(e($event->description)) !!}
                </div>

                {{-- Stats --}}
                <div class="ed-stats">
                    <div class="ed-stat">
                        <div class="ed-stat-val">{{ $event->duration ?? '2.5h' }}</div>
                        <div class="ed-stat-key">Duration</div>
                    </div>
                    <div class="ed-stat">
                        <div class="ed-stat-val">{{ $event->tickets->count() }}</div>
                        <div class="ed-stat-key">Ticket Types</div>
                    </div>
                </div>

                {{-- Featured Artists --}}
                <div class="ed-section-label">Organizer</div>
                <div class="ed-artists-row" style="margin-bottom:36px;">
                    <div class="ed-artist">
                        <div class="ed-artist-avatar">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="ed-artist-name">{{ $event->creator->name ?? 'Panitia Event' }}</div>
                            <div class="ed-artist-role">Official Organizer</div>
                        </div>
                    </div>
                </div>

            </div>{{-- /left --}}

            {{-- ── RIGHT SIDEBAR ── --}}
            <div class="ed-sidebar">

                {{-- Select Tickets Card --}}
                <div class="ed-ticket-card" x-data="{ selectedTicket: {{ $event->tickets->first()->id ?? 'null' }} }">
                    <div class="ed-ticket-card-title">Select Tickets</div>

                    <form action="{{ route('events.booking') }}" method="POST">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <input type="hidden" name="ticket_id" :value="selectedTicket">

                        @foreach($event->tickets as $index => $ticket)
                            <div class="ed-ticket-opt" 
                                 :class="{ 'selected': selectedTicket === {{ $ticket->id }} }" 
                                 @click="selectedTicket = {{ $ticket->id }}">
                                <div>
                                    <div class="ed-ticket-opt-name">{{ $ticket->name }}</div>
                                    <div class="ed-ticket-opt-desc">Kategori: {{ $ticket->type }} ({{ $ticket->quota }} Slot)</div>
                                </div>
                                <div class="ed-ticket-opt-price {{ $ticket->price == 0 ? 'free-price' : '' }}">
                                    {{ $ticket->price == 0 ? 'FREE' : 'Rp '.number_format($ticket->price, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach

                        @if($event->tickets->sum('quota') > 0)
                            <button type="submit" class="btn-complete" style="width:100%; border:none; cursor:pointer;">Complete Booking</button>
                        @else
                            <button type="button" class="btn-complete" style="width:100%; border:none; background: #333; cursor:not-allowed;" disabled>Sold Out</button>
                        @endif
                    </form>
                    
                    <div class="ed-secure-note">Secure Payment via Event Kampus</div>
                </div>

                {{-- Location Card --}}
                <div class="ed-location-card">
                    @if($event->google_maps_url)
                        <a href="{{ $event->google_maps_url }}" target="_blank" class="ed-map-area">
                            <div class="ed-map-pin"></div>
                            <div style="position:absolute; bottom:10px; right:10px; background:rgba(0,0,0,0.6); padding:4px 10px; border-radius:4px; font-size:10px; color:#fff;">View on Maps</div>
                        </a>
                    @else
                        <div class="ed-map-area">
                            <div class="ed-map-pin"></div>
                        </div>
                    @endif
                    <div class="ed-location-info">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div>
                            <div class="ed-location-name">{{ $event->location }}</div>
                            <div class="ed-location-addr">Event Venue</div>
                        </div>
                    </div>
                </div>

            </div>{{-- /sidebar --}}

        </div>{{-- /ed-cols --}}
    </div>{{-- /ed-body --}}
</div>{{-- /event-detail-wrap --}}

@push('scripts')
<script>
function selectTicket(el) {
    document.querySelectorAll('.ed-ticket-opt').forEach(o => o.classList.remove('selected'));
    el.classList.add('selected');
}
</script>
@endpush

@endsection
