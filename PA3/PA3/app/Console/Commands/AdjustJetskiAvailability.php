<?php

namespace App\Console\Commands;

use App\Models\Booking;
use App\Models\PilihPaket;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AdjustJetskiCommand extends Command
{
    protected $signature = 'jetski:adjust';
    protected $description = 'Adjust jetski availability based on booking times';

    public function handle(): void
    {
        $now = Carbon::now();

        DB::transaction(function () use ($now) {
            // Kurangi jetski untuk booking yang sudah mulai
            Booking::where('waktu_mulai', '<=', $now)
                ->where('status_pembayaran', 'success')
                ->whereDoesntHave('jetskiAdjustments', function($q) {
                    $q->where('type', 'reduce');
                })
                ->each(function ($booking) {
                    PilihPaket::query()->update([
                        'jumlah_jetski' => DB::raw("GREATEST(jumlah_jetski - 1, 0)")
                    ]);

                    $booking->jetskiAdjustments()->create([
                        'type' => 'reduce',
                        'adjusted_at' => now()
                    ]);
                });

            // Tambah jetski untuk booking yang sudah selesai
            Booking::where('waktu_selesai', '<', $now)
                ->where('status_pembayaran', 'success')
                ->whereDoesntHave('jetskiAdjustments', function($q) {
                    $q->where('type', 'return');
                })
                ->each(function ($booking) {
                    PilihPaket::query()->update([
                        'jumlah_jetski' => DB::raw("jumlah_jetski + 1")
                    ]);

                    $booking->jetskiAdjustments()->create([
                        'type' => 'return',
                        'adjusted_at' => now()
                    ]);
                });
        });

        $this->info('Jetski availability adjusted successfully.');
    }
}
