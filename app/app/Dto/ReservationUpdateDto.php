<?php

namespace App\Dto;

use App\Models\Reservation;

class ReservationUpdateDto extends Dto {
    private Reservation $reservation;
    private string $check_in_date;
    private int $status;

    public function __construct(Reservation $reservation, $check_in_date = null, $status = null)
    {
        $this->check_in_date = is_null($check_in_date) ? $reservation->check_in_date : $check_in_date;
        $this->status = is_null($status) ? $reservation->status : $status;
        $this->reservation = $reservation;
    }

    public static function init(...$params): ReservationUpdateDto
    {
        return new self(...$params);
    }

    public function getArray(): array
    {
        return [
            "check_in_date" => $this->check_in_date,
            "status" => $this->status
        ];
    }

    public function getOwnerUserID(): int
    {
        return $this->reservation->user_id;
    }

    public function getReservationID(): int
    {
        return $this->reservation->id;
    }
}
