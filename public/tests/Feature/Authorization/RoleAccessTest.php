<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('guest is redirected to login for creator routes', function () {
    get(route('creador.dashboard'))->assertRedirect(route('login'));
});

test('guest is redirected to login for staff routes', function () {
    get(route('staff.dashboard'))->assertRedirect(route('login'));
});

test('regular users cannot access creator routes', function () {
    $user = User::factory()->create();

    actingAs($user);

    get(route('creador.dashboard'))->assertForbidden();
});

test('creadores can access creator routes', function () {
    $creador = User::factory()->withRole('creador')->create();

    actingAs($creador);

    get(route('creador.dashboard'))->assertOk();
});

test('regular users cannot access staff routes', function () {
    $user = User::factory()->create();

    actingAs($user);

    get(route('staff.dashboard'))->assertForbidden();
});

test('creadores cannot access staff routes', function () {
    $creador = User::factory()->withRole('creador')->create();

    actingAs($creador);

    get(route('staff.dashboard'))->assertForbidden();
});

test('staff can access staff routes', function () {
    $staff = User::factory()->withRole('staff')->create();

    actingAs($staff);

    get(route('staff.dashboard'))->assertOk();
});

test('admins can access staff routes', function () {
    $admin = User::factory()->withRole('admin')->create();

    actingAs($admin);

    get(route('staff.dashboard'))->assertOk();
});
