<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\PilihPaket;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransCallbackController extends Controller
{
    public function callback()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        try {
            // Ambil notifikasi pembayaran dari Midtrans
            $notification = new Notification();

            // Ambil data penting dari notifikasi
            $transactionStatus = $notification->transaction_status;
            $paymentType = $notification->payment_type;
            $fraudStatus = $notification->fraud_status;
            $orderId = $notification->order_id;

            // Cari booking berdasarkan order_id (pastikan order_id di Midtrans == id booking)
            $booking = Booking::findOrFail($orderId);

            // Debug log (optional)
            Log::info('Midtrans Callback Received', [
                'transaction_status' => $transactionStatus,
                'payment_type' => $paymentType,
                'order_id' => $orderId,
            ]);

            // Proses status pembayaran
            switch ($transactionStatus) {
                case 'capture':
                    if ($paymentType === 'credit_card') {
                        if ($fraudStatus === 'challenge') {
                            $booking->status_pembayaran = 'pending';
                        } else {
                            $booking->status_pembayaran = 'success';
                        }
                    }
                    break;

                case 'settlement':
                    $booking->status_pembayaran = 'success';
                    break;

                case 'pending':
                    $booking->status_pembayaran = 'pending';
                    break;

                case 'deny':
                case 'cancel':
                case 'expire':
                    $booking->status_pembayaran = 'cancelled';
                    break;

                default:
                    $booking->status_pembayaran = 'unknown';
                    break;
            }

            // Update status booking jika pembayaran sukses dan sebelumnya belum success
            if ($booking->status_pembayaran === 'success' && $booking->getOriginal('status_pembayaran') !== 'success') {
                $booking->status = 'success';

                // ✅ Kurangi jumlah jetski di SEMUA paket
                $allPilihPaket = \App\Models\PilihPaket::all();

                foreach ($allPilihPaket as $paket) {
                    if ($paket->jumlah_jetski > 0) {
                        $paket->jumlah_jetski -= 1;
                        $paket->save();
                    }
                }
            }



            // Simpan perubahan
            $booking->save();

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans Notification Processed Successfully'
                ]
            ]);
        } catch (\Exception $e) {
            // Log error jika terjadi exception
            Log::error('Midtrans Callback Error', [
                'error' => $e->getMessage()
            ]);

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
