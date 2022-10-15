<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'businessName',
        'vat'
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'businessId');
    }
}
