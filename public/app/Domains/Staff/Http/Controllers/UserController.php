<?php

namespace App\Domains\Staff\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(20);

        return view('staff.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('staff.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('staff.users.edit', compact('user'));
    }

    public function update(User $user)
    {
        // TODO: Implement user update
    }

    public function destroy(User $user)
    {
        // TODO: Implement user deletion
    }
}
