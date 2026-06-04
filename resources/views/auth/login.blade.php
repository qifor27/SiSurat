<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Log in - SiSurat Universitas Alifah</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* Fallback for responsive layout if Tailwind isn't compiled */
        .layout-container {
            display: flex;
            width: 100%;
            height: 100vh;
        }
        .left-panel {
            flex: 1;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow-y: auto;
        }
        .right-panel {
            display: none;
            flex: 1;
            background-color: #0f4c81; /* Blue color matching Soniva reference better */
            position: relative;
            overflow: hidden;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem;
        }
        @media (min-width: 768px) {
            .right-panel {
                display: flex !important;
            }
        }
    </style>
</head>
<body class="font-sans antialiased text-[#0F172A] bg-white h-screen overflow-hidden">

    <div class="layout-container">
        <!-- LEFT PANEL (Form) -->
        <div class="left-panel">
            
            <!-- Logo Top -->
            <div class="absolute top-8 left-8 flex items-center gap-2">
                <div class="w-8 h-8 bg-[#0f4c81] text-white rounded flex items-center justify-center font-bold text-lg" style="font-style: italic;">
                    S
                </div>
                <span class="font-bold text-[18px] text-[#0F172A]">SiSurat</span>
            </div>

            <div class="w-full max-w-[400px] mx-auto mt-16 md:mt-0">
                <!-- Header Text -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-[#0F172A] mb-2">Log in</h1>
                    <p class="text-[15px] text-[#64748B]">Welcome back! Please enter your details.</p>
                </div>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-[#FEE2E2] border border-[#FECACA] rounded-xl">
                        <div class="flex items-center gap-2 text-[#991B1B] font-semibold text-[13px] mb-1">
                            <i data-lucide="alert-circle" class="w-4 h-4"></i> Error
                        </div>
                        <ul class="text-[13px] text-[#B91C1C] list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-[14px] font-medium text-[#0F172A] mb-1.5">Email <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                               placeholder="admin@alifah.ac.id"
                               class="w-full h-11 px-4 border border-[#CBD5E1] rounded-xl text-[14px] focus:outline-none focus:border-[#0f4c81] focus:ring-4 focus:ring-[#0f4c81]/10 transition-all placeholder:text-[#94A3B8]">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-[14px] font-medium text-[#0F172A] mb-1.5">Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required
                                   placeholder="••••••••"
                                   class="w-full h-11 px-4 border border-[#CBD5E1] rounded-xl text-[14px] focus:outline-none focus:border-[#0f4c81] focus:ring-4 focus:ring-[#0f4c81]/10 transition-all placeholder:text-[#94A3B8]">
                        </div>
                    </div>

                    <!-- Options -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-[#CBD5E1] text-[#0f4c81] focus:ring-[#0f4c81]/20 transition-all cursor-pointer">
                            <span class="text-[13px] font-medium text-[#0F172A]">Remember me</span>
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[13px] font-semibold text-[#0f4c81] hover:text-[#0a365c] transition-colors">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full h-11 bg-[#0f4c81] hover:bg-[#0a365c] text-white font-semibold rounded-xl text-[14px] transition-colors mt-2">
                        Sign in
                    </button>
                </form>
            </div>
        </div>

        <!-- RIGHT PANEL (Branding) -->
        <div class="right-panel">
            
            <!-- Abstract Waves Background -->
            <svg class="absolute top-0 right-0 w-full h-full object-cover opacity-20 pointer-events-none" viewBox="0 0 800 800" xmlns="http://www.w3.org/2000/svg">
                <path d="M400,0 C600,200 200,600 800,800 L800,0 Z" fill="#ffffff" />
                <circle cx="700" cy="200" r="150" fill="#ffffff" opacity="0.5" />
            </svg>

            <!-- Center Content -->
            <div class="relative z-10 text-center max-w-md mb-16">
                <!-- Icon -->
                <div class="w-12 h-12 bg-transparent border-2 border-white text-white rounded flex items-center justify-center mx-auto mb-6" style="font-style: italic; font-weight: bold; font-size: 24px;">
                    S
                </div>
                
                <h2 class="text-3xl font-semibold text-white mb-4">Welcome to SiSurat</h2>
                <p class="text-[14px] text-white/90 leading-relaxed">
                    Effortlessly manage correspondence with the power of automation. Simplify data collection, improve response times, and create an engaging experience for your users.
                </p>
            </div>

            <!-- Glassmorphism Mockups (Chat bubbles style from reference) -->
            <div class="relative z-10 w-full max-w-[350px]">
                
                <!-- Receiver Bubble -->
                <div class="flex items-start gap-3 mb-6 relative">
                    <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center shrink-0 shadow-lg z-10">
                        <span class="text-[#0f4c81] font-bold text-xs" style="font-style: italic;">S</span>
                    </div>
                    <div>
                        <p class="text-xs text-white/80 mb-1 ml-1">SiSurat System</p>
                        <div class="bg-white p-4 rounded-xl rounded-tl-sm shadow-xl relative z-10 text-left">
                            <p class="text-[12px] text-[#334155] leading-relaxed">
                                Hello, this is SiSurat. In today's session, we'd like to help you manage your incoming and outgoing documents effortlessly.
                            </p>
                        </div>
                    </div>
                    <!-- Glass element behind -->
                    <div class="absolute -top-4 -left-4 w-16 h-16 bg-white/20 backdrop-blur-md rounded-xl z-0"></div>
                </div>

                <!-- Sender Bubble -->
                <div class="flex items-start justify-end gap-3 relative">
                    <div>
                        <p class="text-xs text-white/80 mb-1 mr-1 text-right">You</p>
                        <div class="bg-[#1a5d99] border border-white/10 p-3 rounded-xl rounded-tr-sm shadow-xl relative z-10 text-left">
                            <p class="text-[12px] text-white/90">
                                Yes, I'm ready. Let's go!
                            </p>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl z-0"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
