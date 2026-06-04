<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Page Header Component --}}
            <x-page-header 
                title="Dashboard Overview" 
                subtitle="Ringkasan aktivitas surat menyurat Universitas Alifah."
            >
                <x-slot:actions>
                    <a href="{{ route('admin.surat-masuk.create') }}" class="btn-primary">
                        <i data-lucide="plus" class="w-4 h-4"></i> Registrasi Surat
                    </a>
                </x-slot:actions>
            </x-page-header>

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="mb-6 flex items-center gap-3 bg-[#D1FAE5] border border-[#A7F3D0] text-[#065F46] text-[13px] px-4 py-3 rounded-xl font-medium">
                    <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- ========== 4 STAT CARDS ========== --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

                {{-- Card 1: Total Surat Masuk --}}
                <div class="card-enterprise p-5 relative overflow-hidden group">
                    <div class="flex items-start justify-between relative z-10">
                        <div>
                            <p class="text-[13px] font-semibold text-[#64748B] uppercase tracking-wide mb-1">Total Surat Masuk</p>
                            <p class="text-3xl font-bold text-[#0F172A]">{{ number_format($stats['total']) }}</p>
                        </div>
                        <div class="w-10 h-10 bg-[#EEF2FF] text-[#4338CA] rounded-xl flex items-center justify-center shrink-0">
                            <i data-lucide="inbox" class="w-5 h-5"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-1.5 text-[12px] font-medium text-[#10B981] relative z-10">
                        <i data-lucide="trending-up" class="w-3.5 h-3.5"></i>
                        <span>+{{ $stats['hari_ini'] }} ditambahkan hari ini</span>
                    </div>
                    <!-- Decorative background -->
                    <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-[#EEF2FF] rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 z-0"></div>
                </div>

                {{-- Card 2: Menunggu Diproses --}}
                @php
                    $menungguProses = $stats['draft'] + $stats['dikembalikan'];
                @endphp
                <div class="card-enterprise p-5 relative overflow-hidden group">
                    <div class="flex items-start justify-between relative z-10">
                        <div>
                            <p class="text-[13px] font-semibold text-[#64748B] uppercase tracking-wide mb-1">Menunggu Diproses</p>
                            <p class="text-3xl font-bold text-[#0F172A]">{{ $menungguProses }}</p>
                        </div>
                        <div class="w-10 h-10 {{ $menungguProses > 0 ? 'bg-[#FEF3C7] text-[#B45309]' : 'bg-[#F8FAFC] text-[#64748B]' }} rounded-xl flex items-center justify-center shrink-0">
                            <i data-lucide="clock" class="w-5 h-5"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-1.5 text-[12px] font-medium {{ $stats['dikembalikan'] > 0 ? 'text-[#EF4444]' : 'text-[#64748B]' }} relative z-10">
                        @if($stats['dikembalikan'] > 0)
                            <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                            <span>{{ $stats['dikembalikan'] }} butuh revisi</span>
                        @else
                            <i data-lucide="check" class="w-3.5 h-3.5"></i>
                            <span>Semua terpantau baik</span>
                        @endif
                    </div>
                </div>

                {{-- Card 3: Menunggu Persetujuan --}}
                @php
                    $diteruskan = $stats['menunggu_warek'] + $stats['menunggu_rektor'];
                @endphp
                <div class="card-enterprise p-5 relative overflow-hidden group">
                    <div class="flex items-start justify-between relative z-10">
                        <div>
                            <p class="text-[13px] font-semibold text-[#64748B] uppercase tracking-wide mb-1">Dlm Persetujuan</p>
                            <p class="text-3xl font-bold text-[#0F172A]">{{ $diteruskan }}</p>
                        </div>
                        <div class="w-10 h-10 bg-[#F3E8FF] text-[#7E22CE] rounded-xl flex items-center justify-center shrink-0">
                            <i data-lucide="users" class="w-5 h-5"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-1.5 text-[12px] font-medium text-[#64748B] relative z-10">
                        <i data-lucide="info" class="w-3.5 h-3.5"></i>
                        <span>Di Warek ({{ $stats['menunggu_warek'] }}), Rektor ({{ $stats['menunggu_rektor'] }})</span>
                    </div>
                </div>

                {{-- Card 4: Arsip / Selesai --}}
                <div class="card-enterprise p-5 relative overflow-hidden group">
                    <div class="flex items-start justify-between relative z-10">
                        <div>
                            <p class="text-[13px] font-semibold text-[#64748B] uppercase tracking-wide mb-1">Surat Selesai</p>
                            <p class="text-3xl font-bold text-[#0F172A]">{{ number_format($stats['selesai']) }}</p>
                        </div>
                        <div class="w-10 h-10 bg-[#D1FAE5] text-[#059669] rounded-xl flex items-center justify-center shrink-0">
                            <i data-lucide="check-square" class="w-5 h-5"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-1.5 text-[12px] font-medium text-[#10B981] relative z-10">
                        @if($stats['total'] > 0)
                            <i data-lucide="pie-chart" class="w-3.5 h-3.5"></i>
                            <span>{{ round(($stats['selesai'] / $stats['total']) * 100) }}% completion rate</span>
                        @else
                            <i data-lucide="minus" class="w-3.5 h-3.5"></i>
                            <span>Belum ada data</span>
                        @endif
                    </div>
                </div>

            </div>

            {{-- ========== TABEL 5 SURAT TERBARU ========== --}}
            <div class="table-card">
                <div class="px-5 py-4 flex items-center justify-between">
                    <div>
                        <h3 class="text-[15px] font-bold text-[#0F172A]">Aktivitas Surat Terbaru</h3>
                        <p class="text-[13px] text-[#64748B] mt-0.5">5 surat terakhir yang Anda daftarkan.</p>
                    </div>
                    <a href="{{ route('admin.surat-masuk.index') }}" class="btn-secondary h-9 px-4 text-xs">
                        Lihat Semua
                    </a>
                </div>

                @if($suratTerbaru->isEmpty())
                    <x-empty-state 
                        icon="inbox" 
                        title="Belum ada surat" 
                        description="Anda belum mendaftarkan surat apapun ke dalam sistem."
                    >
                        <x-slot:action>
                            <a href="{{ route('admin.surat-masuk.create') }}" class="btn-primary">
                                <i data-lucide="plus" class="w-4 h-4"></i> Registrasi Surat
                            </a>
                        </x-slot:action>
                    </x-empty-state>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left table-enterprise">
                            <thead>
                                <tr>
                                    <th>Nomor Surat</th>
                                    <th>Asal Surat</th>
                                    <th>Perihal</th>
                                    <th>Status</th>
                                    <th class="text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suratTerbaru as $surat)
                                    <tr>
                                        <td class="font-medium text-[#0F172A] whitespace-nowrap">{{ $surat->nomor_surat }}</td>
                                        <td class="text-[#475569] whitespace-nowrap">{{ Str::limit($surat->asal_surat, 30) }}</td>
                                        <td class="text-[#475569] min-w-[200px]">{{ Str::limit($surat->perihal, 50) }}</td>
                                        <td class="whitespace-nowrap">
                                            <x-badge :type="$surat->status" />
                                        </td>
                                        <td class="text-right whitespace-nowrap">
                                            <a href="{{ route('admin.surat-masuk.show', $surat) }}" 
                                               class="inline-flex items-center justify-center p-2 rounded-lg text-[#64748B] hover:text-[#4338CA] hover:bg-[#EEF2FF] transition-colors" title="Lihat Detail">
                                                <i data-lucide="eye" class="w-[18px] h-[18px]"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
