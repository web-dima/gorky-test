<?php

namespace App\Dto;

class ReservationDestroyDto extends AbstractDto
{
    private string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public static function init(...$params): self
    {
        return new self(...$params);
    }

    public function getArray(): array
    {
        return [
            "success" => false,
            "message" => $this->message,
        ];
    }
}
