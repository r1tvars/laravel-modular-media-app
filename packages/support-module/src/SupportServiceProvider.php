<?php

namespace SupportModule;

use Illuminate\Support\ServiceProvider;
use SupportModule\Services\SlugGenerator;

/**
 * Registers reusable shared services for feature modules.
 */
class SupportServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SlugGenerator::class, function (): SlugGenerator {
            return new SlugGenerator();
        });
    }

    public function boot(): void
    {
    }
}