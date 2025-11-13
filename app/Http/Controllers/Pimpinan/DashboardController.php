<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Obat;
use App\Models\ResepDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $totalKunjungan = Kunjungan::count();
        $totalPasien = Pasien::count();
        $kunjunganHariIni = Kunjungan::whereDate('tgl_kunjungan', today())->count();
        $kunjunganBulanIni = Kunjungan::whereMonth('tgl_kunjungan', now()->month)
            ->whereYear('tgl_kunjungan', now()->year)
            ->count();

        // Top 10 Most Prescribed Medicines
        $topObat = ResepDetail::select('obat_id', DB::raw('SUM(jumlah_obat) as total_prescribed'))
            ->with('obat')
            ->groupBy('obat_id')
            ->orderBy('total_prescribed', 'desc')
            ->limit(10)
            ->get();

        // Recent Visits
        $recentKunjungans = Kunjungan::with('pasien')
            ->orderBy('tgl_kunjungan', 'desc')
            ->limit(10)
            ->get();

        // Monthly Visit Statistics (last 6 months)
        $monthlyStats = Kunjungan::select(
                DB::raw('DATE_FORMAT(tgl_kunjungan, "%Y-%m") as month'),
                DB::raw('COUNT(*) as total')
            )
            ->where('tgl_kunjungan', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('pimpinan.dashboard', compact(
            'totalKunjungan',
            'totalPasien',
            'kunjunganHariIni',
            'kunjunganBulanIni',
            'topObat',
            'recentKunjungans',
            'monthlyStats'
        ));
    }
}
