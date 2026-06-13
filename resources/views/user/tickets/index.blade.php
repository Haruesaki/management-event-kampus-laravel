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

    /* Tabs Styling */
    .tab-container {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        border-bottom: 1px solid var(--border);
        padding-bottom: 10px;
    }
    .tab-item {
        color: var(--text-3);
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        padding: 8px 16px;
        border-radius: 10px;
        transition: all 0.3s;
    }
    .tab-item.active {
        color: #fff;
        background: rgba(168,85,247,0.1);
        box-shadow: 0 0 15px rgba(168,85,247,0.1);
    }

    /* Modern Button Styling */
    .btn-action {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 14px;
        transition: all 0.3s;
        width: 100%;
        text-decoration: none;
    }
    .btn-download {
        background: linear-gradient(135deg, #6366f1, #a855f7);
        color: white;
        border: none;
        box-shadow: 0 4px 15px rgba(168,85,247,0.3);
    }
    .btn-download:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(168,85,247,0.4);
    }
    .btn-pay {
        background: #fbbf24;
        color: #000;
        border: none;
        box-shadow: 0 4px 15px rgba(251,191,36,0.3);
    }
    .btn-pay:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(251,191,36,0.4);
    }
    .btn-disabled {
        background: rgba(255,255,255,0.05);
        color: var(--text-3);
        cursor: not-allowed;
    }

    [x-cloak] { display: none !important; }
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

{{-- Header --}}
<div class="bookings-header">
    <div class="bookings-label">Your Collection</div>
    <h1 class="bookings-title">My Tickets</h1>
    <p class="bookings-desc">
        Kelola tiket event Anda dan pantau riwayat transaksi pendaftaran Anda di sini.
    </p>
</div>

