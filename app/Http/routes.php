<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'as' => 'index',
    'uses' => 'WorldController@index',
]);

Route::group(['prefix' => 'auth'], function () {
    Route::get('login', [
        'as' => 'auth.login',
        'uses' => 'AuthController@getLogin',
    ]);

    Route::post('login', [
        'as' => 'auth.login.do',
        'uses' => 'AuthController@postLogin',
    ]);

    Route::get('logout', [
        'as' => 'auth.logout',
        'uses' => 'AuthController@getLogout',
    ]);
});
