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
            'in'        => 'Het :attribute veld moet een van de volgende waarden bevatten: :values',
            'size'      => 'Het :attribute veld moet :size lang zijn.',
            'between'   => 'Het :attribute veld moet tussen :min - :max zijn.',
            'min'       => 'Het :attribute veld moet minstens :min tekens lang zijn.',
            'max'       => 'Het :attribute veld mag maximaal :max tekens lang zijn.',
            'unique'    => 'Het :attribute veld moet uniek zijn.',
            'alpha_num' => 'Het :attribute veld moet alfanumeriek zijn.',
            'numberic'  => 'Het :attribute veld moet numeriek zijn.',
            'email'     => 'Het :attribute veld moet een geldig emailadres zijn.',
            'image'     => 'Het :attribute veld moet een foto zijn, een jpeg,png, bmp, gif of svg',
            'same'      => 'Het :attribute veld moet gelijk zijn aan :other.',
            'before'    => 'De :attribute moet voor :date zijn',
            'after'     => 'De :attribute moet na :date zijn',
            'alpha'     => 'Het :attribute veld mag enkel uit letters bestaan',
        ];
    }
}
