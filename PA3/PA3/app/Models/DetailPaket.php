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

    protected $casts = [
        'foto' =>'array',
    ];

    // public function getThumnailAttribute(){

    //     if($this->foto){
    //         return Storage::url(json_encode($this->foto)[0]);
    //     }

    //     return 'https://via.placeholder.com/800';
    // }


    // Relasi ke tabel pilihpakets
    public function pilihpaket()
    {
        return $this->belongsTo(PilihPaket::class, 'pilihpakets_id');
    }
}
