<?php

use Illuminate\Support\Facades\Route;
use Module2\CampaignsModule\Http\Controllers\CampaignNotificationController;

Route::prefix(config('campaigns.route_prefix', 'campaigns'))
    ->middleware(config('campaigns.middleware', ['web', 'auth']))
    ->name('campaigns.')
    ->group(function (): void {
        Route::get('/', [CampaignNotificationController::class, 'index'])->name('index');
        Route::get('/create', [CampaignNotificationController::class, 'create'])->name('create');
        Route::post('/', [CampaignNotificationController::class, 'store'])->name('store');
    });