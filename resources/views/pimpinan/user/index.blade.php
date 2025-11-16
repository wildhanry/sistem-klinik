@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-white">Manajemen User</h2>
            <a href="{{ route('pimpinan.user.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah User
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-900 border border-red-700 text-red-200 px-4 py-3 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Users Table -->
        <div class="bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-900">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Dibuat</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @forelse($users as $index => $user)
                            <tr class="hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0 bg-blue-600 rounded-full flex items-center justify-center">
                                            <span class="text-white font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-white">{{ $user->name }}</div>
                                            @if($user->id === auth()->id())
                                                <span class="text-xs text-green-400">(Anda)</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($user->role == 'pendaftaran') bg-blue-900 text-blue-200
                                        @elseif($user->role == 'dokter') bg-green-900 text-green-200
                                        @elseif($user->role == 'apotek') bg-purple-900 text-purple-200
                                        @else bg-yellow-900 text-yellow-200
                                        @endif">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('pimpinan.user.edit', $user) }}" 
                                           class="text-blue-400 hover:text-blue-300" title="Edit">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('pimpinan.user.reset-password', $user) }}" 
                                           class="text-yellow-400 hover:text-yellow-300" title="Reset Password">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                            </svg>
                                        </a>
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('pimpinan.user.destroy', $user) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Yakin ingin menghapus user ini?')"
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300" title="Hapus">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-400">
                                    Belum ada data user
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Summary -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-blue-900 rounded-lg p-4">
                <div class="text-blue-200 text-sm">Pendaftaran</div>
                <div class="text-white text-2xl font-bold">{{ $users->where('role', 'pendaftaran')->count() }}</div>
            </div>
            <div class="bg-green-900 rounded-lg p-4">
                <div class="text-green-200 text-sm">Dokter</div>
                <div class="text-white text-2xl font-bold">{{ $users->where('role', 'dokter')->count() }}</div>
            </div>
            <div class="bg-purple-900 rounded-lg p-4">
                <div class="text-purple-200 text-sm">Apotek</div>
                <div class="text-white text-2xl font-bold">{{ $users->where('role', 'apotek')->count() }}</div>
            </div>
            <div class="bg-yellow-900 rounded-lg p-4">
                <div class="text-yellow-200 text-sm">Pimpinan</div>
                <div class="text-white text-2xl font-bold">{{ $users->where('role', 'pimpinan')->count() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
