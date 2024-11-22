<?php

namespace App\Dto;

abstract class Dto {

    public static abstract function init(...$params): self;
    public abstract function getArray(): array;
}
