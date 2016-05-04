<?php

namespace App\Http\Controllers;

use \App\User;
use \App\Address;
use \App\MedicalInfo;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use Hash;
use Auth;
use Validator;

use \App\Medicine;
use \App\Http\Requests\AddUserRequest;
use \App\Http\Requests\EditUserRequest;
use \App\Http\Requests\EditUserRequestv2;
use \App\Http\Requests\AddAddressUserRequest;
use \App\Http\Requests\EditAddressUserRequest;
use \App\Http\Requests\PasswordResetRequest;

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

    public function delete(Request $request){
      $id = $request->input('ID');
      $user = \App\User::where('id','=',$id)->first();
      if($user){
        $devices = \App\Device::where('user_id',$user->id)->get();
        if(!$devices->isEmpty()){
          foreach($devices as $device){
            $device->user_id = NULL;
            $device->save();
          }
        }
        $buddies = \App\User::where('buddy_id',$user->id)->get();
        if(!$buddies->isEmpty()){
          foreach($buddies as $buddy){
            $buddy->buddy_id = NULL;
            $buddy->save();
          }
        }
        $deleted = $user->delete();
        if($deleted){
          return redirect('/home')->with('success','Gebruiker is verwijdert');
        }
        else{
          return redirect('/home')->with('error','Gebruiker is niet verwijdert');
        }
      }
      else{
        return redirect('/home')->with('error','Er bestaat geen gebruiker met dat ID');
      }

    }

    public function unlinkDokter(Request $request){
      $id = $request->input('buddy');
      $user = \App\User::where('id','=',$id)->first();
      if($user){
        $user->buddy_id = NULL;
        $saved = $user->save();
        if($saved){
          return redirect('/home')->with('success','Dokter is geunlinked');
        }
        else{
          return redirect('/home')->with('error','Dokter is niet geunlinked');
        }
      }
    }

    public function linkDokter(Request $request){
      $id = $request->input('user');
      $user = \App\User::where('id','=',$id)->first();
      $dokterid = $request->input('dokter');
      $dokter = \App\User::where('id','=',$dokterid)->first();
      if($user && $dokter){
        $user->buddy_id = $dokter->id;
        $saved = $user->save();
        if($saved){
          return redirect('/home')->with('success','Dokter is gelinked');
        }
        else{
          return redirect('/home')->with('error','Dokter is niet gelinked');
        }
      }
    }

    public function unlink(Request $request){
      $id = $request->input('buddy');
      $user = \App\User::where('id','=',$id)->first();
      if($user){
        $user->buddy_id = NULL;
        $saved = $user->save();
        if($saved){
          return redirect('/home')->with('success','Buddy is geunlinked');
        }
        else{
          return redirect('/home')->with('error','Buddy is niet geunlinked');
        }
      }
    }

    public function reset(PasswordResetRequest $request){
      $id = $request->input('id');
      $user = \App\User::where('id','=',$id)->first();
      if($user){
        $user->password = bcrypt($request->input('password'));
        $saved = $user->save();
        if($saved){
          return redirect()->to('/home')->with('success','Wachtwoord is successvol verandert');
        }
        else{
          return redirect()->to('/home')->with('error','Wachtwoord kon niet aangepast worden');
        }
      }
    }

    public function linkDevice(Request $request){
      $userid = $request->input('id');
      $device = \App\Device::Where('id','=',$request->input('device'))->first();
      if($device){
        $device->user_id = $userid;
        $savedAdd = $device->save();
        if($savedAdd){
          return redirect()->to('/home')->with('success','Toestel is successvol gelinked');
        }
        else{
          return redirect()->to('/home')->with('error','Toestel is niet gelinked');
        }
      }
    }

    public function linkBuddy(Request $request){
      $buddy = \App\User::where('id','=',$request->input('buddy'))->first();
      $userid = $request->input('user');
      if($buddy){
        $buddy->buddy_id = $userid;
        $savedAdd = $buddy->save();
        if($savedAdd){
          return redirect()->to('/home')->with('success','Buddy is successvol gelinked');
        }
        else{
          return redirect()->to('/home')->with('error','Buddy is niet gelinked');
        }
      }
    }

    public function unlinkDevice(Request $request){
      $device = \App\Device::where('id','=',$request->input('device'))->first();
      if($device){
        $device->user_id = NULL;
        $savedUnlink = $device->save();
        if($savedUnlink){
          return redirect()->to('/home')->with('success','Device is successvol geunlinked');
        }
        else{
          return redirect()->to('/home')->with('error','Device is niet geunlinked');
        }
      }
    }

    public function editUser(EditUserRequestv2 $request){

      $id = $request->input('id');
      $user = \App\User::where('id',$id)->first();
      if($user->email != $request->input('email')){
        $exists = \App\User::where('email',$request->input('email'))->first();
        if($exists){
          return redirect()->to('/home')->with('error','Er bestaat al een gebruiker met deze email.');
        }
      }

      if($user){
        $user->firstName = $request->input('firstname');
        $user->lastName = $request->input('lastname');
        $user->dateOfBirth = $request->input('date');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');
        $user->role = $request->input('role');
        $saved = $user->save();
        if($saved){
          $addrID = $user->address_id;

          $address = \App\Address::where('id','=',$addrID)->first();
          if($address){
            $address->street = $request->input('street');
            $address->streetNumber = $request->input('streetnumber');
            if($request->has('bus'))
              $address->bus = $request->input('bus');
            $address->zipCode = $request->input('zipcode');
            $address->city = $request->input('city');
            $address->country = $request->input('country');
            $savedAdd = $address->save();
            if($savedAdd){
              return redirect()->to('/home')->with('success','De update is voltooid');
            }
            else{
              return redirect()->to('/home')->with('error','Adres kon niet verandert worden');
            }
          }
        }
        else{
          return redirect()->to('/home')->with('error','Gebruiker kon niet worden verandert');
        }
      }
      return redirect()->to('/home')->with('error','Gebruiker kon niet worden verandert');
    }

    public function addUser(AddUserRequest $request){
      $exists = \App\User::where('email',$request->input('email'))->first();
      if($exists){
        return redirect()->to('/home')->with('error','Er bestaat al een gebruiker met deze email.');
      }
      $address = new Address();
      $address->street = $request->input('street');
      $address->streetNumber = $request->input('streetnumber');
      if($request->has('bus'))
        $address->bus = $request->input('bus');
      $address->zipCode = $request->input('zipcode');
      $address->city = $request->input('city');
      $address->country = $request->input('country');
      $savedAdd = $address->save();
      

      if($savedAdd){
        $user = new User();
        $user->firstName = $request->input('firstname');
        $user->lastName = $request->input('lastname');
        $user->password = bcrypt($request->input('password'));
        $user->api_token = str_random(60);
        $user->dateOfBirth = $request->input('date');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->role = $request->input('role');
        $user->address_id = $address->id;


        $savedUser = $user->save();

        if($savedUser){
          // link a MedicalInfo
          $medicalInfo = new MedicalInfo();
          $medicalInfo->user_id = $user->id;
          $savedMedicalInfo = $medicalInfo->save();

          if($savedMedicalInfo){
            return redirect()->to('/home')->with('success','Gebruiker is successvol opgeslagen');
          }
          $user->delete();
          $address->delete();
          return redirect()->to('/home')->with('error','Gebruiker zijn medicalinfo kon niet worden opgeslagen');
        }
        else{
          $address->delete();
          return redirect()->to('/home')->with('error','Gebruiker kon niet worden opgeslagen');
        }
      }
      else{
        return redirect()->to('/home')->with('error','Adres kon niet worden opgeslagen');
      }

    }
  }
