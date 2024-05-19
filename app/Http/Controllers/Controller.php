<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\ArgumentExtractor;

abstract class Controller
{
    use ArgumentExtractor;
}
