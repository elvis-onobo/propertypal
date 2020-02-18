<?php

use Illuminate\Http\Request;

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

// add state
Route::post('state', 'ApiController@state');

// add evaluation
Route::post('evaluation', 'ApiController@evaluation');

// add state
Route::post('category', 'ApiController@category');

// add availability
Route::post('availability', 'ApiController@availability');