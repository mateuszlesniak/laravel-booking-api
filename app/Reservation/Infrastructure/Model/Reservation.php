<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Model;

use App\Location\Infrastructure\Model\Location;
use App\User\Infrastructure\Model\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reservation extends Model
{
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function location(): HasOne
    {
        return $this->hasOne(Location::class);
    }
}
