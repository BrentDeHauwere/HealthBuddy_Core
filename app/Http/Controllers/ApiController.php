<?php

namespace App\Http\Controllers;

use App\MedicalInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests;

use Auth;
use Hash;

use \App\User;
use \App\Address;
use \App\Medicine;
use \App\Weight;
use \App\Schedule;

// use App\Http\Requests\Request;
use App\Http\Requests\UpdateUserApiRequest;
use App\Http\Requests\UpdateAddressApiRequest;

/**
 *This is the Controller that handles all API requests,
 * @author eddi
 */
class ApiController extends Controller
{
  /**
  *   This function returns the budddy and his info + the buddy's patients and their info.
  * The address and patients are retrieved seperately since we need maximum flexibility.
  *   @author eddi
  */
  public function showBuddyProfile()
  {
      // retrieve the buddy
    $auth_user = User::find($this->getAuthenticatedUser()->id);

      // retrieve the buddy's address
    $address = Address::where('id', '=' ,$auth_user->address_id)->first();
      // retrieve the buddy's patients and their infos
    $patients_db = User::where('buddy_id', '=' ,$auth_user->id)
    ->with('medicalinfo')->get();

      // now add the medicines and schedules to the patients
    foreach ($patients_db as $patient) {
      $patient->patients = null;
      $patient->medicines = Medicine::with('schedule')->get();
    }

      // append the patients to the buddy-object
    $auth_user->address = $address;
    $auth_user->patients = $patients_db;
    $auth_user->medicalinfo = null;
    $auth_user->medicines = null;
      // $auth_user->weight = null;

      // return the buddy
    return $auth_user;
  }

  /**
   * This function retrieves the address of a user.
   * If that user is either the buddy OR a patient of the buddy. 
   * @param $user_id
   * @author eddi
   */
  public function showAddress($user_id)
  {
    $auth_user = $this->getAuthenticatedUser();
    // check if the $user_id belongs to the buddy
    if( $auth_user->id == $user_id) {
      return $auth_user->address;
    }
    // check if the $user_id belongs to the buddy's patients
    elseif ($this->isPatient($user_id)) {
      $address = User::where('id', '=', $user_id)->first()->address;
      return $address;   
    }
    return response('Wrong id provided.', 403);
  }


  /**
  * This function retrieves a buddy's patients.
  * @author eddi
  */
  public function showPatients()
  {
    $auth_user = $this->getAuthenticatedUser();

    // retrieve the buddy's patients and their medicalinfo.
    $patients_db = User::where('buddy_id', '=' ,$auth_user->id)
    ->with('medicalinfo', 'address')->get();

      // now add the medicines and schedules to the patients
    foreach ($patients_db as $patient) {
      $patient->patients = null;
      $patient->medicines = Medicine::with('schedule')->get();
    }
    return $patients_db;
  }

  /**
   * This function returns a patient given a correct id and if the patient is a 
   *  patient of the buddy. 
   * @param $patient_id
   * @return mixed
  * @author eddi
   */
  public function showPatient($patient_id)
  {
    if($this->isPatient($patient_id)) {
      $patient = User::with('address', 'medicalinfo')->where('id', '=', $patient_id)->first();
      $patient->medicines = Medicine::with('schedule')->get();
      $patient->patients = null;
      return $patient;
    }
    return response('Wrong Patient_id provided.', 403);
  }

  /**
  * This function retrieves a patients medicines.
  * @author eddi
  */
  public function showMedicines ($patient_id){
    if($this->isPatient($patient_id)) {
      $schedule = Medicine::with('schedule')->where('user_id', '=', $patient_id)->get();
      return $schedule;
    }
    return response('Wrong Patient_id provided.', 403);
  }

  /**
    * This function retrieves a patients schedule, when to take his medicines.
    * @author eddi
    */
  public function showSchedule($patient_id){
        // send the requested patient info
    if($this->isPatient($patient_id)) {
      return Medicine::with('schedule')->where('user_id', '=', $patient_id)->get();
    }
    return response('Wrong Patient_id provided.', 403);
  }

  /**
      * This function retrieves a patients medicalInfo.
      * @author eddi
      */
  public function showMedicalInfo($patient_id){
          // send the requested patient info
    if($this->isPatient($patient_id)) {
      return MedicalInfo::where('user_id', '=', $patient_id)->first();
    }
    return response('Wrong Patient_id provided.', 403);
  }


  public function showWeights($patient_id)
  {
    if($this->isPatient($patient_id)) {
      return Weight::where('user_id', '=', $patient_id)->get();
    }
    return response('Wrong Patient_id provided.', 403);
  }

  public function showLastWeight($patient_id)
  {
    if($this->isPatient($patient_id)) {
      return Weight::where('user_id', '=', $patient_id)->orderBy('created_at', 'desc')->first();
    }
    return response('Wrong Patient_id provided.', 403);
  }



