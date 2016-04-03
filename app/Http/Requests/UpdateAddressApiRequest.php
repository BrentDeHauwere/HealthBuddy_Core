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
        'street'        => 'min:2|max:255',
        'streetNumber'  => 'alpha_num|min:1|max:15',
        'bus'           => 'alpha|min:1|max:5',
        'zipCode'       => 'min:2|max:255',
        'city'          => 'min:2|max:255',
        'country'       => 'min:2|max:255',
        ];
    }
    
}
