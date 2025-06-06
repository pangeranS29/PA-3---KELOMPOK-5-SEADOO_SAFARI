<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class DetailPaket extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'detail_paket'; // Nama tabel

    protected $fillable = [
        'paket_jetski_id', // Ubah dari pilihpakets_id ke paket_jetski_id
        'foto',
        'rating',
        'harga_drone',
        'deskripsi',
    ];



     /**
     * Accessor to get the first photo from the 'foto' column as a thumbnail.
     *
     * @return string
     */








    // Relasi ke tabel pilihpakets
    public function pilihpaket()
    {
        return $this->belongsTo(PilihPaket::class, 'paket_jetski_id', 'id');
    }
}
