<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Requests;
use Auth;
use Hash;

use \App\User;


class ApiController extends Controller
{
    public function showProfile($user_id)
    {
        $auth_user = $this->getAuthenticatedUser();
        if($user_id == $auth_user->id) {
            return User::with('address', 'medicalInfo')->find($user_id);
        }
        else
        {
            return "Unauthorized";
        }
    }

    public function showPatients(User $user)
    {
        $auth_user = $this->getAuthenticatedUser();
        if($user->id == $auth_user->id) {
            return $user->patients;
        }
        else
        {
            return "Unauthorized";
        }
    }

    public function showDevices(User $user)
    {

        $auth_user = $this->getAuthenticatedUser();
        if($user->id == $auth_user->id) {
            return $user->devices;
        }
        else
        {
            return "Unauthorized";
        }

    }

    public function showWeights(User $user)
    {
        $auth_user = $this->getAuthenticatedUser();
        if($user->id == $auth_user->id) {
            return $user->weights;
        }
        else
        {
            return "Unauthorized";
        }
    }

    public function showSchedule($user)
    {
        $auth_user = $this->getAuthenticatedUser();
        if($user->id == $auth_user->id) {
            return Medicine::with('schedule')->where('user_id', '=', $user)->get();
        }
        else
        {
            return "Unauthorized";
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
                return $user->api_token;
            }
            else{
                throw new ModelNotFoundException('Wrong password');
            }

        }catch(ModelNotFoundException $ex){
            // print get_class_methods($ex);
            print($ex->getMessage());
        }
    }
}
