<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Model\ValueObject;

use App\Reservation\Domain\Exception\RequiredException;
use Carbon\Exceptions\InvalidFormatException;

class DateIn extends Date
{
    public function __construct(?string $date)
    {
        try {
            parent::__construct($date);
        } catch (\InvalidArgumentException|InvalidFormatException) {
            throw new RequiredException('date in');
        }
    }
}
