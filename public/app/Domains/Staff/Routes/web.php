<?php

use App\Domains\Staff\Http\Controllers\ChannelController;
use App\Domains\Staff\Http\Controllers\TicketController;
use App\Domains\Staff\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'role:staff|admin'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', function () {
        return view('staff.dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class)
        ->names('users');

    Route::resource('channels', ChannelController::class)
        ->names('channels');

    Route::resource('tickets', TicketController::class)
        ->names('tickets');
});
