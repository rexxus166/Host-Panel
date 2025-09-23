<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HostPanel - @yield('title', 'Solusi Hosting Modern')</title>

    {{-- Fonts, Icons, dan Vite --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@100..900&family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Lexend', sans-serif; color: theme('colors.dark'); }
    </style>
    @stack('styles')
</head>
<body class="bg-white antialiased">
    
    {{-- NAVBAR --}}
    <header class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b-2 border-dark">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('assets/image/logo-miomidev.svg') }}" class="w-10 h-10" alt="HostPanel Logo">
                <span class="ml-3 text-2xl font-exo2 font-bold text-dark">HostPanel</span>
            </a>

            {{-- Menu Desktop --}}
            <div class="hidden md:flex items-center space-x-8">
                <a href="#features" class="text-dark font-semibold hover:text-secondary">Fitur</a>
                <a href="#pricing" class="text-dark font-semibold hover:text-secondary">Harga</a>
                <a href="#" class="text-dark font-semibold hover:text-secondary">Kontak</a>
            </div>

            {{-- Tombol CTA & Dashboard/Login --}}
            <div class="hidden md:flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="px-5 py-2 text-dark font-bold rounded-playful-sm hover:bg-gray-200 transition-all">Login</a>
                    <a href="{{ route('register') }}" class="px-5 py-2 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all">Register</a>
                @endguest
                @auth
                    <a href="{{ route('user.dashboard') }}" class="px-5 py-2 bg-secondary text-white font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all">Dashboard</a>
                @endauth
            </div>

            {{-- Hamburger Menu (Mobile) --}}
            <div class="md:hidden">
                <button id="menu-btn" type="button" class="text-dark focus:outline-none">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
            </div>
        </nav>
        
        <div id="mobile-menu" class="hidden md:hidden">
            <a href="#features" class="block py-2 px-6 text-sm hover:bg-gray-100">Fitur</a>
            <a href="#pricing" class="block py-2 px-6 text-sm hover:bg-gray-100">Harga</a>
            <a href="#" class="block py-2 px-6 text-sm hover:bg-gray-100">Kontak</a>
            <div class="px-6 py-4 border-t border-gray-200">
                @guest
                    <a href="{{ route('login') }}" class="block text-center w-full mb-2 px-5 py-2 text-dark font-bold rounded-playful-sm bg-gray-200">Login</a>
                    <a href="{{ route('register') }}" class="block text-center w-full px-5 py-2 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset">Register</a>
                @endguest
                @auth
                    <a href="{{ route('user.dashboard') }}" class="block text-center w-full px-5 py-2 bg-secondary text-white font-bold rounded-playful-sm border-2 border-dark shadow-border-offset">Dashboard</a>
                @endauth
            </div>
        </div>
    </header>

    {{-- KONTEN UTAMA HALAMAN --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-dark text-white border-t-4 border-primary">
        <div class="container mx-auto px-6 py-12">
            
            {{-- Grid Utama Footer --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                
                {{-- Kolom 1: Branding --}}
                <div class="md:col-span-2">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('assets/image/logo-miomidev.svg') }}" class="w-10 h-10 filter invert" alt="HostPanel Logo">
                        <span class="ml-3 text-2xl font-exo2 font-bold">HostPanel</span>
                    </a>
                    <p class="mt-4 text-gray-400 max-w-md">
                        Platform terbaik untuk mengelola semua layanan hosting Anda. Akses mudah, fitur lengkap, dan performa andal.
                    </p>
                </div>

                {{-- Kolom 2: Navigasi Cepat --}}
                <!-- <div>
                    <h4 class="text-lg font-bold font-exo2 mb-4">Navigasi</h4>
                    <div class="flex flex-col space-y-3">
                        <a href="#features" class="text-gray-400 hover:text-white transition-colors">Fitur</a>
                        <a href="#pricing" class="text-gray-400 hover:text-white transition-colors">Harga</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Kontak</a>
                    </div>
                </div> -->

                {{-- Kolom 3: Legal & Sosial Media --}}
                <div>
                    <h4 class="text-lg font-bold font-exo2 mb-4">Legal</h4>
                    <div class="flex flex-col space-y-3">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Terms of Service</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a>
                    </div>
                    {{-- Sosial Media --}}
                    <div class="flex space-x-4 mt-6">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-x-twitter fa-lg"></i></a>
                    </div>
                </div>
            </div>

            {{-- Garis Pemisah & Copyright --}}
            <div class="mt-12 border-t border-gray-700 pt-6 text-center">
                <p class="text-gray-500 text-sm">
                    &copy; {{ date('Y') }} HostPanel. Dibuat dengan semangat belajar.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Script untuk toggle menu mobile
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>