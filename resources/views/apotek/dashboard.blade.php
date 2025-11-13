@extends('layouts.app')

@section('page-title', 'Antrean Resep')

@section('content')
<div class="space-y-6">
    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-900 bg-opacity-50">
                    <svg class="h-8 w-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Resep Menunggu</p>
                    <p class="text-2xl font-semibold text-white">{{ $reseps->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-900 bg-opacity-50">
                    <svg class="h-8 w-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Apotek</p>
                    <p class="text-lg font-semibold text-white">{{ auth()->user()->name }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Prescription Queue -->
    <div class="bg-gray-800 rounded-lg border border-gray-700">
        <div class="px-6 py-4 border-b border-gray-700">
            <h3 class="text-lg font-semibold text-white">Daftar Resep</h3>
        </div>
        <div class="p-6">
            @if($reseps->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="mt-4 text-gray-400">Tidak ada resep dalam antrean</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($reseps as $index => $resep)
                        <div class="flex items-center justify-between p-4 bg-gray-700 rounded-lg hover:bg-gray-650 transition">
                            <div class="flex items-center space-x-4 flex-1">
                                <div class="flex-shrink-0 w-12 h-12 bg-purple-900 bg-opacity-50 rounded-full flex items-center justify-center">
                                    <span class="text-xl font-bold text-purple-400">{{ $index + 1 }}</span>
                                </div>
                                <div class="flex-1">
                                    <p class="text-lg font-semibold text-white">{{ $resep->kunjungan->pasien->nama_pasien }}</p>
                                    <p class="text-sm text-gray-400">
                                        No. RM: {{ $resep->kunjungan->pasien->no_rekam_medis }} | 
                                        Dokter: {{ $resep->dokter->name }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $resep->resepDetails->count() }} item obat | 
                                        {{ $resep->created_at->format('H:i, d/m/Y') }}
                                    </p>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('apotek.resep.show', $resep) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg text-sm font-medium">
                                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat & Proses
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
