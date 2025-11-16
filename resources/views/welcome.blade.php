<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Klinik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center">
    <div class="text-center">
        <div class="mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-blue-600 rounded-full">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
        </div>
        <h1 class="text-4xl font-bold text-white mb-4">
            Sistem Informasi Kesehatan
        </h1>
        <p class="text-xl text-gray-400 mb-8">
            Klinik Pratama
        </p>
        @if (Route::has('login'))
            <div class="space-y-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium px-8 py-3 rounded-lg transition duration-200">
                        Masuk ke Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium px-8 py-3 rounded-lg transition duration-200">
                        Login Sistem
                    </a>
                @endauth
            </div>
        @endif
        <div class="mt-12 text-gray-500 text-sm">
            <p>Sistem Internal - Hanya untuk staff klinik</p>
        </div>
    </div>
</body>
</html>
