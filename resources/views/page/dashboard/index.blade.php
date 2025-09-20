@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div>
        {{-- Header Sambutan --}}
        <div class="mb-8">
            <h1 class="text-h2 font-exo2 text-dark">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-500">Selamat datang di member area Anda.</p>
        </div>

        {{-- Panel Layanan Aktif --}}
        <div class="bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
            <h3 class="text-h4 font-exo2 text-dark mb-4">Layanan Aktif Anda</h3>
            
            <div class="text-center py-10 border-2 border-dashed border-gray-300 rounded-playful-md">
                <i class="fas fa-server fa-3x text-gray-400 mb-4"></i>
                <p class="text-gray-500">Anda belum memiliki layanan hosting yang aktif.</p>
                <a href="#" {{-- Nanti arahkan ke halaman order --}}
                   class="mt-4 inline-block px-5 py-2 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all duration-200">
                    Pesan Layanan Sekarang
                </a>
            </div>
        </div>

        {{-- Panel Aksi Cepat --}}
        <div class="mt-10 bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
             <h3 class="text-h4 font-exo2 text-dark mb-4">Aksi Cepat</h3>
             <div class="flex flex-wrap gap-4">
                <a href="#" 
                   class="px-5 py-2 bg-secondary text-white font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all duration-200">
                    <i class="fas fa-file-invoice-dollar mr-2"></i> Lihat Tagihan
                </a>
                <a href="#" 
                   class="px-5 py-2 bg-gray-200 text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-gray-300 transition-all duration-200">
                    <i class="fas fa-user-edit mr-2"></i> Edit Profil
                </a>
             </div>
        </div>

    </div>
@endsection