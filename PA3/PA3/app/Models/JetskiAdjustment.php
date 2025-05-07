<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JetskiAdjustment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'type',
        'adjusted_at'
    ];

    protected $casts = [
        'adjusted_at' => 'datetime'
    ];
}
