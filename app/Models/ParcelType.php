<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'minWidth',
        'maxWidth',
        'minDepth',
        'maxDepth',
        'minHeight',
        'maxHeight',
        'minWeight',
        'maxWeight'
    ];
}