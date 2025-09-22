@extends('layouts.app')

@section('title', 'Layanan Saya')

@section('content')
    <div class="bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-h2 font-exo2 text-dark">Layanan Saya</h1>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-dark rounded-playful-md overflow-hidden">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="py-3 px-4 text-left font-semibold">Domain</th>
                        <th class="py-3 px-4 text-left font-semibold">Paket Layanan</th>
                        <th class="py-3 px-4 text-left font-semibold">Tanggal Pesan</th>
                        <th class="py-3 px-4 text-left font-semibold">Status</th>
                        <th class="py-3 px-4 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-dark">
                    @forelse ($services as $service)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4 font-bold">{{ $service->domain }}</td>
                            <td class="py-3 px-4">{{ $service->product->name }}</td>
                            <td class="py-3 px-4">{{ $service->created_at->format('d F Y') }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 font-semibold leading-tight text-xs rounded-full
                                    @if($service->status == 'active') bg-green-100 text-green-700 @endif
                                    @if($service->status == 'pending') bg-yellow-100 text-yellow-700 @endif
                                    @if($service->status == 'suspended') bg-red-100 text-red-700 @endif
                                ">
                                    {{ ucfirst($service->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('user.service.show', $service) }}" class="px-3 py-1 bg-secondary text-white rounded-playful-sm text-sm font-semibold hover:bg-purple">Kelola</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-10 px-4 text-center text-gray-500">
                                <i class="fas fa-server fa-2x text-gray-400 mb-2"></i>
                                <p>Anda belum memiliki layanan aktif.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $services->links() }}
        </div>
    </div>
@endsection