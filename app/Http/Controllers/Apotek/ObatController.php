<?php

namespace App\Http\Controllers\Apotek;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Obat::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama_obat', 'like', "%{$search}%");
        }

        $obats = $query->orderBy('nama_obat')->paginate(10);

        return view('apotek.obat.index', compact('obats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('apotek.obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
            'harga_jual' => 'required|integer|min:0',
        ]);

        Obat::create($validated);

        return redirect()->route('apotek.obat.index')
            ->with('success', 'Data obat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Obat $obat)
    {
        return view('apotek.obat.show', compact('obat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Obat $obat)
    {
        return view('apotek.obat.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Obat $obat)
    {
        $validated = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
            'harga_jual' => 'required|integer|min:0',
        ]);

        $obat->update($validated);

        return redirect()->route('apotek.obat.index')
            ->with('success', 'Data obat berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Obat $obat)
    {
        $obat->delete();

        return redirect()->route('apotek.obat.index')
            ->with('success', 'Data obat berhasil dihapus');
    }
}
