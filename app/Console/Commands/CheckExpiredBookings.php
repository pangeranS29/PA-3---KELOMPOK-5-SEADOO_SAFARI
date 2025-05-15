<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Notifications\BookingExpiredNotification;
use Carbon\Carbon;

class CheckExpiredBookings extends Command
{
    protected $signature = 'bookings:check-expired';
    protected $description = 'Check and update expired bookings';

    public function handle()
    {
        $this->info('Checking for expired bookings...');

        // 1. Booking success yang sudah lewat waktu_selesai
        $successExpired = Booking::where('status_pembayaran', 'success')
            ->where('waktu_selesai', '<', now())
            ->get();

        $successExpired->each(function($booking) {
            $booking->update(['status_pembayaran' => 'expired']);
            $booking->user->notify(new BookingExpiredNotification());
        });

        // 2. Booking pending yang belum pilih metode dan lewat waktu_selesai
        $unpaidExpired = Booking::where('status_pembayaran', 'pending')
            ->whereNull('metode_pembayaran')
            ->where('waktu_selesai', '<', now())
            ->get();

        $unpaidExpired->each(function($booking) {
            $booking->update(['status_pembayaran' => 'expired']);
            $booking->user->notify(new BookingExpiredNotification());
        });

        // 3. Booking pending yang sudah pilih metode tapi lewat 24 jam
        $pendingExpired = Booking::where('status_pembayaran', 'pending')
            ->whereNotNull('metode_pembayaran')
            ->where('created_at', '<', now()->subHours(24))
            ->get();

        $pendingExpired->each(function($booking) {
            $booking->update(['status_pembayaran' => 'expired']);
            $booking->user->notify(new BookingExpiredNotification());
        });

        $this->info("Completed. Expired: {$successExpired->count()} success, {$unpaidExpired->count()} unpaid, {$pendingExpired->count()} pending.");
    }
}
