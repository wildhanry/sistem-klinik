@extends('layouts.app')

@section('page-title', 'Edit Data Obat')

@section('content')
<div class="max-w-3xl">
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <form action="{{ route('apotek.obat.update', $obat) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label for="nama_obat" class="block text-sm font-medium text-gray-300 mb-2">Nama Obat</label>
                    <input type="text" name="nama_obat" id="nama_obat" value="{{ old('nama_obat', $obat->nama_obat) }}" required
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_obat') border-red-500 @enderror">
                    @error('nama_obat')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="satuan" class="block text-sm font-medium text-gray-300 mb-2">Satuan</label>
                        <input type="text" name="satuan" id="satuan" value="{{ old('satuan', $obat->satuan) }}" required
                            class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('satuan') border-red-500 @enderror">
                        @error('satuan')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stok" class="block text-sm font-medium text-gray-300 mb-2">Stok</label>
                        <input type="number" name="stok" id="stok" value="{{ old('stok', $obat->stok) }}" min="0" required
                            class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('stok') border-red-500 @enderror">
                        @error('stok')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="harga_jual" class="block text-sm font-medium text-gray-300 mb-2">Harga Jual (Rp)</label>
                    <input type="number" name="harga_jual" id="harga_jual" value="{{ old('harga_jual', $obat->harga_jual) }}" min="0" required
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('harga_jual') border-red-500 @enderror">
                    @error('harga_jual')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                    Update
                </button>
                <a href="{{ route('apotek.obat.index') }}" class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
