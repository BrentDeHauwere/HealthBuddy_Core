<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('user/{user}', 'UserController@showProfile');
