<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketState;
use Illuminate\Http\Request;

class TicketStateController extends Controller
{
    public function index(Ticket $ticket)
    {
        //check if the order value was passed, if so act accordingly to return result
        if(!empty($ticket->toArray())){
            return $ticket->status()->get();
        }
        //in all other cases return ALL
        else{
            return TicketState::all();
        }
    }

    public function show(Ticket $ticket,TicketState $ticketState)
    {
        return $ticketState;
    }

    public function store(Request $request)
    {
        $ticketState = TicketState::create($request->all());

        return response()->json($ticketState, 201);
    }

    public function update(Request $request, Ticket $ticket,TicketState $ticketState)
    {
        $ticketState->update($request->all());

        return response()->json($ticketState, 200);
    }

    public function destroy(Ticket $ticket,TicketState $ticketState)
    {
        $ticketState->delete();

        return response()->json(null,204);
    }
}