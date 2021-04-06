<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Validator;
use App\userClient;
use App\Subscriber;
use App\SubscriptionLog;
use Illuminate\Support\Facades\Http;


class User extends Controller
{
    public function subscribe(Request $request){
     
        
        $validation = Validator::make($request->all(), [
            'subscriptionId' => 'required',
            'msisdn' => 'required',
        ]);
       
        if ($validation->fails()) {
           dd("fail to insert required param ");
        }  
        else {
            $obj = Subscriber::create($request->all());

            // Add to Log
            $subscription = new SubscriptionLog();
            $subscription->userId = $request->input ('userId');
            $subscription->subscriptionId = $request->input ('subscriptionId');
            $subscription->msisdn = $request->input ('msisdn');
            $subscription->operatorId = $request->input ('operatorId');
            $subscription->action = 'sub';
            $obj2=$subscription->save();
            
            if($obj && $obj2){
                    $payload = JWTFactory::
                    userId($obj->userId)
                    ->subscriptionId($request->subscriptionId)
                    ->msisdn($request->msisdn)
                    ->operatorId($request->operatorId)
                    ->make();

                $token = JWTAuth::encode($payload);
                print ($token);
                $response = Http::get('https://reqbin.com/echo', [
                    'payload' => $token,
                ]);
    return $response;
        }
    
    else{
dd("fail to insert");
    }
}
    }
}
