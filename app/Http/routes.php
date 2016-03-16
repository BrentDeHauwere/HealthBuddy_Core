<?php

/**
 * The default, reachable, homepage.
 * From where a user can login.
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * A Route to goto the login page,
 * used to redirect certain requests directly to the login page
 */
Route::get('/login', function () {
    return view('auth');
});

/**
 * The Login Route for the API.
 * After successfully authenticating the server responds with an api_token.
 */
Route::post('/api/login', 'ApiController@apiLogin');



/**
 * These are the routes one can visit after logging in on the website
 */
Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/home', 'HomeController@index');

<<<<<<< HEAD
    Route::post('/addmodal','ModalController@add');
    Route::post('/editmodal','ModalController@edit');
    Route::post('/resetmodal','ModalController@reset');
    Route::post('/linkmodal','ModalController@link');
=======
    Route::get('user/{user}', 'UserController@showProfile');
    Route::get('patients/{user}', 'UserController@showPatients');
    Route::get('devices/{user}', 'UserController@showDevices');
    Route::get('weights/{user}', 'UserController@showWeights');
    Route::get('schedule/{user}', 'UserController@showSchedule');
>>>>>>> master
});


/**
 * These are the routes one can get to after logging in through the api and gettint an api_token.
 * gebaseerd op volgende tutorial: https://gistlog.co/JacobBennett/090369fbab0b31130b51
 *
*/
Route::group(['prefix' => 'api/', 'middleware' => 'auth:api'], function () {
    Route::post('/short', 'UrlMapperController@store');

    // Routes to get/query records
    Route::post('profile', 'ApiController@showProfile');
    Route::post('patients', 'ApiController@showPatients');
    Route::post('patient/{patient_id}', 'ApiController@showPatient');
    Route::post('weights/{patient_id}', 'ApiController@showWeights');
    Route::post('lastWeight/{patient_id}', 'ApiController@showLastWeight');
    Route::post('schedule/{patient_id}', 'ApiController@showSchedule');

    // Routes to update records
    Route::post('user/{user_id}/update', 'ApiController@updateUser');

    // Routes to create records
    Route::post('weight/{patient_id}/create', 'ApiController@createWeight');
});