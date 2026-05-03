@extends('layouts.app')
@section('title', 'Discovery')

@push('styles')
<style>
    .page-header { margin-bottom: 28px; }
    .page-label {
        font-size: 11px; color: #9b92bc;
        text-transform: uppercase; letter-spacing: 0.15em;
        margin-bottom: 6px;
    }
    .page-title {
        font-family: 'Poppins', sans-serif;
        font-size: 36px; font-weight: 800;
        letter-spacing: -0.01em;
        color: #ffffff;
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
        margin-bottom: 32px;
        overflow-x: auto;
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
    .btn-search {
        background: var(--accent);
        border: none; border-radius: 10px;
        padding: 10px 20px; color: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px; font-weight: 600;
        cursor: pointer;
        transition: background 0.2s, transform 0.15s;
        white-space: nowrap;
    }
    .btn-search:hover { background: #9333ea; transform: translateY(-1px); }

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
        z-index: 2;
    }
    .date-badge .d { font-family: 'Poppins',sans-serif; font-size: 22px; font-weight: 800; line-height: 1; color: var(--text-1); }
    .date-badge .m { font-size: 9px; color: var(--text-3); text-transform: uppercase; letter-spacing: 0.12em; margin-top: 1px; }

    .card-body { padding: 18px; }
    .card-category {
        font-size: 10px; font-weight: 700;
        color: #c47fff; text-transform: uppercase;
        letter-spacing: 0.12em; margin-bottom: 8px;
    }
    .card-title {
        font-family: 'Poppins', sans-serif;
        font-size: 17px; font-weight: 700;
        line-height: 1.25; margin-bottom: 8px;
        color: #ffffff;
    }
    .card-venue {
        display: flex; align-items: center; gap: 4px;
        font-size: 12px; color: #b0a8cc; margin-bottom: 14px;
    }
    .card-venue svg { width: 11px; height: 11px; }
    .card-footer {
        display: flex; align-items: center; justify-content: space-between;
    }
    .card-price {
        font-size: 16px; font-weight: 700;
        color: #ffffff;
    }
    .card-price.free { color: #c47fff; }
    .btn-book {
        font-family: 'Poppins', sans-serif;
        font-size: 13px; font-weight: 600;
        color: #c47fff; text-decoration: none;
        transition: opacity 0.2s;
        background: none; border: none; cursor: pointer;
    }
    .btn-book:hover { opacity: 0.7; }

    /* Empty state */
    .empty-state {
        grid-column: 1/-1;
        text-align: center; padding: 64px 20px;
        color: var(--text-3);
    }
    .empty-state svg { width: 48px; height: 48px; margin: 0 auto 16px; display: block; }
    .empty-state h3 { font-family: 'Syne', sans-serif; font-size: 18px; font-weight: 700; color: var(--text-2); margin-bottom: 8px; }
    .empty-state p { font-size: 13px; }
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
                <option value="technology" {{ request('category')=='technology' ? 'selected' : '' }}>Technology</option>
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
        <button type="submit" class="btn-search">Search</button>
    </div>
</form>

{{-- Events Grid --}}
<div class="events-grid">
    @php
        $eventList = $events ?? [];
        // If events is an Eloquent collection or paginator, convert properly
        if (is_object($eventList) && method_exists($eventList, 'toArray')) {
            $eventList = $eventList->items ?? $eventList;
        }
    @endphp

    @forelse($eventList as $event)
        @php
            // Support both array and object
            $eId       = is_array($event) ? $event['id']       : $event->id;
            $eName     = is_array($event) ? $event['name']      : $event->name;
            $eCategory = is_array($event) ? $event['category']  : $event->category;
            $eVenue    = is_array($event) ? $event['venue']     : $event->venue;
            $ePrice    = is_array($event) ? ($event['price'] ?? 0) : ($event->price ?? 0);
            $eDate     = is_array($event) ? $event['date']      : $event->date;
            $eColor    = is_array($event) ? ($event['color'] ?? 'linear-gradient(135deg,#1e1a30,#2a2040)') : ($event->color ?? 'linear-gradient(135deg,#1e1a30,#2a2040)');
            $eThumb    = is_array($event) ? ($event['thumbnail'] ?? null) : ($event->thumbnail ?? null);
        @endphp
        <a href="{{ route('events.show', $eId) }}" class="event-card">
            <div class="card-thumb">
                @if($eThumb)
                    <img src="{{ asset('storage/' . $eThumb) }}" alt="{{ $eName }}">
                @else
                    <div class="card-thumb-bg" style="background: {{ $eColor }};"></div>
                @endif
                <div class="date-badge">
                    <div class="d">{{ \Carbon\Carbon::parse($eDate)->format('d') }}</div>
                    <div class="m">{{ \Carbon\Carbon::parse($eDate)->format('M') }}</div>
                </div>
            </div>
            <div class="card-body">
                <div class="card-category">{{ $eCategory }}</div>
                <div class="card-title">{{ $eName }}</div>
                <div class="card-venue">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ $eVenue }}
                </div>
                <div class="card-footer">
                    @if($ePrice == 0)
                        <span class="card-price free">FREE</span>
                        <span class="btn-book">Book Now</span>
                    @else
                        <span class="card-price">${{ number_format($ePrice, 2) }}</span>
                        <span class="btn-book">Book Now</span>
                    @endif
                </div>
            </div>
        </a>
    @empty
        <div class="empty-state">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3>No Events Found</h3>
            <p>Try adjusting your search or filter criteria.</p>
        </div>
    @endforelse
</div>

{{-- Pagination --}}
@if(isset($events) && is_object($events) && method_exists($events, 'hasPages') && $events->hasPages())
<div style="margin-top:36px; display:flex; justify-content:center;">
    {{ $events->appends(request()->query())->links() }}
</div>
@endif

@endsection
