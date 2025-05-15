<?php

namespace App\Http\Controllers\Admin;

use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\BeritaRequest;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Berita::query();

            return DataTables::of($query)
                ->addColumn('action', function ($berita) {
                    return '
        <div class="flex space-x-2">
            <a href="' . route('admin.beritas.edit', $berita->id) . '"
                class="action-btn bg-blue-500 hover:bg-blue-600 text-white">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <form class="delete-form" action="' . route('admin.beritas.destroy', $berita->id) . '" method="POST">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit"
                    class="action-btn bg-red-500 hover:bg-red-600 text-white delete-btn"
                    data-id="' . $berita->id . '">
                    <i class="fas fa-trash mr-1"></i> Hapus
                </button>
            </form>
        </div>';
                })
                ->editColumn('dipublikasikan', function ($berita) {
                    return $berita->dipublikasikan
                        ? '<span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">Published</span>'
                        : '<span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-200 rounded-full">Draft</span>';
                })
                ->editColumn('tanggal_publikasi', function ($berita) {
                    return $berita->tanggal_publikasi
                        ? $berita->tanggal_publikasi->format('d M Y H:i')
                        : '-';
                })
                ->rawColumns(['action', 'dipublikasikan'])
                ->make();
        }

        return view('admin.berita.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BeritaRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['judul']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.beritas.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        return view('admin.berita.show', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BeritaRequest $request, Berita $berita)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['judul']);

        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('admin.beritas.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        // Delete image if exists
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('admin.beritas.index')->with('success', 'Berita berhasil dihapus!');
    }
}
