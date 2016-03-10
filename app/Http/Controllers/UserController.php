<?php

namespace App\Http\Controllers;

use \App\User;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Hash;

use \App\Medicine;


class UserController extends Controller
{
    public function showProfile($user)
    {
        return User::with('address', 'medicalInfo')->find($user);
    }

    public function showPatients(User $user)
    {
        return $user->patients;
    }

    public function showDevices(User $user)
    {
        return $user->devices;
    }

    public function showWeights(User $user)
    {
        return $user->weights;
    }

    public function showSchedule($user)
    {
        return Medicine::with('schedule')->where('user_id', '=', $user)->get();
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
