<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Http;

use App\Shared\Infrastructure\Http\Payload;

final class SearchReservationDTO extends Payload
{
    protected array $requiredFields = [
        'user_id'
    ];

    private int $userId;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): SearchReservationDTO
    {
        $this->userId = $userId;
        return $this;
    }
}
