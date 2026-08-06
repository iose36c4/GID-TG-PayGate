<?php

use App\Domains\Public\Http\Controllers\ChannelController;
use App\Http\Controllers\InstallController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ChannelController::class, 'landing'])->name('home');

Route::prefix('install')->name('install.')->middleware(['throttle:30,1'])->group(function () {
    Route::get('requirements', [InstallController::class, 'requirements'])->name('requirements');
    Route::match(['get', 'post'], 'database', [InstallController::class, 'database'])->name('database');
    Route::match(['get', 'post'], 'migrate', [InstallController::class, 'migrate'])->name('migrate');
    Route::match(['get', 'post'], 'admin', [InstallController::class, 'admin'])->name('admin');
    Route::get('complete', [InstallController::class, 'complete'])->name('complete');
});
