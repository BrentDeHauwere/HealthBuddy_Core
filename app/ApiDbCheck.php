<?php

namespace App;

use Auth;
use Hash;

use \App\User;
use \App\Address;
use \App\Medicine;
use \App\Weight;
use \App\Schedule;

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
