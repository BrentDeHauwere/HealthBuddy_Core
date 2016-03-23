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
        $user->password = $request->input('password');
        $saved = $user->save();
        if($saved){
          return redirect('/home')->with('success','Password was succesfully saved');
        }
        else{
          return redirect('/home')->with('response','Password was not saved');
        }
    }

    public function linkDevice(Request $request){
      $userid = $request->input('id');
      $device = \App\Device::Where('id','=',$request->input('device'))->first();
      $device->user_id = $userid;
      $savedAdd = $device->save();
      if($savedAdd){
        return redirect('/home')->with('success','Device was succesfully linked');
      }
      else{
        return redirect('/home')->with('response','Device was not linked');
      }
    }

    public function editUser(Request $request){

      $id = $request->input('data.id');
      $user = \App\User::where('id','=',$id)->first();
      $user->firstName = $request->input('data.firstname');
      $user->lastName = $request->input('data.lastname');
      $user->dateOfBirth = $request->input('data.date');
      $user->email = $request->input('data.email');
      $user->gender = $request->input('data.gender');
      $user->role = $request->input('data.role');
      $saved = $user->save();
      if($saved){
        $addrID = $user->address_id;
        $addr = \App\Address::where('id','=',$addrID)->first();
        return view('modals/editaddressmodal')->with('id',$id)->with('address',$addr);
      }
      else{
        return redirect('/home')->with('response','User was not saved');
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
        return redirect('/home')->with('success','Address was succesfully saved');
      }
      else{
        return redirect('/home')->with('response','Address was not saved');
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
        $user->password = $request->session()->get('password');
        $user->dateOfBirth = $request->session()->get('dateOfBirth');
        $user->email = $request->session()->get('email');
        $user->role = $request->session()->get('role');
        $user->address_id = $address->id;
        $savedUser = $user->save();

        if($savedUser){
          return redirect('/home')->with('success','User was succesfully saved');
        }
        else{
          $address->delete();
          return redirect('/home')->with('response','Could not save the user');
        }
      }
      else{
        return redirect('/home')->with('response','Could not save the address');
      }
    }

    public function addUser(Request $request){

        $array = [
            "firstName" => $request->input('data.firstname'),
            "lastName" => $request->input('data.lastname'),
            "password" => $request->input('data.password'),
            "dateOfBirth" => $request->input('data.date'),
            "email" => $request->input('data.email'),
            "gender" => $request->input('data.gender'),
            "role" => $request->input('data.role'),
        ];

        $request->session()->put($array);
        if($request->session()->has('firstName')){
          return view('modals/addaddressmodal');
        }

    }
}
