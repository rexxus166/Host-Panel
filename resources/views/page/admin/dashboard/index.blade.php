@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div>
        {{-- Header Sambutan --}}
        <div class="mb-8">
            <h1 class="text-h2 font-exo2 text-dark">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-500">Berikut adalah ringkasan untuk panel hosting Anda.</p>
        </div>

        {{-- Grid untuk Kartu Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-secondary bg-opacity-20">
                        <i class="fas fa-users fa-2x text-secondary"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 font-semibold">Total Pengguna</p>
                        <p class="text-2xl font-bold text-dark">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-primary bg-opacity-20">
                        <i class="fas fa-box-open fa-2x text-primary"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 font-semibold">Total Produk</p>
                        <p class="text-2xl font-bold text-dark">{{ $totalProducts }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-orange bg-opacity-20">
                        <i class="fas fa-server fa-2x text-orange"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 font-semibold">Layanan Aktif</p>
                        <p class="text-2xl font-bold text-dark">0</p> {{-- Ganti dengan variabel nanti --}}
                    </div>
                </div>
            </div>

        </div>

        {{-- Panel Aksi Cepat --}}
        <div class="mt-10 bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
             <h3 class="text-h4 font-exo2 text-dark mb-4">Aksi Cepat</h3>
             <div class="flex space-x-4">
                <a href="{{ route('admin.produk') }}" 
                   class="px-5 py-2 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all duration-200">
                    <i class="fas fa-box-open mr-2"></i> Kelola Produk
                </a>
                <a href="{{ route('admin.user') }}" 
                   class="px-5 py-2 bg-secondary text-white font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all duration-200">
                    <i class="fas fa-users mr-2"></i> Kelola Pengguna
                </a>
             </div>
        </div>

    </div>
@endsection