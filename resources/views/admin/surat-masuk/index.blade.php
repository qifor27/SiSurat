<x-app-layout>
    <div class="min-h-screen bg-[#F5F7FA] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Daftar Surat Masuk</h1>
                    <p class="text-sm text-gray-500 mt-1">Kelola dan pantau semua surat yang masuk ke instansi.</p>
                </div>
                <a href="{{ route('admin.surat-masuk.create') }}"
                   class="bg-[#0F4C81] hover:bg-[#0A3A6B] text-white font-medium px-5 py-2.5 rounded-lg transition-colors inline-flex items-center gap-2 text-sm">
                    + Surat Baru
                </a>
            </div>

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mb-4 flex items-center gap-2 bg-green-50 border border-green-200
                            text-green-700 text-sm px-4 py-3 rounded-lg">
                    ✅ {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 flex items-center gap-2 bg-red-50 border border-red-200
                            text-red-700 text-sm px-4 py-3 rounded-lg">
                    ❌ {{ session('error') }}
                </div>
            @endif

            {{-- Main Card --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

                {{-- Filter Bar --}}
                <div class="p-4 border-b border-gray-200 flex items-center justify-between gap-4">
                    <div class="relative flex-1 max-w-md">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            🔍
                        </span>
                        <input type="text"
                               placeholder="Cari nomor, pengirim, atau perihal..."
                               class="w-full border border-gray-200 rounded-lg pl-10 pr-3 py-2 text-sm
                                      focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="border border-gray-300 text-gray-700 hover:bg-gray-50
                                       font-medium px-4 py-2 rounded-lg transition-colors text-sm
                                       flex items-center gap-2">
                            📅 Periode
                        </button>
                        <button class="border border-gray-300 text-gray-700 hover:bg-gray-50
                                       font-medium px-4 py-2 rounded-lg transition-colors text-sm
                                       flex items-center gap-2">
                            ≡ Filter
                        </button>
                    </div>
                </div>

                {{-- Tabel Surat Masuk --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 font-medium">
                                    <input type="checkbox" class="rounded border-gray-300
                                           text-blue-600 focus:ring-blue-500">
                                </th>
                                <th class="px-6 py-4 font-medium">NO</th>
                                <th class="px-6 py-4 font-medium">NOMOR SURAT</th>
                                <th class="px-6 py-4 font-medium">PERIHAL</th>
                                <th class="px-6 py-4 font-medium">ASAL SURAT</th>
                                <th class="px-6 py-4 font-medium">TGL DITERIMA</th>
                                <th class="px-6 py-4 font-medium">URGENSI</th>
                                <th class="px-6 py-4 font-medium">STATUS</th>
                                <th class="px-6 py-4 font-medium text-right">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($suratMasuk as $surat)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    {{-- Checkbox --}}
                                    <td class="px-6 py-4">
                                        <input type="checkbox" class="rounded border-gray-300
                                               text-blue-600 focus:ring-blue-500">
                                    </td>

                                    {{-- Nomor Urut (bukan ID database) --}}
                                    <td class="px-6 py-4 text-gray-500">
                                        {{ str_pad($loop->iteration + ($suratMasuk->currentPage() - 1) * $suratMasuk->perPage(), 2, '0', STR_PAD_LEFT) }}
                                    </td>

                                    {{-- Nomor Surat --}}
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $surat->nomor_surat }}
                                    </td>

                                    {{-- Perihal (maks 50 karakter) --}}
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ Str::limit($surat->perihal, 50) }}
                                    </td>

                                    {{-- Asal Surat --}}
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $surat->asal_surat }}
                                    </td>

                                    {{-- Tanggal Diterima --}}
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $surat->tanggal_diterima->format('d M Y') }}
                                    </td>

                                    {{-- Badge Urgensi --}}
                                    <td class="px-6 py-4">
                                        @php
                                            $urgensiClass = match($surat->tingkat_urgensi) {
                                                'normal'         => 'bg-[#F3F4F6] text-[#6B7280]',
                                                'segera'         => 'bg-[#FEF3C7] text-[#D97706]',
                                                'sangat_segera'  => 'bg-[#FEE2E2] text-[#DC2626]',
                                                default          => 'bg-gray-100 text-gray-600',
                                            };
                                            $urgensiLabel = match($surat->tingkat_urgensi) {
                                                'normal'         => 'Biasa',
                                                'segera'         => 'Segera',
                                                'sangat_segera'  => 'Penting',
                                                default          => $surat->tingkat_urgensi,
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $urgensiClass }}">
                                            {{ $urgensiLabel }}
                                        </span>
                                    </td>

                                    {{-- Badge Status --}}
                                    <td class="px-6 py-4">
                                        @php
                                            $statusClass = match($surat->status) {
                                                'draft'            => 'bg-[#F3F4F6] text-[#6B7280]',
                                                'menunggu_warek'   => 'bg-[#FEF3C7] text-[#D97706]',
                                                'menunggu_rektor'  => 'bg-[#DBEAFE] text-[#2B6CB0]',
                                                'selesai'          => 'bg-[#D1FAE5] text-[#16A34A]',
                                                'dikembalikan'     => 'bg-[#FEE2E2] text-[#DC2626]',
                                                default            => 'bg-gray-100 text-gray-600',
                                            };
                                            $statusLabel = ucwords(str_replace('_', ' ', $surat->status));
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <a href="{{ route('admin.surat-masuk.show', $surat) }}"
                                           class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                            Lihat
                                        </a>
                                        @if($surat->status === 'draft')
                                            <span class="text-gray-300">|</span>
                                            <a href="{{ route('admin.surat-masuk.edit', $surat) }}"
                                               class="text-gray-600 hover:text-gray-900 font-medium text-sm">
                                                Edit
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                {{-- Tampilan saat belum ada surat --}}
                                <tr>
                                    <td colspan="9" class="px-6 py-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <span class="text-4xl mb-3">📭</span>
                                            <p class="text-base font-medium text-gray-900">Belum ada surat masuk</p>
                                            <p class="text-sm mt-1">Surat yang Anda registrasikan akan muncul di sini.</p>
                                            <a href="{{ route('admin.surat-masuk.create') }}"
                                               class="mt-4 text-sm text-blue-600 font-medium hover:underline">
                                                Registrasi Surat Baru →
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($suratMasuk->hasPages())
                    <div class="p-4 border-t border-gray-200">
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>
                                Menampilkan {{ $suratMasuk->firstItem() }}–{{ $suratMasuk->lastItem() }}
                                dari {{ $suratMasuk->total() }} surat
                            </span>
                            {{ $suratMasuk->links() }}
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
