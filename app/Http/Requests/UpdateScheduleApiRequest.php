<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\ApiHelper;
use App\User;

class UpdateScheduleApiRequest extends Request
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
        if(ApiHelper::isPatient($user_id) 
            && ApiHelper::isScheduleOfPatientsMedicine($user_id, $this->route('schedule_id')))
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
        'dayOfWeek'     => 'numeric|between:1,7',
        'time'          => 'date_format:H:i:s',
        'amount'        => 'numeric',
        ];
    }
}
