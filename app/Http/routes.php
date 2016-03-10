<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('user/{user}', 'UserController@showProfile');
Route::get('patients/{user}', 'UserController@showPatients');
Route::get('devices/{user}', 'UserController@showDevices');
Route::get('weights/{user}', 'UserController@showWeights');
Route::get('schedule/{user}', 'UserController@showSchedule');

/**
 * The Login Route for the API
 */
Route::post('/api/login', 'UserController@apiLogin');


/*
	Dit zijn de login paths van de website
*/
Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});


/*
	Dit zijn de ios login routes.
	gebaseerd op volgende tutorial: https://gistlog.co/JacobBennett/090369fbab0b31130b51 
*/
Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/short', 'UrlMapperController@store');
		Route::post('/api/user', function(\Illuminate\Http\Request $request) {
			// dd($request->all());
			return App\User::where('api_token','=',$request->api_token)->get();

		});
});