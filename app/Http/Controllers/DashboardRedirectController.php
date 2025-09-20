<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardRedirectController extends Controller
{
    public function redirectBasedOnRole()
    {
        $role = Auth::user()->role;

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'reseller':
                return redirect()->route('reseller.dashboard');
            case 'user':
                return redirect()->route('user.dashboard'); // Arahkan ke rute user yang baru
            default:
                return redirect('/login'); // Jika role tidak dikenali, logout saja
        }
    }
}