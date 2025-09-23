<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil layanan milik user tersebut, beserta relasi produknya
        // Eager loading `product` untuk menghindari N+1 query problem
        $services = $user->services()->with('product')->get();
        
        return view('page.dashboard.index', compact('services'));
    }

    public function produk()
    {
        $products = Product::all();
        return view('page.order.index', compact('products'));
    }

    public function service()
    {
        // Ambil semua layanan HANYA milik user yang sedang login
        // 'with('product')' adalah eager loading untuk efisiensi query
        $services = Service::where('user_id', auth()->id())
                            ->with('product')
                            ->latest()
                            ->paginate(10);

        return view('page.servis.index', compact('services'));
    }

    public function show(Service $service)
    {
        // PENTING: Pemeriksaan Keamanan (Authorization)
    // Pastikan ID user yang sedang login sama dengan user_id pemilik layanan ini.
    if (auth()->id() !== $service->user_id) {
        // Jika tidak sama, hentikan proses dan tampilkan error 403 (Akses Ditolak).
        abort(403, 'AKSES DITOLAK');
    }

    // Jika aman, tampilkan view dengan data layanan
    return view('page.servis.show', compact('service'));
    }

    public function ssoLogin(Service $service)
    {
        // Keamanan: Pastikan user hanya bisa mengakses layanannya sendiri
        if (auth()->id() !== $service->user_id) {
            abort(403, 'Akses Ditolak');
        }

        // Ambil kredensial dari file config
        $host = config('services.whm.host');
        $user = config('services.whm.user');
        $token = config('services.whm.token');

        // Regenerasi username cPanel dengan logika yang SAMA seperti saat pembuatan
        $cpanelUsername = strtolower(substr(preg_replace('/[^a-zA-Z0-9]/', '', $service->domain), 0, 8));

        // Panggil WHM API untuk membuat sesi login
        $response = Http::withoutVerifying()
                        ->timeout(60)
                        ->withHeaders(['Authorization' => 'whm ' . $user . ':' . $token])
                        ->get("https://{$host}:2087/json-api/create_user_session", [
                            'api.version' => 1,
                            'user'        => $cpanelUsername, // Username cPanel dari user
                            'service'     => 'cpaneld',    // Layanan yang ingin diakses (cPanel)
                            'app'         => 'cpanel',
                        ]);

        // Periksa respon dari API
        if ($response->successful() && isset($response->json()['data']['url'])) {
            $originalUrl = $response->json()['data']['url'];
            
            // ====================================================================
            // === BAGIAN YANG DIPERBARUI: GANTI HOSTNAME DENGAN NAMA ALIAS ANDA ===
            // ====================================================================
            $brandedUrl = str_replace($host, 'cpanel.hosting.miomi.dev', $originalUrl);
            
            // Redirect pengguna ke URL baru yang sudah di-branding
            return redirect()->away($brandedUrl);

        } else {
            // Jika gagal, kembali ke halaman sebelumnya dengan pesan error
            $reason = $response->json()['metadata']['reason'] ?? 'Gagal menghubungi server hosting.';
            return redirect()->back()->with('error', 'Gagal membuat sesi login cPanel: ' . $reason);
        }
    }

    // Route untuk Tagihan
    public function tagihan()
    {
        return view('page.tagihan.index');
    }

    // Route untuk Bantuan
    public function bantuan()
    {
        return view('page.bantuan.index');
    }
}