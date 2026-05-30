<x-app-layout>
    <div class="min-h-screen bg-[#F5F7FA] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="text-sm text-gray-500 mb-4">
                <a href="{{ route('admin.surat-masuk.index') }}" class="hover:text-blue-600">Surat Masuk</a>
                <span class="mx-2">›</span>
                <a href="{{ route('admin.surat-masuk.show', $suratMasuk) }}" class="hover:text-blue-600">Detail Surat</a>
                <span class="mx-2">›</span>
                <span class="text-gray-800 font-medium">Edit Surat</span>
            </nav>

            {{-- Form Utama --}}
            <form method="POST"
                  action="{{ route('admin.surat-masuk.update', $suratMasuk) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Page Header --}}
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Edit Surat Masuk</h1>
                        <p class="text-sm text-gray-500 mt-1">Perbarui detail informasi untuk surat masuk ini.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.surat-masuk.index') }}"
                           class="border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium px-5 py-2.5 rounded-lg transition-colors text-sm">
                            Batal
                        </a>
                        <button type="submit"
                                class="bg-[#0F4C81] hover:bg-[#0A3A6B] text-white font-medium px-5 py-2.5 rounded-lg transition-colors text-sm inline-flex items-center gap-2">
                            💾 Simpan Perubahan
                        </button>
                    </div>
                </div>

                {{-- Flash Error --}}
                @if(session('error'))
                    <div class="mb-4 flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-lg">
                        ❌ {{ session('error') }}
                    </div>
                @endif

                {{-- Layout 2 Kolom --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- ========== KOLOM KIRI (2/3) ========== --}}
                    <div class="lg:col-span-2 space-y-6">

                        {{-- Card: Informasi Dasar --}}
                        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="text-lg">📄</span>
                                <h3 class="text-base font-semibold text-gray-800">Informasi Dasar</h3>
                            </div>

                            {{-- Row 1: Nomor Surat + Tanggal Surat --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                {{-- Nomor Surat --}}
                                <div>
                                    <label for="nomor_surat" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Nomor Surat <span class="text-red-500 ml-0.5">*</span>
                                    </label>
                                    <input type="text" name="nomor_surat" id="nomor_surat"
                                           value="{{ old('nomor_surat', $suratMasuk->nomor_surat) }}"
                                           placeholder="Masukkan nomor surat resmi"
                                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                                    @error('nomor_surat')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Tanggal Surat --}}
                                <div>
                                    <label for="tanggal_surat" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Tanggal Surat <span class="text-red-500 ml-0.5">*</span>
                                    </label>
                                    <input type="date" name="tanggal_surat" id="tanggal_surat"
                                           value="{{ old('tanggal_surat', $suratMasuk->tanggal_surat->format('Y-m-d')) }}"
                                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                                    @error('tanggal_surat')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Row 2: Asal Surat --}}
                            <div class="mb-4">
                                <label for="asal_surat" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Asal Surat (Instansi/Pengirim) <span class="text-red-500 ml-0.5">*</span>
                                </label>
                                <input type="text" name="asal_surat" id="asal_surat"
                                       value="{{ old('asal_surat', $suratMasuk->asal_surat) }}"
                                       placeholder="Contoh: Kementerian Pendidikan dan Kebudayaan"
                                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                                @error('asal_surat')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Row 3: Perihal --}}
                            <div class="mb-4">
                                <label for="perihal" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Perihal <span class="text-red-500 ml-0.5">*</span>
                                </label>
                                <textarea name="perihal" id="perihal" rows="3"
                                          placeholder="Tuliskan perihal atau ringkasan isi surat"
                                          class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">{{ old('perihal', $suratMasuk->perihal) }}</textarea>
                                @error('perihal')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Row 4: Jenis Surat + Tingkat Urgensi --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                {{-- Jenis Surat --}}
                                <div>
                                    <label for="jenis_surat" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Jenis Surat <span class="text-red-500 ml-0.5">*</span>
                                    </label>
                                    <select name="jenis_surat" id="jenis_surat"
                                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                                        <option value="">Pilih jenis surat</option>
                                        @foreach($jenisSurat as $jenis)
                                            <option value="{{ $jenis }}"
                                                {{ old('jenis_surat', $suratMasuk->jenis_surat) === $jenis ? 'selected' : '' }}>
                                                {{ $jenis }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_surat')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Tingkat Urgensi (JavaScript Tabs) --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Tingkat Urgensi <span class="text-red-500 ml-0.5">*</span>
                                    </label>
                                    <div class="flex gap-2 flex-wrap" id="urgensi-pills">
                                        @foreach(['normal' => 'Biasa', 'segera' => 'Segera', 'sangat_segera' => 'Penting'] as $val => $label)
                                            <label class="cursor-pointer urgensi-label">
                                                <input type="radio" name="tingkat_urgensi" value="{{ $val }}"
                                                       class="hidden"
                                                       {{ old('tingkat_urgensi', $suratMasuk->tingkat_urgensi) === $val ? 'checked' : '' }}>
                                                <span class="inline-block px-3 py-1.5 rounded-full text-xs font-medium border
                                                             transition-all cursor-pointer
                                                             {{ old('tingkat_urgensi', $suratMasuk->tingkat_urgensi) === $val
                                                                ? 'bg-[#0F4C81] text-white border-[#0F4C81]'
                                                                : 'border-gray-200 text-gray-600' }}">
                                                    {{ $label }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('tingkat_urgensi')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Row 5: Checkbox Surat Rahasia --}}
                            <div class="flex items-center gap-2">
                                <input type="checkbox" name="is_rahasia" id="is_rahasia" value="1"
                                       {{ old('is_rahasia', $suratMasuk->is_rahasia) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-[#0F4C81] focus:ring-blue-400">
                                <label for="is_rahasia" class="text-sm text-gray-700">
                                    Surat Rahasia
                                </label>
                            </div>
                        </div>

                        {{-- Card: Tanggal Diterima --}}
                        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="text-lg">📅</span>
                                <h3 class="text-base font-semibold text-gray-800">Tanggal Diterima</h3>
                            </div>
                            <div>
                                <label for="tanggal_diterima" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Tanggal Diterima <span class="text-red-500 ml-0.5">*</span>
                                </label>
                                <input type="date" name="tanggal_diterima" id="tanggal_diterima"
                                       value="{{ old('tanggal_diterima', $suratMasuk->tanggal_diterima->format('Y-m-d')) }}"
                                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                                @error('tanggal_diterima')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                    </div>

                    {{-- ========== KOLOM KANAN (1/3) ========== --}}
                    <div class="space-y-6">

                        {{-- Card: Lampiran Dokumen --}}
                        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="text-lg">📎</span>
                                <h3 class="text-base font-semibold text-gray-800">Lampiran Dokumen</h3>
                            </div>

                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center
                                        hover:border-blue-400 transition-colors" id="upload-area">
                                {{-- Icon Upload --}}
                                <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="text-sm font-medium text-gray-700 mt-3">Ganti File Dokumen (Opsional)</p>
                                <p class="text-xs text-gray-400 mt-1">Biarkan kosong jika tidak ingin mengubah file.</p>
                                <label class="mt-3 inline-block border border-blue-500 text-blue-600
                                              text-xs px-4 py-1.5 rounded-lg cursor-pointer
                                              hover:bg-blue-50 transition-colors">
                                    Browse File Baru
                                    <input type="file" name="file_surat" id="file-input" class="hidden"
                                           accept="application/pdf,image/jpeg,image/jpg,image/png">
                                </label>

                                {{-- Nama file baru --}}
                                <p id="file-name" class="text-xs text-blue-600 mt-2 hidden font-medium"></p>

                                {{-- File lama --}}
                                @if($suratMasuk->file_path)
                                    <div class="mt-4 pt-4 border-t border-gray-100 text-left">
                                        <p class="text-xs text-gray-500 mb-1">File saat ini:</p>
                                        <a href="{{ asset('storage/' . $suratMasuk->file_path) }}" target="_blank"
                                           class="text-sm text-blue-600 hover:underline flex items-center gap-1">
                                            <span>📄</span> Lihat Dokumen
                                        </a>
                                    </div>
                                @endif
                            </div>
                            @error('file_surat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Card: Metadata Sistem (read-only) --}}
                        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="text-lg">ℹ️</span>
                                <h3 class="text-base font-semibold text-gray-800">Metadata Sistem</h3>
                            </div>

                            <div class="space-y-4 text-sm">
                                {{-- Tanggal Diterima --}}
                                <div>
                                    <p class="text-gray-500 text-xs uppercase font-medium mb-1">Diinput Pada</p>
                                    <p class="font-medium text-gray-800">{{ $suratMasuk->created_at->format('d F Y, H:i') }} WIB</p>
                                </div>

                                {{-- Dicatat oleh --}}
                                <div>
                                    <p class="text-gray-500 text-xs uppercase font-medium mb-1">Dicatat oleh</p>
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center
                                                    justify-center text-white text-xs font-bold flex-shrink-0">
                                            {{ strtoupper(substr($suratMasuk->pembuat->name, 0, 2)) }}
                                        </div>
                                        <span class="font-medium text-gray-800">{{ $suratMasuk->pembuat->name }}</span>
                                    </div>
                                </div>

                                {{-- No. Agenda --}}
                                <div>
                                    <p class="text-gray-500 text-xs uppercase font-medium mb-1">No. Agenda</p>
                                    <span class="bg-gray-100 text-gray-600 font-mono font-medium text-xs px-2 py-1 rounded">
                                        {{ $suratMasuk->nomor_agenda }}
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Tombol Simpan di Bawah --}}
                <div class="mt-6 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.surat-masuk.index') }}"
                       class="border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium px-5 py-2.5 rounded-lg transition-colors text-sm">
                        Batal
                    </a>
                    <button type="submit"
                            class="bg-[#0F4C81] hover:bg-[#0A3A6B] text-white font-medium px-5 py-2.5 rounded-lg transition-colors text-sm inline-flex items-center gap-2">
                        💾 Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
    </div>

    {{-- Script: Sama seperti Create --}}
    <script>
        document.getElementById('file-input').addEventListener('change', function() {
            const name = this.files[0]?.name;
            const el = document.getElementById('file-name');
            if (name) {
                el.textContent = '📎 ' + name + ' (File Baru)';
                el.classList.remove('hidden');
            }
        });

        document.querySelectorAll('.urgensi-label').forEach(function(label) {
            label.addEventListener('click', function() {
                document.querySelectorAll('.urgensi-label span').forEach(function(span) {
                    span.classList.remove('bg-[#0F4C81]', 'text-white', 'border-[#0F4C81]');
                    span.classList.add('border-gray-200', 'text-gray-600');
                });
                const span = this.querySelector('span');
                span.classList.remove('border-gray-200', 'text-gray-600');
                span.classList.add('bg-[#0F4C81]', 'text-white', 'border-[#0F4C81]');
            });
        });
    </script>
</x-app-layout>
