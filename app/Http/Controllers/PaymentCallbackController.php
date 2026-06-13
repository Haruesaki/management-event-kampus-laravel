<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class PaymentCallbackController extends Controller
{
    /**
     * Menangani callback dari Midtrans.
     */
    public function handle(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');

        try {
            $notif = new Notification();

            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $orderId = $notif->order_id; // Ini adalah order_id unik kita
            $fraud = $notif->fraud_status;

            // Cari data payment berdasarkan order_id unik
            $payment = Payment::with('registration.event', 'registration.user')->where('order_id', $orderId)->first();

            if (!$payment) {
                return response()->json(['message' => 'Payment not found'], 404);
            }

            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $payment->update(['payment_status' => 'Pending']);
                    } else {
                        $payment->update(['payment_status' => 'Success']);
                    }
                }
            } elseif ($transaction == 'settlement') {
                $payment->update(['payment_status' => 'Success']);
                
                // Catat Log Aktivitas
                ActivityLog::create([
                    'user_id' => $payment->registration->user_id,
                    'action' => 'Pembayaran Tiket',
                    'description' => 'Pembayaran untuk tiket di event "' . $payment->registration->event->title . '" berhasil dikonfirmasi via Midtrans.',
                ]);

            } elseif ($transaction == 'pending') {
                $payment->update(['payment_status' => 'Pending']);
            } elseif ($transaction == 'deny') {
                $payment->update(['payment_status' => 'Rejected']);
            } elseif ($transaction == 'expire') {
                $payment->update(['payment_status' => 'Rejected']);
            } elseif ($transaction == 'cancel') {
                $payment->update(['payment_status' => 'Rejected']);
            }

            return response()->json(['message' => 'Callback handled successfully']);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error handling callback: ' . $e->getMessage()], 500);
        }
    }
}
