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

Route::post('/api/login', 'ApiController@apiLogin');

/**
 * The Login Route for the API.
 * After successfully authenticating the server responds with an api_token.
 */

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
    Route::post('/buddymodal','ModalController@linkBuddy');
    Route::post('/doktermodal','ModalController@linkDokter');
    Route::post('user/add','UserController@addUser');
    Route::post('user/addAddress','UserController@addUserAddress');
    Route::post('user/editUser','UserController@editUser');
    Route::post('user/editAddress','UserController@editAddress');
    Route::post('user/link','UserController@linkDevice');
    Route::post('user/linkBuddy','UserController@linkBuddy');
    Route::post('user/reset','UserController@reset');
    Route::post('user/unlink','UserController@unlink');
    Route::post('user/unlinkDokter','UserController@unlinkDokter');
    Route::post('user/delete','UserController@delete');

    Route::get('user/{user}', 'UserController@showProfile');
    Route::get('patients/{user}', 'UserController@showPatients');
    Route::get('devices/{user}', 'UserController@showDevices');
    Route::get('weights/{user}', 'UserController@showWeights');
    Route::get('latestWeight', function () { // TESTING PURPOSES: TO DELETE
        return \App\User::with('latestWeight')->get();
    });
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
    // Routes to get records
    Route::post('profile', 'ApiController@showProfile');

    Route::post('user/{user_id}/address', 'ApiController@showAddress');
    Route::post('patients', 'ApiController@showPatients');
    Route::post('patient/{patient_id}/show', 'ApiController@showPatient');
    Route::post('user/{patient_id}/medicalinfo', 'ApiController@showMedicalInfo');
    Route::post('user/{patient_id}/medicines', 'ApiController@showMedicines');
    Route::post('user/{patient_id}/medicine/{medicine_id}/show', 'ApiController@showMedicine');
    Route::post('user/{patient_id}/medicine/{medicine_id}/photo', 'ApiController@showMedicinePhoto');
    Route::post('user/{patient_id}/schedule', 'ApiController@showSchedule');
    Route::post('user/{patient_id}/schedule/today', 'ApiController@showTodaysSchedule');
    Route::post('user/{patient_id}/weights', 'ApiController@showWeights');
    Route::post('user/{patient_id}/lastWeight', 'ApiController@showLastWeight');

    // Routes to update records
    Route::post('user/{user_id}/update', 'ApiController@updateUser');
    Route::post('user/{user_id}/address/update', 'ApiController@updateAddress');
    Route::post('user/{user_id}/medicalinfo/update', 'ApiController@updateMedicalInfo');
    Route::post('user/{user_id}/schedule/{schedule_id}/update', 'ApiController@updateSchedule');
    Route::post('user/{user_id}/medicine/{medicine_id}/update', 'ApiController@updateMedicine');
    // update medicine

    // Routes to create records
    Route::post('user/{user_id}/medicine/create', 'ApiController@createMedicine');
    Route::post('user/{user_id}/schedule/create', 'ApiController@createSchedule');
    Route::post('user/{user_id}/weight/create', 'ApiController@createWeight');

    // routes to delete records
    Route::post('user/{user_id}/schedule/{schedule_id}/delete', 'ApiController@deleteSchedule');
    Route::post('user/{user_id}/medicine/{medicine_id}/delete', 'ApiController@deleteMedicine');
    Route::post('user/{patient_id}/medicine/{medicine_id}/photo/delete', 'ApiController@deleteMedicinePhoto');


    // Routes for intakes :
    // --------------------
    // show all
    // show last week
    // show last month
    // show for medicine_id
    // 
    // create
    //
    // delete?
    // update?


    // Routes for schedules :
    // ----------------------
    // schedules today
    // schedules die gebruik maakt van om de X dagen

});

