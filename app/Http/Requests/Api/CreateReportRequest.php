<?php

namespace App\Http\Requests\Api;

class CreateReportRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'class' => 'required',
            'file'  => 'required',
            'line'  => 'required|integer',
            'message' => 'required',
            'trace' => 'nullable',
            'url'   => 'required',
        ];
    }
}
