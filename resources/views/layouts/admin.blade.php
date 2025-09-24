<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MiomiHost - @yield('title')</title>

    {{-- Fonts from Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@100..900&family=Lexend:wght@100..900&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    
    {{-- Vite for Tailwind CSS and JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Custom global styles --}}
    <style>
        body {
            font-family: 'Lexend', sans-serif;
            color: theme('colors.dark'); /* Menggunakan warna kustom 'dark' */
        }
        /* Scrollbar styling for a better look in admin panel */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>

    {{-- Additional styles per page --}}
    @stack('styles')
</head>

<body class="bg-gray-100 flex min-h-screen">

    {{-- Overlay untuk Mobile Sidebar --}}
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-60 z-30 hidden md:hidden"></div>

    {{-- Sidebar --}}
    <aside id="sidebar" class="bg-dark text-white w-64 min-h-screen flex-shrink-0 p-4 flex flex-col fixed md:static transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-40">
        <div class="flex items-center justify-center pb-4 border-b border-gray-700 mb-6">
            {{-- Ganti logo ini dengan logo Anda --}}
            <img src="{{ asset('assets/image/logo-miomidev.svg') }}" class="w-10 h-10 mr-2 filter invert" alt="MiomiHost Logo">
            <span class="text-xl font-bold font-exo2">MiomiHost</span>
        </div>

        <nav class="flex-grow">
            {{-- Dashboard Link --}}
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center px-4 py-3 rounded-playful-sm transition-colors duration-200 hover:bg-secondary 
                      {{ request()->routeIs('admin.dashboard') ? 'bg-secondary' : '' }}">
                <i class="fas fa-tachometer-alt w-6 text-center"></i>
                <span class="ml-4 font-semibold font-lexend">Dashboard</span>
            </a>
            
            {{-- Manajemen Produk Link --}}
            <a href="{{ route('admin.produk') }}" 
            class="flex items-center mt-3 px-4 py-3 rounded-playful-sm transition-colors duration-200 hover:bg-secondary 
                    {{ request()->routeIs('admin.produk', 'admin.produk.*') ? 'bg-secondary' : '' }}">
                <i class="fas fa-box-open w-6 text-center"></i>
                <span class="ml-4 font-semibold font-lexend">Produk</span>
            </a>

            {{-- Manajemen Pengguna Link --}}
            <a href="{{ route('admin.user') }}" 
            class="flex items-center mt-3 px-4 py-3 rounded-playful-sm transition-colors duration-200 hover:bg-secondary 
                    {{ request()->routeIs('admin.user', 'admin.user.*') ? 'bg-secondary' : '' }}">
                <i class="fas fa-users w-6 text-center"></i>
                <span class="ml-4 font-semibold font-lexend">Pengguna</span>
            </a>

            {{-- Manajemen Layanan Link --}}
            <a href="{{ route('admin.service') }}" 
            class="flex items-center mt-3 px-4 py-3 rounded-playful-sm transition-colors duration-200 hover:bg-secondary 
                    {{ request()->routeIs('admin.service', 'admin.service.*') ? 'bg-secondary' : '' }}">
                <i class="fas fa-server w-6 text-center"></i>
                <span class="ml-4 font-semibold font-lexend">Layanan</span>
            </a>

            <div>
                <button type="button" id="admin-menu-button" 
                        class="flex items-center justify-between w-full mt-3 px-4 py-3 rounded-playful-sm transition-colors duration-200 hover:bg-secondary 
                               {{ request()->routeIs('admin.users*') || request()->routeIs('admin.orders*') ? 'bg-secondary' : '' }}">
                    <span class="flex items-center">
                        <i class="fas fa-cogs w-6 text-center"></i>
                        <span class="ml-4 font-semibold font-lexend">Pengaturan</span>
                    </span>
                    <i id="admin-chevron" class="fas fa-chevron-down text-xs transition-transform"></i>
                </button>

                <div id="admin-submenu" class="hidden mt-2 space-y-2 pl-8">
                    <a href="#" class="block px-4 py-2 text-sm font-semibold rounded-playful-sm hover:bg-secondary 
                                     {{ request()->routeIs('admin.users*') ? 'bg-secondary' : '' }}">
                        Lorem
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm font-semibold rounded-playful-sm hover:bg-secondary 
                                     {{ request()->routeIs('admin.orders*') ? 'bg-secondary' : '' }}">
                        Lorem
                    </a>
                </div>
            </div>
            
            {{-- Rute Admin Lainnya (Contoh) --}}
            <a href="#" class="flex items-center mt-3 px-4 py-3 rounded-playful-sm transition-colors duration-200 hover:bg-secondary">
                <i class="fas fa-chart-line w-6 text-center"></i>
                <span class="ml-4 font-semibold font-lexend">Laporan</span>
            </a>
        </nav>

        {{-- Footer Sidebar (Info User & Logout) --}}
        <div class="pt-4 border-t border-gray-700">
            <div class="flex items-center mb-4">
                <img class="h-10 w-10 rounded-full object-cover border-2 border-primary" 
                     src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=8FD14F&color=080330" 
                     alt="Admin Avatar">
                <div class="ml-3">
                    <p class="font-bold text-sm font-lexend">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400 font-lexend">{{ Auth::user()->role }}</p> {{-- Role kita simpan sebagai string --}}
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center text-center px-4 py-2 rounded-playful-sm bg-red-500 border-2 border-dark shadow-border-offset hover:bg-red-600 transition-colors duration-200">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    <span class="font-bold font-lexend">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content Area --}}
    <div class="flex-1 flex flex-col">
        {{-- Header untuk Mobile --}}
        <header class="bg-white p-4 flex items-center justify-between md:hidden border-b-2 border-dark shadow-sm">
            <button id="menu-toggle" class="text-dark focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
            <h1 class="text-xl font-bold text-dark font-exo2">
                Admin Panel
            </h1>
            <div class="w-8"></div> {{-- Spacer --}}
        </header>

        {{-- Main Content Slot --}}
        <main class="flex-1 overflow-y-auto bg-gray-100 p-6">
            {{-- Pesan Sukses/Error Global --}}
            @if (session('success'))
                <div class="bg-primary bg-opacity-20 border border-primary text-primary px-4 py-3 rounded-playful-sm relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-playful-sm relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            @yield('content')
        </main>
    </div>

    {{-- Script untuk Sidebar Toggle dan Submenu --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const adminMenuButton = document.getElementById('admin-menu-button');
            const adminSubmenu = document.getElementById('admin-submenu');
            const adminChevron = document.getElementById('admin-chevron');

            // Logic untuk submenu
            if (adminMenuButton) {
                // Tampilkan submenu secara default jika ada child link yang aktif
                if (adminSubmenu.querySelector('a.bg-secondary')) {
                    adminSubmenu.classList.remove('hidden');
                    adminChevron.classList.add('rotate-180');
                }

                adminMenuButton.addEventListener('click', () => {
                    adminSubmenu.classList.toggle('hidden');
                    adminChevron.classList.toggle('rotate-180');
                });
            }

            // Logic untuk mobile sidebar
            if (menuToggle) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('-translate-x-full');
                    overlay.classList.toggle('hidden');
                });
            }

            if (overlay) {
                overlay.addEventListener('click', function() {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                });
            }
        });
    </script>
    
    {{-- Additional scripts per page --}}
    @stack('scripts')
</body>
</html>