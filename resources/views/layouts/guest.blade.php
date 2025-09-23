<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HostPanel - @yield('title')</title>

    {{-- Fonts, Icons, dan Vite --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@100..900&family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Style Global --}}
    <style>
        body { font-family: 'Lexend', sans-serif; color: theme('colors.dark'); }
        /* Pastikan background gradient tetap di belakang konten */
        .gradient-bg {
            background: linear-gradient(135deg, theme('colors.secondary') 0%, theme('colors.purple') 100%);
        }
    </style>
</head>

<body class="h-full antialiased">
    <div class="min-h-screen flex items-center justify-center relative">
        {{-- Background Gradient untuk Desktop --}}
        <div class="hidden lg:block absolute inset-0 w-1/2 gradient-bg"></div>

        <div class="relative z-10 w-full max-w-sm sm:max-w-md lg:max-w-4xl bg-white rounded-playful-lg shadow-border-offset-lg border-2 border-dark overflow-hidden flex flex-col lg:flex-row min-h-[600px]">
            
            {{-- Branding Section (Kiri untuk Desktop, Atas untuk Mobile) --}}
            <div class="w-full lg:w-1/2 p-8 sm:p-12 flex flex-col justify-center items-center text-center 
                        bg-dark lg:gradient-bg text-white lg:text-white">
                <a href="/" class="flex flex-col items-center mb-6">
                    <img src="{{ asset('assets/image/logo-miomidev.svg') }}" class="w-20 h-20 filter invert mb-4" alt="HostPanel Logo">
                    <h1 class="text-h1 font-exo2">HostPanel</h1>
                </a>
                <p class="text-lg text-gray-300 max-w-xs leading-relaxed hidden sm:block">
                    Platform terbaik untuk mengelola semua layanan hosting Anda. Akses mudah, fitur lengkap.
                </p>
            </div>

            {{-- Form Section (Kanan untuk Desktop, Bawah untuk Mobile) --}}
            <div class="w-full lg:w-1/2 p-8 sm:p-12 flex flex-col justify-center">
                {{-- Logo untuk Mobile, jika branding section tidak full-width --}}
                <div class="text-center mb-6 lg:hidden">
                    <a href="/">
                        <img src="{{ asset('assets/image/logo-miomidev.svg') }}" class="w-16 h-16 mx-auto" alt="HostPanel Logo">
                    </a>
                </div>
                
                @yield('content')
            </div>

        </div>
    </div>
</body>
</html>