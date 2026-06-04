<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <x-page-header 
                title="Daftar Surat Masuk" 
                subtitle="Kelola seluruh surat masuk yang terdaftar di dalam sistem."
            >
                <x-slot:actions>
                    <a href="{{ route('admin.surat-masuk.create') }}" class="btn-primary">
                        <i data-lucide="plus" class="w-4 h-4"></i> Registrasi Surat Baru
                    </a>
                </x-slot:actions>
            </x-page-header>

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mb-6 flex items-center gap-3 bg-[#D1FAE5] border border-[#A7F3D0] text-[#065F46] text-[13px] px-4 py-3 rounded-xl font-medium">
                    <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 flex items-center gap-3 bg-[#FEE2E2] border border-[#FECACA] text-[#991B1B] text-[13px] px-4 py-3 rounded-xl font-medium">
                    <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Tabel Card --}}
            <div class="table-card">
                
                {{-- Toolbar: Search & Filter --}}
                <form method="GET" action="{{ route('admin.surat-masuk.index') }}" 
                      class="px-5 py-4 border-b border-[#F1F5F9] flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white">
                    
                    {{-- Search Input --}}
                    <div class="relative w-full max-w-sm">
                        <i data-lucide="search" class="w-4 h-4 text-[#94A3B8] absolute left-3.5 top-3"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari nomor, pengirim, perihal..."
                               class="w-full bg-white border border-[#E2E8F0] text-[13px] rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:border-[#4338CA] focus:ring-4 focus:ring-[#4338CA]/10 transition-all font-sans text-[#0F172A] placeholder:text-[#94A3B8]">
                    </div>

                    {{-- Filters --}}
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <div class="relative flex-1 sm:flex-none">
                            <select name="status" 
                                    onchange="this.form.submit()"
                                    class="w-full sm:w-48 bg-white border border-[#E2E8F0] text-[13px] rounded-lg pl-3 pr-8 py-2 focus:outline-none focus:border-[#4338CA] focus:ring-4 focus:ring-[#4338CA]/10 transition-all font-sans text-[#0F172A] appearance-none cursor-pointer">
                                <option value="">Semua Status</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="menunggu_warek" {{ request('status') == 'menunggu_warek' ? 'selected' : '' }}>Menunggu Warek</option>
                                <option value="menunggu_rektor" {{ request('status') == 'menunggu_rektor' ? 'selected' : '' }}>Menunggu Rektor</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                            </select>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-[#94A3B8] absolute right-3 top-2.5 pointer-events-none"></i>
                        </div>

                        <button type="submit" class="btn-secondary h-9 px-3 shrink-0" title="Cari">
                            <i data-lucide="filter" class="w-4 h-4"></i>
                        </button>

                        @if(request('search') || request('status'))
                            <a href="{{ route('admin.surat-masuk.index') }}" 
                               class="text-[#EF4444] hover:text-[#991B1B] p-2 hover:bg-[#FEE2E2] rounded-lg transition-colors" title="Reset Filter">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </a>
                        @endif
                    </div>
                </form>

                {{-- Table Data --}}
                @if($suratMasuk->isEmpty())
                    <x-empty-state 
                        icon="inbox" 
                        title="Tidak ada surat masuk" 
                        description="Belum ada data surat masuk yang terdaftar atau sesuai dengan filter pencarian Anda."
                    />
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left table-enterprise">
                            <thead>
                                <tr>
                                    <th>Info Surat</th>
                                    <th>Asal Surat</th>
                                    <th>Perihal</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th class="text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suratMasuk as $surat)
                                    <tr>
                                        <td class="whitespace-nowrap">
                                            <p class="font-medium text-[#0F172A] mb-0.5">{{ $surat->nomor_surat }}</p>
                                            <div class="flex items-center gap-2">
                                                <span class="text-[11px] font-mono text-[#64748B] bg-[#F8FAFC] px-1.5 py-0.5 rounded border border-[#E2E8F0]">
                                                    {{ $surat->nomor_agenda ?? '—' }}
                                                </span>
                                                @if($surat->is_rahasia)
                                                    <span class="text-[10px] font-bold text-[#EF4444] bg-[#FEE2E2] px-1.5 py-0.5 rounded tracking-wider">RAHASIA</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-[#0F172A] font-medium min-w-[150px]">{{ $surat->asal_surat }}</td>
                                        <td class="text-[#475569] min-w-[200px]">{{ Str::limit($surat->perihal, 60) }}</td>
                                        <td class="whitespace-nowrap">
                                            <div class="flex flex-col items-start gap-1.5">
                                                <x-badge :type="$surat->status" />
                                                @if($surat->tingkat_urgensi !== 'normal')
                                                    <x-badge :type="$surat->tingkat_urgensi" />
                                                @endif
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap text-[#64748B]">
                                            <p>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d M Y') }}</p>
                                        </td>
                                        <td class="text-right whitespace-nowrap">
                                            <div class="flex items-center justify-end gap-2">
                                                @if($surat->status === 'draft' || $surat->status === 'dikembalikan')
                                                    <a href="{{ route('admin.surat-masuk.edit', $surat) }}" 
                                                       class="p-2 rounded-lg text-[#64748B] hover:text-[#4338CA] hover:bg-[#EEF2FF] transition-colors" title="Edit Surat">
                                                        <i data-lucide="edit-2" class="w-4 h-4"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ route('admin.surat-masuk.show', $surat) }}" 
                                                   class="p-2 rounded-lg text-[#64748B] hover:text-[#4338CA] hover:bg-[#EEF2FF] transition-colors" title="Lihat Detail">
                                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($suratMasuk->hasPages())
                        <div class="px-5 py-4 border-t border-[#F1F5F9] bg-[#F8FAFC]">
                            {{ $suratMasuk->links() }}
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
