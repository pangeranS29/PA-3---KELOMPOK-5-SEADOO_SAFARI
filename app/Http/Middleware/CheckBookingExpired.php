<?php
namespace App\Http\Middleware;

use Closure;
use App\Models\Booking;
use App\Http\Controllers\Front\PaymentController;

class CheckBookingExpired
{
    public function handle($request, Closure $next)
    {
        if ($request->route('bookingId')) {
            $booking = Booking::find($request->route('bookingId'));

            if ($booking) {
                // Cek semua kondisi expired
                if (($booking->status_pembayaran === 'pending' && !empty($booking->metode_pembayaran) &&
                     now()->greaterThan($booking->created_at->addHours(PaymentController::PENDING_PAYMENT_DURATION_HOURS))) ||
                    ($booking->status_pembayaran === 'pending' && empty($booking->metode_pembayaran) &&
                     now()->greaterThan($booking->waktu_selesai)) ||
                    ($booking->status_pembayaran === 'success' && now()->greaterThan($booking->waktu_selesai))) {

                    $booking->status_pembayaran = 'expired';
                    $booking->save();

                    return redirect()->route('front.index')->with('error', 'Waktu pembayaran/booking telah habis.');
                }
            }
        }

        return $next($request);
    }
}
