<?php

namespace App\Http\Controllers\Apotek;

use App\Http\Controllers\Controller;
use App\Models\Resep;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $reseps = Resep::with(['kunjungan.pasien', 'dokter', 'resepDetails.obat'])
            ->where('status_resep', 'Baru')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('apotek.dashboard', compact('reseps'));
    }
}
