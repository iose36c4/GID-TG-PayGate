<?php

namespace App\Policies;

use App\Models\ChannelPago;
use App\Models\User;

class ChannelPagoPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ChannelPago $channel): bool
    {
        return $this->manage($user, $channel);
    }

    public function create(User $user): bool
    {
        return $user->hasRole('creador') || $user->hasRole('admin');
    }

    public function update(User $user, ChannelPago $channel): bool
    {
        return $this->manage($user, $channel);
    }

    public function delete(User $user, ChannelPago $channel): bool
    {
        return $this->manage($user, $channel);
    }

    /**
     * Owner of the channel, or staff/admin with auditing privileges.
     */
    public function manage(User $user, ChannelPago $channel): bool
    {
        return $user->id === $channel->owner_id
            || $user->hasAnyRole(['staff', 'admin']);
    }
}
