<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TransactionNotificationController extends Controller
{
    public function latest(Request $request)
    {
        $user = Auth::user();
        if (!$user) return response()->json([]);

        // Ambil transaksi sukses terbaru
        $transactions = Booking::where('user_id', $user->id)
            ->where('status_pembayaran', 'success')
            ->whereNull('notified_at') // kolom untuk tracking apakah sudah muncul di notifikasi
            ->with(['detail_paket.pilihpaket'])
            ->orderByDesc('created_at')
            ->limit(5) // ✅ diperbaiki dari .limit ke ->limit
            ->get();

        // Setelah fetch, tandai bahwa notifikasi sudah ditampilkan
        foreach ($transactions as $trx) {
            $trx->update(['notified_at' => now()]);
        }

        return response()->json($transactions);
    }
}
