@extends('layouts.public')

@section('title', 'Syarat dan Ketentuan Layanan')

@section('content')

    {{-- HERO SECTION --}}
    <section class="bg-white py-20 border-b border-gray-200">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-h1 lg:text-5xl font-exo2 text-dark leading-tight">
                Syarat dan Ketentuan Layanan
            </h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Terakhir diperbarui: 24 September 2025
            </p>
        </div>
    </section>

    {{-- CONTENT SECTION --}}
    <section class="bg-gray-50 py-20">
        <div class="container mx-auto px-6 max-w-4xl">
            <div class="bg-white border-2 border-dark rounded-playful-lg shadow-border-offset p-8 md:p-10">
                
                {{-- Gunakan class 'prose' untuk styling teks default yang rapi --}}
                <div class="prose max-w-none prose-h2:font-exo2 prose-h2:text-dark prose-h3:font-exo2 prose-h3:text-dark">
                    <h2>1. Penerimaan Ketentuan</h2>
                    <p>
                        Dengan mengakses dan menggunakan layanan dari <strong>{{ config('app.name') }}</strong> (selanjutnya disebut "Layanan"), Anda setuju untuk terikat oleh Syarat dan Ketentuan Layanan ini ("Syarat"). Jika Anda tidak setuju dengan bagian mana pun dari syarat ini, Anda tidak diizinkan untuk menggunakan Layanan kami.
                    </p><br>

                    <h2>2. Deskripsi Layanan</h2>
                    <p>
                        {{ config('app.name') }} menyediakan layanan web hosting, pendaftaran domain, dan layanan terkait lainnya. Fitur dan harga layanan dapat berubah sewaktu-waktu dan akan diumumkan di situs web kami.
                    </p><br>

                    <h2>3. Kewajiban Pengguna</h2>
                    <p>Sebagai pengguna, Anda setuju untuk:</p>
                    <ul>
                        <li>Memberikan informasi yang akurat dan lengkap saat melakukan pendaftaran.</li>
                        <li>Menjaga keamanan akun dan kata sandi Anda.</li>
                        <li>Tidak menggunakan layanan untuk tujuan ilegal, melanggar hukum, atau aktivitas yang merugikan pihak lain (seperti spamming, phishing, penyebaran malware).</li>
                        <li>Bertanggung jawab penuh atas semua konten yang diunggah dan dikelola di akun hosting Anda.</li>
                    </ul><br>

                    <h2>4. Pembayaran dan Perpanjangan</h2>
                    <p>
                        Semua layanan bersifat prabayar. Anda bertanggung jawab untuk memastikan tagihan dibayar tepat waktu untuk menghindari penangguhan atau penghentian layanan. Detail mengenai siklus penagihan dan metode pembayaran tersedia di area klien.
                    </p><br>

                    <h2>5. Pembatasan Tanggung Jawab</h2>
                    <p>
                        {{ config('app.name') }} tidak akan bertanggung jawab atas kerugian langsung maupun tidak langsung yang timbul dari penggunaan atau ketidakmampuan untuk menggunakan layanan kami, termasuk namun tidak terbatas pada kehilangan data, gangguan bisnis, atau kerugian finansial lainnya.
                    </p><br>

                    <h2>6. Perubahan Ketentuan</h2>
                    <p>
                        Kami berhak untuk mengubah Syarat ini dari waktu ke waktu. Versi terbaru akan selalu tersedia di halaman ini. Dengan terus menggunakan Layanan setelah perubahan berlaku, Anda dianggap telah menyetujui Syarat yang baru.
                    </p><br>

                    <h2>7. Kontak</h2>
                    <p>
                        Jika Anda memiliki pertanyaan mengenai Syarat dan Ketentuan Layanan ini, silakan hubungi kami melalui halaman <strong><a href="{{ url('/kontak') }}">kontak</a></strong>.
                    </p>
                </div>

            </div>
        </div>
    </section>

@endsection