@extends('user.layouts.app')
@section('title', 'Discovery')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/user/events.css') }}">
@endpush

@section('content')

<div class="page-header">
    <h1 class="page-title">Discovery</h1>
</div>

{{-- Filter Bar --}}
<form method="GET" action="{{ route('events.index') }}" id="filterForm">
    <div class="filter-bar">
        <div class="filter-search">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
            </svg>
            <input
                type="text" name="search"
                value="{{ request('search') }}"
                placeholder="Search for artists, venues, or campus landmarks..."
                onchange="this.form.submit()"
            >
        </div>
        <div class="filter-select-wrap">
            <select name="date" class="filter-select" onchange="this.form.submit()">
                <option value="">Date: Anytime</option>
                <option value="today" {{ request('date')=='today' ? 'selected' : '' }}>Today</option>
                <option value="week" {{ request('date')=='week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ request('date')=='month' ? 'selected' : '' }}>This Month</option>
            </select>
        </div>
        <div class="filter-select-wrap">
            <select name="category" class="filter-select" onchange="this.form.submit()">
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
            <select name="price" class="filter-select" onchange="this.form.submit()">
                <option value="">Price: Any</option>
                <option value="free" {{ request('price')=='free' ? 'selected' : '' }}>Free</option>
                <option value="paid" {{ request('price')=='paid' ? 'selected' : '' }}>Paid</option>
            </select>
        </div>
        <div class="filter-select-wrap">
            <select name="faculty" class="filter-select" onchange="this.form.submit()">
                <option value="">Faculty: All</option>
                @foreach($faculties ?? [] as $faculty)
                    <option value="{{ $faculty->id }}" {{ request('faculty')==$faculty->id ? 'selected' : '' }}>
                        {{ $faculty->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</form>

{{-- Events Grid --}}
<div class="events-grid">
    @forelse($events as $event)
        <a href="{{ route('events.show', $event->id) }}" class="event-card">
            <div class="card-thumb">
                @if($event->poster_url)
                    <img src="{{ asset($event->poster_url) }}" alt="{{ $event->title }}">
                @else
                    <div class="card-thumb-bg" style="background: linear-gradient(135deg, #1e1a30, #2a2040);"></div>
                @endif
                <div class="date-badge">
                    <div class="d">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</div>
                    <div class="m">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</div>
                </div>
            </div>
            <div class="card-body">
                <div class="card-category">{{ $event->category }}</div>
                <div class="card-title">{{ $event->title }}</div>
                <div class="card-venue">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ $event->location }}
                </div>
                <div class="card-footer">
                    @php
                        $minPrice = $event->tickets->min('price');
                    @endphp
                    @if($minPrice == 0)
                        <span class="card-price free">FREE</span>
                    @else
                        <span class="card-price">Rp {{ number_format($minPrice, 0, ',', '.') }}</span>
                    @endif
                    <span class="btn-book">Book Now</span>
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
