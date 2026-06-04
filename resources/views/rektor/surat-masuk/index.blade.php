<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <x-page-header 
                title="Persetujuan Surat Masuk" 
                subtitle="Daftar surat yang menunggu keputusan akhir dari Anda."
            />

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mb-6 flex items-center gap-3 bg-[#D1FAE5] border border-[#A7F3D0] text-[#065F46] text-[13px] px-4 py-3 rounded-xl font-medium">
                    <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tabel Card --}}
            <div class="table-card">
                
                {{-- Toolbar: Search & Filter --}}
                <div class="px-5 py-4 border-b border-[#F1F5F9] bg-white">
                    <h3 class="text-[15px] font-bold text-[#0F172A]">Daftar Antrean Persetujuan</h3>
                </div>

                {{-- Table Data --}}
                @if($suratMasuk->isEmpty())
                    <x-empty-state 
                        icon="shield-check" 
                        title="Tidak ada antrean persetujuan" 
                        description="Semua surat telah mendapatkan keputusan akhir dari Anda."
                    />
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left table-enterprise">
                            <thead>
                                <tr>
                                    <th>Info Surat</th>
                                    <th>Asal Surat</th>
                                    <th>Perihal</th>
                                    <th>Status / Urgensi</th>
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
                                        <td class="text-right whitespace-nowrap">
                                            <a href="{{ route('rektor.surat-masuk.show', $surat) }}" 
                                               class="btn-primary h-8 px-4 text-[12px]">
                                                Tinjau
                                            </a>
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
