<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::livewire('users', 'pages::admin.users.index')->name('users');
        Route::livewire('users/create', 'pages::admin.users.create')->name('users.create');
        Route::livewire('users/{user}/edit', 'pages::admin.users.edit')->name('users.edit');
    });

    Route::view('campaigns', 'campaigns.index')->name('campaigns.index');
});

require __DIR__.'/auth.php';
