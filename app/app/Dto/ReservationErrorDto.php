<?php

namespace App\Dto;

class ReservationErrorDto extends AbstractDto
{
    private string $error;

    public function __construct(string $error)
    {
        $this->error = $error;
    }

    public static function init(...$params): self
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
