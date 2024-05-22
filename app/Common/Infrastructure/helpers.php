<?php

declare(strict_types=1);

use App\Common\Domain\Exception\UnauthorizedUserException;

if (!function_exists('authorize')) {
    /* @throws UnauthorizedUserException */
    function authorize($ability, $policy, $arguments = []): bool
    {
        if ($policy::{$ability}(...$arguments)) {
            return true;
        }
        throw new UnauthorizedUserException();
    }
}
