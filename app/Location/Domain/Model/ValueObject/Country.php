<?php

declare(strict_types=1);

namespace App\Location\Domain\Model\ValueObject;

use App\Common\Domain\ValueObject\ValueObject;
use App\Reservation\Domain\Exception\RequiredException;

class Country extends ValueObject
{
    private string $country_code;

    public function __construct(?string $country_code)
    {
        if (!$country_code) {
            throw new RequiredException('country code');
        }

        $this->country_code = $country_code;
    }

    public function __toString(): string
    {
        return $this->country_code;
    }

    #[\Override]
    public function jsonSerialize(): string
    {
        return $this->country_code;
    }
}
