<?php

namespace App\Http\Controllers;

use \App\User;
use \App\Address;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use Hash;
use Auth;
use Validator;

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

    public function reset(Request $request){
        $id = $request->input('id');
        $user = \App\User::where('id','=',$id)->first();
        if($user){
          $user->password = bcrypt($request->input('password'));
          $saved = $user->save();
          if($saved){
            return redirect()->back()->with('success','Wachtwoord is successvol verandert');
          }
          else{
            return redirect()->back()->with('error','Wachtwoord kon niet aangepast worden');
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
          return redirect()->back()->with('success','Toestel is successvol gelinked');
        }
        else{
          return redirect()->back()->with('error','Toestel is niet gelinked');
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
          return redirect()->back()->with('success','Buddy is successvol gelinked');
        }
        else{
          return redirect()->back()->with('error','Buddy is niet gelinked');
        }
      }
    }

    public function editUser(Request $request){
      $validator = Validator::make($request->all(),[
        'data.id' => 'required|exists:users,id',
      ]);
      if($validator->fails()){
        return view('modals/errormodal')->with('error','Vul het formulier correct in! Vergeet niet dat de email moet bestaan of ook uniek moet zijn.');
      }
      $id = $request->input('data.id');
      $validator = Validator::make($request->all(),[
        'data.id' => 'required|exists:users,id',
        'data.firstname' => 'required',
        'data.lastname' => 'required',
        'data.date' => 'required|before:today',
        'data.email' => 'required|unique:users,email,'.$id.'|regex:/.+\@.+\..+/',
        'data.phone' => 'required',
        'data.gender' => 'required|in:M,V',
        'data.role' => 'required|in:Zorgwinkel,Zorgbehoevende,Zorgmantel',
      ]);
      if($validator->fails()){
        return view('modals/errormodal')->with('error','Vul het formulier correct in! Vergeet niet dat de email moet bestaan of ook uniek moet zijn.');
      }
      $user = \App\User::where('id','=',$id)->first();
      if($user){
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
          return view('modals/errormodal')->with('error','Gebruiker kon niet worden verandert');
        }
      }
    }

    public function editAddress(Request $request){
      $validator = Validator::make($request->all(),[
        'id' => 'required|exists:addresses,id',
        'street' => 'required',
        'streetnumber' => 'required|digits_between:1,10',
        'bus' => 'optional|digits_between:1,10',
        'zipcode' => 'required',
        'city' => 'required',
        'country' => 'required',
      ]);
      if($validator->fails()){
        return redirect()->back()->with('error','Vul het formulier correct in!');
      }
      $address = \App\Address::where('id','=',$request->input('id'))->first();
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
          return redirect()->back()->with('success','De update is voltooid');
        }
        else{
          return redirect()->back()->with('error','Adres kon niet verandert worden');
        }
      }
    }

    public function addUserAddress(Request $request){
      $validator = Validator::make($request->all(),[
        'street' => 'required',
        'streetnumber' => 'required|digits_between:1,10',
        'bus' => 'optional|digits_between:1,10',
        'zipcode' => 'required',
        'city' => 'required',
        'country' => 'required',
      ]);
      if($validator->fails()){
        return redirect()->back()->with('error','Vul het formulier correct in!');
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
          return redirect()->back()->with('success','Gebruiker is successvol opgeslagen');
        }
        else{
          $address->delete();
          return redirect()->back()->with('error','Gebruiker kon niet worden opgeslagen');
        }
      }
      else{
        return redirect()->back()->with('error','Adres kon niet worden opgeslagen');
      }
    }

    public function addUser(Request $request){
        $validator = Validator::make($request->all(),[
          'data.firstname' => 'required',
          'data.lastname' => 'required',
          'data.password' => 'required|min:7|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
          'data.confirm' => 'required|same:data.password',
          'data.date' => 'required|before:today',
          'data.email' => 'required|unique:users,email|regex:/.+\@.+\..+/',
          'data.phone' => 'required',
          'data.gender' => 'required|in:M,V',
          'data.role' => 'required|in:Zorgwinkel,Zorgbehoevende,Zorgmantel',
        ]);
        if($validator->fails()){
          return view('modals/errormodal')->with('error','Vul het formulier correct in! Een wachtwoord moet minstens 7 characters lang zijn en 1 hoofdletter bevatten en 1 getal, De email moet ook uniek zijn.');
        }
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
          return view('modals/errormodal')->with('error','User data kon niet worden afgehandeld');
        }

    }
}
