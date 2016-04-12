<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\ApiHelper;
use App\User;
use App\Medicine;

class CreateScheduleApiRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user_id = $this->route('user_id');
        $medicine_id = $this->medicine_id;

        // check if the medicine for the schedule belongs to a patient of the buddy
        if(ApiHelper::isPatient($user_id)
            &&  ApiHelper::isMedicineOfPatient($user_id, $medicine_id)) 
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
        'medicine_id'   => 'required|numeric|exists:medicines,id',
        'dayOfWeek'     => 'required|numeric|between:1,7',
        'time'          => 'required|date_format:H:i:s',
        'amount'        => 'required|numeric',        
        ];
    }
}
