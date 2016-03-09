<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', 'UserController@login');
