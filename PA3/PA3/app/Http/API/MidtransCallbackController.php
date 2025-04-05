<?php

namespace App\Http\Controllers\API;

use Midtrans\Config;
use Midtrans\Notification;
use App\Models\Booking;
use App\Http\Controllers\Controller;

class MidtransCallbackController extends Controller
{
    public function callback()
    {
        // Set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat instance midtrans notification
        $notification = new Notification();

        // Assign ke variable untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // Cari transaksi berdasarkan ID
        $booking = Booking::findOrFail($order_id);

        // Handle notification status midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $booking->payment_status = 'pending';
                } else {
                    $booking->payment_status = 'success';
                }
            }
        } else if ($status == 'settlement') {
            $booking->payment_status = 'success';
        } else if ($status == 'pending') {
            $booking->payment_status = 'pending';
        } else if ($status == 'deny') {
            $booking->payment_status = 'cancelled';
        } else if ($status == 'expire') {
            $booking->payment_status = 'cancelled';
        } else if ($status == 'cancel') {
            $booking->payment_status = 'cancelled';
        }

        // Simpan transaksi
        $booking->save();

        // Return response
        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => 'Midtrans Notification Success'
            ]
        ]);
    }
}
