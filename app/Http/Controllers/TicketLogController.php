<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketLog;
use Illuminate\Http\Request;

class TicketLogController extends Controller
{
    public function index(Ticket $ticket)
    {
        //check if the order value was passed, if so act accordingly to return result
        if(!empty($ticket->toArray())){
            return $ticket->logs()->get();

        }
        //in all other cases return ALL
        else{
            return TicketLog::simplePaginate(15);
        }
    }

    public function show(Ticket $ticket,TicketLog $ticketLog)
    {
        return $ticketLog;
    }

    public function store(Request $request)
    {
        $ticketLog = TicketLog::create($request->all());

        return response()->json($ticketLog, 201);
    }

    public function update(Request $request, Ticket $ticket,TicketLog $ticketLog)
    {
        $ticketLog->update($request->all());

        return response()->json($ticketLog, 200);
    }

    public function destroy(Ticket $ticket,TicketLog $ticketLog)
    {
        $ticketLog->delete();

        return response()->json(null,204);
    }
}
