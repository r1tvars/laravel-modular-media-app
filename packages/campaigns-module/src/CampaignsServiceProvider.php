<?php

namespace Module2\CampaignsModule;

use Illuminate\Support\ServiceProvider;

class CampaignsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/campaigns.php',
            'campaigns'
        );
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'campaigns');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}