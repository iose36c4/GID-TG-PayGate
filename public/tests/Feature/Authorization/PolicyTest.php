<?php

use App\Models\Category;
use App\Models\ChannelPago;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

function makeChannel(?User $owner = null, array $attributes = []): ChannelPago
{
    $category = Category::create([
        'name' => 'Categoría Test',
        'slug' => 'categoria-test',
    ]);

    return ChannelPago::create(array_merge([
        'owner_id' => $owner?->id,
        'name' => 'Canal Test',
        'slug' => 'canal-test'.uniqid(),
        'category_id' => $category->id,
        'price' => 1000.00,
        'currency' => 'ARS',
        'billing_cycle' => 'monthly',
        'status' => 'active',
    ], $attributes));
}

test('channel owner can manage their channel', function () {
    $owner = User::factory()->create();
    $channel = makeChannel($owner);

    expect(Gate::forUser($owner)->allows('manage', $channel))->toBeTrue();
});

test('staff and admins can manage any channel', function () {
    $owner = User::factory()->create();
    $channel = makeChannel($owner);

    $staff = User::factory()->withRole('staff')->create();
    $admin = User::factory()->withRole('admin')->create();

    expect(Gate::forUser($staff)->allows('manage', $channel))->toBeTrue()
        ->and(Gate::forUser($admin)->allows('manage', $channel))->toBeTrue();
});

test('unrelated users cannot manage a channel', function () {
    $owner = User::factory()->create();
    $channel = makeChannel($owner);

    $other = User::factory()->withRole('creador')->create();

    expect(Gate::forUser($other)->allows('manage', $channel))->toBeFalse()
        ->and(Gate::forUser($other)->allows('view', $channel))->toBeFalse();
});

test('only creadores or admins may create channels', function () {
    $creador = User::factory()->withRole('creador')->create();
    $admin = User::factory()->withRole('admin')->create();
    $user = User::factory()->create();

    expect(Gate::forUser($creador)->allows('create', ChannelPago::class))->toBeTrue()
        ->and(Gate::forUser($admin)->allows('create', ChannelPago::class))->toBeTrue()
        ->and(Gate::forUser($user)->allows('create', ChannelPago::class))->toBeFalse();
});

test('channel routes enforce ownership', function () {
    $owner = User::factory()->withRole('creador')->create();
    $channel = makeChannel($owner);

    $intruder = User::factory()->withRole('creador')->create();

    actingAs($intruder);

    get(route('creador.channels.show', $channel))->assertForbidden();
    get(route('creador.channels.edit', $channel))->assertForbidden();

    actingAs($owner);

    get(route('creador.channels.show', $channel))->assertOk();
});

test('subscription viewer can view their own subscription', function () {
    $subscriber = User::factory()->create();
    $owner = User::factory()->create();
    $channel = makeChannel($owner);

    $subscription = Subscription::create([
        'user_id' => $subscriber->id,
        'channel_pago_id' => $channel->id,
        'price' => 1000.00,
        'currency' => 'ARS',
        'billing_cycle' => 'monthly',
        'status' => 'active',
        'renews_at' => now()->addMonth(),
    ]);

    expect(Gate::forUser($subscriber)->allows('view', $subscription))->toBeTrue()
        ->and(Gate::forUser($owner)->allows('view', $subscription))->toBeTrue();

    $stranger = User::factory()->create();
    expect(Gate::forUser($stranger)->allows('view', $subscription))->toBeFalse();
});

test('channel owner or staff can manage a subscription', function () {
    $subscriber = User::factory()->create();
    $owner = User::factory()->create();
    $channel = makeChannel($owner);

    $subscription = Subscription::create([
        'user_id' => $subscriber->id,
        'channel_pago_id' => $channel->id,
        'price' => 1000.00,
        'currency' => 'ARS',
        'billing_cycle' => 'monthly',
        'status' => 'active',
        'renews_at' => now()->addMonth(),
    ]);

    $staff = User::factory()->withRole('staff')->create();

    expect(Gate::forUser($owner)->allows('manage', $subscription))->toBeTrue()
        ->and(Gate::forUser($staff)->allows('manage', $subscription))->toBeTrue()
        ->and(Gate::forUser($subscriber)->allows('manage', $subscription))->toBeFalse();
});
