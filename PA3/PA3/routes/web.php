<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PilihPaketController as AdminPilihPaketController;


Route::get('/', function () {
    return view('welcome');
})->name('front.index');

Route::prefix('admin')->name('admin.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
   Route::get('/dashboard',[AdminDashboardController::class,'index'])->name('dashboard');
   Route::resource('pilihpakets',AdminPilihPaketController::class);


});
