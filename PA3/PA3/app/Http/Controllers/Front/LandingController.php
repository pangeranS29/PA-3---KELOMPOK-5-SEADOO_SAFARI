<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailPaket;

class LandingController extends Controller
{
    public function index()
    {

        $detail_pakets = DetailPaket::with(['pilihpaket'])->latest()->take(4)->get()->reverse();

        return view('landing', [
            'detail_pakets' => $detail_pakets
        ]);
    }
}
