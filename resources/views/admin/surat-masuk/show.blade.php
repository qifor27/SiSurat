<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="flex items-center text-[13px] text-[#64748B] mb-4 font-medium">
                <a href="{{ route('admin.surat-masuk.index') }}" class="hover:text-[#4338CA] transition-colors">Surat Masuk</a>
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
                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <a href="{{ route('admin.surat-masuk.index') }}" class="btn-secondary">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
                    </a>
                    
                    @if($suratMasuk->status === 'draft' || $suratMasuk->status === 'dikembalikan')
                        <a href="{{ route('admin.surat-masuk.edit', $suratMasuk) }}" class="btn-secondary">
                            <i data-lucide="edit-2" class="w-4 h-4"></i> Edit
                        </a>
                        
                        <form action="{{ route('admin.surat-masuk.ajukan', $suratMasuk) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-primary" onclick="return confirm('Kirim surat ini untuk direview oleh Wakil Rektor?')">
                                <i data-lucide="send" class="w-4 h-4"></i> Ajukan Review
                            </button>
                        </form>
                    @endif
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

                    {{-- Catatan Warek & Rektor (Jika ada) --}}
                    @if($suratMasuk->catatan_warek || $suratMasuk->catatan_rektor)
                        <div class="card-enterprise-lg p-6 sm:p-8">
                            <h3 class="text-base font-bold text-[#0F172A] mb-6 flex items-center gap-2 border-b border-[#F1F5F9] pb-4">
                                <i data-lucide="message-square" class="w-5 h-5 text-[#4338CA]"></i> Catatan Pimpinan
                            </h3>

                            <div class="space-y-6">
                                @if($suratMasuk->catatan_warek)
                                    <div>
                                        <p class="text-[11px] font-bold text-[#94A3B8] uppercase tracking-wider mb-2">Catatan Wakil Rektor</p>
                                        <div class="bg-[#FEF3C7] border border-[#FDE68A] p-4 rounded-xl relative">
                                            <i data-lucide="quote" class="absolute top-4 right-4 w-8 h-8 text-[#F59E0B] opacity-20"></i>
                                            <p class="text-[14px] text-[#92400E] leading-relaxed whitespace-pre-wrap relative z-10">{{ $suratMasuk->catatan_warek }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if($suratMasuk->catatan_rektor)
                                    <div>
                                        <p class="text-[11px] font-bold text-[#94A3B8] uppercase tracking-wider mb-2">Keputusan / Catatan Rektor</p>
                                        <div class="bg-[#EEF2FF] border border-[#C7D2FE] p-4 rounded-xl relative">
                                            <i data-lucide="quote" class="absolute top-4 right-4 w-8 h-8 text-[#4338CA] opacity-10"></i>
                                            <p class="text-[14px] text-[#3730A3] leading-relaxed whitespace-pre-wrap relative z-10">{{ $suratMasuk->catatan_rektor }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Disposisi Surat --}}
                    @if($suratMasuk->status === 'selesai' && $suratMasuk->disposisis->count() > 0)
                        <div class="card-enterprise-lg p-6 sm:p-8">
                            <h3 class="text-base font-bold text-[#0F172A] mb-6 flex items-center gap-2 border-b border-[#F1F5F9] pb-4">
                                <i data-lucide="share-2" class="w-5 h-5 text-[#4338CA]"></i> Riwayat Disposisi
                            </h3>
                            
                            <div class="space-y-4">
                                @foreach($suratMasuk->disposisis as $disposisi)
                                    <div class="border border-[#E2E8F0] rounded-xl p-4 bg-white flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                <i data-lucide="corner-down-right" class="w-4 h-4 text-[#94A3B8]"></i>
                                                <p class="text-[14px] font-bold text-[#0F172A]">{{ $disposisi->tujuanBagian->name }}</p>
                                            </div>
                                            <p class="text-[13px] text-[#475569] mt-2 whitespace-pre-wrap pl-6 border-l-2 border-[#E2E8F0] ml-2">{{ $disposisi->instruksi }}</p>
                                        </div>
                                        <div class="shrink-0 flex items-center gap-2">
                                            <x-badge :type="$disposisi->status" />
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

                {{-- KOLOM KANAN (Sidebar Status & Dokumen) --}}
                <div class="space-y-6">

                    {{-- Card: Status & Metadata --}}
                    <div class="card-enterprise-lg p-6">
                        <h3 class="text-[14px] font-bold text-[#0F172A] mb-5 flex items-center gap-2">
                            <i data-lucide="activity" class="w-[18px] h-[18px] text-[#4338CA]"></i> Status Surat
                        </h3>

                        <div class="space-y-5">
                            <div>
                                <p class="text-[11px] font-bold text-[#94A3B8] uppercase tracking-wider mb-2">Status Saat Ini</p>
                                <x-badge :type="$suratMasuk->status" />
                            </div>
                            
                            <hr class="border-[#F1F5F9]">

                            <div>
                                <p class="text-[11px] font-bold text-[#94A3B8] uppercase tracking-wider mb-1">No. Agenda Sistem</p>
                                <p class="text-[13px] font-mono font-bold text-[#0F172A]">{{ $suratMasuk->nomor_agenda }}</p>
                            </div>

                            <div>
                                <p class="text-[11px] font-bold text-[#94A3B8] uppercase tracking-wider mb-1">Tanggal Diterima</p>
                                <p class="text-[13px] font-medium text-[#0F172A]">{{ $suratMasuk->tanggal_diterima->translatedFormat('d F Y') }}</p>
                            </div>

                            <div>
                                <p class="text-[11px] font-bold text-[#94A3B8] uppercase tracking-wider mb-1.5">Diregistrasi Oleh</p>
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
                            @if($suratMasuk->is_rahasia && !auth()->user()->hasRole(['admin', 'rektor', 'wakil_rektor']))
                                <div class="bg-[#FEE2E2] border border-[#FECACA] rounded-xl p-4 text-center">
                                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center mx-auto mb-2 shadow-sm">
                                        <i data-lucide="lock" class="w-5 h-5 text-[#EF4444]"></i>
                                    </div>
                                    <p class="text-[12px] font-bold text-[#991B1B] uppercase tracking-wider">Dokumen Rahasia</p>
                                    <p class="text-[11px] text-[#B91C1C] mt-1">Anda tidak memiliki akses untuk melihat dokumen ini.</p>
                                </div>
                            @else
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
                            @endif
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
