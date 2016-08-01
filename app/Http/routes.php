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
Route::group(['middleware' => 'web'], function() {
    Route::get('/' , ['as' =>'home', 'uses' => 'HomeController@index']);
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
    Route::get('login/{social}', ['as' => 'login.{social}', 'uses' => 'SocialAccountController@redirectToProvider']);
    Route::get('login/{social}/callback', ['as' => 'login.{social}.callback', 'uses' => 'SocialAccountController@handleProviderCallback']);
});

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function() {
    Route::get('index',[
        'as' => 'admin',
        'uses' => 'Admin\AdminController@index',
    ]);

    Route::put('{id}', [
        'as' => 'admin.update',
        'uses' => 'Admin\AdminController@update',
    ]);
    Route::get('{id}/profile/', [
        'as' => 'admin.profile',
        'uses' => 'Admin\AdminController@profile',
    ]);

    Route::resource('users', 'Admin\UserController');

});

