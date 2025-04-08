<?php

namespace App\Http\Controllers\API;

use Midtrans\Config;
use Midtrans\Notification;
use App\Models\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class MidtransCallbackController extends Controller
{
    public function callback()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        try {
            // Buat instance Midtrans notification
            $notification = new Notification();

            // Ambil detail status dari notifikasi
            $status = $notification->transaction_status;
            $type = $notification->payment_type;
            $fraud = $notification->fraud_status;
            $order_id = $notification->order_id;

            // Cari booking berdasarkan order_id
            $booking = Booking::findOrFail($order_id);

            // Atur status pembayaran berdasarkan status dari Midtrans
            if ($status === 'capture') {
                if ($type === 'credit_card') {
                    $booking->status_pembayaran = $fraud === 'challenge' ? 'pending' : 'success';
                }
            } elseif ($status === 'settlement') {
                $booking->status_pembayaran = 'success';
            } elseif ($status === 'pending') {
                $booking->status_pembayaran = 'pending';
            } elseif (in_array($status, ['deny', 'expire', 'cancel'])) {
                $booking->status_pembayaran = 'cancelled';
            }

            // Jika pembayaran sukses, ubah juga status booking menjadi success
            if ($booking->status_pembayaran === 'success') {
                $booking->status = 'success';
            }

            $booking->save();

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans Notification Success'
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: ' . $e->getMessage());

            return response()->json([
                'meta' => [
                    'code' => 500,
                    'message' => 'Midtrans Notification Failed',
                    'error' => $e->getMessage()
                ]
            ], 500);
        }
    }
}
