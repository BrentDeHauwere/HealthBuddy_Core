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
use App\Http\Requests\UpdateMedicalInfoApiRequest;
use App\Http\Requests\UpdateScheduleApiRequest;
use App\Http\Requests\UpdateMedicineApiRequest;
use App\Http\Requests\CreateScheduleApiRequest;
use App\Http\Requests\CreateMedicineApiRequest;


// api helper functions
use App\ApiHelper;

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
    $auth_user = User::find(ApiHelper::getAuthenticatedUser()->id);

      // retrieve the buddy's address
    $address = Address::where('id', '=' ,$auth_user->address_id)->first();
      // retrieve the buddy's patients and their infos
    $patients_db = User::where('buddy_id', '=' ,$auth_user->id)
    ->with('medicalinfo', 'address')->get();


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
    $auth_user = ApiHelper::getAuthenticatedUser();
    // check if the $user_id belongs to the buddy
    if( $auth_user->id == $user_id) {
      return $auth_user->address;
    }
    // check if the $user_id belongs to the buddy's patients
    elseif (ApiHelper::isPatient($user_id)) {
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
    $auth_user = ApiHelper::getAuthenticatedUser();

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
    if(ApiHelper::isPatient($patient_id)) {
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
    if(!ApiHelper::isPatient($patient_id)) {
      return response('Wrong Patient_id provided.', 403);
    }
    $medicine = Medicine::with('schedule')->where('user_id', '=', $patient_id)->get();
    return $medicine;
  }

  /**
  * This function retrieves a patients medicine.
  * @param 
  * @author eddi
  */
  public function showMedicine ($patient_id, $medicine_id)
  {
    // is this a buddy's patient? 
    if(!ApiHelper::isPatient($patient_id)) {
      return response('Wrong Patient_id provided.', 403);
    }
    // is this a medicine of the patient?
    if(!ApiHelper::isMedicineOfPatient($patient_id, $medicine_id))
    {
     return response('Wrong medicine_id provided.', 403); 
   }

    // fetch the medicine
   $medicine = Medicine::find($medicine_id);

   return $medicine;
 }

 public function showMedicinePhoto($patient_id, $medicine_id)
 {
    // is this a buddy's patient? 
  if(!ApiHelper::isPatient($patient_id)) {
    return response('Wrong Patient_id provided.', 403);
  }
    // is this a medicine of the patient?
  if(!ApiHelper::isMedicineOfPatient($patient_id, $medicine_id))
  {
   return response('Wrong medicine_id provided.', 403); 
 }

 $medicine = Medicine::find($medicine_id);

 if($medicine->photoUrl == null || empty($medicine->photoUrl))
 {
  return response("This medicine has no photo", 404);
}
$photo = "empty";
    // attach the photo if there is one.
if($medicine->photoUrl != null && file_exists($medicine->photoUrl))
{
  $photo = file_get_contents($medicine->photoUrl);
}
return $photo;
}

  /**
    * This function retrieves a patients schedule, when to take his medicines.
    * @author eddi
    */
  public function showSchedule($patient_id){
        // send the requested patient info
    if(ApiHelper::isPatient($patient_id)) {
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
    if(ApiHelper::isPatient($patient_id)) {
      return MedicalInfo::where('user_id', '=', $patient_id)->first();
    }
    return response('Wrong Patient_id provided.', 403);
  }


  public function showWeights($patient_id)
  {
    if(ApiHelper::isPatient($patient_id)) {
      return Weight::where('user_id', '=', $patient_id)->get();
    }
    return response('Wrong Patient_id provided.', 403);
  }

  public function showLastWeight($patient_id)
  {
    if(ApiHelper::isPatient($patient_id)) {
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
    $auth_user = ApiHelper::getAuthenticatedUser();
    // find the user to be changed.
    $user = User::find($user_id);

    // check if the request wants to change the buddy_id
    if(isset($request->buddy_id) 
      && !empty($request->buddy_id)
      && $request->buddy_id != $user->buddy_id)
    {
      return response('Not allowed to change the buddy itself.', 403);
    }

    // check if the request wants to change the email of the buddy
    if($user_id == $auth_user->id
      && isset($request->email) 
      && !empty($request->email)
      && $request->email != $user->email)
    {
      return response('Not allowed to change the buddy email.', 403);
    }

    if(ApiHelper::isPatient($user_id) || $auth_user->id == $user_id)
    {
      $fields = array('firstName', 'lastName', 'phone', 'gender', 'dateOfBirth', 'email');
      $user = ApiHelper::fillApiRequestFields($fields, $request, $user);
      
      // save the updated user to the db.
      return ($user->save())?$user:response("User not updated", 500);
    }
    return response('Wrong id provided.', 403);
  }

  /**
   * This function is for updating a users address info, only if the address
   * belongs to the buddy
   * or one of it's patients.
   *
   * @param $request
   * @param $user_id
   * @return mixed
   * @author eddi
   */
  public function updateAddress(UpdateAddressApiRequest $request, $user_id)
  {
    $patient = User::find($user_id);

    // retrieve the users address.
    $address = $patient->address;
    // these are the fields to be updated
    $fields = array('street', 'streetNumber', 'bus', 'zipCode', 'city', 'country');
    $address = ApiHelper::fillApiRequestFields($fields, $request, $address);
    
    // save the updated user to the db.
    return ($address->save())?$address:response("Address not updated", 500);
  }


  /**
   * This function is for updating a users medicalinfo, only if the medicalinfo
   * belongs to the buddy
   * or one of it's patients.
   *
   * @param $request
   * @param $user_id The id of the user for which the medicalinfo needs to be changed. Needed for validation.
   * @return mixed
   * @author eddi
   */
  public function updateMedicalInfo(UpdateMedicalInfoApiRequest $request, $user_id)
  {
    $patient = User::find($user_id);

    $medicalinfo = $patient->medicalinfo;
    // the updatable fields.
    $fields = array('length', 'weight', 'bloodType', 'medicalCondition', 'allergies');
    $medicalinfo = ApiHelper::fillApiRequestFields($fields, $request, $medicalinfo);    
    return ($medicalinfo->save())?$medicalinfo:response("MedicalInfo not updated", 500);
  }

  /**
   * This function is for updating a users medicalinfo, only if the medicalinfo
   * belongs to the buddy
   * or one of it's patients.
   *
   * @param $request The parameters of the schedule to be changed.
   * @param $user_id the id of the user to which the schedule belongs, this is needed to validate the request.
   * @param $schedule_id the id of the schedule to be changed.
   * @return mixed
   * @author eddi
   */
  public function updateSchedule(UpdateScheduleApiRequest $request, $user_id, $schedule_id)
  {
    $patient = User::find($user_id);   
    $schedule = Schedule::find($schedule_id);
    $fields = array('dayOfWeek','time','amount');
    $medicalinfo = ApiHelper::fillApiRequestFields($fields, $request, $Schedule);

    return ($schedule->save())?$schedule:response("Schedule not updated", 500);
  }

  /**
   * This function is for updating a medicine, only if the medicine
   * belongs to a patient of the buddy. If the name is changed the photo is deleted, to prevent wrong medication to be taken. 
   * Optionally a new photo can be provided, this will update the photo. 
   * It is recommended to use this function to update the photo alone.
   * @param $request The parameters of the medicine to be changed.
   * @param $user_id the id of the user to which the medicine belongs, this is needed to validate the request.
   * @param $medicine_id the id of the medicine to be changed.
   * @return mixed
   * @author eddi
   */
  public function updateMedicine(UpdateMedicineApiRequest $request, $user_id, $medicine_id)
  {
    $medicine = Medicine::find($medicine_id);
    $fullPath = null;

    // if the name of the medicine changed, the photo is no longer valid!
    if($request->name != $medicine->name)
    {
      if( file_exists($medicine->photoUrl))
      {
        unlink($medicine->photoUrl);
        $medicine->photoUrl = null;
      }
    }

    // update the fields from the medicine
    $fields = array('name','info');
    foreach ($fields as $f) {
      if(isset($request->$f) && !empty($request->$f))
      {
        $medicine->$f = $request->$f;
      }
    }

    // if there is a photo attached -> update it.
    if(isset($request->photo) && !empty($request->photo))
    {
      $path = 'userdata/user_'. $user_id . '/medicines/';
      // sanitize the filename given the name of the medication.
      $filename = ApiHelper::createValidFileName($request->name, $request->photo->guessClientExtension());
      $fullPath = $path.$filename;

      if($request->photo->move($path, 
        $filename) != $fullPath)
      {
        return response('Saving the picture failed', 500);
      }
      // add the photoUrl to the medicine
      $medicine->photoUrl = $fullPath;
    }
    return ($medicine->save() == 1)? $medicine:response('The medicine was not updated', 500);
  }



  /*
   * These functions are for creating records in the database
   */

  /**
    * This function creates a schedule for a medicine, validating the user and the medicine before creation.
    * @param $request The field with which to create the schedule, containing the medicine_id to do validation on.
    * @param $user_id The id of the user to create a schedule for
    * @return mixed
    * @author eddi
    */
  public function createSchedule(CreateScheduleApiRequest $request, $user_id)
  {
    $schedule = new Schedule();
    $fields = array('medicine_id','dayOfWeek','time','amount');
    foreach ($fields as $f) {
      if(isset($request->$f) && !empty($request->$f))
      {
        $schedule->$f = $request->$f;
      }
    }
    return ($schedule->save())?$schedule:response("Schedule not created", 403);
  }


  /**
    * This function creates a medicine for a patient, validating the user before creation.
    * @param $request The fields with which to create the medicine, optionally containing a photo.
    * @param $user_id The id of the user to create a schedule for
    * @return mixed
    * @author eddi
    */
  public function createMedicine(CreateMedicineApiRequest $request, $user_id)
  {
    $fullPath = null;

    // if there is a photo attached -> update it.
    if(isset($request->photo) && !empty($request->photo))
    {
      $path = 'userdata/user_'. $user_id . '/medicines/';
      // sanitize the filename given the name of the medication.
      $filename = ApiHelper::createValidFileName($request->name, $request->photo->guessClientExtension());
      $fullPath = $path.$filename;

      if($request->photo->move($path, 
        $filename) != $fullPath)
      {
        return response('Saving the picture failed', 500);
      }
    }

    // create the medicine object to store in DB
    $medicine = new Medicine;
    $medicine->user_id = $user_id;
    $medicine->name = trim($request->name);
    $medicine->info = trim($request->info);
    $medicine->photoUrl = $fullPath;

    // store the medicine in the DB.
    if($medicine->save() != 1)
    {
      unlink($fullPath);
      return response('Saving the medicine failed', 500);
    }

    return $medicine;
  }

  

  /**
   * This function adds a new weight to the patients records.
   * @param request The parameters to create the weight object from. 
   * @param patient_id The id of the patient to which the weight belons
   * @author eddi 
   * @return mixed
   */
  public function createWeight($patient_id)
  {
    if(!ApiHelper::isPatient($patient_id))
    {
      return response('Wrong id provided.', 403);
    }
    return 'createWeight:: NotImplemented';
  }




  /**
  * These functions delete records from the database.
  */
  
  /**
    * This function removes a schedule from the database.
    * @param user_id The id of the patient for which to delete a schedile, needed for validation of the request.
    * @param schedule_id The id of the schedule to delete.
    * @return mixed
    * @author eddi
    */
  public function deleteSchedule(Request $request, $user_id, $schedule_id)
  {
    if(!isPatient($user_id) 
      || !ApiHelper::isScheduleOfPatientsMedicine($user_id, $schedule_id)){
      return response("This schedule is not from a patient.", 403);
  }
    // fetch the schedule to delete
  $schedule = Schedule::find($schedule_id);
  return ($schedule->delete())?"Schedule is deleted":"Schedule not deleted";
}

  /**
 * This function deletes a medicine , and deletes it's photo
 * @param medicine id the id of the medicine 
 * @param user_id the id of the patient
 * @author eddi
 */
  public function deleteMedicine(Request $request, $user_id, $medicine_id)
  {
    if(!ApiHelper::isPatient($user_id)
      || !ApiHelper::isMedicineOfPatient($user_id, $medicine_id))
    {
      return response("This medicine is not from a patient.", 403);
    }
  // fetch the medicine to delete
    $medicine = Medicine::find($medicine_id);
  // first delete the medicine, this way the medicine will not show anymore, even if the photo deletion fails.
  // it's more important that a patient stops taking a medicine then a server having undeleted files.
    $medicine->delete();

  // delete the photo, if there is one 
    if ($medicine->photoUrl != null) {
      if( file_exists($medicine->photoUrl))
      {
        unlink($medicine->photoUrl);
      }
    }
    return 'Medicine deleted';
  }

  /**
   * This function deletes a photo attached to a medicine, and updates the medicine's photoUrl
   * @param medicine id the id of the medicine 
   * @param user_id the id of the patient
   * @author eddi
   */
  public function deleteMedicinePhoto(Request $request, $user_id, $medicine_id)
  {
    if(!ApiHelper::isPatient($user_id)
      || !ApiHelper::isMedicineOfPatient($user_id, $medicine_id))
    {
      return response("This medicine is not from a patient.", 403);
    }
  // fetch the medicine to delete
    $medicine = Medicine::find($medicine_id);

  // delete the photo, if there is one 
    if ($medicine->photoUrl != null) {
      if( file_exists($medicine->photoUrl))
      {
        unlink($medicine->photoUrl);
      }
    }

  // tell the medicine there is no photo anymore
    $medicine->photoUrl = null;
    return ($medicine->save())?'Medicine photo deleted and medicines photoUrl updated':'Medicine photoUrl not updated';
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

}
