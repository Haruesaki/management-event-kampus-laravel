@extends('user.layouts.app')
@section('title', $event['name'])

@push('styles')
<style>
    /* Back Button */
    .back-btn {
        display: inline-flex; align-items: center; gap: 8px;
        color: var(--text-3); text-decoration: none;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px; font-weight: 600;
        margin-bottom: 24px; transition: color 0.2s;
    }
    .back-btn:hover { color: var(--text-1); }

    /* Event Hero */
    .event-hero {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        min-height: 380px;
        display: flex;
        align-items: flex-end;
        margin-bottom: 40px;
        background: {{ $event['color'] ?? 'linear-gradient(135deg, #1e1a30, #2a2040)' }};
    }
    .hero-bg-img {
        position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.8;
    }
    .hero-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(0deg, rgba(10,8,20,0.95) 0%, rgba(10,8,20,0.3) 100%);
    }
    .event-hero-content {
        position: relative; z-index: 2;
        padding: 40px; width: 100%;
        display: flex; justify-content: space-between; align-items: flex-end;
        flex-wrap: wrap; gap: 24px;
    }

    .event-category-tag {
        display: inline-block;
        font-size: 11px; font-weight: 700;
        color: #c47fff;
        text-transform: uppercase; letter-spacing: 0.15em;
        background: rgba(179,102,255,0.1);
        border: 1px solid rgba(179,102,255,0.3);
        border-radius: 20px;
        padding: 6px 14px;
        margin-bottom: 16px;
    }

    .event-title {
        font-family: 'Poppins', sans-serif;
        font-size: 42px; font-weight: 800;
        line-height: 1.1; margin-bottom: 12px;
        color: #ffffff;
    }

    .event-venue-large {
        display: flex; align-items: center; gap: 6px;
        font-size: 15px; color: #b0a8cc;
    }
    .event-venue-large svg { width: 16px; height: 16px; color: var(--accent); }

    .price-box {
        background: rgba(20,16,30,0.6);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 16px;
        padding: 24px; text-align: right;
        backdrop-filter: blur(12px);
        min-width: 220px;
    }
    .price-label { font-size: 12px; color: var(--text-3); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 4px; }
    .price-value { font-family: 'Poppins', sans-serif; font-size: 32px; font-weight: 800; color: #ffffff; }
    .price-value.free { color: #c47fff; }
    
    .btn-buy {
        display: inline-block; margin-top: 16px; width: 100%; text-align: center;
        padding: 12px 32px; border-radius: 12px;
        background: linear-gradient(90deg, var(--accent), var(--accent-2));
        color: #fff; font-family: 'DM Sans', sans-serif; font-size: 15px; font-weight: 700;
        border: none; cursor: pointer; text-decoration: none;
        transition: all 0.2s;
    }
    .btn-buy:hover { opacity: 0.9; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(179,102,255,0.3); }

    /* Content Grid */
    .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 32px; }
    .section-title {
        font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 700;
        color: #ffffff; margin-bottom: 16px;
    }
    .event-desc { font-size: 15px; color: #d4cef0; line-height: 1.7; margin-bottom: 32px; }

    /* Info Cards */
    .info-card {
        background: var(--bg-card); border: 1px solid var(--border);
        border-radius: 16px; padding: 24px; margin-bottom: 24px;
    }
    .info-item { display: flex; gap: 16px; margin-bottom: 20px; }
    .info-item:last-child { margin-bottom: 0; }
    .info-icon {
        width: 44px; height: 44px; border-radius: 12px;
        background: var(--bg-card-2);
        display: flex; align-items: center; justify-content: center;
        color: var(--accent); flex-shrink: 0;
    }
    .info-icon svg { width: 22px; height: 22px; }
    .info-text .label { font-size: 12px; color: #9b92bc; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.1em; }
    .info-text .val { font-family: 'Poppins', sans-serif; font-size: 15px; font-weight: 600; color: #ffffff; }
    .info-text .sub-val { font-size: 13px; color: var(--text-3); margin-top: 2px; }

    @media (max-width: 768px) {
        .content-grid { grid-template-columns: 1fr; }
        .event-hero-content { flex-direction: column; align-items: flex-start; }
        .price-box { width: 100%; text-align: left; }
    }
</style>
@endpush

@section('content')

<a href="{{ route('events.index') }}" class="back-btn">
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;">
        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
    </svg>
    Back to Discovery
</a>

<div class="event-hero">
    @if(isset($event['thumbnail']) && $event['thumbnail'])
        <img src="{{ asset('storage/' . $event['thumbnail']) }}" class="hero-bg-img" alt="{{ $event['name'] }}">
    @endif
    <div class="hero-overlay"></div>
    
    <div class="event-hero-content">
        <div>
            <div class="event-category-tag">{{ $event['category'] }}</div>
            <h1 class="event-title">{{ $event['name'] }}</h1>
            <div class="event-venue-large">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                {{ $event['venue'] }}
            </div>
        </div>
        
        <div class="price-box">
            <div class="price-label">Ticket Price</div>
            @if(isset($event['price']) && $event['price'] == 0)
                <div class="price-value free">FREE</div>
            @else
                <div class="price-value">${{ number_format($event['price'] ?? 0, 2) }}</div>
            @endif
            <button class="btn-buy">Book Ticket</button>
        </div>
    </div>
</div>

<div class="content-grid">
    <div class="main-column">
        <h2 class="section-title">About this Event</h2>
        <div class="event-desc">
            <p>Join us for an incredible experience at the {{ $event['name'] }}. This event brings together students, professionals, and enthusiasts to explore the amazing world of {{ strtolower($event['category']) }}. Prepare for an engaging session filled with insightful discussions, networking opportunities, and memorable moments.</p>
            <br>
            <p>Hosted at the prestigious {{ $event['venue'] }}, you'll enjoy state-of-the-art facilities and a welcoming atmosphere. Don't miss out on this opportunity to connect with like-minded individuals and expand your horizons.</p>
        </div>
    </div>
    
    <div class="side-column">
        <div class="info-card">
            <div class="info-item">
                <div class="info-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="info-text">
                    <div class="label">Date & Time</div>
                    <div class="val">{{ \Carbon\Carbon::parse($event['date'])->format('l, M d, Y') }}</div>
                    <div class="sub-val">{{ $event['time_start'] ?? '09:00 AM' }} - {{ $event['time_end'] ?? '03:00 PM' }}</div>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div class="info-text">
                    <div class="label">Location</div>
                    <div class="val">{{ $event['venue'] }}</div>
                    <div class="sub-val">Main Campus Area</div>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                </div>
                <div class="info-text">
                    <div class="label">Availability</div>
                    <div class="val" style="color: #22c55e;">Available</div>
                    <div class="sub-val">Open for booking</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
