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
    public function index(Request $request): \Inertia\Response
    {
        $tickets = Ticket::where('created_by', $request->user()->id)->get();
        return Inertia::render('Dashboard', [
            'tickets' => collect($tickets)->toArray(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Ticket/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
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
            'statuses' => config('enums.ticket_status'),
            'messages' => collect($messages)->toArray(),
            'idUser' => $request->user()->id,
        ]);
    }

    public function updateStatus(Request $request): \Illuminate\Http\RedirectResponse
    {
        $fields = $request->validate([
            'ticket' => ['required', 'integer'],
            'status' => ['required', 'string'],
        ]);

        $existStatus = config('enums.ticket_status.'.$fields['status']);
        if($existStatus) {
            Ticket::query()->whereKey($fields['ticket'])->update([
                'status' => $existStatus,
            ]);
        }

        return to_route('ticket', ['id' => $fields['ticket']]);
    }

    public function createMessage(Request $request): \Illuminate\Http\RedirectResponse
    {
        $fields = $request->validate([
            'message' => ['required'],
            'ticket' => ['required', 'integer'],
        ]);
        $fields['created_by'] = $request->user()->id;

        $queryTicket = Ticket::query()->find($fields['ticket']);
        $ticket = $queryTicket->toArray();
        $statusProcess = config('enums.ticket_status.process');

        if(!empty($ticket) && $ticket['status'] != $statusProcess) {
            Ticket::query()->whereKey($fields['ticket'])->update(['status' => $statusProcess]);
        }

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
