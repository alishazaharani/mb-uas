<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View; // <--- tambahin ini
use App\Models\Category;           

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

    public function boot()
{
    if (app()->environment('production')) {
        URL::forceScheme('https');
    }
    {
        // Share $categories ke semua view
        View::share('categories', Category::all());
    }
}
}
