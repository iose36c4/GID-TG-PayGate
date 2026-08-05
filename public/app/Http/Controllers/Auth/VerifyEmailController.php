<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        abort_unless(
            hash_equals((string) $request->route('hash'), sha1($request->user()->getEmailForVerification())),
            403
        );

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('home'));
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(route('home'));
    }
}
