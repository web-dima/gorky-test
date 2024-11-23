<?php

namespace App\Dto;

use App\Models\Reservation;

class ReservationShowDto extends AbstractDto
{
    private Reservation $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
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
            "reservation" => $this->reservation,
        ];
    }

    /**
     * @return Reservation
     */
    public function getReservation(): Reservation
    {
        return $this->reservation;
    }
}
