<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa untuk route admin yang memerlukan autentikasi
        if ($request->is('admin/*') && !Auth::guard('admin')->check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman admin.');
        }

        // Periksa untuk route upload/hapus foto yang memerlukan autentikasi admin
        if (($request->is('informasi/upload-foto') || $request->is('informasi/hapus-foto')) && !Auth::guard('admin')->check()) {
            return redirect('/login')->with('error', 'Silakan login sebagai admin terlebih dahulu untuk mengelola foto gedung sekolah.');
        }

        return $next($request);
    }
}
