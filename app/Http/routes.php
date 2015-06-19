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

Route::group(['prefix' => '/api/v1'], function () {


    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
    header('Access-Control-Allow-Credentials: true');

    // gets the ranking for the current week
    Route::get('rankings', ['as' => 'rankings', 'uses' => 'CelebrityController@getRankings']);

    // Case a Vote to the celebrity
    Route::post('vote', ['as' => 'post.vote', 'uses' => 'VoteController@store']);

    Route::controllers([
        'auth'     => 'AuthController',
        'password' => 'PasswordController'
    ]);

    Route::post('register', 'AuthController@create');

    // returns 2 choice of celebrity to vote
    Route::get('/', ['as' => 'home', 'uses' => 'CelebrityController@index']);



});

Route::group(['namespace' => 'Admin', 'prefix' => '/api/v1/admin', 'middleware' => ['auth']], function () {

    // Controller to Add celebrity
    Route::resource('celebrity', 'CelebrityController', ['only' => ['store']]);

    Route::get('/', ['as' => 'home', 'uses' => 'CelebrityController@index']);

});
