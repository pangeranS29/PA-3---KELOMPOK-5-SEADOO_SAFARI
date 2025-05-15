<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetailPaketRequest;
use Illuminate\Http\Request;
use App\Models\PilihPaket;
use App\Models\DetailPaket;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class DetailPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Script untuk Datatables,Ajax
        if (request()->ajax()) {
            $query = DetailPaket::with(['pilihpaket']);

            return DataTables::of($query)
                ->addColumn('action', function ($detail_paket) {
                    return '
                        <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                            href="' . route('admin.detail_pakets.edit', $detail_paket->id) . '">
                           Edit
                        </a>

                        <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.detail_pakets.destroy', $detail_paket->id) . '" method="POST">
                        <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->editColumn('foto', function ($detail_paket) {
                    if ($detail_paket->foto) {
                        return '<img src="' . asset('storage/' . $detail_paket->foto) . '" alt="foto" class="w-20 mx-auto rounded-md">';
                    }
                    return 'Tidak ada foto';
                })
                ->rawColumns(['foto', 'action'])
                ->make();
        }

        //Script untuk return halaman view Item
        return view('admin.detail_pakets.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pilihpakets = PilihPaket::all();
        return view('admin.detail_pakets.create', compact('pilihpakets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DetailPaketRequest $request)
    {
        $data = $request->all();

        // Upload single photo
        if ($request->hasFile('foto')) {
            $photo = $request->file('foto');
            $data['foto'] = $photo->store('item', 'public');
        }

        DetailPaket::create($data);
        return redirect()->route('admin.detail_pakets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailPaket $detail_paket)
    {
        $detail_paket->load('pilihpaket');
        $pilihpakets = PilihPaket::all();
        return view('admin.detail_pakets.edit', compact('detail_paket', 'pilihpakets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DetailPaketRequest $request, DetailPaket $detail_paket)
    {
        $data = $request->all();

        // Upload single photo
        if ($request->hasFile('foto')) {
            // Delete old photo first
            if ($detail_paket->foto) {
                Storage::disk('public')->delete($detail_paket->foto);
            }

            $photo = $request->file('foto');
            $data['foto'] = $photo->store('item', 'public');
        } else {
            $data['foto'] = $detail_paket->foto;
        }

        $detail_paket->update($data);
        return redirect()->route('admin.detail_pakets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailPaket $detail_paket)
    {
        // Delete associated photo
        if ($detail_paket->foto) {
            Storage::disk('public')->delete($detail_paket->foto);
        }

        $detail_paket->delete();
        return redirect()->route('admin.detail_pakets.index');
    }
}
