@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div>
    {{-- Header Sambutan --}}
    <div class="mb-8">
        <h1 class="text-h2 font-exo2 text-dark">Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p class="text-gray-500">Selamat datang di member area Anda.</p>
    </div>

    {{-- Panel Layanan Aktif (Desain Baru dengan Kartu) --}}
    <div>
        <h3 class="text-h4 font-exo2 text-dark mb-6">Layanan Aktif Anda</h3>
        
        {{-- Jika tidak ada layanan, tampilkan pesan ini --}}
        @if($services->isEmpty())
            <div class="text-center py-10 bg-white border-2 border-dashed border-gray-300 rounded-playful-md">
                <i class="fas fa-server fa-3x text-gray-400 mb-4"></i>
                <p class="text-gray-500">Anda belum memiliki layanan hosting yang aktif.</p>
                <a href="{{ route('produk.index') }}"
                    class="mt-4 inline-block px-5 py-2 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all duration-200">
                    Pesan Layanan Sekarang
                </a>
            </div>
        @else
            {{-- Container Grid untuk Kartu Layanan --}}
            {{-- 1 kolom di mobile, 2 kolom di layar besar (lg) --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                {{-- Looping untuk setiap layanan yang dimiliki user --}}
                @foreach ($services as $service)
                    {{-- Awal dari satu Kartu Layanan --}}
                    {{-- flex-col dan flex-grow agar tombol selalu di bawah --}}
                    <div class="bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark flex flex-col">
                        
                        {{-- Konten utama kartu --}}
                        <div class="flex-grow">
                            {{-- Bagian Atas: Status dan Paket --}}
                            <div class="flex justify-between items-center mb-2">
                                <p class="text-sm font-bold text-gray-600">{{ $service->product->name }}</p>
                                <span class="px-2 py-1 font-semibold leading-tight text-xs rounded-full
                                    @if($service->status == 'active') bg-green-100 text-green-700 @endif
                                    @if($service->status == 'pending') bg-yellow-100 text-yellow-700 @endif
                                    @if($service->status == 'suspended') bg-red-100 text-red-700 @endif
                                ">
                                    {{ ucfirst($service->status) }}
                                </span>
                            </div>

                            {{-- Bagian Tengah: Nama Domain (Dibuat Besar & Jelas) --}}
                            <div class="mb-4">
                                <p class="text-h4 font-exo2 text-dark break-all">{{ $service->domain }}</p>
                            </div>
                        </div>

                        {{-- Bagian Bawah: Tombol Aksi (CTA) --}}
                        {{-- mt-auto akan mendorong tombol ini ke bagian paling bawah kartu --}}
                        <div class="mt-auto">
                             <a href="{{ route('user.service.show', $service) }}" class="block w-full text-center px-4 py-3 bg-primary text-dark font-bold text-base rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all duration-200">
                                Kelola Layanan
                            </a>
                        </div>
                    </div>
                    {{-- Akhir dari satu Kartu Layanan --}}
                @endforeach

            </div>
        @endif
    </div>

    {{-- Panel Aksi Cepat (tetap sama) --}}
    <div class="mt-8 bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
         <h3 class="text-h4 font-exo2 text-dark mb-4">Aksi Cepat</h3>
         <div class="flex flex-wrap gap-4">
              <a href="{{ route('produk.index') }}" 
                  class="px-5 py-2 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all duration-200">
                  <i class="fas fa-file-invoice-dollar mr-2"></i> Produk
              </a>

              <a href="{{ route('tagihan') }}" 
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