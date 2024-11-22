<?php

namespace App\Dto;

class AuthErrorDto extends Dto {
    private string $error;

    public function __construct(string $error)
    {
        $this->error = $error;
    }

    public static function init(...$params): AuthErrorDto
    {
        return new self(...$params);
    }

    public function getArray(): array
    {
        return [
            "success" => false,
            "errors" => [
                $this->error
            ],
        ];
    }
}
