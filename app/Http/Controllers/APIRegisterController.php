<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use JWTAuth;
use JWTFactory;
use Validator;
use Response;


class APIRegisterController extends Controller
{
    public function register (Request $request){


        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'age' => $request->get('age'),
        ]);
        $user = User::first();
        $token = JWTAuth::fromUser($user);
    
    return Response::json(compact('token'));

    }
}
