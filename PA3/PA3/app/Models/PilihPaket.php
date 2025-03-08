<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PilihPaket extends Model
{
    use HasFactory;
    protected $table = 'paket_jetski';



    protected $fillable = [
        'nama_paket',
        'harga',
        'deskripsi',
        'jumlah_jetski',
        'id_jetski'
    ];


    // Relasi ke tabel Jetski (PaketJetski milik satu Jetski)
    public function jetski()
    {
        return $this->belongsTo(Jetski::class, 'id_jetski', 'id_jetski');
    }


    public function detail_paket()
    {
        return $this->hasMany(DetailPaket::class);
    }
}
