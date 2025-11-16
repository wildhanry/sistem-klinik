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
            <h2 class="text-2xl font-bold text-white mt-2">Reset Password</h2>
        </div>

        <!-- User Info -->
        <div class="bg-gray-800 rounded-lg shadow p-6 mb-6">
            <div class="flex items-center gap-4">
                <div class="h-16 w-16 bg-blue-600 rounded-full flex items-center justify-center">
                    <span class="text-white text-2xl font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">{{ $user->name }}</h3>
                    <p class="text-gray-400">{{ $user->email }}</p>
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full mt-2
                        @if($user->role == 'pendaftaran') bg-blue-900 text-blue-200
                        @elseif($user->role == 'dokter') bg-green-900 text-green-200
                        @elseif($user->role == 'apotek') bg-purple-900 text-purple-200
                        @else bg-yellow-900 text-yellow-200
                        @endif">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-gray-800 rounded-lg shadow p-6">
            <form action="{{ route('pimpinan.user.update-password', $user) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="bg-yellow-900 border border-yellow-700 text-yellow-200 px-4 py-3 rounded-lg mb-6">
                    <p class="text-sm">⚠️ <strong>Perhatian:</strong> Password user akan diubah. Pastikan untuk memberitahu user mengenai password baru mereka.</p>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password Baru</label>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           required
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Konfirmasi Password Baru</label>
                    <input type="password" 
                           name="password_confirmation" 
                           id="password_confirmation" 
                           required
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Buttons -->
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                        Reset Password
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
