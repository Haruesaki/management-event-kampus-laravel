@extends('layouts.app')
@section('title', 'Discovery')

@push('styles')
<style>
    .page-header { margin-bottom: 28px; }
    .page-label {
        font-size: 11px; color: var(--text-3);
        text-transform: uppercase; letter-spacing: 0.15em;
        margin-bottom: 6px;
    }
    .page-title {
        font-family: 'Syne', sans-serif;
        font-size: 36px; font-weight: 800;
        letter-spacing: -0.02em;
    }

    /* Search & Filter bar */
    .filter-bar {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 32px;
    }
    .filter-search {
        display: flex; align-items: center; gap: 10px;
        flex: 1; min-width: 200px;
        background: var(--bg-card-2);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 10px 14px;
    }
    .filter-search svg { width: 15px; height: 15px; color: var(--text-3); flex-shrink: 0; }
    .filter-search input {
        background: none; border: none; outline: none; flex: 1;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px; color: var(--text-1);
    }
    .filter-search input::placeholder { color: var(--text-3); }
    .filter-select-wrap {
        position: relative;
    }
    .filter-select {
        appearance: none;
        background: var(--bg-card-2);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 10px 36px 10px 14px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px; color: var(--text-1);
        cursor: pointer; outline: none;
        transition: border-color 0.2s;
        white-space: nowrap;
    }
    .filter-select:focus { border-color: var(--accent); }
    .filter-select-wrap::after {
        content: '';
        position: absolute; right: 12px; top: 50%;
        transform: translateY(-50%);
        border: 4px solid transparent;
        border-top-color: var(--text-3);
        pointer-events: none;
        margin-top: 2px;
    }

    /* Events Grid */
    .events-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    .event-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        display: block;
        transition: all 0.25s;
    }
    .event-card:hover {
        transform: translateY(-4px);
        border-color: rgba(168,85,247,0.4);
        box-shadow: 0 12px 40px rgba(0,0,0,0.35);
    }
    .card-thumb {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    .card-thumb img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .event-card:hover .card-thumb img { transform: scale(1.05); }
    .card-thumb-bg {
        width: 100%; height: 100%;
        display: flex; align-items: center; justify-content: center;
    }
    .date-badge {
        position: absolute; top: 14px; left: 14px;
        background: rgba(10,8,20,0.85);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px;
        padding: 8px 12px;
        text-align: center;
        backdrop-filter: blur(10px);
    }
    .date-badge .d { font-family: 'Syne',sans-serif; font-size: 22px; font-weight: 800; line-height: 1; }
    .date-badge .m { font-size: 9px; color: var(--text-3); text-transform: uppercase; letter-spacing: 0.12em; margin-top: 1px; }

    .card-body { padding: 18px; }
    .card-category {
        font-size: 10px; font-weight: 600;
        color: var(--accent); text-transform: uppercase;
        letter-spacing: 0.12em; margin-bottom: 8px;
    }
    .card-title {
        font-family: 'Syne', sans-serif;
        font-size: 17px; font-weight: 700;
        line-height: 1.25; margin-bottom: 8px;
    }
    .card-venue {
        display: flex; align-items: center; gap: 4px;
        font-size: 12px; color: var(--text-3); margin-bottom: 14px;
    }
    .card-venue svg { width: 11px; height: 11px; }
    .card-footer {
        display: flex; align-items: center; justify-content: space-between;
    }
    .card-price {
        font-size: 16px; font-weight: 700;
    }
    .card-price.free { color: var(--accent); }
    .btn-book {
        font-size: 13px; font-weight: 600;
        color: var(--accent); text-decoration: none;
        transition: opacity 0.2s;
    }
    .btn-book:hover { opacity: 0.7; }

    /* Empty state */
    .empty-state {
        grid-column: 1/-1;
        text-align: center; padding: 64px 20px;
        color: var(--text-3);
    }
    .empty-state svg { width: 48px; height: 48px; margin: 0 auto 16px; }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="page-label">Curated Experience</div>
    <h1 class="page-title">Discovery</h1>
</div>

{{-- Filter Bar --}}
<form method="GET" action="{{ route('events.index') }}">
    <div class="filter-bar">
        <div class="filter-search">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
            </svg>
            <input
                type="text" name="search"
                value="{{ request('search') }}"
                placeholder="Search for artists, venues, or campus landmarks..."
            >
        </div>
        <div class="filter-select-wrap">
            <select name="date" class="filter-select">
                <option value="">Date: Anytime</option>
                <option value="today" {{ request('date')=='today' ? 'selected' : '' }}>Today</option>
                <option value="week" {{ request('date')=='week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ request('date')=='month' ? 'selected' : '' }}>This Month</option>
            </select>
        </div>
        <div class="filter-select-wrap">
            <select name="category" class="filter-select">
                <option value="">Category: All</option>
                <option value="music" {{ request('category')=='music' ? 'selected' : '' }}>Music</option>
                <option value="seminar" {{ request('category')=='seminar' ? 'selected' : '' }}>Seminar</option>
                <option value="workshop" {{ request('category')=='workshop' ? 'selected' : '' }}>Workshop</option>
                <option value="sports" {{ request('category')=='sports' ? 'selected' : '' }}>Sports</option>
                <option value="art" {{ request('category')=='art' ? 'selected' : '' }}>Art</option>
            </select>
        </div>
        <div class="filter-select-wrap">
            <select name="price" class="filter-select">
                <option value="">Price: Any</option>
                <option value="free" {{ request('price')=='free' ? 'selected' : '' }}>Free</option>
                <option value="paid" {{ request('price')=='paid' ? 'selected' : '' }}>Paid</option>
            </select>
        </div>
        <div class="filter-select-wrap">
            <select name="faculty" class="filter-select">
                <option value="">Faculty: All</option>
                @foreach($faculties ?? [] as $faculty)
                    <option value="{{ $faculty->id }}" {{ request('faculty')==$faculty->id ? 'selected' : '' }}>
                        {{ $faculty->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" style="background:var(--accent);border:none;border-radius:10px;padding:10px 20px;color:#fff;font-family:'DM Sans',sans-serif;font-size:13px;font-weight:600;cursor:pointer;">
            Search
        </button>
    </div>
</form>

{{-- Events Grid --}}
<div class="events-grid">
    @forelse($events ?? $dummyEvents ?? [] as $event)
        <a href="{{ route('events.show', $event->id ?? $event['id']) }}" class="event-card">
            <div class="card-thumb">
                @if(!empty($event->thumbnail ?? $event['thumbnail'] ?? null))
                    <img src="{{ asset('storage/' . ($event->thumbnail ?? $event['thumbnail'])) }}" alt="{{ $event->name ?? $event['name'] }}">
                @else
                    <div class="card-thumb-bg" style="background:{{ $event->color ?? $event['color'] ?? 'linear-gradient(135deg,#1e1a30,#2a2040)' }};">
                    </div>
                @endif
                <div class="date-badge">
                    <div class="d">{{ \Carbon\Carbon::parse($event->date ?? $event['date'])->format('d') }}</div>
                    <div class="m">{{ \Carbon\Carbon::parse($event->date ?? $event['date'])->format('M') }}</div>
                </div>
            </div>
            <div class="card-body">
                <div class="card-category">{{ $event->category ?? $event['category'] }}</div>
                <div class="card-title">{{ $event->name ?? $event['name'] }}</div>
                <div class="card-venue">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ $event->venue ?? $event['venue'] }}
                </div>
                <div class="card-footer">
                    @if(($event->price ?? $event['price'] ?? 0) == 0)
                        <span class="card-price free">FREE</span>
                        <a href="{{ route('events.show', $event->id ?? $event['id']) }}" class="btn-book">Book Now</a>
                    @else
                        <span class="card-price">${{ number_format($event->price ?? $event['price'], 2) }}</span>
                        <a href="{{ route('events.show', $event->id ?? $event['id']) }}" class="btn-book">Book Now</a>
                    @endif
                </div>
            </div>
        </a>
    @empty
        {{-- Dummy cards for UI preview when no data --}}
        @php
        $dummies = [
            ['id'=>1,'date'=>'2024-10-12','category'=>'Electronic Arts','name'=>'Neon Nocturne: Digital Symphony','venue'=>'Main Plaza Auditorium','price'=>24,'color'=>'linear-gradient(135deg,#1a1030,#2a1060)'],
            ['id'=>2,'date'=>'2024-10-15','category'=>'Classical Fusion','name'=>'Shadows & Strings Ensemble','venue'=>'The Velvet Chamber','price'=>18.50,'color'=>'linear-gradient(135deg,#0d1f1a,#1a3530)'],
            ['id'=>3,'date'=>'2024-10-18','category'=>'Dramatic Arts','name'=>"The Alchemist's Monologue",'venue'=>'Drama Theater South','price'=>0,'color'=>'linear-gradient(135deg,#1f1510,#3a2010)'],
            ['id'=>4,'date'=>'2024-10-20','category'=>'Visual Media','name'=>'Illumination Fest: VR Expo','venue'=>'Innovation Gallery','price'=>12,'color'=>'linear-gradient(135deg,#0d0d2f,#1a1a5f)'],
            ['id'=>5,'date'=>'2024-10-22','category'=>'Literary Arts','name'=>'Midnight Poetry & Jazz','venue'=>'Founders Library','price'=>15,'color'=>'linear-gradient(135deg,#1f1510,#3a2508)'],
            ['id'=>6,'date'=>'2024-10-25','category'=>'Modern Sculpture','name'=>'Future Forms: Kinetic Art','venue'=>'Design Atrium','price'=>10,'color'=>'linear-gradient(135deg,#0d1a1f,#0a2a35)'],
        ];
        @endphp
        @foreach($dummies as $d)
        <a href="{{ route('events.show', $d['id']) }}" class="event-card">
            <div class="card-thumb">
                <div class="card-thumb-bg" style="background: {{ $d['color'] }};"></div>
                <div class="date-badge">
                    <div class="d">{{ \Carbon\Carbon::parse($d['date'])->format('d') }}</div>
                    <div class="m">{{ \Carbon\Carbon::parse($d['date'])->format('M') }}</div>
                </div>
            </div>
            <div class="card-body">
                <div class="card-category">{{ $d['category'] }}</div>
                <div class="card-title">{{ $d['name'] }}</div>
                <div class="card-venue">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ $d['venue'] }}
                </div>
                <div class="card-footer">
                    @if($d['price'] == 0)
                        <span class="card-price free">FREE</span>
                    @else
                        <span class="card-price">${{ number_format($d['price'], 2) }}</span>
                    @endif
                    <span class="btn-book">Book Now</span>
                </div>
            </div>
        </a>
        @endforeach
    @endforelse
</div>

{{-- Pagination (only shown when $events is a Paginator instance) --}}
@if(isset($events) && is_object($events) && method_exists($events, 'hasPages') && $events->hasPages())
<div style="margin-top:36px; display:flex; justify-content:center;">
    {{ $events->appends(request()->query())->links() }}
</div>
@endif

@endsection
