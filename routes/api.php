<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Berita;
use App\Http\Controllers\Front\BeritaController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/berita/latest', function() {
//     $beritas = Berita::published()
//         ->latest('tanggal_publikasi')
//         ->take(5)
//         ->get(['id', 'judul', 'slug', 'gambar', 'tanggal_publikasi'])
//         ->map(function($berita) {
//             return [
//                 'id' => $berita->id,
//                 'judul' => $berita->judul,
//                 'slug' => $berita->slug,
//                 'gambar' => $berita->gambar ? '/storage/' . $berita->gambar : '/images/news-placeholder.jpg',
//                 'tanggal_publikasi' => $berita->tanggal_publikasi->format('d M Y, H:i')
//             ];
//         });

//     return response()->json($beritas);
// })->name('api.berita.latest'); // Tetap gunakan nama route yang sama

// Route::get('/berita/latest', [BeritaController::class, 'latest'])->name('api.berita.latest');
