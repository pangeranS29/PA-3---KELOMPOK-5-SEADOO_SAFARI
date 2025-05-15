<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    const JETSKI_CAPACITY = 15; // Ubah kapasitas menjadi 15


    public function index(Request $request)
    {
        // Get search and date filter parameters
        $search = $request->input('search');
        $dateFilter = $request->input('date_filter', today()->format('Y-m-d'));

        // Base query for today's bookings
        $todayBookingsQuery = Booking::with(['user', 'detail_paket.pilihpaket'])
            ->whereDate('waktu_mulai', $dateFilter);

        // Apply search if exists
        if ($search) {
            $todayBookingsQuery->where(function($query) use ($search) {
                $query->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%")
                      ->orWhere('phone', 'like', "%$search%");
                })
                ->orWhereHas('detail_paket.pilihpaket', function($q) use ($search) {
                    $q->where('nama_paket', 'like', "%$search%");
                });
            });
        }

        // Get today's bookings
        $todayBookings = $todayBookingsQuery->latest()->get();

        // Calculate jetski availability - hanya hitung booking yang masih aktif (belum melewati waktu_selesai)
        $bookedJetskisToday = Booking::whereDate('waktu_mulai', $dateFilter)
            ->where('status_pembayaran', 'success')
            ->where('waktu_selesai', '>', now())
            ->count();

        $availableJetskis = max(0, self::JETSKI_CAPACITY - $bookedJetskisToday);

        // Total counts
        $totalBookings = Booking::count();
        $totalUsers = User::count();
        $totalRevenue = Booking::where('status_pembayaran', 'success')->sum('total_harga');

        // Percentage increases (same as before)
        $lastMonthBookings = Booking::where('created_at', '>=', now()->subMonth())->count();
        $previousMonthBookings = Booking::whereBetween('created_at', [now()->subMonths(2), now()->subMonth()])->count();
        $bookingIncrease = $previousMonthBookings > 0 ? round(($lastMonthBookings - $previousMonthBookings) / $previousMonthBookings * 100) : 100;

        $lastMonthRevenue = Booking::where('status_pembayaran', 'success')
            ->where('created_at', '>=', now()->subMonth())
            ->sum('total_harga');
        $previousMonthRevenue = Booking::where('status_pembayaran', 'success')
            ->whereBetween('created_at', [now()->subMonths(2), now()->subMonth()])
            ->sum('total_harga');
        $revenueIncrease = $previousMonthRevenue > 0 ? round(($lastMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue * 100) : 100;

        $userIncrease = User::where('created_at', '>=', now()->subMonth())->count();

        return view('admin.dashboard', compact(
            'totalBookings',
            'totalUsers',
            'totalRevenue',
            'bookingIncrease',
            'revenueIncrease',
            'userIncrease',
            'todayBookings',
            'availableJetskis',
            'bookedJetskisToday',
            'search',
            'dateFilter'
        ));
    }
}
