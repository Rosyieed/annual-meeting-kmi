<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('home'); // Redirect ke halaman login jika belum login
        }

        // Ambil role user yang sudah login
        $userRole = Auth::user()->role->txtRole;

        // buat userRole menjadi hurufkecil
        $userRole = strtolower($userRole);

        // Periksa apakah role user ada dalam daftar role yang diperbolehkan
        if (!in_array($userRole, $roles)) {
            abort(401, 'This action is unauthorized.');
        }

        return $next($request);
    }
}
