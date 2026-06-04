<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Page Header Component --}}
            <x-page-header 
                title="Dashboard Bagian/Unit" 
                subtitle="Selamat datang di panel kelola surat disposisi untuk bagian {{ auth()->user()->name }}."
            />

            {{-- ========== STAT CARDS (Placeholder untuk sprint berikutnya) ========== --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                <x-stat-card 
                    title="Surat Baru" 
                    value="0" 
                    icon="inbox" 
                    color="blue"
                />
                <x-stat-card 
                    title="Dalam Proses" 
                    value="0" 
                    icon="loader" 
                    color="amber"
                />
                <x-stat-card 
                    title="Selesai" 
                    value="0" 
                    icon="check-circle" 
                    color="green"
                />
            </div>

            {{-- Tabel Placeholder --}}
            <div class="table-card">
                <div class="px-6 py-5 border-b border-[#F1F5F9]">
                    <h3 class="text-[15px] font-bold text-[#0F172A]">Disposisi Terbaru</h3>
                </div>
                <x-empty-state 
                    icon="inbox" 
                    title="Belum ada disposisi" 
                    description="Belum ada surat yang didisposisikan ke bagian Anda."
                />
            </div>

        </div>
    </div>
</x-app-layout>
