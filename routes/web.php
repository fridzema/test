<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'FrontendController@index');
    Route::get('photo/{photoId}', 'FrontendController@show')->name('photo.show');
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Auth::routes();

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'AdminController@index');
        Route::post('photos/reorder', 'AdminController@reorder');

        Route::resource('photos', 'PhotosController');
    });
});

