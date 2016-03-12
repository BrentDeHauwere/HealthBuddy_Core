<?php

namespace App\Http\Controllers;

use \App\User;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Hash;
use Auth;

use \App\Medicine;


class UserController extends Controller
{
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
}
