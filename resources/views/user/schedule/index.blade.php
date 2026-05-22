@extends('user.layouts.app')
@section('title', 'Schedule')

@push('styles')
<style>
    .schedule-header {
        margin-bottom: 32px;
    }
    .schedule-title {
        font-family: 'Poppins', sans-serif;
        font-size: 28px;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 8px;
    }
    .schedule-subtitle {
        color: var(--text-3);
        font-size: 14px;
    }

    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .badge-ongoing {
        background: rgba(179, 102, 255, 0.15);
        color: var(--accent);
        border: 1px solid rgba(179, 102, 255, 0.3);
    }
    .badge-upcoming {
        background: rgba(255, 255, 255, 0.05);
        color: var(--text-2);
        border: 1px solid var(--border);
    }

    /* Ongoing Section */
    .section-label {
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-label::before {
        content: '';
        width: 4px;
        height: 18px;
        background: var(--accent);
        border-radius: 2px;
    }

    .ongoing-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 48px;
    }
    .ongoing-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 20px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .ongoing-card:hover {
        border-color: var(--accent);
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }
    .ongoing-card::after {
        content: '';
        position: absolute;
        top: 0; right: 0;
        width: 100px; height: 100px;
        background: radial-gradient(circle at top right, var(--accent-soft), transparent 70%);
        opacity: 0.5;
    }
    .oc-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
    }
    .oc-category {
        font-size: 11px;
        font-weight: 700;
        color: var(--accent);
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }
    .oc-name {
        font-family: 'Poppins', sans-serif;
        font-size: 18px;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 12px;
    }
    .oc-time {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: var(--text-2);
    }
    .oc-time svg { width: 14px; height: 14px; }

    /* Upcoming Table */
    .upcoming-container {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
    }
    .upcoming-table {
        width: 100%;
        border-collapse: collapse;
    }
    .upcoming-table th {
        text-align: left;
        padding: 16px 24px;
        font-size: 11px;
        font-weight: 700;
        color: var(--text-3);
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border-bottom: 1px solid var(--border);
    }
    .upcoming-table td {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border);
        font-size: 14px;
    }
    .upcoming-table tr:last-child td { border-bottom: none; }
    .upcoming-table tr:hover { background: rgba(255,255,255,0.02); }
    
    .event-main-info {
        display: flex;
        flex-direction: column;
    }
    .event-main-name {
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 2px;
    }
    .event-main-venue {
        font-size: 12px;
        color: var(--text-3);
    }
    .event-date-info {
        font-weight: 500;
        color: var(--text-2);
    }
</style>
@endpush

@section('content')
<div class="schedule-header">
    <h1 class="schedule-title">Event Schedule</h1>
    <p class="schedule-subtitle">Stay updated with live and upcoming campus activities.</p>
</div>

{{-- Ongoing Events --}}
<h2 class="section-label">Happening Now</h2>
<div class="ongoing-grid">
    @foreach($ongoingEvents as $event)
    <a href="{{ route('events.show', $event['id']) }}" class="ongoing-card" style="text-decoration: none;">
        <div class="oc-header">
            <span class="oc-category">{{ $event['category'] }}</span>
            <span class="status-badge badge-ongoing">Live</span>
        </div>
        <div class="oc-name">{{ $event['name'] }}</div>
        <div class="oc-time">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ $event['time'] }}
        </div>
    </a>
    @endforeach
</div>

{{-- Upcoming Events --}}
<h2 class="section-label">Upcoming This Month</h2>
<div class="upcoming-container">
    <table class="upcoming-table">
        <thead>
            <tr>
                <th>Event</th>
                <th>Date & Time</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($upcomingEvents as $event)
            <tr>
                <td>
                    <div class="event-main-info">
                        <span class="event-main-name">{{ $event['name'] }}</span>
                        <span class="event-main-venue">{{ $event['venue'] }}</span>
                    </div>
                </td>
                <td>
                    <div class="event-date-info">{{ $event['date'] }}</div>
                    <div style="font-size: 12px; color: var(--text-3);">{{ $event['time'] }}</div>
                </td>
                <td>
                    <span class="status-badge badge-upcoming">Upcoming</span>
                </td>
                <td style="text-align: right;">
                    <a href="{{ route('events.show', $event['id']) }}" style="color: var(--accent); text-decoration: none; font-size: 13px; font-weight: 600;">Details →</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
