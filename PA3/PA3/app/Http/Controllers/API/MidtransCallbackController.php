<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\PilihPaket;
use App\Models\Jetski;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;
use Carbon\Carbon;

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
            // Ambil notifikasi dari Midtrans
            $notification = new Notification();

            $transactionStatus = $notification->transaction_status;
            $paymentType = $notification->payment_type;
            $fraudStatus = $notification->fraud_status;
            $orderId = $notification->order_id;

            // Cari data booking
            $booking = Booking::findOrFail($orderId);

            Log::info('Midtrans Callback Received', [
                'transaction_status' => $transactionStatus,
                'payment_type' => $paymentType,
                'order_id' => $orderId,
            ]);

            // Update status pembayaran
            switch ($transactionStatus) {
                case 'capture':
                    if ($paymentType === 'credit_card') {
                        $booking->status_pembayaran = $fraudStatus === 'challenge' ? 'pending' : 'success';
                    }
                    break;

                case 'settlement':
                    $booking->status_pembayaran = 'success';  // Pembayaran berhasil
                    break;

                case 'pending':
                    $booking->status_pembayaran = 'pending';  // Pembayaran masih dalam proses
                    break;

                case 'deny':
                case 'cancel':
                case 'expire':
                    $booking->status_pembayaran = 'cancelled';  // Pembayaran gagal
                    break;

                default:
                    $booking->status_pembayaran = 'unknown';  // Status tidak diketahui
                    break;
            }


            // Jika pembayaran sukses dan sebelumnya belum sukses
            if ($booking->status_pembayaran === 'success' && $booking->getOriginal('status_pembayaran') !== 'success') {
                $booking->status = 'success';

                // ✅ Kurangi jumlah jetski dari semua paket
                $allPilihPaket = PilihPaket::all();
                foreach ($allPilihPaket as $paket) {
                    if ($paket->jumlah_jetski > 0) {
                        $paket->jumlah_jetski -= 1;
                        $paket->save();
                    }
                }

                // ✅ Simpan data Jetski untuk user ini
                Jetski::create([
                    'status_jetski' => 'sedang digunakan',
                    'jumlah_jetski' => 1,
                    'waktu_mulai' => $booking->waktu_mulai,
                    'waktu_selesai' => $booking->waktu_selesai,
                    'booking_id' => $booking->id // Menggunakan booking_id sebagai penghubung
                ]);
            }

            // Simpan perubahan booking
            $booking->save();

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans Notification Processed Successfully'
                ]
            ]);
        } catch (\Exception $e) {
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
