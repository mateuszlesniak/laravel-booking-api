<?php

declare(strict_types=1);

namespace App\Shared\Application\DTO;

trait ApplicationEnum
{
    public static function fromName(string $name): ?self
    {
        foreach (self::cases() as $status) {
            if ($name === $status->name) {
                return $status;
            }
        }

        return null;
    }
}
