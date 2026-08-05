<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('registration screen can be rendered', function () {
    get(route('register'))->assertOk();
});

test('new users can register as regular users', function () {
    Event::fake();

    post(route('register'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'user',
    ])->assertRedirect(route('home'));

    $this->assertAuthenticated();

    $user = User::where('email', 'test@example.com')->first();

    expect($user)->not->toBeNull()
        ->and($user->role)->toBe('user')
        ->and($user->onboarding_step)->toBeNull()
        ->and($user->hasRole('user'))->toBeTrue();

    Event::assertDispatched(Registered::class);
});

test('new users can register as creadores and are redirected to onboarding', function () {
    post(route('register'), [
        'name' => 'Creador Test',
        'email' => 'creador@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'creador',
    ])->assertRedirect(route('creador.dashboard'));

    $this->assertAuthenticated();

    $user = User::where('email', 'creador@example.com')->first();

    expect($user->role)->toBe('creador')
        ->and($user->onboarding_step)->toBe(1)
        ->and($user->hasRole('creador'))->toBeTrue();
});

test('password is hashed on registration', function () {
    post(route('register'), [
        'name' => 'Hash User',
        'email' => 'hash@example.com',
        'password' => 'secret-password',
        'password_confirmation' => 'secret-password',
    ]);

    $user = User::where('email', 'hash@example.com')->firstOrFail();

    expect(Hash::check('secret-password', $user->password))->toBeTrue()
        ->and($user->password)->not->toBe('secret-password');
});

test('registration rejects invalid roles', function () {
    post(route('register'), [
        'name' => 'Bad Role',
        'email' => 'badrole@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'admin',
    ])->assertSessionHasErrors('role');

    expect(User::where('email', 'badrole@example.com')->count())->toBe(0);
});

test('registration rejects duplicate emails', function () {
    User::factory()->create(['email' => 'dup@example.com']);

    post(route('register'), [
        'name' => 'Dup User',
        'email' => 'dup@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertSessionHasErrors('email');
});

test('registration requires confirmed password', function () {
    post(route('register'), [
        'name' => 'No Confirm',
        'email' => 'noconfirm@example.com',
        'password' => 'password',
        'password_confirmation' => 'different-password',
    ])->assertSessionHasErrors('password');

    expect(User::where('email', 'noconfirm@example.com')->count())->toBe(0);
});
