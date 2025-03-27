<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PilihPaketController as AdminPilihPaketController;
use App\Http\Controllers\Admin\DetailPaketController as AdminDetailPaketController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\JetskiController as AdminJetskiController;
use App\Http\Controllers\Front\LandingController ;
use App\Http\Controllers\Front\DetailController ;


Route::name('front.')->group(function (){

    Route::get('/', [LandingController::class, 'index'])->name('index');
    Route::get('/detail', [DetailController::class, 'index'])->name('detail');





});


Route::prefix('admin')->name('admin.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
   Route::get('/dashboard',[AdminDashboardController::class,'index'])->name('dashboard');
   Route::resource('pilihpakets',AdminPilihPaketController::class);
   Route::resource('detail_pakets',AdminDetailPaketController::class);
   Route::resource('bookings',AdminBookingController::class);
   Route::resource('jetski', AdminJetskiController::class);



});
