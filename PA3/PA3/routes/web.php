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
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');

    // Group Middleware Auth (Hanya Pengguna yang Login)
    Route::group(['middleware' => 'auth'], function () {
        // Checkout Page
        Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout/{id}', [CheckoutController::class, 'store'])->name('checkout.store');

        // Payment Page
        Route::get('/payment/{bookingId}', [PaymentController::class, 'index'])->name('payment');
        Route::post('/payment/{bookingId}', [PaymentController::class, 'update'])->name('payment.update');

        // 👇 Batalkan Pembayaran (route baru)
        Route::post('/payment/cancel/{bookingId}', [PaymentController::class, 'cancel'])->name('payment.cancel');
    });
});


/*
|--------------------------------------------------------------------------
| API Routes for Midtrans Notification
|--------------------------------------------------------------------------
*/
Route::post('/midtrans/notification', [PaymentController::class, 'notification'])
    ->name('midtrans.notification')
    ->withoutMiddleware(['web']); // Nonaktifkan middleware web untuk endpoint ini

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
    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // CRUD Pilih Paket
    Route::resource('pilihpakets', AdminPilihPaketController::class);

    // CRUD Detail Paket
    Route::resource('detail_pakets', AdminDetailPaketController::class);

    // CRUD Bookings
    Route::resource('bookings', AdminBookingController::class);

    // CRUD Jetski
    Route::resource('jetski', AdminJetskiController::class);
});
