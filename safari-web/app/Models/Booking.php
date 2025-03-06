<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings'; // Pastikan sesuai dengan tabel di database

    protected $fillable = [
        'order_id',
        'total_price',
        'name',
        'phone',
        'date',
        'time',
        'passenger',
        'include_drone'
    ];
}
