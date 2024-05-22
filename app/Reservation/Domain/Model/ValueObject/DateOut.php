<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Model\ValueObject;

use App\Common\Domain\ValueObject\Date;
use App\Reservation\Domain\Exception\RequiredException;
use Carbon\Exceptions\InvalidFormatException;

class DateOut extends Date
{
    public function __construct(?string $date)
    {
        try {
            parent::__construct($date);
        } catch (\InvalidArgumentException|InvalidFormatException) {
            throw new RequiredException('date out');
        }
    }
}
