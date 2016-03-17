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
      if(!(Input::has('data'))){
        return redirect('/home')->with('response','No data found');
      }

      if(Input::has('data.firstname') && Input::has('data.lastname') && Input::has('data.password') && Input::has('data.confirm') && Input::has('data.date') && Input::has('data.email') && Input::has('data.gender') && Input::has('data.role')){
        if($request->input('data.password') == $request->input('data.confirm')){
          $user = \App\User::where('email','=',$request->input('data.email'))->first();
          //$user = NULL;
          if(!($user)){
            if(preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $request->input('data.password')) === 1){
              if(preg_match('/^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})/', $request->input('data.email')) === 1){
                if($request->input('data.gender') == 'M' || $request->input('data.gender') == 'V'){
                  if($request->input('data.role') == 'Zorgwinkel' || $request->input('data.role') == 'Zorgmantel' || $request->input('data.role') == 'Zorgbehoevende'){
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
                    else{
                      return redirect('/home')->with('response','User could not be made');
                    }
                  }
                  else{
                    return redirect('/home')->with('response','Role cannot be this value');
                  }
                }
                else{
                  return redirect('/home')->with('response','Gender can only be M or V');
                }

              }
              else{
                return redirect('/home')->with('response','This is not a valid email');
              }
            }
            else{
              return redirect('/home')->with('response','Password must have atleast 8 characters and both Alphabetic and number');
            }
          }
          else{
            return redirect('/home')->with('response','Email was not unique');
          }
        }
        else{
          return redirect('/home')->with('response','Passwords were not the same');
        }
      }
      else{
        return redirect('/home')->with('response','Not all fields were filled in');
      }
    }
}
