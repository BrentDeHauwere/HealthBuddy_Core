<?php

/**
 * The default, reachable, homepage.
 * From where a user can login.
 */
Route::get('/', function () {
    return view('welkom');
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
    Route::get('/', function () {
        return view('welkom');
    });
    Route::get('/home', 'HomeController@index');

    Route::post('/addmodal','ModalController@add');
    Route::post('/editmodal','ModalController@edit');
    Route::post('/resetmodal','ModalController@reset');
    Route::post('/linkmodal','ModalController@link');

    Route::post('user/add','UserController@addUser');
    Route::get('user/{user}', 'UserController@showProfile');
    Route::get('patients/{user}', 'UserController@showPatients');
    Route::get('devices/{user}', 'UserController@showDevices');
    Route::get('weights/{user}', 'UserController@showWeights');
    Route::get('schedule/{user}', 'UserController@showSchedule');

    Route::get('apparaatbeheer/show', 'DeviceController@index');
    Route::get('apparaatbeheer/add', 'DeviceController@create');
    Route::post('apparaatbeheer/add', 'DeviceController@store');
    Route::delete('apparaatbeheer/{device}', 'DeviceController@destroy');
});


/**
 * These are the routes one can get to after logging in through the api and receiving an api_token.
 * Gebaseerd op volgende tutorial: https://gistlog.co/JacobBennett/090369fbab0b31130b51
*/
Route::group(['prefix' => 'api/', 'middleware' => 'auth:api'], function () {
    /*
    * TODO: find out who put this here, and ask why it is needed?
    * eddi thinks it's not needed.
    */
    // Route::post('/short', 'UrlMapperController@store');

    // Routes to get/query records
    Route::post('profile', 'ApiController@showProfile');
    Route::post('address/{user_id}', 'ApiController@showAddress');
    Route::post('patients', 'ApiController@showPatients');
    Route::post('patient/{patient_id}', 'ApiController@showPatient');

    Route::post('weights/{patient_id}', 'ApiController@showWeights');
    Route::post('lastWeight/{patient_id}', 'ApiController@showLastWeight');
    
    Route::post('medicalinfo/{patient_id}', 'ApiController@showMedicalInfo');
    Route::post('medicines/{patient_id}', 'ApiController@showMedicines');
    Route::post('schedule/{patient_id}', 'ApiController@showSchedule');


    // Routes to update records
    Route::post('user/{user_id}/update', 'ApiController@updateUser');
    Route::post('address/{address_id}', 'ApiController@updateAddress');


    // Routes to create records
    Route::post('weight/{patient_id}/create', 'ApiController@createWeight');

    // -update user
    // -update medische gegevens
    // -update address --> progress
});
