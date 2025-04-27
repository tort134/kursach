<?php

namespace App\Http\Requests;

use App\Exceptions\ApiException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use function Laravel\Prompts\password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'regex:/[А-Я]{1}+[а-я]+$/u'],
            'last_name' => ['required', 'string', 'regex:/[А-Я]{1}+[а-я]+$/u'],
            'patronymic' => ['string', 'regex:/[А-Я]{1}+[а-я]+$/u'],
            'phone_number' => ['required', 'string', 'regex:/\++7+[0-9]{3}+[0-9]{7}+$/'],
            'email' => 'required|email|unique:users,email',
            'password' => ['required', Password::min(6)->mixedCase()->numbers()],
            'city' => 'required|string',
            'street' => 'required|string',
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg']
        ];

    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new ApiException(422, 'Validation error', $validator->errors());

//        throw new \Illuminate\Http\Exceptions\HttpResponseException(
//            response()->json([
//                'errors' => $validator->errors(),
//            ], 422)
//        );
    }
}
