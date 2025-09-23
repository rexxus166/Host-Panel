<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HostPanel - @yield('title', 'Dashboard')</title>

    {{-- Fonts, Icons, dan Vite --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@100..900&family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Style Global --}}
    <style>
        body { font-family: 'Lexend', sans-serif; color: theme('colors.dark'); }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #888; border-radius: 10px; }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-100 flex min-h-screen">

    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-60 z-30 hidden md:hidden"></div>

    {{-- Sidebar Khusus User --}}
    <aside id="sidebar" class="bg-dark text-white w-64 min-h-screen flex-shrink-0 p-4 flex flex-col fixed md:static transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-40">
        <div class="flex items-center justify-center pb-4 border-b border-gray-700 mb-6">
            <img src="{{ asset('assets/image/logo-miomidev.svg') }}" class="w-10 h-10 mr-2 filter invert" alt="HostPanel Logo">
            <span class="text-xl font-bold font-exo2">HostPanel</span>
        </div>

        <nav class="flex-grow">
            {{-- Link Navigasi untuk User --}}
            <a href="{{ route('user.dashboard') }}" 
               class="flex items-center px-4 py-3 rounded-playful-sm transition-colors duration-200 hover:bg-secondary 
                      {{ request()->routeIs('user.dashboard') ? 'bg-secondary' : '' }}">
                <i class="fas fa-home w-6 text-center"></i>
                <span class="ml-4 font-semibold font-lexend">Dashboard</span>
            </a>

            <a href="{{ route('produk.index') }}"
               class="flex items-center mt-3 px-4 py-3 rounded-playful-sm transition-colors duration-200 hover:bg-secondary 
                      {{ request()->routeIs('produk.index', 'produk.index.*') ? 'bg-secondary' : '' }}">
                <i class="fas fa-shopping-cart w-6 text-center"></i>
                <span class="ml-4 font-semibold font-lexend">Produk</span>
            </a>
            
            <a href="{{ route('user.service') }}"
               class="flex items-center mt-3 px-4 py-3 rounded-playful-sm transition-colors duration-200 hover:bg-secondary 
                      {{ request()->routeIs('user.service', 'user.service.*') ? 'bg-secondary' : '' }}">
                <i class="fas fa-server w-6 text-center"></i>
                <span class="ml-4 font-semibold font-lexend">Layanan Saya</span>
            </a>

            <a href="{{ route('tagihan') }}" {{-- Nanti kita buat route('user.invoices') --}}
               class="flex items-center mt-3 px-4 py-3 rounded-playful-sm transition-colors duration-200 hover:bg-secondary
                      {{ request()->routeIs('tagihan', 'tagihan.*') ? 'bg-secondary' : '' }}">
                <i class="fas fa-file-invoice-dollar w-6 text-center"></i>
                <span class="ml-4 font-semibold font-lexend">Tagihan</span>
            </a>

            <a href="{{ route('bantuan') }}" {{-- Nanti kita buat route('user.tickets') --}}
               class="flex items-center mt-3 px-4 py-3 rounded-playful-sm transition-colors duration-200 hover:bg-secondary
                      {{ request()->routeIs('bantuan', 'bantuan.*') ? 'bg-secondary' : '' }}">
                <i class="fas fa-life-ring w-6 text-center"></i>
                <span class="ml-4 font-semibold font-lexend">Bantuan</span>
            </a>
        </nav>

        {{-- Info User & Logout --}}
        <div class="pt-4 border-t border-gray-700">
            <div class="flex items-center mb-4">
                <img class="h-10 w-10 rounded-full object-cover border-2 border-primary" 
                     src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=8FD14F&color=080330" 
                     alt="User Avatar">
                <div class="ml-3">
                    <p class="font-bold text-sm font-lexend">{{ Auth::user()->name }}</p>
                    <!-- <p class="text-xs text-gray-400 font-lexend">{{ ucfirst(Auth::user()->role) }}</p> -->
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
        <header class="bg-white p-4 flex items-center justify-between md:hidden border-b-2 border-dark shadow-sm">
            <button id="menu-toggle" class="text-dark focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
            <h1 class="text-xl font-bold text-dark font-exo2">@yield('page_title', 'Dashboard')</h1>
            <div class="w-8"></div>
        </header>

        <main class="flex-1 overflow-y-auto bg-gray-100 p-6">
            @if (session('success'))
                <div class="bg-primary bg-opacity-20 border border-primary text-primary px-4 py-3 rounded-playful-sm relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            @yield('content')
        </main>
    </div>

    {{-- Script untuk Sidebar Toggle --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
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
    @stack('scripts')
</body>
</html>