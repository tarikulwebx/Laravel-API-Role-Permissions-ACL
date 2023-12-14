<?php

namespace App\Http\Requests;

use App\Http\Helpers\Helper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            "name"          => "required|string|max:255",
            "username"      => "required|string|unique:users,username",
            "email"         => "required|email|unique:users,email",
            "password"      => "required|min:6|max:255",
            'roles.*'       => "nullable|string|exists:roles,name",
            'permissions.*' => "nullable|string|exists:permissions,name"
        ];
    }

    public function failedValidation(Validator $validator)
    {
        Helper::sendError("Validation error!", $validator->errors());
    }
}
