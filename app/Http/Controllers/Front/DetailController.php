<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\DetailPaket;

class DetailController extends Controller
{
    public function index($id)
    {
        // Ambil data utama beserta relasinya
        $detail_paket = DetailPaket::with(['pilihpaket'])->findOrFail($id);

        // Ambil 4 item acak dengan kriteria:
        // 1. Bukan item yang sedang dilihat (id berbeda)
        // 2. Dari kategori yang sama (jika ada relasi kategori)
        // 3. Diacak dan dibatasi 4 item
        $similiarItems = DetailPaket::with(['pilihpaket'])
            ->where('id', '!=', $id)
            // Jika ada relasi kategori, tambahkan where ini:
            // ->where('category_id', $detail_paket->category_id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('detail', [
            'detail_paket' => $detail_paket,
            'similiarItems' => $similiarItems
        ]);
    }

    
}
