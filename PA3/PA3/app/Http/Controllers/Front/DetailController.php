<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailPaket;

class DetailController extends Controller
{
    public function index($id) // Tambahkan parameter id
    {
        // Ambil data sesuai ID
        $detail_paket = DetailPaket::with(['pilihpaket'])->find($id);

        // Ambil item lain yang tidak memiliki id yang sama
        $similiarItems = DetailPaket::with(['pilihpaket'])
            ->where('id', '!=', $id)
            ->get();

        return view('detail', [
            'detail_paket' => $detail_paket,
            'similiarItems' => $similiarItems
        ]);
    }
}
