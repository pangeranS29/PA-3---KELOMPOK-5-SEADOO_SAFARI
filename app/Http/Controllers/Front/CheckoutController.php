<?php

namespace App\Http\Controllers\Front;

use App\Models\Booking;
use App\Models\DetailPaket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    const JETSKI_CAPACITY = 15; // Ubah kapasitas menjadi 15


    public function index(Request $request, $id)
    {
        $detail_paket = DetailPaket::with(['pilihpaket'])->find($id);

         // Get dates that already have 15 successful bookings
        $fullyBookedDates = Booking::selectRaw('DATE(waktu_mulai) as date')
            ->where('status_pembayaran', 'success')
            ->where('waktu_selesai', '>', now())
            ->whereDate('waktu_mulai', '>=', now())
            ->groupBy('date')
            ->havingRaw('COUNT(*) >= ' . self::JETSKI_CAPACITY)
            ->pluck('date')
            ->toArray();

        return view('checkout', [
            'detail_paket' => $detail_paket,
            'disabledDates' => $fullyBookedDates
        ]);
    }

    public function store(Request $request, $id)
    {
       // Check jetski availability for the selected date
        $bookedJetskis = Booking::whereDate('waktu_mulai', $request->waktu_mulai)
            ->where('status_pembayaran', 'success')
            ->where('waktu_selesai', '>', now())
            ->count();

        if ($bookedJetskis >= self::JETSKI_CAPACITY) {
            return back()->withErrors([
                'waktu_mulai' => 'Maaf, semua jetski sudah dipesan untuk waktu ini. Silakan pilih waktu lain.'
            ]);
        }

        $validatedData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'waktu_mulai' => [
                'required',
                'date',
                'after_or_equal:now',
                'before_or_equal:+14 days',
                function ($attribute, $value, $fail) {
                    $hour = date('H', strtotime($value));
                    if ($hour < 7 || $hour >= 17) {
                        $fail('Waktu booking harus antara jam 07:00 - 17:00.');
                    }
                }
            ],
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'jumlah_penumpang' => 'required|integer|min:1|max:2',
            'penumpang_1_nama' => 'required|string',
            'penumpang_2_nama' => 'nullable|string',
            'harga_drone' => 'required|integer',
        ]);

        $detailPaket = DetailPaket::with('pilihpaket')->findOrFail($id);

        $hargaDasar = $detailPaket->pilihpaket->harga ?? 0;
        $hargaDrone = $request->input('harga_drone', 0);
        $totalHarga = $hargaDasar + $hargaDrone;

        $booking = Booking::create([
            'nama_customer'     => $validatedData['name'],
            'no_telepon'        => $validatedData['phone'],
            'waktu_mulai'       => $validatedData['waktu_mulai'],
            'waktu_selesai'     => $validatedData['waktu_selesai'],
            'jumlah_penumpang'  => $validatedData['jumlah_penumpang'],
            'status'            => 'success',
            'nama_penumpang1'   => $validatedData['penumpang_1_nama'],
            'nama_penumpang2'   => $validatedData['penumpang_2_nama'] ?? null,
            'total_harga'       => $totalHarga,
            'harga_drone'       => $hargaDrone,
            'detail_paket_id'   => $id,
            'status_pembayaran' => 'pending',
            'users_id'          => Auth::id(),
        ]);

        return redirect()->route('front.payment', $booking->id)
            ->with('success', 'Booking berhasil dibuat!');
    }
}
