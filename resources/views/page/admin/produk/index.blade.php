@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')

    <div class="bg-white p-6 rounded-playful-md shadow-border-offset">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-h2 font-exo2 text-dark">Manajemen Produk</h1>
            <a href="{{ route('admin.produk.create') }}" 
               class="px-5 py-2 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all duration-200">
                <i class="fas fa-plus mr-2"></i> Tambah Produk
            </a>
        </div>

        {{-- Pesan Sukses (sudah ada di layout, tapi bisa juga di sini jika mau spesifik) --}}
        {{-- @if (session('success'))
            <div class="bg-primary bg-opacity-20 border border-primary text-primary px-4 py-3 rounded-playful-sm relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif --}}

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-dark rounded-playful-md overflow-hidden">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="py-3 px-4 text-left font-semibold">ID</th>
                        <th class="py-3 px-4 text-left font-semibold">Nama Paket</th>
                        <th class="py-3 px-4 text-left font-semibold">Harga (Rp)</th>
                        <th class="py-3 px-4 text-left font-semibold">Disk (GB)</th>
                        <th class="py-3 px-4 text-left font-semibold">Bandwidth (GB)</th>
                        <th class="py-3 px-4 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-dark">
                    @forelse ($products as $product)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors duration-150">
                            <td class="py-3 px-4">{{ $product->id }}</td>
                            <td class="py-3 px-4">{{ $product->name }}</td>
                            <td class="py-3 px-4">{{ number_format($product->price) }}</td>
                            <td class="py-3 px-4">{{ $product->disk_space_gb }}</td>
                            <td class="py-3 px-4">{{ $product->bandwidth_gb }}</td>
                            <td class="py-3 px-4 flex space-x-2">
                                <a href="{{ route('admin.produk.edit', $product) }}" class="px-3 py-1 bg-secondary text-white rounded-playful-sm text-sm font-semibold hover:bg-purple transition-colors duration-200">Edit</a>
                                <form action="{{ route('admin.produk.destroy', $product) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini secara permanen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-playful-sm text-sm font-semibold hover:bg-red-700 transition-colors duration-200">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-5 px-4 text-center text-gray-500">Belum ada data produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection