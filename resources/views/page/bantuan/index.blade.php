@extends('layouts.app')

@section('title', 'Pusat Bantuan')
@section('page_title', 'Pusat Bantuan')

@php
// DUMMY DATA: Nanti Anda bisa ganti array ini dengan data dari database
$tickets = [
    (object)['id' => 'TICKET-002', 'subjek' => 'Tidak bisa login ke cPanel', 'update_terakhir' => 'Kemarin', 'status' => 'Dibalas'],
    (object)['id' => 'TICKET-001', 'subjek' => 'Bantuan instalasi WordPress', 'update_terakhir' => '3 hari lalu', 'status' => 'Ditutup'],
];
@endphp

@section('content')
<div class="space-y-8">
    
    {{-- KARTU AKSI UNTUK MEMBUAT TIKET BARU --}}
    <div class="bg-white p-6 rounded-playful-md shadow-border-offset border-2 border-dark text-center">
        <i class="fas fa-life-ring fa-3x text-primary mb-3"></i>
        <h2 class="text-h3 font-exo2 text-dark">Butuh Bantuan?</h2>
        <p class="text-gray-500 mt-1 mb-4 max-w-md mx-auto">Jika Anda mengalami kendala atau memiliki pertanyaan, jangan ragu untuk membuat tiket bantuan baru.</p>
        <a href="#" class="inline-block px-8 py-3 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all duration-200">
            <i class="fas fa-plus-circle mr-2"></i> Buat Tiket Bantuan Baru
        </a>
    </div>

    {{-- DAFTAR RIWAYAT TIKET BANTUAN --}}
    <div class="bg-white p-4 sm:p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
        <h3 class="text-h4 font-exo2 text-dark mb-6">Riwayat Tiket Bantuan Anda</h3>

        {{-- Tampilan Desktop --}}
        <div class="hidden md:block">
             <div class="space-y-4">
                <div class="flex items-center text-sm font-bold text-gray-500 border-b-2 border-dark pb-3">
                    <div class="w-6/12">SUBJEK TIKET</div>
                    <div class="w-2/12 text-center">STATUS</div>
                    <div class="w-2/12 text-center">UPDATE TERAKHIR</div>
                    <div class="w-2/12 text-right">AKSI</div>
                </div>
                @forelse ($tickets as $ticket)
                    <div class="flex items-center bg-gray-50 p-4 rounded-playful-lg border-2 border-dark">
                        <div class="w-6/12 font-bold text-dark">{{ $ticket->subjek }}</div>
                        <div class="w-2/12 text-center">
                            <span class="px-2 py-1 font-semibold leading-tight text-xs rounded-full
                                @if($ticket->status == 'Dibalas') bg-green-100 text-green-700 @endif
                                @if($ticket->status == 'Dibuka') bg-blue-100 text-blue-700 @endif
                                @if($ticket->status == 'Ditutup') bg-gray-200 text-gray-600 @endif
                            ">{{ $ticket->status }}</span>
                        </div>
                        <div class="w-2/12 text-center text-sm text-gray-600">{{ $ticket->update_terakhir }}</div>
                        <div class="w-2/12 text-right">
                             <a href="#" class="px-4 py-2 bg-gray-200 text-dark rounded-playful-sm text-sm font-semibold hover:bg-gray-300 transition-all duration-200 border-2 border-dark shadow-border-offset">
                                Lihat
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 border-2 border-dashed border-gray-300 rounded-playful-md"><p>Anda belum pernah membuat tiket bantuan.</p></div>
                @endforelse
            </div>
        </div>

        {{-- Tampilan Mobile --}}
        <div class="md:hidden">
            <div class="space-y-4">
                @forelse ($tickets as $ticket)
                    <div class="bg-gray-50 p-4 rounded-playful-lg border-2 border-dark space-y-4">
                        <p class="font-bold text-lg text-dark break-all">{{ $ticket->subjek }}</p>
                        <div class="border-t border-gray-200"></div>
                        <div class="text-sm space-y-2">
                             <div class="flex justify-between items-center">
                                <span class="text-gray-600">Status:</span>
                                 <span class="px-2 py-1 font-semibold leading-tight text-xs rounded-full
                                    @if($ticket->status == 'Dibalas') bg-green-100 text-green-700 @endif
                                    @if($ticket->status == 'Dibuka') bg-blue-100 text-blue-700 @endif
                                    @if($ticket->status == 'Ditutup') bg-gray-200 text-gray-600 @endif
                                ">{{ $ticket->status }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Update Terakhir:</span>
                                <span class="font-bold text-dark">{{ $ticket->update_terakhir }}</span>
                            </div>
                        </div>
                        <a href="#" class="block w-full text-center px-4 py-3 bg-gray-200 text-dark rounded-playful-sm text-base font-bold hover:bg-gray-300 transition-all duration-200 border-2 border-dark shadow-border-offset">
                            Lihat Detail
                        </a>
                    </div>
                @empty
                    <div class="text-center py-10 border-2 border-dashed border-gray-300 rounded-playful-md"><p>Anda belum pernah membuat tiket bantuan.</p></div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection