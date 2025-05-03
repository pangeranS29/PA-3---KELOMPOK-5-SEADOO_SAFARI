<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {

        // Total counts
        $totalBookings = Booking::count();
        $totalUsers = User::count();
        $totalRevenue = Booking::where('status_pembayaran', 'success')->sum('total_harga');

        // Percentage increases
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


        // Chart data
        $bookingData = [];
        $bookingMonths = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $bookingData[] = Booking::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $bookingMonths[] = $month->format('M Y');
        }
    //      // Debug data grafik
    // dd($bookingData, $bookingMonths); // ✅ Tempatkan di sini

        // Recent data
        $recentBookings = Booking::with(['user', 'detail_paket.pilihpaket'])
            ->latest()
            ->take(5)
            ->get();

        $latestBookings = Booking::with(['user', 'detail_paket.pilihpaket'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalBookings',
            'totalUsers',
            'totalRevenue',
            'bookingIncrease',
            'revenueIncrease',
            'userIncrease',
            'bookingData',
            'bookingMonths',
            'recentBookings',
            'latestBookings'
        ));

    }
}
