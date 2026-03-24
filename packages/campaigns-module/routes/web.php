<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Module2\CampaignsModule\Http\Controllers\CampaignNotificationController;

Route::prefix(config('campaigns.route_prefix', 'campaigns'))
    ->middleware(config('campaigns.middleware', ['web', 'auth']))
    ->name('campaigns.')
    ->group(function (): void {
        Route::get('/', [CampaignNotificationController::class, 'index'])->name('index');
        Route::get('/create', [CampaignNotificationController::class, 'create'])->name('create');
        Route::post('/', [CampaignNotificationController::class, 'store'])->name('store');
        Route::get('/{campaignNotification}', [CampaignNotificationController::class, 'show'])->name('show');
        Route::get('/{campaignNotification}/edit', [CampaignNotificationController::class, 'edit'])->name('edit');
        Route::put('/{campaignNotification}', [CampaignNotificationController::class, 'update'])->name('update');
        Route::delete('/{campaignNotification}', [CampaignNotificationController::class, 'destroy'])->name('destroy');
    });