<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::view('about', 'public.about')->name('about');
    Route::view('contact', 'public.contact')->name('contact');
    Route::view('terms', 'public.terms')->name('terms');
    Route::view('privacy', 'public.privacy')->name('privacy');
});
