<x-app-layout>
    <div class="min-h-screen bg-[#F5F7FA] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="text-sm text-gray-500 mb-4">
                <a href="{{ route('rektor.surat-masuk.index') }}" class="hover:text-blue-600">Surat Menunggu Persetujuan</a>
                <span class="mx-2">›</span>
                <span class="text-gray-800 font-medium">Detail Surat</span>
            </nav>

            {{-- Page Header --}}
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Tinjauan Surat Masuk</h1>
                    <p class="text-sm text-gray-500 mt-1">No. Agenda: <span class="font-mono text-gray-700 font-medium">{{ $suratMasuk->nomor_agenda }}</span></p>
                </div>
                <a href="{{ route('rektor.surat-masuk.index') }}"
                   class="border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium px-4 py-2 rounded-lg transition-colors text-sm">
                    ⬅️ Kembali
                </a>
            </div>

            {{-- Layout 2 Kolom --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- ========== KOLOM KIRI (Detail Surat) ========== --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Card: Informasi Surat --}}
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

                    {{-- Catatan Wakil Rektor (tampil jika ada) --}}
                    @if($suratMasuk->catatan_warek)
                        <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 shadow-sm">
                            <h3 class="text-base font-semibold text-amber-800 mb-2 flex items-center gap-2">
                                💬 Catatan Wakil Rektor
                            </h3>
                            <p class="text-gray-800 whitespace-pre-line text-sm">{{ $suratMasuk->catatan_warek }}</p>
                        </div>
                    @endif

                    {{-- Dokumen Lampiran --}}
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

                    {{-- ========== FORM DISPOSISI (hanya jika status = selesai) ========== --}}
                    @if($suratMasuk->status === 'selesai')
                        {{-- Daftar Disposisi yang Sudah Dibuat --}}
                        @if($suratMasuk->disposisis->isNotEmpty())
                            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                                <h3 class="text-base font-semibold text-gray-800 mb-4">📋 Disposisi yang Sudah Dibuat</h3>
                                <div class="space-y-4">
                                    @foreach($suratMasuk->disposisis as $disposisi)
                                        <div class="bg-gray-50 border border-gray-100 rounded-lg p-4">
                                            <div class="flex items-start justify-between mb-2">
                                                <p class="text-sm font-medium text-gray-900">Instruksi:</p>
                                                <span class="text-xs text-gray-500">{{ $disposisi->created_at->format('d M Y, H:i') }}</span>
                                            </div>
                                            <p class="text-sm text-gray-700 whitespace-pre-line mb-2">{{ $disposisi->instruksi }}</p>
                                            <div class="flex flex-wrap gap-1.5">
                                                @foreach($disposisi->bagians as $bagian)
                                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full font-medium">
                                                        {{ $bagian->nama_bagian }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Form Buat Disposisi Baru --}}
                        <div class="bg-white border-2 border-emerald-300 rounded-xl p-6 shadow-sm">
                            <h3 class="text-base font-bold text-emerald-800 mb-4 flex items-center gap-2">
                                📝 Buat Disposisi Baru
                            </h3>

                            <form method="POST" action="{{ route('rektor.disposisi.store', $suratMasuk) }}">
                                @csrf

                                {{-- Checkbox Bagian --}}
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Disposisi ke Bagian <span class="text-red-500">*</span></label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        @foreach($bagians as $bagian)
                                            <label class="flex items-center gap-2 bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 cursor-pointer hover:bg-gray-100 transition-colors">
                                                <input type="checkbox" name="bagian_ids[]" value="{{ $bagian->id }}"
                                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                                       {{ in_array($bagian->id, old('bagian_ids', [])) ? 'checked' : '' }}>
                                                <span class="text-sm text-gray-800">{{ $bagian->nama_bagian }} ({{ $bagian->kode_bagian }})</span>
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('bagian_ids')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Instruksi --}}
                                <div class="mb-4">
                                    <label for="instruksi" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Instruksi Disposisi <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="instruksi" name="instruksi" rows="3"
                                              placeholder="Tuliskan instruksi untuk bagian terkait..."
                                              class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent">{{ old('instruksi') }}</textarea>
                                    @error('instruksi')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Catatan (opsional) --}}
                                <div class="mb-4">
                                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Catatan Tambahan <span class="text-gray-400">(opsional)</span>
                                    </label>
                                    <textarea id="catatan" name="catatan" rows="2"
                                              placeholder="Catatan tambahan jika diperlukan..."
                                              class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent">{{ old('catatan') }}</textarea>
                                </div>

                                <button type="submit"
                                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium px-4 py-2.5 rounded-lg transition-colors text-sm">
                                    📤 Kirim Disposisi
                                </button>
                            </form>
                        </div>
                    @endif

                </div>

                {{-- ========== KOLOM KANAN (Panel Aksi + Info) ========== --}}
                <div class="space-y-6">

                    {{-- Panel Aksi Rektor (hanya jika status = menunggu_rektor) --}}
                    @if($suratMasuk->status === 'menunggu_rektor')
                        <div class="bg-white border-2 border-[#0F4C81] rounded-xl p-6 shadow-sm">
                            <h3 class="text-base font-bold text-[#0F4C81] mb-4 flex items-center gap-2">
                                🏛️ Keputusan Anda
                            </h3>

                            {{-- Textarea Catatan --}}
                            <div class="mb-4">
                                <label for="catatan_rektor" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Catatan Rektor
                                </label>
                                <textarea id="catatan_rektor" name="catatan_rektor" rows="4"
                                          placeholder="Tulis catatan (wajib diisi jika mengembalikan)..."
                                          class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"></textarea>
                                <p id="catatan-error" class="text-red-500 text-xs mt-1 hidden"></p>
                                @error('catatan_rektor')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tombol: Setujui --}}
                            <form method="POST" action="{{ route('rektor.surat-masuk.approve', $suratMasuk) }}" class="mb-3"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menyetujui surat ini?');">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="catatan_rektor" class="catatan-hidden">
                                <button type="submit"
                                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium px-4 py-2.5 rounded-lg transition-colors text-sm flex items-center justify-center gap-2">
                                    ✅ Setujui Surat
                                </button>
                            </form>

                            {{-- Tombol: Kembalikan --}}
                            <form method="POST" action="{{ route('rektor.surat-masuk.kembalikan', $suratMasuk) }}" id="form-kembalikan">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="catatan_rektor" class="catatan-hidden">
                                <button type="submit"
                                        class="w-full bg-red-500 hover:bg-red-600 text-white font-medium px-4 py-2.5 rounded-lg transition-colors text-sm flex items-center justify-center gap-2">
                                    ↩️ Kembalikan
                                </button>
                            </form>
                        </div>
                    @endif

                    {{-- Card: Status --}}
                    @if($suratMasuk->status === 'selesai')
                        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-6 shadow-sm">
                            <h3 class="text-base font-semibold text-emerald-800 mb-2">✅ Surat Disetujui</h3>
                            <p class="text-sm text-emerald-700">Surat ini telah disetujui. Anda dapat membuat disposisi di bawah.</p>
                        </div>
                    @endif

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

    {{-- Script: Sinkronisasi textarea dengan hidden input --}}
    @if($suratMasuk->status === 'menunggu_rektor')
    <script>
        const textarea = document.getElementById('catatan_rektor');
        const hiddenInputs = document.querySelectorAll('.catatan-hidden');

        textarea.addEventListener('input', function() {
            hiddenInputs.forEach(input => input.value = this.value);
        });

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
    @endif
</x-app-layout>
