<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        return view('booking');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required',
            'passenger' => 'required|integer|min:1',
        ]);

        Booking::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'date' => $request->date,
            'time' => $request->time,
            'passenger' => $request->passenger,
            'include_drone' => $request->has('include_drone'),
        ]);

        return redirect()->route('booking.success')->with('success', 'Booking berhasil!');
    }

    public function success()
    {
        return view('success');
    }

    public function showBukti()
    {
        // Simulasi data booking (ambil dari database di proyek asli)
        $booking = Booking::latest()->first(); // Ambil booking terbaru

        return view('bukti_booking', compact('booking'));
    }
}
