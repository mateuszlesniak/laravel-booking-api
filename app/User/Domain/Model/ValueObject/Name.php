<?php

declare(strict_types=1);

namespace App\User\Domain\Model\ValueObject;

use App\Common\Domain\ValueObject\ValueObject;
use App\Reservation\Domain\Exception\RequiredException;

class Name extends ValueObject implements \Stringable
{
    private ?string $name;

    public function __construct(?string $name = null, bool $isOptional = false)
    {
        if (!$name && !$isOptional) {
            throw new RequiredException('name');
        }

        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name ?? '';
    }

    #[\Override]
    public function jsonSerialize(): ?string
    {
        return $this->name;
    }
}
