<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use App\Models\RekamMedis;
use App\Models\Resep;
use App\Models\ResepDetail;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PemeriksaanController extends Controller
{
    public function create(Kunjungan $kunjungan)
    {
        $kunjungan->load('pasien');
        $obats = Obat::where('stok', '>', 0)->orderBy('nama_obat')->get();
        
        return view('dokter.pemeriksaan', compact('kunjungan', 'obats'));
    }

    public function store(Request $request, Kunjungan $kunjungan)
    {
        $validated = $request->validate([
            'anamnesis' => 'required|string',
            'diagnosis' => 'required|string',
            'tindakan_medis' => 'nullable|string',
            'obat' => 'nullable|array',
            'obat.*.obat_id' => 'required|exists:obats,id',
            'obat.*.jumlah_obat' => 'required|integer|min:1',
            'obat.*.aturan_pakai' => 'required|string',
        ]);

        DB::beginTransaction();
        
        try {
            // Update status kunjungan
            $kunjungan->update(['status_kunjungan' => 'Diperiksa']);

            // Simpan Rekam Medis
            RekamMedis::create([
                'kunjungan_id' => $kunjungan->id,
                'dokter_id' => Auth::id(),
                'anamnesis' => $validated['anamnesis'],
                'diagnosis' => $validated['diagnosis'],
                'tindakan_medis' => $validated['tindakan_medis'] ?? null,
            ]);

            // Jika ada resep obat
            if (!empty($validated['obat'])) {
                // Buat resep
                $resep = Resep::create([
                    'kunjungan_id' => $kunjungan->id,
                    'dokter_id' => Auth::id(),
                    'status_resep' => 'Baru',
                ]);

                // Simpan detail resep
                foreach ($validated['obat'] as $obatData) {
                    ResepDetail::create([
                        'resep_id' => $resep->id,
                        'obat_id' => $obatData['obat_id'],
                        'jumlah_obat' => $obatData['jumlah_obat'],
                        'aturan_pakai' => $obatData['aturan_pakai'],
                    ]);
                }

                // Update status kunjungan ke Tunggu Obat
                $kunjungan->update(['status_kunjungan' => 'Tunggu Obat']);
            } else {
                // Jika tidak ada resep, langsung selesai
                $kunjungan->update(['status_kunjungan' => 'Selesai']);
            }

            DB::commit();

            return redirect()->route('dokter.dashboard')
                ->with('success', 'Pemeriksaan berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
}
