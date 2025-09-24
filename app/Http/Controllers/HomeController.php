<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Ambil semua produk dari database
        return view('welcome', compact('products')); // Kirim data produk ke view welcome
    }

    /**
     * Menampilkan halaman WHOIS.
     */
    public function whois()
    {
        return view('page.whois.index');
    }

    /**
     * Memproses permintaan lookup WHOIS.
     */
    public function lookup(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'domain' => 'required|string|max:255',
        ]);

        $domainName = $request->input('domain');
        
        // 2. Ambil API Key dari file .env (lebih aman)
        $apiKey = env('IP2WHOIS_API_KEY');

        if (!$apiKey) {
            // Jika API key tidak ada, catat di log dan beri pesan error
            Log::error('IP2WHOIS_API_KEY tidak ditemukan di file .env');
            return back()->with('error', 'Konfigurasi API tidak ditemukan. Silakan hubungi administrator.');
        }

        // 3. Buat URL API
        $apiUrl = "https://api.ip2whois.com/v2";

        // 4. Hubungi API menggunakan HTTP Client Laravel
        $response = Http::timeout(15)->get($apiUrl, [
            'key' => $apiKey,
            'domain' => $domainName,
        ]);

        if ($response->successful()) {
            // -- PERUBAHAN DI SINI --
            // Langsung parse respons JSON menjadi array
            $jsonData = $response->json();

            // Cek jika API mengembalikan pesan error di dalam JSON
            if (isset($jsonData['error_message'])) {
                 return back()->with('error', $jsonData['error_message']);
            }

            // Kirim array yang sudah diparsing ke view
            return view('page.whois.index', [
                'whoisResult' => $jsonData, // Mengirim data sebagai array
                'domain' => $domainName,
            ]);
        } else {
            return back()->with('error', 'Gagal menghubungi server API WHOIS. Silakan coba lagi nanti.');
        }
    }
}