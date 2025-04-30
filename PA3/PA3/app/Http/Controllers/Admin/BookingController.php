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
                ->addColumn('no_telepon', function ($row) {
                    return $row->user ? $row->user->no_telepon : '-';
                })
                ->addColumn('nama_paket', function ($row) {
                    return $row->detail_paket && $row->detail_paket->pilihpaket
                        ? $row->detail_paket->pilihpaket->nama_paket
                        : '-';
                })
                ->addColumn('waktu_mulai', function ($row) {
                    return $row->waktu_mulai ? Carbon::parse($row->waktu_mulai)->translatedFormat('d F Y, H:i') : '-';
                })
                ->addColumn('waktu_selesai', function ($row) {
                    return $row->waktu_selesai ? Carbon::parse($row->waktu_selesai)->translatedFormat('d F Y, H:i') : '-';
                })
                ->addColumn('action', function ($booking) {
                    return '
                    <button class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-blue-500 border border-blue-500 rounded-md select-none ease hover:bg-blue-600 focus:outline-none focus:shadow-outline preview-btn"
                        data-id="' . $booking->id . '"
                        data-image="' . asset('storage/' . $booking->bukti_pembayaran) . '"
                        data-status="' . $booking->status_pembayaran . '"
                        data-phone="' . ($booking->user ? $booking->user->no_telepon : '') . '">
                        Preview
                    </button>';
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

    /**
     * Accept the booking payment
     */
    public function accept(Booking $booking)
    {
        $booking->update(['status_pembayaran' => 'success']);
        return response()->json(['message' => 'Status pembayaran berhasil diubah']);
    }

    /**
     * Reject the booking payment
     */
    /**
 * Reject the booking payment
 */
public function reject(Booking $booking, Request $request)
{
    $request->validate([
        'reason' => 'required|string'
    ]);

    $booking->update(['status_pembayaran' => 'rejected']);

    // Get customer phone number
    $customerPhone = $booking->user->phone;

    // Format phone number (remove leading 0 if exists and add 62)
    $formattedPhone = preg_replace('/^0/', '62', $customerPhone);

    // Get admin phone from config
    $adminPhone = env('ADMIN_PHONE', '6281234567890');

    // Create WhatsApp message
    $message = "Maaf, pembayaran Anda untuk booking #{$booking->id} ditolak dengan alasan: " . $request->reason;
    $message .= "\n\nSilakan hubungi admin di: " . $adminPhone . " untuk informasi lebih lanjut.";

    // URL encode the message
    $encodedMessage = urlencode($message);

    // Create WhatsApp deep link
    $whatsappUrl = "https://wa.me/{$formattedPhone}?text={$encodedMessage}";

    return response()->json([
        'message' => 'Status pembayaran berhasil diubah',
        'whatsapp_url' => $whatsappUrl
    ]);
}
}
