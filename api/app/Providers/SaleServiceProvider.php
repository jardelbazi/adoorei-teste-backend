<?php

namespace App\Providers;

use App\Repositories\Sale\SaleRepository;
use App\Repositories\Sale\SaleRepositoryInterface;
use App\Services\Sale\SaleService;
use App\Services\Sale\SaleServiceInterface;
use Illuminate\Support\ServiceProvider;

class SaleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            SaleServiceInterface::class,
            SaleService::class,
        );

        $this->app->bind(
            SaleRepositoryInterface::class,
            SaleRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
