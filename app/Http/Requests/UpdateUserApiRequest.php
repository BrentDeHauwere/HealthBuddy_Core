<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

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
        return true;
        // return false;
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
}
