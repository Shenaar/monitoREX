<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\WebApiRequest;
use App\Rules\Password;

class RegisterRequestWeb extends WebApiRequest
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
        return  [
            'login' => 'required',
            'password' => ['required', new Password()]
        ];
    }
}