<?php

namespace App\Http\Controllers;

use \App\User;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use Hash;
use Auth;

use \App\Medicine;


class UserController extends Controller
{
    public function showProfile($user_id)
    {
            return User::with('address', 'medicalInfo')->find($user_id);
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

    public function addUser(Request $request){
      if(Input::has('firstname') && Input::has('lastname') && Input::has('password') && Input::has('confirm') && Input::has('date') && Input::has('email') && Input::has('gender') && Input::has('role')){
        if($request->input('password') == $request->input('confirm')){
          $user = \App\User::where('email','=',$request->input('confirm'))->first();
          if(!($user)){
            if(preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $request->input('password')) === 1){
              return redirect('/home')->with('success','Success');
            }
            else{
              return redirect('/home')->with('response','Password must have atleast 8 characters and both Alphabetic and number');
            }
          }
          else{
            return redirect('/home')->with('response','Email was not unique');
          }
        }
        else{
          return redirect('/home')->with('response','Passwords were not the same');
        }
      }
      else{
        return redirect('/home')->with('response','Not all fields were filled in');
      }
    }
}
