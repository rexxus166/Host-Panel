@extends('layouts.app')

@section('title', 'Produk')
@section('page_title', 'Produk')

@section('content')
    <div>
        {{-- Header Halaman --}}
        <div class="mb-10 text-center">
            <h1 class="text-h1 font-exo2 text-dark mb-2">Pilih Paket Hosting Terbaik Anda</h1>
            <p class="text-lg text-gray-500">Solusi hosting cepat, aman, dan terjangkau untuk segala kebutuhan website Anda.</p>
        </div>

        {{-- Konten Utama - Daftar Produk Dinamis --}}
        <div class="space-y-12">
            <div>
                <h2 class="text-h3 font-exo2 text-dark mb-6 text-center lg:text-left"></h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    {{-- PERULANGAN DIMULAI DI SINI --}}
                    @forelse ($products as $product)
                        <div class="bg-white p-6 rounded-playful-lg shadow-border-offset border-2 border-dark flex flex-col">
                            <div class="flex-grow">
                                <h3 class="text-h4 font-exo2 text-dark">{{ $product->name }}</h3>
                                <p class="text-gray-500 mb-4">Spesifikasi unggulan untuk Anda.</p>
                                
                                <p class="text-3xl font-exo2 text-dark font-bold mb-4">
                                    {{-- Format harga menjadi Rupiah --}}
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                    <span class="text-lg font-normal text-gray-500">/bulan</span>
                                </p>

                                <ul class="space-y-3 text-dark mb-6">
                                    <li class="flex items-center gap-3">
                                        <i class="fas fa-check-circle text-green-500"></i>
                                        <span><span class="font-bold">{{ $product->disk_space_gb }} GB</span> Disk Space</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <i class="fas fa-check-circle text-green-500"></i>
                                        <span><span class="font-bold">{{ $product->bandwidth_gb }} GB</span> Bandwidth</span>
                                    </li>
                                    {{-- Catatan: Fitur di bawah ini masih statis. --}}
                                    {{-- Anda bisa menambahkan kolom baru di database jika ingin membuatnya dinamis --}}
                                    <li class="flex items-center gap-3">
                                        <i class="fas fa-check-circle text-green-500"></i>
                                        <span><span class="font-bold">Unlimited</span> Addon Domain</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <i class="fas fa-check-circle text-green-500"></i>
                                        <span>Gratis Domain (.com)</span>
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ route('order.create', $product) }}" class="w-full text-center mt-auto px-6 py-3 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all duration-200">
                                Pesan Sekarang
                            </a>
                        </div>
                    @empty
                        {{-- Tampilan ini akan muncul jika tabel products kosong --}}
                        <div class="md:col-span-2 lg:col-span-3 text-center py-10 border-2 border-dashed border-gray-300 rounded-playful-md">
                            <i class="fas fa-box-open fa-3x text-gray-400 mb-4"></i>
                            <p class="text-gray-500">Saat ini belum ada produk yang tersedia.</p>
                        </div>
                    @endforelse
                    {{-- PERULANGAN SELESAI --}}

                </div>
            </div>
        </div>
    </div>
@endsection