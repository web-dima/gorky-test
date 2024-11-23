<?php

namespace App\Dto;

use App\Models\Reservation;

class ReservationArrayDto extends AbstractDto
{
    /** @var Reservation[] */
    private array $reservations;

    public function __construct(array $reservations)
    {
        $this->reservations = $reservations;
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
            "reservations" => $this->reservations,
        ];
    }
}
