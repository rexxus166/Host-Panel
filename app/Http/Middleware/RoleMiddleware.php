<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            // Jika belum login, arahkan ke halaman login
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->role !== $role) {
            // Redirect ke dashboard yang sesuai dengan rolenya
            switch ($user->role) {
                case 'admin':
                    return redirect('/admin/dashboard');
                case 'reseller':
                    return redirect('/reseller/dashboard');
                case 'user':
                    return redirect('/dashboard');
                default:
                    return redirect('/'); // default fallback jika role tidak dikenali
            }
        }

        return $next($request);
    }
}