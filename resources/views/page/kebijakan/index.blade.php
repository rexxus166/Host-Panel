@extends('layouts.public')

@section('title', 'Kebijakan Privasi')

@section('content')

    {{-- HERO SECTION --}}
    <section class="bg-white py-20 border-b border-gray-200">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-h1 lg:text-5xl font-exo2 text-dark leading-tight">
                Kebijakan Privasi
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
                
                <div class="prose max-w-none prose-h2:font-exo2 prose-h2:text-dark prose-h3:font-exo2 prose-h3:text-dark">
                    <h2>1. Pendahuluan</h2>
                    <p>
                        <strong>{{ config('app.name') }}</strong> ("kami") berkomitmen untuk melindungi privasi Anda. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, mengungkapkan, dan menjaga informasi Anda saat Anda mengunjungi situs web kami dan menggunakan layanan kami.
                    </p><br>

                    <h2>2. Informasi yang Kami Kumpulkan</h2>
                    <p>Kami dapat mengumpulkan informasi tentang Anda dalam berbagai cara. Informasi yang kami kumpulkan meliputi:</p>
                    <ul>
                        <li><strong>Data Pribadi:</strong> Informasi identitas pribadi seperti nama, alamat email, nomor telepon, dan alamat penagihan yang Anda berikan secara sukarela saat mendaftar atau melakukan transaksi.</li>
                        <li><strong>Data Turunan:</strong> Informasi yang dikumpulkan server kami secara otomatis saat Anda mengakses Situs, seperti alamat IP Anda, jenis browser, sistem operasi, dan waktu akses.</li>
                        <li><strong>Data Keuangan:</strong> Informasi terkait pembayaran seperti data kartu kredit atau detail rekening bank yang dikumpulkan oleh pemroses pembayaran pihak ketiga kami.</li>
                    </ul><br>

                    <h2>3. Bagaimana Kami Menggunakan Informasi Anda</h2>
                    <p>Informasi yang kami kumpulkan digunakan untuk berbagai tujuan, seperti:</p>
                    <ul>
                        <li>Membuat dan mengelola akun Anda.</li>
                        <li>Memproses pembayaran dan transaksi Anda.</li>
                        <li>Mengirimkan email konfirmasi, tagihan, dan notifikasi teknis.</li>
                        <li>Meningkatkan layanan dan pengalaman pengguna.</li>
                        <li>Mencegah aktivitas penipuan dan menjaga keamanan.</li>
                    </ul><br>

                    <h2>4. Keamanan Data</h2>
                    <p>
                        Kami menggunakan langkah-langkah keamanan administratif, teknis, dan fisik untuk membantu melindungi informasi pribadi Anda. Meskipun kami telah mengambil langkah-langkah yang wajar untuk mengamankan data yang Anda berikan kepada kami, perlu diketahui bahwa tidak ada sistem keamanan yang sempurna atau tidak dapat ditembus.
                    </p><br>
                    
                    <h2>5. Hak Anda</h2>
                    <p>
                        Anda memiliki hak untuk mengakses, memperbaiki, atau menghapus data pribadi Anda yang kami simpan. Anda dapat meninjau atau mengubah informasi di akun Anda kapan saja dengan masuk ke pengaturan akun Anda dan memperbaruinya.
                    </p><br>

                    <h2>6. Perubahan pada Kebijakan Ini</h2>
                    <p>
                        Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu. Versi yang diperbarui akan ditandai dengan tanggal "Terakhir diperbarui" dan akan berlaku segera setelah dapat diakses.
                    </p><br>

                    <h2>7. Kontak Kami</h2>
                    <p>
                        Jika Anda memiliki pertanyaan atau komentar tentang Kebijakan Privasi ini, silakan hubungi kami melalui halaman <strong><a href="{{ url('/kontak') }}">kontak</a></strong>.
                    </p>
                </div>

            </div>
        </div>
    </section>

@endsection