<x-app-layout>
    <div class="min-h-screen bg-[#F5F7FA] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="text-sm text-gray-500 mb-4">
                <a href="{{ route('admin.surat-masuk.index') }}" class="hover:text-blue-600">Surat Masuk</a>
                <span class="mx-2">›</span>
                <span class="text-gray-800 font-medium">Detail Surat</span>
            </nav>

            {{-- Page Header & Actions --}}
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                        Detail Surat Masuk
                        @if($suratMasuk->is_rahasia)
                            <span class="bg-red-100 text-red-700 text-xs px-2.5 py-1 rounded-full font-medium border border-red-200">
                                🔒 Rahasia
                            </span>
                        @endif
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">No. Agenda: <span class="font-mono text-gray-700 font-medium">{{ $suratMasuk->nomor_agenda }}</span></p>
                </div>
                
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.surat-masuk.index') }}"
                       class="border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium px-4 py-2 rounded-lg transition-colors text-sm">
                        ⬅️ Kembali
                    </a>
                    <a href="{{ route('admin.surat-masuk.edit', $suratMasuk) }}"
                       class="bg-amber-500 hover:bg-amber-600 text-white font-medium px-4 py-2 rounded-lg transition-colors text-sm">
                        ✏️ Edit Surat
                    </a>
                </div>
            </div>

            {{-- Layout 2 Kolom --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- ========== KOLOM KIRI (Detail Utama) ========== --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- Card: Isi Surat --}}
                    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                        <div class="border-b border-gray-100 pb-4 mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Informasi Surat</h3>
                        </div>

                        @if($suratMasuk->catatan_warek)
                           <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 shadow-sm">
        <h3 class="text-base font-semibold text-amber-800 mb-2 flex items-center gap-2">
            💬 Catatan Wakil Rektor
        </h3>
        <p class="text-gray-800 whitespace-pre-line text-sm">{{ $suratMasuk->catatan_warek }}</p>
    </div>
@endif
{{-- Tombol Ajukan ke Warek (hanya tampil jika status draft atau dikembalikan) --}}
@if(in_array($suratMasuk->status, ['draft', 'dikembalikan']))
    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
        <form method="POST" action="{{ route('admin.surat-masuk.ajukan', $suratMasuk) }}"
              onsubmit="return confirm('Ajukan surat ini ke Wakil Rektor untuk di-review?');">
            @csrf
            @method('PATCH')
            <button type="submit"
                    class="w-full bg-[#0F4C81] hover:bg-[#0A3A6B] text-white font-medium px-4 py-3 rounded-lg transition-colors text-sm flex items-center justify-center gap-2">
                🚀 Ajukan ke Wakil Rektor
            </button>
        </form>
    </div>
@endif
{{-- Catatan Rektor (tampil jika ada) --}}
@if($suratMasuk->catatan_rektor)
    <div class="bg-purple-50 border border-purple-200 rounded-xl p-6 shadow-sm">
        <h3 class="text-base font-semibold text-purple-800 mb-2 flex items-center gap-2">
            🏛️ Catatan Rektor
        </h3>
        <p class="text-gray-800 whitespace-pre-line text-sm">{{ $suratMasuk->catatan_rektor }}</p>
    </div>
