@extends('panitia.layout')

@section('title', 'Dashboard')
@section('subtitle', 'Kelola event Anda')

@section('content')

<div class="panitia-page">

    {{-- HERO BANNER --}}
    <div class="hero-banner">
        <img src="{{ asset('images/megawati.jpg') }}" class="hero-img" alt="Event Unggulan">
        <div class="hero-overlay">
            <p class="hero-label">Event Unggulan</p>
            <h1 class="hero-title">Dies Natalis <span>Konser 2026</span></h1>
            <p class="hero-desc">Rasakan perpaduan orkestra dan seni digital dalam satu malam yang tak terlupakan.</p>
            <div class="hero-actions">
                <a href="{{ route('panitia.manage_event') }}" class="btn-manage">
                    Kelola Event
                </a>
                <button class="btn-details">Lihat Detail</button>
            </div>
        </div>
    </div>

    {{-- STATS --}}
    <div class="stats-row">
        <div class="stat-card">
            <p class="stat-label">Total Peserta</p>
            <p class="stat-value">342</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Dibayar</p>
            <p class="stat-value green">280</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Tertunda</p>
            <p class="stat-value yellow">62</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Pendapatan</p>
            <p class="stat-value">$12,450</p>
        </div>
    </div>

    {{-- CATEGORIES --}}
    <div>
        <div class="section-row">
            <p class="section-title">Jelajahi Kategori</p>
        </div>
        <div class="category-grid">
            <div class="category-card">🎵 Musik</div>
            <div class="category-card">📢 Seminar</div>
            <div class="category-card">🛠 Workshop</div>
            <div class="category-card">⚽ Olahraga</div>
        </div>
    </div>

    {{-- YOUR EVENTS --}}
    <div>
        <div class="section-row">
            <p class="section-title">Event Anda</p>
        </div>
        <div class="events-grid">
            <div class="event-card">
                <img src="{{ asset('images/bahlil.jpg') }}" class="event-thumb" alt="Event">
                <div class="event-info">
                    <p class="event-name">Raja Bahlil</p>
                    <p class="event-meta">Raja Bensin</p>
                    <div class="event-footer">
                        <span class="event-price">$25</span>
                        <span class="badge-active">Aktif</span>
                    </div>
                </div>
            </div>
            <div class="event-card">
                <img src="{{ asset('images/jokowi.jpg') }}" class="event-thumb" alt="Event">
                <div class="event-info">
                    <p class="event-name">Loh Kaget</p>
                    <p class="event-meta">2 Periode</p>
                    <div class="event-footer">
                        <span class="event-price">GRATIS</span>
                        <span class="badge-open">Buka</span>
                    </div>
                </div>
            </div>
            <div class="event-card">
                <img src="{{ asset('images/prabowo.jpg') }}" class="event-thumb" alt="Event">
                <div class="event-info">
                    <p class="event-name">Hidup Jokowi</p>
                    <p class="event-meta">Jendral</p>
                    <div class="event-footer">
                        <span class="event-price">Lokasi</span>
                        <span class="badge-preview">Pratinjau</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
