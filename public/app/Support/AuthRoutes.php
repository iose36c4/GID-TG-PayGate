<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Http\RedirectResponse;

class AuthRoutes
{
    /**
     * Resolve the named route a user should land on after authentication,
     * based on their assigned role.
     */
    public static function homeFor(User $user): string
    {
        if ($user->hasRole('staff') || $user->hasRole('admin')) {
            return 'staff.dashboard';
        }

        if ($user->hasRole('creador')) {
            return 'creador.dashboard';
        }

        return 'home';
    }

    public static function home(User $user): RedirectResponse
    {
        return redirect()->route(self::homeFor($user));
    }
}
