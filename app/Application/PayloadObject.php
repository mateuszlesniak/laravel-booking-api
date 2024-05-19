<?php

declare(strict_types=1);

namespace App\Application;

interface PayloadObject
{
    public function getRequiredFields(): array;
}
