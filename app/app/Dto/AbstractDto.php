<?php

namespace App\Dto;

abstract class AbstractDto
{
    private bool $success;

    abstract public static function init(...$params): self;
    abstract public function getArray(): array;

    public function getSuccess(): bool
    {
        return $this->success;
    }
    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }
}
