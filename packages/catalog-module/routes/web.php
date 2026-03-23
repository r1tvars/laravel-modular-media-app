<?php

use Illuminate\Support\Facades\Route;
use Module1\CatalogModule\Http\Controllers\CatalogController;

Route::prefix(config('catalog.route_prefix', 'catalog'))
    ->middleware(config('catalog.middleware', ['web', 'auth']))
    ->name('catalog.')
    ->group(function (): void {
        Route::get('/', [CatalogController::class, 'index'])->name('index');
        Route::get('/create', [CatalogController::class, 'create'])->name('create');
        Route::post('/', [CatalogController::class, 'store'])->name('store');
        Route::get('/{catalogItem}/edit', [CatalogController::class, 'edit'])->name('edit');
        Route::put('/{catalogItem}', [CatalogController::class, 'update'])->name('update');
        Route::delete('/{catalogItem}', [CatalogController::class, 'destroy'])->name('destroy');
    });