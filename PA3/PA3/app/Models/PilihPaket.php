<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PilihPaket extends Model
{
    use HasFactory;
    protected $table = 'pilihpakets'; // Pastikan ini ada jika nama tabel berbeda



    protected $fillable = [
        'title',
        'price',
        'deskripsi',
    ];

    public function item()
    {
        return $this->hasMany(Items::class);
    }
}
