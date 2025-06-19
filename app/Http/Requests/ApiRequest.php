<?php

namespace App\Http\Requests;

use App\Exceptions\ApiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{

    public function authorize(): bool
    {
        return false;
    }


    public function rules(): array
    {
        return [
            //
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new ApiException(422, 'Validation failed', $validator->errors());
    }
}
