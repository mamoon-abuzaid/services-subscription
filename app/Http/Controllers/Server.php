<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Validator;

class Server extends Controller
{
    public function validateSubRequest(Request $request){  
//dd($request->payload);
       // $payload = JWTAuth::decode($request->payload);
       //$payload = sub_req($request->sub_req);

        $payload=base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $request->payload)[1])));
        //$data = json_decode(explode('.', $request->payload)[1]);
        //$payload = base64_decode($tokenParts[1]);
        //$name = $request->msisdn;
        //print ($data);
        $json_data = json_decode($payload);
        $msisdn=$json_data->msisdn;
        $userId=$json_data->userId;
        $subscriptionId=$json_data->subscriptionId;
        $userId=$json_data->userId;
        
        return $payload;
        
    }
}
