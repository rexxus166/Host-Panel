@extends('layouts.admin')

@section('title', 'Detail Layanan')

@section('content')
    <div>
        {{-- Header Halaman --}}
        <div class="mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.service') }}" class="text-gray-400 hover:text-secondary">
                    <i class="fas fa-arrow-left fa-lg"></i>
                </a>
                <div>
                    <h1 class="text-h2 font-exo2 text-dark">Detail Layanan</h1>
                    <p class="text-gray-500 font-bold">{{ $service->domain }}</p>
                </div>
            </div>
        </div>

        {{-- Konten Utama --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Kolom Kiri: Informasi --}}
            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
                    <h3 class="text-h4 font-exo2 text-dark mb-4 border-b-2 border-dark pb-2">Informasi Pengguna</h3>
                    <div class="space-y-3 text-dark">
                        <div class="flex justify-between">
                            <span class="font-semibold">Nama:</span>
                            <span>{{ $service->user->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold">Email:</span>
                            <span>{{ $service->user->email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold">Role:</span>
                            <span>{{ ucfirst($service->user->role) }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
                    <h3 class="text-h4 font-exo2 text-dark mb-4 border-b-2 border-dark pb-2">Informasi Layanan</h3>
                    <div class="space-y-3 text-dark">
                        <div class="flex justify-between">
                            <span class="font-semibold">ID Layanan:</span>
                            <span>#{{ $service->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold">Paket:</span>
                            <span>{{ $service->product->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold">Tanggal Pesan:</span>
                            <span>{{ $service->created_at->format('d F Y') }}</span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Kolom Kanan: Status & Aksi --}}
            <div class="bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark h-fit">
                <h3 class="text-h4 font-exo2 text-dark mb-4">Status & Aksi</h3>
                <div class="flex justify-between items-center mb-6">
                    <span class="font-semibold">Status Saat Ini:</span>
                    <span class="px-2 py-1 font-semibold leading-tight text-xs rounded-full
                        @if($service->status == 'active') bg-green-100 text-green-700 @endif
                        @if($service->status == 'pending') bg-yellow-100 text-yellow-700 @endif
                        @if($service->status == 'suspended') bg-orange text-white @endif
                        @if($service->status == 'terminated') bg-red-600 text-white @endif
                    ">
                        {{ ucfirst($service->status) }}
                    </span>
                </div>
                
                {{-- Tombol Aksi Admin --}}
                <div class="space-y-3 border-t-2 border-dark pt-4">
                    <button class="w-full text-center px-4 py-2 font-bold rounded-playful-sm border-2 border-dark shadow-border-offset transition-all bg-secondary text-white hover:bg-opacity-80">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login ke cPanel User
                    </button>
                    
                    {{-- Form untuk Aktivasi --}}
                    @if($service->status == 'pending')
                    <form action="{{ route('admin.services.updateStatus', $service) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="active">
                        <button type="submit" class="w-full text-center px-4 py-2 font-bold rounded-playful-sm border-2 border-dark shadow-border-offset transition-all bg-primary text-dark hover:bg-opacity-80">
                            <i class="fas fa-check-circle mr-2"></i> Aktifkan Layanan
                        </button>
                    </form>
                    @endif

                    {{-- Form untuk Suspend --}}
                    @if($service->status == 'active')
                    <form action="{{ route('admin.services.updateStatus', $service) }}" method="POST" onsubmit="return confirm('Anda yakin ingin men-suspend layanan ini?');">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="suspended">
                        <button type="submit" class="w-full text-center px-4 py-2 font-bold rounded-playful-sm border-2 border-dark shadow-border-offset transition-all bg-orange text-white hover:bg-opacity-80">
                            <i class="fas fa-pause-circle mr-2"></i> Suspend Layanan
                        </button>
                    </form>
                    @endif
                    
                    {{-- Form untuk Aktifkan Kembali (Unsuspend) --}}
                    @if($service->status == 'suspended')
                    <form action="{{ route('admin.services.updateStatus', $service) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="active">
                        <button type="submit" class="w-full text-center px-4 py-2 font-bold rounded-playful-sm border-2 border-dark shadow-border-offset transition-all bg-green-500 text-white hover:bg-green-600">
                            <i class="fas fa-play-circle mr-2"></i> Aktifkan Kembali
                        </button>
                    </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection