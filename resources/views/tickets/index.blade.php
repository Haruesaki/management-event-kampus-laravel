@extends('layouts.app')
@section('title', 'My Tickets')

@push('styles')
<style>
    /* Page header */
    .bookings-header { margin-bottom: 36px; }
    .bookings-label {
        font-size: 10px; font-weight: 600; color: #9b92bc;
        text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 6px;
    }
    .bookings-title {
        font-family: 'Poppins', sans-serif;
        font-size: 36px; font-weight: 800; margin-bottom: 8px; color: #ffffff;
    }
    .bookings-desc { font-size: 14px; color: #d4cef0; line-height: 1.6; max-width: 520px; }

    /* Section heading */
    .section-row {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 18px;
    }
    .section-heading {
        display: flex; align-items: center; gap: 8px;
        font-family: 'Poppins', sans-serif; font-size: 18px; font-weight: 700;
        color: #ffffff;
    }
    .active-dot {
        width: 8px; height: 8px; border-radius: 50%;
        background: #22c55e;
        box-shadow: 0 0 6px rgba(34,197,94,0.6);
    }
    .count-badge {
        font-size: 13px; font-weight: 500; color: #b0a8cc;
    }
    .link-subtle {
        font-size: 13px; color: #d4cef0; text-decoration: none; transition: color 0.2s;
    }
    .link-subtle:hover { color: #c47fff; }

    /* Active tickets grid */
    .active-tickets-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-bottom: 40px;
    }
    .ticket-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        display: flex;
        transition: border-color 0.2s;
    }
    .ticket-card:hover { border-color: rgba(168,85,247,0.3); }
    .ticket-image {
        width: 140px; flex-shrink: 0;
        position: relative;
        overflow: hidden;
    }
    .ticket-image img {
        width: 100%; height: 100%; object-fit: cover;
    }
    .ticket-image-bg {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, #0d1525, #1a1030);
        display: flex; align-items: center; justify-content: center;
    }
    .ticket-badge {
        position: absolute; top: 12px; left: 12px;
        background: rgba(10,8,20,0.8);
        border: 1px solid var(--border);
        border-radius: 6px;
        padding: 4px 8px;
        font-size: 9px; font-weight: 700;
        color: var(--text-2);
        text-transform: uppercase; letter-spacing: 0.1em;
        backdrop-filter: blur(8px);
    }
    .ticket-id-badge {
        position: absolute; top: 12px; right: -60px;
        font-size: 10px; color: var(--text-3);
        white-space: nowrap;
    }
    .ticket-body { padding: 18px; flex: 1; display: flex; flex-direction: column; }
    .ticket-type-row {
        display: flex; align-items: flex-start; justify-content: space-between;
        margin-bottom: 4px;
    }
    .ticket-event-name {
        font-family: 'Poppins', sans-serif;
        font-size: 17px; font-weight: 700;
        line-height: 1.2; margin-bottom: 4px; color: #ffffff;
    }
    .ticket-datetime {
        font-size: 12px; color: #b0a8cc; margin-bottom: 14px;
    }
    .ticket-seat-row {
        display: grid; grid-template-columns: repeat(3, 1fr);
        gap: 8px; margin-bottom: 14px;
    }
    .seat-item { }
    .seat-label { font-size: 9px; color: #9b92bc; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 2px; }
    .seat-val { font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 800; color: #ffffff; }
    .download-btn {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 12px; font-weight: 600;
        color: var(--text-2); text-decoration: none;
        transition: color 0.2s;
    }
    .download-btn:hover { color: var(--accent); }
    .download-btn svg { width: 13px; height: 13px; }

    /* Ticket ID in header */
    .ticket-id {
        font-size: 11px; color: var(--text-3);
    }

    /* Past events */
    .past-list { display: flex; flex-direction: column; gap: 0; margin-bottom: 32px; }
    .past-item {
        display: flex; align-items: center; gap: 14px;
        padding: 16px 0;
        border-bottom: 1px solid var(--border);
        cursor: pointer;
        transition: padding-left 0.2s;
    }
    .past-item:last-child { border-bottom: none; }
    .past-item:hover { padding-left: 4px; }
    .past-thumb {
        width: 44px; height: 44px; border-radius: 10px;
        overflow: hidden; flex-shrink: 0;
        background: var(--bg-card-2);
    }
    .past-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .past-thumb-placeholder {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, #1e1a30, #2a2040);
        display: flex; align-items: center; justify-content: center;
    }
    .past-info { flex: 1; }
    .past-name { font-size: 14px; font-weight: 600; margin-bottom: 2px; color: #ffffff; }
    .past-meta { font-size: 12px; color: #9b92bc; }
    .past-right { display: flex; align-items: center; gap: 10px; }
    .attended-label { font-size: 9px; color: var(--text-3); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 4px; text-align: right; }
    .toggle-wrap { display: flex; align-items: center; gap: 6px; }
    .toggle {
        width: 32px; height: 18px; border-radius: 9px;
        position: relative; cursor: default;
        background: var(--bg-card-2); border: 1px solid var(--border);
    }
    .toggle.on { background: linear-gradient(90deg, var(--accent), var(--accent-2)); border-color: transparent; }
    .toggle::after {
        content: '';
        position: absolute; top: 2px; left: 2px;
        width: 12px; height: 12px; border-radius: 50%;
        background: var(--text-3);
        transition: left 0.2s, background 0.2s;
    }
    .toggle.on::after { left: 16px; background: #fff; }
    .past-arrow { color: var(--text-3); }
    .past-arrow svg { width: 16px; height: 16px; }

    /* CTA section */
    .cta-section {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 28px 32px;
        display: flex; align-items: center; justify-content: space-between;
        gap: 20px;
    }
    .cta-title { font-family: 'Poppins', sans-serif; font-size: 18px; font-weight: 700; margin-bottom: 6px; color: #ffffff; }
    .cta-desc { font-size: 13px; color: #d4cef0; }
    .btn-cta {
        padding: 12px 24px;
        border-radius: 12px;
        background: linear-gradient(90deg, var(--accent), var(--accent-2));
        color: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px; font-weight: 700;
        border: none; cursor: pointer;
        text-decoration: none; white-space: nowrap;
        transition: opacity 0.2s;
    }
    .btn-cta:hover { opacity: 0.9; }

    /* Empty state */
    .empty-state {
        text-align: center; padding: 56px 20px;
        color: var(--text-3);
    }
    .empty-state svg { width: 48px; height: 48px; margin: 0 auto 14px; }
    .empty-state h3 { font-family: 'Syne',sans-serif; font-size: 18px; font-weight: 700; margin-bottom: 8px; color: var(--text-2); }
    .empty-state p { font-size: 13px; margin-bottom: 20px; }
</style>
@endpush

@section('content')

{{-- Header --}}
<div class="bookings-header">
    <div class="bookings-label">Your Collection</div>
    <h1 class="bookings-title">My Bookings</h1>
    <p class="bookings-desc">
        Manage your upcoming experiences and relive the memories of past performances at the Ethereal Auditorium.
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
            <div>
                <div class="attended-label">Attended</div>
                <div class="toggle-wrap">
                    <div class="toggle {{ $ticket->attended ? 'on' : '' }}"></div>
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
            <div>
                <div class="attended-label">Attended</div>
                <div class="toggle-wrap">
                    <div class="toggle {{ $p[2] ? 'on' : '' }}"></div>
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
