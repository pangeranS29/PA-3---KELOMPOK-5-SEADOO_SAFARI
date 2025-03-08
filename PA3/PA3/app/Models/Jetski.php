<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jetski extends Model
{
    use HasFactory;

    protected $table = 'jetski';

    protected $fillable = [
        'status_jetski',
        'jumlah_jetski',
        'waktu_mulai',
        'waktu_selesai',
        'tanggal'
    ];

    // Relasi ke tabel PaketJetski (Satu Jetski bisa memiliki banyak Paket)
    public function paketJetski()
    {
        return $this->hasMany(PilihPaket::class, 'id_jetski', 'id_jetski');
    }
}
