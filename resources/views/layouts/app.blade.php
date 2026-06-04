<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SiSurat') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Lucide Icons -->
        <script src="https://unpkg.com/lucide@latest"></script>
    </head>
    <body class="font-sans antialiased bg-[#F8FAFC] text-[#0F172A] overflow-hidden" x-data="{ sidebarOpen: false }">
        <div class="flex h-screen w-full">
            
            <!-- Sidebar -->
            <x-sidebar />

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col h-full overflow-hidden">
                
                <!-- Header Global -->
                <x-header />

                <!-- Page Content -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-[#F8FAFC]">
                    {{ $slot }}
                </main>
                
            </div>
        </div>

        <script>
            // Initialize Lucide icons
            lucide.createIcons();
        </script>
    </body>
</html>
