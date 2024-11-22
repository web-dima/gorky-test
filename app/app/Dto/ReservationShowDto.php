<?php

namespace App\Dto;

use App\Models\Reservation;

class ReservationShowDto extends Dto {
    private Reservation $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }


    public static function init(...$params): ReservationShowDto
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

    /**
     * @return Reservation
     */
    public function getReservation(): Reservation
    {
        return $this->reservation;
    }
}
