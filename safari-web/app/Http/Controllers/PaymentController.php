<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showPaymentPage()
    {
        // Contoh data booking (harus diganti dengan data dari database)
        $booking = (object) [
            'order_id' => 'INV123456789',
            'total_price' => 250000, // Dalam Rupiah
        ];

        // Simulasi daftar Virtual Accounts
        $virtualAccounts = [
            ['name' => 'Bank BCA', 'logo' => asset('images/bca.png')],
            ['name' => 'Bank Mandiri', 'logo' => asset('images/mandiri.png')],
            ['name' => 'Bank BRI', 'logo' => asset('images/bri.png')],
        ];

        // Simulasi daftar metode pembayaran lain
        $paymentMethods = [
            ['name' => 'Credit Card'],
            ['name' => 'E-Wallet'],
            ['name' => 'Bank Transfer'],
        ];

        return view('Pembayaran.payment', compact('booking', 'virtualAccounts', 'paymentMethods'));
    }
}
