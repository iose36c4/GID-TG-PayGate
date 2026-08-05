<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

test('confirm password screen can be rendered', function () {
    $user = User::factory()->create();

    actingAs($user);

    get(route('password.confirm'))->assertOk();
});

test('password can be confirmed with a valid password', function () {
    $user = User::factory()->create();

    actingAs($user);

    post(route('password.confirm'), ['password' => 'password'])
        ->assertSessionHasNoErrors();

    expect(session('auth.password_confirmed_at'))->not->toBeNull();
});

test('password cannot be confirmed with an invalid password', function () {
    $user = User::factory()->create();

    actingAs($user);

    post(route('password.confirm'), ['password' => 'wrong-password'])
        ->assertSessionHasErrors('password');

    expect(session('auth.password_confirmed_at'))->toBeNull();
});

test('profile screen can be rendered', function () {
    $user = User::factory()->create();

    actingAs($user);

    get(route('profile.edit'))->assertOk();
});

test('profile can be updated', function () {
    $user = User::factory()->create(['email' => 'old@example.com']);

    actingAs($user);

    put(route('profile.update'), [
        'name' => 'New Name',
        'email' => 'new@example.com',
        'timezone' => 'America/Argentina/Buenos_Aires',
    ])->assertSessionHasNoErrors()
        ->assertRedirect();

    $user->refresh();

    expect($user->name)->toBe('New Name')
        ->and($user->email)->toBe('new@example.com')
        ->and($user->timezone)->toBe('America/Argentina/Buenos_Aires')
        ->and($user->email_verified_at)->toBeNull();
});

test('password can be changed with the current password', function () {
    $user = User::factory()->create();

    actingAs($user);

    put(route('password.update'), [
        'current_password' => 'password',
        'password' => 'new-secure-password',
        'password_confirmation' => 'new-secure-password',
    ])->assertSessionHasNoErrors();

    expect($user->fresh()->validateCredentials(['password' => 'new-secure-password']))->toBeTrue();
});

test('password cannot be changed with an incorrect current password', function () {
    $user = User::factory()->create();

    actingAs($user);

    put(route('password.update'), [
        'current_password' => 'wrong-current',
        'password' => 'new-secure-password',
        'password_confirmation' => 'new-secure-password',
    ])->assertSessionHasErrorsIn('updatePassword', 'current_password');

    expect($user->fresh()->validateCredentials(['password' => 'new-secure-password']))->toBeFalse();
});
