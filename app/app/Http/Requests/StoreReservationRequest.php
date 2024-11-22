<?php

namespace App\Http\Requests;

use App\Enums\ReservationStatusEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReservationRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "user_id" => "int|exists:users,id",
            "check_in_date" => "required|date|after_or_equal:today",
            "status" => [Rule::enum(ReservationStatusEnum::class)],
        ];
    }

    public function messages(): array
    {
        return [
            "check_in_date.required" => "Не передана Дата заезда",
            "check_in_date.date" => "Дата заезда неверного формата",
            "check_in_date.after_or_equal" => "Указанная дата уже прошла",
            "user_id.exists" => "Данного пользователя не существует",
            "status.Illuminate\Validation\Rules\Enum" => "Такого статуса не существует",
        ];
    }
}