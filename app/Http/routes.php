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

    Route::get('products/{id}', [
        'as' => 'products.show',
        'uses' => 'ProductController@show',
    ]);

    Route::get('add-to-cart/{id}', [
        'as' => 'products.addToCart',
        'uses' => 'ProductController@getAddToCart',
    ]);

    Route::get('get-cart', [
        'as' => 'products.getCart',
        'uses' => 'ProductController@getCart',
    ]);

    Route::put('update-cart/{rowId}', [
        'as' => 'products.updateCart',
        'uses' => 'ProductController@updateCart',
    ]);

    Route::get('delete/{rowId}', [
        'as' => 'deleteItem',
        'uses' => 'ProductController@deleteItem',
    ]);

    Route::get('deleteAllCart', [
        'as' => 'deleteAllCart',
        'uses' => 'ProductController@deleteAllCart',
    ]);

    Route::get('checkout', [
        'as' => 'checkout',
        'uses' => 'ProductController@checkout',
    ]);

    Route::put('updateAddress', [
        'as' => 'updateAddress',
        'uses' => 'UserController@updateAddress',
    ]);

    Route::get('order', [
        'as' => 'order',
        'uses' => 'OrderController@store',
    ]);

    Route::post('products/{id}/comment', [
        'as' => 'comment',
        'uses' => 'ProductController@getComments',
    ]);

    Route::resource('users', 'SuggestController', [
        'only' => [
            'create',
            'update',
            'store',
        ],
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

    Route::resource('users', 'UserController', ['except' => 'destroy']);

    Route::resource('products', 'ProductController', ['except' => 'destroy']);

    Route::resource('categories', 'CategoryController', ['except' => 'destroy']);

    Route::post('users/destroy', [
        'as' => 'users.destroy',
        'uses' => 'UserController@destroy'
    ]);

    Route::post('categories/destroy', [
        'as' => 'categories.destroy',
        'uses' => 'CategoryController@destroy'
    ]);

    Route::post('products/destroy', [
        'as' => 'products.destroy',
        'uses' => 'ProductController@destroy'
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

