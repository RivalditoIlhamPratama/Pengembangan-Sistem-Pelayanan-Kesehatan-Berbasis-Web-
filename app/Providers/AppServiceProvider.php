<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Adminpuskesmas;
use App\Models\Klinik; // Pastikan model Klinik di-import

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Untuk layout admin
        View::composer('layouts.admin', function ($view) {
            $admin = null;
            if (Auth::check()) {
                $user = Auth::user();
                $admin = Adminpuskesmas::where('user_id', $user->id_user)->first();
            }
            $view->with('admin', $admin);
        });

        // ✅ Untuk layout klinik
        View::composer('layouts.klinik', function ($view) {
            $klinik = null;
            if (Auth::check()) {
                $user = Auth::user();
                $klinik = Klinik::where('user_id', $user->id_user)->first();
            }
            $view->with('klinik', $klinik);
        });
    }
}
