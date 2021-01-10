<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_client extends Model
{
    protected $table='users_client';
    protected $fillable = [
        'subscriptionId', 'msisdn', 'operatorId','status',
    ];
}
