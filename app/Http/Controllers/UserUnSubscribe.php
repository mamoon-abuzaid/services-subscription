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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Client;
use Throwable;

class UserUnSubscribe extends Controller
{
    //
    public function unsubscribe(Request $request){
        
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
                $subscription->action = 'unsub';
                $query1=$subscription->save();
                $id=$subscription->id;
            /////////////////////////////////////////////
            // //////JWT encoding/////////////////////////
            if($query1){
                    $payload = JWTFactory::
                    sub($request->sub)
                    ->userId($request->userId)
                    ->subscriptionId($request->subscriptionId)
                    ->msisdn($request->msisdn)
                    ->operatorId($request->operatorId)
                    ->make();
                $token = JWTAuth::encode($payload);
   
                ///////////////////////////
                ////// call server sub API
                $request = Request::create('/api/server/unsubscribe/', 'GET',["token"=>$token]);
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
            if($update_sub_status){// don't insert unless there sub already
            $update_sub_log = DB::table('subscription_log')
            ->where('subscriptionId', $response_data->subscriptionId)
            ->where('msisdn', $response_data->msisdn)
            ->where('action', 'unsub')
            ->update(['status' => $response_data->msg]);
            }
            else{ // in case there is no sub already
                $update_sub_log = DB::table('subscription_log')
                ->where('subscriptionId', $response_data->subscriptionId)
                ->where('msisdn', $response_data->msisdn)
                ->where('action', 'unsub')
                ->update(['status' => 'Subscription not exist']);
            }
            ///// END Action base on server response


    return $response;
        }
    
    else{
dd("Failed to insert");
    }
}
    }
}
