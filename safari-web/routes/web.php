<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PembayaranController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ✅ Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// ✅ Route Booking (Pemesanan)
Route::prefix('booking')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('booking.index');  // Menampilkan daftar booking
    Route::get('/form', function () {
        return view('formbooking');  // Menampilkan form pemesanan
    })->name('booking.form');
    Route::post('/store', [BookingController::class, 'store'])->name('booking.store'); // Menyimpan data booking
    Route::get('/success', [BookingController::class, 'success'])->name('booking.success'); // Halaman sukses booking
    Route::get('/bukti', [BookingController::class, 'showBukti'])->name('booking.bukti'); // Menampilkan bukti booking
});

// ✅ Route Pembayaran
Route::prefix('pembayaran')->group(function () {
    Route::get('/{id}', [PembayaranController::class, 'show'])->name('pembayaran.detail'); // Menampilkan detail pembayaran
    Route::get('/{id}/proses', [PembayaranController::class, 'proses'])->name('pembayaran.proses'); // Proses pembayaran
});

// ✅ Halaman Tambahan
Route::get('/detail-pembayaran', function () {
    return view('detail_pembayaran');
})->name('detail.pembayaran');

Route::get('/verifikasi', function () {
    return view('verifikasi');
})->name('verifikasi');
