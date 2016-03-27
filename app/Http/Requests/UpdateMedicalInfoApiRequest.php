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
        else
        {
            // the address does not belong to buddy nor patient, abort.
            return response('That address does not belong to a patient', 403);
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

        $fields = array('length', 'weight', 'bloodType', 'medicalCondition', 'allergies');
        // user_id   int(10)     UNSIGNED
        // length  int(10)     UNSIGNED
        // weight  decimal(5,2)
        // bloodType   enum('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'
        // medicalCondition  varchar(255)
        // allergies   varchar(255)

        return [
            //
        ];
    }
}
