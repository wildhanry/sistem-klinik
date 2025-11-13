@extends('layouts.app')

@section('page-title', 'Daftar Kunjungan Baru')

@section('content')
<div class="max-w-3xl">
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <form action="{{ route('pendaftaran.kunjungan.store') }}" method="POST">
            @csrf

            <div class="space-y-4">
                <div>
                    <label for="pasien_id" class="block text-sm font-medium text-gray-300 mb-2">Pilih Pasien</label>
                    <select name="pasien_id" id="pasien_id" required
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('pasien_id') border-red-500 @enderror">
                        <option value="">-- Pilih Pasien --</option>
                        @foreach($pasiens as $pasien)
                            <option value="{{ $pasien->id }}" {{ old('pasien_id') == $pasien->id ? 'selected' : '' }}>
                                {{ $pasien->no_rekam_medis }} - {{ $pasien->nama_pasien }}
                            </option>
                        @endforeach
                    </select>
                    @error('pasien_id')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-blue-900 bg-opacity-30 border border-blue-700 rounded-lg p-4">
                    <p class="text-blue-300 text-sm">
                        <svg class="inline h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Pasien yang didaftarkan akan masuk ke antrean untuk diperiksa oleh dokter.
                    </p>
                </div>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                    Daftarkan Kunjungan
                </button>
                <a href="{{ route('pendaftaran.dashboard') }}" class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <div class="mt-4 text-sm text-gray-400">
        <p>Tidak menemukan pasien? <a href="{{ route('pendaftaran.pasien.create') }}" class="text-blue-400 hover:text-blue-300">Tambah Pasien Baru</a></p>
    </div>
</div>
@endsection
