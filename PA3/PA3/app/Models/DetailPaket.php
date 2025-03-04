<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPaket extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'detail_paket'; // Nama tabel

    protected $fillable = [
        'pilihpakets_id',
        'foto',
        'rating',
        'deskripsi',
        'jumlah_penumpang',
    ];

    // Relasi ke tabel pilihpakets
    public function pilihPaket()
    {
        return $this->belongsTo(PilihPaket::class, 'id_pilihpaket');
    }
}
