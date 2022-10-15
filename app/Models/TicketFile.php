<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'fileSource',
        'fileName',
        'fileType',
        'fileSize',
        'ticketId',
        'userId',
        'isCustomer'
    ];

//    public function ticket()
//    {
//        return $this->belongsTo(Ticket::class, 'ticketId');
//    }
}