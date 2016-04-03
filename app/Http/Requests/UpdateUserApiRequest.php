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
        'firstName'     => 'required|min:2|max:255',
        'lastName'      => 'required|min:2|max:255',
        'phone'         => 'min:9|max:25',
        'gender'        => 'in:M,V',
        'dateOfBirth'   => 'before:today|after:1890-01-01',
        'email'         => 'email|min:12|max:255',
        ];
      }



    /**
    * Get the error messages for the defined validation rules.
    * Maybe not the cleanest solution, but certainly does the job.
    * 
    * @author eddi
    * @return array
    */
      public function messages()
      {

	$fields = array('firstName' => 'voornaam', 'lastName' => 'achternaam', 'phone' => 'telefoon', 'gender' => 'geslacht', 'dateOfBirth' => 'geboortedatum', 'email' => 'email');
        $msgs = array();

        foreach ($fields as $f => $k) {
          $msgs[$f.'.required']  = 'Het ' . $k .' veld is verplicht in te vullen.';
          $msgs[$f.'.size']      = 'Het ' . $k . ' veld moet :size lang zijn.';
          $msgs[$f.'.between']   = 'Het ' . $k . ' veld moet tussen :min - :max zijn.';
          $msgs[$f.'.min']       = 'Het ' . $k . ' veld moet minstens :min tekens lang zijn.';
          $msgs[$f.'.max']       = 'Het ' . $k . ' veld mag maximaal :max tekens lang zijn.';
          $msgs[$f.'.unique']    = 'Het ' . $k . ' veld moet uniek zijn.';
          $msgs[$f.'.alpha_num'] = 'Het ' . $k . ' veld moet alfanumeriek zijn.';
          $msgs[$f.'.numberic']  = 'Het ' . $k . ' veld moet numeriek zijn.';
          $msgs[$f.'.email']     = 'Het ' . $k . ' veld moet een geldig emailadres zijn.';
          $msgs[$f.'.image']     = 'Het ' . $k . ' veld moet een foto zijn, een jpeg,png, bmp, gif of svg';
          $msgs[$f.'.same']      = 'Het ' . $k . ' veld moet gelijk zijn aan :other.';
          $msgs[$f.'.before']    = 'De ' . $k . ' moet voor :date zijn';
          $msgs[$f.'.after']     = 'De ' . $k . ' moet na :date zijn';
          $msgs[$f.'.alpha']     = 'Het ' . $k . ' veld mag enkel uit letters bestaan';
        }

        return $msgs;
      }

    }
