<x-app-layout>
    <div class="min-h-screen bg-[#F5F7FA] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">🏛️ Surat Menunggu Persetujuan</h1>
                <p class="text-sm text-gray-500 mt-1">Daftar surat masuk yang memerlukan persetujuan Anda.</p>
            </div>

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="mb-4 flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm px-4 py-3 rounded-lg">
                    ✅ {{ session('success') }}
                </div>
            @endif

            {{-- Card Tabel --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

                @if($suratMasuk->isEmpty())
                    <div class="text-center py-16">
                        <p class="text-4xl mb-3">📭</p>
                        <p class="text-lg font-medium text-gray-700">Tidak ada surat yang perlu disetujui</p>
                        <p class="text-sm text-gray-500 mt-1">Semua surat sudah ditindaklanjuti.</p>
                    </div>
                @else
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 font-semibold text-gray-600 text-xs uppercase">No. Agenda</th>
                                <th class="px-6 py-3 font-semibold text-gray-600 text-xs uppercase">Asal Surat</th>
                                <th class="px-6 py-3 font-semibold text-gray-600 text-xs uppercase">Perihal</th>
                                <th class="px-6 py-3 font-semibold text-gray-600 text-xs uppercase">Urgensi</th>
                                <th class="px-6 py-3 font-semibold text-gray-600 text-xs uppercase">Tgl Diterima</th>
                                <th class="px-6 py-3 font-semibold text-gray-600 text-xs uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($suratMasuk as $surat)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 font-mono text-xs text-gray-700">{{ $surat->nomor_agenda }}</td>
                                    <td class="px-6 py-4 text-gray-900 font-medium">{{ $surat->asal_surat }}</td>
                                    <td class="px-6 py-4 text-gray-700 max-w-xs truncate">{{ $surat->perihal }}</td>
                                    <td class="px-6 py-4">
                                        @php
                                            $urgColors = [
                                                'normal' => 'bg-gray-100 text-gray-700',
                                                'segera' => 'bg-amber-100 text-amber-800',
                                                'sangat_segera' => 'bg-red-100 text-red-800',
                                            ];
                                        @endphp
                                        <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $urgColors[$surat->tingkat_urgensi] ?? '' }}">
                                            {{ str_replace('_', ' ', ucfirst($surat->tingkat_urgensi)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 text-xs">{{ $surat->tanggal_diterima->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('rektor.surat-masuk.show', $surat) }}"
                                           class="bg-[#0F4C81] hover:bg-[#0A3A6B] text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-colors">
                                            Tinjau
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $suratMasuk->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
