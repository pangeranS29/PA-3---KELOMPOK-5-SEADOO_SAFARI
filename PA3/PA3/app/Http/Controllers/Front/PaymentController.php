<?php

namespace App\Http\Controllers\Front;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function index(Request $request, $bookingId)
    {
        $booking = Booking::with('detail_paket.pilihpaket', 'user')->findOrFail($bookingId);

        return view('payment', [ // pastikan path-nya sesuai view kamu
            'booking' => $booking
        ]);
    }

    public function update(Request $request, $bookingId)
    {
        $booking = Booking::with('detail_paket.pilihpaket', 'user')->findOrFail($bookingId);

        $request->validate([
            'metode_pembayaran' => 'required|string'
        ]);

        // Jangan lanjutkan pembayaran jika status sudah expired
        if ($booking->status_pembayaran === 'expired') {
            return redirect()->route('front.index')->with('error', 'Booking sudah kadaluarsa. Silakan lakukan booking ulang.');
        }

        $booking->metode_pembayaran = $request->metode_pembayaran;

        if ($booking->metode_pembayaran === 'midtrans') {
            // Midtrans config
            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$isProduction = config('services.midtrans.isProduction');
            Config::$isSanitized = config('services.midtrans.isSanitized');
            Config::$is3ds = config('services.midtrans.is3ds');

            $userEmail = optional($booking->user)->email ?? 'noemail@example.com';

            $grossAmount = (int) $booking->total_harga;

            $params = [
                'transaction_details' => [
                    'order_id' => $booking->id,
                    'gross_amount' => $grossAmount
                ],
                'customer_details' => [
                    'first_name' => $booking->nama_customer,
                    'email' => $userEmail,
                ],
                'enabled_payments' => [
                    'credit_card', 'gopay', 'shopeepay', 'bank_transfer',
                    'echannel', 'permata_va', 'bca_va', 'bni_va', 'bri_va',
                    'other_va', 'cstore', 'qris', 'danamon_online',
                    'akulaku', 'kredivo'
                ],
                'vtweb' => []
            ];

            try {
                $snapTransaction = Snap::createTransaction($params);
                $booking->url_pembayaran = $snapTransaction->redirect_url;
                $booking->save();

                return redirect($booking->url_pembayaran);
            } catch (\Exception $e) {
                Log::error('Midtrans Error: ' . $e->getMessage());
                return redirect()->route('front.index')->with('error', 'Gagal membuat transaksi pembayaran.');
            }
        }

        return redirect()->route('front.index');
    }

    public function success(Request $request)
    {
        return view('front.success'); // Sesuaikan view
    }

    public function notification(Request $request)
    {
        try {
            $notif = new Notification();

            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $orderId = $notif->order_id;
            $fraud = $notif->fraud_status;

            $booking = Booking::findOrFail($orderId);

            switch ($transaction) {
                case 'capture':
                    $booking->status_pembayaran = ($type === 'credit_card' && $fraud === 'challenge') ? 'pending' : 'settlement';
                    break;
                case 'settlement':
                    $booking->status_pembayaran = 'settlement';
                    break;
                case 'pending':
                    $booking->status_pembayaran = 'pending';
                    break;
                case 'deny':
                    $booking->status_pembayaran = 'failed';
                    break;
                case 'expire':
                    $booking->status_pembayaran = 'expired';
                    break;
                case 'cancel':
                    $booking->status_pembayaran = 'cancelled';
                    break;
            }

            $booking->save();
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Midtrans Notification Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Notification failed.'], 500);
        }
    }

    public function cancel($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        $booking->metode_pembayaran = null;
        $booking->url_pembayaran = null;
        $booking->save();

        return redirect()->route('front.payment', $booking->id)
            ->with('success', 'Pembayaran berhasil dibatalkan. Silakan pilih metode pembayaran kembali.');
    }
}
