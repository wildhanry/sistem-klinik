<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::with('pasien')
            ->where('status_kunjungan', 'Antri')
            ->orderBy('tgl_kunjungan', 'asc')
            ->get();

        return view('dokter.dashboard', compact('kunjungans'));
    }
}
