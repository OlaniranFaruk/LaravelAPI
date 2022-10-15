<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $allTickets = Ticket::with('logs','files');
        $tickets = QueryBuilder::for($allTickets)
            ->allowedFilters(['stateId','categoryId','subject','startDate','priority'])
            ->paginate(15);

        return $tickets;
    }

    public function show(Ticket $ticket)
    {
        return $ticket;
    }

    public function store(Request $request)
    {
        $ticket = Ticket::create($request->all());

        return response()->json($ticket, 201);
    }

    public function update(Request $request, Ticket $ticket)
    {
        $ticket->update($request->all());

        return response()->json($ticket, 200);
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->files()->delete();
        $ticket->logs()->delete();
        $ticket->delete();

        return response()->json(null,204);
    }
}
