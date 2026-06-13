<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>E-Ticket - {{ $registration->event->title }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .ticket-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border: 2px solid #5b21b6;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
        }
        .header {
            background-color: #5b21b6;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .body {
            padding: 30px;
            background-color: #fff;
        }
        .event-title {
            font-size: 22px;
            font-weight: bold;
            color: #1e1b4b;
            margin-bottom: 10px;
        }
        .info-row {
            margin-bottom: 15px;
            display: flex;
            clear: both;
        }
        .info-label {
            width: 120px;
            font-weight: bold;
            color: #6b7280;
            float: left;
        }
        .info-value {
            margin-left: 130px;
            color: #111827;
        }
        .qr-section {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px dashed #e5e7eb;
        }
        .order-id {
            font-family: 'Courier', monospace;
            font-size: 18px;
            font-weight: bold;
            background: #f3f4f6;
            padding: 5px 15px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }
        .footer {
            background-color: #f9fafb;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
        }
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-purple { background: #ede9fe; color: #5b21b6; }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="header">
            <h1>Official E-Ticket</h1>
        </div>
        <div class="body">
            <div class="event-title">{{ $registration->event->title }}</div>
            <div style="margin-bottom: 25px;">
                <span class="badge badge-purple">{{ $registration->event->category }}</span>
            </div>

            <div class="info-row">
                <div class="info-label">Nama Peserta</div>
                <div class="info-value">{{ $registration->user->name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Varian Tiket</div>
                <div class="info-value">{{ $registration->ticket->name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Tanggal Event</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($registration->event->event_date)->format('l, d F Y') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Waktu Open</div>
                <div class="info-value">{{ $registration->event->gates_open ?? '08:00 AM' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Lokasi</div>
                <div class="info-value">{{ $registration->event->location }}</div>
            </div>

            <div class="qr-section">
                <div style="font-size: 14px; color: #6b7280; margin-bottom: 5px;">Kode Registrasi</div>
                <div class="order-id">#{{ str_pad($registration->id, 8, '0', STR_PAD_LEFT) }}</div>
                <p style="font-size: 11px; color: #9ca3af; margin-top: 15px;">
                    Harap tunjukkan e-ticket ini saat memasuki venue untuk proses check-in.
                </p>
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Manajemen Event Kampus. All rights reserved.
        </div>
    </div>
</body>
</html>
