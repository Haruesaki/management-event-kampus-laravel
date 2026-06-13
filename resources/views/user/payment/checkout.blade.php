@extends('user.layouts.app')

@section('title', 'Pembayaran Tiket')

@push('styles')
<style>
    .payment-container {
        max-width: 600px;
        margin: 100px auto;
        padding: 40px;
        background: #1a1a1a;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        text-align: center;
        color: #fff;
    }
    .payment-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 20px;
    }
    .payment-details {
        text-align: left;
        margin-bottom: 30px;
        background: #222;
        padding: 20px;
        border-radius: 12px;
    }
    .payment-detail-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 16px;
    }
    .payment-detail-label {
        color: #888;
    }
    .btn-pay {
        background: #ff2d55;
        color: #fff;
        border: none;
        padding: 15px 40px;
        font-size: 18px;
        font-weight: 600;
        border-radius: 50px;
        cursor: pointer;
        transition: 0.3s;
        width: 100%;
    }
    .btn-pay:hover {
        background: #e0244a;
        transform: translateY(-2px);
    }
</style>
@endpush

@section('content')
<div class="payment-container">
    <div class="payment-title">Konfirmasi Pembayaran</div>
    
    <div class="payment-details">
        <div class="payment-detail-item">
            <span class="payment-detail-label">Event</span>
            <span>{{ $registration->event->title }}</span>
        </div>
        <div class="payment-detail-item">
            <span class="payment-detail-label">Jenis Tiket</span>
            <span>{{ $registration->ticket->name }}</span>
        </div>
        <div class="payment-detail-item">
            <span class="payment-detail-label">Total Bayar</span>
            <span style="font-weight: 700; color: #ff2d55;">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
        </div>
    </div>

    <button id="pay-button" class="btn-pay">Bayar Sekarang</button>
</div>
@endsection

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{ $snapToken }}', {
            // Optional
            onSuccess: function(result){
                /* You may add your own js here, this is just example */
                window.location.href = "{{ route('tickets.index') }}?status=success";
            },
            // Optional
            onPending: function(result){
                /* You may add your own js here, this is just example */
                window.location.href = "{{ route('tickets.index') }}?status=pending";
            },
            // Optional
            onError: function(result){
                /* You may add your own js here, this is just example */
                window.location.href = "{{ route('tickets.index') }}?status=error";
            }
        });
    };
</script>
@endpush
