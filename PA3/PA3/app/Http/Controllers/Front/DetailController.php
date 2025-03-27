<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailPaket;

class DetailController extends Controller
{
    public  function index()
    {
        $detail_paket = DetailPaket::with(['pilihpaket'])->firstOrFail();
        $similiarItems = DetailPaket::with(['pilihpaket'])

            ->where('id', '!=', $detail_paket->id)
            ->get();

        return view('detail', [
            'detail_paket' => $detail_paket,
            'similiarItems' => $similiarItems
        ]);
    }
}
