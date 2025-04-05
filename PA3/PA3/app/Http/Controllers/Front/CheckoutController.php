<?php

namespace App\Http\Controllers\Front;

use App\Models\Booking;
use App\Models\DetailPaket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request, $id)
    {
        $detail_paket = DetailPaket::with(['pilihpaket'])->find($id);

        return view('checkout', [
            'detail_paket' => $detail_paket
        ]);
    }

    public function store(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string',
        'phone' => 'required|string',
        'waktu_mulai' => 'required|date',
        'waktu_selesai' => 'required|date|after:waktu_mulai',
        'jumlah_penumpang' => 'required|integer',
        'harga_drone' => 'nullable',
    ]);

    $detailPaket = DetailPaket::with('pilihpaket')->findOrFail($id);

    $hargaDasar = $detailPaket->pilihpaket->harga ?? 0;
    $hargaDrone = $request->filled('harga_drone') ? ($detailPaket->harga_drone ?? 0) : 0;

    $totalHarga = $hargaDasar + $hargaDrone;

    $booking = Booking::create([
        'nama_customer'    => $validatedData['name'],
        'no_telepon'       => $validatedData['phone'],
        'waktu_mulai'      => $validatedData['waktu_mulai'],
        'waktu_selesai'    => $validatedData['waktu_selesai'],
        'jumlah_penumpang' => $validatedData['jumlah_penumpang'],
        'total_harga'      => $totalHarga,
        'detail_paket_id'  => $id,
        'status_pembayaran'=>'pending',
        'users_id'         => Auth::id(),
    ]);

    return redirect()->route('front.payment', $booking->id)
        ->with('success', 'Booking berhasil dibuat!');
}

}
