<?php

namespace App\Providers;

use App\Models\Sale;
use App\Observers\SaleObserver;
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
        Sale::observe(SaleObserver::class);
    }
}
