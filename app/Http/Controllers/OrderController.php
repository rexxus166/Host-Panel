<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service; // <-- Import Service Model
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan halaman form pemesanan untuk produk yang dipilih.
     */
    public function create(Product $product)
    {
        // Tampilkan view dan kirim data produk yang dipilih
        return view('page.order.create', compact('product'));
    }

    /**
     * Menyimpan data pesanan baru ke database.
     */
    public function store(Request $request, Product $product)
    {
        // 1. Validasi input dari form
        $request->validate([
            'domain' => 'required|string|max:255|unique:services,domain', // Pastikan domain unik
        ]);

        // 2. Buat record layanan baru di database
        Service::create([
            'user_id' => auth()->id(), // Ambil ID dari user yang sedang login
            'product_id' => $product->id, // Ambil ID dari produk yang dipesan
            'domain' => $request->domain,
            // Status akan otomatis 'pending' sesuai definisi di migrasi
        ]);

        // 3. Arahkan ke dashboard user dengan pesan sukses
        return redirect()->route('user.dashboard')
                         ->with('success', 'Pesanan Anda untuk domain ' . $request->domain . ' berhasil dibuat dan sedang menunggu aktivasi.');
    }
}