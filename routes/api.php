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

Route::middleware('web', 'throttle:60,1')->group(function () {
  Route::resource('photos', 'PhotosController');
  Route::post('search/photos', 'PhotosController@search');
});
