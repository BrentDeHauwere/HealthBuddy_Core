<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Controllers\ApiController;
use Auth;

use App\User;
use App\ApiHelper;

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
        $auth_user = User::find(ApiHelper::getAuthenticatedUser()->id);
        $user_id = $this->route('user_id');
        if($user_id == $auth_user->id || ApiHelper::isPatient($user_id)){

            // ugly code; since iOs sends back <null> instead of null -> need to filter out these fields
            $fields = array('firstName', 'lastName', 'phone', 'gender', 'dateOfBirth', 'email');
            foreach ($fields as $f) {
                if($f == '<null>'
                  )
                {
                    echo $this->$f;
                    $this->$f == null;
                }
            }

            return true;
        }
        return false;
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
        'phone'         => 'min:9|max:25',
        'gender'        => 'in:M,V',
        'dateOfBirth'   => 'before:today|after:1890-01-01',
        'email'         => 'email|min:12|max:255',
        ];
    }

}
