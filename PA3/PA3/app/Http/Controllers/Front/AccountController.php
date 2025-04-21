<?php

namespace App\Http\Controllers\Front;
use App\Models\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = $request->get('tab', 'profile'); // Default ke 'profile' jika tidak ada parameter tab

        // Ambil semua booking user yang sedang login beserta detail_paket
    $bookings = Booking::with('detail_paket')
    ->where('users_id', auth()->id())
    ->get();

   return view('account', compact('activeTab', 'bookings'));
    }
}
