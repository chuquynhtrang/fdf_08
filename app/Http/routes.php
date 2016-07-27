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

Route::get('/' , ['as' =>'home', 'uses' => 'HomeController@index']);
Route::group(['middleware' => 'web'], function() {
    Route::post('login', [
            'as' => 'login',
            'uses' => 'UserController@login'
        ]);
    Route::post('register', [
        'as' => 'register',
        'uses' => 'UserController@register'
    ]);
    Route::get('logout', [
        'as' => 'logout',
        'uses' =>'UserController@logout'
    ]);
});
