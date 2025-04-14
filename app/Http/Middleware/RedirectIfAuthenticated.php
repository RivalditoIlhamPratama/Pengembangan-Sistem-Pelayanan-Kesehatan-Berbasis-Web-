<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                switch($user->role) {
                case 'pasien':
                    return redirect()->intended('/pasien/dashboard');
                case 'admin':
                    return redirect()->intended('/admin/dashboard');
                case 'klinik':
                    return redirect()->intended('/klinik/dashboard');
                case 'dokter':
                    return redirect()->intended('/dokter/dashboard');
                case 'staffrekmedis':
                    return redirect()->intended('/rekam-medis/dashboard');
                default:
                    return redirect()->intended('/');
            }
            }
        }

        return $next($request);
    }
}
