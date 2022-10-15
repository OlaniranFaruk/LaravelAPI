<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $fillable = [
        'addressName',
        'addressNumber',
        'addressStreet',
        'addressPlace',
        'addressZip',
        'addressCountry',
        'addressState',
        'addressMailBoxNumber',
        'addressExtraInfo',
        'loadingPresent',
        'trailerAccess'];

}
