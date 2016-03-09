<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('user/{user}', 'UserController@showProfile');
Route::get('patients/{user}', 'UserController@showPatients');
