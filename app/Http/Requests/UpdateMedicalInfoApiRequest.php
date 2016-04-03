<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\User;
use App\MedicalInfo;

// helper functions
use App\ApiHelper;


class UpdateMedicalInfoApiRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $auth_user = ApiHelper::getAuthenticatedUser();
        $user_id = $this->route('user_id');
        $patient = User::find($user_id);

        // check if the addresss belongs to the buddy or one of it's patients
        if(ApiHelper::isPatient($user_id))
        {
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
        return [
        'length'            => 'numeric|between:0,300',
        'weight'            => 'numeric|between:0,450.1',
        'bloodType'         => 'in:A+,A-,B+,B-,AB+,AB-,O+,O-,onbekend',
        'medicalCondition'  => 'max:255',
        'allergies'         => 'max:255',
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

        $fields = array('length' => 'lengte', 'weight' => 'gewicht', 'bloodType' => 'bloedtype', 'medicalCondition'=>'medische aandoening', 'allergies'=>'allergiën');
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
