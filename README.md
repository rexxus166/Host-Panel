# HostPanel - Panel Manajemen Hosting dengan Laravel 🚀

HostPanel adalah aplikasi web yang dibangun dari nol untuk mengelola dan menjual layanan hosting. Proyek ini berfungsi sebagai sarana latihan untuk mengimplementasikan berbagai fitur modern menggunakan Laravel 12 dan Tailwind CSS.

![Screenshot Dashboard Admin HostPanel](link-ke-screenshot.png)

---

## ✨ Tentang Proyek

Proyek ini dibuat sebagai pengalaman belajar langsung untuk membangun aplikasi web fungsional dari awal. Tujuannya adalah untuk menciptakan sebuah platform di mana seorang admin dapat mengelola produk hosting dan pengguna, dengan sistem otentikasi berbasis peran yang jelas.

### Fitur Utama yang Sudah Diimplementasikan:
* **Kontrol Akses Berbasis Peran (RBAC):** Sistem dengan tiga peran berbeda: **Admin**, **Reseller**, dan **User**.
* **Dashboard Terpisah:** Setiap peran memiliki halaman dashboard dan *layout* yang unik.
* **Manajemen Produk (CRUD):** Admin dapat membuat, melihat, mengedit, dan menghapus paket hosting.
* **Manajemen Pengguna (CRUD):** Admin dapat membuat, melihat, mengedit, dan menghapus data pengguna, termasuk menetapkan peran mereka.
* **Otentikasi Aman:** Dibangun di atas Laravel Breeze untuk sistem registrasi dan login yang aman.
* **UI Modern & Responsif:** Desain antarmuka yang dibuat dengan Tailwind CSS, menampilkan sidebar yang fungsional dan responsif untuk perangkat mobile.

---

## 🛠️ Dibangun Dengan

Daftar teknologi utama yang digunakan dalam proyek ini:

* **Laravel 12**
* **PHP 8.3**
* **Tailwind CSS**
* **Vite**
* **MySQL**
* **Blade Template Engine**

---

## ⚙️ Cara Instalasi & Menjalankan Proyek

Untuk menjalankan proyek ini di lingkungan lokal Anda, ikuti langkah-langkah berikut:

1.  **Clone repository**
    ```bash
    git clone https://github.com/rexxus166/Host-Panel.git
    ```

2.  **Masuk ke direktori proyek**
    ```bash
    cd Host-Panel
    ```

3.  **Install dependensi PHP via Composer**
    ```bash
    composer install
    ```

4.  **Salin file `.env.example` menjadi `.env`**
    ```bash
    cp .env.example .env
    ```

5.  **Generate application key**
    ```bash
    php artisan key:generate
    ```

6.  **Konfigurasi database Anda**
    Buka file `.env` dan sesuaikan pengaturan `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD`.

7.  **Jalankan migrasi database**
    Perintah ini akan membuat semua tabel yang dibutuhkan di database Anda.
    ```bash
    php artisan migrate
    ```

8.  **Install dependensi JavaScript/CSS via NPM**
    ```bash
    npm install
    ```

9.  **Jalankan Vite untuk kompilasi aset**
    (Biarkan terminal ini tetap berjalan)
    ```bash
    npm run dev
    ```

10. **Jalankan server development Laravel**
    Buka terminal baru dan jalankan:
    ```bash
    php artisan serve
    ```

11. **Selesai!**
    Aplikasi sekarang berjalan di `http://127.0.0.1:8000`. Anda bisa mendaftar sebagai pengguna baru, lalu mengubah *role* Anda secara manual di database menjadi `admin` untuk mengakses fitur-fitur admin.

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT. Lihat file `LICENSE` untuk detailnya.