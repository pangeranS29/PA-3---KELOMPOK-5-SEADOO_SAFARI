<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailPaket;

class LandingController extends Controller
{
    public function index()
    {
        // Get all detail packages with their related pilihpaket, ordered by latest
        $detail_pakets = DetailPaket::with(['pilihpaket'])->latest()->get();

        return view('landing', [
            'detail_pakets' => $detail_pakets
        ]);
    }
}
