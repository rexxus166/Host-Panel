@extends('layouts.app')

@section('title', 'Kelola Layanan')

@section('content')
    <div>
        {{-- Header Halaman --}}
        <div class="mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('user.service') }}" class="text-gray-400 hover:text-secondary">
                    <i class="fas fa-arrow-left fa-lg"></i>
                </a>
                <div>
                    <h1 class="text-h2 font-exo2 text-dark">Kelola Layanan</h1>
                    <p class="text-gray-500 font-bold">{{ $service->domain }}</p>
                </div>
            </div>
        </div>

        {{-- Konten Utama --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Kolom Kiri: Detail & Aksi --}}
            <div class="lg:col-span-2 space-y-8">
                
                {{-- Kartu Aksi Utama (Login ke cPanel) --}}
                <div class="bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
                    <h3 class="text-h4 font-exo2 text-dark mb-4">Akses Panel Kontrol</h3>
                    
                    @if ($service->status == 'active')
                        <p class="text-gray-600 mb-4">Masuk ke cPanel untuk mengelola file, database, email, dan lainnya.</p>
                        <a href="#" class="px-6 py-3 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all duration-200">
                            <i class="fas fa-sign-in-alt mr-2"></i> Login ke cPanel (SSO)
                        </a>
                    @else
                        <div class="text-center py-6 border-2 border-dashed border-gray-300 rounded-playful-md">
                            <i class="fas fa-clock fa-2x text-gray-400 mb-2"></i>
                            <p class="text-gray-500 font-semibold">Layanan Anda sedang menunggu aktivasi.</p>
                            <p class="text-sm text-gray-400">Tombol login ke cPanel akan muncul setelah layanan diaktifkan oleh admin.</p>
                        </div>
                    @endif
                </div>

                {{-- Kartu Penggunaan Sumber Daya (Placeholder) --}}
                <div class="bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
                    <h3 class="text-h4 font-exo2 text-dark mb-4">Penggunaan Sumber Daya</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-semibold text-dark">Disk Space</span>
                                <span class="text-sm text-gray-500">0 MB / {{ $service->product->disk_space_gb }} GB</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-secondary h-2.5 rounded-full" style="width: 0%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-semibold text-dark">Bandwidth</span>
                                <span class="text-sm text-gray-500">0 MB / {{ $service->product->bandwidth_gb }} GB</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-primary h-2.5 rounded-full" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Kolom Kanan: Informasi Layanan --}}
            <div class="bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark h-fit">
                <h3 class="text-h4 font-exo2 text-dark mb-4 border-b-2 border-dark pb-2">Informasi Layanan</h3>
                <div class="space-y-3 text-dark">
                    <div class="flex justify-between">
                        <span class="font-semibold">Paket:</span>
                        <span>{{ $service->product->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Tanggal Pesan:</span>
                        <span>{{ $service->created_at->format('d F Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-semibold">Status:</span>
                        <span class="px-2 py-1 font-semibold leading-tight text-xs rounded-full
                            @if($service->status == 'active') bg-green-100 text-green-700 @endif
                            @if($service->status == 'pending') bg-yellow-100 text-yellow-700 @endif
                            @if($service->status == 'suspended') bg-red-100 text-red-700 @endif
                        ">
                            {{ ucfirst($service->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection