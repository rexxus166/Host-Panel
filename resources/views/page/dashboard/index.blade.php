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
            <h3 class="text-h4 font-exo2 text-dark mb-6">Layanan Aktif Anda</h3>
            
            {{-- PERUBAHAN MULAI DI SINI --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="border-b-2 border-dark">
                        <tr>
                            <th class="p-3">Domain</th>
                            <th class="p-3">Paket</th>
                            <th class="p-3">Status</th>
                            <th class="p-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($services as $service)
                            <tr class="border-b border-gray-200">
                                <td class="p-3 font-bold text-dark">{{ $service->domain }}</td>
                                <td class="p-3 text-gray-600">{{ $service->product->name }}</td>
                                <td class="p-3">
                                    <span class="px-2 py-1 font-semibold leading-tight text-xs rounded-full
                                        @if($service->status == 'active') bg-green-100 text-green-700 @endif
                                        @if($service->status == 'pending') bg-yellow-100 text-yellow-700 @endif
                                        @if($service->status == 'suspended') bg-red-100 text-red-700 @endif
                                    ">
                                        {{ ucfirst($service->status) }}
                                    </span>
                                </td>
                                <td class="p-3 text-right">
                                    <a href="{{ route('user.service.show', $service) }}" class="px-4 py-2 bg-gray-200 text-dark font-bold text-sm rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-gray-300 transition-all duration-200">
                                        Kelola
                                    </a>
                                </td>
                            </tr>
                        @empty
                            {{-- Tampilan ini akan muncul jika user tidak punya layanan sama sekali --}}
                            <tr>
                                <td colspan="4">
                                    <div class="text-center py-10 border-2 border-dashed border-gray-300 rounded-playful-md mt-4">
                                        <i class="fas fa-server fa-3x text-gray-400 mb-4"></i>
                                        <p class="text-gray-500">Anda belum memiliki layanan hosting yang aktif.</p>
                                        <a href="{{ route('produk.index') }}"
                                            class="mt-4 inline-block px-5 py-2 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all duration-200">
                                            Pesan Layanan Sekarang
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- PERUBAHAN SELESAI --}}

        </div>

        {{-- Panel Aksi Cepat --}}
        <div class="mt-8 bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
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