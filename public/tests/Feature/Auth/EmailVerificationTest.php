<?php

use App\Models\User;
use Illuminate\Support\Facades\URL;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('unverified users are shown the verification notice', function () {
    $user = User::factory()->unverified()->create();

    actingAs($user);

    get(route('verification.notice'))->assertOk();
});

test('verified users are redirected home from the notice', function () {
    $user = User::factory()->create();

    actingAs($user);

    get(route('verification.notice'))->assertRedirect(route('home'));
});

test('verification link can be resent', function () {
    $user = User::factory()->unverified()->create();

    actingAs($user);

    post(route('verification.send'))
        ->assertSessionHas('status', 'verification-link-sent');
});

test('email can be verified via signed link', function () {
    $user = User::factory()->unverified()->create(['email' => 'verify@example.com']);

    actingAs($user);

    $url = URL::signedRoute('verification.verify', [
        'id' => $user->id,
        'hash' => sha1('verify@example.com'),
    ]);

    get($url)->assertRedirect(route('home'));

    expect($user->fresh()->hasVerifiedEmail())->toBeTrue();
});

test('invalid verification hash is rejected', function () {
    $user = User::factory()->unverified()->create(['email' => 'verify@example.com']);

    actingAs($user);

    $url = URL::signedRoute('verification.verify', [
        'id' => $user->id,
        'hash' => sha1('wrong@example.com'),
    ]);

    get($url)->assertForbidden();

    expect($user->fresh()->hasVerifiedEmail())->toBeFalse();
});
