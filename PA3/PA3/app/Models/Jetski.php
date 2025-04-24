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
        'booking_id'
    ];

    public function paketJetski()
    {
        return $this->hasMany(PilihPaket::class, 'id_jetski', 'id_jetski');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
