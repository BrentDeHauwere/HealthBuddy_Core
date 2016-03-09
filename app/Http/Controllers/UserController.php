<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function login()
    {
        $people = ['Taylor', 'Matt', 'Jeffrey'];
        return view('welcome', compact('people'));
    }
}
