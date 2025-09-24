@extends('layouts.public')

@section('title', 'Kontak Kami')

@section('content')

    {{-- HERO SECTION --}}
    <section class="bg-white py-20 border-b border-gray-200">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-h1 lg:text-5xl font-exo2 text-dark leading-tight">
                Hubungi Kami
            </h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Punya pertanyaan, kritik, atau saran? Jangan ragu untuk menghubungi kami melalui form di bawah ini.
            </p>
        </div>
    </section>

    {{-- CONTACT FORM & INFO SECTION --}}
    <section class="bg-gray-50 py-20">
        <div class="container mx-auto px-6 max-w-2xl"> {{-- max-w diubah agar tidak terlalu lebar --}}
            {{-- REVISI: Menghapus lg:grid-cols-2 agar selalu 1 kolom --}}
            <div class="grid grid-cols-1 gap-12">

                {{-- Kolom Kiri: Form Kontak --}}
                <div class="bg-white border-2 border-dark rounded-playful-lg shadow-border-offset p-6 md:p-8">
                    <h2 class="text-h3 font-exo2 text-dark mb-6">Kirim Pesan</h2>
                    
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        {{-- Nama Lengkap --}}
                        <div>
                            <label for="name" class="block text-dark font-bold mb-2">Nama Lengkap</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name"
                                placeholder="Masukkan nama Anda"
                                class="w-full px-4 py-3 border-2 border-dark rounded-playful-sm focus:outline-none focus:ring-2 focus:ring-primary"
                                required
                            >
                        </div>
                        
                        {{-- Alamat Email --}}
                        <div>
                            <label for="email" class="block text-dark font-bold mb-2">Alamat Email</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email"
                                placeholder="contoh@email.com"
                                class="w-full px-4 py-3 border-2 border-dark rounded-playful-sm focus:outline-none focus:ring-2 focus:ring-primary"
                                required
                            >
                        </div>

                        {{-- Subjek --}}
                        <div>
                            <label for="subject" class="block text-dark font-bold mb-2">Subjek</label>
                            <input 
                                type="text" 
                                id="subject" 
                                name="subject"
                                placeholder="Subjek pesan Anda"
                                class="w-full px-4 py-3 border-2 border-dark rounded-playful-sm focus:outline-none focus:ring-2 focus:ring-primary"
                                required
                            >
                        </div>

                        {{-- Pesan --}}
                        <div>
                            <label for="message" class="block text-dark font-bold mb-2">Pesan</label>
                            <textarea 
                                id="message" 
                                name="message" 
                                rows="5"
                                placeholder="Tuliskan pesan Anda di sini..."
                                class="w-full px-4 py-3 border-2 border-dark rounded-playful-sm focus:outline-none focus:ring-2 focus:ring-primary"
                                required
                            ></textarea>
                        </div>

                        {{-- Tombol Kirim --}}
                        <div>
                            <button 
                                type="submit"
                                class="w-full px-6 py-3 bg-primary text-dark font-bold rounded-playful-sm border-2 border-dark shadow-border-offset hover:bg-opacity-80 transition-all duration-200 transform hover:-translate-y-1">
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Informasi Kontak (Sekarang di bawah) --}}
                <div class="space-y-8">
                    <h2 class="text-h3 font-exo2 text-dark">Informasi Lain</h2>
                    
                    <div class="flex items-start gap-4">
                        <div class="mt-1"><i class="fas fa-envelope fa-2x text-secondary"></i></div>
                        <div>
                            <h4 class="font-bold text-dark text-lg">Email</h4>
                            <p class="text-gray-600">Hubungi kami via email untuk pertanyaan umum.</p>
                            <a href="mailto:support@hostpanel.com" class="text-primary font-semibold hover:underline">support@hostpanel.com</a>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="mt-1"><i class="fas fa-phone-alt fa-2x text-secondary"></i></div>
                        <div>
                            <h4 class="font-bold text-dark text-lg">Telepon</h4>
                            <p class="text-gray-600">Layanan pelanggan siap membantu di jam kerja.</p>
                            <a href="tel:+622150822525" class="text-primary font-semibold hover:underline">(021) 5082-2525</a>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="mt-1"><i class="fas fa-map-marker-alt fa-2x text-secondary"></i></div>
                        <div>
                            <h4 class="font-bold text-dark text-lg">Alamat Kantor</h4>
                            <p class="text-gray-600">Jl. Teknologi Raya No. 123, <br>Kota Cyber, Jakarta, 12345</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection