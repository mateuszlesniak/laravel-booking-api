<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Http\Controllers;

use App\Shared\Infrastructure\Http\ArgumentExtractor;

abstract class Controller
{
    use ArgumentExtractor;
}
