@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <div class="bg-white p-6 sm:p-8 rounded-playful-md shadow-border-offset border-2 border-dark">
        {{-- UKURAN TEKS KITA BUAT RESPONSIVE --}}
        <h2 class="text-2xl sm:text-h3 font-exo2 text-dark text-center mb-6">Login ke Akun Anda</h2>
        
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-dark font-semibold mb-2">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner focus:outline-none focus:ring-2 focus:ring-secondary">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-dark font-semibold mb-2">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner focus:outline-none focus:ring-2 focus:ring-secondary">
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-secondary shadow-sm focus:ring-secondary" name="remember">
                    <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
                </label>
            </div>

            {{-- BAGIAN TOMBOL KITA BUAT RESPONSIVE --}}
            <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between mt-6 gap-4">
                <a class="text-center sm:text-left underline text-sm text-gray-600 hover:text-dark rounded-md" href="{{ route('register') }}">
                    Belum punya akun?
                </a>

                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80">
                    Login
                </button>
            </div>
        </form>
    </div>
@endsection