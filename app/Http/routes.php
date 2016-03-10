<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('user/{user}', 'UserController@showProfile');
Route::get('patients/{user}', 'UserController@showPatients');
Route::get('devices/{user}', 'UserController@showDevices');
Route::get('weights/{user}', 'UserController@showWeights');
Route::get('schedule/{user}', 'UserController@showSchedule');

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
