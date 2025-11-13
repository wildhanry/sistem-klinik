<?php

namespace App\Http\Controllers\Pendaftaran;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::with('pasien')
            ->whereDate('tgl_kunjungan', today())
            ->orderBy('tgl_kunjungan', 'desc')
            ->get();

        return view('pendaftaran.dashboard', compact('kunjungans'));
    }
}
