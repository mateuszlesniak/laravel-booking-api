<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Http\Controllers;

use App\Common\Infrastructure\Http\JsonResponseData;
use Illuminate\Http\JsonResponse;

abstract class Controller
{
    protected function jsonResponseException(
        int $responseCode,
        ?\Exception $exception = null,
    ): JsonResponse {
        return response()->json(JsonResponseData::fromException($exception), $responseCode);
    }
}
