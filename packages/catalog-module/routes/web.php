<?php

use Illuminate\Support\Facades\Route;
use Module1\CatalogModule\Http\Controllers\CatalogController;

Route::prefix(config('catalog.route_prefix', 'catalog'))
    ->middleware(config('catalog.middleware', ['web', 'auth']))
    ->name('catalog.')
    ->group(function (): void {
        Route::get('/', [CatalogController::class, 'index'])->name('index');
    });