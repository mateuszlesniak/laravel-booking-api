<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Model\ValueObject;

use App\Common\Domain\ValueObject;
use App\Reservation\Domain\Exception\RequiredException;

class User extends ValueObject
{
    public readonly string $value;

    public function __construct(
        ?string $email,
    ) {
        if (!$email) {
            throw new RequiredException('user email');
        }

        $this->value = $email;
    }

    #[\Override]
    public function jsonSerialize(): string
    {
        return $this->value;
    }
}
