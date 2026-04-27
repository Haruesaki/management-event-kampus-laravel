@extends('layouts.app')
@section('title', $event->name ?? 'Event Details')

@push('styles')
<style>
    .event-hero {
        position: relative;
        height: 320px;
        border-radius: 18px;
        overflow: hidden;
        margin-bottom: 32px;
    }
    .event-hero img {
        width: 100%; height: 100%;
        object-fit: cover;
    }
    .event-hero-bg {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, #0d1525, #1a1030);
        display: flex; align-items: center; justify-content: center;
    }
    .event-hero-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(10,8,20,0.9) 30%, transparent 70%);
    }
    .event-hero-meta {
        position: absolute; bottom: 28px; left: 32px; right: 32px;
    }
    .live-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(168,85,247,0.25);
        border: 1px solid var(--accent);
        border-radius: 20px;
        padding: 5px 14px;
        font-size: 11px; font-weight: 600;
        color: var(--accent);
        text-transform: uppercase; letter-spacing: 0.1em;
        margin-bottom: 14px;
    }
    .rating-badge {
        display: inline-flex; align-items: center; gap: 4px;
        font-size: 13px; color: var(--text-2);
        margin-left: 10px;
    }
    .rating-badge svg { width: 13px; height: 13px; color: #f59e0b; }
    .event-name {
        font-family: 'Syne', sans-serif;
        font-size: 42px; font-weight: 800;
        line-height: 1.05; margin-bottom: 16px;
    }
    .event-name span { color: var(--accent); }
    .event-meta-row {
        display: flex; align-items: center; gap: 24px; flex-wrap: wrap;
    }
    .meta-item {
        display: flex; align-items: center; gap: 6px;
        font-size: 13px; color: var(--text-2);
    }
    .meta-item svg { width: 14px; height: 14px; }

    /* Two-column layout */
    .detail-layout {
        display: grid;
        grid-template-columns: 1fr 280px;
        gap: 28px;
        align-items: start;
    }

    /* Left column */
    .section-label {
        font-size: 11px; font-weight: 600;
        color: var(--text-3); text-transform: uppercase;
        letter-spacing: 0.12em; margin-bottom: 14px;
    }
    .about-text {
        font-size: 14px; line-height: 1.72;
        color: var(--text-2);
        margin-bottom: 28px;
    }

    .stats-grid {
        display: grid; grid-template-columns: repeat(4, 1fr);
        gap: 10px; margin-bottom: 32px;
    }
    .stat-box {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 16px 14px;
        text-align: center;
    }
    .stat-val {
        font-family: 'Syne', sans-serif;
        font-size: 22px; font-weight: 800;
        color: var(--text-1);
    }
    .stat-lbl {
        font-size: 10px; color: var(--text-3);
        text-transform: uppercase; letter-spacing: 0.1em;
        margin-top: 4px;
    }

    /* Artists */
    .artists-row { display: flex; gap: 24px; margin-bottom: 32px; flex-wrap: wrap; }
    .artist-item { text-align: center; }
    .artist-avatar {
        width: 64px; height: 64px;
        border-radius: 50%;
        background: var(--bg-card-2);
        border: 2px solid var(--border);
        overflow: hidden;
        margin: 0 auto 8px;
    }
    .artist-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .artist-avatar-placeholder {
        width: 100%; height: 100%;
        display: flex; align-items: center; justify-content: center;
        font-family: 'Syne',sans-serif; font-size: 20px; font-weight: 800;
        color: var(--text-3);
        background: linear-gradient(135deg, #1e1a30, #2a2040);
    }
    .artist-name { font-size: 12px; font-weight: 700; margin-bottom: 2px; }
    .artist-role { font-size: 11px; color: var(--text-3); }

    /* Schedule */
    .schedule-list { display: flex; flex-direction: column; gap: 0; }
    .schedule-item { display: flex; gap: 16px; padding: 16px 0; position: relative; }
    .schedule-item:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 6px; top: 36px; bottom: 0;
        width: 1px; background: var(--border);
    }
    .sch-dot {
        width: 14px; height: 14px; flex-shrink: 0;
        border-radius: 50%;
        background: var(--bg-card-2);
        border: 2px solid var(--text-3);
        margin-top: 4px;
    }
    .sch-dot.active { border-color: var(--accent); background: var(--accent); }
    .sch-time { font-size: 13px; font-weight: 600; color: var(--text-2); margin-bottom: 3px; }
    .sch-title { font-family: 'Syne', sans-serif; font-size: 15px; font-weight: 700; margin-bottom: 4px; }
    .sch-desc { font-size: 13px; color: var(--text-3); line-height: 1.5; }

    /* Right column - Ticket selector */
    .ticket-panel {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 24px;
        position: sticky;
        top: 80px;
    }
    .ticket-panel-title {
        font-family: 'Syne', sans-serif;
        font-size: 17px; font-weight: 700;
        margin-bottom: 18px;
    }
    .ticket-option {
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 14px 16px;
        display: flex; align-items: center; justify-content: space-between;
        cursor: pointer;
        transition: all 0.2s;
        margin-bottom: 10px;
    }
    .ticket-option:hover { border-color: var(--accent); }
    .ticket-option.selected { border-color: var(--accent); background: var(--accent-soft); }
    .ticket-option input[type="radio"] { display: none; }
    .ticket-info { flex: 1; }
    .ticket-type { font-size: 14px; font-weight: 700; margin-bottom: 3px; }
    .ticket-desc { font-size: 11px; color: var(--text-3); }
    .ticket-price { font-size: 16px; font-weight: 800; color: var(--text-1); }

    .btn-complete {
        width: 100%;
        padding: 15px;
        border-radius: 12px;
        border: none;
        background: linear-gradient(90deg, var(--accent), var(--accent-2));
        color: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px; font-weight: 700;
        cursor: pointer;
        margin-top: 20px;
        transition: opacity 0.2s, transform 0.15s;
    }
    .btn-complete:hover { opacity: 0.9; transform: translateY(-1px); }

    .secure-note {
        font-size: 10px; text-transform: uppercase;
        letter-spacing: 0.1em; color: var(--text-3);
        text-align: center; margin-top: 10px;
    }

    /* Location card */
    .location-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 20px;
        margin-top: 16px;
    }
    .location-title {
        font-family: 'Syne', sans-serif;
        font-size: 15px; font-weight: 700;
        display: flex; align-items: center; gap: 6px;
        margin-bottom: 4px;
    }
    .location-title svg { width: 14px; height: 14px; color: var(--accent); }
    .location-addr { font-size: 12px; color: var(--text-3); margin-bottom: 12px; }
    .location-map {
        height: 110px;
        border-radius: 10px;
        overflow: hidden;
        background: linear-gradient(135deg, #1a1f2e, #20253a);
        display: flex; align-items: center; justify-content: center;
    }
    .location-map svg { width: 36px; height: 36px; color: var(--accent); }
</style>
@endpush

@section('content')

{{-- Event Hero --}}
<div class="event-hero">
    @if(!empty($event->thumbnail ?? null))
        <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="{{ $event->name }}">
    @else
        <div class="event-hero-bg">
            <svg style="width:80px;height:80px;color:#2a2040;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z"/>
            </svg>
        </div>
    @endif
    <div class="event-hero-overlay"></div>
    <div class="event-hero-meta">
        <div>
            <span class="live-badge">● Live Performance</span>
            <span class="rating-badge">
                <svg fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                {{ $event->rating ?? '4.9' }} Rating
            </span>
        </div>
        <h1 class="event-name">
            {{ $event->name ?? 'Midnight' }}<br>
            <span>{{ $event->subtitle ?? 'Symphony Tour' }}</span>
        </h1>
        <div class="event-meta-row">
            <div class="meta-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ \Carbon\Carbon::parse($event->date ?? '2024-10-24')->format('F d, Y') }}
            </div>
            <div class="meta-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
                {{ $event->venue ?? 'Grand Plaza Hall, London' }}
            </div>
            <div class="meta-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ $event->time_start ?? '08:00 PM' }} - {{ $event->time_end ?? 'Late' }}
            </div>
        </div>
    </div>
</div>

{{-- Detail Layout --}}
<div class="detail-layout">

    {{-- Left: Info --}}
    <div>

        {{-- About --}}
        <div class="section-label">About Event</div>
        <p class="about-text">
            {{ $event->description ?? 'Experience an immersive audio-visual journey where classical arrangements meet futuristic electronic synthesis. The Midnight Symphony Tour features a custom-built 360-degree sound system designed specifically for the venue\'s unique acoustics.' }}
        </p>

        {{-- Stats --}}
        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-val">{{ $event->duration ?? '2.5h' }}</div>
                <div class="stat-lbl">Duration</div>
            </div>
            <div class="stat-box">
                <div class="stat-val">{{ $event->age_limit ?? '18+' }}</div>
                <div class="stat-lbl">Age Limit</div>
            </div>
            <div class="stat-box">
                <div class="stat-val">{{ $event->tickets_available ?? 'VIP' }}</div>
                <div class="stat-lbl">Available</div>
            </div>
            <div class="stat-box">
                <div class="stat-val">{{ $event->capacity ?? '4k+' }}</div>
                <div class="stat-lbl">Capacity</div>
            </div>
        </div>

        {{-- Featured Artists --}}
        @if(isset($event->artists) && $event->artists->isNotEmpty())
        <div class="section-label">Featured Artists</div>
        <div class="artists-row" style="margin-bottom:32px;">
            @foreach($event->artists as $artist)
            <div class="artist-item">
                <div class="artist-avatar">
                    @if($artist->photo)
                        <img src="{{ asset('storage/'.$artist->photo) }}" alt="{{ $artist->name }}">
                    @else
                        <div class="artist-avatar-placeholder">{{ strtoupper(substr($artist->name,0,1)) }}</div>
                    @endif
                </div>
                <div class="artist-name">{{ strtoupper($artist->name) }}</div>
                <div class="artist-role">{{ $artist->role }}</div>
            </div>
            @endforeach
        </div>
        @else
        <div class="section-label">Featured Artists</div>
        <div class="artists-row" style="margin-bottom:32px;">
            @foreach([['Luna X','Lead Synthesist'],['Marcus Vane','Electric Cello'],['The Echo','Vocalist']] as $a)
            <div class="artist-item">
                <div class="artist-avatar">
                    <div class="artist-avatar-placeholder">{{ substr($a[0],0,1) }}</div>
                </div>
                <div class="artist-name">{{ strtoupper($a[0]) }}</div>
                <div class="artist-role">{{ $a[1] }}</div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Schedule --}}
        <div class="section-label">Event Schedule</div>
        <div class="schedule-list">
            @forelse($event->schedules ?? [] as $i => $sched)
            <div class="schedule-item">
                <div class="sch-dot {{ $i===0 ? 'active' : '' }}"></div>
                <div>
                    <div class="sch-time">{{ $sched->time }}</div>
                    <div class="sch-title">{{ $sched->title }}</div>
                    <div class="sch-desc">{{ $sched->description }}</div>
                </div>
            </div>
            @empty
            @foreach([
                ['07:00 PM','Doors Open & Lounge Set','Welcome drinks and ambient atmospheric soundscapes by DJ Void.'],
                ['08:30 PM','Part I: The Awakening','A high-energy opening featuring visual mapping and the core ensemble.'],
                ['10:00 PM','Part II: Echoes of Eternity','The grand finale with full orchestral integration and laser light show.'],
            ] as $i => $s)
            <div class="schedule-item">
                <div class="sch-dot {{ $i===0 ? 'active' : '' }}"></div>
                <div>
                    <div class="sch-time">{{ $s[0] }}</div>
                    <div class="sch-title">{{ $s[1] }}</div>
                    <div class="sch-desc">{{ $s[2] }}</div>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>

    {{-- Right: Ticket Panel --}}
    <div>
        <div class="ticket-panel">
            <div class="ticket-panel-title">Select Tickets</div>

            <form method="POST" action="{{ route('registrations.store') }}" id="ticket-form">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id ?? 1 }}">

                @forelse($event->ticketTypes ?? [] as $type)
                <label class="ticket-option" id="opt-{{ $type->id }}">
                    <input type="radio" name="ticket_type_id" value="{{ $type->id }}" onchange="selectTicket('opt-{{ $type->id }}')">
                    <div class="ticket-info">
                        <div class="ticket-type">{{ $type->name }}</div>
                        <div class="ticket-desc">{{ $type->description }}</div>
                    </div>
                    <div class="ticket-price">${{ number_format($type->price, 0) }}</div>
                </label>
                @empty
                @foreach([
                    ['Standard Entry','General Admission Zone',89],
                    ['VIP Premium','Front row + Backstage Access',245],
                    ['Auditorium Box','Private Cabin (4 Persons)',750],
                ] as $i => $t)
                <label class="ticket-option {{ $i===0?'selected':'' }}" id="opt-{{ $i }}">
                    <input type="radio" name="ticket_type_id" value="{{ $i }}" {{ $i===0?'checked':'' }} onchange="selectTicket('opt-{{ $i }}')">
                    <div class="ticket-info">
                        <div class="ticket-type">{{ $t[0] }}</div>
                        <div class="ticket-desc">{{ $t[1] }}</div>
                    </div>
                    <div class="ticket-price">${{ $t[2] }}</div>
                </label>
                @endforeach
                @endforelse

                @auth
                <button type="submit" class="btn-complete">Complete Booking</button>
                @else
                <a href="{{ route('login') }}" class="btn-complete" style="display:block;text-align:center;text-decoration:none;">
                    Login to Book
                </a>
                @endauth
            </form>

            <div class="secure-note">Secure Payment via Auditor-Pay</div>
        </div>

        {{-- Location --}}
        <div class="location-card">
            <div class="location-title">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
                Location
            </div>
            <div class="location-addr">{{ $event->address ?? '322 Victoria Street, EC1, London' }}</div>
            <div class="location-map">
                <svg fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
function selectTicket(optId) {
    document.querySelectorAll('.ticket-option').forEach(el => el.classList.remove('selected'));
    document.getElementById(optId)?.classList.add('selected');
}
</script>
@endpush
