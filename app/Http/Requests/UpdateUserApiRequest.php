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
        return [
        'email' => 'bail|email|unique:users,email',
        'password' => 'bail|min:8',
        'firstName' => 'bail|min:2|max:255',
        'lastName' => 'bail|min:2|max:255',
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
