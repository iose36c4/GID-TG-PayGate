<?php

namespace App\Domains\Creadores\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChannelPago;
use App\Models\User;
use App\Services\ArgentineTaxService;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class OnboardingController extends Controller
{
    public function __construct(
        protected TelegramService $telegramService
    ) {}

    public function index()
    {
        $user = Auth::user();
        $step = $user->onboarding_step ?? 1;

        if ($step >= 5) {
            return redirect()->route('creadores.dashboard');
        }

        return redirect()->route("creadores.onboarding.step{$step}");
    }

    public function step1()
    {
        $user = Auth::user();

        if ($user->onboarding_step > 1) {
            return redirect()->route("creadores.onboarding.step{$user->onboarding_step}");
        }

        return view('creadores.onboarding.step1', [
            'countries' => [],
            'taxpayerTypes' => ArgentineTaxService::TAXPAYER_TYPES,
            'provinces' => ArgentineTaxService::PROVINCES,
        ]);
    }

    public function step1Store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'taxpayer_type' => ['required', Rule::in(array_keys(ArgentineTaxService::TAXPAYER_TYPES))],
            'cuit_cuil' => ['required', 'string', 'size:11', 'regex:/^\d{11}$/'],
            'tax_province' => ['required', 'string', Rule::in(array_keys(ArgentineTaxService::PROVINCES))],
            'tax_city' => 'required|string|max:100',
            'tax_zip_code' => ['required', 'string', 'size:4', 'regex:/^\d{4}$/'],
            'tax_address' => 'required|string|max:500',
            'iibb_number' => 'nullable|string|max:50',
            'monotributo_category' => ['nullable', 'string', 'size:1', Rule::in(range('A', 'K'))],
            'ganancias_exempt' => 'boolean',
            'iva_exempt' => 'boolean',
        ]);

        if (! ArgentineTaxService::validateCuitCuil($validated['cuit_cuil'])) {
            return back()->withErrors(['cuit_cuil' => 'CUIT/CUIL inválido (algoritmo Módulo 11)'])->withInput();
        }

        $existing = User::where('cuit_cuil', $validated['cuit_cuil'])
            ->where('id', '!=', $user->id)
            ->exists();

        if ($existing) {
            return back()->withErrors(['cuit_cuil' => 'Este CUIT/CUIL ya está registrado'])->withInput();
        }

        $user->update($validated);
        $user->update(['onboarding_step' => 2]);

        return redirect()->route('creadores.onboarding.step2');
    }

    public function step2()
    {
        $user = Auth::user();

        if ($user->onboarding_step !== 2) {
            return redirect()->route("creadores.onboarding.step{$user->onboarding_step}");
        }

        $categories = Category::active()->get();

        return view('creadores.onboarding.step2', compact('categories'));
    }

    public function step2Store(Request $request)
    {
        $user = Auth::user();

        if ($user->onboarding_step !== 2) {
            return redirect()->route("creadores.onboarding.step{$user->onboarding_step}");
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:100|alpha_dash|unique:channel_pagos,slug',
            'description' => 'nullable|string|max:2000',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|max:2048',
            'telegram_chat_id' => ['nullable', 'numeric', 'min:1', 'unique:channel_pagos,telegram_chat_id'],
        ]);

        $slug = $validated['slug'] ?? Str::slug($validated['name']);

        $originalSlug = $slug;
        $counter = 1;
        while (ChannelPago::where('slug', $slug)->exists()) {
            $slug = $originalSlug.'-'.$counter++;
        }

        $channel = ChannelPago::create([
            'owner_id' => $user->id,
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'telegram_chat_id' => $validated['telegram_chat_id'] ?? null,
            'status' => 'draft',
        ]);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('covers', 'public');
            $channel->update(['cover_image' => $path]);
        }

        $user->update(['onboarding_step' => 3]);

        return redirect()->route('creadores.onboarding.step3', $channel);
    }

    public function step3(ChannelPago $channel)
    {
        Gate::authorize('manage', $channel);

        $user = Auth::user();

        if ($user->onboarding_step !== 3) {
            return redirect()->route("creadores.onboarding.step{$user->onboarding_step}");
        }

        return view('creadores.onboarding.step3', compact('channel'));
    }

    public function step3Store(Request $request, ChannelPago $channel)
    {
        Gate::authorize('manage', $channel);

        $user = Auth::user();

        if ($user->onboarding_step !== 3) {
            return redirect()->route("creadores.onboarding.step{$user->onboarding_step}");
        }

        $validated = $request->validate([
            'telegram_bot_token' => 'required|string|max:100',
            'telegram_chat_id' => ['nullable', 'numeric', 'min:1'],
        ]);

        $botInfo = $this->telegramService->getBotInfo($validated['telegram_bot_token']);

        if (! $botInfo['ok']) {
            return back()->withErrors(['telegram_bot_token' => 'Token de bot inválido: '.($botInfo['description'] ?? 'Error desconocido')])->withInput();
        }

        $channel->update([
            'telegram_bot_token' => $validated['telegram_bot_token'],
            'telegram_chat_id' => $validated['telegram_chat_id'] ?? null,
            'telegram_bot_username' => $botInfo['result']['username'],
        ]);

        $user->update(['onboarding_step' => 4]);

        return redirect()->route('creadores.onboarding.step4', $channel);
    }

    public function step4(ChannelPago $channel)
    {
        Gate::authorize('manage', $channel);

        $user = Auth::user();

        if ($user->onboarding_step !== 4) {
            return redirect()->route("creadores.onboarding.step{$user->onboarding_step}");
        }

        return view('creadores.onboarding.step4', compact('channel'));
    }

    public function step4Store(Request $request, ChannelPago $channel)
    {
        Gate::authorize('manage', $channel);

        $user = Auth::user();

        if ($user->onboarding_step !== 4) {
            return redirect()->route("creadores.onboarding.step{$user->onboarding_step}");
        }

        $validated = $request->validate([
            'price' => 'required|numeric|min:0|max:99999999.99',
            'currency' => ['required', 'string', 'size:3', Rule::in(['ARS', 'USD', 'EUR'])],
            'billing_cycle' => ['required', Rule::in(['monthly', 'quarterly', 'yearly', 'lifetime'])],
            'trial_days' => 'nullable|integer|min:0|max:365',
        ]);

        $channel->update([
            'price' => $validated['price'],
            'currency' => $validated['currency'],
            'billing_cycle' => $validated['billing_cycle'],
            'trial_days' => $validated['trial_days'] ?? 0,
            'status' => 'active',
        ]);

        $user->update([
            'onboarding_step' => 5,
            'onboarding_completed_at' => now(),
        ]);

        $channel->payoutSchedules()->create([
            'frequency' => 'monthly',
            'minimum_amount' => 1000,
            'platform_fee_percentage' => 0.05,
            'gateway_fee_percentage' => 0.035,
            'fixed_fee' => 50,
            'is_active' => true,
        ]);

        return redirect()->route('creadores.dashboard')
            ->with('success', '¡Onboarding completado! Tu canal está listo para recibir suscriptores.');
    }
}
