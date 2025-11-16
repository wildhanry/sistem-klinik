@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('pimpinan.user.index') }}" class="text-blue-400 hover:text-blue-300 mb-4 inline-flex items-center gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali
            </a>
            <h2 class="text-2xl font-bold text-white mt-2">Edit User</h2>
        </div>

        <!-- Form -->
        <div class="bg-gray-800 rounded-lg shadow p-6">
            <form action="{{ route('pimpinan.user.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $user->name) }}"
                           required
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email', $user->email) }}"
                           required
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div class="mb-6">
                    <label for="role" class="block text-sm font-medium text-gray-300 mb-2">Role</label>
                    <select name="role" 
                            id="role" 
                            required
                            class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('role') border-red-500 @enderror">
                        <option value="">-- Pilih Role --</option>
                        <option value="pendaftaran" {{ old('role', $user->role) == 'pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                        <option value="dokter" {{ old('role', $user->role) == 'dokter' ? 'selected' : '' }}>Dokter</option>
                        <option value="apotek" {{ old('role', $user->role) == 'apotek' ? 'selected' : '' }}>Apotek</option>
                        <option value="pimpinan" {{ old('role', $user->role) == 'pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-yellow-900 border border-yellow-700 text-yellow-200 px-4 py-3 rounded-lg mb-6">
                    <p class="text-sm">💡 <strong>Catatan:</strong> Untuk mengubah password, gunakan menu "Reset Password"</p>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                        Update
                    </button>
                    <a href="{{ route('pimpinan.user.index') }}" 
                       class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