<div x-data="{ tab: 'tickets' }">
    {{-- Tabs --}}
    <div class="tab-container">
        <div class="tab-item" :class="{ 'active': tab === 'tickets' }" @click="tab = 'tickets'">
            Tiket Saya
        </div>
        <div class="tab-item" :class="{ 'active': tab === 'transactions' }" @click="tab = 'transactions'">
            Transaksi
        </div>
    </div>

    {{-- Content Tiket Saya --}}
    <div x-show="tab === 'tickets'">
        <div class="section-row">
            <div class="section-heading">
                <div class="active-dot"></div>
                Active Tickets
            </div>
            <span class="count-badge">{{ $activeTickets->count() }} Tickets Owned</span>
        </div>

        <div class="active-tickets-grid">
            @forelse($activeTickets as $reg)
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
                        <div class="ticket-id">ORDER ID: #{{ str_pad($reg->id, 5, '0', STR_PAD_LEFT) }}</div>
                    </div>
                    <div class="ticket-event-name">{{ $reg->event->title }}</div>
                    <div class="ticket-datetime">
                        {{ \Carbon\Carbon::parse($reg->event->event_date)->format('l, d M Y') }} • {{ $reg->event->gates_open ?? '08:00 AM' }}
                    </div>
                    
                    <div style="margin-top: 15px; padding: 12px; background: rgba(255,255,255,0.03); border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                        <div style="font-size: 10px; color: var(--text-3); text-transform: uppercase; margin-bottom: 4px;">Ticket Variant</div>
                        <div style="font-size: 14px; font-weight: 700; color: #fff;">{{ $reg->ticket->name }}</div>
                    </div>

                    <div style="margin-top: auto; padding-top: 20px;">
                        <a href="{{ route('tickets.download', $reg->id) }}" class="btn-action btn-download">
                            <svg style="width:18px;height:18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Download E-Ticket
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center" style="background: var(--bg-card); border-radius: 24px; border: 1px dashed var(--border);">
                <svg style="width:48px; height:48px; color: var(--text-3); margin-bottom: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                </svg>
                <h3 style="color: #fff; font-size: 18px; font-weight: 700;">Belum Ada Tiket Aktif</h3>
                <p style="color: var(--text-3); font-size: 14px; margin-top: 8px;">Semua tiket yang berhasil Anda beli atau pesan akan muncul di sini.</p>
                <a href="{{ route('events.index') }}" class="btn-cta" style="margin-top: 24px; display: inline-block;">Mulai Cari Event</a>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Content Transaksi --}}
    <div x-show="tab === 'transactions'" x-cloak>
        <div class="section-row">
            <div class="section-heading">
                Riwayat Transaksi
            </div>
            <span class="count-badge">{{ $transactions->count() }} Total Pendaftaran</span>
        </div>

        <div class="active-tickets-grid">
            @forelse($transactions as $reg)
            <div class="ticket-card" style="{{ $reg->payment && $reg->payment->payment_status === 'Rejected' ? 'opacity: 0.7;' : '' }}">
                <div class="ticket-image">
                    @if($reg->event->poster_url)
                        <img src="{{ asset($reg->event->poster_url) }}" alt="{{ $reg->event->title }}">
                    @else
                        <div class="ticket-image-bg">
                            <svg style="width:24px;height:24px;color:#2a2040;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13"/>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="ticket-body">
                    <div class="ticket-type-row">
                        @if($reg->ticket->type === 'Berbayar' && $reg->payment)
                            <span class="status-badge status-{{ strtolower($reg->payment->payment_status) }}">
                                {{ $reg->payment->payment_status }}
                            </span>
                        @elseif($reg->ticket->type === 'Gratis')
                            <span class="status-badge status-success">Success</span>
                        @endif
                        <div class="ticket-id">#{{ str_pad($reg->id, 5, '0', STR_PAD_LEFT) }}</div>
                    </div>
                    <div class="ticket-event-name" style="font-size: 15px;">{{ $reg->event->title }}</div>
                    <div class="ticket-datetime" style="margin-bottom: 10px;">
                        {{ \Carbon\Carbon::parse($reg->created_at)->format('d M Y, H:i') }}
                    </div>
                    
                    <div style="font-size: 12px; color: #fff; font-weight: 600;">
                        {{ $reg->ticket->name }} 
                        <span style="color: var(--text-3); font-weight: 400; margin-left: 5px;">
                            ({{ $reg->ticket->type === 'Gratis' ? 'Gratis' : ($reg->payment ? 'Rp ' . number_format($reg->payment->amount, 0, ',', '.') : 'N/A') }})
                        </span>
                    </div>

                    <div style="margin-top: auto; padding-top: 15px;">
                        @if($reg->payment && $reg->payment->payment_status === 'Pending')
                            <button onclick="payPending('{{ $reg->payment->snap_token }}')" class="btn-action btn-pay">
                                <svg style="width:18px;height:18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                                Bayar Sekarang
                            </button>
                        @elseif($reg->payment && $reg->payment->payment_status === 'Success')
                            <div class="btn-action btn-disabled" style="background: rgba(34,197,94,0.1); color: #4ade80;">
                                Pembayaran Berhasil
                            </div>
                        @elseif($reg->payment && $reg->payment->payment_status === 'Rejected')
                            <div class="btn-action btn-disabled" style="background: rgba(239,68,68,0.1); color: #f87171;">
                                Gagal / Expired
                            </div>
                        @elseif($reg->ticket->type === 'Gratis')
                            <div class="btn-action btn-disabled" style="background: rgba(34,197,94,0.1); color: #4ade80;">
                                Terdaftar (Gratis)
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center" style="background: var(--bg-card); border-radius: 24px; border: 1px dashed var(--border);">
                <h3 style="color: #fff; font-size: 18px; font-weight: 700;">Belum Ada Transaksi</h3>
            </div>
            @endforelse
        </div>
    </div>
</div>

{{-- CTA --}}
<div class="cta-section" style="margin-top: 60px;">
    <div>
        <div class="cta-title">Ingin Cari Event Lain?</div>
        <p class="cta-desc">Temukan berbagai pengalaman baru yang diselenggarakan oleh organisasi kampus.</p>
    </div>
    <a href="{{ route('events.index') }}" class="btn-cta">Cari Event Lainnya</a>
</div>

@endsection

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    function payPending(snapToken) {
        snap.pay(snapToken, {
            onSuccess: function(result){ 
                alert('Pembayaran berhasil!');
                window.location.reload(); 
            },
            onPending: function(result){ 
                alert('Menunggu pembayaran anda.');
                window.location.reload(); 
            },
            onError: function(result){ 
                alert('Pembayaran gagal.');
                window.location.reload(); 
            },
            onClose: function(){
                console.log('User closed the popup without finishing the payment');
            }
        });
    }
</script>
@endpush
