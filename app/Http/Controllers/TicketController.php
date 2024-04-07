<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tickets = Ticket::when(!$user->hasAnyRole(['Developer', 'Designer']), function ($query) use ($user) {
            return $query->where('user_id', $user->id);
        })->get();
    
        return view('tickets.index', compact('tickets'));
    }


    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
{
    $user_id = auth()->id();


    // Assuming the ticket details are somehow determined automatically or predefined
    $ticket = Ticket::create([
        $user = auth()->user(),
        'title' => $user->name,
        'description' => 'Automatically Generated Description',
        'user_id' => $user_id,
    ]);

    return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
}

public function show(Ticket $ticket)
{
    return view('tickets.show', compact('ticket'));
}

}