@extends('layouts.public')

@section('content')

    {{-- HERO SECTION --}}
    <section class="bg-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-h1 lg:text-6xl font-exo2 text-dark leading-tight">
                Hosting Cepat & Andal untuk Proyek Hebat Anda
            </h1>
            <p class="mt-6 text-lg text-gray-600 max-w-2xl mx-auto">
                Luncurkan website Anda dengan performa maksimal. Kami menyediakan infrastruktur terbaik dengan harga yang terjangkau.
            </p>
            <a href="#pricing" 
               class="mt-8 inline-block px-8 py-4 bg-primary text-dark text-lg font-bold rounded-playful-sm border-2 border-dark shadow-border-offset-lg hover:bg-opacity-80 transition-all duration-200 transform hover:-translate-y-1">
                Lihat Paket
            </a>
        </div>
    </section>

    {{-- FEATURES SECTION --}}
    <section id="features" class="bg-gray-100 py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-h2 font-exo2 text-dark">Kenapa Memilih HostPanel?</h2>
                <p class="mt-4 text-gray-600">Fitur-fitur unggulan yang kami tawarkan.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="bg-white p-8 rounded-playful-md shadow-border-offset border-2 border-dark">
                    <i class="fas fa-rocket fa-3x text-secondary"></i>
                    <h3 class="text-h4 font-exo2 mt-4">Super Cepat</h3>
                    <p class="mt-2 text-gray-600">Dibangun di atas SSD NVMe untuk kecepatan loading website yang maksimal.</p>
                </div>
                <div class="bg-white p-8 rounded-playful-md shadow-border-offset border-2 border-dark">
                    <i class="fas fa-shield-alt fa-3x text-secondary"></i>
                    <h3 class="text-h4 font-exo2 mt-4">Aman & Terjamin</h3>
                    <p class="mt-2 text-gray-600">Proteksi DDoS dan SSL gratis untuk semua paket hosting Anda.</p>
                </div>
                <div class="bg-white p-8 rounded-playful-md shadow-border-offset border-2 border-dark">
                    <i class="fas fa-headset fa-3x text-secondary"></i>
                    <h3 class="text-h4 font-exo2 mt-4">Dukungan 24/7</h3>
                    <p class="mt-2 text-gray-600">Tim support kami siap membantu Anda kapan saja, siang dan malam.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- PRICING SECTION --}}
    <section id="pricing" class="bg-white py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-h2 font-exo2 text-dark">Paket Harga Kami</h2>
                <p class="mt-4 text-gray-600">Transparan, tanpa biaya tersembunyi.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($products as $product)
                    <div class="border-2 border-dark rounded-playful-lg flex flex-col">
                        <div class="p-8">
                            <h3 class="text-h3 font-exo2 text-dark">{{ $product->name }}</h3>
                            <p class="mt-4 text-h2 font-bold text-secondary">
                                Rp {{ number_format($product->price) }}<span class="text-lg font-normal text-gray-500">/bulan</span>
                            </p>
                        </div>
                        <div class="bg-gray-100 p-8 flex-grow">
                            <ul class="space-y-4 text-gray-700">
                                <li class="flex items-center"><i class="fas fa-check-circle text-primary mr-3"></i> <span><span class="font-bold">{{ $product->disk_space_gb }} GB</span> Penyimpanan SSD</span></li>
                                <li class="flex items-center"><i class="fas fa-check-circle text-primary mr-3"></i> <span><span class="font-bold">{{ $product->bandwidth_gb }} GB</span> Bandwidth</span></li>
                                <li class="flex items-center"><i class="fas fa-check-circle text-primary mr-3"></i> <span>Unlimited Database</span></li>
                                <li class="flex items-center"><i class="fas fa-check-circle text-primary mr-3"></i> <span>Gratis SSL</span></li>
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
                    <p class="md:col-span-3 text-center text-gray-500">Belum ada produk yang tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

@endsection