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
        'durasi',
        'jumlah_jetski',
    ];





    // PilihPaket.php
public function detail_paket()
{
    return $this->hasMany(DetailPaket::class, 'paket_jetski_id');
}
}
