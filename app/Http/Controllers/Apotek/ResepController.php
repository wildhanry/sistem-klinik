<?php

namespace App\Http\Controllers\Apotek;

use App\Http\Controllers\Controller;
use App\Models\Resep;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResepController extends Controller
{
    public function show(Resep $resep)
    {
        $resep->load(['kunjungan.pasien', 'dokter', 'resepDetails.obat']);
        return view('apotek.resep-show', compact('resep'));
    }

    public function proses(Resep $resep)
    {
        DB::beginTransaction();
        
        try {
            // Kurangi stok obat berdasarkan resep detail
            foreach ($resep->resepDetails as $detail) {
                $obat = Obat::find($detail->obat_id);
                
                // Cek stok
                if ($obat->stok < $detail->jumlah_obat) {
                    DB::rollBack();
                    return back()->with('error', "Stok obat {$obat->nama_obat} tidak mencukupi. Stok tersedia: {$obat->stok}");
                }
                
                // Kurangi stok
                $obat->decrement('stok', $detail->jumlah_obat);
            }

            // Update status resep
            $resep->update(['status_resep' => 'Selesai Diberikan']);

            // Update status kunjungan menjadi Selesai
            $resep->kunjungan->update(['status_kunjungan' => 'Selesai']);

            DB::commit();

            return redirect()->route('apotek.dashboard')
                ->with('success', 'Resep berhasil diproses dan obat telah diberikan');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
