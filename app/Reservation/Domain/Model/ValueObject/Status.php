<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Model\ValueObject;

use App\Common\Domain\ValueObject\ValueObject;
use App\Reservation\Application\DTO\ReservationStatus;

class Status extends ValueObject implements \Stringable
{
    public readonly ReservationStatus $value;

    public function __construct(?ReservationStatus $status = null)
    {
        if (!$status) {
            $this->value = ReservationStatus::NEW;

            return;
        }

        $this->value = $status;
    }

    public function __toString(): string
    {
        return $this->value->value;
    }

    #[\Override]
    public function jsonSerialize(): string
    {
        return $this->value->value;
    }
}
