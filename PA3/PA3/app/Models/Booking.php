<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings'; // Nama tabel

    protected $fillable = [
        'nama_customer',
        'no_telepon',
        'waktu_mulai',
        'waktu_selesai',
        'status',
        'jumlah_penumpang', // Tambahkan ini
        'nama_penumpang1',
        'nama_penumpang2',
        'metode_pembayaran',
        'status_pembayaran',
        'bukti_pembayaran',
        'url_pembayaran',
        'total_harga',
        'detail_paket_id',
        'users_id',
    ];

    public function detail_paket()
    {
        return $this->belongsTo(DetailPaket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Model Booking.php
    public function jetskis()
    {
        return $this->hasMany(Jetski::class);
    }
}
