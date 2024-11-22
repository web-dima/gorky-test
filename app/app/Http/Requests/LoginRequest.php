<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "email" => "required|string|exists:users,email",
            "password" => "required|string",
        ];
    }

    public function messages(): array
    {
        return [
            "email.required" => "Не передана почта",
            "email.exists" => "Данной почты нет в базе",
            "password.required" => "Пароль не передан",
        ];
    }
}
