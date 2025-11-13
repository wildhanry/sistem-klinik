@extends('layouts.app')

@section('page-title', 'Dashboard Pimpinan')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-900 bg-opacity-50">
                    <svg class="h-8 w-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Total Pasien</p>
                    <p class="text-2xl font-semibold text-white">{{ $totalPasien }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-900 bg-opacity-50">
                    <svg class="h-8 w-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Total Kunjungan</p>
                    <p class="text-2xl font-semibold text-white">{{ $totalKunjungan }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-900 bg-opacity-50">
                    <svg class="h-8 w-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Kunjungan Hari Ini</p>
                    <p class="text-2xl font-semibold text-white">{{ $kunjunganHariIni }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-900 bg-opacity-50">
                    <svg class="h-8 w-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Kunjungan Bulan Ini</p>
                    <p class="text-2xl font-semibold text-white">{{ $kunjunganBulanIni }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top 10 Most Prescribed Medicines -->
        <div class="bg-gray-800 rounded-lg border border-gray-700">
            <div class="px-6 py-4 border-b border-gray-700">
                <h3 class="text-lg font-semibold text-white">10 Obat Paling Banyak Diresepkan</h3>
            </div>
            <div class="p-6">
                @if($topObat->isEmpty())
                    <p class="text-center text-gray-400 py-8">Belum ada data resep</p>
                @else
                    <div class="space-y-3">
                        @foreach($topObat as $index => $item)
                            <div class="flex items-center justify-between p-3 bg-gray-700 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <span class="flex-shrink-0 w-8 h-8 bg-blue-900 bg-opacity-50 rounded-full flex items-center justify-center text-sm font-bold text-blue-400">
                                        {{ $index + 1 }}
                                    </span>
                                    <div>
                                        <p class="text-white font-medium">{{ $item->obat->nama_obat }}</p>
                                        <p class="text-xs text-gray-400">{{ $item->obat->satuan }}</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 bg-green-900 text-green-200 rounded-full text-sm font-medium">
                                    {{ $item->total_prescribed }} {{ $item->obat->satuan }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Visits -->
        <div class="bg-gray-800 rounded-lg border border-gray-700">
            <div class="px-6 py-4 border-b border-gray-700">
                <h3 class="text-lg font-semibold text-white">Kunjungan Terakhir</h3>
            </div>
            <div class="p-6">
                @if($recentKunjungans->isEmpty())
                    <p class="text-center text-gray-400 py-8">Belum ada kunjungan</p>
                @else
                    <div class="space-y-3">
                        @foreach($recentKunjungans as $kunjungan)
                            <div class="flex items-center justify-between p-3 bg-gray-700 rounded-lg">
                                <div class="flex-1">
                                    <p class="text-white font-medium">{{ $kunjungan->pasien->nama_pasien }}</p>
                                    <p class="text-xs text-gray-400">{{ $kunjungan->pasien->no_rekam_medis }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-300">{{ $kunjungan->tgl_kunjungan->format('d/m/Y') }}</p>
                                    <span class="px-2 py-1 rounded-full text-xs font-medium
                                        @if($kunjungan->status_kunjungan == 'Antri') bg-yellow-900 text-yellow-200
                                        @elseif($kunjungan->status_kunjungan == 'Diperiksa') bg-blue-900 text-blue-200
                                        @elseif($kunjungan->status_kunjungan == 'Tunggu Obat') bg-purple-900 text-purple-200
                                        @else bg-green-900 text-green-200
                                        @endif">
                                        {{ $kunjungan->status_kunjungan }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Monthly Statistics Chart -->
    <div class="bg-gray-800 rounded-lg border border-gray-700">
        <div class="px-6 py-4 border-b border-gray-700">
            <h3 class="text-lg font-semibold text-white">Statistik Kunjungan (6 Bulan Terakhir)</h3>
        </div>
        <div class="p-6">
            @if($monthlyStats->isEmpty())
                <p class="text-center text-gray-400 py-8">Belum ada data statistik</p>
            @else
                <div class="space-y-3">
                    @foreach($monthlyStats as $stat)
                        @php
                            $maxValue = $monthlyStats->max('total');
                            $percentage = $maxValue > 0 ? ($stat->total / $maxValue) * 100 : 0;
                        @endphp
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-300">{{ \Carbon\Carbon::parse($stat->month . '-01')->format('F Y') }}</span>
                                <span class="text-white font-medium">{{ $stat->total }} kunjungan</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full transition-all" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
