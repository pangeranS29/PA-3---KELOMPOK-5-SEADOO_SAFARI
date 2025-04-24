<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Jetski;
use App\Models\PilihPaket;
use Carbon\Carbon;

class UpdateJetskiStatus extends Command
{
    protected $signature = 'jetski:update-status';
    protected $description = 'Update status jetski dan restore jumlah jetski ke semua paket jika waktu selesai sudah lewat';

    public function handle()
    {
        $now = Carbon::now();

        $jetskis = Jetski::where('status_jetski', 'sedang digunakan')
            ->where('waktu_selesai', '<', $now)
            ->get();

        foreach ($jetskis as $jetski) {
            $jetski->status_jetski = 'selesai digunakan';
            $jetski->save();

            // Tambahkan kembali jumlah jetski ke semua paket
            $allPaket = PilihPaket::all();
            foreach ($allPaket as $paket) {
                $paket->jumlah_jetski += 1;
                $paket->save();
            }
        }

        $this->info('Status jetski diperbarui dan jumlah jetski dikembalikan.');
    }
}
