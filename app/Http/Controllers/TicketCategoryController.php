<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketCategory;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    public function index(Ticket $ticket)
    {
        //check if the order value was passed, if so act accordingly to return result

        if(!empty($ticket->toArray())){
            return $ticket->category()->get();

        }
        //in all other cases return ALL
        else{
            return TicketCategory::all();
        }

    }


    public function show(Ticket $ticket,TicketCategory $ticketCategory)
    {
        return $ticketCategory;
    }

    public function store(Request $request,Ticket $ticket)
    {
        $ticketCategory = TicketCategory::create($request->all());

        return response()->json($ticketCategory, 201);
    }

    public function update(Request $request,Ticket $ticket, TicketCategory $ticketCategory)
    {
        $ticketCategory->update($request->all());

        return response()->json($ticketCategory, 200);
    }

    public function destroy(Ticket $ticket, TicketCategory $ticketCategory)
    {
        $ticketCategory->delete();

        return response()->json(null,204);
    }
}