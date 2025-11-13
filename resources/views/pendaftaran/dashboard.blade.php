@extends('layouts.app')

@section('page-title', 'Dashboard Pendaftaran')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-900 bg-opacity-50">
                    <svg class="h-8 w-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Total Kunjungan Hari Ini</p>
                    <p class="text-2xl font-semibold text-white">{{ $kunjungans->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-900 bg-opacity-50">
                    <svg class="h-8 w-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Antri</p>
                    <p class="text-2xl font-semibold text-white">{{ $kunjungans->where('status_kunjungan', 'Antri')->count() }}</p>
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
                    <p class="text-sm font-medium text-gray-400">Selesai</p>
                    <p class="text-2xl font-semibold text-white">{{ $kunjungans->where('status_kunjungan', 'Selesai')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Kunjungan List -->
    <div class="bg-gray-800 rounded-lg border border-gray-700">
        <div class="px-6 py-4 border-b border-gray-700 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-white">Antrean Kunjungan Hari Ini</h3>
            <a href="{{ route('pendaftaran.kunjungan.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium">
                + Daftar Kunjungan Baru
            </a>
        </div>
        <div class="p-6">
            @if($kunjungans->isEmpty())
                <p class="text-center text-gray-400 py-8">Belum ada kunjungan hari ini</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                <th class="pb-3">No. Antrean</th>
                                <th class="pb-3">No. Rekam Medis</th>
                                <th class="pb-3">Nama Pasien</th>
                                <th class="pb-3">Waktu Daftar</th>
                                <th class="pb-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-300">
                            @foreach($kunjungans as $index => $kunjungan)
                                <tr class="border-t border-gray-700">
                                    <td class="py-4">{{ $index + 1 }}</td>
                                    <td class="py-4">{{ $kunjungan->pasien->no_rekam_medis }}</td>
                                    <td class="py-4 font-medium text-white">{{ $kunjungan->pasien->nama_pasien }}</td>
                                    <td class="py-4">{{ $kunjungan->tgl_kunjungan->format('H:i') }}</td>
                                    <td class="py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium
                                            @if($kunjungan->status_kunjungan == 'Antri') bg-yellow-900 text-yellow-200
                                            @elseif($kunjungan->status_kunjungan == 'Diperiksa') bg-blue-900 text-blue-200
                                            @elseif($kunjungan->status_kunjungan == 'Tunggu Obat') bg-purple-900 text-purple-200
                                            @else bg-green-900 text-green-200
                                            @endif">
                                            {{ $kunjungan->status_kunjungan }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
