<?php

namespace App\Policies;

use App\Models\Subscription;
use App\Models\User;

class SubscriptionPolicy
{
    /**
     * Subscriber owns the subscription, or the channel owner / staff may view it.
     */
    public function view(User $user, Subscription $subscription): bool
    {
        return $user->id === $subscription->user_id
            || $this->manage($user, $subscription);
    }

    /**
     * Channel owner or staff/admin may manage (cancel, renew, refund).
     */
    public function manage(User $user, Subscription $subscription): bool
    {
        return $user->id === $subscription->channel?->owner_id
            || $user->hasAnyRole(['staff', 'admin']);
    }
}
