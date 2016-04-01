<?php

namespace App\Http\Controllers;

use \App\User;
use \App\Address;

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

    public function reset(Request $request){
        $id = $request->input('id');
        $user = \App\User::where('id','=',$id)->first();
        $user->password = bcrypt($request->input('password'));
        $saved = $user->save();
        if($saved){
          return redirect()->back()->with('success','Password was succesfully saved');
        }
        else{
          return redirect()->back()->with('error','Password was not saved');
        }
    }

    public function linkDevice(Request $request){
      $userid = $request->input('id');
      $device = \App\Device::Where('id','=',$request->input('device'))->first();
      $device->user_id = $userid;
      $savedAdd = $device->save();
      if($savedAdd){
        return redirect()->back()->with('success','Device was succesfully linked');
      }
      else{
        return redirect()->back()->with('error','Deivce could not be linked');
      }
    }

    public function linkBuddy(Request $request){
      $buddy = \App\User::where('id','=',$request->input('buddy'))->first();
      $userid = $request->input('user');
      $buddy->buddy_id = $userid;
      $savedAdd = $buddy->save();
      if($savedAdd){
        return view('/modals/successmodal')->with('success','Buddy was linked');
      }
      else{
        return view('/modals/errormodal')->with('error','Buddy could not be linked');
      }
    }

    public function editUser(Request $request){

      $id = $request->input('data.id');
      $user = \App\User::where('id','=',$id)->first();
      $user->firstName = $request->input('data.firstname');
      $user->lastName = $request->input('data.lastname');
      $user->dateOfBirth = $request->input('data.date');
      $user->email = $request->input('data.email');
      $user->phone = $request->input('data.phone');
      $user->gender = $request->input('data.gender');
      $user->role = $request->input('data.role');
      $saved = $user->save();
      if($saved){
        $addrID = $user->address_id;
        $addr = \App\Address::where('id','=',$addrID)->first();
        return view('modals/editaddressmodal')->with('address',$addr);
      }
      else{
        return view('/modals/errormodal')->with('error','User could not be edited');
      }
    }

    public function editAddress(Request $request){

      $address = \App\Address::where('id','=',$request->input('id'))->first();
      $address->street = $request->input('street');
      $address->streetNumber = $request->input('streetnumber');
      $address->bus = $request->input('bus');
      $address->zipCode = $request->input('zipcode');
      $address->city = $request->input('city');
      $address->country = $request->input('country');
      $savedAdd = $address->save();
      if($savedAdd){
        return redirect()->back()->with('success','Update was succesfully saved');
      }
      else{
        return redirect()->back()->with('error','Address could not be saved');
      }
    }

    public function addUserAddress(Request $request){
      $address = new Address();
      $address->street = $request->input('street');
      $address->streetNumber = $request->input('streetnumber');
      $address->bus = $request->input('bus');
      $address->zipCode = $request->input('zipcode');
      $address->city = $request->input('city');
      $address->country = $request->input('country');
      $savedAdd = $address->save();
      if($savedAdd){
        $user = new User();
        $user->firstName = $request->session()->get('firstName');
        $user->lastName = $request->session()->get('lastName');
        $user->password = bcrypt($request->session()->get('password'));
        $user->api_token = str_random(60);
        $user->dateOfBirth = $request->session()->get('dateOfBirth');
        $user->email = $request->session()->get('email');
        $user->phone = $request->session()->get('phone');
        $user->role = $request->session()->get('role');
        $user->address_id = $address->id;
        $savedUser = $user->save();

        if($savedUser){
          return redirect()->back()->with('success','User was succesfully saved');
        }
        else{
          $address->delete();
          return redirect()->back()->with('error','User could not be saved');
        }
      }
      else{
        return redirect()->back()->with('error','Address could not be saved');
      }
    }

    public function addUser(Request $request){

        $array = [
            "firstName" => $request->input('data.firstname'),
            "lastName" => $request->input('data.lastname'),
            "password" => $request->input('data.password'),
            "dateOfBirth" => $request->input('data.date'),
            "email" => $request->input('data.email'),
            "phone" => $request->input('data.phone'),
            "gender" => $request->input('data.gender'),
            "role" => $request->input('data.role'),
        ];

        $request->session()->put($array);
        if($request->session()->has('firstName')){
          return view('modals/addaddressmodal');
        }
        else{
          return view('/modals/errormodal')->with('error','Could not persist user data');
        }

    }
}
