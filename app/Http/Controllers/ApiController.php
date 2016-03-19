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
use \App\Medicine;
use \App\Weight;
use \App\Schedule;

class ApiController extends Controller
{
    public function showProfile()
    {
        // this must return a JSON object with the user and his info and his patients;
        $auth_user = User::with('address', 'patients')->find($this->getAuthenticatedUser()->id);
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
            $medicines = Medicine::where('user_id', '=',$patient_id)->get();
            $schedule = Medicine::with('schedule')->where('user_id', '=', $patient_id)->get();
            $lastWeight = Weight::where('user_id', '=', $patient_id)->orderBy('created_at', 'desc')->first();

            return response()->json([
                'patient' => $patient,
                'schedule' => $schedule,
                'medicines' => $medicines,
                'weight' => $lastWeight,
            ]);
        }
        abort(403, 'Wrong Patient_id provided.');
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

    public function showSchedule($patient_id)
    {
        // send the requested patient info
        if($this->isPatient($patient_id)) {
            return Medicine::with('schedule')->where('user_id', '=', $patient_id)->get();
        }
        else {
            abort(403, 'Wrong Patient_id provided.');
        }
    }



    /**
     * This is a function to check if an id corresponds to an id of the authenticated user's patients.
     *
     * @param $patient_id
     * @return bool returns true if the given ID corrsponds to a patient of the authenticated user.
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
     * These functions are for updating records in the database
     * @param $request
     * @param $user_id
     * @return mixed
     */
    public function updateUser(Request $request, $user_id)
    {
        $user = $this->getAuthenticatedUser();

        if($this->isPatient($user_id) || $user->id == $user_id)
        {

            // TODO will put valitation here
            // http://slashnode.com/mastering-form-validation-laravel-5/
            // TODO thx to wanz who gave me that link and told me to NOT follow the link i found (laravelbook)
            return "updateUser:: not implemented yet";
        }
        else {
            abort(403, 'Wrong id provided.');
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
                $profile = User::with('address', 'patients')->find($user->id);
                return response()->json(array('api_token'=>$api_token,'profile'=>$profile));
            }
            else{
                throw new ModelNotFoundException('Wrong password');
            }

        }catch(ModelNotFoundException $ex){
            return response($ex->getMessage(), 401);
       }
    }
}
