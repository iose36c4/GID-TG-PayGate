<?php

namespace App\Domains\Staff\Http\Controllers;

use App\Http\Controllers\Controller;

class ChannelController extends Controller
{
    public function index()
    {
        return view('staff.channels.index');
    }

    public function show($id)
    {
        return view('staff.channels.show', compact('id'));
    }

    public function edit($id)
    {
        return view('staff.channels.edit', compact('id'));
    }

    public function update($id)
    {
        // TODO: Implement channel update
    }

    public function destroy($id)
    {
        // TODO: Implement channel deletion
    }
}
