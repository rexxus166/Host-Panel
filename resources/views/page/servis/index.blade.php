@extends('layouts.app')

@section('title', 'Layanan Saya')
@section('page_title', 'Layanan Saya')

@section('content')
<div class="bg-white p-4 sm:p-6 rounded-playful-md shadow-border-offset border-2 border-dark">

    {{-- ====================================================================== --}}
    {{-- ## TAMPILAN DESKTOP: DAFTAR LUAS & BERSIH (Muncul di layar md ke atas) --}}
    {{-- ====================================================================== --}}
    <div class="hidden md:block">
        <div class="space-y-4">
            {{-- Header Daftar --}}
            <div class="flex items-center text-sm font-bold text-gray-500 border-b-2 border-dark pb-3">
                <div class="w-5/12">NAMA LAYANAN</div>
                <div class="w-2/12 text-center">STATUS</div>
                <div class="w-3/12 text-center">TANGGAL PESAN</div>
                <div class="w-2/12 text-right">AKSI</div>
            </div>

            @forelse ($services as $service)
                {{-- Baris Item Layanan --}}
                <div class="flex items-center bg-gray-50 hover:bg-gray-100 p-4 rounded-playful-lg border-2 border-dark transition-colors duration-200">
                    {{-- Kolom 1: Domain & Paket --}}
                    <div class="w-5/12">
                        <p class="font-bold font-exo2 text-lg text-dark break-all">{{ $service->domain }}</p>
                        <p class="text-sm text-gray-600">{{ $service->product->name }}</p>
                    </div>
                    {{-- Kolom 2: Status --}}
                    <div class="w-2/12 text-center">
                        <span class="px-2 py-1 font-semibold leading-tight text-xs rounded-full
                            @if($service->status == 'active') bg-green-100 text-green-700 @endif
                            @if($service->status == 'pending') bg-yellow-100 text-yellow-700 @endif
                            @if($service->status == 'suspended') bg-red-100 text-red-700 @endif
                        ">
                            {{ ucfirst($service->status) }}
                        </span>
                    </div>
                    {{-- Kolom 3: Tanggal --}}
                    <div class="w-3/12 text-center text-sm text-gray-600">
                        {{ $service->created_at->format('d F Y') }}
                    </div>
                    {{-- Kolom 4: Aksi --}}
                    <div class="w-2/12 text-right">
                         <a href="{{ route('user.service.show', $service) }}" class="px-4 py-2 bg-secondary text-white rounded-playful-sm text-sm font-semibold hover:bg-opacity-80 transition-all duration-200 shadow-border-offset border-2 border-dark">
                            Kelola
                        </a>
                    </div>
                </div>
            @empty
                {{-- State jika tidak ada layanan --}}
                <div class="text-center py-10 border-2 border-dashed border-gray-300 rounded-playful-md">
                     <p class="text-gray-500">Anda belum memiliki layanan hosting yang aktif.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- ====================================================================== --}}
    {{-- ## TAMPILAN MOBILE: KARTU VERTIKAL (Muncul di layar kecil, di bawah md) --}}
    {{-- ====================================================================== --}}
    <div class="md:hidden">
        <div class="space-y-4">
            @forelse ($services as $service)
                {{-- Kartu Item Layanan --}}
                <div class="bg-gray-50 p-4 rounded-playful-lg border-2 border-dark space-y-4">
                    {{-- Bagian Info Utama --}}
                    <div>
                        <p class="font-bold font-exo2 text-lg text-dark break-all">{{ $service->domain }}</p>
                        <p class="text-sm text-gray-600">{{ $service->product->name }}</p>
                    </div>

                    {{-- Garis Pemisah --}}
                    <div class="border-t border-gray-200"></div>
                    
                    {{-- Bagian Detail (Status & Tanggal) --}}
                    <div class="text-sm space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Status:</span>
                            <span class="px-2 py-1 font-semibold leading-tight text-xs rounded-full
                                @if($service->status == 'active') bg-green-100 text-green-700 @endif
                                @if($service->status == 'pending') bg-yellow-100 text-yellow-700 @endif
                                @if($service->status == 'suspended') bg-red-100 text-red-700 @endif
                            ">
                                {{ ucfirst($service->status) }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Dipesan:</span>
                            <span class="font-bold text-dark">{{ $service->created_at->format('d F Y') }}</span>
                        </div>
                    </div>
                    
                    {{-- Bagian Aksi (Tombol) --}}
                    <a href="{{ route('user.service.show', $service) }}" class="block w-full text-center px-4 py-3 bg-secondary text-white rounded-playful-sm text-base font-bold hover:bg-opacity-80 transition-all duration-200 shadow-border-offset border-2 border-dark">
                        Kelola
                    </a>
                </div>
            @empty
                 {{-- State jika tidak ada layanan --}}
                <div class="text-center py-10 border-2 border-dashed border-gray-300 rounded-playful-md">
                     <p class="text-gray-500">Anda belum memiliki layanan hosting yang aktif.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Paginasi (Berlaku untuk keduanya) --}}
    <div class="mt-8">
        {{ $services->links() }}
    </div>
</div>
@endsection