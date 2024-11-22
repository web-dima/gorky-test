<?php

namespace App\Enums;

enum ReservationStatusEnum: int
{
     case NOT_ACCEPTED = 0;
     case ACCEPTED = 1;

    public static function values(): array
    {
        return array_map(function ($case) {
            return $case->value;
        }, self::cases());
    }

    // Метод для получения текстового представления статуса
    public static function getName(self $status): string
    {
        return match ($status) {
            self::NOT_ACCEPTED => 'Не подтвержден',
            self::ACCEPTED => 'Подтвержден',
        };
    }
}
