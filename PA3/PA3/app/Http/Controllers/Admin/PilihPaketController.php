<?php

namespace App\Http\Controllers\Admin;

use App\Models\PilihPaket;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Http\Requests\PilihPaketRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PilihPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response\|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //Script untuk Datatables,Ajax
        if (request()->ajax()) {
            $query = PilihPaket::query();

            return DataTables::of($query)
                ->addColumn('action', function ($pilihpakets) {
                    return '
                        <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                            href="' . route('admin.pilihpakets.edit', $pilihpakets->id) . '">
                           Edit
                        </a>

                        <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.pilihpakets.destroy', $pilihpakets->id) . '" method="POST">
                        <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->rawColumns(['action'])
                ->make();
        }



        //Script untuk return halaman view pilihpaket
        return view('admin.pilihpakets.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pilihpakets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PilihPaketRequest $request)
    {
        // Data sudah divalidasi oleh PilihPaketRequest
        PilihPaket::create($request->validated());

        return redirect()->route('admin.pilihpakets.index')->with('success', 'Paket berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PilihPaket $pilihpaket)
    {
        return view('admin.pilihpakets.edit', compact('pilihpaket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PilihPaketRequest $request, string $id)
    {
        $pilihpakets = PilihPaket::findOrFail($id);
        $pilihpakets->update($request->validated());
        return redirect()->route('admin.pilihpakets.index')->with('success', 'Paket berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pilihpaket = PilihPaket::findOrFail($id);
        $pilihpaket->delete();

        return redirect()->route('admin.pilihpakets.index')->with('success', 'Paket berhasil dihapus!');
    }
}
