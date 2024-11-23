<?php

namespace App\Dto;

class StoreReservationDto extends AbstractDto
{
    private int|false $user_id;
    private string $check_in_date;
    private int $status;

    public function __construct(int|false $user_id, string $check_in_date, int $status = 0)
    {
        $this->user_id = $user_id;
        $this->check_in_date = $check_in_date;
        $this->status = $status;
        $this->setSuccess(true);
    }

    public static function init(...$params): self
    {
        if (isset($params["user_id"])) {
            return new self(...$params);
        } else {
            return new self(false, ...$params);
        }
    }

    public function getArray(): array
    {
        return [
            "user_id" => $this->user_id,
            "check_in_date" => $this->check_in_date,
            "status" => $this->status,
        ];
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }
}
