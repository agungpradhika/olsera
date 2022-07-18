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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/v1/items/create', 'api\v1\ItemsController@create');
Route::post('/v1/items/update', 'api\v1\ItemsController@update');
Route::delete('/v1/items/{id?}', 'api\v1\ItemsController@destroy');

Route::post('/v1/pajaks/create', 'api\v1\PajaksController@create');
Route::post('/v1/pajaks/update', 'api\v1\PajaksController@update');
Route::delete('/v1/pajaks/{id?}', 'api\v1\PajaksController@destroy');

Route::get('/v1/all', 'api\v1\AllController@index');

