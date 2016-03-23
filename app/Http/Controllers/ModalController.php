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
          $devices = \App\Device::whereNull('user_id')->get();
          if(count($devices) >= 1){
            return view('modals/linkmodal')->with('user',$user)->with('devices',$devices);
          }
          else {
            return redirect('/home')->with('response','no devices found');
          }
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
