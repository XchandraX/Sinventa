<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// ? panggil class facades Auth agar dapat digunakan di function handle
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // ? tambah string $role untuk 'role !== $role' biar bisa
    public function handle(Request $request, Closure $next, string $role): Response
    {
        /**
         * ? jika user belum login
         * ? atau lore user tidak sama dengan role yg ditentukan di middleware group
         */
        if (! Auth::check()) {
            abort(403);
        }

        $userRole = Auth::user()->role;

        // Izinkan jika role cocok ATAU jika user adalah root
        if ($userRole === $role || $userRole === 'root') {
            return $next($request);
        }

        abort(403);
    }
}
