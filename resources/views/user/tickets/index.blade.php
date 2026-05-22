@extends('user.layouts.app')
@section('title', 'My Tickets')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/user/tickets.css') }}">
@endpush

@section('content')

{{-- Header --}}
<div class="bookings-header">
    <div class="bookings-label">Your Collection</div>
    <h1 class="bookings-title">My Bookings</h1>
    <p class="bookings-desc">
        Manage your upcoming experiences and relive the memories of past performances at the Event Kampus.
    </p>
</div>

{{-- Active Tickets --}}
<div class="section-row">
    <div class="section-heading">
        <div class="active-dot"></div>
        Active Tickets
    </div>
    <span class="count-badge">{{ ($activeTickets ?? collect())->count() }} Active</span>
</div>

<div class="active-tickets-grid">
    @forelse($activeTickets ?? [] as $ticket)
    <div class="ticket-card">
        <div class="ticket-image">
            @if($ticket->event->thumbnail)
                <img src="{{ asset('storage/'.$ticket->event->thumbnail) }}" alt="">
            @else
                <div class="ticket-image-bg">
                    <svg style="width:32px;height:32px;color:#2a2040;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13"/>
                    </svg>
                </div>
            @endif
            <div class="ticket-badge">{{ $ticket->seat_section ?? 'General' }}</div>
        </div>
        <div class="ticket-body">
            <div class="ticket-type-row">
                <div></div>
                <div class="ticket-id">ID: #{{ $ticket->code }}</div>
            </div>
            <div class="ticket-event-name">{{ $ticket->event->name }}</div>
            <div class="ticket-datetime">
                {{ \Carbon\Carbon::parse($ticket->event->date)->format('l, M d') }} • {{ $ticket->event->time_start }}
            </div>
            @if($ticket->seat_section)
            <div class="ticket-seat-row">
                <div class="seat-item">
                    <div class="seat-label">Section</div>
                    <div class="seat-val">{{ $ticket->seat_section }}</div>
                </div>
                <div class="seat-item">
                    <div class="seat-label">Row</div>
                    <div class="seat-val">{{ $ticket->seat_row }}</div>
                </div>
                <div class="seat-item">
                    <div class="seat-label">Seat</div>
                    <div class="seat-val">{{ $ticket->seat_number }}</div>
                </div>
            </div>
            @endif
            <a href="{{ route('tickets.download', $ticket->id) }}" class="download-btn">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Download PDF
            </a>
        </div>
    </div>
    @empty
    {{-- Dummy cards --}}
    @foreach([
        ['id'=>1,'badge'=>'Orchestra Seating','code'=>'EA-90822','name'=>'Neo-Classical Synthesis','date'=>'Friday, Oct 24','time'=>'8:00 PM','section'=>'A1','row'=>'12','seat'=>'42'],
        ['id'=>2,'badge'=>'Private Box','code'=>'EA-44102','name'=>'Midnight Opera Series','date'=>'Sunday, Nov 02','time'=>'10:30 PM','box'=>'VIP 4','suite'=>'North','guests'=>'2'],
    ] as $dummy)
    <div class="ticket-card">
        <div class="ticket-image">
            <div class="ticket-image-bg">
                <svg style="width:32px;height:32px;color:#2a2040;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13"/>
                </svg>
            </div>
            <div class="ticket-badge">{{ $dummy['badge'] }}</div>
        </div>
        <div class="ticket-body">
            <div class="ticket-type-row">
                <div></div>
                <div class="ticket-id">ID: #{{ $dummy['code'] }}</div>
            </div>
            <div class="ticket-event-name">{{ $dummy['name'] }}</div>
            <div class="ticket-datetime">{{ $dummy['date'] }} • {{ $dummy['time'] }}</div>
            @if(isset($dummy['section']))
            <div class="ticket-seat-row">
                <div class="seat-item">
                    <div class="seat-label">Section</div>
                    <div class="seat-val">{{ $dummy['section'] }}</div>
                </div>
                <div class="seat-item">
                    <div class="seat-label">Row</div>
                    <div class="seat-val">{{ $dummy['row'] }}</div>
                </div>
                <div class="seat-item">
                    <div class="seat-label">Seat</div>
                    <div class="seat-val">{{ $dummy['seat'] }}</div>
                </div>
            </div>
            @else
            <div class="ticket-seat-row">
                <div class="seat-item">
                    <div class="seat-label">Box</div>
                    <div class="seat-val">{{ $dummy['box'] }}</div>
                </div>
                <div class="seat-item">
                    <div class="seat-label">Suite</div>
                    <div class="seat-val">{{ $dummy['suite'] }}</div>
                </div>
                <div class="seat-item">
                    <div class="seat-label">Guest</div>
                    <div class="seat-val">{{ $dummy['guests'] }}</div>
                </div>
            </div>
            @endif
            <a href="#" class="download-btn">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Download PDF
            </a>
        </div>
    </div>
    @endforeach
    @endforelse
