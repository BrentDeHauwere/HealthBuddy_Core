<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\ApiHelper;
use App\User;
use App\Schedule;

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
        // 'medicine_id'   => 'required|numeric|exists:medicines,id',
        'time'          => 'date_format:H:i:s',
        'amount'        => 'min:1',
        'start_date'    => 'after:today',
        'interval'      => 'filled|in:'.join(',', Schedule::getPossibleIntervals()),
        ];
    }
}
