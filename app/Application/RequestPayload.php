<?php

declare(strict_types=1);

namespace App\Application;

abstract class RequestPayload implements PayloadObject
{
    protected array $requiredFields = [];

    #[\Override]
    public function getRequiredFields(): array
    {
        return $this->requiredFields;
    }
}
