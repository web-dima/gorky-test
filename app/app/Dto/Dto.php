<?php

namespace App\Dto;

abstract class AbstractDto
{
    abstract public static function init(...$params): self;

    abstract public function getArray(): array;
}
