<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Change the pagination view style from tailwind to bootstrap 4
        // First publish the view from vendor folder to the resorce view folder by using
        // php artisan vendor:publish --tag=laravel-pagination
        Paginator::defaultView('vendor.pagination.bootstrap-4');
        Paginator::defaultSimpleView('vendor.pagination.bootstrap-4');
    }
}
