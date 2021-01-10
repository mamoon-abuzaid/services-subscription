<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Validator;
use App\user_client;
use App\Subscriber;
use App\Subscription_log;
use Illuminate\Support\Facades\Http;


class User extends Controller
{
    public function subscribe(Request $request){
        /*$payloadable = [
            'iss' => $request->iss,
            'exp' => $request->exp,
            'sub' => $request->sub,
            'aud' => $request->aud,
            'nbf' => $request->nbf,
            'iat' => $request->iat,
            'jti' => $request->jti,
            'userId' => $request->userId,
            'subscriptionId' => $request->subscriptionId,
            'msisdn' => $request->msisdn,
            'operatorId' => $request->operatorId
        ];*/
        
        $validation = Validator::make($request->all(), [
            'subscriptionId' => 'required',
            'msisdn' => 'required',
        ]);
       
        if ($validation->fails()) {
           dd("fail to insert required param ");
        }  
        else {
            //$obj = user_client::create($request->all());
            $obj = Subscriber::create($request->all());

            // add to Log
            $subscription = new Subscription_log();
            $subscription->userId = $request->input ('userId');
            $subscription->subscriptionId = $request->input ('subscriptionId');
            $subscription->msisdn = $request->input ('msisdn');
            $subscription->operatorId = $request->input ('operatorId');
            $subscription->action = 'sub';
            $obj2=$subscription->save();

            //$obj2 = $subscription::create($subscription);
            ////////////////////////////////
            // $obj2 = Subscription_log::create($request->all());
            
            // $obj2 = new Subscription_log();
            // $obj2->userId = $request->input ('fname');
            // $obj2->lname = $request->input ('lname');
            // $obj2->age = $request->input ('age');
            // $obj2->save();

            // $students = new Subscription_log();
            // $students->fname = $request->input ('fname');
            // $students->lname = $request->input ('lname');
            // $students->age = $request->input ('age');
    
            // $students->save();
            // ///////////////////////////////
            if($obj2 && $obj){
                  echo"i'm I3NNNNNNNNNNNNNNNNNNN" ;
            }
            if($obj && $obj2){
            echo "teeeeeeeeeeeeeeeeeeestTTTTTTT88TTTTTTTTT";
                    $payload = JWTFactory::
                    //sub($request->subscriptionId)
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
            // dd("ss")
    return $response;
        }
    
    else{
dd("fail to insert");
    }
}
    }
}
