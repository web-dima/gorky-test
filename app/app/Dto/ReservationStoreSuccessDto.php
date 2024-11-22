<?php

namespace App\Dto;

use App\Models\Reservation;

class ReservationStoreSuccessDto extends AbstractDto
{
    private Reservation $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public static function init(...$params): self
    {
        return new self(...$params);
    }

    public function getArray(): array
    {
        return [
            "success" => true,
            "reservation" => $this->reservation,
        ];
    }
}
