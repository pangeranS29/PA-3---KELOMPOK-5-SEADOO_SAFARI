<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log; // Add this line
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    // Durasi waktu untuk pending payment (24 jam)
    const PENDING_PAYMENT_DURATION_HOURS = 24;

    // Durasi waktu untuk memilih metode pembayaran (1 jam)
    const SELECT_PAYMENT_METHOD_DURATION_MINUTES = 60;

    public function index(Request $request, $bookingId)
    {
        $booking = Booking::with('detail_paket.pilihpaket', 'user')->findOrFail($bookingId);

        // Cek semua kondisi expired
        if ($this->isBookingExpired($booking)) {
            return redirect()->route('front.index')->with('error', 'Waktu pembayaran telah habis. Silakan booking ulang.');
        }

        return view('payment', compact('booking'));
    }

    public function updatePaymentMethod(Request $request, $bookingId)
    {
        $request->validate([
            'metode_pembayaran' => 'required|string',
        ]);

        $booking = Booking::findOrFail($bookingId);
        $booking->metode_pembayaran = $request->input('metode_pembayaran');
        $booking->save();

        return view('continue', compact('booking'));
    }

    // Helper function untuk cek unpaid booking expired (belum pilih metode pembayaran)
    protected function isUnpaidBookingExpired($booking)
    {
        return $booking->status_pembayaran === 'pending' &&
            empty($booking->metode_pembayaran) &&
            now()->greaterThan($booking->waktu_selesai);
    }

    // Helper function untuk cek pending payment expired
    protected function isPendingPaymentExpired($booking)
    {
        return $booking->status_pembayaran === 'pending' &&
            !empty($booking->metode_pembayaran) &&
            now()->greaterThan($booking->created_at->addHours(self::PENDING_PAYMENT_DURATION_HOURS));
    }

    public function uploadBuktiPembayaran(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        // Cek expired untuk pending payment
        if ($this->isPendingPaymentExpired($booking)) {
            $booking->status_pembayaran = 'expired';
            $booking->save();
            return redirect()->route('front.index')->with('error', 'Waktu pembayaran telah habis. Silakan booking ulang.');
        }

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $path = $file->store('bukti_pembayaran', 'public');

            $booking->bukti_pembayaran = $path;
            $booking->status_pembayaran = 'menunggu_konfirmasi';
            $booking->save();

            return view('success', compact('booking'));
        }

        return back()->with('error', 'Gagal upload bukti pembayaran.');
    }
    // ... method lainnya tetap sama ...

    public function checkExpired($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        if ($this->isBookingExpired($booking)) {
            return response()->json(['status' => 'expired']);
        }

        return response()->json(['status' => $booking->status_pembayaran]);
    }

    public function showUploadForm($bookingId)
    {
        $booking = Booking::with('detail_paket.pilihpaket', 'user')->findOrFail($bookingId);

        // Cek semua kondisi expired
        if ($this->isBookingExpired($booking)) {
            return redirect()->route('front.index')->with('error', 'Waktu pembayaran telah habis. Silakan booking ulang.');
        }

        if (empty($booking->metode_pembayaran)) {
            return redirect()->route('front.payment', $booking->id);
        }

        return view('continue', compact('booking'));
    }

    // Helper function untuk cek semua kondisi expired
    protected function isBookingExpired($booking)
    {
        Log::info('Checking booking expiration', [
            'booking_id' => $booking->id,
            'current_status' => $booking->status_pembayaran,
            'waktu_selesai' => $booking->waktu_selesai,
            'now' => now(),
            'is_past_due' => now()->greaterThan($booking->waktu_selesai)
        ]);

        // Jika booking sudah success dan waktu selesai sudah lewat
        if ($booking->status_pembayaran === 'success' && now()->greaterThan($booking->waktu_selesai)) {
            $booking->update(['status_pembayaran' => 'expired']);
            return true;
        }

        // Jika booking pending dan sudah memilih metode pembayaran tapi melebihi 24 jam
        if (
            $booking->status_pembayaran === 'pending' &&
            !empty($booking->metode_pembayaran) &&
            now()->greaterThan($booking->created_at->addHours(self::PENDING_PAYMENT_DURATION_HOURS))
        ) {
            $booking->update(['status_pembayaran' => 'expired']);
            return true;
        }

        // Jika booking pending dan belum memilih metode pembayaran dalam 1 jam
        if (
            $booking->status_pembayaran === 'pending' &&
            empty($booking->metode_pembayaran) &&
            now()->greaterThan($booking->created_at->addMinutes(self::SELECT_PAYMENT_METHOD_DURATION_MINUTES))
        ) {
            $booking->update(['status_pembayaran' => 'expired']);
            return true;
        }

        return false;
    }

    public function cancel(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Validasi status sebelum cancel
        if (!in_array($booking->status_pembayaran, ['pending', 'menunggu_konfirmasi'])) {
            return response()->json([
                'error' => 'Cannot cancel this booking',
                'message' => 'Only pending or unconfirmed bookings can be canceled'
            ], 400);
        }

        $booking->update([
            'status_pembayaran' => 'canceled',
            'canceled_at' => now()
        ]);

        return response()->json(['success' => true]);
    }

    // Tambahkan method ini di PaymentController
     public function cetakResi($bookingId)
    {
        $booking = Booking::with('detail_paket.pilihpaket', 'user')->findOrFail($bookingId);

        $pdf = Pdf::loadView('pdf.resi', compact('booking'));
        return $pdf->download('resi_booking_' . $booking->id . '.pdf');
    }
}
