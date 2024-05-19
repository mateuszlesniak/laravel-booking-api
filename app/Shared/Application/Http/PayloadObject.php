<?php

declare(strict_types=1);

namespace App\Shared\Application\Http;

interface PayloadObject
{
    public function getRequiredFields(): array;
}
