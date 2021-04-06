<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Validator;
use App\user_client;
use App\Subscriber;
use App\SubscriptionLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Client;
use Throwable;

class UserSubscribe extends Controller
{
    //

    public function subscribe(Request $request){

        
        $validation = Validator::make($request->all(), [
            'subscriptionId' => 'required',
            'msisdn' => 'required',
        ]);
       
        if ($validation->fails()) {
           dd("Failed to insert required param ");
        }  
        else {  
                /////////////////////////////////////
                ///// add to Log    /////////////////
                $subscription = new Subscription_log();
                $subscription->userId = $request->input ('userId');
                $subscription->subscriptionId = $request->input ('subscriptionId');
                $subscription->msisdn = $request->input ('msisdn');
                $subscription->operatorId = $request->input ('operatorId');
                $subscription->action = 'sub';
                $query1=$subscription->save();

            //////////////////////////////          
            /// create a pendding sub   //////////
            $query2 = Subscriber::create($request->all());
            // //////JWT encoding/////////////////////////
            if($query1 && $query2){
                    $payload = JWTFactory::
                    sub($request->sub)
                    ->userId($request->userId)
                    ->subscriptionId($request->subscriptionId)
                    ->msisdn($request->msisdn)
                    ->operatorId($request->operatorId)
                    ->make();
                $token = JWTAuth::encode($payload);
                //print ($payload);
                //print ("User Token ".$token);
                // BKR code $request = Request::create('/api/server/subscribe/', 'GET',["ddata"=>base64_encode($token)]);
               
                ///////////////////////////
                ////// call server sub API
                $request = Request::create('/api/server/subscribe/', 'GET',["token"=>$token]);
                $response = Route::dispatch($request);

            ///////////////////////////////////
            //// Action base on server response
            ////// change sub status
            $response_data = $response->getData();
            $msg = $response_data->msg;
            
            $update_sub_status = DB::table('subscribers')
            ->where('subscriptionId', $response_data->subscriptionId)
            ->where('msisdn', $response_data->msisdn)
            ->update(['status' => $response_data->status]);

            $update_sub_log = DB::table('subscriptionLog')
            ->where('subscriptionId', $response_data->subscriptionId)
            ->where('msisdn', $response_data->msisdn)
            ->where('action', 'sub')
            ->update(['status' => $response_data->msg]);
            ///// END Action base on server response


    return $response;
        }
    
    else{
dd("Failed to insert");
    }
}
    }
}
