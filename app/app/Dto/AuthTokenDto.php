<?php

namespace App\Dto;

class AuthTokenDto extends AbstractDto
{
    private string $accessToken;
    private string $tokenType;
    private int $expiresIn;

    public function __construct(string $accessToken, string $tokenType, int $expiresIn)
    {
        $this->accessToken = $accessToken;
        $this->tokenType = $tokenType;
        $this->expiresIn = $expiresIn;
        $this->setSuccess(true);
    }

    public static function init(...$params): self
    {
        return new self(...$params);
    }

    public function getArray(): array
    {
        return [
            "success" => $this->getSuccess(),
            "access_token" => $this->accessToken,
            "token_type" => $this->tokenType,
            "expires_in" => $this->expiresIn,
        ];
    }
}
