<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen p-4 bg-gray-100">
        <h1 class="text-6xl font-bold text-red-600 mb-4">403</h1>
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Akses Ditolak</h2>
        <p class="text-gray-600 mb-6 text-center">
            Maaf, Anda tidak memiliki izin (akses) ke halaman ini.
        </p>
        
        @auth
            <a href="{{ auth()->user()->getHomeRoute() }}" class="px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 transition">
                Kembali ke Dashboard
            </a>
        @else
            <a href="{{ route('login') }}" class="px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 transition">
                Kembali ke Halaman Login
            </a>
        @endauth
    </div>
</x-guest-layout>
