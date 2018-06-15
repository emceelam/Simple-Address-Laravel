<?php

use Illuminate\Http\Request;
#use App\Http\Controllers\AddressController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('addresses', 'AddressController@index');
Route::get('addresses/{address}', 'AddressController@show');
Route::post('addresses', 'AddressController@store');
Route::put('addresses/{address}', 'AddressController@update');
Route::delete('addresses/{address}', 'AddressController@delete');
Route::get('addresses/{address}/geocode', 'AddressController@geocode');

