<!-- Sidebar Backdrop for Mobile -->
<div x-show="sidebarOpen" class="fixed inset-0 z-40 bg-gray-900/50 lg:hidden" @click="sidebarOpen = false" x-transition.opacity></div>

<!-- Sidebar Component -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
       class="fixed inset-y-0 left-0 z-50 w-[260px] bg-[#4338CA] text-white transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-auto flex flex-col">
    
    <!-- Logo Area -->
    <div class="flex items-center gap-3 h-20 px-6 border-b border-white/10 shrink-0">
        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-[#4338CA] font-bold text-xl shadow-sm shrink-0">
            S
        </div>
        <div>
            <h1 class="text-[15px] font-bold text-white leading-tight tracking-wide">SiSurat</h1>
            <p class="text-[11px] text-white/60 font-medium">Universitas Alifah</p>
        </div>
    </div>

    <!-- Navigation Menu -->
    <div class="flex-1 overflow-y-auto py-6 px-4 space-y-6">
        
        <!-- MENU UTAMA -->
        <div>
            <p class="px-3 text-[11px] font-bold text-white/40 uppercase tracking-wider mb-2">Menu Utama</p>
            <ul class="space-y-1">
                @role('admin')
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-white/20 text-white font-medium' : 'text-white/65 hover:bg-white/10 hover:text-white' }}">
                            <i data-lucide="layout-dashboard" class="w-[18px] h-[18px]"></i>
                            <span class="text-[13px]">Dashboard</span>
                        </a>
                    </li>
                @endrole
                @role('wakil_rektor')
                    <li>
                        <a href="{{ route('warek.dashboard') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('warek.dashboard') ? 'bg-white/20 text-white font-medium' : 'text-white/65 hover:bg-white/10 hover:text-white' }}">
                            <i data-lucide="layout-dashboard" class="w-[18px] h-[18px]"></i>
                            <span class="text-[13px]">Dashboard</span>
                        </a>
                    </li>
                @endrole
                @role('rektor')
                    <li>
                        <a href="{{ route('rektor.dashboard') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('rektor.dashboard') ? 'bg-white/20 text-white font-medium' : 'text-white/65 hover:bg-white/10 hover:text-white' }}">
                            <i data-lucide="layout-dashboard" class="w-[18px] h-[18px]"></i>
                            <span class="text-[13px]">Dashboard</span>
                        </a>
                    </li>
                @endrole
                @role('bagian_terkait')
                    <li>
                        <a href="{{ route('bagian.dashboard') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('bagian.dashboard') ? 'bg-white/20 text-white font-medium' : 'text-white/65 hover:bg-white/10 hover:text-white' }}">
                            <i data-lucide="layout-dashboard" class="w-[18px] h-[18px]"></i>
                            <span class="text-[13px]">Dashboard</span>
                        </a>
                    </li>
                @endrole
            </ul>
        </div>
        
        <!-- PERSURATAN -->
        <div>
            <p class="px-3 text-[11px] font-bold text-white/40 uppercase tracking-wider mb-2">Persuratan</p>
            <ul class="space-y-1">
                @role('admin')
                    <!-- Accordion Surat Masuk -->
                    <li x-data="{ open: {{ request()->routeIs('admin.surat-masuk.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open" 
                                class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl transition-colors text-white/65 hover:bg-white/10 hover:text-white">
                            <div class="flex items-center gap-3">
                                <i data-lucide="inbox" class="w-[18px] h-[18px]"></i>
                                <span class="text-[13px]">Surat Masuk</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="bg-white/20 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">12</span>
                                <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                            </div>
                        </button>
                        
                        <ul x-show="open" x-collapse class="mt-1 space-y-1 pl-9">
                            <li>
                                <a href="{{ route('admin.surat-masuk.index') }}" 
                                   class="block px-3 py-2 rounded-lg text-[13px] transition-colors {{ request()->routeIs('admin.surat-masuk.index') ? 'bg-white/20 text-white font-medium' : 'text-white/65 hover:bg-white/10 hover:text-white' }}">
                                    Daftar Surat
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.surat-masuk.create') }}" 
                                   class="block px-3 py-2 rounded-lg text-[13px] transition-colors {{ request()->routeIs('admin.surat-masuk.create') ? 'bg-white/20 text-white font-medium' : 'text-white/65 hover:bg-white/10 hover:text-white' }}">
                                    Registrasi Surat
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Menu Lainnya -->
                    <li>
                        <a href="#" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-colors text-white/65 hover:bg-white/10 hover:text-white">
                            <div class="flex items-center gap-3">
                                <i data-lucide="send" class="w-[18px] h-[18px]"></i>
                                <span class="text-[13px]">Surat Keluar</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-colors text-white/65 hover:bg-white/10 hover:text-white">
                            <div class="flex items-center gap-3">
                                <i data-lucide="share-2" class="w-[18px] h-[18px]"></i>
                                <span class="text-[13px]">Disposisi</span>
                            </div>
                            <span class="bg-white/20 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">4</span>
                        </a>
                    </li>
                @endrole

                @role('wakil_rektor')
                    <li>
                        <a href="{{ route('warek.surat-masuk.index') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('warek.surat-masuk.*') ? 'bg-white/20 text-white font-medium' : 'text-white/65 hover:bg-white/10 hover:text-white' }}">
                            <i data-lucide="file-check-2" class="w-[18px] h-[18px]"></i>
                            <span class="text-[13px]">Review Surat</span>
                        </a>
                    </li>
                @endrole

                @role('rektor')
                    <li>
                        <a href="{{ route('rektor.surat-masuk.index') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('rektor.surat-masuk.*') ? 'bg-white/20 text-white font-medium' : 'text-white/65 hover:bg-white/10 hover:text-white' }}">
                            <i data-lucide="check-circle" class="w-[18px] h-[18px]"></i>
                            <span class="text-[13px]">Persetujuan Surat</span>
                        </a>
                    </li>
                @endrole
            </ul>
        </div>
        
        <!-- PENGATURAN -->
        @role('admin')
        <div>
            <p class="px-3 text-[11px] font-bold text-white/40 uppercase tracking-wider mb-2">Manajemen</p>
            <ul class="space-y-1">
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors text-white/65 hover:bg-white/10 hover:text-white">
                        <i data-lucide="users" class="w-[18px] h-[18px]"></i>
                        <span class="text-[13px]">Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors text-white/65 hover:bg-white/10 hover:text-white">
                        <i data-lucide="shield" class="w-[18px] h-[18px]"></i>
                        <span class="text-[13px]">Role & Akses</span>
                    </a>
                </li>
            </ul>
        </div>
        @endrole
    </div>
    
    <!-- User Footer Card -->
    <div class="p-4 border-t border-white/10">
        <div class="bg-white/5 rounded-xl p-3 flex items-center justify-between border border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white text-xs font-bold border border-indigo-400">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div>
                    <p class="text-[13px] font-semibold text-white leading-tight max-w-[100px] truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] text-white/60 capitalize">{{ str_replace('_', ' ', Auth::user()->roles->first()->name ?? 'User') }}</p>
                </div>
            </div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="p-1.5 rounded-lg text-white/40 hover:bg-white/10 hover:text-white transition-colors" title="Keluar">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                </button>
            </form>
        </div>
    </div>
</aside>
