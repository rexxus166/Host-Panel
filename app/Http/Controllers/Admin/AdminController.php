<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Product;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Jobs\ActivateCpanelAccount;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Dashboard
     */
    public function index()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalServices = Service::count();
        return view('page.admin.dashboard.index', compact('totalUsers', 'totalProducts', 'totalServices'));
    }

    /**
     * Manajemen Produk
     */
    public function produk()
    {
        $products = Product::latest()->get();
        return view('page.admin.produk.index', compact('products'));
    }

    /**
     * Tambah Produk Baru
     */
    public function createProduk()
    {
        return view('page.admin.produk.create');
    }

    /**
     * Simpan Produk Baru
     */
    public function storeProduk(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'package_name_whm' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'disk_space_gb' => 'required|string|max:255', // Diubah ke string
            'bandwidth_gb' => 'required|string|max:255',  // Diubah ke string
            'type' => 'required|in:harian,bulanan,tahunan', // Validasi tipe
            'has_free_domain' => 'required|boolean', // Validasi boolean
            'free_domain_tld' => 'nullable|string|max:100|required_if:has_free_domain,true', // Wajib jika free domain = true
        ]);

        Product::create($validatedData);

        return redirect()->route('admin.produk')
                        ->with('success', 'Produk baru berhasil ditambahkan!');
    }

    /**
     * Edit Produk
     */
    public function editProduk(Product $product)
    {
        return view('page.admin.produk.edit', compact('product'));
    }

    /**
     * Update Produk
     */
    public function updateProduk(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'package_name_whm' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'disk_space_gb' => 'required|string|max:255', // Diubah ke string
            'bandwidth_gb' => 'required|string|max:255',  // Diubah ke string
            'type' => 'required|in:harian,bulanan,tahunan', // Validasi tipe
            'has_free_domain' => 'required|boolean', // Validasi boolean
            'free_domain_tld' => 'nullable|string|max:100|required_if:has_free_domain,true', // Wajib jika free domain = true
        ]);

        $product->update($validatedData);

        return redirect()->route('admin.produk')
                        ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Hapus Produk
     */
    public function destroyProduk(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.produk')
                        ->with('success', 'Produk berhasil dihapus!');
    }

    /**
     * Manajemen Layanan
     */
    public function service()
    {
        // Ambil semua layanan, beserta data user dan produk terkait
        // Urutkan agar status 'pending' muncul di atas
        $services = Service::with(['user', 'product'])
                            ->orderByRaw("FIELD(status, 'pending', 'active', 'suspended', 'terminated')")
                            ->latest()
                            ->paginate(15);

        return view('page.admin.service.index', compact('services'));
    }

    /**
     * Detail Layanan
     */
    public function showService(Service $service)
    {
        // Kita bisa memuat relasi user dan produk untuk ditampilkan di view
        $service->load(['user', 'product']);

        return view('page.admin.service.show', compact('service'));
    }

    /**
     * Update Status Layanan
     */
    public function updateStatus(Request $request, Service $service)
    {
        $newStatus = $request->status;

        if ($newStatus == 'active' && $service->status == 'pending') {

            // Kirim pekerjaan ke antrian. Proses ini sangat cepat!
            ActivateCpanelAccount::dispatch($service);

            // Langsung beri respon ke admin
            return redirect()->route('admin.service.show', $service)
                            ->with('success', 'Perintah aktivasi untuk ' . $service->domain . ' telah dikirim ke antrian!');

        } else {
            // Untuk status lain (suspend, dll) kita update langsung
            $service->update(['status' => $newStatus]);

            return redirect()->route('admin.service.show', $service)
                            ->with('success', 'Status layanan berhasil diubah menjadi ' . ucfirst($newStatus) . '.');
        }
    }
    
    /**
     * Manajemen User
     */
    public function pengguna()
    {
        $users = User::orderBy('id', 'asc')->get(); // ID terkecil duluan
        return view('page.admin.pengguna.index', compact('users'));
    }

    /**
     * Tambah User Baru
     */
    public function createPengguna()
    {
        return view('page.admin.pengguna.create');
    }
    

    /**
     * Store User
     */
    public function storePengguna(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,reseller,user'], // Memastikan role yang dipilih valid
        ]);
    
        // Buat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
    
        // Redirect dengan pesan sukses
        return redirect()->route('admin.user')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    /**
     * Edit User
     */
    public function editPengguna(User $user)
    {
        return view('page.admin.pengguna.edit', compact('user'));
    }

    /**
     * Update User
     */
    public function updatePengguna(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id], // Abaikan email user ini saat cek unique
            'role' => ['required', 'in:admin,reseller,user'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()], // Password tidak wajib diisi saat update
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        // Hanya update password jika diisi
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.user')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Hapus User
     */
    public function destroyPengguna(User $user)
    {
        // Tambahkan proteksi agar admin tidak bisa menghapus diri sendiri
        if (auth()->id() == $user->id) {
            return redirect()->route('admin.user')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.user')->with('success', 'Pengguna berhasil dihapus.');
    }
}
