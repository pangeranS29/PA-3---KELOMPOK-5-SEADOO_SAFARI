<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Items extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'stock',
        'deskripsi',
        'pilihpaket_id',
        'photos',
        'rating',
    ];

    protected $casts =[
        'photos' => 'array',
    ];



    public function pilihpaket()
    {
        return $this->belongsTo(PilihPaket::class, 'pilihpaket_id');
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
