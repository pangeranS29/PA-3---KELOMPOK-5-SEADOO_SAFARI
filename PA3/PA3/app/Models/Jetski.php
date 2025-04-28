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

    // Relasi dengan model Booking (Many-to-One)
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id'); // Relasi many-to-one ke Booking
    }
}
