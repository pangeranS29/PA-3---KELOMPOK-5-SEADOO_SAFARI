<?php

namespace App\Http\Controllers\Front;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Barryvdh\DomPDF\Facade\Pdf; // Tambahkan di paling atas

class PaymentController extends Controller
{
    public function index(Request $request, $bookingId)
    {
        $booking = Booking::with('detail_paket.pilihpaket', 'user')->findOrFail($bookingId);

        // Cek apakah waktu sekarang sudah melewati waktu_selesai
        if (now()->greaterThan($booking->waktu_selesai) && $booking->status_pembayaran === 'pending') {
            $booking->status_pembayaran = 'expired';
            $booking->save();

            return redirect()->route('front.index')->with('error', 'Booking sudah kadaluarsa. Silakan lakukan booking ulang.');
        }

        return view('payment', [
            'booking' => $booking
        ]);
    }

    public function update(Request $request, $bookingId)
    {
        $booking = Booking::with('detail_paket.pilihpaket', 'user')->findOrFail($bookingId);


        // Auto-expired check sebelum update
        if (now()->greaterThan($booking->waktu_selesai) && $booking->status_pembayaran === 'pending') {
            $booking->status_pembayaran = 'expired';
            $booking->save();

            return redirect()->route('front.index')->with('error', 'Booking sudah kadaluarsa. Silakan lakukan booking ulang.');
        }

        $request->validate([
            'metode_pembayaran' => 'required|string'
        ]);

        if ($booking->status_pembayaran === 'expired') {
            return redirect()->route('front.index')->with('error', 'Booking sudah kadaluarsa. Silakan lakukan booking ulang.');
        }

        $booking->metode_pembayaran = $request->metode_pembayaran;

        if ($booking->metode_pembayaran === 'midtrans') {
            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$isProduction = config('services.midtrans.isProduction');
            Config::$isSanitized = config('services.midtrans.isSanitized');
            Config::$is3ds = config('services.midtrans.is3ds');

            $userEmail = optional($booking->user)->email ?? 'noemail@example.com';

            $params = [
                'transaction_details' => [
                    'order_id' => $booking->id,
                    'gross_amount' => (int) $booking->total_harga,
                ],
                'customer_details' => [
                    'first_name' => $booking->nama_customer,
                    'email' => $userEmail,
                ],
                'enabled_payments' => ['gopay', 'bank_transfer'],
                'vtweb' => [],
                'callbacks' => [
                    'finish' => route('front.payment.success', ['bookingId' => $booking->id]),
                ]
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


    public function success($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        return view('success', compact('booking'));
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

    public function cetakResi($bookingId)
    {
        $booking = Booking::with('detail_paket.pilihpaket', 'user')->findOrFail($bookingId);

        $pdf = Pdf::loadView('pdf.resi', compact('booking'));
        return $pdf->download('resi_booking_' . $booking->id . '.pdf');
    }
}
