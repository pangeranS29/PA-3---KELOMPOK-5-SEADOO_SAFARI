<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\DetailController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\LandingController;
use App\Http\Controllers\Admin\JetskiController as AdminJetskiController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PilihPaketController as AdminPilihPaketController;
use App\Http\Controllers\Admin\DetailPaketController as AdminDetailPaketController;
use App\Http\Controllers\Front\PaymentController;
use App\Http\Controllers\Front\AccountController;
use App\Http\Controllers\Auth\AuthenticatedSessionController; // 👈 Tambahkan ini

/*
|--------------------------------------------------------------------------
| Auth Routes (Guest Only)
|--------------------------------------------------------------------------
*/
// Route::middleware('guest')->group(function () {
//     Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
//     Route::post('login', [AuthenticatedSessionController::class, 'store']);
// });

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::name('front.')->group(function () {

    // Landing Page
    Route::get('/', [LandingController::class, 'index'])->name('index');

    // Detail Paket
    Route::get('/detail/{id}', [DetailController::class, 'index'])->name('detail');

    // Payment Success Page
    Route::get('/payment/success/{bookingId}', [PaymentController::class, 'success'])->name('payment.success');

    // Group Middleware Auth (Hanya Pengguna yang Login)
    Route::group(['middleware' => 'auth'], function () {
        // Checkout Page
        Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout/{id}', [CheckoutController::class, 'store'])->name('checkout.store');

        // Payment Page
        Route::get('/payment/{bookingId}', [PaymentController::class, 'index'])->name('payment');
        Route::post('/payment/update/{bookingId}', [PaymentController::class, 'updatePaymentMethod'])->name('payment.update');
        Route::post('/payment/upload/{bookingId}', [PaymentController::class, 'uploadBuktiPembayaran'])->name('payment.upload');

        // Batalkan dan Cetak
        Route::get('/payment/cancel/{bookingId}', [PaymentController::class, 'cancel'])->name('payment.cancel');
        Route::get('/cetak-resi/{bookingId}', [PaymentController::class, 'cetakResi'])->name('cetak.resi');

        // Akun
        Route::get('/account', [AccountController::class, 'index'])->name('account');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('pilihpakets', AdminPilihPaketController::class);
    Route::resource('detail_pakets', AdminDetailPaketController::class);
    Route::resource('bookings', AdminBookingController::class);
    Route::post('/bookings/{booking}/accept', [AdminBookingController::class, 'accept'])->name('bookings.accept');
    Route::post('/bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');
    Route::resource('jetski', AdminJetskiController::class);
});
