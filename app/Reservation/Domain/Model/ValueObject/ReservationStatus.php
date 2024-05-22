<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Model\ValueObject;

use App\Common\Domain\ValueObject\ValueObject;
use App\Reservation\Application\DTO\ReservationStatus as ReservationStatusEnum;
use App\Reservation\Domain\Exception\RequiredException;

class ReservationStatus extends ValueObject
{
    private ReservationStatusEnum $reservationStatus;

    public function __construct(?ReservationStatusEnum $reservationStatus)
    {
        if (!$reservationStatus) {
            throw new RequiredException('reservation status');
        }

        $this->reservationStatus = $reservationStatus;
    }

    public function __toString(): string
    {
        return $this->reservationStatus->name;
    }

    #[\Override]
    public function jsonSerialize(): string
    {
        return $this->reservationStatus->name;
    }
}
