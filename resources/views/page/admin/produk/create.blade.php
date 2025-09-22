@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')

@section('content')
    <div class="bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
        <div class="flex justify-between items-center mb-6 border-b-2 border-dark pb-4">
            <h1 class="text-h2 font-exo2 text-dark">Tambah Produk Baru</h1>
            <a href="{{ route('admin.produk') }}" 
               class="px-5 py-2 bg-gray-200 text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-gray-300 transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        {{-- Formulir akan mengirim data ke route 'admin.produk.store' menggunakan method POST --}}
        <form action="{{ route('admin.produk.store') }}" method="POST">
            @csrf  {{-- Token keamanan wajib di Laravel --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nama Paket --}}
                <div class="mb-4">
                    <label for="name" class="block text-dark font-semibold mb-2">Nama Paket</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                           class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner focus:outline-none focus:ring-2 focus:ring-secondary transition-shadow" 
                           required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nama Package di WHM --}}
                <div class="mb-4">
                    <label for="package_name_whm" class="block text-dark font-semibold mb-2">Nama Package di WHM</label>
                    <input type="text" id="package_name_whm" name="package_name_whm" value="{{ old('package_name_whm') }}"
                        class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner" 
                        required>
                    <p class="text-xs text-gray-500 mt-1">Nama paket yang sama persis seperti di WHM (contoh: miomidev_unlimited).</p>
                </div>

                {{-- Harga --}}
                <div class="mb-4">
                    <label for="price" class="block text-dark font-semibold mb-2">Harga (Rp)</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}"
                           class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner focus:outline-none focus:ring-2 focus:ring-secondary transition-shadow" 
                           required>
                     @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Disk Space --}}
                <div class="mb-4">
                    <label for="disk_space_gb" class="block text-dark font-semibold mb-2">Disk Space (GB)</label>
                    <input type="number" id="disk_space_gb" name="disk_space_gb" value="{{ old('disk_space_gb') }}"
                           class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner focus:outline-none focus:ring-2 focus:ring-secondary transition-shadow" 
                           required>
                    @error('disk_space_gb')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Bandwidth --}}
                <div class="mb-4">
                    <label for="bandwidth_gb" class="block text-dark font-semibold mb-2">Bandwidth (GB)</label>
                    <input type="number" id="bandwidth_gb" name="bandwidth_gb" value="{{ old('bandwidth_gb') }}"
                           class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner focus:outline-none focus:ring-2 focus:ring-secondary transition-shadow" 
                           required>
                    @error('bandwidth_gb')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" 
                        class="px-8 py-3 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all duration-200">
                    <i class="fas fa-save mr-2"></i> Simpan Produk
                </button>
            </div>

        </form>
    </div>
@endsection