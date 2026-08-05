<?php

namespace App\Domains\Staff\Http\Controllers;

use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function index()
    {
        return view('staff.tickets.index');
    }

    public function show($id)
    {
        return view('staff.tickets.show', compact('id'));
    }

    public function edit($id)
    {
        return view('staff.tickets.edit', compact('id'));
    }

    public function update($id)
    {
        // TODO: Implement ticket update
    }

    public function destroy($id)
    {
        // TODO: Implement ticket deletion
    }
}
