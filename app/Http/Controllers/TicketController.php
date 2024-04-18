<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
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
    // Fetch all users
    $users = User::all();

    return view('tickets.create', compact('users'));
}

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'user_id' => 'required|exists:users,id',
            'scrumboard' => 'nullable|url',
            'status' => 'required|in:open,closed', // Adjust according to your available statuses
        ]);

        // Create the ticket with the validated data
        Ticket::create($validatedData);

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    // ... any additional methods ...
}
