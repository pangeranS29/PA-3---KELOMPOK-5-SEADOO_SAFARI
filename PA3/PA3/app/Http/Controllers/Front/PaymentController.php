<?php

namespace App\Http\Controllers\Front;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
    public function index(Request $request, $bookingId)
    {
        $booking = Booking::with('detail_paket.pilihpaket', 'user')->findOrFail($bookingId);

        // Cek kadaluarsa
        if (now()->greaterThan($booking->waktu_selesai) && $booking->status_pembayaran === 'pending') {
            $booking->status_pembayaran = 'expired';
            $booking->save();

            return redirect()->route('front.index')->with('error', 'Booking sudah kadaluarsa. Silakan booking ulang.');
        }

        return view('payment', compact('booking'));
    }

    public function updatePaymentMethod(Request $request, $bookingId)
    {
        // Validasi input dari form
        $request->validate([
            'metode_pembayaran' => 'required|string',
        ]);

        // Temukan data booking berdasarkan ID
        $booking = Booking::findOrFail($bookingId);

        // Update metode pembayaran pada tabel bookings
        $booking->metode_pembayaran = $request->input('metode_pembayaran');
        $booking->save();

        // Arahkan ke halaman continue.blade.php dengan data booking
        return view('continue', compact('booking'));
    }

    public function uploadBuktiPembayaran(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Validasi input
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:5048', // max 5MB
        ]);

        // Cek kadaluarsa
        if (now()->greaterThan($booking->waktu_selesai) && $booking->status_pembayaran === 'pending') {
            $booking->status_pembayaran = 'expired';
            $booking->save();

            return redirect()->route('front.index')->with('error', 'Booking sudah kadaluarsa. Silakan booking ulang.');
        }

        // Simpan bukti pembayaran
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $path = $file->store('bukti_pembayaran', 'public');

            // Update data booking
            $booking->bukti_pembayaran = $path;
            $booking->status_pembayaran = 'menunggu_konfirmasi';
            $booking->save();

            // Arahkan ke halaman continue.blade.php dengan data booking
            return view('success', compact('booking'));
        }

        return back()->with('error', 'Gagal upload bukti pembayaran.');
    }

    public function success($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        return view('success', compact('booking'));
    }


    public function cetakResi($bookingId)
    {
        $booking = Booking::with('detail_paket.pilihpaket', 'user')->findOrFail($bookingId);

        if ($booking->status_pembayaran !== 'success') {
            return redirect()->back()->with('error', 'Hanya pembayaran yang berhasil yang dapat mencetak resi');
        }

        $pdf = Pdf::loadView('pdf.resi', compact('booking'));
        return $pdf->download('resi_booking_' . $booking->id . '.pdf');
    }

    public function checkExpired($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        if (now()->greaterThan($booking->waktu_selesai) && $booking->status_pembayaran === 'pending') {
            $booking->status_pembayaran = 'expired';
            $booking->save();
        }

        return response()->json(['status' => 'success']);
    }

    public function cancel($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Hanya bisa dibatalkan jika status masih pending
        if ($booking->status_pembayaran === 'pending') {
            $booking->status_pembayaran = 'dibatalkan';
            $booking->save();

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'Pesanan tidak bisa dibatalkan'], 400);
    }
    public function showUploadForm($bookingId)
    {
        $booking = Booking::with('detail_paket.pilihpaket', 'user')->findOrFail($bookingId);

        // Cek status dan waktu
        if (now()->greaterThan($booking->waktu_selesai)) {
            $booking->status_pembayaran = 'expired';
            $booking->save();
            return redirect()->route('front.index')->with('error', 'Booking sudah kadaluarsa. Silakan booking ulang.');
        }

        // Pastikan metode pembayaran sudah dipilih
        if (empty($booking->metode_pembayaran)) {
            return redirect()->route('front.payment', $booking->id);
        }

        return view('continue', compact('booking'));
    }
}
