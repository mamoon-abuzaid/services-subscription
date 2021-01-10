<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription_log extends Model
{
    
    protected $table = 'subscription_log';
    protected $fillable = ['userId','subscriptionId','msisdn','operatorId','action'];
    //
}
