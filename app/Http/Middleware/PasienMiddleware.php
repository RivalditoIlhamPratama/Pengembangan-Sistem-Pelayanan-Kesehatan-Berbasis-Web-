<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PasienMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Misalnya, cek apakah user memiliki peran 'pasien'
        if (auth()->check() && auth()->user()->role === 'pasien') {
            return $next($request);
        }
        abort(403, 'Akses ditolak. Hanya untuk pasien.');
    }
}
