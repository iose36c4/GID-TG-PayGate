<?php

namespace App\Domains\Creadores\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChannelPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ChannelController extends Controller
{
    public function index()
    {
        $channels = Auth::user()->channels()->with('category')->latest()->paginate(15);

        return view('creadores.channels.index', compact('channels'));
    }

    public function create()
    {
        $categories = Category::active()->get();

        return view('creadores.channels.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:100|alpha_dash|unique:channel_pagos,slug',
            'description' => 'nullable|string|max:2000',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|max:2048',
            'telegram_chat_id' => ['nullable', 'numeric', 'min:1', 'unique:channel_pagos,telegram_chat_id'],
            'price' => 'required|numeric|min:0|max:99999999.99',
            'currency' => ['required', 'string', 'size:3', Rule::in(['ARS', 'USD', 'EUR'])],
            'billing_cycle' => ['required', Rule::in(['monthly', 'quarterly', 'yearly', 'lifetime'])],
            'trial_days' => 'nullable|integer|min:0|max:365',
        ]);

        $slug = $validated['slug'] ?? Str::slug($validated['name']);

        $originalSlug = $slug;
        $counter = 1;
        while (ChannelPago::where('slug', $slug)->exists()) {
            $slug = $originalSlug.'-'.$counter++;
        }

        $channel = ChannelPago::create([
            'owner_id' => Auth::id(),
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'telegram_chat_id' => $validated['telegram_chat_id'] ?? null,
            'price' => $validated['price'],
            'currency' => $validated['currency'],
            'billing_cycle' => $validated['billing_cycle'],
            'trial_days' => $validated['trial_days'] ?? 0,
            'status' => 'draft',
        ]);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('covers', 'public');
            $channel->update(['cover_image' => $path]);
        }

        return redirect()->route('creadores.channels.show', $channel)
            ->with('success', 'Canal creado correctamente. Configura el bot y precios para activarlo.');
    }

    public function show(ChannelPago $channel)
    {
        Gate::authorize('manage', $channel);

        $channel->load(['category', 'owner', 'payoutSchedules', 'subscriptions']);

        return view('creadores.channels.show', compact('channel'));
    }

    public function edit(ChannelPago $channel)
    {
        Gate::authorize('manage', $channel);

        $categories = Category::active()->get();

        return view('creadores.channels.edit', compact('channel', 'categories'));
    }

    public function update(Request $request, ChannelPago $channel)
    {
        Gate::authorize('manage', $channel);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:100', 'alpha_dash', Rule::unique('channel_pagos')->ignore($channel->id)],
            'description' => 'nullable|string|max:2000',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|max:2048',
            'telegram_chat_id' => ['nullable', 'numeric', 'min:1', Rule::unique('channel_pagos')->ignore($channel->id)],
            'telegram_bot_token' => 'nullable|string|max:100',
            'price' => 'nullable|numeric|min:0|max:99999999.99',
            'currency' => ['nullable', 'string', 'size:3', Rule::in(['ARS', 'USD', 'EUR'])],
            'billing_cycle' => ['nullable', Rule::in(['monthly', 'quarterly', 'yearly', 'lifetime'])],
            'trial_days' => 'nullable|integer|min:0|max:365',
            'status' => ['nullable', Rule::in(['draft', 'pending', 'active', 'paused', 'archived'])],
        ]);

        $slug = $validated['slug'] ?? Str::slug($validated['name']);

        $originalSlug = $slug;
        $counter = 1;
        while (ChannelPago::where('slug', $slug)->where('id', '!=', $channel->id)->exists()) {
            $slug = $originalSlug.'-'.$counter++;
        }

        $updateData = [
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'telegram_chat_id' => $validated['telegram_chat_id'] ?? null,
        ];

        if (isset($validated['price'])) {
            $updateData['price'] = $validated['price'];
        }
        if (isset($validated['currency'])) {
            $updateData['currency'] = $validated['currency'];
        }
        if (isset($validated['billing_cycle'])) {
            $updateData['billing_cycle'] = $validated['billing_cycle'];
        }
        if (isset($validated['trial_days'])) {
            $updateData['trial_days'] = $validated['trial_days'];
        }
        if (isset($validated['status'])) {
            $updateData['status'] = $validated['status'];
        }
        if (isset($validated['telegram_bot_token']) && $validated['telegram_bot_token']) {
            $updateData['telegram_bot_token'] = $validated['telegram_bot_token'];
        }

        $channel->update($updateData);

        if ($request->hasFile('cover_image')) {
            if ($channel->cover_image) {
                Storage::disk('public')->delete($channel->cover_image);
            }
            $path = $request->file('cover_image')->store('covers', 'public');
            $channel->update(['cover_image' => $path]);
        }

        return redirect()->route('creadores.channels.show', $channel)
            ->with('success', 'Canal actualizado correctamente.');
    }

    public function destroy(ChannelPago $channel)
    {
        Gate::authorize('manage', $channel);

        if ($channel->cover_image) {
            Storage::disk('public')->delete($channel->cover_image);
        }

        $channel->delete();

        return redirect()->route('creadores.channels.index')
            ->with('success', 'Canal eliminado correctamente.');
    }
}
