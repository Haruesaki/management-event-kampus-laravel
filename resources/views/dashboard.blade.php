@extends('user.layouts.app')
@section('title', 'Dashboard')

@push('styles')
<style>
    /* Hero Slider */
    .hero-wrapper {
        position: relative;
        width: 100%;
        margin-bottom: 40px;
        min-height: 400px;
    }
    .hero-slider-box {
        position: relative;
        width: 100%;
        height: 440px;
        background: #0B0B0F;
        border-radius: 28px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.05);
    }
    .hero-slide {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        width: 100%;
        height: 100%;
    }
    .hero-bg-img {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        /* Low Brightness */
        filter: brightness(0.25) saturate(0.8);
    }
    .hero-gradient {
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(11,11,15,0.9) 20%, rgba(11,11,15,0.4) 60%, transparent 100%);
    }
    .hero-text-content {
        position: relative;
        z-index: 10;
        padding: 0 60px;
        max-width: 700px;
    }
    .hero-main-title {
        font-family: 'Poppins', sans-serif;
        font-size: 48px;
        font-weight: 800;
        color: #ffffff;
        line-height: 1.15;
        margin-bottom: 16px;
    }
    .hero-main-desc {
        font-size: 15px;
        color: #b0a8cc;
        line-height: 1.6;
        margin-bottom: 32px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Buttons */
    .btn-get-tickets {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 16px 36px;
        background: var(--accent);
        color: #fff;
        text-decoration: none;
        font-weight: 700;
        font-size: 15px;
        border-radius: 16px;
        transition: all 0.3s;
        box-shadow: 0 8px 20px rgba(168,85,247,0.3);
    }
    .btn-get-tickets:hover {
        background: #9333ea;
        transform: translateY(-2px);
    }

    /* Arrows */
    .hero-nav {
        position: absolute; top: 50%; transform: translateY(-50%);
        z-index: 50; width: 44px; height: 44px; border-radius: 50%;
        background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.1);
        color: #fff; display: flex; align-items: center; justify-content: center;
        cursor: pointer; backdrop-filter: blur(10px); transition: all 0.3s;
    }
    .hero-nav:hover { background: var(--accent); border-color: var(--accent); }
    .hero-p { left: 20px; }
    .hero-n { right: 20px; }

    /* Sections */
    .section-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
    .section-title { font-family: 'Poppins', sans-serif; font-size: 22px; font-weight: 700; color: #fff; }
    .view-all { color: var(--accent); text-decoration: none; font-size: 14px; font-weight: 600; }

    .category-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 56px; }
    .category-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: 20px; padding: 24px; text-align: center; text-decoration: none; transition: all 0.3s; }
    .category-card:hover { border-color: var(--accent); transform: translateY(-4px); }
    .cat-icon { width: 50px; height: 50px; border-radius: 14px; background: var(--accent-soft); display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; color: var(--accent); }

    .events-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
    .event-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: 24px; overflow: hidden; text-decoration: none; color: inherit; transition: all 0.3s; }
    .event-card:hover { transform: translateY(-8px); border-color: var(--accent); }
    .event-thumb { position: relative; height: 180px; }
    .event-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .date-badge { position: absolute; top: 16px; left: 16px; background: rgba(15,12,26,0.9); padding: 6px 12px; border-radius: 10px; text-align: center; border: 1px solid rgba(255,255,255,0.1); }
    .date-badge .d { font-size: 18px; font-weight: 800; color: #fff; line-height: 1; }
    .date-badge .m { font-size: 10px; font-weight: 700; color: var(--accent); text-transform: uppercase; }
    .event-body { padding: 20px; }
    .event-name { font-size: 17px; font-weight: 700; color: #fff; margin-bottom: 12px; line-height: 1.4; }
    .event-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 16px; border-top: 1px solid rgba(255,255,255,0.06); }
    .event-price { font-size: 16px; font-weight: 800; color: #fff; }
    .event-price.free { color: #4ade80; }
</style>
@endpush

@section('content')

{{-- Hero Section --}}
<div class="hero-wrapper" x-data="{ 
    active: 0, 
    total: {{ $activeEvents->count() }},
    next() { this.active = (this.active + 1) % this.total },
    prev() { this.active = (this.active - 1 + this.total) % this.total }
}">
    <div class="hero-slider-box">
        @forelse($activeEvents as $idx => $event)
            <div class="hero-slide" x-show="active === {{ $idx }}" x-transition:enter="transition opacity duration-500" x-transition:leave="transition opacity duration-500">
                <div class="hero-bg-img" style="background-image: url('{{ asset($event->poster_url) }}')"></div>
                <div class="hero-gradient"></div>
                <div class="hero-text-content">
                    <h1 class="hero-main-title">{{ $event->title }}</h1>
                    <p class="hero-main-desc">{{ $event->description }}</p>
                    <a href="{{ route('events.show', $event->id) }}" class="btn-get-tickets">
                        Dapatkan Tiket Sekarang
                        <svg style="width:18px; height:18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        @empty
            <div class="hero-slide">
                <div class="hero-bg-img" style="background-image: url('https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=1200')"></div>
                <div class="hero-gradient"></div>
                <div class="hero-text-content">
                    <h1 class="hero-main-title">Selamat Datang di Event Kampus</h1>
                    <p class="hero-main-desc">Temukan berbagai event menarik dari seluruh organisasi kampus di sini.</p>
                </div>
            </div>
        @endforelse
    </div>

    @if($activeEvents->count() > 1)
        <button type="button" class="hero-nav hero-p" @click="prev()">
            <svg style="width:20px; height:20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button type="button" class="hero-nav hero-n" @click="next()">
            <svg style="width:20px; height:20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    @endif
</div>

{{-- Explore Categories --}}
<div class="section-row">
    <h2 class="section-title">Explore Categories</h2>
    <a href="{{ route('events.index') }}" class="view-all">View All</a>
</div>

<div class="category-grid">
    @php
        $cats = [
            ['name' => 'Seminar', 'icon' => 'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z'],
            ['name' => 'Workshop', 'icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z'],
            ['name' => 'Konser', 'icon' => 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3'],
            ['name' => 'Olahraga', 'icon' => 'M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z']
        ];
    @endphp
    @foreach($cats as $c)
        <a href="{{ route('events.index', ['category' => $c['name']]) }}" class="category-card">
            <div class="cat-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $c['icon'] }}" /></svg>
            </div>
            <div style="font-size:14px; font-weight:700; color:#fff;">{{ $c['name'] }}</div>
        </a>
    @endforeach
</div>

{{-- Upcoming Events --}}
<div class="section-row">
    <h2 class="section-title">Upcoming Events</h2>
    <a href="{{ route('events.index') }}" class="view-all">See More</a>
</div>

<div class="events-grid">
    @forelse($upcomingEvents as $event)
        <a href="{{ route('events.show', $event->id) }}" class="event-card">
            <div class="event-thumb">
                <img src="{{ asset($event->poster_url) }}" alt="Event">
                <div class="date-badge">
                    <div class="d">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</div>
                    <div class="m">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</div>
                </div>
            </div>
            <div class="event-body">
                <h3 class="event-name">{{ $event->title }}</h3>
                <div class="event-footer">
                    @php $minPrice = $event->tickets->min('price'); @endphp
                    <span class="event-price {{ $minPrice == 0 ? 'free' : '' }}">
                        {{ $minPrice == 0 ? 'FREE' : 'Rp '.number_format($minPrice, 0, ',', '.') }}
                    </span>
                    <span style="font-size:13px; font-weight:700; color:var(--accent);">View Details →</span>
                </div>
            </div>
        </a>
    @empty
        <div class="col-span-full py-20 text-center text-gray-500">
            Belum ada event mendatang.
        </div>
    @endforelse
</div>

@endsection
