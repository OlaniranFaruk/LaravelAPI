<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'email',
        'firstName',
        'lastName',
        'phoneNumber',
        'addressId',
        'businessId',
        'isUser'
    ];

    public function password()
    {
        return $this->hasOne(CustomerPassword::class, 'customerId');
    }

    public function passwordResets()
    {
        return $this->hasMany(PasswordReset::class, 'customerId');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'userId')->where('isCustomer', '=', true);
    }

    public function ticketLogs()
    {
        return $this->hasMany(TicketLog::class, 'userId')->where('isCustomer', '=', true);
    }
    public function address() {
        return $this->hasOne(Address::class,'id','AddressId');
    }
}
