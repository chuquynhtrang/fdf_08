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
    Route::get('language/{lang}', ['as' => 'lang', 'uses' => 'HomeController@changeLanguage']);

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

    Route::get('login/{social}', [
        'as' => 'login.{social}', 
        'uses' => 'SocialAccountController@redirectToProvider'
    ]);

    Route::get('login/{social}/callback', [
        'as' => 'login.{social}.callback', 
        'uses' => 'SocialAccountController@handleProviderCallback'
    ]);
});

Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::get('/',[
        'as' => 'admin',
        'uses' => 'AdminController@index',
    ]);

    Route::put('{id}', [
        'as' => 'admin.update',
        'uses' => 'AdminController@update',
    ]);

    Route::get('{id}/profile/', [
        'as' => 'admin.profile',
        'uses' => 'AdminController@profile',
    ]);

    Route::resource('users', 'UserController');

    Route::resource('products', 'ProductController');

    Route::resource('categories', 'CategoryController', ['except' => 'destroy']);

    Route::post('categories/destroy', [
        'as' => 'categories.destroy', 
        'uses' => 'CategoryController@destroy'
    ]);

    Route::post('categories/importExcel', [
        'as' => 'categories.importExcel', 
        'uses' => 'CategoryController@importExcel'
    ]);

    Route::get('categories/downloadExcel/{type}', [
        'as' => 'categories.downloadExcel', 
        'uses' => 'CategoryController@downloadExcel'
    ]);
});

