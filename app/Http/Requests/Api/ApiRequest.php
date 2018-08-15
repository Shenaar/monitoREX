<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\JsonRequest;
use App\Models\Project;

class ApiRequest extends JsonRequest
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
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }
}