@endif



                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-4">
                            {{-- Field --}}
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium mb-1">Nomor Surat</p>
                                <p class="text-gray-900 font-medium">{{ $suratMasuk->nomor_surat }}</p>
                            </div>
                            
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium mb-1">Jenis Surat</p>
                                <p class="text-gray-900 font-medium">{{ $suratMasuk->jenis_surat }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium mb-1">Asal Surat</p>
                                <p class="text-gray-900 font-medium">{{ $suratMasuk->asal_surat }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium mb-1">Tanggal Surat</p>
                                <p class="text-gray-900 font-medium">{{ $suratMasuk->tanggal_surat->format('d F Y') }}</p>
                            </div>

                            <div class="md:col-span-2">
                                <p class="text-xs text-gray-500 uppercase font-medium mb-1">Perihal</p>
                                <p class="text-gray-900 bg-gray-50 p-4 rounded-lg border border-gray-100 mt-1 whitespace-pre-line">{{ $suratMasuk->perihal }}</p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ========== KOLOM KANAN (Status & Lampiran) ========== --}}
                <div class="space-y-6">

                    {{-- Card: Status & Urgensi --}}
                    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                        <h3 class="text-base font-semibold text-gray-800 mb-4 border-b border-gray-100 pb-2">Status & Urgensi</h3>
                        
                        <div class="space-y-4">
                            {{-- Status --}}
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium mb-2">Status Saat Ini</p>
                                @php
                                    $statusColors = [
                                        'draft' => 'bg-gray-100 text-gray-700 border-gray-200',
                                        'menunggu_warek' => 'bg-blue-50 text-blue-700 border-blue-200',
                                        'menunggu_rektor' => 'bg-purple-50 text-purple-700 border-purple-200',
                                        'selesai' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        'dikembalikan' => 'bg-red-50 text-red-700 border-red-200',
                                    ];
                                    $colorClass = $statusColors[$suratMasuk->status] ?? 'bg-gray-100 text-gray-700';
                                @endphp
                                <span class="px-3 py-1.5 rounded-lg text-sm font-medium border {{ $colorClass }} inline-block">
                                    {{ str_replace('_', ' ', strtoupper($suratMasuk->status)) }}
                                </span>
                            </div>

                            {{-- Urgensi --}}
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium mb-2">Tingkat Urgensi</p>
                                @php
                                    $urgensiColors = [
                                        'normal' => 'bg-gray-100 text-gray-700',
                                        'segera' => 'bg-amber-100 text-amber-800',
                                        'sangat_segera' => 'bg-red-100 text-red-800',
                                    ];
                                    $urgColor = $urgensiColors[$suratMasuk->tingkat_urgensi] ?? 'bg-gray-100 text-gray-700';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $urgColor }} inline-block">
                                    {{ str_replace('_', ' ', strtoupper($suratMasuk->tingkat_urgensi)) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Card: Lampiran File --}}
                    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                        <h3 class="text-base font-semibold text-gray-800 mb-4 border-b border-gray-100 pb-2">Dokumen Lampiran</h3>
                        
                        @if($suratMasuk->file_path)
                            <div class="flex items-center gap-3 bg-blue-50/50 p-4 rounded-lg border border-blue-100">
                                <div class="text-2xl">📄</div>
                                <div class="flex-1 overflow-hidden">
                                    <p class="text-sm font-medium text-gray-900 truncate">Dokumen Surat</p>
                                    <p class="text-xs text-gray-500">Tersedia</p>
                                </div>
                                <a href="{{ asset('storage/' . $suratMasuk->file_path) }}" 
                                   target="_blank"
                                   class="bg-white border border-blue-200 text-blue-700 hover:bg-blue-600 hover:text-white hover:border-blue-600 px-3 py-1.5 rounded text-xs font-medium transition-colors">
                                    Lihat File
                                </a>
                            </div>
                        @else
                            <div class="text-center py-6 bg-gray-50 rounded-lg border border-gray-100 border-dashed">
                                <p class="text-2xl mb-1">📭</p>
                                <p class="text-sm text-gray-500">Tidak ada file lampiran</p>
                            </div>
                        @endif
                    </div>

                    {{-- Card: History/Log Sederhana --}}
                    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                        <h3 class="text-base font-semibold text-gray-800 mb-4 border-b border-gray-100 pb-2">Riwayat Sistem</h3>
                        
                        <div class="space-y-3">
                            <div class="flex gap-3 text-sm">
                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">
                                    📥
                                </div>
                                <div>
                                    <p class="text-gray-900 font-medium">Surat Diterima</p>
                                    <p class="text-gray-500 text-xs">{{ $suratMasuk->tanggal_diterima->format('d F Y') }}</p>
                                </div>
                            </div>
                            
                            <div class="flex gap-3 text-sm">
                                <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center flex-shrink-0">
                                    💻
                                </div>
                                <div>
                                    <p class="text-gray-900 font-medium">Diinput ke Sistem</p>
                                    <p class="text-gray-500 text-xs">Oleh: {{ $suratMasuk->pembuat->name }}</p>
                                    <p class="text-gray-400 text-xs">{{ $suratMasuk->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
