<?php

declare(strict_types=1);

namespace App\Location\Domain\Model\ValueObject;

use App\Common\Domain\ValueObject;
use App\Reservation\Domain\Exception\RequiredException;

class LocationCode extends ValueObject
{
    private string $location_code;

    public function __construct(?string $location_code)
    {
        if (!$location_code) {
            throw new RequiredException('location code');
        }

        $this->location_code = $location_code;
    }

    public function __toString(): string
    {
        return $this->location_code;
    }

    #[\Override]
    public function jsonSerialize(): string
    {
        return $this->location_code;
    }
}
