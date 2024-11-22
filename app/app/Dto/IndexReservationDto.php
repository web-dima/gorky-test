<?php

namespace App\Dto;

class IndexReservationDto extends Dto {
    private ?int $limit;
    private ?int $offset;
    private ?int $status;

    public function __construct(?int $limit = null, ?int $offset = null, ?int $status = null)
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->status = $status;
    }

    public static function init(...$params): IndexReservationDto
    {
        return new self(...$params);
    }

    public function getArray(): array
    {
        return [
            "limit" => $this->limit,
            "offset" => $this->offset,
            "status" => $this->status,
        ];
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @return int|null
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

}
