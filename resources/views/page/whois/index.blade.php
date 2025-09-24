@extends('layouts.public')

@section('title', 'WHOIS Lookup')

@section('content')

    {{-- HERO SECTION --}}
    <section class="bg-white py-20 border-b border-gray-200">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-h1 lg:text-5xl font-exo2 text-dark leading-tight">
                WHOIS Lookup
            </h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Cari tahu detail domain secara cepat — informasi registrant, registrar, status, dan tanggal kadaluarsa.
            </p>
        </div>
    </section>

    {{-- WHOIS FORM --}}
    <section class="bg-gray-100 py-20">
        <div class="container mx-auto px-6 max-w-3xl">
            <div class="bg-white border-2 border-dark rounded-playful-lg shadow-border-offset p-6 md:p-8">
                <h2 class="text-h3 font-exo2 text-dark text-center mb-6">Masukkan Nama Domain</h2>
                
                <div class="max-w-xl mx-auto">
                    <form action="{{ route('lookup') }}#hasil" method="GET" class="flex flex-col md:flex-row gap-4">
                        
                        <input 
                            type="text" 
                            name="domain" 
                            placeholder="contoh: namadomain.com"
                            class="flex-1 w-full px-4 py-3 border-2 border-dark rounded-playful-sm focus:outline-none focus:ring-2 focus:ring-primary text-sm md:text-base"
                            value="{{ old('domain', $domain ?? '') }}"
                            required
                        >
                        <button 
                            type="submit"
                            class="px-6 py-3 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all text-sm md:text-base">
                            Cek WHOIS
                        </button>
                    </form>
                </div>

                @error('domain')
                    <p class="mt-4 text-red-500 text-sm text-center">{{ $message }}</p>
                @enderror
                
                @if(session('error'))
                    <p class="mt-4 text-red-500 text-sm text-center">{{ session('error') }}</p>
                @endif
            </div>
        </div>
    </section>

    {{-- WHOIS RESULT --}}
    {{-- Diperbarui untuk menampilkan tabel yang rapi --}}
    @if (!empty($whoisResult))
        <section id="hasil" class="bg-white py-20 scroll-mt-20">
            <div class="container mx-auto px-6 max-w-5xl">
                <h2 class="text-h2 font-exo2 text-dark mb-8 text-center">
                    Hasil WHOIS untuk <span class="text-primary">{{ $domain }}</span>
                </h2>
                <div class="bg-gray-50 border-2 border-dark rounded-playful-md shadow-border-offset p-6 md:p-8 overflow-x-auto">
                    {{-- Mengganti <pre> dengan tabel --}}
                    <table class="min-w-full bg-white">
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($whoisResult as $key => $value)
                                {{-- PERBAIKAN: Handle nameservers yang berupa array --}}
                                @if ($key == 'nameservers' && is_array($value))
                                    <tr class="hover:bg-gray-100 transition-colors duration-200">
                                        <td class="px-6 py-4 font-semibold text-dark w-1/3 align-top">
                                            {{ ucwords(str_replace('_', ' ', $key)) }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-800 font-mono break-all">
                                            {{-- Loop untuk menampilkan setiap nameserver --}}
                                            @foreach ($value as $ns)
                                                {{ $ns }}<br>
                                            @endforeach
                                        </td>
                                    </tr>
                                {{-- Handle nilai-nilai biasa (string, angka) --}}
                                @elseif (is_scalar($value) && $value !== null && $value !== '')
                                    <tr class="hover:bg-gray-100 transition-colors duration-200">
                                        <td class="px-6 py-4 font-semibold text-dark w-1/3 align-top">
                                            {{-- Membuat key lebih mudah dibaca --}}
                                            {{ ucwords(str_replace('_', ' ', $key)) }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-800 font-mono break-all">
                                            {{-- PERBAIKAN: Format tanggal agar mudah dibaca --}}
                                            @if (in_array($key, ['create_date', 'update_date', 'expire_date']))
                                                {{ \Carbon\Carbon::parse($value)->isoFormat('dddd, D MMMM YYYY [pukul] HH:mm') }}
                                            @else
                                                {{ $value }}
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    @endif

@endsection