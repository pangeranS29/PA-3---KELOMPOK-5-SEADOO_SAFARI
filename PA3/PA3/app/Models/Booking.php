<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_customer',
        'no_telepon',
        'waktu_mulai',
        'waktu_selesai',
        'status',
        'payment_method',
        'payment_status',
        'payment_url',
        'total_price',
        'detail_paket_id',
        'users_id',
    ];





    public function detail_paket() {
        return $this->belongsTo(DetailPaket::class);
    }


    public function user() {
        return $this->belongsTo(User::class);
    }
}


