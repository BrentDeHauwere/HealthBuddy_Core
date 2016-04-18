<?php

namespace App;

use Auth;
use Hash;

use \App\User;
use \App\Address;
use \App\Medicine;
use \App\Weight;
use \App\Schedule;

class ApiHelper {

	/**
	 * This function creates a file from a base64 string, needed to receive photo's from the iOS app.
	 * found info here: http://stackoverflow.com/questions/15153776/convert-base64-string-to-an-image-file
	 * @param base64 the photo base64 encodes from the iOS app.
	 * @param path the path including filename to save the photo in.
	 * @return the path of the photo or -1 on fail.
	 * @author eddi
	 */
	public static function saveBase64Photo($base64, $path)
	{
  		// create a new file, using the w mode, overwriting the file if it exists!
  		// originally the mode was set to 'wb'
		$file = fopen($path, "w+");
		// write the decoded file contents into the file.
		fwrite($file, base64_decode($base64)); 
		// close the file
		fclose($file);

		// create a path with a file extention
		$newPath = $path . ApiHelper::getFileExtension($path);
		
		rename($path, $newPath);
		// return the path on success or -1 on fail
		return (file_exists($newPath))?$newPath:-1;
	}

	/**
	 * A small function that returns the filextension from a file NOT using the filename,
	 * but actually looking at the mimetype.
	 * @author eddi
	 */
	public static function getFileExtension($path)
	{	
		$file = file_get_contents($path);
		$fileInfo = finfo_open();
		$name = finfo_buffer($fileInfo, $file, FILEINFO_MIME_TYPE);
		$extension = str_split($name, strpos($name, '/') + 1);

		return '.' . $extension[1];
	}

	/**
	  * iOS sends back <null> instead of null, replace this with a php null.
	  * @param fields the fields to check for <null> values.
	  * @param request the request that needs to have <null> replaced with null.
	  * @return request/object the updated request.
	  * @author eddi 
	  */
	public static function sanitizeIosFields($fields, $request)
	{
		foreach ($fields as $f) {
			if(isset($request->$f)
				&& $request->$f == '<null>' )
			{
				$request->$f = null;
			}
		}
		return $request;
	}

	/**
	  * This function fills an object's fillable fields from a given request.
	  * @param fields an array with the fillable fields.
	  * @param request the request containing the data to put in the object.
	  * @param object an object for which certain fields will be updated using the data from the request/ 
	  * @return object the updated object or object with filled fields.
	  * @author eddi
	  */
	public static function fillApiRequestFields($fields, $request, $object)
	{
		// fill the object with the fields
		foreach ($fields as $f) {
			$object->$f = $request->$f;
		}
		return $object;
	}

	/**
	 * This function takes in a filename and replaces all the special characters to becom a valid *nix filename
	 * it replaces the slashes ('/') and spaces.
	 * @param filename The original filename to make into a valid filename.
	 * @param extension the extension of the file.
	 * @author eddi
	 * @return string the valid filename.
	 */
	public static function createValidFileName($filename, $extension)
	{	
		$validFilename = trim($filename);

		// replace ' ' with _
		$validFilename = str_replace(' ', '_', $validFilename);
		// replace / with - 
		$validFilename = str_replace('/',  '-', $validFilename);

		// cleanup the extention.
		$validExtension = trim($extension);
		// add the extention to the filename.
		$validExtension = '.' . $validExtension;

		return $validFilename . $validExtension;
	}


	/**
	 * This function checks if a given address belongs to a patient of the buddy, or logged in user.
	 * 
	 * @param $address_id
	 * @return bool returns true if the given ID corresponds to an addres of a patient of the authenticated user.
	 * @author eddi
	 */
	public static function isAddressOfPatient($address_id)
	{
	  // the boolean that will be returned.
		$isAddressOfPatient = false;
	  // fetch all users with the give address_id.
		$users_with_address = User::where('address_id', '=', $address_id)->get();

	  // to be allowed to change the address, only 1 user can have it. 
		if(sizeof($users_with_address) == 1)
		{
	    // check if the user with that address is a patient or the buddy.
			if(ApiHelper::isPatient($users_with_address->first()->id) )
			{
				$isAddressOfPatient = true;
			}  
		}
		return $isAddressOfPatient;
	}

	/**
	 * This function checks if a schedule belongs to a medicine of a given user
	 * @param user_id The id of the user to which the medicine should belong.
	 * @param schedule_id The id of the schedule to match to a cerain user.
	 * @return boolean True if this schedule belongs to a medicine of the given user, false if not.
	 * @author eddi
	 */
	public static function isScheduleOfPatientsMedicine($user_id, $schedule_id)
	{
	  	// the boolean that will be returned.
		$isScheduleValid = false;

	  	// fetch all users with the medicines.
		$medicines_with_schedules = Medicine::where('user_id', '=', $user_id)->with('schedule')->get();

		$schedule = Schedule::find($schedule_id);

		if($schedule != null && ApiHelper::isPatient($user_id))
		{
			foreach ($medicines_with_schedules as $m) {
				if($m->id == $schedule->medicine_id)
				{
					$isScheduleValid = true;
				}		
			}
		}
		return $isScheduleValid;
	}

	/**
	 * This function checks if a medicine belongs to a given user
	 * @param user_id The id of the user to which the medicine should belong.
	 * @param medicine_id The id of the medicine to check.
	 * @return boolean True if this medicine belongs to the given user, false if not.
	 * @author eddi
	 */
	public static function isMedicineOfPatient($user_id, $medicine_id)
	{
		$medicines = Medicine::where('user_id','=',$user_id)->where('id','=',$medicine_id)->get();
		return (sizeof($medicines) == 1)?true:false;
	}

	/**
	 * This is a function to check if an id corresponds to an id of the authenticated user's patients.
	 *
	 * @param $patient_id
	 * @return bool returns true if the given ID corresponds to a patient of the authenticated user.
	 * @author eddi
	 */
	public static function isPatient($patient_id)
	{
		$user = ApiHelper::getAuthenticatedUser();
		foreach ($user->patients as $patient) {
			if($patient->id == $patient_id)
			{
				return true;
			}
		}
		return false;
	}

	/**
	 * This is a function to check if the logged in user is a patient.
	 *
	 * @return bool returns true if the logged in user is a patient.
	 * @author eddi
	 */
	public static function isLoggedInUserPatient(){
		$user = ApiHelper::getAuthenticatedUser();
		return ($user->buddy_id != null && $user->role == 'Zorgbehoevende')?true:false;
	}

	/**
	 * This is a function to get the authenticated user,
	 * in both the web and api cases.
	 * @return mixed
	 */
	public static function getAuthenticatedUser()
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