</div>

{{-- Past Events --}}
<div class="section-row">
    <div class="section-heading">Past Events</div>
    <a href="#" class="link-subtle" style="font-weight:600;">View All History</a>
</div>

<div class="past-list">
    @forelse($pastTickets ?? [] as $ticket)
    <div class="past-item">
        <div class="past-thumb">
            @if($ticket->event->thumbnail)
                <img src="{{ asset('storage/'.$ticket->event->thumbnail) }}" alt="">
            @else
                <div class="past-thumb-placeholder">
                    <svg style="width:18px;height:18px;color:#4e4670;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13"/>
                    </svg>
                </div>
            @endif
        </div>
        <div class="past-info">
            <div class="past-name">{{ $ticket->event->name }}</div>
            <div class="past-meta">{{ \Carbon\Carbon::parse($ticket->event->date)->format('M d, Y') }} • {{ $ticket->event->venue }}</div>
        </div>
        <div class="past-right">
            <div style="text-align: right; min-width: 80px;">
                <div class="attended-label">Status</div>
                <div style="font-size: 13px; font-weight: 700; margin-top: 4px; color: {{ ($ticket->attended ?? false) ? 'var(--accent)' : 'var(--text-3)' }};">
                    {{ ($ticket->attended ?? false) ? 'Hadir' : 'Tidak Hadir' }}
                </div>
            </div>
            <div class="past-arrow">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </div>
    </div>
    @empty
    @foreach([
        ['Electronic Underground Vol. 4','Sep 12, 2023 • The Deep Lounge',true],
        ['Live Podcast: The Future of Sound','Aug 28, 2023 • Hall B',false],
        ['Summer Night Symphony','Aug 05, 2023 • Main Theater',true],
    ] as $p)
    <div class="past-item">
        <div class="past-thumb">
            <div class="past-thumb-placeholder">
                <svg style="width:18px;height:18px;color:#4e4670;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13"/>
                </svg>
            </div>
        </div>
        <div class="past-info">
            <div class="past-name">{{ $p[0] }}</div>
            <div class="past-meta">{{ $p[1] }}</div>
        </div>
        <div class="past-right">
            <div style="text-align: right; min-width: 80px;">
                <div class="attended-label">Status</div>
                <div style="font-size: 13px; font-weight: 700; margin-top: 4px; color: {{ $p[2] ? 'var(--accent)' : 'var(--text-3)' }};">
                    {{ $p[2] ? 'Hadir' : 'Tidak Hadir' }}
                </div>
            </div>
            <div class="past-arrow">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </div>
    </div>
    @endforeach
    @endforelse
</div>

{{-- CTA --}}
<div class="cta-section">
    <div>
        <div class="cta-title">Looking for more?</div>
        <p class="cta-desc">Explore curated upcoming events tailored to your unique taste.</p>
    </div>
    <a href="{{ route('events.index') }}" class="btn-cta">Explore Discovery</a>
</div>

@endsection
