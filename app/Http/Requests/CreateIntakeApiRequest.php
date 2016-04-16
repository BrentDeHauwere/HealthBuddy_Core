<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\ApiHelper;

class CreateIntakeApiRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user_id = $this->route('user_id');
        $schedule_id = $this->schedule_id;

        if(ApiHelper::isLoggedInUserPatient($user_id)) 
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
        // 'schedule_id'  => 'required|numeric',
        ];
    }
}
