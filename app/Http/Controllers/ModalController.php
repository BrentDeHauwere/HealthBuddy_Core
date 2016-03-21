<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ModalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        return view('modals/addmodal');
    }

    public function edit(Request $request)
    {
      if(Input::has('data')){
        $user = \App\User::find($request->input('data'));
        if(!empty($user)){
          return view('modals/editmodal')->with('user',$user);
        }
        else{
          return 'Something went wrong, No User was found with that id';
        }

      }
      else{
        return 'Something went wrong!!!';
      }

    }

    public function reset(Request $request)
    {
      if(Input::has('data')){
        $user = \App\User::find($request->input('data'));
        if(!empty($user)){
          return view('modals/resetmodal')->with('user',$user);
        }
        else{
          return 'Something went wrong, No User was found with that id';
        }

      }
      else{
        return 'Something went wrong!!!';
      }
    }

    public function link(Request $request)
    {
      if(Input::has('data')){
        $user = \App\User::find($request->input('data'));
        if(!empty($user)){
          $devices = \App\Device::Where('user_id','=',NULL);
          return view('modals/linkmodal')->with('user',$user,'devices',$devices);
        }
        else{
          return 'Something went wrong, No User was found with that id';
        }

      }
      else{
        return 'Something went wrong!!!';
      }
    }
}
