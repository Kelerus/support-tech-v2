<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tickets = Ticket::where('created_by', $request->user()->id)->get();
        return Inertia::render('Dashboard', [
            'tickets' => collect($tickets)->toArray(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Ticket/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['required'],
        ]);

        $fields['created_by'] = $request->user()->id;

        $ticket = Ticket::create($fields);

        return to_route('ticket', ['id' => $ticket->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, int $idTicket)
    {
        $ticket = Ticket::find($idTicket);
        $messages = null;
        if($ticket) {
            $messages = Message::query()->with('user')->where('ticket', $ticket->id)->get();
            $ticket = collect($ticket)->toArray();
        }
        return Inertia::render('Ticket/Item', [
            'ticket' => $ticket,
            'messages' => collect($messages)->toArray(),
            'idUser' => $request->user()->id,
        ]);
    }

    public function createMessage(Request $request) {
        $fields = $request->validate([
            'message' => ['required'],
            'ticket' => ['required'],
        ]);
        $fields['created_by'] = $request->user()->id;
        Message::create($fields);
        return to_route('ticket', ['id' => $fields['ticket'] ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
