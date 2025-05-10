<?php

namespace App\Http\Controllers\Front;

use App\Models\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
        'phone' => 'nullable|string|max:20',
    ]);

    $user = auth()->user();
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
    ]);

    return redirect()->route('front.account')->with('success', 'Profile updated successfully!');
}

public function resetPassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    $user = auth()->user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Password saat ini salah']);
    }

    $user->update([
        'password' => Hash::make($request->new_password)
    ]);

    return redirect()->route('front.account')
           ->with('success', 'Password berhasil direset!');
}

}
