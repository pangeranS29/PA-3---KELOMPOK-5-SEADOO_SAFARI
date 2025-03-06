<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class PembayaranController extends Controller
{
    public function show($id)
    {
        // Ambil data booking berdasarkan ID
        $booking = Booking::findOrFail($id);

        // Data virtual account (contoh)
        $virtualAccounts = [
            ['name' => 'Bank BCA', 'logo' => 'bca.png'],
            ['name' => 'Bank Mandiri', 'logo' => 'mandiri.png'],
        ];

        // Kirim data ke view
        return view('pembayaran.payment', compact('booking', 'virtualAccounts'));
    }

    public function proses($id)
    {
        // Ambil data booking berdasarkan ID
        $booking = Booking::findOrFail($id);

        // Data virtual account (contoh)
        $virtualAccounts = [
            ['name' => 'Bank BRI', 'logo' => 'bri.png'],
            ['name' => 'Bank BNI', 'logo' => 'bni.png'],
        ];

        // Kirim data ke view
        return view('pembayaran.payment', compact('booking', 'virtualAccounts'));
    }
}
