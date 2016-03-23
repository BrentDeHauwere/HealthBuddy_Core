<?php

namespace App\Http\Controllers;

use App\MedicalInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests;

use Auth;
use Hash;
use DB;

use \App\User;
use \App\Medicine;
use \App\Weight;
use \App\Schedule;

// use App\Http\Requests\Request;
use App\Http\Requests\UpdateUserApiRequest;

/**
 *This is the Controller that handles all API requests,
 * @author eddi
 */
class ApiController extends Controller
{
    public function showProfile()
    {
        // this must return a JSON object with the user and his info and his patients;
        $auth_user = User::with('patients')->find($this->getAuthenticatedUser()->id);
        $patients = User::where('buddy_id', '=' ,$auth_user->id);
        return $auth_user;
    }

    public function showPatients()
    {
        $auth_user = $this->getAuthenticatedUser();
        return $auth_user->patients;
    }

    /**
     * @param $patient_id
     * @return mixed
     */
    public function showPatient($patient_id)
    {
        if($this->isPatient($patient_id)) {
            $patient = User::with('address', 'medicalinfo')->where('id', '=', $patient_id)->get();
            $lastWeight = Weight::where('user_id', '=', $patient_id)->orderBy('created_at', 'desc')->first();

            return response()->json([
                'patient' => $patient,
                'weight' => $lastWeight,
                ]);
        }
        abort(403, 'Wrong Patient_id provided.');
    }

    public function showMedicines ($patient_id){
        if($this->isPatient($patient_id)) {
          $schedule = Medicine::with('schedule')->where('user_id', '=', $patient_id)->get();
          /// $medicines = Medicine::where('user_id', '=',$patient_id)->get();

          return $schedule;
      }
      abort(403, 'Wrong Patient_id provided.');
  }
  public function showSchedule($patient_id){
        // send the requested patient info
    if($this->isPatient($patient_id)) {
        return Medicine::with('schedule')->where('user_id', '=', $patient_id)->get();
    }
    else {
        abort(403, 'Wrong Patient_id provided.');
    }
}

public function showWeights($patient_id)
{
    if($this->isPatient($patient_id)) {
        return Weight::where('user_id', '=', $patient_id)->get();
    }
    abort(403, 'Wrong Patient_id provided.');
}

public function showLastWeight($patient_id)
{
    if($this->isPatient($patient_id)) {
        return Weight::where('user_id', '=', $patient_id)->orderBy('created_at', 'desc')->first();
    }
    abort(403, 'Wrong Patient_id provided.');
}





    /**
     * This is a function to check if an id corresponds to an id of the authenticated user's patients.
     *
     * @param $patient_id
     * @return bool returns true if the given ID corrsponds to a patient of the authenticated user.
     * @author eddi
     */
    public function isPatient($patient_id)
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
     * This function is for updateing a users info.
     * @param $request
     * @param $user_id
     * @return mixed
     * @author eddi
     */
    public function updateUser(UpdateUserApiRequest $request, $user_id)
    {
        $user = $this->getAuthenticatedUser();

        if($this->isPatient($user_id) || $user->id == $user_id)
        {
            // DB::table('users')
            // ->where('id', $user_id)
            // ->update(array(
            //     'firstName' => $request->firstName,
            //     'lastName' => $request->lastName
            //     ));
            // $user->firstName = $request->firstName;
            // $user->update();

            return "updateUser:: not implemented yet, validation in progress, testing updating a few parameters only";
        }
        else {
            abort(403, 'Wrong id provided.');
        }
    }

    public function updateAddress(Request $request){
        $user = $this->getAuthenticatedUser();

        if(true){
            return 'not implemented yet';
        }
        else {
            abort(403, 'Wrong AddressID');
        }
    }

    /*
     * These functions are for creating records in the database
     */
    public function createWeight($patient_id)
    {
        if($this->isPatient($patient_id))
        {
            return 'createWeight:: NotImplemented';
        }
        else {
            abort(403, 'Wrong id provided.');
        }
    }

    /**
     * This is a function to get the authenticated user,
     * in both the web and api cases.
     * @return mixed
     */
    public function getAuthenticatedUser()
    {
        // get the web-user
        $user = Auth::guard()->user();

        // get the api-user
        if(!isset($user) && $user == null) {
            $user = Auth::guard('api')->user();
        }
        return $user;
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
