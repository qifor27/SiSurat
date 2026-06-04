<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Page Header Component --}}
            <x-page-header 
                title="Dashboard Wakil Rektor" 
                subtitle="Selamat datang kembali, {{ auth()->user()->name }}."
            />

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="mb-6 flex items-center gap-3 bg-[#D1FAE5] border border-[#A7F3D0] text-[#065F46] text-[13px] px-4 py-3 rounded-xl font-medium">
                    <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- ========== STAT CARDS ========== --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

                {{-- Card: Menunggu Review --}}
                <div class="card-enterprise p-6 relative overflow-hidden group border-l-4 {{ $jumlahMenunggu > 0 ? 'border-l-[#F59E0B]' : 'border-l-[#10B981]' }}">
                    <div class="flex items-start justify-between relative z-10">
                        <div>
                            <p class="text-[13px] font-semibold text-[#64748B] uppercase tracking-wide mb-1">Surat Perlu Direview</p>
                            <p class="text-4xl font-bold text-[#0F172A]">{{ $jumlahMenunggu }}</p>
                        </div>
                        <div class="w-12 h-12 {{ $jumlahMenunggu > 0 ? 'bg-[#FEF3C7] text-[#B45309]' : 'bg-[#F8FAFC] text-[#64748B]' }} rounded-2xl flex items-center justify-center shrink-0 shadow-sm">
                            <i data-lucide="bell-ring" class="w-6 h-6"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-1.5 text-[12px] font-medium {{ $jumlahMenunggu > 0 ? 'text-[#B45309]' : 'text-[#64748B]' }} relative z-10">
                        @if($jumlahMenunggu > 0)
                            <i data-lucide="alert-circle" class="w-4 h-4"></i>
                            <span>Butuh tindakan (review) dari Anda</span>
                        @else
                            <i data-lucide="check" class="w-4 h-4 text-[#10B981]"></i>
                            <span class="text-[#10B981]">Semua surat sudah ditindaklanjuti</span>
                        @endif
                    </div>
                </div>

            </div>

            {{-- ========== TABEL 5 SURAT TERBARU ========== --}}
            <div class="table-card">
                <div class="px-6 py-5 flex items-center justify-between border-b border-[#F1F5F9]">
                    <div>
                        <h3 class="text-[15px] font-bold text-[#0F172A]">Menunggu Review</h3>
                        <p class="text-[13px] text-[#64748B] mt-0.5">Surat masuk yang belum Anda periksa.</p>
                    </div>
                    <a href="{{ route('warek.surat-masuk.index') }}" class="btn-secondary h-9 px-4 text-xs">
                        Lihat Semua
                    </a>
                </div>

                @if($suratTerbaru->isEmpty())
                    <x-empty-state 
                        icon="check-circle" 
                        title="Tidak ada antrean" 
                        description="Semua surat masuk telah Anda review. Tidak ada tugas pending saat ini."
                    />
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left table-enterprise">
                            <thead>
                                <tr>
                                    <th>No. Agenda</th>
                                    <th>Asal Surat</th>
                                    <th>Perihal</th>
                                    <th>Urgensi</th>
                                    <th class="text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suratTerbaru as $surat)
                                    <tr>
                                        <td class="font-mono text-[#64748B] whitespace-nowrap text-xs">{{ $surat->nomor_agenda }}</td>
                                        <td class="font-medium text-[#0F172A] whitespace-nowrap">{{ Str::limit($surat->asal_surat, 30) }}</td>
                                        <td class="text-[#475569] min-w-[200px]">{{ Str::limit($surat->perihal, 50) }}</td>
                                        <td class="whitespace-nowrap">
                                            <x-badge :type="$surat->tingkat_urgensi" />
                                        </td>
                                        <td class="text-right whitespace-nowrap">
                                            <a href="{{ route('warek.surat-masuk.show', $surat) }}" 
                                               class="btn-primary h-8 px-3 text-xs bg-[#4338CA] hover:bg-[#3730A3]">
                                                Review
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
