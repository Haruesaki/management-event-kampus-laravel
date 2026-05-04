@extends('user.layouts.app')
@section('title', 'Dashboard')

@push('styles')
<style>
    /* Hero Section */
    .hero-banner {
        position: relative;
        border-radius: 18px;
        overflow: hidden;
        min-height: 300px;
        display: flex;
        align-items: flex-end;
        margin-bottom: 36px;
        background: linear-gradient(135deg, #1a1430 0%, #0f0d1a 100%);
    }
    .hero-bg {
        position: absolute; inset: 0;
        background: url('https://images.unsplash.com/photo-1465847899084-d164df4dedc6?w=1200&q=80') center/cover no-repeat;
        opacity: 0.35;
    }
    .hero-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(90deg, rgba(10,8,20,0.95) 35%, rgba(10,8,20,0.2) 100%);
    }
    .hero-content {
        position: relative;
        z-index: 2;
        padding: 40px 44px;
        max-width: 560px;
    }
    .hero-tag {
        display: inline-block;
        font-size: 10px; font-weight: 600;
        color: var(--text-2);
        text-transform: uppercase; letter-spacing: 0.15em;
        background: rgba(255,255,255,0.08);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 5px 14px;
        margin-bottom: 18px;
    }
    .hero-title {
        font-family: 'Poppins', sans-serif;
        font-size: 38px; font-weight: 800;
        line-height: 1.05;
        margin-bottom: 14px;
        color: #ffffff;
    }
    .hero-title span { color: var(--accent); }
    .hero-desc {
        font-size: 14px; color: #d4cef0;
        line-height: 1.65;
        margin-bottom: 28px;
        max-width: 420px;
    }
    .hero-actions { display: flex; gap: 12px; flex-wrap: wrap; }
    .btn-filled {
        padding: 12px 24px;
        border-radius: 10px;
        background: var(--accent);
        color: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px; font-weight: 600;
        border: none; cursor: pointer;
        text-decoration: none;
        display: inline-flex; align-items: center; gap: 6px;
        transition: all 0.2s;
    }
    .btn-filled:hover { background: #9333ea; transform: translateY(-1px); }
    .btn-ghost {
        padding: 12px 24px;
        border-radius: 10px;
        border: 1px solid var(--border);
        background: rgba(255,255,255,0.05);
        color: var(--text-1);
        font-family: 'DM Sans', sans-serif;
        font-size: 14px; font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex; align-items: center; gap: 6px;
        transition: all 0.2s;
        backdrop-filter: blur(8px);
    }
    .btn-ghost:hover { border-color: var(--accent); color: var(--accent); }

    /* Section heading */
    .section-row {
        display: flex; align-items: baseline; justify-content: space-between;
        margin-bottom: 18px;
    }
    .section-title {
        font-family: 'Poppins', sans-serif;
        font-size: 20px; font-weight: 700;
        color: #ffffff;
    }
    .view-all {
        font-size: 13px; color: #b0a8cc;
        text-decoration: none; transition: color 0.2s;
    }
    .view-all:hover { color: #ffffff; }

    /* Categories */
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-bottom: 36px;
    }
    .cat-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 24px 16px;
        text-align: center;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
    }
    .cat-card:hover { border-color: var(--accent); transform: translateY(-2px); }
    .cat-icon {
        width: 44px; height: 44px;
        border-radius: 50%;
        background: var(--accent-soft);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 12px;
    }
    .cat-icon svg { width: 20px; height: 20px; color: var(--accent); }
    .cat-name {
        font-family: 'Poppins', sans-serif;
        font-size: 13px; font-weight: 600;
        color: #d4cef0;
    }

    /* Events carousel */
    .events-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 8px;
    }
    .event-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        transition: all 0.25s;
        display: block;
    }
    .event-card:hover { transform: translateY(-3px); border-color: rgba(168,85,247,0.35); box-shadow: 0 8px 32px rgba(0,0,0,0.3); }
    .event-thumb {
        position: relative;
        height: 160px;
        background: var(--bg-card-2);
        overflow: hidden;
    }
    .event-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .event-thumb-placeholder {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, #1e1a30, #2a2040);
        display: flex; align-items: center; justify-content: center;
        color: var(--text-3); font-size: 12px;
    }
    .event-date-badge {
        position: absolute; top: 12px; left: 12px;
        background: rgba(10,8,20,0.85);
        border-radius: 8px;
        padding: 6px 10px;
        text-align: center;
        backdrop-filter: blur(8px);
        border: 1px solid var(--border);
    }
    .event-date-badge .day { font-family: 'Syne',sans-serif; font-size: 20px; font-weight: 800; line-height: 1; }
    .event-date-badge .month { font-size: 9px; color: var(--text-3); text-transform: uppercase; letter-spacing: 0.1em; }
    .event-info { padding: 16px; }
    .event-venue-tag {
        display: flex; align-items: center; gap: 4px;
        font-size: 11px; color: var(--text-3);
        margin-bottom: 4px;
    }
    .event-venue-tag svg { width: 10px; height: 10px; }
    .event-name {
        font-family: 'Poppins', sans-serif;
        font-size: 15px; font-weight: 700;
        margin-bottom: 10px; line-height: 1.3;
        color: #ffffff;
    }
    .event-footer {
        display: flex; align-items: center; justify-content: space-between;
    }
    .event-price {
        font-size: 15px; font-weight: 700;
        color: #ffffff;
    }
    .event-price.free { color: var(--accent); }
    .btn-book {
        font-size: 12px; font-weight: 600;
        color: var(--accent); cursor: pointer;
        background: none; border: none;
        text-decoration: none;
        transition: opacity 0.2s;
    }
    .btn-book:hover { opacity: 0.7; }

    /* Venue card (3rd slot) */
    .venue-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        display: flex; flex-direction: column;
    }
    .venue-map {
        height: 130px;
        background: #1e1f2e;
        overflow: hidden;
        position: relative;
    }
    .venue-map img { width: 100%; height: 100%; object-fit: cover; filter: saturate(0.6) brightness(0.7); }
    .venue-map-pin {
        position: absolute; top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        width: 28px; height: 28px;
        background: var(--accent);
        border-radius: 50% 50% 50% 0;
        transform: translate(-50%,-50%) rotate(-45deg);
    }
    .venue-info { padding: 16px; flex: 1; }
    .venue-name { font-family: 'Poppins',sans-serif; font-size: 15px; font-weight: 700; margin-bottom: 6px; color: #ffffff; }
    .venue-desc { font-size: 12px; color: #b0a8cc; line-height: 1.55; margin-bottom: 12px; }
    .venue-directions {
        font-size: 12px; font-weight: 600;
        color: var(--accent); text-decoration: none;
        display: inline-flex; align-items: center; gap: 4px;
    }

    /* Carousel controls */
    .carousel-controls { display: flex; gap: 8px; }
    .ctrl-btn {
        width: 30px; height: 30px;
        border-radius: 50%;
        background: var(--bg-card);
        border: 1px solid var(--border);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: all 0.2s;
        color: var(--text-2);
    }
    .ctrl-btn:hover { border-color: var(--accent); color: var(--accent); }
    .ctrl-btn svg { width: 14px; height: 14px; }
</style>
@endpush

@section('content')

{{-- Hero Banner --}}
<div class="hero-banner">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-tag">Featured Performance</div>
        <h1 class="hero-title">
            Dies Natalis<br>
            <span>Concert 2026</span>
        </h1>
        <p class="hero-desc">
            Experience an ethereal night of orchestral fusion and digital arts
            in the heart of the main campus plaza.
        </p>
        <div class="hero-actions">
            <a href="#" class="btn-filled">
                Get Tickets Now →
            </a>
            <a href="#" class="btn-ghost">
                View Lineup
            </a>
        </div>
    </div>
</div>

{{-- Explore Categories --}}
<div class="section-row">
    <h2 class="section-title">Explore Categories</h2>
<a href="{{ route('user.events') }}" class="view-all">View All</a>
</div>

<div class="categories-grid">
<a href="{{ route('user.events', ['category' => 'music']) }}" class="cat-card">
        <div class="cat-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
            </svg>
        </div>
        <div class="cat-name">Music</div>
    </a>
    <a href="{{ route('user.events', ['category' => 'seminar']) }}" class="cat-card">
        <div class="cat-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
            </svg>
        </div>
        <div class="cat-name">Seminar</div>
    </a>
    <a href="{{ route('user.events', ['category' => 'workshop']) }}" class="cat-card">
        <div class="cat-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
            </svg>
        </div>
        <div class="cat-name">Workshop</div>
    </a>
    <a href="{{ route('user.events', ['category' => 'sports']) }}" class="cat-card">
        <div class="cat-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <circle cx="12" cy="12" r="10" stroke-linecap="round"/>
                <path stroke-linecap="round" d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/>
            </svg>
        </div>
        <div class="cat-name">Sports</div>
    </a>
</div>

{{-- Upcoming Events --}}
<div class="section-row" style="margin-top:8px;">
    <h2 class="section-title">Upcoming Events</h2>
    <div style="display:flex; align-items:center; gap:12px;">
        <div class="carousel-controls">
            <button class="ctrl-btn">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button class="ctrl-btn">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
</div>

<div class="events-row">
    {{-- Event Card 1 --}}
    <a href="{{ route('events.show', 1) }}" class="event-card">
        <div class="event-thumb">
            <div class="event-thumb-placeholder">
                <span style="font-family:'Syne',sans-serif;font-size:14px;font-weight:700;color:#4e4670;">TECH<br>SUMMIT</span>
            </div>
            <div class="event-date-badge">
                <div class="day">15</div>
                <div class="month">MAR</div>
            </div>
        </div>
        <div class="event-info">
            <div class="event-venue-tag">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Main Engineering Hall
            </div>
            <div class="event-name">Future Tech Summit</div>
            <div class="event-footer">
                <span class="event-price">$25.00</span>
                <span class="btn-book">Book Now</span>
            </div>
        </div>
    </a>

    {{-- Event Card 2 --}}
    <a href="{{ route('events.show', 2) }}" class="event-card">
        <div class="event-thumb">
            <div class="event-thumb-placeholder" style="background:linear-gradient(135deg,#1e2a1a,#2a3520);">
                <svg style="width:48px;height:48px;color:#2d4a25;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/>
                </svg>
            </div>
            <div class="event-date-badge">
                <div class="day">02</div>
                <div class="month">APR</div>
            </div>
        </div>
        <div class="event-info">
            <div class="event-venue-tag">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Fine Arts Pavilion
            </div>
            <div class="event-name">Canvas of Dreams</div>
            <div class="event-footer">
                <span class="event-price free">FREE</span>
                <span class="btn-book">RSVP</span>
            </div>
        </div>
    </a>

    {{-- Venue highlight card --}}
    <div class="venue-card">
        <div class="venue-map">
            <img src="https://maps.googleapis.com/maps/api/staticmap?center=-5.3971,105.2668&zoom=15&size=400x200&style=feature:all|element:geometry|color:0x1a1728&style=feature:water|color:0x0d0b16&key=AIzaSyDummy" alt="Map" onerror="this.style.display='none'">
            <div style="position:absolute;inset:0;background:linear-gradient(135deg,#1a1728,#201c30);display:flex;align-items:center;justify-content:center;">
                <svg style="width:36px;height:36px;color:#a855f7;" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
            </div>
        </div>
        <div class="venue-info">
            <div class="venue-name">Central Amphitheater</div>
            <p class="venue-desc">Located at the North end of the Main Library complex. Follow the purple wayfinding lights.</p>
            <a href="#" class="venue-directions">Get Directions →</a>
        </div>
    </div>
</div>

@endsection
