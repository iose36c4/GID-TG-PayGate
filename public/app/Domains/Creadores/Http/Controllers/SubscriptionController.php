<?php

namespace App\Domains\Creadores\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = Subscription::with(['user', 'channel', 'payments', 'invoices'])
            ->whereHas('channel', function ($q) {
                $q->where('owner_id', Auth::id());
            });

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('channel_id')) {
            $query->where('channel_pago_id', $request->channel_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $subscriptions = $query->latest()->paginate(20)->withQueryString();

        $channels = Auth::user()->channels()->where('status', 'active')->get();

        return view('creadores.subscriptions.index', compact('subscriptions', 'channels'));
    }

    public function show(Subscription $subscription)
    {
        Gate::authorize('view', $subscription);

        $subscription->load(['user', 'channel', 'payments', 'invoices']);

        return view('creadores.subscriptions.show', compact('subscription'));
    }

    public function cancel(Request $request, Subscription $subscription)
    {
        Gate::authorize('manage', $subscription->channel);

        $validated = $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $subscription->cancel($validated['reason'], Auth::id());

        // TODO: Send email notifications
        // Mail::to($subscription->user->email)->send(new SubscriptionCancelledMail($subscription));
        // Mail::to($subscription->channel->owner->email)->send(new SubscriptionCancelledCreatorMail($subscription));

        return back()->with('success', 'Suscripción cancelada correctamente.');
    }

    public function renew(Subscription $subscription)
    {
        Gate::authorize('manage', $subscription->channel);

        $subscription->renew();

        // TODO: Send email notification
        // Mail::to($subscription->user->email)->send(new SubscriptionRenewedMail($subscription));

        return back()->with('success', 'Suscripción renovada manualmente.');
    }
}
