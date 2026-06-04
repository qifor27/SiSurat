<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="flex items-center text-[13px] text-[#64748B] mb-4 font-medium">
                <a href="{{ route('admin.surat-masuk.index') }}" class="hover:text-[#4338CA] transition-colors">Surat Masuk</a>
                <i data-lucide="chevron-right" class="w-4 h-4 mx-1"></i>
                <a href="{{ route('admin.surat-masuk.show', $suratMasuk) }}" class="hover:text-[#4338CA] transition-colors">{{ $suratMasuk->nomor_surat }}</a>
                <i data-lucide="chevron-right" class="w-4 h-4 mx-1"></i>
                <span class="text-[#0F172A]">Edit Surat</span>
            </nav>

            {{-- Form Wrapper --}}
            <form method="POST" action="{{ route('admin.surat-masuk.update', $suratMasuk) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Page Header --}}
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-[#0F172A]">Edit Surat Masuk</h1>
                        <p class="text-sm text-[#64748B] mt-1">Perbarui data surat. Biarkan lampiran kosong jika tidak ingin mengubah file.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.surat-masuk.index') }}" class="btn-secondary">
                            Batal
                        </a>
                        <button type="submit" class="btn-primary">
                            <i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>

                {{-- Flash Error --}}
                @if(session('error'))
                    <div class="mb-6 flex items-center gap-3 bg-[#FEE2E2] border border-[#FECACA] text-[#991B1B] text-[13px] px-4 py-3 rounded-xl font-medium">
                        <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Layout 2 Kolom --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- ========== KOLOM KIRI (Informasi Surat) ========== --}}
                    <div class="lg:col-span-2 space-y-6">

                        {{-- Card: Informasi Dasar --}}
                        <div class="card-enterprise-lg p-6 sm:p-8">
                            <h3 class="text-base font-bold text-[#0F172A] mb-6 flex items-center gap-2">
                                <i data-lucide="file-edit" class="w-5 h-5 text-[#4338CA]"></i> Informasi Dasar
                            </h3>

                            <div class="space-y-5">
                                {{-- Baris 1: Nomor & Tanggal --}}
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-[13px] font-semibold text-[#0F172A] mb-2">
                                            Nomor Surat <span class="text-[#EF4444]">*</span>
                                        </label>
                                        <input type="text" name="nomor_surat" value="{{ old('nomor_surat', $suratMasuk->nomor_surat) }}"
                                               class="input-enterprise w-full">
                                        @error('nomor_surat')
                                            <p class="text-[#EF4444] text-xs mt-1.5 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-[13px] font-semibold text-[#0F172A] mb-2">
                                            Tanggal Surat <span class="text-[#EF4444]">*</span>
                                        </label>
                                        <input type="date" name="tanggal_surat" value="{{ old('tanggal_surat', $suratMasuk->tanggal_surat->format('Y-m-d')) }}"
                                               class="input-enterprise w-full">
                                        @error('tanggal_surat')
                                            <p class="text-[#EF4444] text-xs mt-1.5 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Baris 2: Asal Surat --}}
                                <div>
                                    <label class="block text-[13px] font-semibold text-[#0F172A] mb-2">
                                        Asal Surat (Instansi/Pengirim) <span class="text-[#EF4444]">*</span>
                                    </label>
                                    <input type="text" name="asal_surat" value="{{ old('asal_surat', $suratMasuk->asal_surat) }}"
                                           class="input-enterprise w-full">
                                    @error('asal_surat')
                                        <p class="text-[#EF4444] text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Baris 3: Perihal --}}
                                <div>
                                    <label class="block text-[13px] font-semibold text-[#0F172A] mb-2">
                                        Perihal <span class="text-[#EF4444]">*</span>
                                    </label>
                                    <textarea name="perihal" rows="3"
                                              class="w-full border border-[#CBD5E1] rounded-xl px-4 py-3 text-[14px] text-[#0F172A] focus:outline-none focus:border-[#4338CA] focus:ring-4 focus:ring-[#4338CA]/10 transition-all font-sans resize-y min-h-[100px]">{{ old('perihal', $suratMasuk->perihal) }}</textarea>
                                    @error('perihal')
                                        <p class="text-[#EF4444] text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Baris 4: Jenis & Urgensi --}}
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-[13px] font-semibold text-[#0F172A] mb-2">
                                            Jenis Surat <span class="text-[#EF4444]">*</span>
                                        </label>
                                        <div class="relative">
                                            <select name="jenis_surat" class="input-enterprise w-full appearance-none pr-10">
                                                <option value="">Pilih Jenis Surat</option>
                                                @foreach($jenisSurat as $jenis)
                                                    <option value="{{ $jenis }}" {{ old('jenis_surat', $suratMasuk->jenis_surat) === $jenis ? 'selected' : '' }}>
                                                        {{ $jenis }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <i data-lucide="chevron-down" class="w-4 h-4 text-[#64748B] absolute right-3.5 top-[16px] pointer-events-none"></i>
                                        </div>
                                        @error('jenis_surat')
                                            <p class="text-[#EF4444] text-xs mt-1.5 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-[13px] font-semibold text-[#0F172A] mb-2">
                                            Tingkat Urgensi <span class="text-[#EF4444]">*</span>
                                        </label>
                                        <div class="flex gap-2 p-1 bg-[#F1F5F9] rounded-xl border border-[#E2E8F0] w-max">
                                            @foreach(['normal' => 'Biasa', 'segera' => 'Segera', 'sangat_segera' => 'Penting'] as $val => $label)
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="tingkat_urgensi" value="{{ $val }}" class="hidden peer" {{ old('tingkat_urgensi', $suratMasuk->tingkat_urgensi) === $val ? 'checked' : '' }}>
                                                    <div class="px-4 py-1.5 rounded-lg text-[13px] font-medium text-[#64748B] peer-checked:bg-white peer-checked:text-[#4338CA] peer-checked:shadow-sm transition-all">
                                                        {{ $label }}
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                        @error('tingkat_urgensi')
                                            <p class="text-[#EF4444] text-xs mt-1.5 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Baris 5: Sifat Rahasia --}}
                                <div class="pt-2">
                                    <label class="flex items-center gap-3 cursor-pointer group w-max">
                                        <div class="relative flex items-center justify-center">
                                            <input type="checkbox" name="is_rahasia" value="1" {{ old('is_rahasia', $suratMasuk->is_rahasia) ? 'checked' : '' }}
                                                   class="w-5 h-5 rounded-[6px] border-[#CBD5E1] text-[#4338CA] focus:ring-[#4338CA]/20 transition-all cursor-pointer">
                                        </div>
                                        <div>
                                            <span class="text-[14px] font-semibold text-[#0F172A] group-hover:text-[#4338CA] transition-colors">Tandai sebagai Surat Rahasia</span>
                                            <p class="text-[12px] text-[#64748B]">Hanya role tertentu yang bisa melihat lampiran.</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- ========== KOLOM KANAN (Lampiran & Metadata) ========== --}}
                    <div class="space-y-6">

                        {{-- Card: Upload Lampiran --}}
                        <div class="card-enterprise-lg p-6">
                            <h3 class="text-[14px] font-bold text-[#0F172A] mb-4 flex items-center gap-2">
                                <i data-lucide="paperclip" class="w-[18px] h-[18px] text-[#4338CA]"></i> Dokumen Lampiran
                            </h3>

                            @if($suratMasuk->file_surat)
                                <div class="mb-4 p-3 bg-[#EEF2FF] border border-[#C7D2FE] rounded-xl flex items-start gap-3">
                                    <div class="p-2 bg-white rounded-lg shrink-0">
                                        <i data-lucide="file-check" class="w-5 h-5 text-[#4338CA]"></i>
                                    </div>
                                    <div>
                                        <p class="text-[12px] font-bold text-[#4338CA] uppercase tracking-wider mb-0.5">File Saat Ini</p>
                                        <a href="{{ Storage::url($suratMasuk->file_surat) }}" target="_blank" class="text-[13px] font-medium text-[#0F172A] hover:underline break-all">
                                            {{ basename($suratMasuk->file_surat) }}
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <div class="relative border-2 border-dashed border-[#CBD5E1] rounded-2xl p-6 text-center hover:border-[#4338CA] hover:bg-[#EEF2FF] transition-colors group">
                                <input type="file" name="file_surat" id="file_surat" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept=".pdf,.jpg,.jpeg,.png">
                                
                                <div class="flex flex-col items-center justify-center gap-2 relative z-0">
                                    <div class="w-12 h-12 bg-[#F1F5F9] group-hover:bg-white rounded-full flex items-center justify-center transition-colors">
                                        <i data-lucide="upload-cloud" class="w-6 h-6 text-[#64748B] group-hover:text-[#4338CA]"></i>
                                    </div>
                                    <div>
                                        <p class="text-[13px] font-semibold text-[#0F172A]">Ganti File (Opsional)</p>
                                        <p class="text-[12px] text-[#64748B] mt-0.5">Drag & drop atau klik di sini</p>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Preview File Selected --}}
                            <div id="file-preview" class="mt-4 hidden items-center gap-3 p-3 bg-[#F8FAFC] border border-[#E2E8F0] rounded-xl">
                                <div class="w-8 h-8 bg-white border border-[#E2E8F0] rounded flex items-center justify-center shrink-0">
                                    <i data-lucide="file-plus" class="w-4 h-4 text-[#10B981]"></i>
                                </div>
                                <div>
                                    <p class="text-[11px] font-bold text-[#10B981] uppercase tracking-wider">File Baru</p>
                                    <p id="file-name" class="text-[13px] font-medium text-[#0F172A] truncate"></p>
                                </div>
                            </div>

                            @error('file_surat')
                                <p class="text-[#EF4444] text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Card: Metadata / Info --}}
                        <div class="card-enterprise-lg p-6">
                            <h3 class="text-[14px] font-bold text-[#0F172A] mb-4 flex items-center gap-2">
                                <i data-lucide="info" class="w-[18px] h-[18px] text-[#4338CA]"></i> Metadata Surat
                            </h3>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-[11px] font-bold text-[#94A3B8] uppercase tracking-wider mb-1">
                                        Tanggal Diterima
                                    </label>
                                    <input type="date" name="tanggal_diterima" value="{{ old('tanggal_diterima', $suratMasuk->tanggal_diterima->format('Y-m-d')) }}"
                                           class="input-enterprise w-full bg-[#F8FAFC]">
                                    @error('tanggal_diterima')
                                        <p class="text-[#EF4444] text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <p class="block text-[11px] font-bold text-[#94A3B8] uppercase tracking-wider mb-1.5">
                                        No. Agenda
                                    </p>
                                    <p class="text-[14px] font-mono font-medium text-[#0F172A]">{{ $suratMasuk->nomor_agenda }}</p>
                                </div>

                                <div>
                                    <p class="block text-[11px] font-bold text-[#94A3B8] uppercase tracking-wider mb-1.5">
                                        Status Saat Ini
                                    </p>
                                    <x-badge :type="$suratMasuk->status" />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>

    <script>
        document.getElementById('file_surat').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            const preview = document.getElementById('file-preview');
            const nameEl = document.getElementById('file-name');
            
            if (fileName) {
                nameEl.textContent = fileName;
                preview.classList.remove('hidden');
                preview.classList.add('flex');
            } else {
                preview.classList.add('hidden');
                preview.classList.remove('flex');
            }
        });
    </script>
</x-app-layout>
