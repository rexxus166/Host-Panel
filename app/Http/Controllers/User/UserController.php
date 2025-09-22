<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Service;

class UserController extends Controller
{
    public function index()
    {
        return view('page.dashboard.index');
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
}
