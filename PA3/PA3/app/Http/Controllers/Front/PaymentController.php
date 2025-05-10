<?php

namespace App\Http\Controllers\Front;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PaymentController extends Controller
{
    // Durasi waktu untuk pending payment (24 jam)
    const PENDING_PAYMENT_DURATION_HOURS = 24;

    public function index(Request $request, $bookingId)
    {
        $booking = Booking::with('detail_paket.pilihpaket', 'user')->findOrFail($bookingId);

        // Cek expired untuk booking success
        if ($booking->status_pembayaran === 'success' && now()->greaterThan($booking->waktu_selesai)) {
            return redirect()->route('front.index')->with('error', 'Booking sudah kadaluarsa.');
        }

        // Cek expired untuk booking pending yang sudah pilih metode pembayaran
        if ($this->isPendingPaymentExpired($booking)) {
            $booking->status_pembayaran = 'expired';
            $booking->save();
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

        // Cek expired untuk success booking
        if ($booking->status_pembayaran === 'success' && now()->greaterThan($booking->waktu_selesai)) {
            $booking->status_pembayaran = 'expired';
            $booking->save();
        }

        // Cek expired untuk pending payment
        if ($this->isPendingPaymentExpired($booking)) {
            $booking->status_pembayaran = 'expired';
            $booking->save();
        }

        return response()->json(['status' => 'success']);
    }

    public function showUploadForm($bookingId)
    {
        $booking = Booking::with('detail_paket.pilihpaket', 'user')->findOrFail($bookingId);

        // Cek expired untuk success booking
        if ($booking->status_pembayaran === 'success' && now()->greaterThan($booking->waktu_selesai)) {
            $booking->status_pembayaran = 'expired';
            $booking->save();
            return redirect()->route('front.index')->with('error', 'Booking sudah kadaluarsa.');
        }

        // Cek expired untuk pending payment
        if ($this->isPendingPaymentExpired($booking)) {
            $booking->status_pembayaran = 'expired';
            $booking->save();
            return redirect()->route('front.index')->with('error', 'Waktu pembayaran telah habis. Silakan booking ulang.');
        }

        if (empty($booking->metode_pembayaran)) {
            return redirect()->route('front.payment', $booking->id);
        }

        return view('continue', compact('booking'));
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
}
