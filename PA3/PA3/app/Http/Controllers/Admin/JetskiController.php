<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jetski;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JetskiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Script untuk Datatables,Ajax
        if (request()->ajax()) {
            $query = Jetski::with(['pilihpaket']);

            return DataTables::of($query)
                ->addColumn('action', function ($jetski) {
                    return '
                        <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                            href="' . route('admin.jetski.edit', $jetski->id) . '">
                           Edit
                        </a>

                        <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.jetski.destroy', $jetski->id) . '" method="POST">
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
        return view('admin.jetski.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jetski.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status_jetski' => 'required|string',
            'jumlah_jetski' => 'required|integer',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',

        ]);

        Jetski::create($request->all());

        return redirect()->route('admin.jetski.index')->with('success', 'Jetski berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jetski = Jetski::findOrFail($id);
        return view('admin.jetski.edit', compact('jetski'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status_jetski' => 'required|string',
            'jumlah_jetski' => 'required|integer',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',

        ]);

        $jetski = Jetski::findOrFail($id);
        $jetski->update($request->all());

        return redirect()->route('admin.jetski.index')->with('success', 'Jetski berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jetski = Jetski::findOrFail($id);
        $jetski->delete();

        return redirect()->route('admin.jetski.index')->with('success', 'Jetski berhasil dihapus.');
    }
}
