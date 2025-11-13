@extends('layouts.app')

@section('page-title', 'Detail Pasien')

@section('content')
<div class="space-y-6">
    <!-- Patient Info -->
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Informasi Pasien</h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-gray-400">No. Rekam Medis</p>
                <p class="text-white font-medium">{{ $pasien->no_rekam_medis }}</p>
            </div>
            <div>
                <p class="text-gray-400">Nama Pasien</p>
                <p class="text-white font-medium">{{ $pasien->nama_pasien }}</p>
            </div>
            <div>
                <p class="text-gray-400">No. KTP</p>
                <p class="text-white font-medium">{{ $pasien->no_ktp }}</p>
            </div>
            <div>
                <p class="text-gray-400">Tanggal Lahir</p>
                <p class="text-white font-medium">{{ $pasien->tgl_lahir->format('d/m/Y') }} ({{ $pasien->tgl_lahir->age }} tahun)</p>
            </div>
            <div>
                <p class="text-gray-400">Alamat</p>
                <p class="text-white font-medium">{{ $pasien->alamat }}</p>
            </div>
            <div>
                <p class="text-gray-400">No. HP</p>
                <p class="text-white font-medium">{{ $pasien->no_hp }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('pendaftaran.pasien.edit', $pasien) }}" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg text-sm font-medium">
                Edit Data
            </a>
            <a href="{{ route('pendaftaran.pasien.index') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg text-sm font-medium ml-2">
                Kembali
            </a>
        </div>
    </div>

    <!-- Visit History -->
    <div class="bg-gray-800 rounded-lg border border-gray-700">
        <div class="px-6 py-4 border-b border-gray-700">
            <h3 class="text-lg font-semibold text-white">Riwayat Kunjungan</h3>
        </div>
        <div class="p-6">
            @if($kunjungans->isEmpty())
                <p class="text-center text-gray-400 py-8">Belum ada riwayat kunjungan</p>
            @else
                <div class="space-y-3">
                    @foreach($kunjungans as $kunjungan)
                        <div class="flex justify-between items-center p-4 bg-gray-700 rounded-lg">
                            <div>
                                <p class="text-white font-medium">{{ $kunjungan->tgl_kunjungan->format('d/m/Y H:i') }}</p>
                                <p class="text-sm text-gray-400">Kunjungan</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($kunjungan->status_kunjungan == 'Antri') bg-yellow-900 text-yellow-200
                                @elseif($kunjungan->status_kunjungan == 'Diperiksa') bg-blue-900 text-blue-200
                                @elseif($kunjungan->status_kunjungan == 'Tunggu Obat') bg-purple-900 text-purple-200
                                @else bg-green-900 text-green-200
                                @endif">
                                {{ $kunjungan->status_kunjungan }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
