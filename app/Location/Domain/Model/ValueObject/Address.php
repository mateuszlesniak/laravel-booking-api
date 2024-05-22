<?php

declare(strict_types=1);

namespace App\Location\Domain\Model\ValueObject;

use App\Common\Domain\ValueObject;
use App\Reservation\Domain\Exception\RequiredException;

class Address extends ValueObject
{
    private string $address;

    public function __construct(?string $address)
    {
        if (!$address) {
            throw new RequiredException('location address');
        }

        $this->address = $address;
    }

    public function __toString(): string
    {
        return $this->address;
    }

    #[\Override]
    public function jsonSerialize(): string
    {
        return $this->address;
    }
}
