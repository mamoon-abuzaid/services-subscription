<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userClient extends Model
{
    protected $table='usersClient';
    protected $fillable = [
        'subscriptionId', 'msisdn', 'operatorId','status',
    ];
}
