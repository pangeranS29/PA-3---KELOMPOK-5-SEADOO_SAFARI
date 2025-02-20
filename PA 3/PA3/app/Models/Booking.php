<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'start_date',
        'end_date',
        'status',
        'payment_method',
        'payment_status',
        'payment_url',
        'pilihpakets_id',
        'total_price',
        'items_id',
        'users_id',
    ];

    protected $casts =[
        'start_date'=> 'datetime',
        'end_date'=> 'datetime',
    ];


    public function pilihpaket() {
        return $this->belongsTo(PilihPaket::class);
    }


    public function item() {
        return $this->belongsTo(Items::class);
    }


    public function user() {
        return $this->belongsTo(User::class);
    }
}
