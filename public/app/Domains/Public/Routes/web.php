<?php

use App\Domains\Public\Http\Controllers\ChannelController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::get('/canales', [ChannelController::class, 'index'])->name('channels.index');
    Route::get('/canal/{channel:slug}', [ChannelController::class, 'show'])->name('channels.show');
    Route::get('/checkout/{channel:slug}', [ChannelController::class, 'checkout'])->name('checkout.create');

    Route::view('about', 'public.about')->name('about');
    Route::view('contact', 'public.contact')->name('contact');
    Route::view('terms', 'public.terms')->name('terms');
    Route::view('privacy', 'public.privacy')->name('privacy');
});
