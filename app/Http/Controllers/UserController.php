<?php

namespace App\Http\Controllers;

use \App\User;

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
}
