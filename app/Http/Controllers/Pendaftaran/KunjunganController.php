<?php

namespace App\Http\Controllers\Pendaftaran;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use App\Models\Pasien;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function create()
    {
        $pasiens = Pasien::orderBy('nama_pasien')->get();
        return view('pendaftaran.kunjungan.create', compact('pasiens'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
        ]);

        Kunjungan::create([
            'pasien_id' => $validated['pasien_id'],
            'status_kunjungan' => 'Antri',
        ]);

        return redirect()->route('pendaftaran.dashboard')
            ->with('success', 'Kunjungan pasien berhasil didaftarkan');
    }
}
