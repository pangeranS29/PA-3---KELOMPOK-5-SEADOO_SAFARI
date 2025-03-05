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
        'pilihpakets_id',
        'foto',
        'rating',
        'deskripsi',
        'jumlah_penumpang',
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
            return Storage::url(json_decode($this->foto)[0]);
        }

        return asset('images/default.png');


     }




    // Relasi ke tabel pilihpakets
    public function pilihpaket()
    {
        return $this->belongsTo(PilihPaket::class, 'pilihpakets_id');
    }
}
