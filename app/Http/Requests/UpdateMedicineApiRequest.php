<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\ApiHelper;


class UpdateMedicineApiRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(ApiHelper::isPatient($this->route('user_id')) 
            && ApiHelper::isMedicineOfPatient($this->route('user_id'), $this->route('medicine_id')) )
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
        'name'  => 'min:3|max:255',
        'info'  => 'min:3|max:1500',
        'photo' => 'image|max:5000', // Max 5MB pictures        
        ];
    }
}
