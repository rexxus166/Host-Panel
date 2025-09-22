@extends('layouts.public')

@section('title', 'Paket Hosting')

@section('content')

    {{-- Header Halaman --}}
    <section class="bg-white py-16">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-h1 lg:text-5xl font-exo2 text-dark">
                Semua Paket Hosting Kami
            </h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Pilih paket hosting dengan performa terbaik yang dirancang khusus untuk memenuhi segala kebutuhan website Anda, mulai dari proyek pribadi hingga bisnis skala besar.
            </p>
        </div>
    </section>

    {{-- Daftar Produk (Pricing Table) --}}
    <section id="pricing" class="bg-gray-100 py-20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                @forelse ($products as $product)
                    <div class="border-2 border-dark rounded-playful-lg flex flex-col bg-white">
                        <div class="p-8">
                            <h3 class="text-h3 font-exo2 text-dark">{{ $product->name }}</h3>
                            <p class="mt-4 text-h2 font-bold text-secondary">
                                Rp {{ number_format($product->price) }}<span class="text-lg font-normal text-gray-500">/bulan</span>
                            </p>
                        </div>
                        <div class="bg-gray-50 p-8 flex-grow border-y-2 border-dark">
                            <ul class="space-y-4 text-gray-700">
                                <li class="flex items-center"><i class="fas fa-check-circle text-primary mr-3"></i> <span><span class="font-bold">{{ $product->disk_space_gb }} GB</span> Penyimpanan SSD</span></li>
                                <li class="flex items-center"><i class="fas fa-check-circle text-primary mr-3"></i> <span><span class="font-bold">{{ $product->bandwidth_gb }} GB</span> Bandwidth</span></li>
                                <li class="flex items-center"><i class="fas fa-check-circle text-primary mr-3"></i> <span>Unlimited Database</span></li>
                                <li class="flex items-center"><i class="fas fa-check-circle text-primary mr-3"></i> <span>Gratis SSL</span></li>
                                <li class="flex items-center"><i class="fas fa-check-circle text-primary mr-3"></i> <span>Dukungan 24/7</span></li>
                            </ul>
                        </div>
                        <div class="p-8">
                            <a href="{{ route('order.create', $product) }}"
                               class="block w-full text-center px-6 py-3 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all duration-200">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="md:col-span-3 text-center text-gray-500 py-10">
                        Belum ada produk yang tersedia saat ini.
                    </p>
                @endforelse
            </div>
        </div>
    </section>

@endsection