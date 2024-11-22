<?php

namespace App\Dto;

class ReservationErrorDto extends Dto {
    private string $error;

    public function __construct(string $error)
    {
        $this->error = $error;
    }

    public static function init(...$params): ReservationErrorDto
    {
        return new self(...$params);
    }

    public function getArray(): array
    {
        return [
            "success" => false,
            "error" => $this->error,
        ];
    }
}
