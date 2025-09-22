@extends('layouts.guest')

@section('title', 'Register')

@section('content')
    <div>
        <h2 class="text-h3 font-exo2 text-dark text-center mb-1">Buat Akun Baru</h2>
        <p class="text-center text-gray-500 mb-6">Mulai perjalanan Anda bersama kami.</p>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-dark font-semibold mb-2">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                       class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner focus:outline-none focus:ring-2 focus:ring-secondary transition-shadow">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-dark font-semibold mb-2">Alamat Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                       class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner focus:outline-none focus:ring-2 focus:ring-secondary transition-shadow">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-dark font-semibold mb-2">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner focus:outline-none focus:ring-2 focus:ring-secondary transition-shadow">
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-dark font-semibold mb-2">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner focus:outline-none focus:ring-2 focus:ring-secondary transition-shadow">
            </div>

            <div class="flex flex-col items-center gap-4">
                <button type="submit" class="w-full px-8 py-3 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all duration-200">
                    Register
                </button>
                <a class="underline text-sm text-gray-600 hover:text-dark rounded-md" href="{{ route('login') }}">
                    Sudah punya akun? Login
                </a>
            </div>
        </form>
    </div>
@endsection