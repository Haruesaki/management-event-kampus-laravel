@extends('user.layouts.app')
@section('title', $event['name'])

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
        @if(isset($event['thumbnail']) && $event['thumbnail'])
            <img src="{{ asset('storage/' . $event['thumbnail']) }}" alt="{{ $event['name'] }}">
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

        {{-- Category + Rating --}}
        <div class="ed-meta-bar">
            <span class="ed-cat-badge">{{ strtoupper($event['category']) }}</span>
            <div class="ed-rating">
                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                4.9 Rating
            </div>
        </div>

        {{-- Title --}}
        @php
            $words = explode(' ', $event['name']);
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
                {{ \Carbon\Carbon::parse($event['date'])->format('F d, Y') }}
            </div>
            <div class="ed-info-pill">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                {{ $event['venue'] }}, Main Campus
            </div>
            <div class="ed-info-pill">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ $event['time_start'] ?? '08:00 PM' }} – {{ $event['time_end'] ?? 'Late' }}
            </div>
        </div>

        {{-- Two-column --}}
        <div class="ed-cols">

            {{-- ── LEFT COLUMN ── --}}
            <div>

                {{-- About --}}
                <div class="ed-section-label">About Event</div>
                <div class="ed-about-text">
                    <p>Experience an incredible journey at <strong style="color:#e0d8f8">{{ $event['name'] }}</strong>.
                    This event brings together students, professionals, and enthusiasts to explore the amazing
                    world of {{ strtolower($event['category']) }}. Prepare for an engaging session filled with
                    insightful discussions, networking opportunities, and memorable moments.</p>
                    <br>
                    <p>Hosted at the prestigious <strong style="color:#e0d8f8">{{ $event['venue'] }}</strong>,
                    you'll enjoy state-of-the-art facilities and a welcoming atmosphere.
                    Don't miss out on this opportunity to connect with like-minded individuals and expand your horizons.</p>
                </div>

                {{-- Stats --}}
                <div class="ed-stats">
                    <div class="ed-stat">
                        <div class="ed-stat-val">2.5h</div>
                        <div class="ed-stat-key">Duration</div>
                    </div>
                    <div class="ed-stat">
                        <div class="ed-stat-val">18+</div>
                        <div class="ed-stat-key">Age Limit</div>
                    </div>
                    <div class="ed-stat">
                        <div class="ed-stat-val">VIP</div>
                        <div class="ed-stat-key">Available</div>
                    </div>
                    <div class="ed-stat">
                        <div class="ed-stat-val">4k+</div>
                        <div class="ed-stat-key">Capacity</div>
                    </div>
                </div>

                {{-- Featured Artists --}}
                <div class="ed-section-label">Featured Artists</div>
                <div class="ed-artists-row" style="margin-bottom:36px;">
                    @php
                        $artists = [
                            ['name' => 'Luna X',     'role' => 'Lead Synthesist'],
                            ['name' => 'Marcus Vane','role' => 'Electric Cello'],
                            ['name' => 'The Echo',   'role' => 'Vocalist'],
                        ];
                    @endphp
                    @foreach($artists as $artist)
                    <div class="ed-artist">
                        <div class="ed-artist-avatar">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="ed-artist-name">{{ $artist['name'] }}</div>
                            <div class="ed-artist-role">{{ $artist['role'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Event Schedule --}}
                <div class="ed-section-label">Event Schedule</div>
                <div class="ed-schedule">
                    @php
                        $schedule = [
                            ['time' => '07:00 PM', 'title' => 'Doors Open & Lounge Set',    'desc' => 'Welcome drinks and ambient atmospheric soundscapes by DJ Void.', 'active' => true],
                            ['time' => '08:30 PM', 'title' => 'Part I: The Awakening',       'desc' => 'A high-energy opening featuring visual mapping and the core ensemble.', 'active' => false],
                            ['time' => '10:00 PM', 'title' => 'Part II: Echoes of Eternity','desc' => 'The grand finale with full orchestral integration and laser light show.', 'active' => false],
                        ];
                    @endphp
                    @foreach($schedule as $item)
                    <div class="ed-sched-item">
                        <div style="position:relative;">
                            <div class="ed-sched-dot {{ $item['active'] ? 'active' : '' }} ed-sched-line"></div>
                        </div>
                        <div class="ed-sched-content">
                            <div class="ed-sched-time">{{ $item['time'] }}</div>
                            <div class="ed-sched-title">{{ $item['title'] }}</div>
                            <div class="ed-sched-desc">{{ $item['desc'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>{{-- /left --}}

            {{-- ── RIGHT SIDEBAR ── --}}
            <div class="ed-sidebar">

                {{-- Select Tickets Card --}}
                <div class="ed-ticket-card">
                    <div class="ed-ticket-card-title">Select Tickets</div>

                    @if(isset($event['price']) && $event['price'] == 0)
                        {{-- Free event --}}
                        <div class="ed-ticket-opt selected" onclick="selectTicket(this)">
                            <div>
                                <div class="ed-ticket-opt-name">General Admission</div>
                                <div class="ed-ticket-opt-desc">Free Entry</div>
                            </div>
                            <div class="ed-ticket-opt-price free-price">FREE</div>
                        </div>
                    @else
                        {{-- Paid event – three tiers --}}
                        @php $basePrice = $event['price'] ?? 25; @endphp
                        <div class="ed-ticket-opt selected" onclick="selectTicket(this)">
                            <div>
                                <div class="ed-ticket-opt-name">Standard Entry</div>
                                <div class="ed-ticket-opt-desc">General Admission Zone</div>
                            </div>
                            <div class="ed-ticket-opt-price">${{ number_format($basePrice, 0) }}</div>
                        </div>
                        <div class="ed-ticket-opt" onclick="selectTicket(this)">
                            <div>
                                <div class="ed-ticket-opt-name">VIP Premium</div>
                                <div class="ed-ticket-opt-desc">Front Row + Backstage Access</div>
                            </div>
                            <div class="ed-ticket-opt-price">${{ number_format($basePrice * 9.8, 0) }}</div>
                        </div>
                        <div class="ed-ticket-opt" onclick="selectTicket(this)">
                            <div>
                                <div class="ed-ticket-opt-name">Auditorium Box</div>
                                <div class="ed-ticket-opt-desc">Private Cabin (4 Persons)</div>
                            </div>
                            <div class="ed-ticket-opt-price">${{ number_format($basePrice * 30, 0) }}</div>
                        </div>
                    @endif

                    <a href="#" class="btn-complete">Complete Booking</a>
                    <div class="ed-secure-note">Secure Payment via Auditor-Pay</div>
                </div>

                {{-- Location Card --}}
                <div class="ed-location-card">
                    <div class="ed-map-area">
                        <div class="ed-map-pin"></div>
                    </div>
                    <div class="ed-location-info">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div>
                            <div class="ed-location-name">{{ $event['venue'] }}</div>
                            <div class="ed-location-addr">Main Campus Area, University</div>
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
