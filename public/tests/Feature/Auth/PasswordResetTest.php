<?php

use App\Models\User;
use Illuminate\Support\Facades\Password;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('forgot password screen can be rendered', function () {
    get(route('password.request'))->assertOk();
});

test('password reset link can be requested', function () {
    $user = User::factory()->create(['email' => 'reset@example.com']);

    post(route('password.email'), ['email' => 'reset@example.com'])
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    expect(Password::broker()->getRepository()->exists($user, Password::broker()->createToken($user)))->toBeTrue();
});

test('password reset link is not sent for unknown emails', function () {
    post(route('password.email'), ['email' => 'nobody@example.com'])
        ->assertSessionHasErrors('email');
});

test('reset password screen can be rendered', function () {
    $user = User::factory()->create();

    $token = Password::broker()->createToken($user);

    get(route('password.reset', $token))->assertOk();
});

test('password can be reset with a valid token', function () {
    $user = User::factory()->create(['email' => 'newpass@example.com']);

    $token = Password::broker()->createToken($user);

    post(route('password.store'), [
        'token' => $token,
        'email' => 'newpass@example.com',
        'password' => 'new-secure-password',
        'password_confirmation' => 'new-secure-password',
    ])->assertSessionHasNoErrors()
        ->assertRedirect(route('login'));

    expect($user->fresh()->validateCredentials(['password' => 'new-secure-password']))->toBeTrue();
});

test('password cannot be reset with an invalid token', function () {
    $user = User::factory()->create(['email' => 'badtoken@example.com']);

    post(route('password.store'), [
        'token' => 'invalid-token',
        'email' => 'badtoken@example.com',
        'password' => 'new-secure-password',
        'password_confirmation' => 'new-secure-password',
    ])->assertSessionHasErrors('email');

    expect($user->fresh()->validateCredentials(['password' => 'new-secure-password']))->toBeFalse();
});
