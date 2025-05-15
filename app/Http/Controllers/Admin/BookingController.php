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
                ->addColumn('phone', function ($row) {
                    return $row->user ? $row->user->phone : '-';
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
                    <button class="block w-full px-3 py-2 mb-1 text-sm text-center text-white transition duration-200 bg-blue-500 border border-blue-500 rounded-md select-none ease hover:bg-blue-600 focus:outline-none focus:shadow-outline preview-btn"
                        data-id="' . $booking->id . '"
                        data-image="' . asset('storage/' . $booking->bukti_pembayaran) . '"
                        data-status="' . $booking->status_pembayaran . '"
                        data-phone="' . ($booking->user ? $booking->user->phone : '') . '">
                        <i class="fas fa-eye mr-1"></i> Preview
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
     * Accept the booking payment and notify customer
     */
    public function accept(Booking $booking)
    {
        $booking->update(['status_pembayaran' => 'success']);

        // Get customer phone number
        $customerPhone = $booking->user->phone;

        // Format phone number (remove leading 0 if exists and add 62)
        $formattedPhone = preg_replace('/^0/', '62', $customerPhone);

        // Get admin phone from config
        $adminPhone = env('ADMIN_PHONE', '6281234567890');

        // Create WhatsApp confirmation message
        $message = "Pembayaran Anda untuk booking #{$booking->id} telah berhasil diverifikasi.";
        $message .= "\n\nSilakan cek di: Profile -> Transaksi Saya -> Cetak Resi";
        $message .= "\n\nHubungi admin di: " . $adminPhone . " jika ada pertanyaan.";

        // URL encode the message
        $encodedMessage = urlencode($message);

        // Create WhatsApp deep link
        $whatsappUrl = "https://wa.me/{$formattedPhone}?text={$encodedMessage}";

        return response()->json([
            'message' => 'Status pembayaran berhasil diubah',
            'whatsapp_url' => $whatsappUrl
        ]);
    }

    /**
     * Reject the booking payment (but keep status as pending)
     */
    public function reject(Booking $booking, Request $request)
    {
        $request->validate([
            'reason' => 'required|string'
        ]);

        // We don't change the status to rejected, we keep it as pending
        $booking->update(['status_pembayaran' => 'rejected']);

        // Get customer phone number
        $customerPhone = $booking->user->phone;

        // Format phone number (remove leading 0 if exists and add 62)
        $formattedPhone = preg_replace('/^0/', '62', $customerPhone);

        // Get admin phone from config
        $adminPhone = env('ADMIN_PHONE', '6281234567890');

        // Create WhatsApp message
        $message = "Maaf, pembayaran Anda untuk booking #{$booking->id} tidak valid dengan alasan: " . $request->reason;
        $message .= "\n\nSilakan upload ulang bukti pembayaran yang valid.";
        $message .= "\n\nHubungi admin di: " . $adminPhone . " jika ada pertanyaan.";

        // URL encode the message
        $encodedMessage = urlencode($message);

        // Create WhatsApp deep link
        $whatsappUrl = "https://wa.me/{$formattedPhone}?text={$encodedMessage}";

        return response()->json([
            'message' => 'Pemberitahuan penolakan berhasil dikirim',
            'whatsapp_url' => $whatsappUrl
        ]);
    }

    /**
     * Proses refund untuk booking
     */
    public function processRefund(Booking $booking, Request $request)
    {
        $request->validate([
            'refund_proof' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'refund_note' => 'nullable|string|max:500'
        ]);

        // Simpan bukti transfer refund
        $refundProofPath = $request->file('refund_proof')->store('refund_proofs', 'public');

        // Update data booking
        $booking->update([
            'status_pembayaran' => 'refunded',
            'total_harga' => null, // Kosongkan total harga
            'refund_proof' => $refundProofPath,
            'refund_processed_at' => now()
        ]);

        // Format nomor telepon customer
        $customerPhone = preg_replace('/^0/', '62', $booking->user->phone);
        $adminPhone = env('ADMIN_PHONE', '6285763189029');

        // Buat pesan WhatsApp
        $message = "📢 *PEMBERITAHUAN REFUND* 📢\n\n";
        $message .= "Booking ID: #{$booking->id}\n";
        $message .= "Status: *Refund Berhasil Diproses*\n\n";
        $message .= "Dana telah dikembalikan ke rekening Anda.\n\n";

        if ($request->refund_note) {
            $message .= "📝 Catatan:\n{$request->refund_note}\n\n";
        }

        $message .= "🔗 Bukti Refund:\n" . asset('storage/' . $refundProofPath) . "\n\n";
        $message .= "Untuk pertanyaan, hubungi Admin:\n{$adminPhone}";

        $whatsappUrl = "https://wa.me/{$customerPhone}?text=" . urlencode($message);

        return response()->json([
            'message' => 'Refund berhasil diproses',
            'whatsapp_url' => $whatsappUrl
        ]);
    }
}
