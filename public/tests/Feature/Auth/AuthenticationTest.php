<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('login screen can be rendered', function () {
    get(route('login'))->assertOk();
});

test('users can authenticate and land on role home', function () {
    $user = User::factory()->create(['email' => 'user@example.com']);

    post(route('login'), [
        'email' => 'user@example.com',
        'password' => 'password',
    ])->assertRedirect(route('home'));

    $this->assertAuthenticated();
});

test('creadores land on their dashboard after login', function () {
    $creador = User::factory()->withRole('creador')->create(['email' => 'creador@example.com']);

    post(route('login'), [
        'email' => 'creador@example.com',
        'password' => 'password',
    ])->assertRedirect(route('creador.dashboard'));

    $this->assertAuthenticatedAs($creador);
});

test('staff and admins land on the staff panel after login', function () {
    $staff = User::factory()->withRole('staff')->create(['email' => 'staff@example.com']);

    post(route('login'), [
        'email' => 'staff@example.com',
        'password' => 'password',
    ])->assertRedirect(route('staff.dashboard'));

    $this->assertAuthenticatedAs($staff);

    $this->post('/logout');

    $admin = User::factory()->withRole('admin')->create(['email' => 'admin@example.com']);

    post(route('login'), [
        'email' => 'admin@example.com',
        'password' => 'password',
    ])->assertRedirect(route('staff.dashboard'));

    $this->assertAuthenticatedAs($admin);
});

test('users cannot authenticate with an invalid password', function () {
    User::factory()->create(['email' => 'wrong@example.com']);

    post(route('login'), [
        'email' => 'wrong@example.com',
        'password' => 'incorrect-password',
    ])->assertSessionHasErrors('email');

    $this->assertGuest();
});

test('inactive users cannot authenticate', function () {
    User::factory()->inactive()->create(['email' => 'inactive@example.com']);

    post(route('login'), [
        'email' => 'inactive@example.com',
        'password' => 'password',
    ])->assertSessionHasErrors('email');

    $this->assertGuest();
});

test('login throttles after repeated failures', function () {
    User::factory()->create(['email' => 'throttle@example.com']);

    for ($i = 0; $i < 5; $i++) {
        post(route('login'), [
            'email' => 'throttle@example.com',
            'password' => 'wrong-password',
        ]);
    }

    post(route('login'), [
        'email' => 'throttle@example.com',
        'password' => 'wrong-password',
    ])->assertTooManyRequests();
});

test('authenticated users can logout', function () {
    $user = User::factory()->create();

    actingAs($user);

    post(route('logout'))->assertRedirect('/');

    $this->assertGuest();
});

test('guest is redirected to login when accessing protected routes', function () {
    get(route('profile.edit'))->assertRedirect(route('login'));
});
