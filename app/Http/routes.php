<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::get('/', function () {
        return redirect()->route('installs.index');
    });

    Route::get('installs', ['as' => 'installs.index', 'uses' => 'InstallsController@index']);
    Route::get('installs/{id}', ['as' => 'installs.view', 'uses' => 'InstallsController@view']);

    // Authentication Routes
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@showLoginForm']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);
    Route::get('login/google', ['as' => 'login.google', 'uses' => 'Auth\AuthController@redirectToProvider']);
    Route::get('login/google/callback', ['as' => 'login.google.callback', 'uses' => 'Auth\AuthController@handleProviderCallback']);
});