<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServerUnSubscribe extends Controller
{
    //
    public function validateUnSubRequest(Request $request){  
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
            //echo "ZZZOZOZOZOZOZO".$request->idd;
            if(substr($request->msisdn, 0, 7)=='2499123')
            return response()->json(['subscriptionId'=>$request->subscriptionId,'msg'=>'Successful Unsubscribed','status'=>'UNSUBSCRIBED','msisdn'=>$request->msisdn]);
        else
        return response()->json(['subscriptionId'=>$request->subscriptionId,'msg'=>'Invalid MSISDN','status'=>'FAILED','msisdn'=>$request->msisdn]);



    //    return $payload;
   // print_r($payload);
                
            }
}
