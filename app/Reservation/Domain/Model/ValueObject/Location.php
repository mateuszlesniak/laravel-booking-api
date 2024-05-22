<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Model\ValueObject;

use App\Common\Domain\ValueObject;
use App\Reservation\Domain\Exception\RequiredException;

class Location extends ValueObject
{
    public readonly string $value;

    public function __construct(
        ?string $locationCode,
    ) {
        if (!$locationCode) {
            throw new RequiredException('location code');
        }

        $this->value = $locationCode;
    }

    #[\Override]
    public function jsonSerialize(): string
    {
        return $this->value;
    }
}
