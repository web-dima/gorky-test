<?php

namespace App\Dto;

use App\Models\Reservation;

class ReservationArrayDto extends Dto {

    /** @var Reservation[] */
    private array $reservations;

    public function __construct(array $reservations)
    {
        $this->reservations = $reservations;
    }


    public static function init(...$params): ReservationArrayDto
    {
        return new self(...$params);
    }

    public function getArray(): array
    {
        return [
            "success" => true,
            "reservations" => $this->reservations,
        ];
    }
}
