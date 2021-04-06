<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionLog extends Model
{
    
    protected $table = 'subscriptionLog';
    protected $fillable = ['userId','subscriptionId','msisdn','operatorId','action'];
    
}
