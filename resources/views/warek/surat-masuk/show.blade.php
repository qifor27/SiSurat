<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="flex items-center text-[13px] text-[#64748B] mb-4 font-medium">
                <a href="{{ route('warek.surat-masuk.index') }}" class="hover:text-[#4338CA] transition-colors">Review Surat</a>
                <i data-lucide="chevron-right" class="w-4 h-4 mx-1"></i>
                <span class="text-[#0F172A]">{{ $suratMasuk->nomor_surat }}</span>
            </nav>

            {{-- Header & Actions --}}
            <div class="mb-6 flex flex-col md:flex-row md:items-start justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <h1 class="text-2xl font-bold text-[#0F172A] leading-tight">{{ $suratMasuk->perihal }}</h1>
                        @if($suratMasuk->is_rahasia)
                            <span class="text-[10px] font-bold text-[#EF4444] bg-[#FEE2E2] px-2 py-0.5 rounded tracking-wider shrink-0 mt-1">RAHASIA</span>
                        @endif
                    </div>
                    <p class="text-[14px] text-[#64748B]">Dari: <span class="font-medium text-[#0F172A]">{{ $suratMasuk->asal_surat }}</span></p>
                </div>
                <div class="shrink-0">
                    <a href="{{ route('warek.surat-masuk.index') }}" class="btn-secondary">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
                    </a>
                </div>
            </div>

            {{-- Layout 2 Kolom --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- KOLOM KIRI (Informasi Utama) --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Informasi Surat --}}
                    <div class="card-enterprise-lg p-6 sm:p-8">
                        <h3 class="text-base font-bold text-[#0F172A] mb-6 flex items-center gap-2 border-b border-[#F1F5F9] pb-4">
                            <i data-lucide="file-text" class="w-5 h-5 text-[#4338CA]"></i> Detail Informasi Surat
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <p class="text-[11px] font-bold text-[#94A3B8] uppercase tracking-wider mb-1">Nomor Surat</p>
                                <p class="text-[14px] font-medium text-[#0F172A]">{{ $suratMasuk->nomor_surat }}</p>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-[#94A3B8] uppercase tracking-wider mb-1">Tanggal Surat</p>
                                <p class="text-[14px] font-medium text-[#0F172A]">{{ $suratMasuk->tanggal_surat->translatedFormat('d F Y') }}</p>
                            </div>
                            
                            <div>
                                <p class="text-[11px] font-bold text-[#94A3B8] uppercase tracking-wider mb-1">Jenis Surat</p>
                                <p class="text-[14px] font-medium text-[#0F172A]">{{ $suratMasuk->jenis_surat }}</p>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-[#94A3B8] uppercase tracking-wider mb-1">Tingkat Urgensi</p>
                                <div class="mt-1">
                                    <x-badge :type="$suratMasuk->tingkat_urgensi" />
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <p class="text-[11px] font-bold text-[#94A3B8] uppercase tracking-wider mb-1">Isi / Perihal</p>
                                <div class="bg-[#F8FAFC] p-4 rounded-xl border border-[#E2E8F0] mt-1">
                                    <p class="text-[14px] text-[#334155] leading-relaxed whitespace-pre-wrap">{{ $suratMasuk->perihal }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Form Tindakan Warek --}}
                    @if($suratMasuk->status === 'menunggu_warek')
                        <div class="card-enterprise-lg p-6 sm:p-8 bg-white border-2 border-[#4338CA]/20 shadow-lg shadow-[#4338CA]/5">
                            <h3 class="text-base font-bold text-[#0F172A] mb-6 flex items-center gap-2 border-b border-[#F1F5F9] pb-4">
                                <i data-lucide="edit-3" class="w-5 h-5 text-[#4338CA]"></i> Tindakan Wakil Rektor
                            </h3>

                            <form method="POST">
                                @csrf
                                @method('PATCH')
                                
                                <div class="mb-6">
                                    <label class="block text-[13px] font-semibold text-[#0F172A] mb-2">
                                        Catatan / Instruksi (Opsional)
                                    </label>
                                    <textarea name="catatan_warek" rows="4" 
                                              class="w-full border border-[#CBD5E1] rounded-xl px-4 py-3 text-[14px] text-[#0F172A] focus:outline-none focus:border-[#4338CA] focus:ring-4 focus:ring-[#4338CA]/10 transition-all font-sans resize-y"
                                              placeholder="Berikan catatan tambahan untuk Rektor jika surat disetujui, atau alasan revisi jika dikembalikan...">{{ old('catatan_warek') }}</textarea>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-3">
                                    <button type="submit" formaction="{{ route('warek.surat-masuk.teruskan', $suratMasuk) }}" 
                                            class="flex-1 btn-primary bg-[#10B981] hover:bg-[#059669]">
                                        <i data-lucide="check-circle" class="w-4 h-4"></i> Teruskan ke Rektor
                                    </button>
                                    <button type="submit" formaction="{{ route('warek.surat-masuk.kembalikan', $suratMasuk) }}" 
                                            class="flex-1 btn-secondary text-[#EF4444] hover:bg-[#FEE2E2] hover:border-[#FEE2E2]">
                                        <i data-lucide="x-circle" class="w-4 h-4"></i> Kembalikan ke Admin
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif

                </div>

                {{-- KOLOM KANAN (Sidebar Dokumen) --}}
                <div class="space-y-6">

                    {{-- Card: Status & Metadata --}}
                    <div class="card-enterprise-lg p-6">
                        <h3 class="text-[14px] font-bold text-[#0F172A] mb-5 flex items-center gap-2">
                            <i data-lucide="activity" class="w-[18px] h-[18px] text-[#4338CA]"></i> Status Saat Ini
                        </h3>

                        <div class="space-y-5">
                            <div>
                                <x-badge :type="$suratMasuk->status" />
                            </div>
                            
                            <hr class="border-[#F1F5F9]">

                            <div>
                                <p class="text-[11px] font-bold text-[#94A3B8] uppercase tracking-wider mb-1">No. Agenda Sistem</p>
                                <p class="text-[13px] font-mono font-bold text-[#0F172A]">{{ $suratMasuk->nomor_agenda }}</p>
                            </div>

                            <div>
                                <p class="text-[11px] font-bold text-[#94A3B8] uppercase tracking-wider mb-1.5">Diregistrasi Oleh Admin</p>
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded bg-[#E2E8F0] text-[#475569] flex items-center justify-center text-[10px] font-bold">
                                        {{ strtoupper(substr($suratMasuk->pembuat->name, 0, 2)) }}
                                    </div>
                                    <p class="text-[13px] font-medium text-[#0F172A]">{{ $suratMasuk->pembuat->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Card: Dokumen Lampiran --}}
                    <div class="card-enterprise-lg p-6">
                        <h3 class="text-[14px] font-bold text-[#0F172A] mb-4 flex items-center gap-2">
                            <i data-lucide="paperclip" class="w-[18px] h-[18px] text-[#4338CA]"></i> Lampiran
                        </h3>

                        @if($suratMasuk->file_surat)
                            <div class="bg-[#F8FAFC] border border-[#E2E8F0] rounded-xl p-3 flex items-center gap-3 group hover:border-[#4338CA] hover:bg-[#EEF2FF] transition-all cursor-pointer"
                                 onclick="window.open('{{ Storage::url($suratMasuk->file_surat) }}', '_blank')">
                                <div class="p-2.5 bg-white border border-[#E2E8F0] rounded-lg group-hover:border-[#C7D2FE] group-hover:text-[#4338CA] transition-colors shrink-0">
                                    <i data-lucide="file-text" class="w-5 h-5"></i>
                                </div>
                                <div class="flex-1 overflow-hidden">
                                    <p class="text-[13px] font-semibold text-[#0F172A] truncate group-hover:text-[#4338CA] transition-colors">{{ basename($suratMasuk->file_surat) }}</p>
                                    <p class="text-[11px] text-[#64748B]">Klik untuk melihat file</p>
                                </div>
                                <i data-lucide="external-link" class="w-4 h-4 text-[#94A3B8] group-hover:text-[#4338CA] shrink-0 mr-1"></i>
                            </div>
                        @else
                            <div class="text-center py-6 border-2 border-dashed border-[#E2E8F0] rounded-xl bg-[#F8FAFC]">
                                <i data-lucide="file-x" class="w-8 h-8 text-[#94A3B8] mx-auto mb-2"></i>
                                <p class="text-[13px] font-medium text-[#64748B]">Tidak ada lampiran</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
