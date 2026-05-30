<x-app-layout>
    <div class="min-h-screen bg-[#F5F7FA] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="text-sm text-gray-500 mb-4">
                <a href="{{ route('warek.surat-masuk.index') }}" class="hover:text-blue-600">Surat Menunggu Review</a>
                <span class="mx-2">›</span>
                <span class="text-gray-800 font-medium">Detail Surat</span>
            </nav>

            {{-- Page Header --}}
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Review Surat Masuk</h1>
                    <p class="text-sm text-gray-500 mt-1">No. Agenda: <span class="font-mono text-gray-700 font-medium">{{ $suratMasuk->nomor_agenda }}</span></p>
                </div>
                <a href="{{ route('warek.surat-masuk.index') }}"
                   class="border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium px-4 py-2 rounded-lg transition-colors text-sm">
                    ⬅️ Kembali
                </a>
            </div>

            {{-- Layout 2 Kolom --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- ========== KOLOM KIRI (Detail Surat — Read-only) ========== --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Card: Informasi Surat (sama seperti show Admin) --}}
                    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                        <div class="border-b border-gray-100 pb-4 mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Informasi Surat</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-4">
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

                    {{-- Card: Dokumen Lampiran --}}
                    @if($suratMasuk->file_path)
                        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                            <h3 class="text-base font-semibold text-gray-800 mb-4">📎 Dokumen Lampiran</h3>
                            <div class="flex items-center gap-3 bg-blue-50/50 p-4 rounded-lg border border-blue-100">
                                <div class="text-2xl">📄</div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Dokumen Surat</p>
                                    <p class="text-xs text-gray-500">Tersedia</p>
                                </div>
                                <a href="{{ asset('storage/' . $suratMasuk->file_path) }}" target="_blank"
                                   class="bg-white border border-blue-200 text-blue-700 hover:bg-blue-600 hover:text-white px-3 py-1.5 rounded text-xs font-medium transition-colors">
                                    Lihat File
                                </a>
                            </div>
                        </div>
                    @endif

                </div>

                {{-- ========== KOLOM KANAN (Panel Tindakan Warek) ========== --}}
                <div class="space-y-6">

                    {{-- Card: Panel Tindakan --}}
                    <div class="bg-white border-2 border-[#0F4C81] rounded-xl p-6 shadow-sm">
                        <h3 class="text-base font-bold text-[#0F4C81] mb-4 flex items-center gap-2">
                            ⚖️ Tindakan Anda
                        </h3>

                        {{-- Textarea Catatan --}}
                        <div class="mb-4">
                            <label for="catatan_warek" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Catatan Review
                            </label>
                            <textarea id="catatan_warek" name="catatan_warek" rows="4"
                                      placeholder="Tulis catatan untuk surat ini (wajib diisi jika mengembalikan)..."
                                      class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"></textarea>
                            <p id="catatan-error" class="text-red-500 text-xs mt-1 hidden"></p>
                            @error('catatan_warek')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tombol: Teruskan ke Rektor --}}
                        <form method="POST" action="{{ route('warek.surat-masuk.teruskan', $suratMasuk) }}" class="mb-3">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="catatan_warek" class="catatan-hidden">
                            <button type="submit"
                                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium px-4 py-2.5 rounded-lg transition-colors text-sm flex items-center justify-center gap-2">
                                ✅ Teruskan ke Rektor
                            </button>
                        </form>

                        {{-- Tombol: Kembalikan ke Admin --}}
                        <form method="POST" action="{{ route('warek.surat-masuk.kembalikan', $suratMasuk) }}" id="form-kembalikan">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="catatan_warek" class="catatan-hidden">
                            <button type="submit"
                                    class="w-full bg-red-500 hover:bg-red-600 text-white font-medium px-4 py-2.5 rounded-lg transition-colors text-sm flex items-center justify-center gap-2">
                                ↩️ Kembalikan ke Admin
                            </button>
                        </form>
                    </div>

                    {{-- Card: Info Metadata --}}
                    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                        <h3 class="text-base font-semibold text-gray-800 mb-4 border-b border-gray-100 pb-2">ℹ️ Info Surat</h3>
                        <div class="space-y-3 text-sm">
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium mb-1">Urgensi</p>
                                @php
                                    $urgColors = [
                                        'normal' => 'bg-gray-100 text-gray-700',
                                        'segera' => 'bg-amber-100 text-amber-800',
                                        'sangat_segera' => 'bg-red-100 text-red-800',
                                    ];
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $urgColors[$suratMasuk->tingkat_urgensi] ?? '' }}">
                                    {{ str_replace('_', ' ', ucfirst($suratMasuk->tingkat_urgensi)) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium mb-1">Diinput oleh</p>
                                <p class="font-medium text-gray-800">{{ $suratMasuk->pembuat->name }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium mb-1">Tgl Diterima</p>
                                <p class="text-gray-700">{{ $suratMasuk->tanggal_diterima->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    {{-- Script: Sinkronisasi textarea dengan hidden input di kedua form --}}
    <script>
        const textarea = document.getElementById('catatan_warek');
        const hiddenInputs = document.querySelectorAll('.catatan-hidden');

        // Sinkronkan nilai textarea ke semua hidden input
        textarea.addEventListener('input', function() {
            hiddenInputs.forEach(input => input.value = this.value);
        });

        // Validasi: catatan wajib diisi jika klik "Kembalikan"
        document.getElementById('form-kembalikan').addEventListener('submit', function(e) {
            if (textarea.value.trim().length < 10) {
                e.preventDefault();
                const errorEl = document.getElementById('catatan-error');
                errorEl.textContent = 'Catatan wajib diisi minimal 10 karakter saat mengembalikan surat.';
                errorEl.classList.remove('hidden');
                textarea.focus();
            }
        });
    </script>
</x-app-layout>
