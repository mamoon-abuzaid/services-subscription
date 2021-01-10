<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{ 

    protected $table = 'subscribers';
    
    protected $fillable = ['userId','subscriptionId','msisdn','operatorId'];
        //
}
