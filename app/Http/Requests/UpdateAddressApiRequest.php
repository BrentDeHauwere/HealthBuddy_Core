<?php

namespace App\Http\Requests;

use Auth;
use App\Http\Requests\Request;
use App\User;
use App\address;
use App\ApiDbCheck;

class UpdateAddressApiRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {   
        $user = $this->getAuthenticatedUser();
        $address_id = $this->route('address_id');
        
        // check if the addresss belongs to the buddy or one of it's patients
        if($this->isAddressOfPatient($address_id) 
            || $user->address_id == $address_id)
        {
            return true;
        }
        else
        {
            // the address does not belong to buddy nor patient, abort.
            return response('That address does not belong to a patient', 403);
        }   
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'street'        => 'min:2|max:255',
        'streetNumber'  => 'min:1|max:10000',
        'bus'           => 'min:0|max:1000',
        'zipCode'       => 'min:2|max:255',
        'city'          => 'min:2|max:255',
        'country'       => 'min:2|max:255',
        ];
    }

    // TODO: These functions should get their own file
  /**
   * This is a function to check if an id corresponds to an id of the authenticated user's patients.
   *
   * @param $patient_id
   * @return bool returns true if the given ID corresponds to a patient of the authenticated user.
   * @author eddi
   */
  function isPatient($patient_id)
  {
    $user = $this->getAuthenticatedUser();
    foreach ($user->patients as $patient) {
      if($patient->id == $patient_id)
      {
        return true;
      }
    }
    return false;
  }

  /**
   * This function checks if a given address belongs to a patient of the buddy, or logged in user.
   * 
   * @param $address_id
   * @return bool returns true if the given ID corresponds to an addres of a patient of the authenticated user.
   * @author eddi
   */
  function isAddressOfPatient($address_id)
  {
    // the boolean that will be returned.
    $isAddressOfPatient = false;
    // fetch all users with the give address_id.
    $users_with_address = User::where('address_id', '=', $address_id)->get();

    // to be allowed to change the address, only 1 user can have it. 
    if(sizeof($users_with_address) == 1)
    {
      // check if the user with that address is a patient or the buddy.
      if($this->isPatient($users_with_address->first()->id) )
      {
        $isAddressOfPatient = true;
      }  
    }
    return $isAddressOfPatient;
  }

  /**
   * This is a function to get the authenticated user,
   * in both the web and api cases.
   * @return mixed
   */
  function getAuthenticatedUser()
  {
      // get the web-user
    $user = Auth::guard()->user();

      // get the api-user
    if(!isset($user) && $user == null) {
      $user = Auth::guard('api')->user();
    }
    return $user;
  }

}
