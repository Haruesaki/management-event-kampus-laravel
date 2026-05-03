@extends('layouts.app')
@section('title', $event->title ?? $event->name)

@push('styles')
<style>
    .event-hero {
        position: relative;
        height: 320px;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 32px;
        display: flex;
        align-items: flex-end;
        padding: 32px;
        background: linear-gradient(135deg, #1e1a30, #2a2040);
    }
    .event-hero-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.85), transparent);
    }
    .event-hero-content { position: relative; z-index: 2; }
    .event-category {
        font-size: 11px; font-weight: 700;
        color: #c47fff; text-transform: uppercase;
        letter-spacing: 0.12em; margin-bottom: 8px;
    }
    .event-title {
        font-family: 'Poppins', sans-serif;
        font-size: 32px; font-weight: 800;
        color: #fff; line-height: 1.2;
        margin-bottom: 8px;
    }
    .event-meta {
        display: flex; gap: 20px; flex-wrap: wrap;
        font-size: 13px; color: #d4cef0;
    }
    .event-meta span { display: flex; align-items: center; gap: 6px; }
    .event-meta svg { width: 14px; height: 14px; }

    .event-body {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 28px;
    }

    .section-title {
        font-family: 'Poppins', sans-serif;
        font-size: 16px; font-weight: 700;
        color: #fff; margin-bottom: 12px;
    }
    .event-description {
        font-size: 14px; line-height: 1.8;
        color: #b0a8cc; margin-bottom: 28px;
    }

    .booking-card {
        background: #1c1829;
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 16px;
        padding: 24px;
        position: sticky;
        top: 80px;
    }
    .price-tag {
        font-family: 'Poppins', sans-serif;
        font-size: 28px; font-weight: 800;
        color: #fff; margin-bottom: 4px;
    }
    .price-tag.free { color: #c47fff; }
    .price-sub { font-size: 12px; color: #9b92bc; margin-bottom: 20px; }
    .info-row {
        display: flex; justify-content: space-between;
        font-size: 13px; padding: 10px 0;
        border-bottom: 1px solid rgba(255,255,255,0.06);
        color: #d4cef0;
    }
    .info-row:last-of-type { border-bottom: none; }
    .info-label { color: #9b92bc; }
    .btn-book-now {
        width: 100%; padding: 14px;
        border-radius: 12px; border: none;
        background: linear-gradient(90deg, #9333ea, #ec4899);
        color: #fff; font-family: 'Poppins', sans-serif;
        font-size: 15px; font-weight: 700;
        cursor: pointer; margin-top: 20px;
        transition: opacity 0.2s, transform 0.15s;
    }
    .btn-book-now:hover { opacity: 0.9; transform: translateY(-1px); }
    .btn-book-now:disabled {
        background: #2a2040; color: #9b92bc; cursor: not-allowed;
        transform: none;
    }
    .alert-success {
        background: rgba(52,211,153,0.1);
        border: 1px solid rgba(52,211,153,0.3);
        color: #6ee7b7; border-radius: 10px;
        padding: 12px 16px; font-size: 13px;
        margin-bottom: 16px;
    }
    .alert-error {
        background: rgba(239,68,68,0.1);
        border: 1px solid rgba(239,68,68,0.3);
        color: #fca5a5; border-radius: 10px;
        padding: 12px 16px; font-size: 13px;
        margin-bottom: 16px;
    }
    .quota-bar-wrap { margin: 16px 0; }
    .quota-label {
        display: flex; justify-content: space-between;
        font-size: 12px; color: #9b92bc; margin-bottom: 6px;
    }
    .quota-bar {
        height: 6px; background: #2a2040;
        border-radius: 99px; overflow: hidden;
    }
    .quota-fill {
        height: 100%;
        background: linear-gradient(90deg, #9333ea, #ec4899);
        border-radius: 99px;
        transition: width 0.4s;
    }
</style>
@endpush

@section('content')

@php
    $title    = $event->title ?? $event->name ?? 'Event';
    $desc     = $event->description ?? 'No description available.';
    $date     = isset($event->event_date) ? \Carbon\Carbon::parse($event->event_date) : \Carbon\Carbon::parse($event->date ?? now());
    $location = $event->location ?? $event->venue ?? '-';
    $price    = $event->ticket_price ?? $event->price ?? 0;
    $quota    = $event->quota ?? 100;
    $registered = $event->registered_count ?? 0;
    $remaining  = $event->remaining_quota ?? ($quota - $registered);
    $category = $event->category ?? '-';
    $color    = $event->color ?? 'linear-gradient(135deg,#1e1a30,#2a2040)';
    $isFull   = $remaining <= 0;
@endphp

{{-- Hero --}}
<div class="event-hero" style="background: {{ $color }};">
    <div class="event-hero-overlay"></div>
    <div class="event-hero-content">
        <div class="event-category">{{ $category }}</div>
        <div class="event-title">{{ $title }}</div>
        <div class="event-meta">
            <span>
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $date->format('d F Y') }}
            </span>
            <span>
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
                {{ $location }}
            </span>
        </div>
    </div>
</div>

{{-- Body --}}
<div class="event-body">

    {{-- Left: Description --}}
    <div>
        <p class="section-title">About This Event</p>
        <p class="event-description">{{ $desc }}</p>
    </div>

    {{-- Right: Booking Card --}}
    <div>
        <div class="booking-card">

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            <div class="price-tag {{ $price == 0 ? 'free' : '' }}">
                {{ $price == 0 ? 'FREE' : 'Rp ' . number_format($price, 0, ',', '.') }}
            </div>
            <div class="price-sub">per person</div>

            <div class="info-row">
                <span class="info-label">Date</span>
                <span>{{ $date->format('d M Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Location</span>
                <span>{{ $location }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Quota</span>
                <span>{{ $quota }} seats</span>
            </div>

            <div class="quota-bar-wrap">
                <div class="quota-label">
                    <span>{{ $registered }} registered</span>
                    <span>{{ $remaining }} left</span>
                </div>
                <div class="quota-bar">
                    <div class="quota-fill" style="width: {{ $quota > 0 ? min(100, ($registered/$quota)*100) : 0 }}%"></div>
                </div>
            </div>

            @auth
                @if($isFull)
                    <button class="btn-book-now" disabled>Quota Full</button>
                @else
                    <form method="POST" action="{{ route('registration.store') }}">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <button type="submit" class="btn-book-now">Book Now</button>
                    </form>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn-book-now" style="display:block; text-align:center; text-decoration:none;">
                    Login to Book
                </a>
            @endauth

        </div>
    </div>
</div>

@endsection