<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//////////////////////// User APIs 
Route::get('/user/subscribe','UserSubscribe@subscribe');
Route::get('/user/unsubscribe','UserUnSubscribe@unsubscribe');

//////////////////////// Server APIs 
Route::get('/server/subscribe', 'ServerSubscribe@validateSubRequest');
Route::get('/server/unsubscribe', 'ServerUnSubscribe@validateUnSubRequest');
