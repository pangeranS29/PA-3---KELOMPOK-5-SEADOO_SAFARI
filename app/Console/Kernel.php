<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Booking;

class Kernel extends ConsoleKernel
{
    const PENDING_PAYMENT_DURATION_HOURS = 24;

    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            // Booking sudah pilih metode pembayaran tapi belum bayar dalam 24 jam
            Booking::where('status_pembayaran', 'pending')
                ->whereNotNull('metode_pembayaran')
                ->where('created_at', '<=', now()->subHours(self::PENDING_PAYMENT_DURATION_HOURS))
                ->update(['status_pembayaran' => 'expired']);

            // Booking belum pilih metode pembayaran dan melewati waktu_selesai
            Booking::where('status_pembayaran', 'pending')
                ->whereNull('metode_pembayaran')
                ->where('waktu_selesai', '<=', now())
                ->update(['status_pembayaran' => 'expired']);
        })->everyMinute(); // bisa juga ->hourly()
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}
