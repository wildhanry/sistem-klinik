@extends('layouts.app')

@section('page-title', 'Antrean Pasien')

@section('content')
<div class="space-y-6">
    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-900 bg-opacity-50">
                    <svg class="h-8 w-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Pasien Menunggu</p>
                    <p class="text-2xl font-semibold text-white">{{ $kunjungans->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-900 bg-opacity-50">
                    <svg class="h-8 w-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Dokter</p>
                    <p class="text-lg font-semibold text-white">{{ auth()->user()->name }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Queue List -->
    <div class="bg-gray-800 rounded-lg border border-gray-700">
        <div class="px-6 py-4 border-b border-gray-700">
            <h3 class="text-lg font-semibold text-white">Daftar Antrean</h3>
        </div>
        <div class="p-6">
            @if($kunjungans->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="mt-4 text-gray-400">Tidak ada pasien dalam antrean</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($kunjungans as $index => $kunjungan)
                        <div class="flex items-center justify-between p-4 bg-gray-700 rounded-lg hover:bg-gray-650 transition">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-blue-900 bg-opacity-50 rounded-full flex items-center justify-center">
                                    <span class="text-xl font-bold text-blue-400">{{ $index + 1 }}</span>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold text-white">{{ $kunjungan->pasien->nama_pasien }}</p>
                                    <p class="text-sm text-gray-400">
                                        No. RM: {{ $kunjungan->pasien->no_rekam_medis }} | 
                                        Terdaftar: {{ $kunjungan->tgl_kunjungan->format('H:i') }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Usia: {{ \Carbon\Carbon::parse($kunjungan->pasien->tgl_lahir)->age }} tahun | 
                                        HP: {{ $kunjungan->pasien->no_hp }}
                                    </p>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('dokter.pemeriksaan.create', $kunjungan) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium">
                                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                    </svg>
                                    Periksa
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
