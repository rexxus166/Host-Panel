@extends('layouts.app')

@section('title', 'Tagihan')
@section('page_title', 'Tagihan')

@php
// DUMMY DATA: Nanti Anda bisa ganti array ini dengan data dari database
$invoices = [
    (object)['id' => 'INV-2025-003', 'tanggal_terbit' => '15 Sep 2025', 'tanggal_jatuh_tempo' => '22 Sep 2025', 'total' => 250000, 'status' => 'Lunas'],
    (object)['id' => 'INV-2025-002', 'tanggal_terbit' => '15 Agu 2025', 'tanggal_jatuh_tempo' => '22 Agu 2025', 'total' => 250000, 'status' => 'Lunas'],
    (object)['id' => 'INV-2025-001', 'tanggal_terbit' => '15 Jul 2025', 'tanggal_jatuh_tempo' => '22 Jul 2025', 'total' => 150000, 'status' => 'Jatuh Tempo'],
];
@endphp

@section('content')
<div class="bg-white p-4 sm:p-6 rounded-playful-md shadow-border-offset border-2 border-dark">
    <div class="mb-6">
        <h1 class="text-h3 font-exo2 text-dark">Riwayat Tagihan Anda</h1>
        <p class="text-gray-500">Berikut adalah daftar semua tagihan untuk layanan Anda.</p>
    </div>

    {{-- ====================================================================== --}}
    {{-- ## TAMPILAN DESKTOP (Muncul di layar md ke atas) --}}
    {{-- ====================================================================== --}}
    <div class="hidden md:block">
        <div class="space-y-4">
            {{-- Header Daftar --}}
            <div class="flex items-center text-sm font-bold text-gray-500 border-b-2 border-dark pb-3">
                <div class="w-3/12">NOMOR TAGIHAN</div>
                <div class="w-2/12 text-center">STATUS</div>
                <div class="w-3/12 text-center">TANGGAL JATUH TEMPO</div>
                <div class="w-2/12 text-center">TOTAL</div>
                <div class="w-2/12 text-right">AKSI</div>
            </div>

            @forelse ($invoices as $invoice)
                <div class="flex items-center bg-gray-50 p-4 rounded-playful-lg border-2 border-dark">
                    <div class="w-3/12 font-bold text-dark">{{ $invoice->id }}</div>
                    <div class="w-2/12 text-center">
                        <span class="px-2 py-1 font-semibold leading-tight text-xs rounded-full
                            @if($invoice->status == 'Lunas') bg-green-100 text-green-700 @endif
                            @if($invoice->status == 'Belum Dibayar') bg-yellow-100 text-yellow-700 @endif
                            @if($invoice->status == 'Jatuh Tempo') bg-red-100 text-red-700 @endif
                        ">{{ $invoice->status }}</span>
                    </div>
                    <div class="w-3/12 text-center text-sm text-gray-600">{{ $invoice->tanggal_jatuh_tempo }}</div>
                    <div class="w-2/12 text-center text-sm font-bold text-dark">Rp {{ number_format($invoice->total, 0, ',', '.') }}</div>
                    <div class="w-2/12 text-right">
                         <a href="#" class="px-4 py-2 bg-gray-200 text-dark rounded-playful-sm text-sm font-semibold hover:bg-gray-300 transition-all duration-200 border-2 border-dark shadow-border-offset">
                            Lihat
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 border-2 border-dashed border-gray-300 rounded-playful-md"><p>Belum ada tagihan.</p></div>
            @endforelse
        </div>
    </div>

    {{-- ====================================================================== --}}
    {{-- ## TAMPILAN MOBILE (Muncul di layar kecil, di bawah md) --}}
    {{-- ====================================================================== --}}
    <div class="md:hidden">
        <div class="space-y-4">
            @forelse ($invoices as $invoice)
                <div class="bg-gray-50 p-4 rounded-playful-lg border-2 border-dark space-y-4">
                    <div>
                        <p class="font-bold font-exo2 text-lg text-dark">{{ $invoice->id }}</p>
                        <p class="text-sm text-gray-500">Diterbitkan: {{ $invoice->tanggal_terbit }}</p>
                    </div>
                    <div class="border-t border-gray-200"></div>
                    <div class="text-sm space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Status:</span>
                            <span class="px-2 py-1 font-semibold leading-tight text-xs rounded-full
                                @if($invoice->status == 'Lunas') bg-green-100 text-green-700 @endif
                                @if($invoice->status == 'Belum Dibayar') bg-yellow-100 text-yellow-700 @endif
                                @if($invoice->status == 'Jatuh Tempo') bg-red-100 text-red-700 @endif
                            ">{{ $invoice->status }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Jatuh Tempo:</span>
                            <span class="font-bold text-dark">{{ $invoice->tanggal_jatuh_tempo }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Total:</span>
                            <span class="font-bold text-dark">Rp {{ number_format($invoice->total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <a href="#" class="block w-full text-center px-4 py-3 bg-gray-200 text-dark rounded-playful-sm text-base font-bold hover:bg-gray-300 transition-all duration-200 border-2 border-dark shadow-border-offset">
                        Lihat Tagihan
                    </a>
                </div>
            @empty
                <div class="text-center py-10 border-2 border-dashed border-gray-300 rounded-playful-md"><p>Belum ada tagihan.</p></div>
            @endforelse
        </div>
    </div>

</div>
@endsection