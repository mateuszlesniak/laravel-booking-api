<?php

declare(strict_types=1);

namespace App\Location\Domain\Model\ValueObject;

use App\Common\Domain\ValueObject;
use App\Reservation\Domain\Exception\RequiredException;

class Name extends ValueObject
{
    private string $name;

    public function __construct(?string $name)
    {
        if (!$name) {
            throw new RequiredException('name');
        }

        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    #[\Override]
    public function jsonSerialize(): string
    {
        return $this->name;
    }
}
