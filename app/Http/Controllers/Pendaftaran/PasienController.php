<?php

namespace App\Http\Controllers\Pendaftaran;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pasien::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_pasien', 'like', "%{$search}%")
                  ->orWhere('no_rekam_medis', 'like', "%{$search}%")
                  ->orWhere('no_ktp', 'like', "%{$search}%");
            });
        }

        $pasiens = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('pendaftaran.pasien.index', compact('pasiens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pendaftaran.pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_rekam_medis' => 'required|unique:pasiens,no_rekam_medis',
            'nama_pasien' => 'required|string|max:255',
            'no_ktp' => 'required|string|size:16|unique:pasiens,no_ktp',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
        ]);

        Pasien::create($validated);

        return redirect()->route('pendaftaran.pasien.index')
            ->with('success', 'Data pasien berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pasien $pasien)
    {
        $kunjungans = $pasien->kunjungans()->orderBy('tgl_kunjungan', 'desc')->get();
        return view('pendaftaran.pasien.show', compact('pasien', 'kunjungans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pasien $pasien)
    {
        return view('pendaftaran.pasien.edit', compact('pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasien $pasien)
    {
        $validated = $request->validate([
            'no_rekam_medis' => 'required|unique:pasiens,no_rekam_medis,' . $pasien->id,
            'nama_pasien' => 'required|string|max:255',
            'no_ktp' => 'required|string|size:16|unique:pasiens,no_ktp,' . $pasien->id,
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
        ]);

        $pasien->update($validated);

        return redirect()->route('pendaftaran.pasien.index')
            ->with('success', 'Data pasien berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return redirect()->route('pendaftaran.pasien.index')
            ->with('success', 'Data pasien berhasil dihapus');
    }
}
