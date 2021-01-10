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

//Route::get('/user/subscribe','User@subscribe');
Route::get('/user/subscribe','UserSubscribe@subscribe');
Route::get('/user/unsubscribe','UserUnSubscribe@unsubscribe');

//Route::get('/user/subscribe','StudentApiController@create');

// Route::get('/user/unsubscribe', function (Request $request) {
//     dd("route 3");
// });
//////////////////////// Server APIs 
//Route::get('/server/subscribe', 'Server@validateSubRequest');
Route::get('/server/subscribe', 'ServerSubscribe@validateSubRequest');
Route::get('/server/unsubscribe', 'ServerUnSubscribe@validateUnSubRequest');
// //Route::get('/server/unsubscribe', function (Request $request) {
//     dd("4");



//     return $request->user();
// });
