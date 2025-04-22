<?php

namespace App\Http\Controllers\Front;

use App\Models\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = $request->query('tab', 'profile'); // Default ke 'profile'

        $bookings = collect(); // Biar tetap aman di semua tab

        if ($activeTab === 'transaction') {
            $bookings = Booking::with('detail_paket.pilihpaket')
                ->where('users_id', auth()->id()) // ✅ Ganti ke kolom yang benar
                ->orderByDesc('created_at')
                ->paginate(5);
        }

        return view('account', compact('activeTab', 'bookings'));
    }
}
