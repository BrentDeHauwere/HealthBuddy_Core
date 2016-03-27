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
            return response('This user is not a patient.', 403);
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
        return [
        'length'            => 'numeric|between:30,300',
        'weight'            => 'numeric|between:25.0,450.1',
        'bloodType'         => 'in:A+,A-,B+,B-,AB+,AB-,O+,O-',
        'medicalCondition'  => 'max:255',
        'allergies'         => 'max:255',
        ];
    }
}
