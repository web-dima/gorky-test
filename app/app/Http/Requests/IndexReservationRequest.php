<?php

namespace App\Http\Requests;

use App\Enums\ReservationStatusEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexReservationRequest extends FormRequest
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
            "limit" => "int|min:1",
            "offset" => "int|min:0",
            "status" => [Rule::enum(ReservationStatusEnum::class)],
        ];
    }

    public function messages(): array
    {
        return [
            "limit.int" => "",
            "limit.min" => "минимальный limit 1",
            "offset.int" => "offset должен быть числом",
            "offset.min" => "минимальный offset 0",
            "status.Illuminate\Validation\Rules\Enum" => "Такого статуса не существует",
        ];
    }
}
