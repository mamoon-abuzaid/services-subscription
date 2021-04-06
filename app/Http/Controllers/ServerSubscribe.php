<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServerSubscribe extends Controller
{
    //
    public function validateSubRequest(Request $request){  
        //$msg = 'Successfully Changed';
         //dd($request->subscriptionId);
        //echo "Server token".$request."END of Server token";
         //return response()->json($request);
            //////////// Get payload and decoded
                // $payload=base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $request->payload)[1])));
                // $json_data = json_decode($payload);
                // $msisdn=$json_data->msisdn;
                // $userId=$json_data->userId;
                // $subscriptionId=$json_data->subscriptionId;
                // $userId=$json_data->userId;
            //////////// End Get payload and decoded
                if(substr($request->msisdn, 0, 7)=='2499123')
                    return response()->json(['subscriptionId'=>$request->subscriptionId,'msg'=>'Successful Subscribed','status'=>'SUBSCRIBED','msisdn'=>$request->msisdn]);
                else{
                return response()->json(['subscriptionId'=>$request->subscriptionId,'msg'=>'Invalid MSISDN','status'=>'FAILED','msisdn'=>$request->msisdn]);
                }

                
            }
}
