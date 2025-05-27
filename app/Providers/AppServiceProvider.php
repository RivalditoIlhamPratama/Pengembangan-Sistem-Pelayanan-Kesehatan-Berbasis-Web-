<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Adminpuskesmas;

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
        View::composer('layouts.admin', function ($view) {
            $admin = null;
            if (Auth::check()) {
                $user = Auth::user();
                $admin = Adminpuskesmas::where('user_id', $user->id_user)->first();
            }
            $view->with('admin', $admin);
        });
    }
}
