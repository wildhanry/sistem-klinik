@extends('layouts.app')

@section('page-title', 'Form Pemeriksaan')

@section('content')
<div class="space-y-6">
    <!-- Patient Info -->
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Informasi Pasien</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
            <div>
                <p class="text-gray-400">No. Rekam Medis</p>
                <p class="text-white font-medium">{{ $kunjungan->pasien->no_rekam_medis }}</p>
            </div>
            <div>
                <p class="text-gray-400">Nama Pasien</p>
                <p class="text-white font-medium">{{ $kunjungan->pasien->nama_pasien }}</p>
            </div>
            <div>
                <p class="text-gray-400">Usia</p>
                <p class="text-white font-medium">{{ \Carbon\Carbon::parse($kunjungan->pasien->tgl_lahir)->age }} tahun</p>
            </div>
            <div>
                <p class="text-gray-400">No. HP</p>
                <p class="text-white font-medium">{{ $kunjungan->pasien->no_hp }}</p>
            </div>
        </div>
    </div>

    <!-- Examination Form -->
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <h3 class="text-lg font-semibold text-white mb-6">Form Pemeriksaan</h3>
        
        <form action="{{ route('dokter.pemeriksaan.store', $kunjungan) }}" method="POST" id="examForm">
            @csrf

            <div class="space-y-6">
                <!-- Anamnesis -->
                <div>
                    <label for="anamnesis" class="block text-sm font-medium text-gray-300 mb-2">
                        Anamnesis / Keluhan <span class="text-red-400">*</span>
                    </label>
                    <textarea name="anamnesis" id="anamnesis" rows="4" required
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('anamnesis') border-red-500 @enderror">{{ old('anamnesis') }}</textarea>
                    @error('anamnesis')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Diagnosis -->
                <div>
                    <label for="diagnosis" class="block text-sm font-medium text-gray-300 mb-2">
                        Diagnosis <span class="text-red-400">*</span>
                    </label>
                    <textarea name="diagnosis" id="diagnosis" rows="3" required
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('diagnosis') border-red-500 @enderror">{{ old('diagnosis') }}</textarea>
                    @error('diagnosis')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tindakan Medis -->
                <div>
                    <label for="tindakan_medis" class="block text-sm font-medium text-gray-300 mb-2">
                        Tindakan Medis <span class="text-gray-500 text-xs">(Opsional)</span>
                    </label>
                    <textarea name="tindakan_medis" id="tindakan_medis" rows="3"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('tindakan_medis') }}</textarea>
                </div>

                <!-- Resep Obat -->
                <div class="border-t border-gray-700 pt-6">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-md font-semibold text-white">Resep Obat</h4>
                        <button type="button" onclick="addObat()" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium">
                            + Tambah Obat
                        </button>
                    </div>

                    <div id="obatContainer" class="space-y-3">
                        <!-- Obat items will be added here dynamically -->
                    </div>
                </div>
            </div>

            <div class="flex gap-3 mt-8">
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                    Simpan Pemeriksaan
                </button>
                <a href="{{ route('dokter.dashboard') }}" class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
let obatIndex = 0;

function addObat() {
    const container = document.getElementById('obatContainer');
    const obatHtml = `
        <div class="bg-gray-700 p-4 rounded-lg relative" id="obat-${obatIndex}">
            <button type="button" onclick="removeObat(${obatIndex})" class="absolute top-2 right-2 text-red-400 hover:text-red-300">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Nama Obat</label>
                    <select name="obat[${obatIndex}][obat_id]" required class="w-full px-3 py-2 bg-gray-600 border border-gray-500 text-white rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Obat --</option>
                        @foreach($obats as $obat)
                            <option value="{{ $obat->id }}">{{ $obat->nama_obat }} (Stok: {{ $obat->stok }} {{ $obat->satuan }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Jumlah</label>
                    <input type="number" name="obat[${obatIndex}][jumlah_obat]" min="1" required class="w-full px-3 py-2 bg-gray-600 border border-gray-500 text-white rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Aturan Pakai</label>
                    <input type="text" name="obat[${obatIndex}][aturan_pakai]" placeholder="Contoh: 3x1 sehari" required class="w-full px-3 py-2 bg-gray-600 border border-gray-500 text-white rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', obatHtml);
    obatIndex++;
}

function removeObat(index) {
    const element = document.getElementById(`obat-${index}`);
    if (element) {
        element.remove();
    }
}
</script>
@endpush
@endsection
