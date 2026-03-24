<?php

namespace Module1\CatalogModule;

use Illuminate\Support\ServiceProvider;
use Module1\CatalogModule\Services\CatalogItemLookupService;
use SupportModule\Contracts\CatalogItemLookupInterface;

class CatalogServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/catalog.php',
            'catalog'
        );

        $this->app->bind(
            CatalogItemLookupInterface::class,
            CatalogItemLookupService::class
        );
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'catalog');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}