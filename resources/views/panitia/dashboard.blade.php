@extends('panitia.layout')

@section('title', 'Dashboard')
@section('subtitle', 'Manage your event')

@section('content')

<div class="panitia-page">

    {{-- HERO BANNER --}}
    <div class="hero-banner">
        <img src="{{ asset('images/megawati.jpg') }}" class="hero-img" alt="Featured Event">
        <div class="hero-overlay">
            <p class="hero-label">Featured Event</p>
            <h1 class="hero-title">Dies Natalis <span>Concert 2026</span></h1>
            <p class="hero-desc">Experience an orchestral fusion and digital arts in one unforgettable night.</p>
            <div class="hero-actions">
                <a href="{{ route('panitia.events') }}" class="btn-manage">
                    Manage Event
                </a>
                <button class="btn-details">View Details</button>
            </div>
        </div>
    </div>

    {{-- STATS --}}
    <div class="stats-row">
        <div class="stat-card">
            <p class="stat-label">Total Attendees</p>
            <p class="stat-value">342</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Paid</p>
            <p class="stat-value green">280</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Pending</p>
            <p class="stat-value yellow">62</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Revenue</p>
            <p class="stat-value">$12,450</p>
        </div>
    </div>

    {{-- CATEGORIES --}}
    <div>
        <div class="section-row">
            <p class="section-title">Explore Categories</p>
        </div>
        <div class="category-grid">
            <div class="category-card">🎵 Music</div>
            <div class="category-card">📢 Seminar</div>
            <div class="category-card">🛠 Workshop</div>
            <div class="category-card">⚽ Sports</div>
        </div>
    </div>

    {{-- YOUR EVENTS --}}
    <div>
        <div class="section-row">
            <p class="section-title">Your Events</p>
        </div>
        <div class="events-grid">
            <div class="event-card">
                <img src="{{ asset('images/bahlil.jpg') }}" class="event-thumb" alt="Event">
                <div class="event-info">
                    <p class="event-name">King Bahlil</p>
                    <p class="event-meta">The King Of Gasoline</p>
                    <div class="event-footer">
                        <span class="event-price">$25</span>
                        <span class="badge-active">Active</span>
                    </div>
                </div>
            </div>
            <div class="event-card">
                <img src="{{ asset('images/jokowi.jpg') }}" class="event-thumb" alt="Event">
                <div class="event-info">
                    <p class="event-name">Loh Kaget</p>
                    <p class="event-meta">2 Periode</p>
                    <div class="event-footer">
                        <span class="event-price">FREE</span>
                        <span class="badge-open">Open</span>
                    </div>
                </div>
            </div>
            <div class="event-card">
                <img src="{{ asset('images/prabowo.jpg') }}" class="event-thumb" alt="Event">
                <div class="event-info">
                    <p class="event-name">Hidup Jokowi</p>
                    <p class="event-meta">Jendral</p>
                    <div class="event-footer">
                        <span class="event-price">Location</span>
                        <span class="badge-preview">Preview</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- RECENT ATTENDEES --}}
    <div class="attendees-table">
        <p class="section-title" style="margin-bottom:16px;">Recent Attendees</p>
        <div class="attendee-row">
            <span class="attendee-name">Aria Vance</span>
            <span class="attendee-status pending">Pending</span>
            <button class="btn-confirm">Confirm</button>
        </div>
        <div class="attendee-row">
            <span class="attendee-name">Kaelen Moore</span>
            <span class="attendee-status paid">Paid</span>
            <span style="margin-left:16px; color:#555; font-size:13px;">—</span>
        </div>
    </div>

</div>

@endsection