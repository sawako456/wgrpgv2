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
    'as' => 'dashboard',
    'uses' => 'DashboardController@getDashboard',
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

    Route::get('register', [
        'as' => 'auth.register',
        'uses' => 'AuthController@getRegistration',
    ]);

    Route::post('register', [
        'as' => 'auth.register.do',
        'uses' => 'AuthController@postRegistration',
    ]);
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', [
        'as' => 'admin.dashboard',
        'uses' => 'DashboardController@getDashboard',
    ]);

    Route::group(['prefix' => 'profile'], function () {
        Route::get('edit', [
            'as' => 'admin.profile.edit',
            'uses' => 'ProfileController@edit',
        ]);

        Route::put('/', [
            'as' => 'admin.profile.update',
            'uses' => 'ProfileController@update',
        ]);
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [
            'as' => 'admin.users',
            'uses' => 'UserController@index',
        ]);

        Route::get('create', [
            'as' => 'admin.users.create',
            'uses' => 'UserController@create',
        ]);

        Route::post('/', [
            'as' => 'admin.users.store',
            'uses' => 'UserController@store',
        ]);

        Route::get('{id}', [
            'as' => 'admin.users.show',
            'uses' => 'UserController@show',
        ]);

        Route::get('{id}/edit', [
            'as' => 'admin.users.edit',
            'uses' => 'UserController@edit',
        ]);

        Route::put('{id}', [
            'as' => 'admin.users.update',
            'uses' => 'UserController@update',
        ]);

        Route::put('{id}/restore', [
            'as' => 'admin.users.restore',
            'uses' => 'UserController@restore',
        ]);

        Route::delete('{id}', [
            'as' => 'admin.users.destroy',
            'uses' => 'UserController@destroy',
        ]);
    });
});
