<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Inertia\Response
    {
        $user = $request->user();
        $tickets = Ticket::where('created_by', $user->id)->get();
        return Inertia::render('Dashboard', [
            'tickets' => collect($tickets)->toArray(),
            'roles' => $user->getRoleNames()->toArray(),
        ]);
    }

    public function showTicketsUsers(Request $request) {
        return Inertia::render('Ticket/TechTickets', [
            'tickets' => Ticket::all()->toArray(),
            'roles' => $request->user()->getRoleNames()->toArray(),
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
    public function show(Request $request, int $idTicket): \Inertia\Response
    {
        $user = $request->user();
        if($user->hasRole(['admin', 'tech'])) {
            $ticket = Ticket::find($idTicket);
        } else {
            $ticket = Ticket::query()
                ->where('id', $idTicket)
                ->where('created_by', $user->id)->first();
        }
        $messages = null;
        if($ticket) {
            $messages = Message::query()->with('user')->where('ticket', $ticket->id)->get();
            $ticket = collect($ticket)->toArray();
        }

        return Inertia::render('Ticket/Item', [
            'ticket' => $ticket,
            'statuses' => config('enums.ticket_status'),
            'messages' => collect($messages)->toArray(),
            'idUser' => $user->id,
            'roles' => $user->getRoleNames()->toArray(),
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function updateStatus(Request $request): \Illuminate\Http\RedirectResponse
    {
        $fields = $request->validate([
            'ticket' => ['required', 'integer'],
            'status' => ['required', 'string'],
        ]);

        $user = $request->user();

        if($user->hasRole(['admin', 'tech'])) {
            $queryTicket = Ticket::query()->find($fields['ticket']);
        } else {
            $queryTicket = Ticket::query()
                ->where('id', $fields['ticket'])
                ->where('created_by', $user->id)->first();
        }

        if(!$queryTicket) {
            throw ValidationException::withMessages([
                'error' => 'Access denied',
            ]);
        }

        $existStatus = config('enums.ticket_status.'.$fields['status']);
        if($existStatus) {
            Ticket::query()->whereKey($fields['ticket'])->update([
                'status' => $existStatus,
            ]);
        }

        return to_route('ticket', ['id' => $fields['ticket']]);
    }

    /**
     * @throws ValidationException
     */
    public function createMessage(Request $request): \Illuminate\Http\RedirectResponse
    {
        $fields = $request->validate([
            'message' => ['required'],
            'ticket' => ['required', 'integer'],
        ]);
        $fields['created_by'] = $request->user()->id;

        $user = $request->user();

        if($user->hasRole(['admin', 'tech'])) {
            $queryTicket = Ticket::query()->find($fields['ticket']);
        } else {
            $queryTicket = Ticket::query()
                ->where('id', $fields['ticket'])
                ->where('created_by', $user->id)->first();
        }

        if(!$queryTicket) {
            throw ValidationException::withMessages([
                'error' => 'Access denied',
            ]);
        }

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
