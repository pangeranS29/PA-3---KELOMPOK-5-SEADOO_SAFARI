<?php

use App\Models\Berita;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\DetailController;
use App\Http\Controllers\Front\AccountController;
use App\Http\Controllers\Front\LandingController;
use App\Http\Controllers\Front\PaymentController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\JetskiController as AdminJetskiController;
use App\Http\Controllers\Front\BeritaController as FrontBeritaController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaPaketController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PilihPaketController as AdminPilihPaketController;
use App\Http\Controllers\Auth\AuthenticatedSessionController; // 👈 Tambahkan ini
use App\Http\Controllers\Admin\DetailPaketController as AdminDetailPaketController;


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

    // Payment Page
    Route::get('/payment/{bookingId}', [PaymentController::class, 'index'])->name('payment');

    // Berita Routes
    Route::prefix('berita')->name('berita.')->group(function () {
        Route::get('/', [FrontBeritaController::class, 'index'])->name('index');
        Route::get('/{slug}', [FrontBeritaController::class, 'show'])->name('show');
    });

    // Group Middleware Auth (Hanya Pengguna yang Login)
    Route::group(['middleware' => 'auth'], function () {
        // Checkout Page
        Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout/{id}', [CheckoutController::class, 'store'])->name('checkout.store');


        // Ubah route upload menjadi GET untuk menampilkan form
        Route::get('/payment/{bookingId}/upload', [PaymentController::class, 'showUploadForm'])->name('payment.show');
        Route::post('/payment/update/{bookingId}', [PaymentController::class, 'updatePaymentMethod'])->name('payment.update');
        Route::post('/payment/upload/{bookingId}', [PaymentController::class, 'uploadBuktiPembayaran'])->name('payment.upload');
        Route::post('/payment/{booking}/check-expired', [PaymentController::class, 'checkExpired'])->name('payment.check-expired');
        Route::post('/payment/{booking}/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

        Route::middleware('auth')->group(function() {
    Route::get('/api/berita/latest', [FrontBeritaController::class, 'latest'])->name('api.berita.latest');
    Route::post('/api/berita/mark-all-read', [FrontBeritaController::class, 'markAllAsRead'])->name('api.berita.markAllAsRead');
});



        Route::get('/cetak-resi/{bookingId}', [PaymentController::class, 'cetakResi'])->name('cetak.resi');

        // Account Page
        Route::get('/account', [AccountController::class, 'index'])->name('account');
        Route::put('/account/update', [AccountController::class, 'update'])->name('account.update');
        Route::post('/account/reset-password', [AccountController::class, 'resetPassword'])->name('account.reset-password');

        Route::post('/booking/{booking}/check-status', [AccountController::class, 'checkBookingStatus'])
            ->name('booking.check-status');
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

    // Berita Routes
    Route::resource('beritas', AdminBeritaPaketController::class)
        ->except(['show'])
        ->names([
            'index' => 'beritas.index',
            'create' => 'beritas.create',
            'store' => 'beritas.store',
            'edit' => 'beritas.edit',
            'update' => 'beritas.update',
            'destroy' => 'beritas.destroy',
        ]);

    // Optional: If you want to include the show route
    Route::get('beritas/{berita}',[AdminBeritaPaketController::class, 'show'])
        ->name('beritas.show');
});
