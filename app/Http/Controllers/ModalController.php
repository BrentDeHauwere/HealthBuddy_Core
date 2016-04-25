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
    public function add()
    {
        return view('modals/addmodal');
    }

    public function edit($id)
    {

        $user = \App\User::find($id);
        if(!empty($user)){
          $address = \App\Address::where('id',$user->address_id)->first();
          return view('modals/editmodal')->with('user',$user)->with('address',$address);
        }
        else{
          return redirect()->back()->with('error','Er bestaat geen gebruiker met dat ID');
        }

    }

    public function reset($id)
    {

        $user = \App\User::find($id);
        if(!empty($user)){
          return view('modals/resetmodal')->with('user',$user);
        }
        else{
          return redirect()->back()->with('error','Er bestaat geen gebruiker met dat ID');
        }


    }

    public function link($id)
    {

        $user = \App\User::find($id);
        if(!empty($user)){
          $devices = \App\Device::whereNull('user_id')->get();
          if(count($devices) >= 1){
            return view('modals/linkmodal')->with('user',$user)->with('devices',$devices);
          }
          else {
            return redirect()->back()->with('error','Geen toestellen gevonden om mee te werken');
          }
        }
        else{
          return redirect()->back()->with('error','Er bestaat geen gebruiker met dat ID');
        }


    }

    public function linkBuddy($id)
    {
        $user = \App\User::where('id','=',$id)->first();
        if($user){
          $users = \App\User::whereNull('buddy_id')->where('role','=','Zorgbehoevende')->get();
          $buddies = \App\User::where('buddy_id','=',$user->id)->get();
          if(!$users->isEmpty() || !$buddies->isEmpty()){
            return view('modals/buddymodal')->with('user',$user)->with('users',$users)->with('buddies',$buddies);
          }
          else{
            return redirect()->back()->with('error','Geen buddies gevonden');
          }

        }
        else{
          return redirect()->back()->with('error','Er bestaat geen gebruiker met dat ID');
        }

    }
    public function linkDokter($id)
    {
        $user = \App\User::where('id','=',$id)->first();
        if($user){
          $dokter = \App\User::where('id','=',$user->buddy_id)->first();
          if($user->buddy_id != NULL)
            $dokters = \App\User::where('role','=','Zorgmantel')->where('id','!=',$user->buddy_id)->get();
          else
            $dokters = \App\User::where('role','=','Zorgmantel')->get();

          return view('modals/doktermodal')->with('user',$user)->with('dokter',$dokter)->with('dokters',$dokters);
        }
        else{
          return redirect()->back()->with('error','Er bestaat geen gebruiker met dat ID');
        }

    }

}
