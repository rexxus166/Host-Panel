<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\Reseller\ResellerController;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewServiceWelcomeEmail;
use App\Models\Service;

// Halaman depan yang bisa diakses semua orang
Route::get('/', [HomeController::class, 'index'])->name('home');

// Grup untuk semua rute yang hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {
    
    // Route untuk Pengarah (Gatekeeper)
    Route::get('/redirect-dashboard', [DashboardRedirectController::class, 'redirectBasedOnRole']);

    // Route untuk Role Admin
    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('role:admin')->name('admin.dashboard');

    // Kelola Produk
    Route::get('/admin/produk', [AdminController::class, 'produk'])->middleware('role:admin')->name('admin.produk');
    Route::get('/admin/produk/create', [AdminController::class, 'createProduk'])->middleware('role:admin')->name('admin.produk.create');
    Route::post('/admin/produk/store', [AdminController::class, 'storeProduk'])->middleware('role:admin')->name('admin.produk.store');
    Route::get('/admin/produk/edit/{product}', [AdminController::class, 'editProduk'])->middleware('role:admin')->name('admin.produk.edit');
    Route::put('/admin/produk/update/{product}', [AdminController::class, 'updateProduk'])->middleware('role:admin')->name('admin.produk.update');
    Route::delete('/admin/produk/destroy/{product}', [AdminController::class, 'destroyProduk'])->middleware('role:admin')->name('admin.produk.destroy');

    // Kelola Service / Layanan
    Route::get('/admin/services', [AdminController::class, 'service'])->middleware('role:admin')->name('admin.service');
    Route::get('/admin/services/{service}', [AdminController::class, 'showService'])->middleware('role:admin')->name('admin.service.show');
    Route::patch('/admin/services/{service}/status', [AdminController::class, 'updateStatus'])->middleware('role:admin')->name('admin.services.updateStatus');

    // Kelola User
    Route::get('/admin/user', [AdminController::class, 'pengguna'])->middleware('role:admin')->name('admin.user');
    Route::get('/admin/user/create', [AdminController::class, 'createPengguna'])->middleware('role:admin')->name('admin.user.create');
    Route::post('/admin/user/store', [AdminController::class, 'storePengguna'])->middleware('role:admin')->name('admin.user.store');
    Route::get('/admin/user/edit/{user}', [AdminController::class, 'editPengguna'])->middleware('role:admin')->name('admin.user.edit');
    Route::put('/admin/user/update/{user}', [AdminController::class, 'updatePengguna'])->middleware('role:admin')->name('admin.user.update');
    Route::delete('/admin/user/destroy/{user}', [AdminController::class, 'destroyPengguna'])->middleware('role:admin')->name('admin.user.destroy');

    // Route untuk Reseller
    Route::get('/reseller/dashboard', [ResellerController::class, 'index'])->middleware('role:reseller')->name('reseller.dashboard');

    // Route untuk Users
    // Dashboard Users
    Route::get('/dashboard', [UserController::class, 'index'])->middleware('role:user')->name('user.dashboard');

    // Layanan Users
    Route::get('/services', [UserController::class, 'service'])->name('user.service');
    Route::get('/service/{service}', [UserController::class, 'show'])->name('user.service.show');
    Route::get('/user/services/{service}/sso', [UserController::class, 'ssoLogin'])->name('user.service.sso');

    // Produk Users
    Route::get('/produk', [UserController::class, 'produk'])->name('produk.index');
    
    // Rute untuk proses pemesanan
    Route::get('/order/create/{product}', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order/store/{product}', [OrderController::class, 'store'])->name('order.store');
});

require __DIR__.'/auth.php';