<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\ApiHelper;
use App\User;

class CreateMedicineApiRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // check if the user_id is of a patient of this buddy.
        $user_id = $this->route('user_id');
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
            'name'  => 'required|unique:medicines,name|min:3|max:255',
            'info'  => 'min:3|max:1500',
            // 'photo' => 'image|max:5000', // Max 5MB pictures
        ];
    }
}
