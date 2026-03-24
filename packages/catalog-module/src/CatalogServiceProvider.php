<?php

namespace Module1\CatalogModule;

use Module1\CatalogModule\Services\CatalogService;
use Illuminate\Support\ServiceProvider;

class CatalogServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/catalog.php',
            'catalog'
        );
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'catalog');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}