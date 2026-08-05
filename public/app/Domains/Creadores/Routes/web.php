<?php

use App\Domains\Creadores\Http\Controllers\ChannelController;
use App\Domains\Creadores\Http\Controllers\OnboardingController;
use App\Domains\Creadores\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'role:creador'])->prefix('creador')->name('creador.')->group(function () {
    Route::get('/dashboard', function () {
        return view('creadores.dashboard');
    })->name('dashboard');

    // Onboarding
    Route::get('/onboarding', [OnboardingController::class, 'index'])->name('onboarding.index');
    Route::get('/onboarding/step1', [OnboardingController::class, 'step1'])->name('onboarding.step1');
    Route::post('/onboarding/step1', [OnboardingController::class, 'step1Store'])->name('onboarding.step1.store');
    Route::get('/onboarding/step2', [OnboardingController::class, 'step2'])->name('onboarding.step2');
    Route::post('/onboarding/step2', [OnboardingController::class, 'step2Store'])->name('onboarding.step2.store');
    Route::get('/onboarding/step3/{channel}', [OnboardingController::class, 'step3'])->name('onboarding.step3');
    Route::put('/onboarding/step3/{channel}', [OnboardingController::class, 'step3Store'])->name('onboarding.step3.store');
    Route::get('/onboarding/step4/{channel}', [OnboardingController::class, 'step4'])->name('onboarding.step4');
    Route::put('/onboarding/step4/{channel}', [OnboardingController::class, 'step4Store'])->name('onboarding.step4.store');

    // Subscriptions
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('/subscriptions/{subscription}', [SubscriptionController::class, 'show'])->name('subscriptions.show');
    Route::put('/subscriptions/{subscription}/cancel', [SubscriptionController::class, 'cancel'])->name('subscriptions.cancel');
    Route::put('/subscriptions/{subscription}/renew', [SubscriptionController::class, 'renew'])->name('subscriptions.renew');

    Route::resource('channels', ChannelController::class)
        ->names('channels');
});
