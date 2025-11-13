@extends('layouts.app')

@section('page-title', 'Edit Data Pasien')

@section('content')
<div class="max-w-3xl">
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <form action="{{ route('pendaftaran.pasien.update', $pasien) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label for="no_rekam_medis" class="block text-sm font-medium text-gray-300 mb-2">No. Rekam Medis</label>
                    <input type="text" name="no_rekam_medis" id="no_rekam_medis" value="{{ old('no_rekam_medis', $pasien->no_rekam_medis) }}" required
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('no_rekam_medis') border-red-500 @enderror">
                    @error('no_rekam_medis')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nama_pasien" class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap Pasien</label>
                    <input type="text" name="nama_pasien" id="nama_pasien" value="{{ old('nama_pasien', $pasien->nama_pasien) }}" required
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_pasien') border-red-500 @enderror">
                    @error('nama_pasien')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="no_ktp" class="block text-sm font-medium text-gray-300 mb-2">No. KTP (16 digit)</label>
                    <input type="text" name="no_ktp" id="no_ktp" value="{{ old('no_ktp', $pasien->no_ktp) }}" maxlength="16" required
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('no_ktp') border-red-500 @enderror">
                    @error('no_ktp')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tgl_lahir" class="block text-sm font-medium text-gray-300 mb-2">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir', $pasien->tgl_lahir->format('Y-m-d')) }}" required
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tgl_lahir') border-red-500 @enderror">
                    @error('tgl_lahir')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-300 mb-2">Alamat Lengkap</label>
                    <textarea name="alamat" id="alamat" rows="3" required
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('alamat') border-red-500 @enderror">{{ old('alamat', $pasien->alamat) }}</textarea>
                    @error('alamat')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-300 mb-2">No. HP</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $pasien->no_hp) }}" required
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('no_hp') border-red-500 @enderror">
                    @error('no_hp')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                    Update
                </button>
                <a href="{{ route('pendaftaran.pasien.index') }}" class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
