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
          return view('/modals/errormodal')->with('error','Er bestaat geen gebruiker met dat ID');
        }

      }
      else{
        return view('/modals/errormodal')->with('error','Er is iets mis gegaan');
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
          return view('/modals/errormodal')->with('error','Er bestaat geen gebruiker met dat ID');
        }

      }
      else{
        return view('/modals/errormodal')->with('error','Er is iets mis gegaan');
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
            return view('/modals/errormodal')->with('error','Geen toestellen gevonden om mee te werken');
          }
        }
        else{
          return view('/modals/errormodal')->with('error','Er bestaat geen gebruiker met dat ID');
        }

      }
      else{
        return view('/modals/errormodal')->with('error','Er is iets mis gegaan');
      }
    }

    public function linkBuddy(Request $request)
    {
        $user = \App\User::where('id','=',$request->input('data'))->first();
        if($user){
          $users = \App\User::whereNull('buddy_id')->where('role','=','Zorgbehoevende')->get();
          $buddies = \App\User::where('buddy_id','=',$user->id)->get();
          if(!$users->isEmpty() || !$buddies->isEmpty()){
            return view('modals/buddymodal')->with('user',$user)->with('users',$users)->with('buddies',$buddies);
          }
          else{
            return view('modals/errormodal')->with('error','Geen buddies gevonden');
          }

        }
        else{
          return view('/modals/errormodal')->with('error','Er bestaat geen gebruiker met dat ID');
        }

    }
    public function linkDokter(Request $request)
    {
        $user = \App\User::where('id','=',$request->input('data'))->first();
        if($user){
          $dokter = \App\User::where('id','=',$user->buddy_id)->first();
          if($dokter){
            return view('modals/doktermodal')->with('user',$user)->with('dokter',$dokter);
          }
          else{
            return view('modals/errormodal')->with('error','Geen dokter gevonden');
          }

        }
        else{
          return view('/modals/errormodal')->with('error','Er bestaat geen gebruiker met dat ID');
        }

    }

}
