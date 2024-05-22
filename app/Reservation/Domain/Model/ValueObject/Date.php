<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Model\ValueObject;

use App\Common\Domain\ValueObject;
use Carbon\Carbon;

class Date extends ValueObject
{
    private const string DATE_FORMAT = 'Y-m-d';

    public readonly Carbon $value;

    public function __construct(
        ?string $date,
    ) {
        $date = Carbon::createFromFormat(self::DATE_FORMAT, $date)
            ->setTime(0, 0, 0, 0);

        if (!$date) {
            throw new \InvalidArgumentException();
        }

        $this->value = $date;
    }

    #[\Override]
    public function jsonSerialize(): string
    {
        return $this->value->format(self::DATE_FORMAT);
    }

    public function toDate(): Carbon
    {
        return $this->value;
    }
}
