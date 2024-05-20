<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repository;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    public function __construct(
        protected readonly Model $model,
    ) {
    }
}
