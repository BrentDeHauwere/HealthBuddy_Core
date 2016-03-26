<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Controllers\ApiController;
use Auth;

use App\User;

/**
 * This is a Class created to Validate a Request and check userinput 
 * following a set of rules.
 * Gebaseerd op deze tutorial: http://slashnode.com/mastering-form-validation-laravel-5/
  * en ook op de larabel documentatie https://laravel.com/docs/5.2/validation.
  * @author: eddi.
*/
class UpdateUserApiRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $auth_user = User::find($this->getAuthenticatedUser()->id);
        $user_id = $this->route('user_id');
        if($user_id == $auth_user->id || $this->isPatient($user_id)){
            return true;
        }
        else {
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /**
        * This is the original way, expecting post params for each user value
        */
        return [
        'firstName'     => 'min:2|max:255',
        'lastName'      => 'min:2|max:255',
        'pĥone'         => 'max:25|min:7',
        'gender'        => 'in:M,V',
        'dateOfBirth'   => 'before:today|after:1890-01-01',
        ];
    }


       /**
     * This is a function to check if an id corresponds to an id of the authenticated user's patients.
     *
     * @param $patient_id
     * @return bool returns true if the given ID corrsponds to a patient of the authenticated user.
     * @author eddi
     */
       public function isPatient($patient_id)
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
}
