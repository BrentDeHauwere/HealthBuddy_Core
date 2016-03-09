<?php

namespace App\Http\Controllers;

use \App\User;

class UserController extends Controller
{
    public function showProfile(User $user)
    {
        return $user->with('address');
    }
}
