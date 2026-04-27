@extends('layouts.app')
@section('title', 'Pembayaran')

@push('styles')
<style>
    .payment-wrap {
        max-width: 520px;
        margin: 0 auto;
        padding: 20px 0;
    }
    .payment-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 32px;
    }
    .payment-title {
        font-family: 'Syne', sans-serif;
        font-size: 22px; font-weight: 800;
        margin-bottom: 6px;
    }
    .payment-subtitle { font-size: 13px; color: var(--text-2); margin-bottom: 28px; }

    .timer-box {
        background: rgba(239,68,68,0.1);
        border: 1px solid rgba(239,68,68,0.3);
        border-radius: 12px;
        padding: 16px 20px;
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 24px;
    }
    .timer-label { font-size: 12px; color: #fca5a5; text-transform: uppercase; letter-spacing: 0.1em; }
    .timer-countdown {
        font-family: 'Syne', sans-serif;
        font-size: 28px; font-weight: 800;
        color: #ef4444;
    }

    .detail-row {
        display: flex; justify-content: space-between; align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid var(--border);
        font-size: 14px;
    }
    .detail-row:last-child { border-bottom: none; }
    .detail-label { color: var(--text-2); }
    .detail-val { font-weight: 600; }

    .total-row {
        display: flex; justify-content: space-between;
        padding: 16px 0 0;
        margin-top: 8px;
    }
    .total-label { font-size: 15px; font-weight: 700; }
    .total-val {
        font-family: 'Syne', sans-serif;
        font-size: 24px; font-weight: 800;
        color: var(--accent);
    }

    .method-grid {
        display: grid; grid-template-columns: repeat(3, 1fr);
        gap: 10px; margin: 20px 0;
    }
    .method-opt {
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 14px 10px;
        text-align: center;
        cursor: pointer;
        font-size: 13px; font-weight: 600;
        transition: all 0.2s;
        color: var(--text-2);
    }
    .method-opt:hover, .method-opt.selected {
        border-color: var(--accent);
        color: var(--accent);
        background: rgba(168,85,247,0.1);
    }
    .method-opt input { display: none; }

    .btn-pay {
        width: 100%;
        padding: 15px;
        border-radius: 12px;
        background: linear-gradient(90deg, var(--accent), var(--accent-2));
        color: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 15px; font-weight: 700;
        border: none; cursor: pointer;
        margin-top: 8px;
        transition: opacity 0.2s;
    }
    .btn-pay:hover { opacity: 0.9; }
</style>
@endpush

@section('content')
<div class="payment-wrap">
    @if(session('error'))
        <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:10px;padding:12px 16px;color:#fca5a5;margin-bottom:20px;">
            {{ session('error') }}
        </div>
    @endif

    <div class="payment-card">
        <div class="payment-title">Selesaikan Pembayaran</div>
        <div class="payment-subtitle">Segera bayar sebelum waktu habis</div>

        {{-- Timer --}}
        @if($payment && $payment->payment_status === 'Pending')
        <div class="timer-box">
            <div class="timer-label">Batas Waktu</div>
            <div class="timer-countdown" id="timer">05:00</div>
        </div>
        @endif

        {{-- Detail --}}
        <div class="detail-row">
            <span class="detail-label">Event</span>
            <span class="detail-val">{{ $registration->event->title }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Tanggal</span>
            <span class="detail-val">{{ $registration->event->event_date->format('d M Y, H:i') }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Lokasi</span>
            <span class="detail-val">{{ $registration->event->location }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Peserta</span>
            <span class="detail-val">{{ auth()->user()->name }}</span>
        </div>

        <div class="total-row">
            <span class="total-label">Total Pembayaran</span>
            <span class="total-val">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
        </div>

        {{-- Metode Pembayaran --}}
        <form method="POST" action="{{ route('payment.process', $registration->id) }}">
            @csrf
            <div style="font-size:12px;color:var(--text-3);text-transform:uppercase;letter-spacing:0.1em;margin:20px 0 10px;">
                Metode Pembayaran
            </div>
            <div class="method-grid">
                @foreach(['Transfer Bank', 'QRIS', 'E-Wallet'] as $m)
                <label class="method-opt" onclick="selectMethod(this)">
                    <input type="radio" name="payment_method" value="{{ $m }}">
                    {{ $m }}
                </label>
                @endforeach
            </div>
            <button type="submit" class="btn-pay">Bayar Sekarang</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function selectMethod(el) {
    document.querySelectorAll('.method-opt').forEach(e => e.classList.remove('selected'));
    el.classList.add('selected');
    el.querySelector('input').checked = true;
}

// Countdown timer
const expiredAt = new Date("{{ $payment->expired_at->toIso8601String() ?? '' }}");
function updateTimer() {
    const now = new Date();
    const diff = Math.max(0, Math.floor((expiredAt - now) / 1000));
    const m = String(Math.floor(diff / 60)).padStart(2, '0');
    const s = String(diff % 60).padStart(2, '0');
    const el = document.getElementById('timer');
    if (el) {
        el.textContent = `${m}:${s}`;
        if (diff === 0) {
            el.style.color = '#6b7280';
            el.textContent = 'EXPIRED';
            // Auto reload to show expired message
            setTimeout(() => location.reload(), 1000);
        }
    }
}
updateTimer();
setInterval(updateTimer, 1000);

// Select first method by default
document.querySelector('.method-opt')?.click();
</script>
@endpush