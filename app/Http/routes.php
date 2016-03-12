<?php

/**
 * The default, reachable, homepage.
 * From where a user can login.
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * The Login Route for the API.
 * After successfully authenticating the server responds with an api_token.
 */
Route::post('/api/login', 'UserController@apiLogin');


/**
 * These are the routes one can visit after logging in on the website
 */
Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/home', 'HomeController@index');

    Route::get('user/{user}', 'UserController@showProfile');
    Route::get('patients/{user}', 'UserController@showPatients');
    Route::get('devices/{user}', 'UserController@showDevices');
    Route::get('weights/{user}', 'UserController@showWeights');
    Route::get('schedule/{user}', 'UserController@showSchedule');
});


/**
 * These are the routes one can get to after logging in through the api and gettint an api_token.
 * gebaseerd op volgende tutorial: https://gistlog.co/JacobBennett/090369fbab0b31130b51
 *
*/
Route::group(['prefix' => 'api/', 'middleware' => 'auth:api'], function () {
    Route::post('/short', 'UrlMapperController@store');

    Route::get('user/{user}', 'UserController@showProfile');
    Route::get('patients/{user}', 'UserController@showPatients');
    Route::get('devices/{user}', 'UserController@showDevices');
    Route::get('weights/{user}', 'UserController@showWeights');
    Route::get('schedule/{user}', 'UserController@showSchedule');
});