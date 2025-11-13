@extends('layouts.app')

@section('page-title', 'Data Pasien')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div class="flex-1">
            <form action="{{ route('pendaftaran.pasien.index') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pasien (Nama, No. RM, No. KTP)..." class="flex-1 px-4 py-2 bg-gray-800 border border-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <button type="submit" class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg">
                    Cari
                </button>
            </form>
        </div>
        <a href="{{ route('pendaftaran.pasien.create') }}" class="ml-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium">
            + Tambah Pasien
        </a>
    </div>

    <!-- Pasien Table -->
    <div class="bg-gray-800 rounded-lg border border-gray-700">
        <div class="p-6">
            @if($pasiens->isEmpty())
                <p class="text-center text-gray-400 py-8">Tidak ada data pasien</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                <th class="pb-3">No. Rekam Medis</th>
                                <th class="pb-3">Nama Pasien</th>
                                <th class="pb-3">No. KTP</th>
                                <th class="pb-3">Tgl Lahir</th>
                                <th class="pb-3">No. HP</th>
                                <th class="pb-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-300">
                            @foreach($pasiens as $pasien)
                                <tr class="border-t border-gray-700">
                                    <td class="py-4 font-mono">{{ $pasien->no_rekam_medis }}</td>
                                    <td class="py-4 font-medium text-white">{{ $pasien->nama_pasien }}</td>
                                    <td class="py-4">{{ $pasien->no_ktp }}</td>
                                    <td class="py-4">{{ \Carbon\Carbon::parse($pasien->tgl_lahir)->format('d/m/Y') }}</td>
                                    <td class="py-4">{{ $pasien->no_hp }}</td>
                                    <td class="py-4">
                                        <div class="flex gap-2">
                                            <a href="{{ route('pendaftaran.pasien.show', $pasien) }}" class="text-blue-400 hover:text-blue-300">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('pendaftaran.pasien.edit', $pasien) }}" class="text-yellow-400 hover:text-yellow-300">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('pendaftaran.pasien.destroy', $pasien) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data pasien ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $pasiens->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
