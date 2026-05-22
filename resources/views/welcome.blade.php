@extends('user.layouts.app')
@section('title', 'Discovery')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/user/events.css') }}">
@endpush

@section('content')

{{-- Welcome Identification Section --}}
<div style="margin-bottom: 40px; padding: 24px; background: var(--bg-card); border: 1px solid var(--border); border-radius: 20px;">
    <h2 style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 700; color: #fff; margin-bottom: 8px;">
        Halo, saya Ahmad Doni Jalaludin
    </h2>
    <p style="color: var(--text-3); font-size: 14px;">
        NPM: 2407051022 — Selamat datang di Manajemen Event Kampus.
    </p>
</div>

<div class="page-header">
    <h1 class="page-title">Discovery</h1>
</div>

{{-- Filter Bar --}}
<form method="GET" action="/" id="filterForm">
    <div class="filter-bar">
        <div class="filter-search">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for events..." onchange="this.form.submit()">
        </div>
        <div class="filter-select-wrap">
            <select name="category" class="filter-select" onchange="this.form.submit()">
                <option value="">Category: All</option>
                <option value="music" {{ request('category')=='music' ? 'selected' : '' }}>Music</option>
                <option value="seminar" {{ request('category')=='seminar' ? 'selected' : '' }}>Seminar</option>
                <option value="workshop" {{ request('category')=='workshop' ? 'selected' : '' }}>Workshop</option>
                <option value="sports" {{ request('category')=='sports' ? 'selected' : '' }}>Sports</option>
            </select>
        </div>
        <div class="filter-select-wrap">
            <select name="price" class="filter-select" onchange="this.form.submit()">
                <option value="">Price: Any</option>
                <option value="free" {{ request('price')=='free' ? 'selected' : '' }}>Free</option>
                <option value="paid" {{ request('price')=='paid' ? 'selected' : '' }}>Paid</option>
            </select>
        </div>
    </div>
</form>

{{-- Events Grid --}}
<div class="events-grid">
    @forelse($upcomingEvents as $event)
        <a href="{{ route('login') }}" class="event-card">
            <div class="card-thumb">
                <div class="card-thumb-bg" style="background: linear-gradient(135deg, #1e1a30, #2a2040);"></div>
                <div class="date-badge">
                    <div class="d">{{ \Carbon\Carbon::parse($event['date'])->format('d') }}</div>
                    <div class="m">{{ \Carbon\Carbon::parse($event['date'])->format('M') }}</div>
                </div>
            </div>
            <div class="card-body">
                <div class="card-category">{{ $event['category'] }}</div>
                <div class="card-title">{{ $event['name'] }}</div>
                <div class="card-venue">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ $event['venue'] }}
                </div>
                <div class="card-footer">
                    @if(($event['price'] ?? 0) == 0)
                        <span class="card-price free">FREE</span>
                    @else
                        <span class="card-price">${{ number_format($event['price'], 2) }}</span>
                    @endif
                    <span class="btn-book">Join Event</span>
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
@endsection
