<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Pastikan pengguna terautentikasi
        if (!Auth::check()) {
            return redirect('/'); // Redirect jika tidak terautentikasi
        }

        // Periksa peran pengguna
        if (!Auth::user()->hasRole($role)) {
            return redirect('/'); // Redirect jika tidak memiliki peran yang sesuai
        }

        // Periksa apakah akun pengguna sudah disetujui
        if (!Auth::user()->is_approved) {
            return redirect('/')->with('error', 'Akun Anda belum disetujui.'); // Redirect dengan pesan jika belum disetujui
        }

        return $next($request);
    }
}
