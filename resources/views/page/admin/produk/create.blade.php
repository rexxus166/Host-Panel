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

            {{-- Deskripsi Produk --}}
            <div class="mb-4">
                <label for="description" class="block text-dark font-semibold mb-2">Deskripsi Produk</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner focus:outline-none focus:ring-2 focus:ring-secondary transition-shadow" 
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

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
                           placeholder="contoh: miomidev_unlimited" required>
                     @error('package_name_whm')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
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
                
                {{-- Tipe Paket (Dropdown) --}}
                <div class="mb-4">
                    <label for="type" class="block text-dark font-semibold mb-2">Tipe Paket</label>
                    <select id="type" name="type" class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner bg-white focus:outline-none focus:ring-2 focus:ring-secondary transition-shadow" required>
                        <option value="" disabled selected>-- Pilih Tipe --</option>
                        <option value="harian" @selected(old('type') == 'harian')>Harian</option>
                        <option value="bulanan" @selected(old('type') == 'bulanan')>Bulanan</option>
                        <option value="tahunan" @selected(old('type') == 'tahunan')>Tahunan</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Disk Space (diubah menjadi text) --}}
                <div class="mb-4">
                    <label for="disk_space_gb" class="block text-dark font-semibold mb-2">Disk Space</label>
                    <input type="text" id="disk_space_gb" name="disk_space_gb" value="{{ old('disk_space_gb') }}"
                           class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner focus:outline-none focus:ring-2 focus:ring-secondary transition-shadow" 
                           placeholder="Contoh: 20GB atau Unlimited" required>
                    @error('disk_space_gb')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Bandwidth (diubah menjadi text) --}}
                <div class="mb-4">
                    <label for="bandwidth_gb" class="block text-dark font-semibold mb-2">Bandwidth</label>
                    <input type="text" id="bandwidth_gb" name="bandwidth_gb" value="{{ old('bandwidth_gb') }}"
                           class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner focus:outline-none focus:ring-2 focus:ring-secondary transition-shadow" 
                           placeholder="Contoh: 100GB atau Unlimited" required>
                    @error('bandwidth_gb')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Fitur Domain Gratis --}}
            <div class="mt-6 border-t-2 border-dark pt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    {{-- Checkbox Gratis Domain --}}
                    <div class="mb-4">
                         <label for="has_free_domain" class="flex items-center space-x-3 cursor-pointer">
                             {{-- Input hidden untuk memastikan nilai '0' terkirim jika checkbox tidak dicentang --}}
                            <input type="hidden" name="has_free_domain" value="0">
                            <input type="checkbox" id="has_free_domain" name="has_free_domain" value="1" 
                                   @checked(old('has_free_domain'))
                                   class="form-checkbox h-5 w-5 text-primary border-2 border-dark rounded-md focus:ring-primary">
                            <span class="text-dark font-semibold">Dapat Gratis Domain?</span>
                        </label>
                         @error('has_free_domain')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pilihan TLD Domain Gratis --}}
                    <div class="mb-4">
                        <label for="free_domain_tld" class="block text-dark font-semibold mb-2">Pilihan Domain Gratis (TLD)</label>
                        <input type="text" id="free_domain_tld" name="free_domain_tld" value="{{ old('free_domain_tld') }}"
                               class="w-full px-4 py-2 border-2 border-dark rounded-playful-sm-inner" 
                               placeholder="Contoh: .com, .my.id, .id">
                        <p class="text-xs text-gray-500 mt-1">Wajib diisi jika gratis domain dicentang. Pisahkan dengan koma jika lebih dari satu.</p>
                        @error('free_domain_tld')
                           <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                       @enderror
                    </div>
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