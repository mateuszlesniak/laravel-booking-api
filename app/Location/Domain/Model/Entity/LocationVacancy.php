<?php

declare(strict_types=1);

namespace App\Location\Domain\Model\Entity;

use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\Date;

class LocationVacancy extends Entity
{
    public function __construct(
        public readonly ?int $id,
        public readonly Date $date,
        public readonly int $slots,
    ) {
    }

    #[\Override]
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'slots' => $this->slots,
        ];
    }
}
