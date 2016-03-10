<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('user/{user}', 'UserController@showProfile');
Route::get('patients/{user}', 'UserController@showPatients');
Route::get('devices/{user}', 'UserController@showDevices');
Route::get('weights/{user}', 'UserController@showWeights');
Route::get('schedule/{user}', 'UserController@showSchedule');

/*
	De open route om de api te laten inloggen 
*/
Route::get('/api/login', function (\Illuminate\Http\Request $request) {
    // hier komt validatie -> steek deze in de controller later op een andere plaats

    // check if user en pass are ok
    // generate new token in db
    // send token back

    // App\User::find();
    // dump && die
    // dd($request->all());
    /*return response()->json([
        'api_token' => App\User::find()->api_token
    ]);
    */
    // return App\User::where('email', '=', $request->email)->first()->api_token;
    return 'logged in';
});
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
		Route::get('/api/user', function(\Illuminate\Http\Request $request) {
			// dd($request->all());
			return App\User::where('api_token','=',$request->api_token)->get();

		});
});