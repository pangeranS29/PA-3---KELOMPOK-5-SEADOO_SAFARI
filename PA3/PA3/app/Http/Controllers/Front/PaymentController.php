<?php

namespace App\Http\Controllers\Front;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index(Request $request, $bookingId)
    {
        $booking = Booking::with('detail_paket')->findOrFail($bookingId);

        return view('payment', [
            'booking' => $booking
        ]);
    }



    public function update(Request $request, $bookingId)
    {
        $booking = Booking::with('detail_paket.pilihpaket')->findOrFail($bookingId);

        $booking->method_pembayaran = $request->method_pembayaran;

        if ($request->method_pembayaran == 'midtrans') {
           // Call Midtrans API
           \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
           \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
           \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
           \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

           $totalPrice = $booking->total_price; // Langsung gunakan harga dalam IDR

           $midtransParams = [
            'transaction_details' => [
                'order_id' => $booking->id,
                'gross_amount' => (int) $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $booking->name,
                'email' => $booking->user->email,
            ],
            'enabled_payments' => [
                'credit_card',
                'gopay',
                'shopeepay',
                'bank_transfer',
                'echannel',
                'permata_va',
                'bca_va',
                'bni_va',
                'bri_va',
                'other_va',
                'cstore',
                'qris',
                'danamon_online',
                'akulaku',
                'kredivo'
            ],
            'vtweb' => []
        ];
        // Get Snap Payment Page URL
        $url_pembayaran = \Midtrans\Snap::createTransaction($midtransParams)->redirect_url;

        // Save payment URL to booking
        $booking->payment_url = $url_pembayaran;
        $booking->save();

        // Redirect to Snap Payment Page
        return redirect($url_pembayaran);



        }
    }

    public function success(Request $request)
    {
        return view('success');
    }
}
