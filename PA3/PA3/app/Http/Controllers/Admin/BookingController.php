<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\PilihPaket;
use App\Models\DetailPaket;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Booking::with(['user', 'detail_paket.pilihpaket'])->select('bookings.*');

            return DataTables::of($query)
                ->addColumn('user_name', function ($row) {
                    return $row->user ? $row->user->name : '-';
                })
                ->addColumn('nama_paket', function ($row) {
                    return $row->detail_paket && $row->detail_paket->pilihpaket
                        ? $row->detail_paket->pilihpaket->nama_paket
                        : '-';
                })
                // Format waktu_mulai
                ->addColumn('waktu_mulai', function ($row) {
                    return $row->waktu_mulai ? Carbon::parse($row->waktu_mulai)->translatedFormat('d F Y, H:i') : '-';
                })
                // Format waktu_selesai
                ->addColumn('waktu_selesai', function ($row) {
                    return $row->waktu_selesai ? Carbon::parse($row->waktu_selesai)->translatedFormat('d F Y, H:i') : '-';
                })
                ->addColumn('action', function ($booking) {
                    return '
                        <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                            href="' . route('admin.bookings.edit', $booking->id) . '">
                           Edit
                        </a>

                        <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.bookings.destroy', $booking->id) . '" method="POST">
                        <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.bookings.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        return view('admin.bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $booking->update($request->all());
        return redirect()->route('admin.bookings.index')->with('success', 'Paket berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index');
    }
}
