@extends('user.layouts.app')
@section('title', 'My Tickets')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/user/tickets.css') }}">
<style>
    .ticket-type-badge {
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .badge-paid { background: rgba(168,85,247,0.2); color: #d8b4fe; border: 1px solid rgba(168,85,247,0.3); }
    .badge-free { background: rgba(34,197,94,0.2); color: #4ade80; border: 1px solid rgba(34,197,94,0.3); }
    .status-badge {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }
    .status-pending { background: rgba(245,158,11,0.2); color: #fbbf24; border: 1px solid rgba(245,158,11,0.3); }
    .status-success { background: rgba(34,197,94,0.2); color: #4ade80; border: 1px solid rgba(34,197,94,0.3); }
    .status-rejected { background: rgba(239,68,68,0.2); color: #f87171; border: 1px solid rgba(239,68,68,0.3); }
</style>
@endpush

@section('content')

{{-- Alert Status --}}
@if(session('success'))
    <div style="background: rgba(34,197,94,0.1); border: 1px solid #22c55e; color: #4ade80; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background: rgba(239,68,68,0.1); border: 1px solid #ef4444; color: #f87171; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
        {{ session('error') }}
    </div>
@endif

@if(request()->status == 'success')
    <div style="background: rgba(34,197,94,0.1); border: 1px solid #22c55e; color: #4ade80; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
        Pembayaran berhasil! Tiket Anda sedang diproses.
    </div>
@elseif(request()->status == 'pending')
    <div style="background: rgba(245,158,11,0.1); border: 1px solid #f59e0b; color: #fbbf24; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
        Pembayaran sedang menunggu konfirmasi.
    </div>
@endif

{{-- Header --}}
<div class="bookings-header">
    <div class="bookings-label">Your Collection</div>
    <h1 class="bookings-title">My Tickets</h1>
    <p class="bookings-desc">
        Kelola tiket event Anda dan persiapkan diri untuk pengalaman kampus yang tak terlupakan.
    </p>
</div>

{{-- Active Tickets --}}
<div class="section-row">
    <div class="section-heading">
        <div class="active-dot"></div>
        Active Tickets
    </div>
    <span class="count-badge">{{ $registrations->count() }} Tickets Owned</span>
</div>

<div class="active-tickets-grid">
    @forelse($registrations as $reg)
    <div class="ticket-card">
        <div class="ticket-image">
            @if($reg->event->poster_url)
                <img src="{{ asset($reg->event->poster_url) }}" alt="{{ $reg->event->title }}">
            @else
                <div class="ticket-image-bg">
                    <svg style="width:32px;height:32px;color:#2a2040;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13"/>
                    </svg>
                </div>
            @endif
            <div class="ticket-badge">{{ $reg->event->category }}</div>
        </div>
        <div class="ticket-body">
            <div class="ticket-type-row">
                <span class="ticket-type-badge {{ $reg->ticket->type === 'Gratis' ? 'badge-free' : 'badge-paid' }}">
                    {{ $reg->ticket->type }}
                </span>
                @if($reg->ticket->type === 'Berbayar' && $reg->payment)
                    <span class="status-badge status-{{ strtolower($reg->payment->payment_status) }}">
                        {{ $reg->payment->payment_status }}
                    </span>
                @endif
                <div class="ticket-id">ORDER ID: #{{ str_pad($reg->id, 5, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="ticket-event-name">{{ $reg->event->title }}</div>
            <div class="ticket-datetime">
                {{ \Carbon\Carbon::parse($reg->event->event_date)->format('l, d M Y') }} • {{ $reg->event->gates_open ?? '08:00 AM' }}
            </div>
            
            <div style="margin-top: 20px; padding: 12px; background: rgba(255,255,255,0.03); border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                <div style="font-size: 10px; color: var(--text-3); text-transform: uppercase; margin-bottom: 4px;">Ticket Variant</div>
                <div style="font-size: 14px; font-weight: 700; color: #fff;">{{ $reg->ticket->name }}</div>
            </div>

            @if($reg->ticket->type === 'Gratis' || ($reg->payment && $reg->payment->payment_status === 'Success'))
                <a href="#" class="download-btn" style="margin-top: 20px;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download E-Ticket
                </a>
            @elseif($reg->payment && $reg->payment->payment_status === 'Pending')
                <div style="margin-top: 20px; display: flex; flex-direction: column; gap: 10px;">
                    <div style="text-align: center; color: #fbbf24; font-size: 14px; font-weight: 600;">
                        Menunggu Pembayaran
                    </div>
                    <button onclick="payPending('{{ $reg->payment->snap_token }}')" class="download-btn" style="background: #fbbf24; color: #000; border: none;">
                        Bayar Sekarang
                    </button>
                </div>
            @else
                <div style="margin-top: 20px; text-align: center; color: #f87171; font-size: 14px; font-weight: 600;">
                    Pembayaran Gagal/Expired
                </div>
            @endif
        </div>
    </div>
    @empty
    <div class="col-span-full py-20 text-center" style="background: var(--bg-card); border-radius: 24px; border: 1px dashed var(--border);">
        <svg style="width:48px; height:48px; color: var(--text-3); margin-bottom: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
        </svg>
        <h3 style="color: #fff; font-size: 18px; font-weight: 700;">Belum Ada Tiket</h3>
        <p style="color: var(--text-3); font-size: 14px; margin-top: 8px;">Jelajahi berbagai event seru dan pesan tiket Anda sekarang!</p>
        <a href="{{ route('events.index') }}" class="btn-cta" style="margin-top: 24px; display: inline-block;">Mulai Cari Event</a>
    </div>
    @endforelse
</div>

{{-- CTA --}}
@if($registrations->count() > 0)
<div class="cta-section" style="margin-top: 60px;">
    <div>
        <div class="cta-title">Ingin Cari Event Lain?</div>
        <p class="cta-desc">Temukan berbagai pengalaman baru yang diselenggarakan oleh organisasi kampus.</p>
    </div>
    <a href="{{ route('events.index') }}" class="btn-cta">Cari Event Lainnya</a>
</div>
@endif

@endsection

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    function payPending(snapToken) {
        snap.pay(snapToken, {
            onSuccess: function(result){ window.location.reload(); },
            onPending: function(result){ window.location.reload(); },
            onError: function(result){ window.location.reload(); }
        });
    }
</script>
@endpush
