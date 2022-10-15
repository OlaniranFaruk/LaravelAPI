<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketState extends Model
{
    use HasFactory;

    protected $fillable = [
        'stateName'
    ];

//    public function tickets()
//    {
//        return $this->hasMany(Ticket::class, 'ticketStateId');
//    }
}