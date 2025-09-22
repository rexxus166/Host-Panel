@extends('layouts.app')

@section('title', 'Konfirmasi Pesanan')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Kolom Kiri: Form Pemesanan --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
            <h1 class="text-h2 font-exo2 text-dark mb-6 border-b-2 border-dark pb-4">Konfirmasi Pesanan Anda</h1>

            <form action="{{ route('order.store', $product) }}" method="POST">
                @csrf
                <p class="mb-4 text-gray-600">
                    Anda akan memesan paket <strong class="text-secondary">{{ $product->name }}</strong>. 
                    Silakan masukkan nama domain lengkap yang ingin Anda gunakan untuk layanan ini.
                </p>

                <div class="mb-4">
                    <label for="domain" class="block text-dark font-semibold mb-2">Nama Domain</label>
                    <input type="text" id="domain" name="domain" value="{{ old('domain') }}" 
                           placeholder="contohdomain.com"
                           class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner focus:outline-none focus:ring-2 focus:ring-secondary transition-shadow" 
                           required>
                    @error('domain')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Masukkan nama domain lengkap (misal: websiteanda.com atau subdomain.id).</p>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" 
                            class="px-8 py-3 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all duration-200">
                        <i class="fas fa-check-circle mr-2"></i> Selesaikan Pesanan
                    </button>
                </div>
            </form>
        </div>

        {{-- Kolom Kanan: Ringkasan Produk --}}
        <div class="bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark h-fit">
             <h3 class="text-h4 font-exo2 text-dark mb-4">Ringkasan Paket</h3>
             <div class="border-2 border-dark rounded-playful-md">
                <div class="p-4">
                    <h4 class="text-h5 font-exo2 text-dark">{{ $product->name }}</h4>
                    <p class="mt-2 text-h3 font-bold text-secondary">
                        Rp {{ number_format($product->price) }}<span class="text-base font-normal text-gray-500">/bulan</span>
                    </p>
                </div>
                <div class="bg-gray-100 p-4 border-t-2 border-dark">
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-center"><i class="fas fa-check-circle text-primary mr-2"></i> <span>{{ $product->disk_space_gb }} GB SSD</span></li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-primary mr-2"></i> <span>{{ $product->bandwidth_gb }} GB Bandwidth</span></li>
                    </ul>
                </div>
             </div>
        </div>

    </div>
@endsection