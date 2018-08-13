<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

use Symfony\Component\HttpFoundation\Response;

/**
 *
 */
abstract class JsonRequest extends FormRequest
{
    /**
     * @inheritdoc
     */
    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

        throw (new ValidationException($validator, $response));
    }
}
