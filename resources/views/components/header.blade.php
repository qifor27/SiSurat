<header class="bg-white h-[72px] border-b border-[#E2E8F0] flex items-center justify-between px-6 shrink-0 z-30">
    
    <!-- Left Section -->
    <div class="flex items-center gap-4 flex-1">
        <!-- Mobile Sidebar Toggle -->
        <button @click="sidebarOpen = true" class="p-2 -ml-2 rounded-lg text-gray-500 hover:bg-gray-100 lg:hidden">
            <i data-lucide="menu" class="w-5 h-5"></i>
        </button>

        <!-- Search Bar -->
        <div class="hidden sm:flex items-center relative max-w-md w-full">
            <i data-lucide="search" class="w-[18px] h-[18px] text-[#94A3B8] absolute left-3.5"></i>
            <input type="text" placeholder="Cari nomor atau perihal surat..." 
                   class="w-full bg-[#F8FAFC] border border-[#E2E8F0] text-[13px] rounded-[10px] pl-10 pr-4 py-2.5 focus:outline-none focus:border-[#4338CA] focus:ring-4 focus:ring-[#4338CA]/10 transition-all font-sans text-[#0F172A] placeholder:text-[#94A3B8]">
        </div>
    </div>

    <!-- Right Section -->
    <div class="flex items-center gap-3 sm:gap-5">
        
        <!-- Notification -->
        <button class="relative p-2 rounded-full text-[#64748B] hover:bg-[#F1F5F9] transition-colors">
            <i data-lucide="bell" class="w-5 h-5"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-[#EF4444] rounded-full border border-white"></span>
        </button>

        <!-- User Dropdown -->
        <div class="relative" x-data="{ userMenuOpen: false }">
            <button @click="userMenuOpen = !userMenuOpen" @click.outside="userMenuOpen = false" class="flex items-center gap-2.5 focus:outline-none hover:bg-[#F8FAFC] p-1.5 rounded-lg transition-colors border border-transparent hover:border-[#E2E8F0]">
                <!-- Avatar -->
                <div class="w-8 h-8 rounded-lg bg-[#4338CA] text-white flex items-center justify-center font-semibold text-xs">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                
                <i data-lucide="chevron-down" class="w-4 h-4 text-[#94A3B8] hidden sm:block"></i>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="userMenuOpen" 
                 x-transition.opacity
                 class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-[#E2E8F0] py-1.5 z-50 overflow-hidden"
                 style="display: none;">
                
                <div class="px-4 py-2 border-b border-[#F1F5F9] mb-1">
                    <p class="text-[13px] font-semibold text-[#0F172A] truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] text-[#64748B] truncate">{{ Auth::user()->email }}</p>
                </div>

                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2 text-[13px] font-medium text-[#64748B] hover:bg-[#F8FAFC] hover:text-[#4338CA]">
                    <i data-lucide="user" class="w-4 h-4"></i> Profil Saya
                </a>
                
                <a href="#" class="flex items-center gap-2.5 px-4 py-2 text-[13px] font-medium text-[#64748B] hover:bg-[#F8FAFC] hover:text-[#4338CA]">
                    <i data-lucide="settings" class="w-4 h-4"></i> Pengaturan
                </a>
                
                <div class="h-px bg-[#F1F5F9] my-1"></div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2.5 w-full px-4 py-2 text-[13px] font-medium text-[#EF4444] hover:bg-[#FEE2E2] text-left">
                        <i data-lucide="log-out" class="w-4 h-4"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
