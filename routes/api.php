<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainRoomController;
use App\Http\Controllers\LogController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::post('/main-rooms', [MainRoomController::class,'store']);
    Route::post('/customers', [CustomerController::class,'store']);
    Route::get('/customer/{id}', [CustomerController::class,'show']);


Route::post('/room-update/{id}', [MainRoomController::class,'update']);

Route::post('/updateLog/{id}', [LogController::class,'updateVerificationStatus']);
Route::get('/showLog/{id}', [LogController::class,'show']);
















//// MainRooms routes
//Route::resource('main-rooms', MainRoomController::class);
//
//// Logs routes
////Route::resource('logs', LogController::class);
//Route::put('main-rooms/{mainRoom}/logs/{log}/accept', [MainRoomController::class, 'acceptLog']);
//Route::get('logs/unverified', [LogController::class, 'getUnverifiedLogs']);
//Route::put('logs/{log}/verification', [LogController::class, 'updateVerificationStatus']);
//
//// Customer routes
//Route::get('/customers', 'CustomerController@index');
//Route::get('/customers/{customer}', 'CustomerController@show');
//
////Route::post('/create_subdomain', [MyRentoorController::class, 'createSubdomain']);
//
//
//Route::put('/customers/{customer}', 'CustomerController@update');
//Route::delete('/customers/{customer}', 'CustomerController@destroy');
//
//
//
//
////// MainRoom routes
////Route::get('/main-rooms', 'MainRoomController@index');
////Route::get('/main-rooms/{mainRoom}', 'MainRoomController@show');
////
////
////
////Route::delete('/main-rooms/{mainRoom}', 'MainRoomController@destroy');
//
//// SupportInteraction routes
//Route::get('/support-interactions', 'SupportInteractionController@index');
//Route::get('/support-interactions/{supportInteraction}', 'SupportInteractionController@show');
//Route::post('/support-interactions', 'SupportInteractionController@store');
//Route::put('/support-interactions/{supportInteraction}', 'SupportInteractionController@update');
//Route::delete('/support-interactions/{supportInteraction}', 'SupportInteractionController@destroy');
//
//// Log routes
//Route::get('/logs', 'LogController@index');
//Route::get('/logs/{log}', 'LogController@show');
//Route::post('/logs', 'LogController@store');
//Route::put('/logs/{log}', 'LogController@update');
//Route::delete('/logs/{log}', 'LogController@destroy');
