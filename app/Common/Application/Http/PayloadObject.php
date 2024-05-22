<?php

declare(strict_types=1);

namespace App\Common\Application\Http;

interface PayloadObject
{
    public function getRequiredFields(): array;
}
