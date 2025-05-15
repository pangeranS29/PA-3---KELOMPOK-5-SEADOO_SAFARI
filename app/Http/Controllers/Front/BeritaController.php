<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class BeritaController extends Controller
{
    /**
     * Display a listing of published news.
     */
    public function index()
    {
        $beritas = Berita::published()
            ->latest('tanggal_publikasi')
            ->paginate(6);

        return view('berita.index', compact('beritas'));
    }

    /**
     * Display the specified news item.
     */
    public function show($slug)
    {
        $berita = Berita::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $beritaTerbaru = Berita::published()
            ->where('id', '!=', $berita->id)
            ->latest('tanggal_publikasi')
            ->take(3)
            ->get();

        return view('berita.show', compact('berita', 'beritaTerbaru'));
    }

    public function latest()
    {
        $user = Auth::user();

        $beritas = Berita::published()
            ->with(['users' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])
            ->latest('tanggal_publikasi')
            ->take(5)
            ->get()
            ->map(function ($berita) use ($user) {
                 $gambarPath = $berita->gambar
                ? (Str::startsWith($berita->gambar, 'http')
                    ? $berita->gambar
                    : asset('storage/' . $berita->gambar))
                : asset('/images/news-placeholder.jpg');

                $pivot = $berita->users->first() ? $berita->users->first()->pivot : null;

                return [
                    'id' => $berita->id,
                    'judul' => $berita->judul,
                    'slug' => $berita->slug,
                    'gambar' => $gambarPath, // URL gambar final
                    'tanggal_publikasi' => $berita->tanggal_publikasi->format('d M Y, H:i'),
                    'dibaca' => $pivot ? $pivot->dibaca : false,
                    'pivot_exists' => $pivot ? true : false // Tambahkan field ini
                ];
            });

        return response()->json($beritas);
    }

    public function markAllAsRead(Request $request)
    {
        $user = $request->user();

        // Pertama, attach semua berita yang belum ada relasinya dengan user
        $unattachedBeritas = Berita::published()
            ->whereDoesntHave('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->pluck('id');

        if ($unattachedBeritas->count() > 0) {
            $user->beritas()->attach($unattachedBeritas, ['dibaca' => true]);
        }

        // Kemudian update semua yang sudah ada relasinya
        $user->beritas()->updateExistingPivot(
            $user->beritas()->pluck('berita_id'),
            ['dibaca' => true]
        );

        return response()->json([
            'success' => true,
            'message' => 'All notifications marked as read'
        ]);
    }

    // Otomatis attach berita ke user ketika dibuat
    public function attachBeritaToUsers($berita)
    {
        $users = User::all();
        $berita->users()->attach($users, ['dibaca' => false]);
    }
}
