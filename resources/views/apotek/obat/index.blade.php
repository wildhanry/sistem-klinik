@extends('layouts.app')

@section('page-title', 'Data Obat')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div class="flex-1">
            <form action="{{ route('apotek.obat.index') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama obat..." class="flex-1 px-4 py-2 bg-gray-800 border border-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <button type="submit" class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg">
                    Cari
                </button>
            </form>
        </div>
        <a href="{{ route('apotek.obat.create') }}" class="ml-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium">
            + Tambah Obat
        </a>
    </div>

    <!-- Obat Table -->
    <div class="bg-gray-800 rounded-lg border border-gray-700">
        <div class="p-6">
            @if($obats->isEmpty())
                <p class="text-center text-gray-400 py-8">Tidak ada data obat</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                <th class="pb-3">Nama Obat</th>
                                <th class="pb-3">Satuan</th>
                                <th class="pb-3">Stok</th>
                                <th class="pb-3">Harga Jual</th>
                                <th class="pb-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-300">
                            @foreach($obats as $obat)
                                <tr class="border-t border-gray-700">
                                    <td class="py-4 font-medium text-white">{{ $obat->nama_obat }}</td>
                                    <td class="py-4">{{ $obat->satuan }}</td>
                                    <td class="py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium 
                                            {{ $obat->stok > 10 ? 'bg-green-900 text-green-200' : ($obat->stok > 0 ? 'bg-yellow-900 text-yellow-200' : 'bg-red-900 text-red-200') }}">
                                            {{ $obat->stok }}
                                        </span>
                                    </td>
                                    <td class="py-4">Rp {{ number_format($obat->harga_jual, 0, ',', '.') }}</td>
                                    <td class="py-4">
                                        <div class="flex gap-2">
                                            <a href="{{ route('apotek.obat.edit', $obat) }}" class="text-yellow-400 hover:text-yellow-300">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('apotek.obat.destroy', $obat) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus obat ini?')">
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
                    {{ $obats->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
