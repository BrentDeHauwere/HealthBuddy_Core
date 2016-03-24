<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'required'  => 'Het :attribute veld is verplicht in te vullen.',
            'in'        => 'Het :attribute moet een van de volgende waarden bevatten: :values',
            'size'      => 'Het :attribute moet :size lang zijn.',
            'between'   => 'Het :attribute veld moet tussen :min - :max zijn.',
            'min'       => 'Het :attribute moet minstens: :values lang zijn.',
            'max'       => 'Het :attribute mag maximaal: :values lang zijn.',
            'unique'    => 'Het :attribute moet uniek zijn.',
            'alpha_num' => 'Het :attribute moet alfanumeriek zijn.'
        ];
    }
}
