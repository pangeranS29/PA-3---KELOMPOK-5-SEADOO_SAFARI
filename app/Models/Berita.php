<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'ringkasan',
        'konten',
        'gambar',
        'tautan_eksternal',
        'dipublikasikan',
        'tanggal_publikasi',
        'dibaca' // pastikan kolom ini memang ada di tabel `berita`
    ];

    protected $casts = [    
        'tanggal_publikasi' => 'datetime',
        'dipublikasikan' => 'boolean',
        'dibaca' => 'boolean' // tambahkan jika kolom dibaca adalah tipe boolean
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            $berita->slug = Str::slug($berita->judul);
        });

        static::updating(function ($berita) {
            $berita->slug = Str::slug($berita->judul);
        });
    }

    public function scopePublished($query)
    {
        return $query->where('dipublikasikan', true)
                    ->whereNotNull('tanggal_publikasi')
                    ->where('tanggal_publikasi', '<=', now());
    }

    // Tambahkan scope ini sesuai permintaan
    public function scopeUnread($query)
    {
        return $query->where('dibaca', false);
    }

     public function users()
    {
        return $this->belongsToMany(User::class, 'user_berita')
            ->withPivot('dibaca')
            ->withTimestamps();
    }

    public function scopeForUser($query, $userId)
    {
        return $query->whereHas('users', function($q) use ($userId) {
            $q->where('user_id', $userId);
        });
    }
}
