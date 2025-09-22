<?php

namespace App\Http\Controllers;

use App\Models\Product; // <-- Import model Product
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Ambil semua produk dari database
        return view('welcome', compact('products')); // Kirim data produk ke view welcome
    }
}