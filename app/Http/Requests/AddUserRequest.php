<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'firstname' => 'required',
          'lastname' => 'required',
          'password' => 'required|min:7|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
          'confirm' => 'required|same:password',
          'date' => 'required|before:today',
          'email' => 'required|regex:/.+\@.+\..+/',
          'phone' => 'required',
          'gender' => 'required|in:M,V',
          'role' => 'required|in:Zorgwinkel,Zorgbehoevende,Zorgmantel',
          'street' => 'required',
          'streetnumber' => 'required|digits_between:1,10',
          'bus' => 'digits_between:1,10',
          'zipcode' => 'required',
          'city' => 'required',
          'country' => 'required',
        ];
    }

    public function response(array $errors)
    {
        // Optionally, send a custom response on authorize failure
        // (default is to just redirect to initial page with errors)
        //
        // Can return a response, a view, a redirect, or whatever else

        return redirect()
             ->back()
             ->withInput(Request::flash())
             ->withErrors($errors);
    }
}
