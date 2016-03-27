<?php

namespace App\Http\Requests;

use Auth;
use App\Http\Requests\Request;
use App\User;
use App\address;
use App\ApiHelper;

class UpdateAddressApiRequest extends Request
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
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'street'        => 'min:2|max:255',
        'streetNumber'  => 'numeric|between:1,10000',
        'bus'           => 'numeric|between:1,1000',
        'zipCode'       => 'min:2|max:255',
        'city'          => 'min:2|max:255',
        'country'       => 'min:2|max:255',
        ];
    }
    
}
