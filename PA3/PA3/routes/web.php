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

Route::name('front.')->group(function () {

    Route::get('/', [LandingController::class, 'index'])->name('index');
    Route::get('/detail/{id}', [DetailController::class, 'index'])->name('detail');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout/{id}', [CheckoutController::class, 'store'])->name('checkout.store');



        Route::get('/payment/{bookingId}', [PaymentController::class, 'index'])->name('payment');
        Route::post('/payment/{bookingId}', [PaymentController::class, 'update'])->name('payment.update');
    });
});


Route::prefix('admin')->name('admin.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('pilihpakets', AdminPilihPaketController::class);
    Route::resource('detail_pakets', AdminDetailPaketController::class);
    Route::resource('bookings', AdminBookingController::class);
    Route::resource('jetski', AdminJetskiController::class);
});
