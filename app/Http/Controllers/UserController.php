<?php

namespace App\Http\Controllers;

use \App\User;

class UserController extends Controller
{
    public function showProfile($user)
    {
        return User::with('address', 'medicalInfo', 'devices')->find($user);
    }

    public function showPatients(User $user)
    {
        return $user->patients;
    }
}
