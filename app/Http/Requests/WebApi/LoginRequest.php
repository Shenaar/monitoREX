<?php

namespace App\Http\Requests\WebApi;

use App\Http\Requests\JsonRequest;

class LoginRequest extends JsonRequest
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
            'login'    => 'required',
            'password' => 'required',
        ];
    }
}
