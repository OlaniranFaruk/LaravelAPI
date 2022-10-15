<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketFile;
use Illuminate\Http\Request;

class TicketFileController extends Controller
{
    public function index(Ticket $ticket)
    {
        //check if the order value was passed, if so act accordingly to return result

        if(!empty($ticket->toArray())){
            return $ticket->files()->get();

        }
        //in all other cases return ALL
        else{
            return TicketFile::simplePaginate(15);
        }
    }

    public function show(Ticket $ticket,TicketFile $ticketFile)
    {
        return $ticketFile;
    }

    public function store(Request $request)
    {
        $ticketFile = TicketFile::create($request->all());

        return response()->json($ticketFile, 201);
    }

    public function update(Request $request, Ticket $ticket, TicketFile $ticketFile)
    {
        $ticketFile->update($request->all());

        return response()->json($ticketFile, 200);
    }

    public function destroy(Ticket $ticket,TicketFile $ticketFile)
    {
        $ticketFile->delete();

        return response()->json(null,204);
    }
}