  /**
   * These functions are for updating data in the db.
   */

  /**
   * This function is for updateing a users info.
   * @param $request
   * @param $user_id
   * @return mixed
   * @author eddi
   */
  public function updateUser(UpdateUserApiRequest $request, $user_id)
  {
    // get the user that send the request.
    $auth_user = $this->getAuthenticatedUser();
    // find the user to be changed.
    $user = User::find($user_id);

    // check if the request wants to change the buddy_id
    if(isset($request->buddy_id) 
      && !empty($request->buddy_id)
      && $request->buddy_id != $user->buddy_id)
    {
      return response('Not allowed to change the buddy of a patient.', 403);
    }

    // check if the request wants to change the email of the buddy
    if($user_id == $auth_user->id
      && isset($request->email) 
      && !empty($request->email)
      && $request->email != $user->email)
    {
      return response('Not allowed to change the buddy email.', 403);
    }

    if($this->isPatient($user_id) || $auth_user->id == $user_id)
    {
      // automatically fill the user with the received info (after the validation).
      $user->fill($request->all());

      // save the updated user to the db.
      // return ($user->save())?"User updated":"User not updated";
      return "UpdateUser:: Cannot auto fill user -> api_token overwritten, hardcode :/";
    }
    return response('Wrong id provided.', 403);
  }

  /**
   * This function is for updateing a users address info, only if the address
   * belongs to the buddy
   * or one of it's patients.
   *
   * @param $request
   * @param $address_id
   * @return mixed
   * @author eddi
   */
  public function updateAddress(UpdateAddressApiRequest $request, $address_id)
  {
    // Address fielsd: id  street  streetNumber  bus   zipCode   city  country
    $address = Address::find($address_id);
    

    // automatically fill the user with the received info (after the validation).
    $address->fill($request->all());

    // return $address;
    echo $address;
      // save the updated user to the db.
   // return ($address->save())?"Address updated":"Address not updated";
    return "UpdateUser:: Cannot auto fill user -> api_token overwritten, hardcode :/";
  }




  /*
   * These functions are for creating records in the database
   */


  /**
   * This function adds a new weight to the patients records.
   * @author eddi 
   */
  public function createWeight($patient_id)
  {
    if($this->isPatient($patient_id))
    {
      return 'createWeight:: NotImplemented';
    }
    return response('Wrong id provided.', 403);
  }




  /**
   *  The login function for the API
   *
   *   @param Request $request
   *   @return api_token
   *   @author eddi
   */
  public function apiLogin(Request $request) {
    try{
      // find the user in the database.
      $user = User::where('email','=',$request->email)->firstOrFail();

      if(Hash::check($request->password, $user->password)){
              // on each login, regenerate the api_token.
        $user->api_token = str_random(60);
        $user->save();

              // return the api_token.
        $api_token = $user->api_token; 
        return response()->json(array('api_token' => $api_token));
      }
      else{
        throw new ModelNotFoundException('Wrong password');
      }

    }catch(ModelNotFoundException $ex){
      return response($ex->getMessage(), 401);
    }
  }

  // TODO: These functions should get their own file
  /**
   * This is a function to check if an id corresponds to an id of the authenticated user's patients.
   *
   * @param $patient_id
   * @return bool returns true if the given ID corresponds to a patient of the authenticated user.
   * @author eddi
   */
  function isPatient($patient_id)
  {
    $user = $this->getAuthenticatedUser();
    foreach ($user->patients as $patient) {
      if($patient->id == $patient_id)
      {
        return true;
      }
    }
    return false;
  }

  /**
   * This function checks if a given address belongs to a patient of the buddy, or logged in user.
   * 
   * @param $address_id
   * @return bool returns true if the given ID corresponds to an addres of a patient of the authenticated user.
   * @author eddi
   */
  function isAddressOfPatient($address_id)
  {
    // the boolean that will be returned.
    $isAddressOfPatient = false;
    // fetch all users with the give address_id.
    $users_with_address = User::where('address_id', '=', $address_id)->get();

    // to be allowed to change the address, only 1 user can have it. 
    if(sizeof($users_with_address) == 1)
    {
      // check if the user with that address is a patient or the buddy.
      if($this->isPatient($users_with_address->first()->id) )
      {
        $isAddressOfPatient = true;
      }  
    }
    return $isAddressOfPatient;
  }

  /**
   * This is a function to get the authenticated user,
   * in both the web and api cases.
   * @return mixed
   */
  function getAuthenticatedUser()
  {
      // get the web-user
    $user = Auth::guard()->user();

      // get the api-user
    if(!isset($user) && $user == null) {
      $user = Auth::guard('api')->user();
    }
    return $user;
  }

}
