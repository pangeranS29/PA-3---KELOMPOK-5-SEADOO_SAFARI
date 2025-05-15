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

    protected $casts = [
        'foto' => 'array', // Laravel akan otomatis mengubah JSON menjadi array
    ];

     /**
     * Accessor to get the first photo from the 'foto' column as a thumbnail.
     *
     * @return string
     */

     public function getThumbnailAttribute()
     {
          // If photos exist
        if ($this->foto) {
        $filename = json_decode($this->foto)[0]; // contoh: "assets/item/foto1.jpg"
        return '/storage/' . $filename;
    }

        return asset('images/default.png');


     }




    // Relasi ke tabel pilihpakets
    public function pilihpaket()
    {
        return $this->belongsTo(PilihPaket::class, 'paket_jetski_id', 'id');
    }
}
