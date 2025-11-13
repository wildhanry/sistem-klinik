@extends('layouts.app')

@section('page-title', 'Detail Resep')

@section('content')
<div class="space-y-6">
    <!-- Patient & Doctor Info -->
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Informasi Resep</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
            <div>
                <p class="text-gray-400">Pasien</p>
                <p class="text-white font-medium">{{ $resep->kunjungan->pasien->nama_pasien }}</p>
            </div>
            <div>
                <p class="text-gray-400">No. Rekam Medis</p>
                <p class="text-white font-medium">{{ $resep->kunjungan->pasien->no_rekam_medis }}</p>
            </div>
            <div>
                <p class="text-gray-400">Dokter</p>
                <p class="text-white font-medium">{{ $resep->dokter->name }}</p>
            </div>
            <div>
                <p class="text-gray-400">Tanggal Resep</p>
                <p class="text-white font-medium">{{ $resep->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>

    <!-- Prescription Details -->
    <div class="bg-gray-800 rounded-lg border border-gray-700">
        <div class="px-6 py-4 border-b border-gray-700">
            <h3 class="text-lg font-semibold text-white">Daftar Obat</h3>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            <th class="pb-3">No</th>
                            <th class="pb-3">Nama Obat</th>
                            <th class="pb-3">Jumlah</th>
                            <th class="pb-3">Satuan</th>
                            <th class="pb-3">Aturan Pakai</th>
                            <th class="pb-3">Stok Tersedia</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-300">
                        @foreach($resep->resepDetails as $index => $detail)
                            <tr class="border-t border-gray-700">
                                <td class="py-4">{{ $index + 1 }}</td>
                                <td class="py-4 font-medium text-white">{{ $detail->obat->nama_obat }}</td>
                                <td class="py-4">{{ $detail->jumlah_obat }}</td>
                                <td class="py-4">{{ $detail->obat->satuan }}</td>
                                <td class="py-4">{{ $detail->aturan_pakai }}</td>
                                <td class="py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium 
                                        {{ $detail->obat->stok >= $detail->jumlah_obat ? 'bg-green-900 text-green-200' : 'bg-red-900 text-red-200' }}">
                                        {{ $detail->obat->stok }} {{ $detail->obat->satuan }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <div class="flex items-center justify-between">
            <div>
                <h4 class="text-md font-semibold text-white mb-2">Proses Resep</h4>
                <p class="text-sm text-gray-400">Pastikan stok semua obat mencukupi sebelum memproses resep. Stok akan otomatis dikurangi setelah diproses.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('apotek.dashboard') }}" class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium">
                    Kembali
                </a>
                <form action="{{ route('apotek.resep.proses', $resep) }}" method="POST" onsubmit="return confirm('Yakin ingin memproses resep ini? Stok obat akan dikurangi.')">
                    @csrf
                    <button type="submit" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium">
                        ✓ Proses & Serahkan Obat
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
