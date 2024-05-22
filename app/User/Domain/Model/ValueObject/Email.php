<?php

declare(strict_types=1);

namespace App\User\Domain\Model\ValueObject;

use App\Common\Domain\ValueObject\ValueObject;
use App\Reservation\Domain\Exception\RequiredException;
use App\User\Domain\Exception\IncorrectEmailFormatException;

class Email extends ValueObject implements \Stringable
{
    public readonly string $email;

    public function __construct(
        ?string $email,
    ) {
        if (!$email) {
            throw new RequiredException('user email');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new IncorrectEmailFormatException();
        }

        $this->email = $email;
    }

    public function __toString(): string
    {
        return $this->email;
    }

    #[\Override]
    public function jsonSerialize(): string
    {
        return $this->email;
    }
}
