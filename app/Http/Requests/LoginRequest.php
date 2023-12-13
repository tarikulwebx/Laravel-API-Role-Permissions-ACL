<?php

namespace App\Http\Requests;

use App\Http\Helpers\Helper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            "email_or_username" => "required|string|max:255",
            "password" => "required"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        /*return [
            "message" => "Validation failed!",
            "errors" => $validator->errors(),
        ];*/

        Helper::sendError("Validation error", $validator->errors());
    }
}
