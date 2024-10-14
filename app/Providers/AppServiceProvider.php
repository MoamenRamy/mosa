<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrap(); // This will apply Bootstrap styles to pagination links

        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->role >= 2; // Replace 'role' with your actual logic
        });

        Blade::if('superAdmin', function () {
            return auth()->check() && auth()->user()->role >= 3; // Replace 'role' with your actual logic
        });

        Blade::if('employee', function () {
            return auth()->check() && auth()->user()->role >= 1; // Replace 'role' with your actual logic
        });
    }
}
