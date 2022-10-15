<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'description',
        'priority',
        'startDate',
        'endDate',
        'lockedUntil',
        'lockedById',
        'assignedEmployeeId',
        'categoryId',
        'stateId',
        'userId',
        'isCustomer',
    ];

    public function status()
    {
        return $this->belongsTo(TicketState::class, 'stateId');
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class, 'categoryId');
    }

    public function files()
    {
        return $this->hasMany(TicketFile::class, 'ticketId');
    }

    public function logs()
    {
        return $this->hasMany(TicketLog::class, 'ticketId');
    }
    public function lockedBy()
    {
        return $this->hasOne(Employee::class, 'lockedById');
    }
}