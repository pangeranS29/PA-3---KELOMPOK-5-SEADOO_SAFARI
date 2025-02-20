<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PilihPaket extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'nama',
        'price',
        'deskripsi',
    ];

    public function Items()
    {
        return $this->hasMany(Items::class);
    }
}
