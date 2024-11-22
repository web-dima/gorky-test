<?php

namespace App\Dto;

class AuthTokenDto extends Dto {
    private string $access_token;
    private string $token_type;
    private int $expires_in;

    public function __construct(string $access_token, string $token_type, int $expires_in)
    {
        $this->access_token = $access_token;
        $this->token_type = $token_type;
        $this->expires_in = $expires_in;
    }

    public static function init(...$params): AuthTokenDto
    {
        return new self(...$params);
    }

    public function getArray(): array
    {
        return [
            "success" => true,
            "access_token" => $this->access_token,
            "token_type" => $this->token_type,
            "expires_in" => $this->expires_in,
        ];
    }
}
