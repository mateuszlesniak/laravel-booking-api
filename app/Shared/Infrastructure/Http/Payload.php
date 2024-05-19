<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Http;

use App\Shared\Application\Http\PayloadObject;

abstract class Payload implements PayloadObject
{
    protected array $requiredFields = [];

    #[\Override]
    public function getRequiredFields(): array
    {
        return $this->requiredFields;
    }
}
